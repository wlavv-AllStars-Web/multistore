<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from 'module:ets_onepagecheckoutviewstemplateshooklayout_2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4deef5563_72210355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44709a6cdcd824d8ec5f2f0f69f38aec0306e174' => 
    array (
      0 => 'module:ets_onepagecheckoutviewstemplateshooklayout_2.tpl',
      1 => 1723650424,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4deef5563_72210355 (Smarty_Internal_Template $_smarty_tpl) {
?><form id="form_ets_onepagecheckout" class="layout layout_2" action="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('ets_onepagecheckout','order'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" method="post">
    <div id="ets_onepagecheckout" class=" row">
        <div class="onepagecheckout-left col-lg-12">
                        
            <div class="block-onepagecheckout block-shopping-cart">
                                <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_SHOW_SHIPPING']->value) {?>
                    <div class="alert alert-info buy_more_fee_shipping" style="display:none">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <strong></strong> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'more to your order to get free shipping','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        <div class="box_more_fee_shipping">
                            <span class="start"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>0),$_smarty_tpl ) );?>
</span>
                            <div class="box_shipping_free">
                                <div class="box_total_cart"></div>
                            </div>
                            <span class="end">10$</span>
                        </div>
                    </div>

                <?php }?>
                <div class="block-content">
                    <?php echo $_smarty_tpl->tpl_vars['shipping_cart']->value;?>

                </div>
            </div>
            <div class="block-onepagecheckout block-address">
                                <div id="invoice-addresses" class="address-selector js-address-selector col-lg-12">
                        <?php echo $_smarty_tpl->tpl_vars['invoice_address']->value;?>

                                        </div>
                <div class="col-lg-12 col-xs-12 invoice-address-container  px-0">
                    <?php if ($_smarty_tpl->tpl_vars['use_address_invoice']->value) {?>
                                                <div class="form-group typeofshipping flex" style="gap: 2rem;">
                            <label for="use_another_address_for_invoice" class="ets_checkinput">
                                <input type="checkbox" name="use_another_address_for_invoice" id="use_another_address_for_invoice" value="1" />&nbsp;<i class="ets_checkbox"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deliver to a different address?','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
 (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Dropship','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
)
                            </label>
                            <label for="use_pickup_address" class="ets_checkinput">
                                <input type="checkbox" name="use_pickup_address" id="use_pickup_address" value="1" />&nbsp;<i class="ets_checkbox"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pick up with your carrier','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
 (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pickup','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
)
                            </label>
                            
                        </div>
                    <?php }?>
                    
                    <div id="delivery-addresses" class="address-selector js-address-selector col-lg-12 px-0"  style="display:none">
                    <?php echo $_smarty_tpl->tpl_vars['shipping_address']->value;?>

                    
                    </div>
                </div>
            </div>
            <div <?php if (!$_smarty_tpl->tpl_vars['shipping_methods']->value) {?> style="display:none"<?php }?>>
                <div class="block-onepagecheckout block-shipping">
                    <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M640 1408q0-52-38-90t-90-38-90 38-38 90 38 90 90 38 90-38 38-90zm-384-512h384v-256h-158q-13 0-22 9l-195 195q-9 9-9 22v30zm1280 512q0-52-38-90t-90-38-90 38-38 90 38 90 90 38 90-38 38-90zm256-1088v1024q0 15-4 26.5t-13.5 18.5-16.5 11.5-23.5 6-22.5 2-25.5 0-22.5-.5q0 106-75 181t-181 75-181-75-75-181h-384q0 106-75 181t-181 75-181-75-75-181h-64q-3 0-22.5.5t-25.5 0-22.5-2-23.5-6-16.5-11.5-13.5-18.5-4-26.5q0-26 19-45t45-19v-320q0-8-.5-35t0-38 2.5-34.5 6.5-37 14-30.5 22.5-30l198-198q19-19 50.5-32t58.5-13h160v-192q0-26 19-45t45-19h1024q26 0 45 19t19 45z"/></svg>
                                    </span>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping method','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </div>
                    <div class="block-content">
                        <?php echo $_smarty_tpl->tpl_vars['shipping_methods']->value;?>

                    </div>
                </div>
            </div>
            
            <?php if ($_smarty_tpl->tpl_vars['hookDisplayShopLicenseField']->value) {?>
                <div class="block-onepagecheckout block-shop-license-info">
                    <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z"/></svg>
                                    </span>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shop(s) to install','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </div>
                    <div class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please specify the shop domain(s) to install your purchased product(s)','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</div>
                    <div class="block-content">
                        <?php echo $_smarty_tpl->tpl_vars['hookDisplayShopLicenseField']->value;?>

                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['additional_info']->value) {?>
                <div class="block-onepagecheckout block-additional-info">
                    <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z"/></svg>
                                    </span>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional info','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </div>
                    <div class="block-content">
                        <?php echo $_smarty_tpl->tpl_vars['additional_info']->value;?>

                    </div>
                </div>
            <?php }?>

            <div class="cart-grid-body">
                <?php echo $_smarty_tpl->tpl_vars['html_gift_products']->value;?>

            </div>
            <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_CART_COMMENT_ENABLED']->value) {?>
                <div class="block-onepagecheckout block-comment">
                    <div class="title-heading">
                            <span class="ets_icon_svg">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comment" class="svg-inline--fa fa-comment fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"></path></svg>
                            </span>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order comment','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </div>
                    <div class="block-content">
                        <div id="delivery">
                            <label id="label_delivery_message" style="cursor: pointer;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Would you like to add a comment about your order?','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                            <textarea rows="2" cols="160" id="delivery_message" name="delivery_message"></textarea>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if ((Configuration::get('PS_GIFT_WRAPPING') || Configuration::get('PS_RECYCLABLE_PACK')) && !$_smarty_tpl->tpl_vars['is_virtual_cart']->value) {?>
                <div class="block-onepagecheckout block-gift">
                    <div class="title-heading">
                            <span class="ets_icon_svg">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="gift" class="svg-inline--fa fa-gift fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"></path></svg>
                            </span>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Gift wrapping','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </div>
                    <div class="block-content">
                        <div class="gift-box">
                            <?php if (Configuration::get('PS_RECYCLABLE_PACK')) {?>
                                <span class="custom-checkbox">
                                        <label for="input_recyclable" class="ets_checkinput"> <input id="input_recyclable" name="recyclable" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['recyclable']->value) {?> checked="checked"<?php }?> /><i class="ets_checkbox"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>' I would like to receive my order in recycled packaging.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                                    </span>
                            <?php }?>
                            <?php if (Configuration::get('PS_GIFT_WRAPPING')) {?>
                                <span class="custom-checkbox">
                                        <label class="gift_label" for="gift_input" class="ets_checkinput">
                                            <input id="gift_input" name="gift" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['gift']->value) {?> checked="checked"<?php }?> />
                                            <i class="ets_checkbox"></i><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gift_label']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</label>
                                    </span>
                                <div id="gift"<?php if ($_smarty_tpl->tpl_vars['gift']->value) {?> style="display:block"<?php } else { ?> style="display:none"<?php }?>>
                                    <label for="gift_message"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you\'d like, you can add a note to the gift:','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                                    <textarea rows="2" cols="120" id="gift_message" name="gift_message"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['gift_message']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</textarea>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_SHOW_CUSTOMER_REASSURANCE']->value) {?>
                <div class="block-top">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="block-onepagecheckout block-displayReassurance">
                                <?php echo $_smarty_tpl->tpl_vars['ETS_OPC_SHOW_CUSTOMER_REASSURANCE']->value;?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if (Configuration::get('PS_CONDITIONS')) {?>
                <div id="conditions-to-approve" method="GET">
                    <ul>
                        <li style="max-width: 600px;margin: auto;text-align: center;display:flex;justify-content:center;flex-direction:column;">
                            <div class="float-xs-left">
                                <span class="checkbox ets_checkinput">
                                <label class="js-terms required" for="conditions_to_approve" onclick="checkCheckboxTerms()" >
                                    <input id="conditions_to_approve" name="conditions_to_approve[terms-and-conditions]" value="1" class="ps-shown-by-js" onclick="checkCheckboxTerms()" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['ETS_OPC_CHECK_DEFAULT_CONDITION']->value) {?> checked="checked"<?php }?> />&nbsp; <i class="ets_checkbox"></i>
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I have read and accept the current terms, conditions and policies.','d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>

                                </label>
                                </span>
                            </div>
                            <div class="condition-label">
                                
                                <div>
                                    <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(13), ENT_QUOTES, 'UTF-8');?>
