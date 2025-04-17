{*
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
*}
<div class="cart-detailed-totals">
  <div class="card-block">
    {foreach from=$cart.subtotals item="subtotal"}
      {if isset($subtotal.value) && $subtotal.value && $subtotal.type !== 'tax'}
        <div class="cart-summary-line" id="cart-subtotal-{$subtotal.type|escape:'html':'UTF-8'}">
          <span class="label{if 'products' === $subtotal.type} js-subtotal{/if}">
            {$subtotal.label|escape:'html':'UTF-8'}
          </span>
          <span class="value">
            {if 'discount' == $subtotal.type}-&nbsp;{/if}{$subtotal.value|escape:'html':'UTF-8'}
          </span>
          {if $subtotal.type === 'shipping'}
              <div><small class="value">{hook h='displayCheckoutSubtotalDetails' subtotal=$subtotal}</small></div>
          {/if}
        </div>
      {/if}
    {/foreach}
  </div>

  
  {if $customer.id_default_group != 4}
    <div id="cart-subtotal-vat" class="cart-summary-line">
      <span class="label">{l s="Vat" d="Shop.Theme.Checkout"}</span>
      <span class="value">{($cart.totals.total_including_tax.amount - $cart.totals.total_excluding_tax.amount)|number_format:2:'.':' '} €</span>
    </div>
    {else}
    <div id="cart-subtotal-vat" class="cart-summary-line">
      <span class="label">{l s="Vat" d="Shop.Theme.Checkout"}</span>
      <span class="value">0.00 €</span>
    </div>
  {/if}
  
  {include file='module:ets_onepagecheckout/views/templates/hook/cart-summary-totals.tpl' cart=$cart}
</div>