{*
* 2007-2022 ETS-Soft
*
* NOTICE OF LICENSE
*
* This file is not open source! Each license that you purchased is only available for 1 wesite only.
* If you want to use this file on more websites (or projects), you need to purchase additional licenses. 
* You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
* 
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs, please contact us for extra customization service at an affordable price
*
*  @author ETS-Soft <etssoft.jsc@gmail.com>
*  @copyright  2007-2022 ETS-Soft
*  @license    Valid for 1 website (or project) for each purchase of license
*  International Registered Trademark & Property of ETS-Soft
*}
<span class="hidden-sm-down sort-by">{l s='Sort by:' d='Shop.Theme.Actions'}</span>
<div class="products-sort-order dropdown">
  <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {if isset($listing.sort_selected)}{$listing.sort_selected|escape:'html':'UTF-8'}{else}{l s='Select' d='Shop.Theme.Actions'}{/if}
    <i class="material-icons material-icons-arrow_drop_down pull-xs-right"></i>
  </a>
  <div class="dropdown-menu">
    {foreach from=$listing.sort_orders item=sort_order}
      <a rel="nofollow" href="{$sort_order.url|escape:'html':'UTF-8'}" class="select-list {['current' => $sort_order.current, 'js-search-link' => true]|classnames}">
        {$sort_order.label|escape:'html':'UTF-8'}
      </a>
    {/foreach}
  </div>
</div>
