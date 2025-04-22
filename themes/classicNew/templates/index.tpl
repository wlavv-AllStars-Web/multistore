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
{assign var="versionsFordMustang" value=IndexController::getCarsOfBrand(92,100,$currentLanguage,true)}
{* {assign var="versionsChevroletCamaro" value=IndexController::getCarsOfBrand(1058,1061,$currentLanguage,true)}
{assign var="versionsChevroletCorvette" value=IndexController::getCarsOfBrand(1058,1064,$currentLanguage,true)}
{assign var="versionsDodgeChallenger" value=IndexController::getCarsOfBrand(1067,1069,$currentLanguage,true)}
{assign var="versionsRamTrx" value=IndexController::getCarsOfBrand(1067,1072,$currentLanguage,true)}
{assign var="versionsFordBronco" value=IndexController::getCarsOfBrand(92,1076,$currentLanguage,true)}
{assign var="versionsDodgeCharger" value=IndexController::getCarsOfBrand(1067,1079,$currentLanguage,true)}
{assign var="versionsJeepCherokee" value=IndexController::getCarsOfBrand(1085,1086,$currentLanguage,true)}
{assign var="versionsJeepWrangler" value=IndexController::getCarsOfBrand(1085,1094,$currentLanguage,true)}
{assign var="versionsFordShelby" value=IndexController::getCarsOfBrand(92,1091,$currentLanguage,true)} *}


