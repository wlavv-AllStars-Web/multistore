{*  
 {if Context::getContext()->isMobile() != 1}
 <style>
  .p3v{
  font-size: 14px;
  border-right: 1px solid #fff;
  padding-right: 14px;
}
.crt{
  padding-top: 4px;
  padding-left: 7px;
  padding-right: 7px;
  color: #fff !important;
  height: 25px;
}
.crt:hover{
  background-color: #000;
  padding-left: 7px;
  padding-right: 7px;
  color: #dd170e !important;
}
 </style>
       <div class="p3v">
            <a href="./content/6-payment">
              <span style="color: white;">PAIMENT EN 3X / 4X PAR CB - EN SAVOIR PLUS</span>
              </a>
        </div>
  {/if}
   <div id="_desktop_cart" data-refresh-url="{$refresh_url}">  
  <div class="lpp blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}" >
    <a rel="nofollow" href="{$cart_url}">
    <i class="icon icon_cart_alt" style="color: white;"></i>
      {if $cart.products_count > 0}<span class="cart-products-count">{$cart.products_count}</span>{else}<span></span>{/if}
    </a>
    <!-- begin -->
    <div class="body cart-hover-content">
      <ul>
        {if isset($cart.products) && $cart.products}
          {foreach from=$cart.products item=product}
            <li class="cart-wishlist-item">{include 'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' product=$product}</li>
          {/foreach}
        {/if}
      </ul>
      <div class="cart-subtotals">
        {foreach from=$cart.subtotals item="subtotal"}
          {if $subtotal}
            <div class="{$subtotal.type|escape:'html':'UTF-8'}">
              <span class="label">{$subtotal.label|escape:'html':'UTF-8'}</span>
              <span class="value">{$subtotal.value|escape:'html':'UTF-8'}</span>
            </div>
          {/if}
        {/foreach}
      </div>
      <div class="cart-total">
        <span class="label">{$cart.totals.total.label|escape:'html':'UTF-8'}</span>
        <span class="value">{$cart.totals.total.value|escape:'html':'UTF-8'}</span>
      </div>
      <div class="cart-wishlist-action">
        <a class="cart-wishlist-viewcart" href="{$cart_url|escape:'html':'UTF-8'}">view cart</a>*}
        {* <a class="cart-wishlist-checkout"
           href="{$urls.pages.order|escape:'html':'UTF-8'}">{l s='Check Out' d='Shop.Theme.Actions'}</a>
      </div>
    </div>
      <!-- end -->
  </div>

      
</div>
  *}



  {* novoooooo *}

  {* <pre>{$cart.subtotals|print_r}</pre> *}
  <div id="_desktop_cart">
  <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" {if $cart.products_count > 0} onmouseover="hoverCart(this)" onmouseout="hoverCart(this)" {/if}  data-refresh-url="{$refresh_url|escape:'html':'UTF-8'}">
    <div class="header">
      <a rel="nofollow" {if $cart.products_count > 0}href="{$order_url|escape:'html':'UTF-8'}"{/if}>

      <i class="fa-solid fa-cart-shopping" {if $cart.products_count == 0}style="color:#fff;" {/if}></i>
        {* <span class="cart-products-label">{l s='Shopping Cart' d='Shop.Theme.Checkout'}</span> *}
        {* <span class="cart-products-count">{$cart.products_count|escape:'html':'UTF-8'} {if $cart.products_count > 1}{l s=' Items' d='Shop.Theme.Checkout'}{else}{l s=' Item' d='Shop.Theme.Checkout'}{/if} - {$cart.totals.total.value|escape:'html':'UTF-8'} </span> *}
        <span class="cart-products-label" {if $cart.products_count == 0}style="color:#fff;" {/if}>{$cart.products_count|escape:'html':'UTF-8'}</span>
        {* <span class="cart-products-label desktop">{l s='Product' d='Shop.Theme.Asm'}</span> *}
      </a>
    {if $cart.products_count > 0}
   

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
                <span class="value" style="font-weight: 600;">{if isset($subtotal.value)}{$subtotal.value|escape:'html':'UTF-8'}{/if}</span>
              </div>
            {/foreach}
            <div class="{if isset($subtotal.type)}{$subtotal.type|escape:'html':'UTF-8'}{/if}">
              <span class="label">{l s="VAT" d="Shop.Theme.CartQuick"}</span>
              <span class="value" style="font-weight: 600;">€{$cart.totals.total_including_tax.amount - $cart.totals.total_excluding_tax.amount}</span>
            </div>
          </div>
          {if isset($cart.totals.total)}
            <div class="cart-total">
              <span class="label">{l s="Total" d="Shop.Theme.CartQuick"}</span>
              <span class="value" style="font-weight: 600;">{$cart.totals.total_including_tax.value|escape:'html':'UTF-8'}</span>
            </div>

          {/if}
        {/if}
        {* {debug} *}
        <div class="cart-wishlist-action">
          <a class="cart-wishlist-checkout" href="{$order_url|escape:'html':'UTF-8'}">{l s='Check Out' d='Shop.Theme.Actions'}</a>
        </div>
      </div>
    {/if}
    </div>
  </div>
</div>
<style>
/* .cart-preview .cart-products-count {

  background-color: transparent !important;
    border-radius: 50% 50% 50% 50%;
    color: #FFFFFF;
    font-size: 12px;
    height: 14px;
    line-height: 14px;
    position: absolute;
    right: -15px;
    text-align: center;
    top: 5px;
    width: 14px;
    text-align: center;
    display: flex;
    justify-content: center;
} */
/* .right-nav{
  display: flex;
  flex: 1;
} */

/* #_desktop_cart{
  display: flex;
  flex:1;
} */

.cart-products-label{
  font-weight: 600;
}

#_desktop_cart .fa-cart-shopping{
  font-size: 14px;
}
</style>
