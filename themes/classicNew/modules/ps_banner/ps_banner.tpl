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

{* <div id="custom-banner"> *}
{* {$cms_infos.text nofilter} *}
{* <div class="selectVehicle-container">
  <h1>SELECT YOUR VEHICLE</h1>
  <div class="selects-card">
    <div class="selectField">
      <input id="modelyearHidden" type="hidden" value="">
      <label for="modelyear">MODELYEAR</label>
      <select name="modelyear" id="modelyear">
        <option value="ano">Select modelyear...</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
        <option value="ano">1</option>
      </select>
    </div>
    <div class="selectField">
    <input id="brandHidden" type="hidden" value="">
      <label for="brand">BRAND</label>
      <select name="brand" id="brand" disabled>
        <option value="brand">Select brand...</option>
        <option value="2">2</option>
        <option value="2">2</option>
      </select>
    </div>
    <div class="selectField">
    <input id="modelHidden" type="hidden" value="">
      <label for="model">MODEL</label>
      <select name="model" id="model" disabled>
        <option value="model">Select model...</option>
        <option value="3">3</option>
        <option value="3">3</option>
      </select>
    </div>
    <div class="selectField">
      <input id="versionHidden" type="hidden" value="">
      <label for="version">VERSION</label>
      <select name="version" id="version" disabled>
        <option value="version">Select version...</option>
        <option value="4">4</option>
        <option value="4">4</option>
      </select>
    </div>
    <div class="selectField">
      <button class="btn" disabled>SEARCH</button>
    </div>
  </div> *}
{* <div class="counter-products">
    <span>3.811.039</span> products available in the catalog
  </div> *}
{* <div class="mobileLine"></div>
  <div class="mobilePartsCar">
    <div class="mobilePartsCar-text">
      <p>Precisa de fazer uma reparação, tem uma lista de peças ou não consegue encontrar o que precisa?<br>
      Peça um orçamento personalizado à AmericanParts!
      </p>
    </div>
    <div class="mobilePartsCar-button">
      <a class="btn">Orçamento de peças sobresselentes</a>
    </div>
  </div> *}
{* </div> *}
{assign var="currentLanguageIso" value=Context::getContext()->language->iso_code}
{assign var="currentLanguage" value=Context::getContext()->language->id}
{assign var="categories" value=Category::getCategories($currentLanguage)}
{assign var="versionsFordMustang" value=IndexControllerCore::getCarsOfBrand("Ford","Mustang",$currentLanguage)}
{assign var="versionsChevroletCamaro" value=IndexControllerCore::getCarsOfBrand("Chevrolet","Camaro",$currentLanguage)}
{assign var="versionsChevroletCorvette" value=IndexControllerCore::getCarsOfBrand("Chevrolet","Corvette",$currentLanguage)}
{assign var="versionsDodgeChallenger" value=IndexControllerCore::getCarsOfBrand("Dodge","Challenger",$currentLanguage)}
{assign var="versionsRamTrx" value=IndexControllerCore::getCarsOfBrand("Ram","Trx",$currentLanguage)}


<div style="display: none;">
  <form id="ukoocompat_my_cars_custom_form" action="/en/module/ukoocompat/listing" method="POST"> 
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
{* aqui *}



</div>
<div class="lines-tablet"
  style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
<div class="bannersHome">
  <div class="card-img-container">
    <div class="card-big">
      <div class="layerHover">
        <h6>Ram 1500</h6>
      </div>
      <img src="/img/eurmuscle/bannersHome/banner1.png" />
    </div>
    <div class="card-min-img">
      <div class="card-img ">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini1.jpg" />
      </div>
      <div class="card-img">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini2.png" />
      </div>
      <div class="card-img">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini3.png" />
      </div>
    </div>
  </div>
  <div class="card-img-container">
    <div class="card-big">
      <div class="layerHover">
        <h6>Jeep</h6>
      </div>
      <img src="/img/eurmuscle/bannersHome/banner2.png" />
    </div>
    <div class="card-min-img">
      <div class="card-img ">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini1.jpg" />
      </div>
      <div class="card-img">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini2.png" />
      </div>
      <div class="card-img">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini3.png" />
      </div>
    </div>
  </div>
  <div class="card-img-container">
    <div class="card-big">
      <div class="layerHover">
        <h6>Ford Mustang</h6>
      </div>
      <img src="/img/eurmuscle/bannersHome/banner3.png" />
    </div>
    <div class="card-min-img">
      <div class="card-img ">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini1.jpg" />
      </div>
      <div class="card-img">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini2.png" />
      </div>
      <div class="card-img">
        <div class="layerHover">RAM 1500</div>
        <img src="/img/eurmuscle/bannersHome/banner_mini3.png" />
      </div>
    </div>
  </div>
