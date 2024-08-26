<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:05:43
  from '/home/asw200923/beta/themes/classicNew/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2f7850fb5_64550730',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '36e3f67c4d045fe9f4eec68883f2326d56ba0d6c' => 
    array (
      0 => '/home/asw200923/beta/themes/classicNew/templates/index.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2f7850fb5_64550730 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php $_smarty_tpl->_assignInScope('currentLanguageIso', Context::getContext()->language->iso_code);
$_smarty_tpl->_assignInScope('currentLanguage', Context::getContext()->language->id);
$_smarty_tpl->_assignInScope('categories', Category::getCategories($_smarty_tpl->tpl_vars['currentLanguage']->value));
$_smarty_tpl->_assignInScope('versionsFordMustang', IndexController::getCarsOfBrand("Ford","Mustang",$_smarty_tpl->tpl_vars['currentLanguage']->value));
$_smarty_tpl->_assignInScope('versionsChevroletCamaro', IndexController::getCarsOfBrand("Chevrolet","Camaro",$_smarty_tpl->tpl_vars['currentLanguage']->value));
$_smarty_tpl->_assignInScope('versionsChevroletCorvette', IndexController::getCarsOfBrand("Chevrolet","Corvette",$_smarty_tpl->tpl_vars['currentLanguage']->value));
$_smarty_tpl->_assignInScope('versionsDodgeChallenger', IndexController::getCarsOfBrand("Dodge","Challenger",$_smarty_tpl->tpl_vars['currentLanguage']->value));
$_smarty_tpl->_assignInScope('versionsRamTrx', IndexController::getCarsOfBrand("Ram","Trx",$_smarty_tpl->tpl_vars['currentLanguage']->value));
$_smarty_tpl->_assignInScope('versionsFordBronco', IndexController::getCarsOfBrand("Ford","Bronco",$_smarty_tpl->tpl_vars['currentLanguage']->value));?>




    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88755247766cbe2f780b349_94127445', 'page_content_container');
?>



 <?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_184447895966cbe2f780ba48_00949098 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_75461311866cbe2f780c5b2_34104652 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

            <div style="display: none;">
              <form id="ukoocompat_my_cars_custom_form" action="/en/module/ukoocompat/listing" method="POST"> 
                <input type="hidden" name="id_search" value="1"> 
                <input type="hidden" name="id_search3" value="1"> 
                <input type="hidden" name="id_lang" value="1"> 
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
                <input type="hidden" id="custom_filter_1" name="filters1" value="87"> 
                <input type="hidden" id="custom_filter_2" name="filters2" value="864"> 
                <input type="hidden" id="custom_filter_3" name="filters3" value="865"> 
                <input type="hidden" id="custom_filter_4" name="filters4" value="866">
              </form>
            </div>
            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>


            <div class="lines-tablet" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
            
            <div class="bannersHome">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['icones_50'], 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                <?php $_smarty_tpl->_assignInScope('url', $_smarty_tpl->tpl_vars['item']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)]);?>
                <?php $_smarty_tpl->_assignInScope('numberString', smarty_modifier_regex_replace(((string)$_smarty_tpl->tpl_vars['url']->value),"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*"."$"."/","$"."1,"."$"."2,"."$"."3,"."$"."4"));?>
                <?php $_smarty_tpl->_assignInScope('linkBrand', $_smarty_tpl->tpl_vars['item']->value["link"]);?>

                
                
                <?php if ($_smarty_tpl->tpl_vars['numberString']->value != $_smarty_tpl->tpl_vars['url']->value) {?>
                  <?php $_smarty_tpl->_assignInScope('numbers', array());?>
                    <?php $_smarty_tpl->_assignInScope('numbers', explode(",",$_smarty_tpl->tpl_vars['numberString']->value));?>
                <?php }?>
                <div class="card-img-container">
                  <div class="card-big">
                    <div class="layerHover">
                      <h5><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value["title_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
</h5>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['numberString']->value != $_smarty_tpl->tpl_vars['url']->value) {?>
                    <a style="cursor: pointer;"
                    onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[0], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[1], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[2], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[3], ENT_QUOTES, 'UTF-8');?>
)">
                    <?php } elseif ($_smarty_tpl->tpl_vars['linkBrand']->value != '') {?>
                      <?php if (is_numeric($_smarty_tpl->tpl_vars['linkBrand']->value)) {?>
                        <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
-product.html">
                      <?php } else { ?>
                        <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/brand/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
">
                      <?php }?>
                      
                    <?php }?>
                      <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" alt="banner<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
