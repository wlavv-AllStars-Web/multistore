<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/shippings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4ded96404_24858073',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40251be20e04506d063a6d72af96a7678691facd' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/shippings.tpl',
      1 => 1723030152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4ded96404_24858073 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="delivery-options-list shipping_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['opc_layout']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <div id="hook-display-before-carrier">
        <?php if ((isset($_smarty_tpl->tpl_vars['hookDisplayBeforeCarrier']->value))) {?>
            <?php echo $_smarty_tpl->tpl_vars['hookDisplayBeforeCarrier']->value;?>

        <?php }?>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['delivery_option_list']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['delivery_option_list']->value, 'option_list', false, 'id_address');
$_smarty_tpl->tpl_vars['option_list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_address']->value => $_smarty_tpl->tpl_vars['option_list']->value) {
$_smarty_tpl->tpl_vars['option_list']->do_else = false;
?>
            <div class="delivery-options">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['option_list']->value, 'option', false, 'key');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
                    <div class="row delivery-option">
                        <label class="col-sm-12 delivery-option-2" for="delivery_option_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['id_carrier'] )), ENT_QUOTES, 'UTF-8');?>
">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 left_content">
                                    <span class="custom-radio">
                <input id="delivery_option_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['id_carrier'] )), ENT_QUOTES, 'UTF-8');?>
" name="delivery_option[<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_address']->value )), ENT_QUOTES, 'UTF-8');?>
]" <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['id_carrier'] )) == 4) {?> checked <?php } else { ?> <?php }?>  value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"  type="radio"<?php if ($_smarty_tpl->tpl_vars['option']->value['default'] == 1) {?>checked<?php }?> />
                                        <span></span>
                                    </span>
                                    <div class="carrier-name-img">
                                        <span class="h6 carrier-name">
                                            <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_SHIPPING_LOGO_ENABLED']->value && $_smarty_tpl->tpl_vars['option']->value['logo'] && ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2' || $_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_4')) {?>
                                                <img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['logo'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width:40px"  />
                                            <?php }?>
                                            <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                        </span>
                                        <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_SHIPPING_LOGO_ENABLED']->value && $_smarty_tpl->tpl_vars['option']->value['logo'] && $_smarty_tpl->tpl_vars['opc_layout']->value != 'layout_2' && $_smarty_tpl->tpl_vars['opc_layout']->value != 'layout_4') {?>
                                            <div class="" style="text-align: left;">
                                                <img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['logo'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width:50px"  />
                                            </div>
                                        <?php }?>

                                    </div>

                                </div>
                                <div class="col-sm-6 col-xs-12 right_content">
                                    <div class="col-xs-12">
                                        <span class="carrier-price">
                                        <?php if ($_smarty_tpl->tpl_vars['option']->value['total_price_with_tax'] && ((isset($_smarty_tpl->tpl_vars['option']->value['is_free'])) && $_smarty_tpl->tpl_vars['option']->value['is_free'] == 0)) {?>
                							<?php if ($_smarty_tpl->tpl_vars['use_taxes']->value == 1) {?>
                							    <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
                								    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['option']->value['total_price_without_tax']),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Tax excl.)','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                							    <?php } else { ?>
                								    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['option']->value['total_price_with_tax']),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Tax incl.)','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                							    <?php }?>
                							<?php } else { ?>
                							    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['option']->value['total_price_without_tax']),$_smarty_tpl ) );?>

                							<?php }?>
            						    <?php } else { ?>
            							     <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

            						    <?php }?>
                                        
                                        </span>
                                    </div>
                                    <div class="col-xs-12">
                                        <span class="carrier-delay"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['delay'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <?php if ((isset($_smarty_tpl->tpl_vars['option']->value['extraContent'])) && $_smarty_tpl->tpl_vars['option']->value['extraContent']) {?>
                        <div class="row carrier-extra-content extends_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['id_carrier'] )), ENT_QUOTES, 'UTF-8');?>
" <?php if (!in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['delivery_option_selected']->value)) {?> style="display:none;"<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['option']->value['extraContent'];?>

                        </div>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php } else { ?>
        <div class="alert alert-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unfortunately, there are no carriers available for your delivery address.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</div>
    <?php }?>
    <div id="hook-display-after-carrier">
        <?php if ((isset($_smarty_tpl->tpl_vars['hookDisplayAfterCarrier']->value))) {?>
            <?php echo $_smarty_tpl->tpl_vars['hookDisplayAfterCarrier']->value;?>

        <?php }?>
    </div>
</div><?php }
}
