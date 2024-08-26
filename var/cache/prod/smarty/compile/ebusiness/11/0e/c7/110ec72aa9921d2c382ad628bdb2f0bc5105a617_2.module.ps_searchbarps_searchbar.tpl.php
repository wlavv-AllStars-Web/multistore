<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from 'module:ps_searchbarps_searchbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe284124981_68173531',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '110ec72aa9921d2c382ad628bdb2f0bc5105a617' => 
    array (
      0 => 'module:ps_searchbarps_searchbar.tpl',
      1 => 1719912747,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe284124981_68173531 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="search_widget" class="search-widget desktop" data-search-controller-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
	            <form method="get" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
" class="d-none d-lg-flex active" style="background-color: #fff;width:max-content;">
		<input type="hidden" name="controller" value="search">
		<input type="text" name="s" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_string']->value, ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Buscar','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" style="background: #fff !important;width:247px;">
		<button type="submit">
			<i class="fa-solid fa-magnifying-glass"></i>
            		</button>
	</form>
</div>

<div id="search_widget" class="search-widget mobile" data-search-controller-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
" >
  <div id="searchbar" style="display: none;">
	<form class="active mobile d-lg-none" method="get" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
" >
		<input type="hidden" name="controller" value="search">
		<input type="text" name="s" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['search_string']->value, ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Buscar','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" style="width: 100%; height: 44px; border: 0px; padding-left: 12px;">
		<button type="submit" style="border-radius: 0;   background-color: #dd1312;   border: 0px;   padding-left: 17px;   padding-right: 17px;">
			<i class="fa-solid fa-magnifying-glass"></i>
					</button>
	</form>
	</div>
	</div>
<?php }
}
