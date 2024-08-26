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
 {* <pre>{print_r($listing['products'][0]['manufacturer_name'],1)}</pre> *}
 {* <pre>{print_r($listing['products'][0]['id_manufacturer'],1)}</pre> *}
 {* <pre>{print_r($listing['products'],1)}</pre> *}
{assign var="name_manufacturer" value=$listing['products'][0]['manufacturer_name']}
{assign var="id_manufacturer" value=$listing['products'][0]['id_manufacturer']}

 {if $smarty.server.REQUEST_URI == "/en/new-products"}
  <div class="banner"><img src="https://www.all-stars-motorsport.com/img/app_icons/news_en.webp?t=123"  style="width:100%;"/></div>
  {elseif  $smarty.server.REQUEST_URI === "/es/novos-produtos"}
  <div class="banner"><img src="https://www.all-stars-motorsport.com/img/app_icons/news_es.webp?t=123"  style="width:100%;"/></div>
  {elseif $smarty.server.REQUEST_URI === "/fr/nouveaux-produits"}
  <div class="banner"><img src="https://www.all-stars-motorsport.com/img/app_icons/news_fr.webp?t=123"  style="width:100%;"/></div>
 {/if}
<div id="js-product-list-top" class="row products-selection" style="display: flex;align-items:center;margin:2rem 0 4rem 0;gap:0rem;">

  {if $ukoo_name_1}
    <div class="col-lg-2  total-products">
    {* <div class="brand-logo">
      <span style="color:#0d2540;">
        <img src="/img/eurmuscle/brandsCars/{$ukoo_name_1}.png" style="width: 80px;background-color: #0d2540;padding: 0.5rem;border-radius: 0.5rem;gap:2rem;" />
      </span>
    </div> *}
  {else}
    <div class="col-lg-5 hidden-sm-down total-products pt-0">
    {if $smarty.server.REQUEST_URI == "/en/new-products" || $smarty.server.REQUEST_URI === "/es/novos-produtos" || $smarty.server.REQUEST_URI === "/fr/nouveaux-produits"}
      {* <h2 style="text-transform: uppercase;color:#103054">{l s='NEW PRODUCTS' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/15-clearance" || $smarty.server.REQUEST_URI === "/es/15-clearance"|| $smarty.server.REQUEST_URI === "/fr/15-clearance"}
      {* <h2 style="text-transform: uppercase;color:#103054">{l s='CLEARANCE' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/10-truck" || $smarty.server.REQUEST_URI === "/es/10-truck"|| $smarty.server.REQUEST_URI === "/fr/10-truck"}
      {* <h2 style="text-transform: uppercase;color:#103054">{l s='TRUCK' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/9-4x4" || $smarty.server.REQUEST_URI === "/es/9-4x4"|| $smarty.server.REQUEST_URI === "/fr/9-4x4"}
      {* <h2 style="text-transform: uppercase;color:#103054">{l s='4X4' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/11-classics" || $smarty.server.REQUEST_URI === "/es/11-classics"|| $smarty.server.REQUEST_URI === "/fr/11-classics"}
      {* <h2 style="text-transform: uppercase;color:#103054">{l s='CLASSICS' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/12-modern" || $smarty.server.REQUEST_URI === "/es/12-modern"|| $smarty.server.REQUEST_URI === "/fr/12-modern"}
      {* <h2 style="text-transform: uppercase;color:#103054">{l s='MODERN' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/13-tools" || $smarty.server.REQUEST_URI === "/es/13-tools"|| $smarty.server.REQUEST_URI === "/fr/13-tools"}
      <h2 style="text-transform: uppercase;color:#103054">{l s='TOOLS' d='Shop.Theme.Catalog'}</h2>
    {/if}
    {if $smarty.server.REQUEST_URI == "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}" || $smarty.server.REQUEST_URI === "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}" || $smarty.server.REQUEST_URI === "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}"}
      <div style="display: flex;align-items:center;gap:1rem;">
        <img src="/img/m/{$listing['products'][0]['id_manufacturer']}-medium_default.jpg" width="100%" style="max-width: 125px;padding:0.5rem;background:#fff;border-radius:0.5rem;">
        {* <h2 style="text-transform: uppercase;color:#103054">{$listing['products'][0]['manufacturer_name']}</h2> *}
      </div>
    {else}
      
    {/if}
  {/if}

    {* {if $listing.products|count > 1}
      <p>{l s='There are %product_count% products.' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.products|count]}</p>
    {elseif $listing.products|count > 0}
      <p>{l s='There is 1 product.' d='Shop.Theme.Catalog'}</p>
    {/if} *}
  </div>
  {if $ukoo_name_1}
    {* <div class="col-lg-5 ukooListTitle">
      <span id="ukoo1">{$ukoo_name_1}</span>
      <i style="margin:5px 10px;color: #103054;" class="fa fa-caret-right"></i>
      <span id="ukoo2">{$ukoo_name_2}</span>
      <i style="margin:5px 10px;color: #103054;" class="fa fa-caret-right"></i>
      <span id="ukoo3">{$ukoo_name_3}</span>
      <i style="margin:5px 10px;color: #103054;" class="fa fa-caret-right"></i>
      <span id="ukoo4">{$ukoo_name_4}</span>
    </div> *}
  {/if}
  {if $ukoo_name_1}
    <div class="col-lg-6 col-xs-12">
  {else}
    <div class="col-lg-7 col-xs-12" style="display: flex;flex-direction:column;justify-content:center;padding-right:0;">
    {if $smarty.server.REQUEST_URI == "/en/new-products" || $smarty.server.REQUEST_URI === "/es/novos-produtos" || $smarty.server.REQUEST_URI === "/fr/nouveaux-produits"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='NEW PRODUCTS' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/15-clearance" || $smarty.server.REQUEST_URI === "/es/15-clearance"|| $smarty.server.REQUEST_URI === "/fr/15-clearance"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='CLEARANCE' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/10-truck" || $smarty.server.REQUEST_URI === "/es/10-truck"|| $smarty.server.REQUEST_URI === "/fr/10-truck"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='TRUCK' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/9-4x4" || $smarty.server.REQUEST_URI === "/es/9-4x4"|| $smarty.server.REQUEST_URI === "/fr/9-4x4"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='4X4' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/11-classics" || $smarty.server.REQUEST_URI === "/es/11-classics"|| $smarty.server.REQUEST_URI === "/fr/11-classics"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='CLASSICS' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/12-modern" || $smarty.server.REQUEST_URI === "/es/12-modern"|| $smarty.server.REQUEST_URI === "/fr/12-modern"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='MODERN' d='Shop.Theme.Catalog'}</h2> *}
    {elseif $smarty.server.REQUEST_URI === "/en/13-tools" || $smarty.server.REQUEST_URI === "/es/13-tools"|| $smarty.server.REQUEST_URI === "/fr/13-tools"}
      {* <h2 class="hidden-md-up" style="text-transform: uppercase;color:#103054">{l s='TOOLS' d='Shop.Theme.Catalog'}</h2> *}
    {/if}
    {if $smarty.server.REQUEST_URI == "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}" || $smarty.server.REQUEST_URI === "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}" || $smarty.server.REQUEST_URI === "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}"}
      <img class="hidden-md-up" src="/img/m/{$listing['products'][0]['id_manufacturer']}-medium_default.jpg" width="100%" style="max-width: 125px;padding:0.5rem;background:#fff;border-radius:0.5rem;margin:auto;">
    {/if}
  {/if}
      <div class="row sort-by-row">
        {block name='sort_by'}
          {include file='catalog/_partials/sort-orders.tpl' sort_orders=$listing.sort_orders}
        {/block}
        {if !empty($listing.rendered_facets)}
          <div class="col-xs-4 col-sm-3 hidden-md-up filter-button">
            <button id="search_filter_toggler" class="btn btn-secondary js-search-toggler">
              {l s='Filter' d='Shop.Theme.Actions'}
            </button>
          </div>
        {/if}
      </div>
    </div>

  <div class="col-sm-12 hidden-md-up text-sm-center showing">
    {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
    '%from%' => $listing.pagination.items_shown_from ,
    '%to%' => $listing.pagination.items_shown_to,
    '%total%' => $listing.pagination.total_items
    ]}
    {* {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
    '%from%' => $listing.pagination.items_shown_from ,
    '%to%' => $listing.nb_products,
    '%total%' => $listing.products|count
    ]} *}
  </div>
</div>