" id="cta-terms-and-conditions-0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Conditions','d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</a>
                                    | <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(7), ENT_QUOTES, 'UTF-8');?>
" id="cta-terms-and-conditions-0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy','d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php }?>
            <div class="" <?php if (!$_smarty_tpl->tpl_vars['payment_methods']->value) {?> style="display:none"<?php }?>>
                <div class="block-onepagecheckout block-payment" style="display: none;">
                                        <div style="display: flex;flex-direction:column;width:100%;">
                        <h1 style="text-align: center;font-weight:600;margin-bottom: 1rem;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Select your payment method",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
</h1>
                    
                        <div class="block-content" style="width: 100%;">
                            <?php echo $_smarty_tpl->tpl_vars['payment_methods']->value;?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout card-block">
                <div class="text-center">
                    <button class="btn btn-primary" name="submitCompleteMyOrder"<?php if ($_smarty_tpl->tpl_vars['isAvailable']->value) {?> disabled=""<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Complete my order','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</button>
                    <?php if ($_smarty_tpl->tpl_vars['safe_icon']->value) {?>
                        <img class="safe_icon" src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['safe_icon']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                    <?php }?>
                </div>
            </div>
            <div id="payment-confirmation" style="overflow:hidden;opacity:0;">
                <div class="ps-shown-by-js">
                    <button class="btn btn-primary center-block" type="submit"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Complete my order','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </button>
                </div>
                <div class="ps-hidden-by-js" style="display: none;"> </div>
            </div>
        </div>
    </div>
</form>


<style>
.block-onepagecheckout.block-address{
    /* display: flex; */
    border: 0 !important;
}
.block-onepagecheckout.block-shipping{
    visibility: hidden;
    height: 10px;
    overflow: hidden;
}
.block-onepagecheckout.block-payment.show{
    display: flex !important;
}

.block-onepagecheckout.block-payment{
    border: 0 !important;
}

#form_ets_onepagecheckout{
    max-width: 1350px;
    margin: auto;
    padding: 0;
    background: unset;
    box-shadow: none;
    border: 0;
  }

  .block-shopping-cart{
    /* background: #e7e7e7; */
    border: 0 !important;
  }

  .block-shopping-cart .title-heading{
   border-bottom: 0;
   border-top: 0;
   color: #131313;
  }
  .block-shopping-cart .title-heading svg{
   fill: #131313;
  }

  #checkout .cart-overview{
   border: 0;
  }
  #checkout .cart-overview .cart-items{
   border: 0;
   margin: 0 -1rem;
   padding-bottom: 0;
  }
  #checkout .cart-overview .cart-items .cart-item{
   background: #fff;
  }

  #checkout .cart-overview .cart-items .product-line-info{
   display: flex;
   flex-direction: column;
   text-align: start;
  }

  .block-shopping-cart .block-content .cart-grid{
   margin: 0;
  }
  .block-shopping-cart .block-content .cart-grid .cart-total-action {
   /* background: #e7e7e7 !important; */
   margin: 0 -1rem;
  }

  .block-shopping-cart .block-content .cart-grid .cart-total-action .cart-detailed-totals{
   border: 0;
  }

  .cart-summary-totals .cart-summary-line{
    width: 100%;
    display: flex !important;
    justify-content: space-between;
  }
  .cart-items .cart-item{
    padding: 0;
  }

  #checkout .product-discount .regular-price{
    background: none;
    color: #6f6f6f;
    font-size: 12px;
    line-height: 17px;
    font-weight: 400;
  }
  #checkout .product-discount .discount{
    background: none;
    color: #f13340;
    font-size: 14px;
    line-height: 24px;
    font-weight: 400;
  }
  #checkout .current-price .price{
    color: #131313;
    font-size: 14px;
    line-height: 17px;
    font-weight: 700;
  }

  #checkout .product-line-grid-right .bootstrap-touchspin{
    width: 6rem;
  }

  .block-onepagecheckout .product-line-grid-right .price{
    margin-top: 0;
  }
  #form_ets_onepagecheckout a.remove-from-cart i::before{
    color: #131313;
  }

  .block-onepagecheckout .bootstrap-touchspin input{
    color: #555;
  }

  .block-onepagecheckout .bootstrap-touchspin .input-group-btn-vertical .bootstrap-touchspin-down::before{
    color: #0273eb;
    font-size: 1.5rem;
    font-weight: 700;
  }
  .block-onepagecheckout .bootstrap-touchspin .input-group-btn-vertical .bootstrap-touchspin-up::before{
    color: #0273eb;
    font-size: 1.5rem;
    font-weight: 700;
  }

  .shopping-cart-row .price .product-price{
    color: #333 !important;
    font-size: 12px;
    line-height: 17px;
    font-weight: 700 !important;
  }

  #checkout table{
    border: 1px solid #e7e7e7;
  }

  #checkout .cart-overview .cart_description .product-line-info{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 0 1rem;
  }
  #checkout .cart-overview .product-line-info.product-price{
    flex-direction: column;
    align-items: center;
  }

  #checkout .cart-overview thead tr{
    background: #e7e7e7;
  }
  #checkout .cart-overview tbody tr{
    border-bottom: 1px solid #e7e7e7;
  }
  #checkout .cart-overview tbody tr .cart_delete{
    width: 70px;
  }
  #checkout .cart-overview tfoot .text-right{
    text-align: right;
  }
  #checkout .cart-overview tfoot #total_price_container{
    background: #fff;
  }
  #checkout .cart-overview td{
    border-right: 1px solid #dedede;
  }
  #checkout .cart-overview .cart_total .price{
    justify-content: center;
  }

  #checkout #invoice-addresses{
    padding: 0;
  }

