<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/invoice_address.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4ded43077_60721295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2ff3ffa6197e8573c66a337904b2b0859832710' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/invoice_address.tpl',
      1 => 1722935506,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4ded43077_60721295 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-lg-12 flex" style="align-items: center;">
        <div class="title" display="block" style="margin: 0;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Billing address','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</div>
            <a class="btn btn-default btn-contact-us-link" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('contact'), ENT_QUOTES, 'UTF-8');?>
" title="Contact us to update">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Contact us to update",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>

        </a>
    </div>
<?php if ($_smarty_tpl->tpl_vars['list_address']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['use_address']->value) {?>
    <div class="form-group row p_0">
        <label class="col-md-4 form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Use address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
        <div class="col-md-8 opc_field_right">
            <div class="shipping_address_form">
                <div class="ets_opc_select">
                    <span class="ets_opc_select_arrow">
                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                    </span>
                    <select id="use_invoice_address" name="invoice_address[id_address]" class="form-control" data-type="invoice_address">
                        <option value="" disabled="" selected="">-- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'please choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 --</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_address']->value, 'address');
$_smarty_tpl->tpl_vars['address']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
$_smarty_tpl->tpl_vars['address']->do_else = false;
?>
                            <option value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['address']->value['id_address'] )), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['address']->value['id_address'] == $_smarty_tpl->tpl_vars['id_address']->value) {?> selected="selected"<?php }?>><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address']->value['alias'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <option value="new"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter new address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</option>                        
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <input id="use_invoice_address" type="hidden" name="invoice_address[id_address]" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_address']->value )), ENT_QUOTES, 'UTF-8');?>
" data-type="invoice_address" />
    <?php }
}
echo $_smarty_tpl->tpl_vars['address_form']->value;
}
}
