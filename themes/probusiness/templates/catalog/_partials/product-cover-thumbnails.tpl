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
<div class="images-container js-images-container">
  {block name='product_cover'}
    <div class="product-cover" style="border: 3px solid lightgrey !important;margin-bottom: 0;">
      {if $product.default_image}
          <img
            class="js-qv-product-cover img-fluid"
            src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, '600')}"
            alt="{$product.name}"
            loading="lazy"
            width="600"
            height="600"
          >
        <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
          <i class="material-icons zoom-in">search</i>
        </div>
      {else}
          <img
            class="img-fluid"
            src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, '600')}"
            loading="lazy"
            width="600"
            height="600"
          >
      {/if}
    </div>
    <div style="font-weight: bolder;color: grey">{l s='ILLUSTRATIVE PHOTO, WITHOUT LICENSE' d='Shop.Theme.Catalog'}</div>
    
    {* <div style="margin-top: 10px; line-height: 2;"> *}
        {* <div style="float: left; width: calc( 100% - 60px )"> {l s='CHOOSE YOUR VERSION' d='Shop.Theme.Catalog'} </div>
        <div style="float: left; width: 60px"> <i class="fa-solid fa-chevron-down"></i> </div> *}
      {* {block name='product_variants'} {include file='catalog/_partials/product-variants.tpl'} {/block}
    </div> *}
  {/block}

  {block name='product_images'}
    <div class="js-qv-mask mask">
      <ul class="product-images js-qv-product-images">
        {foreach from=$product.images item=image}
          <li class="thumb-container js-thumb-container">
            <picture>
              {if !empty($image.bySize.small_default.sources.avif)}<source srcset="{$image.bySize.small_default.sources.avif}" type="image/avif">{/if}
              {if !empty($image.bySize.small_default.sources.webp)}<source srcset="{$image.bySize.small_default.sources.webp}" type="image/webp">{/if}
              <img
                class="thumb js-thumb {if $image.id_image == $product.default_image.id_image} selected js-thumb-selected {/if}"
                data-image-medium-src="{$image.bySize.medium_default.url}"
                {if !empty($image.bySize.medium_default.sources)}data-image-medium-sources="{$image.bySize.medium_default.sources|@json_encode}"{/if}
                data-image-large-src="{$image.bySize.large_default.url}"
                {if !empty($image.bySize.large_default.sources)}data-image-large-sources="{$image.bySize.large_default.sources|@json_encode}"{/if}
                src="{$image.bySize.small_default.url}"
                {if !empty($image.legend)}
                  alt="{$image.legend}"
                  title="{$image.legend}"
                {else}
                  alt="{$product.name}"
                {/if}
                loading="lazy"
                width="{$product.default_image.bySize.small_default.width}"
                height="{$product.default_image.bySize.small_default.height}"
              >
            </picture>
          </li>
        {/foreach}
      </ul>
    </div>
  {/block}
{hook h='displayAfterProductThumbs' product=$product}
</div>
