<?php
/**
 * Advanced Pack 5
 *
 * @author    Presta-Module.com <support@presta-module.com> - https://www.presta-module.com
 * @copyright Presta-Module - https://www.presta-module.com
 * @license   see file: LICENSE.txt
 *
 *           ____     __  __
 *          |  _ \   |  \/  |
 *          | |_) |  | |\/| |
 *          |  __/   | |  | |
 *          |_|      |_|  |_|
 */

if (!defined('_PS_VERSION_')) {
    exit;
}
class AdvancedPack extends Product
{
    const MODULE_ID = 'AP5';
    const PACK_FAKE_STOCK = 10000;
    const PACK_FAKE_CUSTOMER_ID = 999999;
    // Remove old packs data after 45 days
    const REMOVE_UNORDERED_PACK_DAYS = 45;
    const ANCHOR_PACK_PRODUCT_SEPARATOR = '|';
    public static $actionRemoveOldPackDataProcessing = false;
    public static $forcePackAttributeList = [];
    public $urlAdminProduct;
    public static $forceUseOfAnotherContext = false;
    public static function getPriceStaticPack(
        $id_product,
        $usetax = true,
        $id_product_attribute = null,
        $decimals = 6,
        $divisor = null,
        $only_reduc = false,
        $usereduc = true,
        $quantity = 1,
        $id_customer = null,
        $id_cart = null,
        $id_address = null,
        &$specific_price_output = null,
        $with_ecotax = true,
        $use_group_reduction = true,
        Context $context = null,
        $use_customer_price = true
    ) {
        static $configurationKeys = null;
        static $excludeTaxOption = null;
        if ($configurationKeys === null) {
            $configurationKeys = Configuration::getMultiple(['PS_CURRENCY_DEFAULT', 'PS_TAX_ADDRESS_TYPE', 'VATNUMBER_COUNTRY', 'VATNUMBER_MANAGEMENT']);
        }
        if ($excludeTaxOption === null) {
            $excludeTaxOption = AdvancedPack::excludeTaxeOption();
        }
        if (!$context) {
            $context = self::getContext();
        }
        $cur_cart = $context->cart;
        if ($divisor !== null) {
            Tools::displayParameterAsDeprecated('divisor');
        }
        if (!Validate::isBool($usetax) || !Validate::isUnsignedId($id_product)) {
            die(Tools::displayError());
        }
        $id_group = (int)Group::getCurrent()->id;
        if (!is_object($cur_cart) || (Validate::isUnsignedInt($id_cart) && $id_cart && $cur_cart->id != $id_cart)) {
            if (!$id_cart && !Validate::isLoadedObject($context->employee)) {
                if (!Tools::getIsset('secure_key')) {
                    die(Tools::displayError());
                }
            }
            $cur_cart = new Cart($id_cart);
            if (!Validate::isLoadedObject($context->cart)) {
                $context->cart = $cur_cart;
            }
        }
        $id_currency = (int)Validate::isLoadedObject($context->currency) ? $context->currency->id : $configurationKeys['PS_CURRENCY_DEFAULT'];
        $id_country = (int)$context->country->id;
        $id_state = 0;
        $zipcode = 0;
        if (!$id_address && Validate::isLoadedObject($cur_cart)) {
            $id_address = $cur_cart->{$configurationKeys['PS_TAX_ADDRESS_TYPE']};
        }
        if (!$id_address && Validate::isLoadedObject($context->customer)) {
            $id_address = (int)Address::getFirstCustomerAddressId($context->customer->id);
        }
        if ($id_address) {
            $address_infos = Address::getCountryAndState($id_address);
            if (!self::$forceUseOfAnotherContext) {
                if ($address_infos['id_country']) {
                    $id_country = (int)$address_infos['id_country'];
                    $id_state = (int)$address_infos['id_state'];
                    $zipcode = $address_infos['postcode'];
                }
            } else {
                $fakeContext = self::getContext();
                if (!empty($address_infos['id_country']) && $fakeContext->country->id == $address_infos['id_country']) {
                    $id_state = (isset($address_infos['id_state']) ? (int)$address_infos['id_state'] : 0);
                    $zipcode = (!empty($address_infos['postcode']) ? $address_infos['postcode'] : '');
                } else {
                    $address_infos = [];
                }
            }
        } elseif (!empty($context->customer->geoloc_id_country) && !self::$forceUseOfAnotherContext) {
            $id_country = (int)$context->customer->geoloc_id_country;
            $id_state = (int)$context->customer->id_state;
            $zipcode = (int)$context->customer->postcode;
        }
        if ($excludeTaxOption) {
            $usetax = false;
        }
        if ($usetax != false
            && !empty($address_infos['vat_number'])
            && $address_infos['id_country'] != $configurationKeys['VATNUMBER_COUNTRY']
            && $configurationKeys['VATNUMBER_MANAGEMENT']) {
            $usetax = false;
        }
        if (is_null($id_customer) && Validate::isLoadedObject($context->customer)) {
            $id_customer = $context->customer->id;
        }
        return Product::priceCalculation(
            $context->shop->id,
            $id_product,
            $id_product_attribute,
            $id_country,
            $id_state,
            $zipcode,
            $id_currency,
            $id_group,
            $quantity,
            $usetax,
            $decimals,
            $only_reduc,
            $usereduc,
            $with_ecotax,
            $specific_price_output,
            $use_group_reduction,
            $id_customer,
            $use_customer_price,
            $id_cart,
            $quantity
        );
    }
    public static function getPackAnchorByAttributes($idPack, $attributesList = [])
    {
        $packContent = self::getPackContent($idPack, null, true, $attributesList);
        $url = [];
        foreach ($packContent as $packProduct) {
            if (empty($packProduct['id_product_attribute'])) {
                continue;
            }
            $combinationAnchor = ltrim(ltrim($packProduct['productObj']->getAnchor((int)$packProduct['id_product_attribute'], true), '#'), '/');
            $url[] = (int)$packProduct['id_product_pack'] . '_' . $combinationAnchor;
        }
        return '#' . implode(self::ANCHOR_PACK_PRODUCT_SEPARATOR, $url);
    }
    public static function getPackProductAttributeListFromAnchor($idPack, $anchor)
    {
        $anchor = ltrim(ltrim($anchor, '#'), '/');
        $separator = Configuration::get('PS_ATTRIBUTE_ANCHOR_SEPARATOR');
        $attributesList = [];
        $explodedAnchor = explode(self::ANCHOR_PACK_PRODUCT_SEPARATOR, $anchor);
        if (count($explodedAnchor) == 1) {
            $idAttribute = (int)current(explode('-', current($explodedAnchor)));
            if (version_compare(_PS_VERSION_, '8.0.0', '>=')) {
                $attributeObj = new ProductAttribute($idAttribute);
            } else {
                $attributeObj = new Attribute($idAttribute);
            }
            $validPackAttributeGroup = (Validate::isLoadedObject($attributeObj) && $attributeObj->id_attribute_group == self::getPackAttributeGroupId());
            if ($validPackAttributeGroup) {
                $sql = new DbQuery();
                $sql->select('id_product_attribute');
                $sql->from('product_attribute_combination', 'pac');
                $sql->where('pac.`id_attribute`=' . (int)$idAttribute);
                $idProductAttribute = (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
                if (!empty($idProductAttribute)) {
                    $attributesList = AdvancedPack::getIdProductAttributeListByIdPack($idPack, $idProductAttribute);
                    if (empty($attributesList)) {
                        $packContent = AdvancedPack::getPackContent($idPack);
                        foreach ($packContent as $packProduct) {
                            $attributesList[(int)$packProduct['id_product_pack']] = (int)$packProduct['default_id_product_attribute'];
                        }
                    }
                    return $attributesList;
                }
            }
        }
        foreach ($explodedAnchor as $packProductAttributes) {
            $packProductAttributesExploded = explode('_', $packProductAttributes);
            $idProductPack = (int)$packProductAttributesExploded[0];
            unset($packProductAttributesExploded[0]);
            if (empty($packProductAttributesExploded)) {
                continue;
            }
            $packProductAttributesNameList = implode('_', $packProductAttributesExploded);
            foreach (explode('/', $packProductAttributesNameList) as $productAttribute) {
                $productAttributeExploded = explode($separator, $productAttribute);
                $idAttribute = (int)$productAttributeExploded[0];
                if (!isset($attributesList[$idProductPack])) {
                    $attributesList[$idProductPack] = [];
                }
                $attributesList[$idProductPack][] = (int)$idAttribute;
            }
        }
        foreach ($attributesList as $idProductPack => $attributeList) {
            list($idProductAttribute) = AdvancedPack::combinationExists((int)$idProductPack, $attributeList);
            if (!empty($idProductAttribute)) {
                $attributesList[$idProductPack] = (int)$idProductAttribute;
            } else {
                unset($attributesList[$idProductPack]);
            }
        }
        return $attributesList;
    }
    public static function getPackContent($idPack, $idProductAttribute = null, $withFrontDatas = false, $attributesList = [], $quantityList = [])
    {
        $idLang = (int)self::getContext()->language->id;
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . (int)$idProductAttribute . (int)$withFrontDatas . json_encode($attributesList) . json_encode($quantityList), true);
        $cacheIdWithoutFront = self::getPMCacheId(__METHOD__ . (int)$idPack . (int)$idProductAttribute . json_encode($quantityList));
        if (!self::isInCache($cacheId)) {
            if (!self::isInCache($cacheIdWithoutFront)) {
                $sql = new DbQuery();
                $sql->select('*');
                $sql->from('pm_advancedpack_products', 'app');
                if ($idProductAttribute != null && $idProductAttribute) {
                    $sql->innerJoin('pm_advancedpack_cart_products', 'acp', 'acp.`id_pack`=' . (int)$idPack . ' AND acp.`id_product_pack`=app.`id_product_pack` AND acp.`id_product_attribute_pack`=' . (int)$idProductAttribute);
                }
                $sql->where('app.`id_pack`=' . (int)$idPack);
                $sql->orderBy('app.`position` ASC');
                $productsPack = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
                if (AdvancedPackCoreClass::_isFilledArray($productsPack)) {
                    $productsAttributesPack = self::getPackProductAttributeList($idPack);
                    foreach ($productsPack as &$packProduct) {
                        if (isset($quantityList[$packProduct['id_product_pack']]) && is_numeric($quantityList[$packProduct['id_product_pack']])) {
                            $packProduct['quantity'] = (int)$quantityList[$packProduct['id_product_pack']];
                        }
                        if (isset($packProduct['customization_infos']) && !empty($packProduct['customization_infos'])) {
                            $packProduct['customizationFieldsName'] = [];
                            $packProduct['customization_infos'] = (array)json_decode($packProduct['customization_infos']);
                            $customizationFields = AdvancedPack::getProductPackCustomizationFields((int)$packProduct['id_product']);
                            if (AdvancedPackCoreClass::_isFilledArray($customizationFields)) {
                                foreach ($customizationFields as $customizationField) {
                                    $packProduct['customizationFieldsName'][(int)$customizationField['id_customization_field']] = $customizationField['name'];
                                }
                            }
                        }
                        if (isset($productsAttributesPack[$packProduct['id_product_pack']])) {
                            $packProduct['combinationsInformations'] = $productsAttributesPack[$packProduct['id_product_pack']];
                        }
                    }
                }
                self::storeInCache($cacheIdWithoutFront, $productsPack);
            } else {
                $productsPack = self::getFromCache($cacheIdWithoutFront);
            }
            if ($withFrontDatas && AdvancedPackCoreClass::_isFilledArray($productsPack)) {
                $config = pm_advancedpack::getModuleConfigurationStatic();
                list($address, $useTax) = self::getAddressInstance();
                $gsrModuleInstance = Module::getInstanceByName('gsnippetsreviews');
                if (!Validate::isLoadedObject($gsrModuleInstance) || !$gsrModuleInstance->active || version_compare($gsrModuleInstance->version, '4.3.0', '<')) {
                    $gsrModuleInstance = false;
                }
                $PM_MultipleFeaturesModuleInstance = Module::getInstanceByName('pm_multiplefeatures');
                $productsPack = self::getPackPriceTable($productsPack, self::getPackFixedPrice($idPack), self::getPackIdTaxRulesGroup((int)$idPack), $useTax, true, true, $attributesList);
                if (empty(Context::getContext()->customer)) {
                    Context::getContext()->customer = new Customer();
                }
                $assembler = new ProductAssembler(self::getContext());
                $imageRetriever = new PrestaShop\PrestaShop\Adapter\Image\ImageRetriever(self::getContext()->link);
                $presenterFactory = new ProductPresenterFactory(self::getContext());
                $presentationSettings = $presenterFactory->getPresentationSettings();
                $presenter = new PrestaShop\PrestaShop\Core\Product\ProductPresenter(
                    $imageRetriever,
                    self::getContext()->link,
                    new PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(),
                    new PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(),
                    self::getContext()->getTranslator()
                );
                foreach ($productsPack as &$packProduct) {
                    if (!isset($attributesList[$packProduct['id_product_pack']]) || !is_numeric($attributesList[$packProduct['id_product_pack']])) {
                        if (isset(AdvancedPack::$forcePackAttributeList[$idPack][$packProduct['id_product_pack']])) {
                            $idProductAttribute = (int)AdvancedPack::$forcePackAttributeList[$idPack][$packProduct['id_product_pack']];
                        } else {
                            $idProductAttribute = (int)$packProduct['default_id_product_attribute'];
                        }
                    } else {
                        $idProductAttribute = (int)$attributesList[$packProduct['id_product_pack']];
                    }
                    $packProduct['productObj'] = new Product((int)$packProduct['id_product'], false, (int)$idLang);
                    if (Validate::isLoadedObject($packProduct['productObj'])) {
                        self::transformProductDescriptionWithImg($packProduct['productObj']);
                    }
                    $packProduct['image'] = self::_getProductCoverImage((int)$packProduct['id_product'], (int)$idProductAttribute);
                    if (isset($config['showImagesOnlyForCombinations']) && $config['showImagesOnlyForCombinations']) {
                        $packProduct['images'] = Image::getImages($idLang, (int)$packProduct['id_product'], (int)$idProductAttribute);
                        if (!is_array($packProduct['images']) || !count($packProduct['images'])) {
                            $packProduct['images'] = self::_getProductImages($packProduct, $idLang);
                        }
                        $packProduct['imagesMobile'] = $packProduct['images'];
                    } else {
                        $packProduct['images'] = self::_getProductImages($packProduct, $idLang);
                        $packProduct['imagesCombinations'] = Image::getImages($idLang, (int)$packProduct['id_product'], (int)$idProductAttribute);
                        $packProduct['imagesMobile'] = $packProduct['images'];
                        if (is_array($packProduct['imagesCombinations']) && count($packProduct['imagesCombinations'])) {
                            foreach ($packProduct['imagesCombinations'] as $imgCombination) {
                                foreach ($packProduct['imagesMobile'] as $imgMobileKey => $imgMobile) {
                                    if ($imgMobile['id_image'] == $imgCombination['id_image']) {
                                        unset($packProduct['imagesMobile'][$imgMobileKey]);
                                    }
                                }
                            }
                            $packProduct['imagesMobile'] = array_merge($packProduct['imagesCombinations'], $packProduct['imagesMobile']);
                        }
                    }
                    $packProduct['reduction_amount_tax_incl'] = $packProduct['priceInfos']['reductionAmountWt'];
                    $packProduct['reduction_amount_tax_excl'] = $packProduct['priceInfos']['reductionAmount'];
                    $packProduct['productPackPrice'] = ($packProduct['priceInfos']['productPackPriceWt'] + $packProduct['priceInfos']['productEcoTaxWt']);
                    $packProduct['productPackPriceTaxExcl'] = ($packProduct['priceInfos']['productPackPrice'] + $packProduct['priceInfos']['productEcoTax']);
                    $packProduct['productClassicPrice'] = ($packProduct['priceInfos']['productClassicPriceWt'] + $packProduct['priceInfos']['productEcoTaxWt']);
                    $packProduct['productClassicPriceTaxExcl'] = ($packProduct['priceInfos']['productClassicPrice'] + $packProduct['priceInfos']['productEcoTax']);
                    $packProduct['productClassicPriceTotal'] = $packProduct['productClassicPrice'] * (int)$packProduct['quantity'];
                    $packProduct['productClassicPriceTaxExclTotal'] = $packProduct['productClassicPriceTaxExcl'] * (int)$packProduct['quantity'];
                    $packProduct['productPackPriceTotal'] = $packProduct['productPackPrice'] * (int)$packProduct['quantity'];
                    $packProduct['productPackPriceTaxExclTotal'] = $packProduct['productPackPriceTaxExcl'] * (int)$packProduct['quantity'];
                    $packProduct['productReductionAmountTotal'] = $packProduct['reduction_amount_tax_incl'] * (int)$packProduct['quantity'];
                    $packProduct['productReductionAmountTaxExclTotal'] = $packProduct['reduction_amount_tax_excl'] * (int)$packProduct['quantity'];
                    $packProduct['presentation'] = $presenter->present(
                        $presentationSettings,
                        $assembler->assembleProduct(['id_product' => (int)$packProduct['id_product'], 'id_product_attribute' => (int)$idProductAttribute]),
                        self::getContext()->language
                    );
                    if (is_array($packProduct['images'])) {
                        $newImages = [];
                        foreach ($packProduct['images'] as $tmpImage) {
                            $newImages[] = $imageRetriever->getImage($packProduct['productObj'], $tmpImage['id_image']);
                        }
                        $packProduct['presentation']->offsetSet('images', $newImages, true);
                    }
                    $packProduct['presentation']['productClassicPriceTotal'] = Tools::displayPrice($packProduct['productClassicPriceTotal']);
                    $packProduct['presentation']['productClassicPriceTaxExclTotal'] = Tools::displayPrice($packProduct['productClassicPriceTaxExclTotal']);
                    $packProduct['presentation']['productPackPriceTotal'] = Tools::displayPrice($packProduct['productPackPriceTotal']);
                    $packProduct['presentation']['productPackPriceTaxExclTotal'] = Tools::displayPrice($packProduct['productPackPriceTaxExclTotal']);
                    $packProduct['presentation']['productReductionAmountTotal'] = Tools::displayPrice($packProduct['productReductionAmountTotal']);
                    $packProduct['presentation']['productReductionAmountTaxExclTotal'] = Tools::displayPrice($packProduct['productReductionAmountTaxExclTotal']);
                    $packProduct['attributes'] = false;
                    if ($idProductAttribute) {
                        $packProduct['attributes'] = self::getProductAttributesGroups($packProduct['productObj'], (int)$idProductAttribute, self::getProductAttributeWhiteList($packProduct['id_product_pack']));
                    }
                    $packProduct['id_product_attribute'] = (int)$idProductAttribute;
                    if (Validate::isLoadedObject($PM_MultipleFeaturesModuleInstance) && $PM_MultipleFeaturesModuleInstance->active && method_exists($PM_MultipleFeaturesModuleInstance, 'getFrontFeatures')) {
                        $packProduct['features'] = $PM_MultipleFeaturesModuleInstance->getFrontFeatures((int)$packProduct['productObj']->id);
                    } else {
                        $packProduct['features'] = $packProduct['productObj']->getFrontFeatures((int)$idLang);
                    }
                    $packProduct['accessories'] = $packProduct['productObj']->getAccessories((int)$idLang);
                    $packProduct['attachments'] = (($packProduct['productObj']->cache_has_attachments) ? $packProduct['productObj']->getAttachments((int)$idLang) : []);
                    if ($gsrModuleInstance) {
                        if (method_exists($gsrModuleInstance, 'hookProductRating')) {
                            $packProduct['gsrAverage'] = $gsrModuleInstance->hookProductRating(['id' => (int)$packProduct['id_product'], 'display' => 'productRating']);
                        }
                        $gsrAverageTest = trim(strip_tags($packProduct['gsrAverage']));
                        if (is_string($packProduct['gsrAverage']) && !empty($gsrAverageTest) && method_exists($gsrModuleInstance, 'hookDisplayProductTabContent')) {
                            $packProduct['gsrReviewsList'] = $gsrModuleInstance->hookDisplayProductTabContent(['bForce' => true, 'product' => $packProduct['productObj']]);
                        }
                    }
                    $text_fields = [];
                    if ($packProduct['productObj']->customizable) {
                        $texts = self::getContext()->cart->getProductCustomization($packProduct['productObj']->id, Product::CUSTOMIZE_TEXTFIELD, true);
                        foreach ($texts as $text_field) {
                            if (in_array((int)$text_field['index'], self::getProductCustomizationFieldWhiteList($packProduct['id_product_pack']))) {
                                $text_fields['textFields_' . $packProduct['productObj']->id . '_' . $text_field['index']] = preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text_field['value']);
                            }
                        }
                    }
                    $customization_fields = $packProduct['productObj']->customizable ? AdvancedPack::getProductPackCustomizationFields((int)$packProduct['productObj']->id) : [];
                    foreach ($customization_fields as $customizationKey => $customizationRow) {
                        if (!in_array((int)$customizationRow['id_customization_field'], self::getProductCustomizationFieldWhiteList($packProduct['id_product_pack']))) {
                            unset($customization_fields[$customizationKey]);
                        }
                    }
                    $packProduct['customization']['textFields'] = $text_fields;
                    $packProduct['customization']['customizationFields'] = $customization_fields;
                    $packProduct['productObj']->customization_required = false;
                    if (is_array($customization_fields)) {
                        foreach ($customization_fields as $customization_field) {
                            if ($packProduct['productObj']->customization_required = $customization_field['required']) {
                                break;
                            }
                        }
                    }
                }
            }
            if (AdvancedPackCoreClass::_isFilledArray($productsPack)) {
                self::storeInCache($cacheId, $productsPack);
                return $productsPack;
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, false);
        return false;
    }
    public static function getPackContentGroupByProduct($productsPack)
    {
        $idProductList = [];
        foreach ($productsPack as $productRowKey => $packProduct) {
            if (!in_array((int)$packProduct['id_product'], $idProductList)) {
                $idProductList[] = (int)$packProduct['id_product'];
            } else {
                unset($productsPack[$productRowKey]);
                continue;
            }
        }
        return $productsPack;
    }
    public static function getPackPriceTable($packContent, $packFixedPriceList = [], $packIdTaxRulesGroup = 0, $useTax = true, $includeEcoTax = true, $useGroupReduction = false, $attributesList = [])
    {
        $packFixedPrice = 0;
        $productCategoryReduction = null;
        $packCategoryReduction = null;
        $currentIdGroup = null;
        if ($packContent !== false && is_array($packContent)) {
            $currentIdGroup = (int)Group::getCurrent()->id;
            $packContentFirstItem = current($packContent);
            if (!empty($packContentFirstItem['id_pack'])) {
                $idPack = (int)$packContentFirstItem['id_pack'];
                $packCategoryReduction = GroupReduction::getValueForProduct((int)$idPack, $currentIdGroup);
                if (is_float($packCategoryReduction + 0)) {
                    $packCategoryReduction = $packCategoryReduction * 100;
                } else {
                    $packCategoryReduction = null;
                }
            }
            if (is_array($packFixedPriceList) && isset($packFixedPriceList[$currentIdGroup]) && $packFixedPriceList[$currentIdGroup] > 0) {
                $packFixedPrice = $packFixedPriceList[$currentIdGroup];
            }
        }
        if ($packCategoryReduction !== null) {
            $useGroupReduction = false;
            if ($packFixedPrice > 0) {
                $packFixedPrice -= ($packFixedPrice * $packCategoryReduction / 100);
            }
        }
        $excludeVATCase = false;
        list($address) = self::getAddressInstance();
        if (!$packIdTaxRulesGroup
        && !empty($address->vat_number)
        && $address->id_country != Configuration::get('VATNUMBER_COUNTRY')
        && Configuration::get('VATNUMBER_MANAGEMENT')) {
            $excludeVATCase = true;
        } elseif (!$packIdTaxRulesGroup && Validate::isLoadedObject(self::getContext()->customer) && self::getContext()->customer->id != self::PACK_FAKE_CUSTOMER_ID) {
            $excludeVATCase = (Product::getTaxCalculationMethod(self::getContext()->customer->id) == 0);
        }
        $cacheId = self::getPMCacheId((int)self::$usePackReductionReduction . __METHOD__ . json_encode($packContent) . (float)$packFixedPrice . (int)$packIdTaxRulesGroup . (int)$useTax . (int)$excludeVATCase . (int)$includeEcoTax . (int)$useGroupReduction . json_encode($attributesList), true);
        if (self::$forceUseOfAnotherContext || !self::isInCache($cacheId)) {
            $groupReduction = Group::getReductionByIdGroup($currentIdGroup);
            $totalClassicPriceWithoutTaxes = $totalClassicPriceWithTaxes = $totalEcoTax = 0;
            if ($packContent !== false) {
                $priceRounding = null;
                if (Module::isEnabled('pricerounding') && Tools::file_exists_cache(_PS_MODULE_DIR_ . 'pricerounding/classes/PriceroundingConfiguration.php')) {
                    include_once _PS_MODULE_DIR_ . 'pricerounding/classes/PriceroundingConfiguration.php';
                    if (class_exists('PriceroundingConfiguration')) {
                        $priceRounding = new PriceroundingConfiguration();
                    }
                }
                foreach ($packContent as &$packProduct) {
                    $productPackIdAttribute = (isset($attributesList[(int)$packProduct['id_product_pack']]) ? $attributesList[(int)$packProduct['id_product_pack']] : (isset($packProduct['id_product_attribute']) && (int)$packProduct['id_product_attribute'] ? (int)$packProduct['id_product_attribute'] : (int)$packProduct['default_id_product_attribute']));
                    $specificPriceOutput = null;
                    $productPackPriceWt = $productClassicPriceWt = self::getPriceStaticPack($packProduct['id_product'], true, $productPackIdAttribute, 6, null, false, (bool)$packProduct['use_reduc'], (int)$packProduct['quantity'], null, null, null, $specificPriceOutput, false, $useGroupReduction);
                    $productPackPrice = $productClassicPrice = self::getPriceStaticPack($packProduct['id_product'], false, $productPackIdAttribute, 6, null, false, (bool)$packProduct['use_reduc'], (int)$packProduct['quantity'], null, null, null, $specificPriceOutput, false, $useGroupReduction);
                    if ($packFixedPrice > 0) {
                        if ($packCategoryReduction === null) {
                            $specificCategoryReduction = null;
                            $productCategoryReduction = GroupReduction::getValueForProduct((int)$packProduct['id_product'], $currentIdGroup);
                            if (is_float($productCategoryReduction + 0)) {
                                $productCategoryReduction = $productCategoryReduction * 100;
                            } else {
                                $productCategoryReduction = null;
                            }
                            $specificCategoryReduction = $productCategoryReduction;
                            if ($specificCategoryReduction === null && $groupReduction > 0) {
                                $specificCategoryReduction = (float)$groupReduction;
                            }
                            if ($specificCategoryReduction !== null && $specificCategoryReduction > 0) {
                                $productClassicPriceWtTmp = self::getPriceStaticPack($packProduct['id_product'], true, $productPackIdAttribute, 6, null, false, (bool)$packProduct['use_reduc'], (int)$packProduct['quantity'], null, null, null, $specificPriceOutput, false, false);
                                $productClassicPriceTmp = self::getPriceStaticPack($packProduct['id_product'], false, $productPackIdAttribute, 6, null, false, (bool)$packProduct['use_reduc'], (int)$packProduct['quantity'], null, null, null, $specificPriceOutput, false, false);
                                $packProduct['customPercentageDiscount'] = $specificCategoryReduction;
                                if ($packIdTaxRulesGroup) {
                                    $totalClassicPriceWithTaxes -= ($productClassicPriceTmp * $specificCategoryReduction / 100);
                                } else {
                                    $totalClassicPriceWithoutTaxes -= ($productClassicPriceWtTmp * $specificCategoryReduction / 100);
                                }
                            }
                        }
                    } else {
                        if ($packCategoryReduction === null && self::$usePackReductionReduction && !$useGroupReduction) {
                            $productCategoryReduction = GroupReduction::getValueForProduct((int)$packProduct['id_product'], $currentIdGroup);
                            if (is_float($productCategoryReduction + 0)) {
                                $productCategoryReduction = $productCategoryReduction * 100;
                            } else {
                                $productCategoryReduction = null;
                            }
                            if ($productCategoryReduction != null && $productCategoryReduction > 0) {
                                $packProduct['customPercentageDiscount'] = $productCategoryReduction;
                                $productPackPrice -= ($productPackPrice * $productCategoryReduction / 100);
                                $productPackPriceWt -= ($productPackPriceWt * $productCategoryReduction / 100);
                                $productClassicPrice -= ($productClassicPrice * $productCategoryReduction / 100);
                                $productClassicPriceWt -= ($productClassicPriceWt * $productCategoryReduction / 100);
                            }
                        } elseif ($packCategoryReduction !== null && $packCategoryReduction > 0) {
                            $productPackPrice -= ($productPackPrice * $packCategoryReduction / 100);
                            $productPackPriceWt -= ($productPackPriceWt * $packCategoryReduction / 100);
                            $productClassicPrice -= ($productClassicPrice * $packCategoryReduction / 100);
                            $productClassicPriceWt -= ($productClassicPriceWt * $packCategoryReduction / 100);
                            $packProduct['customPercentageDiscount'] = $packCategoryReduction;
                        }
                    }
                    $taxManager = TaxManagerFactory::getManager($address, Product::getIdTaxRulesGroupByIdProduct((int)$packProduct['id_product']));
                    $productTaxCalculator = $taxManager->getTaxCalculator();
                    $ecoTaxManager = TaxManagerFactory::getManager($address, (int)Configuration::get('PS_ECOTAX_TAX_RULES_GROUP_ID'));
                    $ecoTaxCalculator = $ecoTaxManager->getTaxCalculator();
                    $packReductionType = $packProduct['reduction_type'];
                    $packReductionAmount = $packProduct['reduction_amount'];
                    if (isset($packProduct['combinationsInformations']) && isset($packProduct['combinationsInformations'][$productPackIdAttribute]) && $packProduct['combinationsInformations'][$productPackIdAttribute]['reduction_type'] != null) {
                        $packReductionType = $packProduct['combinationsInformations'][$productPackIdAttribute]['reduction_type'];
                        $packReductionAmount = $packProduct['combinationsInformations'][$productPackIdAttribute]['reduction_amount'];
                        $packProduct['reduction_type'] = $packReductionType;
                        $packProduct['reduction_amount'] = $packReductionAmount;
                    }
                    if ($packReductionType == 'amount') {
                        $packReductionAmount = Tools::convertPrice($packReductionAmount, self::getContext()->currency);
                        $packProduct['reduction_amount'] = $packReductionAmount;
                        $productPackPrice -= Tools::ps_round($packReductionAmount, 6);
                        $productPackPriceWt -= Tools::ps_round($useTax ? $productTaxCalculator->addTaxes($packReductionAmount) : $packReductionAmount, 6);
                    } elseif ($packReductionType == 'percentage') {
                        $productPackPrice *= (1 - $packReductionAmount);
                        $productPackPriceWt *= (1 - $packReductionAmount);
                    }
                    if ($productPackPrice < 0) {
                        $productPackPrice = $productPackPriceWt = 0;
                    }
                    if ($packFixedPrice > 0 && $productPackIdAttribute != (int)$packProduct['default_id_product_attribute']) {
                        $defaultCombinationPriceImpact = (float)Combination::getPrice($packProduct['default_id_product_attribute']);
                        $combinationPriceImpact = (float)Combination::getPrice($productPackIdAttribute);
                        if ($productPackPrice > 0 && $defaultCombinationPriceImpact > 0) {
                            $combinationPriceImpact -= $defaultCombinationPriceImpact;
                        }
                        $packFixedPrice += $combinationPriceImpact;
                    }
                    $productEcoTax = $productEcoTaxWt = self::getProductEcoTax((int)$packProduct['id_product'], (int)$productPackIdAttribute);
                    $productEcoTaxWt = $ecoTaxCalculator->addTaxes($productEcoTaxWt);
                    if ($packFixedPrice > 0 && $excludeVATCase) {
                        $address2 = clone $address;
                        if (!empty($address2->vat_number)) {
                            $address2->vat_number = '';
                        } else {
                            $address2->id_country = (int)Configuration::get('PS_COUNTRY_DEFAULT');
                            $address2->id_state = 0;
                        }
                        $taxManager2 = TaxManagerFactory::getManager($address2, Product::getIdTaxRulesGroupByIdProduct((int)$packProduct['id_product']));
                        $productTaxCalculator2 = $taxManager2->getTaxCalculator();
                        $totalClassicPriceWithoutTaxes += $productClassicPrice * (int)$packProduct['quantity'];
                        $totalClassicPriceWithTaxes += $productTaxCalculator2->addTaxes($productClassicPrice) * (int)$packProduct['quantity'];
                    } else {
                        $totalClassicPriceWithoutTaxes += $productClassicPrice * (int)$packProduct['quantity'];
                        $totalClassicPriceWithTaxes += $productClassicPriceWt * (int)$packProduct['quantity'];
                    }
                    $packProduct['priceInfos'] = [
                        'productPackPrice' => $productPackPrice,
                        'productPackPriceWt' => $productPackPriceWt,
                        'productClassicPrice' => $productClassicPrice,
                        'productClassicPriceWt' => $productClassicPriceWt,
                        'taxesClassic' => $productClassicPriceWt - $productClassicPrice,
                        'taxesPack' => $productPackPriceWt - $productPackPrice,
                        'productEcoTax' => $productEcoTax,
                        'productEcoTaxWt' => $productEcoTaxWt,
                        'quantity' => (int)$packProduct['quantity'],
                    ];
                    if ($priceRounding != null && method_exists($priceRounding, 'getRoundedPrice')) {
                        $prConfigs = null;
                        if (method_exists($priceRounding, 'getPRConfigurations')) {
                            $context = self::getContext();
                            $prConfigs = $priceRounding->getPRConfigurations(
                                $context->shop->id,
                                (int)$packProduct['id_product'],
                                (int)(Validate::isLoadedObject($context->customer) && !empty($context->customer->id) ? $context->customer->id : 0),
                                (int)$address->id_country,
                                (int)$address->id_state,
                                (int)$context->currency->id,
                                (int)$context->language->id
                            );
                        }
                        if ($prConfigs === null || (is_array($prConfigs) && !empty($prConfigs))) {
                            $productPackPriceWt = $priceRounding->getRoundedPrice((int)$packProduct['id_product'], $productPackPriceWt);
                            $packProduct['priceInfos']['productPackPriceWt'] = $productPackPriceWt;
                            $packProduct['priceInfos']['taxesPack'] = $productPackPriceWt - $productPackPrice;
                        }
                    }
                    if ($packReductionType == 'amount') {
                        $packProduct['priceInfos']['reductionAmountWt'] = Tools::ps_round($useTax ? $productTaxCalculator->addTaxes($packReductionAmount) : $packReductionAmount, 6);
                        $packProduct['priceInfos']['reductionAmount'] = Tools::ps_round($packReductionAmount, 6);
                    } else {
                        $packProduct['priceInfos']['reductionAmountWt'] = 0;
                        $packProduct['priceInfos']['reductionAmount'] = 0;
                    }
                }
                if ($packFixedPrice > 0) {
                    foreach ($packContent as &$packProduct) {
                        $taxManager = TaxManagerFactory::getManager($address, Product::getIdTaxRulesGroupByIdProduct((int)$packProduct['id_product']));
                        $productTaxCalculator = $taxManager->getTaxCalculator();
                        if ($packIdTaxRulesGroup) {
                            if ($totalClassicPriceWithoutTaxes > 0) {
                                $packProduct['priceInfos']['productPackPriceWt'] = Tools::ps_round((($packProduct['priceInfos']['productPackPriceWt'] * (int)$packProduct['quantity']) / $totalClassicPriceWithoutTaxes) * $packFixedPrice, 6) / (int)$packProduct['quantity'];
                                $packProduct['priceInfos']['productPackPrice'] = Tools::ps_round((($packProduct['priceInfos']['productPackPrice'] * (int)$packProduct['quantity']) / $totalClassicPriceWithoutTaxes) * $packFixedPrice, 6) / (int)$packProduct['quantity'];
                            } else {
                                $packProduct['priceInfos']['productPackPriceWt'] = Tools::ps_round($packFixedPrice / count($packContent), 6) / (int)$packProduct['quantity'];
                                $packProduct['priceInfos']['productPackPrice'] = Tools::ps_round($packFixedPrice / count($packContent), 6) / (int)$packProduct['quantity'];
                            }
                        } else {
                            if ($totalClassicPriceWithTaxes > 0) {
                                $packProduct['priceInfos']['productPackPriceWt'] = Tools::ps_round((($packProduct['priceInfos']['productPackPriceWt'] * (int)$packProduct['quantity']) / $totalClassicPriceWithTaxes) * $packFixedPrice, 6) / (int)$packProduct['quantity'];
                                $packProduct['priceInfos']['productPackPrice'] = Tools::ps_round((($packProduct['priceInfos']['productPackPrice'] * (int)$packProduct['quantity']) / $totalClassicPriceWithTaxes) * $packFixedPrice, 6) / (int)$packProduct['quantity'];
                            } else {
                                $packProduct['priceInfos']['productPackPriceWt'] = Tools::ps_round($packFixedPrice / count($packContent), 6) / (int)$packProduct['quantity'];
                                $packProduct['priceInfos']['productPackPrice'] = Tools::ps_round($packFixedPrice / count($packContent), 6) / (int)$packProduct['quantity'];
                            }
                        }
                    }
                } else {
                    foreach ($packContent as &$packProduct) {
                        $packProduct['priceInfos']['productPackPrice'] = Tools::ps_round($packProduct['priceInfos']['productPackPrice'], 6);
                        $packProduct['priceInfos']['productPackPriceWt'] = Tools::ps_round($packProduct['priceInfos']['productPackPriceWt'], 6);
                        $packProduct['priceInfos']['productClassicPrice'] = Tools::ps_round($packProduct['priceInfos']['productClassicPrice'], 6);
                        $packProduct['priceInfos']['productClassicPriceWt'] = Tools::ps_round($packProduct['priceInfos']['productClassicPriceWt'], 6);
                        $packProduct['priceInfos']['taxesClassic'] = Tools::ps_round($packProduct['priceInfos']['taxesClassic'], 6);
                        $packProduct['priceInfos']['taxesPack'] = Tools::ps_round($packProduct['priceInfos']['taxesPack'], 6);
                        $packProduct['priceInfos']['productEcoTax'] = Tools::ps_round($packProduct['priceInfos']['productEcoTax'], 6);
                        $packProduct['priceInfos']['productEcoTaxWt'] = Tools::ps_round($packProduct['priceInfos']['productEcoTaxWt'], 6);
                    }
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $packContent);
        return $packContent;
    }
    public static $usePackReductionReduction = false;
    public static function getPackPrice($idPack, $useTax = true, $usePackReduction = true, $includeEcoTax = true, $priceDisplayPrecision = 6, $attributesList = [], $quantityList = [], $packExcludeList = [], $useGroupReduction = false)
    {
        self::$usePackReductionReduction = $usePackReduction;
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . (int)$useTax . (int)$usePackReduction . (int)$includeEcoTax . (int)$priceDisplayPrecision . json_encode($attributesList) . json_encode($quantityList) . json_encode($packExcludeList) . (int)$useGroupReduction, true);
        if (self::$forceUseOfAnotherContext || !self::isInCache($cacheId)) {
            $packContent = self::getPackContent($idPack, null, false, $attributesList, $quantityList);
            $packFixedPrice = self::getPackFixedPrice($idPack);
            $packClassicPrice = $packClassicPriceWt = $packPrice = $packPriceWt = $totalPackEcoTax = $totalPackEcoTaxWt = 0;
            list($address) = self::getAddressInstance();
            self::$usePackReductionReduction = $usePackReduction;
            $packProducts = self::getPackPriceTable($packContent, $packFixedPrice, self::getPackIdTaxRulesGroup((int)$idPack), $useTax, $includeEcoTax, $useGroupReduction, $attributesList);
            foreach ($packProducts as $packProduct) {
                if (in_array((int)$packProduct['id_product_pack'], $packExcludeList)) {
                    continue;
                }
                $packClassicPrice += $packProduct['priceInfos']['productClassicPrice'] * (int)$packProduct['quantity'];
                $packClassicPriceWt += $packProduct['priceInfos']['productClassicPriceWt'] * (int)$packProduct['quantity'];
                $packPriceWt += $packProduct['priceInfos']['productPackPriceWt'] * (int)$packProduct['quantity'];
                $packPrice += $packProduct['priceInfos']['productPackPrice'] * (int)$packProduct['quantity'];
                $totalPackEcoTax += $packProduct['priceInfos']['productEcoTax'] * (int)$packProduct['quantity'];
                $totalPackEcoTaxWt += $packProduct['priceInfos']['productEcoTaxWt'] * (int)$packProduct['quantity'];
            }
            if ($includeEcoTax) {
                $packPriceWt += $totalPackEcoTaxWt;
                $packPrice += $totalPackEcoTax;
                $packClassicPrice += $totalPackEcoTax;
                $packClassicPriceWt += $totalPackEcoTaxWt;
            }
            if ($useTax) {
                if ($usePackReduction) {
                    self::storeInCache($cacheId, (float)$packPriceWt);
                    return $packPriceWt;
                } else {
                    self::storeInCache($cacheId, (float)$packClassicPriceWt);
                    return $packClassicPriceWt;
                }
            } else {
                if ($usePackReduction) {
                    self::storeInCache($cacheId, (float)$packPrice);
                    return $packPrice;
                } else {
                    self::storeInCache($cacheId, (float)$packClassicPrice);
                    return $packClassicPrice;
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
    }
    public static function getPackFixedPrice($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack, true);
        if (!self::isInCache($cacheId)) {
            $packFixedPrice = [];
            $sql = new DbQuery();
            $sql->select('ap.`fixed_price`');
            $sql->from('pm_advancedpack', 'ap');
            $sql->where('ap.`id_pack`=' . (int)$idPack);
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if (!empty($result)) {
                if (is_numeric($result)) {
                    $newFixedPriceData = [];
                    foreach (Group::getGroups(Context::getContext()->language->id, true) as $group) {
                        $newFixedPriceData[(int)$group['id_group']] = $result;
                    }
                    $newFixedPriceData = json_encode($newFixedPriceData);
                    Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'pm_advancedpack` CHANGE COLUMN `fixed_price` `fixed_price` text DEFAULT NULL');
                    Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'pm_advancedpack` ap SET ap.`fixed_price`="' . pSQL($newFixedPriceData) . '" WHERE ap.`id_pack` = ' . (int)$idPack);
                } else {
                    $jsonResult = (array)json_decode($result, true);
                    if ($jsonResult !== false && is_array($jsonResult)) {
                        foreach (array_keys($jsonResult) as $k) {
                            $jsonResult[$k] = Tools::convertPrice((float)$jsonResult[$k], self::getContext()->currency);
                        }
                        $packFixedPrice = $jsonResult;
                    } else {
                        $packFixedPrice = [];
                    }
                }
            } else {
                $packFixedPrice = [];
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, (array)$packFixedPrice);
        return (array)$packFixedPrice;
    }
    public static function getPackAllowRemoveProduct($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack);
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('ap.`allow_remove_product`');
            $sql->from('pm_advancedpack', 'ap');
            $sql->where('ap.`id_pack`=' . (int)$idPack);
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            $packAllowRemoveProduct = (bool)$result;
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, (bool)$packAllowRemoveProduct);
        return (bool)$packAllowRemoveProduct;
    }
    private static function _getCartProducts()
    {
        $cartContent = [];
        $context = self::getContext();
        if (is_object($context->controller) && isset($context->controller->controller_type) && !in_array($context->controller->controller_type, ['front', 'modulefront'])) {
            return $cartContent;
        }
        $cart = $context->cart;
        if (!Validate::isLoadedObject($cart)) {
            return $cartContent;
        }
        $sql = 'SELECT `id_product`, `id_product_attribute`, `quantity` FROM `' . _DB_PREFIX_ . 'cart_product` WHERE `id_cart` = ' . (int)$cart->id;
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (pm_advancedpack::_isFilledArray($result)) {
            foreach ($result as $cartRow) {
                $cartContent[(int)$cartRow['id_product']][(int)$cartRow['id_product_attribute']] = (int)$cartRow['quantity'];
            }
        }
        return $cartContent;
    }
    public static function getCartQuantity($idProduct, $idProductAttribute = 0)
    {
        $cartProducts = self::_getCartProducts();
        if (isset($cartProducts[(int)$idProduct][(int)$idProductAttribute])) {
            return $cartProducts[(int)$idProduct][(int)$idProductAttribute];
        }
        return 0;
    }
    public static function getPackProductsCartQuantity($idProductAttribute = null)
    {
        $currentPackCartStock = [];
        $context = self::getContext();
        if (is_object($context->controller) && isset($context->controller->controller_type) && !in_array($context->controller->controller_type, ['front', 'modulefront'])) {
            return $currentPackCartStock;
        }
        $cart = $context->cart;
        if (!Validate::isLoadedObject($cart)) {
            return $currentPackCartStock;
        }
        foreach ($cart->getProducts() as $cartProduct) {
            if ($idProductAttribute !== null && (int)$idProductAttribute == (int)$cartProduct['id_product_attribute']) {
                continue;
            }
            if (AdvancedPack::isValidPack((int)$cartProduct['id_product'])) {
                $packContent = AdvancedPack::getPackContent((int)$cartProduct['id_product'], (int)$cartProduct['id_product_attribute']);
                if ($packContent !== false) {
                    foreach ($packContent as $packProduct) {
                        if (isset($currentPackCartStock[(int)$packProduct['id_product']][(int)$packProduct['id_product_attribute']])) {
                            $currentPackCartStock[(int)$packProduct['id_product']][(int)$packProduct['id_product_attribute']] += (int)$cartProduct['cart_quantity'] * (int)$packProduct['quantity'];
                        } else {
                            $currentPackCartStock[(int)$packProduct['id_product']][(int)$packProduct['id_product_attribute']] = (int)$cartProduct['cart_quantity'] * (int)$packProduct['quantity'];
                        }
                    }
                }
            }
        }
        return $currentPackCartStock;
    }
    public static function getPackAvailableQuantity($idPack, $attributesList = [], $quantityList = [], $packExcludeList = [], $idProductAttribute = null, $useCache = true)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . json_encode($attributesList) . json_encode($quantityList) . json_encode($packExcludeList) . (int)$idProductAttribute, true);
        $packAvailableQuantity = 0;
        if (!$useCache || !self::isInCache($cacheId)) {
            if (!AdvancedPack::isValidPack($idPack, true, $packExcludeList)) {
                return 0;
            }
            $currentPackCartStock = self::getPackProductsCartQuantity($idProductAttribute);
            $packContent = self::getPackContent($idPack);
            $productPackQuantityList = [];
            $stockNeededByIdProductIdProductAttribute = [];
            if ($packContent !== false) {
                foreach ($packContent as $packProduct) {
                    if (in_array((int)$packProduct['id_product_pack'], $packExcludeList)) {
                        continue;
                    }
                    if (!Product::isAvailableWhenOutOfStock(StockAvailable::outOfStock((int)$packProduct['id_product']))) {
                        if (!isset($attributesList[$packProduct['id_product_pack']]) || !is_numeric($attributesList[$packProduct['id_product_pack']])) {
                            $idProductAttribute = (int)$packProduct['default_id_product_attribute'];
                        } else {
                            $idProductAttribute = (int)$attributesList[$packProduct['id_product_pack']];
                        }
                        if (!isset($stockNeededByIdProductIdProductAttribute[(int)$packProduct['id_product']][$idProductAttribute])) {
                            $stockNeededByIdProductIdProductAttribute[(int)$packProduct['id_product']][$idProductAttribute] = (int)$packProduct['quantity'];
                        } else {
                            $stockNeededByIdProductIdProductAttribute[(int)$packProduct['id_product']][$idProductAttribute] += (int)$packProduct['quantity'];
                        }
                    }
                }
                foreach ($packContent as $packProduct) {
                    if (in_array((int)$packProduct['id_product_pack'], $packExcludeList)) {
                        continue;
                    }
                    if (!Product::isAvailableWhenOutOfStock(StockAvailable::outOfStock((int)$packProduct['id_product']))) {
                        if (!isset($attributesList[$packProduct['id_product_pack']]) || !is_numeric($attributesList[$packProduct['id_product_pack']])) {
                            $idProductAttribute = (int)$packProduct['default_id_product_attribute'];
                        } else {
                            $idProductAttribute = (int)$attributesList[$packProduct['id_product_pack']];
                        }
                        $cartPackStock = 0;
                        if (isset($currentPackCartStock[(int)$packProduct['id_product']][(int)$idProductAttribute])) {
                            $cartPackStock = $currentPackCartStock[(int)$packProduct['id_product']][(int)$idProductAttribute];
                        }
                        if (isset(pm_advancedpack::$currentStockUpdate[(int)$packProduct['id_product']]) && isset(pm_advancedpack::$currentStockUpdate[(int)$packProduct['id_product']][$idProductAttribute])) {
                            $currentAvailableStock = (int)pm_advancedpack::$currentStockUpdate[(int)$packProduct['id_product']][$idProductAttribute];
                        } else {
                            $currentAvailableStock = (int)StockAvailable::getQuantityAvailableByProduct((int)$packProduct['id_product'], $idProductAttribute);
                        }
                        $productPackQuantityList[(int)$packProduct['id_product_pack']] = (int)floor(((int)$currentAvailableStock - self::getCartQuantity((int)$packProduct['id_product'], (int)$idProductAttribute) - $cartPackStock) / (int)$stockNeededByIdProductIdProductAttribute[(int)$packProduct['id_product']][$idProductAttribute]);
                    }
                }
            }
            if (AdvancedPackCoreClass::_isFilledArray($productPackQuantityList)) {
                $packAvailableQuantity = (int)min(array_values($productPackQuantityList));
            } else {
                $packAvailableQuantity = self::PACK_FAKE_STOCK;
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, (int)$packAvailableQuantity);
        return (int)$packAvailableQuantity;
    }
    public static function isPackAvailableInAtLeastCombinations($idPack)
    {
        $packQuantityList = self::getPackAvailableQuantityList($idPack);
        foreach ($packQuantityList as $idProductPack => $quantities) {
            if (max($quantities) <= 0) {
                return false;
            }
        }
        return true;
    }
    public static function getPackAvailableQuantityList($idPack, $attributesList = [], $quantityList = [], $useCache = true)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . json_encode($attributesList) . json_encode($quantityList), true);
        if (!$useCache || !self::isInCache($cacheId)) {
            $currentPackCartStock = self::getPackProductsCartQuantity();
            $packContent = self::getPackContent($idPack, null, false, $attributesList, $quantityList);
            $productPackQuantityList = [];
            $config = pm_advancedpack::getModuleConfigurationStatic();
            $packAllowRemove = AdvancedPack::getPackAllowRemoveProduct($idPack);
            $packShowProductsQuantityWanted = (isset($config['showProductsQuantityWanted']) ? $config['showProductsQuantityWanted'] : false);
            if ($packContent !== false) {
                foreach ($packContent as $packProduct) {
                    $productAttributesList = self::getProductAttributeWhiteList($packProduct['id_product_pack']);
                    if (!pm_advancedpack::_isFilledArray($productAttributesList)) {
                        $productAttributesList = array_keys(self::getProductCombinationsByIdProductPack((int)$packProduct['id_product_pack']));
                    }
                    if (!pm_advancedpack::_isFilledArray($productAttributesList)) {
                        $productAttributesList = [0];
                    }
                    if (!Product::isAvailableWhenOutOfStock(StockAvailable::outOfStock((int)$packProduct['id_product']))) {
                        foreach ($productAttributesList as $idProductAttribute) {
                            $cartPackStock = 0;
                            if (isset($currentPackCartStock[(int)$packProduct['id_product']][(int)$idProductAttribute])) {
                                $cartPackStock = $currentPackCartStock[(int)$packProduct['id_product']][(int)$idProductAttribute];
                            }
                            if ($packAllowRemove && $packShowProductsQuantityWanted) {
                                $productPackQuantityList[(int)$packProduct['id_product_pack']][$idProductAttribute] =
                                    (int)StockAvailable::getQuantityAvailableByProduct((int)$packProduct['id_product'], $idProductAttribute)
                                    - self::getCartQuantity((int)$packProduct['id_product'], (int)$idProductAttribute)
                                    - $cartPackStock
                                ;
                            } else {
                                $productPackQuantityList[(int)$packProduct['id_product_pack']][$idProductAttribute] = (int)floor(
                                    (
                                        (int)StockAvailable::getQuantityAvailableByProduct((int)$packProduct['id_product'], $idProductAttribute)
                                        - self::getCartQuantity((int)$packProduct['id_product'], (int)$idProductAttribute)
                                        - $cartPackStock
                                    )
                                    / (int)$packProduct['quantity']
                                );
                            }
                        }
                    } else {
                        foreach ($productAttributesList as $idProductAttribute) {
                            $productPackQuantityList[(int)$packProduct['id_product_pack']][$idProductAttribute] = self::PACK_FAKE_STOCK;
                        }
                    }
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $productPackQuantityList);
        return $productPackQuantityList;
    }
    public static function getPackWeight($idPack)
    {
        $packContent = self::getPackContent($idPack);
        $packWeight = 0;
        if ($packContent !== false) {
            foreach ($packContent as $packProduct) {
                $product = new Product((int)$packProduct['id_product']);
                $packWeight += (float)$product->weight * (int)$packProduct['quantity'];
            }
        }
        return (float)$packWeight;
    }
    public static function getPackOosMessage($idPack, $idLang, $packAttributesList = [], $packExcludeList = [])
    {
        $packContent = self::getPackContent($idPack, null, false, $packAttributesList);
        if ($packContent !== false) {
            foreach ($packContent as $packProduct) {
                if (in_array((int)$packProduct['id_product_pack'], $packExcludeList)) {
                    continue;
                }
                if (!isset($packAttributesList[$packProduct['id_product_pack']]) || !is_numeric($packAttributesList[$packProduct['id_product_pack']])) {
                    $idProductAttribute = (int)$packProduct['default_id_product_attribute'];
                } else {
                    $idProductAttribute = (int)$packAttributesList[$packProduct['id_product_pack']];
                }
                $stockAvailable = (int)StockAvailable::getQuantityAvailableByProduct((int)$packProduct['id_product'], $idProductAttribute);
                if ($stockAvailable <= 0 && Product::isAvailableWhenOutOfStock(StockAvailable::outOfStock((int)$packProduct['id_product']))) {
                    $productObj = new Product((int)$packProduct['id_product'], false, (int)$idLang);
                    return $productObj->available_later;
                }
            }
        }
        return false;
    }
    public static function getPackWholesalePrice($idPack)
    {
        $packContent = self::getPackContent($idPack);
        $packWholesale = 0;
        if ($packContent !== false) {
            foreach ($packContent as $packProduct) {
                $product = new Product((int)$packProduct['id_product']);
                $defaultPackProductCombination = null;
                if (!empty($packProduct['default_id_product_attribute'])) {
                    $defaultPackProductCombination = new Combination($packProduct['default_id_product_attribute']);
                }
                if (Validate::isLoadedObject($defaultPackProductCombination) && $defaultPackProductCombination->wholesale_price > 0) {
                    $packWholesale += (float)$defaultPackProductCombination->wholesale_price * (int)$packProduct['quantity'];
                } else {
                    $packWholesale += (float)$product->wholesale_price * (int)$packProduct['quantity'];
                }
            }
        }
        return (float)$packWholesale;
    }
    public static function getPackIdTaxRulesGroup($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack);
        $finalIdTaxRulesGroup = 0;
        if (!self::isInCache($cacheId)) {
            $packContent = self::getPackContent($idPack);
            $idTaxRulesGroup = [];
            if ($packContent !== false) {
                foreach ($packContent as $packProduct) {
                    $idTaxRulesGroup[] = (int)Product::getIdTaxRulesGroupByIdProduct((int)$packProduct['id_product']);
                }
            }
            $idTaxRulesGroup = array_unique($idTaxRulesGroup);
            if (count($idTaxRulesGroup) == 1) {
                $finalIdTaxRulesGroup = (int)current($idTaxRulesGroup);
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $finalIdTaxRulesGroup);
        return $finalIdTaxRulesGroup;
    }
    public static function getPackEcoTax($idPack, $idProductAttributeList = [], $packIdTaxRulesGroup = null)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . json_encode($idProductAttributeList) . (int)$packIdTaxRulesGroup);
        if (self::isInCache($cacheId)) {
            return self::getFromCache($cacheId);
        }
        $packContent = self::getPackContent($idPack);
        $packEcoTaxAmount = 0;
        if ($packContent !== false) {
            foreach ($packContent as $packProduct) {
                $productPackIdAttribute = (isset($idProductAttributeList[(int)$packProduct['id_product_pack']]) ? $idProductAttributeList[(int)$packProduct['id_product_pack']] : $packProduct['default_id_product_attribute']);
                $packEcoTaxAmount += self::getProductEcoTax((int)$packProduct['id_product'], $productPackIdAttribute) * (int)$packProduct['quantity'];
            }
        }
        if (!empty($packIdTaxRulesGroup)) {
            list($address) = self::getAddressInstance();
            $taxManager = TaxManagerFactory::getManager($address, $packIdTaxRulesGroup);
            $productTaxCalculator = $taxManager->getTaxCalculator();
            $packEcoTaxAmount = $productTaxCalculator->removeTaxes($packEcoTaxAmount);
        }
        self::storeInCache($cacheId, (float)$packEcoTaxAmount);
        return (float)$packEcoTaxAmount;
    }
    public static function getProductEcoTax($idProduct, $idProductAttribute)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProduct . (int)$idProductAttribute);
        if (!self::isInCache($cacheId)) {
            $product = new Product((int)$idProduct);
            if (Validate::isLoadedObject($product)) {
                $combinationObj = new Combination($idProductAttribute);
                if (Validate::isLoadedObject($combinationObj) && $combinationObj->ecotax > 0) {
                    self::storeInCache($cacheId, (float)$combinationObj->ecotax);
                    return (float)$combinationObj->ecotax;
                }
                self::storeInCache($cacheId, (float)$product->ecotax);
                return (float)$product->ecotax;
            }
            self::storeInCache($cacheId, 0);
            return 0;
        } else {
            return self::getFromCache($cacheId);
        }
    }
    public static function getProductPackCustomizationFields($idProduct, $idLang = null)
    {
        if ($idLang == null) {
            $idLang = self::getContext()->language->id;
        }
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProduct . (int)$idLang);
        if (!self::isInCache($cacheId)) {
            $productObj = new Product($idProduct, false, $idLang);
            if (Validate::isLoadedObject($productObj)) {
                $customizationFields = $productObj->getCustomizationFields($idLang);
                if (AdvancedPackCoreClass::_isFilledArray($customizationFields)) {
                    foreach ($customizationFields as $k => $customizationField) {
                        if ($customizationField['type'] != 1) {
                            unset($customizationFields[$k]);
                        }
                    }
                    self::storeInCache($cacheId, $customizationFields);
                    return $customizationFields;
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, []);
        return [];
    }
    public static function getPackCustomizationRequiredFields($idPack, $packExcludeList = [])
    {
        if (!$idPack || !Customization::isFeatureActive()) {
            return [];
        }
        $sql = new DbQuery();
        $sql->select('GROUP_CONCAT(cf.`id_customization_field`)');
        $sql->from('customization_field', 'cf');
        $sql->innerJoin('pm_advancedpack_products', 'app', 'app.`id_pack`=' . (int)$idPack . ' AND app.`id_product`=cf.`id_product`');
        $sql->where('cf.`required`=1');
        if (AdvancedPackCoreClass::_isFilledArray($packExcludeList)) {
            $sql->where('app.`id_product_pack` NOT IN (' . implode(',', array_map('intval', $packExcludeList)) . ')');
        }
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        if (!empty($result)) {
            return array_map('intval', explode(',', $result));
        }
        return [];
    }
    public static function getMaxImagesPerProduct($productsPack)
    {
        $maxImages = [];
        foreach ($productsPack as $productPack) {
            if (isset($productPack['images']) && is_array($productPack['images'])) {
                $maxImages[] = count($productPack['images']);
            }
        }
        if (count($maxImages)) {
            return max($maxImages);
        }
        return 0;
    }
    public static function getExclusiveProducts()
    {
        $idShop = (int)Context::getContext()->shop->id;
        $cacheId = self::getPMCacheId(__METHOD__ . '_' . (int)$idShop);
        if (!self::isInCache($cacheId)) {
            $idProductExclusiveList = [];
            $sql = new DbQuery();
            $sql->select('GROUP_CONCAT(DISTINCT app.`id_product`)');
            $sql->from('pm_advancedpack_products', 'app');
            $sql->innerJoin('product_shop', 'p_shop', 'p_shop.`id_shop`=' . (int)$idShop . ' AND p_shop.`id_product` = app.`id_pack` AND p_shop.`active` = 1');
            $sql->where('app.`exclusive`=1');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if (!empty($result)) {
                $idProductExclusiveList = explode(',', $result);
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $idProductExclusiveList);
        return $idProductExclusiveList;
    }
    public static function getIdsPacks($fromAllShop = false)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$fromAllShop);
        if (!self::isInCache($cacheId)) {
            $idPackList = [];
            $sql = new DbQuery();
            $sql->select('app.`id_pack`');
            $sql->from('pm_advancedpack', 'app');
            if (!$fromAllShop) {
                $sql->where('app.`id_shop` IN (' . implode(', ', Shop::getContextListShopID()) . ')');
            }
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    $idPackList[] = (int)$row['id_pack'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $idPackList);
        return $idPackList;
    }
    public static function getIdPacksByIdProduct($idProduct)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProduct);
        if (!self::isInCache($cacheId)) {
            $idPackList = [];
            $sql = new DbQuery();
            $sql->select('DISTINCT app.`id_pack`');
            $sql->from('pm_advancedpack', 'ap');
            $sql->innerJoin('pm_advancedpack_products', 'app', 'app.`id_pack` = ap.`id_pack`');
            $sql->where('ap.`id_shop` IN (' . implode(', ', Shop::getContextListShopID()) . ')');
            $sql->where('app.`id_product`=' . (int)$idProduct);
            $sql->where('ap.`is_bundle`=0');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    $idPackList[] = (int)$row['id_pack'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $idPackList);
        return $idPackList;
    }
    public static function getNativeIdsPacks()
    {
        $cacheId = self::getPMCacheId(__METHOD__);
        if (!self::isInCache($cacheId)) {
            $idPackList = [];
            $sql = new DbQuery();
            $sql->select('DISTINCT(`id_product_pack`) as `native_id_pack`');
            $sql->innerJoin('product_shop', 'p_shop', 'p_shop.`id_shop`=' . (int)Context::getContext()->shop->id . ' AND p_shop.`id_product` = `id_product_pack`');
            $sql->from('pack');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    $idPackList[] = (int)$row['native_id_pack'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $idPackList);
        return $idPackList;
    }
    public static function getIdProductAttributeListByIdPack($idPack, $idProductAttribute = null)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . ($idProductAttribute !== null ? (int)$idProductAttribute : ''), true);
        $productAttributeList = [];
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('pm_advancedpack_products', 'app');
            if ($idProductAttribute !== null) {
                $sql->innerJoin('pm_advancedpack_cart_products', 'acp', 'acp.`id_pack`=' . (int)$idPack . ' AND acp.`id_product_pack`=app.`id_product_pack` AND acp.`id_product_attribute_pack`=' . (int)$idProductAttribute);
            }
            $sql->where('app.`id_pack`=' . (int)$idPack);
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    if ($idProductAttribute !== null) {
                        $productAttributeList[(int)$row['id_product_pack']] = (int)$row['id_product_attribute'];
                    } else {
                        $productAttributeList[(int)$row['id_product_pack']] = (int)$row['default_id_product_attribute'];
                    }
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $productAttributeList);
        return $productAttributeList;
    }
    public static function getPackAttributeUniqueName($idPack, $idProductAttribute, $idLang = null)
    {
        if ($idLang == null) {
            $idLang = self::getContext()->language->id;
        }
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . (int)$idProductAttribute . (int)$idLang);
        if (!self::isInCache($cacheId)) {
            $productCombination = new Combination($idProductAttribute);
            $productAttributesNames = $productCombination->getAttributesName($idLang);
            if (is_array($productAttributesNames) && count($productAttributesNames) == 1) {
                $attributeName = current($productAttributesNames);
                if (isset($attributeName['name']) && !empty($attributeName['name'])) {
                    self::storeInCache($cacheId, $attributeName['name']);
                    return $attributeName['name'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, false);
        return false;
    }
    public static function getProductAttributeList($idProductAttribute, $idLang = null)
    {
        if ($idLang == null) {
            $idLang = self::getContext()->language->id;
        }
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProductAttribute . (int)$idLang);
        if (!self::isInCache($cacheId)) {
            $attributeList = ['attributes' => [], 'attributes_small' => []];
            if ($idProductAttribute) {
                $result = Db::getInstance()->executeS('
                    SELECT pa.`reference`,pac.`id_product_attribute`, agl.`public_name` AS public_group_name, al.`name` AS attribute_name
                    FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON a.`id_attribute` = pac.`id_attribute`
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag ON ag.`id_attribute_group` = a.`id_attribute_group`
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al ON (a.`id_attribute` = al.`id_attribute` AND al.`id_lang` = ' . (int)$idLang . ')
                    LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl ON (ag.`id_attribute_group` = agl.`id_attribute_group` AND agl.`id_lang` = ' . (int)$idLang . ')
                    LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON (pac.`id_product_attribute` = pa.`id_product_attribute`)
                    WHERE pac.`id_product_attribute`=' . (int)$idProductAttribute . '
                    ORDER BY agl.`public_name` ASC');
                if (AdvancedPackCoreClass::_isFilledArray($result)) {
                    foreach ($result as $attributeRow) {
                        $attributeList['attributes'][] = $attributeRow['public_group_name'] . ' : ' . $attributeRow['attribute_name'];
                        $attributeList['attributes_small'][] = $attributeRow['attribute_name'];
                        $attributeList['reference'][] = $attributeRow['reference'];
                    }
                    $attributeList['attributes'] = implode(', ', $attributeList['attributes']);
                    $attributeList['attributes_small'] = implode(', ', $attributeList['attributes_small']);
                    $attributeList['reference'] = implode(', ', $attributeList['reference']);
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $attributeList);
        return $attributeList;
    }
    public static function getProductCombinations($idProduct, $ignoreModuleAttributeGroup = true)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProduct . (int)$ignoreModuleAttributeGroup . self::getContext()->shop->id);
        if (!self::isInCache($cacheId)) {
            $combinationsList = [];
            $result = Db::getInstance()->executeS('
                SELECT pac.`id_product_attribute`, pac.`id_attribute`
                FROM `' . _DB_PREFIX_ . 'product_attribute` pa
                ' . Shop::addSqlAssociation('product_attribute', 'pa') .
                'JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON pac.`id_product_attribute` = pa.`id_product_attribute`'
                . ($ignoreModuleAttributeGroup ? ' JOIN `' . _DB_PREFIX_ . 'attribute` a ON (a.`id_attribute` = pac.`id_attribute` AND a.`id_attribute_group` != ' . (int)self::getPackAttributeGroupId() . ')' : '') .
                'WHERE pa.`id_product` = ' . (int)$idProduct);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $combinationRow) {
                    $combinationsList[(int)$combinationRow['id_product_attribute']][] = (int)$combinationRow['id_attribute'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $combinationsList);
        return $combinationsList;
    }
    public static function getProductCombinationsByIdProductPack($idProductPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProductPack . self::getContext()->shop->id);
        if (!self::isInCache($cacheId)) {
            $combinationsList = [];
            $result = Db::getInstance()->executeS('
                SELECT pac.`id_product_attribute`, pac.`id_attribute`
                FROM `' . _DB_PREFIX_ . 'product_attribute` pa
                ' . Shop::addSqlAssociation('product_attribute', 'pa') . '
                JOIN `' . _DB_PREFIX_ . 'pm_advancedpack_products` app ON app.`id_product` = pa.`id_product`
                JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON pac.`id_product_attribute` = pa.`id_product_attribute`
                WHERE app.`id_product_pack` = ' . (int)$idProductPack);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $combinationRow) {
                    $combinationsList[(int)$combinationRow['id_product_attribute']][] = (int)$combinationRow['id_attribute'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $combinationsList);
        return $combinationsList;
    }
    public static function getProductAttributeWhiteList($idProductPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProductPack);
        $whiteListFinal = [];
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('appa.`id_product_attribute`');
            $sql->from('pm_advancedpack_products', 'app');
            $sql->innerJoin('pm_advancedpack_products_attributes', 'appa', 'appa.`id_product_pack`=app.`id_product_pack`');
            $sql->where('app.`id_product_pack`=' . (int)$idProductPack);
            $whiteList = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($whiteList)) {
                foreach ($whiteList as $whiteListRow) {
                    $whiteListFinal[] = (int)$whiteListRow['id_product_attribute'];
                }
                self::storeInCache($cacheId, $whiteListFinal);
                return $whiteListFinal;
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $whiteListFinal);
        return $whiteListFinal;
    }
    public static function getPackProductAttributeList($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack);
        $attributeReductionList = $attributeReductionListFinal = [];
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('appa.*');
            $sql->from('pm_advancedpack_products', 'app');
            $sql->innerJoin('pm_advancedpack_products_attributes', 'appa', 'appa.`id_product_pack`=app.`id_product_pack`');
            $sql->where('app.`id_pack`=' . (int)$idPack);
            $attributeReductionList = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($attributeReductionList)) {
                foreach ($attributeReductionList as $attributeReductionListRow) {
                    $attributeReductionListFinal[(int)$attributeReductionListRow['id_product_pack']][(int)$attributeReductionListRow['id_product_attribute']] = [
                        'reduction_amount' => $attributeReductionListRow['reduction_amount'],
                        'reduction_type' => $attributeReductionListRow['reduction_type'],
                    ];
                }
                self::storeInCache($cacheId, $attributeReductionListFinal);
                return $attributeReductionListFinal;
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $attributeReductionListFinal);
        return $attributeReductionListFinal;
    }
    public static function getProductCustomizationFieldWhiteList($idProductPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProductPack);
        $whiteListFinal = [];
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('appc.`id_customization_field`');
            $sql->from('pm_advancedpack_products', 'app');
            $sql->innerJoin('pm_advancedpack_products_customization', 'appc', 'appc.`id_product_pack`=app.`id_product_pack`');
            $sql->where('app.`id_product_pack`=' . (int)$idProductPack);
            $whiteList = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($whiteList)) {
                foreach ($whiteList as $whiteListRow) {
                    $whiteListFinal[] = (int)$whiteListRow['id_customization_field'];
                }
                self::storeInCache($cacheId, $whiteListFinal);
                return $whiteListFinal;
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $whiteListFinal);
        return $whiteListFinal;
    }
    public static function getPackAttributeGroupId()
    {
        $cacheId = self::getPMCacheId(__METHOD__ . self::getContext()->language->id . self::getContext()->shop->id);
        if (!self::isInCache($cacheId)) {
            $attributeGroups = AttributeGroup::getAttributesGroups(self::getContext()->language->id);
            if (AdvancedPackCoreClass::_isFilledArray($attributeGroups)) {
                foreach ($attributeGroups as $attributeGroup) {
                    if ($attributeGroup['name'] == 'AP5-Pack') {
                        self::storeInCache($cacheId, (int)$attributeGroup['id_attribute_group']);
                        return (int)$attributeGroup['id_attribute_group'];
                    }
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, false);
        return false;
    }
    public static function getIdCountryListByIdPack($idPack, $addAllActive = false)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack, true);
        $idCountryList = [0, (int)self::getContext()->country->id];
        list($address) = self::getAddressInstance();
        if (is_object($address) && !empty($address->id_country)) {
            $idCountryList[] = (int)$address->id_country;
        }
        if ($addAllActive) {
            $countries = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT c.`id_country` FROM `' . _DB_PREFIX_ . 'country` c ' . Shop::addSqlAssociation('country', 'c') . ' WHERE c.`active`=1');
            if (AdvancedPackCoreClass::_isFilledArray($countries)) {
                foreach ($countries as $country) {
                    $idCountryList[] = (int)$country['id_country'];
                }
            }
        }
        if (!self::isInCache($cacheId)) {
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT sp.`id_country`
                FROM `' . _DB_PREFIX_ . 'specific_price` sp
                WHERE sp.`id_product` IN (
                    SELECT app.`id_product`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedpack_products` app
                    WHERE app.`id_pack`=' . (int)$idPack . '
                )
            ');
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    $idCountryList[] = (int)$row['id_country'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        $idCountryList = array_unique($idCountryList);
        self::storeInCache($cacheId, $idCountryList);
        return $idCountryList;
    }
    public static function getIdGroupListByIdPack($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack, true);
        $idGroupList = [0];
        if (!self::isInCache($cacheId)) {
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT sp.`id_group`
                FROM `' . _DB_PREFIX_ . 'specific_price` sp
                WHERE sp.`id_product` IN (
                    SELECT app.`id_product`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedpack_products` app
                    WHERE app.`id_pack`=' . (int)$idPack . '
                )
            ');
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    $idGroupList[] = (int)$row['id_group'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        $idGroupList = array_unique($idGroupList);
        self::storeInCache($cacheId, $idGroupList);
        return $idGroupList;
    }
    public static function getIdCurrencyListByIdPack($idPack, $addAllActive = false)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack, true);
        $idCurrencyList = [0, (int)Configuration::get('PS_CURRENCY_DEFAULT')];
        if (Validate::isLoadedObject(self::getContext()->currency)) {
            $idCurrencyList[] = self::getContext()->currency->id;
        }
        if ($addAllActive) {
            $currencies = Currency::getCurrencies(false, true);
            if (AdvancedPackCoreClass::_isFilledArray($currencies)) {
                foreach ($currencies as $currency) {
                    $idCurrencyList[] = (int)$currency['id_currency'];
                }
            }
        }
        if (!self::isInCache($cacheId)) {
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT sp.`id_currency`
                FROM `' . _DB_PREFIX_ . 'specific_price` sp
                WHERE sp.`id_product` IN (
                    SELECT app.`id_product`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedpack_products` app
                    WHERE app.`id_pack`=' . (int)$idPack . '
                )
            ');
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $row) {
                    $idCurrencyList[] = (int)$row['id_currency'];
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        $idCurrencyList = array_unique($idCurrencyList);
        self::storeInCache($cacheId, $idCurrencyList);
        return $idCurrencyList;
    }
    public static function addCustomPackProductAttribute($idPack, $attributesList, $packUniqueHash = null, $defaultCombination = false)
    {
        $idProductAttribute = false;
        $combinationObj = null;
        if ($packUniqueHash !== null) {
            $idProductAttribute = (int)Db::getInstance()->getValue('SELECT `id_product_attribute_pack` FROM `' . _DB_PREFIX_ . 'pm_advancedpack_cart_products` WHERE `id_order` IS NULL AND `unique_hash` = "' . pSQL($packUniqueHash) . '" AND `id_pack` = ' . (int)$idPack . ' AND `id_cart` = ' . (int)self::getContext()->cookie->id_cart);
            if ($idProductAttribute) {
                $combinationObj = new Combination($idProductAttribute);
                if (!Validate::isLoadedObject($combinationObj)) {
                    Db::getInstance()->getValue('DELETE FROM `' . _DB_PREFIX_ . 'pm_advancedpack_cart_products` WHERE `id_product_attribute_pack`=' . (int)$idProductAttribute . ' AND `id_order` IS NULL AND `unique_hash` = "' . pSQL($packUniqueHash) . '" AND `id_pack` = ' . (int)$idPack . ' AND `id_cart` = ' . (int)self::getContext()->cookie->id_cart);
                    $idProductAttribute = false;
                }
            }
        }
        if (!$idProductAttribute && $defaultCombination) {
            $idProductAttribute = Product::getDefaultAttribute($idPack);
            if ($idProductAttribute) {
                $combinationObj = new Combination($idProductAttribute);
                if (!Validate::isLoadedObject($combinationObj)) {
                    $idProductAttribute = false;
                } else {
                    $hasRealDefaultAttribute = false;
                    $tmpAttributeList = AdvancedPack::getProductAttributeList($combinationObj->id);
                    if (isset($tmpAttributeList['attributes_small']) && $tmpAttributeList['attributes_small'] == $idPack . '-defaultCombination') {
                        $hasRealDefaultAttribute = true;
                    }
                    if (!$hasRealDefaultAttribute) {
                        $idProductAttribute = false;
                        $combinationObj->default_on = false;
                        $combinationObj->save();
                        $combinationObj = null;
                    }
                }
            }
        }
        if (!$idProductAttribute) {
            if ($defaultCombination) {
                $uniqueId = $idPack . '-defaultCombination';
            } else {
                $uniqueId = uniqid();
            }
            if (version_compare(_PS_VERSION_, '8.0.0', '>=')) {
                $attributeObj = new ProductAttribute();
            } else {
                $attributeObj = new Attribute();
            }
            $attributeObj->id_attribute_group = self::getPackAttributeGroupId();
            foreach (Language::getLanguages(false) as $lang) {
                $attributeObj->name[$lang['id_lang']] = $uniqueId;
            }
            if ($attributeObj->save()) {
                $idAttribute = $attributeObj->id;
                $combinationObj = new Combination();
                $combinationObj->id_product = (int)$idPack;
                $combinationObj->default_on = (bool)$defaultCombination;
                $combinationObj->minimal_quantity = 1;
                $combinationObj->ecotax = 0;
                if ($defaultCombination) {
                    if (property_exists($combinationObj, 'quantity') && version_compare(_PS_VERSION_, '8.0.0', '<')) {
                        $combinationObj->quantity = self::getPackAvailableQuantity($idPack, $attributesList, [], [], null, false);
                    }
                }
                $idWarehouse = false;
                $packProducts = self::getPackContent($idPack);
                if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
                    foreach ($packProducts as $packProduct) {
                        $idProductAttributeWeight = (isset($attributesList[(int)$packProduct['id_product_pack']]) ? $attributesList[(int)$packProduct['id_product_pack']] : (int)$packProduct['default_id_product_attribute']);
                        if ($idProductAttributeWeight) {
                            $combinationWeightObj = new Combination($idProductAttributeWeight);
                            if (Validate::isLoadedObject($combinationWeightObj)) {
                                $combinationObj->weight += (float)$combinationWeightObj->weight * (int)$packProduct['quantity'];
                            }
                            unset($combinationWeightObj);
                        }
                        if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && !$idWarehouse) {
                            $warehouseList = Warehouse::getProductWarehouseList((int)$packProduct['id_product'], $idProductAttributeWeight);
                            if (AdvancedPackCoreClass::_isFilledArray($warehouseList)) {
                                foreach ($warehouseList as $warehouseRow) {
                                    $idWarehouse = (int)$warehouseRow['id_warehouse'];
                                    break;
                                }
                            }
                        }
                    }
                }
                unset($packProducts);
                if (!$combinationObj->save() || !$combinationObj->setAttributes([$idAttribute])) {
                    return false;
                }
                if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && $idWarehouse) {
                    $warehouseLocationEntity = new WarehouseProductLocation();
                    $warehouseLocationEntity->id_product = (int)$combinationObj->id_product;
                    $warehouseLocationEntity->id_product_attribute = (int)$combinationObj->id;
                    $warehouseLocationEntity->id_warehouse = (int)$idWarehouse;
                    $warehouseLocationEntity->location = '';
                    $warehouseLocationEntity->save();
                    StockAvailable::synchronize((int)$combinationObj->id_product);
                }
            }
        } else {
            $combinationObj = new Combination($idProductAttribute);
        }
        if (!Validate::isLoadedObject($combinationObj)) {
            return false;
        }
        if (AdvancedPack::isValidPack($idPack, true)) {
            self::setStockAvailableQuantity($idPack, $combinationObj->id, self::getPackAvailableQuantity($idPack, $attributesList, [], [], $combinationObj->id, false), false, $defaultCombination);
        } else {
            self::setStockAvailableQuantity($idPack, $combinationObj->id, 0, false);
        }
        if ($defaultCombination) {
            self::setDefaultPackAttribute((int)$idPack, (int)$combinationObj->id);
        }
        return (int)$combinationObj->id;
    }
    public static function setStockAvailableQuantity($idProduct, $idProductAttribute, $quantity, $runUpdateQuantityHook = true, $defaultCombination = false)
    {
        $combinationObj = new Combination($idProductAttribute, null, (int)AdvancedPack::getPackIdShop($idProduct));
        if (Validate::isLoadedObject($combinationObj)) {
            if (empty($combinationObj->id_product)) {
                $idShopList = $combinationObj->getAssociatedShops();
                if (is_array($idShopList) && count($idShopList)) {
                    $idShop = current($idShopList);
                    $combinationObj = new Combination($idProductAttribute, null, (int)$idShop);
                }
            }
            $currentQuantity = (int)StockAvailable::getQuantityAvailableByProduct((int)$idProduct, (int)$idProductAttribute);
            if (property_exists($combinationObj, 'quantity') && version_compare(_PS_VERSION_, '8.0.0', '<')) {
                if ($combinationObj->quantity != $quantity) {
                    $combinationObj->quantity = (int)$quantity;
                    $combinationObj->minimal_quantity = 1;
                    $combinationObj->save();
                }
            }
            if ($currentQuantity != $quantity) {
                if ($runUpdateQuantityHook) {
                    return StockAvailable::setQuantity((int)$idProduct, (int)$idProductAttribute, (int)$quantity);
                } else {
                    $id_shop = null;
                    if (Shop::getContext() != Shop::CONTEXT_GROUP) {
                        $id_shop = (int)self::getContext()->shop->id;
                    }
                    $id_stock_available = (int)StockAvailable::getStockAvailableIdByProductId((int)$idProduct, (int)$idProductAttribute, $id_shop);
                    if ($id_stock_available) {
                        $stock_available = new StockAvailable($id_stock_available);
                        if ((int)$stock_available->quantity != (int)$quantity) {
                            $stock_available->quantity = (int)$quantity;
                            $stock_available->update();
                        }
                    } else {
                        $out_of_stock = StockAvailable::outOfStock((int)$idProduct, $id_shop);
                        $stock_available = new StockAvailable();
                        $stock_available->out_of_stock = (int)$out_of_stock;
                        $stock_available->id_product = (int)$idProduct;
                        $stock_available->id_product_attribute = (int)$idProductAttribute;
                        $stock_available->quantity = (int)$quantity;
                        if ($id_shop === null) {
                            $shop_group = Shop::getContextShopGroup();
                        } else {
                            $shop_group = new ShopGroup((int)Shop::getGroupFromShop((int)$id_shop));
                        }
                        if ($shop_group->share_stock) {
                            $stock_available->id_shop = 0;
                            $stock_available->id_shop_group = (int)$shop_group->id;
                        } else {
                            $stock_available->id_shop = (int)$id_shop;
                            $stock_available->id_shop_group = 0;
                        }
                        $stock_available->add();
                    }
                    if ($defaultCombination) {
                        $id_stock_available = (int)StockAvailable::getStockAvailableIdByProductId((int)$idProduct, 0, $id_shop);
                        if ($id_stock_available) {
                            $stock_available = new StockAvailable($id_stock_available);
                            if ((int)$stock_available->quantity != (int)$quantity) {
                                $stock_available->quantity = (int)$quantity;
                                $stock_available->update();
                            }
                        }
                    }
                    Cache::clean('StockAvailable::getQuantityAvailableByProduct_' . (int)$idProduct . '*');
                }
            }
        }
        return false;
    }
    public static function updatePackStock($idPack)
    {
        $config = pm_advancedpack::getModuleConfigurationStatic();
        if (empty($config['postponeUpdatePackSpecificPrice'])) {
            self::updateFakePackCombinationStock($idPack);
        }
        self::setStockAvailableQuantity((int)$idPack, (int)Product::getDefaultAttribute($idPack), self::getPackAvailableQuantity($idPack, [], [], [], null, false), false);
    }
    public static function updateFakePackCombinationStock($idPack)
    {
        $packProducts = self::getPackContent($idPack);
        $minStockAvailableByIdAttribute = [];
        $minStockAvailableForProductsWithoutAttributes = null;
        if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
            foreach ($packProducts as $packProduct) {
                $product = new Product((int)$packProduct['id_product']);
                $attributesWhitelist = self::getProductAttributeWhiteList($packProduct['id_product_pack']);
                $isAvailableWhenOutOfStock = Product::isAvailableWhenOutOfStock(StockAvailable::outOfStock((int)$packProduct['id_product']));
                if (AdvancedPackCoreClass::_isFilledArray($attributesWhitelist)) {
                    foreach ($attributesWhitelist as $idProductAttribute) {
                        $combinationList = $product->getAttributeCombinationsById($idProductAttribute, self::getContext()->language->id);
                        if (AdvancedPackCoreClass::_isFilledArray($combinationList)) {
                            foreach ($combinationList as $combinationRow) {
                                if ($isAvailableWhenOutOfStock) {
                                    $stockAvailable = self::PACK_FAKE_STOCK;
                                } else {
                                    $stockAvailable = (int)$combinationRow['quantity'];
                                }
                                if (!isset($minStockAvailableByIdAttribute[(int)$combinationRow['id_attribute']]) || $stockAvailable < $minStockAvailableByIdAttribute[(int)$combinationRow['id_attribute']]) {
                                    $minStockAvailableByIdAttribute[(int)$combinationRow['id_attribute']] = $stockAvailable;
                                }
                            }
                        }
                    }
                } else {
                    $combinationList = $product->getAttributeCombinations(self::getContext()->language->id);
                    if (AdvancedPackCoreClass::_isFilledArray($combinationList)) {
                        foreach ($combinationList as $combinationRow) {
                            if ($isAvailableWhenOutOfStock) {
                                $stockAvailable = self::PACK_FAKE_STOCK;
                            } else {
                                $stockAvailable = (int)$combinationRow['quantity'];
                            }
                            if (!isset($minStockAvailableByIdAttribute[(int)$combinationRow['id_attribute']]) || $stockAvailable < $minStockAvailableByIdAttribute[(int)$combinationRow['id_attribute']]) {
                                $minStockAvailableByIdAttribute[(int)$combinationRow['id_attribute']] = $stockAvailable;
                            }
                        }
                    } else {
                        if ($isAvailableWhenOutOfStock) {
                            $stockAvailable = self::PACK_FAKE_STOCK;
                        } else {
                            $stockAvailable = StockAvailable::getQuantityAvailableByProduct((int)$packProduct['id_product']);
                        }
                        if ($minStockAvailableForProductsWithoutAttributes == null || $stockAvailable < $minStockAvailableForProductsWithoutAttributes) {
                            $minStockAvailableForProductsWithoutAttributes = $stockAvailable;
                        }
                    }
                }
            }
        }
        $combinationList = self::getProductCombinations($idPack, true);
        if (AdvancedPackCoreClass::_isFilledArray($combinationList)) {
            foreach ($combinationList as $packIdProductAttribute => $attributeList) {
                $idAttribute = current($attributeList);
                $availableQuantity = (isset($minStockAvailableByIdAttribute[$idAttribute]) ? $minStockAvailableByIdAttribute[$idAttribute] : 1);
                if ($minStockAvailableForProductsWithoutAttributes !== null) {
                    $availableQuantity = min([$minStockAvailableForProductsWithoutAttributes, $availableQuantity]);
                }
                if ($minStockAvailableForProductsWithoutAttributes !== null) {
                    $availableQuantity = min([$minStockAvailableForProductsWithoutAttributes, $availableQuantity]);
                }
                self::setStockAvailableQuantity((int)$idPack, (int)$packIdProductAttribute, $availableQuantity, false);
            }
        }
    }
    public static function isValidPack($idPack, $deepCheck = false, $packExcludeList = [], $idProductAttribute = null)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . (int)$deepCheck . (int)$idProductAttribute . json_encode($packExcludeList) . ($deepCheck && Validate::isLoadedObject(self::getContext()->customer) ? self::getContext()->customer->id : 0));
        if (!self::isInCache($cacheId)) {
            $packIdList = AdvancedPack::getIdsPacks(true);
            $result = in_array((int)$idPack, $packIdList);
            if ($result && $deepCheck) {
                $packContent = AdvancedPack::getPackContent($idPack, $idProductAttribute);
                if ($packContent !== false) {
                    foreach ($packContent as $packProduct) {
                        if (in_array((int)$packProduct['id_product_pack'], $packExcludeList)) {
                            continue;
                        }
                        $product = new Product((int)$packProduct['id_product']);
                        $result &= Validate::isLoadedObject($product) && $product->active;
                        $result &= Validate::isLoadedObject($product) && $product->checkAccess(Validate::isLoadedObject(self::getContext()->customer) ? self::getContext()->customer->id : 0);
                        $result &= Validate::isLoadedObject($product) && $product->available_for_order;
                        if ($idProductAttribute && Validate::isLoadedObject($product) && ($product->hasAttributes() || !empty($packProduct['default_id_product_attribute']) || !empty($packProduct['id_product_attribute']))) {
                            $defaultPackProductCombination = false;
                            if (!empty($packProduct['id_product_attribute'])) {
                                $defaultPackProductCombination = new Combination($packProduct['id_product_attribute']);
                            } elseif (!empty($packProduct['default_id_product_attribute'])) {
                                $defaultPackProductCombination = new Combination($packProduct['default_id_product_attribute']);
                            }
                            $result &= Validate::isLoadedObject($defaultPackProductCombination) && ($defaultPackProductCombination->id_product == $product->id);
                        }
                    }
                }
            }
            self::storeInCache($cacheId, $result);
            return $result;
        } else {
            return self::getFromCache($cacheId);
        }
    }
    public static function isVirtualPack($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack);
        if (!self::isInCache($cacheId)) {
            $packContent = self::getPackContent($idPack);
            $isVirtual = true;
            if ($packContent !== false) {
                foreach ($packContent as $packProduct) {
                    $product = new Product((int)$packProduct['id_product']);
                    if ($product->getType() != Product::PTYPE_VIRTUAL) {
                        $isVirtual = false;
                        break;
                    }
                }
            }
            self::storeInCache($cacheId, $isVirtual);
            return $isVirtual;
        } else {
            return self::getFromCache($cacheId);
        }
    }
    public static function isInStock($idPack, $quantity = 1, $attributesList = [], $incrementCartQuantity = false, $idProductAttribute = null)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack . json_encode($attributesList) . (int)$incrementCartQuantity . (int)$idProductAttribute, true);
        $packIsInStock = true;
        if (!self::isInCache($cacheId)) {
            $currentPackCartStock = self::getPackProductsCartQuantity();
            if ($incrementCartQuantity) {
                $packContent = self::getPackContent($idPack, $idProductAttribute);
            } else {
                $packContent = self::getPackContent($idPack);
            }
            if ($packContent !== false) {
                foreach ($packContent as $packProduct) {
                    if (!isset($attributesList[$packProduct['id_product_pack']]) || !is_numeric($attributesList[$packProduct['id_product_pack']])) {
                        $idProductAttribute = (int)$packProduct['default_id_product_attribute'];
                    } else {
                        $idProductAttribute = (int)$attributesList[$packProduct['id_product_pack']];
                    }
                    $cartPackStock = 0;
                    if (isset($currentPackCartStock[(int)$packProduct['id_product']][$idProductAttribute])) {
                        $cartPackStock = $currentPackCartStock[(int)$packProduct['id_product']][$idProductAttribute];
                    }
                    if (Product::isAvailableWhenOutOfStock(StockAvailable::outOfStock((int)$packProduct['id_product']))) {
                        $packIsInStock &= true;
                    } else {
                        $stockAvailable = ((int)StockAvailable::getQuantityAvailableByProduct((int)$packProduct['id_product'], $idProductAttribute) * $quantity) - self::getCartQuantity((int)$packProduct['id_product'], $idProductAttribute) - $cartPackStock;
                        if ($incrementCartQuantity) {
                            $packIsInStock &= $stockAvailable >= 0;
                        } else {
                            $packIsInStock &= $stockAvailable >= ((int)$packProduct['quantity'] * $quantity);
                        }
                    }
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, (int)$packIsInStock);
        return (bool)$packIsInStock;
    }
    public static function getPackAsmState($idPack)
    {
        if (!Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
            return false;
        }
        $packProducts = self::getPackContent($idPack);
        $res = true;
        if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
            $idShop = (int)AdvancedPack::getPackIdShop($idPack);
            foreach ($packProducts as $packProduct) {
                $product = new Product((int)$packProduct['id_product'], false, null, $idShop);
                $res &= (bool)$product->advanced_stock_management;
            }
        }
        return $res;
    }
    public static function getPackIdShop($idPack)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idPack, true);
        $idShop = false;
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('ap.`id_shop`');
            $sql->from('pm_advancedpack', 'ap');
            $sql->where('ap.`id_pack`=' . (int)$idPack);
            $idShop = (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, $idShop);
        return $idShop;
    }
    public static function isFromShop($idPack, $idShop)
    {
        return self::getPackIdShop($idPack) == $idShop;
    }
    public static function combinationExists($idProductPack, $attributesList, $findAlternative = false)
    {
        $attributesWhitelist = self::getProductAttributeWhiteList($idProductPack);
        $productCombinations = self::getProductCombinationsByIdProductPack($idProductPack);
        foreach ($productCombinations as $idProductAttribute => $combinationAttributesList) {
            if (AdvancedPackCoreClass::_isFilledArray($attributesWhitelist) && !in_array($idProductAttribute, $attributesWhitelist)) {
                unset($productCombinations[$idProductAttribute]);
                continue;
            }
            if (!count(array_diff($combinationAttributesList, $attributesList))) {
                return [
                    (int)$idProductAttribute,
                    $attributesList,
                ];
            }
        }
        if ($findAlternative && Configuration::get('PS_DISP_UNAVAILABLE_ATTR') == 0) {
            $idProductAttribute = false;
            $query = new DbQuery();
            $query->select('id_product');
            $query->from('pm_advancedpack_products', 'app');
            $query->where('app.`id_product_pack` = ' . (int)$idProductPack);
            $idProduct = (int)Db::getInstance()->getValue($query);
            $orderredIdAttribute = [];
            $result = Db::getInstance()->executeS('
            SELECT a.`id_attribute`
            FROM `' . _DB_PREFIX_ . 'attribute` a
            INNER JOIN `' . _DB_PREFIX_ . 'attribute_group` g ON a.`id_attribute_group` = g.`id_attribute_group`
            WHERE a.`id_attribute` IN (' . implode(',', array_map('intval', $attributesList)) . ')
            ORDER BY g.`position` ASC');
            foreach ($result as $row) {
                $orderredIdAttribute[] = (int)$row['id_attribute'];
            }
            while ($idProductAttribute === false && count($orderredIdAttribute) > 1) {
                array_pop($orderredIdAttribute);
                $idProductAttribute = Db::getInstance()->getValue('
                SELECT pac.`id_product_attribute`
                FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac
                INNER JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON pa.`id_product_attribute` = pac.`id_product_attribute`
                WHERE pa.`id_product` = ' . (int)$idProduct . '
                AND pac.`id_attribute` IN (' . implode(',', array_map('intval', $orderredIdAttribute)) . ')
                ' . (AdvancedPackCoreClass::_isFilledArray($attributesWhitelist) ? 'AND pac.`id_product_attribute` IN (' . implode(',', array_map('intval', $attributesWhitelist)) . ')' : '') . '
                GROUP BY pac.`id_product_attribute`
                HAVING COUNT(pa.`id_product`) = ' . (int)count($orderredIdAttribute));
                if (!isset($productCombinations[$idProductAttribute])) {
                    $idProductAttribute = false;
                }
            }
            if ($idProductAttribute) {
                return [
                    $idProductAttribute,
                    $productCombinations[$idProductAttribute],
                ];
            }
        }
        return [
            false,
            [],
        ];
    }
    protected static function duplicateProductImages($idProductOld, $idProductNew)
    {
        $imagesTypes = ImageType::getImagesTypes('products');
        $result = Db::getInstance()->executeS('
        SELECT i.`id_image`
        FROM `' . _DB_PREFIX_ . 'image` i
        INNER JOIN `' . _DB_PREFIX_ . 'image_shop` image_shop
        ON (i.`id_image` = image_shop.`id_image` AND image_shop.`id_shop` = ' . (int)AdvancedPack::getPackIdShop($idProductNew) . ')
        WHERE i.`id_product` = ' . (int) $idProductOld);
        foreach ($result as $row) {
            $imageOld = new Image($row['id_image']);
            $imageNew = clone $imageOld;
            unset($imageNew->id);
            $imageNew->id_product = (int) $idProductNew;
            if ($imageNew->add()) {
                $newPath = $imageNew->getPathForCreation();
                foreach ($imagesTypes as $imageType) {
                    if (file_exists(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '-' . $imageType['name'] . '.jpg')) {
                        if (!Configuration::get('PS_LEGACY_IMAGES')) {
                            $imageNew->createImgFolder();
                        }
                        copy(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '-' . $imageType['name'] . '.jpg', $newPath . '-' . $imageType['name'] . '.jpg');
                        if (Configuration::get('WATERMARK_HASH')) {
                            $oldImagePath = _PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '-' . $imageType['name'] . '-' . Configuration::get('WATERMARK_HASH') . '.jpg';
                            if (file_exists($oldImagePath)) {
                                copy($oldImagePath, $newPath . '-' . $imageType['name'] . '-' . Configuration::get('WATERMARK_HASH') . '.jpg');
                            }
                        }
                    }
                }
                if (file_exists(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '.jpg')) {
                    copy(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '.jpg', $newPath . '.jpg');
                }
                $imageNew->duplicateShops($idProductOld);
            } else {
                return false;
            }
        }
        return true;
    }
    public static function clonePackImages($idPack)
    {
        $packProducts = self::getPackContent($idPack);
        $res = true;
        // $defaultPackImagePath = dirname(__FILE__) . '/views/img/default-pack-image.png';
        // $coverImage = new Image();
        // $coverImage->id_product = (int)$idPack;
        // $coverImage->position = Image::getHighestPosition($idPack) + 1;
        // if ($coverImage->add() && ($new_path = $coverImage->getPathForCreation()) && ImageManager::resize($defaultPackImagePath, $new_path . '.' . $coverImage->image_format)) {
        //     foreach (ImageType::getImagesTypes('products') as $imageType) {
        //         $res &= ImageManager::resize($defaultPackImagePath, $new_path . '-' . Tools::stripslashes($imageType['name']) . '.' . $coverImage->image_format, $imageType['width'], $imageType['height'], $coverImage->image_format);
        //     }
        // }
        if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
            foreach ($packProducts as $packProduct) {
                $res &= Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'image` i, `' . _DB_PREFIX_ . 'image_shop` i_shop SET i.`cover` = NULL, i_shop.`cover` = NULL WHERE i.`id_image`=i_shop.`id_image` AND i.`id_product` = ' . (int)$idPack);
                $res &= self::duplicateProductImages($packProduct['id_product'], $idPack);
            }
        }
        // if (Validate::isLoadedObject($coverImage)) {
        //     $res &= Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'image` i, `' . _DB_PREFIX_ . 'image_shop` i_shop SET i.`cover` = NULL, i_shop.`cover` = NULL WHERE i.`id_image`=i_shop.`id_image` AND i.`id_product` = ' . (int)$idPack);
        //     $i = 2;
        //     $result = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'image` WHERE `id_product` = ' . (int)$idPack . ' AND `id_image` != ' . (int)$coverImage->id . ' ORDER BY `position`');
        //     if ($result) {
        //         foreach ($result as $row) {
        //             $res &= Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'image` SET `position` = ' . (int)$i . ' WHERE `id_image` = ' . (int)$row['id_image']);
        //             $i++;
        //         }
        //     }
        //     $coverImage->cover = true;
        //     $coverImage->update();
        // }
        return $res;
    }
    protected static function setDefaultPackAttribute($idPack, $idProductAttribute)
    {
        $result = Db::getInstance()->update('product_shop', ['cache_default_attribute' => $idProductAttribute], 'id_product = ' . (int)$idPack . Shop::addSqlRestriction());
        $result &= Db::getInstance()->update('product', ['cache_default_attribute' => $idProductAttribute], 'id_product = ' . (int)$idPack);
        $result &= Db::getInstance()->update('product_attribute_shop', ['default_on' => 1], 'id_product_attribute = ' . (int)$idProductAttribute . Shop::addSqlRestriction());
        $result &= Db::getInstance()->update('product_attribute', ['default_on' => 1], 'id_product_attribute = ' . (int)$idProductAttribute);
        Tools::clearColorListCache($idPack);
        return (bool)$result;
    }
    public static function clonePackAttributes($idPack)
    {
        $packProducts = self::getPackContent($idPack);
        $finalAttributesList = [];
        $res = true;
        if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
            foreach ($packProducts as $packProduct) {
                $product = new Product((int)$packProduct['id_product']);
                $attributesWhitelist = self::getProductAttributeWhiteList($packProduct['id_product_pack']);
                if (AdvancedPackCoreClass::_isFilledArray($attributesWhitelist)) {
                    foreach ($attributesWhitelist as $idProductAttribute) {
                        $combinationList = $product->getAttributeCombinationsById($idProductAttribute, self::getContext()->language->id);
                        if (AdvancedPackCoreClass::_isFilledArray($combinationList)) {
                            foreach ($combinationList as $combinationRow) {
                                $finalAttributesList[] = (int)$combinationRow['id_attribute'];
                            }
                        }
                    }
                } else {
                    $combinationList = $product->getAttributeCombinations(self::getContext()->language->id);
                    if (AdvancedPackCoreClass::_isFilledArray($combinationList)) {
                        foreach ($combinationList as $combinationRow) {
                            $finalAttributesList[] = (int)$combinationRow['id_attribute'];
                        }
                    }
                }
            }
        }
        $productPack = new Product((int)$idPack);
        $combinationList = $productPack->getAttributeCombinations(self::getContext()->language->id);
        if (AdvancedPackCoreClass::_isFilledArray($combinationList)) {
            $combinationToDelete = [];
            $combinationsNotToDelete = [];
            foreach ($combinationList as $combinationRow) {
                $idProductAttribute = (int)$combinationRow['id_product_attribute'];
                if (empty($idProductAttribute)) {
                    continue;
                }
                if ($combinationRow['id_attribute_group'] != self::getPackAttributeGroupId()) {
                    $combinationToDelete[] = $idProductAttribute;
                } else {
                    $combinationsNotToDelete[] = $idProductAttribute;
                }
            }
            if (AdvancedPackCoreClass::_isFilledArray($combinationToDelete)) {
                $res &= Db::getInstance()->delete('product_attribute', '`id_product`=' . (int)$idPack . ' AND `id_product_attribute` IN (' . implode(',', array_map('intval', $combinationToDelete)) . ')');
                $res &= Db::getInstance()->delete('product_attribute_shop', '`id_product_attribute` IN (' . implode(',', array_map('intval', $combinationToDelete)) . ')');
                $res &= Db::getInstance()->delete('product_attribute_combination', '`id_product_attribute` IN (' . implode(',', array_map('intval', $combinationToDelete)) . ')');
                $res &= Db::getInstance()->delete('cart_product', '`id_product`=' . (int)$idPack . ' AND `id_product_attribute` IN (' . implode(',', array_map('intval', $combinationToDelete)) . ')');
                $res &= Db::getInstance()->delete('product_attribute_image', '`id_product_attribute` IN (' . implode(',', array_map('intval', $combinationToDelete)) . ')');
                $res &= Db::getInstance()->delete('stock_available', '`id_product`=' . (int)$idPack . ' AND `id_product_attribute` IN (' . implode(',', array_map('intval', $combinationToDelete)) . ')');
                $res &= Db::getInstance()->delete('product_supplier', '`id_product`=' . (int)$idPack . ' AND `id_product_attribute` NOT IN (' . implode(',', array_map('intval', $combinationsNotToDelete)) . ')');
            }
        }
        if (AdvancedPackCoreClass::_isFilledArray($finalAttributesList)) {
            $finalAttributesList = array_unique($finalAttributesList);
            $packIdShop = (int)AdvancedPack::getPackIdShop($idPack);
            foreach ($finalAttributesList as $idAttribute) {
                $obj = new Combination(null, null, $packIdShop);
                $obj->id_product = (int)$idPack;
                $obj->price = 0;
                $obj->weight = 0;
                $obj->ecotax = 0;
                if (property_exists($obj, 'quantity') && version_compare(_PS_VERSION_, '8.0.0', '<')) {
                    $obj->quantity = 0;
                }
                $obj->reference = '';
                $obj->minimal_quantity = 1;
                if ($obj->add()) {
                    $res &= Db::getInstance()->insert('product_attribute_combination', [
                        'id_product_attribute' => (int)$obj->id,
                        'id_attribute' => (int)$idAttribute,
                    ]);
                }
            }
            self::updateFakePackCombinationStock((int)$idPack);
        }
        self::addCustomPackProductAttribute($idPack, [], null, true);
        return $res;
    }
    private static function checkCustomizationErrors($idPack, $customizationList, $moduleInstance, $fromCartController = true, $packExcludeList = [])
    {
        $customizationError = false;
        $context = self::getContext();
        $packCustomizationRequiredFields = self::getPackCustomizationRequiredFields($idPack, $packExcludeList);
        if (AdvancedPackCoreClass::_isFilledArray($packCustomizationRequiredFields) && !AdvancedPackCoreClass::_isFilledArray($customizationList)) {
            $customizationError = true;
        } else {
            if (AdvancedPackCoreClass::_isFilledArray($customizationList)) {
                foreach ($customizationList as $customization) {
                    foreach ($customization as $idCustomizationField => $value) {
                        if (in_array($idCustomizationField, $packCustomizationRequiredFields) && !Tools::strlen($value)) {
                            $customizationError = true;
                            break;
                        }
                    }
                }
            }
        }
        if ($customizationError) {
            $errors = [$moduleInstance->getFrontTranslation('errorInvalidCustomization')];
            if ($fromCartController) {
                http_response_code(500);
                die(json_encode(['hasError' => true, 'from_AP5' => true, 'errors' => $errors]));
            } else {
                $context->controller->errors = $errors;
                return $customizationError;
            }
        }
        return $customizationError;
    }
    public static function addPackToCart($idPack, $quantity = 1, $idProductAttributeList = [], $customizationList = [], $fromCartController = true, $fromProductController = false, $die = true)
    {
        $errors = [];
        $moduleInstance = AdvancedPack::getModuleInstance();
        $context = self::getContext();
        if (self::isValidPack($idPack, true)) {
            if (!count($idProductAttributeList)) {
                $idProductAttributeList = self::getIdProductAttributeListByIdPack($idPack);
            }
            ksort($idProductAttributeList);
            $packUniqueHash = md5((int)$context->cookie->id_cart . '-' . (int)$idPack . '-' . json_encode($idProductAttributeList) . (count($customizationList) ? json_encode($customizationList) : ''));
            if (self::isInStock($idPack, $quantity, $idProductAttributeList)) {
                $customizationHasError = self::checkCustomizationErrors($idPack, $customizationList, $moduleInstance, $fromCartController);
                $idProductAttribute = self::addCustomPackProductAttribute($idPack, $idProductAttributeList, $packUniqueHash);
                $idAddressDelivery = (int)Tools::getValue('id_address_delivery');
                if (!$customizationHasError && is_numeric($idProductAttribute) && $idProductAttribute > 0 && $idProductAttribute !== false) {
                    if (self::addPackSpecificPrice($idPack, $idProductAttribute, $idProductAttributeList)) {
                        if ($quantity > 0) {
                            $updateQuantity = $context->cart->updateQty($quantity, $idPack, $idProductAttribute, false, 'up', $idAddressDelivery);
                        } else {
                            $updateQuantity = true;
                        }
                        if (!$updateQuantity) {
                            $errors[] = $moduleInstance->getFrontTranslation('errorMaximumQuantity');
                        } else {
                            $resPackAdd = true;
                            $packProducts = self::getPackContent($idPack);
                            if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
                                $values = [];
                                foreach ($packProducts as $packProduct) {
                                    $productPackIdAttribute = (isset($idProductAttributeList[(int)$packProduct['id_product_pack']]) ? $idProductAttributeList[(int)$packProduct['id_product_pack']] : (int)$packProduct['default_id_product_attribute']);
                                    $packCustomizationList = (isset($customizationList[(int)$packProduct['id_product_pack']]) ? $customizationList[(int)$packProduct['id_product_pack']] : null);
                                    $values[] = '(' . (int)$context->cookie->id_cart . ', ' . (int)$context->shop->id . ', ' . (int)$idPack . ', ' . (int)$packProduct['id_product_pack'] . ', ' . (int)$idProductAttribute . ', ' . (int)$productPackIdAttribute . ', "' . pSQL($packUniqueHash) . '", ' . (AdvancedPackCoreClass::_isFilledArray($packCustomizationList) ? '"' . pSQL(json_encode($packCustomizationList)) . '"' : 'NULL') . ')';
                                }
                                if (AdvancedPackCoreClass::_isFilledArray($values)) {
                                    $resPackAdd &= Db::getInstance()->execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'pm_advancedpack_cart_products` (`id_cart`, `id_shop`, `id_pack`, `id_product_pack`, `id_product_attribute_pack`, `id_product_attribute`, `unique_hash`, `customization_infos`) VALUES ' . implode(',', $values));
                                }
                            }
                            if ($resPackAdd) {
                                if ($fromCartController) {
                                    $jsonCartContent = [];
                                    $cartPresenter = new \PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter();
                                    $presentedCart = $cartPresenter->present($context->cart);
                                    $presentedCart['products'] = $moduleInstance->getContainer()->get('prestashop.core.filter.front_end_object.product_collection')->filter($presentedCart['products']);
                                    $jsonCartContent['cart'] = $presentedCart;
                                    $jsonCartContent['id_product'] = (int) $idPack;
                                    $jsonCartContent['id_product_attribute'] = (int) $idProductAttribute;
                                    $jsonCartContent['ap5Data'] = [
                                        'idProductAttribute' => $idProductAttribute,
                                        'cartPackProducts' => $moduleInstance->getFormatedPackAttributes($context->cart),
                                    ];
                                    if (Configuration::get('PS_BLOCK_CART_AJAX') == 0) {
                                        $jsonCartContent['ap5RedirectURL'] = self::getContext()->link->getPageLink('cart');
                                    }
                                    if ($die) {
                                        die(json_encode($jsonCartContent));
                                    }
                                }
                            } else {
                                $errors[] = $moduleInstance->getFrontTranslation('errorSavePackContent');
                            }
                        }
                    } else {
                        $errors[] = $moduleInstance->getFrontTranslation('errorGeneratingPrice');
                    }
                }
            } else {
                $errors[] = $moduleInstance->getFrontTranslation('errorOutOfStock');
            }
        } else {
            $errors[] = $moduleInstance->getFrontTranslation('errorInvalidPack');
        }
        if (count($errors)) {
            if ($fromCartController) {
                if ($die) {
                    http_response_code(500);
                    die(json_encode(['hasError' => true, 'from_AP5' => true, 'errors' => $errors]));
                }
            } else {
                $context->controller->errors = $errors;
            }
            return false;
        }
        if (!isset($idProductAttribute)) {
            return false;
        }
        return (int)$idProductAttribute;
    }
    public static function addExplodedPackToCart($idPack, $quantity = 1, $idProductAttributeList = [], $customizationList = [], $quantityList = [], $packExcludeList = [], $die = true)
    {
        $errors = [];
        $moduleInstance = AdvancedPack::getModuleInstance();
        if (self::isValidPack($idPack, true, $packExcludeList)) {
            self::checkCustomizationErrors($idPack, $customizationList, $moduleInstance, true, $packExcludeList);
            $resPackAdd = true;
            $packProducts = self::getPackContent($idPack, null, true, [], $quantityList);
            $totalPackPrice = 0;
            if (AdvancedPackCoreClass::_isFilledArray($packProducts)) {
                $context = Context::getContext();
                $useTax = (Product::getTaxCalculationMethod($context->customer->id) != PS_TAX_EXC);
                $explodedProductList = [];
                $idAddressDelivery = (int)Tools::getValue('id_address_delivery');
                pm_advancedpack::$_preventInfiniteLoop = true;
                foreach ($packProducts as $k => &$packProduct) {
                    if (in_array((int)$packProduct['id_product_pack'], $packExcludeList)) {
                        unset($packProducts[$k]);
                        continue;
                    }
                    $productPackIdAttribute = (isset($idProductAttributeList[(int)$packProduct['id_product_pack']]) ? $idProductAttributeList[(int)$packProduct['id_product_pack']] : (int)$packProduct['default_id_product_attribute']);
                    $packProduct['id_product_attribute'] = $productPackIdAttribute;
                    if (isset($customizationList[(int)$packProduct['id_product_pack']])) {
                        foreach ($customizationList[(int)$packProduct['id_product_pack']] as $idCustomizationField => $customizationValue) {
                            if (!Tools::strlen($customizationValue)) {
                                continue;
                            }
                            self::getContext()->cart->_addCustomization((int)$packProduct['id_product'], $productPackIdAttribute, $idCustomizationField, Product::CUSTOMIZE_TEXTFIELD, $customizationValue, (int)$packProduct['quantity'] * $quantity);
                        }
                        foreach ($customizationList[(int)$packProduct['id_product_pack']] as $idCustomizationField => $customizationValue) {
                            if (!Tools::strlen($customizationValue)) {
                                continue;
                            }
                            Db::getInstance()->execute('
                                UPDATE `' . _DB_PREFIX_ . 'customization`
                                SET `in_cart`=1
                                WHERE `id_cart`=' . (int)self::getContext()->cart->id . '
                                AND `id_product`=' . (int)$packProduct['id_product'] . '
                                AND `id_product_attribute`=' . (int)$productPackIdAttribute . '
                                AND `quantity`=' . (int)$packProduct['quantity'] * $quantity);
                        }
                    }
                    $resPackAdd &= self::getContext()->cart->updateQty((int)$packProduct['quantity'] * $quantity, (int)$packProduct['id_product'], $productPackIdAttribute, false, 'up', $idAddressDelivery);
                    $totalPackPrice += ((int)$packProduct['quantity'] * $quantity) * $packProduct['productObj']->getPrice($useTax, $productPackIdAttribute);
                    $explodedProductList[] = [
                        'id_product' => (int)$packProduct['id_product'],
                        'id_product_attribute' => $productPackIdAttribute,
                        'quantity' => (int)$packProduct['quantity'] * $quantity,
                    ];
                }
                pm_advancedpack::$_preventInfiniteLoop = false;
                $jsonCartContent = [];
                $jsonCartContent['id_product'] = (int) $idPack;
                $explodedAttributesResume = $moduleInstance->displayPackContent($idPack, null, pm_advancedpack::PACK_CONTENT_BLOCK_CART, $packProducts);
                $cartPackProducts = $moduleInstance->getFormatedPackAttributes($context->cart);
                $cartPackProducts['ap5ExplodedCart'] = ['block_cart' => $explodedAttributesResume, 'cart' => $explodedAttributesResume];
                $cartPresenter = new \PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter();
                $presentedCart = $cartPresenter->present($context->cart);
                $presentedCart['products'] = $moduleInstance->getContainer()->get('prestashop.core.filter.front_end_object.product_collection')->filter($presentedCart['products']);
                $jsonCartContent['cart'] = $presentedCart;
                $jsonCartContent['ap5Data'] = [
                    'idProductAttribute' => null,
                    'cartPackProducts' => $cartPackProducts,
                    'explodedProductsData' => ['cq' => $quantity, 'idpal' => $idProductAttributeList, 'cl' => $customizationList, 'ql' => $quantityList, 'pel' => $packExcludeList],
                ];
                if (Configuration::get('PS_BLOCK_CART_AJAX') == 0) {
                    $jsonCartContent['ap5RedirectURL'] = self::getContext()->link->getPageLink('cart');
                }
                if ($die) {
                    die(json_encode($jsonCartContent));
                }
            }
            $cartController = new CartController();
            $cartController->displayAjax();
        } else {
            $errors[] = $moduleInstance->getFrontTranslation('errorInvalidPack');
        }
        if (count($errors)) {
            if ($die) {
                http_response_code(500);
                die(json_encode(['hasError' => true, 'from_AP5' => true, 'errors' => $errors]));
            }
            return false;
        }
        return true;
    }
    public static function getAddressInstance()
    {
        $address_infos = [];
        $id_country = (int)self::getContext()->country->id;
        $id_state = 0;
        $zipcode = 0;
        $id_address = 0;
        if (Validate::isLoadedObject(self::getContext()->cart)) {
            $id_address = self::getContext()->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')};
        }
        if (!$id_address && Validate::isLoadedObject(self::getContext()->customer)) {
            $id_address = (int)Address::getFirstCustomerAddressId(self::getContext()->customer->id);
        }
        if ($id_address) {
            $address_infos = Address::getCountryAndState($id_address);
            if ($address_infos['id_country']) {
                $id_country = (int)$address_infos['id_country'];
                $id_state = (int)$address_infos['id_state'];
                $zipcode = $address_infos['postcode'];
            }
        } elseif (!empty(self::getContext()->customer->geoloc_id_country)) {
            $id_country = (int)self::getContext()->customer->geoloc_id_country;
            $id_state = (int)self::getContext()->customer->id_state;
            $zipcode = (int)self::getContext()->customer->postcode;
        }
        $address = new Address();
        if (!empty($id_address)) {
            $address = new Address((int)$id_address);
        }
        if (!Validate::isLoadedObject($address)) {
            $address = new Address();
            $address->id_country = $id_country;
            $address->id_state = $id_state;
            $address->postcode = $zipcode;
        }
        $useTax = true;
        if (AdvancedPack::excludeTaxeOption()) {
            $useTax = false;
        }
        if ($useTax != false
            && !empty($address_infos['vat_number'])
            && $address_infos['id_country'] != Configuration::get('VATNUMBER_COUNTRY')
            && Configuration::get('VATNUMBER_MANAGEMENT')) {
            $useTax = false;
        }
        return [$address, $useTax];
    }
    public static function updateCartSpecificPriceAndStock($idCart = null)
    {
        if (empty($idCart)) {
            $idCart = Context::getContext()->cart->id;
        }
        if (empty($idCart)) {
            return;
        }
        $sql = new DbQuery();
        $sql->select('DISTINCT `id_pack`, `id_product_attribute_pack`');
        $sql->from('pm_advancedpack_cart_products', 'acp');
        $sql->where('acp.`id_cart`=' . (int)$idCart);
        $sql->where('acp.`id_order` IS NULL');
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($result !== false && AdvancedPackCoreClass::_isFilledArray($result)) {
            foreach ($result as $resultRow) {
                if (!isset($resultRow['id_product_attribute_pack']) || (int)$resultRow['id_product_attribute_pack'] <= 0) {
                    continue;
                }
                $idProductAttribute = (int)$resultRow['id_product_attribute_pack'];
                $idPack = (int)$resultRow['id_pack'];
                $idProductAttributeList = self::getIdProductAttributeListByIdPack((int)$idPack, $idProductAttribute);
                self::addPackSpecificPrice((int)$idPack, $idProductAttribute, $idProductAttributeList);
                if (!self::isValidPack((int)$idPack, true, [], $idProductAttribute)) {
                    self::setStockAvailableQuantity((int)$idPack, (int)$idProductAttribute, 0, false);
                }
            }
        }
    }
    public static function addPackSpecificPrice($idPack, $idProductAttribute, &$idProductAttributeList = [])
    {
        $config = pm_advancedpack::getModuleConfigurationStatic();
        $packIdTaxRulesGroup = AdvancedPack::getPackIdTaxRulesGroup((int)$idPack);
        $packProducts = self::getPackContent($idPack);
        $packFixedPrice = self::getPackFixedPrice($idPack);
        $packHasFixedPrice = is_array($packFixedPrice) && array_sum($packFixedPrice) > 0;
        $reductionAmountTable = $reductionPercentageTable = [];
        $forceReductionByAmount = false;
        if (!$packHasFixedPrice && AdvancedPackCoreClass::_isFilledArray($packProducts)) {
            foreach ($packProducts as $packProduct) {
                $selectedIdProductAttribute = (isset($idProductAttributeList[$packProduct['id_product_pack']]) ? (int)$idProductAttributeList[$packProduct['id_product_pack']] : null);
                if (empty($selectedIdProductAttribute) && !empty($packProduct['default_id_product_attribute'])) {
                    $selectedIdProductAttribute = (int)$packProduct['default_id_product_attribute'];
                }
                if ($selectedIdProductAttribute != null && isset($packProduct['combinationsInformations']) && isset($packProduct['combinationsInformations'][$selectedIdProductAttribute])) {
                    if ((float)$packProduct['combinationsInformations'][$selectedIdProductAttribute]['reduction_amount'] > 0) {
                        $forceReductionByAmount = true;
                    }
                }
                if ($packProduct['reduction_type'] == 'amount') {
                    $reductionAmountTable[] = $packProduct['reduction_amount'];
                } elseif ($packProduct['reduction_type'] == 'percentage') {
                    $reductionPercentageTable[] = $packProduct['reduction_amount'];
                }
            }
            $reductionPercentageTable = array_unique($reductionPercentageTable);
            if (array_sum($reductionPercentageTable) == 0) {
                $reductionPercentageTable = [];
                $forceReductionByAmount = true;
            }
        }
        $packHasPercentageReduction = (!$forceReductionByAmount && count($reductionPercentageTable) == 1 && !count($reductionAmountTable));
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'specific_price` WHERE `id_product`=' . (int)$idPack . ' AND `id_product_attribute`=' . (int)$idProductAttribute);
        $spToAdd = [];
        $genericSpecificPrice = null;
        $genericSpecificPriceByCurrency = [];
        $sp = new SpecificPrice();
        $sp->id_product = $idPack;
        $sp->id_cart = 0;
        $sp->id_product_attribute = $idProductAttribute;
        $sp->id_shop = AdvancedPack::getPackIdShop($idPack);
        $sp->id_shop_group = 0;
        $sp->id_currency = ($idProductAttribute && Validate::isLoadedObject(self::getContext()->currency) ? self::getContext()->currency->id : 0);
        $sp->id_country = 0;
        $sp->id_group = 0;
        $sp->id_customer = 0;
        $sp->from = '0000-00-00 00:00:00';
        $sp->to = '0000-00-00 00:00:00';
        $sp->from_quantity = 1;
        $sharedShops = Shop::getSharedShops($sp->id_shop, Shop::SHARE_ORDER);
        if (is_array($sharedShops) && count($sharedShops) > 1) {
            $sp->id_shop_group = (new Shop($sp->id_shop))->id_shop_group;
            $sp->id_shop = 0;
        }
        $currentCustomer = self::getContext()->customer;
        $currentCustomerIsLogged = (Validate::isLoadedObject($currentCustomer) && $currentCustomer->isLogged());
        $idGroupList = [];
        $idGroupListWithoutTaxes = [];
        if ($currentCustomerIsLogged) {
            $defaultCustomerGroup = (int)Customer::getDefaultGroupId(self::getContext()->customer->id);
            $idGroupList = [$defaultCustomerGroup];
        } else {
            if ($idProductAttribute) {
                $idGroupList = self::getIdGroupListByIdPack($idPack);
                $idGroupList[] = 0;
                foreach (Group::getGroups(Context::getContext()->language->id, true) as $group) {
                    $groupPriceDisplayMethod = (int)Group::getPriceDisplayMethod((int)$group['id_group']);
                    if ($groupPriceDisplayMethod == 1) {
                        $idGroupListWithoutTaxes[] = (int)$group['id_group'];
                    }
                    if (!$packIdTaxRulesGroup && $groupPriceDisplayMethod == 1) {
                        $idGroupList[] = (int)$group['id_group'];
                    } elseif (!empty($group['reduction']) && $group['reduction'] > 0) {
                        $idGroupList[] = (int)$group['id_group'];
                    }
                }
            } else {
                $idGroupList[] = 0;
                foreach (Group::getGroups(Context::getContext()->language->id, true) as $group) {
                    $groupPriceDisplayMethod = (int)Group::getPriceDisplayMethod((int)$group['id_group']);
                    if ($groupPriceDisplayMethod == 1) {
                        $idGroupListWithoutTaxes[] = (int)$group['id_group'];
                    }
                    $idGroupList[] = (int)$group['id_group'];
                }
            }
            $idGroupList = array_unique($idGroupList);
        }
        if ($idProductAttribute) {
            $idCountryList = self::getIdCountryListByIdPack($idPack);
            $idCurrencyList = self::getIdCurrencyListByIdPack($idPack);
        } else {
            if (!empty($config['postponeUpdatePackSpecificPrice']) && !Context::getContext()->controller instanceof pm_advancedpackcronModuleFrontController) {
                $idCountryList = [Context::getContext()->country->id];
            } else {
                $idCountryList = self::getIdCountryListByIdPack($idPack, true);
            }
            $idCurrencyList = self::getIdCurrencyListByIdPack($idPack, true);
        }
        sort($idGroupList);
        sort($idCountryList);
        sort($idCurrencyList);
        $groupReductionList = [];
        $groupReductionList[(int)Configuration::get('PS_UNIDENTIFIED_GROUP')] = Group::getReductionByIdGroup((int)Configuration::get('PS_UNIDENTIFIED_GROUP'));
        foreach ($idGroupList as $idGroupTmp) {
            if ($idGroupTmp) {
                $groupReductionList[(int)$idGroupTmp] = (float)Group::getReductionByIdGroup($idGroupTmp);
                $packCategoryReduction = GroupReduction::getValueForProduct((int)$idPack, $idGroupTmp);
                if (is_float($packCategoryReduction + 0)) {
                    $groupReductionList[(int)$idGroupTmp] = $packCategoryReduction * 100;
                } else {
                }
            }
        }
        $specificPriceCartesian = AdvancedPackCoreClass::array_cartesian([
            'id_country' => $idCountryList,
            'id_group' => $idGroupList,
            'id_currency' => $idCurrencyList,
        ]);
        $saveResult = true;
        $fieldsList = null;
        $currencyCache = [];
        $countryCache = [];
        $fakeCustomer = new Customer();
        $fakeCustomer->id = self::PACK_FAKE_CUSTOMER_ID;
        $idCountryDefault = Context::getContext()->country->id;
        $oldContext = clone self::getContext();
        self::$forceUseOfAnotherContext = true;
        $spByCountry = clone $sp;
        $psUnidentifiedGroup = (int)Configuration::get('PS_UNIDENTIFIED_GROUP');
        $idDefaultCurrency = (int)Configuration::get('PS_CURRENCY_DEFAULT');
        foreach ($specificPriceCartesian as $specificPriceCartesianRow) {
            $idCountry = $specificPriceCartesianRow[0];
            $idGroup = $specificPriceCartesianRow[1];
            $idCurrency = $specificPriceCartesianRow[2];
            $spByCountry->id = $spByCountry->id_specific_price = null;
            $newContext = $oldContext->cloneContext();
            if ($idCountry) {
                if (isset($countryCache[$idCountry])) {
                    $newContext->country = $countryCache[$idCountry];
                } else {
                    $newContext->country = new Country($idCountry, (int)$newContext->cookie->id_lang);
                    $countryCache[$idCountry] = $newContext->country;
                }
            } elseif ($idCountryDefault) {
                if (isset($countryCache[$idCountryDefault])) {
                    $newContext->country = $countryCache[$idCountryDefault];
                } else {
                    $newContext->country = new Country($idCountryDefault, (int)$newContext->cookie->id_lang);
                    $countryCache[$idCountryDefault] = $newContext->country;
                }
            }
            if (!Validate::isLoadedObject($newContext->customer)) {
                $newContext->customer = $fakeCustomer;
            }
            if (!empty($idGroup)) {
                $newContext->customer->id_default_group = $idGroup;
            } else {
                $newContext->customer->id_default_group = $psUnidentifiedGroup;
            }
            if ($idCurrency) {
                if (isset($currencyCache[$idCurrency])) {
                    $newContext->currency = $currencyCache[$idCurrency];
                } else {
                    $newContext->currency = new Currency($idCurrency);
                    $currencyCache[$idCurrency] = $newContext->currency;
                }
            } else {
                if (isset($currencyCache[$idDefaultCurrency])) {
                    $newContext->currency = $currencyCache[$idDefaultCurrency];
                } else {
                    $newContext->currency = new Currency($idDefaultCurrency);
                    $currencyCache[$idDefaultCurrency] = $newContext->currency;
                }
            }
            self::setContext($newContext);
            $spByCountry->id_group = $idGroup;
            $spByCountry->id_country = $idCountry;
            $spByCountry->id_currency = $idCurrency;
            $currentGlobalGroupDiscount = (!empty($groupReductionList[(int)$idGroup]) ? $groupReductionList[(int)$idGroup] : 0);
            if ($idGroup && $currentGlobalGroupDiscount >= 100) {
                $spByCountry->price = 0;
                $spByCountry->reduction = 0;
                $spByCountry->reduction_type = 'amount';
            } elseif ($idGroup && $currentGlobalGroupDiscount > 0 && $currentGlobalGroupDiscount < 100) {
                if ($packIdTaxRulesGroup) {
                    $spByCountry->price = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList, [], [], true) / (1 - $currentGlobalGroupDiscount / 100);
                    $groupPriceWt = self::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList, [], [], true);
                    $realPriceWt = self::getPackPrice($idPack, true, true, false, 6, $idProductAttributeList, [], [], true);
                } else {
                    if (($packHasFixedPrice || $packHasPercentageReduction) && in_array($idGroup, $idGroupListWithoutTaxes)) {
                        $spByCountry->price = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList, [], [], true) / (1 - $currentGlobalGroupDiscount / 100);
                        $groupPriceWt = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList, [], [], true);
                        $realPriceWt = self::getPackPrice($idPack, false, true, false, 6, $idProductAttributeList, [], [], true);
                    } else {
                        $spByCountry->price = self::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList, [], [], true) / (1 - $currentGlobalGroupDiscount / 100);
                        $groupPriceWt = self::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList, [], [], true);
                        $realPriceWt = self::getPackPrice($idPack, true, true, false, 6, $idProductAttributeList, [], [], true);
                    }
                }
                if ($packHasPercentageReduction) {
                    $spByCountry->reduction = current($reductionPercentageTable);
                    $spByCountry->reduction_type = 'percentage';
                } else {
                    if ($realPriceWt > $groupPriceWt) {
                        $spByCountry->price = self::getPackPrice($idPack, false, $packIdTaxRulesGroup > 0, false, 6, $idProductAttributeList) / (1 - $currentGlobalGroupDiscount / 100);
                        $spByCountry->reduction = 0;
                    } else {
                        $spByCountry->reduction = ($groupPriceWt - $realPriceWt) / (1 - $currentGlobalGroupDiscount / 100);
                    }
                    $spByCountry->reduction_type = 'amount';
                }
            } else {
                if (!($idGroup && !$packIdTaxRulesGroup && (int)Group::getPriceDisplayMethod($idGroup) == 1)) {
                    if (!$idGroup && !$idCountry && !$idCurrency && !$idProductAttribute) {
                        $spByCountry->price = -1;
                    } else {
                        if ($packIdTaxRulesGroup) {
                            $spByCountry->price = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList);
                            if (self::getPackEcoTax($idPack, $idProductAttributeList) > 0) {
                                $spByCountry->price = self::getPackPrice($idPack, false, false, true, 6, $idProductAttributeList);
                            }
                        } else {
                            $spByCountry->price = self::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList);
                            if (self::getPackEcoTax($idPack, $idProductAttributeList) > 0) {
                                $spByCountry->price = self::getPackPrice($idPack, true, false, true, 6, $idProductAttributeList);
                                $spByCountry->price -= (self::getPackEcoTax($idPack, $idProductAttributeList) - self::getPackEcoTax($idPack, $idProductAttributeList, $packIdTaxRulesGroup));
                            }
                        }
                    }
                    if ($packHasFixedPrice) {
                        $spByCountry->reduction = self::getPackPrice($idPack, true, false, true, 6, $idProductAttributeList) - self::getPackPrice($idPack, true, true, true, 6, $idProductAttributeList);
                        $spByCountry->reduction_type = 'amount';
                    } elseif ($packHasPercentageReduction && !(self::getPackEcoTax($idPack, $idProductAttributeList, $packIdTaxRulesGroup) > 0)) {
                        $spByCountry->reduction = current($reductionPercentageTable);
                        $spByCountry->reduction_type = 'percentage';
                    } else {
                        $spByCountry->reduction_type = 'amount';
                        $spByCountry->reduction = self::getPackPrice($idPack, true, false, true, 6, $idProductAttributeList) - self::getPackPrice($idPack, true, true, true, 6, $idProductAttributeList);
                    }
                    if ($spByCountry->reduction_type == 'amount' && $currentCustomerIsLogged && $idProductAttribute) {
                        list(, $useTax) = self::getAddressInstance();
                        if (!$useTax) {
                            $spByCountry->reduction_tax = 0;
                        }
                    }
                    if ($spByCountry->reduction < 0) {
                        $spByCountry->reduction = 0;
                        if ($packIdTaxRulesGroup) {
                            $spByCountry->price = self::getPackPrice($idPack, false, true, false, 6, $idProductAttributeList);
                        } else {
                            $spByCountry->price = self::getPackPrice($idPack, true, true, false, 6, $idProductAttributeList);
                        }
                    }
                } elseif ($idGroup && !$idProductAttribute && !$packIdTaxRulesGroup && (int)Group::getPriceDisplayMethod($idGroup) == 1) {
                    if ($packHasFixedPrice) {
                        $spByCountry->price = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList);
                    } elseif (AdvancedPackCoreClass::_isFilledArray($idProductAttributeList)) {
                        $spByCountry->price = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList);
                    } else {
                        $spByCountry->price = self::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList);
                    }
                    if ($packHasFixedPrice) {
                        $spByCountry->reduction = self::getPackPrice($idPack, false, false, true, 6, $idProductAttributeList) - self::getPackPrice($idPack, false, true, true, 6, $idProductAttributeList);
                        $spByCountry->reduction_type = 'amount';
                    } elseif ($packHasPercentageReduction) {
                        $spByCountry->reduction = current($reductionPercentageTable);
                        $spByCountry->reduction_type = 'percentage';
                    } else {
                        $spByCountry->reduction_type = 'amount';
                        $spByCountry->reduction = self::getPackPrice($idPack, false, false, true, 6, $idProductAttributeList) - self::getPackPrice($idPack, false, true, true, 6, $idProductAttributeList);
                    }
                    if ($spByCountry->reduction < 0) {
                        $spByCountry->reduction = 0;
                        $spByCountry->price = self::getPackPrice($idPack, false, true, false, 6, $idProductAttributeList);
                    }
                } elseif ($idGroup && $idProductAttribute && !$packIdTaxRulesGroup && (int)Group::getPriceDisplayMethod($idGroup) == 1) {
                    $spByCountry->price = self::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList);
                    if (self::getPackEcoTax($idPack, $idProductAttributeList) > 0) {
                        $spByCountry->price = self::getPackPrice($idPack, true, false, true, 6, $idProductAttributeList);
                        $spByCountry->price -= (self::getPackEcoTax($idPack, $idProductAttributeList) - self::getPackEcoTax($idPack, $idProductAttributeList, $packIdTaxRulesGroup));
                    }
                    if ($packHasFixedPrice) {
                        $spByCountry->reduction = self::getPackPrice($idPack, true, false, true, 6, $idProductAttributeList) - self::getPackPrice($idPack, true, true, true, 6, $idProductAttributeList);
                        $spByCountry->reduction_type = 'amount';
                    } elseif ($packHasPercentageReduction && !(self::getPackEcoTax($idPack, $idProductAttributeList, $packIdTaxRulesGroup) > 0)) {
                        $spByCountry->reduction = current($reductionPercentageTable);
                        $spByCountry->reduction_type = 'percentage';
                    } else {
                        $spByCountry->reduction_type = 'amount';
                        $spByCountry->reduction = self::getPackPrice($idPack, true, false, true, 6, $idProductAttributeList) - self::getPackPrice($idPack, true, true, true, 6, $idProductAttributeList);
                    }
                    if ($spByCountry->reduction < 0) {
                        $spByCountry->reduction = 0;
                        $spByCountry->price = self::getPackPrice($idPack, true, true, false, 6, $idProductAttributeList);
                    }
                }
            }
            $spByCountry->price = Tools::ps_round($spByCountry->price, 6);
            $spByCountry->reduction = Tools::ps_round($spByCountry->reduction, 6);
            if (!Validate::isPrice((string)$spByCountry->reduction)) {
                $spByCountry->reduction = 0;
            }
            if (
                $genericSpecificPrice === null &&
                $spByCountry->id_group == 0 &&
                $spByCountry->id_currency == 0 &&
                $spByCountry->id_country == 0
            ) {
                $genericSpecificPrice = clone $spByCountry;
                $genericSpecificPrice->genericPackPrice = null;
                if ($genericSpecificPrice->price == -1) {
                    if ($packIdTaxRulesGroup) {
                        $genericSpecificPrice->genericPackPrice = AdvancedPack::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList);
                    } else {
                        $genericSpecificPrice->genericPackPrice = AdvancedPack::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList);
                    }
                }
            } elseif (
                !isset($genericSpecificPriceByCurrency[(int)$spByCountry->id_currency]) &&
                $spByCountry->id_group == 0 &&
                $spByCountry->id_currency != 0 &&
                $spByCountry->id_country == 0
            ) {
                $genericSpecificPriceByCurrency[(int)$spByCountry->id_currency] = clone $spByCountry;
                $genericSpecificPriceByCurrency[(int)$spByCountry->id_currency]->genericPackPrice = null;
                if ($genericSpecificPriceByCurrency[(int)$spByCountry->id_currency]->price == -1) {
                    if ($packIdTaxRulesGroup) {
                        $genericSpecificPriceByCurrency[(int)$spByCountry->id_currency]->genericPackPrice = AdvancedPack::getPackPrice($idPack, false, false, false, 6, $idProductAttributeList);
                    } else {
                        $genericSpecificPriceByCurrency[(int)$spByCountry->id_currency]->genericPackPrice = AdvancedPack::getPackPrice($idPack, true, false, false, 6, $idProductAttributeList);
                    }
                }
            } else {
                if (
                    $genericSpecificPrice !== null &&
                    self::isSpecificPriceUseless($newContext, $spByCountry, $genericSpecificPrice)
                ) {
                    continue;
                }
                if (
                    isset($genericSpecificPriceByCurrency[(int)$spByCountry->id_currency]) &&
                    self::isSpecificPriceUseless($newContext, $spByCountry, $genericSpecificPriceByCurrency[(int)$spByCountry->id_currency], false)
                ) {
                    continue;
                }
            }
            if ($fieldsList === null) {
                $fieldsList = array_keys($spByCountry->getFields());
                $fieldsList = array_keys(array_intersect_key(get_object_vars($spByCountry), array_flip($fieldsList)));
            }
            $spToAdd[] = '("' . implode('", "', array_map('pSQL', array_intersect_key(get_object_vars($spByCountry), array_flip($fieldsList)))) . '")';
        }
        self::setContext($oldContext);
        self::$forceUseOfAnotherContext = false;
        if (count($spToAdd)) {
            if (!SpecificPrice::isFeatureActive()) {
                Configuration::updateGlobalValue('PS_SPECIFIC_PRICE_FEATURE_ACTIVE', '1');
            }
            $columnList = '`' . implode('`, `', $fieldsList) . '`';
            foreach (array_chunk($spToAdd, 1000) as $spChunckToAdd) {
                $saveResult &= Db::getInstance()->execute('INSERT INTO `' . _DB_PREFIX_ . 'specific_price` (' . $columnList . ') VALUES ' . implode(',', $spChunckToAdd));
            }
        }
        $idSpecificPrice = (int)Db::getInstance()->getValue('SELECT `id_specific_price` FROM `' . _DB_PREFIX_ . 'specific_price` WHERE `id_product`=' . (int)$idPack);
        if (!empty($idSpecificPrice)) {
            $spCacheReset = new SpecificPrice($idSpecificPrice);
            $spCacheReset->update();
        }
        return $saveResult;
    }
    protected static function isSpecificPriceUseless(Context $context, SpecificPrice $spByCountry, SpecificPrice $genericSpecificPrice, bool $checkConversionRate = true)
    {
        if (
            (!$checkConversionRate || ($checkConversionRate && (float)$context->currency->conversion_rate == 1.0)) &&
            ($genericSpecificPrice->price > 0 || $genericSpecificPrice->price == -1) &&
            (
                ($genericSpecificPrice->price == $spByCountry->price)
                || ($genericSpecificPrice->price == -1 && $genericSpecificPrice->genericPackPrice == $spByCountry->price)
            ) &&
            $genericSpecificPrice->reduction == $spByCountry->reduction &&
            $genericSpecificPrice->reduction_tax == $spByCountry->reduction_tax &&
            $genericSpecificPrice->reduction_type == $spByCountry->reduction_type
        ) {
            return true;
        }
        return false;
    }
    public static function transformProductDescriptionWithImg($product)
    {
        $reg = '/\[img\-([0-9]+)\-(left|right)\-([a-zA-Z0-9-_]+)\]/';
        $link = self::getContext()->link;
        $tagName = 'img';
        while (preg_match($reg, $product->description, $matches)) {
            $link_lmg = $link->getImageLink($product->link_rewrite, $product->id . '-' . $matches[1], $matches[3]);
            $class = $matches[2] == 'left' ? 'class="imageFloatLeft"' : 'class="imageFloatRight"';
            $html_img = '<' . $tagName . ' src="' . $link_lmg . '" alt="" ' . $class . '/>';
            $product->description = str_replace($matches[0], $html_img, $product->description);
        }
        return $product->description;
    }
    private static function _getProductImages($packProduct, $idLang = null)
    {
        if ($idLang == null) {
            $idLang = self::getContext()->language->id;
        }
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$packProduct['id_product_pack'] . (int)$idLang . self::getContext()->shop->id);
        if (!self::isInCache($cacheId)) {
            $productAttributesList = self::getProductAttributeWhiteList($packProduct['id_product_pack']);
            if (!pm_advancedpack::_isFilledArray($productAttributesList)) {
                $productObj = new Product((int)$packProduct['id_product'], false, (int)$idLang);
                $images = $productObj->getImages($idLang);
            } else {
                $sql = 'SELECT i.`id_image`, il.`legend`, ai.`id_product_attribute`
                        FROM `' . _DB_PREFIX_ . 'image` i
                        ' . Shop::addSqlAssociation('image', 'i') . '
                        LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_image` ai ON (i.`id_image` = ai.`id_image`)
                        LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = ' . (int)$idLang . ')
                        WHERE i.`id_product` = ' . (int)$packProduct['id_product'] . '
                        AND (ai.`id_product_attribute` IN (' . implode(',', array_map('intval', $productAttributesList)) . ') OR ai.`id_product_attribute` IS NULL)
                        GROUP BY i.`id_image`
                        ORDER BY `position`';
                $images = Db::getInstance()->executeS($sql);
                if (pm_advancedpack::_isFilledArray($images)) {
                    foreach ($images as $k => $image) {
                        if ((int)$image['id_product_attribute'] && !in_array((int)$image['id_product_attribute'], $productAttributesList)) {
                            unset($images[$k]);
                        }
                    }
                } else {
                    $images = [];
                }
            }
            self::storeInCache($cacheId, $images);
        } else {
            return self::getFromCache($cacheId);
        }
        return $images;
    }
    private static function _getProductCoverImage($idProduct, $idProductAttribute = null, $idLang = null)
    {
        if ($idLang == null) {
            $idLang = self::getContext()->language->id;
        }
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$idProduct . (int)$idProductAttribute . (int)$idLang . self::getContext()->shop->id);
        if (!self::isInCache($cacheId)) {
            $sql = new DbQuery();
            $sql->select('i.`id_image`, il.`legend`');
            $sql->from('image', 'i');
            $sql->join(Shop::addSqlAssociation('image', 'i'));
            $sql->leftJoin('image_lang', 'il', 'i.`id_image` = il.`id_image`');
            if ($idProductAttribute != null && $idProductAttribute) {
                $sql->leftJoin('product_attribute_image', 'pai', 'i.`id_image` = pai.`id_image`');
                $sql->where('i.`id_product`=' . (int)$idProduct);
                $sql->where('il.`id_lang`=' . (int)$idLang);
                $sql->where('pai.`id_product_attribute`=' . (int)$idProductAttribute);
            } else {
                $sql->where('i.`id_product`=' . (int)$idProduct);
                $sql->where('il.`id_lang`=' . (int)$idLang);
            }
            $sql->orderBy('i.`position` ASC');
            $productImage = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
            if (AdvancedPackCoreClass::_isFilledArray($productImage)) {
                self::storeInCache($cacheId, $productImage);
                return $productImage;
            } else {
                $sql = new DbQuery();
                $sql->select('i.`id_image`, il.`legend`');
                $sql->from('image', 'i');
                $sql->join(Shop::addSqlAssociation('image', 'i'));
                $sql->leftJoin('image_lang', 'il', 'i.`id_image` = il.`id_image`');
                $sql->where('i.`id_product`=' . (int)$idProduct);
                $sql->where('il.`id_lang`=' . (int)$idLang);
                $sql->where('image_shop.`cover`=1');
                $productImage = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
                if (AdvancedPackCoreClass::_isFilledArray($productImage)) {
                    self::storeInCache($cacheId, $productImage);
                    return $productImage;
                } else {
                    self::storeInCache($cacheId, false);
                    return false;
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
    }
    protected static function getProductAttributesGroups($productObj, $idProductAttributeDefault = null, $idProductAttributeWhiteList = [])
    {
        $context = Context::getContext();
        $attributes_groups = $productObj->getAttributesGroups($context->language->id);
        if (!AdvancedPackCoreClass::_isFilledArray($attributes_groups)) {
            return [
                'groups' => [],
                'colors' => false,
                'combinations' => [],
                'combinationImages' => [],
            ];
        }
        $colors = $groups = $combinations = $combination_prices_set = [];
        $combinationImages = $productObj->getCombinationImages($context->language->id);
        $hideUnavailableAttributes = (!Product::isAvailableWhenOutOfStock($productObj->out_of_stock) && Configuration::get('PS_DISP_UNAVAILABLE_ATTR') == 0);
        foreach ($attributes_groups as $k => $row) {
            if ($idProductAttributeDefault != null && (int)$idProductAttributeDefault == (int)$row['id_product_attribute']) {
                $attributes_groups[$k]['default_on'] = true;
            } else {
                $attributes_groups[$k]['default_on'] = false;
            }
            if (count($idProductAttributeWhiteList) && !in_array((int)$row['id_product_attribute'], $idProductAttributeWhiteList)) {
                unset($attributes_groups[$k]);
                continue;
            }
        }
        foreach ($attributes_groups as $k => $row) {
            $imageExists = Tools::file_exists_cache(_PS_COL_IMG_DIR_ . $row['id_attribute'] . '.jpg');
            if (isset($row['is_color_group']) && $row['is_color_group'] && (isset($row['attribute_color']) && $row['attribute_color']) || $imageExists) {
                $colors[$row['id_attribute']]['image_exists'] = $imageExists;
                $colors[$row['id_attribute']]['value'] = $row['attribute_color'];
                $colors[$row['id_attribute']]['name'] = $row['attribute_name'];
                if (!isset($colors[$row['id_attribute']]['attributes_quantity'])) {
                    $colors[$row['id_attribute']]['attributes_quantity'] = 0;
                }
                $colors[$row['id_attribute']]['attributes_quantity'] += (int)$row['quantity'];
            }
            if (!isset($groups[$row['id_attribute_group']])) {
                $groups[$row['id_attribute_group']] = [
                    'group_name' => $row['group_name'],
                    'name' => $row['public_group_name'],
                    'group_type' => $row['group_type'],
                    'default' => -1,
                ];
            }
            if (!isset($groups[$row['id_attribute_group']]['attributes'][$row['id_attribute']])) {
                $groups[$row['id_attribute_group']]['attributes'][$row['id_attribute']] = [
                    'name' => $row['attribute_name'],
                    'html_color_code' => $row['attribute_color'],
                    'texture' => (@filemtime(_PS_COL_IMG_DIR_ . $row['id_attribute'] . '.jpg')) ? _THEME_COL_DIR_ . $row['id_attribute'] . '.jpg' : '',
                    'selected' => $row['default_on'],
                ];
            }
            if ($row['default_on']) {
                $groups[$row['id_attribute_group']]['attributes'][$row['id_attribute']]['selected'] = true;
            }
            if ($row['default_on'] && $groups[$row['id_attribute_group']]['default'] == -1) {
                $groups[$row['id_attribute_group']]['default'] = (int)$row['id_attribute'];
            }
            if (!isset($groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']])) {
                $groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']] = 0;
            }
            $groups[$row['id_attribute_group']]['attributes_quantity'][$row['id_attribute']] += (int)$row['quantity'];
            $combinations[$row['id_product_attribute']]['attributes_values'][$row['id_attribute_group']] = $row['attribute_name'];
            $combinations[$row['id_product_attribute']]['attributes'][] = (int)$row['id_attribute'];
            $combinations[$row['id_product_attribute']]['price'] = (float)$row['price'];
            if (!isset($combination_prices_set[(int)$row['id_product_attribute']])) {
                $combination_specific_price = null;
                Product::getPriceStatic((int)$productObj->id, false, $row['id_product_attribute'], 6, null, false, true, 1, false, null, null, null, $combination_specific_price);
                $combination_prices_set[(int)$row['id_product_attribute']] = true;
                $combinations[$row['id_product_attribute']]['specific_price'] = $combination_specific_price;
            }
            $combinations[$row['id_product_attribute']]['ecotax'] = (float)$row['ecotax'];
            $combinations[$row['id_product_attribute']]['weight'] = (float)$row['weight'];
            $combinations[$row['id_product_attribute']]['quantity'] = (int)$row['quantity'];
            $combinations[$row['id_product_attribute']]['reference'] = $row['reference'];
            if (isset($row['ean13'])) {
                $combinations[$row['id_product_attribute']]['ean13'] = $row['ean13'];
            }
            if (isset($row['mpn'])) {
                $combinations[$row['id_product_attribute']]['mpn'] = $row['mpn'];
            }
            if (isset($row['upc'])) {
                $combinations[$row['id_product_attribute']]['upc'] = $row['upc'];
            }
            if (isset($row['isbn'])) {
                $combinations[$row['id_product_attribute']]['isbn'] = $row['isbn'];
            }
            $combinations[$row['id_product_attribute']]['unit_impact'] = $row['unit_price_impact'];
            $combinations[$row['id_product_attribute']]['minimal_quantity'] = $row['minimal_quantity'];
            if ($row['available_date'] != '0000-00-00' && Validate::isDate($row['available_date'])) {
                $combinations[$row['id_product_attribute']]['available_date'] = $row['available_date'];
                $combinations[$row['id_product_attribute']]['date_formatted'] = Tools::displayDate($row['available_date']);
            } else {
                $combinations[$row['id_product_attribute']]['available_date'] = $combinations[$row['id_product_attribute']]['date_formatted'] = '';
            }
            if (!isset($combinationImages[$row['id_product_attribute']][0]['id_image'])) {
                $combinations[$row['id_product_attribute']]['id_image'] = -1;
            } else {
                $combinations[$row['id_product_attribute']]['id_image'] = (int)$combinationImages[$row['id_product_attribute']][0]['id_image'];
            }
        }
        $current_selected_attributes = [];
        $count = 0;
        foreach ($groups as &$group) {
            $count++;
            if ($count > 1) {
                $id_product_attributes = [0];
                $query = '
                SELECT pac.`id_product_attribute`
                FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac
                INNER JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON pa.`id_product_attribute` = pac.`id_product_attribute`
                WHERE `id_product` = ' . (int)$productObj->id . ' AND `id_attribute` IN (' . implode(',', array_map('intval', $current_selected_attributes)) . ')
                GROUP BY `id_product_attribute`
                HAVING COUNT(`id_product`) = ' . count($current_selected_attributes);
                if ($results = Db::getInstance()->executeS($query)) {
                    foreach ($results as $row) {
                        $id_product_attributes[] = (int)$row['id_product_attribute'];
                    }
                }
                $id_attributes = Db::getInstance()->executeS('
                SELECT pac2.`id_attribute`
                FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac2' .
                ($hideUnavailableAttributes ? ' INNER JOIN `' . _DB_PREFIX_ . 'stock_available` pa ON pa.`id_product_attribute` = pac2.`id_product_attribute` WHERE pa.`quantity` > 0 AND ' : ' WHERE ') .
                'pac2.`id_product_attribute` IN (' . implode(',', array_map('intval', $id_product_attributes)) . ')
                AND pac2.`id_attribute` NOT IN (' . implode(',', array_map('intval', $current_selected_attributes)) . ')');
                foreach ($id_attributes as $k => $row) {
                    $id_attributes[$k] = (int)$row['id_attribute'];
                }
                foreach ($group['attributes'] as $key => $attribute) {
                    if (!in_array((int)$key, $id_attributes)) {
                        unset(
                            $group['attributes'][$key],
                            $group['attributes_quantity'][$key]
                        );
                    }
                }
            }
            $index = 0;
            $current_selected_attribute = 0;
            foreach ($group['attributes'] as $key => $attribute) {
                if ($index === 0) {
                    $current_selected_attribute = $key;
                }
                if ($attribute['selected']) {
                    $current_selected_attribute = $key;
                    break;
                }
            }
            if ($current_selected_attribute > 0) {
                $current_selected_attributes[] = $current_selected_attribute;
            }
        }
        if ($hideUnavailableAttributes) {
            foreach ($groups as &$group) {
                foreach ($group['attributes_quantity'] as $key => $quantity) {
                    if ($quantity <= 0) {
                        unset($group['attributes'][$key]);
                    }
                }
            }
            foreach ($colors as $key => $color) {
                if ($color['attributes_quantity'] <= 0) {
                    unset($colors[$key]);
                }
            }
        }
        foreach ($combinations as $id_product_attribute => $comb) {
            $attribute_list = '';
            foreach ($comb['attributes'] as $id_attribute) {
                $attribute_list .= '\'' . (int)$id_attribute . '\',';
            }
            $attribute_list = rtrim($attribute_list, ',');
            $combinations[$id_product_attribute]['list'] = $attribute_list;
        }
        unset($group);
        return [
            'groups' => $groups,
            'colors' => (count($colors)) ? $colors : false,
            'combinations' => $combinations,
            'combinationImages' => $combinationImages,
        ];
    }
    public function updatePackContent($packContent, $packSettings, $isNewPack = false, $isMajorUpdate = false)
    {
        $res = true;
        if ($isNewPack) {
            $res &= Db::getInstance()->insert('pm_advancedpack', ['id_pack' => $this->id, 'id_shop' => (int)self::getContext()->shop->id, 'fixed_price' => json_encode($packSettings['fixedPrice']), 'allow_remove_product' => (int)$packSettings['allowRemoveProduct']], true);
        }
        if (!$isNewPack) {
            $sql = new DbQuery();
            $sql->select('`id_cart`, `id_pack`, `id_product_attribute_pack`');
            $sql->from('pm_advancedpack_cart_products', 'acp');
            $sql->leftJoin('product_attribute', 'ipa', 'acp.`id_product_attribute` = ipa.`id_product_attribute`');
            $sql->where('acp.`id_order` IS NULL');
            $sql->where('acp.`id_product_attribute` != 0');
            $sql->where('ipa.`id_product_attribute` IS NULL');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
            if (AdvancedPackCoreClass::_isFilledArray($result)) {
                foreach ($result as $packToRemoveFromCart) {
                    $res &= Db::getInstance()->delete('cart_product', '`id_cart`=' . (int)$packToRemoveFromCart['id_cart'] . ' AND `id_product`=' . (int)$packToRemoveFromCart['id_pack'] . ' AND `id_product_attribute`=' . (int)$packToRemoveFromCart['id_product_attribute_pack']);
                    $res &= Db::getInstance()->delete('pm_advancedpack_cart_products', '`id_pack`=' . (int)$packToRemoveFromCart['id_pack'] . ' AND `id_product_attribute_pack`=' . (int)$packToRemoveFromCart['id_product_attribute_pack']);
                }
            }
        }
        if ($isMajorUpdate) {
            $sql = new DbQuery();
            $sql->select('GROUP_CONCAT(DISTINCT `id_product_attribute_pack`)');
            $sql->from('pm_advancedpack_cart_products', 'acp');
            $sql->where('acp.`id_pack`=' . (int)$this->id);
            $sql->where('acp.`id_order` IS NULL');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if ($result !== false && !empty($result)) {
                $result = array_map('intval', explode(',', $result));
                if (AdvancedPackCoreClass::_isFilledArray($result)) {
                    foreach ($result as $idProductAttribute) {
                        if ((int)$idProductAttribute > 0) {
                            self::setStockAvailableQuantity((int)$this->id, (int)$idProductAttribute, 0, false);
                        }
                    }
                }
            }
        } elseif (!$isMajorUpdate && !$isNewPack) {
            $sql = new DbQuery();
            $sql->select('GROUP_CONCAT(DISTINCT `id_product_attribute_pack`)');
            $sql->from('pm_advancedpack_cart_products', 'acp');
            $sql->where('acp.`id_pack`=' . (int)$this->id);
            $sql->where('acp.`id_order` IS NULL');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if ($result !== false && !empty($result)) {
                $result = array_map('intval', explode(',', $result));
                if (AdvancedPackCoreClass::_isFilledArray($result)) {
                    foreach ($result as $idProductAttribute) {
                        if ((int)$idProductAttribute > 0) {
                            $idProductAttributeList = self::getIdProductAttributeListByIdPack((int)$this->id, $idProductAttribute);
                            self::addPackSpecificPrice((int)$this->id, $idProductAttribute, $idProductAttributeList);
                            if (self::isValidPack((int)$this->id, true)) {
                                self::setStockAvailableQuantity((int)$this->id, (int)$idProductAttribute, self::getPackAvailableQuantity((int)$this->id, $idProductAttributeList), false);
                            } else {
                                self::setStockAvailableQuantity((int)$this->id, (int)$idProductAttribute, 0, false);
                            }
                        }
                    }
                }
            }
        }
        $res &= Db::getInstance()->delete('pm_advancedpack_products', '`id_pack`=' . (int)$this->id);
        $res &= Db::getInstance()->delete('pm_advancedpack_products_attributes', '`id_product_pack` NOT IN (SELECT `id_product_pack` FROM `' . _DB_PREFIX_ . 'pm_advancedpack_products`)');
        $res &= Db::getInstance()->delete('pm_advancedpack_products_customization', '`id_product_pack` NOT IN (SELECT `id_product_pack` FROM `' . _DB_PREFIX_ . 'pm_advancedpack_products`)');
        self::clearAP5Cache();
        foreach ($packContent as $k => $packContentRow) {
            unset($packContentRow['customCombinations']);
            unset($packContentRow['combinationsInformations']);
            unset($packContentRow['customCustomizationField']);
            $res &= Db::getInstance()->insert('pm_advancedpack_products', $packContentRow, true);
            if (is_null($packContentRow['id_product_pack'])) {
                $packContent[$k]['id_product_pack'] = (int)Db::getInstance()->Insert_ID();
            }
        }
        foreach ($packContent as $k => $packContentRow) {
            if (AdvancedPackCoreClass::_isFilledArray($packContentRow['customCombinations'])) {
                foreach ($packContentRow['customCombinations'] as $idProductAttribute) {
                    $res &= Db::getInstance()->insert('pm_advancedpack_products_attributes', [
                        'id_product_pack' => (int)$packContentRow['id_product_pack'],
                        'id_product_attribute' => (int)$idProductAttribute,
                    ]);
                }
            }
            if (AdvancedPackCoreClass::_isFilledArray($packContentRow['combinationsInformations'])) {
                foreach ($packContentRow['combinationsInformations'] as $idProductAttribute => $combinationRow) {
                    $res &= Db::getInstance()->update('pm_advancedpack_products_attributes', [
                        'reduction_amount' => (float)$combinationRow['reduction_amount'],
                        'reduction_type' => (empty($combinationRow['reduction_type']) ? null : $combinationRow['reduction_type']),
                    ], '`id_product_pack`=' . (int)$packContentRow['id_product_pack'] . ' AND `id_product_attribute`=' . (int)$idProductAttribute, 0, true);
                }
            }
            if (AdvancedPackCoreClass::_isFilledArray($packContentRow['customCustomizationField'])) {
                foreach ($packContentRow['customCustomizationField'] as $idCustomizationField) {
                    $res &= Db::getInstance()->insert('pm_advancedpack_products_customization', [
                        'id_product_pack' => (int)$packContentRow['id_product_pack'],
                        'id_customization_field' => (int)$idCustomizationField,
                    ]);
                }
            }
        }
        $updateDatas = [
            'fixed_price' => json_encode($packSettings['fixedPrice']),
            'allow_remove_product' => (int)$packSettings['allowRemoveProduct'],
        ];
        if (isset($packSettings['isBundle'])) {
            $updateDatas['is_bundle'] = (int)$packSettings['isBundle'];
            $updateDatas['bundle_datas'] = json_encode($packSettings['bundleDatas'], JSON_UNESCAPED_UNICODE);
        }
        $res &= Db::getInstance()->update('pm_advancedpack', $updateDatas, '`id_pack`=' . (int)$this->id . ' AND `id_shop`=' . (int)self::getContext()->shop->id, 0, true);
        return (bool)$res;
    }
    public static function removeOldPackData()
    {
        if (self::REMOVE_UNORDERED_PACK_DAYS <= 0) {
            return;
        }
        $oldCart = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT DISTINCT c.`id_cart`, acp.`id_pack`, acp.`id_product_attribute_pack`, acp.`id_order`
            FROM `' . _DB_PREFIX_ . 'pm_advancedpack_cart_products` acp
            LEFT JOIN `' . _DB_PREFIX_ . 'cart` c ON (c.`id_cart` = acp.`id_cart`)
            WHERE acp.`cleaned`=0
            AND c.`date_upd` < DATE_SUB(NOW(), INTERVAL ' . (int)self::REMOVE_UNORDERED_PACK_DAYS . ' DAY)
        ');
        if ($oldCart !== false && AdvancedPackCoreClass::_isFilledArray($oldCart)) {
            foreach ($oldCart as $oldCartRow) {
                $idProductAttribute = (int)$oldCartRow['id_product_attribute_pack'];
                if (!empty($oldCartRow['id_cart']) && !empty($oldCartRow['id_pack']) && !empty($idProductAttribute)) {
                    $idAttribute = (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
                        SELECT `id_attribute`
                        FROM `' . _DB_PREFIX_ . 'product_attribute_combination`
                        WHERE `id_product_attribute` = ' . (int)$idProductAttribute);
                    if (version_compare(_PS_VERSION_, '8.0.0', '>=')) {
                        $attributeObj = new ProductAttribute($idAttribute);
                    } else {
                        $attributeObj = new Attribute($idAttribute);
                    }
                    $validPackAttributeGroup = (Validate::isLoadedObject($attributeObj) && $attributeObj->id_attribute_group == self::getPackAttributeGroupId());
                    if ($validPackAttributeGroup) {
                        Db::getInstance()->delete('attribute_shop', '`id_attribute` = ' . (int)$idAttribute);
                    }
                    Db::getInstance()->delete('product_attribute_shop', '`id_product_attribute` = ' . (int)$idProductAttribute);
                    Db::getInstance()->delete('specific_price', '`id_product_attribute` = ' . (int)$idProductAttribute);
                    if (empty($oldCartRow['id_order'])) {
                        if ($validPackAttributeGroup) {
                            $attributeObj->delete();
                        }
                        Db::getInstance()->delete('cart_product', '`id_product_attribute` = ' . (int)$idProductAttribute);
                        Db::getInstance()->execute('
                            DELETE FROM `' . _DB_PREFIX_ . 'pm_advancedpack_cart_products`
                            WHERE `id_pack` = ' . (int)$oldCartRow['id_pack'] . '
                            AND `id_product_attribute_pack` = ' . (int)$idProductAttribute . '
                            AND `id_cart` = ' . (int)$oldCartRow['id_cart']);
                    } else {
                        self::$actionRemoveOldPackDataProcessing = true;
                        $oldCartProductsRows = Db::getInstance()->executeS('
                            SELECT *
                            FROM `' . _DB_PREFIX_ . 'cart_product`
                            WHERE `id_product_attribute` = ' . (int)$idProductAttribute . '
                            AND `id_cart` = ' . (int)$oldCartRow['id_cart']);
                        if ($validPackAttributeGroup) {
                            $attributeObj->delete();
                        }
                        $oldCartProductsRowsCheck = Db::getInstance()->executeS('
                            SELECT *
                            FROM `' . _DB_PREFIX_ . 'cart_product`
                            WHERE `id_product_attribute` = ' . (int)$idProductAttribute . '
                            AND `id_cart` = ' . (int)$oldCartRow['id_cart']);
                        if (empty($oldCartProductsRowsCheck)) {
                            foreach ($oldCartProductsRows as $oldCartProductsRow) {
                                Db::getInstance()->execute('INSERT INTO `' . _DB_PREFIX_ . 'cart_product`
                                    (`id_cart`, `id_product`, `id_shop`, `id_product_attribute`, `quantity`, `date_add`, `id_address_delivery`)
                                    VALUES (
                                        ' . (int)$oldCartProductsRow['id_cart'] . ',
                                        ' . (int)$oldCartProductsRow['id_product'] . ',
                                        ' . (int)$oldCartProductsRow['id_shop'] . ',
                                        ' . (int)$oldCartProductsRow['id_product_attribute'] . ',
                                        ' . (int)$oldCartProductsRow['quantity'] . ',
                                        "' . pSQL($oldCartProductsRow['date_add']) . '",
                                        ' . (int)$oldCartProductsRow['id_address_delivery'] . ')');
                            }
                        }
                        Db::getInstance()->execute('
                            UPDATE `' . _DB_PREFIX_ . 'pm_advancedpack_cart_products`
                            SET `cleaned` = 1
                            WHERE `id_pack` = ' . (int)$oldCartRow['id_pack'] . '
                            AND `id_product_attribute_pack` = ' . (int)$idProductAttribute . '
                            AND `id_cart` = ' . (int)$oldCartRow['id_cart']);
                        self::$actionRemoveOldPackDataProcessing = false;
                    }
                }
            }
        }
    }
    public static function getPackListToFix($useCache = true)
    {
        $idPackListToFix = [];
        if ($useCache) {
            $cache = Configuration::get('PM_AP5_INVALID_PACKS');
            if (!empty($cache)) {
                $cache = json_decode($cache, true);
                if (is_array($cache)) {
                    return $cache;
                }
            }
        }
        $sql = new DbQuery();
        $sql->select('app.`id_pack`, app.`id_product`');
        $sql->from('pm_advancedpack', 'ap');
        $sql->innerJoin('product_shop', 'p_shop', 'ap.`id_pack` = p_shop.`id_product` AND p_shop.`id_shop` IN (' . implode(', ', Shop::getContextListShopID()) . ')');
        $sql->innerJoin('pm_advancedpack_products', 'app', 'app.`id_pack` = ap.`id_pack`');
        $sql->leftJoin('product_attribute', 'pa', 'app.`id_product` = pa.`id_product` AND app.`default_id_product_attribute` = pa.`id_product_attribute`');
        $sql->where('ap.`id_shop` IN (' . implode(', ', Shop::getContextListShopID()) . ')');
        $sql->where('app.`default_id_product_attribute` != 0');
        $sql->where('pa.`id_product_attribute` IS NULL');
        $resultProductCombinations = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (!AdvancedPackCoreClass::_isFilledArray($resultProductCombinations)) {
            $resultProductCombinations = [];
        }
        $sql = new DbQuery();
        $sql->select('app.`id_pack`, app.`id_product`');
        $sql->from('pm_advancedpack', 'ap');
        $sql->innerJoin('product_shop', 'p_shop', 'ap.`id_pack` = p_shop.`id_product` AND p_shop.`id_shop` IN (' . implode(', ', Shop::getContextListShopID()) . ')');
        $sql->innerJoin('pm_advancedpack_products', 'app', 'app.`id_pack` = ap.`id_pack`');
        $sql->leftJoin('product_attribute', 'pa', 'app.`id_product` = pa.`id_product`');
        $sql->where('ap.`id_shop` IN (' . implode(', ', Shop::getContextListShopID()) . ')');
        $sql->where('app.`default_id_product_attribute` = 0');
        $sql->groupBy('app.`id_pack`, app.`id_product`');
        $sql->having('COUNT(pa.`id_product`) > 0');
        $resultProductWithoutCombinations = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (!AdvancedPackCoreClass::_isFilledArray($resultProductWithoutCombinations)) {
            $resultProductWithoutCombinations = [];
        }
        $result = array_merge($resultProductCombinations, $resultProductWithoutCombinations);
        foreach ($result as $row) {
            if (!isset($idPackListToFix[(int)$row['id_pack']])) {
                $idPackListToFix[(int)$row['id_pack']] = [];
            }
            $idPackListToFix[(int)$row['id_pack']][] = (int)$row['id_product'];
        }
        Configuration::updateValue('PM_AP5_INVALID_PACKS', json_encode($idPackListToFix));
        return $idPackListToFix;
    }
    private static $ap5Context = null;
    public static function setContext($context)
    {
        pm_advancedpack::$moduleCacheId = null;
        self::$ap5Context = $context;
        $currentContext = Context::getContext();
        $currentContext->customer = $context->customer;
        $currentContext->currency = $context->currency;
        $currentContext->country = $context->country;
    }
    public static function getContext()
    {
        if (self::$ap5Context == null) {
            self::$ap5Context = Context::getContext();
            if (!Validate::isLoadedObject(self::$ap5Context->cart) && isset(self::$ap5Context->cookie->id_cart) && Validate::isUnsignedId((int)self::$ap5Context->cookie->id_cart)) {
                $cart = new Cart((int)self::$ap5Context->cookie->id_cart);
                self::$ap5Context->cart = $cart;
            }
        }
        return self::$ap5Context;
    }
    public static function excludeTaxeOption()
    {
        static $excludeTaxeOption = null;
        if ($excludeTaxeOption === null) {
            $excludeTaxeOption = Tax::excludeTaxeOption();
        }
        return $excludeTaxeOption;
    }
    public static function getModuleInstance()
    {
        static $moduleInstance = null;
        if ($moduleInstance === null) {
            $moduleInstance = Module::getInstanceByName('pm_advancedpack');
        }
        return $moduleInstance;
    }
    private static $ap5Cache = [];
    private static function getPMCacheId($key, $withNativeCacheId = false)
    {
        return self::MODULE_ID . sha1($key . ($withNativeCacheId ? AdvancedPack::getModuleInstance()->getPMNativeCacheId() : ''));
    }
    private static function isInCache($key)
    {
        return array_key_exists($key, self::$ap5Cache);
    }
    private static function getFromCache($key)
    {
        return self::$ap5Cache[$key];
    }
    private static function storeInCache($key, $value)
    {
        self::$ap5Cache[$key] = $value;
    }
    public static function clearAP5Cache()
    {
        self::$ap5Cache = [];
        Configuration::updateValue('PM_AP5_INVALID_PACKS', '');
    }
    public static function getBundleFeatureId()
    {
        $cacheId = self::getPMCacheId(__METHOD__ . self::getContext()->language->id . self::getContext()->shop->id);
        if (!self::isInCache($cacheId)) {
            $features = Feature::getFeatures(self::getContext()->language->id);
            if (AdvancedPackCoreClass::_isFilledArray($features)) {
                foreach ($features as $feature) {
                    if ($feature['name'] == 'AP5-Bundle') {
                        self::storeInCache($cacheId, (int)$feature['id_feature']);
                        return (int)$feature['id_feature'];
                    }
                }
            }
        } else {
            return self::getFromCache($cacheId);
        }
        self::storeInCache($cacheId, false);
        return false;
    }
    public static function isBundle($productId)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$productId);
        if (!self::isInCache($cacheId)) {
            $query = new DbQuery();
            $query->select('`is_bundle`');
            $query->from('pm_advancedpack');
            $query->where('`id_pack` = ' . (int)$productId);
            $isBundle = (bool)Db::getInstance()->getValue($query);
            self::storeInCache($cacheId, $isBundle);
            return $isBundle;
        }
        return self::getFromCache($cacheId);
    }
    public static function productHasBundles($productId, $productAttributeId = null)
    {
        $cacheId = self::getPMCacheId(__METHOD__ . (int)$productId . (int)$productAttributeId);
        if (self::isInCache($cacheId)) {
            return self::getFromCache($cacheId);
        }
        $query = new DbQuery();
        $query->select('COUNT(*)');
        $query->from('pm_advancedpack', 'a');
        $query->innerJoin('pm_advancedpack_products', 'ap', 'ap.id_pack = a.id_pack');
        $query->where('a.`is_bundle` = 1');
        $query->where('ap.`id_product` = ' . (int)$productId);
        if (!empty($productAttributeId)) {
            $query->where('ap.`default_id_product_attribute` = ' . (int)$productAttributeId);
        }
        $productHasBundles = ((int)Db::getInstance()->getValue($query) > 0);
        self::storeInCache($cacheId, $productHasBundles);
        return $productHasBundles;
    }
    public static function getMainProductIdFromBundleId($productId)
    {
        $query = new DbQuery();
        $query->select('`id_product`');
        $query->from('pm_advancedpack_products');
        $query->where('`id_pack` = ' . (int)$productId);
        return (int)Db::getInstance()->getValue($query);
    }
    public static function getBundlesByProductId($productId, $productAttributeId = null, $languageId = null)
    {
        if (!Validate::isUnsignedId($productId)) {
            return [];
        }
        if ($languageId === null) {
            $languageId = Context::getContext()->language->id;
        }
        $product = new Product($productId, false, $languageId);
        $query = new DbQuery();
        $query->select('a.*, ap.`quantity`');
        $query->from('pm_advancedpack', 'a');
        $query->leftJoin('pm_advancedpack_products', 'ap', 'ap.id_pack = a.id_pack');
        $query->innerJoin('product_shop', 'p_shop', 'p_shop.`id_shop`=' . (int)Context::getContext()->shop->id . ' AND p_shop.`id_product` = a.`id_pack`');
        $query->where('a.`is_bundle` = 1');
        $query->where('ap.`id_product` = ' . (int)$productId);
        if (!empty($productAttributeId)) {
            $query->where('ap.`default_id_product_attribute` = ' . (int)$productAttributeId);
        }
        $query->groupBy('a.id_pack');
        $query->orderBy('ap.`quantity` ASC');
        $bundles = Db::getInstance()->executeS($query);
        if (is_array($bundles) && count($bundles)) {
            $config = pm_advancedpack::getModuleConfigurationStatic();
            foreach ($bundles as &$bundle) {
                $bundle['datas'] = json_decode($bundle['bundle_datas']);
                $featureValue = new FeatureValue((int) $bundle['datas']->badge, (int) $languageId);
                if (Validate::isLoadedObject($featureValue)) {
                    $bundle['badge_name'] = $featureValue->value;
                } else {
                    $bundle['badge_name'] = 'N/A';
                }
                $bundle['combination_name'] = 'N/A';
                if (!empty($bundle['datas']->combination)) {
                    $attributeList = AdvancedPack::getProductAttributeList((int)$bundle['datas']->combination, (int)$languageId);
                    if (isset($attributeList['attributes'])) {
                        $bundle['combination_name'] = $attributeList['attributes'];
                    }
                }
                $bundle['default_image'] = [];
                $bundle['image'] = [];
                if ((int) $bundle['datas']->image) {
                    $bundle['default_image']['link'] = Context::getContext()->link->getImageLink($product->link_rewrite, (string)$bundle['datas']->image, ImageType::getFormattedName('small'));
                    $bundle['image']['link'] = Context::getContext()->link->getImageLink($product->link_rewrite, (string)$bundle['datas']->image, $config['imageFormatProductThumbs']);
                }
                $bundle['bundlePriceTaxesIncluded'] = Tools::displayPrice(AdvancedPack::getPackPrice($bundle['id_pack'], true));
                $bundle['bundlePriceTaxesExcluded'] = Tools::displayPrice(AdvancedPack::getPackPrice($bundle['id_pack'], false));
                $bundle['productPriceTaxesIncluded'] = Tools::displayPrice($product->getPrice(true, $productAttributeId, 6, null, false, false) * $bundle['quantity']);
                $bundle['productPriceTaxesExcluded'] = Tools::displayPrice($product->getPrice(false, $productAttributeId, 6, null, false, false) * $bundle['quantity']);
                $bundle['addToCartUrl'] = pm_advancedpack::getPackAddCartURL((int) $bundle['id_pack']);
                $bundle['publicUrl'] = $product->getLink();
                $bundle['reductionToDisplay'] = '-';
                if (isset($bundle['datas']->reduction->amount) && $bundle['datas']->reduction->amount) {
                    if (isset($bundle['datas']->reduction->type) && $bundle['datas']->reduction->type == 'percentage') {
                        $bundle['reductionToDisplay'] = Tools::displayNumber($bundle['datas']->reduction->amount) . '%';
                    } else {
                        $bundle['reductionToDisplay'] = Tools::displayPrice($bundle['datas']->reduction->amount);
                    }
                }
            }
        }
        return $bundles;
    }
    public static function getBundlesDatas($productId)
    {
        if (!Validate::isUnsignedId($productId)) {
            return new stdClass();
        }
        $query = new DbQuery();
        $query->select('a.`bundle_datas`');
        $query->from('pm_advancedpack', 'a');
        $query->innerJoin('product_shop', 'p_shop', 'p_shop.`id_shop`=' . (int)Context::getContext()->shop->id . ' AND p_shop.`id_product` = a.`id_pack`');
        $query->where('a.`is_bundle` = 1');
        $query->where('a.`id_pack` = ' . (int)$productId);
        $bundleDatas = Db::getInstance()->getValue($query);
        return json_decode($bundleDatas);
    }
    public static function associateImageToBundle($imageId, $productId)
    {
        if (!Validate::isUnsignedId($imageId) || !Validate::isUnsignedId($productId)) {
            return false;
        }
        $imagesTypes = ImageType::getImagesTypes('products');
        $imageOld = new Image($imageId);
        $imageNew = clone $imageOld;
        $idProductOld = $imageOld->id_product;
        unset($imageNew->id);
        $imageNew->id_product = (int) $productId;
        $imageNew->cover = true;
        if ($imageNew->add()) {
            $newPath = $imageNew->getPathForCreation();
            foreach ($imagesTypes as $imageType) {
                if (file_exists(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '-' . $imageType['name'] . '.jpg')) {
                    if (!Configuration::get('PS_LEGACY_IMAGES')) {
                        $imageNew->createImgFolder();
                    }
                    copy(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '-' . $imageType['name'] . '.jpg', $newPath . '-' . $imageType['name'] . '.jpg');
                    if (Configuration::get('WATERMARK_HASH')) {
                        $oldImagePath = _PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '-' . $imageType['name'] . '-' . Configuration::get('WATERMARK_HASH') . '.jpg';
                        if (file_exists($oldImagePath)) {
                            copy($oldImagePath, $newPath . '-' . $imageType['name'] . '-' . Configuration::get('WATERMARK_HASH') . '.jpg');
                        }
                    }
                }
            }
            if (file_exists(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '.jpg')) {
                copy(_PS_PROD_IMG_DIR_ . $imageOld->getExistingImgPath() . '.jpg', $newPath . '.jpg');
            }
            $imageNew->duplicateShops($idProductOld);
        } else {
            return false;
        }
        return true;
    }
    public function getAttributesGroups($id_lang, $id_product_attribute = null)
    {
        return [];
    }
    public function hasCombinations()
    {
        return false;
    }
}
