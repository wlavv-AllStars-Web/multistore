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

<div class="js-address-form {$address_type|escape:'html':'UTF-8'}">
<input name="{$address_type|escape:'html':'UTF-8'}[id_address]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->id|intval}{/if}" type="hidden" />
    {if $field_address}
        {if !in_array('country',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
            <input id="{$address_type|escape:'html':'UTF-8'}_id_country" class="form-control form-control-select ets-onepage-js-country" name="{$address_type|escape:'html':'UTF-8'}[id_country]" type="hidden" value="{$id_country|intval}" />
        {/if}
        {foreach from=$field_address key='key' item='field'}
            {if $key=='alias' && in_array('alias',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row ">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label{if in_array('alias',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Alias'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_alias" class="form-control validate{if in_array('alias',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isGenericName" name="{$address_type|escape:'html':'UTF-8'}[alias]" value="{$class_address->alias|trim|escape:'html':'UTF-8'}" maxlength="32" type="text" data-validate-errors="{l s='Alias is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Alias is required'  d='Shop.Theme.Checkout' js=1}" />
                    </div>
                </div>
            {/if}
            {if $key=='firstname' && in_array('firstname',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row firstname col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label  {if in_array('firstname',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='First name'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_firstname" class="form-control validate {if in_array('firstname',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isCustomerName" name="{$address_type|escape:'html':'UTF-8'}[firstname]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->firstname|trim|escape:'html':'UTF-8'}{/if}" maxlength="255"  type="text" data-validate-errors="{l s='First name is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='First name is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/> 
                    </div>
                </div>
            {/if}
            {if $key=='lastname' && in_array('lastname',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row lastname col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label  {if in_array('lastname',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Last name'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_lastname" class="form-control validate {if in_array('lastname',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isCustomerName" name="{$address_type|escape:'html':'UTF-8'}[lastname]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->lastname|trim|escape:'html':'UTF-8'}{/if}" maxlength="255" type="text" data-validate-errors="{l s='Last name is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Last name is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='company' && in_array('company',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row {$address_type|escape:'html':'UTF-8'}_customer_type_invoice col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label  {if in_array('company',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Company'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right  ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_company" class="form-control validate{if in_array('company',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isGenericName" name="{$address_type|escape:'html':'UTF-8'}[company]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->company|trim|escape:'html':'UTF-8'}{/if}" maxlength="255" type="text" data-validate-errors="{l s='Company is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Company is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='address' && in_array('address',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label  {if in_array('address',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Address'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_address1" class="form-control validate {if in_array('address',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isAddress" name="{$address_type|escape:'html':'UTF-8'}[address1]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->address1|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" id="{$address_type|escape:'html':'UTF-8'}_address1" data-validate-errors="{l s='Address is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Address is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='address2' && in_array('address2',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('address2',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Address Complement'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_address2" class="form-control validate{if in_array('address2',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isAddress" name="{$address_type|escape:'html':'UTF-8'}[address2]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->address2|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='Address Complement is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Address Complement is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='other' && in_array('other',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                {* {if $address_type|escape:'html':'UTF-8' == 'invoice_address'}  *}
                    <div class="form-group row  col-lg-12 col-xs-12" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} style="display: none;" {/if}>
                        <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('other',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Additional information'  d='Shop.Theme.Checkout'} </label>
                        <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                            <textarea id="{$address_type|escape:'html':'UTF-8'}_other" class="form-control {if in_array('other',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}"  name="{$address_type|escape:'html':'UTF-8'}[other]" value="" maxlength="128" type="text"  {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}> 
                            </textarea>
                        </div>
                    </div>
                {* {/if} *}
            {/if}
            {if $key=='city' && in_array('city',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('city',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='City'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_city" class="form-control validate{if in_array('city',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isCityName" name="{$address_type|escape:'html':'UTF-8'}[city]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->city|trim|escape:'html':'UTF-8'}{/if}" maxlength="64" type="text" data-validate-errors="{l s='City is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='City is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='state' && in_array('state',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row address_state  col-lg-3 col-xs-12" {if !$states} style="display:none"{/if}>
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label  {if in_array('state',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='State'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        {if $states}
                            <div class="ets_opc_select">
                                <span class="ets_opc_select_arrow">
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                </span>
                                <select id="{$address_type|escape:'html':'UTF-8'}_id_state" class="form-control form-control-select" name="{$address_type|escape:'html':'UTF-8'}[id_state]" id="{$address_type|escape:'html':'UTF-8'}_id_state">
                                    <option value="0">-- {l s='please choose'  d='Shop.Theme.Checkout'} --</option>
                                    {foreach from = $states item='state'}
                                        <option data-iso-code="{$state.iso_code|escape:'html':'UTF-8'}" value="{$state.id_state|intval}" {if $id_state_selected}{if $id_state_selected==$state.id_state} selected="selected"{/if}{else} {if $class_address->id_state== $state.id_state} selected="selected"{/if}{/if}>{$state.name|escape:'html':'UTF-8'}</option>
                                    {/foreach}
                                </select>
                            </div>
                        {/if}
                    </div>
                </div>
            {/if}
            {if $key=='postcode' && in_array('post_code',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('post_code',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Zip Code'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_postal_code" class="form-control validate{if in_array('post_code',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isPostCode" name="{$address_type|escape:'html':'UTF-8'}[postcode]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->postcode|trim|escape:'html':'UTF-8'}{/if}" maxlength="12" type="text" data-validate-errors="{l s='Zip code is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Zip code is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='country' && in_array('country',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('country',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Country'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <div class="ets_opc_select">
                            <span class="ets_opc_select_arrow">
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                </span>
                            <select id="{$address_type|escape:'html':'UTF-8'}_id_country" class="form-control form-control-select ets-onepage-js-country" name="{$address_type|escape:'html':'UTF-8'}[id_country]" data-type="{$address_type|escape:'html':'UTF-8'}" id="{$address_type|escape:'html':'UTF-8'}_country" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}>
                                <option value="">-- {l s='please choose'  d='Shop.Theme.Checkout'} --</option>
                                {if $countries}
                                    {foreach from=$countries item='country'}
                                        <option data-iso-code="{$country.iso_code|escape:'html':'UTF-8'}" value="{$country.id_country|intval}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} {if $country.id_country==$id_country} selected="selected"{/if} {/if}>{$country.name|escape:'html':'UTF-8'}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                </div>
            {/if}
            {if $key=='phone' && in_array('phone',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('phone',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Phone'   d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_phone" class="form-control validate{if in_array('phone',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isPhoneNumber" name="{$address_type|escape:'html':'UTF-8'}[phone]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->phone|trim|escape:'html':'UTF-8'}{/if}" maxlength="32" type="tel" data-validate-errors="{l s='Phone is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Phone is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {else} required {/if} />
                    </div>
                </div>
            {/if}
            {if $key=='phonemobile' && in_array('phone_mobile',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('phone_mobile',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Mobile phone'   d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_phone_mobile" class="form-control validate{if in_array('phone_mobile',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isPhoneNumber" name="{$address_type|escape:'html':'UTF-8'}[phone_mobile]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->phone_mobile|trim|escape:'html':'UTF-8'}{/if}" maxlength="32" type="tel" data-validate-errors="{l s='Mobile phone is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Mobile phone is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if} />
                    </div>
                </div>
            {/if}
            {if $key=='dni' && in_array('dni',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('dni',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Identification number'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_dni" class="form-control validate{if in_array('dni',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isDniLite" name="{$address_type|escape:'html':'UTF-8'}[dni]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->dni|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='Identification number is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Identification number is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div> 
            {/if}
            {if $key=='vatnumber' && in_array('vat_number',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                {if $address_type|escape:'html':'UTF-8' == 'invoice_address'}
                    <div class="form-group row  col-lg-3 col-xs-12">
                        <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('vat_number',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='VAT number'  d='Shop.Theme.Checkout'} </label>
                        <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                            <input id="{$address_type|escape:'html':'UTF-8'}_vat_number" class="form-control validate{if in_array('vat_number',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isGenericName" name="{$address_type|escape:'html':'UTF-8'}[vat_number]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->vat_number|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='VAT number is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='VAT number is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                        </div>
                    </div>
                {/if}
            {/if}
            {if $key=='doornumber' && in_array('door_number',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('door_number',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Door Nº'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_door_number" class="form-control validate{if in_array('door_number',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isAddress" name="{$address_type|escape:'html':'UTF-8'}[door_number]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->door_number|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='Building number is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Building number is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='building' && in_array('building',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('building',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Building'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_building" class="form-control validate{if in_array('building',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isAddress" name="{$address_type|escape:'html':'UTF-8'}[building]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->building|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='Building number is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Building number is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='floor' && in_array('floor',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('floor',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Floor Nº'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_floor" class="form-control validate{if in_array('floor',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isAddress" name="{$address_type|escape:'html':'UTF-8'}[floor]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->floor|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='Floor number is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Floor number is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='stairs' && in_array('stairs',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('stairs',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Stairs Nº'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_stairs" class="form-control validate{if in_array('stairs',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isAddress" name="{$address_type|escape:'html':'UTF-8'}[stairs]" value="{if $address_type|escape:'html':'UTF-8' == 'invoice_address'}{$class_address->stairs|trim|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='Stairs number is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='Stairs number is required'  d='Shop.Theme.Checkout' js=1}" {if $address_type|escape:'html':'UTF-8' == 'invoice_address'} disabled {/if}/>
                    </div>
                </div>
            {/if}
            {if $key=='eicustomertype' && in_array('company',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label " for="field-{$address_type|escape:'html':'UTF-8'}-eicustomertype">
                        {l s='Customer type'  d='Shop.Theme.Checkout'}
                    </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} form-control-valign opc_field_right ">
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input class="{$address_type|escape:'html':'UTF-8'}-eicustomertype" data-type="{$address_type|escape:'html':'UTF-8'}" name="{$address_type|escape:'html':'UTF-8'}[eicustomertype]" type="radio" value="0" {if !isset($class_address->company) || !$class_address->company}checked{/if}>
                              <span></span>
                            </span>
                            {l s='Private'  d='Shop.Theme.Checkout'}
                        </label>
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input class="{$address_type|escape:'html':'UTF-8'}-eicustomertype" data-type="{$address_type|escape:'html':'UTF-8'}" name="{$address_type|escape:'html':'UTF-8'}[eicustomertype]" type="radio" value="1" {if isset($class_address->company) && $class_address->company}checked{/if}>
                              <span></span>
                            </span>
                            {l s='Company'  d='Shop.Theme.Checkout'}
                        </label>
                    </div>
                </div>
            {/if}
            {if $key=='eisdi' && in_array('eisdi',$ETS_OPC_ADDRESS_DISPLAY_FIELD) && in_array('eicustomertype',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row {$address_type|escape:'html':'UTF-8'}_customer_type_invoice  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('eisdi',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='SDI code'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_eisdi" class="form-control validate{if in_array('eisdi',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isGenericName" name="{$address_type|escape:'html':'UTF-8'}[eisdi]" value="{if isset($class_address->eisdi)}{$class_address->eisdi|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='SDI code is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='SDI code is required'  d='Shop.Theme.Checkout' js=1}" />
                    </div>
                </div>
            {/if}
            {if $key=='eipec' && in_array('eipec',$ETS_OPC_ADDRESS_DISPLAY_FIELD) && in_array('eicustomertype',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row {$address_type|escape:'html':'UTF-8'}_customer_type_invoice  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label {if in_array('eipec',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='PEC address'  d='Shop.Theme.Checkout'} </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} opc_field_right ">
                        <input id="{$address_type|escape:'html':'UTF-8'}_eipec" class="form-control validate{if in_array('eipec',$ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isEmail" name="{$address_type|escape:'html':'UTF-8'}[eipec]" value="{if isset($class_address->eipec)}{$class_address->eipec|escape:'html':'UTF-8'}{/if}" maxlength="128" type="text" data-validate-errors="{l s='PEC address is not valid'  d='Shop.Theme.Checkout' js=1}" data-required-errors="{l s='EPC address is required'  d='Shop.Theme.Checkout' js=1}" />
                    </div>
                </div>
            {/if}
            {if $key=='eipa' && in_array('eipa',$ETS_OPC_ADDRESS_DISPLAY_FIELD) && in_array('eicustomertype',$ETS_OPC_ADDRESS_DISPLAY_FIELD)}
                <div class="form-group row {$address_type|escape:'html':'UTF-8'}_customer_type_invoice  col-lg-3 col-xs-12">
                    <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4 col-xs-12{/if} form-control-label " for="field-{$address_type|escape:'html':'UTF-8'}-eipa">
                        {l s='Public Administration'  d='Shop.Theme.Checkout'}
                    </label>
                    <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8 col-xs-12{/if} form-control-valign opc_field_right ">
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input data-type="{$address_type|escape:'html':'UTF-8'}" name="{$address_type|escape:'html':'UTF-8'}[eipa]" type="radio" value="0" {if !isset($class_address->eipa) || !$class_address->eipa}checked{/if}>
                              <span></span>
                            </span>
                            {l s='No'  d='Shop.Theme.Checkout'}
                        </label>
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input data-type="{$address_type|escape:'html':'UTF-8'}" name="{$address_type|escape:'html':'UTF-8'}[eipa]" type="radio" value="1" {if isset($class_address->eipa) && $class_address->eipa}checked{/if}>
                              <span></span>
                            </span>
                            {l s='Yes'  d='Shop.Theme.Checkout'}
                        </label>
                    </div>
                </div>
            {/if}
        {/foreach}

    {/if}
</div>