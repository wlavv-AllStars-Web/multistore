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
{* {debug} *}
    <meta content="{$product.url}">

    <section id="main" style="max-width:1350px;margin:auto;">

        <div class="row" style="text-align: center;">
            <div class="col-lg-2">
                <img src="/img/asd/product/exclusive.webp" style="width: 120px;padding: 25px 0;" alt="Distributor"/>
            </div>
            <div class="col-lg-8">
                <img src="http://webtools.euromuscleparts.com/uploads/manufacturer/ASD/{$product->manufacturer_name|replace:' ':''}/{$product.id_manufacturer}.webp" style="width: 90%; margin: 0 auto;" alt="Brand banner"/>
            </div>
            <div class="col-lg-2">
                <img src="/img/asd/product/exclusive.webp" style="width: 120px;padding: 25px 0;" alt="Origin"/>
            </div>
        </div>

        <div class="row" style="text-align: center;margin-top: 50px;">
            <div class="col-lg-4">
                {block name='page_content_container'}
                    <section class="page-content" id="content">
                        {block name='page_content'}
                            {block name='product_cover_thumbnails'}
                                {include file='catalog/_partials/product-cover-thumbnails.tpl'}
                            {/block}
                            <div class="scroll-box-arrows">
                                <i class="material-icons left">&#xE314;</i>
                                <i class="material-icons right">&#xE315;</i>
                            </div>
                        {/block}
                    </section>
                    <div style="margin-top: 10px; line-height: 2;">
                        {* <div style="float: left; width: calc( 100% - 60px )"> {l s='CHOOSE YOUR VERSION' d='Shop.Theme.Catalog'} </div>
                        <div style="float: left; width: 60px"> <i class="fa-solid fa-chevron-down"></i> </div> *}
                    {block name='product_variants'} {include file='catalog/_partials/product-variants.tpl'} {/block}
                    </div>
                {/block}
            </div>
            <div class="col-lg-8">
                
                <div style="margin-bottom: 30px;">
                    <h1 class="h1" style="text-align: center;font-size:30px;color: #666;font-weight:bold;line-height:1.15;text-transform:uppercase;">{block name='page_title'}{$product.name}{/block}</h1>
                    
                    <div class="product-details" >
                        <div class="product-manufacturer" style="font-size: 18px;font-weight:600;">{l s='Brand:' d='Shop.Theme.Catalog'} <span style="font-size: 18px;font-weight:400;">{$product->manufacturer_name}</span> </div>
                        <span class="separator">|</span>
                        <div class="product-reference" style="font-size: 18px;font-weight:600;">  {l s='SKU:' d='Shop.Theme.Catalog'}   <span style="font-size: 18px;font-weight:400;">{$product.reference}</span> </div>
                    </div>
                    
                    {if $product->ean13 != ''}
                    <div class="product-details" >
                        <div class="product-manufacturer" style="font-size: 18px;font-weight:600;">{l s='UPC:' d='Shop.Theme.Catalog'} <span style="font-size: 18px;font-weight:400;"> {$product->ean13}</span> </div>
                    </div>
                    {/if}
                    
                    <div style="width: 150px; height: 3px; background-color: lightgrey; margin: 30px auto;"></div>
                </div>

                {* {block name='product_prices'} {include file='catalog/_partials/product-prices.tpl'} {/block} *}


                <div class="product-actions js-product-actions">
                    {block name='product_buy'}
                        <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                            <input type="hidden" name="token" value="{$static_token}">
                            <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
                            <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">
        
                            {block name='product_variants'} {include file='catalog/_partials/product-variants.tpl'} {/block}
        
                            {block name='product_pack'}
                                {if $packItems}
                                    <section class="product-pack">
                                        <p class="h4">{l s='This pack contains' d='Shop.Theme.Catalog'}</p>
                                        {foreach from=$packItems item="product_pack"}
                                            {block name='product_miniature'} {include file='catalog/_partials/miniatures/pack-product.tpl' product=$product_pack showPackProductsPrice=$product.show_price} {/block}
                                        {/foreach}
                                    </section>
                                {/if}
                          {/block}
        
                          {block name='product_add_to_cart'} {include file='catalog/_partials/product-add-to-cart.tpl'} {/block}
                          {block name='product_additional_info'} {include file='catalog/_partials/product-additional-info.tpl'} {/block}
                          
                          {block name='product_refresh'}{/block}
                        </form>
                    {/block}
                </div>
            </div>
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 30px auto;"></div>
            </div>
        </div>

        <div class="row" style="text-align: left;margin-top: 30px;">
            <div class="col-lg-3">
                <h1 style="border-bottom: 3px solid #0273eb;width:fit-content;padding-bottom: 5px;font-size: 24px;">{l s='Disponibility:' d='Shop.Theme.Catalog'}</h1>
                <div style="font-size: 18px; color: #666;line-height: 1.7; font-weight: 600;">
                    <div>
                        <span>{l s='Stock:' d='Shop.Theme.Catalog'}</span> 
                        {if $product.quantity > 3}
                            <span style="color: green;font-weight:400;">{$product.quantity}</span>
                        {elseif $product.quantity >= 1 && $product.quantity <= 3}
                            <span style="color: orange;font-weight:400;">{$product.quantity}</span>
                        {else}
                            <span style="color: red;font-weight:400;">0</span>
                        {/if}
                        
                    </div>
                    <div>
                        <span>{l s='Arrive:' d='Shop.Theme.Catalog'}</span> 
                        <span style="font-weight: 400;">15</span>
                    </div>
                    <div>
                        <span>{l s='ETA:' d='Shop.Theme.Catalog'}</span> 
                        <span style="font-weight: 400;">12/04/2024</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <h1 style="border-bottom: 3px solid #0273eb;width:fit-content;padding-bottom: 5px;font-size: 24px;">{l s='Package:' d='Shop.Theme.Catalog'}</h1>
                <div style="font-size: 18px; color: #666;line-height: 1.7; font-weight: 600;">
                    <div>
                        <span>{l s='Volume:' d='Shop.Theme.Catalog'}</span> 
                        <span style="font-weight: 400;">1</span>
                    </div>
                    <div>
                        <span>{$product.width|number_format:0}cm x {$product.height|number_format:0}cm x {$product.depth|number_format:0}cm</span>
                    </div>
                    <div>
                        <span>{$product.weight|number_format:2}kg</span>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3">
                <h1 style="border-bottom: 3px solid #0273eb;width:fit-content;padding-bottom: 5px;font-size: 24px;">{l s='Info:' d='Shop.Theme.Catalog'}</h1>
                <div style="font-size: 18px; color: #666;line-height: 1.7; font-weight: 600;">
                    <div>
                        <span>{l s='Origin:' d='Shop.Theme.Catalog'}</span> 
                        <span style="font-weight: 400;">{$product.location}</span>
                    </div>
                    <div>
                        <span>{l s='Tax:' d='Shop.Theme.Catalog'}</span> 
                        <span style="font-weight: 400;">{$product.rate}</span>
                    </div>
                    <div>
                        <span>{l s='Status:' d='Shop.Theme.Catalog'}</span> 
                {if $product.active === 1}<span style="color: green;font-weight:400;">{l s='Active' d='Shop.Theme.Catalog'}</span>{else}<span style="color: red;font-weight:400;">{l s="Unavailable" d='Shop.Theme.Catalog'}</span>{/if}
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3">
                <h1 style="border-bottom: 3px solid #0273eb;width:fit-content;padding-bottom: 5px;font-size: 24px;">{l s='Links:' d='Shop.Theme.Catalog'}</h1>
                <div class="links-productpage" style="font-size: 18px; color: #666;line-height: 1.7; font-weight: 400;">
                    <div>
                        <a style="color: #666;" href="{$link->getPageLink('catalog', true)}">{l s='Catalogue' d='Shop.Theme.Catalog'}</a> 
                    </div>
                    <div>
                        <a style="color: #666;" href="">{l s='Manufacturer website' d='Shop.Theme.Catalog'}</a> 
                    </div>
                    <div>
                        <a style="color: #666;" onclick="openShippingtab('{$urls.pages.my_account}','shipping')">{l s='Transport prices' d='Shop.Theme.Catalog'}</a> 
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 50px auto;"></div>
            </div>
            
            <div class="col-lg-12" style="text-align: center;">
                <h1 style="color: #0273eb;font-size:24px">{l s='DETAILS' d='Shop.Theme.Catalog'}</h1>
                <div style="margin-top: 30px; font-size: 18px; color: #666;line-height: 1.7; font-weight: 400;">
                    {if $product.description || $product.description_short}
                        {if $product.description}
                            {$product.description}
                        {else}
                            {$product.description_short}
                        {/if}
                    {else}
                        {l s="No details"}
                    {/if}
                </div>
            </div>
            
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 50px auto;"></div>
            </div>
            
            <div class="col-lg-12" style="text-align: center;">
                <h1 style="color: #0273eb;font-size:24px">{l s='NOTE' d='Shop.Theme.Catalog'}</h1>
                <div style="margin-top: 30px; font-size: 18px; color: #666;line-height: 1.7; font-weight: 400;">
                    {l s='Fusce sodales, lorem eget tincidunt eleifend, magna urna vehicula lectus, eu ultrices nunc nulla a turpis. In hac habitasse platea dictumst. Nulla a posuere felis. Vestibulum molestie lectus orci. Suspendisse dapibus nulla ex, sit amet efficitur tellus facilisis id. Etiam suscipit bibendum purus quis gravida. Mauris congue, ante non finibus scelerisque, lorem diam aliquam arcu, aliquam auctor dui nulla ac dui. Vivamus in eros risus. Curabitur vitae massa euismod quam sodales fermentum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas faucibus, mi non accumsan tincidunt, justo ante fermentum ligula, sit amet accumsan nisi lacus vel purus. Etiam non interdum metus.' d='Shop.Theme.Catalog'} 
                </div>
            </div>
            <div class="col-lg-12">
                <div style="margin: 50px auto;"></div>
            </div>            
        </div>
        
        {block name='product_images_modal'} {include file='catalog/_partials/product-images-modal.tpl'} {/block}
    
    </section>

{/block}


