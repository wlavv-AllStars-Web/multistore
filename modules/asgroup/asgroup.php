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

use Symfony\Component\Form\Extension\Core\Type\TextType;


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
            $this->registerHook('actionAdminControllerSetMedia') &&
            $this->registerHook('actionOrderGridDefinitionModifier')&&
            $this->registerHook('actionOrderGridQueryBuilderModifier');
    }
    
    /**
     * Modify product form builder
     *
     * @param array $params
     */

    public function hookActionAdminControllerSetMedia()
    {
        $this->context->controller->addCss($this->_path . 'views/css/kpi.css');
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
                ->setName($this->l('Product Ref'))
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
                    'placeholder' => $this->trans('Search reference', [], 'Admin.Actions'),
                ],
            ])
            ->setAssociatedColumn('product_reference')
        );

        
        $orderGridDefinition->getColumns()->remove('new');
        $orderGridDefinition->getColumns()->remove('shop_name');
    }

    public function hookActionOrderGridQueryBuilderModifier(array $params): void
    {
        error_log('hookActionOrderGridQueryBuilderModifier called');

        /** @var DoctrineQueryBuilder $searchQueryBuilder */
        $searchQueryBuilder = $params['search_query_builder'];

        $searchQueryBuilder->addSelect('GROUP_CONCAT(od.product_reference SEPARATOR ", ") AS product_reference')
            ->leftJoin(
                'o', // alias for order table
                _DB_PREFIX_ . 'order_detail', // table name
                'od', // alias for order_detail table
                'od.id_order = o.id_order' // join condition
            );
    }


}