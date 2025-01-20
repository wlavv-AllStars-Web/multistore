{* <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script> *}
{* <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.js"></script> *}

    <div id="ukoocompat_search_block_{$search->id|intval}" class="block ukoocompat_search_block" style="clear: both;">
        <div class="block_content" style="background:#282828; display: flex;padding: 0;">
        <form id="ukoocompat_search_block_form_{$search->id|intval}" action="{$form_action|escape}" method="POST" class="ukoocompat_search_block_form{if $search->dynamic_criteria} dynamic_criteria{/if}" style="margin-top: 10px;width: 100%;">
            <input type="hidden" name="id_search" value="{$search->id|intval}" />
            <input type="hidden" name="id_search3" value="{$search->id|intval}" />
            <input type="hidden" name="id_lang" value="{$search->current_id_lang|intval}" />

            <input type="hidden" id="multiFilter_news" name="news_compats" value="{(isset($news_compats)) ? $news_compats : 0 }"/>
            <input type="hidden" id="multiFilter_order_by" name="order_by_compats" value="{(isset($order_by_compats)) ? $order_by_compats : 'position' }"/>
            <input type="hidden" id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="{(isset($order_by_orientation_compats)) ? $order_by_orientation_compats : 'asc' }"/>
            <input type="hidden" id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value="{(isset($id_manufacturer_compats)) ? $id_manufacturer_compats : '' }"/>
            <input type="hidden" id="multiFilter_nr_items" name="nr_items_compats" value="{(isset($nr_items_compats)) ? $nr_items_compats : 20 }"/>
            <input type="hidden" id="multiFilter_n_items" name="n" value="{(isset($nr_items_compats)) ? $nr_items_compats : 20 }"/>
            <input type="hidden" id="multiFilter_page_number" name="p" value="{(isset($p)) ? $p : 1 }"/>
            <input type="hidden" id="multiFilter_id_category" name="id_category" value="{if (isset($id_category))}{$id_category}{else}0{/if}"/>
            <input type="hidden" id="multiFilter_root_page" name="root_page" value=""/>
            
            
            
            {* <div style="display: none;">
                <form id="ukoocompat_my_cars_custom_form" action="/en/module/ukoocompat/listing" method="POST"> 
                    <input type="hidden" name="id_search" value="1"> 
                    <input type="hidden" name="id_search3" value="1"> 
                    <input type="hidden" name="id_lang" value="{Context::getContext()->language->id|escape:'html':'UTF-8'}">
                    <input type="hidden" id="multiFilter_news" name="news_compats" value="0"> 
                    <input type="hidden" id="multiFilter_order_by" name="order_by_compats" value="price"> 
                    <input type="hidden" id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="DESC"> 
                    <input type="hidden" id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value=""> 
                    <input type="hidden" id="multiFilter_nr_items" name="nr_items_compats" value="20"> 
                    <input type="hidden" id="multiFilter_n_items" name="n" value="20"> 
                    <input type="hidden" id="multiFilter_page_number" name="p" value="1"> 
                    <input type="hidden" id="multiFilter_id_category" name="id_category" value="0"> 
                    <input type="hidden" id="multiFilter_root_page" name="root_page" value="">
                    <input type="hidden" id="check_form" name="check_form" value="99585">
                    <input type="hidden" id="custom_filter_1" name="filters1" value="{$icon['brand']}">
                        <input type="hidden" id="custom_filter_2" name="filters2" value="{$icon['model']}">
                        <input type="hidden" id="custom_filter_3" name="filters3" value="{$icon['type']}">
                        <input type="hidden" id="custom_filter_4" name="filters4" value="{$icon['version']}">
                </form>
            </div> *}

                {foreach from=$search->filters item=filter}
            	    
                    {if $filter->id == 1}

                	    {if count($filter->criteria) < 2}
                	        <div style="color: #FFF;background-color: #282828;text-transform: uppercase;font-size: 18px;padding: 7px 15px; margin-bottom: 10px;border:1px solid red; display: inline-block;cursor: pointer;" onclick="$('#ukoocompat_clear_my_cars_custom_form').submit();">Clear Filter</div>
                	    {/if}

            			<div class="ukoocompat_search_block_filter filter_{$filter->id|intval}" style="float:left; width:100%;">
            				<div class="swiper brands-desk ukoocompat_search_block_filter_filter {if count($filter->criteria) > 1}brand-logos{/if}" style="margin: 0 auto;display: flex;">
                                <div class="swiper-wrapper">
                                    {if !isset($filter->disabled) || $filter->disabled|intval != 1}
                                        {foreach from=$filter->criteria item=criterion}
                                            
                                            {if $criterion['id_ukoocompat_filter'] == 1}    
                                                <div style="width: 117px; float: left;text-align: center;height: 160px;" class="car_item_image swiper-slide" >
                                                    {if $criterion['id'] == ''}
                                                    <img src="/img/homepage/brands/undefined.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), {$criterion['id']})" class="selected_item">
                                                    {else}
                                                    <img src="/img/homepage/brands/{$criterion['id']}.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), {$criterion['id']})" class="selected_item">
                                                    {/if}
                                                    <div style="text-transform: uppercase;font-weight: bolder;font-size: 12px;">{$criterion['value']}</div>
                                                </div>
                                            {else}
                                            {/if}
                                        {/foreach}
                                    {/if}
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
            			</div>

            			<div class="ukoocompat_search_block_filter-mobile filter_{$filter->id|intval}" style="float:left; width:100%;">
            				<div class="brands-desk ukoocompat_search_block_filter_filter {if count($filter->criteria) > 1}brand-logos{/if}" style="margin: 0 auto;display: flex;">
                                <div class="">
                                    {if !isset($filter->disabled) || $filter->disabled|intval != 1}
                                        {foreach from=$filter->criteria item=criterion}
                                            
                                            {if $criterion['id_ukoocompat_filter'] == 1}    
                                                <div style="float: left;text-align: center;height: 160px;" class="car_item_image" >
                                                    {if $criterion['id'] == ''}
                                                    <img src="/img/homepage/brands/undefined.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), {$criterion['id']})" class="selected_item">
                                                    {else}
                                                    <img src="/img/homepage/brands/{$criterion['id']}.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), {$criterion['id']})" class="selected_item">
                                                    {/if}
                                                    <div style="text-transform: uppercase;font-weight: bolder;font-size: 12px;">{$criterion['value']}</div>
                                                </div>
                                            {else}
                                            {/if}
                                        {/foreach}
                                    {/if}
                                </div>
                            </div>
            			</div>

                    {/if}
                {/foreach}
                
    			<div class="selector_car_container" style="display: none;"></div>  

            <div class="ukoocompat_search_block_button" style="float:left; width:200px; padding-top:5px;display: none;">
                <button id="ukoocompat_search_block_submit_{$search->id|intval}" type="submit" name="ukoocompat_search_submit" class="button btn btn-default button-medium" style="line-height: 13px; width:100%; padding:6px 10px;">
                    <span>{l s='Search' d='Modules.Ukoocompat.HomeTopmenu'}</span>
                </button>
            </div>
            <input type="hidden" id="ukoocompat_page_name" name="page_name" value="{$page_name|escape:'htmlall':'UTF-8'}"/>
            
            {if !$is_rewrite_active}
                <input type="hidden" name="fc" value="module"/>
                <input type="hidden" name="module" value="ukoocompat"/>
                <input type="hidden" name="controller" value="{$search->controller|escape:'htmlall':'UTF-8'}"/>
            {/if}
            
        </form>
        </div>
    </div>
    
    {if isset($search->display_alias_search_block) && $search->display_alias_search_block}
        {include file='./search-block-alias.tpl'}
    {/if}

<style>
    
    #ukoocompat_select_1{ display: none; }
    #ukoocompat_select_2{ display: none; }
    #ukoocompat_select_3{ display: none; }
    #ukoocompat_select_4{ display: none; }
    .ukoocompat_search_block_form{
        flex-direction: column;
    }
    .brand-logos{ margin: 0 auto; display: flex; overflow: hidden; }
    .ukoocompat_search_block_filter{ float: left; width: 100%; overflow-x: hidden; display: flex; }
    
    .slick-slider{ display: flex; }
    .slick-list { float: left; overflow: hidden; }
    .slick-prev.slick-arrow { float: left;  width: 50px; background: none; border: none; color: red; font-weight: bolder; font-size: 50px; padding: 50px 0; }
    .slick-next.slick-arrow { float: right; width: 50px; background: none; border: none; color: red; font-weight: bolder; font-size: 50px; padding: 50px 0; }
    
    .slick-prev:before { content: "<"; font-size: 50px; }
    .slick-next:before { content: ">"; font-size: 50px; }
    .slick-prev.slick-arrow:hover { background: red; color: #FFF; }
    .slick-next.slick-arrow:hover { background: red; color: #FFF; }
    
    
        .myCarsBrand .carBrandMenu{
            display:none !important;
        }
    
</style>


<script>
var swiper = new Swiper(".brands-desk", {
    slidesPerView: 16,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 6,
          spaceBetween: 0,
        },
        1441: {
          slidesPerView: 9,
          spaceBetween: 0,
        },
        1550: {
          slidesPerView: 9,
          spaceBetween: 0,
        },
        1601: {
          slidesPerView: 12,
          spaceBetween: 0,
        },
        1921: {
          slidesPerView: 12,
          spaceBetween: 0,
        },
      },
});

function setCarAndSearch(brand, model, type, version){
        
        document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_1").value = brand
        document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_2").value = model
        document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_3").value = type
        document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_4").value = version
        // console.log(document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_1"))
        // console.log(document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_2"))
        // console.log(document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_3"))
        // console.log(document.querySelector("#ukoocompat_my_cars_custom_form #custom_filter_4"))
        document.querySelector("#ukoocompat_my_cars_custom_form").submit();
        // console.log(document.querySelector("#custom_filter_1"))
        // $("#custom_filter_1").prop('value', brand);
        // $("#custom_filter_2").prop('value', model);
        // $("#custom_filter_3").prop('value', type);
        // $("#custom_filter_4").prop('value', version);
        
        // $('#ukoocompat_my_cars_custom_form').submit();
        
    }

function hideMyCars(element, brand) { 
        
        $.ajax({
            method: "POST",
            url: "/?action=getMenuHtml",
            data: { 
                action : 'getMenuHtml',
                brand: brand
            }
        }).done(function( html ) {
            
            $('.selected_item').css('border', '1px solid #282828');
            $('.car_item_image').css('background-color', 'transparent');
            element.css('border', '1px solid red').css('border-radius', '5px');
            $('.selector_car_container').replaceWith('<div class="selector_car_container" style="display: none;">' + html + '</div>');
            //$('#selector_container_' + brand).replaceWith( html );
            $('.myCars').hide('slow');
            $('.selector_car_container').show('slow'); 

        });
            
}

</script>