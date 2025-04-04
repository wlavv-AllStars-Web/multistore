<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @copyright 2007-2013 PrestaShop SA
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class AdminOrdersController extends AdminOrdersControllerCore
{


	public function ajaxProcessAddProductOnOrder()
	{
		// Load object
		$order = new Order((int)Tools::getValue('id_order'));
		if (!Validate::isLoadedObject($order))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('The order object cannot be loaded.')
			)));

		$old_cart_rules = Context::getContext()->cart->getCartRules();

		if ($order->hasBeenShipped())
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('You cannot add products to delivered orders. ')
			)));

		$product_informations = Tools::getValue('add_product');
		if (Tools::getIsset($_POST['add_invoice']))
			$invoice_informations = Tools::getValue('add_invoice');
		else
			$invoice_informations = array();
		$product = new Product($product_informations['product_id'], false, $order->id_lang);
		if (!Validate::isLoadedObject($product))
			die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('The product object cannot be loaded.')
			)));

		if (isset($product_informations['product_attribute_id']) && $product_informations['product_attribute_id'])
		{
			$combination = new Combination($product_informations['product_attribute_id']);
			if (!Validate::isLoadedObject($combination))
				die(Tools::jsonEncode(array(
				'result' => false,
				'error' => Tools::displayError('The combination object cannot be loaded.')
			)));
		}

		// Total method
		$total_method = Cart::BOTH_WITHOUT_SHIPPING;

		// Create new cart
		$cart = new Cart();
		$cart->id_shop_group = $order->id_shop_group;
		$cart->id_shop = $order->id_shop;
		$cart->id_customer = $order->id_customer;
		$cart->id_carrier = $order->id_carrier;
		$cart->id_address_delivery = $order->id_address_delivery;
		$cart->id_address_invoice = $order->id_address_invoice;
		$cart->id_currency = $order->id_currency;
		$cart->id_lang = $order->id_lang;
		$cart->secure_key = $order->secure_key;

		// Save new cart
		$cart->add();

		// Save context (in order to apply cart rule)
		$this->context->cart = $cart;
		$this->context->customer = new Customer($order->id_customer);

		// always add taxes even if there are not displayed to the customer
		$use_taxes = true;

		$initial_product_price_tax_incl = Product::getPriceStatic($product->id, $use_taxes, isset($combination) ? $combination->id : null, 2, null, false, true, 1,
			false, $order->id_customer, $cart->id, $order->{Configuration::get('PS_TAX_ADDRESS_TYPE', null, null, $order->id_shop)});

		// Creating specific price if needed
		if ($product_informations['product_price_tax_incl'] != $initial_product_price_tax_incl)
		{
			$specific_price = new SpecificPrice();
			$specific_price->id_shop = 0;
			$specific_price->id_shop_group = 0;
			$specific_price->id_currency = 0;
			$specific_price->id_country = 0;
			$specific_price->id_group = 0;
			$specific_price->id_customer = $order->id_customer;
			$specific_price->id_product = $product->id;
			if (isset($combination))
				$specific_price->id_product_attribute = $combination->id;
			else
				$specific_price->id_product_attribute = 0;
			$specific_price->price = $product_informations['product_price_tax_excl'];
			$specific_price->from_quantity = 1;
			$specific_price->reduction = 0;
			$specific_price->reduction_type = 'amount';
			$specific_price->reduction_tax = 0;
			$specific_price->from = '0000-00-00 00:00:00';
			$specific_price->to = '0000-00-00 00:00:00';
			$specific_price->add();
		}

		// Add product to cart
		$update_quantity = $cart->updateQty($product_informations['product_quantity'], $product->id, isset($product_informations['product_attribute_id']) ? $product_informations['product_attribute_id'] : null,
			isset($combination) ? $combination->id : null, 'up', 0, new Shop($cart->id_shop));

		if ($update_quantity < 0)
		{
			// If product has attribute, minimal quantity is set with minimal quantity of attribute
			$minimal_quantity = ($product_informations['product_attribute_id']) ? Attribute::getAttributeMinimalQty($product_informations['product_attribute_id']) : $product->minimal_quantity;
			die(Tools::jsonEncode(array('error' => sprintf(Tools::displayError('You must add %d minimum quantity', false), $minimal_quantity))));
		}
		elseif (!$update_quantity)
			die(Tools::jsonEncode(array('error' => Tools::displayError('You already have the maximum quantity available for this product.', false))));

		// If order is valid, we can create a new invoice or edit an existing invoice
		if ($order->hasInvoice())
		{
			$order_invoice = new OrderInvoice($product_informations['invoice']);
			// Create new invoice
			if ($order_invoice->id == 0)
			{
				// If we create a new invoice, we calculate shipping cost
				$total_method = Cart::BOTH;
				// Create Cart rule in order to make free shipping
				if (isset($invoice_informations['free_shipping']) && $invoice_informations['free_shipping'])
				{
					$cart_rule = new CartRule();
					$cart_rule->id_customer = $order->id_customer;
					$cart_rule->name = array(
						Configuration::get('PS_LANG_DEFAULT') => $this->l('[Generated] CartRule for Free Shipping')
					);
					$cart_rule->date_from = date('Y-m-d H:i:s', time());
					$cart_rule->date_to = date('Y-m-d H:i:s', time() + 24 * 3600);
					$cart_rule->quantity = 1;
					$cart_rule->quantity_per_user = 1;
					$cart_rule->minimum_amount_currency = $order->id_currency;
					$cart_rule->reduction_currency = $order->id_currency;
					$cart_rule->free_shipping = true;
					$cart_rule->active = 1;
					$cart_rule->add();

					// Add cart rule to cart and in order
					$cart->addCartRule($cart_rule->id);
					$values = array(
						'tax_incl' => $cart_rule->getContextualValue(true),
						'tax_excl' => $cart_rule->getContextualValue(false)
					);
					$order->addCartRule($cart_rule->id, $cart_rule->name[Configuration::get('PS_LANG_DEFAULT')], $values);
				}

				$order_invoice->id_order = $order->id;
				if ($order_invoice->number)
				{
					Configuration::updateValue('PS_INVOICE_START_NUMBER', false, false, null, $order->id_shop);
				}
				else
					$order_invoice->number = Order::getLastInvoiceNumber() + 1;

				$invoice_address = new Address((int)$order->{Configuration::get('PS_TAX_ADDRESS_TYPE', null, null, $order->id_shop)});

				$carrier = new Carrier((int)$order->id_carrier);
				$tax_calculator = $carrier->getTaxCalculator($invoice_address);

				$order_invoice->total_paid_tax_excl = Tools::ps_round((float)$cart->getOrderTotal(false, $total_method), 2);
				$order_invoice->total_paid_tax_incl = Tools::ps_round((float)$cart->getOrderTotal($use_taxes, $total_method), 2);
				$order_invoice->total_products = (float)$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
				$order_invoice->total_products_wt = (float)$cart->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);
				$order_invoice->total_shipping_tax_excl = (float)$cart->getTotalShippingCost(null, false);
				$order_invoice->total_shipping_tax_incl = (float)$cart->getTotalShippingCost();

				$order_invoice->total_wrapping_tax_excl = abs($cart->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order_invoice->total_wrapping_tax_incl = abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->shipping_tax_computation_method = (int)$tax_calculator->computation_method;

				// Update current order field, only shipping because other field is updated later
				$order->total_shipping += $order_invoice->total_shipping_tax_incl;
				$order->total_shipping_tax_excl += $order_invoice->total_shipping_tax_excl;
				$order->total_shipping_tax_incl += ($use_taxes) ? $order_invoice->total_shipping_tax_incl : $order_invoice->total_shipping_tax_excl;

				$order->total_wrapping += abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order->total_wrapping_tax_excl += abs($cart->getOrderTotal(false, Cart::ONLY_WRAPPING));
				$order->total_wrapping_tax_incl += abs($cart->getOrderTotal($use_taxes, Cart::ONLY_WRAPPING));
				$order_invoice->add();

				$order_invoice->saveCarrierTaxCalculator($tax_calculator->getTaxesAmount($order_invoice->total_shipping_tax_excl));

				$order_carrier = new OrderCarrier();
				$order_carrier->id_order = (int)$order->id;
				$order_carrier->id_carrier = (int)$order->id_carrier;
				$order_carrier->id_order_invoice = (int)$order_invoice->id;
				$order_carrier->weight = (float)$cart->getTotalWeight(null, (int)$order->id_carrier);
				$order_carrier->shipping_cost_tax_excl = (float)$order_invoice->total_shipping_tax_excl;
				$order_carrier->shipping_cost_tax_incl = ($use_taxes) ? (float)$order_invoice->total_shipping_tax_incl : (float)$order_invoice->total_shipping_tax_excl;
				$order_carrier->add();
			}
			// Update current invoice
			else
			{
				$order_invoice->total_paid_tax_excl += Tools::ps_round((float)$cart->getOrderTotal(false, $total_method), 2);
				$order_invoice->total_paid_tax_incl += Tools::ps_round((float)$cart->getOrderTotal($use_taxes, $total_method), 2);
				$order_invoice->total_products += (float)$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
				$order_invoice->total_products_wt += (float)$cart->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);
				$order_invoice->update();
			}
		}

		// Create Order detail information
		$order_detail = new OrderDetail();
		$order_detail->createList($order, $cart, $order->getCurrentOrderState(), $cart->getProducts(), (isset($order_invoice) ? $order_invoice->id : 0), $use_taxes, (int)Tools::getValue('add_product_warehouse'));

		// update totals amount of order
		$order->total_products += (float)$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS);
		$order->total_products_wt += (float)$cart->getOrderTotal($use_taxes, Cart::ONLY_PRODUCTS);

		$order->total_paid += Tools::ps_round((float)$cart->getOrderTotal(true, $total_method), 2);
		$order->total_paid_tax_excl += Tools::ps_round((float)$cart->getOrderTotal(false, $total_method), 2);
		$order->total_paid_tax_incl += Tools::ps_round((float)$cart->getOrderTotal($use_taxes, $total_method), 2);

		if (isset($order_invoice) && Validate::isLoadedObject($order_invoice))
		{
			$order->total_shipping = $order_invoice->total_shipping_tax_incl;
			$order->total_shipping_tax_incl = $order_invoice->total_shipping_tax_incl;
			$order->total_shipping_tax_excl = $order_invoice->total_shipping_tax_excl;
		}
		// discount
		$order->total_discounts += (float)abs($cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS));
		$order->total_discounts_tax_excl += (float)abs($cart->getOrderTotal(false, Cart::ONLY_DISCOUNTS));
		$order->total_discounts_tax_incl += (float)abs($cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS));

		// Save changes of order
		$order->update();


		// Update weight SUM
		$order_carrier = new OrderCarrier((int)$order->getIdOrderCarrier());
		if (Validate::isLoadedObject($order_carrier))
		{
			$order_carrier->weight = (float)$order->getTotalWeight();
			if ($order_carrier->update())
				$order->weight = sprintf('%.3f '.Configuration::get('PS_WEIGHT_UNIT'), $order_carrier->weight);
		}

		// Update Tax lines
		$order_detail->updateTaxAmount($order);

		// Delete specific price if exists
		if (isset($specific_price))
			$specific_price->delete();

		$products = $this->getProducts($order);

		// Get the last product
		$product = end($products);
		$resume = OrderSlip::getProductSlipResume((int)$product['id_order_detail']);
		$product['quantity_refundable'] = $product['product_quantity'] - $resume['product_quantity'];
		$product['amount_refundable'] = $product['total_price_tax_excl'] - $resume['amount_tax_excl'];
		$product['amount_refund'] = Tools::displayPrice($resume['amount_tax_incl']);
		$product['return_history'] = OrderReturn::getProductReturnDetail((int)$product['id_order_detail']);
		$product['refund_history'] = OrderSlip::getProductSlipDetail((int)$product['id_order_detail']);

		if ($product['id_warehouse'] != 0)
		{
			$warehouse = new Warehouse((int)$product['id_warehouse']);
			$product['warehouse_name'] = $warehouse->name;
			$warehouse_location = WarehouseProductLocation::getProductLocation($product['product_id'], $product['product_attribute_id'], $product['id_warehouse']);
			if (!empty($warehouse_location))
				$product['warehouse_location'] = $warehouse_location;
			else
				$product['warehouse_location'] = false;
		}
		else
		{
			$product['warehouse_name'] = '--';
			$product['warehouse_location'] = false;
		}

		// Get invoices collection
		$invoice_collection = $order->getInvoicesCollection();

		$invoice_array = array();
		foreach ($invoice_collection as $invoice)
		{
			/** @var OrderInvoice $invoice */

			$invoice->name = $invoice->getInvoiceNumberFormatted(Context::getContext()->language->id, (int)$order->id_shop);
			$invoice_array[] = $invoice;
		}

		// Assign to smarty informations in order to show the new product line
		$this->context->smarty->assign(array(
			'product' => $product,
			'order' => $order,
			'currency' => new Currency($order->id_currency),
			'can_edit' => $this->tabAccess['edit'],
			'invoices_collection' => $invoice_collection,
			'current_id_lang' => Context::getContext()->language->id,
			'link' => Context::getContext()->link,
			'current_index' => self::$currentIndex
		));

		$this->sendChangedNotification($order);

		$new_cart_rules = Context::getContext()->cart->getCartRules();
		sort($old_cart_rules);
		sort($new_cart_rules);
		$result = array_diff($new_cart_rules, $old_cart_rules);
		$refresh = false;

		$res = true;
			
		foreach ($result as $cart_rule)
		{
			$refresh = true;
			// Create OrderCartRule
			$rule = new CartRule($cart_rule['id_cart_rule']);
			$values = array(
					'tax_incl' => $rule->getContextualValue(true),
					'tax_excl' => $rule->getContextualValue(false)
					);
			$order_cart_rule = new OrderCartRule();
			$order_cart_rule->id_order = $order->id;
			$order_cart_rule->id_cart_rule = $cart_rule['id_cart_rule'];
			$order_cart_rule->id_order_invoice = $order_invoice->id;
			$order_cart_rule->name = $cart_rule['name'];
			$order_cart_rule->value = $values['tax_incl'];
			$order_cart_rule->value_tax_excl = $values['tax_excl'];
			$res &= $order_cart_rule->add();

			$order->total_discounts += $order_cart_rule->value;
			$order->total_discounts_tax_incl += $order_cart_rule->value;
			$order->total_discounts_tax_excl += $order_cart_rule->value_tax_excl;
			$order->total_paid -= $order_cart_rule->value;
			$order->total_paid_tax_incl -= $order_cart_rule->value;
			$order->total_paid_tax_excl -= $order_cart_rule->value_tax_excl;
		}

		// Update Order
		$res &= $order->update();

		die(Tools::jsonEncode(array(
			'result' => true,
			'view' => $this->createTemplate('_product_line.tpl')->fetch(),
			'can_edit' => $this->tabAccess['add'],
			'order' => $order,
			'invoices' => $invoice_array,
			'documents_html' => $this->createTemplate('_documents.tpl')->fetch(),
			'shipping_html' => $this->createTemplate('_shipping.tpl')->fetch(),
			'discount_form_html' => $this->createTemplate('_discount_form.tpl')->fetch(),
			'refresh' => $refresh
		)));
	}
}

