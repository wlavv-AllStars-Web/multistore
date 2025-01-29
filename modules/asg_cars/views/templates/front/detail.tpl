{extends file="page.tpl"}
{block name="content"}
    {* <pre>{$car|print_r}</pre> *}

    <div class="rte page-car">
        <div class="col-lg-4 col-md-6 col-sm-6" style="overflow-y: hidden;">
            <div style="text-align:left;">
                <h1><strong>{$car.name}</strong></h1>
                {assign var="description_field" value='description_'|cat:$language.iso_code}
                {assign var="description" value=$car[$description_field]}
                {assign var="budget_field" value='budget_'|cat:$language.iso_code}
                {assign var="budget" value=$car[$budget_field]}
                <h3><strong>{$description}</strong></h3>
                <h3 style="text-transform:uppercase;color:#000000;"><strong>{$budget}</strong></h3>
            </div>
            <div style="text-align:left;">
                <h1><strong>{l s="Engine" d="Shop.Theme.CarDetails"}</strong></h1>
            </div>
            <div>
                <ul class="cars_ul" style="color:#000000;text-align:left;">
                    {foreach from=$car.products item=product}
                        {if $product.category == 'motor' && $product.id_lang == Context::getContext()->language->id}
                            {if !empty($product.link)}
                                <li><a href="{$product.link}">{$product.name}<sup style="color: #dd170e;"> ( Link )</sup></a></li>
                            {else}
                                <li>{$product.name}</li>
                            {/if}
                        {/if}
                    {/foreach}
                </ul>
            </div>
            <div class="spacer-20"></div>
            <div style="text-align:left;">
                <h1><strong>{l s="Chassis / Brakes" d="Shop.Theme.CarDetails"}</strong></h1>
            </div>
            <div>
                <ul class="cars_ul" style="color:#000000;text-align:left;">
                {foreach from=$car.products item=product}
                    {if $product.category == 'chassis' && $product.id_lang == Context::getContext()->language->id}
                            {if !empty($product.link)}
                                <li><a href="{$product.link}">{$product.name}<sup style="color: #dd170e;"> ( Link )</sup></a></li>
                            {else}
                                <li>{$product.name}</li>
                            {/if}
                    {/if}
                {/foreach}
                </ul>
            </div>
            <div class="spacer-20"></div>
            <div style="text-align:left;">
                <h1><strong>{l s="Exterior" d="Shop.Theme.CarDetails"}</strong></h1>
            </div>
            <div>
                <ul class="cars_ul" style="color:#000000;text-align:left;">
                {foreach from=$car.products item=product}
                    {if $product.category == 'exterior' && $product.id_lang == Context::getContext()->language->id}
                            {if !empty($product.link)}
                                <li><a href="{$product.link}">{$product.name}<sup style="color: #dd170e;"> ( Link )</sup></a></li>
                            {else}
                                <li>{$product.name}</li>
                            {/if}
                    {/if}
                {/foreach}
                </ul>
            </div>
            <div class="spacer-20"></div>
            <div style="text-align:left;">
                <h1><strong>{l s="Interior" d="Shop.Theme.CarDetails"}</strong></h1>
            </div>
            <div>
                <ul class="cars_ul" style="color:#000000;text-align:left;">
                    {foreach from=$car.products item=product}
                        {if $product.category == 'interior' && $product.id_lang == Context::getContext()->language->id}
                                {if !empty($product.link)}
                                <li><a href="{$product.link}">{$product.name}<sup style="color: #dd170e;"> ( Link )</sup></a></li>
                            {else}
                                <li>{$product.name}</li>
                            {/if}
                        {/if}
                    {/foreach}
                </ul>
            </div>
            {* <div class="spacer-20"></div>
            <div style="text-align:left;">
                <h1><strong>Transmision</strong></h1>
            </div>
            <div>
                <ul class="cars_ul" style="color:#000000;text-align:left;">
                    <li>Original</li>
                </ul>
            </div> *}
        </div>
        <div class="col-lg-8 col-md-6 col-sm-6">
            <div class="row">
            {foreach from=$car.images item=image}
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><img src="/{$image}"
                        alt="SF90-1.jpg"></div>
            {/foreach}
            </div>
        </div>

    </div>

    <script>
    const content = document.querySelector("#module-asg_cars-FrontAsgCars")

    const containerModal = document.createElement("div")
    containerModal.classList.add("modal-imgs-car")

    const swiperContainer = document.createElement("div")
    swiperContainer.classList.add("swiper")
    swiperContainer.classList.add("mySwiperCar")

    containerModal.appendChild(swiperContainer)

    const swiperWrapper = document.createElement("div")
    swiperWrapper.classList.add("swiper-wrapper")

    swiperContainer.appendChild(swiperWrapper)


    const imgs = document.querySelectorAll("#module-asg_cars-FrontAsgCars img")

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


            document.addEventListener("DOMContentLoaded", () => {
                gsap.registerPlugin(ScrollTrigger);

                const leftSide = document.querySelector(".page-car div:nth-child(1)");
                const rightSide = document.querySelector(".page-car div:nth-child(2) .row");

                const leftSideScrollHeight = leftSide.scrollHeight - leftSide.clientHeight;
                const rightSideScrollHeight = rightSide.scrollHeight - rightSide.clientHeight;

                // Initial state
                const scrollRatio = rightSideScrollHeight / leftSideScrollHeight;;// Initially disable scrolling on the left side

                leftSide.style.overflowY = "hidden"; 

                // Create ScrollTrigger
                ScrollTrigger.create({
                    trigger: ".list-menu-desktop", // Pin the container
                    start: "top top", // Pin starts when `.page-car` reaches the top
                    endTrigger: ".footer_top", // Pin stops when `.footer` comes into view
                    end: "bottom bottom", // End pinning when `.page-car` bottom hits `.footer` top
                    pin: true, // Pin `.page-car`
                    scrub: true, // Smooth scroll syncing
                    markers: true,
                    onUpdate: (self) => {
    
                    const rightSideScrollValue = rightSideScrollHeight * self.progress ;
                    rightSide.scrollTo({ top: rightSideScrollValue, behavior: "smooth" }); // Smooth scroll for right side

                    // Adjust left side scroll value to sync it with the right side
                    const leftSideScrollValue = leftSideScrollHeight * self.progress;
                    leftSide.scrollTo({ top: leftSideScrollValue, behavior: "smooth" });

                    }
                });
            });
    </script>

    <style>
    /* .page-car{
        pointer-events: none;
    } */
    #module-asg_cars-FrontAsgCars > div:nth-child(2) .row,#module-asg_cars-FrontAsgCars > div:nth-child(1){
        max-height: 100dvh;
        overflow-y: scroll;
        scrollbar-width: none;
    }

    #module-asg_cars-FrontAsgCars > div:nth-child(1)::-webkit-scrollbar,
    #module-asg_cars-FrontAsgCars > div:nth-child(2) .row::-webkit-scrollbar {
        display: none;
    }






    .modal-imgs-car.show-imgs{
        display: flex !important;
    }

    .mySwiperCar{
        max-width: 1200px;
        max-height: 800px;
        background: #fff;
        width: 100%;
    }

    .mySwiperCar .swiper-slide img {
        max-width: 1200px;
        width: 100%;
    }

    #module-asg_cars-FrontAsgCars .cars_ul a {
        color: #111 !important;
        font-weight: 600;
    }
    #module-asg_cars-FrontAsgCars .cars_ul a:hover {
        color: var(--asm-color) !important;
        font-weight: 600;
    }

    </style>
{/block}