"/>
                    <?php if ((isset($_smarty_tpl->tpl_vars['numbers']->value))) {?>
                    </a>
                    <?php } elseif ($_smarty_tpl->tpl_vars['linkBrand']->value != '') {?>
                      </a>
                    <?php }?>
                    </div>
                  <div class="card-min-img">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['icones_33'], 'child', false, 'childkey', 'childname', array (
));
$_smarty_tpl->tpl_vars['child']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childkey']->value => $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->do_else = false;
?>
                    <?php $_smarty_tpl->_assignInScope('urlMini', $_smarty_tpl->tpl_vars['child']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)]);?>
                    <?php $_smarty_tpl->_assignInScope('numberStringMini', smarty_modifier_regex_replace(((string)$_smarty_tpl->tpl_vars['urlMini']->value),"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*"."$"."/","$"."1,"."$"."2,"."$"."3,"."$"."4"));?>
                    <?php $_smarty_tpl->_assignInScope('linkBrandMini', $_smarty_tpl->tpl_vars['child']->value["link"]);?>
                
                    <?php if ($_smarty_tpl->tpl_vars['numberStringMini']->value != $_smarty_tpl->tpl_vars['urlMini']->value) {?>
                      <?php $_smarty_tpl->_assignInScope('numbersMini', array());?>
                        <?php $_smarty_tpl->_assignInScope('numbersMini', explode(",",$_smarty_tpl->tpl_vars['numberStringMini']->value));?>
                    <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['key']->value == 0 && $_smarty_tpl->tpl_vars['child']->value['id_parent_card'] == 1) {?>
                          <div class="card-img ">

                          <?php if ($_smarty_tpl->tpl_vars['numberStringMini']->value != $_smarty_tpl->tpl_vars['urlMini']->value) {?>
                            <a style="cursor: pointer;"
                            onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbersMini']->value[0], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbersMini']->value[1], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbersMini']->value[2], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbersMini']->value[3], ENT_QUOTES, 'UTF-8');?>
)">
                            <?php } elseif ($_smarty_tpl->tpl_vars['linkBrandMini']->value != '') {?>
                              <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrandMini']->value, ENT_QUOTES, 'UTF-8');?>
-product.html">
                            <?php }?>
                              <div class="layerHover"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value["title_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
</div>
                              <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" loading="lazy" alt="banner_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value['id_parent_card'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['childkey']->value, ENT_QUOTES, 'UTF-8');?>
" />
                            <?php if ((isset($_smarty_tpl->tpl_vars['numbersMini']->value))) {?>
                            </a>
                            <?php } elseif ($_smarty_tpl->tpl_vars['linkBrandMini']->value != '') {?>
                              </a>
                          <?php }?>

                            
                          </div>
                        <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 1 && $_smarty_tpl->tpl_vars['child']->value['id_parent_card'] == 2) {?>
                          <div class="card-img ">
                            <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value['link'], ENT_QUOTES, 'UTF-8');?>
-product.html">
                              <div class="layerHover"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value["title_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
</div>
                              <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" loading="lazy" alt="banner_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value['id_parent_card'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['childkey']->value, ENT_QUOTES, 'UTF-8');?>
"/>
                            </a>
                          </div>
                        <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 2 && $_smarty_tpl->tpl_vars['child']->value['id_parent_card'] == 3) {?>
                          <div class="card-img ">
                            <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value['link'], ENT_QUOTES, 'UTF-8');?>
