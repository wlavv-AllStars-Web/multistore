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
{extends file=$layout}

{block name='head' append}
  <meta property="og:type" content="product">
  {if $product.cover}
    <meta property="og:image" content="{$product.cover.large.url}">
  {/if}

  {if $product.show_price}
    <meta property="product:pretax_price:amount" content="{$product.price_tax_exc}">
    <meta property="product:pretax_price:currency" content="{$currency.iso_code}">
    <meta property="product:price:amount" content="{$product.price_amount}">
    <meta property="product:price:currency" content="{$currency.iso_code}">
  {/if}
  {if isset($product.weight) && ($product.weight != 0)}
  <meta property="product:weight:value" content="{$product.weight}">
  <meta property="product:weight:units" content="{$product.weight_unit}">
  {/if}
{/block}

{block name='head_microdata_special'}
  {include file='_partials/microdata/product-jsonld.tpl'}
{/block}

{block name='content'}

  <section id="main">
    <meta content="{$product.url}">

    <div class="row product-container js-product-container">
      <div class="col-md-6 left-side" >
        {block name='page_content_container'}
          <section class="page-content" id="content" >
            {block name='page_content'}
              {* {include file='catalog/_partials/product-flags.tpl'} *}

              {block name='product_cover_thumbnails'}
                {include file='catalog/_partials/product-cover-thumbnails.tpl'}
              {/block}
              <div class="scroll-box-arrows">
                <i class="material-icons left" >&#xE314;</i>
                <i class="material-icons right" >&#xE315;</i>
              </div>
              

            {/block}
          </section>
        {/block}
        </div>
        <div class="col-md-6 right-side" >
          {block name='page_header_container'}
            {block name='page_header'}
              <h1 class="h1">{block name='page_title'}{$product.name}{/block}</h1>
            {/block}
          {/block}

          {assign var="linkPayment" value=$link->getCMSLink(47)}
          {assign var="manufacturers" value=Manufacturer::getManufacturers()}

          <div class="subtitles-details">
            <div class="details-reference"><b>Reference:</b> {$product.reference}</div>
            {foreach from=$manufacturers item=item}
              {if $item.name === $product.manufacturer_name}
              <div class="details-brand"><b>Brand:</b> <span><a href="/brand/{$item.id_manufacturer}-{$item.link_rewrite}">{$product.manufacturer_name}</a></span></div>
              {/if}
            {/foreach}
            <div class="details-payment"><a href="{$linkPayment}">Pay in 3 or 4 Installment</a></div>
          </div>
          

          <div class="product-information">
            {* {block name='product_description_short'}
              <div id="product-description-short-{$product.id}" class="product-description">{$product.description_short nofilter}</div>
            {/block} *}

            {if $product.is_customizable && count($product.customizations.fields)}
              {block name='product_customization'}
                {include file="catalog/_partials/product-customization.tpl" customizations=$product.customizations}
              {/block}
            {/if}

            <div class="product-actions js-product-actions">
              {block name='product_buy'}
                <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                  <input type="hidden" name="token" value="{$static_token}">
                  <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
                  <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">
                  {* availability  and price *}
                  <div class="prices-availability" >
                  {block name='product_prices'}
                    {include file='catalog/_partials/product-prices.tpl'}
                  {/block}
                  {block name='product_availability'}
              
                    <span id="product-availability" class="js-product-availability" >
                      {if $product.show_availability && $product.availability_message}
                        {if $product.availability == 'available'}
                        {* <i class="material-icons rtl-no-flip product-available">&#xE5CA;</i> *}
                        
                        {elseif $product.availability == 'last_remaining_items'}
                          {* <i class="material-icons product-last-items">&#xE002;</i> *}
                          <div style="font-weight: 700;">Availability: <span style="background: #ff9a52;color:#f2f2f2;padding: 0.25rem 0.5rem;">{$product.availability_message}</span></div>
                          {else}
                            {* <i class="material-icons product-unavailable">&#xE14B;</i> *}
                            <div style="font-weight: 700;">Availability: <span style="background: #ee302e;color:#f2f2f2;padding: 0.25rem 1rem;">{$product.availability_message}</span>
                            <div class="tooltip" style="font-size: 1rem;width:15px;text-align:center;cursor:pointer;">?
                              <div class="tooltiptext">This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximate shipping date for this item.</div>
                            </div>
                            </div>
                          {/if}
                      {else}
                        <div style="font-weight: 700;">Availability: 
                          <span style="background: #5eac2d;color:#f2f2f2;padding: 0.25rem 0.5rem;">In Stock</span>
                          <div class="tooltip" onclick="OpenTooltip(this)" style="font-size: 1rem;width:15px;text-align:center;cursor:pointer;">?
                            <div class="tooltiptext">This product is in stock in our warehouses and will ship the same day if ordered before 12:30 or next weekday if ordered later</div>
                          </div>
                        </div>
                      {/if}
                    </span>
                    <script>
                      function OpenTooltip(element){
                        const tooltip = element;
                        const tooltipText = element.querySelector(".tooltiptext");
                        tooltipText.style.visibility = "visible";
                        document.body.addEventListener("click", function(event) {
                            // Check if the click is outside the tooltip
                            if (!tooltip.contains(event.target)) {
                                // If outside, hide the tooltip
                                tooltipText.style.visibility = "hidden";
                            }
                        });
                      }
                    </script>
                  {/block}
                  </div>

                  <div class="features_productdetails" >
                  {* features *}
                    <div class="product_features" >
                      {* <pre>{print_r($product.features,1)}</pre> *}
                      {foreach from=$product.features item=feature}
                        <div style="padding: 0.2rem 2rem;"><b>{$feature.name}:</b> {$feature.value}</div>
                      {/foreach}
                    </div>

                    <div class="product-details-options" >
                      
                      {block name='product_pack'}
                        {if $packItems}
                          <section class="product-pack">
                            <p class="h4">{l s='This pack contains' d='Shop.Theme.Catalog'}</p>
                            {foreach from=$packItems item="product_pack"}
                              {block name='product_miniature'}
                                {include file='catalog/_partials/miniatures/pack-product.tpl' product=$product_pack showPackProductsPrice=$product.show_price}
                              {/block}
                            {/foreach}
                        </section>
                        {/if}
                      {/block}

                      {block name='product_discounts'}
                        {include file='catalog/_partials/product-discounts.tpl'}
                      {/block}

                      {block name='product_variants'}
                        {include file='catalog/_partials/product-variants.tpl'}
                      {/block}

                      {block name='product_add_to_cart'}
                        {include file='catalog/_partials/product-add-to-cart.tpl'}
                      {/block}
                      
                    </div>
                  </div>
                  

                  {* {block name='product_additional_info'}
                    {include file='catalog/_partials/product-additional-info.tpl'}
                  {/block} *}

                  {* Input to refresh product HTML removed, block kept for compatibility with themes *}
                  {block name='product_refresh'}{/block}
                </form>
              {/block}

            </div>
{* 
            {block name='hook_display_reassurance'}
              {hook h='displayReassurance'}
            {/block} *}

        </div>



      </div>
    </div>
    <div class="hidden-md-down"
  style="border-bottom:4px solid #103054;border-top:4px solid #ee302e;padding-block:2px;width: 100%;margin:4rem 0 0 0"></div>
<div class="section_tabs_video" style="display: flex;{if empty($product.youtube_code)}justify-content:center;{/if}">
            {* inicio tabs *}
            <div class="column_tabs" style="width:100%">
            {block name='product_tabs'}
              {* <pre>{print_r($product,1)}</pre> *}
              <div class="tabs" style="background: #f6f6f6;margin-top:0;">
                <ul class="nav nav-tabs" role="tablist" style="display: flex;justify-content:space-between;">
                  {* {if $product.description} *}
                    <li class="nav-item">
                       <a
                         class="nav-link active js-product-nav-active"
                         data-toggle="tab"
                         href="#description"
                         role="tab"
                         aria-controls="description"
                         {if $product.description} aria-selected="true"{/if}>{l s='DESCRIPTION' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {* {/if} *}
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-toggle="tab"
                      href="#product-installation"
                      role="tab"
                      aria-controls="product-installation"
                      {if !$product.description} aria-selected="true"{/if}>{l s='INSTALLATION & FITMENT' d='Shop.Theme.Catalog'}</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-toggle="tab"
                      href="#compatibilities"
                      role="tab"
                      aria-controls="product-details"
                      {if !$product.description} aria-selected="true"{/if}>{l s='COMPATIBILITIES' d='Shop.Theme.Catalog'}</a>
                  </li>
                  {* {if $product.attachments}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#attachments"
                        role="tab"
                        aria-controls="attachments">{l s='Instructions' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if} *}
                  {foreach from=$product.extraContent item=extra key=extraKey}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#extra-{$extraKey}"
                        role="tab"
                        aria-controls="extra-{$extraKey}">{$extra.title}</a>
                    </li>
                  {/foreach}
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-toggle="tab"
                      href="#product_reviews"
                      role="tab"
                      aria-controls="product-details"
                      {if !$product.description} aria-selected="true"{/if}>{l s='REVIEWS' d='Shop.Theme.Catalog'}</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-toggle="tab"
                      href="#product_warranty"
                      role="tab"
                      aria-controls="product-details"
                      {if !$product.description} aria-selected="true"{/if}>{l s='WARRANTY' d='Shop.Theme.Catalog'}</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-toggle="tab"
                      href="#product_brand"
                      role="tab"
                      aria-controls="product-details"
                      {if !$product.description} aria-selected="true"{/if}>{$product.manufacturer_name}</a>
                  </li>
                </ul>
        
                {* tabs content *}
        
                <div class="tab-content" id="tab-content">
                 <div class="tab-pane fade in active" id="description" role="tabpanel">
                  {if $product.description}
                    <div class="banner-tabs" >
                      <img src="https://www.all-stars-motorsport.com/img/app_icons/description/99_en.webp" />
                    </div>
                    <div class="tab-description" style="display: flex;justify-content:center;">
                      {block name='product_description'}
                        <div class="product-description" style="{if empty($product.youtube_code)}width:90%;{else}width: 60%;{/if}">{$product.description nofilter}</div>
                      {/block}
                      {if !empty($product.youtube_code)}
                        <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
                          <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                            <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                            <img src="{$product.cover.large.url}" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
                              <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                                <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                              </div>
                            </div>
                            <div  class="iframeClass"  style="display:none;height:318px">
                              <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_code}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
                              </iframe>
                            </div>
                          </div>
                        </div>
                        {/if}
                    </div>
                    {* {if $product.features}
                      <div class="product_features">
                          {foreach from=$product.features item=feature}
                            <div style="padding: 0.5rem 1rem;"><b>{$feature.name}:</b> {$feature.value}</div>
                          {/foreach}
                        </div>
                        {/if} *}
                  {else}
                    <div class="banner-tabs" >
                      <img src="https://www.all-stars-motorsport.com/img/app_icons/description/99_en.webp" />
                    </div>
                    <div class="tab-description" style="display: flex;">
                      {block name='product_description'}
                        <div class="product-description" style="{if empty($product.youtube_code)}width:90%;{else}width: 60%;{/if}">
                          <p>{l s='No description.' d='Shop.Theme.Catalog'}</p>
                        </div>
                      {/block}
                      {if !empty($product.youtube_code)}
                        <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
                          <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                            <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                            <img src="{$product.cover.large.url}" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
                              <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                                <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                              </div>
                            </div>
                            <div  class="iframeClass"  style="display:none;height:318px">
                              <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_code}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
                              </iframe>
                            </div>
                          </div>
                        </div>
                        {/if}
                      {* fim tabs *}
                      
                    </div>

                  {/if}
                  <script>
                      addEventListener("DOMContentLoaded", (event) => {
                        const videoProduct =  document.querySelector(".column_video .video");
                        const imgPlay = document.querySelector(".image_play")
                        if(videoProduct && imgPlay){
                          videoProduct.addEventListener('mouseover', () => {
                            imgPlay.setAttribute('src', "/img/youtube_play_hover.png")
                          });
                          videoProduct.addEventListener('mouseleave', () => {
                            imgPlay.setAttribute('src', "/img/youtube_play.png")
                          });
                        }
                        
                      });
                      </script>
                 </div>
        
                 {* <div class="tab-pane fade in" id="product-installation" role="tabpanel">
                   <div>product-installation</div>
                 </div> *}
                 
        
                 <div class="tab-pane fade in" id="compatibilities" role="tabpanel">
                    <div class="banner-tabs" >
                      <img src="https://www.all-stars-motorsport.com/img/app_icons/compatibilities_en.webp" />
                    </div>
                   <div>{hook h='displayProductTabContent' mod='ukoocompat' id_module=124}</div>
                 </div>
        
                 {* {block name='product_details'}
                   {include file='catalog/_partials/product-details.tpl'}
                 {/block} *}
        
                 {block name='product_attachments'}
                   {if $product.attachments}
                    <div class="tab-pane fade in" id="product-installation" role="tabpanel">
                    <div class="banner-tabs" >
                      <img src="https://www.all-stars-motorsport.com/img/app_icons/instructions_en.webp" />
                    </div>
                       <section class="product-attachments">
                         {* <p class="h5 text-uppercase">{l s='Download Instructions' d='Shop.Theme.Actions'}</p> *}
                         {foreach from=$product.attachments item=attachment}
                           <div class="attachment">
                             {* <h4><a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">{$attachment.name}</a></h4> *}
                             {* <p>{$attachment.description}</p> *}
                             <a class="btn_downloadInstructions" href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
                               {l s='Download Instructions' d='Shop.Theme.Actions'}
                             </a>
                           </div>
                         {/foreach}
                       </section>
                     </div>
                    {else}
                     
                      <div class="tab-pane fade in" id="product-installation" role="tabpanel">
                        <div class="banner-tabs" >
                          <img src="https://www.all-stars-motorsport.com/img/app_icons/instructions_en.webp" />
                        </div>
                        <p>{l s='No Instructions' d='Shop.Theme.Actions'}</p>
                      </div>
                   {/if}
                 {/block}
        
                 {foreach from=$product.extraContent item=extra key=extraKey}
                 <div class="tab-pane fade in {$extra.attr.class}" id="extra-{$extraKey}" role="tabpanel" {foreach $extra.attr as $key => $val} {$key}="{$val}"{/foreach}>
                   {$extra.content nofilter}
                 </div>
                 {/foreach}
        
                 <div  class="tab-pane fade in" id="product_reviews"  role="tabpanel">
                  <div class="banner-tabs" >
                    <img src="https://www.all-stars-motorsport.com/img/app_icons/reviews_en.webp" />
                  </div>
                  {hook h='displayFooterProduct' product=$product category=$category}
                 </div>
                 <div  class="tab-pane fade in" id="product_warranty"  role="tabpanel">
                  <div class="banner-tabs" >
                    <img src="https://www.all-stars-motorsport.com/img/app_icons/warranty_en.webp" />
                  </div>
                  <p>Product Warranty</p>
                 </div>
                 <div  class="tab-pane fade in" id="product_brand"  role="tabpanel">
                  <div class="banner-tabs" >
                      <img src="https://www.all-stars-motorsport.com/img/app_icons/instructions_en.webp" />
                  </div>
                  <h4 style="padding: 1rem;">Product Manufacturer</h4>
                  <div style="padding: 1rem;">{$product_manufacturer->description|strip_tags|replace:'<p>':''|replace:'</p>':''}</div>
                  {* <pre>{print_r($product_manufacturer->description,1)}</pre> *}
                 </div>
        
              </div>
              </div>
            {/block}

            </div>
            {* {if !empty($product.youtube_code)}
            <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
              <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                <img src="{$product.cover.large.url}" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
                  <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                    <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                  </div>
                </div>
                <div  class="iframeClass"  style="display:none;height:318px">
                  <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_code}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
                  </iframe>
                </div>
              </div>
            </div>
            {/if} *}
          {* fim tabs *}
          {* <script>
          addEventListener("DOMContentLoaded", (event) => {
            const videoProduct =  document.querySelector(".column_video .video");
            const imgPlay = document.querySelector(".image_play")
            
              videoProduct.addEventListener('mouseover', () => {
                imgPlay.setAttribute('src', "/img/youtube_play_hover.png")
              });
              videoProduct.addEventListener('mouseleave', () => {
                imgPlay.setAttribute('src', "/img/youtube_play.png")
              });
            
          });
          </script> *}
          <script>
          document.addEventListener("DOMContentLoaded", (event) => {
            const arrowsImgs = document.querySelector(".scroll-box-arrows")
            if(screen.width > 600){
              arrowsImgs.style.display = "none";
            }
          })
          </script>
</div>
<div class=""
style="border-bottom:4px solid #103054;border-top:4px solid #ee302e;padding-block:2px;width: 100%;margin:0 0 4rem 0"></div>



    {block name='product_accessories'}
      {if $accessories}
        <section class="product-accessories clearfix" style="margin-top: 4rem;">
          <p class="h5 text-uppercase">{l s='You might also like' d='Shop.Theme.Catalog'}</p>
          <div class="products row">
            {foreach from=$accessories item="product_accessory" key="position"}
              {if $position < 4}
                {block name='product_miniature'}
                  {include file='catalog/_partials/miniatures/product.tpl' product=$product_accessory position=$position productClasses="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
                {/block}
              {/if}
            {/foreach}
          </div>
        </section>
      {/if}
    {/block}

    {* {block name='product_footer'}
      {hook h='displayFooterProduct' product=$product category=$category}
    {/block} *}

    {block name='product_images_modal'}
      {include file='catalog/_partials/product-images-modal.tpl'}
    {/block}

    {block name='page_footer_container'}
      <footer class="page-footer">
        {block name='page_footer'}
          <!-- Footer content -->
        {/block}
      </footer>
    {/block}
  </section>

{/block}
