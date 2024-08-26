<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:10:03
  from '/home/asw200923/beta/themes/probusiness/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc385b78f6e1_51916838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e655f52acefe67b2fc26ac3eff26e5747b3c18f1' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/_partials/footer.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc385b78f6e1_51916838 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>


<div  class="footer-container">
      <div style="max-width: 100%;" class="row">
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>

      </div>
    
    <div style="justify-content:center; display: flex ; max-width: 100%;" class="row">
    <div style="padding-top: 25px ;" class="col-md-12" >
      <p class="text-sm-center" style="font-weight: 600;font-size:12px;text-transform:uppercase;">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5000137166cc385b78eb89_78781261', 'copyright_link');
?>

      </p>
    </div>
  </div>
  
    </div>
  </div>
<?php }
/* {block 'copyright_link'} */
class Block_5000137166cc385b78eb89_78781261 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'copyright_link' => 
  array (
    0 => 'Block_5000137166cc385b78eb89_78781261',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'@ 2024 All Stars Distribution. All Rights Reserved.','d'=>'Shop.Theme.Copyrights'),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block 'copyright_link'} */
}
