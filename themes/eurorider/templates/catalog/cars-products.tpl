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

 {block name='head_microdata_special'}
   {include file='_partials/microdata/product-list-jsonld.tpl' listing=$listing}
 {/block}
 
 {block name='content'}
   <section id="main">
 
     {block name='product_list_header'}
     {* <h1 id="js-product-list-header" style="margin-left:3rem;" class="h2">
         {$listing.label}
     </h1> *}
     {/block}
 
     {block name='subcategory_list'}
       {if isset($subcategories) && $subcategories|@count > 0}
         {include file='catalog/_partials/subcategories.tpl' subcategories=$subcategories}
       {/if}
     {/block}
     
     {hook h="displayHeaderCategory"}
     {* <pre>{$compat|print_r}</pre> *}
     <section id="products">
       {* {$listing.products|count} *}

          {if $listing.products|count > 0 }
            <div class="filters-mobile">
              <div class="filters-sort-btn" onclick="openNavCarSpecs()"><i class="material-icons" translate="no">filter_list</i> {l s='Filters' d='Shop.Theme.ProductList'}</div>
              
              <div class="bg-sidenavCarSpecs" onclick="closeNavCarSpecs()"></div>
              <div id="sidenavCarSpecs" class="sidenav">
                <div style="width:100%;display:flex;justify-content:end;padding: .5rem 0;">
                  <button type="button" class="btn-primary" onclick="closeNavCarSpecs()" aria-label="Close" style="border-radius: .25rem;">
                    <i class="fa-solid fa-xmark fa-xl"></i>
                  </button>
                </div>
                <div>
                  {block name='product_list_top'}
                    {include file='catalog/_partials/products-top.tpl' listing=$listing}
                  {/block}
                </div>
              </div>
            </div>
          
            <div class="filters-desktop">
            {block name='product_list_top'}
              {include file='catalog/_partials/products-top.tpl' listing=$listing}
            {/block}
            </div>
         {/if}
 
         {block name='product_list_active_filters'}
           <div class="hidden-sm-down">
             {$listing.rendered_active_filters nofilter}
           </div>
         {/block}
         
         {block name='product_list'}
            
            {include file='catalog/_partials/products.tpl' listing=$listing compat=$compat productClass="col-xs-12 col-sm-6 col-xl-2"}

            {if $universals}
            {include file='catalog/_partials/universal_ajax_products.tpl' universals=$universals productClass="col-xs-12 col-sm-6 col-xl-2"}
            {/if}
         {/block}
 
         {if $listing.products|count > 0}
          {block name='product_list_bottom'}
            {include file='catalog/_partials/products-bottom.tpl' listing=$listing}
          {/block}
         {/if}
  
       {* {else}
         <div id="js-product-list-top"></div>
 
         <div id="js-product-list">
           {capture assign="errorContent"}
             <h4>{l s='No products available yet' d='Shop.Theme.Catalog'}</h4>
             <p>{l s='Stay tuned! More products will be shown here as they are added.' d='Shop.Theme.Catalog'}</p>
           {/capture}
 
           {include file='errors/not-found.tpl' errorContent=$errorContent}
         </div>
 
         <div id="js-product-list-bottom"></div>
       {/if} *}
     </section>
 
     {block name='product_list_footer'}{/block}
 
     {hook h="displayFooterCategory"}
 
   </section>


 {/block}
 

