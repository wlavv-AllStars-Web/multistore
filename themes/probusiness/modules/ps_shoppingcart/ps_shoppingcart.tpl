{*
* 2007-2022 ETS-Soft
*
* NOTICE OF LICENSE
*
* This file is not open source! Each license that you purchased is only available for 1 wesite only.
* If you want to use this file on more websites (or projects), you need to purchase additional licenses. 
* You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
* 
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs, please contact us for extra customization service at an affordable price
*
*  @author ETS-Soft <etssoft.jsc@gmail.com>
*  @copyright  2007-2022 ETS-Soft
*  @license    Valid for 1 website (or project) for each purchase of license
*  International Registered Trademark & Property of ETS-Soft
*}

<div id="_desktop_cart">
  <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
    <div class="header">
      <a rel="nofollow" href="{$order_url|escape:'html':'UTF-8'}">
        <div  style="cursor: pointer; width: 100%">
          <div style=" display: flex; flex-direction: row; justify-content:center" class="cart-container  {if $cart['products']|count < 1} cart_empty{/if}">
            <div style="width:33px; background-color: #0273eb;float: left;border-radius: 20px 0 0 20px;border: 1px solid #777; color: white;display:flex;align-items:center;justify-content:center;"> 
              <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
            </div>
            <div style="height:35px; border: 1px solid #777" class="cart_total_header"> {l s="Total" d="Shop.Theme.Cart"} <span class="productsValue">{$cart.totals.total_excluding_tax.amount|number_format:2:'.':' '} €</span></div>
            <div class="products_total_header">
              <div style="width:33px; height:35px; background-color: #0273eb;border-radius: 0px 20px 20px 0px;border: 1px solid #777; color: white; font-size: 18px;text-align:center;display:flex;justify-content:center;align-items:center;" >{$cart.products_count}</div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>




{* <div id="_desktop_cart"> *}
  {* <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
    <div class="header">
      <a rel="nofollow" href="{$order_url|escape:'html':'UTF-8'}">
        <div  style="cursor: pointer; width: 100%">
          <div style=" display: flex; flex-direction: row; justify-content:center" class="cart-container  {if $cart['products']|count < 1} cart_empty{/if}">
            <div style="width:33px; background-color: #0273eb;float: left;border-radius: 20px 0 0 20px;border: 1px solid #777; color: white;display:flex;align-items:center;justify-content:center;"> 
              <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
            </div>
            <div style="height:35px; border: 1px solid #777" class="cart_total_header"> {l s="Total"} <span class="productsValue">{$cart.totals.total_excluding_tax.value}</span></div>
            <div class="products_total_header">
              <div style="width:33px; height:35px; background-color: #0273eb;border-radius: 0px 20px 20px 0px;border: 1px solid #777; color: white; font-size: 18px;text-align:center;display:flex;justify-content:center;align-items:center;" >{$cart.products_count}</div>
            </div>
          </div>
        </div>
      </a>

      <div class="body cart-hover-content">
        <ul>
          {foreach from=$cart.products item=product}
            <li class="cart-wishlist-item">{include 'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' product=$product}</li>
          {/foreach}
        </ul>
        {if isset($cart.subtotals)}
          <div class="cart-subtotals">
            {foreach from=$cart.subtotals item="subtotal"}
              <div class="{if isset($subtotal.type)}{$subtotal.type|escape:'html':'UTF-8'}{/if}">
                <span class="label">{if isset($subtotal.label)}{$subtotal.label|escape:'html':'UTF-8'}{/if}</span>
                <span class="value">{if isset($subtotal.value)}{$subtotal.value|escape:'html':'UTF-8'}{/if}</span>
              </div>
            {/foreach}
          </div>
          {if isset($cart.totals.total)}
            <div class="cart-total">
              <span class="label">{$cart.totals.total.label|escape:'html':'UTF-8'}</span>
              <span class="value">{$cart.totals.total.value|escape:'html':'UTF-8'}</span>
            </div>

          {/if}
        {/if}
        <div class="cart-wishlist-action">
          <a class="cart-wishlist-checkout" href="{$order_url|escape:'html':'UTF-8'}">{l s='Check Out' d='Shop.Theme.Actions'}</a>
        </div>
      </div>
    </div>
  </div> *}
{* </div> *}


{* <div class="wdth blockcart cart-preview" style="width: 50%;" data-refresh-url="{$refresh_url}">
<a href="/order">
  <div  style="cursor: pointer; width: 100%">
    <div style=" display: flex; flex-direction: row; justify-content:center" class="cart-container  {if $cart['products']|count < 1} cart_empty{/if}">
      <div style="width:33px; background-color: #0273eb;float: left;border-radius: 20px 0 0 20px;border: 1px solid #777; color: white;display:flex;align-items:center;justify-content:center;"> 
        <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
      </div>
      <div style="height:35px; border: 1px solid #777" class="cart_total_header"> {l s="Total"} <span class="productsValue">{$cart.totals.total_excluding_tax.value}</span></div>
      <div class="products_total_header">
        <div style="width:33px; height:35px; background-color: #0273eb;border-radius: 0px 20px 20px 0px;border: 1px solid #777; color: white; font-size: 18px;text-align:center;display:flex;justify-content:center;align-items:center;" >{$cart.products_count}</div>
      </div>
    </div>
  </div>
</a>
</div> *}