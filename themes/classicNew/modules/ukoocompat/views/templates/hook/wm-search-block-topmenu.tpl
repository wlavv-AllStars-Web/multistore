<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

{if !isset($ajax_reload)}
    <div id="ukoocompat_search_block_{$search->id|intval}" class="block ukoocompat_search_block" style="clear: both;">
        <div class="block_content" style="background:#282828;padding: 0;display:flex;">
{/if}
    <!--  <form id="ukoocompat_search_block_form_{$search->id|intval}" action="{$form_action|escape}" method="POST" class="ukoocompat_search_block_form{if $search->dynamic_criteria} dynamic_criteria{/if}" style="margin-top: 10px;width: 100%;">
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
-->
                    <div style="display: none;">
                        <form id="ukoocompat_my_cars_custom_form" action="/{$lang_iso}/module/ukoocompat/listing" method="POST"> 
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
                    </div>
                    
                    {if $page_name =='index'}
                        <div style="display: none;">
                            
                            <form id="ukoocompat_clear_my_cars_custom_form" action="/{$lang_iso}/module/ukoocompat/listing" method="POST"> 
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
                                <input type="hidden" id="custom_filter_1" name="filters1" value="0">
                                <input type="hidden" id="custom_filter_2" name="filters2" value="0">
                                <input type="hidden" id="custom_filter_3" name="filters3" value="0">
                                <input type="hidden" id="custom_filter_4" name="filters4" value="0">
                            </form>    
                            
                        </div>
                    {/if}

            <div  class="filterLogo" >
            {foreach from=$search->filters item=filter}
            	    
                    {if $filter->id == 1}

                	    {if count($filter->criteria) < 2}
                	        <div  class="clearfilterLogo" style="color: #FFF;background-color: #282828;text-transform: uppercase;font-size: 18px;padding: 7px 15px; margin-bottom: 10px;border:1px solid red;cursor: pointer;" onclick="$('#ukoocompat_clear_my_cars_custom_form').submit();">Clear Filter</div>
                	    {/if}

            			<div class="ukoocompat_search_block_filter filter_{$filter->id|intval}" style="float:left; width:100%;">
            				<div class="ukoocompat_search_block_filter_filter {if count($filter->criteria) > 1}brand-logos{/if}" style="margin: 0 auto;display: table; width:100%">
                             {if !isset($filter->disabled) || $filter->disabled|intval != 1} 
                                    {foreach from=$filter->criteria item=criterion}
                                        {if $criterion['id_ukoocompat_filter'] == 1}
                                            <div class="car_item_image slide" touchstart="mouseHoverMyCars($(this), {$criterion['id']})" touchend="mouseLeaveMyCars($(this), {$criterion['id']})">
                                                {if $criterion['id'] == ''}
                                                <img src="/img/homepage/brands/undefined.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), {$criterion['id']})" class="selected_item">
                                                
                                                {else}
                                                <img src="/img/homepage/brands/{$criterion['id']}.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), {$criterion['id']})" class="selected_item">
                                                <input type="hidden" value="{$criterion['value']}"  id="brandName_{$criterion['id']}"/>
                                                {/if}
                                               <!-- <div style="text-transform: uppercase;font-weight: bolder;font-size: 12px;color:#fff;">{$criterion['value']}</div> -->
                                            </div>
                                        {else}
                                        {/if}
                                    {/foreach}
                            {/if}
                            </div>
            			</div>

                    {/if}
                {/foreach}
               </div> 
                
    			<div class="selector_car_container" style="display: none;">
    		    </div>  
    			
    			

            <div class="ukoocompat_search_block_button" style="float:left; width:200px; padding-top:5px;display: none;">
                <button id="ukoocompat_search_block_submit_{$search->id|intval}" type="submit" name="ukoocompat_search_submit" class="button btn btn-default button-medium" style="line-height: 13px; width:100%; padding:6px 10px;">
                    <span>{l s='Search' d='Modules.Ukoocompat.Block-topmenu'}</span>
                </button>
            </div>
            <input type="hidden" id="ukoocompat_page_name" name="page_name" value="{$page_name|escape:'htmlall':'UTF-8'}"/>
            
            {if !$is_rewrite_active}
                <input type="hidden" name="fc" value="module"/>
                <input type="hidden" name="module" value="ukoocompat"/>
                <input type="hidden" name="controller" value="{$search->controller|escape:'htmlall':'UTF-8'}"/>
            {/if}
            
        </form>
{if !isset($ajax_reload)}
        </div>
    </div>
    {if isset($search->display_alias_search_block) && $search->display_alias_search_block}
        {include file='./search-block-alias.tpl'}
    {/if}
{/if}

