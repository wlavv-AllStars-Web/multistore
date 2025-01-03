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
<!-- Block search module TOP -->
{* {if $urls.current_url == $link->getPageLink('quickshop', true)}
	<div id="search_widget" class="search-widgets shop-asd" data-search-controller-url="{$link->getPageLink('quickshop', true)}">
		<form method="get" action="{$link->getPageLink('quickshop', true)}">
			<input type="hidden" name="controller" value="search">
			<input type="text" name="s" value="{$search_string}" placeholder="{l s='Search our catalog' d='Shop.Theme.Catalog'}" aria-label="{l s='Search' d='Shop.Theme.Catalog'}">
		</form>
	</div>

{else} *}
<div id="search_widget" class="col-lg-5 col-md-5 col-sm-12 search-widget" data-search-controller-url="{$search_controller_url|escape:'html':'UTF-8'}">
	<span class="toogle_search_top">
        <i class="material-icons material-icons-search" ></i>
    </span>
    <div class="search_block_top_fixed">
        <form method="get" action="{$search_controller_url|escape:'html':'UTF-8'}">
    		<input type="hidden" name="controller" value="search">
    		<input type="text" name="s" value="{$search_string|escape:'html':'UTF-8'}" placeholder="{l s='Search our catalog' d='Shop.Theme.Catalog'}">
    		<button type="submit">
    			<i class="material-icons material-icons-search"></i>
    		</button>
    	</form>
    </div>
</div>
{* {/if} *}
<!-- /Block search module TOP -->
