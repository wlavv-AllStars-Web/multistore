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

{assign var="currentUrl" value=Tools::getCurrentUrl()}
{assign var="manufacturers" value=Manufacturer::getManufacturers()}

{block name='header_banner'}
  <div class="header-banner">
    {hook h='displayBanner'}
  </div>
{/block}

{block name='header_nav'}
  
  <nav class="header-nav" style="border-bottom: none;">

    <div class="container">
      <div class="row">
        <div class="hidden-sm-down">
          <div class="col-md-6 col-xs-12" style="display: flex;align-items:center;height:57px;gap:2rem;justify-content:end;width:100%;padding-right: 8rem;">
          {hook h='displayNav2'}
          </div>
          <div class="col-md-6 right-nav">
          

          {hook h='displayNav1'}
                
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
          <div class="float-xs-left" id="menu-icon">
            <i class="material-icons d-inline">&#xE5D2;</i>
          </div>
          <div class="float-xs-right" id="_mobile_cart"></div>
          <div class="top-logo" id="_mobile_logo"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </nav>
{/block}

{block name='header_top'}
  <div class="header-top">
    <div class="container">
       <div class="row" style="position: relative;z-index:1;width:100%;">
        <div class="col-md-1 hidden-sm-down" id="_desktop_logo" style="display: flex;justify-content:flex-start;">
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
        <div class="header-top-right col-md-9 col-sm-12 position-static mobile-search">
          {hook h='displayTop'}
        </div>

        <div class="col-md-10 header-top-right-desktop">
        {hook h='displayNav1'}
        <div class="shipped-eu">
          <a href="{$linkShipping}"><img src="/img/eurmuscle/topHeader/europe-rounded-02.svg
          " alt="shipped from europe"/><div style="display: flex;flex-direction:column;">{l s='SHIPPED' d='Shop.Theme.Global'}<small style="white-space: nowrap;">{l s='FROM EUROPE' d='Shop.Theme.Global'}</small></a></div>
        </div>
        
        {hook h='displayNav2'}
        <div class="payment-plans">
          <a href="{$linkPayment}"><img src="/img/eurmuscle/topHeader/payment-01.svg" alt="payment-plans"/><div style="display: flex;flex-direction:column;">{l s='PAYMENT' d='Shop.Theme.Global'}<small style="white-space: nowrap;">{l s='PLANS' d='Shop.Theme.Global'}</small></a></div>
        </div>
        </div>
        </div>
        
      
      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
      {* <pre>{print_r($manufacturers,1)}</pre> *}
        <div class="js-top-menu mobile" id="_mobile_top_menu" onclick="closeMenu()">
        <img src="http://euromus.local/img/logo-17047994381.jpg" style="width: 26vw; margin-right:auto; margin-left:1rem;">
        <i class="fa fa-times"></i>
          <div>Close</div>
        </div>
        <div class="js-top-menu-bottom mobile-menu-open">
          <div id="_mobile_currency_selector"></div>
          {* <div style="border-top:0.5rem solid #103054;border-bottom:0.5rem solid #ee302e;padding-block:0.25rem;background:#fff;height: 0.5rem;width:100%;z-index:-1;transform:rotate(180deg)"></div> *}

          <div id="_mobile_login" class="{if $currentUrl === "http://euromus.local/en/login?back=my-account"}activeLink{/if}"><a href="{$linkMyaccount}"><i class="fa-solid fa-user"></i>{l s='Login' d='Shop.Theme.Global'}</a></div>
          <div id="homeLinkMobile" class="{if $currentUrl === $link->getPageLink('index', true)}activeLink{/if}"><a href="/"><i class="fa-solid fa-house"></i>{l s='Home' d='Shop.Theme.Global'}</a></div>
          <div id="NewsLinkMobile" class="{if $currentUrl === $link->getPageLink('new-products', true)}activeLink{/if}"><a href="{$link->getPageLink('new-products', true)}"><i class="fa-solid fa-newspaper"></i>{l s='News' d='Shop.Theme.Global'}</a></div>
          <div id="_mobile_contact_link" class="{if $currentUrl === $link->getPageLink('contact', true)}activeLink{/if}"><a href="{$link->getPageLink('contact', true)}"><i class="fa-solid fa-phone"></i>{l s='Contacts' d='Shop.Theme.Global'}</a></div>
          <div id="_mobile_shipping_link" class="{if $currentUrl === $linkShipping}activeLink{/if}"><a href="{$linkShipping}"><i class="fa-solid fa-truck-fast"></i>{l s='Shipping' d='Shop.Theme.Global'}</a></div>
          <div id="_mobile_payment_link" class="{if $currentUrl === $linkPayment}activeLink{/if}"><a href="{$linkPayment}"><i class="fa-solid fa-credit-card"></i>{l s='Payment' d='Shop.Theme.Global'}</a></div>
          
          <div id="button_modal_language"><img src="/img/flags/{$language.iso_code}.jpg" /><p>{l s='Change Language' d='Shop.Theme.Global'}</p></div>
          <div id="brands_mobile">
            <div class="btn-brandsMobile"><i class="fa-solid fa-list"></i>{l s='Brands' d='Shop.Theme.Global'}<i class="fa-solid fa-caret-down"></i></div>
            <ul class="content_brands">
            {foreach from=$manufacturers item=$manufacturer }
              <li class="col-lg-3">
              <a href="/{$currentLanguage->iso_code }/{l s='brand' d='Shop.Theme.Global'}/{$manufacturer.id_manufacturer}-{$manufacturer.link_rewrite}">
              <img src="/img/tmp/manufacturer_mini_{$manufacturer.id_manufacturer}.jpg" width="100%" style="max-width: 100px;" />
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
    <div style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;background:#fff;position:absolute;width:100%;z-index:-1;"></div>
    <ul class="mainmenuDesktop">
        <li class="{if $currentUrl === $link->getPageLink('index', true)}activeLinkDesk{/if}" ><a href="{$link->getPageLink('index', true)}">Home</a></li>
        <li class="{if $currentUrl === $link->getPageLink('new-products', true)}activeLinkDesk{/if}" ><a href="{$link->getPageLink('new-products', true)}">News</a></li>
        <li><a style="background: #ee302e;">Your Car</a></li>
        <li class="dropdown ">
          <div class="dropbtn">{l s='Brands' d='Shop.Theme.Global'}<i class="fa-solid fa-caret-down"></i></div>
          <ul class="dropdown-content">
        
          {foreach from=$manufacturers item=$manufacturer }
            <li class="col-lg-3">
            <a href="/{$currentLanguage->iso_code }/{l s='brand' d='Shop.Theme.Global'}/{$manufacturer.id_manufacturer}-{$manufacturer.link_rewrite}">
              {$manufacturer.name}
            </a>
            </li>
          {/foreach}
  
            <div style="border-top:2px solid #103054;border-bottom:2px solid #ee302e;padding-block:1px;width: 100%;
            height: 2px;
            position: absolute;
            bottom: 0;"></div>
          </ul>
        </li>
        <li class="{if $currentUrl === $link->getPageLink('contact', true)}activeLinkDesk{/if}" ><a href="{$link->getPageLink('contact', true)}">Contact</a></li>
      </ul>
  </div>


  <div id="modalLanguage" class="modalLanguage">
  <!-- Modal content -->

    <div class="modal-content" style="display: flex;align-items:center;justify-content:space-between;flex-direction: column;position:relative;gap: 0.85rem;">
    {foreach from=$languages item=$language }
      {if $language.id_lang === 2 ||$language.id_lang === 4 ||$language.id_lang === 5 }
      <div style="display: flex;gap:1rem;align-items:center;width:90%;padding:0.5rem;border-radius: 4px;{if $currentLanguage->iso_code === $language.iso_code}background:#ee302e;{/if}">
        <img src="/img/flags/{$language.iso_code}.jpg" width="16" height="11"/>
        {* <div id="_mobile_language_selector"></div> *}
        <a href="/{$language.iso_code}" data-iso="{$language.iso_code}" style="{if $currentLanguage->iso_code === $language.iso_code}color:#fff;{/if}">{$language.name}</a>
        </div>
        {/if}
      {/foreach}
      <span class="close" style="color: #103054;opacity:1;position:absolute;top:1rem;right:1rem;">&times;</span>
    </div>
  </div>  

  {hook h='displayNavFullWidth'}
{/block}

