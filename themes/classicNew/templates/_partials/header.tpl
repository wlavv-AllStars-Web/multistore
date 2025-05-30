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

 {* {Language::getLanguages(true, $this->context->shop->id)} *}

{assign var="languages" value=Language::getLanguages(true, $this->context->shop->id)}
{assign var="currentLanguage" value=Context::getContext()->language}
{assign var="linkRegistration" value=$urls.pages.registration}
{assign var="linkMyaccount" value=$urls.pages.my_account}
{assign var="linkShipping" value=$link->getCMSLink(46)}
{assign var="linkPayment" value=$link->getCMSLink(47)}
{assign var="linkClearance" value=$link->getCategoryLink(523)}
{assign var="customerId" value=Context::getContext()->customer->id}

{assign var="currentUrl" value=Tools::getCurrentUrl()}
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

<div id="cookie-consent-banner-background"></div>
<div id="cookie-consent-banner">
  <p style="margin: 0;">{l s='To provide the best experiences, we use technologies like cookies to store and/or access device information. By clicking “Accept” you consent to these technologies that may allow us to process data such as browsing behavior or unique IDs on this site. Not consenting or withdrawing consent, may adversely affect certain features and functions.' d="Shop.Theme.Cookies"}</p>
  <button id="accept-cookies">{l s='Accept' d="Shop.Theme.Cookies"}</button>
  <button id="decline-cookies">{l s='Decline' d="Shop.Theme.Cookies"}</button>
</div>

<script>
  // Função para verificar se o consentimento já foi dado
  function checkCookieConsent() {
    return localStorage.getItem('cookieConsent');
  }

  // Função para mostrar o banner de consentimento
  function showConsentBanner() {
    localStorage.removeItem('cookieConsent')
    const banner = document.getElementById('cookie-consent-banner');
    const banner_bg = document.getElementById('cookie-consent-banner-background');
    banner.style.display = 'block';
    banner_bg.style.display = 'block';
  }

  // Função para esconder o banner de consentimento
  function hideConsentBanner() {
    const banner = document.getElementById('cookie-consent-banner');
    const banner_bg = document.getElementById('cookie-consent-banner-background');
    banner.style.display = 'none';
    banner_bg.style.display = 'none';
  }

  // Função para definir o consentimento no localStorage e no dataLayer
  function setConsent(consent) {
    // Salvar o consentimento no localStorage para não aparecer novamente
    localStorage.setItem('cookieConsent', consent);
    
    // Enviar o consentimento para o dataLayer do Google Tag Manager
    window.dataLayer = window.dataLayer || [];
    if (consent === 'granted') {
      window.dataLayer.push({
        event: 'consent',
        ad_storage: 'granted',
        analytics_storage: 'granted'
      });
    } else {
      window.dataLayer.push({
        event: 'consent',
        ad_storage: 'denied',
        analytics_storage: 'denied'
      });
    }

    // Esconde o banner após a escolha do usuário
    hideConsentBanner();
  }

  function isLoggedIn() {
    return {$customer['is_logged'] == 1};
  }

  // Verificar se o consentimento já foi dado
  if (!checkCookieConsent()) {
    if (isLoggedIn()) {
      // Se o usuário está logado
      // , dar consentimento automaticamente
      setConsent('granted');
    } else {
    // Se não, mostrar o banner
    showConsentBanner();
    }
  } else {
    // Se sim, esconder o banner
    hideConsentBanner();

    if (checkCookieConsent() === 'denied') {
      showConsentBanner();
    }
  }

  // Definir comportamento do botão "Aceitar"
  document.getElementById('accept-cookies').addEventListener('click', function() {
    setConsent('granted');
  });

  // Definir comportamento do botão "Recusar"
  document.getElementById('decline-cookies').addEventListener('click', function() {
    setConsent('denied');
  });
</script>



{block name='header_banner'}
  <div class="header-banner">
    {hook h='displayBanner'}
  </div>
{/block}

{block name='header_nav'}
  
  <nav class="header-nav" style="border-bottom: none;">

    <div class="container-fluid">
      <div class="row">
        <div class="hidden-sm-down" style="width: 100%;">
          <div class="col-md-12 col-xs-12" style="display: flex;align-items:center;height:57px;gap:2rem;justify-content:end;width:100%;">
          {hook h='displayNav2'}
          </div>
          <div class="col-md-6 right-nav">
          

          {hook h='displayNav1'}
                
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
          <div class="float-xs-left" id="menu-icon">
            <i class="material-icons d-inline" translate="no">&#xE5D2;</i>
          </div>
          <div class="float-xs-right" id="_mobile_cart" translate="no"></div>
          <div class="top-logo" id="_mobile_logo"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </nav>
{/block}

