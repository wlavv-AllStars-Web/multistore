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

{include file='_partials/helpers.tpl'}

<!doctype html>
<html lang="{$language.locale}">

  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>

  <body id="{$page.page_name}" class="{$page.body_classes|classnames}" style="height: auto;">

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PSF3LZPP"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    

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

      <section id="wrapper"  style="display: flex;flex-direction:column;">


        {hook h="displayWrapperTop"}
        {block name='breadcrumb'}
          {include file='_partials/breadcrumb.tpl'}
        {/block}

        {block name='notifications'}
          {include file='_partials/notifications.tpl'}
        {/block}


        <div class="container-fluid container-{$page.page_name}">
          
        {if $page.page_name === "contact"}
          <div class="banner_contact" style="position: relative;">
            <img class="contact_Banner" src="/img/eurmuscle/cmsBanners/Banners-contact.webp" alt="Contact Banner"/>
            <h2 class="" style="position: absolute;bottom:1rem;color: #fff;">{l s="CONTACTS" d="Shop.Theme.Cms"}</h2>
          </div>
          <script>
            document.addEventListener("DOMContentLoaded", (event) => {
              const screenSize = screen.width;
              const banner_contact = document.querySelector(".banner_contact");
              const img_banner_contact = document.querySelector(".contact_Banner");

              const wrapper = document.getElementById("wrapper")

              if(screenSize > 390){
                banner_contact.classList.remove("banner_contact_mobile");
                banner_contact.classList.add("banner_contact_desk");
                wrapper.classList.add("wrapper_desktop");
                img_banner_contact.setAttribute("src", "/img/eurmuscle/cmsBanners/Banners-contact.webp")

              }else{
                banner_contact.classList.remove("banner_contact_desk");
                banner_contact.classList.add("banner_contact_mobile");
                wrapper.classList.add("wrapper_mobile");
                img_banner_contact.setAttribute("src", "/img/eurmuscle/cmsBanners/Banners-contactMobile.webp")
              }
            });
            </script>
        {/if}

          <div class="">
            {block name="left_column"}
              <div id="left-column" class="col-xs-12 col-md-4 col-lg-3">
                {if $page.page_name == 'product'}
                  {hook h='displayLeftColumnProduct' product=$product category=$category}
                {else}
                  {hook h="displayLeftColumn"}
                {/if}
              </div>
            {/block}

            {block name="content_wrapper"}
              <div id="content-wrapper" class="js-content-wrapper left-column right-column col-md-4 col-lg-3">
                {hook h="displayContentWrapperTop"}
                {block name="content"}
                  <p>Hello world! This is HTML5 Boilerplate.</p>
                {/block}
                {hook h="displayContentWrapperBottom"}
              </div>
            {/block}

            {block name="right_column"}
              <div id="right-column" class="col-xs-12 col-md-4 col-lg-3">
                {if $page.page_name == 'product'}
                  {hook h='displayRightColumnProduct'}
                {else}
                  {hook h="displayRightColumn"}
                {/if}
              </div>
            {/block}
          </div>
        </div>
        {hook h="displayWrapperBottom"}
      </section>

      <footer id="footer" class="js-footer">
        {block name="footer"}
          {include file="_partials/footer.tpl"}
        {/block}
      </footer>

    </main>

    {block name='javascript_bottom'}
      {include file="_partials/password-policy-template.tpl"}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {block name='hook_before_body_closing_tag'}
      {hook h='displayBeforeBodyClosingTag'}
    {/block}
  </body>

</html>
