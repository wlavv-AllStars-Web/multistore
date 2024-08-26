<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:21:01
  from '/home/asw200923/beta/mails/_partials/order_conf_product_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4ed7a4348_69727488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '399db5a366cdc2607bbe81938e4c602c6d350fd0' => 
    array (
      0 => '/home/asw200923/beta/mails/_partials/order_conf_product_list.tpl',
      1 => 1723824391,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4ed7a4348_69727488 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
    <tr>
    	<td style="border:1px solid #D6D4D4;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454"> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
  </font>
    	</td>
    	<td style="border:1px solid #D6D4D4;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454">
    			<strong><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</strong>
    			<?php if (count($_smarty_tpl->tpl_vars['product']->value['customization']) == 1) {?>
    				<br>
    				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customization'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
    					<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['customization']->value['customization_text'], ENT_QUOTES, 'UTF-8');?>

    				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    			<?php }?>
    
    			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl ) );?>

    		</font>
    	</td>
    	<td style="border:1px solid #D6D4D4; text-align: center;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454"> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['unit_price'], ENT_QUOTES, 'UTF-8');?>
 </font>
    	</td>
    	<td style="border:1px solid #D6D4D4; text-align: center;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454"> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
   </font>
    	</td>
    	<td style="border:1px solid #D6D4D4; text-align: center;">
    	    <font size="3" face="Open-sans, sans-serif" color="#555454"> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
      </font>
    	</td>
    </tr>
    <?php if (count($_smarty_tpl->tpl_vars['product']->value['customization']) > 1) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customization'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
            <tr>
                <td colspan="3" style="border:1px solid #D6D4D4;text-align: center;">
                    <font size="3" face="Open-sans, sans-serif" color="#555454"> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['customization']->value['customization_text'], ENT_QUOTES, 'UTF-8');?>
 </font>
                </td>
                <td style="border:1px solid #D6D4D4; text-align: center;">
                    <font size="3" face="Open-sans, sans-serif" color="#555454" style="text-align: center;">
                    <?php if (count($_smarty_tpl->tpl_vars['product']->value['customization']) > 1) {?> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['customization']->value['customization_quantity'], ENT_QUOTES, 'UTF-8');?>
 <?php }?>
                    </font>
                </td>
                <td style="border:1px solid #D6D4D4;"></td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
