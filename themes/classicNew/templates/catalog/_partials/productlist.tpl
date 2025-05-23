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

{capture assign="productClasses"}{if !empty($productClass)}{$productClass}{else}col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-3{/if}{/capture}
{assign var="count_products" value=$products|count}
    
<div class="products{if !empty($cssClass)} {$cssClass}{/if}">

    {if $cars_products_page}
        {if $compat}
          <article id="current_car_settings" class=" js-product-miniature d-flex justify-content-center col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3" itemscope itemtype="http://schema.org/Product" style="display:flex;flex-direction: column;border-radius:0.25rem;" id_compat="{$compat['id_compat']}">
          <div class="miniature-car" style="display:flex;flex-direction:column;align-items:center;height:100%;border-radius:.25rem;padding:1rem;width:100%;justify-content:center;">
            <div style="width: 100%;height:120px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:relative;background:transparent;position:relative;">
                <img class="img-responsive" src="{$compat['cartoon']}" 
                onerror="this.onerror=null;this.src='/img/eurmuscle/compat/unknown.png';" style="margin: 0 auto;max-width: 300px; position: relative; top: -5px;pointer-events: none;width:100%;">
              </div>
              <div class="current-car-content">
                {if !$compat['subscribed']}
                <div class="addToMyCarsButton" style="position: relative; top: -5px;cursor: pointer; color: var(--euromus-color-300);font-weight:600;"
                onclick="addToMyCars({$compat['id_compat']})">
                  {l s='Click to receive updates about new products for this car' d='Shop.Theme.ProductList'}
                </div>
                {/if}
    
                <div class="mobile details-info-car-mobile">
                  <span style="background: #333;"><img src="{$compat['brand_logo']}" style="width: 40px;padding: .25rem"/></span>
                  {* <span>|</span> *}
                  <span style="color: var(--asm-color) !important;">{$compat['model']}</span>
                  <span>|</span>
                  <span>{$compat['type']}</span>
                </div>
                <div class="desktop details-info-car-dektop">
                  <div>{$compat['brand']} | {$compat['model']}</div>
                  <div style="margin-top: 11px;"> {$compat['type']} | {$compat['version']}</div>
                </div>
              </div>
              {* <div class="logo_brand_compat" style="display: flex;justify-content:end;width:100%;position:absolute;bottom:0;right:0;">
                <img src="{$compat['brand_logo']}" style="width: 80px;background: var(--euromus-color-text2);padding:.25rem;border-radius: .25rem 0 0 0;"/>
              </div> *}
            </div>
          </article>
        {/if}
    {/if}

    {if $category.id == 550 ||$category.id == 551 ||$category.id == 552 ||$category.id == 553 ||$category.id == 554 ||$category.id == 555}
    <div class="js-product product category{if !empty($productClasses)} {$productClasses}{/if}" style="display: flex;justify-content:center;">
        <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}">
            <div class="thumbnail-container" style="background:#1030543d;display: flex;flex-direction: row;justify-content: center;align-items:center;">
                <div class="thumbnail-top" style="flex: 1;height:100%;">
                    <picture>
                        <img src="/img/eurmuscle/bannersHome/{$category.link_rewrite}.webp" style="width: 100%;background:transparent;height:100%;object-position: -132px center;
                        object-fit: cover;"/>
                    </picture>
                </div>
                <div class="product-descriptionn" style="background: transparent;display: flex;flex-direction: column;align-items: center;color:#fff;gap:0.5rem;padding:0.5rem 0;flex:0.7;">
                    <h2 style="color: #103054;font-size:1.5rem;font-weight:600;">{$category.name|upper}</h2>
                </div>
            </div>
    </div>
    {/if}

    {if $listing.products|count < 1 || $no_products}
        <div style="
          display: flex;
          flex: 1;
          justify-content: center;
          align-items: center;
          font-size: 2rem;
          color: #222;
          margin-bottom: 30px;
        ">
          <div class="container-not-found-filters" style="text-align: center;">
            <i class="material-icons" style="font-size: 3rem;color: var(--asm-color);" translate="no">error_outline</i>
            <h1 style="font-weight: 600;font-size: 2rem;">{l s='No Result Found' d='Shop.Theme.ProductList'}</h1>
            <span style="font-size: 1.25rem;color: #555;">{l s='We can\'t find any item matching your search' d='Shop.Theme.ProductList'}</span>
          </div>
        </div>
      {else}
        {foreach from=$listing.products item="product" key="index"}
            {* <pre>{$product|print_r}</pre> *}
            {block name='product_miniature'}
              {if $index > 2}
                {include file='catalog/_partials/miniatures/product.tpl' product=$product productClasses="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3" lazy=true}
              {else}
                {include file='catalog/_partials/miniatures/product.tpl' product=$product productClasses="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3"}
              {/if}
            {/block}
        {/foreach}
      {/if}

    {* {foreach from=$products item="product" key="position"}
        {include file="catalog/_partials/miniatures/product.tpl" product=$product position=$position productClasses=$productClasses }
    {/foreach} *}
</div>

