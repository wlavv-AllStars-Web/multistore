{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="bannersContainer">
{if Context::getContext()->isMobile() != 1}
  {/if}
  <div class="bannerRow1">
    <a class="banner banner1 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="banner__image-container">
          <img src="/img/banner2.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid" style="object-position: right;">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
    <a class="banner banner2 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="banner__image-container">
          <img src="/img/banner1.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid" style="object-position: left;">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
  </div>
  <div class="bannerRow2">
    <a class="banner banner1 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="banner__image-container">
          <img src="/img/banner3.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
    <a class="banner banner2 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="banner__image-container">
          <img src="/img/banner4.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
    <a class="banner banner2 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="banner__image-container">
          <img src="/img/banner5.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
  </div>
  <div class="bannerRow3">
    <a class="banner banner1 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="containerVideo">
          <div class="banner__image-container">
            <img src="/img/video1.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid">
          </div>
          <img src="/img/youtube_play.png" alt="{$banner_desc}" title="{$banner_desc}" class="youtube-play">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
    <a class="banner banner2 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="containerVideo">
          <div class="banner__image-container">
            <img src="/img/video2.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid">
          </div>
          <img src="/img/youtube_play.png" alt="{$banner_desc}" title="{$banner_desc}" class="youtube-play">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
    <a class="banner banner2 image-box" href="#" >
      {* {if isset($banner_img)} *}
        <div class="containerVideo">
          <div class="banner__image-container">
            <img src="/img/video3.webp" alt="{$banner_desc}" title="{$banner_desc}" class="img-fluid">
          </div>
          <img src="/img/youtube_play.png" alt="{$banner_desc}" title="{$banner_desc}" class="youtube-play">
        </div>
      {* {else}
        <span>{$banner_desc}</span>
      {/if} *}
    </a>
  </div>
</div>
<script>
  const videosYoutube = document.querySelectorAll(".containerVideo")
  
  videosYoutube.forEach(element => {
    element.addEventListener("mouseover", () => {
      const playButton = element.querySelector('.youtube-play')
      console.log(playButton)
      playButton.setAttribute("src","/img/youtube_play_hover.png")
    })
    element.addEventListener("mouseout", () => {
      const playButton = element.querySelector('.youtube-play')
      console.log(playButton)
      playButton.setAttribute("src","/img/youtube_play.png")
    })
    if(screen.width <= 768){
      const playButton = element.querySelector('.youtube-play')
      playButton.setAttribute("src","/img/youtube_play_hover.png")
    }
  });
</script>
