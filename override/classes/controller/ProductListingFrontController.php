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

use DoctrineExtensions\Query\Mysql\Field;
use PrestaShop\PrestaShop\Core\Product\Search\Facet;
use PrestaShop\PrestaShop\Core\Product\Search\FacetsRendererInterface;
use PrestaShop\PrestaShop\Core\Product\Search\Pagination;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
use PrestaShopBundle\Controller\Admin\Sell\Catalog\CategoryController;
use PrestaShopBundle\Controller\Api\CategoryController as ApiCategoryController;

/**
 * This class is the base class for all front-end "product listing" controllers,
 * like "CategoryController", that is, controllers whose primary job is
 * to display a list of products and filters to make navigation easier.
 */
abstract class ProductListingFrontControllerCore extends ProductPresentingFrontController
{
    /**
     * Generates an URL to a product listing controller
     * with only the essential query params and page remaining.
     *
     * @param string $canonicalUrl an url to a listing controller page
     *
     * @return string a canonical URL for the current page in the list
     */
    public function buildPaginatedUrl(string $canonicalUrl): string
    {
        $parsedUrl = parse_url($canonicalUrl);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $params);
        } else {
            $params = [];
        }
        $page = (int) Tools::getValue('page');
        if ($page > 1) {
            $params['page'] = $page;
        } else {
            unset($params['page']);
        }

        return http_build_url($parsedUrl, ['query' => http_build_query($params)]);
    }

    /**
     * Takes an associative array with at least the "id_product" key
     * and returns an array containing all information necessary for
     * rendering the product in the template.
     *
     * @param array $rawProduct an associative array with at least the "id_product" key
     *
     * @return array a product ready for templating
     */
    // @phpstan-ignore-next-line
    private function prepareProductForTemplate(array $rawProduct)
    {
        // Enrich data of product
        $product = (new ProductAssembler($this->context))
            ->assembleProduct($rawProduct);

        // Prepare configuration
        $presenter = $this->getProductPresenter();
        $settings = $this->getProductPresentationSettings();

        // Present and return product
        return $presenter->present(
            $settings,
            $product,
            $this->context->language
        );
    }

    /**
     * Runs "prepareProductForTemplate" on the collection
     * of product ids passed in.
     *
     * @param array $products array of arrays containing at list the "id_product" key
     *
     * @return array of products ready for templating
     */
    protected function prepareMultipleProductsForTemplate(array $products)
    {
        // Enrich data set of products
        $products = (new ProductAssembler($this->context))
            ->assembleProducts($products);

        // Prepare configuration
        $presenter = $this->getProductPresenter();
        $settings = $this->getProductPresentationSettings();

        // Present and return each product
        foreach ($products as &$product) {
            $product = $presenter->present(
                $settings,
                $product,
                $this->context->language
            );
        }

        return $products;
    }

    /**
     * The ProductSearchContext is passed to search providers
     * so that they can avoid using the global id_lang and such
     * variables. This method acts as a factory for the ProductSearchContext.
     *
     * @return ProductSearchContext a search context for the queries made by this controller
     */
    protected function getProductSearchContext()
    {
        return (new ProductSearchContext())
            ->setIdShop($this->context->shop->id)
            ->setIdLang($this->context->language->id)
            ->setIdCurrency($this->context->currency->id)
            ->setIdCustomer($this->context->customer ? $this->context->customer->id : null);
    }

    /**
     * Converts a Facet to an array with all necessary
     * information for templating.
     *
     * @param Facet $facet
     *
     * @return array ready for templating
     */
    protected function prepareFacetForTemplate(Facet $facet)
    {
        $facetsArray = $facet->toArray();
        foreach ($facetsArray['filters'] as &$filter) {
            $filter['facetLabel'] = $facet->getLabel();
            if ($filter['nextEncodedFacets']) {
                $filter['nextEncodedFacetsURL'] = $this->updateQueryString([
                    'q' => $filter['nextEncodedFacets'],
                    'page' => null,
                ]);
            } else {
                $filter['nextEncodedFacetsURL'] = $this->updateQueryString([
                    'q' => null,
                ]);
            }
        }
        unset($filter);

        return $facetsArray;
    }

    /**
     * Renders an array of facets.
     *
     * @param ProductSearchResult $result
     *
     * @return string the HTML of the facets
     */
    protected function renderFacets(ProductSearchResult $result)
    {
        $facetCollection = $result->getFacetCollection();
        // not all search providers generate menus
        if (empty($facetCollection)) {
            return '';
        }

        $facetsVar = array_map(
            [$this, 'prepareFacetForTemplate'],
            $facetCollection->getFacets()
        );

        $activeFilters = [];
        foreach ($facetsVar as $facet) {
            foreach ($facet['filters'] as $filter) {
                if ($filter['active']) {
                    $activeFilters[] = $filter;
                }
            }
        }

        return $this->render('catalog/_partials/facets', [
            'facets' => $facetsVar,
            'js_enabled' => $this->ajax,
            'activeFilters' => $activeFilters,
            'sort_order' => $result->getCurrentSortOrder()->toString(),
            'clear_all_link' => $this->updateQueryString(['q' => null, 'page' => null]),
        ]);
    }

    /**
     * Renders an array of active filters.
     *
     * @param ProductSearchResult $result
     *
     * @return string the HTML of the facets
     */
    protected function renderActiveFilters(ProductSearchResult $result)
    {
        $facetCollection = $result->getFacetCollection();
        // not all search providers generate menus
        if (empty($facetCollection)) {
            return '';
        }

        $facetsVar = array_map(
            [$this, 'prepareFacetForTemplate'],
            $facetCollection->getFacets()
        );

        $activeFilters = [];
        foreach ($facetsVar as $facet) {
            foreach ($facet['filters'] as $filter) {
                if ($filter['active']) {
                    $activeFilters[] = $filter;
                }
            }
        }

        return $this->render('catalog/_partials/active_filters', [
            'activeFilters' => $activeFilters,
            'clear_all_link' => $this->updateQueryString(['q' => null, 'page' => null]),
        ]);
    }

    /**
     * This method is the heart of the search provider delegation
     * mechanism.
     *
     * It executes the `productSearchProvider` hook (array style),
     * and returns the first one encountered.
     *
     * This provides a well specified way for modules to execute
     * the search query instead of the core.
     *
     * The hook is called with the $query argument, which allows
     * modules to decide if they can manage the query.
     *
     * For instance, if two search modules are installed and
     * one module knows how to search by category but not by manufacturer,
     * then "ManufacturerController" will use one module to do the query while
     * "CategoryController" will use another module to do the query.
     *
     * If no module can perform the query then null is returned.
     *
     * @param ProductSearchQuery $query
     *
     * @return ProductSearchProviderInterface|null
     */
    private function getProductSearchProviderFromModules($query)
    {
        // An array [module_name => module_output] will be returned
        $providers = Hook::exec(
            'productSearchProvider',
            ['query' => $query],
            null,
            true
        );

        if (!is_array($providers)) {
            $providers = [];
        }

        foreach ($providers as $provider) {
            if ($provider instanceof ProductSearchProviderInterface) {
                return $provider;
            }
        }

        return null;
    }

    /**
     * This returns all template variables needed for rendering
     * the product list, the facets, the pagination and the sort orders.
     *
     * @return array variables ready for templating
     */
    protected function getProductSearchVariables()
    {
        /*
         * To render the page we need to find something (a ProductSearchProviderInterface)
         * that knows how to query products.
         */

        // the search provider will need a context (language, shop...) to do its job
        $context = $this->getProductSearchContext();



        // the controller generates the query...
        $query = $this->getProductSearchQuery();





        // ...modules decide if they can handle it (first one that can is used)
        $provider = $this->getProductSearchProviderFromModules($query);

        // if no module wants to do the query, then the core feature is used
        if (null === $provider) {
            $provider = $this->getDefaultProductSearchProvider();
        }


        $resultsPerPage = (int) Tools::getValue('resultsPerPage');
        if ($resultsPerPage <= 0) {
            $resultsPerPage = Configuration::get('PS_PRODUCTS_PER_PAGE');
        }


        if (Tools::getValue('n')) {
            $resultsPerPage = Tools::getValue('n');
        }

        if (Tools::getValue('id_category_layered')) {
            $query
                ->setIdCategory(Tools::getValue('id_category_layered'));
        }

        if (Tools::getValue('id_manufacturer_layered')) {
            $query
                ->setIdManufacturer(Tools::getValue('id_manufacturer_layered'));
        }



        // we need to set a few parameters from back-end preferences
        $query
            ->setResultsPerPage($resultsPerPage)
            ->setPage(max((int) Tools::getValue('page'), 1))
        ;


        if (Tools::getValue('orderby')) {
            $encodedSortOrder = 'product.' . Tools::getValue('orderby') . '.' . strtolower(Tools::getValue('orderway'));
            // pre($encodedSortOrder);
            $query->setSortOrder(SortOrder::newFromString(
                $encodedSortOrder
            ));
        }

        // set the sort order if provided in the URL
        if (($encodedSortOrder = Tools::getValue('order'))) {

            $query->setSortOrder(SortOrder::newFromString(
                $encodedSortOrder
            ));
        }




        // get the parameters containing the encoded facets from the URL
        $encodedFacets = Tools::getValue('q');

        // pre($encodedFacets);

        /*
         * The controller is agnostic of facets.
         * It's up to the search module to use /define them.
         *
         * Facets are encoded in the "q" URL parameter, which is passed
         * to the search provider through the query's "$encodedFacets" property.
         */

        $query->setEncodedFacets($encodedFacets);

        // pre($query);

        Hook::exec('actionProductSearchProviderRunQueryBefore', [
            'query' => $query,
        ]);

        // $query
        // ->setQueryType('compat');


        // We're ready to run the actual query!
        // pre($provider);

        /** @var ProductSearchResult $result */
        $result = $provider->runQuery(
            $context,
            $query
        );
        // pre($query);
        // pre($result);

        // if(Tools::getValue('id_compat')){

        //     $id_compat = Tools::getValue('id_compat');

        //     $sql = 'SELECT cp.id_product
        //         FROM ' . _DB_PREFIX_ . 'category_product cp WHERE id_product = ' . (int) $id_compat;


        //     $productsCar = Db::getInstance()->executeS($sql);

        //     $result['products'] = $productsCar;
        //     pre($result);
        //     pre($productsCar);

        // }   



        Hook::exec('actionProductSearchProviderRunQueryAfter', [
            'query' => $query,
            'result' => $result,
        ]);

        if (Configuration::get('PS_CATALOG_MODE') && !Configuration::get('PS_CATALOG_MODE_WITH_PRICES')) {
            $this->disablePriceControls($result);
        }

        // pre($result->getProducts());

        // pre($$query->getSortOrder());
        // sort order is useful for template,
        // add it if undefined - it should be the same one
        // as for the query anyway
        if (!$result->getCurrentSortOrder()) {
            $result->setCurrentSortOrder($query->getSortOrder());
        }

        // quickshop

        if (Tools::getValue('quickshop') == 1) {
            // Get the products array
            $products = $result->getProducts();

            // Ensure $products is an array
            if (!is_array($products)) {
                error_log('Error: $result->getProducts() is not an array');
                return;
            }

            // Filter products: Keep only those where out_of_stock is 1 or 2
            $filteredProducts = array_filter($products, function ($product) {
                return isset($product['out_of_stock']) && ($product['out_of_stock'] == 1 || $product['out_of_stock'] == 2);
            });

            // Reindex the array
            $filteredProducts = array_values($filteredProducts);

            // Check if $result has a setter method
            if (method_exists($result, 'setProducts')) {
                $result->setProducts($filteredProducts);
            } else {
                error_log('Error: $result does not have a setProducts method');
            }
        }

        // prepare the products
        $products = $this->prepareMultipleProductsForTemplate(
            $result->getProducts()
        );

        // pre(count($products));


        // render the facets
        if ($provider instanceof FacetsRendererInterface) {
            // with the provider if it wants to
            $rendered_facets = $provider->renderFacets(
                $context,
                $result
            );
            $rendered_active_filters = $provider->renderActiveFilters(
                $context,
                $result
            );
        } else {
            // with the core
            $rendered_facets = $this->renderFacets(
                $result
            );
            $rendered_active_filters = $this->renderActiveFilters(
                $result
            );
        }



        $pagination = $this->getTemplateVarPagination(
            $query,
            $result
        );

        // pre($pagination);
        // prepare the sort orders
        // note that, again, the product controller is sort-orders
        // agnostic
        // a module can easily add specific sort orders that it needs
        // to support (e.g. sort by "energy efficiency")
        $sort_orders = $this->getTemplateVarSortOrders(
            $result->getAvailableSortOrders(),
            $query->getSortOrder()->toString()
        );



        $sort_selected = false;
        if (!empty($sort_orders)) {
            foreach ($sort_orders as $order) {
                if (isset($order['current']) && true === $order['current']) {
                    $sort_selected = $order['label'];

                    break;
                }
            }
        }

        // removi do proximo if porque tinha bug na barra de pesquisa || $this->context->shop->id == 2 && $query->getQueryType() == 'search'

        // asm wheels
        if ($this->context->shop->id == 2 && $query->getQueryType() == 'new-products' || $this->context->shop->id == 2 && $query->getQueryType() == 'category' || $this->context->shop->id == 2 && $query->getQueryType() == 'manufacturer' || $this->context->shop->id == 2 && (Tools::getValue('id_compat') !== 'undefined' && Tools::getValue('id_compat') > 0)) {



            if ($query->getQueryType()) {
                $type = $query->getQueryType();
            }

            if ($query->getIdCategory()) {
                $category = $query->getIdCategory();
            }

            if ($query->getIdManufacturer()) {
                $manufacturer = $query->getIdManufacturer();
            }

            if ($query->getIdSupplier()) {
                $supplier = $query->getIdSupplier();
            }

            if ($query->getResultsPerPage()) {
                $resultsPerPage = $query->getResultsPerPage();
            }

            if ($query->getSortOrder()) {
                $sortOrder = $query->getSortOrder();
            }

            if ($query->getSearchString()) {
                $searchString = $query->getSearchString();
            }

            // pre($query);

            // Fetch category and manufacturer IDs from the query object
            $category = (int) $query->getIdCategory();
            $manufacturer = (int) $query->getIdManufacturer();

            // pre($query);

            $sql = 'SELECT p.id_product, 
                    p.price AS base_price, 
                   COALESCE(
                       (SELECT MAX(p.price + pa.price) 
                        FROM ps_product_attribute_shop pa 
                        WHERE pa.id_product = p.id_product 
                          AND pa.id_shop = 2
                       ), p.price
                   ) AS final_price 
            FROM ps_product p
            LEFT JOIN ps_product_shop ps ON p.id_product = ps.id_product
            LEFT JOIN ps_product_lang pl ON p.id_product = pl.id_product AND pl.id_lang = ' . $this->context->language->id . ' AND pl.id_shop = 2
            LEFT JOIN ps_product_sale psale ON p.id_product = psale.id_product 
            LEFT JOIN ps_category_product pc ON p.id_product = pc.id_product AND pl.id_lang = ' . $this->context->language->id . ' AND pl.id_shop = 2
            WHERE p.active = 1 AND p.visibility != "none" AND ps.id_shop = 2';

            if ($category > 0) {
                $sql .= ' AND pc.id_category = ' . (int) $category;
            }

            if ($manufacturer > 0) {
                $sql .= ' AND p.id_manufacturer = ' . (int) $manufacturer;
            }

            if (!empty($searchString)) {
                $sql .= ' AND (pl.name LIKE "%' . pSQL($searchString) . '%" 
                        OR p.reference LIKE "%' . pSQL($searchString) . '%"
                        OR EXISTS (
                            SELECT 1 FROM ps_product_attribute pa 
                            WHERE pa.id_product = p.id_product 
                              AND pa.reference LIKE "%' . pSQL($searchString) . '%"
                        ))';
            }

            if (!empty($type) && $type == 'new-products') {
                $daysNewProduct = (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT', null, null, 2);
                $newProductDate = date('Y-m-d H:i:s', strtotime("-{$daysNewProduct} days"));
                $sql .= ' AND p.date_add >= "' . pSQL($newProductDate) . '"';
            }

            $sql .= ' GROUP BY p.id_product';

            if ($query->getSortOrder()) {
                $sortOrder = $query->getSortOrder();

                if ($sortOrder->getField() === 'price') {
                    // Sort by final price correctly
                    $sql .= ' ORDER BY final_price '
                        . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'name') {
                    $sql .= ' ORDER BY pl.name ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'reference') {
                    $sql .= ' ORDER BY p.reference ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'sales') {
                    $sql .= ' ORDER BY psale.quantity ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'date_add') {
                    $sql .= ' ORDER BY p.date_add ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                }
            }

            if ($query->getResultsPerPage()) {
                if ($query->getQueryType() == 'new-products') {
                    $query->setResultsPerPage(19);
                }

                $resultsPerPage = (int) $query->getResultsPerPage();
                $currentPage = (int) $query->getPage();
                $offset = ($currentPage - 1) * $resultsPerPage;

                $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;
            }

            $pagination = $this->getTemplateVarPagination(
                $query,
                $result
            );

            // pre($sql);



            // if(count($products) == 0){

            // }
            // pre($products);

            $productsQuery = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);

            $products = $this->prepareMultipleProductsForTemplate(
                $productsQuery
            );


            $product_options = [];



            if ($category == 528 && !($query->getQueryType() == 'new-products') && !($query->getQueryType() == 'manufacturer')) {

                $filters = Tools::getValue('filters');

                if ($filters) {
                    $product_options = self::getProductIdsFromFilters($filters);
                }
                // pre($product_options);

                $brand_api = CategoryControllerCore::apiCall('brand');

                foreach ($brand_api->data as $brand) {
                    $car_brands[$brand->slug] = $brand->name_en;
                }

                // pre($car_brands);

                $this->context->smarty->assign('car_brands', $car_brands);



                if (strlen($filters) > 0) {
                    $features = explode('|', $filters);
                    $arr = array();

                    foreach ($features as $feature) {
                        $current_features = explode(':', $feature);
                        $arr[$current_features[0]][] = $current_features[1];
                    }

                    $flatted = self::combinarArrays($arr);

                    foreach ($flatted as $flatted_options) {

                        $product_options_temp = array();
                        foreach ($flatted_options as $key => $option) {

                            $ids = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT id_product FROM ps_feature_product WHERE id_feature_value = ' . $option);

                            foreach ($ids as $id) $product_options_temp[$id['id_product']] += 1;
                        }

                        $total_option = count($flatted_options);
                        foreach ($product_options_temp as $key_product => $found_option) {
                            if ($found_option == $total_option) $product_options[] = $key_product;
                        }
                    }
                }

                // pre($product_options);

                $selected_filter_feature = [];
                $selected_features = null;
                $selected_id_values = null;

                if (strlen($filters) > 0) {
                    $selected_filter = explode('|', $filters);

                    foreach ($selected_filter as $selected_option) {
                        $selected_feature = explode(':', $selected_option);

                        $selected_id_values[] = $selected_feature[1];

                        if (count($product_options) > 0) $sql_product_options = 'AND ps_feature_product.id_product IN ( ' . implode(',', $product_options) . ' )';

                        $sqlFeature =  'SELECT name 
                                        FROM ps_feature_lang 
                                        LEFT JOIN ps_feature_product ON ps_feature_product.id_feature = ps_feature_lang.id_feature 
                                        WHERE ps_feature_lang.id_lang=' . $this->context->language->id . ' 
                                        ' . $sql_product_options . '
                                        AND ps_feature_lang.id_feature=' . $selected_feature[0] .
                            ' ORDER BY name DESC';

                        // pre($sqlFeature);

                        $feature_group = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlFeature);



                        if ($selected_feature[1] == 0) {
                            $feature_value = 'ALL';
                        } else {
                            $sqlFeatureValue = 'SELECT value 
                                                FROM ps_feature_value_lang 
                                                LEFT JOIN ps_feature_product ON ps_feature_product.id_feature_value = ps_feature_value_lang.id_feature_value 
                                                WHERE ps_feature_value_lang.id_lang=' . $this->context->language->id . ' 
                                                ' . $sql_product_options . '
                                                AND ps_feature_value_lang.id_feature_value=' . $selected_feature[1] .
                                ' ORDER BY value DESC';

                            $feature_value = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlFeatureValue);

                            $selected_filter_feature[] = $selected_feature[0];
                        }

                        /**
                        if( strlen($feature_group) > 0){
                            $selected_features[] = [
                                'combination' => $selected_option,
                                'feature' => $feature_group,
                                'value' => $feature_value
                            ];
                        }
                         **/

                        if (strlen($feature_group) > 0) {
                            $selected_features[$feature_group][] = [
                                'combination' => $selected_option,
                                'feature' => $feature_group,
                                'value' => $feature_value
                            ];
                        }
                    }
                }

                // pre($product_options);

                // pre($selected_filter_feature);
                $default_products_per_page = max(1, 19);
                $currentPage = (int) $query->getPage(); // Get the current page from the query object
                $offset = ($currentPage - 1) * $default_products_per_page;



                $sql_products_of_category = 'SELECT pc.*, pp.id_manufacturer FROM ps_category_product pc LEFT JOIN ps_product pp ON pc.id_product = pp.id_product  WHERE id_category IN (528) AND pp.visibility != "none"';
                // pre($sql_products_of_category);


                if (!empty($product_options)) {
                    $sql_products_of_category .= ' AND pc.id_product IN (' . implode(',', $product_options) . ')';
                } else if (!empty($selected_filter_feature) && empty($product_options)) {
                    $sql_products_of_category .= 'AND 1=0';
                }
                // elseif(count($ids_products) > 0 ){
                //     $sql_products_of_category .= ' AND id_product IN (' . implode(',', $ids_products) . ')';
                // }

                $sql_products_of_category .= ' LIMIT ' . $default_products_per_page . ' OFFSET ' . $offset;

                // pre($sql_products_of_category);

                $products_227 = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql_products_of_category);

                // pre($products_227);

                $formatted_products_227 = [];
                foreach ($products_227 as $product) {
                    $formatted_products_227[] = ['id_product' => $product['id_product']];
                }

                $sql_total_products = 'SELECT COUNT(*) as total FROM ps_category_product WHERE id_category IN (528)';
                $total_products = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql_total_products);

                $result->setProducts($formatted_products_227);
                $result->setTotalProductsCount($total_products);
                $query->setResultsPerPage(19);

                $pagination = $this->getTemplateVarPagination(
                    $query,
                    $result
                );

                $ids_prods = array();
                $features  = array();

                foreach ($products_227 as $product_227) $ids_prods[] = $product_227['id_product'];

                // pre($ids_prods);

                // echo 'SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat 
                //         FROM ps_feature_product 
                //         LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                //         LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                //             AND id_lang=' . (int)$this->context->language->id . ' 
                //         WHERE id_product IN (' . implode(", ", $ids_prods) . ')  
                //         GROUP BY ps_feature_product.id_feature 
                //         ORDER BY ps_feature.position ASC';
                //         exit;

                // $features_category = Db::getInstance()->ExecuteS('SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat FROM ps_feature_product LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature AND id_lang=' . $this->context->language->id . ' WHERE id_product IN (' . implode(", ", $ids_prods) . ' ) ' . ' GROUP BY ps_feature_product.id_feature');

                // $features_category = Db::getInstance()->ExecuteS('SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat FROM ps_feature_product LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature AND id_lang=' . $this->context->language->id . ' WHERE id_product IN (' . implode(", ", $ids_prods) . ' ) ' . ' GROUP BY ps_feature_product.id_feature ORDER BY ps_feature.position ASC');

                if (!empty($ids_prods)) {
                    $features_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS(
                        'SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat 
                        FROM ps_feature_product 
                        LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                            AND id_lang=' . (int)$this->context->language->id . ' 
                        WHERE id_product IN (' . implode(", ", $ids_prods) . ')  
                        GROUP BY ps_feature_product.id_feature 
                        ORDER BY ps_feature.position ASC'
                    );
                } else {
                    $features_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS(
                        'SELECT ps_feature_product.id_feature, ps_feature_lang.name, COUNT(ps_feature_lang.name) AS nr_repeat , ps_feature_shop.id_shop 
                        FROM ps_feature_product 
                        LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_shop ON ps_feature_product.id_feature = ps_feature_shop.id_feature WHERE id_lang=2  AND id_shop=' . $this->context->shop->id . '
                        GROUP BY ps_feature_product.id_feature ORDER BY ps_feature.position ASC'
                    );
                }



                foreach ($features_category as $f_category) {

                    // $features_value = Db::getInstance()->ExecuteS('SELECT ps_feature_value.id_feature,ps_feature_value_lang.id_feature_value, ps_feature_value_lang.value, value, count(value) AS nr_values FROM ps_feature_value LEFT JOIN ps_feature_value_lang ON ps_feature_value_lang.id_feature_value = ps_feature_value.id_feature_value AND ps_feature_value_lang.id_lang=' . $this->context->language->id . ' AND ps_feature_value.id_feature = ' . $f_category['id_feature'] . ' 
                    // WHERE ps_feature_value_lang.id_feature_value IS NOT NULL
                    // GROUP BY ps_feature_value_lang.id_feature_value ORDER BY ps_feature_value.id_feature');
                    $features_value = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('SELECT ps_feature_product.id_feature, ps_feature_product.id_feature_value, value, count(value) AS nr_values FROM ps_feature_product LEFT JOIN ps_feature_value_lang ON ps_feature_value_lang.id_feature_value = ps_feature_product.id_feature_value AND id_lang=' . $this->context->language->id . ' LEFT JOIN ps_feature_value ON ps_feature_value.id_feature_value = ps_feature_product.id_feature_value WHERE ps_feature_value.id_feature = ' . $f_category['id_feature'] . ' GROUP BY ps_feature_value_lang.id_feature_value');
                    // pre($features_value);

                    $features[] = [
                        'id_feature' => $f_category['id_feature'],
                        'name' => $f_category['name'],
                        'quantity' => $f_category['nr_repeat'],
                        'values' => $features_value
                    ];
                }


                // pre($features);

                if ($selected_features) {
                    foreach ($features as &$feature) {
                        // Initialize combined_combinations for this feature
                        $feature['combined_combinations'] = '';

                        foreach ($feature['values'] as &$value) {
                            $value['checked'] = 0; // Default checked value

                            // Check if the feature exists in selected features
                            if (isset($selected_features[$feature['name']])) {
                                $combinations = [];
                                foreach ($selected_features[$feature['name']] as $selected) {
                                    $combination = "{$value['id_feature']}:{$value['id_feature_value']}";

                                    // Set checked if combination matches
                                    if ($combination === $selected['combination']) {
                                        $value['checked'] = 1;
                                    }

                                    // Collect combination for this feature
                                    $combinations[] = $selected['combination'];
                                }

                                // Assign all combinations to the feature
                                $feature['combined_combinations'] = implode(',', $combinations);
                            }

                            // Additional processing for "Brand" feature
                            if ($feature['name'] === 'Brand' || $feature['name'] === 'Marca' || $feature['name'] === 'Marque') {
                                // pre($product_227);
                                if (!empty($product_227)) {
                                    $sqlBrandImg = 'SELECT id_manufacturer FROM ps_manufacturer WHERE id_manufacturer="' . $product_227["id_manufacturer"] . '"';
                                    $brandImg = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlBrandImg);

                                    // Add img field to $value
                                    $value['img'] = $brandImg
                                        ? "/img/wheels/" . $brandImg . ".webp?t=3"
                                        : null; // Add null or fallback URL if brandImg is not found

                                } elseif ($feature['id_feature'] == 19) {
                                    // if theres a name in the ps_manufacture = $feature['values']['value'] needs a foreach
                                    // pre($feature['values']);
                                    foreach ($feature['values'] as &$value) {
                                        if ($value['checked'] != '0') {
                                            $sqlBrandImg = 'SELECT id_manufacturer FROM ps_manufacturer WHERE name = "' . pSQL($value['value']) . '"';

                                            // Execute the query to check if the manufacturer exists
                                            $brandImg = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlBrandImg);

                                            // If a manufacturer is found, assign the image path
                                            if ($brandImg) {
                                                $value['img'] = "/img/wheels/" . $brandImg . ".webp?t=3";
                                                // pre($value);
                                            } else {
                                                if ($value['value'] == 'Gram Lights') {
                                                    $value['img'] = "/img/wheels/170.webp?t=3";
                                                } elseif ($value['value'] == 'Carroll Shelby') {
                                                    $value['img'] = "/img/wheels/188.webp?t=3";
                                                } elseif ($value['value'] == 'Volk Racing') {
                                                    $value['img'] = "/img/wheels/173.webp?t=3";
                                                }
                                                // pre($value);
                                            }
                                        }
                                    }
                                }


                                // pre($value);
                            }
                        }
                    }
                    unset($feature, $value); // Break reference
                }



                // pre($features);

                $this->context->smarty->assign('asw_features', $features);
                $this->context->smarty->assign('have_selected_features', $selected_features ? count($selected_features) : null);
                $this->context->smarty->assign('selected_features', $selected_features);
                $this->context->smarty->assign('selected_values', $selected_id_values);

                // After filtering, check if product_options is empty
                // if (empty($product_options)) {
                //     $this->context->smarty->assign('no_products', true);
                // }



                $products = $this->prepareMultipleProductsForTemplate(
                    $products_227
                );


                if (empty($products)) {
                    $this->context->smarty->assign('no_products', true);
                }


                // $noProducts = count($products) < 1 ? 1 : 0;
                // $this->context->smarty->assign('noProducts', $noProducts);



                // pre($products);

            }

            if (Tools::getValue('id_compat') !== 'undefined' && Tools::getValue('id_compat') > 0) {
                // pre(Tools::getAllValues());
                // pre(Tools::getValue('id_compat'));
                // echo 'paulo';
                // exit;
                // pre($pagination);

                $id_compat = Tools::getValue('id_compat');
                $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
                $shop_id = $this->context->shop->id;

                $url = 'https://webtools.all-stars-motorsport.com/api/get/products/' . $id_compat . '/' . $shop_id . '/' . $key;
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

                $productsC = $data['data'];

                // pre($query);
                $category = Tools::getValue('id_category_layered');
                $manufacturer = Tools::getValue('id_manufacturer_layered');

                // $search = $this->getProductSearchVariables();

                // Fetch products related to the selected car product
                if (empty($productsC)) {
                    return [];
                }

                $ids = array_map('intval', (array) $productsC);
                $idList = implode(',', $ids);

                // count products
                // Query to count total products matching the filters
                $sqlCount = 'SELECT COUNT(DISTINCT ps_category_product.id_product) 
                FROM ps_category_product
                LEFT JOIN ps_product_shop ON ps_category_product.id_product = ps_product_shop.id_product
                LEFT JOIN ps_product ON ps_category_product.id_product = ps_product.id_product
                LEFT JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product 
                    AND ps_product_lang.id_lang = ' . $this->context->language->id . ' 
                    AND ps_product_lang.id_shop = ' . $this->context->shop->id . '
                WHERE ps_category_product.id_product IN (' . $idList . ')  
                AND ps_product.active = 1 AND ps_product.visibility != "none"
                AND ps_product_shop.id_shop = ' . $this->context->shop->id;

                if ($category > 0) {
                    $sqlCount .= ' AND ps_category_product.id_category = ' . $category;
                }

                if ($manufacturer > 0) {
                    $sqlCount .= ' AND ps_product.id_manufacturer = ' . $manufacturer;
                }

                $totalProducts = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlCount);

                $sql = 'SELECT cp.id_category, 
                cp.id_product, 
                cp.position, 
                COALESCE(
                    (SELECT MAX(p.price + pa.price) 
                        FROM ps_product_attribute_shop pa 
                        WHERE pa.id_product = p.id_product 
                        AND pa.id_shop = ' . $this->context->shop->id . '
                    ), p.price
                ) AS final_price
                    FROM ps_category_product cp
                    LEFT JOIN ps_product_shop ps ON cp.id_product = ps.id_product
                    LEFT JOIN ps_product p ON cp.id_product = p.id_product
                    LEFT JOIN ps_product_lang pl ON p.id_product = pl.id_product 
                        AND pl.id_lang = ' . $this->context->language->id . ' 
                        AND pl.id_shop = ' . $this->context->shop->id . '
                    WHERE cp.id_product IN (' . $idList . ')  
                        AND p.active = 1 
                        AND p.visibility != "none" 
                        AND ps.id_shop = ' . $this->context->shop->id;

                if ($category > 0) {
                    $sql .= ' AND cp.id_category = ' . (int) $category;
                }

                if ($manufacturer > 0) {
                    $sql .= ' AND p.id_manufacturer = ' . (int) $manufacturer;
                }

                $sql .= ' GROUP BY p.id_product';

                // Sorting Fix
                if ($query->getSortOrder()) {
                    $sortOrder = $query->getSortOrder();

                    if ($sortOrder->getField() === 'price') {
                        $sql .= ' ORDER BY final_price ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'name') {
                        $sql .= ' ORDER BY pl.name ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'reference') {
                        $sql .= ' ORDER BY p.reference ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'sales') {
                        $sql .= ' ORDER BY psale.quantity ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'date_add') {
                        $sql .= ' ORDER BY p.date_add ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    }
                }

                // Pagination
                if ($query->getResultsPerPage()) {
                    $query->setResultsPerPage(19);

                    $resultsPerPage = (int) $query->getResultsPerPage();
                    $currentPage = (int) $query->getPage();
                    $offset = ($currentPage - 1) * $resultsPerPage;

                    $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;
                }


                // $result->setProducts($$totalProducts);
                // $result->setTotalProductsCount($total_products);
                // $query->setResultsPerPage(19);

                // $pagination = $this->getTemplateVarPagination(
                //     $query,
                //     $result
                // );

                // pre($pagination);



                // pre($pagination);
                // $productsCarTotal =  Db::getInstance()->executeS($sql);

                // pre($sql);

                // fim test




                $productsCar =  Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

                $products = $this->prepareMultipleProductsForTemplate(
                    $productsCar
                );

                $formatted_productsCar = [];
                foreach ($productsCar as $product) {
                    $formatted_productsCar[] = ['id_product' => $product['id_product']];
                }

                $result->setProducts($formatted_productsCar);
                $result->setTotalProductsCount($totalProducts);

                $pagination = $this->getTemplateVarPagination(
                    $query,
                    $result
                );

                // universal products
                $sqlUniversals = 'SELECT pcp.id_category, pcp.id_product, pcp.POSITION 
                                FROM ps_category_product AS pcp
                                LEFT JOIN ps_product AS pp ON pcp.id_product = pp.id_product
                                LEFT JOIN ps_product_shop AS pps ON pps.id_product = pp.id_product
                                WHERE pp.universal = 1 AND pp.active = 1 AND pps.id_shop = 2 GROUP BY pcp.id_product';




                $universalProducts = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sqlUniversals);
                // pre($universalProducts);

                $universals = $this->prepareMultipleProductsForTemplate(
                    $universalProducts
                );
                $noProducts = 1;
                // pre($products);
                if (empty($products) || !is_array($products)) {
                    $noProducts = 1;
                } else {
                    $noProducts = count($products) < 1 ? 1 : 0;
                }

                // pre($noProducts);


                if ($totalProducts > 0) {
                    // Calculate total pages
                    // $pagesCount = ceil($totalProducts / $resultsPerPage);
                    // $currentPage = max((int) $query->getPage(), 1);

                    // // Ensure current page is within valid range
                    // if ($currentPage > $pagesCount) {
                    //     $currentPage = $pagesCount;
                    // }

                    // // Now, calculate the offset for pagination
                    // $offset = ($currentPage - 1) * $resultsPerPage;

                    // // Add the LIMIT and OFFSET to the main SQL query
                    // $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;

                    // // Assign pagination info to Smarty
                    // $pagination = [
                    //     'total_items' => $totalProducts,
                    //     'items_shown_from' => $offset + 1,
                    //     'items_shown_to' => min($offset + $resultsPerPage, $totalProducts),
                    //     'current_page' => $currentPage,
                    //     'pages_count' => $pagesCount,
                    //     'pages' => [],
                    // ];

                    // // Build the page links
                    // for ($i = 1; $i <= $pagesCount; $i++) {
                    //     // Generate URL without `page` parameter for page 1
                    //     $url = ($i == 1) 
                    //         ? $this->context->link->getPageLink('cars-products', null, null, [
                    //             'id_compat' => Tools::getValue('id_compat'),
                    //           ])
                    //         : $this->context->link->getPageLink('cars-products', null, null, [
                    //             'page' => $i,
                    //             'id_compat' => Tools::getValue('id_compat'),
                    //           ]);

                    //     $pagination['pages'][$i] = [
                    //         'type' => 'page',
                    //         'page' => $i,
                    //         'clickable' => $i != $currentPage,
                    //         'current' => $i == $currentPage,
                    //         'url' => $url,
                    //     ];
                    // }

                    // pre($query);

                    // $compat = $query->getCompat();
                    // pre($compat);
                    // Assign the pagination to Smarty
                    $this->context->smarty->assign([
                        // 'compat' => $compat[0],
                        'cars_products_page' => 1,
                        'pagination' => $pagination,
                        'products' => $products,  // the list of products fetched after applying pagination
                        'noProducts' => $noProducts,
                        'universals' => $universals,
                    ]);
                }

                // $this->context->smarty->assign([
                //     'noProducts' => $noProducts,
                //     'universals' => $universals
                // ]);

                // pre($this->context->smarty);

                // pre($query);

            }

            // pre(count($products));
            // pre($pagination);

            $default_products_per_page = max(1, (int)Configuration::get('PS_PRODUCTS_PER_PAGE'));
            $n_array = array($default_products_per_page, $default_products_per_page * 2, $default_products_per_page * 5);


            $this->context->smarty->assign([
                'nb_products'       => $pagination['total_items'],
                'n_array' => $n_array,
            ]);

            // Loop through each sorting option
            foreach ($sort_orders as &$order) {
                // Generate the order URL using the setOrder() function
                $order['url'] = '';
                $order['value'] = $order['field'] . ':' . $order['direction'];
            }



            $searchVariables = [
                'result' => $result,
                'label' => $this->getListingLabel(),
                'products' => $products,
                'sort_orders' => $sort_orders,
                'sort_selected' => $sort_selected,
                'pagination' => $pagination,
                'rendered_facets' => $rendered_facets,
                'rendered_active_filters' => $rendered_active_filters,
                'js_enabled' => $this->ajax,
                'current_url' => $this->updateQueryString([
                    'q' => $result->getEncodedFacets(),
                ]),
            ];
        } elseif ($this->context->shop->id == 1 && $query->getQueryType() == 'new-products' || $this->context->shop->id == 1 && $query->getQueryType() == 'category' || $this->context->shop->id == 1 && $query->getQueryType() == 'manufacturer' || $this->context->shop->id == 1 && (Tools::getValue('id_compat') !== 'undefined' && Tools::getValue('id_compat') > 0)) {


            if ($query->getQueryType()) {
                $type = $query->getQueryType();
            }

            if ($query->getIdCategory()) {
                $category = $query->getIdCategory();
            }

            if ($query->getIdManufacturer()) {
                $manufacturer = $query->getIdManufacturer();
            }

            if ($query->getIdSupplier()) {
                $supplier = $query->getIdSupplier();
            }

            if ($query->getResultsPerPage()) {
                $resultsPerPage = $query->getResultsPerPage();
            }

            if ($query->getSortOrder()) {
                $sortOrder = $query->getSortOrder();
            }

            if ($query->getSearchString()) {
                $searchString = $query->getSearchString();
            }

            // pre($query);

            // Fetch category and manufacturer IDs from the query object
            $category = (int) $query->getIdCategory();
            $manufacturer = (int) $query->getIdManufacturer();

            // pre($query);

            $sql = 'SELECT p.id_product, 
                    p.price AS base_price, 
                   COALESCE(
                       (SELECT MAX(p.price + pa.price) 
                        FROM ps_product_attribute_shop pa 
                        WHERE pa.id_product = p.id_product 
                          AND pa.id_shop = 1
                       ), p.price
                   ) AS final_price 
            FROM ps_product p
            LEFT JOIN ps_product_shop ps ON p.id_product = ps.id_product
            LEFT JOIN ps_product_lang pl ON p.id_product = pl.id_product AND pl.id_lang = ' . $this->context->language->id . ' AND pl.id_shop = 1
            LEFT JOIN ps_product_sale psale ON p.id_product = psale.id_product 
            LEFT JOIN ps_category_product pc ON p.id_product = pc.id_product AND pl.id_lang = ' . $this->context->language->id . ' AND pl.id_shop = 1
            WHERE p.active = 1 AND p.visibility != "none" AND ps.id_shop = 1';

            if ($category > 0) {
                $sql .= ' AND pc.id_category = ' . (int) $category;
            }

            if ($manufacturer > 0) {
                $sql .= ' AND p.id_manufacturer = ' . (int) $manufacturer;
            }

            if (!empty($searchString)) {
                $sql .= ' AND (pl.name LIKE "%' . pSQL($searchString) . '%" 
                        OR p.reference LIKE "%' . pSQL($searchString) . '%"
                        OR EXISTS (
                            SELECT 1 FROM ps_product_attribute pa 
                            WHERE pa.id_product = p.id_product 
                              AND pa.reference LIKE "%' . pSQL($searchString) . '%"
                        ))';
            }

            if (!empty($type) && $type == 'new-products') {
                $daysNewProduct = (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT', null, null, 2);
                $newProductDate = date('Y-m-d H:i:s', strtotime("-{$daysNewProduct} days"));
                $sql .= ' AND p.date_add >= "' . pSQL($newProductDate) . '"';
            }

            $sql .= ' GROUP BY p.id_product';

            if ($query->getSortOrder()) {
                $sortOrder = $query->getSortOrder();

                if ($sortOrder->getField() === 'price') {
                    // Sort by final price correctly
                    $sql .= ' ORDER BY final_price '
                        . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'name') {
                    $sql .= ' ORDER BY pl.name ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'reference') {
                    $sql .= ' ORDER BY p.reference ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'sales') {
                    $sql .= ' ORDER BY psale.quantity ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'date_add') {
                    $sql .= ' ORDER BY p.date_add ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                }
            }

            if ($query->getResultsPerPage()) {
                if ($query->getQueryType() == 'new-products') {
                    $query->setResultsPerPage(19);
                }

                $resultsPerPage = (int) $query->getResultsPerPage();
                $currentPage = (int) $query->getPage();
                $offset = ($currentPage - 1) * $resultsPerPage;

                $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;
            }

            $pagination = $this->getTemplateVarPagination(
                $query,
                $result
            );

            // pre($sql);



            // if(count($products) == 0){

            // }
            // pre($products);

            $productsQuery = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);

            $products = $this->prepareMultipleProductsForTemplate(
                $productsQuery
            );

            // pagination new products

            $formatted_products = [];
            foreach ($productsQuery as $product) {
                $formatted_products[] = ['id_product' => $product['id_product']];
            }

            $result->setProducts($formatted_products);

            $result->setTotalProductsCount(count($products));

            $pagination = $this->getTemplateVarPagination(
                $query,
                $result
            );


            $product_options = [];



            if ($category == 528 && !($query->getQueryType() == 'new-products') && !($query->getQueryType() == 'manufacturer')) {

                $filters = Tools::getValue('filters');

                if ($filters) {
                    $product_options = self::getProductIdsFromFilters($filters);
                }
                // pre($product_options);

                $brand_api = CategoryControllerCore::apiCall('brand');

                foreach ($brand_api->data as $brand) {
                    $car_brands[$brand->slug] = $brand->name_en;
                }

                // pre($car_brands);

                $this->context->smarty->assign('car_brands', $car_brands);



                if (strlen($filters) > 0) {
                    $features = explode('|', $filters);
                    $arr = array();

                    foreach ($features as $feature) {
                        $current_features = explode(':', $feature);
                        $arr[$current_features[0]][] = $current_features[1];
                    }

                    $flatted = self::combinarArrays($arr);

                    foreach ($flatted as $flatted_options) {

                        $product_options_temp = array();
                        foreach ($flatted_options as $key => $option) {

                            $ids = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT id_product FROM ps_feature_product WHERE id_feature_value = ' . $option);

                            foreach ($ids as $id) $product_options_temp[$id['id_product']] += 1;
                        }

                        $total_option = count($flatted_options);
                        foreach ($product_options_temp as $key_product => $found_option) {
                            if ($found_option == $total_option) $product_options[] = $key_product;
                        }
                    }
                }

                // pre($product_options);

                $selected_filter_feature = [];
                $selected_features = null;
                $selected_id_values = null;

                if (strlen($filters) > 0) {
                    $selected_filter = explode('|', $filters);

                    foreach ($selected_filter as $selected_option) {
                        $selected_feature = explode(':', $selected_option);

                        $selected_id_values[] = $selected_feature[1];

                        if (count($product_options) > 0) $sql_product_options = 'AND ps_feature_product.id_product IN ( ' . implode(',', $product_options) . ' )';

                        $sqlFeature =  'SELECT name 
                                        FROM ps_feature_lang 
                                        LEFT JOIN ps_feature_product ON ps_feature_product.id_feature = ps_feature_lang.id_feature 
                                        WHERE ps_feature_lang.id_lang=' . $this->context->language->id . ' 
                                        ' . $sql_product_options . '
                                        AND ps_feature_lang.id_feature=' . $selected_feature[0] .
                            ' ORDER BY name DESC';

                        // pre($sqlFeature);

                        $feature_group = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlFeature);



                        if ($selected_feature[1] == 0) {
                            $feature_value = 'ALL';
                        } else {
                            $sqlFeatureValue = 'SELECT value 
                                                FROM ps_feature_value_lang 
                                                LEFT JOIN ps_feature_product ON ps_feature_product.id_feature_value = ps_feature_value_lang.id_feature_value 
                                                WHERE ps_feature_value_lang.id_lang=' . $this->context->language->id . ' 
                                                ' . $sql_product_options . '
                                                AND ps_feature_value_lang.id_feature_value=' . $selected_feature[1] .
                                ' ORDER BY value DESC';

                            $feature_value = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlFeatureValue);

                            $selected_filter_feature[] = $selected_feature[0];
                        }

                        /**
                        if( strlen($feature_group) > 0){
                            $selected_features[] = [
                                'combination' => $selected_option,
                                'feature' => $feature_group,
                                'value' => $feature_value
                            ];
                        }
                         **/

                        if (strlen($feature_group) > 0) {
                            $selected_features[$feature_group][] = [
                                'combination' => $selected_option,
                                'feature' => $feature_group,
                                'value' => $feature_value
                            ];
                        }
                    }
                }

                // pre($product_options);

                // pre($selected_filter_feature);
                $default_products_per_page = max(1, 19);
                $currentPage = (int) $query->getPage(); // Get the current page from the query object
                $offset = ($currentPage - 1) * $default_products_per_page;



                $sql_products_of_category = 'SELECT pc.*, pp.id_manufacturer FROM ps_category_product pc LEFT JOIN ps_product pp ON pc.id_product = pp.id_product  WHERE id_category IN (528) AND pp.visibility != "none"';
                // pre($sql_products_of_category);


                if (!empty($product_options)) {
                    $sql_products_of_category .= ' AND pc.id_product IN (' . implode(',', $product_options) . ')';
                } else if (!empty($selected_filter_feature) && empty($product_options)) {
                    $sql_products_of_category .= 'AND 1=0';
                }
                // elseif(count($ids_products) > 0 ){
                //     $sql_products_of_category .= ' AND id_product IN (' . implode(',', $ids_products) . ')';
                // }

                $sql_products_of_category .= ' LIMIT ' . $default_products_per_page . ' OFFSET ' . $offset;

                // pre($sql_products_of_category);

                $products_227 = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql_products_of_category);

                // pre($products_227);

                $formatted_products_227 = [];
                foreach ($products_227 as $product) {
                    $formatted_products_227[] = ['id_product' => $product['id_product']];
                }

                $sql_total_products = 'SELECT COUNT(*) as total FROM ps_category_product WHERE id_category IN (528)';
                $total_products = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql_total_products);

                $result->setProducts($formatted_products_227);
                $result->setTotalProductsCount($total_products);
                $query->setResultsPerPage(19);

                $pagination = $this->getTemplateVarPagination(
                    $query,
                    $result
                );

                $ids_prods = array();
                $features  = array();

                foreach ($products_227 as $product_227) $ids_prods[] = $product_227['id_product'];

                // pre($ids_prods);

                // echo 'SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat 
                //         FROM ps_feature_product 
                //         LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                //         LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                //             AND id_lang=' . (int)$this->context->language->id . ' 
                //         WHERE id_product IN (' . implode(", ", $ids_prods) . ')  
                //         GROUP BY ps_feature_product.id_feature 
                //         ORDER BY ps_feature.position ASC';
                //         exit;

                // $features_category = Db::getInstance()->ExecuteS('SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat FROM ps_feature_product LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature AND id_lang=' . $this->context->language->id . ' WHERE id_product IN (' . implode(", ", $ids_prods) . ' ) ' . ' GROUP BY ps_feature_product.id_feature');

                // $features_category = Db::getInstance()->ExecuteS('SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat FROM ps_feature_product LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature AND id_lang=' . $this->context->language->id . ' WHERE id_product IN (' . implode(", ", $ids_prods) . ' ) ' . ' GROUP BY ps_feature_product.id_feature ORDER BY ps_feature.position ASC');

                if (!empty($ids_prods)) {
                    $features_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS(
                        'SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat 
                        FROM ps_feature_product 
                        LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                            AND id_lang=' . (int)$this->context->language->id . ' 
                        WHERE id_product IN (' . implode(", ", $ids_prods) . ')  
                        GROUP BY ps_feature_product.id_feature 
                        ORDER BY ps_feature.position ASC'
                    );
                } else {
                    $features_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS(
                        'SELECT ps_feature_product.id_feature, ps_feature_lang.name, COUNT(ps_feature_lang.name) AS nr_repeat , ps_feature_shop.id_shop 
                        FROM ps_feature_product 
                        LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_shop ON ps_feature_product.id_feature = ps_feature_shop.id_feature WHERE id_lang=2  AND id_shop=' . $this->context->shop->id . '
                        GROUP BY ps_feature_product.id_feature ORDER BY ps_feature.position ASC'
                    );
                }



                foreach ($features_category as $f_category) {

                    // $features_value = Db::getInstance()->ExecuteS('SELECT ps_feature_value.id_feature,ps_feature_value_lang.id_feature_value, ps_feature_value_lang.value, value, count(value) AS nr_values FROM ps_feature_value LEFT JOIN ps_feature_value_lang ON ps_feature_value_lang.id_feature_value = ps_feature_value.id_feature_value AND ps_feature_value_lang.id_lang=' . $this->context->language->id . ' AND ps_feature_value.id_feature = ' . $f_category['id_feature'] . ' 
                    // WHERE ps_feature_value_lang.id_feature_value IS NOT NULL
                    // GROUP BY ps_feature_value_lang.id_feature_value ORDER BY ps_feature_value.id_feature');
                    $features_value = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('SELECT ps_feature_product.id_feature, ps_feature_product.id_feature_value, value, count(value) AS nr_values FROM ps_feature_product LEFT JOIN ps_feature_value_lang ON ps_feature_value_lang.id_feature_value = ps_feature_product.id_feature_value AND id_lang=' . $this->context->language->id . ' LEFT JOIN ps_feature_value ON ps_feature_value.id_feature_value = ps_feature_product.id_feature_value WHERE ps_feature_value.id_feature = ' . $f_category['id_feature'] . ' GROUP BY ps_feature_value_lang.id_feature_value');
                    // pre($features_value);

                    $features[] = [
                        'id_feature' => $f_category['id_feature'],
                        'name' => $f_category['name'],
                        'quantity' => $f_category['nr_repeat'],
                        'values' => $features_value
                    ];
                }


                // pre($features);

                if ($selected_features) {
                    foreach ($features as &$feature) {
                        // Initialize combined_combinations for this feature
                        $feature['combined_combinations'] = '';

                        foreach ($feature['values'] as &$value) {
                            $value['checked'] = 0; // Default checked value

                            // Check if the feature exists in selected features
                            if (isset($selected_features[$feature['name']])) {
                                $combinations = [];
                                foreach ($selected_features[$feature['name']] as $selected) {
                                    $combination = "{$value['id_feature']}:{$value['id_feature_value']}";

                                    // Set checked if combination matches
                                    if ($combination === $selected['combination']) {
                                        $value['checked'] = 1;
                                    }

                                    // Collect combination for this feature
                                    $combinations[] = $selected['combination'];
                                }

                                // Assign all combinations to the feature
                                $feature['combined_combinations'] = implode(',', $combinations);
                            }

                            // Additional processing for "Brand" feature
                            if ($feature['name'] === 'Brand' || $feature['name'] === 'Marca' || $feature['name'] === 'Marque') {
                                // pre($product_227);
                                if (!empty($product_227)) {
                                    $sqlBrandImg = 'SELECT id_manufacturer FROM ps_manufacturer WHERE id_manufacturer="' . $product_227["id_manufacturer"] . '"';
                                    $brandImg = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlBrandImg);

                                    // Add img field to $value
                                    $value['img'] = $brandImg
                                        ? "/img/wheels/" . $brandImg . ".webp?t=3"
                                        : null; // Add null or fallback URL if brandImg is not found

                                } elseif ($feature['id_feature'] == 19) {
                                    // if theres a name in the ps_manufacture = $feature['values']['value'] needs a foreach
                                    // pre($feature['values']);
                                    foreach ($feature['values'] as &$value) {
                                        if ($value['checked'] != '0') {
                                            $sqlBrandImg = 'SELECT id_manufacturer FROM ps_manufacturer WHERE name = "' . pSQL($value['value']) . '"';

                                            // Execute the query to check if the manufacturer exists
                                            $brandImg = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlBrandImg);

                                            // If a manufacturer is found, assign the image path
                                            if ($brandImg) {
                                                $value['img'] = "/img/wheels/" . $brandImg . ".webp?t=3";
                                                // pre($value);
                                            } else {
                                                if ($value['value'] == 'Gram Lights') {
                                                    $value['img'] = "/img/wheels/170.webp?t=3";
                                                } elseif ($value['value'] == 'Carroll Shelby') {
                                                    $value['img'] = "/img/wheels/188.webp?t=3";
                                                } elseif ($value['value'] == 'Volk Racing') {
                                                    $value['img'] = "/img/wheels/173.webp?t=3";
                                                }
                                                // pre($value);
                                            }
                                        }
                                    }
                                }


                                // pre($value);
                            }
                        }
                    }
                    unset($feature, $value); // Break reference
                }



                // pre($features);

                $this->context->smarty->assign('asw_features', $features);
                $this->context->smarty->assign('have_selected_features', $selected_features ? count($selected_features) : null);
                $this->context->smarty->assign('selected_features', $selected_features);
                $this->context->smarty->assign('selected_values', $selected_id_values);

                // After filtering, check if product_options is empty
                // if (empty($product_options)) {
                //     $this->context->smarty->assign('no_products', true);
                // }



                $products = $this->prepareMultipleProductsForTemplate(
                    $products_227
                );


                if (empty($products)) {
                    $this->context->smarty->assign('no_products', true);
                }


                // $noProducts = count($products) < 1 ? 1 : 0;
                // $this->context->smarty->assign('noProducts', $noProducts);



                // pre($products);

            }

            if ($this->context->shop->id == 1 && (Tools::getValue('id_compat') !== 'undefined' && Tools::getValue('id_compat') > 0)) {

                $id_compat = Tools::getValue('id_compat');
                $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
                $shop_id = $this->context->shop->id;

                $url = 'https://webtools.all-stars-motorsport.com/api/get/products/' . $id_compat . '/' . $shop_id . '/' . $key;
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

                $productsC = $data['data'];

                // pre($query);
                $category = Tools::getValue('id_category_layered');
                $manufacturer = Tools::getValue('id_manufacturer_layered');

                // $search = $this->getProductSearchVariables();

                // Fetch products related to the selected car product
                if (empty($productsC)) {
                    return [];
                }

                $ids = array_map('intval', (array) $productsC);
                $idList = implode(',', $ids);

                // count products
                // Query to count total products matching the filters
                $sqlCount = 'SELECT COUNT(DISTINCT ps_category_product.id_product) 
                FROM ps_category_product
                LEFT JOIN ps_product_shop ON ps_category_product.id_product = ps_product_shop.id_product
                LEFT JOIN ps_product ON ps_category_product.id_product = ps_product.id_product
                LEFT JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product 
                    AND ps_product_lang.id_lang = ' . $this->context->language->id . ' 
                    AND ps_product_lang.id_shop = ' . $this->context->shop->id . '
                WHERE ps_category_product.id_product IN (' . $idList . ')  
                AND ps_product.active = 1 AND ps_product.visibility != "none"
                AND ps_product_shop.id_shop = ' . $this->context->shop->id;

                if ($category > 0) {
                    $sqlCount .= ' AND ps_category_product.id_category = ' . $category;
                }

                if ($manufacturer > 0) {
                    $sqlCount .= ' AND ps_product.id_manufacturer = ' . $manufacturer;
                }
                
                
                $totalProducts = Db::getInstance()->getValue($sqlCount);
                
                // pre($totalProducts);

                $sql = 'SELECT cp.id_category, 
                   cp.id_product, 
                   cp.position, 
                   COALESCE(
                       (SELECT MAX(p.price + pa.price) 
                        FROM ps_product_attribute_shop pa 
                        WHERE pa.id_product = p.id_product 
                          AND pa.id_shop = ' . $this->context->shop->id . '
                       ), p.price
                   ) AS final_price
                    FROM ps_category_product cp
                    LEFT JOIN ps_product_shop ps ON cp.id_product = ps.id_product
                    LEFT JOIN ps_product p ON cp.id_product = p.id_product
                    LEFT JOIN ps_product_lang pl ON p.id_product = pl.id_product 
                        AND pl.id_lang = ' . $this->context->language->id . ' 
                        AND pl.id_shop = ' . $this->context->shop->id . '
                    WHERE cp.id_product IN (' . $idList . ')  
                        AND p.active = 1 
                        AND ps.active = 1
                        AND p.visibility != "none" 
                        AND ps.id_shop = ' . $this->context->shop->id;

                if ($category > 0) {
                    $sql .= ' AND cp.id_category = ' . (int) $category;
                }

                if ($manufacturer > 0) {
                    $sql .= ' AND p.id_manufacturer = ' . (int) $manufacturer;
                }

                $sql .= ' GROUP BY p.id_product';

                // Sorting Fix
                if ($query->getSortOrder()) {
                    $sortOrder = $query->getSortOrder();

                    if ($sortOrder->getField() === 'price') {
                        $sql .= ' ORDER BY final_price ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'name') {
                        $sql .= ' ORDER BY pl.name ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'reference') {
                        $sql .= ' ORDER BY p.reference ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'sales') {
                        $sql .= ' ORDER BY psale.quantity ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'date_add') {
                        $sql .= ' ORDER BY p.date_add ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    }
                }

                // Pagination
                if ($query->getResultsPerPage()) {
                    $query->setResultsPerPage(19);

                    $resultsPerPage = (int) $query->getResultsPerPage();
                    $currentPage = (int) $query->getPage();
                    $offset = ($currentPage - 1) * $resultsPerPage;

                    $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;
                }

                // pre($sql);

                $productsCar =  Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

                $products = $this->prepareMultipleProductsForTemplate(
                    $productsCar
                );

                $formatted_productsCar = [];
                foreach ($productsCar as $product) {
                    $formatted_productsCar[] = ['id_product' => $product['id_product']];
                }

                $result->setProducts($formatted_productsCar);
                $result->setTotalProductsCount($totalProducts);

                $pagination = $this->getTemplateVarPagination(
                    $query,
                    $result
                );


                // universal products
                $sqlUniversals = 'SELECT pcp.id_category, pcp.id_product, pcp.POSITION 
                        FROM ps_category_product AS pcp
                        LEFT JOIN ps_product AS pp ON pcp.id_product = pp.id_product
                        LEFT JOIN ps_product_shop AS pps ON pps.id_product = pp.id_product
                        WHERE pp.universal = 1 
                        AND pp.active = 1 
                        AND (pp.wmdeprecated != 1 OR (pp.wmdeprecated = 1 AND pp.quantity > 0))
                        AND pps.id_shop = ' . $this->context->shop->id . ' 
                        AND pps.visibility != "none"
                        GROUP BY pcp.id_product';




                $universalProducts = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sqlUniversals);
                // pre($universalProducts);

                $universals = $this->prepareMultipleProductsForTemplate(
                    $universalProducts
                );
                $noProducts = 1;
                // pre($products);
                if (empty($products) || !is_array($products)) {
                    $noProducts = 1;
                } else {
                    $noProducts = count($products) < 1 ? 1 : 0;
                }

                // pre($noProducts);


                if ($totalProducts > 0) {
                    // Calculate total pages
                    // $pagesCount = ceil($totalProducts / $resultsPerPage);
                    // $currentPage = max((int) $query->getPage(), 1);

                    // // Ensure current page is within valid range
                    // if ($currentPage > $pagesCount) {
                    //     $currentPage = $pagesCount;
                    // }

                    // // Now, calculate the offset for pagination
                    // $offset = ($currentPage - 1) * $resultsPerPage;

                    // // Add the LIMIT and OFFSET to the main SQL query
                    // $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;

                    // // Assign pagination info to Smarty
                    // $pagination = [
                    //     'total_items' => $totalProducts,
                    //     'items_shown_from' => $offset + 1,
                    //     'items_shown_to' => min($offset + $resultsPerPage, $totalProducts),
                    //     'current_page' => $currentPage,
                    //     'pages_count' => $pagesCount,
                    //     'pages' => [],
                    // ];

                    // // Build the page links
                    // for ($i = 1; $i <= $pagesCount; $i++) {
                    //     // Generate URL without `page` parameter for page 1
                    //     $url = ($i == 1) 
                    //         ? $this->context->link->getPageLink('cars-products', null, null, [
                    //             'id_compat' => Tools::getValue('id_compat'),
                    //           ])
                    //         : $this->context->link->getPageLink('cars-products', null, null, [
                    //             'page' => $i,
                    //             'id_compat' => Tools::getValue('id_compat'),
                    //           ]);

                    //     $pagination['pages'][$i] = [
                    //         'type' => 'page',
                    //         'page' => $i,
                    //         'clickable' => $i != $currentPage,
                    //         'current' => $i == $currentPage,
                    //         'url' => $url,
                    //     ];
                    // }

                    // pre($query);

                    // $compat = $query->getCompat();
                    // pre($compat);
                    // Assign the pagination to Smarty
                    $this->context->smarty->assign([
                        // 'compat' => $compat[0],
                        'cars_products_page' => 1,
                        'pagination' => $pagination,
                        'products' => $products,  // the list of products fetched after applying pagination
                        'noProducts' => $noProducts,
                        'universals' => $universals,
                    ]);
                }
            }

            $default_products_per_page = max(1, (int)Configuration::get('PS_PRODUCTS_PER_PAGE'));
            $n_array = array($default_products_per_page, $default_products_per_page * 2, $default_products_per_page * 5);


            $this->context->smarty->assign([
                'nb_products'       => $pagination['total_items'],
                'n_array' => $n_array,
            ]);

            // Loop through each sorting option
            foreach ($sort_orders as &$order) {
                // Generate the order URL using the setOrder() function
                $order['url'] = '';
                $order['value'] = $order['field'] . ':' . $order['direction'];
            }



            $searchVariables = [
                'result' => $result,
                'label' => $this->getListingLabel(),
                'products' => $products,
                'sort_orders' => $sort_orders,
                'sort_selected' => $sort_selected,
                'pagination' => $pagination,
                'rendered_facets' => $rendered_facets,
                'rendered_active_filters' => $rendered_active_filters,
                'js_enabled' => $this->ajax,
                'current_url' => $this->updateQueryString([
                    'q' => $result->getEncodedFacets(),
                ]),
            ];

            //fim euromuscle

            // euro-rider
        } elseif (
            $this->context->shop->id == 6 && (
                in_array($query->getQueryType(), ['new-products', 'category', 'search', 'manufacturer']) ||
                (Tools::getValue('id_compat') !== 'undefined' && Tools::getValue('id_compat') > 0)
            )
        ) {


            if ($query->getQueryType()) {
                $type = $query->getQueryType();
            }

            if ($query->getIdCategory()) {
                $category = $query->getIdCategory();
            }

            if ($query->getIdManufacturer()) {
                $manufacturer = $query->getIdManufacturer();
            }

            if ($query->getIdSupplier()) {
                $supplier = $query->getIdSupplier();
            }

            if ($query->getResultsPerPage()) {
                $resultsPerPage = $query->getResultsPerPage();
            }

            if ($query->getSortOrder()) {
                $sortOrder = $query->getSortOrder();
            }

            if ($query->getSearchString()) {
                $searchString = $query->getSearchString();
            }

            // pre($query);

            // Fetch category and manufacturer IDs from the query object
            $category = (int) $query->getIdCategory();
            $manufacturer = (int) $query->getIdManufacturer();

            // pre($query);

            $sql = 'SELECT p.id_product, 
                    p.price AS base_price, 
                   COALESCE(
                       (SELECT MAX(p.price + pa.price) 
                        FROM ps_product_attribute_shop pa 
                        WHERE pa.id_product = p.id_product 
                          AND pa.id_shop = 6
                       ), p.price
                   ) AS final_price 
            FROM ps_product p
            LEFT JOIN ps_product_shop ps ON p.id_product = ps.id_product
            LEFT JOIN ps_product_lang pl ON p.id_product = pl.id_product AND pl.id_lang = ' . $this->context->language->id . ' AND pl.id_shop = 6
            LEFT JOIN ps_product_sale psale ON p.id_product = psale.id_product 
            LEFT JOIN ps_category_product pc ON p.id_product = pc.id_product AND pl.id_lang = ' . $this->context->language->id . ' AND pl.id_shop = 6
            WHERE p.active = 1 AND p.visibility != "none" AND ps.id_shop = 6';

            if ($category > 0) {
                $sql .= ' AND pc.id_category = ' . (int) $category;
            }

            if ($manufacturer > 0) {
                $sql .= ' AND p.id_manufacturer = ' . (int) $manufacturer;
            }

            if (!empty($searchString)) {
                $sql .= ' AND (pl.name LIKE "%' . pSQL($searchString) . '%" 
                        OR p.reference LIKE "%' . pSQL($searchString) . '%"
                        OR EXISTS (
                            SELECT 1 FROM ps_product_attribute pa 
                            WHERE pa.id_product = p.id_product 
                              AND pa.reference LIKE "%' . pSQL($searchString) . '%"
                        ))';
            }

            if (!empty($type) && $type == 'new-products') {
                $daysNewProduct = (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT', null, null, 2);
                $newProductDate = date('Y-m-d H:i:s', strtotime("-{$daysNewProduct} days"));
                $sql .= ' AND p.date_add >= "' . pSQL($newProductDate) . '"';
            }

            $sql .= ' GROUP BY p.id_product';

            if ($query->getSortOrder()) {
                $sortOrder = $query->getSortOrder();

                if ($sortOrder->getField() === 'price') {
                    // Sort by final price correctly
                    $sql .= ' ORDER BY final_price '
                        . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'name') {
                    $sql .= ' ORDER BY pl.name ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'reference') {
                    $sql .= ' ORDER BY p.reference ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'sales') {
                    $sql .= ' ORDER BY psale.quantity ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                } elseif ($sortOrder->getField() === 'date_add') {
                    $sql .= ' ORDER BY p.date_add ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                }
            }

            if ($query->getResultsPerPage()) {
                if ($query->getQueryType() == 'new-products') {
                    $query->setResultsPerPage(19);
                }

                $resultsPerPage = (int) $query->getResultsPerPage();
                $currentPage = (int) $query->getPage();
                $offset = ($currentPage - 1) * $resultsPerPage;

                $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;
            }

            $pagination = $this->getTemplateVarPagination(
                $query,
                $result
            );

            // pre($sql);



            // if(count($products) == 0){

            // }
            // pre($products);

            $productsQuery = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);

            $products = $this->prepareMultipleProductsForTemplate(
                $productsQuery
            );

            // pagination new products

            $formatted_products = [];
            foreach ($productsQuery as $product) {
                $formatted_products[] = ['id_product' => $product['id_product']];
            }

            $result->setProducts($formatted_products);

            $result->setTotalProductsCount(count($products));

            $pagination = $this->getTemplateVarPagination(
                $query,
                $result
            );


            $product_options = [];



            if ($category == 528 && !($query->getQueryType() == 'new-products') && !($query->getQueryType() == 'manufacturer')) {

                $filters = Tools::getValue('filters');

                if ($filters) {
                    $product_options = self::getProductIdsFromFilters($filters);
                }
                // pre($product_options);

                $brand_api = CategoryControllerCore::apiCall('brand');

                foreach ($brand_api->data as $brand) {
                    $car_brands[$brand->slug] = $brand->name_en;
                }

                // pre($car_brands);

                $this->context->smarty->assign('car_brands', $car_brands);



                if (strlen($filters) > 0) {
                    $features = explode('|', $filters);
                    $arr = array();

                    foreach ($features as $feature) {
                        $current_features = explode(':', $feature);
                        $arr[$current_features[0]][] = $current_features[1];
                    }

                    $flatted = self::combinarArrays($arr);

                    foreach ($flatted as $flatted_options) {

                        $product_options_temp = array();
                        foreach ($flatted_options as $key => $option) {

                            $ids = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT id_product FROM ps_feature_product WHERE id_feature_value = ' . $option);

                            foreach ($ids as $id) $product_options_temp[$id['id_product']] += 1;
                        }

                        $total_option = count($flatted_options);
                        foreach ($product_options_temp as $key_product => $found_option) {
                            if ($found_option == $total_option) $product_options[] = $key_product;
                        }
                    }
                }

                // pre($product_options);

                $selected_filter_feature = [];
                $selected_features = null;
                $selected_id_values = null;

                if (strlen($filters) > 0) {
                    $selected_filter = explode('|', $filters);

                    foreach ($selected_filter as $selected_option) {
                        $selected_feature = explode(':', $selected_option);

                        $selected_id_values[] = $selected_feature[1];

                        if (count($product_options) > 0) $sql_product_options = 'AND ps_feature_product.id_product IN ( ' . implode(',', $product_options) . ' )';

                        $sqlFeature =  'SELECT name 
                                        FROM ps_feature_lang 
                                        LEFT JOIN ps_feature_product ON ps_feature_product.id_feature = ps_feature_lang.id_feature 
                                        WHERE ps_feature_lang.id_lang=' . $this->context->language->id . ' 
                                        ' . $sql_product_options . '
                                        AND ps_feature_lang.id_feature=' . $selected_feature[0] .
                            ' ORDER BY name DESC';

                        // pre($sqlFeature);

                        $feature_group = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlFeature);



                        if ($selected_feature[1] == 0) {
                            $feature_value = 'ALL';
                        } else {
                            $sqlFeatureValue = 'SELECT value 
                                                FROM ps_feature_value_lang 
                                                LEFT JOIN ps_feature_product ON ps_feature_product.id_feature_value = ps_feature_value_lang.id_feature_value 
                                                WHERE ps_feature_value_lang.id_lang=' . $this->context->language->id . ' 
                                                ' . $sql_product_options . '
                                                AND ps_feature_value_lang.id_feature_value=' . $selected_feature[1] .
                                ' ORDER BY value DESC';

                            $feature_value = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlFeatureValue);

                            $selected_filter_feature[] = $selected_feature[0];
                        }

                        /**
                        if( strlen($feature_group) > 0){
                            $selected_features[] = [
                                'combination' => $selected_option,
                                'feature' => $feature_group,
                                'value' => $feature_value
                            ];
                        }
                         **/

                        if (strlen($feature_group) > 0) {
                            $selected_features[$feature_group][] = [
                                'combination' => $selected_option,
                                'feature' => $feature_group,
                                'value' => $feature_value
                            ];
                        }
                    }
                }

                // pre($product_options);

                // pre($selected_filter_feature);
                $default_products_per_page = max(1, 19);
                $currentPage = (int) $query->getPage(); // Get the current page from the query object
                $offset = ($currentPage - 1) * $default_products_per_page;



                $sql_products_of_category = 'SELECT pc.*, pp.id_manufacturer FROM ps_category_product pc LEFT JOIN ps_product pp ON pc.id_product = pp.id_product  WHERE id_category IN (528) AND pp.visibility != "none"';
                // pre($sql_products_of_category);


                if (!empty($product_options)) {
                    $sql_products_of_category .= ' AND pc.id_product IN (' . implode(',', $product_options) . ')';
                } else if (!empty($selected_filter_feature) && empty($product_options)) {
                    $sql_products_of_category .= 'AND 1=0';
                }
                // elseif(count($ids_products) > 0 ){
                //     $sql_products_of_category .= ' AND id_product IN (' . implode(',', $ids_products) . ')';
                // }

                $sql_products_of_category .= ' LIMIT ' . $default_products_per_page . ' OFFSET ' . $offset;

                // pre($sql_products_of_category);

                $products_227 = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql_products_of_category);

                // pre($products_227);

                $formatted_products_227 = [];
                foreach ($products_227 as $product) {
                    $formatted_products_227[] = ['id_product' => $product['id_product']];
                }

                $sql_total_products = 'SELECT COUNT(*) as total FROM ps_category_product WHERE id_category IN (528)';
                $total_products = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql_total_products);

                $result->setProducts($formatted_products_227);
                $result->setTotalProductsCount($total_products);
                $query->setResultsPerPage(19);

                $pagination = $this->getTemplateVarPagination(
                    $query,
                    $result
                );

                $ids_prods = array();
                $features  = array();

                foreach ($products_227 as $product_227) $ids_prods[] = $product_227['id_product'];

                // pre($ids_prods);

                // echo 'SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat 
                //         FROM ps_feature_product 
                //         LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                //         LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                //             AND id_lang=' . (int)$this->context->language->id . ' 
                //         WHERE id_product IN (' . implode(", ", $ids_prods) . ')  
                //         GROUP BY ps_feature_product.id_feature 
                //         ORDER BY ps_feature.position ASC';
                //         exit;

                // $features_category = Db::getInstance()->ExecuteS('SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat FROM ps_feature_product LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature AND id_lang=' . $this->context->language->id . ' WHERE id_product IN (' . implode(", ", $ids_prods) . ' ) ' . ' GROUP BY ps_feature_product.id_feature');

                // $features_category = Db::getInstance()->ExecuteS('SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat FROM ps_feature_product LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature AND id_lang=' . $this->context->language->id . ' WHERE id_product IN (' . implode(", ", $ids_prods) . ' ) ' . ' GROUP BY ps_feature_product.id_feature ORDER BY ps_feature.position ASC');

                if (!empty($ids_prods)) {
                    $features_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS(
                        'SELECT ps_feature_product.id_feature, name, count(name) AS nr_repeat 
                        FROM ps_feature_product 
                        LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                            AND id_lang=' . (int)$this->context->language->id . ' 
                        WHERE id_product IN (' . implode(", ", $ids_prods) . ')  
                        GROUP BY ps_feature_product.id_feature 
                        ORDER BY ps_feature.position ASC'
                    );
                } else {
                    $features_category = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS(
                        'SELECT ps_feature_product.id_feature, ps_feature_lang.name, COUNT(ps_feature_lang.name) AS nr_repeat , ps_feature_shop.id_shop 
                        FROM ps_feature_product 
                        LEFT JOIN ps_feature ON ps_feature.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_lang ON ps_feature_lang.id_feature = ps_feature_product.id_feature 
                        LEFT JOIN ps_feature_shop ON ps_feature_product.id_feature = ps_feature_shop.id_feature WHERE id_lang=2  AND id_shop=' . $this->context->shop->id . '
                        GROUP BY ps_feature_product.id_feature ORDER BY ps_feature.position ASC'
                    );
                }



                foreach ($features_category as $f_category) {

                    // $features_value = Db::getInstance()->ExecuteS('SELECT ps_feature_value.id_feature,ps_feature_value_lang.id_feature_value, ps_feature_value_lang.value, value, count(value) AS nr_values FROM ps_feature_value LEFT JOIN ps_feature_value_lang ON ps_feature_value_lang.id_feature_value = ps_feature_value.id_feature_value AND ps_feature_value_lang.id_lang=' . $this->context->language->id . ' AND ps_feature_value.id_feature = ' . $f_category['id_feature'] . ' 
                    // WHERE ps_feature_value_lang.id_feature_value IS NOT NULL
                    // GROUP BY ps_feature_value_lang.id_feature_value ORDER BY ps_feature_value.id_feature');
                    $features_value = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('SELECT ps_feature_product.id_feature, ps_feature_product.id_feature_value, value, count(value) AS nr_values FROM ps_feature_product LEFT JOIN ps_feature_value_lang ON ps_feature_value_lang.id_feature_value = ps_feature_product.id_feature_value AND id_lang=' . $this->context->language->id . ' LEFT JOIN ps_feature_value ON ps_feature_value.id_feature_value = ps_feature_product.id_feature_value WHERE ps_feature_value.id_feature = ' . $f_category['id_feature'] . ' GROUP BY ps_feature_value_lang.id_feature_value');
                    // pre($features_value);

                    $features[] = [
                        'id_feature' => $f_category['id_feature'],
                        'name' => $f_category['name'],
                        'quantity' => $f_category['nr_repeat'],
                        'values' => $features_value
                    ];
                }


                // pre($features);

                if ($selected_features) {
                    foreach ($features as &$feature) {
                        // Initialize combined_combinations for this feature
                        $feature['combined_combinations'] = '';

                        foreach ($feature['values'] as &$value) {
                            $value['checked'] = 0; // Default checked value

                            // Check if the feature exists in selected features
                            if (isset($selected_features[$feature['name']])) {
                                $combinations = [];
                                foreach ($selected_features[$feature['name']] as $selected) {
                                    $combination = "{$value['id_feature']}:{$value['id_feature_value']}";

                                    // Set checked if combination matches
                                    if ($combination === $selected['combination']) {
                                        $value['checked'] = 1;
                                    }

                                    // Collect combination for this feature
                                    $combinations[] = $selected['combination'];
                                }

                                // Assign all combinations to the feature
                                $feature['combined_combinations'] = implode(',', $combinations);
                            }

                            // Additional processing for "Brand" feature
                            if ($feature['name'] === 'Brand' || $feature['name'] === 'Marca' || $feature['name'] === 'Marque') {
                                // pre($product_227);
                                if (!empty($product_227)) {
                                    $sqlBrandImg = 'SELECT id_manufacturer FROM ps_manufacturer WHERE id_manufacturer="' . $product_227["id_manufacturer"] . '"';
                                    $brandImg = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlBrandImg);

                                    // Add img field to $value
                                    $value['img'] = $brandImg
                                        ? "/img/wheels/" . $brandImg . ".webp?t=3"
                                        : null; // Add null or fallback URL if brandImg is not found

                                } elseif ($feature['id_feature'] == 19) {
                                    // if theres a name in the ps_manufacture = $feature['values']['value'] needs a foreach
                                    // pre($feature['values']);
                                    foreach ($feature['values'] as &$value) {
                                        if ($value['checked'] != '0') {
                                            $sqlBrandImg = 'SELECT id_manufacturer FROM ps_manufacturer WHERE name = "' . pSQL($value['value']) . '"';

                                            // Execute the query to check if the manufacturer exists
                                            $brandImg = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlBrandImg);

                                            // If a manufacturer is found, assign the image path
                                            if ($brandImg) {
                                                $value['img'] = "/img/wheels/" . $brandImg . ".webp?t=3";
                                                // pre($value);
                                            } else {
                                                if ($value['value'] == 'Gram Lights') {
                                                    $value['img'] = "/img/wheels/170.webp?t=3";
                                                } elseif ($value['value'] == 'Carroll Shelby') {
                                                    $value['img'] = "/img/wheels/188.webp?t=3";
                                                } elseif ($value['value'] == 'Volk Racing') {
                                                    $value['img'] = "/img/wheels/173.webp?t=3";
                                                }
                                                // pre($value);
                                            }
                                        }
                                    }
                                }


                                // pre($value);
                            }
                        }
                    }
                    unset($feature, $value); // Break reference
                }



                // pre($features);

                $this->context->smarty->assign('asw_features', $features);
                $this->context->smarty->assign('have_selected_features', $selected_features ? count($selected_features) : null);
                $this->context->smarty->assign('selected_features', $selected_features);
                $this->context->smarty->assign('selected_values', $selected_id_values);

                // After filtering, check if product_options is empty
                // if (empty($product_options)) {
                //     $this->context->smarty->assign('no_products', true);
                // }



                $products = $this->prepareMultipleProductsForTemplate(
                    $products_227
                );


                if (empty($products)) {
                    $this->context->smarty->assign('no_products', true);
                }


                // $noProducts = count($products) < 1 ? 1 : 0;
                // $this->context->smarty->assign('noProducts', $noProducts);



                // pre($products);

            }

            if ($this->context->shop->id == 6 && (Tools::getValue('id_compat') !== 'undefined' && Tools::getValue('id_compat') > 0)) {

                $id_compat = Tools::getValue('id_compat');
                $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
                $shop_id = $this->context->shop->id;

                $url = 'https://webtools.all-stars-motorsport.com/api/get/products/' . $id_compat . '/' . $shop_id . '/' . $key;
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

                $productsC = $data['data'];

                // pre($query);
                $category = Tools::getValue('id_category_layered');
                $manufacturer = Tools::getValue('id_manufacturer_layered');

                // $search = $this->getProductSearchVariables();

                // Fetch products related to the selected car product
                if (empty($productsC)) {
                    return [];
                }

                $ids = array_map('intval', (array) $productsC);
                $idList = implode(',', $ids);

                // count products
                // Query to count total products matching the filters
                $sqlCount = 'SELECT COUNT(DISTINCT ps_category_product.id_product) 
                FROM ps_category_product
                LEFT JOIN ps_product_shop ON ps_category_product.id_product = ps_product_shop.id_product
                LEFT JOIN ps_product ON ps_category_product.id_product = ps_product.id_product
                LEFT JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product 
                    AND ps_product_lang.id_lang = ' . $this->context->language->id . ' 
                    AND ps_product_lang.id_shop = ' . $this->context->shop->id . '
                WHERE ps_category_product.id_product IN (' . $idList . ')  
                AND ps_product.active = 1 AND ps_product.visibility != "none"
                AND ps_product_shop.id_shop = ' . $this->context->shop->id;

                if ($category > 0) {
                    $sqlCount .= ' AND ps_category_product.id_category = ' . $category;
                }

                if ($manufacturer > 0) {
                    $sqlCount .= ' AND ps_product.id_manufacturer = ' . $manufacturer;
                }

                $totalProducts = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sqlCount);

                $sql = 'SELECT cp.id_category, 
                   cp.id_product, 
                   cp.position, 
                   COALESCE(
                       (SELECT MAX(p.price + pa.price) 
                        FROM ps_product_attribute_shop pa 
                        WHERE pa.id_product = p.id_product 
                          AND pa.id_shop = ' . $this->context->shop->id . '
                       ), p.price
                   ) AS final_price
                    FROM ps_category_product cp
                    LEFT JOIN ps_product_shop ps ON cp.id_product = ps.id_product
                    LEFT JOIN ps_product p ON cp.id_product = p.id_product
                    LEFT JOIN ps_product_lang pl ON p.id_product = pl.id_product 
                        AND pl.id_lang = ' . $this->context->language->id . ' 
                        AND pl.id_shop = ' . $this->context->shop->id . '
                    WHERE cp.id_product IN (' . $idList . ')  
                        AND p.active = 1 
                        AND p.visibility != "none" 
                        AND ps.id_shop = ' . $this->context->shop->id;

                if ($category > 0) {
                    $sql .= ' AND cp.id_category = ' . (int) $category;
                }

                if ($manufacturer > 0) {
                    $sql .= ' AND p.id_manufacturer = ' . (int) $manufacturer;
                }

                $sql .= ' GROUP BY p.id_product';

                // Sorting Fix
                if ($query->getSortOrder()) {
                    $sortOrder = $query->getSortOrder();

                    if ($sortOrder->getField() === 'price') {
                        $sql .= ' ORDER BY final_price ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'name') {
                        $sql .= ' ORDER BY pl.name ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'reference') {
                        $sql .= ' ORDER BY p.reference ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'sales') {
                        $sql .= ' ORDER BY psale.quantity ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    } elseif ($sortOrder->getField() === 'date_add') {
                        $sql .= ' ORDER BY p.date_add ' . ($sortOrder->getDirection() === 'desc' ? 'DESC' : 'ASC');
                    }
                }

                // Pagination
                if ($query->getResultsPerPage()) {
                    $query->setResultsPerPage(19);

                    $resultsPerPage = (int) $query->getResultsPerPage();
                    $currentPage = (int) $query->getPage();
                    $offset = ($currentPage - 1) * $resultsPerPage;

                    $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;
                }



                $productsCar =  Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

                $products = $this->prepareMultipleProductsForTemplate(
                    $productsCar
                );

                $formatted_productsCar = [];
                foreach ($productsCar as $product) {
                    $formatted_productsCar[] = ['id_product' => $product['id_product']];
                }

                $result->setProducts($formatted_productsCar);
                $result->setTotalProductsCount($totalProducts);

                $pagination = $this->getTemplateVarPagination(
                    $query,
                    $result
                );



                // universal products
                $sqlUniversals = 'SELECT pcp.id_category, pcp.id_product, pcp.POSITION 
                        FROM ps_category_product AS pcp
                        LEFT JOIN ps_product AS pp ON pcp.id_product = pp.id_product
                        LEFT JOIN ps_product_shop AS pps ON pps.id_product = pp.id_product
                        WHERE pp.universal = 1 
                        AND pp.active = 1 
                        AND (pp.wmdeprecated != 1 OR (pp.wmdeprecated = 1 AND pp.quantity > 0))
                        AND pps.id_shop = ' . $this->context->shop->id . ' 
                        AND pps.visibility != "none"
                        GROUP BY pcp.id_product';




                $universalProducts = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sqlUniversals);
                // pre($universalProducts);

                $universals = $this->prepareMultipleProductsForTemplate(
                    $universalProducts
                );
                $noProducts = 1;
                // pre($products);
                if (empty($products) || !is_array($products)) {
                    $noProducts = 1;
                } else {
                    $noProducts = count($products) < 1 ? 1 : 0;
                }

                // pre($noProducts);


                if ($totalProducts > 0) {
                    // Calculate total pages
                    // $pagesCount = ceil($totalProducts / $resultsPerPage);
                    // $currentPage = max((int) $query->getPage(), 1);

                    // // Ensure current page is within valid range
                    // if ($currentPage > $pagesCount) {
                    //     $currentPage = $pagesCount;
                    // }

                    // // Now, calculate the offset for pagination
                    // $offset = ($currentPage - 1) * $resultsPerPage;

                    // // Add the LIMIT and OFFSET to the main SQL query
                    // $sql .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;

                    // // Assign pagination info to Smarty
                    // $pagination = [
                    //     'total_items' => $totalProducts,
                    //     'items_shown_from' => $offset + 1,
                    //     'items_shown_to' => min($offset + $resultsPerPage, $totalProducts),
                    //     'current_page' => $currentPage,
                    //     'pages_count' => $pagesCount,
                    //     'pages' => [],
                    // ];

                    // // Build the page links
                    // for ($i = 1; $i <= $pagesCount; $i++) {
                    //     // Generate URL without `page` parameter for page 1
                    //     $url = ($i == 1) 
                    //         ? $this->context->link->getPageLink('cars-products', null, null, [
                    //             'id_compat' => Tools::getValue('id_compat'),
                    //           ])
                    //         : $this->context->link->getPageLink('cars-products', null, null, [
                    //             'page' => $i,
                    //             'id_compat' => Tools::getValue('id_compat'),
                    //           ]);

                    //     $pagination['pages'][$i] = [
                    //         'type' => 'page',
                    //         'page' => $i,
                    //         'clickable' => $i != $currentPage,
                    //         'current' => $i == $currentPage,
                    //         'url' => $url,
                    //     ];
                    // }

                    // pre($query);

                    // $compat = $query->getCompat();
                    // pre($compat);
                    // Assign the pagination to Smarty
                    $this->context->smarty->assign([
                        // 'compat' => $compat[0],
                        'cars_products_page' => 1,
                        'pagination' => $pagination,
                        'products' => $products,  // the list of products fetched after applying pagination
                        'noProducts' => $noProducts,
                        'universals' => $universals,
                    ]);
                }
            }

            $default_products_per_page = max(1, (int)Configuration::get('PS_PRODUCTS_PER_PAGE'));
            $n_array = array($default_products_per_page, $default_products_per_page * 2, $default_products_per_page * 5);


            $this->context->smarty->assign([
                'nb_products'       => $pagination['total_items'],
                'n_array' => $n_array,
            ]);

            // Loop through each sorting option
            foreach ($sort_orders as &$order) {
                // Generate the order URL using the setOrder() function
                $order['url'] = '';
                $order['value'] = $order['field'] . ':' . $order['direction'];
            }



            $searchVariables = [
                'result' => $result,
                'label' => $this->getListingLabel(),
                'products' => $products,
                'sort_orders' => $sort_orders,
                'sort_selected' => $sort_selected,
                'pagination' => $pagination,
                'rendered_facets' => $rendered_facets,
                'rendered_active_filters' => $rendered_active_filters,
                'js_enabled' => $this->ajax,
                'current_url' => $this->updateQueryString([
                    'q' => $result->getEncodedFacets(),
                ]),
            ];
        } else {

            $searchVariables = [
                'result' => $result,
                'label' => $this->getListingLabel(),
                'products' => $products,
                'sort_orders' => $sort_orders,
                'sort_selected' => $sort_selected,
                'pagination' => $pagination,
                'rendered_facets' => $rendered_facets,
                'rendered_active_filters' => $rendered_active_filters,
                'js_enabled' => $this->ajax,
                'current_url' => $this->updateQueryString([
                    'q' => $result->getEncodedFacets(),
                ]),
            ];
        }

        // pre($sort_orders);
        // pre($sort_selected);

        // pre($searchVariables);

        Hook::exec('filterProductSearch', ['searchVariables' => &$searchVariables]);
        Hook::exec('actionProductSearchAfter', $searchVariables);

        return $searchVariables;
    }

    function getProductIdsFromFilters($filters)
    {
        // Explode os filtros em pares de feature:value
        $filterPairs = explode('|', $filters);

        // pre($filterPairs);

        // Organiza os valores por id_feature
        $featureValues = [];
        foreach ($filterPairs as $pair) {
            list($feature, $value) = explode(':', $pair);
            if (!isset($featureValues[$feature])) {
                $featureValues[$feature] = [];
            }
            $featureValues[$feature][] = $value;
        }

        // Cria as subconsultas para cada id_feature
        $subqueries = [];
        foreach ($featureValues as $feature => $values) {
            $subqueries[] = "
                SELECT id_product
                FROM ps_feature_product
                WHERE id_feature = $feature
                  AND id_feature_value IN (" . implode(',', $values) . ")
            ";
        }

        // pre($subqueries);

        // Combina as subconsultas usando INTERSECT
        $query = implode(" INTERSECT ", $subqueries);

        // pre($query);

        $productIds = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

        $productIdsArray = array_map(function ($product) {
            return $product['id_product'];
        }, $productIds);


        return $productIdsArray;
    }

    private static function combinarArrays($arrays)
    {
        // Inicia o resultado com um array vazio para gerar combinações
        $result = [[]];

        // Percorre cada array na lista de arrays
        foreach ($arrays as $array) {
            $novoResultado = [];

            // Adiciona cada item do array atual a cada combinação já existente no resultado
            foreach ($result as $combination) {
                foreach ($array as $item) {
                    $novoResultado[] = array_merge($combination, [$item]);
                }
            }

            // Atualiza o resultado com as novas combinações geradas
            $result = $novoResultado;
        }

        return $result;
    }

    /**
     * Removes price information from result (in facet collection and available sorters)
     * Usually used for catalog mode.
     *
     * @param ProductSearchResult $result
     */
    protected function disablePriceControls(ProductSearchResult $result)
    {
        if ($result->getFacetCollection()) {
            $filteredFacets = [];
            /** @var Facet $facet */
            foreach ($result->getFacetCollection()->getFacets() as $facet) {
                if ('price' === $facet->getType()) {
                    continue;
                }
                $filteredFacets[] = $facet;
            }
            $result->getFacetCollection()->setFacets($filteredFacets);
        }


        if ($result->getAvailableSortOrders()) {
            $filteredOrders = [];
            /** @var SortOrder $sortOrder */
            foreach ($result->getAvailableSortOrders() as $sortOrder) {
                if ('price' === $sortOrder->getField()) {
                    continue;
                }
                $filteredOrders[] = $sortOrder;
            }
            $result->setAvailableSortOrders($filteredOrders);
        }
    }

    /**
     * Pagination is HARD. We let the core do the heavy lifting from
     * a simple representation of the pagination.
     *
     * Generated URLs will include the page number, obviously,
     * but also the sort order and the "q" (facets) parameters.
     *
     * @param ProductSearchQuery $query
     * @param ProductSearchResult $result
     *
     * @return array An array that makes rendering the pagination very easy
     */
    protected function getTemplateVarPagination(
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
            'items_shown_to' => ($itemsShownTo <= $totalItems) ? $itemsShownTo : $totalItems,
            'current_page' => $pagination->getPage(),
            'pages_count' => $pagination->getPagesCount(),
            'pages' => $pages,
            // Compare to 3 because there are the next and previous links
            'should_be_displayed' => (count($pagination->buildLinks()) > 3),
        ];
    }

    /**
     * Prepares the sort-order links.
     *
     * Sort order links contain the current encoded facets if any,
     * but not the page number because normally when you change the sort order
     * you want to go back to page one.
     *
     * @param array $sortOrders the available sort orders
     * @param string $currentSortOrderURLParameter used to know which of the sort orders (if any) is active
     *
     * @return array
     */
    protected function getTemplateVarSortOrders(array $sortOrders, $currentSortOrderURLParameter)
    {
        return array_map(function ($sortOrder) use ($currentSortOrderURLParameter) {
            $order = $sortOrder->toArray();
            $order['current'] = $order['urlParameter'] === $currentSortOrderURLParameter;
            $order['url'] = $this->updateQueryString([
                'order' => $order['urlParameter'],
                'page' => null,
            ]);

            return $order;
        }, $sortOrders);
    }

    /**
     * Similar to "getProductSearchVariables" but used in AJAX queries.
     *
     * It returns an array with the HTML for the products and facets,
     * and the current URL to put it in the browser URL bar (we don't want to
     * break the back button!).
     *
     * @return array
     */
    protected function getAjaxProductSearchVariables()
    {
        $search = $this->getProductSearchVariables();

        // pre(Tools::getAllValues());

        $rendered_products_top = $this->render('catalog/_partials/products-top', ['listing' => $search]);
        $rendered_products = $this->render('catalog/_partials/products', ['listing' => $search]);
        $rendered_products_bottom = $this->render('catalog/_partials/products-bottom', ['listing' => $search]);




        $data = array_merge(
            [
                'rendered_products_top' => $rendered_products_top,
                'rendered_products' => $rendered_products,
                'rendered_products_bottom' => $rendered_products_bottom,
            ],
            $search
        );

        if (!empty($data['products']) && is_array($data['products'])) {
            $data['products'] = $this->prepareProductArrayForAjaxReturn($data['products']);
        }

        return $data;
    }

    protected function getAjaxProductSearchVariablesQS()
    {
        $search = $this->getProductSearchVariables();

        // $product = new Product($search['id_product']);
        // $haveCombinations = $product->hasAttributes();


        // $search['hasCombinations'] = $haveCombinations;


        if ($this->context->shop->id == 3) {
            // echo '<pre>'.print_r($search,1).'</pre>';
            // exit;

            // $productsArray = [];
            // foreach($search['products'] as $product){
            //     $product = new Product($product['id_product']);
            //     $productsArray[] = $product;

            // }

            // $haveCombinations = $product->hasAttributes();

            $searchRef = pSQL(Tools::getValue('s'));
            // echo 'SELECT id_product_attribute FROM '._DB_PREFIX_.'product_attribute  WHERE reference LIKE "'.pSQL($searchRef).'%"';
            // exit;
            foreach ($search['products'] as $product) {
                $product['product_attribute_atr'] = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT id_product_attribute FROM ' . _DB_PREFIX_ . 'product_attribute  WHERE reference LIKE "' . pSQL($searchRef) . '%"');
            }

            // $product_attribute = Db::getInstance()->getValue('SELECT id_product_attribute FROM '._DB_PREFIX_.'product_attribute  WHERE reference="'.pSQL(Tools::getValue('s')).'"');

            // if($product_attribute){
            //     $search['child_attribute'] = $product_attribute;
            //     $search['child_reference'] = Tools::getValue('s');
            // }


            // echo '<pre>'.print_r($haveCombinations,1).'</pre>';




            // $rendered_products_top = $this->render('catalog/_partials/products-top', ['listing' => $search]);
            $rendered_products = $this->render('catalog/qs-search-product', ['listing' => $search]);
            // $rendered_products = $this->render('catalog/qs-search-product', ['listing' => $search, 'child_attribute' => $product_attribute+0, 'isFather' => $haveCombinations, 'child_reference' => pSQL(Tools::getValue('s'))]);
            // $rendered_products_bottom = $this->render('catalog/_partials/products-bottom', ['listing' => $search]);
        } else {
            $rendered_products_top = $this->render('catalog/_partials/products-top', ['listing' => $search]);
            $rendered_products = $this->render('catalog/_partials/products', ['listing' => $search]);
            $rendered_products_bottom = $this->render('catalog/_partials/products-bottom', ['listing' => $search]);
        }



        $data = array_merge(
            [
                'rendered_products_top' => $rendered_products_top,
                'rendered_products' => $rendered_products,
                'rendered_products_bottom' => $rendered_products_bottom,
            ],
            $search
        );

        if (!empty($data['products']) && is_array($data['products'])) {
            $data['products'] = $this->prepareProductArrayForAjaxReturn($data['products']);
        }

        return $data;
    }

    // protected function getAjaxProductSearchVariablesCompats()
    // {
    //     $search = $this->getProductSearchVariables();

    //     echo 'paulo';

    //     pre($search);

    //     // $product = new Product($search['id_product']);
    //     // $haveCombinations = $product->hasAttributes();


    //     // $search['hasCombinations'] = $haveCombinations;


    //     if($this->context->shop->id == 3){

    //         // $haveCombinations = $product->hasAttributes();

    //         $searchRef = pSQL(Tools::getValue('s'));
    //         // echo 'SELECT id_product_attribute FROM '._DB_PREFIX_.'product_attribute  WHERE reference LIKE "'.pSQL($searchRef).'%"';
    //         // exit;
    //         foreach($search['products'] as $product){
    //             $product['product_attribute_atr'] = Db::getInstance()->getValue('SELECT id_product_attribute FROM '._DB_PREFIX_.'product_attribute  WHERE reference LIKE "'.pSQL($searchRef).'%"');
    //         }

    //         // $rendered_products_top = $this->render('catalog/_partials/products-top', ['listing' => $search]);
    //         $rendered_products = $this->render('catalog/qs-search-product', ['listing' => $search]);
    //         // $rendered_products = $this->render('catalog/qs-search-product', ['listing' => $search, 'child_attribute' => $product_attribute+0, 'isFather' => $haveCombinations, 'child_reference' => pSQL(Tools::getValue('s'))]);
    //         // $rendered_products_bottom = $this->render('catalog/_partials/products-bottom', ['listing' => $search]);
    //     }else{
    //         $rendered_products_top = $this->render('catalog/_partials/products-top', ['listing' => $search]);
    //         $rendered_products = $this->render('catalog/_partials/products', ['listing' => $search]);
    //         $rendered_products_bottom = $this->render('catalog/_partials/products-bottom', ['listing' => $search]);
    //     }



    //     $data = array_merge(
    //         [
    //             'rendered_products_top' => $rendered_products_top,
    //             'rendered_products' => $rendered_products,
    //             'rendered_products_bottom' => $rendered_products_bottom,
    //         ],
    //         $search
    //     );

    //     if (!empty($data['products']) && is_array($data['products'])) {
    //         $data['products'] = $this->prepareProductArrayForAjaxReturn($data['products']);
    //     }

    //     return $data;
    // }

    /**
     * Cleans the products array with only whitelisted properties.
     *
     * @param array[] $products
     *
     * @return array[] Filtered product list
     */
    protected function prepareProductArrayForAjaxReturn(array $products)
    {
        $filter = $this->get('prestashop.core.filter.front_end_object.search_result_product_collection');

        return $filter->filter($products);
    }

    /**
     * Finally, the methods that wraps it all:.
     *
     * If we're doing AJAX, output a JSON of the necessary product search related
     * variables.
     *
     * If we're not doing AJAX, then render the whole page with the given template.
     *
     * @param string $template the template for this page
     */
    protected function doProductSearch($template, $params = [], $locale = null)
    {
        if ($this->ajax) {
            ob_end_clean();
            header('Content-Type: application/json');
            if ($template == 'catalog/quick-shop') {
                $this->ajaxRender(json_encode($this->getAjaxProductSearchVariablesQS()));
                // }elseif($template == 'catalog/cars-products'){
                //     $this->ajaxRender(json_encode($this->getAjaxProductSearchVariablesCompats()));
            } else {
                $this->ajaxRender(json_encode($this->getAjaxProductSearchVariables()));
            }

            return;
        } else {
            $variables = $this->getProductSearchVariables();

            $this->context->smarty->assign([
                'listing' => $variables,
            ]);

            $this->setTemplate($template, $params, $locale);
        }
    }

    abstract public function getListingLabel();

    /**
     * Gets the product search query for the controller.
     * That is, the minimum contract with which search modules
     * must comply.
     *
     * @return ProductSearchQuery
     */
    abstract protected function getProductSearchQuery();

    /**
     * We cannot assume that modules will handle the query,
     * so we need a default implementation for the search provider.
     *
     * @return ProductSearchProviderInterface
     */
    abstract protected function getDefaultProductSearchProvider();
}