-product.html">
                              <div class="layerHover"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value["title_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
</div>
                              <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" loading="lazy" alt="banner_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['child']->value['id_parent_card'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['childkey']->value, ENT_QUOTES, 'UTF-8');?>
"/>
                            </a>
                          </div>
                        <?php }?>
                      
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>    
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>

            <div class="lines-tablet" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
            
            <div class="bannersHomeMobile">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mobile']->value, 'mobileItem', false, 'mobilekey', 'mobilename', array (
));
$_smarty_tpl->tpl_vars['mobileItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['mobilekey']->value => $_smarty_tpl->tpl_vars['mobileItem']->value) {
$_smarty_tpl->tpl_vars['mobileItem']->do_else = false;
?>
              <?php $_smarty_tpl->_assignInScope('url', $_smarty_tpl->tpl_vars['mobileItem']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)]);?>
              <?php $_smarty_tpl->_assignInScope('numberString', smarty_modifier_regex_replace(((string)$_smarty_tpl->tpl_vars['url']->value),"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*"."$"."/","$"."1,"."$"."2,"."$"."3,"."$"."4"));?>
              <?php $_smarty_tpl->_assignInScope('linkBrand', $_smarty_tpl->tpl_vars['mobileItem']->value["link"]);?>

              <?php if ($_smarty_tpl->tpl_vars['numberString']->value != $_smarty_tpl->tpl_vars['url']->value) {?>
                <?php $_smarty_tpl->_assignInScope('numbers', array());?>
                  <?php $_smarty_tpl->_assignInScope('numbers', explode(",",$_smarty_tpl->tpl_vars['numberString']->value));?>
              <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['numberString']->value != $_smarty_tpl->tpl_vars['url']->value) {?>
                <a class="card-img" style="cursor: pointer; position: relative;"
                onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[0], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[1], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[2], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[3], ENT_QUOTES, 'UTF-8');?>
)">
                <?php } elseif ($_smarty_tpl->tpl_vars['linkBrand']->value != '') {?>
                  <?php if (is_numeric($_smarty_tpl->tpl_vars['linkBrand']->value)) {?>
                    <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
-product.html" style="position: relative;">
                  <?php } else { ?>
                    <a href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/brand/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
" style="position: relative;">
                  <?php }?>
                <?php } else { ?>
                  <a style="position: relative;">
                <?php }?>

                  <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['mobileItem']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" style="width: 100%;" loading="lazy" alt="banner<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['mobilekey']->value, ENT_QUOTES, 'UTF-8');?>
