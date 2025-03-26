<?php

use PrestaShop\Module\AsGroup\Adapter\Search\CustomSearchProductSearchProvider;
use PrestaShop\Module\AsGroup\Core\Product\Search\CustomProductSearchQuery;
use PrestaShop\PrestaShop\Adapter\Search\SearchProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
use PrestaShop\PrestaShop\Core\Localization\TranslatorInterface;

class CarsProductsControllerCore extends ProductListingFrontController{
    public $auth = false;
    public $php_self = 'cars-products';

    public $instant_search;
    public $ajax_search;

    protected $search_string;
    protected $search_tag;
    public $car_description;

    public $brand;
    public $model;
    public $type;
    public $version;
    public $compatProducts;
    public $compat;

    public function init()
    {
        parent::init();

        if (Tools::getValue('ajax')) {
            $this->ajax = true;
        }

        // pre(Tools::getAllValues());
        if(Tools::getValue('id_compat')){

            $id_compat = Tools::getValue('id_compat');
            $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
            $shop_id = $this->context->shop->id; 
            $exists = 0;
            if($this->context->customer->id){
                $id_customer = $this->context->customer->id;
                $urlCarsGarage = 'https://webtools.all-stars-motorsport.com/api/get/cars/'.$id_customer.'/'.$shop_id.'/'.$key;

                $ch2 = curl_init();
                curl_setopt($ch2,CURLOPT_URL,$urlCarsGarage);
                curl_setopt($ch2,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch2,CURLOPT_CONNECTTIMEOUT, 4);
                $jsonGarage = curl_exec($ch2);
                curl_close($ch2);
    
                // Decode JSON string into an associative array
                $myCarsGarage = json_decode($jsonGarage, true);

                if(isset($myCarsGarage['data'])){
                    $exists = !empty(array_filter($myCarsGarage['data'], function ($car) use ($id_compat) {
                        return $car['id_compat'] == $id_compat;
                    }));
                }else{
                    $exists = 0;
                }
                
                
            }

            $url = 'https://webtools.all-stars-motorsport.com/api/get/products/' . $id_compat . '/'. $shop_id . '/' . $key;

            // pre($url);
    
            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
    
            // Execute cURL request
            $json = curl_exec($ch);
            curl_close($ch);
    
            // Decode the response into an associative array
            $data = json_decode($json, true);



            // pre($data);


            $products = $data['data'];
            $compat = $data['compat'];

            $compat['subscribed'] = $exists;

            if(count($products) > 0){
                $productObjects = [];
                
                foreach($products as $product){
                    $productObjects[] = ['id_product' => $product];
                };

                $this->compatProducts = $productObjects;

                $productsCar = $this->getProductsByCar($products);


                $products = $this->prepareMultipleProductsForTemplate(
                    $productsCar
                );
            }

            // pre($productObjects);

           $this->brand = $compat['brand'];
           $this->model = $compat['model'];
           $this->type = $compat['type'];
           $this->version = $compat['version'];

           $this->compat[] = [
                'id_compat' => $compat['id_compat'],
                'brand' => $compat['brand'],
                'model' => $compat['model'],
                'type' => $compat['type'],
                'version' => $compat['version'],
                'brand_logo' => $compat['brand_logo'],
                'brand_hover_logo' => $compat['brand_hover_logo'],
                'cartoon' => $compat['cartoon'],
                'subscribed' => $compat['subscribed'],
            ];
        

     
            $this->car_description = $compat['brand']." | ".$compat['model']." | ".$compat['type']." | ".$compat['version'];
            // $search = $this->getProductSearchVariables();

        
            // Fetch products related to the selected car product


            $manufacturerOBJ = new Manufacturer();
            $manufacturers = $manufacturerOBJ->getManufacturers();




            // pre(count($products));

            // Store data in Smarty for use in the template
            $this->context->smarty->assign([
                'listingCompat' => [
                    'products' => $products, // Assign prepared product array
                ],
                'compat' => $compat,
                'manufacturers' => $manufacturers,
            ]);

            // Redirect to the cars-products page
            $this->setTemplate('catalog/cars-products.tpl');
            
        }


    }

    protected function getProductsByCar($carProductIds)
    {
        if (empty($carProductIds)) {
            return [];
        }

        $ids = array_map('intval', (array) $carProductIds);
        $idList = implode(',', $ids);

        $sql = 'SELECT cp.id_category, cp.id_product, cp.position
                FROM ' . _DB_PREFIX_ . 'category_product cp
                LEFT JOIN ' . _DB_PREFIX_ . 'product_shop ps ON cp.id_product = ps.id_product
                WHERE cp.id_product IN (' . $idList . ') GROUP BY cp.id_product';
                
        // pre($sql);

        return Db::getInstance()->executeS($sql);
    }

        
    /**
     * Ensure that no search results page is indexed by search engines.
     */
    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();

        $page['meta']['robots'] = 'noindex';

