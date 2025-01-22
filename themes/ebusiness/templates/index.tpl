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


 {assign var="currentLanguageIso" value=Context::getContext()->language->iso_code}
{assign var="currentLanguage" value=Context::getContext()->language->id}
{assign var="categories" value=Category::getCategories($currentLanguage)}
{extends file='page.tpl'}

    {block name='page_content_container'}
      <section id="content" class="page-home" style="">
        {block name='page_content_top'}{/block}
        {block name='page_content'}
            {* {hook h='ybcCustom3'} *}
          {* {$HOOK_HOME nofilter} *}

          

        
          
          <div class="bannersHome">
          {* {$HOOK_HOME nofilter} *}
          <div class="swiper-container">
            <div class="swiper-wrapper">
              {foreach from=$desktop['banners'] item=item key=key name=name}
                {if !empty($item['image_en'])}
                <div class="swiper-slide">
                  <a href="{$item['link']}">
                    <img  src="{$item['image_en']}"/>
                  </a>
                </div>
                {/if}
              {/foreach}
            </div>
            <div class="swiper-pagination"></div>
          </div>

          <div class="banners_50">
            {foreach from=$desktop['icones_50'] item=item key=key name=name}
              <div class="banner_50">
                <a href="{if $key == 0}{l s="brand" d="Shop.Theme.Homepage"}/{/if}{$item['link']}">
                  <img src="{$item['image_en']}" />
                </a>
              </div>
            {/foreach}
          </div>

          <div class="banners_33">
            {foreach from=$desktop['icones_33'] item=item key=key name=name}
              <div class="banner_33">
              <a href="{if $key == 0 || $key == 2}{l s="brand" d="Shop.Theme.Homepage"}/{/if}{$item['link']}">
                  <img src="{$item['image_en']}" />
                </a>
              </div>
            {/foreach}
          </div>
          

          <div class="videosContainer">
              {foreach $desktop['icones_videos'] AS $key => $icon}
                <div class="video3 video">
                  <div class="firstDiv" onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
                  <img src="{$icon["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$icon.youtube_code}"/>
                    <div class="play">
                      <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                    </div>
                  </div>
                  <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$icon.youtube_code}?autoplay=1&mute=1&rel=0" loading="lazy">
                    </iframe>
                  </div>
                </div>
              {/foreach}
          </div>

          </div>

          <div class="bannersHomeMobile">

            <div class="cards-menu">
              <div class="card-yourcar" onclick="toggleMenuCars(this)"></div>
              {$HOOK_HOME nofilter}
              <div class="cards-menuLink">
                <div class="card-news" onclick="window.location = '{$link->getPageLink('new-products', true)}';"></div>
                <div class="card-brands" onclick="window.location = '{$link->getPageLink('manufacturer', true)}';"></div>
                <div class="card-wheels" onclick="window.location = '{$link->getCategoryLink(227)}';"></div>
              </div>
            </div>
            
            <div class="card-container-homepage">
              {foreach from=$mobile item=mobileItem key=mobilekey name=mobilename}
                {assign var="url" value=$mobileItem["image_{$currentLanguageIso}"]}
                {assign var="numberString" value="`$url`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
                {assign var="linkBrand" value=$mobileItem["link"]}

                

                {if $numberString != $url}
                  {assign var="numbers" value=[]}
                    {assign var="numbers" value=explode(",", $numberString)}
                {/if}

                  {if $numberString != $url}
                  <a class="card-img card-itemMobile" style="cursor: pointer; position: relative;"
                  onclick="setCarAndSearch({$numbers[0]},{$numbers[1]},{$numbers[2]},{$numbers[3]})">
                  {elseif $linkBrand != ''}
                    {if $linkBrand|is_numeric}
                      <a class="card-itemMobile" href="/{$currentLanguageIso}/{$linkBrand}-product.html" style="position: relative;">
                    {else}
                      <a class="card-itemMobile" href="/{$currentLanguageIso}/brand/{$linkBrand}" style="position: relative;">
                    {/if}
                  {else}
                    <a class="card-itemMobile" style="position: relative;">
                  {/if}

                    <img src="{$mobileItem["image_{$currentLanguageIso}"]}" style="width: 100%;" loading="lazy" alt="banner{$mobilekey}"/>
                    {* <div class="layerHovermobile">{$mobileItem["title_{$currentLanguageIso}"]}</div> *}

                  {if isset($numbers)}
                  </a>
                  {elseif $linkBrand != ''}
                  </a>
                  {/if}
                  
              {/foreach}
            

            </div>

            {hook h='displayFooter' mod='ps_linklist'}
          


        {/block}
      </section>
      <style>

      /* @media screen and (max-width:560px) {
        #content{
          display: flex;justify-content:center;width:100%;padding:1rem;
        }
      } */
      .swiper-container {
    width: 100%;
    position: relative;
    overflow: hidden;
    }

    .swiper-slide {
        background-size: cover;
        background-position: 50%;
        min-height: 20vh;
        max-width: 100dvw;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        overflow: hidden !important;
    }
    .swiper-slide img {
      width: 100%;
    }

    .banners_50{
      display: flex;
      gap: .5rem;
      padding: 0.25rem;
    }
    
    .banners_50 .banner_50{
      flex: 1;
    }
    
    .banners_50 .banner_50 img{
      width: 100%;
    }

    .banners_33{
      display: flex;
      gap: .5rem;
      padding: 0.25rem;
    }
    
    .banners_33 .banner_33{
      flex: 1;
    }
    
    .banners_33 .banner_33 img{
      width: 100%;
    }



      </style>
    {/block}
