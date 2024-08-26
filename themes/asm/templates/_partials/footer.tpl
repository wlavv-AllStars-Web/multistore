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
 <div class="hidden-md-up" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;background:#fff;"></div>
<div class="container">
<div id="scrollToTopBtn" onclick="scrollToTop()" >
            <i class="fa-solid fa-arrow-up"></i>
    </div>
  <div class="row" style="display: none;">
    {block name='hook_footer_before'}
      {hook h='displayFooterBefore'}
    {/block}
  </div>
</div>
<div class="footer-container">
  {* <div class="helpFooter ">
    <h3>{l s='Need assistance?' d='Shop.Theme.Global'}</h3>
    <p>{l s='Contact us' d='Shop.Theme.Global'}&#160;<strong>{l s='by phone' d='Shop.Theme.Global'}&#160;</strong>{l s='at' d='Shop.Theme.Global'}&#160;<strong>+39 049 8597636</strong>&#160;{l s='or via' d='Shop.Theme.Global'} <strong class="whatsappStrong">Whatsapp</strong>&#160;{l s='always at the same number. We are available Monday through Friday, 8:30 am to 1 pm and 2:30 pm to 7 pm GMT+1' d='Shop.Theme.Global'}</p>
    <div class="phone">
    <i class="fa-solid fa-phone"></i>
      049 8597636
    </div>
  </div> *}
  <div class="lines">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>
  <div class="container-md container-fluid">
    <div class="row footer-row">
      {block name='hook_footer'}
        {hook h='displayFooter'}
      {/block}
      <div class="socials hidden-md-down">
        <a aria-label="Facebook" id="footer_facebook" class="social-icon" style="margin-right: 5px;" href="https://www.facebook.com/allstarsmotorsport" target="_NEW">
          <i class="fa-brands fa-square-facebook"></i>
        </a>
        <a aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://instagram.com/allstarsmotorsport" target="_NEW">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW">
          <i class="fa-brands fa-flickr"></i>
        </a>
        <a aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/allstarsmotorsport" target="_NEW">
          <i class="fa-brands fa-youtube"></i>
        </a>
      </div>
    </div>
    <div class="row">
      {block name='hook_footer_after'}
        {hook h='displayFooterAfter'}
      {/block}
    </div>
    <div class="row">
      <div class="col-md-12 socialsMobile">
      <a aria-label="Facebook" id="footer_facebook" class="social-icon" style="margin-right: 5px;" href="https://www.facebook.com/allstarsmotorsport" target="_NEW">
        <i class="fa-brands fa-square-facebook"></i>
      </a>
      <a aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://instagram.com/allstarsmotorsport" target="_NEW">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW">
        <i class="fa-brands fa-flickr"></i>
      </a>
      <a aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/allstarsmotorsport" target="_NEW">
        <i class="fa-brands fa-youtube"></i>
      </a>
      </div>
      <div class="col-md-12 copyrights">
        <p class="text-sm-center">
          {block name='copyright_link'}
            <a href="/" target="_blank" rel="noopener noreferrer nofollow" style="color: #fff;text-decoration:underline;text-decoration-color:#ee302e">
              {l s='%copyright% %year% - Euro Muscle Parts' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
            </a>
            <p style="color: #fff;">{l s='All Rights Reserved' d='Shop.Theme.Global'}</p>
          {/block}
        </p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("scroll", (event) => {
  const buttonTop = document.querySelector('#scrollToTopBtn')
  const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
  if(currentScroll > 0){
    buttonTop.style.display = "flex";
  } else {
    buttonTop.style.display = "none";
  }
})

function scrollToTop() {
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });
    }

  window.addEventListener('load', () => {
  const footer = document.querySelector('#footer.js-footer');
  const menuMobile = document.querySelector('#mobile_top_menu_wrapper');
  
  if(menuMobile.style.display === "none"){
    footer.style.display = "block"
  
  } else {
    footer.style.display = "none"

  }
})





</script>