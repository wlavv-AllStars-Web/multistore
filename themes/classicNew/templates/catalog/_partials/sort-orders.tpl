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
{* <pre style="
z-index: 9999;
position: absolute;
width: 100vw !important;
background: white;
overflow: scroll;
top: 0;
">{print_r($listing.search->filters,1)}</pre> *}
{* <pre>{print_r($sortOrders,1)}</pre> *}
{* {$order_by_orientation_compats} *}
<span class="col-sm-3 col-md-5 hidden-sm-down sort-by">{l s='Sort by:' d='Shop.Theme.Global'}</span>
{* <div class="{if !empty($listing.rendered_facets)}col-xs-8 col-sm-7{else}col-xs-12 col-sm-12{/if} col-md-9 products-sort-order dropdown"> *}
<div class="col-md-9 col-xs-12 products-sort-order dropdown">
  <button style="color: black !important"
    class="btn-unstyle select-title"
    rel="nofollow"
    data-toggle="dropdown"
    aria-label="{l s='Sort by selection' d='Shop.Theme.Global'}"
    aria-haspopup="true"
    aria-expanded="false">
    {l s='Choose' d='Shop.Theme.Actions'}
    <i class="material-icons float-xs-right">&#xE5C5;</i>
  </button>
  <div class="dropdown-menu">
  {if isset($sortOrders)}
    {foreach from=$sortOrders item=sortOrder}
      <a
        rel="nofollow"
        href="{$sortOrder.url}&filters1={$filter_1}&filters2={$filter_2}&filters3={$filter_3}&filters4={$filter_4}"
      class="{if $sortOrder.current}current{/if} select-list "
      >
        {$sortOrder.label}
      </a>
  {/foreach}

  {else}
    
    {foreach from=$listing.sort_orders item=sort_order}
        <a
          rel="nofollow"
          href="{$sort_order.url}"
          class="select-list {['current' => $sort_order.current, 'js-search-link' => true]|classnames}"
        >
          {$sort_order.label}
        </a>
    {/foreach}
  {/if}
  </div>
</div>
