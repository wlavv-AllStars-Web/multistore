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

 {* <pre>{print_r($count_products,1)}</pre> *}
 {* http://euromus.local/29-tm_home_default/mustang-23t-ecoboost-mishimoto-aluminium-radiator.jpg *}
 {* {$link->getImageLink($product.link_rewrite, $product.cover_image_id, 'tm_home_default')} *}

  {block name='product_miniature_item'}
  <div class="js-product product {if !empty($productClasses)} {$productClasses}{/if}" style="display: flex;justify-content:center;">
    <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}">
      <div class="thumbnail-container">
        <div class="thumbnail-top">
        {block name='product_thumbnail'}
          {if $product.cover_image_id}
            <a href="{$product.link}" class="thumbnail product-thumbnail">
              <picture>
                {* {if !empty($product.cover.bySize.tm_home_default.sources.avif)}<source srcset="{$product.cover.bySize.tm_home_default.sources.avif}" type="image/avif">{/if}
                {if !empty($product.cover.bySize.tm_home_default.sources.webp)}<source srcset="{$product.cover.bySize.tm_home_default.sources.webp}" type="image/webp">{/if} *}
                <img
                src="{if !empty($product.cover.bySize.tm_home_default.url)}{$product.cover.bySize.tm_home_default.url}{else}{$link->getImageLink($product.link_rewrite, $product.cover_image_id, 'tm_home_default')}{/if}"
                  alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
                  {if $lazy == true}loading="lazy"{/if}
                  data-full-size-image-url="{$product.cover.large.url}"
                  width="{$product.cover.bySize.tm_home_default.width}"
                  height="{$product.cover.bySize.tm_home_default.height}"
                />
              </picture>
            </a>
          {else}
            <a href="{$product.url}" class="thumbnail product-thumbnail">
              <picture>
                {if !empty($urls.no_picture_image.bySize.tm_home_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.tm_home_default.sources.avif}" type="image/avif">{/if}
                {if !empty($urls.no_picture_image.bySize.tm_home_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.tm_home_default.sources.webp}" type="image/webp">{/if}
                <img
                  src="{$urls.no_picture_image.bySize.tm_home_default.url}"
                  loading="lazy"
                  width="{$urls.no_picture_image.bySize.tm_home_default.width}"
                  height="{$urls.no_picture_image.bySize.tm_home_default.height}"
                />
              </picture>
            </a>
          {/if}
        {/block}
  
          {* <div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
            {block name='quick_view'}
              <a class="quick-view js-quick-view" href="#" data-link-action="quickview">
                <i class="material-icons search" translate="no">&#xE8B6;</i> {l s='Quick view' d='Shop.Theme.Actions'}
              </a>
            {/block}
  
            {block name='product_variants'}
              {if $product.main_variants}
                {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
              {/if}
            {/block}
          </div> *}
        </div>
  
        <div class="product-description">
          {block name='product_name'}
            {if $product.url}
              {if $page.page_name == 'index'}
                <h3 class="h3 product-title"><a href="{$product.url}" content="{$product.url}">{$product.name}</a></h3>
              {else}
                <h2 class="h3 product-title"><a href="{$product.url}" content="{$product.url}">{$product.name}</a></h2>
              {/if}
            {else}
              <h2 class="h3 product-title"><a href="{$product.link}" content="{$product.link}">{$product.name}</a></h2>
            {/if}
          {/block}
  
          {block name='product_price_and_shipping'}
            {if $product.show_price}
              <div class="product-price-and-shipping">
                {if $product.has_discount}
                  {hook h='displayProductPriceBlock' product=$product type="old_price"}
  
                  <span class="regular-price" aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}">{$product.regular_price}</span>
                  {if $product.discount_type === 'percentage'}
                    <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                  {elseif $product.discount_type === 'amount'}
                    <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                  {/if}
                {/if}
  
                {hook h='displayProductPriceBlock' product=$product type="before_price"}
  
                <span class="price" aria-label="{l s='Price' d='Shop.Theme.Catalog'}">
                  {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
                  {if '' !== $smarty.capture.custom_price}
                    {$smarty.capture.custom_price nofilter}
                  {else}
                    {$product.price}
                  {/if}
                </span>
  
                {hook h='displayProductPriceBlock' product=$product type='unit_price'}
  
                {hook h='displayProductPriceBlock' product=$product type='weight'}
              </div>
            {/if}
          {/block}
  
          {* {block name='product_reviews'}
            {hook h='displayProductListReviews' product=$product}
          {/block} *}
        </div>
  
        {* {include file='catalog/_partials/product-flags.tpl'} *}
      </div>
    </article>

    
    <script>

      document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('article.product-miniature').forEach((article) => {
          const productLink = article.querySelector('.product-title a');

          // Click on the whole article
          article.addEventListener('click', function (e) {
            // If the click originated from inside an "add-to-cart" button, do nothing
            if (e.target.closest('.add-to-cart')) return;

            // Simulate a click on the product link
            if (productLink) {
              window.location.href = productLink.href;
            }
          });

          // Prevent click propagation on all add-to-cart buttons
        //   article.querySelectorAll('.add-to-cart').forEach((btn) => {
        //     btn.addEventListener('click', function (e) {
        //       e.stopPropagation(); // Don't trigger the article click
        //     });
        //   });
        });
      });

    </script>

    
  </div>
  {/block}


