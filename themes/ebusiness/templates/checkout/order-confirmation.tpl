{extends file='page.tpl'}

{block name='page_content_container' prepend}
    <section id="content-hook_order_confirmation" class="card">
      <div class="card-block">
        <div class="row">
          <div class="col-md-12">

            {block name='order_confirmation_header'}
              <h3 class="h1 card-title">
                <i class="material-icons rtl-no-flip done">&#xE876;</i>{l s='Your order is confirmed' d='Shop.Theme.Checkout'}
              </h3>
            {/block}

            <p>
              {l s='An email has been sent to your mail address %email%.' d='Shop.Theme.Checkout' sprintf=['%email%' => $order_customer.email]}
              {if $order.details.invoice_url}
                {* [1][/1] is for a HTML tag. *}
                {l
                  s='You can also [1]download your invoice[/1]'
                  d='Shop.Theme.Checkout'
                  sprintf=[
                    '[1]' => "<a href='{$order.details.invoice_url}'>",
                    '[/1]' => "</a>"
                  ]
                }
              {/if}
            </p>

            {block name='hook_order_confirmation'}
              {$HOOK_ORDER_CONFIRMATION nofilter}
            {/block}

          </div>
        </div>
      </div>
    </section>
{/block}

{block name='page_content_container'}
  <section id="content" class="page-content page-order-confirmation card">
    <div class="card-block">
      <div class="row">

        {* {block name='order_confirmation_table'}
          {include
            file='checkout/_partials/order-confirmation-table.tpl'
            products=$order.products
            subtotals=$order.subtotals
            totals=$order.totals
            labels=$order.labels
            add_product_link=false
          }
        {/block} *}
        {* <pre>{$order->getTotals()|print_r}</pre> *}
        {assign var="order_totals" value=$order->getTotals()}

        {block name='order_details'}
          <div style="display: flex;flex-direction:column;gap:1rem;">
            <div>
              <p>{l s='Thank you again for choosing ALL STARS MOTORSPORT' d='Shop.Theme.Checkout'}</p>
              <p>{l s='Your order has been registered and payment instructions by bank transfer have been sent to your email address.' d='Shop.Theme.Checkout'}</p>
            </div>
            <div id="order-details">
              {* <h3 class="h3 card-title">{l s='Order details' d='Shop.Theme.Checkout'}:</h3> *}
              <ul style="padding: 0;">
                <li id="order-reference-value">{l s='Order reference: %reference%' d='Shop.Theme.Checkout' sprintf=['%reference%' => $order.details.reference]}</li>
                <li>{l s='Payment method: %method%' d='Shop.Theme.Checkout' sprintf=['%method%' => $order.details.payment]}</li>
                <li>{l s='A payer: %payment%' d='Shop.Theme.Checkout' sprintf=['%payment%' => $order_totals['total']['value']]}</li>
                {* {if !$order.details.is_virtual}
                  <li>
                    {l s='Shipping method: %method%' d='Shop.Theme.Checkout' sprintf=['%method%' => $order.carrier.name]}<br>
                    <em>{$order.carrier.delay}</em>
                  </li>
                {/if} *}
                {if $order.details.recyclable}
                  <li>  
                    <em>{l s='You have given permission to receive your order in recycled packaging.' d="Shop.Theme.Customeraccount"}</em>
                  </li>
                {/if}
              </ul>
            </div>
            <div>
              <h4>{l s='Important information:' d="Shop.Theme.Checkout"}</h4>
              <p>{l s='Bank transfers relating to orders placed on our ALL STARS MOTORSPORT platform must be made exclusively to our account, the details of which will be communicated to you by email in the next few seconds.' d="Shop.Theme.Checkout"}</p>
            </div>
          </div>
        {/block}

      </div>
    </div>
  </section>

  {* {block name='hook_payment_return'}
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
  {/block} *}

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

  {* <pre>{$urls|print_r}</pre> *}

  <section class="back-to-orders">
    <a class="btn-orders" href="{$urls.pages.history}">{l s='View your order history' d="Shop.Theme.Checkout"}</a>
  </section>

  {* {block name='hook_order_confirmation_2'}
    <section id="content-hook-order-confirmation-footer">
      {hook h='displayOrderConfirmation2'}
    </section>
  {/block} *}
{/block}
