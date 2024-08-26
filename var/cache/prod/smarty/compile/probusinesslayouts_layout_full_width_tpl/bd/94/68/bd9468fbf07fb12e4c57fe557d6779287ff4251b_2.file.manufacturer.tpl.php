<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:09:59
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/listing/manufacturer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc3857516ac4_50300826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd9468fbf07fb12e4c57fe557d6779287ff4251b' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/listing/manufacturer.tpl',
      1 => 1724256165,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/products.tpl' => 1,
  ),
),false)) {
function content_66cc3857516ac4_50300826 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175827600066cc3857506193_80401595', 'product_list_header');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_24957591966cc38575133f2_39159094', 'product_list');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'catalog/listing/product-list.tpl');
}
/* {block 'product_list_header'} */
class Block_175827600066cc3857506193_80401595 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_list_header' => 
  array (
    0 => 'Block_175827600066cc3857506193_80401595',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>


  <div style="max-width:1350px;margin:auto;">
    <img src="http://webtools.euromuscleparts.com/uploads/manufacturer/ASD/<?php echo htmlspecialchars((string) smarty_modifier_replace($_smarty_tpl->tpl_vars['manufacturer']->value['name'],' ',''), ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['manufacturer']->value['id'], ENT_QUOTES, 'UTF-8');?>
.webp" style="width: 100%;" alt="Brand banner"/>
  </div>
  
  <style>
    
    .btnCar{  black; float: left; width: 50%; margin: 0 auto; border: 0px solid #000; text-align: right; padding: 20px; }
    .btnBike{ black; float: left; width: 50%; margin: 0 auto; border: 0px solid #000; text-align: left;  padding: 20px; }
    
    .btnCar:hover{ background-color: #fff; }
    .btnBike:hover{ background-color: #fff; }

</style>

<?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['bike_parts'] == 1) {?>
<div style="display: flex;width: 100%; text-align: center;margin: 0 auto; background-color: #fff;">

            <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getManufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id']), ENT_QUOTES, 'UTF-8');?>
" class="btnCar mobile">
            <img id="car" <?php if ((!(isset($_smarty_tpl->tpl_vars['id_category']->value))) || ($_smarty_tpl->tpl_vars['id_category']->value != 17)) {?> src="/img/car_mobile_hover.webp" style="background-color: #0076E7;" <?php } else { ?> src="/img/car_mobile.webp" <?php }?>>
        </a> 
        <a href="<?php echo htmlspecialchars((string) $_SERVER['SCRIPT_URI'], ENT_QUOTES, 'UTF-8');?>
?id_category=17" class="btnBike mobile" >
            <img id="bike" <?php if ((isset($_smarty_tpl->tpl_vars['id_category']->value)) && ($_smarty_tpl->tpl_vars['id_category']->value == 17)) {?> src="/img/bike_mobile_hover.webp" style="background-color: #0076E7;" <?php } else { ?> src="/img/bike_mobile.webp" <?php }?>>
        </a> 
            <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getManufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id']), ENT_QUOTES, 'UTF-8');?>
" class="btnCar desktop">
            <img id="car" <?php if ((!(isset($_smarty_tpl->tpl_vars['id_category']->value))) || ($_smarty_tpl->tpl_vars['id_category']->value != 17)) {?> src="/img/car_hover.webp" style="background-color: #0076E7;" <?php } else { ?> src="/img/car.webp" <?php }?>>
        </a> 
        <a href="<?php echo htmlspecialchars((string) $_SERVER['SCRIPT_URI'], ENT_QUOTES, 'UTF-8');?>
?id_category=17" class="btnBike desktop" >
            <img id="bike" <?php if ((isset($_smarty_tpl->tpl_vars['id_category']->value)) && ($_smarty_tpl->tpl_vars['id_category']->value == 17)) {?> src="/img/bike_hover.webp" style="background-color: #0076E7;" <?php } else { ?> src="/img/bike.webp" <?php }?>>
        </a> 
    </div>
  <?php }
}
}
/* {/block 'product_list_header'} */
/* {block 'product_list'} */
class Block_24957591966cc38575133f2_39159094 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_list' => 
  array (
    0 => 'Block_24957591966cc38575133f2_39159094',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/products.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value,'productClass'=>"col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"), 0, false);
}
}
/* {/block 'product_list'} */
}
