<?php
/* Smarty version 4.3.4, created on 2024-08-23 11:26:05
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/product-add-to-cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c863bdcba323_11523026',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1872853401f34cf18e50e5c1c7fa92ce99ecba87' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/product-add-to-cart.tpl',
      1 => 1724408757,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c863bdcba323_11523026 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="product-add-to-cart js-product-add-to-cart">
    <?php if (!$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_123744708166c863bdcb1e72_31223035', 'product_quantity');
?>

        
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_56701186566c863bdcb5244_78041964', 'product_availability');
?>

        
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_50862212766c863bdcb8329_49258317', 'product_minimal_quantity');
?>

    <?php }?>
</div>
<?php }
/* {block 'product_quantity'} */
class Block_123744708166c863bdcb1e72_31223035 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_quantity' => 
  array (
    0 => 'Block_123744708166c863bdcb1e72_31223035',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="product-quantity clearfix">
                <div class="qty">
                    <input
                    type="text"
                    name="qty"
                    id="quantity_wanted"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity_wanted']) {?>
                    value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity_wanted'], ENT_QUOTES, 'UTF-8');?>
"
                    min="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"
                    <?php } else { ?>
                    value="1"
                    min="1"
                    <?php }?>
                    class="input-group"
                    aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
"
                    >
                </div>
                
                <div class="add">
                    <button
                    class="btn btn-primary add-to-cart"
                    data-button-action="add-to-cart"
                    type="submit"
                    <?php if (!$_smarty_tpl->tpl_vars['product']->value['add_to_cart_url']) {?>
                    disabled
                    <?php }?>
                    >
                        <i class="material-icons shopping-cart">&#xE547;</i>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

                    </button>
                </div>
                
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductActions','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            </div>
        <?php
}
}
/* {/block 'product_quantity'} */
/* {block 'product_availability'} */
class Block_56701186566c863bdcb5244_78041964 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_availability' => 
  array (
    0 => 'Block_56701186566c863bdcb5244_78041964',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        
            <span id="product-availability" class="js-product-availability">
                <?php if ($_smarty_tpl->tpl_vars['product']->value['show_availability'] && $_smarty_tpl->tpl_vars['product']->value['availability_message']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['availability'] == 'available') {?>
                        <i class="material-icons rtl-no-flip product-available">&#xE5CA;</i>
                        <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['availability_message'], ENT_QUOTES, 'UTF-8');?>

                    <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['availability'] == 'last_remaining_items') {?>
                                        <?php } else { ?>
                        <i class="material-icons product-unavailable">&#xE14B;</i>
                        <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['availability_message'], ENT_QUOTES, 'UTF-8');?>

                    <?php }?>
                <?php }?>
            </span>
            
        <?php
}
}
/* {/block 'product_availability'} */
/* {block 'product_minimal_quantity'} */
class Block_50862212766c863bdcb8329_49258317 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_minimal_quantity' => 
  array (
    0 => 'Block_50862212766c863bdcb8329_49258317',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <p class="product-minimal-quantity js-product-minimal-quantity">
                <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] > 1) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum purchase order quantity for the product is %quantity%.','d'=>'Shop.Theme.Checkout','sprintf'=>array('%quantity%'=>$_smarty_tpl->tpl_vars['product']->value['minimal_quantity'])),$_smarty_tpl ) );?>

                <?php }?>
            </p>
        <?php
}
}
/* {/block 'product_minimal_quantity'} */
}
