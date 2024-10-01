{if count($listing.products) > 1}
    <div class="qs-warning">
        <p>{l s="Please verify the product reference." d="Shop.Theme.Quickshop"}</p>
    </div>
{/if}

{* <pre>{print_r($listing,1)}</pre> *}

<div class="productsQS{if !empty($cssClass)} {$cssClass}{/if}">
    {if empty($listing.products)}
        <p style="font-size: 1rem;">{l s="No products found..." d="Shop.Theme.Quickshop"}</p>
    {/if}
    {* {if $isFather != 0 && $child_attribute == 0 }
        <p style="font-size: 1rem;">{l s="No products found..." d="Shop.Theme.Quickshop"}</p>
        aqui 2
    {else} *}
        {foreach from=$listing.products item="product" key="position"}
            {* {include file="catalog/_partials/miniatures/product.tpl" product=$product position=$position productClasses=$productClasses} *}
            {* <pre>{print_r($product.id_product_attribute,1)}</pre> *}
            <div class="qs-product" 
            data-id-product="{$product.id_product}" 
            data-child-id-product-attribute="{$product.product_attribute_atr}" 
            data-id-product-attribute="{$product.id_product_attribute}" 
        
            style="display: flex;align-items:center;" 
            data-product-json="{$product|json_encode|escape:'htmlall':'UTF-8'}" 
            onclick="setProductQS(this, this.getAttribute('data-product-json'))"
            >
                <div class="qs-product-cover">
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
                                style="width:80px;height:80px;"
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
                                style="width:80px;height:80px;"
                            />
                            </picture>
                        </a>
                        {/if}
                    {/block}
                </div>
                
                <div class="qs-product-description" style="padding: 0 1rem;">
                    {block name='product_name'}
                        <div class="quick-product-description">
                            <p>{$product.name}
                            -<span>
                            {if $child_reference}
                                {$child_reference}
                            {else}
                                {$product.reference}
                            {/if}
                            </span></p>
                        </div>
                {/block}
                </div>
            </div>


            
        {/foreach}
    {* {/if} *}
</div>

<style>
    .productsQS{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 1rem;
    }
    .qs-product{
        width: 100%;
        outline: 1px solid #dedede;
        overflow: hidden;
        padding: 0.5rem;
        cursor: pointer;
        border-radius: 0.25rem;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .qs-product:hover{
        outline: 2px solid #0273eb;
    }

    .quick-product-description p{
        margin-bottom: 0;
    }
</style>
