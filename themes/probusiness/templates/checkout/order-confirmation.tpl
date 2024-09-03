{extends file='page.tpl'}

{block name='page_content_container' prepend}
    <section id="content-hook_order_confirmation" class="card">
      <div class="card-block">
        <div class="row">
          <div class="col-md-12">
            <div class="banner_order_confirmation" style="max-width: 1350px;display:flex;justify-content:center;margin-bottom:2rem;">
              <img class="p-img" src="/img/asd/Content_pages/order-confirmation/orderconf_{$language.iso_code}.webp" style="width: 100%;height:auto;" />
            </div>
          </div>
          <div class="col-md-12" style="padding: 2rem 0;">

            {block name='order_confirmation_header'}
              <div style="display: flex; gap:1rem;justify-content:center;align-items:center;">
                <img src="/img/asd/icon_correct.svg" width="40" height="40" style="width: 40px;height:auto;"/>
                <h3 class="h1 card-title" style="text-align: center;font-weight:400;margin-bottom: 0;">
                  {* <i class="material-icons rtl-no-flip done" style="font-size: 2rem;">&#xE876;</i> *}
                  {l s='Order' d='Shop.Theme.OrderConfirmation'}
                </h3>
                <h3 class="h1 card-title" style="text-align: center;margin-bottom: 0;">
                  <strong>{$order.details.reference}</strong>
                </h3>

                <h3 class="h1 card-title" style="text-align: center;font-weight:400;margin-bottom: 0;">
                  {l s='Registered' d='Shop.Theme.OrderConfirmation'}
                </h3>
              </div>
              <br>
            {/block}

            <div style="text-align: center;margin-top:2rem;">
              <p style="font-size: 18px;color: #333;">{l s="In the next few minutes, you will receive an order confirmation by email including the delivery costs to allow you to make your payment via the selected method." d="Shop.Theme.OrderConfirmation"}</p>
              <br>
              <p style="font-size: 18px;color: #333;">{l s="Please pay attention to any comments that may be present on the order confirmation (ETA, availability, modification, etc.)." d="Shop.Theme.OrderConfirmation"}</p>
              <br>
              <div class="warnig-order-confirmation" style="width: 100%;display:flex;justify-content:center;margin-block: 2rem 1rem;">
                <img src="/img/asd/icon_danger.svg" width="45" height="45" style="width: 45px;height:auto;" />
              </div>
              <p style="font-size: 18px;color: #333;">{l s="Please do not make any payment before receiving and checking the order confirmation sent by our sales department." d="Shop.Theme.OrderConfirmation"}</p>
              <br>
              <p style="font-size: 18px;color: #333;">{l s="Thank you" d="Shop.Theme.OrderConfirmation"}</p>
              <br>
              <div>
                <a class="btn btn-primary btn-view-history" href="{$link->getPageLink('my-account')}" title="Go to your order history page">{l s="Order history" d="Shop.Theme.Customeraccount"}</a>
              </div>
            </div>

            {* <p>
              {l s='An email has been sent to your mail address %email%.' d='Shop.Theme.Checkout' sprintf=['%email%' => $order_customer.email]}
              {if $order.details.invoice_url}
                
                {l
                  s='You can also [1]download your invoice[/1]'
                  d='Shop.Theme.Checkout'
                  sprintf=[
                    '[1]' => "<a href='{$order.details.invoice_url}'>",
                    '[/1]' => "</a>"
                  ]
                }
              {/if}
            </p> *}

            {block name='hook_order_confirmation'}
              {$HOOK_ORDER_CONFIRMATION nofilter}
            {/block}

          </div>
        </div>
      </div>
    </section>
{/block}

{block name='page_content_container'}
  {*
  <section id="content" class="page-content page-order-confirmation card">
    <div class="card-block">
      <div class="row">

        {block name='order_confirmation_table'}
          {include
            file='checkout/_partials/order-confirmation-table.tpl'
            products=$order.products
            subtotals=$order.subtotals
            totals=$order.totals
            labels=$order.labels
            add_product_link=false
          }
        {/block}

        {block name='order_details'}
          <div id="order-details" class="col-md-4">
            <h3 class="h3 card-title">{l s='Order details' d='Shop.Theme.Checkout'}:</h3>
            <ul>
              <li id="order-reference-value">{l s='Order reference: %reference%' d='Shop.Theme.Checkout' sprintf=['%reference%' => $order.details.reference]}</li>
              <li>{l s='Payment method: %method%' d='Shop.Theme.Checkout' sprintf=['%method%' => $order.details.payment]}</li>
              {if !$order.details.is_virtual}
                <li>
                  {l s='Shipping method: %method%' d='Shop.Theme.Checkout' sprintf=['%method%' => $order.carrier.name]}<br>
                  <em>{$order.carrier.delay}</em>
                </li>
              {/if}
              {if $order.details.recyclable}
                <li>  
                  <em>{l s='You have given permission to receive your order in recycled packaging.' d="Shop.Theme.Customeraccount"}</em>
                </li>
              {/if}
            </ul>
          </div>
        {/block}

      </div>
    </div>
  </section>

  {block name='hook_payment_return'}
    {if ! empty($HOOK_PAYMENT_RETURN)}
    <section id="content-hook_payment_return" class="card definition-list">
      <div class="card-block">
        <div class="row">
          <div class="col-md-12">
            {$HOOK_PAYMENT_RETURN nofilter}
          </div>
        </div>
      </div>
    </section>
    {/if}
  {/block}

  {if !$registered_customer_exists}
    {block name='account_transformation_form'}
      <div class="card">
        <div class="card-block">
          {include file='customer/_partials/account-transformation-form.tpl'}
        </div>
      </div>
    {/block}
  {/if}

  {block name='hook_order_confirmation_1'}
    {hook h='displayOrderConfirmation1'}
  {/block}
  *}



{/block}
