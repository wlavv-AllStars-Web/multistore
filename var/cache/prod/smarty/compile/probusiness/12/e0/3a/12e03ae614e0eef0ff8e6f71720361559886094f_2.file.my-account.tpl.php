<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/my-account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4ded77a21_18325210',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12e03ae614e0eef0ff8e6f71720361559886094f' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/my-account.tpl',
      1 => 1718718998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4ded77a21_18325210 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="myaccount">
    <p class="identity">
         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Connected as','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->firstname,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&nbsp;<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->lastname,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a>.
    </p>
    <p> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not you?','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,'mylogout'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log out','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</a></p>
</div><?php }
}
