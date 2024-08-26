<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:47
  from '/home/asw200923/beta/themes/ebusiness/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe283d94b28_23895088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7420a3f99c0e34f3f7c15f6cf2ac2259926f0f51' => 
    array (
      0 => '/home/asw200923/beta/themes/ebusiness/templates/page.tpl',
      1 => 1719912706,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe283d94b28_23895088 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_203564923466cbe283d908b1_26451535', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_127817584966cbe283d91359_94905598 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h2><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h2>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_157336426466cbe283d90dc8_41568184 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127817584966cbe283d91359_94905598', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_41539127566cbe283d92c03_61959118 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_11136819366cbe283d93190_77009986 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_204300492866cbe283d92805_24971209 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block" style="width:100%">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_41539127566cbe283d92c03_61959118', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11136819366cbe283d93190_77009986', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_26823648966cbe283d93da9_15309101 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_175564786266cbe283d939e6_74468864 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26823648966cbe283d93da9_15309101', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_203564923466cbe283d908b1_26451535 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_203564923466cbe283d908b1_26451535',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_157336426466cbe283d90dc8_41568184',
  ),
  'page_title' => 
  array (
    0 => 'Block_127817584966cbe283d91359_94905598',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_204300492866cbe283d92805_24971209',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_41539127566cbe283d92c03_61959118',
  ),
  'page_content' => 
  array (
    0 => 'Block_11136819366cbe283d93190_77009986',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_175564786266cbe283d939e6_74468864',
  ),
  'page_footer' => 
  array (
    0 => 'Block_26823648966cbe283d93da9_15309101',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <div id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_157336426466cbe283d90dc8_41568184', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204300492866cbe283d92805_24971209', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175564786266cbe283d939e6_74468864', 'page_footer_container', $this->tplIndex);
?>


  </div>

<?php
}
}
/* {/block 'content'} */
}
