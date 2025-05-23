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

<div class="col-md-2 links wrapper">
  <h3 class="hidden-sm-down">{l s='Information' d='Modules.Legalcompliance.Shop'}</h3>
  <div class="title clearfix hidden-md-up" data-target="#footer_eu_about_us_list" data-toggle="collapse">
    <span class="h3">{l s='Information' d='Modules.Legalcompliance.Shop'}</span>
    <span class="float-xs-right">
      <span class="navbar-toggler collapse-icons">
        <i class="material-icons add" translate="no">&#xE313;</i>
        <i class="material-icons remove" translate="no">&#xE316;</i>
      </span>
    </span>
  </div>
  <ul class="collapse" id="footer_eu_about_us_list">
    {foreach from=$cms_links item=cms_link}
      <li>
        <a href="{$cms_link.link}" class="cms-page-link" title="{$cms_link.description|default:''}" id="{$cms_link.id}"> {$cms_link.title} </a>
      </li>
    {/foreach}
  </ul>
</div>
