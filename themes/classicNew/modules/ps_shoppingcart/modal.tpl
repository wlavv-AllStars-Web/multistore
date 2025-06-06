{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="backdrop-filter: blur(10px);">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="{l s='Close' d='Shop.Theme.Global'}">
          <span aria-hidden="true"><i class="material-icons" translate="no">close</i></span>
        </button>
        <h4 class="modal-title h6 text-sm-center" id="myModalLabel"><i class="material-icons rtl-no-flip" translate="no">&#xE876;</i>{l s='Product successfully added to your shopping cart' d='Shop.Theme.Checkout'}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 divide-right">
            <div class="row" style="display: flex;flex-direction:column;">
              <div class="col-md-12">
                {if $product.default_image}
                  <img
                    src="{$product.default_image.bySize.tm_home_default.url}"
                    data-full-size-image-url="{$product.default_image.large.url}"
                    title="{$product.default_image.legend}"
                    alt="{$product.default_image.legend}"
                    loading="lazy"
                    class="product-image"
                    style="max-width: 125px;margin:auto;"
                  >
                {else}
                  <img
                    src="{$urls.no_picture_image.bySize.tm_home_default.url}"
                    loading="lazy"
                    class="product-image"
                    style="max-width: 125px;margin:auto;"
                  />
                {/if}
              </div>
              <div class="col-md-12">
                <h6 class="h6 product-name">{$product.name}</h6>
                <span class="product-price label" style="color: #103054;"><strong>{l s='Price' d='Shop.Theme.Checkout'}:</strong> <span>{$product.price}</span></span>
                {hook h='displayProductPriceBlock' product=$product type="unit_price"}
                {foreach from=$product.attributes item="property_value" key="property"}
                <span class="{$property|lower} label"><strong>{l s='%label%:' sprintf=['%label%' => $property] d='Shop.Theme.Global'}</strong> <span> {$property_value}</span></span><br>
                {/foreach}
                <span class="product-quantity label"><strong>{l s='Quantity:' d='Shop.Theme.Checkout'}</strong>&nbsp;<span>{$product.cart_quantity}</span></span>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="cart-content">
              {if $cart.products_count > 1}
                <p class="cart-products-count">{l s='There are %products_count% items in your cart.' sprintf=['%products_count%' => $cart.products_count] d='Shop.Theme.Checkout'}</p>
              {else}
                <p class="cart-products-count">{l s='There is %products_count% item in your cart.' sprintf=['%products_count%' =>$cart.products_count] d='Shop.Theme.Checkout'}</p>
              {/if}
              <p><span class="label">{l s='Subtotal:' d='Shop.Theme.Checkout'}</span>&nbsp;<span class="subtotal value">{$cart.subtotals.products.value}</span></p>
              {if $cart.subtotals.shipping.value}
                <p><span class="label">{l s='Shipping:' d='Shop.Theme.Checkout'}</span>&nbsp;<span class="shipping value">{$cart.subtotals.shipping.value} {hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</span></p>
              {/if}

              {if !$configuration.display_prices_tax_incl && $configuration.taxes_enabled}
                <p><span>{$cart.totals.total.label}{if $configuration.display_taxes_label}&nbsp;{$cart.labels.tax_short}{/if}</span>&nbsp;<span>{$cart.totals.total.value}</span></p>
                {* <p class="product-total"><span class="label">{$cart.totals.total_including_tax.label}</span>: <span class="value">{$cart.totals.total_including_tax.value}</span></p> *}
              {else}
                <p class="product-total"><span class="label">{$cart.totals.total.label} {if $configuration.taxes_enabled && $configuration.display_taxes_label}{$cart.labels.tax_short}{/if}:</span><span class="value">{$cart.totals.total.value}</span></p>
              {/if}

              {if $cart.subtotals.tax}
                <p class="product-tax">{l s='%label%:' sprintf=['%label%' => $cart.subtotals.tax.label] d='Shop.Theme.Global'}: <span class="value">{$cart.subtotals.tax.value}</span></p>
              {/if}
              {hook h='displayCartModalContent' product=$product}
              <div class="cart-content-btn" style="width: 100%;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;font-size: .85rem;">{l s='Continue shopping' d='Shop.Theme.Actions'}</button>
                <a href="{$order_url}" class="btn btn-primary"  style="font-size: .85rem;width: 100%;"><i class="material-icons rtl-no-flip" translate="no">&#xE876;</i>{l s='Proceed to checkout' d='Shop.Theme.Actions'}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {hook h='displayCartModalFooter' product=$product}
    </div>
  </div>
</div>
