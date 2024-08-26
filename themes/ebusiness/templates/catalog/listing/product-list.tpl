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
{* <pre>{$urls|print_r}</pre> *}
  {if $urls.current_url === $urls.pages.new_products}
    <div class="banner_news" style="max-width: 1350px;width:100%;margin:auto;">
      <img src="https://www.all-stars-motorsport.com/img/app_icons/news_en.webp?t=3" style="width:100%"/>
    </div>
  {/if}

  {* {if $smarty.server.REQUEST_URI == '/en/brand/' }
    brand
  {/if} *}
  {if $manufacturer.name}
    <div class="description_box" style="display:flex;align-items:center;">
      <div class="webmaster-logomanufacturer" style="padding: 0 1rem;">
        <img src="/img/m/{$manufacturer.id}-medium_default.jpg" style="width:100%;height: auto;min-width: 200px;"/>
      </div>
      {if !empty($manufacturer.short_description)}
        <div class="description_short" style="display: flex;flex-direction:column;width:80%;">
        {if strlen($manufacturer.short_description) > 550}
          <div id="manufacturer-short_description" class="text_description hiddenTextDescription" style="font-size:15px;line-height:22px;text-transform:uppercase;font-weight:500;padding:0 3rem;margin:0 !important;text-align:center;">
            {$manufacturer.short_description nofilter}
          </div>

          <button class="show-more" onclick="toggleDescription(this)">Show More</button>
        {else}
          {$manufacturer.short_description nofilter}
        {/if}
        </div>
      {else}
        {if strlen($manufacturer.description) > 550}
        <div class="description" style="display: flex;flex-direction:column">
          <div id="manufacturer-description" class="text_description hiddenTextDescription">{$manufacturer.description nofilter}</div>
          <button class="show-more" onclick="toggleDescription(this)">Show More</button>
        </div>
        {else}
          <div class="description" style="display: flex;flex-direction:column">
            <div id="manufacturer-description">{$manufacturer.description nofilter}</div>
          </div>
        {/if}
      {/if}
      
    </div>
  {/if}

  {* {substr($urls.current_url, 0, 25)}
  {$urls.pages.brands} *}
 {* <pre>{$manufacturer|print_r}</pre> *}



    {* {block name='product_list_header'}
      <h2 class="h2">{$listing.label}</h2>
    {/block} *}

    <div id="products" class="sang">

    {* <pre>{$listing|print_r}</pre> *}

      {if $listing.products|count}


        <div>
          {block name='product_list_top'}
            {include file='catalog/_partials/products-top.tpl' listing=$listing}
          {/block}
        </div>

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

      {else}

        {include file='errors/not-found.tpl'}

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
      overflow: hidden;
      height:54px;
      transition:height ease-in 1s;
    }
    .visibleTextDescription {
      overflow: visible;
      height:fit-content;
      transition:height ease-in 1s;
    }

  .show-more{
        border:0;
        background:none;
        color: var(--asm-color);
        margin:2rem 0;
        font-size:1.25rem;
    }

    .description_box{
      max-height: 171px;
  overflow: hidden;
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
