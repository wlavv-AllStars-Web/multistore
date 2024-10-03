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


{assign var="currentLanguageIso" value=Context::getContext()->language->iso_code}
{assign var="currentLanguage" value=Context::getContext()->language->id}
{assign var="categories" value=Category::getCategories($currentLanguage)}
{assign var="versionsFordMustang" value=IndexController::getCarsOfBrand("Ford","Mustang",$currentLanguage)}
{assign var="versionsChevroletCamaro" value=IndexController::getCarsOfBrand("Chevrolet","Camaro",$currentLanguage)}
{assign var="versionsChevroletCorvette" value=IndexController::getCarsOfBrand("Chevrolet","Corvette",$currentLanguage)}
{assign var="versionsDodgeChallenger" value=IndexController::getCarsOfBrand("Dodge","Challenger",$currentLanguage)}
{assign var="versionsRamTrx" value=IndexController::getCarsOfBrand("Ram","Trx",$currentLanguage)}
{assign var="versionsFordBronco" value=IndexController::getCarsOfBrand("Ford","Bronco",$currentLanguage)}


{extends file='page.tpl'}

    {block name='page_content_container'}
      <section id="content" class="page-home">
        {block name='page_content_top'}{/block}

        {block name='page_content'}

          {block name='hook_home'}
            <div style="display: none;">
              <form id="ukoocompat_my_cars_custom_form" action="/en/module/ukoocompat/listing" method="GET"> 
                <input type="hidden" name="id_search" value="1"> 
                <input type="hidden" name="id_search3" value="1"> 
                <input type="hidden" name="id_lang" value="1"> 
                <input type="hidden" id="multiFilter_news" name="news_compats" value="0"> 
                <input type="hidden" id="multiFilter_order_by" name="order_by_compats" value="price"> 
                <input type="hidden" id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="DESC"> 
                <input type="hidden" id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value=""> 
                <input type="hidden" id="multiFilter_nr_items" name="nr_items_compats" value="20"> 
                <input type="hidden" id="multiFilter_n_items" name="n" value="20"> 
                <input type="hidden" id="multiFilter_page_number" name="p" value="1"> 
                <input type="hidden" id="multiFilter_id_category" name="id_category" value="0"> 
                <input type="hidden" id="multiFilter_root_page" name="root_page" value=""> 
                <input type="hidden" id="check_form" name="check_form" value="99585"> 
                <input type="hidden" id="custom_filter_1" name="filters1" value="87"> 
                <input type="hidden" id="custom_filter_2" name="filters2" value="864"> 
                <input type="hidden" id="custom_filter_3" name="filters3" value="865"> 
                <input type="hidden" id="custom_filter_4" name="filters4" value="866">
              </form>
            </div>
            {$HOOK_HOME nofilter}

            <div class="lines-tablet" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
            
            <div class="bannersHome">
              {foreach from=$desktop['icones_50'] item=item key=key name=name }
                {assign var="url" value=$item["image_{$currentLanguageIso}"]}
                {assign var="numberString" value="`$url`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
                {assign var="linkBrand" value=$item["link"]}

                
                
                {if $numberString != $url}
                  {assign var="numbers" value=[]}
                    {assign var="numbers" value=explode(",", $numberString)}
                {/if}
                <div class="card-img-container">
                  <div class="card-big">
                    <div class="layerHover">
                      <h5>{$item["title_{$currentLanguageIso}"]}</h5>
                    </div>
                    {if $numberString != $url}
                    <a style="cursor: pointer;"
                    onclick="setCarAndSearch({$numbers[0]},{$numbers[1]},{$numbers[2]},{$numbers[3]})">
                    {elseif $linkBrand != ''}
                      {if $linkBrand|is_numeric}
                        <a href="/{$currentLanguageIso}/{$linkBrand}-product.html">
                      {else}
                        <a href="/{$currentLanguageIso}/brand/{$linkBrand}">
                      {/if}
                      
                    {/if}
                      <img src="{$item["image_{$currentLanguageIso}"]}" alt="banner{$linkBrand}"/>
                    {if isset($numbers)}
                    </a>
                    {elseif $linkBrand != ''}
                      </a>
                    {/if}
                    </div>
                  <div class="card-min-img">
                  {foreach from=$desktop['icones_33'] item=child key=childkey name=childname}
                    {assign var="urlMini" value=$child["image_{$currentLanguageIso}"]}
                    {assign var="numberStringMini" value="`$urlMini`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
                    {assign var="linkBrandMini" value=$child["link"]}
                
                    {if $numberStringMini != $urlMini}
                      {assign var="numbersMini" value=[]}
                        {assign var="numbersMini" value=explode(",", $numberStringMini)}
                    {/if}

                        {if $key == 0 && $child.id_parent_card == 1}
                          <div class="card-img ">
{* aquui *}

                          {if $numberStringMini != $urlMini}
                            <a style="cursor: pointer;"
                            onclick="setCarAndSearch({$numbersMini[0]},{$numbersMini[1]},{$numbersMini[2]},{$numbersMini[3]})">
                            {elseif $linkBrandMini != ''}
                              <a href="/{$currentLanguageIso}/{$linkBrandMini}-product.html">
                            {/if}
                              <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                              <img src="{$child["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$child.id_parent_card}_{$childkey}" />
                            {if isset($numbersMini)}
                            </a>
                            {elseif $linkBrandMini != ''}
                              </a>
                          {/if}

{* aqiiiii *}
                            {* <a href="/{$currentLanguageIso}/{$child['link']}-product.html">
                              <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                              <img src="{$child["image_{$currentLanguageIso}"]}" />
                            </a> *}

                          </div>
                        {elseif  $key == 1 && $child.id_parent_card == 2}
                          <div class="card-img ">
                            <a href="/{$currentLanguageIso}/{$child['link']}-product.html">
                              <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                              <img src="{$child["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$child.id_parent_card}_{$childkey}"/>
                            </a>
                          </div>
                        {elseif  $key == 2 && $child.id_parent_card == 3}
                          <div class="card-img ">
                            <a href="/{$currentLanguageIso}/{$child['link']}-product.html">
                              <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                              <img src="{$child["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$child.id_parent_card}_{$childkey}"/>
                            </a>
                          </div>
                        {/if}
                      
                    {/foreach}
                    </div>    
                </div>
              {/foreach}
            </div>

            <div class="lines-tablet" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
            
            <div class="bannersHomeMobile">
            {foreach from=$mobile item=mobileItem key=mobilekey name=mobilename}
              {assign var="url" value=$mobileItem["image_{$currentLanguageIso}"]}
              {assign var="numberString" value="`$url`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
              {assign var="linkBrand" value=$mobileItem["link"]}

              {if $numberString != $url}
                {assign var="numbers" value=[]}
                  {assign var="numbers" value=explode(",", $numberString)}
              {/if}

                {if $numberString != $url}
                <a class="card-img" style="cursor: pointer; position: relative;"
                onclick="setCarAndSearch({$numbers[0]},{$numbers[1]},{$numbers[2]},{$numbers[3]})">
                {elseif $linkBrand != ''}
                  {if $linkBrand|is_numeric}
                    <a href="/{$currentLanguageIso}/{$linkBrand}-product.html" style="position: relative;">
                  {else}
                    <a href="/{$currentLanguageIso}/brand/{$linkBrand}" style="position: relative;">
                  {/if}
                {else}
                  <a style="position: relative;">
                {/if}

                  <img src="{$mobileItem["image_{$currentLanguageIso}"]}" style="width: 100%;" loading="lazy" alt="banner{$mobilekey}"/>
                  <div class="layerHovermobile">{$mobileItem["title_{$currentLanguageIso}"]}</div>

                {if isset($numbers)}
                </a>
                {elseif $linkBrand != ''}
                  </a>
                {/if}
                
              {/foreach}
          
            </div>

            {* cars *}

            <div class="hidden-md-up"
  style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;background: #fff;"></div>

<div class="cars-container">
  <div class="cars-cards col-12">
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordMustang.png" alt="Card image Ford Mustang" loading="lazy">
      <div class="card-title"><a href="">Ford Mustang</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>
          
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                {foreach from=$versionsFordMustang item=item key=key name=name}
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="setCarAndSearch({$item.id_brand},{$item.id_model},{$item.id_type},{$item.id_version})">{$item.type}</a><span>{$item.version}</span>
                  </div>
                {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/ChevroletCamaro.png" alt="Card image Chevrolet Camaro" loading="lazy">
      <div class="card-title"><a href="">Chevrolet Camaro</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              {foreach from=$versionsChevroletCamaro item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="setCarAndSearch({$item.id_brand},{$item.id_model},{$item.id_type},{$item.id_version})">{$item.type}</a><span>{$item.version}</span>
                </div>
              {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeChallenger.png" alt="Card image Dodge Challenger" loading="lazy">
      <div class="card-title"><a href="">Dodge Challenger</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                aria-controls="collapseThree">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              {foreach from=$versionsDodgeChallenger item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="setCarAndSearch({$item.id_brand},{$item.id_model},{$item.id_type},{$item.id_version})">{$item.type}</a><span>{$item.version}</span>
                </div>
              {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/ChevroletCorvette.png" alt="Card image Chevrolet Corvette" loading="lazy">
      <div class="card-title"><a href="">Chevrolet Corvette</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
                aria-controls="collapseFour">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>
          <div id="collapseFour" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                {foreach from=$versionsChevroletCorvette item=item key=key name=name}
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="setCarAndSearch({$item.id_brand},{$item.id_model},{$item.id_type},{$item.id_version})">{$item.type}</a><span>{$item.version}</span>
                  </div>
                {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/RamTrx.png" alt="Card image Ram Trx" loading="lazy">
      <div class="card-title"><a href="">Ram Trx</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
                aria-controls="collapseFive">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseFive" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              {foreach from=$versionsRamTrx item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="setCarAndSearch({$item.id_brand},{$item.id_model},{$item.id_type},{$item.id_version})">{$item.type}</a><span>{$item.version}</span>
                </div>
              {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeCharger.png" alt="Card image Dodge Charger" loading="lazy">
      <div class="card-title"><a href="">Dodge Charger</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
                aria-controls="collapseFive">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseSix" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordBronco.png" alt="Card image Ford Bronco" loading="lazy">
      <div class="card-title"><a href="">Ford Bronco</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true"
                aria-controls="collapseFive">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseSeven" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                {foreach from=$versionsFordBronco item=item key=key name=name}
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="setCarAndSearch({$item.id_brand},{$item.id_model},{$item.id_type},{$item.id_version})">{$item.type}</a><span>{$item.version}</span>
                  </div>
                {/foreach}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/JeepCherokee.png" alt="Card image Jeep Cherokee" loading="lazy">
      <div class="card-title"><a href="">Jeep Cherokee</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true"
                aria-controls="collapseEight">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseFive" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordF-150.png" alt="Card image Ford F-150" loading="lazy">
      <div class="card-title"><a href="">Ford F-150</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true"
                aria-controls="collapseFive">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseNine" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/JeepWrangler.png" alt="Card image Jeep Wrangler" loading="lazy">
      <div class="card-title"><a href="">Jeep Wrangler</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true"
                aria-controls="collapseFive">
                {l s='Versions' d='Shop.Theme.Banner'}
              </button>
            </h5>
          </div>

          <div id="collapseTen" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


            {* categories *}

            <div class="hidden-md-up"
            style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;background: #fff;"></div>
            <div class="hidden-sm-down" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;  background: #fff;"></div>
          <div class="otherCars"
            style="width:100%;display: flex;flex-direction:column;justify-content:center;align-items:center;background:#142c46;">
            {* <div class="titleCars" style="text-align: center;padding:3rem 0">
              <h5 style="font-weight: 400;">OTHER</h5>
              <h3>VEHICLE TYPES</h3>
            </div> *}
            <div class="categoryCars" style="display: flex;justify-content:space-evenly;width:100%;padding:3rem 1rem;max-width:1920px;gap:1rem;">
            {* <pre>{print_r($language.iso_code,1)}</pre> *}
              {* {foreach from=$categories item=categoryLevel1} *}
                {foreach from=$cats item=category}
                  {* {if $category.id_category == 9 || $category.id_category == 10 || $category.id_category == 11 || $category.id_category == 12 || $category.id_category == 13 || $category.id_category == 14  } *}
                    {if $category.link_rewrite == 'merchandising'}
                      <a rel="nofollow" href="http://tune4style.com/{$currentLanguageIso}" class="select-list ">
                        <div class="category {$category.name}">
                          <img src="/img/eurmuscle/bannersHome/{$category.link_rewrite}.webp" loading="lazy" alt="category {$category.name}">
                          <div class="model-type-overlay"><span>{$category.name}</span></div>
                        </div>
                      </a>
                    {else}
                      {if $category.link_rewrite !== 'clearance'}
                      <a rel="nofollow" href="/{$language.iso_code}/{$category.id_category}-{$category.link_rewrite}" class="select-list ">
                        <div class="category {$category.name}">
                          <img src="/img/eurmuscle/bannersHome/{$category.link_rewrite}.webp" loading="lazy" alt="category {$category.name}">
                          <div class="model-type-overlay"><span>{$category.name}</span></div>
                        </div>
                      </a>

                      {/if}
                    {/if}
                  {* {/if} *}
                {/foreach}
              {* {/foreach} *}
          
            </div>
          </div>

            {* videos *}
            <div style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;background: #fff;"></div>
{*             
              <div class="videosContainer">
              {foreach $desktop['icones_videos'] AS $key => $icon}
                <div class="video3 video">
                  <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
                  <img src="{$icon["image_{$currentLanguageIso}"]}" style="min-width: 32vw;" loading="lazy" alt="banner_{$icon.youtube_code}"/>
                    <div class="play">
                      <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                    </div>
                  </div>
                  <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$icon.youtube_code}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                  </div>
                </div>
              {/foreach}
                </div> *}
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
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$icon.youtube_code}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                  </div>
                </div>
              {/foreach}
                </div>

              <script>
const videosContainer = Array.from(document.querySelector('.videosContainer').children);

videosContainer.forEach((item) => {
  const img = item.querySelector('.play img');
  if (img) {
    item.addEventListener('mouseover', () => {
      img.setAttribute('src', "/img/youtube_play_hover.png")
    });
    item.addEventListener('mouseleave', () => {
      img.setAttribute('src', "/img/youtube_play.png")
    });
  }
});

if (window.screen.width < 768) {
  videosContainer.forEach((item) => {
    const img = item.querySelector('.play img');
    if (img) {
      img.setAttribute("src", "/img/youtube_play_hover.png")
    }
  })
}


function setCarAndSearch(brand, model, type, version) {
    $("#custom_filter_1").prop('value', brand);
    $("#custom_filter_2").prop('value', model);
    $("#custom_filter_3").prop('value', type);
    $("#custom_filter_4").prop('value', version);
    $('#ukoocompat_my_cars_custom_form').submit();
  }

              </script>

<style>
  

@media screen and (max-width:767px){
  .categoryCars .category {
  max-height: 291px !important;
  background: #707c88  !important;
}
.categoryCars .category img {
  width: 100%;
  object-fit: contain;
  height: 100%;
  transform: scale(1.25);
  object-position: 5px;
  
}
}

@media screen and (min-width:768px){
.categoryCars .category {
  max-height: 370px !important;
  background: #bfbfbf !important;
}
.categoryCars .category img {
  width: 100%;
  object-fit: cover;
  height: 100%;
  transform: scale(1.25);
  object-position: left;
  
}

.categoryCars .category.MODERN img {
  object-position: left 14px !important;
}

}



</style>
            
          {/block}
        {/block}
      </section>
    {/block}


 