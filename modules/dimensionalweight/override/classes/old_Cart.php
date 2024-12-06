<?php
/**
* 2007-2011 PrestaShop
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
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2011 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class Cart extends CartCore
{

	/**
	 * Return package shipping cost
	 *
	 * @param integer $id_carrier Carrier ID (default : current carrier)
	 * @param booleal $use_tax
	 * @param Country $default_country
	 * @param Array $product_list
	 * @param array $product_list List of product concerned by the shipping. If null, all the product of the cart are used to calculate the shipping cost
	 *
	 * @return float Shipping total
	 */
	public function getPackageShippingCost($id_carrier = null, $use_tax = true, Country $default_country = null, $product_list = null, $id_zone = null)
	{
		include_once(_PS_ROOT_DIR_.'/modules/dimensionalweight/dimensionalweight.php');

		/* Instanciate the Dimensional Weight module and check if active */
		$dimensionalweight = new dimensionalweight();
		if (!$dimensionalweight->active)
			return parent::getPackageShippingCost($id_carrier, $use_tax, $default_country, $product_list, $id_zone);

		if ($this->isVirtualCart())
			return 0;

		if (!$default_country)
			$default_country = Context::getContext()->country;

		if (!is_null($product_list))
			foreach ($product_list as $key => $value)
				if ($value['is_virtual'] == 1)
					unset($product_list[$key]);


		$complete_product_list = $this->getProducts();
		if (is_null($product_list)) {
			$products = $complete_product_list;
		}
		else
			$products = $product_list;

		if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_invoice')
			$address_id = (int)$this->id_address_invoice;
		elseif (count($product_list))
		{
			$prod = current($product_list);
			$address_id = (int)$prod['id_address_delivery'];
		}
		else
			$address_id = null;
		if (!Address::addressExists($address_id))
			$address_id = null;
		
		if (version_compare(_PS_VERSION_, '1.6.1.2', '>='))
		{	
			if (is_null($id_carrier) && !empty($this->id_carrier)) {
            	$id_carrier = (int)$this->id_carrier;
        	}
        }



		$cache_id = 'getPackageShippingCost_'.(int)$this->id.'_'.(int)$address_id.'_'.(int)$id_carrier.'_'.(int)$use_tax.'_'.(int)$default_country->id;

		if ($products)
			foreach ($products as $product)
				$cache_id .= '_'.(int)$product['id_product'].'_'.(int)$product['id_product_attribute'];

		if (Cache::isStored($cache_id))
			return Cache::retrieve($cache_id);

		// Order total in default currency without fees
		$order_total = $this->getOrderTotal(true, Cart::ONLY_PHYSICAL_PRODUCTS_WITHOUT_SHIPPING, $product_list);

		// Start with shipping cost at 0
		$shipping_cost = 0;
		// If no product added, return 0


		if (!count($products))
		{
			Cache::store($cache_id, $shipping_cost);
			return $shipping_cost;
		}

		if (!isset($id_zone))
		{
			// Get id zone
			if (!$this->isMultiAddressDelivery()
				&& isset($this->id_address_delivery) // Be carefull, id_address_delivery is not usefull one 1.5
				&& $this->id_address_delivery
				&& Customer::customerHasAddress($this->id_customer, $this->id_address_delivery
			))
				$id_zone = Address::getZoneById((int)$this->id_address_delivery);
			else
			{
				if (!Validate::isLoadedObject($default_country))
					$default_country = new Country(Configuration::get('PS_COUNTRY_DEFAULT'), Configuration::get('PS_LANG_DEFAULT'));

				$id_zone = (int)$default_country->id_zone;
			}
		}

		if ($id_carrier && !$this->isCarrierInRange((int)$id_carrier, (int)$id_zone))
			$id_carrier = '';

		if (empty($id_carrier) && $this->isCarrierInRange((int)Configuration::get('PS_CARRIER_DEFAULT'), (int)$id_zone))
			$id_carrier = (int)Configuration::get('PS_CARRIER_DEFAULT');

		$total_package_without_shipping_tax_inc = $this->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING, $product_list);
		if (empty($id_carrier))
		{
			if ((int)$this->id_customer)
			{
				$customer = new Customer((int)$this->id_customer);
				$result = Carrier::getCarriers((int)Configuration::get('PS_LANG_DEFAULT'), true, false, (int)$id_zone, $customer->getGroups());
				unset($customer);
			}
			else
				$result = Carrier::getCarriers((int)Configuration::get('PS_LANG_DEFAULT'), true, false, (int)$id_zone);

			foreach ($result as $k => $row)
			{
				if ($row['id_carrier'] == Configuration::get('PS_CARRIER_DEFAULT'))
					continue;

				if (!isset(self::$_carriers[$row['id_carrier']]))
					self::$_carriers[$row['id_carrier']] = new Carrier((int)$row['id_carrier']);

				/** @var Carrier $carrier */
				$carrier = self::$_carriers[$row['id_carrier']];

				$shipping_method = $carrier->getShippingMethod();

				// Get only carriers that are compliant with shipping method
				if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && $carrier->getMaxDeliveryPriceByWeight((int)$id_zone) === false)
				|| ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && $carrier->getMaxDeliveryPriceByPrice((int)$id_zone) === false))
				{
					unset($result[$k]);
					continue;
				}
				

				// If out-of-range behavior carrier is set on "Desactivate carrier"
				if ($row['range_behavior'])
				{
					$check_delivery_price_by_weight = Carrier::checkDeliveryPriceByWeight($row['id_carrier'], $this->getTotalWeight(null, $row['id_carrier']), (int)$id_zone);

					$total_order = $total_package_without_shipping_tax_inc;
					$check_delivery_price_by_price = Carrier::checkDeliveryPriceByPrice($row['id_carrier'], $total_order, (int)$id_zone, (int)$this->id_currency);
					
					// Get only carriers that have a range compatible with cart
					if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && !$check_delivery_price_by_weight)
					|| ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && !$check_delivery_price_by_price))
					{
						unset($result[$k]);
						continue;
					}					
				}

				if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT)
					$shipping = $carrier->getDeliveryPriceByWeight($this->getTotalWeight($product_list, $row['id_carrier']), (int)$id_zone);
				else
					$shipping = $carrier->getDeliveryPriceByPrice($order_total, (int)$id_zone, (int)$this->id_currency);

				if (!isset($min_shipping_price))
					$min_shipping_price = $shipping;

				if ($shipping <= $min_shipping_price)
				{
					$id_carrier = (int)$row['id_carrier'];
					$min_shipping_price = $shipping;
				}
			}
		}

		if (empty($id_carrier))
			$id_carrier = Configuration::get('PS_CARRIER_DEFAULT');

		if (!isset(self::$_carriers[$id_carrier]))
			self::$_carriers[$id_carrier] = new Carrier((int)$id_carrier, Configuration::get('PS_LANG_DEFAULT'));

		$carrier = self::$_carriers[$id_carrier];

		// No valid Carrier or $id_carrier <= 0 ?
		if (!Validate::isLoadedObject($carrier))
		{
			Cache::store($cache_id, 0);
			return 0;
		}

		$shipping_method = $carrier->getShippingMethod();

		if (!$carrier->active)
		{
			Cache::store($cache_id, $shipping_cost);
			return $shipping_cost;
		}

		// Free fees if free carrier
		if ($carrier->is_free == 1)
		{
			Cache::store($cache_id, 0);
			return 0;
		}

		// Select carrier tax
		if ($use_tax && !Tax::excludeTaxeOption())
		{
			$address = Address::initialize((int)$address_id);

			if (Configuration::get('PS_ATCP_SHIPWRAP'))
			{
				// With PS_ATCP_SHIPWRAP, pre-tax price is deduced
				// from post tax price, so no $carrier_tax here
				// even though it sounds weird.
				$carrier_tax = 0;
			}
			else
			{
				$carrier_tax = $carrier->getTaxesRate($address);
			}
		}

		$configuration = Configuration::getMultiple(array(
			'PS_SHIPPING_FREE_PRICE',
			'PS_SHIPPING_HANDLING',
			'PS_SHIPPING_METHOD',
			'PS_SHIPPING_FREE_WEIGHT'
		));

		// Free fees
		$free_fees_price = 0;
		if (isset($configuration['PS_SHIPPING_FREE_PRICE']))
			$free_fees_price = Tools::convertPrice((float)$configuration['PS_SHIPPING_FREE_PRICE'], Currency::getCurrencyInstance((int)$this->id_currency));
		$orderTotalwithDiscounts = $this->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING, null, null, false);
		if ($orderTotalwithDiscounts >= (float)$free_fees_price && (float)$free_fees_price > 0)
		{
			Cache::store($cache_id, $shipping_cost);
			return $shipping_cost;
		}

		if (isset($configuration['PS_SHIPPING_FREE_WEIGHT'])
			&& $this->getTotalWeight(null, $carrier->id) >= (float)$configuration['PS_SHIPPING_FREE_WEIGHT']
			&& (float)$configuration['PS_SHIPPING_FREE_WEIGHT'] > 0)
		{
			Cache::store($cache_id, $shipping_cost);
			return $shipping_cost;
		}

		// Get shipping cost using correct method
		if ($carrier->range_behavior)
		{
			if (!isset($id_zone))
			{
				// Get id zone
				if (isset($this->id_address_delivery)
					&& $this->id_address_delivery
					&& Customer::customerHasAddress($this->id_customer, $this->id_address_delivery))
					$id_zone = Address::getZoneById((int)$this->id_address_delivery);
				else
					$id_zone = (int)$default_country->id_zone;
			}

			if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && !Carrier::checkDeliveryPriceByWeight((int)$carrier->id, $this->getTotalWeight(null, (int)$carrier->id), (int)$id_zone))
			|| ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && !Carrier::checkDeliveryPriceByPrice($carrier->id, $total_package_without_shipping_tax_inc, $id_zone, (int)$this->id_currency)
			))
				$shipping_cost += 0;
			else
			{
				if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT)
					$shipping_cost += $carrier->getDeliveryPriceByWeight($this->getTotalWeight($product_list, $carrier->id), $id_zone);
				else // by price
					$shipping_cost += $carrier->getDeliveryPriceByPrice($order_total, $id_zone, (int)$this->id_currency);
			}
		}
		else
		{
			if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT)
				$shipping_cost += $carrier->getDeliveryPriceByWeight($this->getTotalWeight($product_list, $carrier->id), $id_zone);
			else
				$shipping_cost += $carrier->getDeliveryPriceByPrice($order_total, $id_zone, (int)$this->id_currency);

		}
		// Adding handling charges
		if (isset($configuration['PS_SHIPPING_HANDLING']) && $carrier->shipping_handling)
			$shipping_cost += (float)$configuration['PS_SHIPPING_HANDLING'];

		// Additional Shipping Cost per product
		foreach ($products as $product)
			if (!$product['is_virtual'])
				$shipping_cost += $product['additional_shipping_cost'] * $product['cart_quantity'];

		$shipping_cost = Tools::convertPrice($shipping_cost, Currency::getCurrencyInstance((int)$this->id_currency));

		//get external shipping cost from module
		if ($carrier->shipping_external)
		{
			$module_name = $carrier->external_module_name;
			/** @var CarrierModule $module */
			$module = Module::getInstanceByName($module_name);

			if (Validate::isLoadedObject($module))
			{
				if (array_key_exists('id_carrier', $module))
					$module->id_carrier = $carrier->id;
				if ($carrier->need_range)
					if (method_exists($module, 'getPackageShippingCost'))
						$shipping_cost = $module->getPackageShippingCost($this, $shipping_cost, $products);
					else
						$shipping_cost = $module->getOrderShippingCost($this, $shipping_cost);
				else
					$shipping_cost = $module->getOrderShippingCostExternal($this);

				// Check if carrier is available
				if ($shipping_cost === false)
				{
					Cache::store($cache_id, false);
					return false;
				}
			}
			else
			{
				Cache::store($cache_id, false);
				return false;
			}
		}

		// Apply tax
		if (Configuration::get('PS_ATCP_SHIPWRAP'))
		{
			if (!$use_tax)
			{
				// With PS_ATCP_SHIPWRAP, we deduce the pre-tax price from the post-tax
				// price. This is on purpose and required in Germany.
				$shipping_cost /= (1 + $this->getAverageProductsTaxRate());
			}
		}
		else
		{
			// Apply tax
			if ($use_tax && isset($carrier_tax))
				$shipping_cost *= 1 + ($carrier_tax / 100);
		}

		if (version_compare(_PS_VERSION_, '1.6.1.4', '<'))
			$shipping_cost = (float)Tools::ps_round((float)$shipping_cost, 2);
		else
			$shipping_cost = (float)Tools::ps_round((float)$shipping_cost, (Currency::getCurrencyInstance((int)$this->id_currency)->decimals * _PS_PRICE_DISPLAY_PRECISION_));

		Cache::store($cache_id, $shipping_cost);

		return $shipping_cost;
	}

	/**
	* Return cart weight
	* @return float Cart weight
	*/
	public function getTotalWeight($products = null, $id_carrier = null)
	{
		if (is_null($id_carrier))
			$id_carrier = $this->id_carrier;

		include_once(_PS_ROOT_DIR_.'/modules/dimensionalweight/dimensionalweight.php');
		/* Instanciate the Dimensional Weight module */
		$dimensionalweight = new DimensionalWeight();
		if (!$dimensionalweight->active)
			return parent::getTotalWeight($products);
		$dim_weight_params = $dimensionalweight->getCarrierRuleWithIdCarrier($id_carrier);

		if (!is_null($products))
		{
			$total_weight = 0;

			foreach ($products as $product)
			{
				$real_weight = (!isset($product['weight_attribute']) || is_null($product['weight_attribute']) ? $product['weight'] : $product['weight_attribute']);

				if (!empty($dim_weight_params))
				{
					$dim_weight = (($product['width'] * $product['height'] * $product['depth']) / $dim_weight_params['factor']);
					$weight = ($dim_weight > $real_weight ? $dim_weight : $real_weight);
					$total_weight += $weight * $product['cart_quantity'];
				}
				else
					$total_weight += $real_weight * $product['cart_quantity'];
			}
			return $total_weight;
		}

		$products = Db::getInstance()->executeS('
		SELECT p.`weight` as weight, pa.`weight` as weight_attribute, p.`width` as width, p.`height` as height, p.`depth` as depth, cp.`quantity` as cart_quantity
		FROM `'._DB_PREFIX_.'cart_product` cp
		LEFT JOIN `'._DB_PREFIX_.'product` p ON (cp.`id_product` = p.`id_product`)
		LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (cp.`id_product_attribute` = pa.`id_product_attribute`)
		WHERE  cp.`id_cart` = '.(int)$this->id);

		$total_weight = 0;

		foreach ($products as $product)
		{
			$real_weight = (!isset($product['weight_attribute']) || is_null($product['weight_attribute']) ? $product['weight'] : ($product['weight'] + $product['weight_attribute']));

			if (!empty($dim_weight_params))
			{
				$dim_wight = (($product['width'] * $product['height'] * $product['depth']) / $dim_weight_params['factor']);
				$weight = ($dim_wight > $real_weight ? $dim_wight : $real_weight);
				$total_weight += $weight * $product['cart_quantity'];
			}
			else
				$total_weight += $real_weight * $product['cart_quantity'];
		}
		
		if (version_compare(_PS_VERSION_, '1.6.1.2', '<'))
			self::$_totalWeight[$this->id] = round((float)$total_weight, 3);
		else
			self::$_totalWeight[$this->id] = round((float)$total_weight, 6);

		return self::$_totalWeight[$this->id];
	}

	/**
	 * isCarrierInRange
	 *
	 * Check if the specified carrier is in range
	 *
	 * @id_carrier int
	 * @id_zone int
	 */
	public function isCarrierInRange($id_carrier, $id_zone)
	{
		$carrier = new Carrier((int)$id_carrier, Configuration::get('PS_LANG_DEFAULT'));
		$shipping_method = $carrier->getShippingMethod();
		if (!$carrier->range_behavior)
			return true;

		if ($shipping_method == Carrier::SHIPPING_METHOD_FREE)
			return true;

		$check_delivery_price_by_weight = Carrier::checkDeliveryPriceByWeight(
			(int)$id_carrier,
			$this->getTotalWeight(null, $id_carrier),
			$id_zone
		);
		if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && $check_delivery_price_by_weight)
			return true;

		$check_delivery_price_by_price = Carrier::checkDeliveryPriceByPrice(
			(int)$id_carrier,
			$this->getOrderTotal(
				true,
				Cart::BOTH_WITHOUT_SHIPPING
			),
			$id_zone,
			(int)$this->id_currency
		);
		if ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && $check_delivery_price_by_price)
			return true;

		return false;
	}
}