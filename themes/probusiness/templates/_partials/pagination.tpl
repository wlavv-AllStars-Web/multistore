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
<nav class="pagination">


  <div class="col-md-12" style="display: flex;justify-content:center;">
    {block name='pagination_page_list'}
      <ul class="page-list clearfix text-xs-center">
        {foreach from=$pagination.pages item="page"}
          <li {if $page.current} class="current" {/if}>
            {if $page.type === 'spacer'}
              <span class="spacer">&hellip;</span>
            {else}
              <a
                rel="{if $page.type === 'previous'}prev{elseif $page.type === 'next'}next{else}nofollow{/if}"
                href="{$page.url|escape:'html':'UTF-8'}"
                class="{if $page.type === 'previous'}previous {elseif $page.type === 'next'}next {/if}{['disabled' => !$page.clickable, 'js-search-link' => true]|classnames}"
                style="position: relative;"
              >
                {if $page.type === 'previous'}
                  {* {l s='Previous' d='Shop.Theme.Actions'} *}
                  <i class="fa-solid fa-angle-left" style="font-weight: unset;"></i>
                {elseif $page.type === 'next'}
                  {* {l s='Next' d='Shop.Theme.Actions'} *}
                  <i class="fa-solid fa-angle-right" style="font-weight: unset;"></i>
                {else}
                  {$page.page|escape:'html':'UTF-8'}
                {/if}
              </a>
            {/if}
          </li>
        {/foreach}
      </ul>
    {/block}
  </div>

  <div class="col-md-12" style="display: flex;justify-content:center;">
    {block name='pagination_summary'}
      {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=['%from%' => $pagination.items_shown_from ,'%to%' => $pagination.items_shown_to, '%total%' => $pagination.total_items]}
    {/block}
  </div>

</nav>
