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
{block name='pack_miniature_item'}
  <article>
    <div class="card">
      <div class="pack-product-container">
        <div class="thumb-mask">
          <div class="mask">
            <a href="{$product.url}" title="{$product.name}">
              {if !empty($product.default_image.medium)}
                <picture>
                  {if !empty($product.default_image.medium.sources.avif)}<source srcset="{$product.default_image.medium.sources.avif}" type="image/avif">{/if}
                  {if !empty($product.default_image.medium.sources.webp)}<source srcset="{$product.default_image.medium.sources.webp}" type="image/webp">{/if}
                  <img
                          src="{$product.default_image.medium.url}"
                          {if !empty($product.default_image.legend)}
                            alt="{$product.default_image.legend}"
                            title="{$product.default_image.legend}"
                          {else}
                            alt="{$product.name}"
                          {/if}
                          loading="lazy"
                          data-full-size-image-url="{$product.default_image.large.url}"
                  >
                </picture>
              {else}
                <picture>
                  {if !empty($urls.no_picture_image.bySize.medium_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.medium_default.sources.avif}" type="image/avif">{/if}
                  {if !empty($urls.no_picture_image.bySize.medium_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.medium_default.sources.webp}" type="image/webp">{/if}
                  <img src="{$urls.no_picture_image.bySize.medium_default.url}" loading="lazy" />
                </picture>
              {/if}
            </a>
          </div>
        </div>

        <div class="pack-product-name" style="color: #333;">
          <a href="{$product.url}" title="{$product.name}">
            {$product.name}
          </a>
        </div>

        {if $showPackProductsPrice}
          <div class="pack-product-price">
            <strong>{$product.price}</strong>
          </div>
        {/if}

        <div class="pack-product-quantity">
          <span>x {$product.pack_quantity}</span>
        </div>
      </div>
    </div>
  </article>
{/block}
