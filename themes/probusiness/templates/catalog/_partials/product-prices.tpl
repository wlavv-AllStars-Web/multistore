{if $product.show_price}
    <div style="font-size: 24px; color: #666; font-weight: bold; line-height: 1.7; margin-bottom: 0px;">
        {block name='product_discount'}
            
                <div>
                    {hook h='displayProductPriceBlock' product=$product type="old_price"}
                    <div>{l s="RRP / PVP" d="Shop.Theme.ProductList"}:  <span style="font-weight: 400;">{$product.price_without_reduction_without_tax|number_format:2:".":" "}€ <span style="font-size: 12px;font-weight:600;color:#666;">({l s="ExVAT" d='Shop.Theme.Modal'})</span></span></div>
                    {if $product.has_discount}
                    <div>{l s="Discount" d="Shop.Theme.ProductList"}:  <span style="font-weight: 400;">{$product.discount_percentage}</span></div>
                    {/if}
                </div>
        {/block}

        {block name='product_price'}
          {if $product.has_discount}
            <div>
                {l s="Your Price " d="Shop.Theme.ProductList"}:
                
                {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='product_sheet'}{/capture}
                
                <span style="color: #0273eb;font-weight:600;"> {if '' !== $smarty.capture.custom_price} {$smarty.capture.custom_price nofilter} {else} {($product.price_without_reduction_without_tax - $product.reduction_without_tax)|number_format:2:".":" "}€ <span style="font-size: 12px;font-weight:600;color:#666;">({l s="ExVAT" d='Shop.Theme.Modal'})</span>{/if} </span>

                {block name='product_unit_price'}
                    {if $displayUnitPrice}
                        <p class="product-unit-price sub">{$product.unit_price_full}</p>
                    {/if}
                {/block}
                <div>{l s="Your Margin " d="Shop.Theme.ProductList"}: <span style="font-weight: 400;">{($product.price_without_reduction_without_tax - ($product.price_without_reduction_without_tax - $product.reduction_without_tax))|number_format:2:".":" "}€ </span></div>
            </div>
          {/if}
        {/block}

    {block name='product_without_taxes'}
      {if $priceDisplay == 2}
        <p class="product-without-taxes">{l s='%price% tax excl.' d='Shop.Theme.Catalog' sprintf=['%price%' => $product.price_tax_exc]}</p>
      {/if}
    {/block}

    {block name='product_pack_price'}
      {if $displayPackPrice}
        <p class="product-pack-price"><span>{l s='Instead of %price%' d='Shop.Theme.Catalog' sprintf=['%price%' => $noPackPrice]}</span></p>
      {/if}
    {/block}

    {block name='product_ecotax'}
        {if !$product.is_virtual && $product.ecotax.amount > 0}
        <p class="price-ecotax">{l s='Including %amount% for ecotax' d='Shop.Theme.Catalog' sprintf=['%amount%' => $product.ecotax.value]}
          {if $product.has_discount}
            {l s='(not impacted by the discount)' d='Shop.Theme.Catalog'}
          {/if}
        </p>
      {/if}
    {/block}

    {hook h='displayProductPriceBlock' product=$product type="weight" hook_origin='product_sheet'}

  </div>
{/if}
