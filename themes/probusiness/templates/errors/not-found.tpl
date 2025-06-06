{*
* 2007-2022 ETS-Soft
*
* NOTICE OF LICENSE
*
* This file is not open source! Each license that you purchased is only available for 1 wesite only.
* If you want to use this file on more websites (or projects), you need to purchase additional licenses. 
* You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
* 
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs, please contact us for extra customization service at an affordable price
*
*  @author ETS-Soft <etssoft.jsc@gmail.com>
*  @copyright  2007-2022 ETS-Soft
*  @license    Valid for 1 website (or project) for each purchase of license
*  International Registered Trademark & Property of ETS-Soft
*}
<section id="content" class="page-content page-not-found">
{* <img src="/img/asd/Content_pages/error/errorM_en.webp" class="errorMobile"  style="width:100%;"/>
<img src="/img/asd/Content_pages/error/error_en.webp" class="errorDesktop"  style="width:100%;"/> *}
  {block name='page_content'}

      {* <h4>{l s='Sorry for the inconvenience.' d='Shop.Theme.Actions'}</h4>
      <p>{l s='Search again what you are looking for' d='Shop.Theme.Actions'}</p> *}

      {block name='search'}
        {hook h='displaySearch'}
      {/block}

      {block name='hook_not_found'}
        {hook h='displayNotFound'}
      {/block}

  {/block}
</section>

<style>

  #pagenotfound #wrapper {
    display: flex;
    align-items: center;
  }



  #pagenotfound .page-content #search_widget{
    position: absolute;
    margin: 0;
    padding: 1rem;
  }

  #pagenotfound .page-content #search_widget form input{
    background: #fff;
    color: #1d3558;
    box-shadow: 2px 2px 11px 0 rgba(0,0,0,.4);
  }

  #pagenotfound .page-content #search_widget form input::placeholder{
    color: #1d3558;
    opacity: 0.8;
  }

  #pagenotfound .page-content #search_widget form input:focus-visible{
    outline: none;
  }

  #pagenotfound .page-content #search_widget form button{
    color: #1d3558;
  }

  #search #wrapper {
    display: flex;
    align-items: center;
  }

  @media screen and (min-width:769px){
    #pagenotfound .page-content.page-not-found{
      background: url('/img/asd/Content_pages/error/error_{$language.iso_code}.webp') !important;
      width: 600px !important;
      height: 400px;
      min-height: 400px;
      padding: 0;
      position: relative;
    }

    #search .page-content.page-not-found{
      background: url('/img/asd/Content_pages/error/error_{$language.iso_code}.webp') !important;
      width: 600px !important;
      height: 400px;
      min-height: 400px;
      padding: 0;
      position: relative;
    }

    #pagenotfound .page-content.page-not-found #search_widget{
      position: absolute;
      bottom: 1rem;
    }
    #search .page-content.page-not-found #search_widget{
      position: absolute;
      bottom: 1rem;
    }
    #pagenotfound .page-content.page-not-found .errorDesktop{
      display: block;
    }
    #search .page-content.page-not-found .errorMobile{
      display: none;
    }
  }



  @media screen and (max-width:768px){

  .header-top .search-widget form input[type="text"]{
    background-color: #fff !important;
    border: 1px solid #d4d4d4 !important;
  }

  .header-top .search-widget form i{
    border-radius: 0 !important;
  }

    #search #wrapper {
      min-height: 60dvh;
    }
    #pagenotfound #wrapper {
      min-height: 60dvh;
    }
    #pagenotfound #content-wrapper .page-footer{
      margin-bottom: 0 !important;
    }

    #pagenotfound #main .page-content{
      margin-bottom: 0 !important;
    }

    #pagenotfound .page-content.page-not-found{
      background: url('/img/asd/Content_pages/error/errorM_{$language.iso_code}.webp') !important;
      height: 60dvh;
      background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
      padding: 0;
      position: relative;
      width: 100vw !important;
    }
    #search .page-content.page-not-found{
      background: url('/img/asd/Content_pages/error/errorM_{$language.iso_code}.webp') !important;
      height: 60dvh;
      background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
      padding: 0;
      position: relative;
    }

    /* #pagenotfound .page-content.page-not-found .errorDesktop{
      display: none;
    }
    #pagenotfound .page-content.page-not-found .errorMobile{
      display: block;
    }
    #search .page-content.page-not-found .errorDesktop{
      display: none;
    }
    #search .page-content.page-not-found .errorMobile{
      display: block;
    }

    #pagenotfound .container-fluid{
      width: 100%;
    }
    #search .container-fluid{
      width: 100%;
    }

    #search footer{
      float: unset;
    }

    #search #wrapper{
      height: auto;
    } */

    #pagenotfound .page-content.page-not-found #search_widget{
      position: absolute;
      margin: 0;
      padding: 1rem;
      bottom: 1rem;
      max-width: 350px;
      transform: translateX(-50%);
      left: 50%;
    }

    #search .page-content.page-not-found #search_widget{
      position: absolute;
      margin: 0;
      padding: 1rem;
      bottom: 1rem;
      max-width: 350px;
      transform: translateX(-50%);
      left: 50%;
    }


    #pagenotfound .page-content.page-not-found #search_widget .search_block_top_fixed {
      border-radius: 0;
    }
    #pagenotfound .page-content.page-not-found #search_widget form i {
      border-radius: 0;
    }
    #search .page-content.page-not-found #search_widget .search_block_top_fixed {
      border-radius: 0;
    }
    #search .page-content.page-not-found #search_widget form i {
      border-radius: 0;
    }
  
  }


  #search .page-content #search_widget{
    position: absolute;
    margin: 0;
    padding: 1rem;
  }

  #search .page-content #search_widget form input{
    background: #fff;
    color: #1d3558;
    box-shadow: 2px 2px 11px 0 rgba(0,0,0,.4);
  }

  #search .page-content #search_widget form input::placeholder{
    color: #1d3558;
    opacity: 0.8;
  }

  #search .page-content #search_widget form input:focus-visible{
    outline: none;
  }

  #search .page-content #search_widget form button{
    color: #1d3558;
  }

</style>
