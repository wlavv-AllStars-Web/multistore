{assign var="currentLanguage" value=Context::getContext()->language}
{assign var="currentLanguageIso" value=Context::getContext()->language->iso_code}
{assign var="manufacturers" value=Manufacturer::getManufacturers()}

<div style="display: none;">
                            
  <form id="ukoocompat_clear_my_cars_custom_form" action="/en/module/ukoocompat/listing" method="POST"> 
      <input type="hidden" name="id_search" value="1"> 
      <input type="hidden" name="id_search3" value="1"> 
      <input type="hidden" name="id_lang" value="{Context::getContext()->language->id|escape:'html':'UTF-8'}">
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
      <input type="hidden" id="custom_filter_1" name="filters1" value="0">
      <input type="hidden" id="custom_filter_2" name="filters2" value="0">
      <input type="hidden" id="custom_filter_3" name="filters3" value="0">
      <input type="hidden" id="custom_filter_4" name="filters4" value="0">
  </form>    
            
</div>
{* {debug} *}

<div style="display: none;">
  <form id="ukoocompat_my_cars_custom_form" action="/en/module/ukoocompat/listing" method="POST"> 
      <input type="hidden" name="id_search" value="1"> 
      <input type="hidden" name="id_search3" value="1"> 
      <input type="hidden" name="id_lang" value="{Context::getContext()->language->id|escape:'html':'UTF-8'}">
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
      <input type="hidden" id="custom_filter_1" name="filters1" value="">
      <input type="hidden" id="custom_filter_2" name="filters2" value="">
      <input type="hidden" id="custom_filter_3" name="filters3" value="">
      <input type="hidden" id="custom_filter_4" name="filters4" value="">
  </form>
</div>

<div class="header_content">
{block name='header_nav'}
  <nav class="header-nav d-none d-lg-block" style="margin-bottom:0;background:linear-gradient(to bottom, #969696,#282828);">
    <div class="container-fluid">
        <div class="nav" style="display: flex;justify-content:space-between;width:100%;align-items:center;margin-top: -2px;">
            <div class="left-nav">
              <div style="display: flex;">
              {hook h='displayNav1'}
                <a title="Whatsapp" class="social-icon" style="color: rgb(255, 255, 255); margin-right: 8px; padding-right: 8px; display: flex; align-items: center; float: left; background: unset;" href="https://wa.me/+351912201753" target="_blank" onmouseover="this.style.color='#dd170e';this.style.background='#161616'" onmouseout="this.style.color='#fff';this.style.background='unset'">
                    <img src="https://www.all-stars-motorsport.com/img/whatsapp_search.png" style="width: 24px; height: 24px;padding:3px;margin-left:1rem;" alt="Whatsapp">
                    {if $currentLanguageIso === 'en'}
                    <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:600;">+351 912 201 753</p>
                    {elseif $currentLanguageIso === 'es'}
                    <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:600;">+34 691 16 15 70</p>
                    {elseif $currentLanguageIso === 'fr'}
                    <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:600;">+33 0651871788</p>
                    {/if}

                </a>
              </div>
            </div>

            <div class="right-nav" style="display: flex;gap:1rem;align-items:center;">
              <a class="alma-options-header" href="{$link->getCMSLink(5)}">{l s='PAY IN 3 / 4 INSTALLMENTS BY CREDIT CARD - LEARN MORE' d='Shop.Theme.Homepage'}</a>
              {hook h='displayNav2'}
            </div>
        </div>
    </div>
  </nav>
  
  <nav class="header-nav mobile" style="margin-bottom:0;background: #111111;height: 43px;">
    <div class="container-fluid">
        <div class="nav" style="display: flex;justify-content:space-between;width:100%;align-items:center;padding-top: 5px;">
            <div class="left-nav col-4 d-flex justify-content-start align-items-center">
              <i onclick="dropdownSearch()" class="fa-solid fa-magnifying-glass" style="cursor:pointer;padding-right: 12px;"></i>
              <span class="languageMobile" style="font-weight: 600;" onclick="dropdownFlags()">{strtoupper($currentLanguageIso)}</span>
              
              <a style="color: #fff;" href="https://wa.me/+351912201753" target="_blank" title="Whatsapp">
                <img src="https://www.all-stars-motorsport.com/img/whatsapp_search.png" style="width: 20px; height: 20px; margin-top: -5px;" alt="Whatsapp">
              </a>
            </div>
            <div class="col-4 d-flex justify-content-center">
              <img width="32" height="32" src="/img/eum.png" />
            </div>
            <div class="right-nav  col-4" style="display: flex;align-items:center;justify-content: end;">
                {hook h='displayNav2' mod='ps_shoppingcart'}
                {hook h='displayMyAccountBlock'}
            </div>
        </div>
    </div>
  </nav>

{/block}

