{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{extends file='layouts/layout-error.tpl'}

{block name='content'}

  <section id="main" style="display: flex;">
  <div class="maintenance-page">
    <div class="maintenance-page-content">
    {block name='page_header_container'}
      <header class="page-header">
        <div class="logo"><img src="{$shop.logo}" alt="logo"></div>
        {$HOOK_MAINTENANCE nofilter}
        {block name='page_header'}
          <h1>{block name='page_title'}{l s='We\'ll be back soon.' d='Shop.Theme'}{/block}</h1>
        {/block}
      </header>
    {/block}

    {block name='page_content_container'}
      <section id="content" class="page-content page-maintenance">
        {block name='page_content'}
          {$maintenance_text nofilter}
        {/block}
      </section>
    {/block}

    {block name='page_footer_container'}

    {/block}
    </div>
  </div>
  </section>

  <style>

    .maintenance-page {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      width: 100dvw;
      height: 100dvh;
      background: #f9f9f9;
    }

    .maintenance-page-content {
      background: #d9d9d9;
      padding: 2rem;
      border-radius: .25rem;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      color: #333;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      font-weight: 500;
    }
    


  </style>
{/block}