"/>
                  <div class="layerHovermobile"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['mobileItem']->value["title_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
</div>

                <?php if ((isset($_smarty_tpl->tpl_vars['numbers']->value))) {?>
                </a>
                <?php } elseif ($_smarty_tpl->tpl_vars['linkBrand']->value != '') {?>
                  </a>
                <?php }?>
                
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          
            </div>

            
            <div class="hidden-md-up"
  style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>

<div class="cars-container">
  <div class="cars-cards col-12">
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordMustang.png" alt="Card image Ford Mustang" loading="lazy">
      <div class="card-title"><a href="">Ford Mustang</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>
          
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['versionsFordMustang']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_brand'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_model'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_type'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_version'], ENT_QUOTES, 'UTF-8');?>
)"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['type'], ENT_QUOTES, 'UTF-8');?>
</a><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['version'], ENT_QUOTES, 'UTF-8');?>
</span>
                  </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/ChevroletCamaro.png" alt="Card image Chevrolet Camaro" loading="lazy">
      <div class="card-title"><a href="">Chevrolet Camaro</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['versionsChevroletCamaro']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_brand'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_model'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_type'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_version'], ENT_QUOTES, 'UTF-8');?>
)"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['type'], ENT_QUOTES, 'UTF-8');?>
</a><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['version'], ENT_QUOTES, 'UTF-8');?>
</span>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeChallenger.png" alt="Card image Dodge Challenger" loading="lazy">
      <div class="card-title"><a href="">Dodge Challenger</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                aria-controls="collapseThree">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['versionsDodgeChallenger']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_brand'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_model'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_type'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_version'], ENT_QUOTES, 'UTF-8');?>
)"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['type'], ENT_QUOTES, 'UTF-8');?>
</a><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['version'], ENT_QUOTES, 'UTF-8');?>
</span>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/ChevroletCorvette.png" alt="Card image Chevrolet Corvette" loading="lazy">
      <div class="card-title"><a href="">Chevrolet Corvette</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
                aria-controls="collapseFour">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>
          <div id="collapseFour" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['versionsChevroletCorvette']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_brand'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_model'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_type'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_version'], ENT_QUOTES, 'UTF-8');?>
)"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['type'], ENT_QUOTES, 'UTF-8');?>
</a><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['version'], ENT_QUOTES, 'UTF-8');?>
</span>
                  </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/RamTrx.png" alt="Card image Ram Trx" loading="lazy">
      <div class="card-title"><a href="">Ram Trx</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
                aria-controls="collapseFive">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseFive" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['versionsRamTrx']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                <div class="card-link"><a style="cursor: pointer;"
                    onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_brand'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_model'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_type'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_version'], ENT_QUOTES, 'UTF-8');?>
)"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['type'], ENT_QUOTES, 'UTF-8');?>
</a><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['version'], ENT_QUOTES, 'UTF-8');?>
</span>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/DodgeCharger.png" alt="Card image Dodge Charger" loading="lazy">
      <div class="card-title"><a href="">Dodge Charger</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
                aria-controls="collapseFive">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseSix" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordBronco.png" alt="Card image Ford Bronco" loading="lazy">
      <div class="card-title"><a href="">Ford Bronco</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true"
                aria-controls="collapseFive">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseSeven" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['versionsFordBronco']->value, 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                  <div class="card-link"><a style="cursor: pointer;"
                      onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_brand'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_model'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_type'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['id_version'], ENT_QUOTES, 'UTF-8');?>
)"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['type'], ENT_QUOTES, 'UTF-8');?>
</a><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['version'], ENT_QUOTES, 'UTF-8');?>
</span>
                  </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/JeepCherokee.png" alt="Card image Jeep Cherokee" loading="lazy">
      <div class="card-title"><a href="">Jeep Cherokee</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true"
                aria-controls="collapseEight">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseFive" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/FordF-150.png" alt="Card image Ford F-150" loading="lazy">
      <div class="card-title"><a href="">Ford F-150</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true"
                aria-controls="collapseFive">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseNine" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card col-lg-3 hidden-md-up">
      <img class="card-img-top" src="/img/eurmuscle/cardCarsHome/JeepWrangler.png" alt="Card image Jeep Wrangler" loading="lazy">
      <div class="card-title"><a href="">Jeep Wrangler</a></div>
      <div id="accordion" style="width: 100%;">
        <div class="cardAccordion">

          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true"
                aria-controls="collapseFive">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Versions','d'=>'Shop.Theme.Banner'),$_smarty_tpl ) );?>

              </button>
            </h5>
          </div>

          <div id="collapseTen" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-text">
                <div class="card-link"><a href="">DT 5700 V8 HEMI</a><span>(2019 -)</span></div>
                <div class="card-link"><a href="">DS 5700 V8 HEMI Classic</a><span>(2013 - 2022)</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


            
            <div class="hidden-md-up"
            style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
            <div class="hidden-sm-down" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;  background: #fff;"></div>
          <div class="otherCars"
            style="width:100%;display: flex;flex-direction:column;justify-content:center;align-items:center;background:#707c88;">
                        <div class="categoryCars" style="display: flex;justify-content:space-evenly;width:100%;padding:3rem 0;">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value[1], 'categoryLevel1');
