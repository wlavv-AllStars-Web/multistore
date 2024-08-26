{extends file='customer/page.tpl'}

{block name='page_title'}
    <div class="col-lg-12 banner-myaccount" style="margin-bottom: 1rem;padding:0;">
        <img src="/img/asd/Content_pages/order-details/order_{$language.iso_code}.webp" alt="account_banner" />
    </div>
{/block}

{block name='page_content'}

    {block name='order_infos'}
        <div id="order-infos">
            <div class="box">
                <div class="row">
                    <div class="col-xs-{if $order.details.reorder_url}9{else}12{/if}" style="text-align: center;text-transform: uppercase;font-size: 34px;">
                        <strong style="color: #777;"> {l s='Order' d='Shop.Theme.Actions'} <span style="color: #0273eb">{$order.details.reference}</span> <strong>
                    </div>
                <div class="clearfix"></div>
            </div>
        </div>
        
        <div class="">
            <table class="table table-striped table-bordered hidden-sm-down">
                <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                    <tr>
                        <td>{l s='Date'     d='Shop.Theme.Actions'}</td>
                        <td>{l s='Montant'  d='Shop.Theme.Checkout'}</td>
                        <td>{l s='Payment'  d='Shop.Theme.Checkout'}</td>
                        <td>{l s='Shipping' d='Shop.Theme.Checkout'}</td>
                        {if $order.details.invoice_url}
                            <td>{l s='Invoice' d='Shop.Theme.Checkout'}</td>
                        {else}
                            <td>{l s='Valid to' d='Shop.Theme.Checkout'}</td>
                        {/if}
                    </tr>
                </thead>
                <tbody style="text-align: center;font-size: 18px;">
                    <tr>
                        <td>{$order.history.current.date_add|date_format:"d-m-Y"}</td>
                        <td>{$order.totals.total.value|escape:'html':'UTF-8'}</td>
                        <td>{$order->details->getPayment()}</td>
                        <td>{$order.shipping[0].carrier_name}</td>
                        
                        {if $order.details.invoice_url}
                            <td>
                                <a href="{$order.details.invoice_url|escape:'html':'UTF-8'}" style="display: block;">
                                  <img src="/img/asd/icon_invoice.svg" width="23" height="23" style="width: 23px;height:auto;" />
                                </a>
                            </td>
                        {else}
                            <td>{$order.history.current.date_add|cat:' +5 days'|strtotime|date_format:"d-m-Y"}</td>
                        {/if}
                    </tr>
                </tbody>
            </table>
        </div>
    {/block}

    {block name='addresses'}
        <div class="addresses">
            {if $order.addresses.delivery}
            <div class="col-lg-6 col-md-6 col-sm-6">
                <article id="delivery-address" class="box">
                    <h4 style="font-size: 24px;border-bottom: 3px solid #0273eb;padding: 10px 0;text-transform: uppercase">{l s='Delivery address' d='Shop.Theme.Checkout'}</h4>
                    <address style="font-size: 18px; line-height: 1.4;">{$order.addresses.delivery.formatted nofilter}</address>
                </article>
            </div>
            {/if}
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                <article id="invoice-address" class="box" style="text-align: right;">
                    <h4 style="font-size: 24px;border-bottom: 3px solid #0273eb;padding: 10px 0;text-transform: uppercase">{l s='Invoice address' d='Shop.Theme.Checkout'}</h4>
                    <address style="font-size: 18px; line-height: 1.4;">{$order.addresses.invoice.formatted nofilter}</address>
                </article>
            </div>
            <div class="clearfix"></div>
        </div>
    {/block}

    {$HOOK_DISPLAYORDERDETAIL nofilter}

    {block name='order_detail'}
        {if $order.details.is_returnable}
            {include file='customer/_partials/order-detail-return.tpl'}
        {else}
            {include file='customer/_partials/order-detail-no-return.tpl'}
        {/if}
    {/block}

    {block name='order_history'}
        <section id="order-history" class="">
            <h3 style="text-align: center; border-top: 3px solid #0273eb;padding: 20px 0 10px 0;text-transform: uppercase;font-size: 24px;margin-top: 60px;">{l s='Status history' d='Shop.Theme.Actions'}</h3>
            <table class="table table-striped table-bordered table-labeled hidden-xs-down">
                <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                    <tr>
                        <td>{l s='Date' d='Shop.Theme.Actions'}</td>
                        <td>{l s='Status' d='Shop.Theme.Actions'}</td>
                    </tr>
            </thead>
            <tbody>
                {foreach from=$order.history item=state}
                    <tr style="text-align: center;font-size: 18px">
                        <td>{$state.history_date|escape:'html':'UTF-8'}</td>
                        <td> <span class="label label-pill {$state.contrast|escape:'html':'UTF-8'}" style="background-color:{$state.color|escape:'html':'UTF-8'}"> {$state.ostate_name|escape:'html':'UTF-8'} </span> </td>
                    </tr>
                {/foreach}
            </tbody>
          </table>
          <div class="hidden-sm-up history-lines">
            {foreach from=$order.history item=state}
              <div class="history-line">
                <div class="date">{$state.history_date|escape:'html':'UTF-8'}</div>
                <div class="state">
                  <span class="label label-pill {$state.contrast|escape:'html':'UTF-8'}" style="background-color:{$state.color|escape:'html':'UTF-8'}">
                    {$state.ostate_name|escape:'html':'UTF-8'}
                  </span>
                </div>
              </div>
            {/foreach}
          </div>
        </section>
    {/block}

    {if $order.follow_up}
        <div class="box">
            <p>{l s='Click the following link to track the delivery of your order' d='Shop.Theme.Actions'}</p>
            <a href="{$order.follow_up|escape:'html':'UTF-8'}">{$order.follow_up|escape:'html':'UTF-8'}</a>
        </div>
    {/if}

    {block name='order_carriers'}
        {if $order.shipping}
            <div class="">
                <h3 style="text-align: center; border-top: 3px solid #0273eb;padding: 20px 0 10px 0;text-transform: uppercase;font-size: 24px;margin-top: 60px;">{l s='Information' d='Shop.Theme.Actions'}</h3>
                <table class="table table-striped table-bordered hidden-sm-down" style>
                    <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                        <tr>
                            <td>{l s='Last update' d='Shop.Theme.Actions'}</td>
                            <td>{l s='Weight' d='Shop.Theme.Checkout'}</td>
                            <td>{l s='Carrier' d='Shop.Theme.Checkout'}</td>
                            <td>{l s='Tracking' d='Shop.Theme.Checkout'}</td>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$order.shipping item=line}
                            <tr style="text-align: center;font-size: 18px">
                                <td>{$line.shipping_date|escape:'html':'UTF-8'}</td>
                                <td>{$line.weight|number_format:2:".":","} Kg</td>
                                <td>{$line.carrier_name|escape:'html':'UTF-8'}</td>
                                <td>{$line.tracking|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {/if}
    {/block}
{/block}