</div>
<div class="lines-tablet"
  style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>

<div class="bannersHomeMobile">
  <a class="card-img" href="">
    <img src="/img/eurmuscle/bannersHome/banner_mini1.jpg" />
    <div class="layerHovermobile">Jeep Wrangler</div>
  </a>
  <a class="card-img">
    <img src="/img/eurmuscle/bannersHome/banner_mini2.png" />
    <div class="layerHovermobile">Ram 1500</div>
  </a>
  <a class="card-img">
    <img src="/img/eurmuscle/bannersHome/banner_mini3.png" />
    <div class="layerHovermobile">Jeep Wrangler</div>
  </a>
</div>

<div class="hidden-md-up"
  style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>

<div class="cars-container">
  <div class="cars-cards col-12">
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordMustang.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/Camaro.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeChallanger.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/Corvette.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/RamTrx.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/CHARGER.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/BRONCO.png" alt="Card image cap">
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
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/CHEROKEE.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/F-150.png" alt="Card image cap">
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
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/WRANGLER.png" alt="Card image cap">
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
{*  *}
<div class="hidden-md-up"
  style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
  <div class="hidden-sm-down" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
<div class="otherCars"
  style="width:100%;display: flex;flex-direction:column;justify-content:center;align-items:center;background:#707c88;">
  {* <div class="titleCars" style="text-align: center;padding:3rem 0">
    <h5 style="font-weight: 400;">OTHER</h5>
    <h3>VEHICLE TYPES</h3>
  </div> *}
  <div class="categoryCars" style="display: flex;justify-content:space-evenly;width:100%;padding:3rem 0;">
    {foreach from=$categories[1] item=categoryLevel1}
      {foreach from=$categoryLevel1 item=category}
        {if $category.id_category != 2}
          {if $category.id_category == 14}
            <a rel="nofollow" href="http://tune4style.com/{$currentLanguageIso}" class="select-list ">
              <div class="category {$category.name}">
                <img src="/img/eurmuscle/bannersHome/{$category.id_category}.png" loading="lazy" alt="{$category.name}">
                <div class="model-type-overlay"><span>{$category.name}</span></div>
              </div>
            </a>
          {else}
            <a rel="nofollow" href="/{$category.id_category}-{$category.link_rewrite}" class="select-list ">
              <div class="category {$category.name}">
                <img src="/img/eurmuscle/bannersHome/{$category.id_category}.png" loading="lazy" alt="{$category.name}">
                <div class="model-type-overlay"><span>{$category.name}</span></div>
              </div>
            </a>
          {/if}
        {/if}
      {/foreach}
    {/foreach}

  </div>
</div>

