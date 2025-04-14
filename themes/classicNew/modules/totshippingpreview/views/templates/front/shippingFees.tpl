{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license


<table class="totselectzone__table">
	<tr class="totselectzone__row--head">
		<th class="has-image"></th>
		<th>{l s='Carrier' mod='totshippingpreview'}</th>
		<th>{l s='Fee' mod='totshippingpreview'}</th>
		<!--<th>{l s='Shipping Time' mod='totshippingpreview'}</th>-->
		<!--<th>{l s='Estimated Total' mod='totshippingpreview'}</th>-->
	</tr>
	{foreach from=$shipping_fee key=carrier item=carrier_value name=carrier_table}
		{if $carrier_value.fees >= 0 && $carrier_value.wm_id != 765 && $carrier_value.wm_id != 752 && $carrier_value.wm_id != 768}
		<tr class="{if $smarty.foreach.carrier_table.first}totselectzone__row--first {elseif $smarty.foreach.carrier_table.first}totselectzone__row--last {/if}{if $smarty.foreach.carrier_table.index % 2 == 0}totselectzone__row--odd {/if}">
			<td class="has-image">{if $carrier_value.logo}<img src="{$carrier_value.logo|escape:'html':'UTF-8'}" alt="{$carrier|escape:'html':'UTF-8'}" style="height: 40px; width: 40px;">{/if}</td>
			<td>{$carrier|escape:'html':'UTF-8'} - {$carrier_value.delay|escape:'html':'UTF-8'}</td>
			<td class="fees">{if $carrier_value.fees > 0}{$carrier_value.fees|escape:'htmlall':'UTF-8'} {$currency->sign|escape:'htmlall':'UTF-8'}{elseif $carrier_value.fees == 0}{l s='Free' mod='totshippingpreview'}{/if}</td>
			<!--<td class="delay">
				{$carrier_value.delay|escape:'html':'UTF-8'}
			</td>-->
			<!--<td class="delay">
				{$carrier_value.wm_total|escape:'htmlall':'UTF-8'} {$currency->sign|escape:'htmlall':'UTF-8'}
			</td>-->
		</tr>
		{/if}
	{/foreach}
</table>
*}

<table class="totselectzone__table">
    <thead  class="thead-dark">
        <tr class="totselectzone__row--head">
            <th scope="col" id="logo-shipping" class="has-image"></th>
            <th scope="col" id="carrier-shipping">{l s='Carrier' d='Shop.Theme.Product'}</th>
            <th scope="col">{l s='Shipping Cost' d='Shop.Theme.Product'}</th>
        </tr>
    </thead>
    <tbody>
    {if $shipping_fee|count > 0}
        {foreach from=$shipping_fee key=carrier item=carrier_value name=carrier_table}
            {if $carrier_value.fees >= 0 && $carrier_value.wm_id != 765 && $carrier_value.wm_id != 752 && $carrier_value.wm_id != 768}
                <tr class="{if $smarty.foreach.carrier_table.first}totselectzone__row--first {elseif $smarty.foreach.carrier_table.first}totselectzone__row--last {/if}{if $smarty.foreach.carrier_table.index % 2 == 0}totselectzone__row--odd {/if}">
                    <td class="has-image">{if $carrier_value.logo}<img src="{$carrier_value.logo|escape:'html':'UTF-8'}" alt="{$carrier|escape:'html':'UTF-8'}" style="height: 65px; width: 65px;">{/if}</td>
                    <td>{$carrier|escape:'html':'UTF-8'} - {$carrier_value.delay|escape:'html':'UTF-8'}</td>
                    <td class="fees">{if $carrier_value.fees > 0}{$carrier_value.fees|escape:'htmlall':'UTF-8'}€ {elseif $carrier_value.fees == 0}{l s='Free' mod='totshippingpreview'}{/if}</td>
                </tr>
            {/if}
        {/foreach}
    {else}
        <tr class="totselectzone__row--first totselectzone__row--last totselectzone__row--odd">
            <td colspan="3" class="text-center">{l s='No shipping fees available' d='Shop.Theme.Product'}</td>
        </tr>
    {/if}
    </tbody>
</table>

<style>
    @media screen and (min-width:560px){
        .totselectzone__table-container{
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 2rem auto;
        }

        .totselectzone__table{
            width: 100%;
        }
    }

    @media screen and (max-width:560px){
        #logo-shipping{
            width:10% !important;
        }
        #carrier-shipping{
            width:40% !important;
        }
    }
</style>