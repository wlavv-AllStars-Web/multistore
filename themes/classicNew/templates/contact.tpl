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
{extends file='page.tpl'}

{block name='page_header_container'}{/block}

{if $layout === 'layouts/layout-left-column.tpl'}
  {block name="left_column"}
    <div id="left-column" class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
      {hook h='displayContactLeftColumn'}
      <div><b>{l s='Working Hours' d='Shop.Theme.Contact'}:</b> 9:00h - 18:00h (GMT +1)</div>
    </div>
  {/block}
{else if $layout === 'layouts/layout-right-column.tpl'}
  {block name="right_column"}
    {* <script src="https://www.google.com/recaptcha/api.js"></script> *}

    <div id="right-column" class="col-xs-12 col-sm-4 col-md-3">
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>

      {hook h='displayContactRightColumn'}
      <div class="g-recaptcha" data-sitekey="6LePv_oqAAAAAJz5p1N-VGJBZNuC6ok9jw0z7CRj"></div>
      {* <button class="g-recaptcha" 
        data-sitekey="6LePv_oqAAAAAJz5p1N-VGJBZNuC6ok9jw0z7CRj" 
        data-callback='onSubmit' 
        data-action='submit'>Submit</button> *}

    </div>
  {/block}
{/if}

{block name='page_content'}
  {hook h='displayContactContent'}
{/block}
