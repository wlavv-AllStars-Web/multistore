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
<div id="_desktop_user_info">
  <div class="user-info">
    {if $logged}
      <div style="display: flex;gap:1rem;">
        
        <a
          class="account"
          href="{$urls.pages.my_account}"
          title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
          rel="nofollow"
        >
          <i class="material-icons hidden-md-up logged" translate="no">&#xE7FF;</i>
          <span class="hidden-sm-down">{$customerName}</span>
        </a>
        <a
          class="logout hidden-sm-down"
          href="{$urls.actions.logout}"
          rel="nofollow"
        >
          <i class="material-icons logout" style="font-size: 35px !important;" translate="no">&#xe9ba;</i>
        </a>
      </div>
    {else}
      <a
        {* href="{$urls.pages.authentication}?back={$urls.current_url|urlencode}" *}
        href="{$urls.pages.authentication}"
        title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
        rel="nofollow"
      >
        {* <i class="material-icons">&#xE7FF;</i> *}
        <i class="fa-solid fa-user"></i>
        <span class="hidden-sm-down">{l s='Sign in' d='Shop.Theme.Actions'}</span>
      </a>
    {/if}
  </div>
</div>
