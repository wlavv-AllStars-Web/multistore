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
<div class="cart-overview js-cart" data-refresh-url="{$link->getModuleLink('ets_onepagecheckout','order',['ajax' => true, 'action' => 'refresh'])|escape:'html':'UTF-8'}">
    {if isset($cart.products) &&  $cart.products}
    <div class="list-header-products col-lg-12" style="background: #d9d9d9;padding: .5rem 1rem;">
      <div class="col-lg-1 pl-0">{l s="Product" d="Shop.Theme.Checkout"}</div>
      <div class="col-lg-6 pl-0">
        <div class="col-lg-6">{l s="Description" d="Shop.Theme.Checkout"}</div>
        <div class="col-lg-4">{l s="Availability" d="Shop.Theme.Checkout"}</div>
        <div class="col-lg-2">{l s="Unit Price" d="Shop.Theme.Checkout"}</div>
      </div>
      <div class="col-lg-5 px-4">
        <div class="col-md-10 px-0">
          <div class="col-md-6">{l s="Quantity" d="Shop.Theme.Checkout"}</div>
          <div class="col-md-6 pl-5 pr-0">{l s="Total" d="Shop.Theme.Checkout"}</div>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    <ul class="cart-items">
      {foreach from=$cart.products item=product}
        <li class="cart-item">
            {if Module::isEnabled('ph_extend_support')}
                {include file='module:ph_extend_support/views/templates/hook/checkout/cart-detailed-product-line.tpl' product=$product}
            {else}
                {include file='module:ets_onepagecheckout/views/templates/hook/cart-detailed-product-line.tpl' product=$product}
            {/if}
        </li>
        {if is_array($product.customizations) && Ets_onepagecheckout::validateArray($product.customizations) && $product.customizations|count >1}<hr>{/if}
      {/foreach}
    </ul>
    {else}
      <span class="no-items">{l s='There are no more items in your cart' mod='ets_onepagecheckout'}</span>
    {/if}
</div>