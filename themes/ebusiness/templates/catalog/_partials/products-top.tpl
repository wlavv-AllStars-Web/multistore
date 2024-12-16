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
  <span>Apply Filters</span>
</div>
{if $page.body_classes['category-Wheels']} 

  <div id="js-product-list-top" class="products-selection category-wheels-top">

  <div class=" box-sortby">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <div class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {l s='Brand' d='Shop.Theme.Actions'}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </div>
        <div class="dropdown-menu">

        </div>
      </div>
    </div>
  </div>

  <div class=" box-sortby">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {l s='Bolt Pattern' d='Shop.Theme.Actions'}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        </div>
      </div>
    </div>
  </div>

  <div class=" box-sortby">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {l s='Diameter' d='Shop.Theme.Actions'}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        </div>
      </div>
    </div>
  </div>

  <div class=" box-sortby">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {l s='Width' d='Shop.Theme.Actions'}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        </div>
      </div>
    </div>
  </div>

  <div class=" box-sortby">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {l s='Offset' d='Shop.Theme.Actions'}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        </div>
      </div>
    </div>
  </div>

  <div class=" box-sortby">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {l s='Color' d='Shop.Theme.Actions'}
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        </div>
      </div>
    </div>
  </div>

  <div class=" box-sortby wheels-accessories-filter">
    <div class="" style="display: flex;justify-content:center;align-items:center;height:100%;">
      <div class="">
        <a class="select-title" href='https://www.all-stars-motorsport.com/en/549-wheels-accessories'>
        {l s='Wheels Accessories' d='Shop.Theme.Actions'}
        </a>
      </div>
    </div>
  </div>



  </div>

{else}



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
  {assign var="categories" value=Category::getCategories()}
  {* {assign var="attribute_groups" value=AttributeGroup::getAttributesGroups()} *}

  {* <select name="category_id">
    {foreach from=$categories item=category}
        <option value="{$category.id_category}">{$category.name}</option>
    {/foreach}
  </select> *}


  {* <pre>{print_r($attribute_groups,1)}</pre> *}
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
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        {foreach from=$categories[2] item=categoryLevel1}
          {foreach from=$categoryLevel1 item=category}
            <div 
              id="category_element_{$category['id_category']}" 
              onclick="setCategory({$category['id_category']})"
              class="select-list"
            >
                {$category['name']}
            </div>
              
            {* <a
            rel="nofollow"
            href="{$link->getCategoryLink($category.id_category)}"
            class="select-list "
          >
            {$category.name}
          </a> *}
          {/foreach}
        {/foreach}
        </div>
      </div>
    </div>
  </div>

  {* bybrand *}

  <div class=" box-sortby col-md-3">
    <div class="row sort-by-row">
      <div class="{*if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if*} products-sort-order dropdown">
        <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span id="name_brand">
          
            {l s='By Brand' d='Shop.Theme.Actions'}
          </span>
          <i class="material-icons pull-xs-right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu">
        {foreach $manufacturers AS $manufacturer}
            <div  id="manufacturer_{$manufacturer['id_manufacturer']}" 
                  class="select-list js-search-link"
                  onclick="setManufacturer($(this), {$manufacturer['id_manufacturer']})">{$manufacturer['name']}
            </div>
        {/foreach}
        </div>
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
