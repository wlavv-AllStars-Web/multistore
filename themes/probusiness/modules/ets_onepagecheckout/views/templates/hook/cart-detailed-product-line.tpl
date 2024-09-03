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

  {* <pre>{print_r($product,1)}</pre> *}
    <tr id="product_{$product.id_product}" class="cart_item last_item even first_item">
      <td class="cart_delete text-center">
        <div style="display: flex;justify-content: center;"> 
          <a 
            class                       = "remove-from-cart"
            rel                         = "nofollow"
            href                        = "{$product.remove_from_cart_url|escape:'html':'UTF-8'}"
            data-link-action            = "ets-delete-from-cart"
            data-id-product             = "{$product.id_product|intval}"
            data-id-product-attribute   = "{$product.id_product_attribute|intval}"
            data-id-customization   	  = "{$product.id_customization|intval}"
            >
            {if empty($product.is_gift)}
              <i class="material-icons float-xs-left">delete</i>
            {/if}
          </a>
        </div>
      </td>
      <td class="cart_product" style="width: 125px;"> 
        <a href="{$product.link}"> 
          <span class="product-image media-middle">
            {if $product.default_image}
            
              
              <img
              class="js-qv-product-cover img-fluid"
              src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, 'thumb')}"
              alt="{$product.name}"
              loading="lazy"
              width="125"
              height="125"
            >
             
            {else}
              <img
              class="js-qv-product-cover img-fluid"
              src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, 'thumb')}"
              alt="{$product.name}"
              loading="lazy"
              width="125"
              height="125"
            >
            {/if}
          </span>
        </a>
      </td>
      <td class="cart_description" data-title="Descrição">
        <div class="product-line-info">
          <a class="label" href="{$product.url}"
            data-id_customization="{$product.id_customization|intval}">{$product.name}</a>
          <span>{l s="Reference" d="Shop.Theme.Checkout"}: {$product.reference}</span>
        </div>
      </td>
      <td class="cart_unit" data-title="Preço unitário">
        <div class="product-line-info product-price h5 desktop {if $product.has_discount}has-discount{/if}">
          {* {if $product.has_discount}
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
          {/if} *}
          {* {debug} *}
          
          <div class="current-price">
            <span class="price">{$product.price_with_reduction_without_tax|number_format:2:'.':' '} € </span>
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
                  min="1"
                  aria-label="{l s='%productName% product quantity field' sprintf=['%productName%' => $product.name] d='Shop.Theme.Checkout'}" />
              {/if}
            </div>
            
          </div>
          {* <div class="product-line-info product-price h5 mobile {if $product.has_discount}has-discount{/if}">
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
              
              <span class="price">{$product.total}</span>
              {if $product.unit_price_full}
                <div class="unit-price-cart">{$product.unit_price_full}</div>
              {/if}
            </div>
            {hook h='displayProductPriceBlock' product=$product type="unit_price"}
          </div> *}
        </div>
      </td>
      {* <pre>{print_r($product,1)}</pre> *}
      <td class="cart_total" data-title="Total"> 
        <div class="price desktop">
          <span class="product-price">
            <strong>
              {if !empty($product.is_gift)}
                <span class="gift">{l s='Gift' d='Shop.Theme.Checkout'}</span>
              {else}
                {* {$product.total} *}
                {($product.price_with_reduction_without_tax * $product.quantity)|number_format:2:'.':' '} €
              {/if}
            </strong>
          </span>
        </div>
      </td>
      <td class="cart_delete-mobile text-center" style="width: 100%;background:#0273eb;padding: 0.5rem 1rem;">
        <div style="display: flex;justify-content: center;"> 
          <a 
            class                       = "remove-from-cart"
            rel                         = "nofollow"
            href                        = "{$product.remove_from_cart_url|escape:'html':'UTF-8'}"
            data-link-action            = "ets-delete-from-cart"
            data-id-product             = "{$product.id_product|intval}"
            data-id-product-attribute   = "{$product.id_product_attribute|intval}"
            data-id-customization   	  = "{$product.id_customization|intval}"
            >
            {if empty($product.is_gift)}
              <i class="material-icons float-xs-left" style="line-height:25px;">delete</i>
            {/if}
          </a>
        </div>
      </td>
    </tr>


<div class="clearfix"></div>

