<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:09:56
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/brands.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc38540ee6e4_90026572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '506ad7086c67c4426d1cb6f1624156c8adbec8d2' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/brands.tpl',
      1 => 1721145902,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/miniatures/brand.tpl' => 1,
  ),
),false)) {
function content_66cc38540ee6e4_90026572 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>
 

 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_210350727266cc38540e65f8_31521864', 'content');
?>

 <?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'brand_miniature'} */
class Block_149609271666cc38540e8a29_44464378 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

       <ul class="list_manu row">
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brands']->value, 'brand');
$_smarty_tpl->tpl_vars['brand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
$_smarty_tpl->tpl_vars['brand']->do_else = false;
?>
           <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/brand.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('brand'=>$_smarty_tpl->tpl_vars['brand']->value), 0, true);
?>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       </ul>
     <?php
}
}
/* {/block 'brand_miniature'} */
/* {block 'content'} */
class Block_210350727266cc38540e65f8_31521864 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_210350727266cc38540e65f8_31521864',
  ),
  'brand_miniature' => 
  array (
    0 => 'Block_149609271666cc38540e8a29_44464378',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section id="main">
     <div id="brands-page">
       <div class="brands_banner">
         <img class="desktop" src="/img/asd/dealers/headers/linecard_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="brands_banner" width="1350" height="300" />
         <img class="mobile" src="/img/asd/dealers/headers/linecard_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="brands_banner" width="390" height="90" />
       </div>
     <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_149609271666cc38540e8a29_44464378', 'brand_miniature', $this->tplIndex);
?>

     </div>
   </section>
 
 <?php
}
}
/* {/block 'content'} */
}