{block name='header_top'}
  <div class="menu-languageselector-mobile">
    {hook h='displayNav2' mod='ps_languageselector'}
  </div>
  <div class="menu-searchbar">
    {hook h='displaySearch'}
  </div>
  <div class="header-top" style="background:  #282828;margin:0;">
  {* <pre>{print_r($currentLanguage,1)}</pre> *}
    <div class="container-fluid">
       <div class="row">
        <div class="col-xs-12 col-lg-4 d-flex justify-content-sm-center justify-content-lg-start p-0" id="_desktop_logo">
          <a href="{$urls.base_url}">
            <img class="logo img-responsive" src="{if isset($tc_dev_mode) && $tc_dev_mode && isset($logo_url)&&$logo_url}{$logo_url}{else}{$shop.logo}{/if}" alt="{$shop.name}" style="max-width: 180px;
              padding: 0px;
              margin: 20px 45px;">
          </a>
        </div>
        <div class="col-md-4  d-none d-lg-flex justify-content-center align-items-center" >
        <img width="90" height="90" src="/img/eu.png" />
        </div>
        <div class="col-md-4 d-none d-lg-flex justify-content-end align-items-center" style="position: relative;z-index:1;padding-right: 3rem;">
            {hook h='displaySearch'}
            <div class="clearfix"></div>
        </div>
      </div>
    </div>
    {* menu *}

    <div class="menu d-none d-lg-flex col-12 js-top-menu position-static hidden-sm-down" id="_desktop_top_menu">  
      <ul class="list-menu-desktop">
        <li>
          <a href="/">Home</a> 
        </li>
        <li>
          <a href="{$link->getPageLink('new-products', true)}">{l s='News' d='Shop.Theme.Homepage'}</a>
        </li>

        <li {if $page.page_name =='index'}class="dropdown" {/if}>
            <a class="link-logosMenu"  {if $page.page_name !='index'}role="link" href="/en/?open=yourCar"{else} data-toggle="dropdown" aria-expanded="false" {/if} >Your Car</a>
              <div class="dropdown-menu menu-logos">
          {if $page.page_name =='index'}
            {if $customer.is_logged && is_array($myCars) && ( count($myCars) > 0 ) }
              <div id="your_garage_container" style="text-align: center;margin: 0 auto;display: none;">
                    <h2 id="openMyCars" style="cursor: pointer;">{l s='Your Garage' d='Shop.Theme.Homepage'}</h2>
                    <div class="cars-container">
                  {foreach $myCars AS $car}
                      <div style="width: 190px; float: left;margin: 20px;font-size: 18px; line-height: 2;text-align: center;" class="myCars">
                          <div onclick="setCarAndSearch({$car['id_brand']}, {$car['id_model']}, {$car['id_type']}, {$car['id_version']})" style="cursor: pointer;">
                              {assign var=check_path value="/img/homepage/models/{$car['id_brand']}_{$car['id_type']}.png"}
                              {if !file_exists($check_path) }
                                  <img class="img-responsive" src="/img/homepage/models/{$car['id_brand']}_{$car['id_type']}.png" style="margin: 0 auto;width: 300px; pointer-events: none;">
                                {else}
                                  <img class="img-responsive" src="/img/homepage/models/unknown.png" style="margin: 0 auto;width: 300px; cursor: pointer;">
                                {/if}
                          </div>
                          <div>
                              <div class="spacer-10"></div>
                              <div class="brand-model" onclick="setCarAndSearch({$car['id_brand']}, {$car['id_model']}, {$car['id_type']}, {$car['id_version']})" style="cursor: pointer;">
                                  <div><span>{$car['brand']}</span> <span>{$car['model']}</span> </div>	                
                              </div>
                            </div>
                      </div>
                      
                  {/foreach}
                    </div>
              </div>
            {/if}
              
                  {hook h="displayHome" mod="ukoocompat"}
              </div>
          {/if}
        </li>

        <li class="dropdown brands-drop">
          <a class="dropdown-toggle-brands"  role="button" data-toggle="dropdown" aria-expanded="false">{l s='Brands' d='Shop.Theme.Homepage'}</a>
          <ul class="dropdown-menu-brands">
          {foreach from=$manufacturers item=$manufacturer }
            <li class="col-lg-3">
              <a href="/{$currentLanguage->iso_code }/brand/{$manufacturer.id_manufacturer}-{$manufacturer.link_rewrite}">
                {$manufacturer.name}
              </a>
            </li>
          {/foreach}
          </ul>
        </li>
        {* <li><a href="{$link->getPageLink('manufacturer', true)}">Brands</a></li> *}
        <li><a href="{$link->getCategoryLink(227)}">{l s='Wheels' d='Shop.Theme.Homepage'}</a></li>
        <li><a href="{$link->getPageLink('contact', true)}">{l s='Contact' d='Shop.Theme.Homepage'}</a></li>
      </ul>
    <div class="clearfix"></div> 
    </div>
{* {debug} *}
{* <pre>{$customer|print_r}</pre> *}

  </div>
  {hook h='displayNavFullWidth'}
{/block}
</div>
{hook h='displayMLS'}

<script>

    // function setCarAndSearch(brand, model, type, version){
        
    //     $("#custom_filter_1").prop('value', brand);
    //     $("#custom_filter_2").prop('value', model);
    //     $("#custom_filter_3").prop('value', type);
    //     $("#custom_filter_4").prop('value', version);
        
    //     $('#ukoocompat_my_cars_custom_form').submit();
        
    // }


    document.addEventListener('DOMContentLoaded', (event) => {
        const queryString = window.location.search;
        console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const open = urlParams.get('open');
        
        const dropdownMenu = document.querySelector(".dropdown-menu.menu-logos");
        const garageContainer = document.getElementById('your_garage_container');


        if (dropdownMenu) {

            const holder_your_car = dropdownMenu.parentNode;

            if (open === 'yourCar') {
                holder_your_car.classList.add("open");
                if(garageContainer){
                  garageContainer.style.display = 'flex';
                }
            } else {
                holder_your_car.classList.remove("open");
                if(garageContainer){
                  garageContainer.style.display = 'none';
                }
            }
        }
    });
</script>
