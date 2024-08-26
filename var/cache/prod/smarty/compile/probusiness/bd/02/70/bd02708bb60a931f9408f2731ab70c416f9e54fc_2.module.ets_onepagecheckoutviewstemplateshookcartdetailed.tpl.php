<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from 'module:ets_onepagecheckoutviewstemplateshookcartdetailed.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4dee9b998_98276426',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd02708bb60a931f9408f2731ab70c416f9e54fc' => 
    array (
      0 => 'module:ets_onepagecheckoutviewstemplateshookcartdetailed.tpl',
      1 => 1723626948,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:ph_extend_support/views/templates/hook/checkout/cart-detailed-product-line.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/cart-detailed-product-line.tpl' => 1,
  ),
),false)) {
function content_66c6f4dee9b998_98276426 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),1=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="cart-overview js-cart" data-refresh-url="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('ets_onepagecheckout','order',array('ajax'=>true,'action'=>'refresh')),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <?php if ((isset($_smarty_tpl->tpl_vars['cart']->value['products'])) && $_smarty_tpl->tpl_vars['cart']->value['products']) {?>

    <div class="banner_checkout" style="max-width: 1350px;margin-bottom:2rem;">
      <img src="/img/asd/Content_pages/checkout/checkout_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" style="width: 100%;" />
    </div>

    <table class="col-lg-12">
      <thead style="background: #e7e7e7;">
        <tr>
          <th class="text-center cart_delete last_item">&nbsp;</th>
          <th class="text-center cart_product first_item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Product",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</th>
          <th class="text-center cart_description item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Description",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</th>
          <th class="text-center cart_unit item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Unit price",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</th>
          <th class="text-center cart_quantity item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Qty",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</th>
          <th class="text-center cart_total item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Total",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</th>
        </tr>
      </thead>
      <tfoot style="background: #e7e7e7;">
        <tr class="cart_total_price">
          <td colspan="5" class="text-right" style="padding-right:1rem;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Total (Ex VAT)",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</td>
          <td class="price" id="total_product" style="text-align: center;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['cart']->value['totals']['total_excluding_tax']['value'], ENT_QUOTES, 'UTF-8');?>
</td>
        </tr>
        <tr class="cart_total_tax">
          <td colspan="5" class="text-right" style="padding-right:1rem;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"VAT",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</td>
          <td class="price" id="total_tax" style="text-align: center;">€ <?php echo htmlspecialchars((string) smarty_modifier_number_format(($_smarty_tpl->tpl_vars['cart']->value['totals']['total_including_tax']['amount']-$_smarty_tpl->tpl_vars['cart']->value['totals']['total_excluding_tax']['amount']),2), ENT_QUOTES, 'UTF-8');?>
</td>
        </tr>
        <tr class="cart_total_price">
          <td colspan="5" class="total_price_container text-right" style="padding-right:1rem;"> <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Total",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</span></td>
          <td class="price" id="total_price_container" style="text-align: center;"> <span id="total_price"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['cart']->value['totals']['total']['value'], ENT_QUOTES, 'UTF-8');?>
</span>
          </td>
        </tr>
      </tfoot>

      <tbody>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                        <?php if (Module::isEnabled('ph_extend_support')) {?>
                  <?php $_smarty_tpl->_subTemplateRender('module:ph_extend_support/views/templates/hook/checkout/cart-detailed-product-line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
              <?php } else { ?>

                

                  <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed-product-line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>


                





              <?php }?>
                    <?php if (is_array($_smarty_tpl->tpl_vars['product']->value['customizations']) && Ets_onepagecheckout::validateArray($_smarty_tpl->tpl_vars['product']->value['customizations']) && smarty_modifier_count($_smarty_tpl->tpl_vars['product']->value['customizations']) > 1) {?><hr><?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
    </table>
    <?php } else { ?>
      <span class="no-items"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are no more items in your cart','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
    <?php }?>
</div><?php }
}
