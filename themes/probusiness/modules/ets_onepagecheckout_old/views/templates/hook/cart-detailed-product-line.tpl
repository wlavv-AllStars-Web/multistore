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

 
    <tr id="product_32156_0_0_38375" class="cart_item last_item address_38375 even first_item">
      <td class="cart_delete text-center">
        <div style="display: flex;justify-content: center;"> 
          <a class="remove-from-cart" rel="nofollow" href="{$product.remove_from_cart_url}"
            data-link-action="delete-from-cart" data-id-product="{$product.id_product|escape:'javascript'}"
            data-id-product-attribute="{$product.id_product_attribute|escape:'javascript'}"
            data-id-customization="{$product.id_customization|default|escape:'javascript'}">
            {if empty($product.is_gift)}
              <i class="material-icons float-xs-left">delete</i>
            {/if}
          </a>
        </div>
      </td>
      <td class="cart_product"> 
        <a href="https://www.allstarsmotorsport.fr/pt/32156-racingline-intercooler-mqb-25-tsi-ea855.html"> 
          <span class="product-image media-middle">
            {if $product.default_image}
              <picture>
                {if !empty($product.default_image.bySize.cart_default.sources.avif)}
                <source srcset="{$product.default_image.bySize.cart_default.sources.avif}" type="image/avif">{/if}
                {if !empty($product.default_image.bySize.cart_default.sources.webp)}
                <source srcset="{$product.default_image.bySize.cart_default.sources.webp}" type="image/webp">{/if}
                <img src="{$product.default_image.bySize.cart_default.url}" alt="{$product.name|escape:'quotes'}" loading="lazy"
                  style="width:100px;">
              </picture>
            {else}
              <picture>
                {if !empty($urls.no_picture_image.bySize.cart_default.sources.avif)}
                <source srcset="{$urls.no_picture_image.bySize.cart_default.sources.avif}" type="image/avif">{/if}
                {if !empty($urls.no_picture_image.bySize.cart_default.sources.webp)}
                <source srcset="{$urls.no_picture_image.bySize.cart_default.sources.webp}" type="image/webp">{/if}
                <img src="{$urls.no_picture_image.bySize.cart_default.url}" loading="lazy" />
              </picture>
            {/if}
          </span>
        </a>
      </td>
      <td class="cart_description" data-title="Descrição">
        <div class="product-line-info">
          <a class="label" href="{$product.url}"
            data-id_customization="{$product.id_customization|intval}">{$product.name}</a>
          <span>Reference: {$product.reference}</span>
        </div>
      </td>
      <td class="cart_unit" data-title="Preço unitário">
        <div class="product-line-info product-price h5 desktop {if $product.has_discount}has-discount{/if}">
          {if $product.has_discount}
            <div class="product-discount">
              <span class="regular-price">{$product.regular_price}</span>
              {if $product.discount_type === 'percentage'}
                <span class="discount">
                  -{$product.discount_percentage_absolute}
                </span>
              {else}
                <span class="discount discount-amount">
                  -{$product.discount_to_display}
                </span>
              {/if}
            </div>
          {/if}
          <div class="current-price">
            <span class="price">{$product.price}</span>
            {if $product.unit_price_full}
              <div class="unit-price-cart">{$product.unit_price_full}</div>
            {/if}
          </div>
          {hook h='displayProductPriceBlock' product=$product type="unit_price"}
        </div>
      </td>
      <td class="cart_quantity" data-title="Qty" style="width: 200px;"> 
        <div class="qty-price">
          <div class=" shopping-cart-row ">
            <div class="qty" style="margin: auto;width:150px;">
              {if !empty($product.is_gift)}
                <span class="gift-quantity">{$product.quantity}</span>
              {else}
                <input class="js-cart-line-product-quantity" data-down-url="{$product.down_quantity_url}"
                  data-up-url="{$product.up_quantity_url}" data-update-url="{$product.update_quantity_url}"
                  data-product-id="{$product.id_product}" type="number" inputmode="numeric" pattern="[0-9]*"
                  value="{$product.quantity}" name="product-quantity-spin"
                  aria-label="{l s='%productName% product quantity field' sprintf=['%productName%' => $product.name] d='Shop.Theme.Checkout'}" />
              {/if}
            </div>
            
          </div>
          <div class="product-line-info product-price h5 mobile {if $product.has_discount}has-discount{/if}">
            {if $product.has_discount}
              <div class="product-discount">
                <span class="regular-price">{$product.regular_price}</span>
                {if $product.discount_type === 'percentage'}
                  <span class="discount">
                    -{$product.discount_percentage_absolute}
                  </span>
                {else}
                  <span class="discount discount-amount">
                    -{$product.discount_to_display}
                  </span>
                {/if}
              </div>
            {/if}
            <div class="current-price">
              {* <span class="price">{$product.price}</span> *}
              <span class="price">{$product.total}</span>
              {if $product.unit_price_full}
                <div class="unit-price-cart">{$product.unit_price_full}</div>
              {/if}
            </div>
            {hook h='displayProductPriceBlock' product=$product type="unit_price"}
          </div>
        </div>
      </td>
      <td class="cart_total" data-title="Total"> 
        <div class="price desktop">
          <span class="product-price">
            <strong>
              {if !empty($product.is_gift)}
                <span class="gift">{l s='Gift' d='Shop.Theme.Checkout'}</span>
              {else}
                {$product.total}
              {/if}
            </strong>
          </span>
        </div>
      </td>
    </tr>




<div class="clearfix"></div>