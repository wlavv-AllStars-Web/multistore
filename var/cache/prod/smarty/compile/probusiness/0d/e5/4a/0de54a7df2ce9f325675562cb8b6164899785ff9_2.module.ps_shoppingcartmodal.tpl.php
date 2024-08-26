<?php
/* Smarty version 4.3.4, created on 2024-08-23 11:26:02
  from 'module:ps_shoppingcartmodal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c863ba1ee973_80615098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0de54a7df2ce9f325675562cb8b6164899785ff9' => 
    array (
      0 => 'module:ps_shoppingcartmodal.tpl',
      1 => 1723624903,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c863ba1ee973_80615098 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>
<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-lg-6 divide-right">
          <h4 class="modal-title h6 text-xs-center" id="myModalLabel" style="display: flex;align-items:center;"><i class="material-icons" style="background: #19b719;width:2rem;height:2rem;border-radius:50%;display:flex;justify-content:center;align-items:center;">&#xE876;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product successfully added to your shopping cart','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
</h4>
        </div>
        <div class="col-lg-6 modal-header-right" style="padding-left: calc(2.5rem + 15px);font-weight:600;">
          <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] > 1) {?>
            <p class="cart-products-count"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are %products_count% items in your cart.','sprintf'=>array('%products_count%'=>$_smarty_tpl->tpl_vars['cart']->value['products_count']),'d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
</p>
          <?php } else { ?>
            <p class="cart-products-count"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is %product_count% item in your cart.','sprintf'=>array('%product_count%'=>$_smarty_tpl->tpl_vars['cart']->value['products_count']),'d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
</p>
          <?php }?>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 divide-right">
            <div class="row" style="display: flex;align-items:center;">
              <div class="col-md-4 col-sm-12 col-xs-12">
                                <img class="product-image" src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer'],'thumb'), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['cover']['legend'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['cover']['legend'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" itemprop="image" style="width: 100%;max-width:125px;">
              </div>
              <div class="col-md-8  col-sm-12 col-xs-12 details-product-modal">
                            
                <h6 class="h6 product-name"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h6>
                <span><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Price",'d'=>"Shop.Theme.Modal"),$_smarty_tpl ) );?>
</strong>: €<?php echo htmlspecialchars((string) smarty_modifier_number_format($_smarty_tpl->tpl_vars['product']->value['price_with_reduction_without_tax'],2), ENT_QUOTES, 'UTF-8');?>
</span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl ) );?>

                <span><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Reference",'d'=>"Shop.Theme.Modal"),$_smarty_tpl ) );?>
</strong>: <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['reference'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['attributes'], 'property_value', false, 'property');
$_smarty_tpl->tpl_vars['property_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['property']->value => $_smarty_tpl->tpl_vars['property_value']->value) {
$_smarty_tpl->tpl_vars['property_value']->do_else = false;
?>
                  <span><strong><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['property']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</strong>: <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['property_value']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <p><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity:','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
</strong>&nbsp;<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['cart_quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="cart-content">
                              <p><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
 :</strong>&nbsp;<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['cart']->value['totals']['total_excluding_tax']['value'], ENT_QUOTES, 'UTF-8');?>
 (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"ExVAT",'d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
)</p>
              <p><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'VAT','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
 :</strong>&nbsp;€<?php echo htmlspecialchars((string) smarty_modifier_number_format(($_smarty_tpl->tpl_vars['cart']->value['totals']['total']['amount']-$_smarty_tpl->tpl_vars['cart']->value['totals']['total_excluding_tax']['amount']),2), ENT_QUOTES, 'UTF-8');?>
</p>
              <p>
                <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
  :</strong>&nbsp;
                <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['shipping']['amount'],'html','UTF-8' )) > 0) {?> 
                                    (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"To be defined",'d'=>"Shop.Theme.Modal"),$_smarty_tpl ) );?>
)
                <?php } else { ?> 
                  (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"To be defined",'d'=>"Shop.Theme.Modal"),$_smarty_tpl ) );?>
)
                <?php }
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCheckoutSubtotalDetails','subtotal'=>$_smarty_tpl->tpl_vars['cart']->value['subtotals']['shipping']),$_smarty_tpl ) );?>
</p>
              <p><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
 :</strong>&nbsp;<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['products']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>

                                          
                                                                                    
            </div>
          </div>

          <div class="col-lg-12 container-modal-btns-shopping">
            <div class="cart-content-btn col-lg-6">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue shopping','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
</button>
            </div>
            <div class="cart-content-btn col-lg-6">
              <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order_url']->value, ENT_QUOTES, 'UTF-8');?>
" class="btn btn-primary"><i class="material-icons rtl-no-flip">&#xE876;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Proceed to checkout','d'=>'Shop.Theme.Modal'),$_smarty_tpl ) );?>
</a>
            </div>
          </div>

        </div>
      </div>
          </div>
  </div>
</div>
<?php }
}
