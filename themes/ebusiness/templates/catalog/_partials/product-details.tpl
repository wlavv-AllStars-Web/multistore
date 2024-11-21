<div class="tab-pane {if !$product.description} in active{/if}"
     id="product-details"
     data-product="{$product.embedded_attributes|json_encode}"
  >

  {block name='product_reference'}
    <div class="subtitles-details">

            <div class="subtitles-details-left">
              <div class="details-reference product-reference"><b>Reference:</b> {$product.reference_to_display}</div>
              <div class="details-ec"><b>EC Approved:</b> <span class="not-aproved">No</span></div>
            </div>



            <div class="subtitles-details-right">
            {block name='product_availability'}
               
              <span id="product-availability" class="js-product-availability" >
                {if $product.show_availability && $product.availability_message}
                  {if $product.availability == 'available'}
                  {* <i class="material-icons rtl-no-flip product-available">&#xE5CA;</i> *}
                  
                  {elseif $product.availability == 'last_remaining_items'}
                    {* <i class="material-icons product-last-items">&#xE002;</i> *}
                    <div>Availability: <span style="background: #ff9a52;color:#f2f2f2;padding: 0.25rem 0.5rem;">{$product.availability_message}</span></div>
                    {else}
                      {* <i class="material-icons product-unavailable">&#xE14B;</i> *}
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

            {/block}
              <div>Shipped from EU</div>
            </div>

           </div>
  {/block}
  
  {block name='product_reference'}
    {* {if isset($product_manufacturer->id)}
      <div class="product-manufacturer">
        {if isset($manufacturer_image_url)}
          <a href="{$product_brand_url}">
            <img src="{$manufacturer_image_url}" class="img img-thumbnail manufacturer-logo" alt="" />
          </a>
        {else}
          <label class="label">{l s='Brand' d='Shop.Theme.Catalog'}</label>
          <span>
            <a href="{$product_brand_url}">{$product_manufacturer->name}</a>
          </span>
        {/if}
      </div>
    {/if} *}
    
    {if isset($product.reference_to_display)}
        {if isset($tc_config.YBC_TC_PRODUCT_REF) && $tc_config.YBC_TC_PRODUCT_REF == 1}
          <div class="product-reference">
            <label class="label">{l s='Reference' d='Shop.Theme.Catalog'} </label>
            <span itemprop="sku">{$product.reference_to_display}</span>
          </div>
        {/if}
    {/if}
    
    
    {/block}
    {block name='product_quantities'}
      {if $product.show_quantities}
        {if isset($tc_config.YBC_TC_PRODUCT_QTY) && $tc_config.YBC_TC_PRODUCT_QTY == 1}
        <div class="product-quantities">
          <label class="label">{l s='In stock' d='Shop.Theme.Catalog'}</label>
          <span>{$product.quantity} {$product.quantity_label}</span>
        </div>
        {/if}
      {/if}
    {/block}
    {block name='product_availability_date'}
      {if $product.availability_date}
        <div class="product-availability-date">
          <label>{l s='Availability date:' d='Shop.Theme.Catalog'} </label>
          <span>{$product.availability_date}</span>
        </div>
      {/if}
    {/block}
    {block name='product_out_of_stock'}
      <div class="product-out-of-stock">
        {hook h='actionProductOutOfStock' product=$product}
      </div>
    {/block}

    {block name='product_features'}
      {if $product.features}
        <section class="product-features">
          <h3 class="h6">{l s='Data sheet' d='Shop.Theme.Catalog'}</h3>
          <dl class="data-sheet">
            {foreach from=$product.features item=feature}
              <dt class="name">{$feature.name}</dt>
              <dd class="value">{$feature.value}</dd>
            {/foreach}
          </dl>
        </section>
      {/if}
    {/block}

    {* if product have specific references, a table will be added to product details section *}
    {* {block name='product_specific_references'}
      {if isset($product.specific_references)}
        <section class="product-features">
          <h3 class="h6">{l s='Specific References' d='Shop.Theme.Catalog'}</h3>
            <dl class="data-sheet">
              {foreach from=$product.specific_references item=reference key=key}
                <dt class="name">{$key}</dt>
                <dd class="value">{$reference}</dd>
              {/foreach}
            </dl>
        </section>
      {/if}
    {/block} *}

    {block name='product_condition'}
      {if $product.condition}
        <div class="product-condition">
          <label class="label">{l s='Condition' d='Shop.Theme.Catalog'} </label>
          <link itemprop="itemCondition" href="{$product.condition.schema_url}"/>
          <span>{$product.condition.label}</span>
        </div>
      {/if}
    {/block}
</div>
