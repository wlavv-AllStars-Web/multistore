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


 <div class="images-container js-images-container" >
 {block name='product_cover'}
  
  <div class="d-mobile">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
      {foreach from=$product.images item=item key=key name=name}
        <div class="swiper-slide">
          <img src="{$item.bySize.large_default.url}" class="product_image" title="{$item.legend}" alt="{$item.legend}"/>
        </div>
      {/foreach}
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

   <div class="product-cover d-desktop">
     {if $product.default_image}
       <picture>
         {* {if !empty($product.default_image.bySize.large_default.sources.avif)}<source srcset="{$product.default_image.bySize.large_default.sources.avif}" type="image/avif">{/if}
         {if !empty($product.default_image.bySize.large_default.sources.webp)}<source srcset="{$product.default_image.bySize.large_default.sources.webp}" type="image/webp">{/if} *}
         <img
           class="js-qv-product-cover img-fluid"
           src="{$product.default_image.bySize.large_default.url}"
           {if !empty($product.default_image.legend)}
             alt="{$product.default_image.legend}"
             title="{$product.default_image.legend}"
           {else}
             alt="{$product.name}"
           {/if}
           loading="lazy"
           width="{$product.default_image.bySize.large_default.width}"
           height="{$product.default_image.bySize.large_default.height}"
          
         >
       </picture>
       <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
         {* <i class="material-icons zoom-in">search</i> *}
       </div>
     {else}
       <picture>
         {if !empty($urls.no_picture_image.bySize.large_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.large_default.sources.avif}" type="image/avif">{/if}
         {if !empty($urls.no_picture_image.bySize.large_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.large_default.sources.webp}" type="image/webp">{/if}
         <img
           class="img-fluid"
           src="{$urls.no_picture_image.bySize.large_default.url}"
           loading="lazy"
           width="{$urls.no_picture_image.bySize.large_default.width}"
           height="{$urls.no_picture_image.bySize.large_default.height}"
         >
       </picture>
     {/if}

     {if str_contains($product['category'] ,'clearance')}
      <div style="position: absolute;top:1rem; right:0; width: fit-content;height:31px;background:var(--asm-color);border-radius:50px 0 0 50px;display:flex;align-items:center;gap:0.5rem;min-width:200px;font-weight:600;font-size:18px;padding:0 0.5rem;justify-content: end;">
      <span style="color: #131313;font-weight:700">CLEARANCE</span>  
      <span style="color: white;"> - 25%</span>  
     
      </div>
      {/if}

    <div class="real-picture" >
      Real Picture
    </div>
   </div>
 {/block}

 {block name='product_images'}
   {* <div class="js-qv-mask mask">
     <ul class="product-images js-qv-product-images" >
       {foreach from=$product.images item=image key=key}
         {if $key < 5}
         <li class="thumb-container js-thumb-container">
           <picture>
             {if !empty($image.bySize.small_default.sources.avif)}<source srcset="{$image.bySize.small_default.sources.avif}" type="image/avif">{/if}
             {if !empty($image.bySize.small_default.sources.webp)}<source srcset="{$image.bySize.small_default.sources.webp}" type="image/webp">{/if}
             <img
               class="thumb js-thumb {if $image.id_image == $product.default_image.id_image} selected js-thumb-selected {/if}"
               data-image-medium-src="{$image.bySize.large_default.url}"
               {if !empty($image.bySize.large_default.sources)}data-image-medium-sources="{$image.bySize.large_default.sources|@json_encode}"{/if}
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
         {/if}
       {/foreach}
     </ul>
   </div> *}

   <div class="swiper mySwiper-thumb-images d-desktop">
    <div class="swiper-wrapper">
      {foreach from=$product.images item=image key=key}
        <div class="swiper-slide">
          <li class="js-thumb-container">
          <picture>
             {if !empty($image.bySize.medium_default.sources.avif)}<source srcset="{$image.bySize.medium_default.sources.avif}" type="image/avif">{/if}
             {if !empty($image.bySize.medium_default.sources.webp)}<source srcset="{$image.bySize.medium_default.sources.webp}" type="image/webp">{/if}
             <img
               class="thumb js-thumb {if $image.id_image == $product.default_image.id_image} selected js-thumb-selected {/if}"
               data-image-medium-src="{$image.bySize.large_default.url}"
               {if !empty($image.bySize.large_default.sources)}data-image-medium-sources="{$image.bySize.large_default.sources|@json_encode}"{/if}
               data-image-large-src="{$image.bySize.large_default.url}"
               {if !empty($image.bySize.large_default.sources)}data-image-large-sources="{$image.bySize.large_default.sources|@json_encode}"{/if}
               src="{$image.bySize.medium_default.url}"
               {if !empty($image.legend)}
                 alt="{$image.legend}"
                 title="{$image.legend}"
               {else}
                 alt="{$product.name}"
               {/if}
               loading="lazy"
               width="{$product.default_image.bySize.medium_default.width}"
               height="{$product.default_image.bySize.medium_default.height}"
             >
           </picture>
          </li>
        </div>
      {/foreach}
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    {* <div class="swiper-pagination"></div> *}
  </div>

  <script>
    var swiper = new Swiper(".mySwiper-thumb-images", {
      direction: "vertical",
      slidesPerView: 5,
      spaceBetween: 10,
      mousewheel: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
 {/block}
{hook h='displayAfterProductThumbs' product=$product}
</div>
