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
 
<div id="_desktop_cart">
  <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
    <div class="header cart-link">
      <i class="material-icons search" aria-hidden="true">search</i>
      {* {if $cart.products_count > 0} *}
        <a rel="nofollow" aria-label="{l s='Shopping cart link containing %nbProducts% product(s)' sprintf=['%nbProducts%' => $cart.products_count] d='Shop.Theme.Checkout'}" href="{$cart_url}">
      {* {/if} *}

        
        {* <div style="position: relative;"> *}
          <i class="material-icons shopping-cart" aria-hidden="true">shopping_cart</i>
          {* <span style="position: absolute;top:-6px;right:0;z-index:999;color:white;background:#ee302e;padding:0 4px;border-radius:25rem;font-size:11px;" class="cart-products-count">{$cart.products_count}</span> *}
        {* </div> *}
        <span class="hidden-sm-down">{l s='Your Cart' d='Shop.Theme.Checkout'}</span>
      {* {if $cart.products_count > 0} *}
        </a>
      {* {/if} *}
    </div>
  </div>
</div>

<script>

// document.addEventListener("DOMContentLoaded", function() {
//   const buttonSearchMobile = document.querySelector('#_desktop_cart .search');
//   const search_widget = document.getElementById('search_widget');

//   buttonSearchMobile.addEventListener('click', () => {
//     if(search_widget.style.display === 'none'){
//       search_widget.style.display = 'block'
//     }else{
//       search_widget.style.display = 'none'
//     }
//   });
// });

document.addEventListener("DOMContentLoaded", function() {
  const buttonSearchMobile = document.querySelector('#_desktop_cart .search');
  const search_widget = document.getElementById('search_widget');
  const submitFormBtn = document.querySelector("#search_widget form .search")
  const formSearch = document.querySelector("#search_widget form")

  buttonSearchMobile.addEventListener('click', () => {
    const computedStyle = window.getComputedStyle(search_widget);

    if (computedStyle.display === 'none') {
      search_widget.style.display = 'block';
    } else {
      search_widget.style.display = 'none';
    }
  });

  // submitFormBtn.addEventListener("submit", (event) => {
  //   console.log("submit")
  //   event.preventDefault();
  // })

});


</script>


