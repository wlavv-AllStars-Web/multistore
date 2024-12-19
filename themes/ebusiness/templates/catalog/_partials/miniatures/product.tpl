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
{* <pre>{print_r($product['category'],1)}</pre> *}
{* <pre>{$ur|print_r}</pre> *}
{* <pre>{$product|print_r}</pre> *}
<article class="product-miniature js-product-miniature d-flex justify-content-center col-lg-3 col-md-4  col-sm-6 col-xs-12" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
  <div class="thumbnail-container" style="width: 526px;height:349px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:relative">
    <div class="image_item_product" style="border: 0;">
    {block name='product_thumbnail'}
      {if $product.cover_image_id}
        <a href="{$product.link}" class="thumbnail product-thumbnail">
          <picture>
            {* {if !empty($product.cover.bySize.home_default.sources.avif)}<source srcset="{$product.cover.bySize.home_default.sources.avif}" type="image/avif">{/if}
            {if !empty($product.cover.bySize.home_default.sources.webp)}<source srcset="{$product.cover.bySize.home_default.sources.webp}" type="image/webp">{/if} *}
            <img
            src="{if !empty($product.cover.bySize.home_default.url)}{$product.cover.bySize.home_default.url}{else}{$link->getImageLink($product.link_rewrite, $product.cover_image_id, 'home_default')}{/if}"
              alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
              loading="lazy"
              data-full-size-image-url="{$product.cover.large.url}"
              width="{$product.cover.bySize.home_default.width}"
              height="{$product.cover.bySize.home_default.height}"
            />
          </picture>
        </a>
      {else}
        <a href="{$product.url}" class="thumbnail product-thumbnail">
          <picture>
            {if !empty($urls.no_picture_image.bySize.home_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.home_default.sources.avif}" type="image/avif">{/if}
            {if !empty($urls.no_picture_image.bySize.home_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.home_default.sources.webp}" type="image/webp">{/if}
            <img
              src="{$urls.no_picture_image.bySize.home_default.url}"
              loading="lazy"
              width="{$urls.no_picture_image.bySize.home_default.width}"
              height="{$urls.no_picture_image.bySize.home_default.height}"
            />
          </picture>
        </a>
      {/if}
    {/block}
        {* <div class="highlighted-informationsif !$product.main_variants} no-variants{/if"> *}
          {* <div class="add_to_cart_button"> *}
{*              <form action="{$urls.pages.cart}" method="post">*}
              {* <div> *}
                    {* <input type="hidden" name="token" value="{$static_token}" /> *}
                    {* <input type="hidden" value="{$product.id_product}" name="id_product" /> *}
                    {* <input type="hidden" class="input-group form-control atc_qty" name="qty" value="1"> *}
{*                    <button data-button-action="add-to-cart" class="btn btn-primary" {if $product.quantity <= 0}disabled="disabled"{/if}>*}
                  {* <button class="add_to_cart btn btn-primary" onclick="mypresta_productListCart.add({literal}$(this){/literal});"> *}
                        {*l s='Buy Now' d='Shop.Theme.Actions'*}
                        {* <i class="fa fa-shopping-cart"></i> *}
                    {* </button> *}
              {* </div> *}
{*             </form>*}
         {* </div> *}
         {* {hook h='displayProductListFunctionalButtons' product=$product} *}
          {* <a href="#" class="quick-view" data-link-action="quickview"> *}
            {* <i class="material-icons search">search</i> {l s='Quick view' d='Shop.Theme.Actions'} *}
          {* </a> *}
        {* </div> *}
        {block name='product_variants'}
            {if $product.main_variants}
              {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
            {/if}
        {/block}
    </div>
    {if isset($filter_1)}
      {block name='product_price_and_shipping'}
        {if $product.show_price}
          <div class="product_pricebox" style="width: 100%;display:flex;">
            <div class="product-price-and-shipping" style="width: fit-content;height:31px;background:var(--asm-color);border-radius:0 50px 50px 0;display:flex;align-items:center;min-width:200px;">
              {hook h='displayProductPriceBlock' product=$product type="before_price"}

              <span itemprop="price" class="price" style="color: white;padding:0 0rem 0 1rem;font: 600 21px/26px 'Open Sans', sans-serif;margin-right:0;">{$product.price}€</span>
              
              {if $product.has_discount}
                {hook h='displayProductPriceBlock' product=$product type="old_price"}

                <span class="regular-price" style="color: #131313;font-weight:600;font-size:19px;padding-top:4px;">{$product.regular_price}€</span>
                {*if $product.discount_type === 'percentage'}
                  <span class="discount-percentage">{$product.discount_percentage}</span>
                {/if*}
              {/if}
              
              {hook h='displayProductPriceBlock' product=$product type='unit_price'}

              {hook h='displayProductPriceBlock' product=$product type='weight'}
            </div>
          </div>
        {/if}
      {/block}
    {else}
      {block name='product_price_and_shipping'}
        {if $product.show_price}
          <div class="product_pricebox" style="width: 100%;display:flex;">
            <div class="product-price-and-shipping" style="width: fit-content;height:31px;background:var(--asm-color);border-radius:0 50px 50px 0;display:flex;align-items:center;min-width:200px;">
              {hook h='displayProductPriceBlock' product=$product type="before_price"}

              <span itemprop="price" class="price" style="color: white;padding:0 0rem 0 1rem;font: 600 21px/26px 'Open Sans', sans-serif;margin-right:0;">{$product.price}</span>
              
              {if $product.has_discount}
                {hook h='displayProductPriceBlock' product=$product type="old_price"}

                <span class="regular-price" style="color: #131313;font-weight:600;font-size:19px;padding-top:4px;">{$product.regular_price}</span>
                {*if $product.discount_type === 'percentage'}
                  <span class="discount-percentage">{$product.discount_percentage}</span>
                {/if*}
              {/if}
              
              {hook h='displayProductPriceBlock' product=$product type='unit_price'}

              {hook h='displayProductPriceBlock' product=$product type='weight'}
            </div>
          </div>
        {/if}
      {/block}
    {/if}
    <div class="product-description" style="color: black;">
    
      {block name='product_name'}
        {* <h4 class="h3 product-title"  itemprop="name"><a style="color: black;" href="{$product.url}">{$product.name|truncate:30:'...'}</a></h4> *}
        <div style="display:flex;align-items:flex-start;justify-content: space-between;">
          <h4 class="h3 product-title"  itemprop="name" style="max-width: 382px;text-align:start;padding:0 0.5rem;margin:0;"><a style="color: #131313;font-size:14px;text-transform:uppercase;" href="{$product.url}">{$product.name}</a></h4>
          <div class="add_to_cart_button d-desktop" style="margin-right: 1rem;">

            <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                    <input type="hidden" name="token" value="{$static_token}">
                    <input type="hidden" name="id_product" value="{$product.id_product}" id="product_page_product_id">
                    <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">

                    <div class="add">
                    <button
                      class="btn btn-primary add-to-cart"
                      data-button-action="add-to-cart"
                      data-dismiss="modal"
                      type="submit"
                      style="margin-top: 0;"
                      {* {if !$product.add_to_cart_url}
                        disabled
                      {/if} *}
                    >
                      <i class="material-icons shopping-cart">&#xE547;</i>
      
                    </button>
                  </div>
            </form>

          </div>
         </div>
      {/block}
      {if isset($product.description_short) && $product.description_short !=''}
        <div class="short_description" style="color: black;">{$product.description_short|truncate:100:'...' nofilter}</div>
      {/if}
      
      {* <div class="hook-reviews"> *}
	      {* {hook h='displayProductListReviews' product=$product} *}
	  {* </div> *}

    {if count($product['attributes']) > 0}
    <div class="variantionsProductList" style="color: var(--asm-color);text-align:center;display: block;line-height: 17px;color: var(--asm-color);text-align: center;font-size: 14px;padding:0.5rem;">
      {l s='More variations available' d='Shop.Theme.Actions'}
    </div>
    {else}
      <div class="variantionsProductList" style="min-height:17px"></div>
    {/if}

    <div class="add_to_cart_button-mobile d-mobile">

      <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
              <input type="hidden" name="token" value="{$static_token}">
              <input type="hidden" name="id_product" value="{$product.id_product}" id="product_page_product_id">
              <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">

              <div class="add">
              <button
                class="btn btn-outline-primary add-to-cart"
                data-button-action="add-to-cart"
                data-dismiss="modal"
                type="submit"
                style="margin-top: 0;"
                {* {if !$product.add_to_cart_url}
                  disabled
                {/if} *}
              >
                {* <i class="material-icons shopping-cart">&#xE547;</i> *}
                {l s="Add to cart" d="Shop.Theme.ProductList"}
              </button>
            </div>
      </form>

    </div>
    

    {if str_contains($product['category'] ,'clearance')}
      <div style="position: absolute;top:1rem; left:0; width: fit-content;height:31px;background:var(--asm-color);border-radius:0 50px 50px 0;display:flex;align-items:center;gap:0.5rem;min-width:200px;font-weight:600;font-size:18px;padding:0 0.5rem;">
      <span style="color: #131313;font-weight:700">CLEARANCE</span>  
      <span style="color: white;"> - 25%</span>  
     
      </div>
    {/if}
      
      
    </div>
    {* {block name='product_flags'}
      <ul class="product-flags">
        {foreach from=$product.flags item=flag}
            {if $flag.type != 'discount'}
              <li class="{$flag.type}">
                {$flag.label}
              </li>
            {/if}
        {/foreach}
        {if $product.show_price}
            {if $product.has_discount}
              {if $product.discount_type === 'percentage'}
                <li class="product-discount">
                    <span class="discount-percen">{$product.discount_percentage}</span>
                </li>
              {/if}
            {/if}
        {/if}
      </ul>
    {/block} *}
  </div>

</article>

<script>
// document.addEventListener('DOMContentLoaded', function() {
//   var addButton = document.querySelectorAll('.add_to_cart_button .btn.btn-primary');
  

//   addButton.forEach((item) => {
//     var icon = item.querySelector('.add_to_cart i');

//     item.addEventListener('mouseover', function() {
//       icon.style.color = 'white';
//     });

//     item.addEventListener('mouseout', function() {
//       icon.style.color = ''; // Revert to the default color or remove this line if not needed
//     });
//   })

  
// });

</script>
