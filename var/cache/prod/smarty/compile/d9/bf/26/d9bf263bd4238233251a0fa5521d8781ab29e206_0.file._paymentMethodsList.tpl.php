<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:19:44
  from '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_paymentMethodsList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4a0c59655_04132682',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9bf263bd4238233251a0fa5521d8781ab29e206' => 
    array (
      0 => '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_paymentMethodsList.tpl',
      1 => 1673625328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4a0c59655_04132682 (Smarty_Internal_Template $_smarty_tpl) {
if (empty($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings'][call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ))])) {?>
  <div class="alert alert-info">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You do not have any payment methods. Please refresh the list to sync payment options','mod'=>'worldlineop'),$_smarty_tpl ) );?>

  </div>
<?php }?>

<div class="col-lg-offset-3">
  <div class="payment-products">
    <?php $_smarty_tpl->_assignInScope('i', 0);?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings'][call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ))], 'paymentMethod');
$_smarty_tpl->tpl_vars['paymentMethod']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['paymentMethod']->value) {
$_smarty_tpl->tpl_vars['paymentMethod']->do_else = false;
?>
      <div class="payment-product panel">
        <div class="logo">
          <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['logo'],'html','UTF-8' ));?>
"/>
        </div>
        <p class="title"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['identifier'],'html','UTF-8' ));?>
</p>
        <?php if ('iframePaymentMethods' !== $_smarty_tpl->tpl_vars['name']->value) {?>
          <span class="enable-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enable','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
          <span class="switch prestashop-switch fixed-width-md">
            <input type="radio"
                   value="1"
                   name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][enabled]"
                   id="worldlineopPaymentMethodsSettings_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['type']->value,'html','UTF-8' ));?>
_product_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['productId'] ));?>
_enabled_on"
                   <?php if ($_smarty_tpl->tpl_vars['paymentMethod']->value['enabled'] === true) {?>checked="checked"<?php }?>>
            <label for="worldlineopPaymentMethodsSettings_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['type']->value,'html','UTF-8' ));?>
_product_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['productId'] ));?>
_enabled_on">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </label>
            <input type="radio"
                   value="0"
                   name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][enabled]"
                   id="worldlineopPaymentMethodsSettings_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['type']->value,'html','UTF-8' ));?>
_product_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['productId'] ));?>
_enabled_off"
                   <?php if ($_smarty_tpl->tpl_vars['paymentMethod']->value['enabled'] != true) {?>checked="checked"<?php }?>>
            <label for="worldlineopPaymentMethodsSettings_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['type']->value,'html','UTF-8' ));?>
_product_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['productId'] ));?>
_enabled_off">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </label>
            <a class="slide-button btn"></a>
          </span>
        <?php } else { ?>
          <input type="hidden"
                 name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][enabled]"
                 value="1"/>
        <?php }?>
        <input type="hidden"
               name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][logo]"
               value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['logo'],'html','UTF-8' ));?>
"/>
        <input type="hidden"
               name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][type]"
               value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['type'],'html','UTF-8' ));?>
"/>
        <input type="hidden"
               name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][productId]"
               value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['productId'] ));?>
"/>
        <input type="hidden"
               name="worldlineopPaymentMethodsSettings[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' ));?>
][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value ));?>
][identifier]"
               value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['paymentMethod']->value['identifier'],'html','UTF-8' ));?>
"/>
      </div>
      <?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </div>
</div>
<?php }
}
