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
        <div class="payment-options" style="display: flex;padding: 1rem;gap:1rem;">
            <form></form>
            {if $payment_methods}
                {foreach from=$payment_methods key='module_name' item='payment_method'}
                    {foreach from=$payment_method item='module'}

                        {if $module.module_name|escape:'html':'UTF-8' == 'alma'}
                            {assign var="url_parts" value=$module.action|regex_replace:'/.*key=([^&]+)$/':'$1'}
                            {if $url_parts == 'general_3_0_0'}
                                <div class="ets_payment_method" style="display: flex;flex-direction:column;align-items:center;padding: 10px 15px;justify-content:center;height:unset !important;min-height:120px;">
                                <div class="" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <img src="{$module_template_dir}views/img/{$module.module_name|escape:'html':'UTF-8'}.png" style="width: 100%;height:auto !important;max-width:100px !important;max-height:unset !important;"/>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                    {foreach from=$payment_methods key='module_name' item='payment_method'}
                                        {foreach from=$payment_method item='module' key=key}
                                            {if $module.module_name|escape:'html':'UTF-8' == 'alma'}
                            
                                                <div class="ets_payment_method" onclick="setPaymentClick(this)">
                                                    <div id="{$module.id|escape:'html':'UTF-8'}-container" class="payment-option clearfix" style="display: flex;justify-content:center;justify-content:center;gap:1rem;max-width:unset !important;"  >
                                                        <label class="img-payment-method" for="{$module.id|escape:'html':'UTF-8'}" style="display: flex;justify-content:center;align-items:center;">
                                                            {* <img src="{$module_template_dir}views/img/{$module.module_name|escape:'html':'UTF-8'}_{$key + 3}.png" /> *}
                                                            <span style="font-size: 1.5rem;display: flex;line-height: normal;" class="badge badge-dark">{if $key == 0}3X{else}4X{/if}</span>
                                                        </label>
                                                        <span class="custom-radio float-xs-left" style="display: none;">
                                                            {* <input id="{$module.id|escape:'html':'UTF-8'}"
                                                                    class="ps-shown-by-js {if $module.module_name}{if $payment_selected==$module.module_name}checked{/if}{else}{if $payment_selected==$module_name}checked{/if}{/if}"
                                                                    data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                                                    value="{$module_name|escape:'html':'UTF-8'}"
                                                            /> *}
                                                            <input id="{$module.id|escape:'html':'UTF-8'}"
                                                                    class="ps-shown-by-js"
                                                                    data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                                                    value="{$module_name|escape:'html':'UTF-8'}"
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
                                                
                                                    {* <div id="{$module.id|escape:'html':'UTF-8'}-additional-information" class="js-additional-information definition-list additional-information ps-hidden " {if $payment_selected==$module.module_name} style="display:block"{else}style="display: none;"{/if}>
                                                        {$module.additionalInformation nofilter}
                                                    </div> *}
                                                    <div id="pay-with-{$module.id|escape:'html':'UTF-8'}-form" class="js-payment-option-form ps-hidden " {if $payment_selected==$module.module_name}  style="color:red; display:block"{else}style="display: none;"{/if}>
                                                        {if $module.form}
                                                            {$module.form nofilter}
                                                        {else}
                                                            <form id="payment-form" method="POST" action="{$module.action|escape:'html':'UTF-8'}">
                                                                {if isset($module.inputs) && $module.inputs}
                                                                    {foreach from = $module.inputs item='input'}
                                                                        <input{foreach from=$input key='key' item='value'} {$key|escape:'html':'UTF-8'}="{$value|escape:'html':'UTF-8'}"{/foreach} />
                                                                    {/foreach}
                                                                {/if}
                                                                <button id="pay-with-{$module.id|escape:'html':'UTF-8'}" style="display:none" type="submit"></button>
                                                            </form>
                                                        {/if}
                                                    </div>
                                                </div>
                                            {/if}
                                        {/foreach}
                                    {/foreach}
                                        
                            
                                    </div>
                                </div>
                            </div>
                            {/if}
                        {elseif $module_name == 'worldlineop'}
                            {assign var="number_part" value=$module.logo|regex_replace:'/.*\/([0-9]+)\.svg$/':'$1'}
                        <div class="ets_payment_method" onclick="setPaymentClick(this)">
                                <div id="{$module.id|escape:'html':'UTF-8'}-container" class="payment-option clearfix" style="display: flex;flex-direction:column;align-items:center;max-width:unset !important;">
                                    <label class="img-payment-method" for="{$module.id|escape:'html':'UTF-8'}">
                                        {if $number_part == 3}
                                            <img src="{$module_template_dir}views/img/mastercard.png" 
                                            style="width: 100%;height:auto !important;max-width:100px !important;max-height:unset !important;" />
                                        {elseif $number_part == 1}
                                            <img src="{$module_template_dir}views/img/visa.png" 
                                            style="width: 100%;height:auto !important;max-width:100px !important;max-height:unset !important;" />
                                        {else}
                                            <img src="{$module.logo}" 
                                            style="width: 100%;height:auto !important;max-width:100px !important;max-height:unset !important;" />
                                        {/if}
                                        {* <img src="{$module_template_dir}views/img/{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}.png" 
                                        style="max-width: 120px !important;width: 100%;" /> *}
                                    </label>
                                    <span class="custom-radio float-xs-left" style="display: none;">
                                        {* <input id="{$module.id|escape:'html':'UTF-8'}"
                                                class="ps-shown-by-js {if $module.module_name}{if $payment_selected==$module.module_name}checked{/if}{else}{if $payment_selected==$module_name}checked{/if}{/if}"
                                                data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                                value="{$module_name|escape:'html':'UTF-8'}"
                                        /> *}
                                        <input id="{$module.id|escape:'html':'UTF-8'}"
                                                class="ps-shown-by-js"
                                                data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                                value="{$module_name|escape:'html':'UTF-8'}"
                                        />
                                        <span></span>
                                    </span>
                                    <form method="GET" class="ps-hidden-by-js" style="display:none;">
                                        <button class="ps-hidden-by-js" type="submit" name="select_payment_option" value="{$module.id|escape:'html':'UTF-8'}">
                                            {l s='Choose' mod='ets_onepagecheckout'}
                                        </button>
                                    </form>
                                    <label for="{$module.id|escape:'html':'UTF-8'}" style="display: none;">
                                        <span>
                                            {if $ETS_OPC_PAYMENT_LOGO_ENABLED}{if isset($module.logo) && $module.logo}<img src="{$module.logo|escape:'html':'UTF-8'}" style="width:40px" />{/if}{/if}
                                            {$module.call_to_action_text|escape:'html':'UTF-8'}
                                        </span>
                                    </label>
                                </div>
                            
                                {* <div id="{$module.id|escape:'html':'UTF-8'}-additional-information" class="js-additional-information definition-list additional-information ps-hidden " style="display: none;">
                                    {$module.additionalInformation nofilter}
                                </div> *}
                                <div id="pay-with-{$module.id|escape:'html':'UTF-8'}-form" class="js-payment-option-form ps-hidden " {if $payment_selected==$module.module_name}  style="color:red; display:none"{else}style="display: none;"{/if}>
                                    {if $module.form}
                                        {$module.form nofilter}
                                    {else}
                                        <form id="payment-form" method="POST" action="{$module.action|escape:'html':'UTF-8'}">
                                            {if isset($module.inputs) && $module.inputs}
                                                {foreach from = $module.inputs item='input'}
                                                    <input{foreach from=$input key='key' item='value'} {$key|escape:'html':'UTF-8'}="{$value|escape:'html':'UTF-8'}"{/foreach} />
                                                {/foreach}
                                            {/if}
                                            <button id="pay-with-{$module.id|escape:'html':'UTF-8'}" style="display:none" type="submit"></button>
                                        </form>
                                    {/if}
                                </div>
                            </div>
                        {else}
                            <div class="ets_payment_method"  onclick="setPaymentClick(this)">
                                <div id="{$module.id|escape:'html':'UTF-8'}-container" class="payment-option clearfix" 
                                style="display: flex;flex-direction:column;align-items:center;max-width:unset !important;">
                                    <label class="img-payment-method" for="{$module.id|escape:'html':'UTF-8'}">
                                        <img src="{$module_template_dir}views/img/{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}.png" 
                                        style="width: 100%;height:auto !important;max-width:100px !important;max-height:unset !important;" />
                                    </label>
                                    <span class="custom-radio float-xs-left" style="display: none;">
                                        {* <input id="{$module.id|escape:'html':'UTF-8'}"
                                                class="ps-shown-by-js {if $module.module_name}{if $payment_selected==$module.module_name}checked{/if}{else}{if $payment_selected==$module_name}checked{/if}{/if}"
                                                data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                                value="{$module_name|escape:'html':'UTF-8'}"
                                        /> *}
                                        <input id="{$module.id|escape:'html':'UTF-8'}"
                                                class="ps-shown-by-js"
                                                data-module-name="{if $module.module_name}{$module.module_name|escape:'html':'UTF-8'}{else}{$module_name|escape:'html':'UTF-8'}{/if}" name="payment-option" type="radio"
                                                value="{$module_name|escape:'html':'UTF-8'}"
                                        />
                                        <span></span>
                                    </span>
                                    <form method="GET" class="ps-hidden-by-js" style="display:none;">
                                        <button class="ps-hidden-by-js" type="submit" name="select_payment_option" value="{$module.id|escape:'html':'UTF-8'}">
                                            {l s='Choose' mod='ets_onepagecheckout'}
                                        </button>
                                    </form>
                                    <label for="{$module.id|escape:'html':'UTF-8'}" style="display: none;">
                                        <span>
                                            {if $ETS_OPC_PAYMENT_LOGO_ENABLED}{if isset($module.logo) && $module.logo}<img src="{$module.logo|escape:'html':'UTF-8'}" style="width:40px" />{/if}{/if}
                                            {$module.call_to_action_text|escape:'html':'UTF-8'}
                                        </span>
                                    </label>
                                </div>
                            
                                {* <div id="{$module.id|escape:'html':'UTF-8'}-additional-information" class="js-additional-information definition-list additional-information ps-hidden " {if $payment_selected==$module.module_name} style="display:none"{else}style="display: none;"{/if}>
                                    {$module.additionalInformation nofilter}
                                </div> *}
                                <div id="pay-with-{$module.id|escape:'html':'UTF-8'}-form" class="js-payment-option-form ps-hidden " {if $payment_selected==$module.module_name}  style="color:red; display:none"{else}style="display: none;"{/if}>
                                    {if $module.form}
                                        {$module.form nofilter}
                                    {else}
                                        <form id="payment-form" method="POST" action="{$module.action|escape:'html':'UTF-8'}">
                                            {if isset($module.inputs) && $module.inputs}
                                                {foreach from = $module.inputs item='input'}
                                                    <input{foreach from=$input key='key' item='value'} {$key|escape:'html':'UTF-8'}="{$value|escape:'html':'UTF-8'}"{/foreach} />
                                                {/foreach}
                                            {/if}
                                            <button id="pay-with-{$module.id|escape:'html':'UTF-8'}" style="display:none" type="submit"></button>
                                        </form>
                                    {/if}
                                </div>
                            </div>
                        {/if}
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

    function setPaymentClick(e) {
        const payment_methods = document.querySelectorAll("#checkout-payment-step .payment-options .ets_payment_method")
        payment_methods.forEach((m) => m.classList.remove("payment_method_selected"));

        e.classList.add("payment_method_selected");
    }

</script>