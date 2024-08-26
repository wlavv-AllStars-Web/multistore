<?php
/* Smarty version 4.3.4, created on 2024-08-16 15:36:23
  from 'module:ps_shoppingcartps_shoppingcart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66bf63e75a6c01_43424471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35655e6409b6198f29dd6e732ef9598dec599880' => 
    array (
      0 => 'module:ps_shoppingcartps_shoppingcart.tpl',
      1 => 1722529618,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66bf63e75a6c01_43424471 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<!-- begin /home/asw200923/beta/themes/probusiness/modules/ps_shoppingcart/ps_shoppingcart.tpl -->
<div id="_desktop_cart">
  <div class="blockcart cart-preview <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] > 0) {?>active<?php } else { ?>inactive<?php }?>" data-refresh-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['refresh_url']->value, ENT_QUOTES, 'UTF-8');?>
">
    <div class="header">
      <a rel="nofollow" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
        <div  style="cursor: pointer; width: 100%">
          <div style=" display: flex; flex-direction: row; justify-content:center" class="cart-container  <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['cart']->value['products']) < 1) {?> cart_empty<?php }?>">
            <div style="width:33px; background-color: #0273eb;float: left;border-radius: 20px 0 0 20px;border: 1px solid #777; color: white;display:flex;align-items:center;justify-content:center;"> 
              <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
            </div>
            <div style="height:35px; border: 1px solid #777" class="cart_total_header"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Total",'d'=>"Shop.Theme.Cart"),$_smarty_tpl ) );?>
 <span class="productsValue"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['products']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></div>
            <div class="products_total_header">
              <div style="width:33px; height:35px; background-color: #0273eb;border-radius: 0px 20px 20px 0px;border: 1px solid #777; color: white; font-size: 18px;text-align:center;display:flex;justify-content:center;align-items:center;" ><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['cart']->value['products_count'], ENT_QUOTES, 'UTF-8');?>
</div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>




  

<!-- end /home/asw200923/beta/themes/probusiness/modules/ps_shoppingcart/ps_shoppingcart.tpl --><?php }
}
