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
                {/block}
            </div>
            <div class="col-lg-8">
                
                <div style="margin-bottom: 30px;">
                    <h1 class="h1" style="text-align: center;font-size:30px;color: #666;font-weight:bold;line-height:1.15;text-transform:uppercase;">{block name='page_title'}{$product.name}{/block}</h1>
                    
                    <div class="product-details" >
                        <div class="product-manufacturer"> <span style="font-size: 18px;font-weight:600;">{l s='BRAND:' d='Shop.Theme.Catalog'} {$product->manufacturer_name}</span> </div>
                        <span class="separator">|</span>
                        <div class="product-reference">    <span style="font-size: 18px;font-weight:600;">{l s='SKU:' d='Shop.Theme.Catalog'} {$product.reference}</span> </div>
                    </div>
                    
                    {if $product->ean13 != ''}
                    <div class="product-details" >
                        <div class="product-manufacturer"> <span style="font-size: 18px;font-weight:600;">{l s='UPC:' d='Shop.Theme.Catalog'} {$product->ean13}</span> </div>
                    </div>
                    {/if}
                    
                    <div style="width: 150px; height: 3px; background-color: lightgrey; margin: 30px auto;"></div>
                </div>

                {block name='product_prices'} {include file='catalog/_partials/product-prices.tpl'} {/block}


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
                <h1>{l s='DISPONIBILITY:' d='Shop.Theme.Catalog'}</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <span>{l s='Stock:' d='Shop.Theme.Catalog'}</span> 
                        <span style="color: green">1000</span>
                    </div>
                    <div>
                        <span>{l s='Arrive:' d='Shop.Theme.Catalog'}</span> 
                        <span>15</span>
                    </div>
                    <div>
                        <span>{l s='ETA:' d='Shop.Theme.Catalog'}</span> 
                        <span>12/04/2024</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <h1>{l s='PACKAGE:' d='Shop.Theme.Catalog'}</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <span>{l s='Volume:' d='Shop.Theme.Catalog'}</span> 
                        <span>1</span>
                    </div>
                    <div>
                        <span>100x100x100cm</span>
                    </div>
                    <div>
                        <span>32kg</span>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3">
                <h1>{l s='INFO:' d='Shop.Theme.Catalog'}</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <span>{l s='Origin:' d='Shop.Theme.Catalog'}</span> 
                        <span>UK</span>
                    </div>
                    <div>
                        <span>{l s='Rate:' d='Shop.Theme.Catalog'}</span> 
                        <span>15</span>
                    </div>
                    <div>
                        <span>{l s='Status:' d='Shop.Theme.Catalog'}</span> 
                        <span style="color: green">Active</span>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3">
                <h1>{l s='LINKS:' d='Shop.Theme.Catalog'}</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <a style="color: #666;" href="">{l s='Catalogue' d='Shop.Theme.Catalog'}</a> 
                    </div>
                    <div>
                        <a style="color: #666;" href="">{l s='Manufacturer website' d='Shop.Theme.Catalog'}</a> 
                    </div>
                    <div>
                        <a style="color: #666;" href="">{l s='Transport prices' d='Shop.Theme.Catalog'}</a> 
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 50px auto;"></div>
            </div>
            
            <div class="col-lg-12" style="text-align: center;">
                <h1 style="color: #0273eb;font-size:28px">{l s='DETAILS' d='Shop.Theme.Catalog'}</h1>
                <div style="margin-top: 30px; font-size: 20px; color: #666;line-height: 1.7; font-weight: bolder;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies, ante id pulvinar porttitor, lacus tellus malesuada tellus, id pretium lorem ligula tincidunt ipsum. Aliquam facilisis et metus eget imperdiet. Suspendisse eleifend ullamcorper nisl, ac posuere nulla sollicitudin non. Proin vulputate accumsan ante in ornare. Suspendisse non tristique est. Cras sollicitudin augue magna, ac congue massa elementum ut. Sed malesuada volutpat ullamcorper. Sed lacinia orci et justo tempus venenatis. Etiam mollis sodales quam sit amet volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam tortor dui, ultrices vel consequat sed, pretium id sapien. Nam vel nisl vel odio egestas tempus a ac orci. Maecenas quam enim, accumsan vehicula euismod hendrerit, dapibus vitae dolor. Suspendisse feugiat odio ac lacinia ultrices. Ut at elementum lacus, quis placerat mauris.
                    <br><br>
                    Proin ultrices, nibh eget dignissim aliquam, enim magna condimentum diam, quis consectetur quam mauris et purus. In at ultrices enim. Proin faucibus imperdiet dui, eget posuere arcu facilisis non. Phasellus ante ligula, iaculis vel gravida ac, tristique sit amet urna. Quisque pharetra, ante eu blandit varius, risus quam scelerisque dui, sit amet sagittis eros purus sed purus. Curabitur diam magna, pulvinar ut leo in, varius blandit tellus. Pellentesque orci dui, semper a gravida vitae, pulvinar id lectus. Sed felis lacus, gravida congue purus id, tempor dictum orci. Suspendisse nec viverra enim. In sit amet lectus est. Morbi sagittis sit amet nibh at ullamcorper. Ut commodo auctor elit eget varius. Nam non varius turpis.
                    <br><br>
                    In risus mi, elementum at lobortis vitae, euismod vel lacus. Nam ut consequat turpis. Sed cursus rutrum ante. Maecenas at leo vulputate, malesuada elit vel, lobortis justo. Cras convallis turpis nec rhoncus dapibus. Pellentesque vulputate pulvinar rutrum. Fusce aliquam maximus fermentum. Aenean tincidunt scelerisque magna quis hendrerit. Curabitur quis congue sapien. Proin sed orci rhoncus justo fringilla porttitor. Fusce vitae gravida erat, id ornare neque. In consectetur accumsan fermentum. Fusce blandit ligula eget mauris ultricies porta.
                    <br><br>
                    Aenean ultrices lacus a quam pretium fringilla. Curabitur a facilisis est. Sed facilisis fringilla tortor. Integer id eleifend nisl, et pharetra metus. Pellentesque eget pretium nunc. Suspendisse potenti. Nulla ut sem varius, tincidunt mauris ut, imperdiet nibh. 
                </div>
            </div>
            
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 50px auto;"></div>
            </div>
            
            <div class="col-lg-12" style="text-align: center;">
                <h1 style="color: #0273eb;font-size:28px">{l s='NOTE' d='Shop.Theme.Catalog'}</h1>
                <div style="margin-top: 30px; font-size: 20px; color: #666;line-height: 1.7; font-weight: bolder;">
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


