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

  #pagenotfound .page-content.page-not-found{
    background: url('/img/asd/Content_pages/error/error_{$language.iso_code}.webp') !important;
    width: 600px !important;
    height: 400px;
    position: relative;
    display: flex;
    align-items: end;
    padding: 0 !important;
    margin-bottom: 0 !important;
    max-width: unset !important;
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

  #search .page-content.page-not-found{
    background: url('/img/asd/Content_pages/error/error_{$language.iso_code}.webp') !important;
    width: 600px !important;
    height: 400px;
    position: relative;
    display: flex;
    align-items: end;
    padding: 0 !important;
    margin-bottom: 0 !important;
    max-width: unset !important;
    justify-content: end;
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
