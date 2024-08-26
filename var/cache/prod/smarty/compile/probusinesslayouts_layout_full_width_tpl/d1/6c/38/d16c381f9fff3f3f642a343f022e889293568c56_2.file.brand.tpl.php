<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:09:56
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/miniatures/brand.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc38542db293_65014607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd16c381f9fff3f3f642a343f022e889293568c56' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/miniatures/brand.tpl',
      1 => 1722531684,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc38542db293_65014607 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_146514994166cc38542d67d9_47354634', 'brand_miniature_item');
?>

<?php }
/* {block 'brand_miniature_item'} */
class Block_146514994166cc38542d67d9_47354634 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'brand_miniature_item' => 
  array (
    0 => 'Block_146514994166cc38542d67d9_47354634',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if (Context::getContext()->customer->logged) {?>
    <li class="brand_logged col-lg-3 col-md-4 col-sm-6" style="margin-top: 2rem;">
      <div class="brand_content_item_logged" style="border: 1px solid #0273eb;">
          <div class="brand-infos">
            <h3 style="text-align: center;background:#0273eb;color:#fff;padding: 5px;font-size:13px;line-height:18px;font-weight:700;"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h3>
          </div>
          <div class="brand-img" >
                        <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="display:flex;justify-content:center;align-items:center;"><img src="/img/asd/150px/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['brand']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width: 100%;max-width:300px;height:auto;" width="300" height="150"></a>
            
          </div>
          
      </div>
    </li>
  <?php } else { ?>
    
    <li class="brand_logged col-lg-3 col-md-4 col-sm-6" style="margin-top: 2rem;">
      <div class="brand_content_item_logged" style="border: 1px solid #0273eb;">
          <div class="brand-infos">
            <h3 style="text-align: center;background:#0273eb;color:#fff;padding: 5px;font-size:13px;line-height:18px;font-weight:700;"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h3>
          </div>
          <div class="brand-img" >
                        <div style="display:flex;justify-content:center;align-items:center;">
            <img src="/img/asd/150px/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['brand']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width: 100%;max-width:300px;height:auto;" width="300" height="150">
            </div>
            
          </div>
          
      </div>
    </li>
  <?php }
}
}
/* {/block 'brand_miniature_item'} */
}