<script>
        var globalBrand;
        var globalModel;
        var globalType;
        var globalVersion;
        var globalImgBrand;
        
        

        function hideMyCars(element,brand){
            brandName= $("#brandName_"+brand).val();
            
            
            $.ajax({
                method:"POST",
                url:"/?action=getMenuHtml",
                data:{
                    action:'getMenuHtml',
                    brand:brand
                    
                }
                
            }).done(function(html){
                
                $('.selected_item').css('border','1px solid #282828');
                $('.car_item_image').css('background-color','transparent');
                $('.ukoocompat_search_block_filter').css('display', 'none')
                $('.block_content').css('display', 'none !important')
                element.css('border','1px solid red').css('border-radius','5px');
                if(screen.width < 960){
                $('.selector_car_container').replaceWith('<div class="selector_car_container"><button class="btn-back" type="button" onclick="$(\'#ukoocompat_clear_my_cars_custom_form\').submit()"><span class="material-symbols-outlined" style="font-size:30px;">arrow_left</span>{l s='Back'}</button><div class="informationBrandModel" style="display:flex !important;"><img src="/img/homepage/brands/'+brand+'.png" width="70px" /><div id="breadcrumbModel"><span style="text-transform:uppercase;font-weight:bold;color:red;">'+brandName+'</span> <span class="material-symbols-outlined" style="font-size:30px;">arrow_right</span> MODEL <span class="material-symbols-outlined" style="font-size:30px;">arrow_right</span> TYPE <span class="material-symbols-outlined" style="font-size:30px;">arrow_right</span> VERSION</div></div>' + html + '</div>');
                } else {
                    $(".selector_car_container").replaceWith('<div class="selector_car_container" style="display:flex !important;background:red;">' + html + "</div>");
                }
                $('.myCars').hide('slow');
                $('.selector_car_container').show('slow');
                
                
                
            });
        }
            
        $("#openMyCars").click(function(){
            $('.myCars').show('slow');
            $('.selector_car_container').hide('slow');
            
        });
        
        function mouseHoverMyCars(element,id){
            let img=element.find('img');
        img.attr('src','/img/homepage/brands/_'+id+'.png');
            
        }
        
        function setCarAndSearch(brand,model,type,version){
            $("#custom_filter_1").prop('value',brand);
            $("#custom_filter_2").prop('value',model);
            $("#custom_filter_3").prop('value',type);
            $("#custom_filter_4").prop('value',version);
            $('#ukoocompat_my_cars_custom_form').submit();
            
        }
        
        

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<style>
    
    @media screen and (max-width:560px){
       
        .page-content-container{
         overflow:hidden;
         
        }
        .informationBrandModel{
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            color:#fff;
            /*margin:1rem;*/
        }
        
        #breadcrumbModel{
            margin: 1rem 0;
            display: flex;
            align-items: center;
            font-size:14px;
            text-align:center;
        }
        #breadcrumbModel span{
            color:red;
        }
        
        #collapseExample{
            padding:10px 0;
        }
        .myCarsBrand{ font-size: 18px; line-height: 2; text-align: center; width: 200px; padding: 5px; float: left; margin-bottom: 40px;color:#fff; }
        .ukoocompat_search_block_filter_filter.brand-logos{
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
        }
        .car_item_image{
         width:fit-content !important;   
         height:fit-content !important;
         
        }
        
        .car_item_image .selected_item{
            width:70px !important;
            
        }
        
        
        .myCarsBrand .carBrandMenu {
            color:#222222;
            width:fit-content;
            margin:auto;
            font-weight:600;
        }
        
        
        
        .modespan {
            color:#ff0000;
        }
        
        .model-cars::-webkit-scrollbar-track {
            background:#5c5c5c !important;
        }
        
        .model-cars::-webkit-scrollbar-thumb {
            background-color: #ff0000 !important; 
            border-radius: 6px !important;
        }
        .model-cars {
            scrollbar-width: thin !important; 
            scrollbar-color: #ff0000 #5c5c5c;
        }
        .model-cars-container{
            display: flex;
            overflow-x: scroll;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            width: 100%;
            flex-direction:column;
        }
        
        .model-cars{
            background:#282828; 
            padding: 0;
            display: flex;
            scroll-snap-type:x mandatory;
            width: 90vw;
            margin-top: 5px; 
            margin-bottom:1rem;
            overflow-x: scroll;
            overflow-y: hidden;
            position:relative;
            
        }
        
        
        
        
        .car_item_holder{
         background:#5c5c5c;
        border: 1px solid #000;
         flex:0 0 auto;
         scroll-snap-align:start;
         width:99%;
         border-radius:5px;
         margin:5px !important;
         box-shadow: 4px 4px 5px #222222;
         
         display:flex;
         flex-direction:column;
         justify-content:space-between;
        }
        
        #container_version_parent{
            margin-inline: 1rem;
            background: #282828;
            border-radius: 5px;
            box-shadow: 2px 4px 4px #444444;
                                    
        }
        
        .btn-back:hover{
            background:#ff0000;
        }
        
        .btn-back{
            background:#282828;
            border:2px solid #ff0000;
            border-radius:5px;
            display:flex;
            align-items:center;
            color: #fff;
            padding:0.25rem 1rem;
            margin: 0.5rem 1rem;
        
        }
        .btn-back span{
            color: #fff;
            font-size:25px;
            
            
        }
        .btn-back span:focus-visible{
            outline:none;
        }
        
        .btn-back:focus-visible{
            outline:none;
        }
        
        .myCarsBrand {
            width:100%;
        }
        
        .type_selector{
           color: #ff0000;
           margin:0.5rem auto;
           background:#f7f7f5;
           padding:0.5rem 1rem;
           border-radius:5px;
        }
        .container_x_x{
            margin-top:2rem;
        }
        
        .block_content{
            background: #282828;
            display: flex !important;
            padding: 1rem 10px !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
        }
        .block_content .ukoocompat_search_block_filter_filter {
            display:flex !important;
            justify-content:center;
        }
        
        #indicator {
          position: absolute;
          top: 0px;
          left: 20px;
          height: 100vh;
          display: flex;
          flex-direction: column;
          justify-content: center;
        }
        
        #indicator > div {
          background-color: white;
          width:10px;
          height:10px;
          border-radius: 5px;
          margin: 10px;
          cursor: pointer;
        }
        
        #indicator > div.active {
          transform: scale(1.6);
        }

        
        
    }
    @media screen and (min-width:561px) and (max-width:960px){
        .filterLogo{
            display: flex;
            flex-direction: column;
            width:100%;
            justify-content:center;
        }
        
        .clearfilterLogo {
            width:fit-content;
            margin:auto;
        }
        
        .car_item_image{
         display:flex;
         height:fit-content;
         width:fit-content;
        }
        .block_content{
            margin-bottom:1rem;
        }
        
        .ukoocompat_search_block_filter.filter_1{
            width:100%;
        }
        
        .ukoocompat_search_block_filter_filter.brand-logos {
            display:flex !important;
            flex-wrap:wrap;
            justify-content:center;
        }
        
        .informationBrandModel {
               display:flex;
               flex-direction:column;
               justify-content:center;
        }
        
        .model-cars {
            display:flex;
        }
        
        
        
        /* aqui*/
        
         .page-content-container{
         overflow:hidden;
         
        }
        .informationBrandModel{
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            color:#fff;
            /*margin:1rem;*/
        }
        
        #breadcrumbModel{
            margin: 1rem 0;
            display: flex;
            align-items: center;
            font-size:14px;
            text-align:center;
        }
        #breadcrumbModel span{
            color:red;
        }
        
        #collapseExample{
            padding:10px 0;
        }
        .myCarsBrand{ font-size: 18px; line-height: 2; text-align: center; width: 200px; padding: 5px; float: left; margin-bottom: 40px;color:#fff; }
        .ukoocompat_search_block_filter_filter.brand-logos{
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
        }
        .car_item_image{
         width:fit-content !important;   
         height:fit-content !important;
         
        }
        
        .car_item_image .selected_item{
            width:70px !important;
            
        }
        
        
        .myCarsBrand .carBrandMenu {
            color:#222222;
            width:fit-content;
            margin:auto;
            font-weight:600;
        }
        
        
        
        .modespan {
            color:#ff0000;
        }
        
        .model-cars::-webkit-scrollbar-track {
            background:#5c5c5c !important;
        }
        
        .model-cars::-webkit-scrollbar-thumb {
            background-color: #ff0000 !important; 
            border-radius: 6px !important;
        }
        .model-cars {
            scrollbar-width: thin !important; 
            scrollbar-color: #ff0000 #5c5c5c;
        }
        .model-cars-container{
            display: flex;
            overflow-x: scroll;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            width: 100%;
            flex-direction:column;
        }
        
        .model-cars{
            background:#282828; 
            padding: 0;
            display: flex;
            scroll-snap-type:x mandatory;
            width: 90vw;
            margin-top: 5px; 
            margin-bottom:1rem;
            overflow-x: scroll;
            overflow-y: hidden;
            position:relative;
            
        }
        
        
        
        
        .car_item_holder{
         background:#5c5c5c;
        border: 1px solid #000;
         flex:0 0 auto;
         scroll-snap-align:start;
         width:99%;
         border-radius:5px;
         margin:5px !important;
         box-shadow: 4px 4px 5px #222222;
         
         display:flex;
         flex-direction:column;
         justify-content:space-between;
        }
        
        #container_version_parent{
            margin-inline: 1rem;
            background: #282828;
            border-radius: 5px;
            box-shadow: 2px 4px 4px #444444;
                                    
        }
        
        .btn-back:hover{
            background:#ff0000;
        }
        
        .btn-back{
            background:#282828;
            border:2px solid #ff0000;
            border-radius:5px;
            display:flex;
            align-items:center;
            color: #fff;
            padding:0.25rem 1rem;
            margin: 0.5rem 1rem;
        
        }
        .btn-back span{
            color: #fff;
            font-size:25px;
            
            
        }
        .btn-back span:focus-visible{
            outline:none;
        }
        
        .btn-back:focus-visible{
            outline:none;
        }
        
        .myCarsBrand {
            width:100%;
        }
        
        .type_selector{
           color: #ff0000;
           margin:0.5rem auto;
           background:#f7f7f5;
           padding:0.5rem 1rem;
           border-radius:5px;
        }
        .container_x_x{
            margin-top:2rem;
        }
        
        .block_content{
            background: #282828;
            display: flex !important;
            padding: 1rem 10px !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
        }
        .block_content .ukoocompat_search_block_filter_filter {
            display:flex !important;
            justify-content:center;
        }
        
        #indicator {
          position: absolute;
          top: 0px;
          left: 20px;
          height: 100vh;
          display: flex;
          flex-direction: column;
          justify-content: center;
        }
        
        #indicator > div {
          background-color: white;
          width:10px;
          height:10px;
          border-radius: 5px;
          margin: 10px;
          cursor: pointer;
        }
        
        #indicator > div.active {
          transform: scale(1.6);
        }
        
    }
</style>
