<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4dee8a3f8_62505856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a5eb24827f9e72ed8ae6e90067eec550f9785125' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/cart.tpl',
      1 => 1721733928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'module:ets_onepagecheckout/views/templates/hook/cart-detailed.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/cart-detailed-totals.tpl' => 2,
    'module:ets_onepagecheckout/views/templates/hook/cart-voucher.tpl' => 1,
  ),
),false)) {
function content_66c6f4dee8a3f8_62505856 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="main">
    <div class="cart-grid row">
      <!-- Left Block: cart product informations & shpping -->
      <div class="cart-grid-body col-xs-12 col-lg-12">
        <!-- cart products detailed -->
        <div class="card cart-container">
            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, false);
?>
        </div>
        <div class="card cart-total-action ass">
            <div class="row">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3' || $_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_4') {?>
                    <div class="col-lg-12">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed-totals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, false);
?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-voucher.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                        </div>
                    </div>
                <?php } else { ?>
                                        <div class="col-lg-12">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed-totals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, true);
?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayShoppingCartFooterOnepageCheckout'),$_smarty_tpl ) );?>

      </div>
    </div>
</section><?php }
}
