{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 
{* <div class="modal fade js-product-images-modal" id="product-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        {assign var=imagesCount value=$product.images|count}
        <figure>
          <img class="js-modal-product-cover product-cover-modal" width="{$product.cover.large.width}" src="{$product.cover.large.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" itemprop="image">
          <figcaption class="image-caption">
          {block name='product_description_short'}
            <div id="product-description-short" itemprop="description">{$product.description_short nofilter}</div>
          {/block}
        </figcaption>
        </figure>
        <aside id="thumbnails" class="thumbnails js-thumbnails text-xs-center">
          {block name='product_images'}
            <div class="js-modal-mask mask {if $imagesCount <= 5} nomargin {/if}">
              <ul class="product-images js-modal-product-images">
                {foreach from=$product.images item=image}
                  <li class="thumb-container">
                    <img data-image-large-src="{$image.large.url}" class="thumb js-modal-thumb" src="{$image.medium.url}" alt="{$image.legend}" title="{$image.legend}" width="{$image.medium.width}" itemprop="image">
                  </li>
                {/foreach}
              </ul>
            </div>
          {/block}
          {if $imagesCount > 5}
            <div class="arrows js-modal-arrows">
              <i class="material-icons arrow-up js-modal-arrow-up">&#xE5C7;</i>
              <i class="material-icons arrow-down js-modal-arrow-down">&#xE5C5;</i>
            </div>
          {/if}
        </aside>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> *}


<div class="modal fade js-product-images-modal" id="product-modal">
  <div class="btn-close-modal-images" style="
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: #fff;
    z-index: 999;
    width: 2rem;
    height: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #222;
    cursor: pointer;
    border-radius: .5rem;
    outline: 2px solid var(--asm-color);

  " onclick="closeModalProductImages()">
    <i class="material-icons">close</i>
  </div>
  <div class="modal-dialog" role="document" style="width: 100%;max-width: 1200px;height: 100%;transform: unset;">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-body">
        {assign var=imagesCount value=$product.images|count}

        <div class="swiper mySwiper-modal-product-images" style="height: 100%;">
          <div class="swiper-wrapper">
            
            {foreach from=$product.images item=image}
              {* <li class="thumb-container"> *}
              <div class="swiper-slide">
                <img data-image-large-src="{$image.tm_large.url}" class="thumb js-modal-thumb" src="{$image.large.url}" alt="{$image.legend}" title="{$image.legend}" width="{$image.medium.width}" itemprop="image">
              </div>
              {* </li> *}
            {/foreach}
            </div>
          </div>
          <div class="swiper-button-next" style="color: #222;"></div>
          <div class="swiper-button-prev" style="color: #222;"></div>
          {* <div class="swiper-pagination">asdasdsad</div> *}
        </div>

      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  initSwiper();
});
</script>