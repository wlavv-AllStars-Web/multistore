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
  {l s='Order history' d='Shop.Theme.CustomerAccount'}
{/block}

{block name='page_content'}
  <h6>{l s='Here are the orders you\'ve placed since your account was created.' d='Shop.Theme.CustomerAccount'}</h6>

  {if $orders}
    <table class="table table-striped table-bordered table-labeled hidden-md-down">
      <thead class="thead-default">
        <tr>
          <th class="text-center">{l s='Date' d='Shop.Theme.Checkout'}</th>
          <th class="text-center">{l s='Order reference' d='Shop.Theme.Checkout'}</th>
          <th class="text-center">{l s='Total price' d='Shop.Theme.Checkout'}</th>
          <th class="text-center">{l s='Status' d='Shop.Theme.Checkout'}</th>
          {* <th class="hidden-md-down">{l s='Payment' d='Shop.Theme.Checkout'}</th> *}
          <th class="text-center">{l s='Carrier' d='Shop.Theme.Customeraccount'}</th>
          <th class="text-center">{l s='Tracking' d='Shop.Theme.Customeraccount'}</th>
          <th class="text-center">{l s='Invoice' d='Shop.Theme.Checkout'}</th>
          {* <th>&nbsp;</th> *}
        </tr>
      </thead>
      <tbody>
        {foreach from=$orders item=order}
          <tr>
            <td class="text-center">{$order.details.order_date}</td>  
            <td scope="row" class="text-center">
              <a href="{$order.details.details_url}">
                {$order.details.reference}
              </a>
            </td>
            <td class="text-center">{$order.totals.total.value}</td>
            <td  class="text-center">
              <span
                class="label label-pill {$order.history.current.contrast}"
                style="background-color:{$order.history.current.color}"
              >
                {$order.history.current.ostate_name}
              </span>
              <span>
                <a href="{$link->getCMSLink(86)}">
                  <i class="material-icons">info_outline</i>
                </a>
              </span>
            </td>
            {* <td class="hidden-md-down">{$order.details.payment}</td> *}
            <td  class="text-center">
              {foreach from=$order.shipping item=line}
                {$line.carrier_name}
              {/foreach}
            </td>
            <td class="text-center" title="{l s='Tracking' d='Shop.Theme.Customeraccount'}">
              {foreach from=$order.shipping item=line}
                
                <div style="display: flex;flex-direction:column;">
                {if !empty($line.tracking_number)}
                  <div style="color: #0273eb;display:flex;align-items:center;gap:.5rem;justify-content:center;">
                    <i class="material-icons">local_shipping</i>  {$line.tracking}
                  </div>
                {else}
                    <span style="color: #333;">
                    {$line.tracking}
                    </span>
                {/if}
                </div>
              
              
              {/foreach}
            </td>
            <td class="text-center">
              {if $order.details.invoice_url}
                <a href="{$order.details.invoice_url}"><i class="material-icons">&#xE415;</i></a>
              {else}
                -
              {/if}
            </td>
            {* <td class="text-xs-center order-actions">
              <a href="{$order.details.details_url}" data-link-action="view-order-details">
                {l s='Details' d='Shop.Theme.CustomerAccount'}
              </a>
              {if $order.details.reorder_url}
                <a href="{$order.details.reorder_url}">{l s='Reorder' d='Shop.Theme.Actions'}</a>
              {/if}
            </td> *}
          </tr>
        {/foreach}
      </tbody>
    </table>

    <div class="orders hidden-lg-up mobile-table-orders">
      {foreach from=$orders item=order}
        <div class="order">
          <div class="row">
            <div class="col-xs-10">
              <a href="{$order.details.details_url}"><h3>{$order.details.reference}</h3></a>
              <div class="date">{$order.details.order_date}</div>
              <div class="total">{$order.totals.total.value}</div>
              <div class="status">
                <span
                  class="label label-pill {$order.history.current.contrast}"
                  style="background-color:{$order.history.current.color}"
                >
                  {$order.history.current.ostate_name}
                </span>
                <span>
                  <a href="{$link->getCMSLink(86)}">
                    <i class="material-icons">info_outline</i>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-xs-2 text-xs-right right-side-order">
                <div>
                  <a href="{$order.details.details_url}" data-link-action="view-order-details" title="{l s='Details' d='Shop.Theme.CustomerAccount'}">
                    <i class="material-icons">&#xE8B6;</i>
                  </a>
                </div>
                {if $order.details.reorder_url}
                  <div>
                    <a href="{$order.details.reorder_url}" title="{l s='Reorder' d='Shop.Theme.Actions'}">
                      <i class="material-icons">&#xE863;</i>
                    </a>
                  </div>
                {/if}
            </div>
          </div>
        </div>
      {/foreach}
    </div>

  {/if}
{/block}
