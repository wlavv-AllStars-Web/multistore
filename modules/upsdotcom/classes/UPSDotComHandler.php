<?php
/**
 * 2014-2024 Web VIZO LLC
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the module to newer
 * versions in the future. If you wish to customize the module for your
 * needs please refer to https://www.webvizo.com (support@webvizo.com) for
 * more information.
 *
 *  @author    Web VIZO LLC <support@webvizo.com>
 *  @copyright 2014-2024 Web VIZO LLC
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of Web VIZO LLC
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

include_once dirname(__FILE__) . '/../upsdotcom.php';
class UPSDotComHandler
{
    private $module;
    private $context;

    private $module_carrier;
    private $cache_md5_string;
    private $packages;
    private $package_list;

    private $return_label_index;

    private $id_warehouse;
    private $warehouse_carrier_list;

    private $cart;
    private $rate_currency;

    public $order_total;
    public $order_total_wt;

    public function setCart($cart)
    {
        $this->cart = $cart;
        $this->rate_currency = new Currency();

        if (Validate::isLoadedObject($this->cart)) {
            $this->rate_currency = new Currency((int) $this->cart->id_currency);
        }
        if (!Validate::isLoadedObject($this->rate_currency)) {
            $this->rate_currency = $this->context->currency;
        }
        if (!Validate::isLoadedObject($this->rate_currency)) {
            $this->rate_currency = new Currency((int) Configuration::get('PS_CURRENCY_DEFAULT'));
        }
    }
    private $products;

    public function setProducts($products)
    {
        $this->products = $products;
    }

    private $id_order;

    private $request;
    public $post_response;

    private $tracking_numbers;
    private $additional_info;

    public $destination_address;
    public $origin_address;
    public $shipment_method;
    public $shipment_option;
    public $packages_for_shipment;
    public $date_of_shipment;
    public $is_intl;
    public $customs_clearance;

    public $response;
    public $shipping_rate;
    public $quote_currency;
    public $output;

    public function __construct($id_carrier, $id_order = 0)
    {
        $this->module = new UPSDotCom();
        $this->module->id_carrier = $id_carrier;
        $this->id_order = $id_order;
        $this->context = $this->module->getContext();
    }

    public function setDeafaults($cart = false)
    {
        $this->setCart($cart);
        $this->getConfiguredPackages();

        $this->package_list = [];
        $this->id_warehouse = 0;
        $this->warehouse_carrier_list = [];

        $this->module_carrier = [];

        $this->return_label_index = 0;

        $this->shipment_method = '';
        $this->shipment_option = [];

        $this->products = [];

        $this->is_intl = false;
        $this->customs_clearance = false;
        $this->origin_address = [];
        $this->destination_address = [];

        $this->date_of_shipment = new DateTime();
        $this->request = [];
        $this->response = [];
        $this->post_response = null;
        $this->shipping_rate = null;
        $this->quote_currency = null;

        $this->output = '';

        $this->order_total = 0;
        $this->order_total_wt = 0;
    }

    // region Postage
    public function getPostage($cart = false, $products = [])
    {
        if (!$this->module->active) {
            return false;
        }

        $this->setDeafaults($cart);

        if (!$this->getShippingAddresses()) {
            return false;
        }

        $carriers = UPSDotComCarrier::getModuleCarriers($this->module->getContext());

        if (!is_array($carriers) || !count($carriers)) {
            return false;
        }

        foreach ($carriers as $carrier) {
            if ($carrier['id_carrier'] == $this->module->id_carrier) {
                $this->module_carrier = $carrier;
                break;
            }
        }

        if (!is_array($this->module_carrier) || !count($this->module_carrier)) {
            return false;
        }

        $shipping_methods = UPSDotComConfiguration::getShippingMethods();
        $shipping_methods = $shipping_methods[$this->is_intl ? 'INTL' : 'DOM'];

        if (!isset($shipping_methods[$this->module_carrier['method']])) {
            return false;
        }

        $this->shipment_method = $this->module_carrier['method'];
        $this->shipment_option = $this->module_carrier['options'];

        if (is_array($products) && count($products)) {
            $this->products = $products;
        } elseif (Validate::isLoadedObject($this->cart)) {
            $this->products = $this->cart->getProducts();
        }

        if (Validate::isLoadedObject($this->cart)) {
            $id_order = (int) Order::getOrderByCartId($this->cart->id);
            $order = new Order($id_order);

            if (Validate::isLoadedObject($order)) {
                if (is_array($this->products) && count($this->products) === 0) {
                    $this->products = $order->getCartProducts();
                }
                $order_details = $order->getOrderDetailList();
                $this->products = UPSDotCom::updateProductsWithOrderDetail($this->products, $order_details);
            }
        }

        $cache_id = self::getCacheId('UPSDotCom', $this->products, $this->packages);
        if ($cache_id != null) {
            if (Cache::isStored($cache_id)) {
                $this->packages_for_shipment = Cache::retrieve($cache_id);
            } elseif (UPSDotComCache::getInstance()->exists($cache_id)) {
                $this->packages_for_shipment = UPSDotComCache::getInstance()->get($cache_id);
            }
        }

        if ($this->packages_for_shipment == null) {
            $boxing = new UPSDotComBoxing([
                'packages' => $this->packages,
                'products' => $this->products,
                'weight_only_packing' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_WEIGHT_ONLY'),
            ]);

            $this->packages_for_shipment = $boxing->getPackedPackages();

            if ($cache_id != null) {
                Cache::store($cache_id, $this->packages_for_shipment);
                if ($this->packages_for_shipment !== false) {
                    UPSDotComCache::getInstance()->set($cache_id, $this->packages_for_shipment);
                }
            }
        }

        $this->order_total = 0;
        $this->order_total_wt = 0;
        if (Validate::isLoadedObject($this->cart)) {
            $this->order_total = $this->cart->getOrderTotal(true, 7);
            $this->order_total_wt = $this->cart->getOrderTotal(false, 7);
        } elseif (is_array($this->packages_for_shipment) && count($this->packages_for_shipment)) {
            foreach ($this->packages_for_shipment as $package) {
                $this->order_total += $package['products_price'];
                $this->order_total_wt += $package['products_price'];
            }
        }

        /* CRITICAL! MODULE FAILED TO PACK THE PRODUCTS */
        if ($this->packages_for_shipment === false) {
            return false;
        }

        $this->getShippingRates();
        if ($this->shipping_rate >= 0) {
            $this->shipping_rate = number_format($this->shipping_rate, 2, '.', '');

            return $this->shipping_rate;
        } else {
            return false;
        }
    }

    protected static function getCacheId($cache_prefix, $products, $packages)
    {
        $cache_level = Configuration::get(UPSDotCom::$module_prefix_upper . '_CACHE_LEVEL');
        if ((int) $cache_level == 0) {
            return null;
        }

        $cache_packages = $packages;
        /*
         * CACHE LEVEL
         * 0 => NO CACHE
         * 1 => FULL CACHE
         * 2 => FULL PACKAGES + SIMPLIFIED PRODUCTS
         * 3 => SIMPLIFIED PACKAGES + FULL PRODUCTS
         * 4 => SIMPLIFIED CACHE
         */

        if ($cache_level > 2) {
            foreach ($cache_packages as &$package) {
                unset($package['type']);
                unset($package['additional_weight']);
                unset($package['additional_charge']);
                unset($package['priority']);
            }
        }

        $total_weight = 0;
        $total_volume = 0;
        $cache_products = [];
        foreach ($products as $product) {
            if ($cache_level == 1 || $cache_level == 3) {
                $key = $product['width'] . '_' . $product['height'] . '_' . $product['depth'] . '_' . $product['weight'];

                if (!isset($cache_products[$key])) {
                    $cache_products[$key] = true;
                }
            }

            $total_weight += $product['weight'] * $product['cart_quantity'];
            $total_volume += ($product['width'] * $product['height'] * $product['depth']) * $product['cart_quantity'];
        }

        $cache_id = UPSDotComCarrierModule::encodeString(UPSDotComCarrierModule::safeSerialization($cache_packages)) . '_';
        if (count($cache_products) > 0) {
            $cache_id .= UPSDotComCarrierModule::encodeString(UPSDotComCarrierModule::safeSerialization($cache_products)) . '_';
        }
        $cache_id .= $total_volume . '_' . $total_weight;

        return $cache_prefix . '_' . UPSDotComCarrierModule::encodeString($cache_id);
    }

    public function getShippingRates($use_cache = true, $return = false)
    {
        $this->request = [];

        $this->response = [];
        $this->response['error'] = [];
        $this->response['success'] = [];

        // WEBVIZO TODO : Allow "Return labels" to be choosen by packages (group of shipments)
        if (is_array($this->packages_for_shipment) && count($this->packages_for_shipment)) {
            $packages_for_shipment = $this->preparePackagesForRates($this->packages_for_shipment);

            // pre($use_cache);
            $use_cache = false;

            /** get rates from cache */
            $amount = false;
            if ($use_cache) {
                $this->cache_md5_string = UPSDotComCache::getCacheMD5String(
                    $this->origin_address,
                    $this->destination_address,
                    $packages_for_shipment,
                    $this->module_carrier,
                    (int) $return . '-' . (int) Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_MPS')
                );

                $cache_expiration = Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_USE_CACHE');
                $amount = UPSDotComCache::getCachedRates($this->cache_md5_string, $cache_expiration, $this->rate_currency->id);
            }

            if ($amount !== false && $amount >= 0) {
                $this->shipping_rate += $amount;
            } elseif ($amount < 0) {
                $this->shipping_rate = -1;
            } else {

                if (Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_MPS') && !$return) {
                    $this->requestShippingRates($packages_for_shipment, $return, $use_cache);
                } else {
                    foreach ($packages_for_shipment as $package) {
                        $this->requestShippingRates([$package], $return, $use_cache);
                    }
                }

                if ($use_cache) {
                    UPSDotComCache::saveRatesInCache($this->cache_md5_string, $this->shipping_rate, $this->rate_currency->iso_code);
                }
            }

            /* IF FRONT-OFFICE GET POSTAGE */
            if ($this->shipping_rate > 0 && $this->module_carrier) {
                if (is_array($packages_for_shipment) && count($packages_for_shipment)) {
                    foreach ($packages_for_shipment as $package) {
                        if (isset($package['additional_charge']) && $package['additional_charge'] > 0) {
                            $this->shipping_rate += $package['additional_charge'];
                        }
                    }
                }

                if (
                    isset($this->module_carrier['options']['additional_charge']['amount'], $this->module_carrier['options']['additional_charge']['orders_above'])
                    && $this->module_carrier['options']['additional_charge']['amount'] > 0
                    && $this->module_carrier['options']['additional_charge']['orders_above'] <= $this->order_total
                ) {
                    switch ($this->module_carrier['options']['additional_charge']['type']) {
                        case 1:
                            $this->shipping_rate += $this->module_carrier['options']['additional_charge']['amount'];
                            break;

                        case 2:
                            $this->shipping_rate += $this->order_total_wt * ($this->module_carrier['options']['additional_charge']['amount'] / 100);
                            break;

                        case 3:
                            $this->shipping_rate += $this->order_total * ($this->module_carrier['options']['additional_charge']['amount'] / 100);
                            break;

                        case 4:
                            $this->shipping_rate += $this->shipping_rate * ($this->module_carrier['options']['additional_charge']['amount'] / 100);
                            break;
                    }
                }

                $this->estimateCarrierFees();

                if (
                    isset($this->module_carrier['options']['free_shipping']['orders_above'])
                    && $this->module_carrier['options']['free_shipping']['orders_above'] != null
                    && $this->module_carrier['options']['free_shipping']['orders_above'] <= $this->order_total
                ) {
                    $this->shipping_rate = 0;
                }
            }
        }
    }

    private function requestShippingRates($packages, $return = false, $use_cache = true)
    {

        $amount = false;
        $front_office = false;
        if ($use_cache) {
            $cache_md5_string = UPSDotComCache::getCacheMD5String(
                $this->origin_address,
                $this->destination_address,
                $packages,
                $this->module_carrier,
                (int) $return . '-' . (int) Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_MPS')
            );

            $cache_expiration = Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_USE_CACHE');
            $amount = UPSDotComCache::getCachedRates($cache_md5_string, $cache_expiration, $this->rate_currency->id);
            $front_office = true;
        }

        if ($amount !== false) {
            $this->shipping_rate += $amount;
        } else {
            $request_option = 'Rate';

            $log_type = UPSDotComLog::$log_types[2];
            if (!$use_cache) {
                $log_type = UPSDotComLog::$log_types[3];
            }
            // pre(Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0');
            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
                $token_response = $this->getOAuthToken();
                // pre($token_response);
                if ($token_response !== null && !isset($token_response->access_token)) {
                    $this->post_response = [];
                    $this->post_response['error'] = $token_response->Response->Error;
                } else {
                    $this->buildRatesRequest($packages, 'Rate', $return, true, $front_office);

                    $url = 'https://onlinetools.ups.com/api/rating/v1/' . $request_option;
                    if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                        $url = 'https://wwwcie.ups.com/api/rating/v1/' . $request_option;
                    }

                    $this->post_response = $this->module->executeCurlRequest(
                        $url,
                        $this->request['Request'],
                        $this->request['Method'],
                        $log_type,
                        [
                            'Authorization: Bearer ' . $token_response->access_token,
                        ]
                    );

                    pre($this->post_response);
                }
            } else {
                $this->buildRatesRequest($packages, 'RatingServiceSelection', $return, true, $front_office);

                $url = 'https://onlinetools.ups.com/ups.app/xml/Rate';
                if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                    $url = 'https://wwwcie.ups.com/ups.app/xml/Rate';
                }

                $this->post_response = $this->module->executeSOAPRequestUsingCurl(
                    $url,
                    $this->request['Request'],
                    $this->request['Method'],
                    $this->request['Action'],
                    $log_type
                );
            }

            $amount = -1;
            if (is_array($this->post_response) && isset($this->post_response['error'])) {
                $this->shipping_rate = -1;
            } elseif (is_object($this->post_response)) {
                $quote = $this->retrieveAmountIncludingOptions();
                if ($quote !== false) {
                    $this->quote_currency = $quote['currency_iso'];
                    $amount = $quote['amount'];
                }

                if ($use_cache) {
                    UPSDotComCache::saveRatesInCache($cache_md5_string, $amount, $this->quote_currency);
                }

                if ($amount > 0) {
                    $this->shipping_rate += UPSDotCom::convertAmountBasedInCurrency($amount, $this->quote_currency, $this->rate_currency->id);
                } else {
                    $this->shipping_rate = -1;
                }
            } else {
                $this->post_response = new stdClass();
                $this->post_response->Response = new stdClass();
                $this->post_response->Response->ResponseStatus = new stdClass();
                $this->post_response->Response->ResponseStatus->Code = 0;
                $this->post_response->Response->ResponseStatus->Description = 'Failure';
                $this->post_response->Response->Error = new stdClass();
                $this->post_response->Response->Error->Severity = 'Hard';
                $this->post_response->Response->Error->Source = 'WebVIZO Exception';
                $this->post_response->Response->Error->Code = '0000';
                $this->post_response->Response->Error->Message = $this->module->l('Unknown error have happened, please contact us for more information');

                $this->shipping_rate = -1;
            }
        }
    }

    private function estimateCarrierFees()
    {
        $shipping_handling = Configuration::get('PS_SHIPPING_HANDLING');
        if ((int) Configuration::get('PS_CURRENCY_DEFAULT') != $this->rate_currency->id) {
            $shipping_handling = UPSDotCom::convertAmountBasedInCurrency($shipping_handling, Configuration::get('PS_CURRENCY_DEFAULT'), $this->rate_currency->id, 0);
        }

        /* Adding handling charges */
        if (isset($shipping_handling) && $this->module_carrier['shipping_handling']) {
            $this->shipping_rate += (float) $shipping_handling;
        }

        /* Additional Shipping Cost per product */
        foreach ($this->products as $product) {
            if ($this->module->ps_version == 1.4 || !$product['is_virtual']) {
                if ((int) Configuration::get('PS_CURRENCY_DEFAULT') != $this->rate_currency->id) {
                    $product['additional_shipping_cost'] = UPSDotCom::convertAmountBasedInCurrency($product['additional_shipping_cost'], Configuration::get('PS_CURRENCY_DEFAULT'), $this->rate_currency->id, 0);
                }

                $this->shipping_rate += $product['additional_shipping_cost'] * $product['cart_quantity'];
            }
        }
    }

    private function retrieveAmountIncludingOptions()
    {
        $amount = -1;
        $quote_currency = 0;

        $shipment_details = null;
        if (
            isset($this->post_response->RatedShipment)
            && is_object($this->post_response->RatedShipment)
        ) {
            $shipment_details = $this->post_response->RatedShipment;
        } elseif (
            isset($this->post_response->ShipmentResults)
            && is_object($this->post_response->ShipmentResults)
        ) {
            $shipment_details = $this->post_response->ShipmentResults;
        }

        if (
            isset($shipment_details->ShipmentCharges)
            && is_object($shipment_details->ShipmentCharges)
        ) {
            $shipment_details = $shipment_details->ShipmentCharges;
        }

        $arr_shipment_details = (array) $shipment_details;
        if (isset($arr_shipment_details[0])) {
            $shipment_details = $arr_shipment_details[0];
        }

        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_NEGOTIATED_RATE')) {
            if (
                isset($shipment_details->NegotiatedRates)
                && count((array) $shipment_details->NegotiatedRates)
            ) {
                $shipment_details = $shipment_details->NegotiatedRates;
            } elseif (
                isset($shipment_details->NegotiatedRateCharges)
                && count((array) $shipment_details->NegotiatedRateCharges)
            ) {
                $shipment_details = $shipment_details->NegotiatedRateCharges;
            } else {
                return [
                    'amount' => -1,
                    'currency_iso' => $this->rate_currency->iso_code,
                ];
            }
        }

        if (
            isset($shipment_details->TotalCharges)
            && count((array) $shipment_details->TotalCharges)
        ) {
            $shipment_details = $shipment_details->TotalCharges;
        }

        $arr_shipment_details = (array) $shipment_details;
        if (isset($arr_shipment_details[0])) {
            $shipment_details = $arr_shipment_details[0];
        }

        /* RatedShipment + Negotiated Rates */
        if (isset($shipment_details->NetSummaryCharges, $shipment_details->NetSummaryCharges->GrandTotal)) {
            $shipment_details = $shipment_details->NetSummaryCharges->GrandTotal;
        } elseif (isset($shipment_details->TotalCharge)) {
            $shipment_details = $shipment_details->TotalCharge;
        }

        $amount = (float) $shipment_details->MonetaryValue;
        $quote_currency = pSQL($shipment_details->CurrencyCode);

        $quote_currency = UPSDotComConfiguration::currencyCodeConversion($quote_currency, true);

        return [
            'amount' => $amount,
            'currency_iso' => $quote_currency,
        ];
    }
    // endregion

    // region Account validation request
    public function validateAccount($validate_shipping_rates = false)
    {
        $action = 'Rate';
        $request_option = 'Shop';

        $request = null;

        $this->origin_address = [
            'FullName' => 'Web VIZO',
            'Address1' => '1048 Madison Ave',
            'Address2' => 'Apt 2B',
            'City' => 'New York',
            'State' => 'NY',
            'ZIPCode' => '10075',
            'Country' => 'US',
        ];

        if (
            $validate_shipping_rates
            || (Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_COUNTRY')
                && Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_POSTCODE')
            )
        ) {
            $this->origin_address = [
                'FullName' => 'Web VIZO',
                'Address1' => '1048 Madison Ave',
                'Address2' => 'Apt 2B',
                'City' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_CITY'),
                'State' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_STATE'),
                'ZIPCode' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_POSTCODE'),
                'Country' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_COUNTRY'),
            ];
        }

        $this->destination_address = [
            'FullName' => 'Web VIZO',
            'Address1' => '1717 Corcoran St NW',
            'Address2' => 'Apt 6C',
            'City' => 'Washington',
            'State' => 'DC',
            'ZIPCode' => '20009',
            'Country' => 'US',
        ];

        $package = [];
        $package['type'] = UPSDotComConfiguration::getPackingType('Package');
        $package['width'] = 10;
        $package['height'] = 10;
        $package['depth'] = 10;
        $package['weight'] = 10;

        if ($this->origin_address['Country'] == 'US' || $this->origin_address['Country'] == 'PR') {
            $weight_unit_to_use = 'lb';
            $dimension_unit_to_use = 'in';
        } else {
            $weight_unit_to_use = 'kg';
            $dimension_unit_to_use = 'cm';
        }

        $this->context->smarty->assign([
            'TransactionReference' => 'Account validation',
            'legacy' => Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '1',

            'PickupCode' => '01',
            'RequestOption' => $request_option,
            'RateType' => Configuration::get(UPSDotCom::$module_prefix_upper . '_RATE_TYPE'),
            'NegotiatedRate' => Configuration::get(UPSDotCom::$module_prefix_upper . '_NEGOTIATED_RATE'),

            'AccountNumber' => Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_NUMBER'),
            'From' => $this->origin_address,
            'To' => $this->destination_address,
            'TotalWeight' => 10,
            'packages' => [$package, $package],

            'store_weight_unit' => $weight_unit_to_use,
            'store_dimension_unit' => $dimension_unit_to_use,

            'RequestType' => 'STANDARD',
        ]);

        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
            $token_response = $this->getOAuthToken(0, true);

            if ($token_response !== null && !isset($token_response->access_token)) {
                $response = [];
                $response['error'] = $token_response->Response->Error;
            } else {
                $method = 'Rate';

                $request_content = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_Rate.tplx');
                $request = $this->generateRequest($request_content, $method, $action, $request_option);
            }

            $url = 'https://onlinetools.ups.com/api/rating/v1/' . $request_option;
            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                $url = 'https://wwwcie.ups.com/api/rating/v1/' . $request_option;
            }

            $response = $this->module->executeCurlRequest(
                $url,
                $request,
                $method,
                UPSDotComLog::$log_types[1],
                [
                    'Authorization: Bearer ' . $token_response->access_token,
                ]
            );
        } else {
            $method = 'RatingServiceSelection';

            $request_content = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_Rate.tplx');
            $request = $this->generateRequest($request_content, $method, $action, $request_option);

            $url = 'https://onlinetools.ups.com/ups.app/xml/Rate';
            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                $url = 'https://wwwcie.ups.com/ups.app/xml/Rate';
            }

            $response = $this->module->executeSOAPRequestUsingCurl(
                $url,
                $request,
                $method,
                $action,
                UPSDotComLog::$log_types[1]
            );
        }

        $invalid_negotiated = false;
        if (is_array($response) && isset($response['error'])) {
            $error_message = '<b>' . $this->module->l('It was not possible to validate your shipment address because of the following error(s):') . '</b><br>';

            $web_service_sources = [
                'prof',
                'crs',
                'ship',
                'wsi',
            ];
            if (in_array(pSQL($response['error']->Source), $web_service_sources)) {
                $error_message .= '- [' . $this->module->l('UPS Web Service Response');
            } else {
                $error_message .= '- [' . $response['error']->Source;
            }

            $error_message .= '] ' . $response['error']->Severity . ' CODE: ' . $response['error']->Code . ' - ' . $response['error']->Message . '<br>';

            $this->output .= $this->module->generateAlertDiv($error_message, 'error');
        } elseif (is_object($response)) {
            $status_code = 0;
            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
                if (
                    isset($response->Response, $response->Response->ResponseStatus->Code)
                ) {
                    $status_code = pSQL($response->Response->ResponseStatus->Code);
                    if (isset($response->Response->Alert) && pSQL($response->Response->Alert->Code) === '120900') {
                        $invalid_negotiated = true;
                    } elseif (
                        Configuration::get(UPSDotCom::$module_prefix_upper . '_NEGOTIATED_RATE')
                        && isset($response->RatedShipment)
                        && count((array) $response->RatedShipment)
                    ) {
                        $rated_shipment = (array) $response->RatedShipment[0];
                        if (!isset($rated_shipment['NegotiatedRateCharges'])) {
                            $invalid_negotiated = true;
                        }
                    }
                }
            } else {
                if (isset($response->Response, $response->Response->ResponseStatus->Code)) {
                    $status_code = pSQL($response->Response->ResponseStatus->Code);
                    if (
                        Configuration::get(UPSDotCom::$module_prefix_upper . '_NEGOTIATED_RATE')
                        && isset($response->RatedShipment)
                        && count((array) $response->RatedShipment)
                    ) {
                        $rated_shipment = (array) $response->RatedShipment[0];
                        if (!isset($rated_shipment['NegotiatedRates'])) {
                            $invalid_negotiated = true;
                        }
                    }
                }
            }

            if ($invalid_negotiated) {
                $this->output .= $this->module->generateAlertDiv($this->module->l('Negotiated rates are not available for your account!'), 'error');

                return false;
            }

            // return $status_code == '1';
            // alteração paulo
            return true;
        }

        return false;
    }
    // endregion

    // region Build Requests
    private function buildRatesRequest($packages, $method = 'Rate', $return = false, $render = true, $front_office = false)
    {
        $this->context = $this->module->assignGlobalTemplateValues($this->context, $this->id_order);

        $this->request['Method'] = $method;
        $this->request['Action'] = 'Rate';

        $shipment_method = $this->shipment_method;
        if ($return) {
            $shipment_method = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_return_method');
        }

        $total_weight = 0;
        foreach ($packages as $package) {
            $total_weight += $package['weight'];
        }

        $from = $this->origin_address;
        $to = $this->destination_address;
        if ($return) {
            $from = $this->destination_address;
            $to = $this->origin_address;
        }

        // $tracking_number = null;
        // if ($return
        //     && isset($this->additional_info)
        //     && is_array($this->additional_info)
        //     && count($this->additional_info)
        // ) {
        //     $tracking_number = $this->additional_info[$this->return_label_index]['TrackingNumber'];
        //     ++$this->return_label_index;
        // }

        if ($from['Country'] == 'US' || $from['Country'] == 'PR') {
            $weight_unit_to_use = 'lb';
            $dimension_unit_to_use = 'in';
        } else {
            $weight_unit_to_use = 'kg';
            $dimension_unit_to_use = 'cm';
        }

        // TODO : CHECK RETURN OPTIONS
        // $return_options = UPSDotComConfiguration::getCustomsOptionsTypes();
        // $return_customs_option = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_return_option');
        // $return_customs_other_option = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_return_option_oth');

        // if ($return && $return_customs_option != 'OTHER') {
        //     if (isset($return_options[$return_customs_option])) {
        //         $return_customs_other_option = $return_options[$return_customs_option];
        //     } else {
        //         $return_customs_other_option = $return_customs_option;
        //     }
        //     $return_customs_option = 'OTHER';
        // }

        $access_point_dropoff_code = '01';
        $access_point_dropoff_address = 'Temporary location for rates';
        $request_type = UPSDotComConfiguration::getRequestTypeByShipmentMethod($this->is_intl, $shipment_method);
        /* Only when printing labels */
        if ($request_type === 'ACCESS_POINT' && !$front_office) {
            $access_point_dropoff_code = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_ap_dropoff');
            $access_point_dropoff_address = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_ap_address');
        }

        $this->context->smarty->assign([
            'legacy' => Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '1',
            'TransactionReference' => 'Shipping rate',

            'PickupCode' => (is_array($this->shipment_option) ? $this->shipment_option[0] : $this->shipment_option),

            'RateType' => Configuration::get(UPSDotCom::$module_prefix_upper . '_RATE_TYPE'),
            'NegotiatedRate' => Configuration::get(UPSDotCom::$module_prefix_upper . '_NEGOTIATED_RATE'),

            'AccountNumber' => Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_NUMBER'),

            'ServiceType' => $shipment_method,

            'From' => $from,
            'To' => $to,
            'packages' => $packages,
            'TotalWeight' => $total_weight,

            'RequestType' => $request_type,

            'AccessPointDropOffCode' => $access_point_dropoff_code,
            'AccessPointDropOffAddress' => $access_point_dropoff_address,
            /* RETURN OPTIONS */
            // 'tracking_number' => $tracking_number,
            // 'is_return_label' => $return,
            // 'return_customs_option' => $return_customs_option,
            // 'return_customs_other_option' => $return_customs_other_option,

            'store_weight_unit' => $weight_unit_to_use,
            'store_dimension_unit' => $dimension_unit_to_use,
        ]);

        $this->assignIntlShipmentInformation($packages);

        if (!$render) {
            return;
        }

        $request_content = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_Rate.tplx');
        $this->request['Request'] = $this->generateRequest($request_content, $this->request['Method'], $this->request['Action'], 'Rate');
    }

    private function buildShippingLabelRequest($packages, $package_number)
    {
        $this->request['Method'] = 'ShipmentConfirm';
        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
            $this->request['Method'] = 'Shipment';
        }
        $this->request['Action'] = 'ShipConfirm';

        $label_stock_type = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_labellayout');
        if ($label_stock_type != '0') {
            $label_stock_type = explode('x', $label_stock_type);
        }

        $id_order = Tools::getValue('id_order');
        $order = new Order($id_order);

        $image_type = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_labelformat');
        if ($image_type === 'PDF') {
            $image_type = 'GIF';
        }

        $this->context->smarty->assign([
            'order_reference' => $order->reference,
            'IncludeLabel' => true,
            /* ADDITIONAL RATES */
            'LabelStockType' => $label_stock_type,
            'ImageType' => $image_type,
            'package_number' => $package_number,
        ]);

        $this->assignIntlShipmentInformation($packages);

        $request_content = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_Rate.tplx');
        $this->request['Request'] = $this->generateRequest($request_content, $this->request['Method'], $this->request['Action'], 'validate');
    }

    private function buildAcceptRequest($shipment_digest)
    {
        $this->request['Method'] = 'ShipmentAccept';
        $this->request['Action'] = 'ShipAccept';

        $this->context->smarty->assign(
            [
                'shipment_digest' => $shipment_digest,
                /* TODO : CHECK THIS PROPERTY */
                'transaction_reference' => '',
            ]
        );

        $request_content = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_Accept.tplx');
        $this->request['Request'] = $this->generateRequest($request_content, $this->request['Method'], $this->request['Action'], 'validate');
    }
    // endregion

    // region Shipping label
    public function generateShippingLabel($return = false)
    {
        $id_order = Tools::getValue('id_order');
        $order = new Order((int) $id_order);
        if (!Validate::isLoadedObject($order)) {
            Tools::displayError($this->module->l('Could not load order ID: ') . $id_order);
        }

        $this->tracking_numbers = [];

        if (!$return) {
            $this->additional_info = [];

            $this->response = [];
            $this->response['error'] = $this->validateRequiredInfo();
            $this->response['success'] = [];
        }

        $packages_for_shipment = $this->preparePackagesForRates($this->packages_for_shipment, true, $return);

        $this->request = [];
        if (is_array($this->response['error']) && !count($this->response['error'])) {
            // if ($return) {
            //     $this->resetMasterTracking();
            // }

            $sequence = 1;
            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_MPS') && !$return) {
                $this->buildRatesRequest($packages_for_shipment, $return, false);
                $this->buildShippingLabelRequest($packages_for_shipment, $sequence);

                $this->execGenerateLabelRequest($return);
            } else {
                foreach ($packages_for_shipment as $package) {
                    $this->buildRatesRequest([$package], $return, false);
                    $this->buildShippingLabelRequest([$package], $sequence);

                    $this->execGenerateLabelRequest($return);
                }
            }
        }

        if (is_array($this->response['error']) && !count($this->response['error'])) {
            $query = '
                SELECT `id_' . pSQL(UPSDotCom::$module_prefix) . '_order_information`
                FROM `' . _DB_PREFIX_ . pSQL(UPSDotCom::$module_prefix) . '_order_information`
                WHERE `id_order` = ' . (int) $id_order;
            $additional_info_exists = (bool) Db::getInstance()->getValue($query);

            if ($additional_info_exists) {
                $query = '
                    UPDATE `' . _DB_PREFIX_ . pSQL(UPSDotCom::$module_prefix) . '_order_information`
                    SET    `additional_information` = "' . pSQL(UPSDotComCarrierModule::encodeString(UPSDotComCarrierModule::safeSerialization($this->additional_info))) . '",
                    `is_voided` = 0,
                    `is_sample` = ' . (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test' ? 1 : 0) . '
                    WHERE `id_order` = ' . (int) $id_order;
                Db::getInstance()->execute($query);
            } else {
                $query = '
                    INSERT INTO  `' . _DB_PREFIX_ . pSQL(UPSDotCom::$module_prefix) . '_order_information` (
                        `id_order` ,
                        `additional_information` ,
                        `is_voided` ,
                        `is_sample`
                    )
                    VALUES (
                        ' . (int) $id_order . ',
                        "' . pSQL(UPSDotComCarrierModule::encodeString(UPSDotComCarrierModule::safeSerialization($this->additional_info))) . '",
                        0,
                        ' . (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test' ? 1 : 0) . '
                    );
                ';
                Db::getInstance()->execute($query);
            }

            $tracking_numbers = '';
            if (is_array($this->tracking_numbers)) {
                $tracking_numbers = implode('%0D%0A', $this->tracking_numbers);

                if ($this->module->ps_version < 8.0) {
                    $order->shipping_number = $tracking_numbers;
                    $order->update();
                }

                $query = '
                SELECT `id_order_carrier`
                FROM `' . _DB_PREFIX_ . 'order_carrier`
                WHERE `id_order` = ' . (int) $order->id;
                $id_order_carrier = Db::getInstance()->getValue($query);

                if ($id_order_carrier) {
                    $order_carrier = new OrderCarrier($id_order_carrier);
                    $order_carrier->tracking_number = $tracking_numbers;
                    $order_carrier->update();
                }
            }

            $new_order_status = (int) $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_orderstatus');
            if ($new_order_status > 0) {
                $history = new OrderHistory();

                if ($this->module->ps_version == 1.4) {
                    $order->current_state = $order->getCurrentState();
                }

                if ($order->current_state != $new_order_status) {
                    $history->id_order = (int) $id_order;
                    $history->changeIdOrderState($new_order_status, $order);
                    $history->add();

                    $order = new Order($id_order);
                }
            }

            if ($this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_trackinginfo')) {
                $customer = new Customer($order->id_customer);
                $carrier = new Carrier($order->id_carrier);
                if (!Validate::isLoadedObject($customer) || !Validate::isLoadedObject($carrier)) {
                    exit(Tools::displayError());
                }

                $tracking_url = 'https://www.ups.com/track?InquiryNumber=@';
                if (Tools::strlen($carrier->url)) {
                    $tracking_url = $carrier->url;
                }

                $followup = str_replace('@', $tracking_numbers, $tracking_url);

                $link = new Link();
                $products = $order->getProducts();

                $meta_products = '';
                if (is_array($products) && count($products)) {
                    foreach ($products as $product) {
                        $prod_obj = new Product((int) $product['product_id']);

                        $combination_img = null;
                        $product_imgs = $prod_obj->getCombinationImages($order->id_lang);
                        if (is_array($product_imgs) && count($product_imgs)) {
                            $product_attribute_imgs = $product_imgs[$product['product_attribute_id']];
                            if (is_array($product_attribute_imgs) && count($product_attribute_imgs)) {
                                $combination_img = $product_attribute_imgs[0]['id_image'];
                            }
                        }

                        if ($combination_img != null) {
                            $img_url = $link->getImageLink($prod_obj->link_rewrite[$order->id_lang], $combination_img, 'large_default');
                        } else {
                            $img = $prod_obj->getCover($prod_obj->id);
                            $img_url = $link->getImageLink($prod_obj->link_rewrite[$order->id_lang], $img['id_image']);
                        }
                        $prod_url = $prod_obj->getLink();

                        $meta_products .= "\n" . '<div itemprop="itemShipped" itemscope itemtype="http://schema.org/Product">';
                        $meta_products .= "\n" . '   <meta itemprop="name" content="' . htmlspecialchars($product['product_name']) . '"/>';
                        $meta_products .= "\n" . '   <link itemprop="image" href="' . $img_url . '"/>';
                        $meta_products .= "\n" . '   <link itemprop="url" href="' . $prod_url . '"/>';
                        $meta_products .= "\n" . '</div>';
                    }
                }

                $template_vars = [
                    '{followup}' => $followup,
                    '{firstname}' => $customer->firstname,
                    '{lastname}' => $customer->lastname,
                    '{id_order}' => $order->id,
                    '{meta_products}' => $meta_products,
                ];

                if ($this->module->ps_version > 1.4) {
                    $template_vars['{order_name}'] = $order->getUniqReference();
                }

                if (!$this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_trackinginfoemail')) {
                    $template = 'in_transit';
                } else {
                    $template = $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_trackinginfoemail');
                }

                Mail::Send(
                    (int) $order->id_lang,
                    $template,
                    $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_emailsubject'),
                    $template_vars,
                    $customer->email,
                    $customer->firstname . ' ' . $customer->lastname,
                    null,
                    null,
                    null,
                    null,
                    _PS_MAIL_DIR_,
                    true,
                    (int) $order->id_shop
                );
            }
        }
    }

    public function execGenerateLabelRequest($return = false)
    {
        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
            $token_response = $this->getOAuthToken();
            if ($token_response !== null && !isset($token_response->access_token)) {
                $this->post_response = [];
                $this->post_response['error'] = $token_response->Response->Error;
            } else {
                $url = 'https://onlinetools.ups.com/api/shipments/v1/ship';
                if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                    $url = 'https://wwwcie.ups.com/api/shipments/v1/ship';
                }

                $this->post_response = $this->module->executeCurlRequest(
                    $url,
                    $this->request['Request'],
                    $this->request['Method'],
                    UPSDotComLog::$log_types[4],
                    [
                        'Authorization: Bearer ' . $token_response->access_token,
                    ]
                );
            }
        } else {
            $url = 'https://onlinetools.ups.com/ups.app/xml/ShipConfirm';
            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                $url = 'https://wwwcie.ups.com/ups.app/xml/ShipConfirm';
            }

            $this->post_response = $this->module->executeSOAPRequestUsingCurl(
                $url,
                $this->request['Request'],
                $this->request['Method'],
                $this->request['Action'],
                UPSDotComLog::$log_types[4]
            );
        }

        if (is_array($this->post_response) && isset($this->post_response['error'])) {
            if (is_object($this->post_response['error'])) {
                $help_context = $this->post_response['error']->Source;
                $description = '['
                    . $this->post_response['error']->Severity
                    . ' #' . $this->post_response['error']->Code
                    . '] ' . $this->post_response['error']->Message;

                $this->response['error'][] = [
                    'Description' => $description,
                    'HelpContext' => $help_context,
                ];
            } else {
                $response = explode(' in ' . dirname(__FILE__), $this->post_response);
                $response = str_replace('Error: SoapFault exception: [soap:Server] ', '', $response[0]);

                $this->response['error'][] = [
                    'Description' => $response,
                    'HelpContext' => 'UPS Web Service Response',
                ];
            }
        }

        if (isset($this->post_response->ShipmentResponse)) {
            $this->post_response = $this->post_response->ShipmentResponse;
        }

        // Legacy
        if (isset($this->post_response->ShipmentDigest)) {
            if (isset($this->post_response->ShipmentDigest, $this->post_response->ShipmentIdentificationNumber)) {
                $this->buildAcceptRequest($this->post_response->ShipmentDigest);

                $url = 'https://onlinetools.ups.com/ups.app/xml/ShipAccept';
                if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                    $url = 'https://wwwcie.ups.com/ups.app/xml/ShipAccept';
                }

                $this->post_response = $this->module->executeSOAPRequestUsingCurl(
                    $url,
                    $this->request['Request'],
                    $this->request['Method'],
                    $this->request['Action'],
                    UPSDotComLog::$log_types[6]
                );

                if (is_array($this->post_response) && isset($this->post_response['error'])) {
                    if (is_object($this->post_response['error'])) {
                        $help_context = $this->post_response['error']->Source;
                        $description = '['
                            . $this->post_response['error']->Severity
                            . ' #' . $this->post_response['error']->Code
                            . '] ' . $this->post_response['error']->Message;

                        $this->response['error'][] = [
                            'Description' => $description,
                            'HelpContext' => $help_context,
                        ];
                    } else {
                        $response = explode(' in ' . dirname(__FILE__), $this->post_response);
                        $response = str_replace('Error: SoapFault exception: [soap:Server] ', '', $response[0]);

                        $this->response['error'][] = [
                            'Description' => $response,
                            'HelpContext' => 'UPS Web Service Response',
                        ];
                    }
                }
            }
        }

        /** CONVERTS TO USE $this->response ARRAY */
        if (is_array($this->response['error']) && !count($this->response['error'])) {
            if (
                isset($this->post_response->ShipmentResults->ShipmentIdentificationNumber, $this->post_response->ShipmentResults->PackageResults)
            ) {
                $package_results = $this->post_response->ShipmentResults->PackageResults;
                if (!is_array($package_results)) {
                    $package_results = [$this->post_response->ShipmentResults->PackageResults];
                }

                foreach ($package_results as $package_result) {
                    if (isset($package_result->TrackingNumber)) {
                        $shipment_information = [
                            'ShipmentIdentificationNumber' => pSQL($this->post_response->ShipmentResults->ShipmentIdentificationNumber),
                            'TrackingNumber' => pSQL($package_result->TrackingNumber),
                            'Postage' => (float) $this->retrieveAmountIncludingOptions(),
                            'labelFormat' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_labelformat'),
                            'label_type' => ($return ? 'return' : 'standard'),
                        ];

                        $this->additional_info[] = $shipment_information;
                        $this->tracking_numbers[] = pSQL($package_result->TrackingNumber);
                    }

                    // Legacy
                    $documents = null;
                    $image_data = null;
                    if (isset($package_result->LabelImage) && isset($package_result->LabelImage->GraphicImage)) {
                        // if (isset($this->post_response->CompletedShipmentDetail->CompletedPackageDetails->PackageDocuments->Parts->Image)) {
                        //     $documents = $this->post_response->CompletedShipmentDetail->CompletedPackageDetails->PackageDocuments->Parts->Image;
                        // }
                        $image_data = pSQL($package_result->LabelImage->GraphicImage);
                    } elseif (isset($package_result->ShippingLabel) && isset($package_result->ShippingLabel->GraphicImage)) {
                        $image_data = pSQL($package_result->ShippingLabel->GraphicImage);
                    }

                    if ($this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_labelformat') === 'PDF') {
                        $pdf_doc = UPSDotComImageManager::convertGIFToPDF($image_data);
                        if ($pdf_doc !== false) {
                            $image_data = $pdf_doc;
                        } else {
                            $shipment_information['labelFormat'] = 'GIF';
                        }
                    }

                    $shipment_information['ImageData'] = $image_data;
                    $shipment_information['Documents'] = $documents;

                    $this->response['success'][] = $shipment_information;
                }

            // if (Configuration::get(UPSDotCom::$module_prefix_upper . '_SETTINGS_MPS')) {
            //     if ($this->master_tracking == null) {
            //         $this->master_tracking = pSQL($this->post_response->CompletedShipmentDetail->MasterTrackingId->TrackingNumber);
            //         $this->master_tracking_type = pSQL($this->post_response->CompletedShipmentDetail->MasterTrackingId->TrackingIdType);
            //         $this->master_tracking_form = pSQL($this->post_response->CompletedShipmentDetail->MasterTrackingId->FormId);
            //     }
            // }
            /* CREATE THE ERROR MESSAGE BECAUSE THE IMAGE WAS NOT AVAILABLE (JUST IN CASE) */
            } else {
                if (Tools::strlen($this->post_response) !== false) {
                    $this->post_response = explode(' in ' . dirname(__FILE__), $this->post_response);
                    $this->post_response = str_replace('Error: SoapFault exception: [soap:Server] ', '', $this->post_response[0]);
                }

                $this->response['error'][] = [
                    'Description' => $this->post_response,
                    'HelpContext' => 'UPS Web Service Response',
                ];
            }
        } else {
            if (is_array($this->additional_info) && count($this->additional_info)) {
                $this->voidShippingLabel(0);
            }
        }
    }

    public function voidShippingLabel($id_order = 0)
    {
        $order = new Order((int) $id_order);
        if (!Validate::isLoadedObject($order)) {
            Tools::displayError($this->module->l('Could not load order ID: ') . $id_order);
        }

        $this->request = [];

        /** $id_order = 0 means that the packages are being voided due to problems in the generation of all packages */
        if ($id_order) {
            $query = '
                SELECT `additional_information`
                FROM `' . _DB_PREFIX_ . pSQL(UPSDotCom::$module_prefix) . '_order_information`
                WHERE `id_order` = ' . (int) $id_order;
            $this->additional_info = Db::getInstance()->getValue($query);

            $this->additional_info = UPSDotComCarrierModule::safeDeserialization(UPSDotComCarrierModule::decodeString($this->additional_info));
            $this->tracking_numbers = [];

            $this->response = [];
            $this->response['error'] = [];
            $this->response['success'] = [];
        }

        $query = '
            SELECT `is_sample`
            FROM `' . _DB_PREFIX_ . pSQL(UPSDotCom::$module_prefix) . '_order_information`
            WHERE `id_order` = ' . (int) $id_order;
        $is_sample = Db::getInstance()->getValue($query);

        if (is_array($this->additional_info) && count($this->additional_info)) {
            foreach ($this->additional_info as $key => $information) {
                if (!$is_sample) {
                    $this->request['Method'] = 'VoidShipment';
                    $this->request['Action'] = 'Void';

                    if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
                        $token_response = $this->getOAuthToken();
                        if ($token_response !== null && !isset($token_response->access_token)) {
                            $this->post_response = [];
                            $this->post_response['error'] = $token_response->Response->Error;
                        } else {
                            $url = 'https://onlinetools.ups.com/api/shipments/v1/void/cancel';
                            if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                                $url = 'https://wwwcie.ups.com/api/shipments/v1/void/cancel';
                            }

                            $url .= '/' . $information['ShipmentIdentificationNumber'];

                            $this->post_response = $this->module->executeCurlRequest(
                                $url,
                                null,
                                $this->request['Method'],
                                UPSDotComLog::$log_types[5],
                                [
                                    'Authorization: Bearer ' . $token_response->access_token,
                                ],
                                'DELETE'
                            );
                        }
                    } else {
                        $this->context->smarty->assign([
                            'TransactionReference' => 'Void shipment',
                            'shipment_id' => $information['ShipmentIdentificationNumber'],
                        ]);

                        $request_content = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_VoidShipment.tplx');
                        $this->request['Request'] = $this->generateRequest($request_content, $this->request['Method'], $this->request['Action']);

                        $url = 'https://onlinetools.ups.com/ups.app/xml/Void';
                        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
                            $url = 'https://wwwcie.ups.com/ups.app/xml/Void';
                        }

                        $this->post_response = $this->module->executeSOAPRequestUsingCurl(
                            $url,
                            $this->request['Request'],
                            $this->request['Method'],
                            $this->request['Action'],
                            UPSDotComLog::$log_types[5]
                        );
                    }

                    if (is_array($this->post_response) && isset($this->post_response['error'])) {
                        if (is_object($this->post_response['error'])) {
                            /* has already been voided */
                            if ($this->post_response['error']->Code == 190117) {
                                $this->response['success'][] = $information['label_type'];
                                unset($this->additional_info[$key]);
                            } else {
                                $this->tracking_numbers[] = $information['TrackingNumber'];
                                $help_context = $this->post_response['error']->Source;
                                $description = '['
                                    . $this->post_response['error']->Severity
                                    . ' #' . $this->post_response['error']->Code
                                    . '] ' . $this->post_response['error']->Message;

                                $this->response['error'][] = [
                                    'Description' => $description,
                                    'HelpContext' => $help_context,
                                ];
                            }
                        } else {
                            $response = explode(' in ' . dirname(__FILE__), $this->post_response);
                            $response = str_replace('Error: SoapFault exception: [soap:Server] ', '', $response[0]);

                            $this->response['error'][] = [
                                'Description' => $response,
                                'HelpContext' => 'UPS Web Service Response',
                            ];
                        }
                    } elseif ($id_order) {
                        $this->response['success'][] = $information['label_type'];
                        unset($this->additional_info[$key]);
                    }
                } elseif ($id_order) {
                    $this->additional_info = [];
                    $this->response['success'][] = true;
                }
            }

            if ($id_order) {
                $additional_information = 'null';
                if (count($this->additional_info)) {
                    $additional_information = UPSDotComCarrierModule::encodeString(UPSDotComCarrierModule::safeSerialization($this->additional_info));
                }

                $query = '
                    UPDATE `' . _DB_PREFIX_ . pSQL(UPSDotCom::$module_prefix) . '_order_information`
                    SET
                    `additional_information` = "' . pSQL($additional_information) . '",
                    `is_voided` = ' . (count($this->additional_info) ? 0 : 1) . '
                    WHERE `id_order` = ' . (int) $id_order;
                Db::getInstance()->execute($query);

                $tracking_numbers = '';
                if (is_array($this->tracking_numbers)) {
                    $tracking_numbers = implode('%0D%0A', $this->tracking_numbers);
                }

                if ($this->module->ps_version < 8.0) {
                    $order->shipping_number = $tracking_numbers;
                    $order->update();
                }

                $query = '
                    SELECT `id_order_carrier`
                    FROM `' . _DB_PREFIX_ . 'order_carrier`
                    WHERE `id_order` = ' . (int) $id_order;
                $id_order_carrier = Db::getInstance()->getValue($query);

                if ($id_order_carrier) {
                    $order_carrier = new OrderCarrier($id_order_carrier);
                    $order_carrier->tracking_number = $tracking_numbers;
                    $order_carrier->update();
                }
            }
        } else {
            $this->response['error'][] = [
                'Description' => $this->module->l('Required information to void the shipment is not available for this order'),
                'HelpContext' => 0,
            ];
        }

        return $this->response;
    }

    /*
     * Validate label settings, and package information
     *
     * @return array(
     *   [] => array(
     *        'Description' => Error description,
     *        'HelpContext' => 0 (when Help Context returns 0, it is not an UPS default error. In this case "[#{CODE}] {Error description}" does not appear )
     *   ),
     * );
     */
    private function validateRequiredInfo()
    {
        $return = [];

        /* VALIDATE LABEL SETTINGS */

        /* Verify Shipping Type, if there is something selected */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_shipmentmethod'))) {
            $error_description = $this->module->l('Shipment method is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify Image Type, if there is something selected */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_labelformat'))) {
            $error_description = $this->module->l('Label Format is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_labellayout'))) {
            $error_description = $this->module->l('Label Layout is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* VALIDATE REQUIRED CUSTOMER INFOS */

        $recipient_email = $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_email');
        /* Verify E-mail, if there is something wrote and if is a valid format */
        if (!Tools::strlen($recipient_email)) {
            $error_description = $this->module->l('Customer E-mail is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        } elseif (!preg_match('/([\w\-\.]+)@(([\w-]+\.)+)[a-zA-Z]{2,4}$/', $recipient_email)) {
            $error_description = $this->module->l('Customer E-mail format is incorrect, please verify. (Ex: email@domin.domin_extension)');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify E-mail, if there is something wrote and if is a valid format */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_email'))) {
            $error_description = $this->module->l('Sender E-mail is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        } elseif (!preg_match('/([\w\-\.]+)@(([\w-]+\.)+)[a-zA-Z]{2,4}$/', $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_email'))) {
            $error_description = $this->module->l('Sender E-mail format is incorrect, please verify. (Ex: email@domin.domin_extension)');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify Name, if there is something wrote */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_name'))) {
            $error_description = $this->module->l('Customer Name is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify Address, if there is something wrote */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_address1'))) {
            $error_description = $this->module->l('Customer Address Line 1 is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify Country, if there is something selected */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_country'))) {
            $error_description = $this->module->l('Customer Country is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }
        /* VALIDATE SENDER INFORMATION */

        /* Verify Name, if there is something wrote */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_name'))) {
            $error_description = $this->module->l('Your Name is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify Address, if there is something wrote */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_address1'))) {
            $error_description = $this->module->l('Your Address Line 1 is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        /* Verify Country, if there is something selected */
        if (!Tools::strlen($this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_country'))) {
            $error_description = $this->module->l('Your Country is a required field.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        if (is_array($this->packages_for_shipment) && count($this->packages_for_shipment)) {
            /* VALIDATE PACKAGES */
            foreach ($this->packages_for_shipment as $key => $package) {
                ++$key;

                /* Verify Package Width, if there is something wrote, format and if greater than 0 */
                if (!Tools::strlen($package['width'])) {
                    $error_description = $this->module->l('Field Width of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('is required.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif (!is_numeric($package['width'])) {
                    $error_description = $this->module->l('Width of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be numeric, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif ($package['width'] <= 0) {
                    $error_description = $this->module->l('Width of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be greater than 0, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                }

                /* Verify Package Height, if there is something wrote, format and if greater than 0 */
                if (!Tools::strlen($package['height'])) {
                    $error_description = $this->module->l('Field Height of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('is required.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif (!is_numeric($package['height'])) {
                    $error_description = $this->module->l('Height of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be numeric, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif ($package['height'] <= 0) {
                    $error_description = $this->module->l('Height of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be greater than 0, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                }

                /* Verify Package Lenght, if there is something wrote, format and if greater than 0 */
                if (!Tools::strlen($package['depth'])) {
                    $error_description = $this->module->l('Field Lenght of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('is required.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif (!is_numeric($package['depth'])) {
                    $error_description = $this->module->l('Lenght of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be numeric, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif ($package['depth'] <= 0) {
                    $error_description = $this->module->l('Lenght of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be greater than 0, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                }

                /* Verify Package Weight, if there is something wrote, format and if greater than 0 */
                if (!Tools::strlen($package['weight'])) {
                    $error_description = $this->module->l('Field Weight of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('is required.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif (!is_numeric($package['weight'])) {
                    $error_description = $this->module->l('Wight of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be numeric, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif ($package['weight'] <= 0) {
                    $error_description = $this->module->l('Weight of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be greater than 0, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                }

                /* Verify Package Insured Value, if there is something wrote, format and if greater than 0 */
                if ($package['Insurance'] < 0) {
                    $error_description = $this->module->l('Insured Value of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be greater than 0, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                } elseif (Tools::strlen($package['Insurance']) && !is_numeric($package['Insurance'])) {
                    $error_description = $this->module->l('Insured Value of the package')
                        . ' ' . $key . ' ' .
                        $this->module->l('need to be numeric, please verify.');

                    $return[] = [
                        'Description' => $error_description,
                        'HelpContext' => 0,
                    ];
                }

                /* CUSTOMS CLEARANCE VERIFICATION */
                if ($this->module->getTplVar(UPSDotCom::$module_prefix . '_is_intl')) {
                    $products_not_in_box = 0;
                    foreach ($package['Products'] as $key_prod => $product_info) {
                        ++$key_prod;

                        if (Tools::strlen($product_info['Description']) && $product_info['Quantity'] <= 0) {
                            $error_description = $this->module->l('Quantity of the product')
                                . ' ' . $key_prod . ' ' .
                                $this->module->l('of the package')
                                . ' ' . $key . ' ' .
                                $this->module->l('need to be greater than 0, please verify.');

                            $return[] = [
                                'Description' => $error_description,
                                'HelpContext' => 0,
                            ];
                        }

                        if (Tools::strlen($product_info['Description']) && $product_info['UnitValue'] <= 0) {
                            $error_description = $this->module->l('Unit Value of the product')
                                . ' ' . $key_prod . ' ' .
                                $this->module->l('of the package')
                                . ' ' . $key . ' ' .
                                $this->module->l('need to be greater than 0, please verify.');

                            $return[] = [
                                'Description' => $error_description,
                                'HelpContext' => 0,
                            ];
                        }

                        if (Tools::strlen($product_info['Description']) && $product_info['UnitWeight'] <= 0) {
                            $error_description = $this->module->l('Unit Weight of the product')
                                . ' ' . $key_prod . ' ' .
                                $this->module->l('of the package')
                                . ' ' . $key . ' ' .
                                $this->module->l('need to be greater than 0, please verify.');

                            $return[] = [
                                'Description' => $error_description,
                                'HelpContext' => 0,
                            ];
                        }

                        if (!Tools::strlen($product_info['Description'])) {
                            ++$products_not_in_box;
                        }
                    }

                    if ($products_not_in_box == count($package['Products'])) {
                        $error_description = $this->module->l('You must insert the products information of the package') . ' ' . $key . '.';

                        $return[] = [
                            'Description' => $error_description,
                            'HelpContext' => 0,
                        ];
                    }
                }
            }
        } else {
            $error_description = $this->module->l('You must create at least one box.');

            $return[] = [
                'Description' => $error_description,
                'HelpContext' => 0,
            ];
        }

        return $return;
    }
    // endregion

    // region Utils
    private function preparePackagesForRates($packages, $use_additional_weight = true, $return = false)
    {
        foreach ($packages as &$package) {
            $package['type'] = UPSDotComConfiguration::getPackingType($package['type']);
            if ($use_additional_weight && $package['additional_weight'] != 0) {
                $package['weight'] += $package['additional_weight'];
            }

            /* IF INSURANCE IS NOT SET IN PACKAGE, CALCULATE IT (FRONT-OFFICE IN ACTION) */
            if (!isset($package['Insurance'])) {
                $package['Insurance'] = 0;

                if ($package['products_price'] > 0) {
                    if ($this->order_total >= $this->module_carrier['options']['insurance']['orders_above'] && $this->module_carrier['options']['insurance']['amount'] > 0) {
                        $package['Insurance'] = $package['products_price'] * ($this->module_carrier['options']['insurance']['amount'] / 100);
                    }
                }
            }

            if ((int) Configuration::get('PS_CURRENCY_DEFAULT') != $this->rate_currency->id) {
                if (isset($package['Insurance']) && $package['Insurance'] > 0) {
                    $package['Insurance'] = UPSDotCom::convertAmountBasedInCurrency($package['Insurance'], $this->rate_currency->id, Configuration::get('PS_CURRENCY_DEFAULT'), 0);
                }
            }

            /* IF US DOMESTIC SHIPMENTS */
            if ($this->origin_address['Country'] == 'US' || $this->origin_address['Country'] == 'PR') {
                if (UPSDotComConfiguration::convertDimensionsToCm()) {
                    $package['width'] = UPSDotComConfiguration::cmToIn($package['width']);
                    $package['height'] = UPSDotComConfiguration::cmToIn($package['height']);
                    $package['depth'] = UPSDotComConfiguration::cmToIn($package['depth']);
                }

                if (!UPSDotComConfiguration::convertDimensionsToKg() && UPSDotComConfiguration::convertDimensionsToG()) {
                    $package['weight'] /= 1000;
                    $package['weight'] = UPSDotComConfiguration::kgToLb($package['weight']);
                    if (isset($package['ProductsIn']) && $package['ProductsIn'] > 0) {
                        foreach ($package['Products'] as &$product) {
                            $product['UnitWeight'] /= 1000;
                            $product['UnitWeight'] = UPSDotComConfiguration::kgToLb($product['UnitWeight']);
                        }
                    }
                } elseif (UPSDotComConfiguration::convertDimensionsToKg() && !UPSDotComConfiguration::convertDimensionsToG()) {
                    $package['weight'] = UPSDotComConfiguration::kgToLb($package['weight']);
                    if (isset($package['ProductsIn']) && $package['ProductsIn'] > 0) {
                        foreach ($package['Products'] as &$product) {
                            $product['UnitWeight'] = UPSDotComConfiguration::kgToLb($product['UnitWeight']);
                        }
                    }
                }
            } else {
                if (!UPSDotComConfiguration::convertDimensionsToCm()) {
                    $package['width'] = UPSDotComConfiguration::inToCm($package['width']);
                    $package['height'] = UPSDotComConfiguration::inToCm($package['height']);
                    $package['depth'] = UPSDotComConfiguration::inToCm($package['depth']);
                }

                if (!UPSDotComConfiguration::convertDimensionsToKg() && !UPSDotComConfiguration::convertDimensionsToG()) {
                    $package['weight'] = UPSDotComConfiguration::lbToKg($package['weight']);
                    if (isset($package['ProductsIn']) && $package['ProductsIn'] > 0) {
                        foreach ($package['Products'] as &$product) {
                            $product['UnitWeight'] = UPSDotComConfiguration::lbToKg($product['UnitWeight']);
                        }
                    }
                } elseif (!UPSDotComConfiguration::convertDimensionsToKg() && UPSDotComConfiguration::convertDimensionsToG()) {
                    $package['weight'] /= 1000;
                    if (isset($package['ProductsIn']) && $package['ProductsIn'] > 0) {
                        foreach ($package['Products'] as &$product) {
                            $product['UnitWeight'] /= 1000;
                        }
                    }
                }
            }

            $package['actual_weight'] = $package['weight'];

            /* DIMENSIONAL WEIGHT CALCULATION */
            if (
                UPSDotComConfiguration::getPackingType($package['type']) == '02'
                && ($this->origin_address['Country'] == 'US'
                    || $this->origin_address['Country'] == 'PR')
                && !$this->is_intl
            ) {
                $package_volume = UPSDotComBoxing::getVolume($package);
                $dimensional_weight = ($package_volume / 139);

                if ($dimensional_weight > $package['actual_weight']) {
                    $package['weight'] = round($dimensional_weight, 3);
                }
            }

            $package = UPSDotComBoxing::validatePackageProperties($package);
        }

        return $packages;
    }

    public function getShippingAddresses($load_from_tpl = false)
    {
        if ($load_from_tpl) {
            $this->origin_address = [
                'FullName' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_name'),
                'Company' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_company'),
                'Address1' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_address1'),
                'Address2' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_address2'),
                'City' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_city'),
                'State' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_state'),
                'ZIPCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_postcode'),
                'ZipCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_postcode'),
                'CountryCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_country'),
                'Country' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_country'),
                'PhoneNumber' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_phone'),
                'EMailAddress' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_shipper_email'),
            ];

            $this->destination_address = [
                'FullName' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_name'),
                'Company' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_company'),
                'Address1' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_address1'),
                'Address2' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_address2'),
                'City' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_city'),
                'State' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_state'),
                'ZIPCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_postcode'),
                'ZipCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_postcode'),
                'CountryCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_country'),
                'Country' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_country'),
                'PhoneNumber' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_phone'),
                'EMailAddress' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_recipient_email'),
            ];

            $this->alternative_address = [
                'FullName' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altname'),
                'Company' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altcompany'),
                'Address1' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altaddress1'),
                'Address2' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altaddress2'),
                'City' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altcity'),
                'State' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altstate'),
                'ZIPCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altpostcode'),
                'ZipCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altpostcode'),
                'CountryCode' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altcountry'),
                'Country' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altcountry'),
                'PhoneNumber' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_altphone'),
                'EMailAddress' => '',
            ];
        } else {
            $this->origin_address = [
                'FullName' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_NAME'),
                'Company' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_COMPANY'),
                'Address1' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_ADDRESS1'),
                'Address2' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_ADDRESS2'),
                'City' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_CITY'),
                'State' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_STATE'),
                'CountryCode' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_COUNTRY'),
                'Country' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_COUNTRY'),
                'ZipCode' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_POSTCODE'),
                'ZIPCode' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_POSTCODE'),
                'PhoneNumber' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_PHONE'),
                'EMailAddress' => Configuration::get(UPSDotCom::$module_prefix_upper . '_SHIPPER_EMAIL'),
            ];

            if (Validate::isLoadedObject($this->cart)) {
                $destination_address = new Address(isset($this->cart->id_address_delivery) ? $this->cart->id_address_delivery : 0);
                if (!Validate::isLoadedObject($destination_address)) {
                    return false;
                }

                $customer_email = '';
                $customer = new Customer($destination_address->id_customer);
                if (Validate::isLoadedObject($customer)) {
                    $customer_email = $customer->email;
                }

                $destination_state = new State((int) $destination_address->id_state);
                $destination_phone = $destination_address->phone;
                if (!$destination_phone || Tools::strlen($destination_phone) < 3) {
                    $destination_phone = $destination_address->phone_mobile;
                }

                $this->destination_address = [
                    'FullName' => $destination_address->firstname . ' ' . $destination_address->lastname,
                    'Company' => $destination_address->company,
                    'Address1' => $destination_address->address1,
                    'Address2' => $destination_address->address2,
                    'City' => $destination_address->city,
                    'State' => $destination_state->iso_code,
                    'CountryCode' => Country::getIsoById($destination_address->id_country ? $destination_address->id_country : 0),
                    'Country' => Country::getIsoById($destination_address->id_country ? $destination_address->id_country : 0),
                    'ZipCode' => $destination_address->postcode,
                    'ZIPCode' => $destination_address->postcode,
                    'PhoneNumber' => $destination_phone,
                    'EMailAddress' => (isset($this->destination_address['EMailAddress']) ? $this->destination_address['EMailAddress'] : $customer_email),
                ];
            }
        }

        $this->is_intl = (
            $this->destination_address['CountryCode'] != $this->origin_address['CountryCode']
            || in_array($this->origin_address['CountryCode'], UPSDotComConfiguration::$international_customs_clearance)
        );
        $this->customs_clearance = (in_array($this->origin_address['CountryCode'], UPSDotComConfiguration::$regional_customs_clearance) && !$this->is_intl);

        return true;
    }
    // endregion

    private function generateRequest($request_content, $method, $action, $option = 'Shop')
    {
        $request_header = $this->generateRequestHeader($action, $option);
        $request_access = $this->generateAccessRequest();

        $this->context->smarty->assign(
            [
                'AccountNumber' => Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_NUMBER'),

                'method' => $method . 'Request',
                'RequestHeader' => $request_header,
                'RequestContent' => $request_content,
            ]
        );

        $request_body = $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/RequestBody.tplx');
        $request = $request_access . trim($request_body);
        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') !== '0') {
            $request = UPSDotComCarrierModule::jsonFromXML($request);
        }

        return $request;
    }

    private function generateRequestHeader($action, $option)
    {
        $this->context->smarty->assign(
            [
                'RequestAction' => $action,
                /* use Shop for all rates in one request and Rate when specify rate is required */
                'RequestOption' => $option,
            ]
        );

        return $this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/_Header.tplx');
    }

    private function generateAccessRequest()
    {
        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_OAUTH_MODE') === '1') {
            return '';
        }

        $this->context->smarty->assign(
            [
                'AccessLicenseNumber' => Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCESS_KEY'),
                'AccountUsername' => Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_USERNAME'),
                'AccountPassword' => Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_PASSWORD'),
            ]
        );

        return trim($this->fetch($this->module->getLocalPath() . 'views/templates/admin/requests/AccessRequest.tplx'));
    }

    public function fetch($template, $context = null)
    {
        if ($context == null) {
            $context = $this->context;
        }

        $strings_to_remove = [
            "\n" . '<!-- begin ' . $template . ' -->' . "\n",
            "\n" . '&lt;!-- begin ' . $template . ' --&gt;' . "\n",
            "\n" . '<!-- end ' . $template . ' -->' . "\n",
            "\n" . '&lt;!-- end ' . $template . ' --&gt;' . "\n",
        ];

        $content = $context->smarty->fetch($template);

        return str_replace($strings_to_remove, '', $content);
    }

    private function assignIntlShipmentInformation($packages, $context = null)
    {
        if ($context == null) {
            $context = $this->context;
        }

        $declared_value = 0;
        $custom_lines = [];
        foreach ($packages as $package) {
            if (!isset($package['Products']) || !is_array($package['Products']) || !count($package['Products'])) {
                $package['Products'] = UPSDotComBoxing::sortProductsForRequest($package);
            }

            if (is_array($package['Products']) && count($package['Products'])) {
                foreach ($package['Products'] as &$product) {
                    if (!$product['CountryOfOrigin'] || Tools::strlen($product['CountryOfOrigin']) < 2) {
                        $product['CountryOfOrigin'] = ($this->origin_address['CountryCode'] ? $this->origin_address['CountryCode'] : 'US');
                    } elseif ($product['CountryOfOrigin'] && Tools::strlen($product['CountryOfOrigin']) > 2) {
                        $country_id = Country::getIdByName($this->context->cookie->id_lang, pSQL($product['CountryOfOrigin']));
                        $country = new Country((int) $country_id);

                        if (Validate::isLoadedObject($country)) {
                            $product['CountryOfOrigin'] = $country->iso_code;
                        } else {
                            $product['CountryOfOrigin'] = Tools::substr($product['CountryOfOrigin'], 0, 2);
                        }
                    }

                    $custom_lines[] = [
                        'Description' => $product['Description'],
                        'Quantity' => $product['Quantity'],
                        'UnitValue' => $product['UnitValue'],
                        'UnitWeight' => $product['UnitWeight'],
                        'CountryOfOrigin' => $product['CountryOfOrigin'],
                    ];

                    $declared_value += $product['UnitValue'] * $product['Quantity'];
                }
            }
        }

        // WEBVIZO TODO : MOVE SHIPMENT PURPOSE AND DUTY PAYER TO SHIPMENT SETTINGS
        $context->smarty->assign([
            /* PACKAGE INFORMATION */
            'ShipmentPurpose' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_shipment_purpose'),
            /* DUTIES PAYMENT OPTIONS */
            'DutyPayer' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_duty_payer'),
            'DutyPayerAccountNumber' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_duty_payer_account'),
            'DutyPayerCountry' => $this->module->getTplVar(UPSDotCom::$module_prefix . '_settings_duty_payer_country'),

            'CustomsLines' => $custom_lines,
            'DeclaredValue' => $declared_value,

            'is_intl' => $this->is_intl,
            'customs_clearance' => $this->customs_clearance,
        ]);
    }

    public function getConfiguredPackages()
    {
        $packages = Configuration::get(UPSDotCom::$module_prefix_upper . '_PACKAGES');
        $this->packages = UPSDotComCarrierModule::safeDeserialization(UPSDotComCarrierModule::decodeString($packages));
        if (is_array($this->packages) && count($this->packages) > 0) {
            foreach ($this->packages as &$package) {
                if ((int) Configuration::get('PS_CURRENCY_DEFAULT') != $this->rate_currency->id) {
                    if (isset($package['additional_charge']) && $package['additional_charge'] > 0) {
                        $package['additional_charge'] = UPSDotCom::convertAmountBasedInCurrency(
                            $package['additional_charge'],
                            Configuration::get('PS_CURRENCY_DEFAULT'),
                            $this->rate_currency->id,
                            0
                        );
                    }
                }
            }
        } else {
            $this->packages = [];
        }
    }

    public function getOAuthToken($times_requested = 0, $flush_session = false)
    {
        ++$times_requested;

        if ($flush_session) {
            $_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN'] = false;
            $_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN_EXP'] = false;
        }

        $token = isset($_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN'])
            ? $_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN']
            : false;
        $token_expires_at = isset($_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN_EXP'])
            ? $_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN_EXP']
            : false;

        if ($token_expires_at !== false && $token !== false && (int) $token_expires_at > time()) {
            $post_response = new stdClass();
            $post_response->access_token = $token;

            return $post_response;
        }

        $account_number = Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_NUMBER');
        $client_id = Configuration::get(UPSDotCom::$module_prefix_upper . '_CLIENT_ID');
        $client_secret = Configuration::get(UPSDotCom::$module_prefix_upper . '_CLIENT_SECRET');

        $request = 'grant_type=client_credentials';
        $headers = [
            'x-merchant-id: ' . $account_number,
            'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
        ];

        $url = 'https://onlinetools.ups.com/security/v1/oauth/token';
        if (Configuration::get(UPSDotCom::$module_prefix_upper . '_ACCOUNT_MODE') == 'test') {
            $url = 'https://wwwcie.ups.com/security/v1/oauth/token';
        }

        $post_response = $this->module->executeCurlRequest(
            $url,
            $request,
            '',
            UPSDotComLog::$log_types[7],
            $headers
        );

        if (isset($post_response->response) && isset($post_response->response->errors)) {
            // Too many requests
            if (
                $times_requested < 5
                && $post_response->response->errors[0]->code == 10429
            ) {
                return $this->getOAuthToken($times_requested);
            }

            $post_response = new stdClass();
            $post_response->Response = new stdClass();
            $post_response->Response->ResponseStatus = new stdClass();
            $post_response->Response->ResponseStatus->Code = 0;
            $post_response->Response->ResponseStatus->Description = 'Failure';
            $post_response->Response->Error = new stdClass();
            $post_response->Response->Error->Severity = 'Hard';
            $post_response->Response->Error->Source = $this->l('UPS Web Service Response');
            $post_response->Response->Error->Code = $post_response->response->errors[0]->code;
            $post_response->Response->Error->Message = $post_response->response->errors[0]->message;
        } elseif (!isset($post_response->access_token)) {
            $post_response = new stdClass();
            $post_response->Response = new stdClass();
            $post_response->Response->ResponseStatus = new stdClass();
            $post_response->Response->ResponseStatus->Code = 0;
            $post_response->Response->ResponseStatus->Description = 'Failure';
            $post_response->Response->Error = new stdClass();
            $post_response->Response->Error->Severity = 'Hard';
            $post_response->Response->Error->Source = 'WebVIZO Exception';
            $post_response->Response->Error->Code = '0000';
            $post_response->Response->Error->Message = $this->module->l('Unknown error have happened, please contact us for more information');
        } else {
            $_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN'] = pSQL($post_response->access_token);
            $_SESSION[UPSDotCom::$module_prefix_upper . '_OAUTH_TOKEN_EXP'] = (int) $post_response->issued_at + (int) $post_response->expires_in;
        }

        return $post_response;
    }
}
