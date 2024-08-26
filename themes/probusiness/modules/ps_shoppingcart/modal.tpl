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
<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-lg-6 divide-right">
          <h4 class="modal-title h6 text-xs-center" id="myModalLabel" style="display: flex;align-items:center;"><i class="material-icons" style="background: #19b719;width:2rem;height:2rem;border-radius:50%;display:flex;justify-content:center;align-items:center;">&#xE876;</i>{l s='Product successfully added to your shopping cart' d='Shop.Theme.Modal'}</h4>
        </div>
        <div class="col-lg-6 modal-header-right" style="padding-left: calc(2.5rem + 15px);font-weight:600;">
          {if $cart.products_count > 1}
            <p class="cart-products-count">{l s='There are %products_count% items in your cart.' sprintf=['%products_count%' => $cart.products_count] d='Shop.Theme.Modal'}</p>
          {else}
            <p class="cart-products-count">{l s='There is %product_count% item in your cart.' sprintf=['%product_count%' =>$cart.products_count] d='Shop.Theme.Modal'}</p>
          {/if}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 divide-right">
            <div class="row" style="display: flex;align-items:center;">
              <div class="col-md-4 col-sm-12 col-xs-12">
                {* <img class="product-image" src="{$product.cover.large.url|escape:'html':'UTF-8'}" alt="{$product.cover.legend|escape:'html':'UTF-8'}" title="{$product.cover.legend|escape:'html':'UTF-8'}" itemprop="image"> *}
                <img class="product-image" src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, 'thumb')}" alt="{$product.cover.legend|escape:'html':'UTF-8'}" title="{$product.cover.legend|escape:'html':'UTF-8'}" itemprop="image" style="width: 100%;max-width:125px;">
              </div>
              <div class="col-md-8  col-sm-12 col-xs-12 details-product-modal">
              {* <pre>{print_r($cart,1)}</pre> *}
              
                <h6 class="h6 product-name">{$product.name|escape:'html':'UTF-8'}</h6>
                <span><strong>{l s="Price" d="Shop.Theme.Modal"}</strong>: €{$product.price_with_reduction_without_tax|number_format:2}</span>
                {hook h='displayProductPriceBlock' product=$product type="unit_price"}
                <span><strong>{l s="Reference" d="Shop.Theme.Modal"}</strong>: {$product.reference|escape:'html':'UTF-8'}</span>
                {foreach from=$product.attributes item="property_value" key="property"}
                  <span><strong>{$property|escape:'html':'UTF-8'}</strong>: {$property_value|escape:'html':'UTF-8'}</span>
                {/foreach}
                <p><strong>{l s='Quantity:' d='Shop.Theme.Modal'}</strong>&nbsp;{$product.cart_quantity|escape:'html':'UTF-8'}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="cart-content">
                {* {debug} *}
              <p><strong>{l s='Price' d='Shop.Theme.Modal'} :</strong>&nbsp;{$cart.totals.total_excluding_tax.value} ({l s="ExVAT" d='Shop.Theme.Modal'})</p>
              <p><strong>{l s='VAT' d='Shop.Theme.Modal'} :</strong>&nbsp;€{($cart.totals.total.amount - $cart.totals.total_excluding_tax.amount)|number_format:2}</p>
              <p>
                <strong>{l s='Shipping' d='Shop.Theme.Modal'}  :</strong>&nbsp;
                {if $cart.subtotals.shipping.amount|escape:'html':'UTF-8' > 0} 
                  {* {$cart.subtotals.shipping.amount|escape:'html':'UTF-8'} *}
                  ({l s="To be defined" d="Shop.Theme.Modal"})
                {else} 
                  ({l s="To be defined" d="Shop.Theme.Modal"})
                {/if}{hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</p>
              <p><strong>{l s='Total' d='Shop.Theme.Modal'} :</strong>&nbsp;{$cart.subtotals.products.value|escape:'html':'UTF-8'}</p>

              {* ---------------------------------------- *}
              {* <p class="subtitle-modal-cart"><strong>{l s='Total products:' d='Shop.Theme.Checkout'}</strong>&nbsp;{$cart.subtotals.products.value|escape:'html':'UTF-8'}</p> *}
              
              {* <pre>{print_r($cart.totals.total_excluding_tax,1)}</pre> *}
              {* <p><strong>{$cart.subtotals.shipping.label|escape:'html':'UTF-8'} :</strong>&nbsp;{$cart.subtotals.shipping.value|escape:'html':'UTF-8'} {hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</p> *}
              {* {if $cart.subtotals.tax}
              	<p><strong>{$cart.subtotals.tax.label|escape:'html':'UTF-8'}</strong>&nbsp;{$cart.subtotals.tax.value|escape:'html':'UTF-8'}</p>
              {/if} *}
              {* <p><strong>{l s='Total:' d='Shop.Theme.Checkout'}</strong>&nbsp;{$cart.totals.total.value|escape:'html':'UTF-8'} {$cart.labels.tax_short|escape:'html':'UTF-8'}</p> *}
              {* <p class="subtitle-modal-cart"><strong>{l s='Total' d='Shop.Theme.Checkout'} :</strong>&nbsp;{$cart.totals.total_excluding_tax.value} {$cart.totals.total_excluding_tax.label|escape:'html':'UTF-8'}</p>
              {hook h='displayCartModalContent' product=$product} *}
              
            </div>
          </div>

          <div class="col-lg-12 container-modal-btns-shopping">
            <div class="cart-content-btn col-lg-6">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{l s='Continue shopping' d='Shop.Theme.Modal'}</button>
            </div>
            <div class="cart-content-btn col-lg-6">
              <a href="{$order_url}" class="btn btn-primary"><i class="material-icons rtl-no-flip">&#xE876;</i>{l s='Proceed to checkout' d='Shop.Theme.Modal'}</a>
            </div>
          </div>

        </div>
      </div>
      {* {hook h='displayCartModalFooter' product=$product} *}
    </div>
  </div>
</div>
