{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 {extends file='customer/page.tpl'}

 {block name='page_title'}
   {l s='Order details' d='Shop.Theme.CustomerAccount'}
 {/block}
 
 {block name='page_content'}
   <section class="order-details-top">
     <div class="col-lg-7 px-0">
       <div class="col-lg-5 order-details-card1 pl-0">
         {block name='order_infos'}
           <div id="order-infos">
             <div class="title-box">
               <h3>{l s="Infos commande" d="Shop.Theme.OrderDetails"}</h3>
             </div>
             <div class="order-infos-content">
               <div><span class="order-infos-attribute">{l s='Reference' d='Shop.Theme.CustomerAccount'}</span> <span class="order-infos-description">{$order.details.reference}</span></div>
               <div><span class="order-infos-attribute">{l s='Date' d='Shop.Theme.CustomerAccount'}</span> <span class="order-infos-description">{$order.details.order_date}</span></div>
               <div><span class="order-infos-attribute">{l s='Payment Method' d='Shop.Theme.CustomerAccount'}</span> <span class="order-infos-description">{$order.details.payment}</span></div>
             </div>
             {* <div class="box">
                 <div class="row">
                   <div class="col-xs-{if $order.details.reorder_url}9{else}12{/if}">
                     <strong>
                       {l
                         s='Order Reference %reference% - placed on %date%'
                         d='Shop.Theme.CustomerAccount'
                         sprintf=['%reference%' => $order.details.reference, '%date%' => $order.details.order_date]
                       }
                     </strong>
                   </div>
                   {if $order.details.reorder_url}
                     <div class="col-xs-3 text-xs-right">
                       <a href="{$order.details.reorder_url}" class="button-primary">{l s='Reorder' d='Shop.Theme.Actions'}</a>
                     </div>
                   {/if}
                   <div class="clearfix"></div>
                 </div>
             </div>
 
             <div class="box">
                 <ul>
                   <li><strong>{l s='Carrier' d='Shop.Theme.Checkout'}</strong> {$order.carrier.name}</li>
                   <li><strong>{l s='Payment method' d='Shop.Theme.Checkout'}</strong> {$order.details.payment}</li>
 
                   {if $order.details.invoice_url}
                     <li>
                       <a href="{$order.details.invoice_url}">
                         {l s='Download your invoice as a PDF file.' d='Shop.Theme.CustomerAccount'}
                       </a>
                     </li>
                   {/if}
 
                   {if $order.details.recyclable}
                     <li>
                       {l s='You have given permission to receive your order in recycled packaging.' d='Shop.Theme.CustomerAccount'}
                     </li>
                   {/if}
 
                   {if $order.details.gift_message}
                     <li>{l s='You have requested gift wrapping for this order.' d='Shop.Theme.CustomerAccount'}</li>
                     <li>{l s='Message' d='Shop.Theme.CustomerAccount'} {$order.details.gift_message nofilter}</li>
                   {/if}
                 </ul>
             </div> *}
           </div>
         {/block}
 
         {block name='order_history'}
           <div id="order-history">
             <h6>{l s='Statut de commande' d='Shop.Theme.CustomerAccount'}</h6>
             {* <pre>{$order.history|print_r}</pre> *}
             {foreach $order.history as $key => $state}
               {if $key == 'current'}
               <div class="col-lg-12 px-0 container-current-state" onclick="toggleOrderStateHistory()">
                 <div class="order-state-label-date" style="background-color:{$state.color}">{$state.history_date} - <span class="ostate_name-label">{$state.ostate_name}</span></div>
                 <div class="order-state-label-title">{l s='History' d='Shop.Theme.CustomerAccount'}</div>
               </div>
               {else}
               {/if}
 
               <div class="col-lg-12 order-state-history px-0 mt-2">
               <table class="table table-striped table-bordered table-labeled ">
                 <thead class="thead-default">
                   <tr>
                     <th>{l s='Date' d='Shop.Theme.CustomerAccount'}</th>
                     <th>{l s='Status' d='Shop.Theme.CustomerAccount'}</th>
                   </tr>
                 </thead>
                 <tbody>
                   {foreach from=$order.history item=state}
                     <tr>
                       <td>{$state.history_date}</td>
                       <td>
                         <span class="label label-pill {$state.contrast}" style="background-color:{$state.color}">
                           {$state.ostate_name}
                         </span>
                       </td>
                     </tr>
                   {/foreach}
                 </tbody>
               </table>
             </div>
             {/foreach}
             
 
 
 
             
             {* <div class="hidden-sm-up history-lines">
               {foreach from=$order.history item=state}
                 <div class="history-line">
                   <div class="date">{$state.history_date}</div>
                   <div class="state">
                     <span class="label label-pill {$state.contrast}" style="background-color:{$state.color}">
                       {$state.ostate_name}
                     </span>
                   </div>
                 </div>
               {/foreach}
             </div> *}
           </div>
         {/block}
       </div>
       <div class="col-lg-7">
         {block name='order_carriers'}
           {if $order.shipping}
             <div class="order-shipping-container">
               <h3>{l s='Suivez vos colis' d='Shop.Theme.CustomerAccount'}</h3>
               <table class="table table-striped table-bordered ">
                 <thead class="thead-default">
                   <tr>
                     <th>{l s='Date' d='Shop.Theme.CustomerAccount'}</th>
                     <th>{l s='Carrier' d='Shop.Theme.Checkout'}</th>
                     {* <th>{l s='Weight' d='Shop.Theme.Checkout'}</th>
                     <th>{l s='Shipping cost' d='Shop.Theme.Checkout'}</th> *}
                     <th>{l s='Tracking number' d='Shop.Theme.Checkout'}</th>
                   </tr>
                 </thead>
                 <tbody>
                   {foreach from=$order.shipping item=line}
                     <tr>
                       <td>{$line.shipping_date}</td>
                       <td>{$line.carrier_name}</td>
                       {* <td>{$line.shipping_weight}</td>
                       <td>{$line.shipping_cost}</td> *}
                       <td>{$line.tracking}</td>
                     </tr>
                   {/foreach}
                 </tbody>
               </table>
               {* <div class="hidden-md-up shipping-lines">
                 {foreach from=$order.shipping item=line}
                   <div class="shipping-line">
                     <ul>
                       <li>
                         <strong>{l s='Date' d='Shop.Theme'}</strong> {$line.shipping_date}
                       </li>
                       <li>
                         <strong>{l s='Carrier' d='Shop.Theme.Checkout'}</strong> {$line.carrier_name}
                       </li> *}
                       {* <li>
                         <strong>{l s='Weight' d='Shop.Theme.Checkout'}</strong> {$line.shipping_weight}
                       </li>
                       <li>
                         <strong>{l s='Shipping cost' d='Shop.Theme.Checkout'}</strong> {$line.shipping_cost}
                       </li> *}
                       {* <li>
                         <strong>{l s='Tracking number' d='Shop.Theme.Checkout'}</strong> {$line.tracking}
                       </li>
                     </ul>
                   </div>
                 {/foreach}
               </div> *}
             </div>
           {/if}
         {/block}
       </div>
     </div>
 
     {* {if $order.follow_up}
       <div class="box">
         <p>{l s='Click the following link to track the delivery of your order' d='Shop.Theme.CustomerAccount'}</p>
         <a href="{$order.follow_up}">{$order.follow_up}</a>
       </div>
     {/if} *}
     <div class="col-lg-5 pl-0">
     {block name='addresses'}
       <div class="addresses">
         {if $order.addresses.delivery}
           <div class="container-delivery-address col-lg-6 col-md-6 col-sm-6 px-0 px-lg-3">
             <h3>{l s='Delivery address' d='Shop.Theme.CustomerAccount'}</h3>
             <div class="">
               <article id="delivery-address" >
                 {* <h4>{l s='Delivery address %alias%' d='Shop.Theme.Checkout' sprintf=['%alias%' => $order.addresses.delivery.alias]}</h4> *}
                 <address>{$order.addresses.delivery.formatted nofilter}</address>
               </article>
             </div>
           </div>
         {/if}
           <div class="container-invoice-address col-lg-6 col-md-6 col-sm-6 px-0 px-lg-3">
             <h3>{l s='Invoice address' d='Shop.Theme.CustomerAccount'}</h3>
             <div class="">
               <article id="invoice-address">
                 {* <h4>{l s='Invoice address %alias%' d='Shop.Theme.Checkout' sprintf=['%alias%' => $order.addresses.invoice.alias]}</h4> *}
                 <address>{$order.addresses.invoice.formatted nofilter}</address>
               </article>
             </div>
           </div>
         {* <div class="clearfix"></div> *}
       </div>
     {/block}
     </div>
   </section>
 
   <section class="order-details-bottom">
     {$HOOK_DISPLAYORDERDETAIL nofilter}
 
     {block name='order_detail'}
       {if $order.details.is_returnable}
         {include file='customer/_partials/order-detail-return.tpl'}
       {else}
         {include file='customer/_partials/order-detail-no-return.tpl'}
       {/if}
     {/block}
   </section>
 
   <section class="order-details-bottom-shipping hidden-md-up">
     <div class="title-shipping-bottom">
       <h3>{l s="Shipping" d="Shop.Theme.OrderDetails"}</h3>
     </div>
     <div class="content-shipping-bottom">
       <div class="content-shipping-item">
         <strong>{l s="Date" d="Shop.Theme.OrderDetails"}:</strong> <span>{$line.shipping_date}</span>
       </div>
       <div class="content-shipping-item">
         <strong>{l s="Carrier" d="Shop.Theme.OrderDetails"}:</strong> <span>{$line.carrier_name}</span>
       </div>
       <div class="content-shipping-item">
         <strong>{l s="Weight" d="Shop.Theme.OrderDetails"}:</strong> <span>{$line.weight|number_format:2} kg</span>
       </div>
       <div class="content-shipping-item">
         <strong>{l s="Shipping cost" d="Shop.Theme.OrderDetails"}:</strong> <span>{$line.shipping_cost}</span>
       </div>
       <div class="content-shipping-item">
         <strong>{l s="Tracking number" d="Shop.Theme.OrderDetails"}:</strong> <span>{$line.tracking}</span>
       </div>
 
     </div>
   </section>
 
 
 
   {* {block name='order_messages'}
     {include file='customer/_partials/order-messages.tpl'}
   {/block} *}
 {/block}
 