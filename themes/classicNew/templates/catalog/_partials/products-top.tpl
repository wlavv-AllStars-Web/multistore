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
 {* <pre>{print_r($listing['products'][0]['manufacturer_name'],1)}</pre> *}
 {* <pre>{print_r($listing['products'][0]['id_manufacturer'],1)}</pre> *}
 {* <pre>{print_r($listing['products'],1)}</pre> *}
{assign var="name_manufacturer" value=$manufacturer.name}
{assign var="id_manufacturer" value=$manufacturer.id}

 {if $urls.current_url == "{$urls.pages.new_products}"}
  <div class="banner"><img src="https://www.all-stars-motorsport.com/img/app_icons/news_{$language.iso_code}.webp?t=123"  style="width:100%;"/></div>
 {/if}

<div id="js-product-list-top" class="row products-selection mb-lg-3" style="display: flex;align-items:center;gap:0rem;">

    {if $smarty.server.REQUEST_URI == "/{$language.iso_code}/brand/{$id_manufacturer}-{$name_manufacturer|lower}"}
      {* <pre>{$urls|print_r}</pre> *}
      {* {$link->getCategoryLink(10)} *}
      {* <pre>{$urls.pages.new_products|print_r}</pre> *}
      <div class="col-lg-5 hidden-sm-down total-products p-0">
        <div style="display: flex;align-items:center;gap:1rem;">
          <img src="/img/m/{$manufacturer.id}-tm_medium_default.jpg" width="100%" style="max-width: 110px;padding:0.5rem;background:#fff;border-radius:0.5rem;outline: 1px solid #dedede;box-shadow:var(--euromus-shadow);">
          {* <h2 style="color:var(--euromus-color-600);font-weight: 600;">{$manufacturer.name}</h2> *}
        </div>
      </div>     
    {/if}
  

    {* {if $listing.products|count > 1}
      <p>{l s='There are %product_count% products.' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.products|count]}</p>
    {elseif $listing.products|count > 0}
      <p>{l s='There is 1 product.' d='Shop.Theme.Catalog'}</p>
    {/if} *}
  


    <div class="col-lg-12 col-xs-12" style="display: flex;flex-direction:column;justify-content:center;padding-right:0;">
      {if $smarty.server.REQUEST_URI == "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}" || $smarty.server.REQUEST_URI === "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}" || $smarty.server.REQUEST_URI === "/en/brand/{$id_manufacturer}-{$name_manufacturer|lower}"}
        <img class="hidden-md-up" src="/img/m/{$listing['products'][0]['id_manufacturer']}-medium_default.jpg" width="100%" style="max-width: 125px;padding:0.5rem;background:#fff;border-radius:0.5rem;margin:auto;">
      {/if}
 

    {* by category *}

    {if $page.page_name != "search"}
      {* bycategory *}
      <div class="box-sortby col-md-3">
        <div class="row sort-by-row">
          {* <div class="col-sm-3 col-xs-4 hidden-md-up filter-button">
            <button id="search_filter_toggler" class="btn btn-secondary">
              {l s='Filter' d='Shop.Theme.Actions'}
            </button>
          </div> *}
    
          <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
            <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span id="name_category">
                {l s='By Category' d='Shop.Theme.Actions'}
              </span>
              {* {if isset($listing.sort_selected)}{$listing.sort_selected}{else}{l s='Select' d='Shop.Theme.Actions'}{/if} *}
              {if !$page.body_classes['category-id-549']}
              <i class="material-icons pull-xs-right">arrow_drop_down</i>
              {/if}
            </a>
            {if !$page.body_classes['category-id-549']}
              <div class="dropdown-menu">
              {foreach from=$categories[2] item=parentCategory}
                {if $parentCategory['infos']['id_category'] != 523 && $parentCategory['infos']['id_category'] != 528 && $parentCategory['infos']['id_category'] != 549}
                  <div 
                      id="category_element_{$parentCategory['infos']['id_category']}" 
                      
                    class="select-list {if $categories[{$parentCategory['infos']['id_category']}]}has-children-category{/if}"
                    > 
                    <div class="container-dropdown-category">
                      <div onclick="setCategory({$parentCategory['infos']['id_category']}, this)">
                        {$parentCategory['infos']['name']}
                      </div>
                      {if $categories[{$parentCategory['infos']['id_category']}]}
                        <button class="btn-custom-category" type="button" data-toggle="collapse" data-target="#collapse{$parentCategory['infos']['id_category']}" aria-expanded="false" aria-controls="collapse{$parentCategory['infos']['id_category']}">
                          <i class="material-icons">arrow_drop_down</i>
                        </button>
                      {/if}
                    </div>
                    <div class="collapse-container-category collapse" id="collapse{$parentCategory['infos']['id_category']}">
                      {foreach from=$categories[{$parentCategory['infos']['id_category']}] item=categoryChildren}
                        {if $categoryChildren['infos']['id_parent'] == $parentCategory['infos']['id_category']}
                          
                            <li onclick="setCategory({$categoryChildren['infos']['id_category']}, this)">{$categoryChildren['infos']['name']}</li>
                          
                        {/if}
                        {* {if $category['id_category'] != 16}
                        <div 
                          id="category_element_{$category['id_category']}" 
                          onclick="setCategory({$category['id_category']})"
                          class="select-list"
                        >
                            {$category['name']}
                        </div>
                        {/if} *}
                      {/foreach}
                    </div>
                  </div>
                {/if}
              {/foreach}
              </div>
            {/if}
          </div>
        </div>
      </div>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.dropdown-menu button[data-toggle="collapse"]').forEach((collapseElement) => {
                // Prevent dropdown from closing when interacting with collapsible content
                collapseElement.addEventListener('click',(e) => {
                    e.stopPropagation();
    
                    let collapseEl = collapseElement.parentElement.nextElementSibling
                    // Toggle the `collapsed` class on the button dynamically
                    if (collapseEl.classList.contains('collapsed')) {
                        collapseEl.classList.remove('collapsed');
                        collapseEl.classList.add('collapse');
                    } else {
                        collapseEl.classList.add('collapsed');
                        collapseEl.classList.remove('collapse');
                    }
                });
            });
        });
    
      </script>
      {/if}

    {* sort by *}
      <div class="row sort-by-row">
        {block name='sort_by'}
          {include file='catalog/_partials/sort-orders.tpl' sort_orders=$listing.sort_orders}
        {/block}
        {if !empty($listing.rendered_facets)}
          <div class="col-xs-4 col-sm-3 hidden-md-up filter-button">
            <button id="search_filter_toggler" class="btn btn-secondary js-search-toggler">
              {l s='Filter' d='Shop.Theme.Actions'}
            </button>
          </div>
        {/if}
      </div>
    </div>

  {* <div class="col-sm-12 hidden-md-up text-sm-center showing"> *}
    {* {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
    '%from%' => $listing.pagination.items_shown_from ,
    '%to%' => $listing.pagination.items_shown_to,
    '%total%' => $listing.pagination.total_items
    ]} *}
    {* {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
    '%from%' => $listing.pagination.items_shown_from ,
    '%to%' => $listing.nb_products,
    '%total%' => $listing.products|count
    ]} *}
  {* </div> *}
</div>
