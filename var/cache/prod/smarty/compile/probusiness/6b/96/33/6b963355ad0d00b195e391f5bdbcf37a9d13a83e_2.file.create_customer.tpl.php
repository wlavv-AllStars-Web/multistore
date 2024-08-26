<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:08:06
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/create_customer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc37e668eb44_67189217',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b963355ad0d00b195e391f5bdbcf37a9d13a83e' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/create_customer.tpl',
      1 => 1718718998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc37e668eb44_67189217 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    var ETS_OPC_CHECK_BOX_NEWSLETTER = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_NEWSLETTER']->value )), ENT_QUOTES, 'UTF-8');?>
;
    var ETS_OPC_CHECK_BOX_OFFERS =<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_OFFERS']->value )), ENT_QUOTES, 'UTF-8');?>
;
<?php echo '</script'; ?>
><?php }
}
