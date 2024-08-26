<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:09:31
  from '/home/asw200923/beta/themes/probusiness/templates/errors/not-found.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc383b45b599_61252097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8038c92943e28ab4361d204e81df84cd9bea83b' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/errors/not-found.tpl',
      1 => 1723651490,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc383b45b599_61252097 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<section id="content" class="page-content page-not-found">
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_96924740066cc383b4578e4_34196108', 'page_content');
?>

</section>

<style>

  #pagenotfound #wrapper {
    display: flex;
    align-items: center;
  }

  #pagenotfound .page-content.page-not-found{
    background: url('/img/asd/Content_pages/error/error_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp') !important;
    width: 600px !important;
    height: 400px;
    position: relative;
    display: flex;
    align-items: end;
    padding: 0 !important;
    margin-bottom: 0 !important;
    max-width: unset !important;
  }

  #pagenotfound .page-content #search_widget{
    position: absolute;
    margin: 0;
    padding: 1rem;
  }

  #pagenotfound .page-content #search_widget form input{
    background: #fff;
    color: #1d3558;
    box-shadow: 2px 2px 11px 0 rgba(0,0,0,.4);
  }

  #pagenotfound .page-content #search_widget form input::placeholder{
    color: #1d3558;
    opacity: 0.8;
  }

  #pagenotfound .page-content #search_widget form input:focus-visible{
    outline: none;
  }

  #pagenotfound .page-content #search_widget form button{
    color: #1d3558;
  }

  #search #wrapper {
    display: flex;
    align-items: center;
  }

  #search .page-content.page-not-found{
    background: url('/img/asd/Content_pages/error/error_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp') !important;
    width: 600px !important;
    height: 400px;
    position: relative;
    display: flex;
    align-items: end;
    padding: 0 !important;
    margin-bottom: 0 !important;
    max-width: unset !important;
    justify-content: end;
  }

  #search .page-content #search_widget{
    position: absolute;
    margin: 0;
    padding: 1rem;
  }

  #search .page-content #search_widget form input{
    background: #fff;
    color: #1d3558;
    box-shadow: 2px 2px 11px 0 rgba(0,0,0,.4);
  }

  #search .page-content #search_widget form input::placeholder{
    color: #1d3558;
    opacity: 0.8;
  }

  #search .page-content #search_widget form input:focus-visible{
    outline: none;
  }

  #search .page-content #search_widget form button{
    color: #1d3558;
  }

</style>
<?php }
/* {block 'search'} */
class Block_36771015266cc383b457df5_84520230 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displaySearch'),$_smarty_tpl ) );?>

      <?php
}
}
/* {/block 'search'} */
/* {block 'hook_not_found'} */
class Block_31378254266cc383b458855_27183891 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNotFound'),$_smarty_tpl ) );?>

      <?php
}
}
/* {/block 'hook_not_found'} */
/* {block 'page_content'} */
class Block_96924740066cc383b4578e4_34196108 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_96924740066cc383b4578e4_34196108',
  ),
  'search' => 
  array (
    0 => 'Block_36771015266cc383b457df5_84520230',
  ),
  'hook_not_found' => 
  array (
    0 => 'Block_31378254266cc383b458855_27183891',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_36771015266cc383b457df5_84520230', 'search', $this->tplIndex);
?>


      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_31378254266cc383b458855_27183891', 'hook_not_found', $this->tplIndex);
?>


  <?php
}
}
/* {/block 'page_content'} */
}
