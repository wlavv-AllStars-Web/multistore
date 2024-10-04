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
<table id="total-tab" width="100%" style="border: 1px solid #CCC; font-size: 8pt;">

  <tr>
    <td class="grey" width="50%">
      {l s='Total Products (Tax Excl.)' d='Shop.Pdf' pdf='true'}
    </td>
    <td class="white" width="50%">
      {displayPrice currency=$order->id_currency price=$footer.products_before_discounts_tax_excl}
    </td>
  </tr> 

  {* {if $footer.product_discounts_tax_excl > 0}

    <tr>
      <td class="grey" width="50%">
        {l s='Total Discounts' d='Shop.Pdf' pdf='true'}
      </td>
      <td class="white" width="50%">
        - {displayPrice currency=$order->id_currency price=$footer.product_discounts_tax_excl}
      </td>
    </tr>

  {/if} *}
  {* {if !$order->isVirtual()}
  <tr>
    <td class="grey" width="50%">
      {l s='Shipping Costs' d='Shop.Pdf' pdf='true'}
    </td>
    <td class="white" width="50%">
      {if $footer.shipping_tax_excl > 0}
        {displayPrice currency=$order->id_currency price=$footer.shipping_tax_excl}
      {else}
        {l s='Free Shipping' d='Shop.Pdf' pdf='true'}
      {/if}
    </td>
  </tr>
  {/if}

  {if $footer.wrapping_tax_excl > 0}
    <tr>
      <td class="grey">
        {l s='Wrapping Costs' d='Shop.Pdf' pdf='true'}
      </td>
      <td class="white">{displayPrice currency=$order->id_currency price=$footer.wrapping_tax_excl}</td>
    </tr>
  {/if} *}

  {* <tr class="bold">
    <td class="grey">
      {if $isTaxEnabled}
        {l s='Total (Tax excl.)' d='Shop.Pdf' pdf='true'}
      {else}
        {l s='Total' d='Shop.Pdf' pdf='true'}
      {/if}
    </td>
    <td class="white">
      {displayPrice currency=$order->id_currency price=$footer.total_paid_tax_excl}
    </td>
  </tr> *}
  {if $isTaxEnabled}
    {if $footer.total_taxes > 0}
      <tr class="bold">
        <td class="grey">
          {l s='Total Tax' d='Shop.Pdf' pdf='true'}
        </td>
        <td class="white">
          {displayPrice currency=$order->id_currency price=$footer.total_taxes}
        </td>
      </tr>
    {/if}
    <tr class="bold big">
      <td class="grey" style="background-color: #CCC; color: #000;">
        {l s='Total' d='Shop.Pdf' pdf='true'}
      </td>
      <td class="white">
        {displayPrice currency=$order->id_currency price=$footer.total_paid_tax_incl}
      </td>
    </tr>
  {/if}
</table>
{* 
 
    <table style="width: 100%;padding-top:8px;">
    	{if (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) > 0)}
    	<tr style="">
    		<td style="width: 85%; text-align: right; font-weight: bold">{l s='Product Total (Tax Excl.)' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
    	</tr>
     *}
    	<!--<tr style="">
    		<td style="width: 85%; text-align: right; font-weight: bold">{l s='Product Total (Tax Incl.)' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products_wt}</td>
    	</tr>-->
    	{* {else}
    	<tr style="">
    		<td style="width: 85%; text-align: right; font-weight: bold">{l s='Product Total' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
    	</tr>
    	{/if}
    
    	{if $order_invoice->total_discount_tax_incl > 0}
    	<tr style="">
    		<td style="text-align: right; font-weight: bold">{l s='Total Vouchers' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">-{displayPrice currency=$order->id_currency price=($order_invoice->total_discount_tax_incl + $shipping_discount_tax_incl)}</td>
    	</tr>
    	{/if}
    
    	{if $order_invoice->total_wrapping_tax_incl > 0}
    	<tr style="">
    		<td style="text-align: right; font-weight: bold">{l s='Wrapping Cost' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">
    		{if $tax_excluded_display}
    			{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_excl}
    		{else}
    			{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_incl}
    		{/if}
    		</td>
    	</tr>
    	{/if}
    
    	{if $order_invoice->total_shipping_tax_incl > 0}
    	<tr style="">
    		<td style="text-align: right; font-weight: bold">{l s='Shipping Cost' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">
    			{if $tax_excluded_display}
    				{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_excl}
    				{else}
    				{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_incl}
    			{/if}
    		</td>
    	</tr>
    	{/if}
    
    	{if $tax_excluded_display || (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) <= 0)}
    	
    	{else}
    	<tr style="">
    		<td style="text-align: right; font-weight: bold">{l s='Total Tax' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl)}</td>
    	</tr>
    	{/if}
    	
    	{if $tax_excluded_display || (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) <= 0)}
    	<tr style="">
    		<td style="text-align: right; font-weight: bold">{l s='Total' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_paid_tax_excl}</td>
    	</tr>
    	{else}
    	<tr style="">
    		<td style="text-align: right; font-weight: bold">{l s='Total' d='Shop.Pdf' pdf='true'}</td>
    		<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_paid_tax_incl}</td>
    	</tr>
    	{/if}
    </table> *}
    