<script>
window.addEventListener('scroll', () => {
  const footer = document.querySelector('footer#footer.js-footer');
  if (footer) {
    footer.style.display = "block"
}
});

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

var modal = document.getElementById("modalLanguage");

// Get the button that opens the modal
var btn = document.getElementById("button_modal_language");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
 
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    wrapper.style.display = "block";
  }
}

window.onload = function() {
  const searchIconMobile = document.querySelector('.header-nav #_mobile_cart .search');
  const searchBarMobile = document.querySelector('.header-top-right #search_widget');

  if (searchIconMobile) {
    searchIconMobile.addEventListener('click', () => {

      if (!searchBarMobile.style.display || searchBarMobile.style.display === "none") {
        searchBarMobile.style.display = "block";
      } else {
        searchBarMobile.style.display = "none";
      }
    });
  }
};

const dropdownBrands = document.querySelector('li .dropbtn');
const dropdownBrandsCaret = document.querySelector('li.dropdown i');
const dropdownContent = document.querySelector('ul.dropdown-content');

dropdownBrands.addEventListener('click', (e) => {
  e.stopPropagation();
  toggleDropdown();
});

// Add event listener to close dropdown on clicks outside
document.addEventListener('click', (e) => {
  const isClickInsideDropdown = dropdownBrands.contains(e.target) || dropdownContent.contains(e.target);

  if (!isClickInsideDropdown) {
    closeDropdown();
  }
});

