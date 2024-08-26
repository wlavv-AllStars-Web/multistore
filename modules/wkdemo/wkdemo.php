<?php


declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once __DIR__.'/vendor/autoload.php';
use PrestaShop\Module\WkDemo\Form\Modifier\ProductFormModifier;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;

class WkDemo extends Module
{
    public function __construct()
    {
        $this->name = 'wkdemo';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Webkul');
        $this->description = $this->l('Form types within PrestaShop');
        $this->ps_versions_compliancy = ['min' => '8.1', 'max' => _PS_VERSION_];
    }

    /**
     * @return bool
     */
    public function install()
    {
        return parent::install() &&
            $this->registerHook(['displayHome']) &&
            $this->registerHook(['actionProductFormBuilderModifier']) &&
            $this->registerHook(['actionProductSave']);
    }
    
    /**
     * Modify product form builder
     *
     * @param array $params
     */
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

}