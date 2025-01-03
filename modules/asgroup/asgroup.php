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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            $this->registerHook('actionAdminOrdersControllerSaveBefore') &&
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
        $this->unregisterHook('actionAdminOrdersControllerSaveBefore') &&
        $this->unregisterHook('actionOrderGridQueryBuilderModifier');
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

        if ($manufacturerId) {
            $sql = 'SELECT youtube
                    FROM `' . _DB_PREFIX_ . 'manufacturer`
                    WHERE id_manufacturer = ' . (int) $manufacturerId;
            $youtubeValue = Db::getInstance()->getValue($sql); 
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

        

        // $manufacturerData = Tools::getValue('manufacturer');

        
        // if ($manufacturerData) {


        //     if (isset($manufacturerData['youtube'])){

        //         $youtube_code = $manufacturerData['youtube'];

        //         $result = Db::getInstance()->update(
        //             'manufacturer', 
        //             ['youtube' => pSQL($youtube_code)], 
        //             'id_manufacturer = ' . (int) $manufacturerId
        //         );
                
        //         if (!$result) {
        //             error_log('Update Error: ' . Db::getInstance()->getMsgError());
        //         } else {
        //             error_log('Manufacturer updated successfully.');
        //         }

        //     }else{
        //         error_log('Product data is not valid or youtube_code is not set.');
        //     }
        // }

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
        } else {
            error_log('YouTube code is not set for manufacturer ID: ' . $manufacturerId);
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

        if (is_array($productData) && isset($productData['description']['youtube_code'])){
            $youtube_code = $productData['description']['youtube_code'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'youtube_code' => pSQL($youtube_code),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or youtube_code is not set.');
        }

        if (is_array($productData) && isset($productData['description']['youtube_code2']) ){
            $youtube_code2 = $productData['description']['youtube_code2'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'youtube_2' => pSQL($youtube_code2),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or youtube_2 is not set.');
        }

        if (is_array($productData) && isset($productData['description']['hs_code']) ){
            $hs_code = $productData['description']['hs_code'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'nc' => pSQL($hs_code),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or youtube_2 is not set.');
        }

        if (is_array($productData) && isset($productData['shipping']['dim_verify'])){
            $dim_verify = $productData['shipping']['dim_verify'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'dim_verify' => pSQL($dim_verify),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or dim_verify is not set.');
        }

        if (is_array($productData) && isset($productData['description']['wmdeprecated'])){
            $wmdeprecated = $productData['description']['wmdeprecated'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
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
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'not_to_order' => pSQL($not_to_order),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or not_to_order is not set.');
        }

        if (is_array($productData) && isset($productData['description']['difficulty'])){
            $difficulty = $productData['description']['difficulty'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'difficulty' => pSQL($difficulty),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or difficulty is not set.');
        }

        if (is_array($productData) && isset($productData['description']['ec_approved'])){
            $ec_approved = $productData['description']['ec_approved'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
            Db::getInstance()->update('product', [
                'ec_approved' => pSQL($ec_approved),
            ], 'id_product = ' . $idProduct);
        }else{
            error_log('Product data is not valid or ec_approved is not set.');
        }

        if (is_array($productData) && isset($productData['description']['disallow_stock'])){
            $disallow_stock = $productData['description']['disallow_stock'];
            $idProduct = $params['id_product'];
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
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
            // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
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

        if(Context::getContext()->shop->id == 2){
            $choices[$this->l('Bank Transfer')] = 1;
            $choices[$this->l('Credit Card')] = 2;
        }else{
            $choices[$this->l('Bank Transfer')] = 'ps_wirepayment';
            $choices[$this->l('Ingenico')] = 'ogone';
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

        if(Context::getContext()->shop->id == 2){

            $searchQueryBuilder->addSelect(
                '(CASE WHEN o.payment_id IS NULL THEN "Error"
                WHEN o.payment_id = 1 THEN CONCAT("<img src=\"'.$imageBank.'\" style=\"width: 60px; height: auto;\" />")
                WHEN o.payment_id = 2 THEN CONCAT("<img src=\"'.$imageCard.'\" style=\"width: 50px; height: auto;\" />")
                END) AS payment_id'

            );

        }else{

            $searchQueryBuilder->addSelect(
                '(CASE WHEN o.module IS NULL THEN "Error"
                WHEN o.module = "ps_wirepayment" THEN CONCAT("<img src=\"'.$imageBank.'\" style=\"width: 60px; height: auto;\" />")
                WHEN o.module = "ogone" THEN CONCAT("<img src=\"'.$imageCard.'\" style=\"width: 50px; height: auto;\" />")
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

            if(Context::getContext()->shop->id == 2){
                if ($filterName === 'payment_id' && !empty($filterValue)) {
                    $searchQueryBuilder->andWhere('o.payment_id = :payment_id')
                        ->setParameter('payment_id', $filterValue);
                }
            }else{
                if ($filterName === 'payment_id' && !empty($filterValue)) {
                    $searchQueryBuilder->andWhere('o.module = :payment_id')
                        ->setParameter('payment_id', $filterValue);
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


}