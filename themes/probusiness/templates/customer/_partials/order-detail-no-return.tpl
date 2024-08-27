{block name='order_products_table'}

        

    <div class="hidden-sm-down">
        <table id="order-products" class="table table-bordered">
            <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;font-size: 16px;font-weight:700;">
                <tr style="text-align: center;">
                    <td>{l s='Reference' d='Shop.Theme.Catalog'}</td>
                    <td>{l s='Product' d='Shop.Theme.Catalog'}</td>
                    <td>{l s='Unit Price' d='Shop.Theme.Catalog'}</td>
                    <td>{l s='Discount' d='Shop.Theme.Catalog'}</td>
                    <td>{l s='Quantity' d='Shop.Theme.Catalog'}</td>
                    <td>{l s='Total Price' d='Shop.Theme.Catalog'}</td>
                </tr>
            </thead>

            {foreach from=$order.products item=product}
                <tr style="font-size: 16px;font-weight:400;text-align: center;">
                    <td>
                    {$product.reference|escape:'html':'UTF-8'} </td>
                    <td> <a style="display: block;" {if isset($product.download_link)}href="{$product.download_link|escape:'html':'UTF-8'}"{/if}> {$product.name|escape:'html':'UTF-8'} </a> 
                        {if $product.customizations}
                            {foreach from=$product.customizations item="customization"}
                                <div class="customization">
                                    <a href="#" data-toggle="modal" data-target="#product-customizations-modal-{$customization.id_customization|escape:'html':'UTF-8'}">{l s='Product customization' d='Shop.Theme.Catalog'}</a>
                                </div>
                                <div id="_desktop_product_customization_modal_wrapper_{$customization.id_customization|escape:'html':'UTF-8'}">
                                    <div class="modal fade customization-modal" id="product-customizations-modal-{$customization.id_customization|escape:'html':'UTF-8'}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                    <h4 class="modal-title">{l s='Product customization' d='Shop.Theme.Catalog'}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {foreach from=$customization.fields item="field"}
                                                        <div class="product-customization-line row">
                                                            <div class="col-sm-3 col-xs-4 label"> {$field.label|escape:'html':'UTF-8'} </div>
                                                            <div class="col-sm-9 col-xs-8 value">
                                                                {if $field.type == 'text'}
                                                                    {if (int)$field.id_module} {$field.text nofilter}
                                                                    {else} {$field.text|escape:'html':'UTF-8'}
                                                                    {/if}
                                                                {elseif $field.type == 'image'} <img src="{$field.image.small.url|escape:'html':'UTF-8'}"> {/if}
                                                            </div>
                                                        </div>
                                                    {/foreach}
                                                </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        {/if}                    
                    </td>        
                    <td>{number_format($product.total_price_tax_excl / (1-($product.reduction_percent/100)), 2, '.', ',')} €</td>        
                    <td>{number_format($product.reduction_percent, 0)} %</td>
                    <td>
                        {if $product.customizations}
                            {foreach $product.customizations as $customization}
                                {$customization.quantity|escape:'html':'UTF-8'}
                            {/foreach}
                        {else}
                            {$product.quantity|escape:'html':'UTF-8'}
                        {/if}
                    </td>
                    <td>{number_format($product.total_price_tax_excl, 2, '.', ',')} €</td>
                </tr>
            {/foreach}
            <tfoot>
                {if ($order.totals.total_including_tax.amount - $order.totals.total_excluding_tax.amount ) > 0}
                <tr style="font-size: 16px;text-align: center;" class="line-{$order.totals.total.type|escape:'html':'UTF-8'}">
                    <td colspan="5" style="text-align: right;font-weight:700;">{l s='Total taxes' d='Shop.Theme.Catalog'}</td>
                    <td style="font-weight:400;">{number_format($order.totals.total_including_tax.amount - $order.totals.total_excluding_tax.amount, 2, '.', ',')} €</td>
                </tr>
                {/if}

                <tr style="font-size: 16px;text-align: center;" class="line-{$order.totals.total.type|escape:'html':'UTF-8'}">
                    <td colspan="5" style="text-align: right;font-weight:700;">{l s='Total paid' d='Shop.Theme.Catalog'}</td>
                    <td style="font-weight:400;">{$order.totals.total.value|escape:'html':'UTF-8'}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="order-items hidden-md-up box">
        {foreach from=$order.products item=product}
            <div class="order-item">
            <div class="row">
              <div class="col-md-5 col-sm-12 col-xs-12 desc">
                <div class="name">{$product.name|escape:'html':'UTF-8'}</div>
                {if $product.reference}
                  <div class="ref">{l s='Reference' d='Shop.Theme.Catalog'}: {$product.reference|escape:'html':'UTF-8'}</div>
                {/if}
                {if $product.customizations}
                  {foreach $product.customizations as $customization}
                    <div class="customization">
                      <a href="#" data-toggle="modal" data-target="#product-customizations-modal-{$customization.id_customization|escape:'html':'UTF-8'}">{l s='Product customization' d='Shop.Theme.Catalog'}</a>
                    </div>
                    <div id="_mobile_product_customization_modal_wrapper_{$customization.id_customization|escape:'html':'UTF-8'}">
                    </div>
                  {/foreach}
                {/if}
              </div>
              <div class="col-md-7 col-sm-12 col-xs-12 qty">
                <div class="row">
                  <div class="col-xs-4 text-sm-left text-xs-left">
                    {$product.price|escape:'html':'UTF-8'}
                  </div>
                  <div class="col-xs-4">
                    {if $product.customizations}
                      {foreach $product.customizations as $customization}
                        {$customization.quantity|escape:'html':'UTF-8'}
                      {/foreach}
                    {else}
                      {$product.quantity|escape:'html':'UTF-8'}
                    {/if}
                  </div>
                  <div class="col-xs-4 text-xs-right">
                    {$product.total|escape:'html':'UTF-8'}
                  </div>
                </div>
              </div>
            </div>
          </div>
        {/foreach}
    </div>
    
    <div class="order-totals hidden-md-up box">
        
        {foreach $order.subtotals as $line}
        
            {if ($line.value)}
                <div class="order-total row">
                    <div class="col-xs-8"><strong>{$line.label|escape:'html':'UTF-8'} - {$line.type}</strong></div>
                    <div class="col-xs-4 text-xs-right">{$line.value|escape:'html':'UTF-8'}</div>
                </div>
            {/if}
        {/foreach}
        <div class="order-total row">
            <div class="col-xs-8"><strong>{$order.totals.total.label|escape:'html':'UTF-8'}</strong></div>
            <div class="col-xs-4 text-xs-right">{$order.totals.total.value|escape:'html':'UTF-8'}</div>
        </div>
    </div>
{/block}
