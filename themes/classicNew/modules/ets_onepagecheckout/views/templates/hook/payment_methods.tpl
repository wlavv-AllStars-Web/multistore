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
        <div class="payment-options">
            <form></form>
            {if $payment_methods}
                {foreach from=$payment_methods key='module_name' item='payment_method'}
                    {foreach from=$payment_method item='module'}
                        <div class="ets_payment_method">
                            <div id="{$module.id|escape:'html':'UTF-8'}-container" class="payment-option clearfix">
                                <label for="{$module.id|escape:'html':'UTF-8'}">
                                    <span class="custom-radio float-xs-left">
                                        <input id="{$module.id|escape:'html':'UTF-8'}"
                                                class="ps-shown-by-js {if $module.module_name}{if $payment_selected==$module.module_name}checked{/if}{else}{if $payment_selected==$module_name}checked{/if}{/if}"
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
                                
                                    <span>
                                        {if $ETS_OPC_PAYMENT_LOGO_ENABLED}{if isset($module.logo) && $module.logo}<img src="{$module.logo|escape:'html':'UTF-8'}" style="width:40px" />{/if}{/if}
                                        {$module.call_to_action_text|escape:'html':'UTF-8'}
                                    </span>
                                </label>
                            </div>
                            <div id="{$module.id|escape:'html':'UTF-8'}-additional-information" class="js-additional-information definition-list additional-information ps-hidden " {if $payment_selected==$module.module_name} style="display:block"{else}style="display: none;"{/if}>
                                {$module.additionalInformation nofilter}
                            </div>
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
                    {/foreach}
                {/foreach}
            {else}
                <div class="alert alert-danger">{l s='Unfortunately, there are no payment methods available.' mod='ets_onepagecheckout'}</div>
            {/if}
        </div>
        {hook h='displayPaymentByBinaries'}
    </div>
</section>