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
       <div class="col-xl-7 col-lg-5 left-side" >
         {block name='page_content_container'}
           <section class="page-content" id="content" >
             {block name='page_content'}
               {* {include file='catalog/_partials/product-flags.tpl'} *}
 
               {block name='product_cover_thumbnails'}
                 {include file='catalog/_partials/product-cover-thumbnails.tpl'}
               {/block}
               <div class="scroll-box-arrows">
                 <i class="material-icons left" translate="no">&#xE314;</i>
                 <i class="material-icons right" translate="no">&#xE315;</i>
               </div>
               
 
             {/block}
           </section>
         {/block}
         </div>
         <div class="col-xl-5 col-lg-7 right-side" >
           {block name='page_header_container'}
             {block name='page_header'}
               <h1 class="h1">{block name='page_title'}{$product.name}{/block}</h1>
             {/block}
           {/block}
 
           {assign var="linkPayment" value=$link->getCMSLink(47)}
           {assign var="manufacturers" value=Manufacturer::getManufacturers()}
 
           <div class="subtitles-details">
             <div class="details-reference"><b>{l s="Reference" d="Shop.Theme.Pageproduct"}:</b> {$product.reference}</div>
             {foreach from=$manufacturers item=item}
               {if $item.name === $product.manufacturer_name}
               <div class="details-brand"><b>{l s="Brand" d="Shop.Theme.Pageproduct"}:</b> <span><a href="/brand/{$item.id_manufacturer}-{$item.link_rewrite}">{$product.manufacturer_name}</a></span></div>
               {/if}
             {/foreach}
             <div class="details-payment"><a href="{$linkPayment}">{l s="Pay in 3 or 4 Installment" d="Shop.Theme.Pageproduct"}</a></div>
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

                <span id="product-availability">

                  {if $product.show_availability && $product.availability_message && !$packLabel}
                    {if $product.available_later || $product.available_now}
                      {if $product.quantity < 1}
                        <div>{l s="Shipped within:" d="Shop.Theme.Catalog"}
                          <div class="tooltip" style="font-size: 1rem;width:15px;text-align:center;cursor:pointer;">?
                            <div class="tooltiptext">{l s="This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximate shipping date for this item." d="Shop.Theme.Catalog"}</div>
                          </div>
                          <span style="background: #f6ed1d;color:#333;padding: 0.25rem 0.5rem;">{$product.available_later}</span>
                        </div>
                      {else}
                        <div>{l s="Availability:" d="Shop.Theme.Catalog"} <span style="background: #88f941;color:#333;padding: 0.25rem 0.5rem;">{$product.available_now}</span></div>
                      {/if}
                    {elseif $product.availability == 'last_remaining_items'}
                      <i class="material-icons product-last-items" translate="no">&#xE002;</i>
                    {else}
                      <i class="material-icons product-unavailable" translate="no">block</i>
                    {/if}
                  {/if}
                  {* {if $packLabel}
                    {if $packLabelStock < 1}
                      <div>{l s="Shipped within:" d="Shop.Theme.Catalog"}
                          <div class="tooltip" style="font-size: 1rem;width:15px;text-align:center;cursor:pointer;">?
                            <div class="tooltiptext">{l s="This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximate shipping date for this item." d="Shop.Theme.Catalog"}</div>
                          </div>
                          <span style="background: #f6ed1d;color:#222;padding: 0.25rem 0.5rem;">{$packLabel}</span>
                        </div>
                    {else}
                      <div>{l s="Availability:" d="Shop.Theme.Catalog"} <span style="background: #88f941;color:#f2f2f2;padding: 0.25rem 0.5rem;">{$packLabel}</span></div>
                    {/if}
                    
                  {/if} *}
                </span>
              {/block}
                   </div>


                   {* <pre>{$product|print_r}</pre> *}
 
                   <div class="features_productdetails" >
                   {* features *}
                     <div class="product_features" >
                       {* <pre>{print_r($product.features,1)}</pre> *}
                        <div style="padding: 0.2rem 2rem;"><b>{l s="EC Approval" d="Shop.Theme.Pageproduct"}:</b> <span>{if $product.ec_approved == 0}{l s="No" d="Shop.Theme.Pageproduct"}{else}{l s="Yes" d="Shop.Theme.Pageproduct"}{/if}</span></div>
                        {if !empty($product.origin_product)}
                          <div style="padding: 0.2rem 2rem;"><b>{l s="Origin" d="Shop.Theme.Pageproduct"}:</b> <span>{$product.origin_product}</span></div>
                        {/if}

                       {foreach from=$product.features item=feature}
                         <div style="padding: 0.2rem 2rem;"><b>{$feature.name}:</b> <span>{$feature.value}</span></div>
                       {/foreach}
                     </div>
 
                     <div class="product-details-options" >
                       
                       {* {block name='product_pack'}
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
                       {/block} *}
 
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
   style="border-bottom:4px solid #103054;border-top:4px solid #ee302e;padding-block:2px;width: 100%;margin:1rem 0 0 0"></div>

  <div class="d-mobile section-content-product" style="margin-top: 1rem;flex-direction:column;gap:.25rem;">
    <div class="container-description-mobile" style="flex-direction: column;width:100%;">
      <div class="nav-link" data-toggle="collapse" href="#descriptionMobile" role="button" aria-expanded="false" aria-controls="descriptionMobile" style="width: 100%;background: #fff;text-align:center;">
        {l s='DESCRIPTION' d='Shop.Theme.Catalog'}
      </div>

      <div class="collapse container-drop" id="descriptionMobile">
        
                {* <div class="tab">{hook h='displayProductTabContent' mod='ukoocompat' id_module=124}</div> *}
                {if $product.description}
                  <div class="banner-tabs" >
                    <img src="/img/eurmuscle/bannersProduct/brands/{$product_manufacturer->id}_{$language.iso_code}.webp" alt="banner manufacturer {$product_manufacturer->id}" />
                  </div>
                  <div class="tab-description tab" style="display: flex;justify-content:center;flex-direction:column;padding:1rem;color:#333;">
                    {block name='product_description'}
                      <div class="product-description">{$product.description nofilter}</div>
                    {/block}
                    {if !empty($product.youtube_1)}
                      <div class="column_video" style="display:flex;justify-content:center;align-items:center;margin:2rem 0;">
                        <div class="video3 video" style="width:480px;border-radius: 0.25rem;overflow: hidden;">
                          <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                          <img src="https://i3.ytimg.com/vi/{$product.youtube_1}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy" alt="banner youtube video {$product.youtube_1}"/>
                            <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                              <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                            </div>
                          </div>
                          <div  class="iframeClass"  style="display:none;height:318px">
                            <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_1}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
                            </iframe>
                          </div>
                        </div>
                      </div>
                      {/if}
                      <small style="text-align: center;">{l s="Content protected by copyright © 2024 - All rights reserved" d="Shop.Theme.Catalog"}</small>
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
                    <img src="/img/eurmuscle/bannersProduct/brands/{$product_manufacturer->id}_{$language.iso_code}.webp" alt="banner manufacturer {$product_manufacturer->id}"/>
                  </div>
                  <div class="tab-description tab" style="display: flex;">
                    {block name='product_description'}
                      <div class="product-description" style="{if empty($product.youtube_1)}width:90%;{else}width: 60%;{/if}">
                        <p>{l s='No description.' d='Shop.Theme.Catalog'}</p>
                      </div>
                    {/block}
                    {if !empty($product.youtube_1)}
                      <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
                        <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                          <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                          <img src="https://i3.ytimg.com/vi/{$product.youtube_1}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy" alt="banner {$product.youtube_1}"/>
                            <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                              <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                            </div>
                          </div>
                          <div  class="iframeClass"  style="display:none;height:318px">
                            <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_1}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;" alt="banner youtube video {$product.youtube_1}">
                            </iframe>
                          </div>
                        </div>
                      </div>
                      {/if}
                    {* fim tabs *}
                    
                  </div>
          
                {/if}

      </div>
    </div>

   <div class="container-compat-mobile" style="flex-direction: column;width:100%;">
     <div class="nav-link" data-toggle="collapse" href="#compatMobile" role="button" aria-expanded="false" aria-controls="compatMobile" style="width: 100%;background: #fff;text-align:center;">
       {l s='COMPATIBILITIES' d='Shop.Theme.Catalog'}
     </div>
   
     <div class="collapse container-drop" id="compatMobile">
       
       <div class="banner-tabs" >
         <img src="/img/eurmuscle/bannersProduct/compatibilities_{$language.iso_code}.webp" alt="banner compat" />
       </div>
               {* <div class="tab">{hook h='displayProductTabContent' mod='ukoocompat' id_module=124}</div> *}
       {if $compats|count}
       <div class="container-table-compats table-mobile">
         {* {hook h='displayProductTabContent' mod='ukoocompat'} *}
         <table class="table table-bordered table-compats" style="max-width: 1350px;width:100%;margin:2rem auto;">
           <thead class="thead-dark">
             <tr>
               <th scope="col">{l s="Brand" d="Shop.Theme.ProductPage"}</th>
               <th scope="col">{l s="Model" d="Shop.Theme.ProductPage"}</th>
               <th scope="col">{l s="Type" d="Shop.Theme.ProductPage"}</th>
               <th scope="col">{l s="Version" d="Shop.Theme.ProductPage"}</th>
             </tr>
           </thead>
           <tbody>
           {foreach from=$compats item=compat name=compatLoop}
             <tr {if $smarty.foreach.compatLoop.index >= 5} class="hidden-row" style="display: none;" {/if}>
               <td>{$compat.brand}</td>
               <td>{$compat.model}</td>
               <td>{$compat.type}</td>
               <td>{$compat.version}</td>
             </tr>
           {/foreach}
           </tbody>
         </table>

         {if $compats|count > 5}
           <div style="text-align: center;">
             <button id="showMoreBtn" class="btn btn-primary" onclick="toggleRows()">{l s='Show More' d='Shop.Theme.Actions'}</button>
           </div>
         {/if}
       </div>

       <script>
         function toggleRows() {
           var hiddenRows = document.querySelectorAll(".table-mobile .hidden-row");
                   var btn = document.getElementById("showMoreBtn");

                   // Toggle rows visibility
                   let isHidden = hiddenRows[0].style.display === "none";
                   hiddenRows.forEach(row => {
                     row.style.display = isHidden ? "table-row" : "none";
                   });

                   // Toggle button text
                   btn.textContent = isHidden ? "{l s='Show Less' d='Shop.Theme.Actions'}" : "{l s='Show More' d='Shop.Theme.Actions'}";
         }
       </script>

       {else}
        <div class="container-no-compats" style="padding: 3rem 1rem;">
         <p style="text-align: center;margin-bottom:0;">{l s="No compatibilities available." d="Shop.Theme.Product"}</p>
        </div>
       {/if}


     </div>
   </div>
   
   <div class="container-shipping-mobile" style="flex-direction: column;width:100%;">
     <div class="nav-link" data-toggle="collapse" href="#shippingMobile" role="button" aria-expanded="false" aria-controls="shippingMobile" style="width: 100%;background: #fff;text-align:center;">
       {l s='SHIPPING' d='Shop.Theme.Catalog'}
     </div>
   
     <div class="collapse container-drop" id="shippingMobile">
       
       <div class="banner-tabs" >
         <img src="/img/asm/banners/shipping/shipping_{$language.iso_code}.webp" alt="banner shipping"/>
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
             <img src="/img/eurmuscle/bannersProduct/instructions_{$language.iso_code}.webp" alt="banner instructions"/>
           </div>
           <section class="product-attachments tab">
             {* <p class="h5 text-uppercase">{l s='Download Instructions' d='Shop.Theme.Actions'}</p> *}
             {foreach from=$product.attachments item=attachment}
               <div class="attachment">
                 {* <h4><a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">{$attachment.name}</a></h4> *}
                 {* <p>{$attachment.description}</p> *}
                 <a class="btn_downloadInstructions" href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
                   <i class="material-icons" translate="no">file_download</i>
                   {l s='Download Instructions' d='Shop.Theme.Actions'}
                 </a>

                 <div class="difficulty-level">
                   <span>{l s='Difficulty Level:' d='Shop.Theme.Catalog'}</span>
                   <img src="https://www.all-stars-motorsport.com/img/app_icons/difficulty_3.webp" alt="img difficulty"/>
                 </div>
               </div>
             {/foreach}
           </section>
         </div>
       {else}

         
         
          <div class="tab-pane fade in" id="product_instructions_mobile" role="tabpanel">
            <div class="banner-tabs" >
              <img src="/img/eurmuscle/bannersProduct/instructions_{$language.iso_code}.webp" alt="banner instructions"/>
            </div>
            {* <div class="class_instructions" style="display: flex;gap:1rem;align-items:center;justify-content:center;padding:2rem;font-size:1rem;color:#333;">
             <p class="tab" style="margin-bottom: 0;">{l s='No Instructions' d='Shop.Theme.Actions'}</p>
             <div class="separator-line" style="height:50px;width:3px; background:#b3b3b3;"></div>
             <div class="difficulty-level">
                     <span>Difficulty Level:</span>
                     <img src="https://www.all-stars-motorsport.com/img/app_icons/difficulty_{$product.difficulty}.webp" />
               </div>
            </div> *}

           <div style="text-align: center;display:flex;justify-content:center;">
               <div style="display:flex;align-items:center;justify-content:space-between;height:fit-content;margin:3rem 0;gap:2rem;">
                 <h4 style="font-size:18px;margin:0;text-transform:uppercase;font-weight:500;">{l s='No Instructions' d='Shop.Theme.Catalog'}</h4>
               {* {if $product.difficulty > 0}
                 <div class="verticalLign" style="height:50px;width:3px; background:#b3b3b3;"></div>
                 <div class="difficulty_content" style="display:flex;align-items:center;gap:2rem;">
                     <h4 style="margin:0;text-transform:uppercase;font-weight:500;">{l s='Difficulty Level:' d='Shop.Theme.Catalog'}</h4>
                     <img src="/img/asm/difficulty/difficulty_{$product.difficulty}.webp" alt="Difficulty{$product.difficulty}" style="height:fit-content;">
                 </div>
               {/if} *}
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
           <img src="/img/asm/banners/faq/faq_{$language.iso_code}.webp" alt="banner faq" />
       </div>

       {* {if $email_sent == 1} *}
         <div class="container_ask_successfull" style="display: none;padding:1rem;">
           <div class="question_buble">

             <i class="material-icons question-success-icon" translate="no">check_circle</i>
             <h1 class="question-success-title">{l s='Great!' d='Shop.Theme.Catalog'}</h1>
             <i class="material-icons close-question" onclick="closeQuestionBuble()" translate="no">close</i>
           </div>
           <div class="question-success-msg" >{l s='Please, check your mailbox from time to time. We will respond you as soon as possible.' d='Shop.Theme.Catalog'}</div>
           <div class="btn_close_message_ask" onclick="closeQuestionBuble()">
             {l s='Close' d='Shop.Theme.Catalog'}
           </div>
         </div>

       {* {else} *}
         
         
         <form class="form-askquestion col-lg-9 tab" action="{$link->getPageLink('product', true)}" method="post">

         <div class="form-group">
           <div class="input-group-prepend">
             <span class="input-group-text" id="basic-addon1"><i class="material-icons" translate="no">person</i></span>
           </div>
           <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp" placeholder="{l s='Name' d='Shop.Theme.Catalog'}" name="name_customer" value="{if $customer.is_logged}{$customer.firstname} {$customer.lastname}{/if}">
         </div>
         <div class="form-group">
           <div class="input-group-prepend">
             <span class="input-group-text" id="basic-addon1"><i class="material-icons" translate="no">email</i></span>
           </div>
           <input type="email" class="form-control" id="inputEmail" placeholder="{l s='Email' d='Shop.Theme.Catalog'}" name="email_customer" value="{if $customer.is_logged}{$customer.email}{/if}">
         </div>
         <div class="form-group">
           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="{l s='Write your question.' d='Shop.Theme.Catalog'}" name="question_customer"></textarea>
         </div>

         {* <button type="submit" class="btn btn-primary">
           {l s='Submit' d='Shop.Theme.Catalog'}
           <input type="hidden" name="id_lang" value="{$language.id|escape:'htmlall':'UTF-8'}">
           <input type="hidden" name="id_shop" value="{$shop.id|escape:'htmlall':'UTF-8'}">
           <input type="hidden" name="product_askquestion" value="1">
           <input type="hidden" name="id_product" value="{$product.id}">
           <input type="hidden" name="category" value="">
         </button> *}

         <button class="g-recaptcha btn btn-primary" 
         name="submitMessage"
         data-sitekey="6LePv_oqAAAAAJz5p1N-VGJBZNuC6ok9jw0z7CRj" 
         data-callback='onSubmit' 
         data-action='submit'>
           {l s='Submit' d='Shop.Theme.Catalog'}
           <input type="hidden" name="id_lang" value="{$language.id|escape:'htmlall':'UTF-8'}">
           <input type="hidden" name="id_shop" value="{$shop.id|escape:'htmlall':'UTF-8'}">
           <input type="hidden" name="product_askquestion" value="1">
           <input type="hidden" name="id_product" value="{$product.id}">
           <input type="hidden" name="category" value="">
         </button>

         <script>
         function onSubmit(token) {
             // Get the form element
             var form = document.querySelector(".container-askquestion-mobile .form-askquestion");
             
             // Create FormData object
             var formData = new FormData(form);
             formData.append('g-recaptcha-response', token);

             // Send AJAX request
             fetch(form.action, {
                 method: 'POST',
                 body: formData
             })
             .then(response => response.json())
             .then(data => {
                 if (data.email_sent) {
                     // Show success message
                     document.querySelector(".container-askquestion-mobile .container_ask_successfull").style.display = "block";
                     form.style.display = "none";
                 } else {
                     alert("Error sending question: " + (data.error || "Unknown error"));
                 }
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert("An error occurred while sending your question");
             });
         }
         </script>
       
         </form>
       {* {/if} *}

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

 <div class="section_tabs_video" style="display: flex;{if empty($product.youtube_1)}justify-content:center;{/if}">
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
                       {if !$product.description} aria-selected="true"{/if}>{l s='INSTRUCTIONS' d='Shop.Theme.Catalog'}</a>
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
                   <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#product_shipping"
                        role="tab"
                        aria-controls="product-details"
                        {if !$product.description} aria-selected="true"{/if}>{l s='SHIPPING' d='Shop.Theme.Catalog'}</a>
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
                   {if isset($product.manufacturer_name) && $product.manufacturer_name|trim != ''}
                   <li class="nav-item">
                     <a
                       class="nav-link"
                       data-toggle="tab"
                       href="#product_brand"
                       role="tab"
                       aria-controls="product-details"
                       {if !$product.description} aria-selected="true"{/if}>{$product.manufacturer_name}</a>
                   </li>
                  {/if}
                 </ul>
         
                 {* tabs content *}
         
                 <div class="tab-content" id="tab-content">
                  <div class="tab-pane fade in active" id="description" role="tabpanel">
                   {if $product.description}
                     <div class="banner-tabs" >
                       <img src="/img/eurmuscle/bannersProduct/brands/{$product_manufacturer->id}_{$language.iso_code}.webp" alt="banner description brand" />
                     </div>
                     <div class="tab-description" style="display: flex;justify-content:center;">
                       {block name='product_description'}
                         <div class="product-description" style="{if empty($product.youtube_1)}width:90%;{else}width: 60%;{/if}">{$product.description nofilter}</div>
                       {/block}
                       {if !empty($product.youtube_1)}
                         <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
                           <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                             <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                             <img src="https://i3.ytimg.com/vi/{$product.youtube_1}/hqdefault.jpg" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy" alt="banner youtube video {$product.youtube_1}"/>
                               <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                                 <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                               </div>
                             </div>
                             <div  class="iframeClass"  style="display:none;height:318px">
                               <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_1}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
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
                       <img src="/img/eurmuscle/bannersProduct/brands/{$product_manufacturer->id}_{$language.iso_code}.webp" alt="banner brand"/>
                     </div>
                     <div class="tab-description" style="display: flex;">
                       {block name='product_description'}
                         <div class="product-description" style="{if empty($product.youtube_1)}width:90%;{else}width: 60%;{/if}">
                           <p>{l s='No description.' d='Shop.Theme.Catalog'}</p>
                         </div>
                       {/block}
                       {if !empty($product.youtube_1)}
                         <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
                           <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                             <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                             <img src="{$product.cover.large.url}" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy" alt="product cover img"/>
                               <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                                 <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                               </div>
                             </div>
                             <div  class="iframeClass"  style="display:none;height:318px">
                               <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_1}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
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
                       <img src="/img/eurmuscle/bannersProduct/compatibilities_{$language.iso_code}.webp"  alt="banner compats"/>
                     </div>
                    <div>
                    {if $compats|count}
                      <div class="container-table-compats table-mobile">
                        {* {hook h='displayProductTabContent' mod='ukoocompat'} *}
                        <table class="table table-bordered table-compats" style="max-width: 1350px;width:100%;margin:2rem auto;">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">{l s="Brand" d="Shop.Theme.ProductPage"}</th>
                              <th scope="col">{l s="Model" d="Shop.Theme.ProductPage"}</th>
                              <th scope="col">{l s="Type" d="Shop.Theme.ProductPage"}</th>
                              <th scope="col">{l s="Version" d="Shop.Theme.ProductPage"}</th>
                            </tr>
                          </thead>
                          <tbody>
                          {foreach from=$compats item=compat name=compatLoop}
                            <tr {if $smarty.foreach.compatLoop.index >= 5} class="hidden-row" style="display: none;" {/if}>
                              <td>{$compat.brand}</td>
                              <td>{$compat.model}</td>
                              <td>{$compat.type}</td>
                              <td>{$compat.version}</td>
                            </tr>
                          {/foreach}
                          </tbody>
                        </table>
          
                        {if $compats|count > 5}
                          <div style="text-align: center;">
                            <button id="showMoreBtn" class="btn btn-primary" onclick="toggleRows()">{l s='Show More' d='Shop.Theme.Actions'}</button>
                          </div>
                        {/if}
                      </div>
          
                      <script>
                        function toggleRows() {
                          var hiddenRows = document.querySelectorAll(".table-mobile .hidden-row");
                                  var btn = document.getElementById("showMoreBtn");
          
                                  // Toggle rows visibility
                                  let isHidden = hiddenRows[0].style.display === "none";
                                  hiddenRows.forEach(row => {
                                    row.style.display = isHidden ? "table-row" : "none";
                                  });
          
                                  // Toggle button text
                                  btn.textContent = isHidden ? "{l s='Show Less' d='Shop.Theme.Actions'}" : "{l s='Show More' d='Shop.Theme.Actions'}";
                        }
                      </script>
          
                      {else}
                        <p style="text-align: center;padding:0 1rem 1rem 1rem;margin-bottom:0;">{l s="No compatibilities available." d="Shop.Theme.Product"}</p>
                      {/if}
                    </div>
                  </div>

                  <div  class="tab-pane fade in" id="product_shipping"  role="tabpanel">
                    <div class="banner-tabs" >
                    <img src="/img/asm/banners/shipping/shipping_{$language.iso_code}.webp" alt=" banner shipping {$language.iso_code}"/>
                    </div>
                   <div class="tab">
                     {hook h='extraRight' mod='totshippingpreview' mobile=0}
                   </div>
                  </div>
         
                  {* {block name='product_details'}
                    {include file='catalog/_partials/product-details.tpl'}
                  {/block} *}
         
                  {block name='product_attachments'}
                    {if $product.attachments}
                     <div class="tab-pane fade in" id="product-installation" role="tabpanel">
                     <div class="banner-tabs" >
                       <img src="/img/eurmuscle/bannersProduct/instructions_{$language.iso_code}.webp" alt="banner instructions"/>
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
                           <img src="/img/eurmuscle/bannersProduct/instructions_{$language.iso_code}.webp" alt="banner instructions" />
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
                     <img src="/img/eurmuscle/bannersProduct/reviews_{$language.iso_code}.webp" alt="banner reviews" />
                   </div>
                   {hook h='displayFooterProduct' product=$product category=$category}
                  </div>
                  <div  class="tab-pane fade in" id="product_warranty"  role="tabpanel">
                   <div class="banner-tabs" >
                     <img src="/img/eurmuscle/bannersProduct/warranty_{$language.iso_code}.webp"  alt="banner warranty"/>
                   </div>
                   <p>Product Warranty</p>
                  </div>
                  
                  {if isset($product_manufacturer->name) && $product_manufacturer->name|trim != ''}
                  <div  class="tab-pane fade in" id="product_brand"  role="tabpanel">
                   <div class="banner-tabs" >
                       <img src="/img/eurmuscle/bannersProduct/instructions_{$language.iso_code}.webp" alt="banner instructions"/>
                   </div>
                   <h4 style="padding: 1rem;">{$product_manufacturer->name}</h4>
                   <div style="padding: 1rem;">
                    {if !empty($product_manufacturer->short_description)}
                      {$product_manufacturer->short_description|strip_tags|replace:'<p>':''|replace:'</p>':''}
                    {else if !empty($product_manufacturer->description)}
                      {$product_manufacturer->description|strip_tags|replace:'<p>':''|replace:'</p>':''}
                    {else}
                      <p>{l s='No description' d='Shop.Theme.Actions'}</p>
                    {/if}
                  </div>
                   {* <pre>{print_r($product_manufacturer->description,1)}</pre> *}
                  </div>
                  {/if}
         
               </div>
               </div>
             {/block}
 
             </div>
             {* {if !empty($product.youtube_1)}
             <div class="column_video" style="width: 40%;display:flex;justify-content:center;align-items:center;">
               <div class="video3 video" style="width: 75%;border-radius: 0.25rem;overflow: hidden;">
                 <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="position: relative;cursor:pointer;">
                 <img src="{$product.cover.large.url}" style="width: 100%;max-height:318px;object-fit:cover;" loading="lazy"/>
                   <div class="play" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                     <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                   </div>
                 </div>
                 <div  class="iframeClass"  style="display:none;height:318px">
                   <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$product.youtube_1}?autoplay=0&mute=1&rel=0" loading="lazy" style="width:100%;height:318px;">
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


 
 
     {block name='product_accessories'}
       {if $accessories}
        <div class=""
        style="border-bottom:4px solid #103054;border-top:4px solid #ee302e;padding-block:2px;width: 100%;margin:0 0 1rem 0"></div>
        
         <section class="product-accessories clearfix">
           <p class="h5 text-uppercase">{l s='You might also like' d='Shop.Theme.Catalog'}</p>
           <div class="products row">
            {* <div class="swiper products-mobile">
              <div class="swiper-wrapper"> *}
              {foreach from=$accessories item="product_accessory" key="position"}
                {if $position < 4}
                  <div class="swiper-slide">
                  {block name='product_miniature'}
                    {include file='catalog/_partials/miniatures/product.tpl' product=$product_accessory position=$position productClasses="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3" complementary=true}
                  {/block}
                  </div>
                {/if}
              {/foreach}
              {* </div> *}
              {* <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div> *}
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
 