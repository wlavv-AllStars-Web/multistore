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
<pre>{$delivery_option_list|print_r}</pre>
<div class="delivery-options-list shipping_{$opc_layout|escape:'html':'UTF-8'}">
    <div id="hook-display-before-carrier">
        {if isset($hookDisplayBeforeCarrier)}
            {$hookDisplayBeforeCarrier nofilter}
        {/if}
    </div>
    {if $delivery_option_list}
        {foreach $delivery_option_list as $id_address => $option_list}
            <div class="delivery-options">
                {foreach $option_list as $key => $option}
                    <div class="row delivery-option">
                        <label class="col-sm-12 delivery-option-2" for="delivery_option_{$option.id_carrier|intval}">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 left_content">
                                    <span class="custom-radio">
                <input id="delivery_option_{$option.id_carrier|intval}" reference="{$option.id_reference|intval}" name="delivery_option[{$id_address|intval}]" {if $option.id_carrier|intval == 4} checked {else} {/if}  value="{$key|escape:'html':'UTF-8'}"  type="radio"{if $option.default == 1}checked{/if} />
                                        <span></span>
                                    </span>
                                    <div class="carrier-name-img">
                                        <span class="h6 carrier-name">
                                            {if $ETS_OPC_SHIPPING_LOGO_ENABLED && $option.logo && ($opc_layout == 'layout_2' || $opc_layout == 'layout_4')}
                                                <img src="{$option.logo|escape:'html':'UTF-8'}" alt="{$option.name|escape:'html':'UTF-8'}" style="width:40px"  />
                                            {/if}
                                            {$option.name|escape:'html':'UTF-8'}
                                        </span>
                                        {if $ETS_OPC_SHIPPING_LOGO_ENABLED && $option.logo && $opc_layout != 'layout_2' && $opc_layout != 'layout_4'}
                                            <div class="" style="text-align: left;">
                                                <img src="{$option.logo|escape:'html':'UTF-8'}" alt="{$option.name|escape:'html':'UTF-8'}" style="width:50px"  />
                                            </div>
                                        {/if}

                                    </div>

                                </div>
                                <div class="col-sm-6 col-xs-12 right_content">
                                    <div class="col-xs-12">
                                        <span class="carrier-price">
                                        {if $option.total_price_with_tax && (isset($option.is_free) && $option.is_free == 0)}
                							{if $use_taxes == 1}
                							    {if $priceDisplay == 1}
                								    {displayPrice price=$option.total_price_without_tax} {l s='(Tax excl.)' mod='ets_onepagecheckout'}
                							    {else}
                								    {displayPrice price=$option.total_price_with_tax} {l s='(Tax incl.)' mod='ets_onepagecheckout'}
                							    {/if}
                							{else}
                							    {displayPrice price=$option.total_price_without_tax}
                							{/if}
            						    {else}
            							     {l s='Free' mod='ets_onepagecheckout'}
            						    {/if}
                                        
                                        </span>
                                    </div>
                                    <div class="col-xs-12">
                                        <span class="carrier-delay">{$option.delay|escape:'html':'UTF-8'}</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    {if isset($option.extraContent) && $option.extraContent}
                        <div class="row carrier-extra-content extends_{$option.id_carrier|intval}" {if !in_array($key,$delivery_option_selected)} style="display:none;"{/if}>
                            {$option.extraContent nofilter}
                        </div>
                    {/if}
                {/foreach}
            </div>
        {/foreach}
    {else}
        <div class="alert alert-danger">{l s='Unfortunately, there are no carriers available for your delivery address.' mod='ets_onepagecheckout'}</div>
    {/if}
    <div id="hook-display-after-carrier">
        {if isset($hookDisplayAfterCarrier)}
            {$hookDisplayAfterCarrier nofilter}
        {/if}
    </div>
</div>