{block name='header_top'}
  <div class="header-top">
    {* <pre>{$urls.pages.manufacturer|print_r}</pre> *}
    <div class="container-fluid">
       <div class="row row-mobile" style="position: relative;z-index:1;width:100vw;padding: 1rem;display:flex;align-items:center;">
        <div class="col-md-2 hidden-sm-down" id="_desktop_logo" style="display: flex;justify-content:flex-start;">
          {if $shop.logo_details}
            {if $page.page_name == 'index'}
              <h1 class="header-logo">
                {renderLogo}
              </h1>
            {else}
              {renderLogo}
            {/if}
          {/if}
        </div>
        <div class="header-top-right col-md-10 col-sm-12 position-static mobile-search">
          {hook h='displayTop'}
        </div>

        <div class="col-md-10 header-top-right-desktop">
        {hook h='displayNav1'}
        <div class="shipped-eu">
          <a href="{$linkShipping}"><img src="/img/eurmuscle/topHeader/europe-rounded-02.svg
          " alt="shipped from europe"/><div style="display: flex;flex-direction:column;">{l s='SHIPPED' d='Shop.Theme.Global'}<small style="white-space: nowrap;">{l s='FROM EUROPE' d='Shop.Theme.Global'}</small></a></div>
        </div>
        <div class="payment-plans">
          <a href="{$linkPayment}"><img src="/img/eurmuscle/topHeader/payment-01.svg" alt="payment-plans"/><div style="display: flex;flex-direction:column;">{l s='Payment' d="Shop.Theme.Global"}<small style="white-space: nowrap;">{l s='PLANS' d='Shop.Theme.Global'}</small></a></div>
        </div>
        
        {hook h='displayNav2'}

        

        </div>
        </div>
        
      <div class="bg-mobile_top_menu" onclick="closeMenu()"></div>

      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">

        
        <div class="js-top-menu mobile" id="_mobile_top_menu" onclick="closeMenu()">
        <img src="/img/logo-17047994381.jpg" style="width: 26vw; margin-right:auto; margin-left:1rem;" alt="logo Euromuscle">
        <i class="fa fa-times"></i>
          <div>Close</div>
        </div>
        <div class="js-top-menu-bottom mobile-menu-open">
          <div id="_mobile_currency_selector"></div>
          {* <div style="border-top:0.5rem solid #103054;border-bottom:0.5rem solid #ee302e;padding-block:0.25rem;background:#fff;height: 0.5rem;width:100%;z-index:-1;transform:rotate(180deg)"></div> *}
          
          <div id="_mobile_login" class="{if $currentUrl === "http://euromus.local/en/login?back=my-account"}activeLink{/if}">
            {if $customerId }
            <a href="{$linkMyaccount}" style="width: fit-content;"><i class="fa-solid fa-user"></i>{l s='My account' d='Shop.Theme.MenuMobile'}</a>
            {else}
              <a href="{$linkMyaccount}"><i class="fa-solid fa-user"></i>{l s='Login' d='Shop.Theme.MenuMobile'}</a>
            {/if}
          </div>
          <div id="homeLinkMobile" class="{if $currentUrl === $link->getPageLink('index', true)}activeLink{/if}"><a href="/"><i class="fa-solid fa-house"></i>{l s='Home' d='Shop.Theme.MenuMobile'}</a></div>
          <div id="NewsLinkMobile" class="{if $currentUrl === $link->getPageLink('new-products', true)}activeLink{/if}"><a href="{$link->getPageLink('new-products', true)}"><i class="fa-solid fa-newspaper"></i>{l s='News' d='Shop.Theme.MenuMobile'}</a></div>
          <div id="ClearanceLinkMobile" class="{if $currentUrl === $link->getCategoryLink(523)}activeLink{/if}"><a href="{$link->getCategoryLink(523)}"><i class="fa-solid fa-tag"></i>{l s='Clearance' d='Shop.Theme.MenuMobile'}</a></div>
          <div id="_mobile_contact_link" class="{if $currentUrl === $link->getPageLink('contact', true)}activeLink{/if}"><a href="{$link->getPageLink('contact', true)}"><i class="fa-solid fa-phone"></i>{l s='Contacts' d='Shop.Theme.MenuMobile'}</a></div>
          <div id="_mobile_shipping_link" class="{if $currentUrl === $linkShipping}activeLink{/if}"><a href="{$linkShipping}"><i class="fa-solid fa-truck-fast"></i>{l s='Shipping' d='Shop.Theme.MenuMobile'}</a></div>
          <div id="_mobile_payment_link" class="{if $currentUrl === $linkPayment}activeLink{/if}"><a href="{$linkPayment}"><i class="fa-solid fa-credit-card"></i>{l s='Payment' d='Shop.Theme.MenuMobile'}</a></div>
          
          <div id="button_modal_language2" onclick="showLanguagesMobile()"><img src="/img/flags/{$language.iso_code}.jpg" alt="language flag {$language.iso_code}" /><p>{l s='Change Language' d='Shop.Theme.MenuMobile'}</p></div>
          <div id="container-languages-mobile">
            {foreach from=$languages item=$language }
            {if $language.id_lang == 2 ||$language.id_lang == 4 ||$language.id_lang == 5 }
            <div style="display: flex;gap:1rem;align-items:center;width:90%;padding:0.5rem;border-radius: 4px;{if $currentLanguage->iso_code === $language.iso_code}background:#ee302e;{/if}">
              <img src="/img/flags/{$language.iso_code}.jpg" width="16" height="11" alt="flag_{$language.iso_code}"/>
              {* <div id="_mobile_language_selector"></div> *}
              <a href="{url entity='language' id=$language.id_lang}" data-iso="{$language.iso_code}" style="{if $currentLanguage->iso_code === $language.iso_code}color:#fff;{/if}">{$language.name}</a>
              </div>
              {/if}
            {/foreach}
          </div>
          <div id="brands_mobile">
            <div class="btn-brandsMobile"><i class="fa-solid fa-list"></i>{l s='Brands' d='Shop.Theme.MenuMobile'}<i class="fa-solid fa-caret-down"></i></div>
            <ul class="content_brands">
            {foreach from=$manufacturers item=$manufacturer }
              <li class="col-lg-3">
              <a href="/{$currentLanguage->iso_code }/brand/{$manufacturer.id_manufacturer}-{$manufacturer.link_rewrite}">
              <img src="/img/m/{$manufacturer.id_manufacturer}-large_default.webp" alt="Manufacturer {$manufacturer.link_rewrite} logo" width="100" height="45" style="max-width: 100px;" loading="lazy" />
              </a>
              </li>
            {/foreach}
            </ul>
          </div>
          
          {* <div id="_mobile_language_selector"></div> *}
        </div>
      </div>
    </div>
    <div class="linesHeaderDesktop"></div>
    <div style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;background:#fff;width:100%;"></div>
    <ul class="mainmenuDesktop">
        <li class="{if $currentUrl === $link->getPageLink('index', true)}activeLinkDesk{/if}" ><a href="{$link->getPageLink('index', true)}">{l s='Home' d='Shop.Theme.Global'}</a></li>
        <li class="{if $currentUrl === $link->getPageLink('new-products', true)}activeLinkDesk{/if}" ><a href="{$link->getPageLink('new-products', true)}">{l s='News' d='Shop.Theme.Global'}</a></li> 
        <li class="dropdown brands-drop">
          <a class="dropdown-toggle-brands"  role="button" data-toggle="dropdown" aria-expanded="false">{l s='Brands' d='Shop.Theme.Homepage'}</a>
          <ul class="dropdown-content">
          {* <pre>{print_r($manufacturers,1)}</pre> *}
          {foreach from=$manufacturers item=$manufacturer }
            
            <li class="brand-li col-lg-3 col-md-4">
            <a href="/{$currentLanguage->iso_code }/brand/{$manufacturer.id_manufacturer}-{$manufacturer.link_rewrite}">
              {$manufacturer.name}
              {* <img src="/img/tmp/manufacturer_mini_{$manufacturer.id_manufacturer}.jpg?time=1708602834" width="80px" height="auto"/> *}
            </a>
            </li>
          {/foreach}
            
          {* {foreach from=$categories[1] item=categoryLevel1}
            {foreach from=$categoryLevel1 item=category}
              {if $category.id_category == 18}
                <a href="/{$category.id_category}-{$category.link_rewrite}">ALL PRODUCTS</a>
              {/if}
            {/foreach}
          {/foreach}    *}
            
  
            <div style="border-top:2px solid #103054;border-bottom:2px solid #ee302e;padding-block:1px;width: 100%;background:#fff;
            height: 2px;
            position: absolute;
            bottom: 0;"></div>
          </ul>
        </li>
        <li class="{if $currentUrl === $link->getPageLink('contact', true)}activeLinkDesk{/if}" ><a href="{$link->getPageLink('contact', true)}">{l s='Contact' d='Shop.Theme.Global'}</a></li>
        <li class="{if $currentUrl === $linkClearance}activeLinkDesk{/if}" ><a href="{$linkClearance}">{l s='Clearance' d='Shop.Theme.Global'}</a></li>
      </ul>
  </div>
  <style>
    .brands-drop .dropdown-content {
      display: none;
    }

  /* open state */
    .brands-drop.open .dropdown-content {
      display: flex !important;
      flex-wrap: wrap;
    }
  </style>


  <div id="modalLanguage" class="modalLanguage">
  <!-- Modal content -->

    <div class="modal-content" style="display: flex;align-items:center;justify-content:space-between;flex-direction: column;position:relative;gap: 0.85rem;">
    {foreach from=$languages item=$language }
      {if $language.id_lang == 2 ||$language.id_lang == 4 ||$language.id_lang == 5 }
      <div style="display: flex;gap:1rem;align-items:center;width:90%;padding:0.5rem;border-radius: 4px;{if $currentLanguage->iso_code === $language.iso_code}background:#ee302e;{/if}">
        <img src="/img/flags/{$language.iso_code}.jpg" width="16" height="11" alt="flag_{$language.iso_code}"/>
        {* <div id="_mobile_language_selector"></div> *}
        <a href="/{$language.iso_code}" data-iso="{$language.iso_code}" style="{if $currentLanguage->iso_code === $language.iso_code}color:#fff;{/if}">{$language.name}</a>
        </div>
        {/if}
      {/foreach}
      <span class="close" style="color: #103054;opacity:1;position:absolute;top:0.5rem;right:0.5rem;">&times;</span>
    </div>
  </div>  

  {hook h='displayNavFullWidth'}
{/block}

