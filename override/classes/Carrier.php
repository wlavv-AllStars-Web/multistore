<?php
if (!defined('_PS_VERSION_')) { exit; }
class Carrier extends CarrierCore
{
    /*
    * module: ets_onepagecheckout
    * date: 2024-11-21 17:55:06
    * version: 2.7.9
    */
    public static function getAvailableCarrierList(Product $product, $id_warehouse, $id_address_delivery = null, $id_shop = null, $cart = null, &$error = array())
    {
        if(($address_type =  Tools::getValue('address_type')) && $address_type=='shipping_address')
            $id_address_delivery = (int)Tools::getValue('id_address',$id_address_delivery);
        static $ps_country_default = null;
        if ($ps_country_default === null) {
            $ps_country_default = Configuration::get('PS_COUNTRY_DEFAULT');
        }
        if (null === $id_shop) {
            $id_shop = Context::getContext()->shop->id;
        }
        if (null === $cart) {
            $cart = Context::getContext()->cart;
        }
        if (null === $error || !is_array($error)) {
            $error = array();
        }
        $id_address = (int) ((null !== $id_address_delivery && $id_address_delivery != 0) ? $id_address_delivery : $cart->id_address_delivery);
        if ($id_address) {
            $id_zone = Address::getZoneById($id_address);
            if (!Address::isCountryActiveById($id_address)) {
                return array();
            }
        } else {
            if(!$id_zone = (int)Hook::exec('actionGetIDZoneByAddressID'))
            {
                $country = new Country($ps_country_default);
                $id_zone = $country->id_zone;
            }
        }
        $cache_id = 'Carrier::getAvailableCarrierList_' . (int) $product->id . '-' . (int) $id_shop;
        if (!Cache::isStored($cache_id)) {
            $query = new DbQuery();
            $query->select('id_carrier');
            $query->from('product_carrier', 'pc');
            $query->innerJoin(
                'carrier',
                'c',
                'c.id_reference = pc.id_carrier_reference AND c.deleted = 0 AND c.active = 1'
            );
            $query->where('pc.id_product = ' . (int) $product->id);
            $query->where('pc.id_shop = ' . (int) $id_shop);
            $carriers_for_product = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            Cache::store($cache_id, $carriers_for_product);
        } else {
            $carriers_for_product = Cache::retrieve($cache_id);
        }
        $carrier_list = array();
        if (!empty($carriers_for_product)) {
            foreach ($carriers_for_product as $carrier) { //check if the linked carriers are available in current zone
                if (Carrier::checkCarrierZone($carrier['id_carrier'], $id_zone)) {
                    $carrier_list[$carrier['id_carrier']] = $carrier['id_carrier'];
                }
            }
            if (empty($carrier_list)) {
                return array();
            }//no linked carrier are available for this zone
        }
        if ($id_warehouse) {
            $warehouse = new Warehouse($id_warehouse);
            $warehouse_carrier_list = $warehouse->getCarriers();
        }
        $available_carrier_list = array();
        $cache_id = 'Carrier::getAvailableCarrierList_getCarriersForOrder_' . (int) $id_zone . '-' . (int) $cart->id;
        if (!Cache::isStored($cache_id)) {
            $customer = new Customer($cart->id_customer);
            $carrier_error = array();
            $carriers = Carrier::getCarriersForOrder($id_zone, $customer->getGroups(), $cart, $carrier_error);
            Cache::store($cache_id, array($carriers, $carrier_error));
        } else {
            list($carriers, $carrier_error) = Cache::retrieve($cache_id);
        }
        $error = array_merge($error, $carrier_error);
        foreach ($carriers as $carrier) {
            $available_carrier_list[$carrier['id_carrier']] = $carrier['id_carrier'];
        }
        if ($carrier_list) {
            $carrier_list = array_intersect($available_carrier_list, $carrier_list);
        } else {
            $carrier_list = $available_carrier_list;
        }
        if (isset($warehouse_carrier_list)) {
            $carrier_list = array_intersect($carrier_list, $warehouse_carrier_list);
        }
        $cart_quantity = 0;
        $cart_weight = 0;
        foreach ($cart->getProducts(false, false) as $cart_product) {
            if ($cart_product['id_product'] == $product->id) {
                $cart_quantity += $cart_product['cart_quantity'];
            }
            if (isset($cart_product['weight_attribute']) && $cart_product['weight_attribute'] > 0) {
                $cart_weight += ($cart_product['weight_attribute'] * $cart_product['cart_quantity']);
            } else {
                $cart_weight += ($cart_product['weight'] * $cart_product['cart_quantity']);
            }
        }
        if ($product->width > 0 || $product->height > 0 || $product->depth > 0 || $product->weight > 0 || $cart_weight > 0) {
            foreach ($carrier_list as $key => $id_carrier) {
                $carrier = new Carrier($id_carrier);
                $carrier_sizes = array((int) $carrier->max_width, (int) $carrier->max_height, (int) $carrier->max_depth);
                $product_sizes = array((int) $product->width, (int) $product->height, (int) $product->depth);
                rsort($carrier_sizes, SORT_NUMERIC);
                rsort($product_sizes, SORT_NUMERIC);
                if (($carrier_sizes[0] > 0 && $carrier_sizes[0] < $product_sizes[0])
                    || ($carrier_sizes[1] > 0 && $carrier_sizes[1] < $product_sizes[1])
                    || ($carrier_sizes[2] > 0 && $carrier_sizes[2] < $product_sizes[2])) {
                    $error[$carrier->id] = Carrier::SHIPPING_SIZE_EXCEPTION;
                    unset($carrier_list[$key]);
                }
                if ($carrier->max_weight > 0 && ($carrier->max_weight < $product->weight * $cart_quantity || $carrier->max_weight < $cart_weight)) {
                    $error[$carrier->id] = Carrier::SHIPPING_WEIGHT_EXCEPTION;
                    unset($carrier_list[$key]);
                }
            }
        }
        return $carrier_list;
    }
    /*
    * module: totshippingpreview
    * date: 2024-12-06 14:25:52
    * version: 1.3.0
    */
    public function add($autodate = true, $null_values = false)
    {
        if ($this->position <= 0) {
            $this->position = Carrier::getHigherPosition() + 1;
        }
        if (!parent::add($autodate, $null_values) || !Validate::isLoadedObject($this)) {
            return false;
        }
        if (!$count = Db::getInstance()->getValue('SELECT count(`id_carrier`) FROM `'._DB_PREFIX_.$this->def['table'].'` WHERE `deleted` = 0')) {
            return false;
        }
        if ($count == 1) {
            Configuration::updateValue('PS_CARRIER_DEFAULT', (int)$this->id);
        }
        Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.$this->def['table'].'` SET `id_reference` = '.$this->id.' WHERE `id_carrier` = '.$this->id);
        $data = array(
            'id_totshippingpreview_carrier' => $this->id,
            'mindays' => Tools::getValue('mindays')!='' ? (int) Tools::getValue('mindays'): null,
            'maxdays' => Tools::getValue('maxdays')!='' ? (int) Tools::getValue('maxdays'): null,
        );
        DB::getInstance()->insert('totshippingpreview_carrier', $data);
        return true;
    }


    public static function getCarriersForOrder($id_zone, $groups = null, $cart = null, &$error = array())
	{
		include_once(_PS_ROOT_DIR_.'/modules/dimensionalweight/dimensionalweight.php');

		/* Instanciate the Dimensional Weight module and check if active */
		$dimensionalweight = new dimensionalweight();
		if (!$dimensionalweight->active)
			return parent::getCarriersForOrder($id_zone, $groups, $cart);

		$context = Context::getContext();
		$id_lang = $context->language->id;
		if (is_null($cart))
			$cart = $context->cart;

		if (isset($context->currency))
			$id_currency = $context->currency->id;

		if (is_array($groups) && !empty($groups))
			$result = Carrier::getCarriers($id_lang, true, false, (int)$id_zone, $groups, self::PS_CARRIERS_AND_CARRIER_MODULES_NEED_RANGE);
		else
			$result = Carrier::getCarriers($id_lang, true, false, (int)$id_zone, array(Configuration::get('PS_UNIDENTIFIED_GROUP')), self::PS_CARRIERS_AND_CARRIER_MODULES_NEED_RANGE);
		$results_array = array();

		foreach ($result as $k => $row)
		{
			$carrier = new Carrier((int)$row['id_carrier']);
			$shipping_method = $carrier->getShippingMethod();
			if ($shipping_method != Carrier::SHIPPING_METHOD_FREE)
			{

				// Get only carriers that are compliant with shipping method
				if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && $carrier->getMaxDeliveryPriceByWeight($id_zone) === false))
				{
					$error[$carrier->id] = Carrier::SHIPPING_WEIGHT_EXCEPTION;
					unset($result[$k]);
					continue;
				}
				if (($shipping_method == Carrier::SHIPPING_METHOD_PRICE && $carrier->getMaxDeliveryPriceByPrice($id_zone) === false))
				{
					$error[$carrier->id] = Carrier::SHIPPING_PRICE_EXCEPTION;
					unset($result[$k]);
					continue;
				}

				// If out-of-range behavior carrier is set on "Desactivate carrier"
				if ($row['range_behavior'])
				{
					// Get id zone
					if (!$id_zone)
							$id_zone = Country::getIdZone(Country::getDefaultCountryId());


					// Get only carriers that have a range compatible with cart
					if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT
						&& (!Carrier::checkDeliveryPriceByWeight($row['id_carrier'], $cart->getTotalWeight(null, $row['id_carrier']), $id_zone)))
					{
						$error[$carrier->id] = Carrier::SHIPPING_WEIGHT_EXCEPTION;
						unset($result[$k]);
						continue;
					}

					if ($shipping_method == Carrier::SHIPPING_METHOD_PRICE
						&& (!Carrier::checkDeliveryPriceByPrice($row['id_carrier'], $cart->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING), $id_zone, $id_currency)))
					{
						$error[$carrier->id] = Carrier::SHIPPING_PRICE_EXCEPTION;
						unset($result[$k]);
						continue;
					}
				}
			}

			$row['name'] = (strval($row['name']) != '0' ? $row['name'] : Configuration::get('PS_SHOP_NAME'));
			$row['price'] = ($shipping_method == Carrier::SHIPPING_METHOD_FREE ? 0 : $cart->getPackageShippingCost((int)$row['id_carrier'], true, null, null, $id_zone));
			$row['price_tax_exc'] = ($shipping_method == Carrier::SHIPPING_METHOD_FREE ? 0 : $cart->getPackageShippingCost((int)$row['id_carrier'], false, null, null, $id_zone));
			$row['img'] = file_exists(_PS_SHIP_IMG_DIR_.(int)$row['id_carrier'].'.jpg') ? _THEME_SHIP_DIR_.(int)$row['id_carrier'].'.jpg' : '';

			// If price is false, then the carrier is unavailable (carrier module)
			if ($row['price'] === false)
			{
				unset($result[$k]);
				continue;
			}
			$results_array[] = $row;
		}

		// if we have to sort carriers by price
		$prices = array();
		if (Configuration::get('PS_CARRIER_DEFAULT_SORT') == Carrier::SORT_BY_PRICE)
		{
			foreach ($results_array as $r)
				$prices[] = $r['price'];
			if (Configuration::get('PS_CARRIER_DEFAULT_ORDER') == Carrier::SORT_BY_ASC)
				array_multisort($prices, SORT_ASC, SORT_NUMERIC, $results_array);
			else
				array_multisort($prices, SORT_DESC, SORT_NUMERIC, $results_array);
		}

		return $results_array;
	}
}