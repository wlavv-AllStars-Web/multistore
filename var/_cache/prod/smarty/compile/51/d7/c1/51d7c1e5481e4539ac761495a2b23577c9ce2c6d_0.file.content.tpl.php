<?php
/* Smarty version 4.3.4, created on 2024-08-21 12:23:43
  from '/home/asw200923/beta/admineuromus1/themes/default/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c5ce3fb87d76_83696633',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51d7c1e5481e4539ac761495a2b23577c9ce2c6d' => 
    array (
      0 => '/home/asw200923/beta/admineuromus1/themes/default/template/content.tpl',
      1 => 1719913920,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c5ce3fb87d76_83696633 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>
<div id="content-message-box"></div>

<?php if ((isset($_smarty_tpl->tpl_vars['content']->value))) {?>
	<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }
}
}
