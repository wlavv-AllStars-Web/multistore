<?php


declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once __DIR__.'/vendor/autoload.php';
use PrestaShop\Module\AsGroup\Form\Modifier\ProductFormModifier;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\Module\AsGroup\AGCustomKpi;

use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollectionInterface;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnInterface;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinitionInterface;
use PrestaShop\PrestaShop\Core\Grid\Exception\ColumnNotFoundException;
use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\AsGroup\Grid\Definition\Factory\CustomOrderGridDefinitionFactory;
use PrestaShop\AsGroup\Grid\Definition\Factory\OrderGridDefinitionFactory;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Query\OrderQueryBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\ValueObject\ManufacturerId;
use PrestaShop\PrestaShop\Core\Grid\Action\GridActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinition;

use PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton;

use PrestaShop\PrestaShop\Core\Grid\Filter\Filter;
use PrestaShop\PrestaShop\Core\Form\FormInterface; // If you use forms
use PrestaShop\PrestaShop\Core\Grid\Column\Type\ImageColumn;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AsGroup extends Module
{
    protected $toolbar_btn = [];
    
    public function __construct()
    {
        $this->name = 'asgroup';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('AsGroup');
        $this->description = $this->l('AsGroup module for modifications in the backoffice.');
        $this->ps_versions_compliancy = ['min' => '8.1', 'max' => _PS_VERSION_];
    }

    /**
     * @return bool
     */
    public function install()
    {
        return parent::install() &&
            // $this->registerHook(['displayHome']) &&
            $this->registerHook(['actionProductFormBuilderModifier']) &&
            $this->registerHook(['actionManufacturerFormBuilderModifier']) &&
            $this->registerHook(['actionProductSave']) &&
            // $this->registerHook(['actionManufacturerSave']) &&
            $this->registerHook('actionObjectManufacturerUpdateAfter') &&
            $this->registerHook('actionOrdersKpiRowModifier') &&
            $this->registerHook('actionCustomersKpiRowModifier') &&
            $this->registerHook('actionAdminControllerSetMedia') &&
            $this->registerHook('actionOrderGridDefinitionModifier') &&
            $this->registerHook('actionProductGridDefinitionModifier') &&
            $this->registerHook('actionProductGridDataModifier') &&
            $this->registerHook('actionProductGridQueryBuilderModifier') &&
            $this->registerHook('actionAdminOrdersControllerSaveBefore') &&
            $this->registerHook('actionDispatcherBefore') &&
            // $this->registerHook('actionAdminOrdersControllerView') &&
            // $this->registerHook('actionAdminOrderControllerSave') &&
            // $this->registerHook('actionOrderGridDataBefore') &&
            // $this->registerHook('actionOrderGridDataModifier') &&
            // $this->registerHook('actionGetAdminToolbarButtons') &&
            // $this->registerHook('displayAdminOrderCreateExtraButtons') &&
            // $this->registerHook('displayAdminOrder') &&
            $this->registerHook('actionOrderGridQueryBuilderModifier');
            // $this->registerHook('displayOrderPreview') &&
            // $this->registerHook('actionGetAdminOrderButtons');
    }

    public function uninstall()
{
    // Unregister all hooks
    return parent::uninstall() &&
        $this->unregisterHook('actionProductFormBuilderModifier') &&
        $this->unregisterHook('actionManufacturerFormBuilderModifier') &&
        $this->unregisterHook('actionProductSave') &&
        $this->unregisterHook('actionObjectManufacturerUpdateAfter') &&
        $this->unregisterHook('actionOrdersKpiRowModifier') &&
        $this->unregisterHook('actionCustomersKpiRowModifier') &&
        $this->unregisterHook('actionAdminControllerSetMedia') &&
        $this->unregisterHook('actionOrderGridDefinitionModifier') &&
        $this->unregisterHook('actionProductGridDefinitionModifier') &&
        $this->unregisterHook('actionProductGridDataModifier') &&
        $this->unregisterHook('actionProductGridQueryBuilderModifier') &&
        $this->unregisterHook('actionAdminOrdersControllerSaveBefore') &&
        $this->unregisterHook('actionOrderGridQueryBuilderModifier');
        $this->unregisterHook('actionDispatcherBefore');
}


    public function initContent()
    {
        parent::initContent();
        // your own code
    }
    /**
     * Modify product form builder
     *
     * @param array $params
     */


     public function hookActionDispatcherBefore(array $params)
    {
    //     // Get the container
    //     $container = $this->get('prestashop.adapter.legacy.context')->getContainer();

    //     // Override the default search provider with your custom one
    //     $container->set(
    //         'prestashop.core.product_search_provider',
    //         $container->get('PrestaShop\Module\AsGroup\Adapter\Search\CustomSearchProductSearchProvider')
    //     );
    }

    public function hookActionAdminControllerSetMedia()
    {
        $this->context->controller->addCss('/modules/asgroup/views/css/kpi.css');
        $this->context->controller->addCss('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=barcode');
        $this->context->controller->addJS('/modules/asgroup/views/js/orders.js');
    }
     
    // add input youtube code Product page in BO 

    public function hookActionManufacturerFormBuilderModifier(array $params)
    {
        $manufacturerId = isset($params['id']) ? (int) $params['id'] : null;
        $youtubeValue = '';
        $warrantyValues = [];
    
        if ($manufacturerId) {
            // Retrieve the YouTube value
            $sql = 'SELECT youtube FROM `' . _DB_PREFIX_ . 'manufacturer`
                    WHERE id_manufacturer = ' . (int) $manufacturerId;
            $youtubeValue = Db::getInstance()->getValue($sql);
    
            // Retrieve the warranty values for all languages
            $sql = 'SELECT id_lang, warranty FROM `' . _DB_PREFIX_ . 'manufacturer_lang`
                    WHERE id_manufacturer = ' . (int) $manufacturerId;
            $warrantyResults = Db::getInstance()->executeS($sql);
    
            // Format warranty data into an associative array (id_lang => warranty_text)
            foreach ($warrantyResults as $row) {
                $warrantyValues[(int) $row['id_lang']] = $row['warranty'];
            }

            $sql = 'SELECT available_to_buy
            FROM
            `' . _DB_PREFIX_ . 'manufacturer` 
            WHERE id_manufacturer= '. (int) $manufacturerId;
    
            $availableToBuy = Db::getInstance()->getValue($sql);
            // pre($availableToBuy);
            $availableToBuy = ($availableToBuy == 2) ? 1 : $availableToBuy;
        }



        /** @var FormBuilderInterface $formBuilder */
        $formBuilder = $params['form_builder'];

        $formBuilder->add(
            'youtube', 
            TextType::class,
            [
                // you can remove the label if you dont need it by passing 'label' => false
                'label' => $this->trans('Youtube Code', [], 'Modules.ASGroup.Admin'),
                'required' => false,
                'data' => $youtubeValue,
            ]
        );

        $formBuilder->add(
            'warranty', 
            TranslatableType::class,
            [
                'type' => TextareaType::class,
                'label' => $this->trans('Warranty', [], 'Modules.ASGroup.Admin'),
                'required' => false,
                'options' => [
                    'attr' => [
                        'class' => 'custom-class', // Optional: Add CSS class
                        'rows' => 3, // Optional: Define textarea size
                    ],
                ],
                'data' => $warrantyValues,
            ]
        );

        $formBuilder->add(
            'available_to_buy', 
            SwitchType::class,
            [
                'choices' => [
                    $this->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $availableToBuy,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->trans('Allow buying from this brand',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->trans('This will let or not let buy the products of this brand in the frontoffice.',[], 'Admin.Catalog.Help'),
            ]
        );


    }

    public function hookActionObjectManufacturerUpdateAfter(array $params)
    {
        $manufacturer = $params['object'];
        // Get the manufacturer object that was updated
        $manufacturerId = $manufacturer->id;
        
        // Get the YouTube code from the form submission
        $manufacturerData = Tools::getValue('manufacturer');
        $youtube_code = $manufacturerData['youtube']; 

        // echo '<pre>'.print_r($manufacturerData,true).'</pre>';
        // echo $manufacturer->id;
        // echo $youtube_code;
        // exit;
        // If the YouTube code is set, update it in the database
        if ($youtube_code) {
            // Sanitize and update the manufacturer YouTube field
            $sql = 'UPDATE `' . _DB_PREFIX_ . 'manufacturer`
                    SET youtube = "' . pSQL($youtube_code) . '"
                    WHERE id_manufacturer = ' . (int) $manufacturerId;
            
            // Execute the query
            $result = Db::getInstance()->execute($sql);
    
            if (!$result) {
                error_log('Failed to update YouTube code for manufacturer ID: ' . $manufacturerId);
            } else {
                error_log('YouTube code updated successfully for manufacturer ID: ' . $manufacturerId);
            }
        } 

        $warrantyData = isset($manufacturerData['warranty']) ? $manufacturerData['warranty'] : [];

        if (!empty($warrantyData) && is_array($warrantyData)) {
            foreach ($warrantyData as $idLang => $warrantyText) {
                $sql = 'INSERT INTO `' . _DB_PREFIX_ . 'manufacturer_lang` (`id_manufacturer`, `id_lang`, `warranty`) 
                        VALUES (' . $manufacturerId . ', ' . (int) $idLang . ', "' . pSQL($warrantyText) . '")
                        ON DUPLICATE KEY UPDATE warranty = "' . pSQL($warrantyText) . '"';
                Db::getInstance()->execute($sql);
            }
        }

        $outofstockData = $manufacturerData['available_to_buy']; 

        if (isset($outofstockData)) {
            $sql = 'UPDATE `' . _DB_PREFIX_ . 'manufacturer`
                    SET available_to_buy = "' . $outofstockData . '"
                    WHERE id_manufacturer = ' . (int) $manufacturerId;
            
            // Execute the query
            $resultOutofstock = Db::getInstance()->execute($sql);
    
            if (!$resultOutofstock) {
                error_log('Failed to update YouTube code for manufacturer ID: ' . $manufacturerId);
            } else {
                error_log('YouTube code updated successfully for manufacturer ID: ' . $manufacturerId);
            }

            // update product table out of stock to display the same as the brand available to buy
            $sql = 'UPDATE `' . _DB_PREFIX_ . 'product`
                    SET out_of_stock = "' . $outofstockData . '"
                    WHERE id_manufacturer = ' . (int) $manufacturerId;

            $resultOutofstockProduct = Db::getInstance()->execute($sql);

            if (!$resultOutofstockProduct) {
                error_log('Failed to update out_of_stock in the products table where the manufacturer is: ' . $manufacturerId);
            } else {
                error_log('Products table updated sucessfully: ' . $manufacturerId);
            }

            // get products id from id manufacturer
            $sql = 'SELECT id_product FROM `' . _DB_PREFIX_ . 'product` WHERE id_manufacturer = ' . (int) $manufacturerId;
            $productIds = Db::getInstance()->executeS($sql);

            if (!empty($productIds)) {
                // Extract IDs into an array
                $productIdsArray = array_column($productIds, 'id_product');
                
                // Convert array to comma-separated values for SQL IN clause
                $productIdsList = implode(',', array_map('intval', $productIdsArray));
            
                // Now update stock availability for these products
                $updateSql = 'UPDATE `' . _DB_PREFIX_ . 'stock_available`
                              SET out_of_stock = "' . (int) $outofstockData . '"
                              WHERE id_product IN (' . $productIdsList . ')';
            
                $resultOutofstockProduct = Db::getInstance()->execute($updateSql);
            
                if (!$resultOutofstockProduct) {
                    error_log('Failed to update out_of_stock for manufacturer ID: ' . $manufacturerId);
                } else {
                    error_log('Stock availability updated for products of manufacturer ID: ' . $manufacturerId);
                }
            } else {
                error_log('No products found for manufacturer ID: ' . $manufacturerId);
            }

        }


    }
    


    public function hookActionProductFormBuilderModifier(array $params): void
    {
        /** @var ProductFormModifier $productFormModifier */
        $productId = isset($params['id']) ? new ProductId((int) $params['id']) : null;
        if ($productId) {
            $productFormModifier = $this->get(ProductFormModifier::class);
            $productFormModifier->modify($productId, $params['form_builder']);
        } else {
            error_log('Product ID is not set or invalid.');
        }
    }

    public function hookActionProductSave(array $params): void
    {
        // error_log('hookActionProductSave params: ' . print_r($params, true));
        // Please write your logic and operation and save the data as per your need
        // We are using configuration table to save the data
        $productData = Tools::getValue('product');
        $idProduct = $params['id_product'];


        if (isset($productData['asg']['reference'])) {
            Db::getInstance()->update('product', [
                'notes' => $productData['asg']['notes'] // No need to use pSQL() if it's HTML content
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or notes is not set.');
        }

        if (isset($productData['asg']['ean13'])) {
            Db::getInstance()->update('product', [
                'notes' => $productData['asg']['notes'] // No need to use pSQL() if it's HTML content
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or notes is not set.');
        }

        if (isset($productData['asg']['housing'])) {
            Db::getInstance()->update('product', [
                'notes' => $productData['asg']['notes'] // No need to use pSQL() if it's HTML content
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or notes is not set.');
        }
        
        // 1. Handle Short Description (in ps_product_lang)
        if (isset($productData['asg']['description_short']) && is_array($productData['asg']['description_short'])) {
            foreach ($productData['asg']['description_short'] as $idLang => $shortDesc) {
                // Save the raw HTML content (no escaping required)
                Db::getInstance()->update('product_lang', [
                    'description_short' => $shortDesc // No need to use pSQL() if it's HTML content
                ], 'id_product = ' . (int)$idProduct . ' AND id_lang = ' . (int)$idLang);
            }
        } else {
            error_log('Product data is not valid or description_short is not set.');
        }
    
        // 2. Handle Long Description (in ps_product_lang)
        if (isset($productData['asg']['description_long']) && is_array($productData['asg']['description_long'])) {
            foreach ($productData['asg']['description_long'] as $idLang => $longDesc) {
                // Save the raw HTML content (no escaping required)
                Db::getInstance()->update('product_lang', [
                    'description' => $longDesc // No need to use pSQL() if it's HTML content
                ], 'id_product = ' . (int)$idProduct . ' AND id_lang = ' . (int)$idLang);
            }
        } else {
            error_log('Product data is not valid or description_long is not set.');
        }


        if (isset($productData['asg']['notes'])) {
            Db::getInstance()->update('product', [
                'notes' => $productData['asg']['notes'] // No need to use pSQL() if it's HTML content
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or notes is not set.');
        }

        if (isset($productData['asg']['visibility'])) {
            Db::getInstance()->update('product', [
                'visibility' => $productData['asg']['visibility'] // No need to use pSQL() if it's a predefined enum
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or visibility is not set.');
        }

        if (isset($productData['asg']['wmpackqt']) && is_numeric($productData['asg']['wmpackqt'])) {
            Db::getInstance()->update('product', [
                'wmpackqt' => (int)$productData['asg']['wmpackqt'] // Ensure the value is cast to an integer
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or wmpackqt is not set.');
        }

        if (isset($productData['asg']['ec_approved']) && is_bool($productData['asg']['ec_approved'])) {
            Db::getInstance()->update('product', [
                'ec_approved' => (int)$productData['asg']['ec_approved'] // Convert to integer (0 or 1)
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or ec_approved is not set.');
        }

        if (isset($productData['asg']['wmdeprecated']) && is_bool($productData['asg']['wmdeprecated'])) {
            Db::getInstance()->update('product', [
                'wmdeprecated' => (int)$productData['asg']['wmdeprecated'] // Convert to 1 (true) or 0 (false)
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or wmdeprecated is not set.');
        }

        if (isset($productData['asg']['not_to_order']) && in_array($productData['asg']['not_to_order'], [0, 1], true)) {
            Db::getInstance()->update('product', [
                'not_to_order' => (int)$productData['asg']['not_to_order'] // Store 0 or 1 based on the flag
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or not_to_order is not set.');
        }

        if (isset($productData['asg']['show_compat_exception']) && in_array($productData['asg']['show_compat_exception'], [0, 1], true)) {
            Db::getInstance()->update('product', [
                'show_compat_exception' => (int)$productData['asg']['show_compat_exception'] // Store 0 or 1
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or show_compat_exception is not set.');
        }

        if (isset($productData['asg']['universal']) && in_array($productData['asg']['universal'], [0, 1], true)) {
            Db::getInstance()->update('product', [
                'universal' => (int)$productData['asg']['universal'] // Store 0 or 1
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or universal is not set.');
        }

        if (isset($productData['asg']['youtube_1']) && !empty($productData['asg']['youtube_1'])) {
            // If youtube_1 is a valid URL or string, update it
            $youtubeUrl = pSQL($productData['asg']['youtube_1']); // Sanitize the URL or string
            Db::getInstance()->update('product', [
                'youtube_1' => $youtubeUrl // Store sanitized URL or string
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or youtube_1 is not set.');
        }

        if (isset($productData['asg']['youtube_2']) && !empty($productData['asg']['youtube_2'])) {
            // If youtube_2 is a valid URL or string, update it
            $youtubeUrl = pSQL($productData['asg']['youtube_2']); // Sanitize the URL or string
            Db::getInstance()->update('product', [
                'youtube_2' => $youtubeUrl // Store sanitized URL or string
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or youtube_2 is not set.');
        }


        if (isset($productData['asg']['nc']) && is_numeric($productData['asg']['nc'])) {
            // Ensure the value is cast to an integer
            $ncValue = (int)$productData['asg']['nc'];

            Db::getInstance()->update('product', [
                'nc' => $ncValue // Store the numeric value
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or nc is not set.');
        }

        if (isset($productData['asg']['difficulty']) && is_numeric($productData['asg']['difficulty'])) {
            // Ensure the value is cast to an integer
            $difficultyValue = (int)$productData['asg']['difficulty'];

            Db::getInstance()->update('product', [
                'difficulty' => $difficultyValue // Store the numeric value
            ], 'id_product = ' . (int)$idProduct);
        } else {
            error_log('Product data is not valid or difficulty is not set.');
        }

        // Assuming $productData contains the tags for each language and $productId is the current product ID

        // Assuming $productData contains the tags for each language and $productId is the current product ID

            // Assuming $productData contains the tags for each language and $productId is the current product ID

            foreach ($productData['asg']['tags'] as $langId => $tagsString) {
                if (isset($tagsString) && !empty($tagsString)) {
                    // Step 1: Convert the string of tags into an array
                    $tags = explode(',', $tagsString);
                    $tags = array_map('trim', $tags); // Trim whitespace from each tag
                    
                    foreach ($tags as $tag) {
                        // Step 2: Check if the product-tag association already exists
                        $existingAssociation = Db::getInstance()->getRow(
                            'SELECT id_product_tag 
                            FROM ' . _DB_PREFIX_ . 'product_tag 
                            WHERE id_product = ' . (int)$productId . ' 
                            AND id_lang = ' . (int)$langId . ' 
                            AND id_tag IN (SELECT id_tag FROM ' . _DB_PREFIX_ . 'tag WHERE name = "' . pSQL($tag) . '" AND id_lang = ' . (int)$langId . ')'
                        );

                        // If the association exists, skip it
                        if ($existingAssociation) {
                            continue;
                        }

                        // Step 3: Check if the tag exists in ps_tag table for the given language
                        $existingTag = Db::getInstance()->getRow(
                            'SELECT id_tag FROM ' . _DB_PREFIX_ . 'tag WHERE name = "' . pSQL($tag) . '" AND id_lang = ' . (int)$langId
                        );

                        if ($existingTag) {
                            // If the tag exists, use its id_tag
                            $idTag = (int)$existingTag['id_tag'];
                        } else {
                            // If the tag doesn't exist, insert it into ps_tag
                            Db::getInstance()->insert(
                                _DB_PREFIX_ . 'tag',
                                [
                                    'name' => pSQL($tag),
                                    'id_lang' => (int)$langId,
                                ]
                            );

                            // Get the ID of the newly inserted tag
                            $idTag = Db::getInstance()->Insert_ID();
                        }

                        // Step 4: Insert the product-tag association into ps_product_tag
                        Db::getInstance()->insert(
                            _DB_PREFIX_ . 'product_tag',
                            [
                                'id_product' => (int)$productId,
                                'id_tag' => (int)$idTag,
                                'id_lang' => (int)$langId,
                            ]
                        );
                    }
                }
            }


        // 
        // 
        // 

        if (is_array($productData) && isset($productData['description']['real_photos'])){
            $real_photos = $productData['description']['real_photos'];
            $idProduct = $params['id_product'];

            Db::getInstance()->update('product', [
                'real_photos' => pSQL($real_photos),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or real_photos is not set.');
        }

        if (is_array($productData) && isset($productData['description']['youtube_1'])){
            $youtube_1 = $productData['description']['youtube_1'];
            $idProduct = $params['id_product'];
        
            Db::getInstance()->update('product', [
                'youtube_1' => pSQL($youtube_1),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or youtube_code is not set.');
        }

        if (is_array($productData) && isset($productData['description']['youtube_2']) ){
            $youtube_2 = $productData['description']['youtube_2'];
            $idProduct = $params['id_product'];
           
            Db::getInstance()->update('product', [
                'youtube_2' => pSQL($youtube_2),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or youtube_2 is not set.');
        }

        if (is_array($productData) && isset($productData['description']['hs_code']) ){
            $hs_code = $productData['description']['hs_code'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'nc' => pSQL($hs_code),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or youtube_2 is not set.');
        }

        if (is_array($productData) && isset($productData['shipping']['dim_verify'])){
            $dim_verify = $productData['shipping']['dim_verify'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'dim_verify' => pSQL($dim_verify),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or dim_verify is not set.');
        }

        if (is_array($productData) && isset($productData['description']['wmdeprecated'])){
            $wmdeprecated = $productData['description']['wmdeprecated'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'wmdeprecated' => pSQL($wmdeprecated),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or wmdeprecated is not set.');
        }

        if (is_array($productData) && isset($productData['details']['housing'])){
            $housing = $productData['details']['housing'];
            $idProduct = $params['id_product'];

            Db::getInstance()->update('product', [
                'housing' => pSQL($housing),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or housing is not set.');
        }

        if (is_array($productData) && isset($productData['description']['not_to_order'])){
            $not_to_order = $productData['description']['not_to_order'];
            $idProduct = $params['id_product'];
           
            Db::getInstance()->update('product', [
                'not_to_order' => pSQL($not_to_order),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or not_to_order is not set.');
        }

        if (is_array($productData) && isset($productData['description']['difficulty'])){
            $difficulty = $productData['description']['difficulty'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'difficulty' => pSQL($difficulty),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or difficulty is not set.');
        }

        if (is_array($productData) && isset($productData['description']['ec_approved'])){
            $ec_approved = $productData['description']['ec_approved'];
            $idProduct = $params['id_product'];
           
            Db::getInstance()->update('product', [
                'ec_approved' => pSQL($ec_approved),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or ec_approved is not set.');
        }

        if (is_array($productData) && isset($productData['description']['universal'])){
            $universal = $productData['description']['universal'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'universal' => pSQL($universal),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or universal is not set.');
        }


        if (is_array($productData) && isset($productData['description']['disallow_stock'])){
            $disallow_stock = $productData['description']['disallow_stock'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'disallow_stock' => pSQL($disallow_stock),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or disallow_stock is not set.');
        }

        // pre($productData);

        if (is_array($productData) && isset($productData['shipping']['dimensions']['weight'])){
            $weight = $productData['shipping']['dimensions']['weight'];
            $idProduct = $params['id_product'];
            
            Db::getInstance()->update('product', [
                'weight' => pSQL($weight),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or weight is not set.');
        }
    }


    // ----------

    // orders page BO


    public function hookActionOrdersKpiRowModifier($params)
    {
        $params['kpis'] = [];

        $params['kpis'][] = new AGCustomKpi(); 
    }

    public function hookActionCustomersKpiRowModifier($params)
    {
        $params['kpis'] = [];

        $params['kpis'][] = new AGCustomKpi(); 
    }

    public function hookActionProductGridDefinitionModifier(array $params)
    {
        if (empty($params['definition'])) {
            return;
        }

        $shopContext = $this->context->cookie->shopContext; 

        /** @var PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinitionInterface $definition */
        $definition = $params['definition'];

        // pre($definition);
        // pre($this->context->shop);
        // pre($this->context->cookie);

        // remove column category
        $definition->getColumns()->remove('category'); 
        $definition->getColumns()->remove('final_price_tax_excluded'); 
        $definition->getColumns()->remove('price_tax_included');
         
        if(!empty($shopContext)){
            $definition->getColumns()->remove('associated_shops');
        }


        $definition->getFilters()->remove('category'); 
        $definition->getFilters()->remove('final_price_tax_excluded'); 
        $definition->getFilters()->remove('price_tax_included'); 
        


        // 


        if(!empty($shopContext)){
            $definition
            ->getColumns()
            ->addAfter(
                'id_product',
                (new PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ImageColumn('shop'))
                    ->setName($this->l('Shop'))
                    ->setOptions([
                        'src_field' => 'shop', // This should match the field in hookActionProductGridDataModifier
                        'clickable' => false,
                    ])
            );
        }else{
            $definition
            ->getColumns()
            ->addAfter(
                'id_product',
                (new DataColumn('associated_shops'))
                    ->setName($this->l('Store`s'))
                    ->setOptions([
                        'field' => 'associated_shops', // This should match the field in hookActionProductGridDataModifier
                        'clickable' => false,
                    ])
            );
        }


        


        // pre($definition->getColumns());


        $definition
        ->getColumns()
        ->addAfter(
            'reference',
            (new DataColumn('created_at'))
                ->setName($this->l('Created'))
                ->setOptions([
                    'field' => 'created_at',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'created_at',
            (new DataColumn('manufacturer_name'))
                ->setName($this->l('Manufacturer'))
                ->setOptions([
                    'field' => 'manufacturer_name',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                ])
        );
        $definition
        ->getColumns()
        ->addAfter(
            'manufacturer_name',
            (new DataColumn('housing'))
                ->setName($this->l('Housing'))
                ->setOptions([
                    'field' => 'housing',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'housing',
            (new DataColumn('ean13'))
                ->setName($this->l('Ean13'))
                ->setOptions([
                    'field' => 'ean13',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'ean13',
            (new DataColumn('dim_verify'))
                ->setName($this->l('Size'))
                ->setOptions([
                    'field' => 'dim_verify',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'dim_verify',
            (new DataColumn('stock_arrive'))
                ->setName($this->l('Arrive'))
                ->setOptions([
                    'field' => 'stock_arrive',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'stock_arrive',
            (new DataColumn('rrp'))
                ->setName($this->l('RRP'))
                ->setOptions([
                    'field' => 'rrp',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                    'sortable' => true,
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'rrp',
            (new DataColumn('margin'))
                ->setName($this->l('Margin'))
                ->setOptions([
                    'field' => 'margin',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                ])
        );

        $definition
        ->getColumns()
        ->addAfter(
            'margin',
            (new DataColumn('discount'))
                ->setName($this->l('Discount'))
                ->setOptions([
                    'field' => 'discount',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                    'clickable' => false,
                ])
        );




        // filter product grid


        /** @var PrestaShop\PrestaShop\Adapter\Form\ChoiceProvider\ManufacturerNameByIdChoiceProvider $manufacturerNameByIdChoiceProvider */
        $manufacturerNameByIdChoiceProvider = $this->get('prestashop.adapter.form.choice_provider.manufacturer_name_by_id');

        // $definition->getFilters()->add(
        //     (new PrestaShop\PrestaShop\Core\Grid\Filter\Filter('manufacturer_name', Symfony\Component\Form\Extension\Core\Type\ChoiceType::class))
        //         ->setAssociatedColumn('manufacturer_name')
        //         ->setTypeOptions([
        //             'required' => false,
        //             'choices' => $manufacturerNameByIdChoiceProvider->getChoices(),
        //             'translation_domain' => false,
        //         ])
        // );

        $definition
        ->getFilters()
        ->add((new Filter('manufacturer_name', ChoiceType::class))
            ->setTypeOptions([
                'required' => false,
                'choices' => $manufacturerNameByIdChoiceProvider->getChoices(),
                'translation_domain' => false,
            ])
            ->setAssociatedColumn('manufacturer_name')
            );

        $definition
        ->getFilters()
        ->add((new Filter('housing', TextType::class))
            ->setTypeOptions([
                'required' => false,
                'attr' => [
                    'placeholder' => $this->trans('Housing', [], 'Admin.Actions'),
                ],
            ])
            ->setAssociatedColumn('housing')
            );

        $definition
        ->getFilters()
        ->add((new Filter('ean13', TextType::class))
            ->setTypeOptions([
                'required' => false,
                'attr' => [
                    'placeholder' => $this->trans('Ean13', [], 'Admin.Actions'),
                ],
            ])
            ->setAssociatedColumn('ean13')
            );

    }

    public function hookActionProductGridDataModifier(array &$params)
    {
        // if (empty($params['data']) || !Configuration::get(static::CONFIGURATION_KEY_SHOW_LOGO)) {
        //     return;
        // }
        $shopContext = $this->context->cookie->shopContext; 

        /** @var PrestaShop\PrestaShop\Core\Grid\Data\GridData $gridData */
        $gridData = $params['data'];
        $modifiedRecords = $gridData->getRecords()->all();

        /** @var PrestaShop\PrestaShop\Adapter\Manufacturer\ManufacturerLogoThumbnailProvider $manufacturerLogoThumbnailProvider */
        $manufacturerLogoThumbnailProvider = $this->get('prestashop.adapter.manufacturer.manufacturer_logo_thumbnail_provider');

        foreach ($modifiedRecords as $key => $data) {
            if (isset($data['id_manufacturer'])) {
                $modifiedRecords[$key]['manufacturer_logo'] = $manufacturerLogoThumbnailProvider->getPath($data['id_manufacturer']);
            }

            if(!empty($shopContext)){
                if(isset($data['shop'])){
                    // Get the shop's logo path
                    $logoFilename = Configuration::get('PS_LOGO', null, null, $data['shop']);
                
                    if ($logoFilename) {
                        $modifiedRecords[$key]['shop'] = _PS_BASE_URL_ . __PS_BASE_URI__ . 'img/' . $logoFilename;
                    } else {
                        // Provide a default logo if none is set
                        $modifiedRecords[$key]['shop'] = _PS_BASE_URL_ . __PS_BASE_URI__ . 'img/logo.jpg';
                    }
                }
            }

            // if($data['id_product'] === 18136){
            //     $price = (float) $data['price'];
            //     echo $price;
                // pre($data);
            // }
            if(empty($shopContext)){
                if (isset($data['associated_shops_ids']) && is_array($data['associated_shops_ids'])) {
                    $logos = [];
                    
                    foreach ($data['associated_shops_ids'] as $shopId) {
                        $logoFilename = Configuration::get('PS_LOGO', null, null, $shopId);
                        $shopLogoUrl = $logoFilename
                            ? _PS_BASE_URL_ . __PS_BASE_URI__ . 'img/' . $logoFilename
                            : _PS_BASE_URL_ . __PS_BASE_URI__ . 'img/logo.jpg'; // Default logo
                
                        // Store as HTML img tag
                        $logos[] = '<img src="' . htmlspecialchars($shopLogoUrl) . '" style="margin:2px;border-radius:5px;width:35px;height:fit-content;">';
                    }
                
                    // Join multiple images into a single string (for proper rendering)
                    $modifiedRecords[$key]['associated_shops'] = implode(' ', $logos);
                }
            }
            

            // pre($data);
            

            if(isset($data['created_at'])){
                $modifiedRecords[$key]['created_at'] = date('Y-m-d', strtotime($data['created_at']));
            }

            if(isset($data['dim_verify'])){
                $modifiedRecords[$key]['dim_verify'] = $data['dim_verify'] == 1
                ? '<i class="fa fa-check text-success"></i>'  
                : '<i class="fa fa-times text-danger"></i>'; 
            }

            if (isset($data['stock_arrive']) && $data['stock_arrive'] !== null && $data['stock_arrive'] !== 0) {
                $modifiedRecords[$key]['stock_arrive'] = (string) $data['stock_arrive']; // Convert to string to prevent "--"
            } else {
                $modifiedRecords[$key]['stock_arrive'] = '0'; // Explicitly set 0 instead of "--"
            }


            if(isset($data['wholesale_price']) && isset($data['price'])){
                $wholesalePrice = (float) $data['wholesale_price'];
                $price = (float) $data['price'];

                    if ($price > 0) {
                        $modifiedRecords[$key]['margin'] = number_format(-(($wholesalePrice / $price) - 1) * 100 , 0) . '%';
                    } else {
                        $modifiedRecords[$key]['margin'] = 'N/A'; // Avoid division by zero if price is 0
                    }
            }

            if(isset($data['price'])){
                $price = (float) $data['price'];
                $modifiedRecords[$key]['rrp'] = '€'.number_format($price, 2, '.', ' ');
            }

            if(isset($data['discount'])){
                $discount = (float) $data['discount'] * 100;
                $modifiedRecords[$key]['discount'] = number_format($discount, 0) . '%';
            }


        }

        $params['data'] = new PrestaShop\PrestaShop\Core\Grid\Data\GridData(
            new PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection($modifiedRecords),
            $gridData->getRecordsTotal(),
            $gridData->getQuery()
        );
    }


    public function hookActionProductGridQueryBuilderModifier(array $params)
    {
        if (empty($params['search_query_builder']) || empty($params['search_criteria'])) {
            return;
        }

        /** @var Doctrine\DBAL\Query\QueryBuilder $searchQueryBuilder */
        $searchQueryBuilder = $params['search_query_builder'];

        /** @var PrestaShop\PrestaShop\Core\Search\Filters\ProductFilters $searchCriteria */
        $searchCriteria = $params['search_criteria'];

        $searchQueryBuilder->addSelect(
            'p.`id_manufacturer`, man.`name` AS `manufacturer_name`, man.`id_manufacturer` AS `manufacturer_id`'
        );

        $searchQueryBuilder->leftJoin(
            'p',
            '`' . _DB_PREFIX_ . 'manufacturer`',
            'man',
            'man.`id_manufacturer` = p.`id_manufacturer`'
        );

        $searchQueryBuilder->addSelect(
            'sp.`reduction` AS `discount`'
        );

        $searchQueryBuilder->leftJoin(
            'p',
            '`' . _DB_PREFIX_ . 'specific_price`',
            'sp',
            'sp.`id_product` = p.`id_product`'
        );


        if ('manufacturer_name' === $searchCriteria->getOrderBy()) {
            $searchQueryBuilder->orderBy('man.`manufacturer_name`', $searchCriteria->getOrderWay());
        }

        if ('rrp' === $searchCriteria->getOrderBy()) {
            $searchQueryBuilder->orderBy('p.`price`', $searchCriteria->getOrderWay());
        }
        

        // pre($searchCriteria->getFilters());


        // Apply manufacturer_name filter
        foreach ($searchCriteria->getFilters() as $filterName => $filterValue) {
            if ('manufacturer_name' === $filterName) {
                // Use manufacturer_name for filtering, not manufacturer_id
                $searchQueryBuilder->andWhere('man.`id_manufacturer` LIKE :manufacturer_name');
                $searchQueryBuilder->setParameter('manufacturer_name', '%' . $filterValue . '%');  // Add % for LIKE query
            }

            if('housing' === $filterName){
                $searchQueryBuilder->andWhere('p.`housing` LIKE :housing');
                $searchQueryBuilder->setParameter('housing', '%' . $filterValue . '%');  // Add % for LIKE query
            }

            if('ean13' === $filterName){
                $searchQueryBuilder->andWhere('p.`ean13` LIKE :ean13');
                $searchQueryBuilder->setParameter('ean13', '' . $filterValue . '%');  // Add % for LIKE query
            }
        }

        // shop part product grid
        $searchQueryBuilder->addSelect(
            'p.`id_shop_default` AS `shop`',
            'p.`date_add` AS `created_at`',
            'p.`housing`',
            'p.`ean13`',
            'p.`dim_verify`',
            'p.`stock_arrive`',
            'p.`product_type`',
            'p.`price`',
            'p.`wholesale_price`',
            // 's.`discount_percentage` AS `discount`',
        );
    }


    public function hookActionOrderGridDefinitionModifier(array $params): void
    {
        error_log('hookActionOrderGridDefinitionModifier called');

        /** @var GridDefinitionInterface $orderGridDefinition */
        $orderGridDefinition = $params['definition'];

        $orderGridDefinition
        ->getColumns()
        ->addAfter(
            'total_paid_tax_incl',
            (new DataColumn('payment_id'))
                ->setName($this->l('Payment'))
                ->setOptions([
                    'field' => 'payment_id',
                    'attr' => [
                        'class' => 'text-center', 
                    ],
                ])
        );

        $orderGridDefinition
        ->getColumns()
        ->addAfter(
            'reference', // Adding after the 'total_paid' column
            (new DataColumn('product_reference'))
                ->setName($this->l('Products'))
                ->setOptions([
                    'field' => 'product_reference',
                ])
        );

        $orderGridDefinition
        ->getFilters()
        ->add(
            (new \PrestaShop\PrestaShop\Core\Grid\Filter\Filter('product_reference', TextType::class))
            ->setTypeOptions([
                'required' => false,
                'attr' => [
                    'placeholder' => $this->trans('Search product ref', [], 'Admin.Actions'),
                ],
            ])
            ->setAssociatedColumn('product_reference')
        );

        if(Context::getContext()->shop->id == 3){
            $choices[$this->l('Bank Transfer')] = 1;
            $choices[$this->l('Credit Card')] = 2;
        }else{
            $choices[$this->l('Bank Transfer')] = 'ps_wirepayment';
            $choices[$this->l('Ingenico')] = 'worldlineop';
            $choices[$this->l('Paypal')] = 'paypal';
            $choices[$this->l('Alma')] = 'alma';
        }




        $orderGridDefinition
        ->getFilters()
        ->add((new Filter('payment_id', ChoiceType::class))
            ->setTypeOptions([
                'required' => false,
                'choices' => $choices,
                'translation_domain' => false,
            ])
            ->setAssociatedColumn('payment_id')
            );
                
        // $orderGridDefinition
        // ->getFilters()
        // ->add(
        //     (new Filter('payment_id', TextType::class))
        //     ->setTypeOptions([
        //         'required' => false,
        //         'attr' => [
        //             'placeholder' => $this->trans('Payment', [], 'Admin.Actions'),
        //         ],
        //         'choices' => $choices,
        //     ])
        //     ->setAssociatedColumn('payment_id')
        // );



        $columns = $orderGridDefinition->getColumns();
        $columns->remove('new')
                ->remove('payment')
                ->remove('shop_name');

        $filters = $orderGridDefinition->getFilters();
        $filters->remove('new')
                ->remove('payment')
                ->remove('shop_name');




    }

    // public function hookActionOrderGridDataModifier(array $params)
    // {
    //     // Check if 'data' exists in the parameters
    //     if (isset($params['data'])) {
            
    //         $data = $params['data']; // This contains the rows fetched from the database

    //         foreach ($data as &$row) {
    //             // Modify the 'payment' field to display images based on payment_id
    //             switch ($row['payment_id']) {
    //                 case 1:
    //                     $row['payment'] = '<img src="path/to/image1.png" alt="Payment Image 1" style="width: 50px; height: auto;" />';
    //                     break;
    //                 case 2:
    //                     $row['payment'] = '<img src="path/to/image2.png" alt="Payment Image 2" style="width: 50px; height: auto;" />';
    //                     break;
    //                 default:
    //                     $row['payment'] = '<img src="path/to/default_image.png" alt="Default Payment Image" style="width: 50px; height: auto;" />';
    //                     break;
    //             }
    //         }
    //     } else {
    //         error_log('Warning: Undefined array key "data" in hookActionOrderGridDataModifier.');
    //     }
    // }

    public function hookActionOrderGridQueryBuilderModifier(array $params): void
    {
        error_log('hookActionOrderGridQueryBuilderModifier called');

        /** @var DoctrineQueryBuilder $searchQueryBuilder */
        $searchQueryBuilder = $params['search_query_builder'];

        $filters = $params['search_criteria']->getFilters();

        // echo '<pre>'.print_r(Context::getContext()->shop->id,true).'</pre>';
        // exit;


        

        $searchQueryBuilder->leftJoin(
            'o', // alias for order table
            _DB_PREFIX_ . 'order_detail', // table name
            'od', // alias for order_detail table
            'od.id_order = o.id_order' // join condition
        );

        $searchQueryBuilder->addSelect('GROUP_CONCAT(od.product_reference SEPARATOR ", ") AS product_reference');

        $imageCard = Context::getContext()->link->getMediaLink('/modules/asgroup/views/img/card.webp');
        $imageBank = Context::getContext()->link->getMediaLink('/modules/asgroup/views/img/bank.webp');
        $imageAlma = Context::getContext()->link->getMediaLink('/modules/asgroup/views/img/alma.webp');
        $imagePaypal = Context::getContext()->link->getMediaLink('/modules/asgroup/views/img/paypal.webp');

        if(Context::getContext()->shop->id == 3){

            $searchQueryBuilder->addSelect(
                '(CASE WHEN o.payment_id IS NULL THEN "Error"
                WHEN o.payment_id = 1 THEN CONCAT("<img src=\"'.$imageBank.'\" style=\"width: 60px; height: auto;\" />")
                WHEN o.payment_id = 2 THEN CONCAT("<img src=\"'.$imageCard.'\" style=\"width: 50px; height: auto;\" />")
                END) AS payment_id'

            );

        }else{

            $searchQueryBuilder->addSelect(
                '(CASE WHEN o.module IS NULL THEN "Error"
                WHEN o.module IN ("ps_wirepayment", "bankwire") THEN CONCAT("<img src=\"'.$imageBank.'\" style=\"width: 60px; height: auto;\" />")
                WHEN o.module IN ("worldlineop", "ogone") THEN CONCAT("<img src=\"'.$imageCard.'\" style=\"width: 50px; height: auto;\" />")
                WHEN o.module = "alma" THEN CONCAT("<img src=\"'.$imageAlma.'\" style=\"width: 50px; height: auto;\" />")
                WHEN o.module = "paypal" THEN CONCAT("<img src=\"'.$imagePaypal.'\" style=\"width: 50px; height: auto;\" />")
                END) AS payment_id'
                // 'o.payment_id AS payment_id'
            );
        }

        // echo '<pre>'.print_r($searchQueryBuilder,true).'</pre>';
        // exit;

        $searchQueryBuilder->groupBy('o.id_order');
        // Apply filtering if product_reference is set in the filters
        $likeComparisonFilters = [
            'reference' => 'o.`reference`',
            'product_reference' => 'od.`product_reference`',
            // 'payment_id' => 'o.payment_id`'
        ];


        // echo '<pre>'.print_r($searchQueryBuilder->addSelect('o.payment_id AS payment_id'),true).'</pre>';
        // exit;
       

        foreach ($filters as $filterName => $filterValue) {
            if (array_key_exists($filterName, $likeComparisonFilters)) {
                $alias = $likeComparisonFilters[$filterName];
                    $searchQueryBuilder->andWhere("$alias LIKE :$filterName")
                        ->setParameter($filterName, '%' . $filterValue . '%');
            }

            if(Context::getContext()->shop->id == 3){
                if ($filterName === 'payment_id' && !empty($filterValue)) {
                    $searchQueryBuilder->andWhere('o.payment_id = :payment_id')
                        ->setParameter('payment_id', $filterValue);
                }
            }else{
                if ($filterName === 'payment_id' && !empty($filterValue)) {
                    if ($filterValue === 'worldlineop') { // User selected Ingenico
                        $searchQueryBuilder->andWhere('o.module IN (:payment_id)')
                            ->setParameter('payment_id', ['worldlineop', 'ogone'], \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
                    }elseif($filterValue === 'ps_wirepayment'){
                        $searchQueryBuilder->andWhere('o.module IN (:payment_id)')
                            ->setParameter('payment_id', ['ps_wirepayment', 'bankwire'], \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
                    } else {
                        $searchQueryBuilder->andWhere('o.module = :payment_id')
                            ->setParameter('payment_id', $filterValue);
                    }
                }
            }
        }

    }

    // modules/asgroup/asgroup.php

    public function getCustomerData($customerId)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'customer WHERE id_customer = ' . (int)$customerId;
    
        return Db::getInstance()->getRow($sql);
    }
    
    public function hookActionAdminOrdersControllerSaveBefore($params)
    {
        $orderId = (int)$params['id_order'];

        // Fetch the order using PrestaShop Order class
        $order = new \Order($orderId);

        if ($order->id) {
            // Get customer data
            $customerData = $this->getCustomerData($order->id_customer);

            if ($customerData) {
                $idDefaultGroup = $customerData['id_default_group'];

                // Assign to the Smarty context
                $this->context->smarty->assign('idDefaultGroup', $idDefaultGroup);
            }
        }
    }

    public function ajaxProcessUpdateOrderTracking()
    {
        $var1 = Tools::getValue('order_id');

        echo $var1;
        exit;
        // your action code ....
    }

    protected function fetchTemplate($tpl, $customVars = [], $configOptions = [])
    {
        if (Tools::getValue('getmodelsbrand')) {
            $this->ajaxProcessGetModels();
        }
        $this->context->smarty->assign([
            'ps_major_version' => Tools::substr(str_replace('.', '', _PS_VERSION_), 0, 2),
            'module_name' => $this->name,
            'module_path' => $this->_path,
            'current_iso_lang' => $this->context->language->iso_code,
            'current_id_lang' => (int)$this->context->language->id,
            'options' => $configOptions,
            // 'base_config_url' => $this->baseConfigUrl,
        ]);
        if (!empty($customVars)) {
            foreach ($customVars as $key => $value) {
                $this->context->smarty->assign($key, $value);
            }
        }
        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->name . '/views/templates/admin/' . $tpl);
    }


public function getASGProductCreation($product) {
    $storeId = $this->context->shop->id;
    
    $baseUrl = $this->context->link->getBaseLink();


    // Get Symfony services
    $formFactory = SymfonyContainer::getInstance()->get('form.factory');
    $twig = SymfonyContainer::getInstance()->get('twig');
    $formRenderer = $twig->getRuntime(\Symfony\Component\Form\FormRenderer::class);

    // Get available languages
    $languages = $this->context->controller->getLanguages();
    
    // Initialize the default values array (empty for now)
    $defaultValues = [];
    
    // Populate the default values array with empty strings for each language
    foreach ($languages as $lang) {
        $defaultValues[$lang['iso_code']] = ''; // Empty string or existing value
    }

    // Render the template with the languages and default values
    return $this->fetchTemplate('product_creation_custom.tpl', [
        'product' => $product,
        'shop_id' => $storeId,
        'languages' => $languages,
        'defaultValues' => $defaultValues,
        'base_url' => $baseUrl,
    ]);
}



    public function getCompatsCars($product) {
        // get brands compat

        

        $key = 'DSuqgsPKdWGM7oyc77z759DAGtYhd1c3Ryr5UvdjrXmIepwfqBGOlYRPvW7Ba0XgvxBZJ8eeXtiaehD2yLHwGf2fSQfIh3iDtf9i115YQIbMqtmfBPrCUMxeqVt0Ua1iB6FuTeQ2cES8UUYcTVcIFir6f8Xh5TrXFr9UBzHuqbSKpZWFcuzeWCFyK0GqeZuLL7apgoTzdJjwcrI1sf0BmqBItDPBljAaBeG0Pcb5Z8HlyPbalUqKABCMW9i5sseA';
        $keyFront = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
        
        $storeId = $this->context->shop->id;

        $url = 'https://webtools.euromuscleparts.com/api/get/bo/brands/'.$storeId.'/'.$key;

        $urlCompats = 'https://webtools.euromuscleparts.com/api/get/product/compats/'.$product->id .'/'.$storeId.'/'.$keyFront;

        // pre($product);

        // $adminUrl = $this->context->link->getAdminLink('AsGroup', true) . '&action=getmodelsbrand';

        // $adminUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . __PS_BASE_URI__ . 'modules/asgroup/asgroup.php';



        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);

        $ch2 = curl_init();
        curl_setopt($ch2,CURLOPT_URL,$urlCompats);
        curl_setopt($ch2,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch2,CURLOPT_CONNECTTIMEOUT, 4);
        $compats = curl_exec($ch2);
        curl_close($ch2);

        // Decode JSON string into an associative array
        $brands = json_decode($json, true);
        $compats = json_decode($compats, true);
        // pre($compats);

        return $this->fetchTemplate('compats_admin_cars.tpl',[
            'product' => $product,
            'brands'  => isset($brands['data']) ? $brands['data'] : [],
            'compats' => isset($compats['data']) ? $compats['data'] : [],
            'shop_id' => $storeId,
            'key'   => $key,
            'admin_url' => $this->context->link->getAdminLink('AdminModules', true, [], [
                    'configure' => $this->name,
                    'action' => 'getModels',
                ]),
        ]);
        
    }

    public function getModelsFromBrand($brand, $shop_id, $key)
    {
        // Build the API URL
        $url = 'https://webtools.euromuscleparts.com/api/get/bo/models/' . $brand . '/' . $shop_id . '/' . $key;

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

        $html_models = '';
        $html_models .= '<option selected>Model</option>';
        foreach ($data['data'] as $key => $model) {
            $html_models .= '<option data-brand="'.$brand.'" value="'.$model['id_model'].'">'.$model['name'].'</option>';
        };

        $data['html_brands'] = $html_models;

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function getTypesFromModel($brand,$modelV,$shop_id, $key)
    {
        // Build the API URL
        $url = 'https://webtools.euromuscleparts.com/api/get/bo/types/' . $brand . '/'.$modelV.'/' . $shop_id . '/' . $key;
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

        $html_models = '';
        $html_models .= '<option selected>Type</option>';
        foreach ($data['data'] as $key => $model) {
            $html_models .= '<option data-brand="'.$brand.'" data-model="'.$modelV.'" value="'.$model['id_type'].'">'.$model['name'].'</option>';
        };

        $data['html_brands'] = $html_models;

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function getVersionsFromTypes($brand,$modelV,$type,$shop_id, $key)
    {
        // Build the API URL
        $url = 'https://webtools.euromuscleparts.com/api/get/bo/versions/' . $brand . '/'.$modelV.'/'.$type.'/' . $shop_id . '/' . $key;
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

        $html_models = '';
        $html_models .= '<option selected>Version</option>';
        foreach ($data['data'] as $key => $model) {
            $html_models .= '<option data-brand="'.$brand.'" data-model="'.$modelV.'" data-type="'.$type.'" value="'.$model['id_version'].'">'.$model['name'].'</option>';
        };

        $data['html_brands'] = $html_models;

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function saveCompat($brand, $model, $type, $version, $product,$shop_id, $key) {
        $url = 'https://webtools.euromuscleparts.com/api/create/bo/compats/' . $brand . '/'.$model.'/'.$type.'/'.$version.'/'.$product.'/' . $shop_id . '/' . $key;

        $keyFront = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
        $urlCompats = 'https://webtools.euromuscleparts.com/api/get/product/compats/'.$product .'/'.$shop_id.'/'.$keyFront;
        
        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);

        // Execute cURL request
        $res = curl_exec($ch);
        curl_close($ch);

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $urlCompats);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 4);

        // Execute cURL request
        $compats = curl_exec($ch2);
        curl_close($ch2);

        // Decode the response into an associative array
        $data = json_decode($res, true);
        $comp = json_decode($compats, true);
       

        $tableCompats = '';
        foreach ($comp['data'] as $key => $compat) {
            $tableCompats .= '<tr>
                                    <td>'.$compat["brand"].'</td>
                                    <td>'.$compat["model"].'</td>
                                    <td>'.$compat["type"].'</td>
                                    <td>'.$compat["version"].'</td>
                                    <td style="text-align: center;"><i class="material-icons" onclick="deleteCompat('.$compat["id_compat"].',this)">delete</i></td>
                                </tr>';
        };

        $data['compats'] = $tableCompats;


        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function deleteCompat($id_compat, $product, $shop_id) {
        $key = 'DSuqgsPKdWGM7oyc77z759DAGtYhd1c3Ryr5UvdjrXmIepwfqBGOlYRPvW7Ba0XgvxBZJ8eeXtiaehD2yLHwGf2fSQfIh3iDtf9i115YQIbMqtmfBPrCUMxeqVt0Ua1iB6FuTeQ2cES8UUYcTVcIFir6f8Xh5TrXFr9UBzHuqbSKpZWFcuzeWCFyK0GqeZuLL7apgoTzdJjwcrI1sf0BmqBItDPBljAaBeG0Pcb5Z8HlyPbalUqKABCMW9i5sseA';
        $urlCompatRemove = 'https://webtools.euromuscleparts.com/api/remove/bo/compats/'.$id_compat.'/'.$product .'/'.$shop_id.'/'.$key;

        
        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlCompatRemove);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);

        // Execute cURL request
        $res = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($res, true);

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function ajaxProcessGetModels()
    {   

        $brand = Tools::getValue('brand');
        $shop_id = Tools::getValue('shop_id');
        $key = Tools::getValue('key');
        $model = Tools::getValue('model');
        $type = Tools::getValue('type');
        $version = Tools::getValue('version');
        $product = Tools::getValue('product');
        $id_compat = Tools::getValue('id_compat');
    
        $models= '';
        
        // Example: call your API to fetch models based on the brand
        if(Tools::getValue('getmodelsbrand')){
            $models = $this->getModelsFromBrand($brand, $shop_id, $key);
        }

        if(Tools::getValue('getTypesbrand')){
            $models = $this->getTypesFromModel($brand,$model, $shop_id, $key);
        }

        if(Tools::getValue('getVersionsbrand')){
            $models = $this->getVersionsFromTypes($brand, $model, $type, $shop_id, $key);
        }

        if(Tools::getValue('saveCompat')){
            $models = $this->saveCompat($brand, $model, $type, $version, $product, $shop_id, $key);
        }

        if(Tools::getValue('deleteCompat')){
            $models = $this->deleteCompat($id_compat, $product, $shop_id);
        }


        die(json_encode($models));
        
    }
}