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
<!doctype html>
<html lang="{$language.iso_code|escape:'html':'UTF-8'}">

<head>
  {block name='head'}
    {include file='_partials/head.tpl'}
  {/block}

</head>


<body id="{$page.page_name|escape:'html':'UTF-8'}"
  class="{$page.body_classes|classnames} {if isset($YBC_TC_CLASSES)}{$YBC_TC_CLASSES|escape:'html':'UTF-8'}{/if}">
  <style>
    #cms>main {
      min-height: 100%;
    }

    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
  {block name='hook_after_body_opening_tag'}
    {hook h='displayAfterBodyOpeningTag'}
  {/block}

  <main>
    {block name='product_activation'}
      {include file='catalog/_partials/product-activation.tpl'}
    {/block}

    <header id="header">
      {block name='header'}
        {include file='_partials/header.tpl'}
      {/block}
    </header>

    {block name='notifications'}
      {include file='_partials/notifications.tpl'}
    {/block}

    <div id="wrapper">
      <div class="container-fluid">

        {block name='breadcrumb'}
          {include file='_partials/breadcrumb.tpl'}
        {/block}

        {block name="left_column"}
          <div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
            {if $page.page_name == 'product'}
              {hook h='displayLeftColumnProduct'}
            {else}
              {hook h="displayLeftColumn"}
            {/if}
          </div>
        {/block}

        {block name="content_wrapper"}
          <div id="content-wrapper" class="left-column has_left_right_col right-column col-sm-4 col-md-6">
            {block name="content"}
              <p>Hello world! This is HTML5 Boilerplate.</p>
            {/block}
          </div>
        {/block}

        {block name="right_column"}
          <div id="right-column" class="col-xs-12 col-sm-4 col-md-3">
            {if $page.page_name == 'product'}
              {hook h='displayRightColumnProduct'}
            {else}
              {hook h="displayRightColumn"}
            {/if}
          </div>
        {/block}
      </div>
    </div>

    <footer style="background-color:#333333; padding-top:0; color: white;" id="footer">
      {block name="footer"}
        {include file="_partials/footer.tpl"}
      {/block}
    </footer>

  </main>


  {block name='javascript_bottom'}
    {* <script type="text/javascript" src="/themes/probusiness/assets/js/distribution.js" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer" async></script> *}
    {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
  {/block}

  {block name='hook_before_body_closing_tag'}
    {hook h='displayBeforeBodyClosingTag'}
  {/block}
</body>

</html>