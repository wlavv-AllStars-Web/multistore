{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 {extends file='layouts/layout-error.tpl'}

 {block name='content'}
 
   {* <section id="main">
 
     {block name='page_header_container'}
       <header class="page-header">
         {block name='page_header_logo'}
         <div class="logo"><img src="{$shop.logo}" alt="logo" loading="lazy"></div>
         {/block}
 
         {block name='hook_maintenance'}
           {$HOOK_MAINTENANCE nofilter}
         {/block}
 
         {block name='page_header'}
           <h1>{block name='page_title'}{l s='We\'ll be back soon.' d='Shop.Theme.Global'}{/block}</h1>
         {/block}
       </header>
     {/block}
 
     {block name='page_content_container'}
       <section id="content" class="page-content page-maintenance">
         {block name='page_content'}
           {$maintenance_text nofilter}
         {/block}
       </section>
     {/block}
 
     {block name='page_footer_container'}
 
     {/block}
 
   </section> *}
  <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet">
    
  <main>
      <div class="masthead" style="padding: 0 50px;text-align: center;">
          <div class="masthead-content text-white">
              <div class="container-fluid px-lg-0 px-md-3 px-sm-12 px-xs-12">
                  <img src="/img/eurorider/logo_horizontal.png" style="max-width: 15rem;margin: 50px 0;">
                  <h1 class="fst-italic lh-1 mb-4 text-class">Our Website is Coming Soon</h1>
                  <p class="mb-5 text-class"> We're working hard to finish the development of this website.</p>
                  <h3 class="text-class" style="padding: 20px 0px;">Stay Tuned</h3>
                  <p class="mb-5 text-class"> Our team is building the final touches on something very special, and we can't wait to share it with you. </p>
              </div>
          </div>
      </div>
  </main>

    {* <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> *}

    <style>
        body::before { background-color: #000; opacity: 0; }
        body {
          margin: 0;
          font-family: "Tinos", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
          font-weight: 700;
        }
        
        @media only screen and (max-width : 899px) { 
            body{ background-color: #000; } 
            .masthead .masthead-content { padding-top: 1rem; }
        }

        main {
          min-height: 98dvh;
        }

        .masthead {
          position: relative;
          overflow: hidden;
          z-index: 2;
          display: flex;
          align-items: center;
          justify-content: center;
          min-height: 100dvh !important;
          color: #fff;
          padding: 0 !important;
        }
        
        .masthead::before {
          content: "";
          position: absolute;
          top: 0;
          bottom: 0;
          right: 0;
          left: 0;
          height: 100%;
          width: 100%;
          background-color: rgba(0, 0, 0, 0.95);
          z-index: -1;
        }

        .text-class {
          max-width: 450px;
        }

        .masthead h1 {
          font-size: 3.5rem !important;
          line-height: 3.5rem;
          font-style: italic;
          margin-top: 0;
        }
        .masthead h3 {
          font-size: 1.75rem !important;
        }
        .masthead p {
          font-family: DM Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
          font-size: 1.3rem !important;
          font-weight: 400;
        }

        @media (min-width: 992px) {
          .masthead::before {
            transform: skewX(-9deg);
            transform-origin: top right;
          }
          .masthead {
            height: 100%;
            width: 75vw;
            min-height: 0;
            padding-bottom: 0;
          }
        }

        @media (min-width: 1200px) {
          .masthead {
            width: 65vw;
          }
        }

        @media only screen and (min-width : 900px) { body{ background: url('/img/eurorider/2.jpg');background-position: right;background-repeat: no-repeat;background-size: contain;background-color: #000; } }
        
    </style>
 
 {/block}
 