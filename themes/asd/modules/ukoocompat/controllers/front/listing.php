<?php
/**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2015 - 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 */
use PrestaShop\PrestaShop\Core\Product\Search\Facet;
use PrestaShop\PrestaShop\Core\Product\Search\FacetsRendererInterface;
use PrestaShop\PrestaShop\Core\Product\Search\Pagination;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
use modules\ps_viewedproduct\Ps_Viewedproduct;
use PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductListingLazyArray;
class UkooCompatListingModuleFrontController extends ModuleFrontController
{
    public $display_column_left = true;

    public function __construct()
    {
        parent::__construct();
        $this->context = Context::getContext();
    }

    public function setMedia()
    {
        parent::setMedia();

        if (!$this->useMobileTheme()) {
            $this->addCSS(array(_THEME_CSS_DIR_.'category.css' => 'all', _THEME_CSS_DIR_.'product_list.css' => 'all'));
        }
        $this->addJS(_THEME_JS_DIR_.'category.js');
    }

    private static function getUrlFiltersForCookie()
    {
        $filters[1] = $_POST['filters1'];
        $filters[2] = $_POST['filters2'];
        $filters[3] = $_POST['filters3'];
        $filters[4] = $_POST['filters4'];
        return $filters;
    }

    
    public function initContent()
    {
        $getData = Tools::getAllValues();
        
        $query = new ProductSearchQuery();
        $result = new ProductSearchResult();
        // $totalProductsCount = $result->getTotalProductsCount();


        // echo '<pre>' . print_r($sortOrders, true) . '</pre>';
        // exit;
        parent::initContent();
 
        // $this->productSort();

        // on récupère les informations de la recherche
        $search = new UkooCompatSearch((int)Tools::getValue('id_search'), (int)$this->context->language->id);
        $search->current_id_lang = (int)$this->context->language->id;
        $search->filters = $search->getFilters((int)$this->context->language->id);

        // on assigne les critères sélectionnés à la recherche (pré-remplissage des valeurs saisies)
        $search->selected_criteria = unserialize($this->context->cookie->__get('ukoocompat_search_'.(int)$search->id));
        $search->selected_criteria[1] = Tools::getValue('filters1', Tools::getValue('filter1'));
        $search->selected_criteria[2] = Tools::getValue('filters2', Tools::getValue('filter2'));
        $search->selected_criteria[3] = Tools::getValue('filters3', Tools::getValue('filter3'));
        $search->selected_criteria[4] = Tools::getValue('filters4', Tools::getValue('filter4'));

        // on assigne la catégorie courante à la recherche
      
        // $search->category = new Category(
        //     (Tools::isSubmit('id_category') ? (int)Tools::getValue('id_category') : null),
        //     (int)$this->context->language->id
        // );

        // on récupère les tags et leurs valeurs pour les filtres sélectionnés
        // puis on remplace les tags par leur valeur dans les différents éléments de la recherche
        $search->tags = UkooCompatCompat::getTags($search->selected_criteria, (int)$this->context->language->id);
        $search->replaceSEOTags();
        
        
        // on récupère les informations de l'alias pour affichage
        // $id_alias = (int)UkooCompatAlias::getAliasFromSelectedCriteria($search->selected_criteria);
        // if ($id_alias != 0) {
            // $search->alias = new UkooCompatAlias($id_alias, (int)$this->context->language->id);
        // } else {
        //     $search->alias = null;
        // }

        // on assigne toutes les catégories dans lesquelles la recherche va s'effectuer
        // if ($search->display_subcategories_products) {
        //     $search->categories = UkooCompatSearch::getSearchCategories((int)$search->id);
        // } else {
        //     $search->categories = array();
        // }
        
        $p = Tools::getValue('p', 1);
        
        $n = 19;
        
        $p2 = Tools::getValue('p2', 1);
        
        $n2 = 20;

        $sort_orders = [
            [
                'entity' => 'product',
                'field' => 'sales',
                'direction' => 'desc',
                'label' => 'Sales, highest to lowest',
                'urlParameter' => 'product.sales.desc',
                'current' => '',
                'url' => '?order=product.sales.desc',
            ],
            [
                'entity' => 'product',
                'field' => 'position',
                'direction' => 'asc',
                'label' => 'Relevance',
                'urlParameter' => 'product.position.asc',
                'current' => 1,
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.position.asc',
            ],
            [
                'entity' => 'product',
                'field' => 'name',
                'direction' => 'asc',
                'label' => 'Name, A to Z',
                'urlParameter' => 'product.name.asc',
                'current' => '',
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.name.asc',
            ],
            [
                'entity' => 'product',
                'field' => 'name',
                'direction' => 'desc',
                'label' => 'Name, Z to A',
                'urlParameter' => 'product.name.desc',
                'current' => '',
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.name.desc',
            ],
            [
                'entity' => 'product',
                'field' => 'price',
                'direction' => 'asc',
                'label' => 'Price, low to high',
                'urlParameter' => 'product.price.asc',
                'current' => '',
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.price.asc',
            ],
            [
                'entity' => 'product',
                'field' => 'price',
                'direction' => 'desc',
                'label' => 'Price, high to low',
                'urlParameter' => 'product.price.desc',
                'current' => '',
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.price.desc',
            ],
            [
                'entity' => 'product',
                'field' => 'reference',
                'direction' => 'asc',
                'label' => 'Reference, A to Z',
                'urlParameter' => 'product.reference.asc',
                'current' => '',
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.reference.asc',
            ],
            [
                'entity' => 'product',
                'field' => 'reference',
                'direction' => 'desc',
                'label' => 'Reference, Z to A',
                'urlParameter' => 'product.reference.desc',
                'current' => '',
                'url' => 'http://euromus.local/en/brand/17-mishimoto?order=product.reference.desc',
            ],
        ];
        $sort_selected = null;

        foreach ($sort_orders as $sortOption) {
            if ($sortOption['current'] == 1) {
                $sort_selected = $sortOption;
                break; // Once we find the current one, no need to continue the loop
            }
        }
        
        
        // on assigne les produits compatibles
        $products = UkooCompatCompat::getCompatiblesProducts(
            $search,
            (int)$this->context->language->id,
            (Tools::isSubmit('id_category') ? (int)Tools::getValue('id_category') : null),
            abs((int)Tools::getValue('p', 1)),
			(int)$n,
            /*abs((int)Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))),*/
            (Tools::isSubmit('orderby') ? Tools::getValue('orderby') : 'position'),
            (Tools::isSubmit('orderway') ? Tools::getValue('orderway') : 'desc')
        );
        // echo '<pre>'.print_r($products,1).'</pre>';
        // exit;

        // $productId = [];
        // $processedProducts = array();
        // foreach ($products as $product) {
        //     if (isset($product['id_product'])) {
        //         $productUkoo = new Product($product['id_product'], true);
        
        //         // Example: Assigning specific properties to Smarty
        //         $this->context->smarty->assign('productName', $productUkoo->name);
        //         $this->context->smarty->assign('productPrice', $productUkoo->getPrice());

        //         // Add the processed product to the array
        //         $processedProducts[] = $productUkoo;
        //     }
        // }
        //         // Example: Assigning the array of processed products to Smarty
        // $this->context->smarty->assign('processedProducts', $processedProducts);

        // Assuming you are in a controller or a class that extends ControllerCore



        // Debug: Print the array of processed products
        // echo '<pre>' . print_r($processedProducts, true) . '</pre>';
        // exit;
        // foreach ($products as $productId->id_product) {
        //     $product = new Product($productId, true);
        //     $productsArray[] = $product;
        // }

        $nb_products = (int)UkooCompatCompat::getCompatiblesProducts(
            $search,
            (int)$this->context->language->id,
            (Tools::isSubmit('id_category') ? (int)Tools::getValue('id_category') : null),
            1,
            (int)$n,
            null,
            null,
            true
        );
        

        // $itemsPerPage = Configuration::get('PS_PRODUCTS_PER_PAGE');

        // $pagination = $this->getPagination($nb_products, $p, $itemsPerPage);

        // echo '<pre>'.print_r($products,1).'</pre>';
        // exit;
    //     echo '<pre>'.print_r($others_vars,1).'</pre>';
    // exit;
        
        
        // $nb_productsUniversal = (int)UkooCompatCompat::getUniversalProducts(
        //     $search,
        //     (int)$this->context->language->id,
        //     (Tools::isSubmit('id_category') ? (int)Tools::getValue('id_category') : null),
        //     1,
        //     (int)$n2,
        //     null,
        //     null,
        //     true
        // );

        // $n2 = $nb_productsUniversal;
        // $productsUniversal = UkooCompatCompat::getUniversalProducts(
        //     $search,
        //     (int)$this->context->language->id,
        //     (Tools::isSubmit('id_category') ? (int)Tools::getValue('id_category') : null),
        //     abs((int)Tools::getValue('p2', 1)),
		// 	(int)$n2,
        //     /*abs((int)Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))),*/
        //     (Tools::isSubmit('orderby') ? Tools::getValue('orderby') : 'position'),
        //     (Tools::isSubmit('orderway') ? Tools::getValue('orderway') : 'desc')
        // );
        
        // ---------------------

        // affectation des coloris aux produits
        $this->addColorsToProductList($products);
        // $this->Pagination($nb_products);
        // $pagination = $this->getTemplateVarPagination($query, $result);
        $pagination = $this->getTemplateVarPagination($query, $result);
        $this->context->smarty->assign($pagination);

        // echo '<pre>'.print_r($pagination,1).'</pre>';
        // exit;
        // paulo
        // $this->addColorsToProductList($productsUniversal);
        // $this->pagination($nb_productsUniversal);
        // ----------------
        
        $params = array(
            'id_search' => (int)$search->id,
            'id_lang' => (int)$this->context->language->id,
            'ukoocompat_search_submit' => '');

        if(!empty($_POST['filters1']) && (is_null($getData['id_manufacturer_compats'])) && (is_null($getData['id_category']))){
            $params['filters1'] = $_POST['filters1'];
            $params['filters2'] = $_POST['filters2'];
            $params['filters3'] = $_POST['filters3'];
            $params['filters4'] = $_POST['filters4'];
            
            $filters = self::getUrlFiltersForCookie();

            $this->context->cookie->__set('ukoocompat_search_'.(int)$search->id, serialize($filters));

        }else{
            foreach ($search->selected_criteria as $id_filter => $id_criterion) {
                $params['filters'.(int)$id_filter] = (int)$id_criterion;
            }
        }

        $this->context->smarty->assign(
            array(
                'search' => $search,
                'products' => $products,
                // 'processedProducts' => $processedProducts,
                'sort_orders' => $sort_orders,
                'sort_selected' => $sort_selected,
                'pagination' => $pagination,
                // 'productsUniversal' => $productsUniversal,
                /**'universal' => $universals,**/
                'nb_products' => $nb_products,
                // 'nb_productsUniversal' => $nb_productsUniversal,
                'catalog_link' => $this->context->link->getModuleLink(
                    'ukoocompat',
                    'catalog',
                    $params
                ),
                'meta_title' => $search->listing_meta_title,
                'meta_description' => $search->listing_meta_description)
        );

        // if (isset($this->context->cookie->id_compare)) {
        //     $this->context->smarty->assign(
        //         'compareProducts',
        //         CompareProduct::getCompareProducts((int)$this->context->cookie->id_compare)
        //     );
        // }

        // $categories = CategoryController::getRootCategory();

        $ukooObj = new UkooCompat();
        $ukooData = $ukooObj->hookDisplayCompat(null);

        // $blockLayered = new BlockLayered();
        // $data = $blockLayered->hookLeftColumn(null);

        $manufacturerOBJ = new Manufacturer();
        $manufacturers = $manufacturerOBJ->getManufacturers();

        $getData = Tools::getAllValues();
        
        
        
        $name_1 = UkooCompatCriterion::getCriterionNameFromId($getData['filters1'], $this->context->language->id);
        $name_2 = UkooCompatCriterion::getCriterionNameFromId($getData['filters2'], $this->context->language->id);
        $name_3 = UkooCompatCriterion::getCriterionNameFromId($getData['filters3'], $this->context->language->id);
        $name_4 = UkooCompatCriterion::getCriterionNameFromId($getData['filters4'], $this->context->language->id);

        $id_row=0;

        
        if(isset($this->context->customer->id)) {
            $id_customer = $this->context->customer->id;
            $id_row = Db::getInstance()->getValue("Select id FROM eu_ASM_ukoo_customer WHERE id_brand = " . $getData['filters1'] . " AND id_model = " . $getData['filters2'] . " AND id_type = " . $getData['filters3'] . " AND id_version = " . $getData['filters4'] . " AND id_customer = " . $this->context->customer->id);
        }

        // echo '<pre>'.print_r($products,1).'</pre>';
        // exit;
        
        
        if($getData['filters1'] == 0){
            $params['filters1'] = 0;
            $params['filters2'] = 0;
            $params['filters3'] = 0;
            $params['filters4'] = 0;
            
            $filters = self::getUrlFiltersForCookie();

            $this->context->cookie->__set('ukoocompat_search_'.(int)$search->id, serialize($filters));
            
            Tools::redirect('/?open=yourCar');
        }else{
            $this->context->smarty->assign(array(
                'ukoodata' => $ukooData,
                // 'blockLayered' => $data,
                // 'categoriesMenu' => $categories,
                'manufacturers' => $manufacturers,
                'news_compats' => Tools::getValue('news_compats', 0),
                'order_by_compats' => Tools::getValue('order_by_compats', 'price'),
                'order_by_orientation_compats' => Tools::getValue('order_by_orientation_compats', 'DESC'),
                'id_manufacturer_compats' => Tools::getValue('id_manufacturer_compats', null),
                'nr_items_compats' => Tools::getValue('nr_items_compats', 20),
                'p' => Tools::getValue('p', 1),
                'id_category' => Tools::getValue('id_category', null),
                'search_by_compats' => 1,
                'selected_filter_1' => Tools::getValue('filters1'),
                'selected_filter_2' => Tools::getValue('filters2'),
                'selected_filter_3' => Tools::getValue('filters3'),
                'selected_filter_4' => Tools::getValue('filters4'),
                'filter_1' => Tools::getValue('filters1'),
                'filter_2' => Tools::getValue('filters2'),
                'filter_3' => Tools::getValue('filters3'),
                'filter_4' => Tools::getValue('filters4'),
                'ukoo_name_1' => $name_1,
                'ukoo_name_2' => $name_2,
                'ukoo_name_3' => $name_3,
                'ukoo_name_4' => $name_4,
                'ukoo_listing' => 1,
                'root_page' => Tools::getValue('root_page', null),
                'in_my_cars' => $id_row,
            ));

        //     echo '<pre>'.print_r($name_1,1).'</pre>';
        // exit;
        
            // $link = new Link();
            // $moduleLink = $link->getModuleLink('ukoocompact');
            // $moduleLink = str_replace('default', '', $moduleLink);
            // echo $moduleLink;
            // exit;
            // $templatePath = 'modules\ukoocompat\views\templates\front\listing.tpl';
            // $templatePath = $_SERVER['DOCUMENT_ROOT'] . "modules/ukoocompat/views/templates/front/listing.tpl";
            
            // echo "Template Path: " . $templatePath;
            // exit;
            // $this->setTemplate('listing.tpl');

            // $this->setTemplate('module:listing.tpl');
            $this->setTemplate('module:ukoocompat/views/templates/front/listing.tpl');
            // $this->setTemplate("file:modules/ukoocompat/views/templates/front/listing.tpl");

            // $this->setTemplate('module:ukoocompat/views/templates/front/listing.tpl');
            // $this->module->display('front/listing.tpl', array('selected_filter_1' => 'selected_filter_2', 'selected_filter_3' => 'selected_filter_4'));




            // echo $moduleLink;
            // exit;
            // echo 'listing';
            
            // $this->setTemplate($moduleLink . 'views/templates/front/listing.tpl');
            // $this->setTemplate('listing.tpl');
            // $this->setTemplate('module:ukoocompact/views/templates/front/listing.tpl');


        }
    }