        return $page;
    }

    public function initContent(){
        
        
        parent::initContent();

        if (Tools::getValue('getMoreProducts')) {
            $this->returnMoreProducts();
            exit; // Prevent further execution
        }

        $product = Tools::getValue('id_compat');
        // pre($product);

        // fazer aqui request tools to get products
    
        // Fetch products related to the selected car product
        $productsCar = $this->getProductsByCar($product);

        // pre($productsCar);

        

        $products = $this->prepareMultipleProductsForTemplate(
            $productsCar
        );


        
        if (empty($products) || !is_array($products)) {
            $noProducts = 1;
        } else {
            $noProducts = count($products) < 1 ? 1 : 0;
        }



        $this->doProductSearch('catalog/cars-products', ['entity' => 'cars-products','listing' => $products]);

        // universal products
        $sqlUniversals = 'SELECT pcp.id_category, pcp.id_product, pcp.POSITION 
                            FROM ps_category_product AS pcp
                            LEFT JOIN ps_product AS pp ON pcp.id_product = pp.id_product
                            LEFT JOIN ps_product_shop AS pps ON pps.id_product = pp.id_product
                            WHERE pp.universal = 1 AND pp.active = 1 AND pps.id_shop = 2 GROUP BY pcp.id_product LIMIT 20';

        $universalProducts = Db::getInstance()->executeS($sqlUniversals);

        $universals = $this->prepareMultipleProductsForTemplate(
            $universalProducts
        );

        $sqlTotalUniversals = 'SELECT COUNT(*)
                                FROM ps_product AS pp
                                LEFT JOIN ps_product_shop AS pps ON pps.id_product = pp.id_product AND pps.id_shop = 2
                                WHERE pp.universal = 1 AND pp.active = 1';

        $TotalUniversals = Db::getInstance()->getValue($sqlTotalUniversals);
        // pre($TotalUniversals);


        $this->context->smarty->assign(
            [
                'url_cars_products_controller' => $this->context->link->getPageLink('cars-products', null, null, null, false, null, true),
                'cars_products_page' => 1,
                'universals' => $universals,
                'total' => $TotalUniversals,
                'noProducts' => $noProducts
            ]
        );

        // pre($this->context->smarty);

        $this->setTemplate('catalog/cars-products.tpl');
    }


    private function returnMoreProducts()
    {
        $displayedProducts = Tools::getValue('displayedProducts');

        // pre($displayedProducts);

        if ($displayedProducts) {
            $displayedProductsArray = array_map('intval', explode(',', $displayedProducts)); // Convert to array of integers
            $excludedProducts = implode(',', $displayedProductsArray); // Convert back to SQL format
        } else {
            $excludedProducts = '0'; // Prevent SQL error if empty
        }

        $sql = 'SELECT pp.id_product 
        FROM ps_product AS pp
        LEFT JOIN ps_product_shop AS pps ON pps.id_product = pp.id_product
        WHERE pp.universal = 1 
          AND pp.active = 1 
          AND pps.id_shop = 2 
          AND NOT EXISTS (
              SELECT 1 FROM ps_product WHERE id_product IN (' . $excludedProducts . ')
          )
        ORDER BY pp.id_product ASC 
        LIMIT 20';

        $newProducts = Db::getInstance()->executeS($sql);
    
        if ($newProducts) {
            $universalsGet = $this->prepareMultipleProductsForTemplate(
                $newProducts
            );

            $this->context->smarty->assign('universalsGet', $universalsGet);

            $newHtml = $this->context->smarty->fetch('catalog/_partials/universal_ajax_products.tpl');
            
    
            die(json_encode([
                'success' => true,
                'product' => $newHtml
            ]));
        } else {

            $this->context->smarty->assign('noMoreProducts', 1);

            $newHtml = $this->context->smarty->fetch('catalog/_partials/universal_ajax_products.tpl');

            die(json_encode([
                'success' => false,
                'message' => $this->trans('No more products.', [], 'Shop.Theme.Cars')
            ]));
        }
    }




    /**
     * @return ProductSearchQuery
     */
    protected function getProductSearchQuery()
    {
        $query = new CustomProductSearchQuery();
        $query
            ->setQueryType('search')
            ->setSortOrder(new SortOrder('product', 'price', 'asc'))
            ->setSearchString($this->search_string)
            ->setSearchTag($this->search_tag)
            ->setBrand($this->brand)
            ->setModel($this->model)
            ->setType($this->type)
            ->setVersion($this->version)
            ->setCompat($this->compat)
            ->setCompatsProducts($this->compatProducts);

            // Pagination settings
            $resultsPerPage = Configuration::get('PS_PRODUCTS_PER_PAGE');
            
            // Use the page number from the URL, default to 1 if not present
            $page = max((int) Tools::getValue('page'), 1);

            
            // Set the pagination properties
            $query->setResultsPerPage($resultsPerPage);
            $query->setPage($page);

            if ($this->search_string) {
                $this->search_string = $this->search_string;
            }

        return $query;
    }

    /**
     * @return SearchProductSearchProvider
     */
    protected function getDefaultProductSearchProvider()
    {

        return new CustomSearchProductSearchProvider(
            $this->getTranslator()
        );
    }

    public function getListingLabel()
    {
        return $this->getTranslator()->trans('Search results', [], 'Shop.Theme.Catalog');
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $carTitle = !empty($this->car_description) ? $this->car_description : 'CAR';

        $breadcrumb['links'][] = [
            'title' => $this->trans($carTitle, [], 'Shop.Theme.CarsProducts'),
            'url' => $this->context->link->getPageLink('cars-products', null, null, ['id_compat' => Tools::getValue('id_compat')]),
        ];

        return $breadcrumb;
    }
}
