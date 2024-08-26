<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from 'module:ets_onepagecheckoutviewstemplatesfrontonepagecheckout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4def3b114_21790383',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1e3825ee280661812215af369670f50918195e9' => 
    array (
      0 => 'module:ets_onepagecheckoutviewstemplatesfrontonepagecheckout.tpl',
      1 => 1718718998,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4def3b114_21790383 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_84279844666c6f4def3a518_97222746', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "page.tpl");
}
/* {block "content"} */
class Block_84279844666c6f4def3a518_97222746 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_84279844666c6f4def3a518_97222746',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo $_smarty_tpl->tpl_vars['html_content']->value;?>

<?php
}
}
/* {/block "content"} */
}
