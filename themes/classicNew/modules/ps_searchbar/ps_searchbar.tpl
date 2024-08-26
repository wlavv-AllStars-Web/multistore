{**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 <style>
 @media (min-width: 767px){
 .bigscreen {
      max-width: 100vw !important; 
      width: 100%;
      
 }
}

@media (max-width: 767px){
  .smallscreen{
    max-width: 100vw !important; 
    width:95vw; 
    border-radius: 25px;   
  }
  .whitebg{
    background-color: white;
  }
}
 </style>
  <div id="search_widget" class="search-widgets bigscreen smallscreen" data-search-controller-url="{$search_controller_url}">
    <form method="get" action="{$search_controller_url}">
      <input type="hidden" name="controller" value="search">
      <i class="material-icons search" aria-hidden="true">search</i>
      <input type="text" name="s" value="{$search_string}" style="{if $search_string != null}background:#fff;{/if}" class="whitebg searchbarInput"
        placeholder="{l s='Search our catalog' d='Shop.Theme.Catalog'}"
        aria-label="{l s='Search' d='Shop.Theme.Catalog'}">
      {* <i class="material-icons clear" aria-hidden="true">clear</i> *}
    </form>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    if(window.screen.width > 580) {
      const inputSearch = document.querySelector(".header-top-right-desktop #search_widget .searchbarInput");
      const iconSearch = document.querySelector(".header-top-right-desktop #search_widget .search")
      inputSearch.style.border = "1px solid #103054"
      // const log = document.getElementById("log");

    inputSearch.addEventListener("input", updateValue);
    function updateValue(e) {
      inputSearch.setAttribute("value", e.target.value);
      if(inputSearch.value.length != 0) {
        iconSearch.style.background = "#103054";
        iconSearch.style.cursor = "pointer";
        iconSearch.style.color = "#fff";
        inputSearch.style.borderColor = "#103054";
      }else {
        iconSearch.style.background = "none"
        iconSearch.style.color = "#103054";
        inputSearch.style.borderColor = "#ee302e";
      }
    }

    iconSearch.addEventListener("click", () => {
        document.querySelector('.header-top-right-desktop #search_widget form').submit();
    })



  } else {
    const inputSearch = document.querySelector(".header-top-right #search_widget .searchbarInput");
    const iconSearch = document.querySelector(".header-top-right #search_widget .search")
    inputSearch.style.border = "1px solid #103054"
    // const inputSearch = document.querySelector("#_mobile_cart .searchbarInput");
    // const iconSearch = document.querySelector(".header-nav .mobile #_mobile_cart .search")
    //     if(iconSearch && inputSearch) {
    //       iconSearch.addEventListener('click', () => {
    //         console.log("deu")
    //           document.querySelector('.header-top .header-top-right #search_widget form').submit();
    //         })
    //     }
    inputSearch.addEventListener("input", updateValue);
    function updateValue(e) {
      inputSearch.setAttribute("value", e.target.value);
      if(inputSearch.value.length != 0) {
        iconSearch.style.background = "#103054";
        iconSearch.style.cursor = "pointer";
        iconSearch.style.color = "#fff";
        inputSearch.style.borderColor = "#ee302e";
      }else {
        iconSearch.style.background = "none"
        iconSearch.style.color = "#103054";
        inputSearch.style.borderColor = "#ee302e";
      }
    }

    iconSearch.addEventListener("click", () => {
        document.querySelector('.header-top-right #search_widget form').submit();
    })
   
  }

  })
  


  </script>

  <style>
  .header-top-right #search_widget {
  margin: auto;
  margin-right: 1rem;
}

.header-top-right #search_widget form input.ui-autocomplete-input{
  border-color: #2d405f90;
    color: #2d405f;
    border: 1px solid #768397;
}
.header-top-right #search_widget form i{
  right: 0;
    overflow: clip;
    height: 100%;
    width: fit-content;
    background: #768397;
    color: #fff;
    border-radius: 0 5px 5px 0;
}
#search_widget {
  /* margin: auto;
  margin-right: 1rem; */
}

#search_widget form input.ui-autocomplete-input{
  border-color: #2d405f90;
    color: #2d405f;
    border: 1px solid #768397;
}
#search_widget form i{
  right: 0;
    overflow: clip;
    height: 100%;
    width: fit-content;
    /* background: #768397; */
    color: #2d405f;
    border-radius: 0 5px 5px 0;
}

#search_widget form input {
  padding: 10px 20px 10px 20px;
}

  </style>
