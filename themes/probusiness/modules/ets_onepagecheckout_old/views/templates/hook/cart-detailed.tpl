{*
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
*}
<div class="cart-overview js-cart" data-refresh-url="{$link->getModuleLink('ets_onepagecheckout','order',['ajax' => true, 'action' => 'refresh'])|escape:'html':'UTF-8'}">
    {if isset($cart.products) &&  $cart.products}

    <table class="col-lg-12">
      <thead style="background: #e7e7e7;">
        <tr>
          <th class="text-center cart_delete last_item">&nbsp;</th>
          <th class="text-center cart_product first_item">Produto</th>
          <th class="text-center cart_description item">Descrição</th>
          <th class="text-center cart_unit item">Preço unitário</th>
          <th class="text-center cart_quantity item">Qty</th>
          <th class="text-center cart_total item">Total</th>
        </tr>
      </thead>
      <tfoot style="background: #e7e7e7;">
        <tr class="cart_total_price">
          <td colspan="5" class="text-right" style="padding-right:1rem;">Total dos produtos</td>
          <td class="price" id="total_product" style="text-align: center;">{$cart.totals.total_excluding_tax.value}</td>
        </tr>
        <tr class="cart_total_tax">
          <td colspan="5" class="text-right" style="padding-right:1rem;">IVA</td>
          <td class="price" id="total_tax" style="text-align: center;">€ {($cart.totals.total.amount - $cart.totals.total_excluding_tax.amount)|number_format:2}</td>
        </tr>
        <tr class="cart_total_price">
          <td colspan="5" class="total_price_container text-right" style="padding-right:1rem;"> <span>Total</span></td>
          <td class="price" id="total_price_container" style="text-align: center;"> <span id="total_price">{$cart.totals.total.value}</span>
          </td>
        </tr>
      </tfoot>

      <tbody>
      {* <div class="cart-items"> *}
        {foreach from=$cart.products item=product}
          {* <div class="cart-item"> *}
              {if Module::isEnabled('ph_extend_support')}
                  {include file='module:ph_extend_support/views/templates/hook/checkout/cart-detailed-product-line.tpl' product=$product}
              {else}

                

                  {include file='module:ets_onepagecheckout/views/templates/hook/cart-detailed-product-line.tpl' product=$product}


                





              {/if}
          {* </div> *}
          {if is_array($product.customizations) && Ets_onepagecheckout::validateArray($product.customizations) && $product.customizations|count >1}<hr>{/if}
        {/foreach}
      {* </div> *}
      </tbody>
    </table>
    {else}
      <span class="no-items">{l s='There are no more items in your cart' mod='ets_onepagecheckout'}</span>
    {/if}
</div>