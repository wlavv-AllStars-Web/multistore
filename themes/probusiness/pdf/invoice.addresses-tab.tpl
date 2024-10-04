{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *}
 <table cellpadding="4" cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;padding:10px 0;">
	<tr>
		<th style="width:35%; border: 1px solid #CCC; border-bottom: 1px solid #000; background-color: #CCC; color: #000;"><b>{l s='Billing Address' d='Shop.Pdf' pdf='true' }</b></th>
		<th style="width:30%; border: 1px solid #CCC; border-bottom: 1px solid #000; background-color: #CCC; color: #000; text-align: center;"><b>{l s='Order Detail' d='Shop.Pdf' pdf='true' }</b></th>
		<th style="width:35%; border: 1px solid #CCC; border-bottom: 1px solid #000; background-color: #CCC; color: #000; text-align: right;"><b>{l s='Delivery Address' d='Shop.Pdf' pdf='true'}</b></th>
	</tr>
	<tr>
		<td style="width:35%;">{$invoice_address}</td>
		<td style="width:30%;"><img style="" src="https://img.freepik.com/free-vector/illustration-barcode_53876-44019.jpg?t=st=1727799293~exp=1727802893~hmac=0f4f0f90db68013b9efcf2ef161bd07e2af0e834ddfe8cad59195916abeac817&w=826"></td>
		<td style="width:35%; text-align: right;">{$delivery_address}</td>
	</tr>
</table>
