<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from 'module:ets_onepagecheckoutviewstemplateshookcartdetailedtotals.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4deeb8100_84481158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4c8576fed80ee6dbb9ce3982054d8d364f7542e' => 
    array (
      0 => 'module:ets_onepagecheckoutviewstemplateshookcartdetailedtotals.tpl',
      1 => 1721733992,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:ets_onepagecheckout/views/templates/hook/cart-summary-totals.tpl' => 1,
  ),
),false)) {
function content_66c6f4deeb8100_84481158 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="cart-detailed-totals">
    <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-summary-totals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, false);
?>
</div><?php }
}