</style>

<?php echo '<script'; ?>
>
function checkCheckboxTerms() {
    const ifcheckterms = document.querySelector("#conditions_to_approve")
    const paymentmethods = document.querySelector(".block-payment")
    // console.log(ifcheckterms.checked)
    if(ifcheckterms.checked){
        paymentmethods.classList.add("show")
    }else{
        paymentmethods.classList.remove("show")
    }
}

function checkCheckboxsShipping() {

    const checkboxesInput = document.querySelectorAll(".typeofshipping input");

    checkboxesInput.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            if (checkbox.checked) {
                const checkboxname = checkbox.getAttribute("name")
                // Uncheck all other checkboxes
                checkboxesInput.forEach(otherCheckbox => {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                        if(otherCheckbox.getAttribute("name") == "use_another_address_for_invoice"){
                            document.querySelector("#delivery-addresses").style.display = "none"
                        }
                    }
                });
                
                if(checkboxname == 'use_pickup_address'){
                    document.querySelector(".block-shipping .delivery-options .delivery-option input[type='radio'][value='1,']").checked = true;
                }else{
                    document.querySelector(".block-shipping .delivery-options .delivery-option input[type='radio'][value='7,']").checked = true;
                }

            } else {
                // document.querySelector("#invoice-addresses").style.display = "none"
            }
        });
    });
}



document.addEventListener("DOMContentLoaded", (e) => {
    checkCheckboxsShipping()
    document.querySelector(".block-shipping .delivery-options .delivery-option input[type='radio'][value='7,']").checked = true;
})
<?php echo '</script'; ?>
><?php }
}
