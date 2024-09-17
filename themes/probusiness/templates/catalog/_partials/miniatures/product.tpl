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
 {* <pre>{print_r($product.id_product_attribute,1)}</pre> *}
 {block name='product_miniature_item'}
 <div class="js-product product{if !empty($productClasses)} {$productClasses}{/if}" style="padding:0;">
 
 <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" style="display: flex;width:100%;height:139px;{if $position%2!=0}border-left: 2px solid #0273EB{/if}" >
 
     <div class="thumbnail-container" style="display: flex;align-items:center;">
     
       <div class="thumbnail-top col-lg-2 col-md-2 col-sm-6 col-xs-6 px-0" style="display: flex !important;justify-content:center;" >
         {block name='product_thumbnail'}
           {if $product.cover}
             <a href="{$product.url}" class="thumbnail product-thumbnail">
               <picture>
                 <img
                   src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, 'thumb')}"
                   alt="{$product.name|truncate:30:'...'}"
                   loading="lazy"
                   data-full-size-image-url="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer)}"
                   width="125"
                   height="125"
                   style="width:125px;height:auto;border: 2px solid #dedede;"
                 />
               </picture>
             </a>
           {else}
             <a href="{$product.url}" class="thumbnail product-thumbnail">
               <picture>
                 <img
                   src="{$link->getImageLink($product.reference, $product.id_image, null, 'jpg', $product.id_product, $product.id_manufacturer, 'thumb')}"
                   loading="lazy"
                   width="125"
                   height="125"
                   style="width:125px;height:auto;border: 2px solid #dedede;"
                 />
               </picture>
             </a>
           {/if}
         {/block}
       </div>
 
       <div class="col-lg-10 col-md-12 bottom-product" style="display: flex;flex-direction:column;height:100%;">
         <div class="col-lg-12 px-0 bottom-product-container" style="display: flex;align-items:center;flex:1;">
          <div class="information-product col-lg-8 col-md-8 col-sm-12 col-xs-12 px-0" onclick="window.location.href='{$product.url}'">
                {* <div class="btn-catalog-brand"><img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/xlsx_updated.png" style=" height: auto; width: 100%;"></div> *}
              <div class="brand-product" style="font-weight: 700;font-size:16px;line-height:18px;color:#111;text-transform:uppercase;" >{$product.manufacturer_name}</div>
              <div class="referencia" style="font-weight: 400;font-size:16px;line-height:18px;color: #0273EB;">{$product.reference}</div>
              {block name='product_name'}
                {if $page.page_name == 'index'}
                  <h3 class="h3 product-title-list"><a href="{$product.url}" content="{$product.url}" style="font-weight: 400;font-size:16px;line-height:18px;color:#444;" title="{$product.name}">{$product.name}</a></h3>
                {else}
                  <h2 class="h3 product-title-list"><a href="{$product.url}" content="{$product.url}" style="font-weight: 400;font-size:16px;line-height:18px;color:#444;" title="{$product.name}">{$product.name}</a></h2>
                {/if}
              {/block}
    
          </div>
            
          <div class="product-description col-lg-4 col-md-4 col-sm-12 col-xs-12 pr-0" >
    
            {block name='product_price_and_shipping'}
              {if $product.show_price}
                <div class="product-price-and-shipping" style="display: flex;flex-direction:column;align-items:end;">
                  {* {if $product.has_discount}
                    {hook h='displayProductPriceBlock' product=$product type="old_price"}
                    <div class="old_price" style="display: flex;align-items:center;gap:0.5rem;font-size:12px;line-height:21px;font-weight:700;justify-content:center;">
                    {l s="RRP / PVP" d="Shop.Theme.ProductList"}
                    <span class="regular-price" aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}" style="font-size: 14px;line-height:21px;font-weight:400;color:#000;margin-bottom:0;text-decoration:unset;">{$product.regular_price}</span>
                    </div>
                    {if $product.discount_type === 'percentage'}
                      <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                    {elseif $product.discount_type === 'amount'}
                      <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                    {/if}
                  {/if}
    
                  <div class="discount" style="font-size: 12px;font-weight:700;line-height:21px;">{l s="Discount:" d="Shop.Theme.ProductList"}<span style="font-size: 14px;font-weight:400;line-height:24px;margin:0;">{$product.discount_percentage}</span></div>
                  {hook h='displayProductPriceBlock' product=$product type="before_price"}
    
                  <span class="price" aria-label="{l s='Price' d='Shop.Theme.Catalog'}" style="font-size: 21px;font-weight:700;line-height:26px;margin:0;">
                    {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
                    {if '' !== $smarty.capture.custom_price}
                      {$smarty.capture.custom_price nofilter}
                    {else}
                      {$product.price}
                    {/if}
                  </span> *}
                  <div style="font-size: 16px;padding: 3px 0;display:flex;align-items:center;gap:0.25rem;line-height:18px;font-weight:400;color:#444;" class="list-name">
                    <div style="text-transform: uppercase;">{l s='Stock' d="Shop.Theme.ProductList"}:</div>
                    {if ($product.quantity == 1) }
                          <div style="color: orange;font-weight:600;font-size:16px;">{$product.quantity}</div>
                    {elseif ($product.quantity > 1) }
                        <div style="color: green;font-weight:600;font-size:16px;">{$product.quantity}</div>
                    {elseif $product.quantity < 1 }
                          <div style="color: red;font-weight:600;font-size:16px;">0</div>
                    {/if}
                  </div>

                  {* <div class="btn-product-details">
                    <a href="{$product.url}">{l s='Details' d="Shop.Theme.ProductList"}</a>
                  </div> *}
    
                  {hook h='displayProductPriceBlock' product=$product type='unit_price'}
    
                  {hook h='displayProductPriceBlock' product=$product type='weight'}
    
                  
                  {if $product.id_product_attribute == 0}
                  {* <pre>{print_r($product.id_product_attribute,1)}</pre> *}
                  <div class="product-actions js-product-actions">
                  {block name='product_buy'}
                    {* <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                      <input type="hidden" name="token" value="{$static_token}">
                      <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
                    <div class="product-quantity">
    
                        <input type="number" name="quantity" value="1" min="1" max="{$product.quantity}" class="product-quantity-input" />
                        <span class="plus">+</span>
                        <span class="minus">-</span>
                        <button class="add-to-cart" data-id-product="{$product.id_product}" data-button-action="add-to-cart">Add to Cart</button>
                    
                    </div>
                    </form> *}
    
                    {* <pre>{$urls.pages|print_r}</pre> *}
                    <div class="product-add-to-cart js-product-add-to-cart">
                      <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                      <input type="hidden" name="token" value="{$static_token}">
                      <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
                      <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">
                      
                        {block name='product_quantity'}
                          <div class="product-quantity clearfix">
                            <div class="qty">
                              <input
                                type="number"
                                name="qty"
                                id="quantity_wanted"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                {if $product.quantity_wanted}
                                  value="{$product.quantity_wanted}"
                                  min="{$product.minimal_quantity}"
                                {else}
                                  value="1"
                                  min="1"
                                {/if}
                                class="input-group"
                                aria-label="{l s='Quantity' d='Shop.Theme.Actions'}"
                              >
                            </div>
                    
                            <div class="add">
                              <button
                                class="btn btn-primary add-to-cart"
                                data-button-action="add-to-cart"
                                type="submit"
                                {if !$product.add_to_cart_url}
                                  disabled
                                {/if}
                                style="display: flex;"
                              >
                                <i class="material-icons shopping-cart" style="margin-right: 0;">&#xE547;</i>
                              </button>
                            </div>
                          
                          {* {hook h='displayProductActions' product=$product} *}
                        </div>
                      {/block}
                          

    
                      {block name='product_refresh'}{/block}
                    </form>
                    </div>
                    {* <form action="{$urls.pages.cart}" method="post" class="mini-form-add">
                        <input type="hidden" name="token" value="{$static_token}">
                        <input type="hidden" value="{$product.id_product}" name="id_product">
                        {if $product.add_to_cart_url}
                            <div class="add-to-cart-input-group">
                                <div class="qty">
                                    <span class="minus">-</span>
                                    <input type="number" class="count" name="qty" min="1" value="1">
                                    <span class="plus">+</span>
                                </div>
    
                                <button data-button-action="add-to-cart" class="btn btn-primary btn-mini-add" {if !$product.add_to_cart_url}disabled{/if}>
                                    {l s='Add to cart' d='Shop.Theme.Actions'}
                                </button>
    
                            </div>
                        {/if}
                    </form> *}
                  {/block}
    
                </div>
                {else}
                  <div style="color: #0273EB;">
                    {l s="More variations available" d="Shop.Theme.Productlist"}
                  </div>
                {/if}
                  
                </div>
              {/if}
            {/block}
    
            {* {block name='product_reviews'}
              {hook h='displayProductListReviews' product=$product}
            {/block} *}
          </div>
        </div>

        <div class="product-prices-bottom col-lg-12 px-0" style="display: flex;justify-content:space-between;padding-top: 0.25rem;cursor:pointer;"  onclick="window.location.href='{$product.url}'">
          {* {if $product.has_discount} *}
            {hook h='displayProductPriceBlock' product=$product type="old_price"}
            <div class="old_price" style="display: flex;align-items:center;gap:0.5rem;font-size:16px;font-weight:400;justify-content:center;color:#444;">
            {l s="RRP / PVP" d="Shop.Theme.ProductList"}
            <span class="regular-price" aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}" style="font-size: 16px;font-weight:600;color:#444;margin-bottom:0;text-decoration: line-through;">{$product.price_without_reduction_without_tax|number_format:2}€</span>
            </div>

          {* {/if} *}

          <div class="discount" style="color:#444;font-size: 16px;font-weight:400;line-height:21px;text-transform:uppercase;display:flex;align-items:center;">{l s="Discount:" d="Shop.Theme.ProductList"}<span style="font-size: 16px;font-weight:400;line-height:24px;margin:0;">{$product.discount_percentage}</span></div>
          {hook h='displayProductPriceBlock' product=$product type="before_price"}

          {if $product.id_product_attribute == 0}
          <span class="price" aria-label="{l s='Price' d='Shop.Theme.Catalog'}" style="line-height:26px;margin:0;display:flex;align-items:center;gap:0.5rem">
            {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
            {if '' !== $smarty.capture.custom_price}
              {l s="Price" d="Shop.Theme.ProductList"}: {$smarty.capture.custom_price nofilter}
            {else}
              <span style="font-size:16px;color: #444;text-transform:uppercase;">{l s="Price" d="Shop.Theme.ProductList"}:</span> <span style="font-size: 21px;font-weight:700;color:#0273EB;">{($product.price_without_reduction_without_tax - $product.reduction_without_tax)|number_format:2}€</span>
            {/if}
          </span>
          {else}
            <span class="price" aria-label="{l s='From' d='Shop.Theme.Catalog'}" style="line-height:26px;margin:0;display:flex;align-items:center;gap:0.5rem">
            {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
            {if '' !== $smarty.capture.custom_price}
              {l s="From" d="Shop.Theme.ProductList"}: {$smarty.capture.custom_price nofilter}
            {else}
              <span style="font-size:16px;color: #444;text-transform:uppercase;">{l s="From" d="Shop.Theme.ProductList"}:</span> <span style="font-size: 21px;font-weight:700;color:#0273EB;">{($product.price_without_reduction_without_tax - $product.reduction_without_tax)|number_format:2}€</span>
            {/if}
          </span>
          {/if}
        </div>

       </div>

       
 
       {* {include file='catalog/_partials/product-flags.tpl'} *}
     </div>
   </article>
 </div>
{* {debug} *}
 <script>
  if(window.screen.width <= 992){
    if(document.querySelectorAll('.product-miniature')){
      document.querySelectorAll('.product-miniature').forEach(function(article) {
        article.addEventListener('click', function(event) {
            // If the click was inside the product-description, do nothing
            if (!event.target.closest('.product-description')) {
                window.location.href = '{$product.url}';
            }
        });
      });
    }
  }
  

 </script>

 {* <pre>{$product|print_r}</pre> *}
 {/block}
 