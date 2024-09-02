{*
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
*}
<form id="form_ets_onepagecheckout" class="layout layout_2" action="{$link->getModuleLink('ets_onepagecheckout','order')|escape:'html':'UTF-8'}" method="post">
    <div id="ets_onepagecheckout" class=" row">
        <div class="onepagecheckout-left col-lg-12">
            {* <div class="block-onepagecheckout block-customer ">
                <div class="title-heading">
                    <span class="ets_icon_svg">
                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1536 1399q0 109-62.5 187t-150.5 78h-854q-88 0-150.5-78t-62.5-187q0-85 8.5-160.5t31.5-152 58.5-131 94-89 134.5-34.5q131 128 313 128t313-128q76 0 134.5 34.5t94 89 58.5 131 31.5 152 8.5 160.5zm-256-887q0 159-112.5 271.5t-271.5 112.5-271.5-112.5-112.5-271.5 112.5-271.5 271.5-112.5 271.5 112.5 112.5 271.5z"/></svg>
                    </span>
                    {l s='Your account' mod='ets_onepagecheckout'}
                </div>
                <div class="block-content">
                    {include file='module:ets_onepagecheckout/views/templates/hook/login.tpl'}
                </div>
            </div> *}
            
            <div class="block-onepagecheckout block-shopping-cart">
                {* <div class="title-heading">
                        <span class="ets_icon_svg">
                            <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M704 1536q0 52-38 90t-90 38-90-38-38-90 38-90 90-38 90 38 38 90zm896 0q0 52-38 90t-90 38-90-38-38-90 38-90 90-38 90 38 38 90zm128-1088v512q0 24-16.5 42.5t-40.5 21.5l-1044 122q13 60 13 70 0 16-24 64h920q26 0 45 19t19 45-19 45-45 19h-1024q-26 0-45-19t-19-45q0-11 8-31.5t16-36 21.5-40 15.5-29.5l-177-823h-204q-26 0-45-19t-19-45 19-45 45-19h256q16 0 28.5 6.5t19.5 15.5 13 24.5 8 26 5.5 29.5 4.5 26h1201q26 0 45 19t19 45z"/></svg>
                        </span>
                    {l s='Shopping cart' mod='ets_onepagecheckout'}
                </div> *}
                {if $ETS_OPC_SHOW_SHIPPING}
                    <div class="alert alert-info buy_more_fee_shipping" style="display:none">
                        {l s='Add' mod='ets_onepagecheckout'} <strong></strong> {l s='more to your order to get free shipping' mod='ets_onepagecheckout'}
                        <div class="box_more_fee_shipping">
                            <span class="start">{displayPrice price =0}</span>
                            <div class="box_shipping_free">
                                <div class="box_total_cart"></div>
                            </div>
                            <span class="end">10$</span>
                        </div>
                    </div>

                {/if}
                <div class="block-content">
                    {$shipping_cart nofilter}
                </div>
            </div>
            <div class="block-onepagecheckout block-address">
                {* <div class="title-heading">
                    <span class="ets_icon_svg">
                        <svg viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1024 1131q0-64-9-117.5t-29.5-103-60.5-78-97-28.5q-6 4-30 18t-37.5 21.5-35.5 17.5-43 14.5-42 4.5-42-4.5-43-14.5-35.5-17.5-37.5-21.5-30-18q-57 0-97 28.5t-60.5 78-29.5 103-9 117.5 37 106.5 91 42.5h512q54 0 91-42.5t37-106.5zm-157-520q0-94-66.5-160.5t-160.5-66.5-160.5 66.5-66.5 160.5 66.5 160.5 160.5 66.5 160.5-66.5 66.5-160.5zm925 509v-64q0-14-9-23t-23-9h-576q-14 0-23 9t-9 23v64q0 14 9 23t23 9h576q14 0 23-9t9-23zm0-260v-56q0-15-10.5-25.5t-25.5-10.5h-568q-15 0-25.5 10.5t-10.5 25.5v56q0 15 10.5 25.5t25.5 10.5h568q15 0 25.5-10.5t10.5-25.5zm0-252v-64q0-14-9-23t-23-9h-576q-14 0-23 9t-9 23v64q0 14 9 23t23 9h576q14 0 23-9t9-23zm256-320v1216q0 66-47 113t-113 47h-352v-96q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v96h-768v-96q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v96h-352q-66 0-113-47t-47-113v-1216q0-66 47-113t113-47h1728q66 0 113 47t47 113z"/></svg>
                    </span>
                    {l s='Address' mod='ets_onepagecheckout'}
                </div> *}
                <div id="invoice-addresses" class="address-selector js-address-selector col-lg-12">
                        {$invoice_address nofilter}
                        {* <div class="form-group"> 
                            <label for="other">Additional information</label>
                            <textarea class="form-control custom_input_form" name="other" id="other" cols="26" rows="2">
                            </textarea>
                        </div> *}
                </div>
                <div class="col-lg-12 col-xs-12 invoice-address-container  px-0">
                    {if $use_address_invoice}
                        {* <p class="no_invoice_address">{l s='The selected address will be used both as your personal address (for invoice) and as your delivery address.' mod='ets_onepagecheckout'}</p> *}
                        <div class="form-group typeofshipping flex" style="gap: 2rem;">
                            <label for="use_another_address_for_invoice" class="ets_checkinput">
                                <input type="checkbox" name="use_another_address_for_invoice" id="use_another_address_for_invoice" value="1" />
                                <i class="ets_checkbox"></i>
                                <span >{l s='Deliver to a different address?' d='Shop.Theme.Checkout'} ({l s='Dropship' d='Shop.Theme.Checkout'})</span>
                            </label>
                            <label for="use_pickup_address" class="ets_checkinput">
                                <input type="checkbox" name="use_pickup_address" id="use_pickup_address" value="1" />
                                <i class="ets_checkbox"></i>
                                <span >{l s='Pick up with your carrier' d='Shop.Theme.Checkout'} ({l s='Pickup' d='Shop.Theme.Checkout'})</span>
                            </label>
                            
                        </div>
                    {/if}
                    
                    <div id="delivery-addresses" class="address-selector js-address-selector col-lg-12 px-0"  style="display:none">
                    {$shipping_address nofilter}
                    
                    </div>
                </div>
            </div>
            <div {if !$shipping_methods} style="display:none"{/if}>
                <div class="block-onepagecheckout block-shipping">
                    <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M640 1408q0-52-38-90t-90-38-90 38-38 90 38 90 90 38 90-38 38-90zm-384-512h384v-256h-158q-13 0-22 9l-195 195q-9 9-9 22v30zm1280 512q0-52-38-90t-90-38-90 38-38 90 38 90 90 38 90-38 38-90zm256-1088v1024q0 15-4 26.5t-13.5 18.5-16.5 11.5-23.5 6-22.5 2-25.5 0-22.5-.5q0 106-75 181t-181 75-181-75-75-181h-384q0 106-75 181t-181 75-181-75-75-181h-64q-3 0-22.5.5t-25.5 0-22.5-2-23.5-6-16.5-11.5-13.5-18.5-4-26.5q0-26 19-45t45-19v-320q0-8-.5-35t0-38 2.5-34.5 6.5-37 14-30.5 22.5-30l198-198q19-19 50.5-32t58.5-13h160v-192q0-26 19-45t45-19h1024q26 0 45 19t19 45z"/></svg>
                                    </span>
                        {l s='Shipping method' mod='ets_onepagecheckout'}
                    </div>
                    <div class="block-content">
                        {$shipping_methods nofilter}
                    </div>
                </div>
            </div>
            
            {if $hookDisplayShopLicenseField}
                <div class="block-onepagecheckout block-shop-license-info">
                    <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z"/></svg>
                                    </span>
                        {l s='Shop(s) to install' mod='ets_onepagecheckout'}
                    </div>
                    <div class="help-block">{l s='Please specify the shop domain(s) to install your purchased product(s)' mod='ets_onepagecheckout'}</div>
                    <div class="block-content">
                        {$hookDisplayShopLicenseField nofilter}
                    </div>
                </div>
            {/if}
            {if $additional_info}
                <div class="block-onepagecheckout block-additional-info">
                    <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z"/></svg>
                                    </span>
                        {l s='Additional info' mod='ets_onepagecheckout'}
                    </div>
                    <div class="block-content">
                        {$additional_info nofilter}
                    </div>
                </div>
            {/if}

            <div class="cart-grid-body">
                {$html_gift_products nofilter}
            </div>
            {if $ETS_OPC_CART_COMMENT_ENABLED}
                <div class="block-onepagecheckout block-comment">
                    <div class="title-heading">
                            <span class="ets_icon_svg">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comment" class="svg-inline--fa fa-comment fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"></path></svg>
                            </span>
                        {l s='Order comment' mod='ets_onepagecheckout'}
                    </div>
                    <div class="block-content">
                        <div id="delivery">
                            <label id="label_delivery_message" style="cursor: pointer;">{l s='Would you like to add a comment about your order?' mod='ets_onepagecheckout'}</label>
                            <textarea rows="2" cols="160" id="delivery_message" name="delivery_message"></textarea>
                        </div>
                    </div>
                </div>
            {/if}
            {if (Configuration::get('PS_GIFT_WRAPPING') || Configuration::get('PS_RECYCLABLE_PACK')) && !$is_virtual_cart }
                <div class="block-onepagecheckout block-gift">
                    <div class="title-heading">
                            <span class="ets_icon_svg">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="gift" class="svg-inline--fa fa-gift fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"></path></svg>
                            </span>
                        {l s='Gift wrapping' mod='ets_onepagecheckout'}
                    </div>
                    <div class="block-content">
                        <div class="gift-box">
                            {if Configuration::get('PS_RECYCLABLE_PACK')}
                                <span class="custom-checkbox">
                                        <label for="input_recyclable" class="ets_checkinput"> <input id="input_recyclable" name="recyclable" value="1" type="checkbox"{if $recyclable} checked="checked"{/if} /><i class="ets_checkbox"></i>{l s=' I would like to receive my order in recycled packaging.' mod='ets_onepagecheckout'}</label>
                                    </span>
                            {/if}
                            {if Configuration::get('PS_GIFT_WRAPPING')}
                                <span class="custom-checkbox">
                                        <label class="gift_label" for="gift_input" class="ets_checkinput">
                                            <input id="gift_input" name="gift" value="1" type="checkbox"{if $gift} checked="checked"{/if} />
                                            <i class="ets_checkbox"></i>{$gift_label|escape:'html':'UTF-8'}</label>
                                    </span>
                                <div id="gift"{if $gift} style="display:block"{else} style="display:none"{/if}>
                                    <label for="gift_message">{l s='If you\'d like, you can add a note to the gift:' mod='ets_onepagecheckout'}</label>
                                    <textarea rows="2" cols="120" id="gift_message" name="gift_message">{$gift_message|escape:'html':'UTF-8'}</textarea>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            {/if}
            {if $ETS_OPC_SHOW_CUSTOMER_REASSURANCE}
                <div class="block-top">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="block-onepagecheckout block-displayReassurance">
                                {$ETS_OPC_SHOW_CUSTOMER_REASSURANCE nofilter}
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
            {if Configuration::get('PS_CONDITIONS')}
                <div id="conditions-to-approve" method="GET">
                    <ul>
                        <li style="max-width: 600px;margin: auto;text-align: center;display:flex;justify-content:center;flex-direction:column;">
                            <div class="float-xs-left">
                                <span class="checkbox ets_checkinput">
                                <label class="js-terms required" for="conditions_to_approve" onclick="checkCheckboxTerms()" >
                                    <input id="conditions_to_approve" name="conditions_to_approve[terms-and-conditions]" value="1" class="ps-shown-by-js" onclick="checkCheckboxTerms()" type="checkbox"{if $ETS_OPC_CHECK_DEFAULT_CONDITION} checked="checked"{/if} />&nbsp; <i class="ets_checkbox"></i>
                                    <span>{l s='I have read and accept the current terms, conditions and policies.' d="Shop.Theme.Checkout"}</span>
                                </label>
                                </span>
                            </div>
                            <div class="condition-label">
                                
                                <div>
                                    <a href="{$link->getCMSLink(13)}" >{l s='Conditions'  d="Shop.Theme.Checkout"}</a>
                                    | <a href="{$link->getCMSLink(7)}" >{l s='Privacy'  d="Shop.Theme.Checkout"}</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            {/if}
            <div class="" {if !$payment_methods} style="display:none"{/if}>
                <div class="block-onepagecheckout block-payment" style="display: none;">
                    {* <div class="title-heading">
                                    <span class="ets_icon_svg">
                                        <svg viewBox="0 0 2304 1792" xmlns="http://www.w3.org/2000/svg"><path d="M0 1504v-608h2304v608q0 66-47 113t-113 47h-1984q-66 0-113-47t-47-113zm640-224v128h384v-128h-384zm-384 0v128h256v-128h-256zm1888-1152q66 0 113 47t47 113v224h-2304v-224q0-66 47-113t113-47h1984z"/></svg>
                                    </span>
                        {l s='Payment method' mod='ets_onepagecheckout'}
                    </div> *}
                    <div style="display: flex;flex-direction:column;width:100%;">
                        <h1 style="text-align: center;font-weight:600;margin-bottom: 1rem;color:#0273eb;">{l s="Select your payment method" d="Shop.Theme.Checkout"}</h1>
                    
                        <div class="block-content" style="width: 100%;">
                            {$payment_methods nofilter}
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout card-block">
                <div class="text-center">
                    <button class="btn btn-primary" name="submitCompleteMyOrder"{if $isAvailable} disabled=""{/if}>{l s='Complete my order' mod='ets_onepagecheckout'}</button>
                    {if $safe_icon}
                        <img class="safe_icon" src="{$safe_icon|escape:'html':'UTF-8'}">
                    {/if}
                </div>
            </div>
            <div id="payment-confirmation" style="overflow:hidden;opacity:0;">
                <div class="ps-shown-by-js">
                    <button class="btn btn-primary center-block" type="submit"> {l s='Complete my order' mod='ets_onepagecheckout'} </button>
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

<script>
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
</script>