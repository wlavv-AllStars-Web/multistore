{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div id="search_widget" class="search-widget desktop" data-search-controller-url="{$search_controller_url}">
	{* <span class="search_icon_toogle"> *}
        {* <i class="material-icons-search"></i></span> *}
    <form method="get" action="{$search_controller_url}" class="d-none d-lg-flex active" style="background-color: #fff;width:max-content;">
		<input type="hidden" name="controller" value="search">
		<input type="text" name="s" value="{$search_string}" placeholder="{l s='Buscar' d='Shop.Theme.Catalog'}" style="background: #fff !important;width:247px;">
		<button type="submit">
			<i class="fa-solid fa-magnifying-glass"></i>
            {* {l s='Search' d='Shop.Theme.Catalog'} *}
		</button>
	</form>
</div>

<div id="search_widget" class="search-widget mobile" data-search-controller-url="{$search_controller_url}" >
  <div id="searchbar" style="display: none;">
	<form class="active mobile d-lg-none" method="get" action="{$search_controller_url}" >
		<input type="hidden" name="controller" value="search">
		<input type="text" name="s" value="{$search_string}" placeholder="{l s='Buscar' d='Shop.Theme.Catalog'}" style="width: 100%; height: 44px; border: 0px; padding-left: 12px;">
		<button type="submit" style="border-radius: 0;   background-color: #dd1312;   border: 0px;   padding-left: 17px;   padding-right: 17px;">
			<i class="fa-solid fa-magnifying-glass"></i>
			{* {l s='Search' d='Shop.Theme.Catalog'} *}
		</button>
	</form>
	</div>
	</div>
