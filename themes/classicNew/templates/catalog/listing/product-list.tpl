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
{extends file=$layout}

{block name='head_microdata_special'}
  {include file='_partials/microdata/product-list-jsonld.tpl' listing=$listing}
{/block}

{block name='content'}
  <section id="main">
    <input type="hidden" id="temp_multiFilter_news" name="temp_news_compats" value="{$news_compats}"/>
    <input type="hidden" id="temp_multiFilter_order_by" name="temp_order_by_compats" value="{$order_by_compats}"/>
    <input type="hidden" id="temp_multiFilter_order_by_orientation" name="temp_order_by_orientation_compats" value="{$order_by_orientation_compats}"/>
    <input type="hidden" id="temp_multiFilter_id_manufacturer" name="temp_id_manufacturer_compats" value="{$manufacturer.id}"/>
    <input type="hidden" id="temp_multiFilter_nr_items" name="temp_nr_items_compats" value="{$nr_items_compats}"/>
    <input type="hidden" id="temp_multiFilter_page_number" name="temp_p" value="{$p}"/>
    <input type="hidden" id="temp_multiFilter_id_category" name="temp_id_category" value="{$id_category}"/>
    <input type="hidden" id="selected_filter_4" name="selected_filter_4" value="{$selected_filter_4}"/>
    <input type="hidden" id="temp_multiFilter_root_page" name="temp_root_file" value="{$root_page}"/>


    {block name='subcategory_list'}
      {if isset($subcategories) && $subcategories|@count > 0}
        {include file='catalog/_partials/subcategories.tpl' subcategories=$subcategories}
      {/if}
    {/block}
    
    {hook h="displayHeaderCategory"}

    <section id="products">
      {if $listing.products|count}

        <div class="filters-mobile">
          <div class="filters-sort-btn" onclick="openNavCarSpecs()"><i class="material-icons" translate="no">filter_list</i> {l s='Filters' d='Shop.Theme.ProductList'}</div>
          
          <div class="bg-sidenavCarSpecs" onclick="closeNavCarSpecs()"></div>
          <div id="sidenavCarSpecs" class="sidenav">
            <div style="width:100%;display:flex;justify-content:end;padding: .5rem 0;">
              <button type="button" class="btn-primary" onclick="closeNavCarSpecs()" aria-label="Close" style="border-radius: .25rem;">
                <i class="fa-solid fa-xmark fa-xl"></i>
              </button>
            </div>
            <div>
              {block name='product_list_top'}
                {include file='catalog/_partials/products-top.tpl' listing=$listing}
              {/block}
            </div>
          </div>
        </div>
      
        <div class="filters-desktop">
          {block name='product_list_top'}
            {include file='catalog/_partials/products-top.tpl' listing=$listing}
          {/block}
        </div>

        {block name='product_list_active_filters'}
          <div class="hidden-sm-down">
            {$listing.rendered_active_filters nofilter}
          </div>
        {/block}

        {block name='product_list'}
          {include file='catalog/_partials/products.tpl' listing=$listing productClass="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3"}
        {/block}

        {block name='product_list_bottom'}
          {include file='catalog/_partials/products-bottom.tpl' listing=$listing}
        {/block}

      {elseif $n_array}
        <div>
          <div class="filters-mobile">
            <div class="filters-sort-btn" onclick="openNavCarSpecs()"><i class="material-icons" translate="no">filter_list</i> {l s='Filters' d='Shop.Theme.ProductList'}</div>

            <div class="bg-sidenavCarSpecs" onclick="closeNavCarSpecs()"></div>
            <div id="sidenavCarSpecs" class="sidenav">
              <div style="width:100%;display:flex;justify-content:end;padding: .5rem 0;">
                <button type="button" class="btn-primary" onclick="closeNavCarSpecs()" aria-label="Close" style="border-radius: .25rem;">
                  <i class="fa-solid fa-xmark fa-xl"></i>
                </button>
              </div>
              <div>
                {block name='product_list_top'}
                  {include file='catalog/_partials/products-top.tpl' listing=$listing}
                {/block}
              </div>
            </div>
          </div>
          
          <div class="filters-desktop">
          {block name='product_list_top'}
            {include file='catalog/_partials/products-top.tpl' listing=$listing}
          {/block}
          </div>
        </div>
        <div class="page-product-notfound">
          {capture assign="errorContent"}
            <h4>{l s='No products available yet' d='Shop.Theme.Catalog'}</h4>
            <p>{l s='Stay tuned! More products will be shown here as they are added.' d='Shop.Theme.Catalog'}</p>
          {/capture}
          {include file='errors/not-found.tpl'}
        </div>
      {else}
        <div class="page-product-notfound">
          {include file='errors/not-found.tpl'}
        </div>
      {/if}
    </section>

    {block name='product_list_footer'}{/block}

    {hook h="displayFooterCategory"}

  </section>

  <script>
    function swapFiltersByScreenSize() {
      const isMobile = window.innerWidth <= 992; // Check if it's a mobile screen
      const mobileContainer = document.querySelector('.filters-mobile');
      const desktopContainer = document.querySelector('.filters-desktop');

      const parentElement = mobileContainer.parentElement;

      if (isMobile) {
        mobileContainer.style.display = 'flex';
        desktopContainer.style.display = 'none';
      } else {
        mobileContainer.style.display = 'none';
        desktopContainer.style.display = 'block';
      }
    }

    // Initial check when the page loads
    swapFiltersByScreenSize();

    // Re-check on window resize
    window.addEventListener('resize', swapFiltersByScreenSize);

  </script>
{/block}
