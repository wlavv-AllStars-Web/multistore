{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
{extends file=$layout}

{block name='content'}
{* {assign var="shipping" value=ShippingData::shippingInfo($cart)}
<pre>{print_r($shipping,1)}</pre> *}
  <section id="main">
    <div class="cart-grid row">

      <!-- Left Block: cart product informations & shipping -->
      <div class="cart-grid-body col-lg-12 mb-0">

        <!-- cart products detailed -->
        <div class="card cart-container">
          <div class="card-block">
            <h1 class="h1">{l s='Shopping Cart' d='Shop.Theme.Checkout'}</h1>
          </div>
          <hr class="separator">
          {block name='cart_overview'}
            {include file='checkout/_partials/cart-detailed.tpl' cart=$cart}
          {/block}
        </div>

      </div>

      <!-- Right Block: cart subtotal & cart total -->
      <div class="cart-grid-right col-lg-12 mb-3" style="display: flex;justify-content:end;">
        <!-- shipping informations -->
        <div class="col-lg-3 p-0" style="background: #fff;">
        {block name='hook_shopping_cart_footer'}
          {hook h='displayShoppingCartFooter'}
        {/block}
        </div>

        {block name='cart_summary'}
          <div class="card cart-summary col-lg-9 mb-0">

            {block name='hook_shopping_cart'}
              {hook h='displayShoppingCart'}
            {/block}

            {block name='cart_totals'}
              {include file='checkout/_partials/cart-detailed-totals.tpl' cart=$cart}
            {/block}

            {block name='cart_actions'}
              {include file='checkout/_partials/cart-detailed-actions.tpl' cart=$cart}
            {/block}

          </div>
        {/block}

        

        {* {block name='hook_reassurance'}
          {hook h='displayReassurance'}
        {/block} *}

      </div>

      {block name='continue_shopping'}
        <a class="label" href="{$urls.pages.index}" style="margin-left: 4rem;margin-right:1rem;font-size:1.1rem;color:#ee302e;" onMouseOver="this.style.color='#103054'" onMouseOut="this.style.color='#ee302e'">
          <i class="material-icons">chevron_left</i>{l s='Continue shopping' d='Shop.Theme.Actions'}
        </a>
      {/block}

    </div>
    
    {hook h='displayCrossSellingShoppingCart'}
    

    {* <div class="cart-grid-body col-xs-12 col-lg-12 px-0">
        {block name='checkout_process'}
          {render file='checkout/checkout-process.tpl' ui=$checkout_process}
        {/block}
      </div> *}
  </section>
  
  
{/block}



{* {if isset($checkout_process)}
  <pre>{$checkout_process|print_r}</pre>
{/if} *}
{* {block name='checkout_process'}
 {render file='checkout/checkout-process.tpl' ui=$checkout_process}
{/block} *}
{* <div class="payment_cart">
  <h1><span>3</span> PAYMENT</h1>
    {block name="delivery_block"}
      {include file='checkout/checkout.tpl' cart=$cart} *}
      

{* checkout-personal-information-step *}
{* checkout-addresses-step *}
    {* {/block}
</div> *}