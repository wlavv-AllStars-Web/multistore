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
    {/if}

 
    {$cms.content nofilter}

    {if $cms.id == 30}
        <script>
            const classIframe = document.querySelectorAll(".user-help-content .iframeClass")

            classIframe.forEach(element => {
                const parentCard = element.parentElement

                const iframe = document.createElement("iframe")
                iframe.setAttribute("allowfullscreen","allowfullscreen")
                iframe.setAttribute("frameborder","0")
                iframe.setAttribute("loading","lazy")

                if(parentCard.classList.contains("card-availability")){
                    iframe.setAttribute("src","https://www.youtube.com/embed/{$youtube_availability}?autoplay=0&mute=1&rel=0")
                }
                else if(parentCard.classList.contains("card-compatibility")){
                    iframe.setAttribute("src","https://www.youtube.com/embed/{$youtube_compat}?autoplay=0&mute=1&rel=0")
                }
                else if(parentCard.classList.contains("card-shipping")){
                    iframe.setAttribute("src","https://www.youtube.com/embed/{$youtube_shipping}?autoplay=0&mute=1&rel=0")
                }
                else if(parentCard.classList.contains("card-newsletter")){
                    iframe.setAttribute("src","https://www.youtube.com/embed/{$youtube_newsletter}?autoplay=0&mute=1&rel=0")
                }
                else if(parentCard.classList.contains("card-contact")){
                    iframe.setAttribute("src","https://www.youtube.com/embed/{$youtube_contact}?autoplay=0&mute=1&rel=0")
                }
                
                element.appendChild(iframe)
            });

            function playhoverFunction(e) {
                const playDiv = e.previousElementSibling;

                if (playDiv) {
                    const imageElement = playDiv.querySelector('.image_play');
                    const currentSrc = imageElement.getAttribute('src');
                    
                    const newSrc = currentSrc.includes('hover') ? '/img/youtube_play.png' : '/img/youtube_play_hover.png';
                    imageElement.setAttribute('src', newSrc);
                    
                }
            }

        </script>
    {elseif $cms.id == 28}
        <script>
            const cmsLinks = {
                64: "{$link->getCMSLink(64)}",
                65: "{$link->getCMSLink(65)}",
                66: "{$link->getCMSLink(66)}",
                67: "{$link->getCMSLink(67)}",
                68: "{$link->getCMSLink(68)}",
                69: "{$link->getCMSLink(69)}",
                70: "{$link->getCMSLink(70)}",
                71: "{$link->getCMSLink(71)}",
                72: "{$link->getCMSLink(72)}",
                73: "{$link->getCMSLink(73)}",
                74: "{$link->getCMSLink(74)}",
                75: "{$link->getCMSLink(75)}",
                76: "{$link->getCMSLink(76)}",
                77: "{$link->getCMSLink(77)}",
                78: "{$link->getCMSLink(78)}",
                79: "{$link->getCMSLink(79)}",
                80: "{$link->getCMSLink(80)}",
                81: "{$link->getCMSLink(81)}",
                82: "{$link->getCMSLink(82)}",
                83: "{$link->getCMSLink(83)}",
                84: "{$link->getCMSLink(84)}",
            };

            const cars = document.querySelectorAll(".car-container")

            cars.forEach((element) => {
                const aTag = element.querySelector("a")
                aTag.removeAttribute("href")
                const carID = aTag.getAttribute("class").split("-")[1]
                element.querySelector("a").setAttribute("href", cmsLinks[carID])
            })

        </script>
    {elseif $cms.id >= 64 && $cms.id <= 84}
        <script>

            const breadcrumb = document.querySelector(".cms-id-" + {$cms.id} + " .breadcrumb");
            console.log(breadcrumb);

            const breadcrumbList = breadcrumb.querySelector("ol"); // Select the first <ol> instead of using querySelectorAll
            console.log(breadcrumbList);

            const breadcrumbItems = breadcrumb.querySelectorAll("ol li");
            console.log(breadcrumbItems);

            const listLinkPageCars = document.createElement("li");

            const linkPageCars = document.createElement("a");

            const spanPageCars = document.createElement("span");
            spanPageCars.setAttribute("itemprop","name")
            spanPageCars.textContent = "{l s='CARS' d='Shop.Theme.Cms'}";

            linkPageCars.setAttribute("href", "{$link->getCMSLink(28)}"); // Use 'href' for links
            
            listLinkPageCars.appendChild(linkPageCars);

            linkPageCars.appendChild(spanPageCars);

            const lastBreadcrumbItem = breadcrumbItems[breadcrumbItems.length - 1];
            breadcrumbList.insertBefore(listLinkPageCars, lastBreadcrumbItem);


            const content = document.querySelector(".page-car")

            const containerModal = document.createElement("div")
            containerModal.classList.add("modal-imgs-car")

            const swiperContainer = document.createElement("div")
            swiperContainer.classList.add("swiper")
            swiperContainer.classList.add("mySwiperCar")

            containerModal.appendChild(swiperContainer)

            const swiperWrapper = document.createElement("div")
            swiperWrapper.classList.add("swiper-wrapper")

            swiperContainer.appendChild(swiperWrapper)


            const imgs = document.querySelectorAll(".page-car img")

            imgs.forEach((img, index) => {
                const slide = document.createElement("div")
                slide.classList.add("swiper-slide")

                const slideZoom = document.createElement("div")
                slideZoom.classList.add("swiper-zoom-container")

                const imgContent = document.createElement("img")
                const src = img.getAttribute("src")

                imgContent.setAttribute("src", src)

                slideZoom.appendChild(imgContent)
                slide.appendChild(slideZoom)

                swiperWrapper.appendChild(slide)

                img.addEventListener("click", (e) => {
                    containerModal.classList.toggle("show-imgs")
                    swiperCarImgs.slideTo(index,0)
                })
            })

            const right = document.createElement("div")
            right.classList.add("swiper-button-next")

            const left = document.createElement("div")
            left.classList.add("swiper-button-prev")

            swiperContainer.appendChild(right)
            swiperContainer.appendChild(left)

            content.appendChild(containerModal)

                // Click outside logic
            containerModal.addEventListener("click", (event) => {
                // Check if the click is outside the modal
                if (
                    containerModal.classList.contains("show-imgs") &&
                    !swiperContainer.contains(event.target) // Click not inside .mySwiperCar
                ) {
                    containerModal.classList.remove("show-imgs");
                    swiperCarImgs.update();
                }
            });

            var swiperCarImgs = new Swiper(".mySwiperCar", {
                zoom: true,
                loop: false,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    768: {
                        autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                        },
                    }
                }
            });
        </script>

        <style>


            .modal-imgs-car.show-imgs{
                display: flex !important;
            }

            .mySwiperCar{
                width: 850px;
                max-height: 567px;
                background: #fff;
            }

            .mySwiperCar .swiper-slide img {
                max-width: 850px;
                width: 100%;
            }

            .page-car .cars_ul a {
                color: #111 !important;
                font-weight: 600;
            }
            .page-car .cars_ul a:hover {
                color: var(--asm-color) !important;
                font-weight: 600;
            }

        </style>
    {/if}



<script>


// function openYoutubeLink(videoId) {
//         var youtubeLink = "https://www.youtube.com/watch?v=" + videoId;
//         window.open(youtubeLink, "_blank");
// }

</script>

  {hook h='displayCMSDisputeInformation'}

  {hook h='displayCMSPrintButton'}
  </section>
{/block}