<style>
  #container-languages-mobile {
    display: none !important;
  }
  #container-languages-mobile.show-languages {
    display: flex !important;
    flex-direction: column;
    height: fit-content !important;
  }

  #button_modal_language2 {
    padding: 0.625rem;
  }
</style>

<script>

function showLanguagesMobile() {
  const containerLanguagesMobile = document.querySelector('#container-languages-mobile');

  containerLanguagesMobile.classList.toggle('show-languages');
}

window.addEventListener('scroll', () => {
  const footer = document.querySelector('footer#footer.js-footer');
  if (footer) {
    footer.style.display = "block"
}
});

function openLinkBrands(){
  window.location.href='{$urls.pages.manufacturer}'

}

function closeMenu() {
  const buttonCloseMenu = document.querySelector('#_mobile_top_menu')
const menuMobile = document.querySelector('#mobile_top_menu_wrapper')
const headerMobile = document.querySelector('#header')
const footer = document.querySelector('footer#footer.js-footer')
var wrapper =  document.getElementById("wrapper");

  menuMobile.style.display = "none";
  headerMobile.classList.remove("is-open")
  footer.style.display = "block"
  wrapper.style.display = "block";
}

// var modal = document.getElementById("modalLanguage");

// Get the button that opens the modal
// var btn = document.getElementById("button_modal_language");

// Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
 
// }

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//     wrapper.style.display = "block";
//   }
// }


// const dropdownBrands = document.querySelector('li .dropbtn');
// // const dropdownBrandsCaret = document.querySelector('li.dropdown i');
// const dropdownContent = document.querySelector('ul.dropdown-content');

// dropdownBrands.addEventListener('click', (e) => {
//   e.stopPropagation();
//   toggleDropdown();
// });

// // Add event listener to close dropdown on clicks outside
// document.addEventListener('click', (e) => {
//   const isClickInsideDropdown = dropdownBrands.contains(e.target) || dropdownContent.contains(e.target);

//   if (!isClickInsideDropdown) {
//     closeDropdown();
//   }
// });

// function toggleDropdown() {
//   if (!dropdownContent.style.display || dropdownContent.style.display === "none") {
//     dropdownContent.style.display = "flex";
//     dropdownContent.style.flexWrap = "wrap";
//   } else {
//     closeDropdown();
//   }
// }

// function closeDropdown() {
//   dropdownContent.style.display = "none";
// }


// mobile

const contentBrands = document.querySelector('.content_brands');
const btnBrandsMobile = document.querySelector('.btn-brandsMobile')

btnBrandsMobile.addEventListener('click', () => {
  btnBrandsMobile.classList.toggle('activeBtnBrands')
  contentBrands.classList.toggle("showBrands")
})



