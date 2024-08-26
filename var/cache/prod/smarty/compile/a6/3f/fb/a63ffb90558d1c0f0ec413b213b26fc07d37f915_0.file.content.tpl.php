<?php
/* Smarty version 4.3.4, created on 2024-08-22 18:01:01
  from '/home/asw200923/beta/admineuromus1/themes/new-theme/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c76ecdf0c6f8_90930719',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a63ffb90558d1c0f0ec413b213b26fc07d37f915' => 
    array (
      0 => '/home/asw200923/beta/admineuromus1/themes/new-theme/template/content.tpl',
      1 => 1719913924,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c76ecdf0c6f8_90930719 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="ajax_confirmation" class="alert alert-success" style="display: none;"></div>
<div id="content-message-box"></div>


<?php if ((isset($_smarty_tpl->tpl_vars['content']->value))) {?>
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }
}
}
