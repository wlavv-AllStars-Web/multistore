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
<nav class="pagination" style="margin-bottom: 0;border-bottom:0;">

  <div class="col-md-12" style="display: flex;justify-content:center;">
    <ul class="page-list clearfix">
      {foreach from=$pagination.pages item="page"}
        <li {if $page.current} class="current" {/if}>
          {if $page.type === 'spacer'}
            <span class="spacer">&hellip;</span>
          {else}
            <a
              rel="{if $page.type === 'previous'}prev{elseif $page.type === 'next'}next{else}nofollow{/if}"
              href="{$page.url}"
              class="{if $page.type === 'previous'}previous {elseif $page.type === 'next'}next {/if}{['disabled' => !$page.clickable, 'js-search-link' => true]|classnames}"
            >
              {if $page.type === 'previous'}
                <i class="material-icons">chevron_left</i>{l s='Previous' d='Shop.Theme.Actions'}
              {elseif $page.type === 'next'}
                {l s='Next' d='Shop.Theme.Actions'}<i class="material-icons">chevron_right</i>
              {else}
                {$page.page}
              {/if}
            </a>
          {/if}
        </li>
      {/foreach}
    </ul>
  </div>
  <div class="col-md-12" style="display: flex;justify-content:center;font-size:14px">
    {l s='Showing %from%-%to% of %total% items' d='Shop.Theme.Catalog' sprintf=['%from%' => $pagination.items_shown_from ,'%to%' => $pagination.items_shown_to, '%total%' => $pagination.total_items]}
  </div>
</nav>
<style>
.pagination{
  padding: 0.5rem 0;
}

.pagination li a  {
    background-color: #ccc ;
    color: #000 !important;
    margin: 2px ;
    font-size: 14px ;
    border: 1px solid #999;
}
.pagination li a:hover{
  color: var(--asm-color)!important;
}

.pagination .current a  {
    background-color: #fff !important;
    color: var(--asm-color) !important;
    margin: 2px !important;
    font-size: 14px !important;
    font-weight: bold;
    border: 1px solid var(--asm-color);
}

.pagination .current a:hover{
  cursor: text;
}

.pagination > div:first-child {
  line-height: 0;
}
</style>
