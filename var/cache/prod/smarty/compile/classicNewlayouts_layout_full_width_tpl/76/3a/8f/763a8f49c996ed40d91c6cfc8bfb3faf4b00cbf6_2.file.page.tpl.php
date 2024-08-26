<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:05:43
  from '/home/asw200923/beta/themes/classicNew/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2f79a1c00_65278335',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '763a8f49c996ed40d91c6cfc8bfb3faf4b00cbf6' => 
    array (
      0 => '/home/asw200923/beta/themes/classicNew/templates/page.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2f79a1c00_65278335 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204059138966cbe2f799db37_66090659', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_190193585166cbe2f799e4c7_79441318 extends Smarty_Internal_Block
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
class Block_205639408566cbe2f799df89_82398129 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190193585166cbe2f799e4c7_79441318', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_83119569466cbe2f799ff96_24074810 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_143965840166cbe2f79a05e9_61649796 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_89993024366cbe2f799fb80_46638483 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block" >
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_83119569466cbe2f799ff96_24074810', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_143965840166cbe2f79a05e9_61649796', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_85877180466cbe2f79a1248_00454195 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_207088599266cbe2f79a0e80_61835922 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_85877180466cbe2f79a1248_00454195', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_204059138966cbe2f799db37_66090659 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_204059138966cbe2f799db37_66090659',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_205639408566cbe2f799df89_82398129',
  ),
  'page_title' => 
  array (
    0 => 'Block_190193585166cbe2f799e4c7_79441318',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_89993024366cbe2f799fb80_46638483',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_83119569466cbe2f799ff96_24074810',
  ),
  'page_content' => 
  array (
    0 => 'Block_143965840166cbe2f79a05e9_61649796',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_207088599266cbe2f79a0e80_61835922',
  ),
  'page_footer' => 
  array (
    0 => 'Block_85877180466cbe2f79a1248_00454195',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <section id="main">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_205639408566cbe2f799df89_82398129', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89993024366cbe2f799fb80_46638483', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_207088599266cbe2f79a0e80_61835922', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
