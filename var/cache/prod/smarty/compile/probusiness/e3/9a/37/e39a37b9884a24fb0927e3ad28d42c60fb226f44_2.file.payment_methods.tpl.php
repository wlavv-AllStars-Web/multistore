<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:48
  from '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/payment_methods.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4e02ed179_55096610',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e39a37b9884a24fb0927e3ad28d42c60fb226f44' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/modules/ets_onepagecheckout/views/templates/hook/payment_methods.tpl',
      1 => 1723027215,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4e02ed179_55096610 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="checkout-personal-information-step" class="checkout-step -reachable -complete -clickable"></div>
<section id="checkout-payment-step" class="checkout-step -current -reachable js-current-step">
    <div class="content">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPaymentTop'),$_smarty_tpl ) );?>

        <div class="payment-options" style="display: flex;">
            <form></form>
            <?php if ($_smarty_tpl->tpl_vars['payment_methods']->value) {?>
                                     
               
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_methods']->value, 'payment_method', false, 'module_name');
$_smarty_tpl->tpl_vars['payment_method']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module_name']->value => $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->do_else = false;
?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_method']->value, 'module');
$_smarty_tpl->tpl_vars['module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->do_else = false;
?>
                        <?php
$_smarty_tpl->tpl_vars['__smarty_section_dup'] = new Smarty_Variable(array());
if (true) {
for ($__section_dup_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] = 0; $__section_dup_0_iteration <= 2; $__section_dup_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']++){
?>
                        <div class="ets_payment_method col-lg-6" style="display: flex;flex-direction:column;justify-content:center;align-items:center;" >
                            <div class="img-module" idform="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>2<?php } else { ?>1<?php }?>" onclick="setPaymentMethod(this)">
                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 1) {?>
                                <img src="/img/asd/Content_pages/payment/bankwire.png?t=113">
                                <div class="payment-description">
                                    <div class="title-payment"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"BANK TRANSFER",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</div>
                                    <div class="text-payment">( <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"PROCESSING UP TO 48H",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
 )</div>
                                    <div class="text-fee">( <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"No fees",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
 )</div>
                                </div>
                                                            <?php } else { ?>
                                <img src="/img/asd/Content_pages/payment/worldline.webp?t=113">
                                <div class="payment-description">
                                    <div class="title-payment"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"CREDIT CARD",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</div>
                                    <div class="text-payment">( <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"IMMEDIATE PROCESSING",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
 )</div>
                                    <div class="text-fee">( +1% <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"fees",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
 )</div>
                                </div>
                                                            <?php }?>
                            </div>
                            <div id="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-container" class="payment-option col-lg-6 clearfix" >
                                <span class="custom-radio float-xs-left" >
                                                                          <input id="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>payment-option-2<?php } else { ?>payment-option-1<?php }?>"
                                            class="ps-shown-by-js <?php if ($_smarty_tpl->tpl_vars['module']->value['module_name']) {
if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module']->value['module_name']) {?>checked<?php }
} else {
if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module_name']->value) {?>checked<?php }
}?>"
                                            data-module-name="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>creditcard<?php } else {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" name="payment-option" type="radio"
                                            value="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>creditcard<?php } else {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>"
                                            
                                     />    

                                    
                                    <span></span>
                                </span>
                            
                                
                                <form method="GET" class="ps-hidden-by-js" style="display:none;">
                                    <button class="ps-hidden-by-js" type="submit" name="select_payment_option" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                                    </button>
                                </form>
                                <label for="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                    <span>
                                        <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_PAYMENT_LOGO_ENABLED']->value) {
if ((isset($_smarty_tpl->tpl_vars['module']->value['logo'])) && $_smarty_tpl->tpl_vars['module']->value['logo']) {?><img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['logo'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width:40px" /><?php }
}?>
                                        <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['call_to_action_text'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                    </span>
                                </label>
                            </div>

                            <div id="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>pay-with-payment-option-2-form<?php } else { ?>pay-with-payment-option-1-form<?php }?>" class="js-payment-option-form ps-hidden " <?php if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module']->value['module_name']) {?>  style="color:red; display:block"<?php } else {
}?>>
                                <?php if ($_smarty_tpl->tpl_vars['module']->value['form']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['module']->value['form'];?>

                                <?php } else { ?>
                                    <form id="payment-form" method="POST" action="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['action'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                        <?php if ((isset($_smarty_tpl->tpl_vars['module']->value['inputs'])) && $_smarty_tpl->tpl_vars['module']->value['inputs']) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['module']->value['inputs'], 'input');
$_smarty_tpl->tpl_vars['input']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['input']->value) {
$_smarty_tpl->tpl_vars['input']->do_else = false;
?>
                                                <input<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?> <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> />
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <?php }?>
                                        <button id="pay-with-<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>payment-option-2<?php } else { ?>payment-option-1<?php }?>"  type="submit"></button>
                                        <input type="hidden" nameinput="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>creditcard<?php } else {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" name="payment_id" value="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_dup']->value['index'] : null) == 0) {?>2<?php } else { ?>1<?php }?>" />
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    <?php
}
}
?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                
            <?php } else { ?>
                <div class="alert alert-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unfortunately, there are no payment methods available.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</div>
            <?php }?>
        </div>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPaymentByBinaries'),$_smarty_tpl ) );?>

    </div>
</section>


<?php echo '<script'; ?>
>

function setPaymentMethod(form) {
    const idform = form.getAttribute("idform")
    // console.log(idform)
    let moduleName;
    if(idform == 1){
        moduleName = 'ps_wirepayment'
    }else{
        moduleName = 'creditcard' 
    }
    // console.log(moduleName)
    const radio = document.querySelector("input[value="+moduleName+"]")
    // radio.checked = true;
    radio.click()

    // const formPayment = document.querySelector(`#pay-with-payment-option-`+idformGlobal+`-form form`)
    // formPayment.submit()


    const disabledInputs = document.querySelectorAll("#invoice-addresses .invoice_address input[disabled],#invoice-addresses .invoice_address select[disabled],#invoice-addresses .invoice_address textarea[disabled]");
    
    disabledInputs.forEach(element => {
        element.removeAttribute("disabled")
    });



    document.querySelector("button[name='submitCompleteMyOrder']").click();
    // document.querySelector("#form_ets_onepagecheckout").submit();

    // formPayment.submit()
}

document.addEventListener("DOMContentLoaded", (e) => {
    // document.querySelector(".block-shipping .delivery-options .delivery-option input[type='radio'][value='5,']").checked = true;
    const errorContainer = document.querySelector("#onepagecheckout-information-errros");

    const observer = new MutationObserver(() => {
        const errors = errorContainer.children;
        console.log(errors);
        if (errors.length > 0) {
            const disabledInputs = document.querySelectorAll("#invoice-addresses .invoice_address input,#invoice-addresses .invoice_address select,#invoice-addresses .invoice_address textarea");
            
            disabledInputs.forEach(element => {
                element.setAttribute("disabled", "disabled");
            });
        } else {
            // console.log("n«ªo tem"); // Does not have children

        }
    });

    // Start observing the error container for changes in its children
    observer.observe(errorContainer, { childList: true });
    
    // const selecteInputCountry = document.querySelector(".shipping_address #shipping_address_id_country");
    
    // selecteInputCountry.addEventListener("change", (e) => {
    //     document.querySelector(".block-shipping .delivery-options .delivery-option:nth-child(2) input[type='radio']").checked = true;
    // })
});


<?php echo '</script'; ?>
><?php }
}
