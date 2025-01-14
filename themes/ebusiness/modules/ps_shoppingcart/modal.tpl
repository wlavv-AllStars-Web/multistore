<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title h6 text-xs-center" id="myModalLabel"><i class="material-icons">&#xE876;</i>{l s='Product successfully added to your shopping cart' d='Shop.Theme.Checkout'}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 divide-right">
            <div class="row">
              <div class="col-md-6">
                <img class="product-image" src="{$product.cover.large.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" itemprop="image">
              </div>
              <div class="col-md-6">
                <h6 class="h6 product-name">{$product.name}</h6>
                <p>{$product.price}</p>
                {hook h='displayProductPriceBlock' product=$product type="unit_price"}
                
                {foreach from=$product.attributes item="property_value" key="property"}
                  {$property != "Pack content"}
                  {if $property != "Pack content" || $property != "Contenido del pack" || $property != "Contenu du pack"}
                  <span><strong>{$property}</strong>: {$property_value}</span><br>
                  {else}
                    {if $packProducts}
                      <ul class="ap5_pack_product_list ap5_pack_product_list_block_cart">
                        {foreach from=$packProducts item='packProduct'}
                          <li>
                            <span class="badge badge-dark">{$packProduct['quantity']}x</span> {$packProduct['reference']|escape:'htmlall':'UTF-8'}
                            {if isset($packProduct['attributes_small']) && !empty($packProduct['attributes_small'])}<br /><em>{$packProduct['attributes_small']|escape:'htmlall':'UTF-8'}</em>{/if}
                          </li>
                        {/foreach}
                      </ul>
                    {/if}
                  {/if}
                {/foreach}

                
                <p><strong>{l s='Quantity:' d='Shop.Theme.Checkout'}</strong>&nbsp;{$product.cart_quantity}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="cart-content">
              {if $cart.products_count > 1}
                <p class="cart-products-count">{l s='There are %products_count% items in your cart.' sprintf=['%products_count%' => $cart.products_count] d='Shop.Theme.Checkout'}</p>
              {else}
                <p class="cart-products-count">{l s='There is %product_count% item in your cart.' sprintf=['%product_count%' =>$cart.products_count] d='Shop.Theme.Checkout'}</p>
              {/if}
              <p><strong>{l s='Total products:' d='Shop.Theme.Checkout'}</strong>&nbsp;{$cart.subtotals.products.value}</p>
              <p><strong>{l s='Total shipping:' d='Shop.Theme.Checkout'}</strong>&nbsp;{$cart.subtotals.shipping.value} {hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</p>
              {if $cart.subtotals.tax}
              	<p><strong>{$cart.subtotals.tax.label}</strong>&nbsp;{$cart.subtotals.tax.value}</p>
              {/if}
              <p><strong>{l s='Total:' d='Shop.Theme.Checkout'}</strong>&nbsp;{$cart.totals.total.value} {$cart.labels.tax_short}</p>
              <div class="container-buttons-modal-blockcart">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{l s='Continue shopping' d='Shop.Theme.Actions'}</button>
                <a href="{$order_url}" class="btn btn-primary"><i class="material-icons">&#xE876;</i>{l s='proceed to checkout' d='Shop.Theme.Actions'}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Select the span element containing "Pack content"
  const packContentSpan = document.querySelector('.modal-body span:has(strong:contains("Pack content"))');

  // Check if the span element exists
  if (packContentSpan) {
    // Remove the span element from the DOM
    packContentSpan.remove();
    console.log("Pack content span removed successfully.");
  } else {
    console.log("No Pack content span found.");
  }
});

</script>

