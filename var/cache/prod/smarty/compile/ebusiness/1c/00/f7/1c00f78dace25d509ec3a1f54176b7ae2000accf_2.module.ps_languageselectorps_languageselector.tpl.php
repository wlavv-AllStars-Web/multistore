<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from 'module:ps_languageselectorps_languageselector.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe284118d08_24378586',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c00f78dace25d509ec3a1f54176b7ae2000accf' => 
    array (
      0 => 'module:ps_languageselectorps_languageselector.tpl',
      1 => 1719912747,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe284118d08_24378586 (Smarty_Internal_Template $_smarty_tpl) {
?>

 <div class="desktop" id="_desktop_language_selector">
   <div style="display-flex;" class="language-selector-wrapper">
       <div class="language-selector dropdown js-dropdown">
       <div data-toggle="dropdown" class=" btn-unstyle lang lgh"  style="display: flex;flex-direction:row;align-items:center;gap:5px;"  aria-haspopup="true" aria-expanded="false" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Language dropdown','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
">
       <img style="width:16px; height:11px;vertical-align: inherit;" src="/img/tmp/lang_mini_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['current_language']->value['id_lang'], ENT_QUOTES, 'UTF-8');?>
_3.jpg?time=1699550058">
       <span style="font-weight: 600;"><?php echo htmlspecialchars((string) strtoupper($_smarty_tpl->tpl_vars['current_language']->value['iso_code']), ENT_QUOTES, 'UTF-8');?>
</span>
         <i class="material-icons expand-more">&#xE5C5;</i>
       </div>
       <ul class="dropdown-menu" style="margin-top: -1px;margin-left: -46px; background-color:#121212; color: white " aria-labelledby="language-selector-label ">
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
           <li style="display: flex; " class=" selector <?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang'] == $_smarty_tpl->tpl_vars['current_language']->value['id_lang']) {?> current  <?php }?>">
             <img src="/img/tmp/lang_mini_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['id_lang'], ENT_QUOTES, 'UTF-8');?>
_3.jpg?time=1699550058" style="width:16px; height:11px" class="languageimg">
             <a style="margin-left: 8px; " href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('entity'=>'language','id'=>$_smarty_tpl->tpl_vars['language']->value['id_lang']),$_smarty_tpl ) );?>
" class="dropdown-item" data-iso-code="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['name_simple'], ENT_QUOTES, 'UTF-8');?>
</a>
           </li>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       </ul>
     </div>
   </div>
 </div>

 <div class="mobile" id="_desktop_language_selector">
   <div class="language-selector-wrapper">
       <ul aria-labelledby="language-selector-label ">
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
           <li style="display: flex; " class=" selector <?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang'] == $_smarty_tpl->tpl_vars['current_language']->value['id_lang']) {?> current  <?php }?>">
            <a style="margin-left: 8px; " href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('entity'=>'language','id'=>$_smarty_tpl->tpl_vars['language']->value['id_lang']),$_smarty_tpl ) );?>
" class="dropdown-item" data-iso-code="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
              <img src="/img/tmp/lang_mini_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['id_lang'], ENT_QUOTES, 'UTF-8');?>
_3.jpg?time=1699550058" style="width:48px; height:30px;border-radius: 0.25rem;" class="languageimg">
             </a>
           </li>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       </ul>
     </div>
   </div>
 </div>

<?php }
}
