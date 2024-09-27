<?php

use PrestaShop\PrestaShop\Adapter\Search\SearchProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class QuickShopControllerCore extends ProductListingFrontController{
    public $auth = true;
    public $authRedirection = 'my-account';
    public $php_self = 'quickshop';

    public $instant_search;
    public $ajax_search;

    protected $search_string;
    protected $search_tag;

    public function init()
    {
        parent::init();

        if (Tools::getValue('ajax')) {
            $this->ajax = true;
        }

        if (Tools::getValue('qs_setproduct')) {
            $dataProductJson = Tools::getValue('data_product'); // Get JSON string from the request
            $dataProduct = json_decode($dataProductJson, true); 

            // Decode JSON to associative array

                // Check if decoding was successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                die(json_encode(['error' => 'Invalid JSON received: ' . json_last_error_msg()]));
            }

            // Now you can access product data using $dataProduct
            if (!isset($dataProduct['id_product'])) {
                die(json_encode(['error' => 'Product ID not set']));
            }

            $productId = $dataProduct['id_product'];
            // Fetch product or do whatever you need with this data
            $QSproduct = new Product($productId);
            $attributes = $QSproduct->getAttributeCombinations($this->context->language->id);
            
            // // Initialize the grouped attributes array
            // $groupedAttributes = [];

            // // Iterate through the attributes to group them
            // foreach ($attributes as $attribute) {
            //     $groupId = $attribute['id_attribute_group']; // Get the group ID
            //     $groupName = $attribute['group_name']; // Get the group name

            //     // Initialize the group if it doesn't exist
            //     if (!isset($groupedAttributes[$groupId])) {
            //         $groupedAttributes[$groupId] = [
            //             'group_name' => $groupName,
            //             'name' => $groupName, // This can be customized as needed
            //             'group_type' => 'select', // Assuming type is select for dropdowns
            //             'default' => $attribute['default_on'] ? $attribute['id_attribute'] : -1, // Default attribute
            //             'attributes' => [],
            //             'attributes_quantity' => [],
            //         ];
            //     }

            //     // Add the attribute to the group's attributes
            //     $groupedAttributes[$groupId]['attributes'][$attribute['id_attribute']] = [
            //         'name' => $attribute['attribute_name'], // The name of the attribute (e.g., "S", "M", etc.)
            //         'html_color_code' => $attribute['html_color_code'] ?? '', // Optional: Color code if applicable
            //         'texture' => $attribute['texture'] ?? '', // Optional: Texture if applicable
            //         'selected' => $attribute['default_on'] ? 1 : 0, // Mark as selected if it's the default
            //     ];

            //     // Also keep track of the quantity for each attribute
            //     $groupedAttributes[$groupId]['attributes_quantity'][$attribute['id_attribute']] = $attribute['quantity'] ?? 0;
            // }

            // // At this point, $groupedAttributes is structured similarly to your original $groups
            $dataProduct['groups'] = $attributes; // Set the transformed groups into your data product

            // echo '<pre>' . print_r($dataProduct['id_product_attribute'], 1) . '</pre>';
            // exit;

            $imageLink = $this->context->link->getImageLink(
                $QSproduct->reference, 
                null, 
                null,
                'jpg', 
                $productId, 
                $QSproduct->id_manufacturer,
                'thumb'
            );

            $dataProduct['product_img'] = $imageLink;

            $dataProduct['id_attribute_child'] = Tools::getValue('id_attribute_child');
            

            if($dataProduct['id_attribute_child'] > 0){

                $atributes = Db::getInstance()->ExecuteS('
                SELECT *
                FROM '._DB_PREFIX_.'product_attribute_combination AS pac
                INNER JOIN '._DB_PREFIX_.'attribute AS a
                ON pac.id_attribute = a.id_attribute
                INNER JOIN '._DB_PREFIX_.'attribute_group_lang AS agl
                ON a.id_attribute_group = agl.id_attribute_group
                INNER JOIN '._DB_PREFIX_.'attribute_lang AS al 
                ON pac.id_attribute = al.id_attribute
                WHERE pac.id_product_attribute="'.$dataProduct['id_attribute_child'] .'"
                GROUP BY al.id_attribute');

                $dataProduct['qs_attributes'] = $atributes;
            }


            // echo '<pre>' . print_r($dataProduct['qs_attributes'] , 1) . '</pre>';
            // exit;

            // Render your response template as before
            $renderedTemplate = $this->context->smarty->fetch('catalog/qs-line.tpl', ['product' => $dataProduct]);

            // Return the rendered template in JSON format
            die(json_encode([
                'rendered_template' => $renderedTemplate,
            ]));
        }




        $this->search_string = Tools::getValue('s');

        if (!$this->search_string) {
            $this->search_string = Tools::getValue('search_query');
        }

        // Debugging: Log or output the search string to see if it's passed correctly
        error_log("Search string: " . $this->search_string);

        $this->search_tag = Tools::getValue('tag');

        $this->context->smarty->assign(
            [
                'search_string' => $this->search_string,
                'search_tag' => $this->search_tag,
                'subcategories' => [],
            ]
        );
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

        $this->doProductSearch('catalog/quick-shop', ['entity' => 'search']);

        $this->context->smarty->assign(
            [
                'url_quickshop_controller' => $this->context->link->getPageLink('quickshop', null, null, null, false, null, true),
            ]
        );

        $this->setTemplate('catalog/quick-shop.tpl');
    }


    




    /**
     * @return ProductSearchQuery
     */
    protected function getProductSearchQuery()
    {
        $query = new ProductSearchQuery();
        $query
            ->setQueryType('search')
            ->setSortOrder(new SortOrder('product', 'position', 'desc'))
            ->setSearchString($this->search_string)
            ->setSearchTag($this->search_tag);

            if ($this->search_string) {
                $this->search_string = '%' . $this->search_string . '%';
            }

        return $query;
    }

    /**
     * @return SearchProductSearchProvider
     */
    protected function getDefaultProductSearchProvider()
    {
        return new SearchProductSearchProvider(
            $this->getTranslator()
        );
    }

    public function getListingLabel()
    {
        return $this->getTranslator()->trans('Search results', [], 'Shop.Theme.Catalog');
    }
}