{extends file='page.tpl'}

    {block name='page_content_container'}
      <section id="content" class="page-home">
        {block name='page_content_top'}{/block}

        {block name='page_content'}

          {block name='hook_home'}

            {* {$HOOK_HOME nofilter} *}

            <div class="section menu-select-car">
              <div class="menu-select-car-container">
                <input name="id_store" type="hidden" id="id_store" value="{Context::getContext()->shop->id}">
                <div class="menu-select-car-header">
                    <h1>{l s='SELECT YOUR VEHICLE' d='Shop.Theme.Global'}</h1>
                </div>
                
                <div class="menu-select-car-content">
                  <select class="custom-select custom-select-lg brands-select">
                    <option selected>{l s="Brand" d="Shop.Theme.Homepage"}</option>
                  </select>
                  <select class="custom-select custom-select-lg models-select disabled">
                    <option selected>{l s="Model" d="Shop.Theme.Homepage"}</option>

                  </select>
                  <select class="custom-select custom-select-lg types-select disabled">
                    <option selected>{l s="Type" d="Shop.Theme.Homepage"}</option>
                  </select>
                  <select class="custom-select custom-select-lg versions-select disabled">
                    <option selected>{l s="Version" d="Shop.Theme.Homepage"}</option>
                  </select>

                    <button id="search-button-car" type="submit" name="" class="button btn btn-default button-medium" disabled="disabled">
                      <span>{l s="Search" d="Shop.Theme.Homepage"}</span>
                    </button>
                
                </div>
              </div>
            </div>

            <script defer="defer">
              document.addEventListener("DOMContentLoaded", function () {
                const brandSelect = $(".brands-select"); 
                const modelSelect = $(".models-select");
                const typeSelect = $(".types-select");
                const versionSelect = $(".versions-select");
                const searchButton = $("#search-button-car");

                // Reset and disable a select field
                function resetSelect(selectElement, placeholder) {
                    selectElement.empty();
                    selectElement.append(`<option selected disabled>`+placeholder+`</option>`);
                    selectElement.prop('disabled', true);
                }

                // Fetch data from the server
                function fetchOptions(params, selectElement, placeholder) {
                    $.ajax({
                        url: '{$link->getPageLink('index')}',
                        type: 'GET',
                        data: params,
                        dataType: 'json',
                        success: function (data) {
                          console.log(data)
                            resetSelect(selectElement, placeholder);
                            console.log('selectElement', selectElement)
                            console.log('placeholder', placeholder)
                            if (data.length > 0) {
                                selectElement.removeAttr("disabled").removeClass("disabled");;
                                
                                $.each(data, function (index, item) {
                                  if(placeholder == "{l s='Brand' d='Shop.Theme.Homepage'}") {
                                    selectElement.append('<option value="'+item.id_brand+'">'+item.name+'</option>');
                                  }else if(placeholder == "{l s='Model' d='Shop.Theme.Homepage'}") {
                                    selectElement.append('<option value="'+item.id_model+'">'+item.name+'</option>');
                                  }else if(placeholder == "{l s='Type' d='Shop.Theme.Homepage'}") {
                                    selectElement.append('<option value="'+item.id_type+'">'+item.name+'</option>');
                                  }else if(placeholder == "{l s='Version' d='Shop.Theme.Homepage'}") {
                                    selectElement.append('<option value="'+item.id_version+'">'+item.name+'</option>');
                                  }else if(placeholder == "{l s='Search' d='Shop.Theme.Homepage'}") {
                                    window.location.href = "{$link->getPageLink('cars-products')}?id_compat="+item.id_compat
                                  }
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error:", error);
                            console.log("Response Text:", xhr.responseText);
                        }
                    });
                }

                // fetch brands
              setTimeout(() => {
                const storeId = $(".menu-select-car-container #id_store").val();

                fetchOptions({
                    getdataBrandsEuromus: 1,
                    type: 'brand',
                    storeId: storeId
                }, brandSelect, "{l s='Brand' d='Shop.Theme.Homepage'}");
              }, 100);

                // Event: Select Brand → Fetch Models
                brandSelect.change(function () {
                    const brandId = $(this).val();
                    resetSelect(modelSelect, "{l s='Model' d='Shop.Theme.Homepage'}");
                    resetSelect(typeSelect, "{l s='Type' d='Shop.Theme.Homepage'}");
                    resetSelect(versionSelect, "{l s='Version' d='Shop.Theme.Homepage'}");
                    searchButton.prop("disabled", true);

                    fetchOptions({
                        getdataModelsEuromus: 1,
                        type: 'model',
                        id_brand: brandId,
                        storeId: {Context::getContext()->shop->id}
                    }, modelSelect, "{l s='Model' d='Shop.Theme.Homepage'}");
                });

                // Event: Select Model → Fetch Types
                modelSelect.change(function () {
                    const modelId = $(this).val();
                    resetSelect(typeSelect, "{l s='Type' d='Shop.Theme.Homepage'}");
                    resetSelect(versionSelect, "{l s='Version' d='Shop.Theme.Homepage'}");
                    searchButton.prop("disabled", true);

                    fetchOptions({
                      getdataTypesEuromus: 1,
                        type: 'type',
                        id_model: modelId,
                        storeId: {Context::getContext()->shop->id}
                    }, typeSelect, "{l s='Type' d='Shop.Theme.Homepage'}");
                });

                // Event: Select Type → Fetch Versions
                typeSelect.change(function () {
                    const typeId = $(this).val();
                    resetSelect(versionSelect, "{l s='Version' d='Shop.Theme.Homepage'}");
                    searchButton.prop("disabled", true);

                    fetchOptions({
                      getdataVersionsEuromus: 1,
                        type: 'version',
                        id_type: typeId,
                        storeId: {Context::getContext()->shop->id}
                    }, versionSelect, "{l s='Version' d='Shop.Theme.Homepage'}");
                });

                // Event: Select Version → Enable Search Button
                versionSelect.change(function () {
                    searchButton.prop("disabled", false);
                });

                // Event: Click Search Button → Send Data
                searchButton.click(function () {
                    const searchParams = {
                        brand_id: brandSelect.val(),
                        model_id: modelSelect.val(),
                        type_id: typeSelect.val(),
                        version_id: versionSelect.val(),
                    };

                    fetchOptions({
                      getProductsIdCompat: 1,
                        brand_id: searchParams.brand_id,
                        model_id: searchParams.model_id,
                        type_id: searchParams.type_id,
                        version_id: searchParams.version_id,
                    },searchButton,"{l s='Search' d='Shop.Theme.Homepage'}")

                    // console.log("Search Params:", searchParams);

                    // Perform search action (redirect or AJAX request)
                    // window.location.href = "/search-results?" + $.param(searchParams);
                });
              });
  

            </script>

            <style>
              select::-webkit-scrollbar {
                width: 8px; /* Adjust scrollbar width */
              }

              select::-webkit-scrollbar-thumb {
                background-color: #888; /* Scrollbar handle color */
                border-radius: 4px; /* Rounded corners */
              }

              select::-webkit-scrollbar-track {
                background-color: #f1f1f1; /* Track background color */
              }

              select {
                scrollbar-width: thin; /* Options: auto, thin, none */
                scrollbar-color: #888 #f1f1f1; /* thumb color | track color */
              }

              .menu-select-car{
                background-color: var(--euromus-color-200);
                background-image: url(/img/eurmuscle/tire.webp);
                background-repeat: no-repeat;
                background-position: right top;
                background-size: auto;
              }

              .menu-select-car-container {
                width: 100%;
                max-width: 1440px;
                margin: auto;
                padding-bottom: 4rem;
              }

              .menu-select-car-header {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 3rem 0;
              }
              .menu-select-car-header h1 {
                color: #fff;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, “Segoe UI”, Roboto, Oxygen-Sans, Ubuntu, Cantarell, “Helvetica Neue”, Arial, sans-serif;
                font-size: 40px;
                line-height: 44px;
                font-weight: 400;
              }

              .menu-select-car-content {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
              }

              .menu-select-car .custom-select {
                padding: 0.375rem 2.25rem 0.375rem 0.75rem;
                height: 3rem;
                color: var(--euromus-color-100);
                border-radius: 0.25rem;
                font-family: 'Roboto', Arial,Helvetica,sans-serif;
                border: none;
                font-size: 16px;
                appearance: none;
                background: #eee;
                flex: 1;
                font-weight: 600;
              }

              .menu-select-car .custom-select.disabled {
                opacity: .8;
              }

              .menu-select-car button{
                background: var(--euromus-color-300) !important;
                border-radius: 0.25rem;
                height: 48px;
                font-size: 1rem;
                text-transform: uppercase;
                flex: 1;
              }
            </style>

            <div class="lines-tablet" style="border-top:4px solid var(--euromus-color-200);border-bottom:4px solid var(--euromus-color-300);padding-block:2px;width: 100%;transform: rotate(180deg);"></div>
            
            <div class="bannersHome">
              {foreach from=$desktop['icones_50'] item=item key=key name=name }
                {assign var="url" value=$item["image_{$currentLanguageIso}"]}
                {assign var="numberString" value="`$url`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
                {assign var="linkBrand" value=$item["link"]}

                
                
                {* {if $numberString != $url}
                  {assign var="numbers" value=[]}
                    {assign var="numbers" value=explode(",", $numberString)}
                {/if} *}

                <div class="card-img-container">
                  <div class="card-big">
                    <div class="layerHover">
                      <h5>{$item["title_{$currentLanguageIso}"]}</h5>
                    </div>
                    {if $item['id_compat'] > 0}
                    <a style="cursor: pointer;"
                    onclick="setCarSearch({$item['id_compat']})">
                    {elseif $linkBrand != ''}
                      {if $linkBrand|is_numeric}
                        <a href="/{$currentLanguageIso}/{$linkBrand}-product.html">
                      {else}
                        <a href="/{$currentLanguageIso}/brand/{$linkBrand}">
                      {/if}
                      
                    {/if}
                      <img src="{$item["image_{$currentLanguageIso}"]}" alt="banner{$linkBrand}"/>

                    {if $item['id_compat'] > 0}
                    </a>
                    {elseif $linkBrand != ''}
                      </a>
                    {else}
                      </a>
                    {/if}
                    </div>

                  <div class="card-min-img">
                  {foreach from=$desktop['icones_33'] item=child key=childkey name=childname}
                    {assign var="urlMini" value=$child["image_{$currentLanguageIso}"]}
                    {assign var="numberStringMini" value="`$urlMini`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
                    {assign var="linkBrandMini" value=$child["link"]}
                
                    {* {if $numberStringMini != $urlMini}
                      {assign var="numbersMini" value=[]}
                        {assign var="numbersMini" value=explode(",", $numberStringMini)}
                    {/if} *}

                        {if $key == 0 && $child.id_parent_card == 1}
                          <div class="card-img ">
{* aquui *}

                          {if  $child['id_compat'] > 0}
                            <a style="cursor: pointer;"
                            onclick="setCarSearch({$child['id_compat']})">
                            {elseif $linkBrandMini != ''}
                              <a href="/{$currentLanguageIso}/{$linkBrandMini}-product.html">
                            {/if}
                              <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                              <img src="{$child["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$child.id_parent_card}_{$childkey}" />
                            {if $child['id_compat'] > 0}
                            </a>
                            {elseif $linkBrandMini != ''}
                              </a>
                            {else}
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
                            {if  $child['id_compat'] > 0}
                              <a style="cursor: pointer;"
                              onclick="setCarSearch({$child['id_compat']})">
                              {elseif $linkBrandMini != ''}
                                <a href="/{$currentLanguageIso}/{$linkBrandMini}-product.html">
                              {/if}
                                <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                                <img src="{$child["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$child.id_parent_card}_{$childkey}" />
                              {if $child['id_compat'] > 0}
                              </a>
                              {elseif $linkBrandMini != ''}
                                </a>
                              {else}
                                </a>
                            {/if}
                          </div>
                        {elseif  $key == 2 && $child.id_parent_card == 3}
                          <div class="card-img ">
                            {if  $child['id_compat'] > 0}
                            <a style="cursor: pointer;"
                            onclick="setCarSearch({$child['id_compat']})">
                            {elseif $linkBrandMini != ''}
                              <a href="/{$currentLanguageIso}/{$linkBrandMini}-product.html">
                            {/if}
                              <div class="layerHover">{$child["title_{$currentLanguageIso}"]}</div>
                              <img src="{$child["image_{$currentLanguageIso}"]}" loading="lazy" alt="banner_{$child.id_parent_card}_{$childkey}" />
                            {if $child['id_compat'] > 0}
                            </a>
                            {elseif $linkBrandMini != ''}
                              </a>
                            {else}
                              </a>
                            {/if}
                          </div>
                        {/if}
                      
                    {/foreach}
                    </div>    
                </div>
              {/foreach}
            </div>

            <div class="lines-tablet" style="border-top:4px solid var(--euromus-color-200);border-bottom:4px solid var(--euromus-color-300);padding-block:2px;width: 100%;"></div>
            
            <div class="bannersHomeMobile">
            {foreach from=$mobile item=mobileItem key=mobilekey name=mobilename}
              {assign var="url" value=$mobileItem["image_{$currentLanguageIso}"]}
              {assign var="numberString" value="`$url`"|regex_replace:"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*$/":"$1,$2,$3,$4"}
              {assign var="linkBrand" value=$mobileItem["link"]}

              {* {if $numberString != $url}
                {assign var="numbers" value=[]}
                  {assign var="numbers" value=explode(",", $numberString)}
              {/if} *}

                {if $mobileItem['id_compat'] > 0}
                  <a class="card-img" style="cursor: pointer; position: relative;" onclick="setCarSearch({$mobileItem['id_compat']})">
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

                {if $mobileItem['id_compat'] > 0}
                </a>
                {elseif $linkBrand != ''}
                  </a>
                {else}
                  </a>
                {/if}
                
              {/foreach}
          
            </div>

            {* cars *}

            <div class="hidden-md-up"
  style="border-top:4px solid var(--euromus-color-200);border-bottom:4px solid var(--euromus-color-300);padding-block:2px;width: 100%;background: #fff;"></div>
{* cars section *}
<div class="cars-container">
  <div class="cars-cards col-12">
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordMustang.png" alt="Card image Ford Mustang" loading="lazy">
      <div class="card-title">Ford Mustang</div>
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
                      onclick="showCarVersions(this)">{$item.name}</a>
                      <div class="container-versions-car" style="display: none;">
                        {foreach from=$item.versions item=version key=versionkey}
                          <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                        {/foreach}
                      </div>
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
      <div class="card-title">Chevrolet Camaro</div>
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
              {* {foreach from=$versionsChevroletCamaro item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeChallenger.png" alt="Card image Dodge Challenger" loading="lazy">
      <div class="card-title">Dodge Challenger</div>
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
              {* {foreach from=$versionsDodgeChallenger item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/ChevroletCorvette.png" alt="Card image Chevrolet Corvette" loading="lazy">
      <div class="card-title">Chevrolet Corvette</div>
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
                {* {foreach from=$versionsChevroletCorvette item=item key=key name=name}
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="showCarVersions(this)">{$item.name}</a>
                      <div class="container-versions-car" style="display: none;">
                        {foreach from=$item.versions item=version key=versionkey}
                          <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                        {/foreach}
                      </div>
                  </div>
                {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/RamTrx.png" alt="Card image Ram Trx" loading="lazy">
      <div class="card-title">Ram Trx</div>
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
              {* {foreach from=$versionsRamTrx item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeCharger.png" alt="Card image Dodge Charger" loading="lazy">
      <div class="card-title">Dodge Charger</div>
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
              {* {foreach from=$versionsDodgeCharger item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordBronco.png" alt="Card image Ford Bronco" loading="lazy">
      <div class="card-title">Ford Bronco</div>
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
                {* {foreach from=$versionsFordBronco item=item key=key name=name}
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="showCarVersions(this)">{$item.name}</a>
                      <div class="container-versions-car" style="display: none;">
                        {foreach from=$item.versions item=version key=versionkey}
                          <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                        {/foreach}
                      </div>
                  </div>
                {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/JeepCherokee.png" alt="Card image Jeep Cherokee" loading="lazy">
      <div class="card-title">Jeep Cherokee</div>
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

          <div id="collapseEight" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              {* {foreach from=$versionsJeepCherokee item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordF-150.png" alt="Card image Ford F-150" loading="lazy">
      <div class="card-title">Ford F-150</div>
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
              {* {foreach from=$versionsFordShelby item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/JeepWrangler.png" alt="Card image Jeep Wrangler" loading="lazy">
      <div class="card-title">Jeep Wrangler</div>
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
              {* {foreach from=$versionsJeepWrangler item=item key=key name=name}
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="showCarVersions(this)">{$item.name}</a>
                    <div class="container-versions-car" style="display: none;">
                      {foreach from=$item.versions item=version key=versionkey}
                        <span class="car_version" style="display:flex;flex-direction: column;gap: .5rem;margin-top: .5rem;" onclick="searchCompat({$version.compat_data[0].id_compat})">{$version.compat_data[0].version}</span>
                      {/foreach}
                    </div>
                </div>
              {/foreach} *}
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
            style="border-top:4px solid var(--euromus-color-200);border-bottom:4px solid var(--euromus-color-300);padding-block:2px;width: 100%;background: #fff;"></div>
            <div class="hidden-sm-down" style="border-top:4px solid var(--euromus-color-200);border-bottom:4px solid var(--euromus-color-300);padding-block:2px;width: 100%;  background: #fff;"></div>
          <div class="otherCars"
            style="width:100%;display: flex;flex-direction:column;justify-content:center;align-items:center;background:#142c46;">
            {* <div class="titleCars" style="text-align: center;padding:3rem 0">
              <h5 style="font-weight: 400;">OTHER</h5>
              <h3>VEHICLE TYPES</h3>
            </div> *}
            <div class="categoryCars" style="display: grid;width:100%;padding:3rem 1rem;max-width:1920px;gap:2rem;grid-template-columns: repeat(auto-fit,minmax(250px,1fr));">
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
                      {if $category.link_rewrite !== 'clearance' && $category.link_rewrite !== 'liquidacion' &&  $category.link_rewrite !== 'destockage'}
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
            <div style="border-top:4px solid var(--euromus-color-200);border-bottom:4px solid var(--euromus-color-300);padding-block:2px;width: 100%;background: #fff;"></div>
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
                  <div  class="iframeClass" style="display: none;">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$icon.youtube_code}?autoplay=0&mute=0&rel=0&controls=1" loading="lazy">
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

                function setCarSearch(idCompat) {
                    window.location.href = "{$link->getPageLink('cars-products')}?id_compat="+idCompat
                }
                // function setCarAndSearch(brand, model, type, version) {
                //     $("#custom_filter_1").prop('value', brand);
                //     $("#custom_filter_2").prop('value', model);
                //     $("#custom_filter_3").prop('value', type);
                //     $("#custom_filter_4").prop('value', version);
                //     $('#ukoocompat_my_cars_custom_form').submit();
                //   }

                  function getCarVersions(e,brand,model,type) {

                    $.ajax({
                      url: '{$link->getPageLink('index')}',
                      type: 'GET',
                      data: {
                        getCarVersions: 1,
                        brand : brand,
                        model: model,
                        type: type,
                        storeId: {Context::getContext()->shop->id}
                      },
                      success: function(response) {
                        console.log(response)
                              // Check if compat_data exists and has at least one item
                        if (response && response.length > 0) {
                          let spanContent = ''; // This will store the HTML for the spans
                          
                          // Loop through each version object
                          response.forEach(function(version) {
                            // Check if compat_data exists within each version object
                            if (version.compat_data && version.compat_data.length > 0) {
                              // Loop through each compat_data item in this version and create a span for it
                              version.compat_data.forEach(function(compatData) {
                                spanContent += '<span onclick="searchCompat('+ compatData.id_compat +')">'+ compatData.version +'</span>';
                              });
                            }
                          });

                          const carVersionSpan = $(e).closest('.card-link').find('.car_version');;  // Find the sibling span with the class 'car_version'
                          
                          console.log(carVersionSpan.length)
                          console.log(carVersionSpan)


                           if (carVersionSpan.length > 0) {
                              console.log(carVersionSpan)
                          carVersionSpan.html(spanContent); // Insert the generated span content
                           }
                        } else {
                          console.error("No compat data found in the response.");
                        }

                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", status, error);
                      }
                    })
                  }

                  function showCarVersions(e) {
                    const element = e.nextElementSibling;

                    if (element.style.display === "none") {
                      element.style.display = "block";
                      e.classList.add("show");
                    } else {
                      element.style.display = "none";
                      e.classList.remove("show");
                    }
                  }

                  function searchCompat(id_compat) {
                    window.location.href = "{$link->getPageLink('cars-products')}?id_compat="+id_compat
                  }

              </script>

<style>
  

@media screen and (max-width:767px){
  .categoryCars .category {
  max-height: 291px !important;
  background: var(--euromus-color-500)  !important;
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


 