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

{* {$style_tab} *}

{* <table width="100%" id="body" border="0" cellpadding="0" cellspacing="0" style="margin:0;">
	<!-- Addresses -->
	<tr colspan="12">
		logo
	</tr>
	<tr>
		<td colspan="12">

		{$addresses_tab}

		</td>
	</tr>

	<tr>
		<td colspan="12" height="30">&nbsp;</td>
	</tr>

	<tr>
		<td colspan="12">

		{$summary_tab}

		</td>
	</tr>

	<tr>
		<td colspan="12" height="20">&nbsp;</td>
	</tr>

	<!-- Products -->
	<tr>
		<td colspan="12">

		{$product_tab}

		</td>
	</tr>

	<tr>
		<td colspan="12" height="20">&nbsp;</td>
	</tr>

	<tr>
		<td colspan="7" class="left">

			{$payment_tab}

		</td>
		<td colspan="5">&nbsp;</td>
	</tr>

	<!-- Hook -->
	{if isset($HOOK_DISPLAY_PDF)}
	<tr>
		<td colspan="12" height="30">&nbsp;</td>
	</tr>

	<tr>
		<td colspan="12">
			{$HOOK_DISPLAY_PDF}
		</td>
	</tr>
	{/if}

</table> *}

<div style="font-size: 8pt; color: #444;">
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
    <br><br>
    <table cellpadding="4" cellspacing="0" style="width: 100%; text-align: center; border: 1px solid #CCC; font-size: 8pt;">
    	<tr>
			<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Order Reference' d='Shop.Pdf' pdf='true'}</b> </th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Order date' d='Shop.Pdf' pdf='true'}</b> </th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Status' d='Shop.Pdf' pdf='true'}</b> </th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Carrier' d='Shop.Pdf' pdf='true'}</b> </th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Tracking' d='Shop.Pdf' pdf='true'}</b> </th>

    		{* <th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Invoice Number' d='Shop.Pdf' pdf='true'}</b> </th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Invoice Date' d='Shop.Pdf' pdf='true'}</b> </th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;"> <b>{l s='Payment Method' d='Shop.Pdf' pdf='true'}</b> </th> *}
    	</tr>
    	<tr>
			<td style="width: 20%;"> {$order->getUniqReference()} </td>
    		<td style="width: 20%;"> {$order->date_add|date_format:"%d-%m-%Y %H:%M"} </td>
    		<td style="width: 20%;">{$current_state}</td>
    		<td style="width: 20%;">{$carrier->name}</td>
    		<td style="width: 20%;">{$tracking_number}</td>

    		{* <td style="width: 20%;"> {$title|escape:'html':'UTF-8'} </td>
    		<td style="width: 20%;"> {dateFormat date=$order->invoice_date full=0} </td>
    		<td style="width: 20%;">
    			{foreach from=$order_invoice->getOrderPaymentCollection() item=payment}
    				<b>{$payment->payment_method}</b>
    			{foreachelse}
    				{l s='No payment' d='Shop.Pdf' pdf='true'}
    			{/foreach}
    		</td> *}
    	</tr>
    </table>
    <br><br>
    <table cellpadding="4" cellspacing="0" style="width: 100%; text-align: center; border: 1px solid #CCC; font-size: 7pt;">
    	<tr>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;width:25%;"><b>{l s='Reference' d='Shop.Pdf' pdf='true'}</b></th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000;width:45%;"><b>{l s='Product' d='Shop.Pdf' pdf='true'}</b></th>
			<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; text-align: center;width:15%;"><b>{l s='Ordered' d='Shop.Pdf' pdf='true'}</b></th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; text-align: center;width:15%;"><b>{l s='Shipped' d='Shop.Pdf' pdf='true'}</b></th>

    		{* <th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; "> <b>{l s='Housing' d='Shop.Pdf' pdf='true'}</b></th> *}
    		{* <th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; "><b>{l s='Unit Price' d='Shop.Pdf' pdf='true'}{l s='(Tax Excl.)' d='Shop.Pdf' pdf='true'}</b></th>
    		<th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; "><b>{l s='Tax Rate' d='Shop.Pdf' pdf='true'}</b></th> *}
    		{* <th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; "><b>{l s='Unit Price' d='Shop.Pdf' pdf='true'} {l s='(Tax Incl.)' d='Shop.Pdf' pdf='true'}</b></th> *}
    		
    		{* <th style="border-bottom: 1px solid #000; background-color: #CCC; color: #000; ">
    			<b>{l s='Total' d='Shop.Pdf' pdf='true'}
    			{if $tax_excluded_display || (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) <= 0)}
    				{l s='(Tax Excl.)' d='Shop.Pdf' pdf='true'}
    			{else}
    				{l s='(Tax Incl.)' d='Shop.Pdf' pdf='true'}
    				
    			{/if}</b>
    		</th> *}
    	</tr>
    	<!-- PRODUCTS -->
    	{foreach $order_details as $order_detail}
    	
        	{if ( $order_detail['product_quantity'] - $order_detail['product_quantity_return'] ) == 0}
    	    	{assign var='deleted_row' value='color: red; text-decoration: line-through; background-color: #ccc;'}
	    	{else}
    	    	{assign var='deleted_row' value=''}
	    	{/if}

    	{if $order_detail.unit_price_tax_excl > 0}
    	{cycle values=' ,#EEE' assign=bgcolor}
    	<tr style="{$deleted_row}">
    		<td style="text-align: center;">
    			{if !empty($order_detail.product_reference)}
    				{$order_detail.product_reference}
    			{else}
    				--
    			{/if}
    		</td>

    		{* <td style="text-align: left;"> *}
				{* {assign var=query value="SELECT housing FROM ps_product WHERE id_product=`$order_detail.product_id`"}
				{assign var=location value=Db::getInstance()->getValue($query)}
				{$location['housing']} *}
    		    {* {if $order_detail.product_attribute_id == 0}
    			    {assign var=query value="SELECT housing FROM ps_product WHERE id_product=`$order_detail.product_id`"}
    			    {assign var=location value=Db::getInstance()->getRow($query)}
    				{$location['housing']}
                {else}
    			    {assign var=query value="SELECT `location` FROM ps_product_attribute WHERE id_product_attribute=`$order_detail.product_attribute_id`"}
    			    {assign var=location value=Db::getInstance()->getRow($query)}
    				{$location['location']}
				{/if} *}

    		{* </td> *}
    		
    		<td style="text-align: center;">{$order_detail.product_name}</td>
    	
    		<!-- unit price tax excluded is mandatory -->
    		{* <td style="text-align: center;">
    			{displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_excl}
    		</td> *}
    
    		<!--Valor real do imposto-->
    		{* <td style="text-align: center;"> *}
    		{* {if $tax_excluded_display || (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) <= 0)}
    			---
    		{else}
    			{displayPrice currency=$order->id_currency price=($order_detail.unit_price_tax_incl - $order_detail.unit_price_tax_excl)}
    		{/if} *}
				{* {$order_detail.tax_rate|number_format:0}%
    		</td> *}
    		
    		{* <td style="text-align: center;">
    		{if $tax_excluded_display || (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) <= 0)}
    			---
    		{else}
    			{displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_incl}
    		{/if}
    		</td> *}
    		<td style="text-align: center;">{$order_detail.product_quantity}</td>

			{if $order_detail.product_quantity_sent < $order_detail.product_quantity}
    			<td style="display:inherit;text-align: center;background-color: #f1aeb5;vertical-align: middle;color: #000;">{$order_detail.product_quantity_sent}</td>
			{else}
				<td style="text-align: center;">{$order_detail.product_quantity_sent}</td>
			{/if}
    		{* <td style="text-align: right;">
    		{if $tax_excluded_display}
    			{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl}
    		{else}
    			{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_incl}
    		{/if}
    		</td> *}
    	</tr>
    		{* {foreach $order_detail.customizedDatas as $customizationPerAddress}
    			{foreach $customizationPerAddress as $customizationId => $customization}
    				<tr style="line-height:6px;background-color:{$bgcolor}; ">
    					<td style="line-height:3px; text-align: left; width: 60%; vertical-align: top">
    
    							<blockquote>
    								{if isset($customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_]) && count($customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_]) > 0}
    									{foreach $customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_] as $customization_infos}
    										{$customization_infos.name}: {$customization_infos.value}
    										{if !$smarty.foreach.custo_foreach.last}<br />
    										{else}
    										<div style="line-height:0.4pt">&nbsp;</div>
    										{/if}
    									{/foreach}
    								{/if}
    
    								{if isset($customization.datas[$smarty.const._CUSTOMIZE_FILE_]) && count($customization.datas[$smarty.const._CUSTOMIZE_FILE_]) > 0}
    									{count($customization.datas[$smarty.const._CUSTOMIZE_FILE_])} {l s='image(s)' d='Shop.Pdf' pdf='true'}
    								{/if}
    							</blockquote>
    					</td>
    					<td style="text-align: right; width: 15%"></td>
    					<td style="text-align: center; width: 10%; vertical-align: top">({$customization.quantity})</td>
    					<td style="width: 15%; text-align: right;"></td>
    				</tr>
    			{/foreach}
    		{/foreach} *}
    		{/if}
    	{/foreach}
    	<!-- END PRODUCTS -->
    
    	<!-- CART RULES -->
    	{* {assign var="shipping_discount_tax_incl" value="0"}
    	{foreach $cart_rules as $cart_rule}
    	{cycle values='#FFF,#DDD' assign=bgcolor}
    		<tr style="line-height:6px;background-color:{$bgcolor}; text-align:right;">
    			<td colspan="{if !$tax_excluded_display}6{else}5{/if}">{$cart_rule.name}</td>
    			<td>
    				{if $cart_rule.free_shipping}
    					{assign var="shipping_discount_tax_incl" value=$order_invoice->total_shipping_tax_incl}
    				{/if}
    				{if $tax_excluded_display}
    					- {displayPrice currency=$order->id_currency price=$cart_rule.value_tax_excl}
    				{else}
    					- {displayPrice currency=$order->id_currency price=$cart_rule.value}
    				{/if}
    			</td>
    		</tr>
    	{/foreach} *}
    	<!-- END CART RULES -->
    </table>

	{* <table style="padding-top: 10px;">
		<tr>
			<td style="width: 50%;">
			</td>
			
			<td style="width: 50%;">
				<table style="width: 100%;border: 1px solid #CCC; font-size: 8pt;padding:5px;" align="right">
					{if (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) > 0)}
					<tr>
						<td style="width: 60%; text-align: right; font-weight: bold;background-color: #f0f0f0; color: #000;">{l s='Product Total (Tax Excl.)' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 40%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
					</tr> *}
				
					<!--<tr style="">
						<td style="width: 85%; text-align: right; font-weight: bold">{l s='Product Total (Tax Incl.)' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 15%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products_wt}</td>
					</tr>-->
					{* {else}
					<tr style="">
						<td style="width: 60%; text-align: right; font-weight: bold">{l s='Product Total' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 40%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
					</tr>
					{/if}
				
					{if $order_invoice->total_discount_tax_incl > 0}
					<tr style="">
						<td style="text-align: right; font-weight: bold;width: 60%;">{l s='Total Vouchers' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 40%; text-align: right;">-{displayPrice currency=$order->id_currency price=($order_invoice->total_discount_tax_incl + $shipping_discount_tax_incl)}</td>
					</tr>
					{/if}
				
					{if $order_invoice->total_wrapping_tax_incl > 0}
					<tr style="">
						<td style="text-align: right; font-weight: bold;width: 60%;">{l s='Wrapping Cost' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 15%; text-align: right;width: 40%;">
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
						<td style="text-align: right; font-weight: bold;width: 60%;">{l s='Shipping Cost' d='Shop.Pdf' pdf='true'}</td>
						<td style="text-align: right;width: 40%;">
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
						<td style="width: 60%;text-align: right; font-weight: bold;background-color: #f0f0f0; color: #000;">{l s='Total Tax' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 40%; text-align: right;">{displayPrice currency=$order->id_currency price=($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl)}</td>
					</tr>
					{/if}
					
					{if $tax_excluded_display || (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) <= 0)}
					<tr style="">
						<td style="width: 60%;text-align: right; font-weight: bold">{l s='Total' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 40%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_paid_tax_excl}</td>
					</tr>
					{else}
					<tr style="">
						<td style="width: 60%;text-align: right; font-weight: bold;background-color: #CCC; color: #000;">{l s='Total' d='Shop.Pdf' pdf='true'}</td>
						<td style="width: 40%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_paid_tax_incl}</td>
					</tr>
					{/if}
				</table>
			</td>
		</tr>
	</table> *}
    
    
    
    <!--<table>
    <tr>
    <td>
    <p><br />{$legal_free_text|escape:'html':'UTF-8'|nl2br}</p>
    </td>
    </tr>
    </table>-->
    <table style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <td>
    {if isset($free_text) && Customer::getDefaultGroupId($order->id_customer)==5}
    {$free_text|escape:'htmlall':'UTF-8'}
    {/if}
    </td>
    </tr>
    </table>
    
    			
    <!-- / PRODUCTS TAB -->
    
    {if isset($order_invoice->note) && $order_invoice->note}
    <div style="line-height: 1pt">&nbsp;</div>
    <table style="width: 100%">
    	<tr>
    		<td style="width: 15%"></td>
    		<td style="width: 85%">{$order_invoice->note|nl2br}</td>
    	</tr>
    </table>
    {/if}
    
    
    {if isset($HOOK_DISPLAY_PDF)}
    
    <table style="width: 100%">
    	<tr>
    		<td style="width: 15%"></td>
    		<td style="width: 85%">{$HOOK_DISPLAY_PDF}</td>
    	</tr>
    </table>
    {/if}


</div>