<div style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
{* <div class="videosContainer">
  <div class="video1 video">
    <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
      <img src="/img/eurmuscle/bannersHome/vid1.png" />
      <div class="play">
        <img class="image_play" alt="video player" src="/img/youtube_play.png" />
      </div>
    </div>
    <div class="iframeClass" style="display:none">
      <iframe frameborder="0" allowfullscreen src="https://www.youtube.com/embed/sGZ1lRpGfnA?autoplay=0&mute=1&rel=0" loading="lazy">
      </iframe>
    </div>
  </div>
  <div class="video2 video">
    <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
      <img src="/img/eurmuscle/bannersHome/vid2.png" />
      <div class="play">
        <img class="image_play" alt="video player" src="/img/youtube_play.png" />
      </div>
    </div>
    <div  class="iframeClass" style="display:none">
      <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/5SpcsztedgQ?autoplay=0&mute=1&rel=0" loading="lazy">
      </iframe>
    </div>
  </div>
  <div class="video3 video">
    <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
      <img src="/img/eurmuscle/bannersHome/vid3.png" />
      <div class="play">
        <img class="image_play" alt="video player" src="/img/youtube_play.png" />
      </div>
    </div>
    <div  class="iframeClass"  style="display:none">
      <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/KWLv_iCL8ww?autoplay=0&mute=1&rel=0" loading="lazy">
      </iframe>
    </div>
  </div>
</div> *}

<style>
  .video {
    width: 100%;
  }
</style>

