<?php
/* Smarty version 4.3.4, created on 2024-08-16 15:36:23
  from '/home/asw200923/beta/themes/probusiness/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66bf63e74f99c9_01901807',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9588eac19a4f1ff2e4960ce6fc09a5e93a8bffa5' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/page.tpl',
      1 => 1719912706,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66bf63e74f99c9_01901807 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20007735866bf63e74f5b14_55732658', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_192399846066bf63e74f64c8_08387866 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_102350245766bf63e74f5f66_45312810 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_192399846066bf63e74f64c8_08387866', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_110146835066bf63e74f7df9_30156627 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_99427683166bf63e74f83e1_53670402 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_110782136766bf63e74f7a02_05563788 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_110146835066bf63e74f7df9_30156627', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_99427683166bf63e74f83e1_53670402', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_146192892266bf63e74f8ff8_95414504 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_156240646766bf63e74f8c43_03216240 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_146192892266bf63e74f8ff8_95414504', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_20007735866bf63e74f5b14_55732658 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_20007735866bf63e74f5b14_55732658',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_102350245766bf63e74f5f66_45312810',
  ),
  'page_title' => 
  array (
    0 => 'Block_192399846066bf63e74f64c8_08387866',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_110782136766bf63e74f7a02_05563788',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_110146835066bf63e74f7df9_30156627',
  ),
  'page_content' => 
  array (
    0 => 'Block_99427683166bf63e74f83e1_53670402',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_156240646766bf63e74f8c43_03216240',
  ),
  'page_footer' => 
  array (
    0 => 'Block_146192892266bf63e74f8ff8_95414504',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <div id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_102350245766bf63e74f5f66_45312810', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_110782136766bf63e74f7a02_05563788', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_156240646766bf63e74f8c43_03216240', 'page_footer_container', $this->tplIndex);
?>


  </div>

<?php
}
}
/* {/block 'content'} */
}
