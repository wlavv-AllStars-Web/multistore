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
{extends file='page.tpl'}

{* {block name='page_title'} *}
  {* {$cms.meta_title} *}
{* {/block} *}

{block name='page_content_container'}
  <section id="content" class="page-content page-cms page-cms-{$cms.id}" style="min-height: 50dvh;">
    {* <pre>{print_r($cms,1)}</pre> *}

    {if $cms.id === 30}
      {if $language.iso_code == 'es'}
          {assign var="youtube_availability" value="p3mWoXq0Sh0"}
          {assign var="youtube_compat" value="1I7oxKWNk10"}
          {assign var="youtube_shipping" value="zE2_e39Tdm8"}
          {assign var="youtube_newsletter" value="YCXbyjBRkzI"}
          {assign var="youtube_contact" value="Bv5Y-11vqmE"}
      {elseif $language.iso_code == 'fr'}
          {assign var="youtube_availability" value="Zv8Tw8H8DGA"}
          {assign var="youtube_compat" value="GgQvaNMYrrQ"}
          {assign var="youtube_shipping" value="yWln2uJ52iU"}
          {assign var="youtube_newsletter" value="f1TCe1q-emA"}
          {assign var="youtube_contact" value="l1xwWMCqWF0"}
      {else}
          {assign var="youtube_availability" value="3shE5Ki8ZzM"}
          {assign var="youtube_compat" value="N06Rv015on4"}
          {assign var="youtube_shipping" value="UVpWbaECK-0"}
          {assign var="youtube_newsletter" value="ycQJs64knkk"}
          {assign var="youtube_contact" value="n44oNOA8tjQ"}
      {/if}
      <div id="user-help" class="row">
        <div class="user-help-header"><img src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/faqs/faq_{$language.iso_code}.jpg?v=1" alt="faq_{$language.iso_code}.jpg?v=1" /></div>
        <div class="user-help-content">
            <div class="card-user">
                <div class="element-to-click">
                    <a href="https://www.youtube.com/watch?v={$youtube_availability}" class="card-link"> 
                        <img
                            id="image_thumb_tut" src="https://www.allstarsmotorsport.com/img/cms/FAQs/product_availability.jpg"
                            alt="product_availability.jpg" />
                    </a>
                    <div class="play"><img src="https://www.allstarsmotorsport.com/img/youtube_play.png"/></div>
                    <div class="card-description">
                        <h2>{l s='Product availability' d='Shop.Theme.UserHelp'}</h2>
                    </div>
                </div>
                <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$youtube_availability}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="card-user">
                <div class="element-to-click">
                    <a href="https://www.youtube.com/watch?v={$youtube_compat}" class="card-link">
                        <img
                            src="https://www.allstarsmotorsport.com/img/cms/FAQs/product_compatibility.jpg" alt="product_compatibility.jpg" />
                    </a>
                    <div class="play"><img src="https://www.allstarsmotorsport.com/img/youtube_play.png"/></div>
                    <div class="card-description">
                        <h2>{l s='Product compatibility' d='Shop.Theme.UserHelp'}</h2>
                    </div>
                </div>
                <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$youtube_compat}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="card-user">
                <div class="element-to-click">
                    <a href="https://www.youtube.com/watch?v={$youtube_shipping}" class="card-link"> <img
                            src="https://www.allstarsmotorsport.com/img/cms/FAQs/product_shipping.jpg" alt="product_shipping.jpg" />
                    </a>
                    <div class="play"><img src="https://www.allstarsmotorsport.com/img/youtube_play.png"/></div>
                    <div class="card-description">
                        <h2>{l s='Product shipping' d='Shop.Theme.UserHelp'}</h2>
                    </div>
                </div>
                <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$youtube_shipping}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="card-user">
                <div class="element-to-click">
                    <a href="https://www.youtube.com/watch?v={$youtube_newsletter}" class="card-link"> <img
                            src="https://www.all-stars-motorsport.com/img/cms/FAQs/newsletter.jpg" alt="product_shipping.jpg" />
                    </a>
                    <div class="play">
                        <img src="https://www.allstarsmotorsport.com/img/youtube_play.png"/></div>
                    <div class="card-description">
                        <h2>{l s='Newsletter' d='Shop.Theme.UserHelp'}</h2>
                    </div>
                </div>
                <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$youtube_newsletter}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="card-user">
                <div class="element-to-click">
                    <a href="https://www.youtube.com/watch?v={$youtube_contact}" class="card-link"> <img
                            src="https://www.all-stars-motorsport.com/img/cms/FAQs/CONTACT.jpg" alt="product_shipping.jpg" />
                    </a>
                    <div class="play"><img src="https://www.allstarsmotorsport.com/img/youtube_play.png"/></div>
                    <div class="card-description">
                        <h2>{l s='Contact' d='Shop.Theme.UserHelp'}</h2>
                    </div>
                </div>
                <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/{$youtube_contact}?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
      </div>
    {else}
      {$cms.content nofilter}
    {/if}



<script>
function playhoverFunction(e) {
  const playDiv = e.previousElementSibling;

  if (playDiv) {
    const imageElement = playDiv.querySelector('.image_play');
    const currentSrc = imageElement.getAttribute('src');
    
      const newSrc = currentSrc.includes('hover') ? '/img/youtube_play.png' : '/img/youtube_play_hover.png';
      imageElement.setAttribute('src', newSrc);
    
  }
}

function openYoutubeLink(videoId) {
        var youtubeLink = "https://www.youtube.com/watch?v=" + videoId;
        window.open(youtubeLink, "_blank");
}

</script>

  {hook h='displayCMSDisputeInformation'}

  {hook h='displayCMSPrintButton'}
  </section>
{/block}