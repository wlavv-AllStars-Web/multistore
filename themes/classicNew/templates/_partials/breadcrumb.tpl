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
 {* <pre>{print_r($listing['filters'][0]->getCriteria()[0]['value'],1)}</pre> *}
 {* {assign var=filters value=$listing['search']->filters} *}
 
 {* <pre>{print_r($listing['search']->filters,1)}</pre> *}
 {* <pre>{print_r($filters,1)}</pre> *}


{if $breadcrumb.links}
  <nav data-depth="{$breadcrumb.count}" class="breadcrumb">
    <ol>
      {block name='breadcrumb'}
        {foreach from=$breadcrumb.links item=path name=breadcrumb}
          {block name='breadcrumb_item'}
            <li>
              {if not $smarty.foreach.breadcrumb.last}
                <a href="{$path.url}"><span>{$path.title}</span></a>
              {else}
                <span>{$path.title}</span>
              {/if}
            </li>
          {/block}
        {/foreach}
      {/block}
    </ol>
  </nav>
{else}
  <nav data-depth="{$breadcrumb.count}" class="breadcrumb">
    <ol>
      {block name='breadcrumb'}
        {foreach from=$filters item=item name=breadcrumb}
          {block name='breadcrumb_item'}
            <li>
            {* <pre>{print_r($item,1)}</pre> *}
              {$item.criteria[0]['value']}
              {* {if not $smarty.foreach.breadcrumb.last}
                <a href="{$path.url}"><span>{$path.title}</span></a>
              {else}
                <span>{$path.title}</span>
              {/if} *}
            </li>
          {/block}
        {/foreach}
      {/block}
    </ol>
  </nav>
{/if}
