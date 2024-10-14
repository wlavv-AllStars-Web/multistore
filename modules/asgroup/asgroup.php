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

use PrestaShop\PrestaShop\Core\Grid\Action\GridActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinition;

use PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton;



class AsGroup extends Module
{
    
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
            $this->registerHook(['actionProductSave']) &&
            $this->registerHook('actionOrdersKpiRowModifier') &&
            $this->registerHook('actionCustomersKpiRowModifier') &&
            $this->registerHook('actionAdminControllerSetMedia') &&
            $this->registerHook('actionOrderGridDefinitionModifier') &&
            $this->registerHook('actionOrderGridQueryBuilderModifier') ;
            // $this->registerHook('displayOrderPreview') &&
            // $this->registerHook('actionGetAdminOrderButtons');
    }
    
    /**
     * Modify product form builder
     *
     * @param array $params
     */

    public function hookActionAdminControllerSetMedia()
    {
        $this->context->controller->addCss('/modules/asgroup/views/css/kpi.css');
        $this->context->controller->addJS('/modules/asgroup/views/js/orders.js');
    }
     

    public function hookActionProductFormBuilderModifier(array $params): void
    {
        /** @var ProductFormModifier $productFormModifier */
        $productFormModifier = $this->get(ProductFormModifier::class);
        $productId = isset($params['id']) ? new ProductId((int) $params['id']) : null;
        $productFormModifier->modify($productId, $params['form_builder']);
    }

    public function hookActionProductSave(array $params): void
    {
        // Please write your logic and operation and save the data as per your need
        // We are using configuration table to save the data
        $productData = Tools::getValue('product');
        $youtube_code = $productData['description']['youtube_code'];
        $idWkProduct = $params['id_product'];
        // Configuration::updateValue('youtube_code' . $idWkProduct, $youtube_code);
        Db::getInstance()->update('product', [
            'youtube_code' => pSQL($youtube_code),
        ], 'id_product = ' . $idWkProduct);
    }

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
            'reference', // Adding after the 'total_paid' column
            (new \PrestaShop\PrestaShop\Core\Grid\Column\Type\DataColumn('product_reference'))
                ->setName($this->l('Products'))
                ->setOptions([
                    'field' => 'product_reference', // This field will be populated later
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

        
        $orderGridDefinition->getColumns()->remove('new');
        $orderGridDefinition->getColumns()->remove('shop_name');

        // $orderGridDefinition->getGridActions()
        //     ->add((new Delete('subscribe'))
        //     ->setName($this->trans('Subscribe', [], 'Admin.Actions'))
        //     ->setIcon('mail')
        //     ->setOptions([
        //         'route' => 'admin_customer_subscribe',
        //         'route_param_name' => 'customerId',
        //         'route_param_field' => 'id_customer',
        //         'confirm_message' => $this->trans(
        //             'Subscribe to newsletter?',
        //             [],
        //             'Admin.Notifications.Warning'
        //         ),
        //     ])
        // );

        // echo '<pre>'.print_r(Context::getContext()->shop->current,true).'</pre>';
        // echo '<pre>'.print_r(Context::getContext()->shop,true).'</pre>';
        // exit;

        // $rowActionCollection = CustomOrderGridDefinitionFactory::getRowActions();
        
        // echo '<pre>'.$orderGridDefinition.'</pre>';
        // exit;
        // $orderGridDefinition->remove('print_invoice');
        // $orderGridDefinition->OrderGridDefinitionFactory->remove('print_invoice');
        // $rowActionCollection->remove('print_delivery_slip');
        // $rowActionCollection->remove('view');
    }

    public function hookActionOrderGridQueryBuilderModifier(array $params): void
    {
        error_log('hookActionOrderGridQueryBuilderModifier called');

        /** @var DoctrineQueryBuilder $searchQueryBuilder */
        $searchQueryBuilder = $params['search_query_builder'];

        $filters = $params['search_criteria']->getFilters();

        // echo '<pre>'.print_r($filters,true).'</pre>';
        // exit;


        

        $searchQueryBuilder->innerJoin(
            'o', // alias for order table
            _DB_PREFIX_ . 'order_detail', // table name
            'od', // alias for order_detail table
            'od.id_order = o.id_order' // join condition
        );

        $searchQueryBuilder->addSelect('GROUP_CONCAT(od.product_reference SEPARATOR ", ") AS product_reference');

        // echo '<pre>'.print_r($searchQueryBuilder,true).'</pre>';
        // exit;

        // Apply filtering if product_reference is set in the filters
        $likeComparisonFilters = [
            'reference' => 'o.`reference`',
            'product_reference' => 'od.`product_reference`'
        ];

       
        
        foreach ($filters as $filterName => $filterValue) {
            if (array_key_exists($filterName, $likeComparisonFilters)) {
                $alias = $likeComparisonFilters[$filterName];
                // echo '<pre>'.print_r(,true).'</pre>';
                // exit;
                    $searchQueryBuilder->andWhere("$alias LIKE :$filterName")
                        ->setParameter($filterName, '%' . $filterValue . '%');
            }
        }

    }

    // public function hookActionGetAdminOrderButtons(array $params)
    // {
        // $order = new Order($params['id_order']);

        // $router = $this->get('router');

        // $bar = $params['actions_bar_buttons_collection'];
        // $createAnOrderUrl = $router->generate('admin_orders_create');
        // $bar->add(
        //     new ActionsBarButton(
        //         'btn-info', ['href' => $createAnOrderUrl], 'Create an order'
        //     )
        // );
        // $viewCustomerUrl = $router->generate('admin_customers_view', ['customerId'=> (int)$order->id_customer]);
        // $bar->add(
        //     new ActionsBarButton(
        //         'btn-secondary', ['href' => $viewCustomerUrl], 'View customer'
        //     )
        // );
        // $shopLink =  'https://asd.local/';
        // // echo '<pre>'.print_r($shopLink).'</pre>';
        // $bar->add(
        //     new ActionsBarButton(
        //         'btn-link', ['href' => $shopLink], 'Go to Shop'
        //     )
        // );
        // $productLink =  Context::getContext()->link->getAdminLink('AdminProducts');
        // $bar->add(
        //     new ActionsBarButton(
        //         'btn-dark', ['href' => $productLink], 'Go to Catalog'
        //     )
        // );        
    // }

    // public function hookdisplayOrderPreview(array $params)
    // {
    //     // $router = $this->get('router');

    //     $html = '
    //     <div class="custom-order-preview">
    //         <h3>Custom Order Preview</h3>
    //         <p>Order ID: <pre>' . $params['orderId'] . '</pre></p>
    //         <p>Custom content here...</p>
    //     </div>
    // ';

    // return $this->display(__FILE__, 'views/templates/hook/order_preview.tpl');
    // }

}