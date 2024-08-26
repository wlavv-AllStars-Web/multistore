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
<div id="checkout-personal-information-step" class="checkout-step -reachable -complete -clickable"></div>
<section id="checkout-payment-step" class="checkout-step -current -reachable js-current-step">
    <div class="content">
        {hook h='displayPaymentTop'}
        <div class="payment-options" style="display: flex;">
            <form></form>
            {if $payment_methods}
                {* <div class="payment-methods-asd"> *}
                     {* <div class="ets_payment_method col-lg-6" style="display: flex;flex-direction:column;justify-content:center;align-items:center;" >
                        <div class="img-module" idform="1" onclick="setPaymentMethod(this)">
                            <img src="https://www.all-stars-distribution.com/img/payment-bankwire-color.png?t=112">
                            <div>Bank transfer (0% fees)</div>
                            
                        </div>
                        <div class="payment-option">
                            <input id="payment-option-1"
                                    class=""
                                    data-module-name="ps_wirepayment" name="payment-option" type="radio"
                                    value="ps_wirepayment"
                                    
                            />
                            <input type="hidden" value="1" name="payment_id" />
                            <form id="payment-form-1" method="GET">
                                
                                
                                <button id="pay-with-1" style="display:none" name="select_payment_option" value="payment-option-1" type="submit"></button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="ets_payment_method col-lg-6" style="display: flex;flex-direction:column;justify-content:center;align-items:center;" >
                        <div class="img-module" idform="2" onclick="setPaymentMethod(this)">
                            <img src="https://www.all-stars-distribution.com//modules/ogone/views/img/default_user_logo.png?t=113">
                            <div>Credit card (+1% fees)</div>
                            
                        </div>
                        <div class="payment-option">
                            <input id="payment-option-2"
                                class=""
                                data-module-name="creditcard" name="payment-option" type="radio"
                                value="creditcard"
                                
                            />
                            <input type="hidden" value="2" name="payment_id" />
                            <form id="payment-form-2" method="GET" >
                                
                                
                                <button id="pay-with-1" style="display:none" name="select_payment_option" value="payment-option-2" type="submit"></button>
                            </form>
                        </div>
                    </div>
                    
                    <div id="pay-with-payment-option-1-form" class="js-payment-option-form ps-hidden " style="color: red; display: block;">
                        
                        <form id="payment-form" method="POST" action="/en/module/ps_wirepayment/validation">
                            <button id="pay-with-payment-option-1" style="display:none" type="submit"></button>
                        </form>
                    </div>
                    <div id="pay-with-payment-option-2-form" class="js-payment-option-form ps-hidden " style="color: red; display: block;">
                        <form id="payment-form" method="POST" action="/en/module/ps_wirepayment/validation">
                            <button id="pay-with-payment-option-2" style="display:none" type="submit"></button>
                        </form>
                    </div>
                </div>  *}

               
                {foreach from=$payment_methods key='module_name' item='payment_method'}
                    {foreach from=$payment_method item='module'}
                        {section name=dup start=0 loop=2}
                        <div class="ets_payment_method col-lg-6" style="display: flex;flex-direction:column;justify-content:center;align-items:center;" >
                            <div class="img-module" idform="{if $smarty.section.dup.index == 0}2{else}1{/if}" onclick="setPaymentMethod(this)">
                            {if $smarty.section.dup.index == 1}
                                <img src="https://www.all-stars-distribution.com/img/payment-bankwire-color.png?t=112">
                                <div class="title-payment">Bank transfer (0% fees)</div>
                            
                                {* <input type="hidden" name="payment_id" value="1" /> *}
                            {else}
                                <img src="https://www.all-stars-distribution.com//modules/ogone/views/img/default_user_logo.png?t=113">
                                <div class="title-payment">Credit card (+1% fees)</div>
                                {* <input type="hidden" name="payment_id" value="2" /> *}
                            {/if}
                            </div>
                            <div id="{$module.id|escape:'html':'UTF-8'}-container" class="payment-option col-lg-6 clearfix" >
                                <span class="custom-radio float-xs-left" >
                                     {* <input id="{$module.id|escape:'html':'UTF-8'}"
                                            class="ps-shown-by-js {if $module.module_name}{if $payment_selected==$module.module_name}checked{/if}{else}{if $payment_selected==$module_name}checked{/if}{/if}"
                                            data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                            value="{$module_name|escape:'html':'UTF-8'}"
                                            
                                     /> *}
                                     <input id="{$module.id|escape:'html':'UTF-8'}"
                                            class="ps-shown-by-js {if $module.module_name}{if $payment_selected==$module.module_name}checked{/if}{else}{if $payment_selected==$module_name}checked{/if}{/if}"
                                            data-module-name="{if $smarty.section.dup.index == 0}creditcard{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                            value="{if $smarty.section.dup.index == 0}creditcard{else}{$module_name|escape:'html':'UTF-8'}{/if}"
                                            
                                     />
                                            
                                    <span></span>
                                </span>
                                
                                <form method="GET" class="ps-hidden-by-js" style="display:none;">
                                    <button class="ps-hidden-by-js" type="submit" name="select_payment_option" value="{$module.id|escape:'html':'UTF-8'}">
                                        {l s='Choose' mod='ets_onepagecheckout'}
                                    </button>
                                </form>
                                <label for="{$module.id|escape:'html':'UTF-8'}">
                                    <span>
                                        {if $ETS_OPC_PAYMENT_LOGO_ENABLED}{if isset($module.logo) && $module.logo}<img src="{$module.logo|escape:'html':'UTF-8'}" style="width:40px" />{/if}{/if}
                                        {$module.call_to_action_text|escape:'html':'UTF-8'}
                                    </span>
                                </label>
                            </div>

                            <div id="{if $smarty.section.dup.index == 0}pay-with-payment-option-2-form{else}pay-with-payment-option-1-form{/if}" class="js-payment-option-form ps-hidden " {if $payment_selected==$module.module_name}  style="color:red; display:block"{else}{/if}>
                                {if $module.form}
                                    {$module.form nofilter}
                                {else}
                                    <form id="payment-form" method="POST" action="{$module.action|escape:'html':'UTF-8'}">
                                        {if isset($module.inputs) && $module.inputs}
                                            {foreach from = $module.inputs item='input'}
                                                <input{foreach from=$input key='key' item='value'} {$key|escape:'html':'UTF-8'}="{$value|escape:'html':'UTF-8'}"{/foreach} />
                                            {/foreach}
                                        {/if}
                                        <button id="pay-with-{if $smarty.section.dup.index == 0}payment-option-2{else}payment-option-1{/if}"  type="submit"></button>
                                        <input type="hidden" nameinput="{if $smarty.section.dup.index == 0}creditcard{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment_id" value="{if $smarty.section.dup.index == 0}2{else}1{/if}" />
                                    </form>
                                {/if}
                            </div>
                        </div>
                    {/section}
                    {/foreach}
                {/foreach}
                
            {else}
                <div class="alert alert-danger">{l s='Unfortunately, there are no payment methods available.' mod='ets_onepagecheckout'}</div>
            {/if}
        </div>
        {hook h='displayPaymentByBinaries'}
    </div>
</section>


<script>
function setPaymentMethod(form) {
    
    const idform = form.getAttribute("idform")
    console.log(idform)
    let moduleName;
    if(idform == 1){
        moduleName = 'ps_wirepayment'
    }else{
        moduleName = 'creditcard' 
    }
    console.log(moduleName)
    const radio = document.querySelector("input[value="+moduleName+"]")
    radio.checked = true;
    const formPayment = document.querySelector(`#pay-with-payment-option-`+idform+`-form form`)
    // document.querySelector("button[name='submitCompleteMyOrder']").click();
    formPayment.submit()
}
</script>