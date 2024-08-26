<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:08:15
  from '/home/asw200923/beta/themes/probusiness/templates/customer/_partials/order-detail-no-return.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc37efc69d36_72795327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fec833a2e91fde94c549f6008eee2ef927e4b9b' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/customer/_partials/order-detail-no-return.tpl',
      1 => 1724253301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc37efc69d36_72795327 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204068945066cc37efc48331_73790351', 'order_products_table');
?>

<?php }
/* {block 'order_products_table'} */
class Block_204068945066cc37efc48331_73790351 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_products_table' => 
  array (
    0 => 'Block_204068945066cc37efc48331_73790351',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        

    <div class="hidden-sm-down">
        <table id="order-products" class="table table-bordered">
            <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                <tr style="text-align: center;">
                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reference','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discount','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                </tr>
            </thead>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                <tr style="font-size: 18px;text-align: center;">
                    <td>
                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['reference'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <a style="display: block;" <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['download_link']))) {?>href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['download_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?>> <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 </a> 
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['customizations']) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customizations'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
                                <div class="customization">
                                    <a href="#" data-toggle="modal" data-target="#product-customizations-modal-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['id_customization'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a>
                                </div>
                                <div id="_desktop_product_customization_modal_wrapper_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['id_customization'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                    <div class="modal fade customization-modal" id="product-customizations-modal-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['id_customization'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                    <h4 class="modal-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customization']->value['fields'], 'field');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>
                                                        <div class="product-customization-line row">
                                                            <div class="col-sm-3 col-xs-4 label"> <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 </div>
                                                            <div class="col-sm-9 col-xs-8 value">
                                                                <?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'text') {?>
                                                                    <?php if ((int)$_smarty_tpl->tpl_vars['field']->value['id_module']) {?> <?php echo $_smarty_tpl->tpl_vars['field']->value['text'];?>

                                                                    <?php } else { ?> <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['text'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                                    <?php }?>
                                                                <?php } elseif ($_smarty_tpl->tpl_vars['field']->value['type'] == 'image') {?> <img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['image']['small']['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"> <?php }?>
                                                            </div>
                                                        </div>
                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>                    
                    </td>        
                    <td><?php echo htmlspecialchars((string) number_format($_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl']/(1-($_smarty_tpl->tpl_vars['product']->value['reduction_percent']/100)),2,'.',','), ENT_QUOTES, 'UTF-8');?>
 €</td>        
                    <td><?php echo htmlspecialchars((string) number_format($_smarty_tpl->tpl_vars['product']->value['reduction_percent'],0), ENT_QUOTES, 'UTF-8');?>
 %</td>
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['customizations']) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customizations'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
                                <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                        <?php }?>
                    </td>
                    <td><?php echo htmlspecialchars((string) number_format($_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'],2,'.',','), ENT_QUOTES, 'UTF-8');?>
 €</td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <tfoot>
                <?php if (($_smarty_tpl->tpl_vars['order']->value['totals']['total_including_tax']['amount']-$_smarty_tpl->tpl_vars['order']->value['totals']['total_excluding_tax']['amount']) > 0) {?>
                <tr style="font-size: 18px;text-align: center;" class="line-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['type'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                    <td colspan="5" style="text-align: right;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total taxes','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo htmlspecialchars((string) number_format($_smarty_tpl->tpl_vars['order']->value['totals']['total_including_tax']['amount']-$_smarty_tpl->tpl_vars['order']->value['totals']['total_excluding_tax']['amount'],2,'.',','), ENT_QUOTES, 'UTF-8');?>
 €</td>
                </tr>
                <?php }?>

                <tr style="font-size: 18px;text-align: center;" class="line-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['type'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                    <td colspan="5" style="text-align: right;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total paid','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</td>
                    <td><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="order-items hidden-md-up box">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="order-item">
            <div class="row">
              <div class="col-sm-5 desc">
                <div class="name"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['reference']) {?>
                  <div class="ref"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reference','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
: <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['reference'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['customizations']) {?>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customizations'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
                    <div class="customization">
                      <a href="#" data-toggle="modal" data-target="#product-customizations-modal-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['id_customization'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a>
                    </div>
                    <div id="_mobile_product_customization_modal_wrapper_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['id_customization'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                    </div>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
              </div>
              <div class="col-sm-7 qty">
                <div class="row">
                  <div class="col-xs-4 text-sm-left text-xs-left">
                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                  </div>
                  <div class="col-xs-4">
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['customizations']) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customizations'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
                        <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customization']->value['quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                      <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                    <?php }?>
                  </div>
                  <div class="col-xs-4 text-xs-right">
                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['total'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    
    <div class="order-totals hidden-md-up box">
        
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['subtotals'], 'line');
$_smarty_tpl->tpl_vars['line']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->do_else = false;
?>
        
            <?php if (($_smarty_tpl->tpl_vars['line']->value['value'])) {?>
                <div class="order-total row">
                    <div class="col-xs-8"><strong><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['line']->value['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['line']->value['type'], ENT_QUOTES, 'UTF-8');?>
</strong></div>
                    <div class="col-xs-4 text-xs-right"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['line']->value['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                </div>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <div class="order-total row">
            <div class="col-xs-8"><strong><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</strong></div>
            <div class="col-xs-4 text-xs-right"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
        </div>
    </div>
<?php
}
}
/* {/block 'order_products_table'} */
}