function toggleDropdown() {
  if (!dropdownContent.style.display || dropdownContent.style.display === "none") {
    dropdownContent.style.display = "flex";
    dropdownContent.style.flexWrap = "wrap";
    dropdownBrandsCaret.style.transform = "rotate(0deg)";
  } else {
    closeDropdown();
  }
}

function closeDropdown() {
  dropdownContent.style.display = "none";
  dropdownBrandsCaret.style.transform = "rotate(-90deg)";
}


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
  width: 100%;
  /* max-width: 100px; */
  display: flex;
  align-content: center;
}

.mainmenuDesktop a {
  background: #103054;
  color: white !important;
  padding: 16px;
  font-size: 16px;
  border: none;
  width: 100%;
  /* max-width: 100px; */
  display: flex;
  justify-content: center;
  transition: 0.3s;
}

.mainmenuDesktop .activeLinkDesk a{
  background-color: #fff !important;
  color: #103054 !important;
}

/* drppdown inicio */

.dropbtn {
  background: #103054;
  color: white;
  padding: 16px;
  font-size: 16px;
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
  background: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  width: 100vw;
  left: -60vw;
  transition: all 1s;
}
.dropdown:hover .dropbtn {
  background: #fff;
  color: #103054;
}

.dropdown:hover .dropdown-content {
  display: flex ;
  min-height: fit-content;
  flex-wrap: wrap;
  /* justify-content: space-evenly; */
}

.dropdown-content li {
  color: #103054 !important;
  background: transparent !important;
  height: fit-content;
  text-decoration: none;
  display: flex;
  max-width: none!important;
  width: 25%;
  cursor: auto;
}

.dropdown-content li a{
  background: transparent;
  width: fit-content;
  /* color: #103054 !important; */
  color: #0b223b !important;
  max-width: none !important;
  text-transform: uppercase;
}
.dropdown-content li a:hover{
  color: #ee302e !important;
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
  z-index: 99; /* Sit on top */
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