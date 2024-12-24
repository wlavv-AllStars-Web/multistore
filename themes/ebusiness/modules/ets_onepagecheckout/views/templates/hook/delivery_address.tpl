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

{if $customer['is_logged']}
    {* {assign var="customer_group" value=$customer_group_professional} *}


    {if !$customer_group_professional}
    <div class="title yes_invoice_address" >{l s='Delivery address' mod='ets_onepagecheckout'}</div>

        {if $list_address}
            {if $use_address}
                <div class="form-group row">
                    <label class="col-md-4 form-control-label required"> {l s='Use address' mod='ets_onepagecheckout'} </label>
                    <div class="col-md-8 opc_field_right">
                        <div class="shipping_address_form">
                                <div class="ets_opc_select">
                                    <span class="ets_opc_select_arrow">
                                        <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                    </span>
                                    <select id="use_shipping_address" name="shipping_address[id_address]" class="form-control" data-type="shipping_address">
                                        <option value="" disabled="" selected="">-- {l s='please choose' mod='ets_onepagecheckout'} --</option>
                                        {foreach from=$list_address item='address'}
                                            <option value="{$address.id_address|intval}"{if $address.id_address==$id_address} selected="selected"{/if}>{$address.alias|escape:'html':'UTF-8'}</option>
                                        {/foreach}
                                        <option value="new">{l s='Enter new address' mod='ets_onepagecheckout'}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
            {else}
                <input id="use_shipping_address" type="hidden" name="shipping_address[id_address]" value="{$id_address|intval}" data-type="shipping_address" />
            {/if}
        {/if}
        {$address_form nofilter}
        {if $use_address_invoice}
            <p class="no_invoice_address">{l s='The selected address will be used both as your personal address (for invoice) and as your delivery address.' mod='ets_onepagecheckout'}</p>
            <div class="form-group row ">
                <label for="use_another_address_for_invoice" class="ets_checkinput">
                <input type="checkbox" name="use_another_address_for_invoice" id="use_another_address_for_invoice" value="1" />&nbsp;<i class="ets_checkbox"></i>{l s='Use another address for invoice' mod='ets_onepagecheckout'}</label>
                
            </div>
        {/if}

    {else}
        <div class="container-addresses d-flex">
            <div id="delivery-addresses_professional" style="float: none;padding:1rem;flex: .5;">
                {assign var="last_id_address" value=max(array_keys($customer.addresses))}
                {foreach from=$customer.addresses[$last_id_address] item=item key=key name=name}
                    {if $key == 'id'}
                    <input type="hidden" name="shipping_address[id_address]" value="{$item}"/>
                    {else}
                        <input type="hidden" name="shipping_address[{$key}]" value="{$item}"/>
                    {/if}
                {/foreach}

                <div class="delivery_addresses_professional_title">
                    <div style="font-size:1.25rem;border-bottom: 2px solid #d0d0d0;padding-bottom: .5rem;margin-bottom:.5rem;">Delivery address</div>
                </div>
                <div class="customer_name">
                    {$customer.firstname} {$customer.lastname}
                </div>
                <div class="customer_address">
                    {$customer.addresses[$last_id_address]['address1']}
                </div>
                <div class="customer_postcode">
                    {$customer.addresses[$last_id_address]['postcode']} {$customer.addresses[$last_id_address]['city']}
                </div>
                <div class="customer_country">
                    {$customer.addresses[$last_id_address]['country']}
                </div>
                <div class="customer_phone">
                    {$customer.addresses[$last_id_address]['phone']}
                </div>
            </div>

            <div id="billing-addresses_professional" style="float: none;padding:1rem;flex: .5;">
                {assign var="last_id_address" value=max(array_keys($customer.addresses))}
                {foreach from=$customer.addresses[$last_id_address] item=item key=key name=name}
                    {if $key == 'id'}
                        <input type="hidden" name="invoice_address[id_address]" value="{$item}"/>
                    {else}
                        <input type="hidden" name="invoice_address[{$key}]" value="{$item}"/>
                    {/if}
                {/foreach}
                <div class="billing_addresses_professional_title">
                    <div style="font-size:1.25rem;border-bottom: 2px solid #d0d0d0;padding-bottom: .5rem;margin-bottom:.5rem;">Billing address</div>
                </div>
                <div class="customer_name">
                    {$customer.firstname} {$customer.lastname}
                </div>
                <div class="customer_address">
                    {$customer.addresses[$last_id_address]['address1']}
                </div>
                <div class="customer_postcode">
                    {$customer.addresses[$last_id_address]['postcode']} {$customer.addresses[$last_id_address]['city']}
                </div>
                <div class="customer_country">
                    {$customer.addresses[$last_id_address]['country']}
                </div>
                <div class="customer_phone">
                    {$customer.addresses[$last_id_address]['phone']}
                </div>
            </div>
        </div>
        <div class="btn_update_address_container" style="padding: 1rem;">
            <a class="btn_update_address" href="{$urls.pages.contact}" style="padding: .5rem 1rem;background: #444;color: #fff;">Update my address <i class="material-icons">autorenew</i></a>
        </div>

    {/if}
{/if}