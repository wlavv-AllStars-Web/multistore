<?php
/**
* 2007-2013 PrestaShop
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

class Order extends OrderCore
{
	public function getTotalWeight()
	{
		include_once(_PS_ROOT_DIR_.'/modules/dimensionalweight/dimensionalweight.php');

		/* Instanciate the Dimensional Weight module and check if active */
		$dimensionalweight = new DimensionalWeight();
		if (!$dimensionalweight->active)
			return parent::getTotalWeight();

		$id_carrier = 0;

		$order_carrier = new OrderCarrier((int)$this->getIdOrderCarrier());
		if (Validate::isLoadedObject($order_carrier))
			$id_carrier = $order_carrier->id_carrier;
		else
			$id_carrier = $this->id_carrier;

		$total_weight = 0;

		$dim_weight_params = $dimensionalweight->getCarrierRuleWithIdCarrier($id_carrier);

		$products_details = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT product_id, product_quantity, product_weight
		FROM '._DB_PREFIX_.'order_detail
		WHERE id_order = '.(int)$this->id);

		foreach ($products_details as $product_details)
		{

			$product_dimensions = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
								SELECT width, height, depth
								FROM '._DB_PREFIX_.'product
								WHERE id_product = '.(int)$product_details['product_id']);

			if (!empty($dim_weight_params))
			{
				$dim_weight = (($product_dimensions['width'] * $product_dimensions['height'] * $product_dimensions['depth']) / $dim_weight_params['factor']);
				$weight = ($dim_weight > $product_details['product_weight'] ? $dim_weight : $product_details['product_weight']);
				$total_weight += $weight * $product_details['product_quantity'];
			}
			else
				$total_weight += $product_details['product_weight'] * $product_details['product_quantity'];
		}
		return $total_weight;
	}

	// public function getIdOrderCarrier()
	// {
	// 	return (int)Db::getInstance()->getValue('
	// 			SELECT `id_order_carrier`
	// 			FROM `'._DB_PREFIX_.'order_carrier`
	// 			WHERE `id_order` = '.(int)$this->id);
	// }
}

