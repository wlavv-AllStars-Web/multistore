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
 {assign var="categories" value=Category::getCategories(Context::getContext()->language->id)}

<div class="wm-hiddencompats" style="display:none;">
  {if ( isset($ukoodata) && strlen($ukoodata) > 0)} {$ukoodata}
  {else} {hook h="displayUkooCompatBlock"}
  {/if}
</div>
{* <pre>{print_r($brand,1)}</pre> *}
<div class="d-mobile count-products">
{count($listing.products)} {l s="products" d="Shop.Theme.ProductList"}
</div>

<div class="btn-toggleFilters mobile" onclick="toggleFilters()">
  <span><i class="fa-solid fa-filter"></i></span>
  <span>{l s="Apply Filters" d="Shop.Theme.ProductList"}</span>
</div>
{if $page.body_classes['category-Wheels']} 

  <div id="js-product-list-top" class="products-selection category-wheels-top">
  {foreach $asw_features AS $feature key=key}
    <div class=" box-sortby">
      <div class="row sort-by-row">
        <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
          <div class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {assign var="is_selected" value=false}
            {if isset($selected_features[$feature.name])}
              {assign var="is_selected" value=true}
            {/if}
              
            {if $feature.combined_combinations}
                {* <i class="material-icons btn-remove-filter-wheel" aria-hidden="true" style="color: #333; margin-right: 5px;" onclick="removeFilterFeatures('{$selected_features.combination}')">cancel</i> *}
                <i class="material-icons btn-remove-filter-wheel" aria-hidden="true" style="color: #333; margin-right: 5px;" 
               onclick="removeFilterFeatures('{$feature.combined_combinations}')">cancel</i>
            {/if}

            <span class="featuresName" style="font-weight: 500;color: #333;font-size: 1rem;">{$feature['name']}</span>

            {assign var="countChecked" value=0}
            {foreach $feature['values'] AS $value}
                {if $value['checked'] == 1}
                    {assign var="countChecked" value=$countChecked+1}
                {/if}
            {/foreach}

            {if $countChecked == 1}
              {foreach $feature['values'] AS $value}
                {if $value['checked'] == 1 && $feature['name'] == 'Brand'}<img src="{$value['img']}" style="width: auto;max-height:34px;max-width:131px;"/>{/if}
                {if $value['checked'] == 1 && !($feature['name'] == 'Brand')}<span class="badge badge-dark" style="font-weight: 500;color: #fff;font-size: .85rem;padding: .35rem;min-width: 55px;max-width: 70px;background: var(--asm-color);margin-right: .5rem">{$value['value']}</span>{/if}
              {/foreach}
            {elseif $countChecked > 1}
              <span class="badge" style="font-weight: 500;color: #fff;font-size: .85rem;padding: .35rem;min-width: 55px;background: var(--asm-color);margin-right: .5rem;max-width: 70px;">{$countChecked} {l s="filters" d="Shop.Theme.ProductList"}</span>
            {/if}

            {* {if !$is_selected} *}
              <i class="material-icons pull-xs-right">arrow_drop_down</i>
            {* {/if} *}

          </div>
          {* {if !$is_selected} *}
          {* <pre>{$feature['values']|print_r}</pre> *}
          <div class="dropdown-menu">
            {foreach $feature['values'] AS $value}
              {* {if !in_array($value['id_feature_value'], $selected_values)} *}
                <div class="form-group form-check" style="margin-bottom: 0;padding: .5rem 2rem;display:flex;align-items: end;">
                  <input type="checkbox" class="form-check-input" id="{$feature['name']}_{$value['id_feature_value']}"
                    {if $value['checked'] == 1} checked="checked" onclick="removeFilterFeatures('{$value['id_feature']}:{$value['id_feature_value']}')" 
                    {else} onclick="filterFeatures({$value['id_feature']},{$value['id_feature_value']})" {/if}>
                  <label class="form-check-label" for="{$feature['name']}_{$value['id_feature_value']}" style="width: 100%;text-align:start;">{$value['value']}</label>
                </div>
              {* {else}
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="manufacturer_{$feature['id_feature']}" onclick="removeFilterFeatures('{$feature['id_feature']}:{$value['id_feature_value']}')">
                  <label class="form-check-label" for="manufacturer_{$feature['id_feature']}">{$feature['quantity']} {$feature['value']}</label>
                </div>
              {/if} *}
            {/foreach}
          </div>
          {* {/if} *}
        </div>
      </div>
    </div>
  {/foreach}

  <div class=" box-sortby wheels-accessories-filter">
    <div class="" style="display: flex;justify-content:center;align-items:center;height:100%;">
      <div class="">
        <a class="select-title" href='{$link->getCategoryLink(228)}'>
          {l s='Wheels Accessories' d='Shop.Theme.ProductList'}
        </a>
      </div>
    </div>
  </div>



  </div>