    private function getTemplateVarPagination(
        ProductSearchQuery $query,
        ProductSearchResult $result
    ) {

        $pagination = new Pagination();
        $pagination
            ->setPage($query->getPage())
            ->setPagesCount(
                (int) ceil($result->getTotalProductsCount() / $query->getResultsPerPage())
            )
        ;

        $totalItems = $result->getTotalProductsCount();
        $itemsShownFrom = ($query->getResultsPerPage() * ($query->getPage() - 1)) + 1;
        $itemsShownTo = $query->getResultsPerPage() * $query->getPage();

        
        $pages = array_map(function ($link) {
            $link['url'] = $this->updateQueryString([
                'page' => $link['page'] > 1 ? $link['page'] : null,
            ]);

            return $link;
        }, $pagination->buildLinks());

        //Filter next/previous link on first/last page
        $pages = array_filter($pages, function ($page) use ($pagination) {
            if ('previous' === $page['type'] && 1 === $pagination->getPage()) {
                return false;
            }
            if ('next' === $page['type'] && $pagination->getPagesCount() === $pagination->getPage()) {
                return false;
            }

            return true;
        });
        return [
            'total_items' => $totalItems,
            'items_shown_from' => $itemsShownFrom,
            'items_shown_to' => $itemsShownTo,
            'current_page' => $pagination->getPage(),
            'pages_count' => $pagination->getPagesCount(),
            'pages' => $pages,
            'should_be_displayed' => (count($pagination->buildLinks()) > 3),
        ];
    }
}