<script>
  window.addEventListener("DOMContentLoaded", () => {
    const brandSelect = document.querySelector('#ukoocompat_select_1')
    const modelSelect = document.querySelector('#ukoocompat_select_2')
    const typeSelect = document.querySelector('#ukoocompat_select_3')
    const versionSelect = document.querySelector('#ukoocompat_select_4')
    // const buttonSubmit = document.querySelector('.selectField .btn')

    brandSelect.firstElementChild.setAttribute('selected', 'selected');
    modelSelect.firstElementChild.setAttribute('selected', 'selected');
    typeSelect.firstElementChild.setAttribute('selected', 'selected');
    versionSelect.firstElementChild.setAttribute('selected', 'selected');

    // hover youtube

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


    const cardsVersions = document.querySelectorAll(".cars-cards .card");
    cardsVersions.forEach((item) => {

      const cardImg = item.querySelector(".card-img-top");
      const versionsButton = item.querySelector('.btn');
      cardImg.addEventListener('click', (event) => {
        versionsButton.click();
      });
    });


  });

  var globalBrand;
  var globalModel;
  var globalType;
  var globalVersion;
  var globalImgBrand;



  // function hideMyCars(element,brand){
  //     brandName= $("#brandName_"+brand).val();


  //     $.ajax({
  //         method:"POST",
  //         url:"/?action=getMenuHtml",
  //         data:{
  //             action:'getMenuHtml',
  //             brand:brand

  //         }

  //     }).done(function(html){

  //         $('.selected_item').css('border','1px solid #282828');
  //         $('.car_item_image').css('background-color','transparent');
  //         $('.ukoocompat_search_block_filter').css('display', 'none')
  //         $('.block_content').css('display', 'none !important')
  //         element.css('border','1px solid red').css('border-radius','5px');
  //         if(screen.width < 960){
  //         $('.selector_car_container').replaceWith('<div class="selector_car_container"><button class="btn-back" type="button" onclick="$(\'#ukoocompat_clear_my_cars_custom_form\').submit()"><span class="material-symbols-outlined" style="font-size:30px;">arrow_left</span>{l s='Back'}</button><div class="informationBrandModel" style="display:flex !important;"><img src="/img/homepage/brands/'+brand+'.png" width="70px" /><div id="breadcrumbModel"><span style="text-transform:uppercase;font-weight:bold;color:red;">'+brandName+'</span> <span class="material-symbols-outlined" style="font-size:30px;">arrow_right</span> MODEL <span class="material-symbols-outlined" style="font-size:30px;">arrow_right</span> TYPE <span class="material-symbols-outlined" style="font-size:30px;">arrow_right</span> VERSION</div></div>' + html + '</div>');
  //         } else {
  //             $(".selector_car_container").replaceWith('<div class="selector_car_container" style="display:flex !important;background:red;">' + html + "</div>");
  //         }
  //         $('.myCars').hide('slow');
  //         $('.selector_car_container').show('slow');



  //     });
  // }

  // $("#openMyCars").click(function(){
  //     $('.myCars').show('slow');
  //     $('.selector_car_container').hide('slow');

  // });

  // function mouseHoverMyCars(element,id){
  //     let img=element.find('img');
  // img.attr('src','/img/homepage/brands/_'+id+'.png');

  // }

  function setCarAndSearch(brand, model, type, version) {
    $("#custom_filter_1").prop('value', brand);
    $("#custom_filter_2").prop('value', model);
    $("#custom_filter_3").prop('value', type);
    $("#custom_filter_4").prop('value', version);
    $('#ukoocompat_my_cars_custom_form').submit();

  }

  // javascript carsmobile

  window.addEventListener("orientationchange", function() {
    location.reload();
  });


  if (window.innerWidth < 768) {

    const modelCars = document.querySelectorAll('.cars-cards');
    modelCars.forEach(function(container) {
      // console.log(container.children.length)
      if (container.children.length > 1) {
        // container.classList.add('hasMultipleChildren');


        container.querySelectorAll('.card').forEach((child, index) => {


          child.style.position = "relative";
          const div = document.createElement('div');

          const arrowRight = document.createElement('span')
          arrowRight.classList.add("fa");
          arrowRight.classList.add("fa-chevron-right");
          // arrowRight.textContent += 'arrow_right';
          arrowRight.style.marginLeft = "1rem";
          arrowRight.style.fontSize = "30px";
          arrowRight.style.right = "1rem";
          arrowRight.style.top = "50%";
          arrowRight.style.transform = "translateY(-50%)";
          arrowRight.style.color = "#fff";
          // arrowRight.style.background = "rgba(255, 255, 255, 0.4)";
          arrowRight.style.padding = "0.25rem";
          arrowRight.style.borderRadius = "5px";
          // arrowRight.style.boxShadow = "2px 4px 4px #444444";
          arrowRight.style.position = "absolute";
          arrowRight.style.width = "2.5rem";
          arrowRight.style.height = "2.5rem";
          arrowRight.style.cursor = "pointer";

          //     // arrow left

          const arrowLeft = document.createElement('span');
          arrowLeft.classList.add("fa");
          arrowLeft.classList.add("fa-chevron-left");
          // arrowLeft.textContent += 'arrow_left';
          arrowLeft.style.fontSize = "30px";
          arrowLeft.style.left = "1rem";
          arrowLeft.style.top = "50%";
          arrowLeft.style.transform = "translateY(-50%)";
          arrowLeft.style.color = "#fff";
          // arrowLeft.style.background = "rgba(255, 255, 255, 0.4)";
          arrowLeft.style.padding = "0.25rem";
          arrowLeft.style.borderRadius = "5px";
          // arrowLeft.style.boxShadow = "2px 4px 4px #444444";
          arrowLeft.style.position = "absolute";
          arrowLeft.style.width = "2.5rem";
          arrowLeft.style.height = "2.5rem";
          arrowLeft.style.cursor = "pointer";

          if (index === 0) {

            arrowRight.addEventListener('click', function() {

              if (index < container.children.length - 1) {

                const nextIndex = index + 1;
                container.children[nextIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest',
                  inline: 'start' });
              }
            });
            child.appendChild(arrowRight)
          } else if (index == container.children.length - 1) {


            arrowLeft.addEventListener('click', function() {
              if (index == container.children.length - 1) {

                const prevIndex = index - 1;
                container.children[prevIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest',
                  inline: 'start' });
              }
            });

            child.appendChild(arrowLeft)
          } else {


            arrowLeft.addEventListener('click', function() {


              const prevIndex = index - 1;
              container.children[prevIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest',
                inline: 'start' });

            });
            arrowRight.addEventListener('click', function() {

              if (index < container.children.length - 1) {

                const nextIndex = index + 1;
                container.children[nextIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest',
                  inline: 'start' });
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
</script>


{* <a class="banner" href="{$banner_link}" title="{$banner_desc}">
  {if isset($banner_img)}
    <img src="{$banner_img}" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid" loading="lazy" width="1110" height="213">
  {else}
    <span>{$banner_desc}</span>
  {/if}
</a> *}


<style>
  

  @media screen and (max-width:767px){
    .categoryCars .category {
    max-height: 291px !important;
    background: #bfbfbf !important;
  }
  .categoryCars .category img {
    width: 100%;
    object-fit: cover;
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