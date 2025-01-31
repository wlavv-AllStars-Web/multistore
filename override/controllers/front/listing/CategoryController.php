<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class CategoryControllerCore extends ProductListingFrontController
{
    /** @var string Internal controller name */
    public $php_self = 'category';

    /** @var bool If set to false, customer cannot view the current category. */
    public $customer_access = true;

    /** @var bool */
    protected $notFound = false;

    /**
     * @var Category
     */
    protected $category;

    public function canonicalRedirection($canonicalURL = '')
    {
        if (Validate::isLoadedObject($this->category)) {
            parent::canonicalRedirection($this->context->link->getCategoryLink($this->category));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCanonicalURL()
    {
        if (!Validate::isLoadedObject($this->category)) {
            return '';
        }

        return $this->buildPaginatedUrl($this->context->link->getCategoryLink($this->category));
    }

    /**
     * Initializes controller.
     *
     * @see FrontController::init()
     *
     * @throws PrestaShopException
     */
    public function init()
    {
        $id_category = (int) Tools::getValue('id_category');
        $this->category = new Category(
            $id_category,
            $this->context->language->id
        );

        if (Tools::getValue('ajax') && Tools::getValue('action') === 'getWheelsTemplate') {
            $this->getWheelsTemplate();
            exit; // Prevent further processing
        }

        parent::init();

        if (!Validate::isLoadedObject($this->category) || !$this->category->active || !$this->category->existsInShop($this->context->shop->id)) {
            header('HTTP/1.1 404 Not Found');
            header('Status: 404 Not Found');
            $this->setTemplate('errors/404');
            $this->notFound = true;

            return;
        } elseif (!$this->category->checkAccess($this->context->customer->id)) {
            header('HTTP/1.1 403 Forbidden');
            header('Status: 403 Forbidden');
            // $this->errors[] = $this->trans('You do not have access to this category.', [], 'Shop.Notifications.Error');
            $this->setTemplate('errors/forbidden');

            return;
        }

        $categoryVar = $this->getTemplateVarCategory();

        // Chained hook call - if multiple modules are hooked here, they will receive the result of the previous one as a parameter
        $filteredCategory = Hook::exec(
            'filterCategoryContent',
            ['object' => $categoryVar],
            null,
            false,
            true,
            false,
            null,
            true
        );
        if (!empty($filteredCategory['object'])) {
            $categoryVar = $filteredCategory['object'];
        }

        if($this->context->shop->id == 2) {
            // $this->assignProductList();
            // $ukooObj = new UkooCompat();
            // $ukooData = $ukooObj->hookDisplayCompat(null);
            $manufacturerOBJ = new Manufacturer();
            $manufacturers = $manufacturerOBJ->getManufacturers();

            // pre($ukooData);

            $this->context->smarty->assign([
                'category' => $categoryVar,
                'subcategories' => $this->getTemplateVarSubCategories(),
                'manufacturers'        => $manufacturers,
                // 'ukoodata'             => $ukooData,
            ]);
        }else{
            $this->context->smarty->assign([
                'category' => $categoryVar,
                'subcategories' => $this->getTemplateVarSubCategories(),
                // 'ukoodata'             => $ukooData,
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function initContent()
    {
        parent::initContent();

        if (
            Validate::isLoadedObject($this->category)
            && $this->category->active
            && $this->category->checkAccess($this->context->customer->id)
            && $this->category->existsInShop($this->context->shop->id)
        ) {
            $this->doProductSearch(
                'catalog/listing/category',
                [
                    'entity' => 'category',
                    'id' => $this->category->id,
                ]
            );
        }
    }

    private function getWheelsTemplate()
    {
        $templatePath = _PS_THEME_DIR_ . 'templates/catalog/wheels.tpl';


        header('Content-Type: application/json; charset=utf-8'); // JSON response

        if (file_exists($templatePath)) {
            // Fetch the template content
            $templateContent = file_get_contents($templatePath);

            // Return the template as a JSON response
            echo json_encode([
                'success' => true,
                'template' => $templateContent,
            ]);
        } else {
            // Return a JSON error message
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Template not found',
            ]);
        }
        exit;
    }


    /**
     * overrides layout if category is not visible.
     *
     * @return bool|string
     */
    public function getLayout()
    {
        if (!$this->category->checkAccess($this->context->customer->id) || $this->notFound) {
            return $this->context->shop->theme->getLayoutRelativePathForPage('error');
        }

        return parent::getLayout();
    }

    protected function getAjaxProductSearchVariables()
    {
        // Basic data with rendered products, facets, active filters etc.
        $data = parent::getAjaxProductSearchVariables();

        // Extra data for category pages, so we can dynamically update also these parts
        $rendered_category_header = $this->render('catalog/_partials/category-header', ['listing' => $data]);
        $data['rendered_products_header'] = $rendered_category_header;
        $rendered_category_footer = $this->render('catalog/_partials/category-footer', ['listing' => $data]);
        $data['rendered_products_footer'] = $rendered_category_footer;

        return $data;
    }

    /**
     * @return ProductSearchQuery
     *
     * @throws \PrestaShop\PrestaShop\Core\Product\Search\Exception\InvalidSortOrderDirectionException
     */
    protected function getProductSearchQuery()
    {
        // echo 'paulo';
        $query = new ProductSearchQuery();
        $query
            ->setQueryType('category')
            ->setIdCategory($this->category->id)
            ->setSortOrder(new SortOrder('product', Tools::getProductsOrder('by'), Tools::getProductsOrder('way')));

        return $query;
    }

    /**
     * @return CategoryProductSearchProvider
     */
    protected function getDefaultProductSearchProvider()
    {
        return new CategoryProductSearchProvider(
            $this->getTranslator(),
            $this->category
        );
    }

    protected function getTemplateVarCategory()
    {
        $category = $this->objectPresenter->present($this->category);
        $category['image'] = $this->getImage(
            $this->category,
            $this->category->id_image
        );

        return $category;
    }

    protected function getTemplateVarSubCategories()
    {
        return array_map(function (array $category) {
            $object = new Category(
                $category['id_category'],
                $this->context->language->id
            );

            $category['image'] = $this->getImage(
                $object,
                $object->id_image
            );

            $category['url'] = $this->context->link->getCategoryLink(
                $category['id_category'],
                $category['link_rewrite']
            );

            return $category;
        }, $this->category->getSubCategories($this->context->language->id));
    }

    protected function getImage($object, $id_image)
    {
        $retriever = new ImageRetriever(
            $this->context->link
        );

        return $retriever->getImage($object, $id_image);
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        foreach ($this->category->getAllParents() as $category) {
            /** @var Category $category */
            if ($category->id_parent != 0 && !$category->is_root_category && $category->active) {
                $breadcrumb['links'][] = [
                    'title' => $category->name,
                    'url' => $this->context->link->getCategoryLink($category),
                ];
            }
        }

        if ($this->category->id_parent != 0 && !$this->category->is_root_category && $this->category->active) {
            $breadcrumb['links'][] = [
                'title' => $this->category->name,
                'url' => $this->context->link->getCategoryLink($this->category),
            ];
        }

        return $breadcrumb;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();

        if ($this->notFound) {
            $page['page_name'] = 'pagenotfound';
            $page['body_classes']['pagenotfound'] = true;
            $page['title'] = $this->trans('The page you are looking for was not found.', [], 'Shop.Theme.Global');
        } else {
            $page['body_classes']['category-id-' . $this->category->id] = true;
            $page['body_classes']['category-' . $this->category->name] = true;
            $page['body_classes']['category-id-parent-' . $this->category->id_parent] = true;
            $page['body_classes']['category-depth-level-' . $this->category->level_depth] = true;
        }

        return $page;
    }

    public function getListingLabel()
    {
        if (!Validate::isLoadedObject($this->category)) {
            $this->category = new Category(
                (int) Tools::getValue('id_category'),
                $this->context->language->id
            );
        }

        return $this->trans(
            'Category: %category_name%',
            ['%category_name%' => $this->category->name],
            'Shop.Theme.Catalog'
        );
    }

    public function postProcess(){
        
        if( Tools::getValue('wheelsFilter', 0)){

            if( !empty(Tools::getValue('type')) ){
                $data = self::apiCall( Tools::getValue('type') );
                
                if( Tools::getValue('type') == 'info'){
                    $html = $data;
                    // echo $data;
                }else{
                    $html = '<select class="form-control" id="' . Tools::getValue('id') . '" style="text-align: center;" onChange="' . Tools::getValue('function') . '()">';
                        $html .= '<option value=""> Please select a option </option>';
                        foreach($data->data AS $item) $html .= '<option value="' . $item->slug . '"> ' . $item->name . ' </option>';
                    $html .= '</select>';
                }
                
                echo $html;
            }

            exit;
        }
       
    }

    public static function apiCall($arrayType){

        $key = '9860e1da0926ea371e69f2c19bbb1fe9';
        $brand = Tools::getValue('brand', 0);
        $model = Tools::getValue('model', 0);
        $year  = Tools::getValue('year', 0);
        $modification = Tools::getValue('modification', 0);

        if($arrayType == 'brand')           $url = 'https://api.wheel-size.com/v2/makes/?region=eudm&user_key=' . $key;
        if($arrayType == 'model')           $url = 'https://api.wheel-size.com/v2/models/?make='.$brand.'&region=eudm&user_key=' . $key;
        if($arrayType == 'year')            $url = 'https://api.wheel-size.com/v2/years/?make='.$brand.'&model='.$model.'&region=eudm&user_key=' . $key;
        if($arrayType == 'modifications')   $url = 'https://api.wheel-size.com/v2/modifications/?make='.$brand.'&model='.$model.'&year='.$year.'&region=eudm&user_key=' . $key;
        if($arrayType == 'info')            $url = 'https://api.wheel-size.com/v2/search/by_model/?make='.$brand.'&model='.$model.'&year='.$year.'&modification='.$modification.'&region=eudm&user_key=' . $key;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        curl_close($ch);
        
        if($arrayType == 'info'){
        
            $data = json_decode($json);
            
            $html = '<div style="padding: .5rem 0;display:block;" id="carSpecs">';
                $html.= '<table style="width: 100%;text-align: center;font-size: 16px;color: #fff;margin: 0 auto;margin-top: 10px;border-radius: .25rem;overflow: hidden;">';
                    $html .='<thead>';
                        $html .='<tr style="background: #333;text-align: center;">';
                            $html .='<td style="text-align: center;padding: .5rem 0;"></td>';
                            $html .='<td style="text-align: center;padding: .5rem 0;">Bolt pattern</td>';
                            $html .='<td style="text-align: center;padding: .5rem 0;">Diameter</td>';
                            $html .='<td style="text-align: center;padding: .5rem 0;">Width</td>';
                            $html .='<td style="text-align: center;padding: .5rem 0;">Offset</td>';
                            $html .='<td style="text-align: center;padding: .5rem 0;width: 30px;"></td>';
                        $html .='</tr>';   
                    $html .='</thead>';   
                    
                    foreach($data->data AS $dataSpecs){
                        foreach($dataSpecs->wheels AS $wheels){
                            if($wheels->rear->rim == null){
                                
                                $boltPattern = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue( 'SELECT id_feature_value FROM ps_feature_value_lang WHERE value = "' . $dataSpecs->technical->bolt_pattern . '"' ) + 0;
                                $rimDiameter = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue( 'SELECT id_feature_value FROM ps_feature_value_lang WHERE value = "' . pSQL($wheels->front->rim_diameter. '"') . '"' ) + 0;

                                $html .='<tr style="background: #fff;color: #000;text-align: center;border-bottom: 1px solid #666;" onclick="setFilterFromSelector(\'4:' . $boltPattern . '|5:' . $rimDiameter . '\')">';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">All</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $dataSpecs->technical->bolt_pattern . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->front->rim_diameter . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->front->rim_width . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->front->rim_offset . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;"><i style="color: var(--asm-color);padding: 4px;cursor: pointer;font-size: 1.5rem;" class="fa-solid fa-circle-chevron-right" onclick="setFilterFromSelector(\'4:' . $boltPattern . '|5:' . $rimDiameter . '\')"></i></td>';
                                $html .='</tr>';                            
                            }else{
                                
                                $boltPattern = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue( 'SELECT id_feature_value FROM ps_feature_value_lang WHERE value = "' . $dataSpecs->technical->bolt_pattern . '"' ) + 0;
                                $rimDiameter = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue( 'SELECT id_feature_value FROM ps_feature_value_lang WHERE value = "' . pSQL($wheels->front->rim_diameter. '"') . '"' ) + 0;
                                
                                $html .='<tr style="background: #fff;color: #000;text-align: center;" onclick="setFilterFromSelector(\'4:|5:\')">';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">Front</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $dataSpecs->technical->bolt_pattern . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->front->rim_diameter . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->front->rim_width . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->front->rim_offset . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;"><i style="color: var(--asm-color);padding: 4px;cursor: pointer;font-size: 1.5rem;" class="fa-solid fa-circle-chevron-right" onclick="setFilterFromSelector(\'4:|5:\')"></i></td>';
                                $html .='</tr>'; 
                                
                                $boltPattern = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue( 'SELECT id_feature_value FROM ps_feature_value_lang WHERE value = "' . $dataSpecs->technical->bolt_pattern . '"' ) + 0;
                                $rimDiameter = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue( 'SELECT id_feature_value FROM ps_feature_value_lang WHERE value = "' . pSQL($wheels->front->rim_diameter. '"') . '"' ) + 0;
                                
                                $html .='<tr style="background: #fff;color: #000;text-align: center;border-bottom: 1px solid #666;" onclick="setFilterFromSelector(\'4:|5:\')">';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">Rear</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $dataSpecs->technical->bolt_pattern . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->rear->rim_diameter . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->rear->rim_width . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;">' . $wheels->rear->rim_offset . '</td>';
                                    $html .='<td style="text-align: center;padding: .5rem 0;"><i style="color: var(--asm-color);padding: 4px;cursor: pointer;font-size: 1.5rem;" class="fa-solid fa-circle-chevron-right" onclick="setFilterFromSelector(\'4:|5:\')"></i></td>';
                                $html .='</tr>';                            
                            }
                        }
                    }
                $html.= '</table>';
                $html.= '<div style="padding: 1rem 0;margin-right: auto;display: flex;justify-content: end;"><button type="button" class="btn btn-secondary btn-sm" onclick="resetFilters()" style="border-radius:.25rem;">Reset Filters</button></div>';
            $html.= '</div>';

            return $html;
        }
        
        return json_decode($json);
    }
}
