<?php
/* Smarty version 4.3.4, created on 2024-08-21 12:22:42
  from '/home/asw200923/beta/themes/probusiness/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c5ce02276db4_05703515',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9588eac19a4f1ff2e4960ce6fc09a5e93a8bffa5' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/page.tpl',
      1 => 1724058881,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c5ce02276db4_05703515 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_141469676066c5ce02272fa7_23958294', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_163463189566c5ce02273913_67968498 extends Smarty_Internal_Block
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
class Block_80609230266c5ce022733c9_31703757 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_163463189566c5ce02273913_67968498', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_135351281566c5ce02275082_98721994 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_107939441766c5ce02275854_31084753 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_64300718366c5ce02274c98_47202199 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135351281566c5ce02275082_98721994', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_107939441766c5ce02275854_31084753', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_87721879266c5ce02276453_51979373 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_68733064366c5ce022760a9_81671364 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_87721879266c5ce02276453_51979373', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_141469676066c5ce02272fa7_23958294 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_141469676066c5ce02272fa7_23958294',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_80609230266c5ce022733c9_31703757',
  ),
  'page_title' => 
  array (
    0 => 'Block_163463189566c5ce02273913_67968498',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_64300718366c5ce02274c98_47202199',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_135351281566c5ce02275082_98721994',
  ),
  'page_content' => 
  array (
    0 => 'Block_107939441766c5ce02275854_31084753',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_68733064366c5ce022760a9_81671364',
  ),
  'page_footer' => 
  array (
    0 => 'Block_87721879266c5ce02276453_51979373',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <div id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_80609230266c5ce022733c9_31703757', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_64300718366c5ce02274c98_47202199', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_68733064366c5ce022760a9_81671364', 'page_footer_container', $this->tplIndex);
?>


  </div>

<?php
}
}
/* {/block 'content'} */
}
