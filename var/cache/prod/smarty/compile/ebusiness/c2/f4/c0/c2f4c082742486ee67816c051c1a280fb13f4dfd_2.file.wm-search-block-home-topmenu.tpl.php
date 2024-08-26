<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from '/home/asw200923/beta/themes/ebusiness/modules/ukoocompat/views/templates/hook/wm-search-block-home-topmenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2841c3e74_70624906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2f4c082742486ee67816c051c1a280fb13f4dfd' => 
    array (
      0 => '/home/asw200923/beta/themes/ebusiness/modules/ukoocompat/views/templates/hook/wm-search-block-home-topmenu.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./search-block-alias.tpl' => 1,
  ),
),false)) {
function content_66cbe2841c3e74_70624906 (Smarty_Internal_Template $_smarty_tpl) {
?>
    <div id="ukoocompat_search_block_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->id )), ENT_QUOTES, 'UTF-8');?>
" class="block ukoocompat_search_block" style="clear: both;">
        <div class="block_content" style="background:#282828; display: flex;padding: 0;">
        <form id="ukoocompat_search_block_form_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->id )), ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['form_action']->value )), ENT_QUOTES, 'UTF-8');?>
" method="POST" class="ukoocompat_search_block_form<?php if ($_smarty_tpl->tpl_vars['search']->value->dynamic_criteria) {?> dynamic_criteria<?php }?>" style="margin-top: 10px;width: 100%;">
            <input type="hidden" name="id_search" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->id )), ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="id_search3" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->id )), ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="id_lang" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->current_id_lang )), ENT_QUOTES, 'UTF-8');?>
" />

            <input type="hidden" id="multiFilter_news" name="news_compats" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['news_compats']->value)) ? $_smarty_tpl->tpl_vars['news_compats']->value : 0, ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_order_by" name="order_by_compats" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['order_by_compats']->value)) ? $_smarty_tpl->tpl_vars['order_by_compats']->value : 'position', ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['order_by_orientation_compats']->value)) ? $_smarty_tpl->tpl_vars['order_by_orientation_compats']->value : 'asc', ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['id_manufacturer_compats']->value)) ? $_smarty_tpl->tpl_vars['id_manufacturer_compats']->value : '', ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_nr_items" name="nr_items_compats" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['nr_items_compats']->value)) ? $_smarty_tpl->tpl_vars['nr_items_compats']->value : 20, ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_n_items" name="n" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['nr_items_compats']->value)) ? $_smarty_tpl->tpl_vars['nr_items_compats']->value : 20, ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_page_number" name="p" value="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['p']->value)) ? $_smarty_tpl->tpl_vars['p']->value : 1, ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" id="multiFilter_id_category" name="id_category" value="<?php if (((isset($_smarty_tpl->tpl_vars['id_category']->value)))) {
echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['id_category']->value, ENT_QUOTES, 'UTF-8');
} else { ?>0<?php }?>"/>
            <input type="hidden" id="multiFilter_root_page" name="root_page" value=""/>
            
            
            
            
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['search']->value->filters, 'filter');
$_smarty_tpl->tpl_vars['filter']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['filter']->value) {
$_smarty_tpl->tpl_vars['filter']->do_else = false;
?>
            	    
                    <?php if ($_smarty_tpl->tpl_vars['filter']->value->id == 1) {?>

                	    <?php if (count($_smarty_tpl->tpl_vars['filter']->value->criteria) < 2) {?>
                	        <div style="color: #FFF;background-color: #282828;text-transform: uppercase;font-size: 18px;padding: 7px 15px; margin-bottom: 10px;border:1px solid red; display: inline-block;cursor: pointer;" onclick="$('#ukoocompat_clear_my_cars_custom_form').submit();">Clear Filter</div>
                	    <?php }?>

            			<div class="ukoocompat_search_block_filter filter_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value->id )), ENT_QUOTES, 'UTF-8');?>
" style="float:left; width:100%;">
            				<div class="swiper brands-desk ukoocompat_search_block_filter_filter <?php if (count($_smarty_tpl->tpl_vars['filter']->value->criteria) > 1) {?>brand-logos<?php }?>" style="margin: 0 auto;display: flex;">
                                <div class="swiper-wrapper">
                                    <?php if (!(isset($_smarty_tpl->tpl_vars['filter']->value->disabled)) || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value->disabled )) != 1) {?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filter']->value->criteria, 'criterion');
$_smarty_tpl->tpl_vars['criterion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['criterion']->value) {
$_smarty_tpl->tpl_vars['criterion']->do_else = false;
?>
                                            
                                            <?php if ($_smarty_tpl->tpl_vars['criterion']->value['id_ukoocompat_filter'] == 1) {?>    
                                                <div style="width: 117px; float: left;text-align: center;height: 160px;" class="car_item_image swiper-slide" >
                                                    <?php if ($_smarty_tpl->tpl_vars['criterion']->value['id'] == '') {?>
                                                    <img src="/img/homepage/brands/undefined.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['criterion']->value['id'], ENT_QUOTES, 'UTF-8');?>
)" class="selected_item">
                                                    <?php } else { ?>
                                                    <img src="/img/homepage/brands/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['criterion']->value['id'], ENT_QUOTES, 'UTF-8');?>
.png" style="width: 105px;margin: 0 auto;" onclick="hideMyCars($(this), <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['criterion']->value['id'], ENT_QUOTES, 'UTF-8');?>
)" class="selected_item">
                                                    <?php }?>
                                                    <div style="text-transform: uppercase;font-weight: bolder;font-size: 12px;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['criterion']->value['value'], ENT_QUOTES, 'UTF-8');?>
</div>
                                                </div>
                                            <?php } else { ?>
                                            <?php }?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <?php }?>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
            			</div>

                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                
    			<div class="selector_car_container" style="display: none;"></div>  

            <div class="ukoocompat_search_block_button" style="float:left; width:200px; padding-top:5px;display: none;">
                <button id="ukoocompat_search_block_submit_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->id )), ENT_QUOTES, 'UTF-8');?>
" type="submit" name="ukoocompat_search_submit" class="button btn btn-default button-medium" style="line-height: 13px; width:100%; padding:6px 10px;">
                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Modules.Ukoocompat.HomeTopmenu'),$_smarty_tpl ) );?>
</span>
                </button>
            </div>
            <input type="hidden" id="ukoocompat_page_name" name="page_name" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['page_name']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
            
            <?php if (!$_smarty_tpl->tpl_vars['is_rewrite_active']->value) {?>
                <input type="hidden" name="fc" value="module"/>
                <input type="hidden" name="module" value="ukoocompat"/>
                <input type="hidden" name="controller" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['search']->value->controller,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
            <?php }?>
            
        </form>
        </div>
    </div>
    
    <?php if ((isset($_smarty_tpl->tpl_vars['search']->value->display_alias_search_block)) && $_smarty_tpl->tpl_vars['search']->value->display_alias_search_block) {?>
        <?php $_smarty_tpl->_subTemplateRender('file:./search-block-alias.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php }?>

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


<?php echo '<script'; ?>
>
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

<?php echo '</script'; ?>
><?php }
}
