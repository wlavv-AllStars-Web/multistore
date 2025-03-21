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
{extends file=$layout}

{block name='content'}
  <section id="main" style="width: 100%;">

  <input type="hidden" id="temp_multiFilter_news" name="temp_news_compats" value="{$news_compats}"/>
  <input type="hidden" id="temp_multiFilter_order_by" name="temp_order_by_compats" value="{$order_by_compats}"/>
  <input type="hidden" id="temp_multiFilter_order_by_orientation" name="temp_order_by_orientation_compats" value="{$order_by_orientation_compats}"/>
  <input type="hidden" id="temp_multiFilter_id_manufacturer" name="temp_id_manufacturer_compats" value="{$manufacturer.id}"/>
  <input type="hidden" id="temp_multiFilter_nr_items" name="temp_nr_items_compats" value="{$nr_items_compats}"/>
  <input type="hidden" id="temp_multiFilter_page_number" name="temp_p" value="{$p}"/>
  <input type="hidden" id="temp_multiFilter_id_category" name="temp_id_category" value="{$id_category}"/>
  <input type="hidden" id="selected_filter_4" name="selected_filter_4" value="{$selected_filter_4}"/>
  <input type="hidden" id="temp_multiFilter_root_page" name="temp_root_file" value="{$root_page}"/>
  {* {debug} *}
{* <pre>{$brand|print_r}</pre> *}

  {* {if $smarty.server.REQUEST_URI == '/en/brand/' }
    brand
  {/if} *}
  {if $manufacturer.name}
    <div class="description_box" style="display:flex;align-items:center;">
      <div class="webmaster-logomanufacturer" style="padding: 0 1rem;">
        <img src="/img/m/{$manufacturer.id}-home_default.jpg" style="width: 170px;"/>
      </div>
      {if !empty($manufacturer.short_description)}
        <div class="description_short" style="display: flex;flex-direction:column;width:80%;">
        {if strlen($manufacturer.short_description) > 550}
          <div id="manufacturer-short_description" class="text_description hiddenTextDescription" style="font-size:15px;line-height:22px;text-transform:uppercase;font-weight:500;padding:0 3rem;margin:0 !important;text-align:center;">
            {$manufacturer.short_description nofilter}
          </div>

          <p class="show-more" onclick="toggleDescription(this)">{l s='Show More' d='Shop.Theme.Actions'}</p>
        {else}
          {$manufacturer.short_description nofilter}
        {/if}
        </div>
      {elseif !empty($manufacturer.description)}
        {if strlen($manufacturer.description) > 550}
        <div class="description" style="display: flex;flex-direction:column">
          <div id="manufacturer-description" class="text_description hiddenTextDescription">{$manufacturer.description nofilter}</div>
          <p class="show-more" onclick="toggleDescription(this)">{l s='Show More' d='Shop.Theme.Actions'}</p>
        </div>
        {else}
          <div class="description" style="display: flex;flex-direction:column">
            <div id="manufacturer-description">{$manufacturer.description nofilter}</div>
          </div>
        {/if}
      {else}
        {* <div>
          {block name='product_list_top'}
            {include file='catalog/_partials/products-top.tpl' listing=$listing}
          {/block}
        </div> *}
      {/if}
      
    </div>
  {/if}
  
  {* {if $page.page_name == 'new-products'}
    <div class="banner_news" style="max-width: 1350px;width:100%;margin:auto;">
      <img src="https://www.all-stars-motorsport.com/img/app_icons/news_en.webp?t=3" style="width:100%"/>
    </div>
  {/if} *}

  {* {substr($urls.current_url, 0, 25)}
  {$urls.pages.brands} *}
 {* <pre>{$manufacturer|print_r}</pre> *}



    {* {block name='product_list_header'}
      <h2 class="h2">{$listing.label}</h2>
    {/block} *}

    <div id="products" class="sang">

    {* <pre>{$listing|print_r}</pre> *}
      {if $listing.products|count || $no_products}


        {* {if !$no_products} *}
        <div>
          {block name='product_list_top'}
            {include file='catalog/_partials/products-top.tpl' listing=$listing}
          {/block}
        </div>
        {* {/if} *}

        {block name='product_list_active_filters'}
          <div class="hidden-sm-down">
            {$listing.rendered_active_filters nofilter}
          </div>
        {/block}

        <div>
          {block name='product_list'}
            {include file='catalog/_partials/products.tpl' listing=$listing}
          {/block}
        </div>

 
        <div>
          {block name='product_list_bottom'}
            {include file='catalog/_partials/products-bottom.tpl' listing=$listing}
          {/block}
        </div>


      {elseif $n_array}
        <div>
          {block name='product_list_top'}
            {include file='catalog/_partials/products-top.tpl' listing=$listing}
          {/block}
        </div>
        <div class="page-product-notfound">
          {include file='errors/not-found.tpl'}
        </div>
      {else}
        <div class="page-product-notfound">
          {include file='errors/not-found.tpl'}
        </div>
      {/if}
    </div>

  </section>
  <style>
  #manufacturer .container {
    max-width: none !important;
    margin: 0;
  }
  #manufacturer #main {
    width: 100%;
    background: #fff;
  }

  .hiddenTextDescription {
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    }
    .visibleTextDescription {
      overflow: visible;
      height:fit-content;
      transition:height ease-in 1s;
    }
    
    #manufacturer-description p {
      margin-bottom: 0;
    }

    .show-more{
        border:0;
        padding: .5rem 1rem;
        font-size:1rem;
        max-width: 200px;
        margin: 1rem auto;
        border-radius: .25rem;
        text-transform: capitalize;
    }

    .description_box{
      max-height: 171px;
      overflow: hidden;
    }

    .description_box .description{
      max-width: 1500px;
      width: 100%;
    }

    .description_box .show-more:focus{
      outline: none !important;
    }
  </style>

<script>
function toggleDescription(button) {
  const shortText = button.parentNode.querySelector(".short-text");
  const fullDesc = button.parentNode.querySelector(".full_desc");
  const textDescription = button.parentNode.querySelector(".text_description");

  
  if (textDescription.classList.contains("hiddenTextDescription")) {
  textDescription.classList.remove("hiddenTextDescription");
  textDescription.classList.add("visibleTextDescription");
  button.innerText = "Show Less";
} else {
  textDescription.classList.remove("visibleTextDescription");
  textDescription.classList.add("hiddenTextDescription");
  button.innerText = "Show More";
}
}


</script>
{/block}
