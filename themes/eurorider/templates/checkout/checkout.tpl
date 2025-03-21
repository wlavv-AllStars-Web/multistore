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

{block name='header'}
  {include file='../_partials/header.tpl'}
{/block}

{block name='content'}
  <section id="content">
    <div class="row row-checkout">
      {* <div class="cart-grid-body col-xs-12 col-lg-12"> *}
        {* {block name='cart_summary'} *}
          {* {include file='checkout/_partials/cart-summary.tpl' cart=$cart} *}
          {* {include file='checkout/cart.tpl'}
        {/block}
      </div> *}
      <div class="cart-grid-right col-xs-12 col-lg-12">
      {block name='cart_summary'}
        {include file='checkout/_partials/cart-summary.tpl' cart=$cart}
      {/block}


    {* {hook h='displayReassurance'} *}
      </div>
      {block name='continue_shopping'}
        {* <pre>{$urls.pages|print_r}</pre> *}
        <a class="label btn-backshopping" onclick="window.history.go(-1); return false;" style="margin-left: 4rem;margin-right:1rem;font-size:1.1rem;color:var(--asm-color);" onMouseOver="this.style.color='#0273EB'" onMouseOut="this.style.color='#0273EB'">
          <i class="material-icons">chevron_left</i>{l s='Continue shopping' d='Shop.Theme.Actions'}
        </a>
      {/block}
    
      <div class="cart-grid-body col-xs-12 col-lg-12">
        {block name='checkout_process'}
          {render file='checkout/checkout-process.tpl' ui=$checkout_process}
        {/block}
      </div>
      
    </div>
  </section>
{/block}

{block name='footer'}
  {include file='../_partials/footer.tpl'}
{/block}
