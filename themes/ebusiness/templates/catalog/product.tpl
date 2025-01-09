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
  {* <pre>{$product|print_r}</pre> *}
 
   <section id="main">
     <meta content="{$product.url}">
     {* <pre style="background: #fff;">{$product|print_r}</pre> *}
     {if $email_sent == 1}
      <div class="container-alert-askquestion">
      <div class="alert alert-success" role="alert">
        Question sent successfully!
      </div>
      </div>
     {/if}
     <div class="row product-container js-product-container">
        <div class="col-md-6 left-side desktop product-imgs-section">
         {block name='page_content_container'}
           <section class="page-content" id="content" >
             {block name='page_content'}
               {* {include file='catalog/_partials/product-flags.tpl'} *}
              
               {block name='product_cover_thumbnails'}
                 {include file='catalog/_partials/product-cover-thumbnails.tpl'}
               {/block}
               {* <div class="scroll-box-arrows">
                <i class="material-icons left">&#xE314;</i>
                <i class="material-icons right">&#xE315;</i>
                </div> *}
               
 
             {/block}
           </section>
         {/block}
         </div>

         <div class="container-imgs-mobile mobile">
         {* <h1>{$product.name}</h1> *}
         {block name='page_content'}
          {* <div class="swiper mySwiper">
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
          </div> *}
          {block name='product_cover_thumbnails'}
            {include file='catalog/_partials/product-cover-thumbnails.tpl'}
          {/block}
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
{*  
           <div class="subtitles-details">

            {block name='product_details'}
              {include file='catalog/_partials/product-details.tpl'}
            {/block} *}

            {* <div class="subtitles-details-left">
              <div class="details-reference product-reference"><b>Reference:</b> {$product.reference_to_display}</div>
              <div class="details-ec"><b>EC Approved:</b> <span class="not-aproved">No</span></div>
            </div> *}



            {* <div class="subtitles-details-right">
            {block name='product_availability'}
               
              <span id="product-availability" class="js-product-availability" >
                {if $product.show_availability && $product.availability_message}
                  {if $product.availability == 'available'}
            
                  
                  {elseif $product.availability == 'last_remaining_items'}
                   
                    <div>Availability: <span style="background: #ff9a52;color:#f2f2f2;padding: 0.25rem 0.5rem;">{$product.availability_message}</span></div>
                    {else}
                   
                      <div>Availability: <span style="background: #ee302e;color:#f2f2f2;padding: 0.25rem 1rem;">{$product.availability_message}</span>
                      <div class="tooltip" style="font-size: 1rem;width:15px;text-align:center;cursor:pointer;">?
                        <div class="tooltiptext">This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximate shipping date for this item.</div>
                      </div>
                      </div>
                    {/if}
                {else}
                  <div >Availability: 
                    <span style="background: #88f941;color: #3a3a34;padding: 0.25rem 0.5rem;font-size:14px;font-weight: 600;">In Stock</span>
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
                     
                      if (!tooltip.contains(event.target)) {
                         
                          tooltipText.style.visibility = "hidden";
                      }
                  });
                }
              </script>
            {/block}
              <div>Shipped from EU</div>
            </div>

           </div> *}

           {block name='product_details'}
            {include file='catalog/_partials/product-details.tpl'}
          {/block}
           
 
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


                   </div>
 
                   <div class="features_productdetails" >
                   {* features *}
                     {* <div class="product_features" >
                       
                       {foreach from=$product.features item=feature}
                         <div style="padding: 0.2rem 2rem;"><b>{$feature.name}:</b> {$feature.value}</div>
                       {/foreach}
                     </div> *}
 
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
                   {/block}
  *}
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

     <div class="d-mobile description-product-mobile">
      {if $product.description}
        <div class="banner-tabs" >
          <img src="/img/asm/banners/description/{$product_manufacturer->id}_{$language.iso_code}.webp" />
        </div>
        <div class="tab-description tab" style="display: flex;justify-content:center;flex-direction:column;padding:1rem;color:#333;">
          {block name='product_description'}
            <div class="product-description">{$product.description nofilter}</div>
          {/block}
          {if !empty($product.youtube_code)}
            <div class="column_video" style="display:flex;justify-content:center;align-items:center;margin:2rem 0;">
              <div class="video3 video" style="width:480px;border-radius: 0.25rem;overflow: hidden;">
                <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                <img src="https://i3.ytimg.com/vi/{$product.youtube_code}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
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
            <small style="text-align: center;">Content protected by copyright © 2024 - All rights reserved</small>
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
          <img src="/img/asm/banners/description/{$product_manufacturer->id}_{$language.iso_code}.webp" />
        </div>
        <div class="tab-description tab" style="display: flex;">
          {block name='product_description'}
            <div class="product-description" style="{if empty($product.youtube_code)}width:90%;{else}width: 60%;{/if}">
              <p>{l s='No description.' d='Shop.Theme.Catalog'}</p>
            </div>
          {/block}
          {if !empty($product.youtube_code)}
            <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
              <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                <img src="https://i3.ytimg.com/vi/{$product.youtube_code}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
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
     </div>

      <div class="d-mobile section-content-product" style="margin-top: 1rem;flex-direction:column;gap:.25rem;">
        <div class="container-compat-mobile" style="flex-direction: column;width:100%;">
          <div class="nav-link" data-toggle="collapse" href="#compatMobile" role="button" aria-expanded="false" aria-controls="compatMobile" style="width: 100%;background: #fff;text-align:center;">
            {l s='COMPATIBILITIES' d='Shop.Theme.Catalog'}
          </div>
        
          <div class="collapse container-drop" id="compatMobile">
            
            <div class="banner-tabs" >
              <img src="/img/asm/banners/compatibilities/compatibilities_{$language.iso_code}.webp" />
            </div>
                    {* <div class="tab">{hook h='displayProductTabContent' mod='ukoocompat' id_module=124}</div> *}

            <div class="container-table-compats">
              {* {hook h='displayProductTabContent' mod='ukoocompat'} *}
              <table class="table table-bordered table-compats" style="max-width: 1350px;width:100%;margin:2rem auto;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Brand</th>
                    <th scope="col">Model</th>
                    <th scope="col">Type</th>
                    <th scope="col">Version</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Audi</td>
                    <td>A3</td>
                    <td>8V / 8.5V - 12-20</td>
                    <td>2.0 TFSI - 190 / 220</td>
                  </tr>
                </tbody>
              </table>
            </div>



          </div>
        </div>
        
        <div class="container-shipping-mobile" style="flex-direction: column;width:100%;">
          <div class="nav-link" data-toggle="collapse" href="#shippingMobile" role="button" aria-expanded="false" aria-controls="shippingMobile" style="width: 100%;background: #fff;text-align:center;">
            {l s='SHIPPING' d='Shop.Theme.Catalog'}
          </div>
        
          <div class="collapse container-drop" id="shippingMobile">
            
            <div class="banner-tabs" >
              <img src="/img/asm/banners/shipping/shipping_{$language.iso_code}.webp" />
            </div>
            <div class="tab">
              {hook h='extraRight' mod='totshippingpreview' mobile=1}
            </div>

          </div>
        </div>


        <div class="container-instructions-mobile" style="flex-direction: column;width:100%;">
          <div class="nav-link" data-toggle="collapse" href="#instructionsMobile" role="button" aria-expanded="false" aria-controls="instructionsMobile" style="width: 100%;background: #fff;text-align:center;">
            {l s='INSTRUCTIONS' d='Shop.Theme.Catalog'}
          </div>
        
          <div class="collapse container-drop" id="instructionsMobile">
            
          {block name='product_attachments'}
            {if $product.attachments}
             <div class="tab-pane fade in" id="product_instructions_mobile" role="tabpanel">
                <div class="banner-tabs" >
                  <img src="/img/asm/banners/instructions/instructions_{$language.iso_code}.webp" />
                </div>
                <section class="product-attachments tab">
                  {* <p class="h5 text-uppercase">{l s='Download Instructions' d='Shop.Theme.Actions'}</p> *}
                  {foreach from=$product.attachments item=attachment}
                    <div class="attachment">
                      {* <h4><a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">{$attachment.name}</a></h4> *}
                      {* <p>{$attachment.description}</p> *}
                      <a class="btn_downloadInstructions" href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
                        {l s='Download Instructions' d='Shop.Theme.Actions'}
                      </a>

                      <div class="difficulty-level">
                        <span>Difficulty Level:</span>
                        <img src="https://www.all-stars-motorsport.com/img/app_icons/difficulty_3.webp" />
                      </div>
                    </div>
                  {/foreach}
                </section>
              </div>
            {else}

              
              
               <div class="tab-pane fade in" id="product_instructions_mobile" role="tabpanel">
                 <div class="banner-tabs" >
                   <img src="/img/asm/banners/instructions/instructions_{$language.iso_code}.webp" />
                 </div>
                 {* <div class="class_instructions" style="display: flex;gap:1rem;align-items:center;justify-content:center;padding:2rem;font-size:1rem;color:#333;">
                  <p class="tab" style="margin-bottom: 0;">{l s='No Instructions' d='Shop.Theme.Actions'}</p>
                  <div class="separator-line" style="height:50px;width:3px; background:#b3b3b3;"></div>
                  <div class="difficulty-level">
                          <span>Difficulty Level:</span>
                          <img src="https://www.all-stars-motorsport.com/img/app_icons/difficulty_{$product.difficulty}.webp" />
                    </div>
                 </div> *}

                <div style="text-align: center;display:flex;justify-content:center; min-width: 800px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;height:fit-content;margin:3rem 0;gap:2rem;">
                      <h4 style="font-size:18px;margin:0;text-transform:uppercase;font-weight:500;">No Instructions</h4>
                    {if $product.difficulty > 0}
                      <div class="verticalLign" style="height:50px;width:3px; background:#b3b3b3;"></div>
                      <div class="difficulty_content" style="display:flex;align-items:center;gap:2rem;">
                          <h4 style="margin:0;text-transform:uppercase;font-weight:500;">Difficulty Level:</h4>
                          <img src="/img/asm/difficulty/difficulty_{$product.difficulty}.webp" alt="Difficulty{$product.difficulty}" style="height:fit-content;">
                      </div>
                    {/if}
                    </div>
                </div>

               </div>
            {/if}
          {/block}

          </div>
        </div>

        <div class="container-askquestion-mobile" style="flex-direction: column;width:100%;">
          <div class="nav-link" data-toggle="collapse" href="#askquestionMobile" role="button" aria-expanded="false" aria-controls="askquestionMobile" style="width: 100%;background: #fff;text-align:center;">
            {l s='ASK A QUESTION' d='Shop.Theme.Catalog'}
          </div>
        
          <div class="collapse container-drop" id="askquestionMobile">
            
            <div class="banner-tabs" >
                <img src="/img/asm/banners/faq/faq_{$language.iso_code}.webp" />
            </div>

            {if $email_sent == 1}
              <div class="container_ask_successfull">
                <div class="question_buble">

                  <i class="material-icons question-success-icon">check_circle</i>
                  <h1 class="question-success-title">IMPRESSIONNANT!</h1>
                  <i class="material-icons close-question" onclick="closeQuestionBuble()">close</i>
                </div>
                <div class="question-success-msg" >Please, check your mailbox from time to time. We will respond you as soon as possible.</div>
                <div class="btn_close_message_ask" onclick="closeQuestionBuble()">
                  Close
                </div>
              </div>

            {else}
              
              
              <form class="form-askquestion col-lg-9 tab" action="{$link->getPageLink('product', true)}" method="post">

              <div class="form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="material-icons">person</i></span>
                </div>
                <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp" placeholder="Name" name="name_customer" value="{if $customer.is_logged}{$customer.firstname} {$customer.lastname}{/if}">
              </div>
              <div class="form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="material-icons">email</i></span>
                </div>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email_customer" value="{if $customer.is_logged}{$customer.email}{/if}">
              </div>
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your question." name="question_customer"></textarea>
              </div>

              <button type="submit" class="btn btn-primary">
                Submit
                <input type="hidden" name="id_lang" value="{$language.id|escape:'htmlall':'UTF-8'}">
                <input type="hidden" name="id_shop" value="{$shop.id|escape:'htmlall':'UTF-8'}">
                <input type="hidden" name="product_askquestion" value="1">
                <input type="hidden" name="id_product" value="{$product.id}">
                <input type="hidden" name="category" value="">
              </button>
            
              </form>
            {/if}

          </div>
        </div>

        <div class="container-reviews-mobile" style="flex-direction: column;width:100%;">
          <div class="nav-link" data-toggle="collapse" href="#reviewsMobile" role="button" aria-expanded="false" aria-controls="reviewsMobile" style="width: 100%;background: #fff;text-align:center;">
            {l s='Reviews' d='Shop.Theme.Catalog'}
          </div>
        
          <div class="collapse container-drop" id="reviewsMobile">
            <div class="banner-content">
              {block name='product_miniature_item'}
                {block name='product_reviews'}
                  {hook h='displayFooterProduct' mod='productcomments'  product=$product  category=$category}
                {/block}
              {/block}
            </div>
          </div>
        </div>

      </div>

      <div class="section_tabs_video d-desktop" style="display: flex;{if empty($product.youtube_code)}justify-content:center;{/if}">
             {* inicio tabs *}
             <div class="column_tabs" style="width:100%">
             {block name='product_tabs'}
               {* <pre>{print_r($product,1)}</pre> *}
               <div class="tabs" style="background: #f6f6f6;margin-top:0;">
                 <ul class="nav nav-tabs" role="tablist">
                   {* {if $product.description} *}
                     <li class="nav-item d-desktop">
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
                       href="#compatibilities"
                       role="tab"
                       aria-controls="product-details"
                       {if !$product.description} aria-selected="true"{/if}>{l s='COMPATIBILITIES' d='Shop.Theme.Catalog'}</a>
                   </li>
                   <li class="nav-item">
                     <a
                       class="nav-link"
                       data-toggle="tab"
                       href="#product_shipping"
                       role="tab"
                       aria-controls="product-details"
                       {if !$product.description} aria-selected="true"{/if}>{l s='SHIPPING' d='Shop.Theme.Catalog'}</a>
                   </li>
                   <li class="nav-item">
                     <a
                       class="nav-link"
                       data-toggle="tab"
                       href="#product_instructions"
                       role="tab"
                       aria-controls="product_instructions"
                       {if !$product.description} aria-selected="true"{/if}>{l s='INSTRUCTIONS' d='Shop.Theme.Catalog'}</a>
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

                   {if $product_manufacturer->warranty}
                   <li class="nav-item">
                     <a
                       class="nav-link"
                       data-toggle="tab"
                       href="#product_warranty"
                       role="tab"
                       aria-controls="product-details"
                       {if !$product.description} aria-selected="true"{/if}>{l s='Warranty' d='Shop.Theme.Catalog'}</a>
                   </li>
                  {/if}

                   <li class="nav-item">
                     <a
                       class="nav-link"
                       data-toggle="tab"
                       href="#product_askquestion"
                       role="tab"
                       aria-controls="product-details"
                       {if !$product.description} aria-selected="true"{/if}>{l s='ASK A QUESTION' d='Shop.Theme.Catalog'}</a>
                   </li>
                   <li class="nav-item mobile">
                     <a
                       class="nav-link"
                       data-toggle="tab"
                       href="#product_reviews"
                       role="tab"
                       aria-controls="product_reviews"
                       {if !$product.description} aria-selected="true"{/if}>{l s='Reviews' d='Shop.Theme.Catalog'}</a>
                   </li>
                   
                 </ul>
         
                 {* tabs content *}
                 {* {$language['iso_code']} *}
                 <div class="tab-content" id="tab-content">
                  <div class="tab-pane fade in active" id="description" role="tabpanel">
                  {* {debug} *}
                   {if $product.description}
                     <div class="banner-tabs" >
                       <img src="/img/asm/banners/description/{$product_manufacturer->id}_{$language.iso_code}.webp" />
                     </div>
                     <div class="tab-description tab" style="display: flex;justify-content:center;flex-direction:column;padding:1rem;color:#333;">
                       {block name='product_description'}
                         <div class="product-description">{$product.description nofilter}</div>
                       {/block}
                       <div class="videos-container" style="display: flex;gap: 1rem;">
                        {if !empty($product.youtube_code)}
                         <div class="column_video" style="display:flex;justify-content:center;align-items:center;margin:2rem 0;">
                           <div class="video3 video" style="width:480px;border-radius: 0.25rem;overflow: hidden;">
                             <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                             <img src="https://i3.ytimg.com/vi/{$product.youtube_code}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
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
                        {if !empty($product.youtube_2)}
                         <div class="column_video" style="display:flex;justify-content:center;align-items:center;margin:2rem 0;">
                           <div class="video3 video" style="width:480px;border-radius: 0.25rem;overflow: hidden;">
                             <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                             <img src="https://i3.ytimg.com/vi/{$product.youtube_2}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
                               <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                                 <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                               </div>
                             </div>
                             <div  class="iframeClass"  style="display:none;height:318px">
                               <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_2}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
                               </iframe>
                             </div>
                           </div>
                         </div>
                        {/if}
                       </div>
                         <small style="text-align: center;">Content protected by copyright © 2024 - All rights reserved</small>
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
                      <img src="/img/asm/banners/description/{$product_manufacturer->id}_{$language.iso_code}.webp" />
                     </div>
                     <div class="tab-description tab" style="display: flex;">
                       {block name='product_description'}
                         <div class="product-description" style="{if empty($product.youtube_code)}width:90%;{else}width: 60%;{/if}">
                           <p>{l s='No description.' d='Shop.Theme.Catalog'}</p>
                         </div>
                       {/block}
                       {if !empty($product.youtube_code)}
                         <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
                           <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                             <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                             <img src="https://i3.ytimg.com/vi/{$product.youtube_code}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
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
                       <img src="/img/asm/banners/compatibilities/compatibilities_{$language.iso_code}.webp" />
                     </div>
                    {* <div class="tab">{hook h='displayProductTabContent' mod='ukoocompat' id_module=124}</div> *}

                    <div class="container-table-compats">
                      {* {hook h='displayProductTabContent' mod='ukoocompat'} *}
                      <table class="table table-bordered table-compats" style="max-width: 1350px;width:100%;margin:2rem auto;">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Type</th>
                            <th scope="col">Version</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Audi</td>
                            <td>A3</td>
                            <td>8V / 8.5V - 12-20</td>
                            <td>2.0 TFSI - 190 / 220</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
         
                  {* {block name='product_details'}
                    {include file='catalog/_partials/product-details.tpl'}
                  {/block} *}
         
                  <div class="tab-pane fade in" id="product_instructions" role="tabpanel">
                  {block name='product_attachments'}
                    {if $product.attachments}
                        <div class="banner-tabs" >
                          <img src="/img/asm/banners/instructions/instructions_{$language.iso_code}.webp" />
                        </div>
                        <section class="product-attachments tab">
                          {* <p class="h5 text-uppercase">{l s='Download Instructions' d='Shop.Theme.Actions'}</p> *}
                          {foreach from=$product.attachments item=attachment}
                            <div class="attachment">
                              {* <h4><a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">{$attachment.name}</a></h4> *}
                              {* <p>{$attachment.description}</p> *}
                              <a class="btn_downloadInstructions" href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
                                {l s='Download Instructions' d='Shop.Theme.Actions'}
                              </a>

                              <div class="difficulty-level">
                                <span>Difficulty Level:</span>
                                <img src="/img/asm/difficulty/difficulty_{$product.difficulty}.webp"  alt="Difficulty{$product.difficulty}"/>
                              </div>
                            </div>
                          {/foreach}
                        </section>
                    {else}

                         <div class="banner-tabs" >
                           <img src="/img/asm/banners/instructions/instructions_{$language.iso_code}.webp" />
                         </div>
                         {* <div class="class_instructions" style="display: flex;gap:1rem;align-items:center;justify-content:center;padding:2rem;font-size:1rem;color:#333;">
                          <p class="tab" style="margin-bottom: 0;">{l s='No Instructions' d='Shop.Theme.Actions'}</p>
                          <div class="separator-line" style="height:50px;width:3px; background:#b3b3b3;"></div>
                          <div class="difficulty-level">
                                  <span>Difficulty Level:</span>
                                  <img src="https://www.all-stars-motorsport.com/img/app_icons/difficulty_{$product.difficulty}.webp" />
                            </div>
                         </div> *}

                        <div style="text-align: center;display:flex;justify-content:center; min-width: 800px;">
    								        <div style="display:flex;align-items:center;justify-content:space-between;height:fit-content;margin:3rem 0;gap:2rem;">
                              <h4 style="font-size:18px;margin:0;text-transform:uppercase;font-weight:500;">No Instructions</h4>
                            {if $product.difficulty > 0}
                              <div class="verticalLign" style="height:50px;width:3px; background:#b3b3b3;"></div>
                              <div class="difficulty_content" style="display:flex;align-items:center;gap:2rem;">
                                  <h4 style="margin:0;text-transform:uppercase;font-weight:500;">Difficulty Level:</h4>
                                  <img src="/img/asm/difficulty/difficulty_{$product.difficulty}.webp" alt="Difficulty{$product.difficulty}" style="height:fit-content;">
                              </div>
                            {/if}
                            </div>
                        </div>

                       
                    {/if}
                  {/block}
                  </div>
         
                  {foreach from=$product.extraContent item=extra key=extraKey}
                  <div class="tab-pane fade in {$extra.attr.class}" id="extra-{$extraKey}" role="tabpanel" {foreach $extra.attr as $key => $val} {$key}="{$val}"{/foreach}>
                    {$extra.content nofilter}
                  </div>
                  {/foreach}
         
                  <div  class="tab-pane fade in" id="product_shipping"  role="tabpanel">
                   <div class="banner-tabs" >
                    <img src="/img/asm/banners/shipping/shipping_{$language.iso_code}.webp" />
                   </div>
                    <div class="tab">
                      {hook h='extraRight' mod='totshippingpreview' mobile=0}
                    </div>
                  </div>

                  <div  class="tab-pane fade in" id="product_warranty"  role="tabpanel">
                   <div class="banner-tabs" >
                     <img src="/img/asm/banners/warranty/warranty_{$language.iso_code}.webp" />
                   </div>
                   {* <pre>{$product_manufacturer|print_r}</pre> *}
                   <div style="max-width: 1350px;margin:auto;">
                    {if $product_manufacturer->warranty}
                      <p class="tab" style="color: #333;">{$product_manufacturer->warranty}</p>
                    {/if}
                   </div>
                  </div>

                  <div  class="tab-pane fade in" id="product_askquestion"  role="tabpanel">
                   <div class="banner-tabs" >
                       <img src="/img/asm/banners/faq/faq_{$language.iso_code}.webp" />
                   </div>

                   {if $email_sent == 1}
                    <div class="container_ask_successfull">
                      <div class="question_buble">

                        <i class="material-icons question-success-icon">check_circle</i>
                        <h1 class="question-success-title">IMPRESSIONNANT!</h1>
                        <i class="material-icons close-question" onclick="closeQuestionBuble()">close</i>
                      </div>
                      <div class="question-success-msg" >Please, check your mailbox from time to time. We will respond you as soon as possible.</div>
                      <div class="btn_close_message_ask" onclick="closeQuestionBuble()">
                        Close
                      </div>
                    </div>

                  {else}
                   
                   
                   <form class="form-askquestion col-lg-9 tab" action="{$link->getPageLink('product', true)}" method="post">

                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="material-icons">person</i></span>
                      </div>
                      <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp" placeholder="Name" name="name_customer" value="{if $customer.is_logged}{$customer.firstname} {$customer.lastname}{/if}">
                    </div>
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="material-icons">email</i></span>
                      </div>
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email_customer" value="{if $customer.is_logged}{$customer.email}{/if}">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your question." name="question_customer"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                      Submit
                      <input type="hidden" name="id_lang" value="{$language.id|escape:'htmlall':'UTF-8'}">
											<input type="hidden" name="id_shop" value="{$shop.id|escape:'htmlall':'UTF-8'}">
											<input type="hidden" name="product_askquestion" value="1">
											<input type="hidden" name="id_product" value="{$product.id}">
											<input type="hidden" name="category" value="">
                    </button>
                  
                   </form>
                  {/if}
                  </div>

                  {* <div class="tab-pane fade in" id="product_reviews"  role="tabpanel">
                    <div class="banner-tabs" >
                       <img src="https://www.all-stars-motorsport.com/img/app_icons/reviews_en.webp" />
                    </div>
                    <div class="banner-content">
                    {block name='product_reviews'}
                      {hook h='displayFooterProduct' product=$product}
                    {/block}
                    </div>
                  </div> *}

               </div>
               </div>
             {/block}
 
             </div>
             
 </div>

 {* <div class="desktop" style="padding: 0.5rem 1rem; background:#333;width:100%;color: #fff;">
 Reviews
 </div> *}

 <div  class="desktop" id="product_reviews" style="padding:0;display:flex;flex-direction:column;">
  {block name='product_miniature_item'}
    {block name='product_reviews'}
      {hook h='displayFooterProduct' mod='productcomments'  product=$product  category=$category}
    {/block}
  {/block}
  
  {* {hook h='displayFooterProduct' mod='productcomments' product=$product category=$category} *}
</div>

 
  <div class="complementary-products-flag">
    Complementary Products
  </div>
 
     {block name='product_accessories'}
       {if $accessories}
         <section class="product-accessories clearfix">

           {* <div class="products d-desktop">
             {foreach from=$accessories item="product_accessory" key="position"}
               {if $position < 4}
                 {block name='product_miniature'}
                   {include file='catalog/_partials/miniatures/product.tpl' product=$product_accessory position=$position productClasses="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
                 {/block}
               {/if}
             {/foreach}
           </div> *}

           <div class="swiper products-mobile">
            <div class="swiper-wrapper">
             {foreach from=$accessories item="product_accessory" key="position"}
               {if $position < 4}
                <div class="swiper-slide">
                 {block name='product_miniature'}
                   {include file='catalog/_partials/miniatures/product.tpl' product=$product_accessory position=$position productClasses="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
                 {/block}
                </div>
               {/if}
             {/foreach}
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
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
 

 {* <script>
    var swiper = new Swiper(".product-accessories .products-mobile", {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script> *}