$_smarty_tpl->tpl_vars['categoryLevel1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['categoryLevel1']->value) {
$_smarty_tpl->tpl_vars['categoryLevel1']->do_else = false;
?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categoryLevel1']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
                  <?php if ($_smarty_tpl->tpl_vars['category']->value['id_category'] == 9 || $_smarty_tpl->tpl_vars['category']->value['id_category'] == 10 || $_smarty_tpl->tpl_vars['category']->value['id_category'] == 11 || $_smarty_tpl->tpl_vars['category']->value['id_category'] == 12 || $_smarty_tpl->tpl_vars['category']->value['id_category'] == 13 || $_smarty_tpl->tpl_vars['category']->value['id_category'] == 14) {?>
                    <?php if ($_smarty_tpl->tpl_vars['category']->value['id_category'] == 14) {?>
                      <a rel="nofollow" href="http://tune4style.com/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
" class="select-list ">
                        <div class="category <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                          <img src="/img/eurmuscle/bannersHome/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['id_category'], ENT_QUOTES, 'UTF-8');?>
.webp" loading="lazy" alt="category <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                          <div class="model-type-overlay"><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></div>
                        </div>
                      </a>
                    <?php } else { ?>
                      <a rel="nofollow" href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['id_category'], ENT_QUOTES, 'UTF-8');?>
-<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['link_rewrite'], ENT_QUOTES, 'UTF-8');?>
" class="select-list ">
                        <div class="category <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                          <img src="/img/eurmuscle/bannersHome/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['id_category'], ENT_QUOTES, 'UTF-8');?>
.webp" loading="lazy" alt="category <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                          <div class="model-type-overlay"><span><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></div>
                        </div>
                      </a>
                    <?php }?>
                  <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          
            </div>
          </div>

                        <div style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;background: #fff;"></div>
              <div class="videosContainer">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['icones_videos'], 'icon', false, 'key');
$_smarty_tpl->tpl_vars['icon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['icon']->value) {
$_smarty_tpl->tpl_vars['icon']->do_else = false;
?>
                <div class="video3 video">
                  <div class="firstDiv" onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
                  <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['icon']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" loading="lazy" alt="banner_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['icon']->value['youtube_code'], ENT_QUOTES, 'UTF-8');?>
"/>
                    <div class="play">
                      <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                    </div>
                  </div>
                  <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['icon']->value['youtube_code'], ENT_QUOTES, 'UTF-8');?>
?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                  </div>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>

              <?php echo '<script'; ?>
>
const videosContainer = Array.from(document.querySelector('.videosContainer').children);

videosContainer.forEach((item) => {
  const img = item.querySelector('.play img');
  if (img) {
    item.addEventListener('mouseover', () => {
      img.setAttribute('src', "/img/youtube_play_hover.png")
    });
    item.addEventListener('mouseleave', () => {
      img.setAttribute('src', "/img/youtube_play.png")
    });
  }
});

if (window.screen.width < 768) {
  videosContainer.forEach((item) => {
    const img = item.querySelector('.play img');
    if (img) {
      img.setAttribute("src", "/img/youtube_play_hover.png")
    }
  })
}


function setCarAndSearch(brand, model, type, version) {
    $("#custom_filter_1").prop('value', brand);
    $("#custom_filter_2").prop('value', model);
    $("#custom_filter_3").prop('value', type);
    $("#custom_filter_4").prop('value', version);
    $('#ukoocompat_my_cars_custom_form').submit();
  }

              <?php echo '</script'; ?>
>

<style>
  

@media screen and (max-width:767px){
  .categoryCars .category {
  max-height: 291px !important;
  background: #bfbfbf !important;
}
.categoryCars .category img {
  width: 100%;
  object-fit: cover;
  height: 100%;
  transform: scale(1.25);
  object-position: 5px;
  
}
}

@media screen and (min-width:768px){
.categoryCars .category {
  max-height: 370px !important;
  background: #bfbfbf !important;
}
.categoryCars .category img {
  width: 100%;
  object-fit: cover;
  height: 100%;
  transform: scale(1.25);
  object-position: left;
  
}

.categoryCars .category.MODERN img {
  object-position: left 14px !important;
}

}



</style>
            
          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_30393331866cbe2f780c1f2_33846710 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_75461311866cbe2f780c5b2_34104652', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_88755247766cbe2f780b349_94127445 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_88755247766cbe2f780b349_94127445',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_184447895966cbe2f780ba48_00949098',
  ),
  'page_content' => 
  array (
    0 => 'Block_30393331866cbe2f780c1f2_33846710',
  ),
  'hook_home' => 
  array (
    0 => 'Block_75461311866cbe2f780c5b2_34104652',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_184447895966cbe2f780ba48_00949098', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_30393331866cbe2f780c1f2_33846710', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