{else}

  {if $page['page_name'] == 'new-products'}
    <div id="banner_news" class="banner-news">
      <img src="img/eurorider/banners/news/news_banner_{$language.iso_code}.webp" alt="banner_news" />
    </div>
  {/if}


<div id="js-product-list-top" class="products-selection">

  {* <div class="col-md-6 hidden-sm-down total-products"> *}
    {*if $listing.products|count > 1}
      <p>{l s='There are %product_count% products.' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.products|count]}</p>
    {else}
      <p>{l s='There is %product_count% product.' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.products|count]}</p>
    {/if*}
        {* <ul class="display hidden-xs">
            <li id="grid" class="active">
                <a rel="nofollow" href="#" title="{l s='Grid'}">
                    <i class="fa fa-th"></i>
                </a>
            </li>
            <li id="list">
                <a rel="nofollow" href="#" title="{l s='List'}">
                    <i class="fa fa-list"></i>
                </a>
            </li>
      </ul>
  </div> *}

  {* <div class="filter_button">
      <a class="wmbtnlayered btn button filter_button_action" onclick="$('.wm-hiddenCategoryMenu').toggle()">
          <span id="name_category">{l s='By Category'}</span>
      </a>
      <div class="wm-hiddenCategoryMenu" style="display:none;">
          <div style="display: block;">
              {if ( isset($listing))}
                <ul id="ul_layered_category_0" class="layered_filter_ul">
                    {foreach $listing['products'] AS $key => $category}
                       
                        <li class="nomargin hiddable col-lg-12" style="padding:0">
                            <div  id="category_element_{$category['id_category']}" onclick="setCategory({$category['id_category']})">{$category['name']}</div>
                        </li>
                      
                    {/foreach}
                </ul>
              {/if}
          </div>
      </div>
  </div> *}

  {* {assign var="categories" value=Category::getHomeCategories(Context::getContext()->language->id, true)} *}
 
  {* {assign var="attribute_groups" value=AttributeGroup::getAttributesGroups()} *}

  {* <select name="category_id">
    {foreach from=$categories item=category}
        <option value="{$category.id_category}">{$category.name}</option>
    {/foreach}
  </select> *}


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
          {if !$page.body_classes['category-id-228']}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
          {/if}
        </a>
        {if !$page.body_classes['category-id-228']}
          <div class="dropdown-menu">
          {foreach from=$categories[2] item=parentCategory}
            {if $parentCategory['infos']['id_category'] != 16}
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
      document.querySelectorAll('.dropdown-menu button.btn-custom-category').forEach((collapseElement) => {
        collapseElement.addEventListener('click', (e) => {
          e.stopPropagation();

          const collapseEl = collapseElement.parentElement.nextElementSibling;

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

  {* bybrand *}

  <div class=" box-sortby col-md-3">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span id="name_brand">
          
            {l s='By Brand' d='Shop.Theme.Actions'}
          </span>
          {if $page.page_name != "manufacturer"}
            <i class="material-icons pull-xs-right">arrow_drop_down</i>
          {/if}
        </a>
        {if $page.page_name != "manufacturer"}
          <div class="dropdown-menu">
          {foreach $manufacturers AS $manufacturer}
              <div  id="manufacturer_{$manufacturer['id_manufacturer']}" 
                    class="select-list js-search-link"
                    onclick="setManufacturer($(this), {$manufacturer['id_manufacturer']})">{$manufacturer['name']}
              </div>
          {/foreach}
          </div>
        {/if}
      </div>
    </div>
  </div>

  {* SortBy *}
  <div class="box-sortby col-md-3">
    <div class="row sort-by-row">
      {if !empty($listing.rendered_facets)}
        {* <div class="col-sm-3 col-xs-4 hidden-md-up filter-button">
          <button id="search_filter_toggler" class="btn btn-secondary">
            {l s='Filter' d='Shop.Theme.Actions'}
          </button>
        </div> *}
      {/if}
      {block name='sort_by'}
        {include file='catalog/_partials/sort-orders.tpl' sort_orders=$listing.sort_orders}
      {/block}
    </div>
  </div>


  
  {if $page['page_name'] == 'new-products'}
    {assign var='requestPage' value=$link->getPaginationLink(false, false, false, false, true, false)}
		{assign var='requestNb' value=$link->getPaginationLink('new-products', false, true, false, false, true)}
  {/if}
  {* <pre>{$requestNb|print_r}</pre> *}
  {* bypage *}
  <div class="box-sortby col-md-3">
    <div class="row sort-by-row">
      {* <div class="col-sm-3 col-xs-4 hidden-md-up filter-button">
        <button id="search_filter_toggler" class="btn btn-secondary">
          {l s='Filter' d='Shop.Theme.Actions'}
        </button>
      </div> *}

      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a  class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span  id="name_items_per_page">{l s='By Page' d='Shop.Theme.Actions'}</span>
          {* {if isset($listing.sort_selected)}{$listing.sort_selected}{else}{l s='Select' d='Shop.Theme.Actions'}{/if} *}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu dropdown-perpage" onchange="setProductsPerPage('change')">
          <form action="{if !is_array($requestNb)}{$requestNb|escape:'html':'UTF-8'}{else}{$requestNb.requestUrl|escape:'html':'UTF-8'}{/if}" method="get" class="wm-hiddennbr nbrItemPage" style="width:100%;">
            {foreach from=$n_array item=nValue}
              <div class="select-list"  value="{$nValue|escape:'html':'UTF-8'}" {if $nb_products == $nValue}selected="selected"{/if}>{$nValue|escape:'html':'UTF-8'}</div>
            {/foreach}
          </form>
        </div>
      </div>
    </div>
  </div>



  {* <div class="col-sm-12 hidden-md-up text-xs-center showing">
    {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
    '%from%' => $listing.pagination.items_shown_from ,
    '%to%' => $listing.pagination.items_shown_to,
    '%total%' => $listing.pagination.total_items
    ]}
  </div> *}
  </div>
{/if}
{include file='catalog/_partials/setFilterData.tpl'}
{include file='catalog/_partials/getDataFromUrl.tpl'}

  <script>
      $('document').ready(function () {

      disable_cursor_hover();
      $('#nb_item').unbind('change');
      getDataFromUrl();

      });

      function disable_cursor_hover(){
        if($('#manufacturer').length > 0) {
            $('.wmbtnlayered_brand').css('cursor', 'none');
            $('.wmbtnlayered_brand > a').css('cursor', 'none');
            $('#multiFilter_id_manufacturer').val($('#id_current_manufacturer').val());
        }
        if($('#category').length > 0) {
            $('.wmbtnlayered_category').css('cursor', 'none');
            $('.wmbtnlayered_category > a').css('cursor', 'none');
            $('#multiFilter_id_category').val($('#id_current_category').val());
        }
    }
  </script>

  <style>
    #manufacturer .products-selection {
      display: flex;
      justify-content: center;
    }

    #manufacturer .select-title{
      color: var(--asm-color)
      font-size: 14px;
      padding: 0.425rem;
    }
    #manufacturer .sort-by-row {
      display: flex;
      justify-content:center;
    }

    #manufacturer .products-sort-order {
      width: 400px;
      height: 32px;
      text-align: center;
    }
    #manufacturer .products-sort-order:hover .select-title{
      color: black;
    }

    #manufacturer .box-sortby{
      max-width: 400px;
    }

    #manufacturer .products-sort-order .dropdown-menu {
      width: 100%;
      border: 1px solid #d0d0d0;
    }

    #manufacturer .products-sort-order .select-list:hover{
      background: var(--asm-color)
    }

    
  </style>