</script>

<style>
/* main menu */
.mainmenuDesktop {
  display: flex;
  justify-content: end;
  align-items: center;
  margin-bottom: 0;
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
}
.mainmenuDesktop li{
  /* max-width: 100px; */
  display: flex;
  align-content: center;
}

.mainmenuDesktop li:not(.brand-li) {
  width: 100%;  
}

.mainmenuDesktop a {
  background: #142c46;
  color: white !important;
  padding: 16px;
  font-size: 1.2rem;
  border: none;
  width: 100%;
  /* max-width: 100px; */
  display: flex;
  justify-content: center;
  transition: 0.3s;
  text-transform: uppercase;
}

/* .mainmenuDesktop .activeLinkDesk a{
  background-color: #091b2f !important;
  color: #fff !important;
} */

/* drppdown inicio */

.dropbtn {
  background: #142c46;
  color: white;
  padding: 16px;
  font-size: 1.2rem;
  font-weight: 600;
  border: none;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  transition: 0.3s;
}

.dropdown {
  position: relative;
  display: inline-block !important;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  background: var(--euromus-color-400);
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  width: 100vw;
  left: -40vw;
  transition: all 1s;
  padding: 2rem 0;
}
.dropdown:hover .dropbtn {
  background: #142c46e3;
  color: #fff;
}

.dropdown .dropdown-content {
  display: none;
}

.dropdown:hover .dropdown-content {
  display: flex !important;
  min-height: fit-content;
  flex-wrap: wrap;
  /* padding: 2rem 0; */
  /* justify-content: space-evenly; */
}

.dropdown-content li {
  color: #103054 !important;
  background: transparent !important;
  height: fit-content;
  text-decoration: none;
  display: flex;
  max-width: none!important;
  cursor: auto;
}

.dropdown-content li a{
  background: transparent;
  width: fit-content;
  color: var(--euromus-color-200) !important;
  max-width: none !important;
  text-transform: uppercase;
  padding: 5px;
  font-size: 1em;
  font-weight: 500;
}

.dropdown-content li a:hover{
  color: var(--euromus-color-300) !important;
  background: transparent !important;
}

/* Show the dropdown menu on hover */
/* .dropdown:hover .dropdown-content {
  display: block;
} */


/* drppdown fim */


.modalLanguage {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin:auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
  top: 50%;
  transform: translateY(-50%);
}

.modal-content a {
  font-size: 1.1rem;
  width: 100%;
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 36px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}


/* teste */

.header-logo .logo {
  max-width: 240px !important;
}

.header-nav #_desktop_contact_link #contact-link{
  margin-top: 0 !important;
}
.header-nav .right-nav .language-selector{
  margin-top: 0 !important;
}

.header-nav .right-nav {
  align-items: unset;
  gap: 2rem;
  /* margin-top: 1rem; */
  align-items: center !important;
}
.header-nav .right-nav .links ul{
  margin-bottom: 0;
}

.header-nav .right-nav .links .h3{
  display: none;
}


.header-top {
  padding: 0 !important;
  /* max-height: 117px; */

}
.header-top-right {
  display: flex !important;
  justify-content: center;
}

.header-top .container{
  max-width: 1440px;
  width: 100%;
}

.header-nav .container{
  max-width: 1440px;
  width: 100%;
}

.header-nav #menu-icon i{
  font-size: 1.85rem;
}
.header-nav #_mobile_cart .search{
  font-size: 1.85rem;
}
.header-nav #_mobile_cart .shopping-cart{
  font-size: 1.85rem;
}

.btn-header{
  width: 180px !important;
  height: 55px;
  color: #103054;
  text-align: center;
  padding: 0.5em 0.3em;
  display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  

}
.btn-header:hover{
  width: 180px !important;
  color: #fff !important;
  background: #103054;
}

.btn-header h5 {
  font-size: 1.15em;
  width: 180px !important;
  margin-bottom: 0;
  color: #103054;
  font-weight: 400;
}
.btn-header small {
  /* width: 180px !important; */
  font-size: 0.85em;
  color: #103054;
  font-weight: 400;
}

.btn-header:hover  h5{
  color: #fff;
}
.btn-header:hover  small{
  color: #fff;
}
</style>