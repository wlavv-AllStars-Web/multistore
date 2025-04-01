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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                  <a href="{l s="brand" d="Shop.Theme.Homepage"}/{$item['link']}">
                    <img src="{$item["image_"|cat:$language.iso_code]}" />
                  </a>
                </div>
                {/if}
              {/foreach}
            </div>
            <div class="swiper-pagination"></div>
          </div>
          {* <pre>{$urls|print_r}</pre> *}

          <div class="banners_50">
            {foreach from=$desktop['icones_50'] item=item key=key name=name}
              {* <pre>{$item|print_r}</pre> *}
              <div class="banner_50">
                {if $item['id_compat'] > 0}
                  <a href="{$urls.current_url}cars-products?id_compat={$item['id_compat']}">
                    <img src="{$item["image_"|cat:$language.iso_code]}" />
                  </a>
                {else}
                  <a href="{l s="brand" d="Shop.Theme.Homepage"}/{$item['link']}">
                    <img src="{$item["image_"|cat:$language.iso_code]}" />
                  </a>
                {/if}
              </div>
            {/foreach}
          </div>

          <div class="banners_33">
            {foreach from=$desktop['icones_33'] item=item key=key name=name}
              <div class="banner_33">
                {if $item['id_compat'] > 0}
                  <a href="{$urls.current_url}cars-products?id_compat={$item['id_compat']}">
                    <img src="{$item["image_"|cat:$language.iso_code]}" />
                  </a>
                {elseif $item['link']|substr:0:4 === '523-'}
                  <a href="{$link->getCategoryLink(523)|escape:'html':'UTF-8'}">
                    <img src="{$item["image_"|cat:$language.iso_code]}" />
                  </a>
                {else}
                  <a href="{l s="brand" d="Shop.Theme.Homepage"}/{$item['link']}">
                    <img src="{$item["image_"|cat:$language.iso_code]}" />
                  </a>
                {/if}
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
              <div class="car_brands_mobile" style="display: none;overflow:hidden;">
                <div class="loading-overlay-universals showLoading" role="status">
                  <span class="loading-spinner"></span>
                </div>
              </div>
              {* {$HOOK_HOME nofilter} *}
              <div class="cards-menuLink">
                <div class="card-news" onclick="window.location = '{$link->getPageLink('new-products', true)}';"></div>
                <div class="card-brands" onclick="window.location = '{$link->getPageLink('manufacturer', true)}';"></div>
                <div class="card-wheels" onclick="window.location = '{$link->getCategoryLink(528)}';"></div>
              </div>
            </div>
            
            <div class="card-container-homepage">
              {foreach from=$mobile item=mobileItem key=mobilekey name=mobilename}
                {$mobileItem['title_en'] = strtolower($mobileItem['title_en'])}
                
                {* {assign var="url" value=$mobileItem["image_{$currentLanguageIso}"]}
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
            

                  {if isset($numbers)}
                  </a>
                  {elseif $linkBrand != ''}
                  </a>
                  {/if} *}
                    {assign var="image_key" value="image_`$language.iso_code`"}

                    {if $mobileItem['id_compat'] > 0}
                      <a class="card-img card-itemMobile"  href="{$urls.current_url}cars-products?id_compat={$mobileItem['id_compat']}">
                        <img src="{$mobileItem[$image_key]}" style="width: 100%;"/>
                      </a>
                    {elseif $mobileItem['title_en'] === 'clearance'}
                      <a  class="card-itemMobile"  href="{$link->getCategoryLink(523)|escape:'html':'UTF-8'}">
                        <img src="{$mobileItem[$image_key]}" style="width: 100%;"/>
                      </a>
                    {else}
                      <a  class="card-itemMobile"  href="{l s="brand" d="Shop.Theme.Homepage"}/{$mobileItem['link']}">
                        <img src="{$mobileItem[$image_key]}" style="width: 100%;"/>
                      </a>
                    {/if}
               
                  
                  
              {/foreach}
            

            </div>

            {hook h='displayFooter' mod='ps_linklist'}
          


        {/block}
      </section>
      <style>



      @media screen and (max-width:768px) {
        .card-yourcar {
          background: url("https://www.all-stars-motorsport.com/themes/theme1164/mobile/img//yourcar_{$language.iso_code}.webp?t=1597494218");
          background-position: center;
          background-size: cover;
        }
        .card-news {
          background: url("https://www.all-stars-motorsport.com/themes/theme1164/mobile/img//news_{$language.iso_code}.webp?t=1521401943");
          background-position: center;
          background-size: cover;
        }
        .card-brands {
          background: url("https://www.all-stars-motorsport.com/themes/theme1164/mobile/img//brands_{$language.iso_code}.webp?t=1849194914");
          background-position: center;
          background-size: cover;
        }

        .card-wheels {
          background: url("https://www.all-stars-motorsport.com/themes/theme1164/mobile/img//wheels_{$language.iso_code}.webp?t=1743148996");
          background-position: center;
          background-size: cover;
        }
      }



    .swiper-container {
      width: 100%;
      position: relative;
      overflow: hidden;
    }

    /* .swiper-wrapper{
      display: flex;
    } */

    .swiper-slide {
        background-size: cover;
        background-position: 50%;
        /* min-height: 20vh; */
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

      <script>
        function openModelsMobile(elem,id_brand){
          event.stopPropagation(); 
          let loading = '<div class="loading-overlay-universals showLoading" role="status">' +
                    '<span class="loading-spinner"></span>' +
                  '</div>';

          document.querySelector(".car_brands_mobile").innerHTML = loading
          
          // document.querySelector(".dropdown-menu .versions_cars").innerHTML = ''
          // document.querySelector(".loading-overlay-cars").classList.remove("dont_show")
          $.ajax({
              url: '{url entity='frontController'}', // Replace with your endpoint
              type: 'GET',
              data: {
                getdataBrands: 1,
                type: 'model',
                id_brand: id_brand,
                storeId: {Context::getContext()->shop->id}
              },
              success: function(brands) {
                console.log(brands)
                // document.querySelector(".loading-overlay-cars").classList.add("dont_show")
                let modelsContainerMobile = document.querySelector(".car_brands_mobile")
                modelsContainerMobile.innerHTML = brands.html_models_mobile


                if(screen.width < 560){

                  function toggleStatus(element){

                      element.parentElement.classList.toggle("show");
                  }
                                    
                  const modelCars = document.querySelectorAll('.model_group_cars_mobile');
                  console.log(modelCars);
                    modelCars.forEach(function(container) {
                        if (container.children.length > 1) {
                            container.classList.add('has-multiple-children');
                    
                            container.querySelectorAll('.car_item_holder').forEach(function(child, index) {
                                const versionsParent = document.querySelectorAll("#container_version_parent");
                                
                                
                                child.style.position = "relative";
                                const div = document.createElement('div');
                                div.innerHTML = `<span style="font-weight:bold;font-size:1.25rem;">`+(index + 1)+`</span><span style="color: #222222;font-size:1rem;"> / `+container.children.length+`</span>`;
                                div.style.color = "red";
                                div.style.fontWeight = "regular";
                                div.style.textAlign = "center";
                                
                                div.style.margin = "0 0 1rem 0";
                                
                                // arrow right
                                    const arrowRight = document.createElement('span')
                                    arrowRight.classList.add("fa");
                                    arrowRight.classList.add("fa-chevron-right");
                                    arrowRight.style.marginLeft = "1rem";
                                    arrowRight.style.fontSize = "30px";
                                    arrowRight.style.right = "1rem";
                                    arrowRight.style.bottom = "1rem";
                                    arrowRight.style.color = "red";
                                    arrowRight.style.background = "#282828";
                                    arrowRight.style.padding = "0.25rem 0.5rem";
                                    arrowRight.style.borderRadius = "5px";
                                    arrowRight.style.boxShadow = "2px 4px 4px #444444";
                                    arrowRight.style.position = "absolute";
                                    arrowRight.setAttribute("title", "Right click");
                                
                                // arrow left
                                
                                    const arrowLeft = document.createElement('span');
                                    arrowLeft.classList.add("fa");
                                    arrowLeft.classList.add("fa-chevron-left");
                                    arrowLeft.style.fontSize = "30px";
                                    arrowLeft.style.left = "1rem";
                                    arrowLeft.style.bottom = "1rem";
                                    arrowLeft.style.color = "red";
                                    arrowLeft.style.background = "#282828";
                                    arrowLeft.style.padding = "0.25rem 0.5rem";
                                    arrowLeft.style.borderRadius = "5px";
                                    arrowLeft.style.boxShadow = "2px 4px 4px #444444";
                                    arrowLeft.style.position = "absolute";
                                    arrowLeft.setAttribute("title", "Left click");

                                
                                if (index === 0) {
                                    
                                    arrowRight.addEventListener('click', function() {
                                    
                                        if (index < container.children.length - 1) {
                                            
                                            const nextIndex = index + 1;
                                            container.children[nextIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start'  });
                                        }
                                    });
                                    child.appendChild(arrowRight)
                                } else if(index == container.children.length - 1){
                                    
                                    
                                    arrowLeft.addEventListener('click', function() {
                                        if (index == container.children.length - 1) {
                                            
                                            const prevIndex = index - 1;
                                            container.children[prevIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start'  });
                                        }
                                    });
                                    
                                    child.appendChild(arrowLeft)
                                }else{
                                    
                                    
                                    arrowLeft.addEventListener('click', function() {
                                        
                                            
                                            const prevIndex = index - 1;
                                            container.children[prevIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start'  });
                                    
                                    });
                                    arrowRight.addEventListener('click', function() {
                                    
                                        if (index < container.children.length - 1) {
                                            
                                            const nextIndex = index + 1;
                                            container.children[nextIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start'  });
                                        }
                                    });
                                
                                child.appendChild(arrowLeft)
                                child.appendChild(arrowRight)
                                    
                                }
                    
                                child.appendChild(div);
                                
                                
                            
                            });
                        }
                    });
                  }


              },
              error: function(xhr, status, error) {
                  console.error("AJAX Error:", status, error);
              }
            })
        }


        // check if URL parameter exists

        function checkUrlParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.has(param);
        }

        // Usage Example
        if (checkUrlParam('openCarsMobile')) {
            console.log('openCarsMobile parameter detected!'); // Replace with your action
            const el = document.querySelector('.card-yourcar');
            toggleMenuCars(el);
        }

        function toggleMenuCars(e){
          const menuCars = document.querySelector(".car_brands_mobile");
          menuCars.classList.toggle("show-menu-cars")
        }

      </script>

    {/block}
