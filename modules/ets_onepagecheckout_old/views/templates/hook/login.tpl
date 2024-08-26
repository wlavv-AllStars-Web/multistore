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
{if $customer_logged}
    {$customer_block nofilter}
{else}
    <template id="password-feedback">
        <div class="password-strength-feedback mt-1" style="display: none;">
        <div class="progress-container">
            <div class="progress mb-1">
                <div class="progress-bar" role="progressbar" value="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <script type="text/javascript" class="js-hint-password">
            {literal}  {
                "0":{/literal}
                "{l s='Very weak' mod='ets_onepagecheckout'}"{literal},
                    "1":{/literal}
                "{l s='Weak' mod='ets_onepagecheckout'}"{literal},
                    "2":{/literal}
                "{l s='Average' mod='ets_onepagecheckout'}"{literal},
                    "3":{/literal}"{l s='Strong' mod='ets_onepagecheckout'}"{literal},
                    "4":{/literal}"{l s='Very strong' mod='ets_onepagecheckout'}"{literal},
                    "Straight rows of keys are easy to guess":{/literal}"{l s='Straight rows of keys are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Short keyboard patterns are easy to guess":{/literal}"{l s='Short keyboard patterns are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Use a longer keyboard pattern with more turns":{/literal}"{l s='Use a longer keyboard pattern with more turns' mod='ets_onepagecheckout'}"{literal},
                    "Repeats like \"aaa\" are easy to guess":{/literal}"{l s='Repeats like \"aaa\" are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Repeats like \"abcabcabc\" are only slightly harder to guess than \"abc\"":{/literal}"{l s='Repeats like \"abcabcabc\" are only slightly harder to guess than \"abc\"' mod='ets_onepagecheckout'}"{literal},
                    "Sequences like abc or 6543 are easy to guess":{/literal}"{l s='Sequences like \"abc\"or \"6543\" are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Recent years are easy to guess":{/literal}"{l s='Recent years are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Dates are often easy to guess":{/literal}"{l s='Dates are often easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "This is a top-10 common password":{/literal}"{l s='This is a top-10 common password' mod='ets_onepagecheckout'}"{literal},
                    "This is a top-100 common password":{/literal}"{l s='This is a top-100 common password' mod='ets_onepagecheckout'}"{literal},
                    "This is a very common password":{/literal}"{l s='This is a very common password' mod='ets_onepagecheckout'}"{literal},
                    "This is similar to a commonly used password":{/literal}"{l s='This is similar to a commonly used password' mod='ets_onepagecheckout'}"{literal},
                    "A word by itself is easy to guess":{/literal}"{l s='A word by itself is easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Names and surnames by themselves are easy to guess":{/literal}"{l s='Names and surnames by themselves are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Common names and surnames are easy to guess":{/literal}"{l s='Common names and surnames are easy to guess' mod='ets_onepagecheckout'}"{literal},
                    "Use a few words, avoid common phrases":{/literal}"{l s='Use a few words, avoid common phrases' mod='ets_onepagecheckout'}"{literal},
                    "No need for symbols, digits, or uppercase letters":{/literal}"{l s='No need for symbols, digits, or uppercase letters' mod='ets_onepagecheckout'}"{literal},
                    "Avoid repeated words and characters":{/literal}"{l s='Avoid repeated words and characters' mod='ets_onepagecheckout'}"{literal},
                    "Avoid sequences":{/literal}"{l s='Avoid sequences' mod='ets_onepagecheckout'}"{literal},
                    "Avoid recent years":{/literal}"{l s='Avoid recent years' mod='ets_onepagecheckout'}"{literal},
                    "Avoid years that are associated with you":{/literal}"{l s='Avoid years that are associated with you' mod='ets_onepagecheckout'}"{literal},
                    "Avoid dates and years that are associated with you":{/literal}"{l s='Avoid dates and years that are associated with you' mod='ets_onepagecheckout'}"{literal},
                    "Capitalization doesn't help very much":{/literal}"{l s='Capitalization doesn\'t help very much' mod='ets_onepagecheckout'}"{literal},
                    "All-uppercase is almost as easy to guess as all-lowercase":{/literal}"{l s='All-uppercase is almost as easy to guess as all-lowercase' mod='ets_onepagecheckout'}"{literal},
                    "Reversed words aren't much harder to guess":{/literal}"{l s='Reversed words aren\'t much harder to guess' mod='ets_onepagecheckout'}"{literal},
                    "Predictable substitutions like '@' instead of 'a' don't help very much":{/literal}"{l s='Predictable substitutions like \"@\" instead of \"a\" don\'t help very much' mod='ets_onepagecheckout'}"{literal},
                    "Add another word or two. Uncommon words are better.":{/literal}"{l s='Add another word or two. Uncommon words are better.' mod='ets_onepagecheckout'}"{literal}} {/literal}
        </script>
    </div>
    </template>
    <div class="customer-information">
        <ul class="type-checkout-options">
            {if $ETS_OPC_DEFAULT_ACCOUNT_FORM=='create' || ( !$PS_GUEST_CHECKOUT_ENABLED && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest')}
                <li>
                    <label for="type-checkout-options-3">
                        <input id="type-checkout-options-3" type="radio" name="type-checkout-options" value="create" data-type="create" {if !$is_guest && ($ETS_OPC_DEFAULT_ACCOUNT_FORM=='create' || (!$PS_GUEST_CHECKOUT_ENABLED && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest'))} checked="checked"{/if} />
                        <span>{l s='Create account' mod='ets_onepagecheckout'}</span>
                    </label>
                </li>
                <li>
                    <label for="type-checkout-options-1">
                        <input id="type-checkout-options-1" type="radio" name="type-checkout-options" value="1" data-type="login"{if !$is_guest && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='login'} checked="checked"{/if} />
                        <span>{l s='Log in' mod='ets_onepagecheckout'}</span>
                    </label>
                </li>
                {if $PS_GUEST_CHECKOUT_ENABLED}
                    <li>
                        <label for="type-checkout-options-2">
                            <input id="type-checkout-options-2" type="radio" name="type-checkout-options" value="guest" data-type="guest"{if $is_guest || $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest'} checked="checked"{/if} />
                            <span>{l s='Guest order' mod='ets_onepagecheckout'}</span>
                        </label>
                    </li>
                {/if}
            {elseif $ETS_OPC_DEFAULT_ACCOUNT_FORM=='login'}
                <li>
                    <label for="type-checkout-options-1">
                        <input id="type-checkout-options-1" type="radio" name="type-checkout-options" value="1" data-type="login"{if !$is_guest && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='login'} checked="checked"{/if} />
                        <span>{l s='Log in' mod='ets_onepagecheckout'}</span>
                    </label>
                </li>
                <li>
                    <label for="type-checkout-options-3">
                        <input id="type-checkout-options-3" type="radio" name="type-checkout-options" value="create" data-type="create" {if !$is_guest && ($ETS_OPC_DEFAULT_ACCOUNT_FORM=='create' || (!$PS_GUEST_CHECKOUT_ENABLED && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest'))} checked="checked"{/if} />
                        <span>{l s='Create account' mod='ets_onepagecheckout'}</span>
                    </label>
                </li>
                {if $PS_GUEST_CHECKOUT_ENABLED}
                    <li>
                        <label for="type-checkout-options-2">
                            <input id="type-checkout-options-2" type="radio" name="type-checkout-options" value="guest" data-type="guest"{if $is_guest || $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest'} checked="checked"{/if} />
                            <span>{l s='Guest order' mod='ets_onepagecheckout'}</span>
                        </label>
                    </li>
                {/if}
            {else}
                {if $PS_GUEST_CHECKOUT_ENABLED}
                    <li>
                        <label for="type-checkout-options-2">
                            <input id="type-checkout-options-2" type="radio" name="type-checkout-options" value="guest" data-type="guest"{if $is_guest || $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest'} checked="checked"{/if} />
                            <span>{l s='Guest order' mod='ets_onepagecheckout'}</span>
                        </label>
                    </li>
                {/if}
                <li>
                    <label for="type-checkout-options-1">
                        <input id="type-checkout-options-1" type="radio" name="type-checkout-options" value="1" data-type="login"{if !$is_guest && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='login'} checked="checked"{/if} />
                        <span>{l s='Log in' mod='ets_onepagecheckout'}</span>
                    </label>
                </li>
                <li>
                    <label for="type-checkout-options-3">
                        <input id="type-checkout-options-3" type="radio" name="type-checkout-options" value="create" data-type="create" {if !$is_guest && ($ETS_OPC_DEFAULT_ACCOUNT_FORM=='create' || (!$PS_GUEST_CHECKOUT_ENABLED && $ETS_OPC_DEFAULT_ACCOUNT_FORM=='guest'))} checked="checked"{/if} />
                        <span>{l s='Create account' mod='ets_onepagecheckout'}</span>
                    </label>
                </li>
            {/if}
        </ul>
    </div>
    <div class="form-group row type-checkout-option opc_hasaccount create sugguest" style="display:none;">
        <p>{l s='Already have an account?' mod='ets_onepagecheckout'} <label for="type-checkout-options-1"><a>{l s='Log in instead!' mod='ets_onepagecheckout'}</a></label></p>
    </div>
    <div id="customer-login" class="type-checkout-option login guest create">
        <div class="form-group row type-checkout-option login" style="display:none;">
            <label class="form-control-label required {if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if}">{l s='Email' mod='ets_onepagecheckout'}</label>
            <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                <input name="customer_login[email]" id="customer_login_email" class="form-control validate is_required" type="text" data-validate="isEmail" data-validate-errors="{l s='Email is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Email is required' mod='ets_onepagecheckout' js=1}"/>
            </div>
        </div>
        <div class="form-group row type-checkout-option login" style="display:none;">
            <label class="form-control-label required {if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if}">{l s='Password' mod='ets_onepagecheckout'}</label>
            <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                  <div class="input-group js-parent-focus ets-passw">
                      <input id="customer_login_password" class="js-child-focus js-visible-password form-control validate is_required" name="customer_login[password]" data-validate="isPasswd" title="{l s='At least 5 characters long' mod='ets_onepagecheckout'}" value="" type="password" data-validate-errors="{l s='Password is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Password is required' mod='ets_onepagecheckout' js=1}" />
                      <span class="input-group-btn">
                          <button class="btn ets_password" type="button">
                                <svg class="eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"/></svg>
                                <svg class="un-eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M555 1335l78-141q-87-63-136-159t-49-203q0-121 61-225-229 117-381 353 167 258 427 375zm389-759q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm363-191q0 7-1 9-106 189-316 567t-315 566l-49 89q-10 16-28 16-12 0-134-70-16-10-16-28 0-12 44-87-143-65-263.5-173t-208.5-245q-20-31-20-69t20-69q153-235 380-371t496-136q89 0 180 17l54-97q10-16 28-16 5 0 18 6t31 15.5 33 18.5 31.5 18.5 19.5 11.5q16 10 16 27zm37 447q0 139-79 253.5t-209 164.5l280-502q8 45 8 84zm448 128q0 35-20 69-39 64-109 145-150 172-347.5 267t-419.5 95l74-132q212-18 392.5-137t301.5-307q-115-179-282-294l63-112q95 64 182.5 153t144.5 184q20 34 20 69z"/></svg>
                          </button>
                      </span>
                  </div>
            </div>
        </div>
        {if $PS_GUEST_CHECKOUT_ENABLED}
            {if in_array('social_title',$ETS_OPC_GUEST_DISPLAY_FIELD)}
                <div class="form-group row type-checkout-option social_title_field guest" style="display:none;">
                    <label class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if} form-control-label{if in_array('social_title',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if}">{l s='Social title' mod='ets_onepagecheckout'}</label>
                    <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                        <div id="customer_guest_id_gender" class="form-control-valign">
                          <label class="radio-inline">
                              <span class="custom-radio">
                                <input name="customer_guest[id_gender]" value="1"{if $is_guest && $checkout_customer->id_gender==1} checked="checked"{/if} type="radio" />
                                <span></span>
                              </span>
                              {l s='Mr.' mod='ets_onepagecheckout'}
                          </label>
                          <label class="radio-inline">
                              <span class="custom-radio">
                                <input name="customer_guest[id_gender]" value="2"{if $is_guest && $checkout_customer->id_gender==2} checked="checked"{/if} type="radio" />
                                <span></span>
                              </span>
                              {l s='Mrs.' mod='ets_onepagecheckout'}
                          </label>
                        </div>
                    </div>
                </div>
            {/if}
            {if $opc_layout=='layout_2'}
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <label class="col-md-4 form-control-label required"> {l s='First name' mod='ets_onepagecheckout'}</label>
                            <div class="col-md-8 opc_field_right">
                                <input id="customer_guest_firstname" class="form-control validate is_required" name="customer_guest[firstname]" value="{if $is_guest}{$checkout_customer->firstname|escape:'html':'UTF-8'} {/if}"  type="text" data-validate="isCustomerName" data-validate-errors="{l s='First name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='First name is required' mod='ets_onepagecheckout' js=1}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <label class="col-md-4 form-control-label required"> {l s='Last name' mod='ets_onepagecheckout'}</label>
                            <div class="col-md-8 opc_field_right">
                                <input id="customer_guest_lastname" class="form-control validate is_required" name="customer_guest[lastname]" value="{if $is_guest}{$checkout_customer->lastname|escape:'html':'UTF-8'} {/if}" type="text" data-validate="isCustomerName" data-validate-errors="{l s='Last name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Last name is required' mod='ets_onepagecheckout' js=1}" />
                            </div>
                        </div>
                    </div>
                </div>
            {else}
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <label class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required"> {l s='First name' mod='ets_onepagecheckout'}</label>
                    <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                        <input id="customer_guest_firstname" class="form-control validate is_required" name="customer_guest[firstname]" value="{if $is_guest}{$checkout_customer->firstname|escape:'html':'UTF-8'} {/if}"  type="text" data-validate="isCustomerName" data-validate-errors="{l s='First name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='First name is required' mod='ets_onepagecheckout' js=1}" />
                    </div>
                </div>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <label class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required"> {l s='Last name' mod='ets_onepagecheckout'}</label>
                    <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                        <input id="customer_guest_lastname" class="form-control validate is_required" name="customer_guest[lastname]" value="{if $is_guest}{$checkout_customer->lastname|escape:'html':'UTF-8'} {/if}" type="text" data-validate="isCustomerName" data-validate-errors="{l s='Last name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Last name is required' mod='ets_onepagecheckout' js=1}" />
                    </div>
                </div>
            {/if}

            <div class="form-group row type-checkout-option guest" style="display:none;">
                <label class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required"> {l s='Email' mod='ets_onepagecheckout'}</label>
                <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                    <input id="customer_guest_email" class="form-control validate is_required" name="customer_guest[email]" value="{if $is_guest}{$checkout_customer->email|escape:'html':'UTF-8'} {/if}" type="email" data-validate="isEmail" data-validate-errors="{l s='Email is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Email is required' mod='ets_onepagecheckout' js=1}" />
                </div>
            </div>
            {if in_array('password',$ETS_OPC_GUEST_DISPLAY_FIELD)}
                {if isset($isps18) && $isps18}
                    <div class="field-password-policy">
                        <div class="form-group row type-checkout-option guest" style="display:none;">
                            <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label {if in_array('password',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if}" for="field-password">
                                {l s='Password' mod='ets_onepagecheckout'}
                            </label>
                            <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right js-input-column">
                                <div class="input-group js-parent-focus">
                                    <input id="customer_guest_password" class="form-control js-child-focus js-visible-password validate {if in_array('password',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} is_required{/if}{if isset($isps18) && $isps18} is18{/if}" name="customer_guest[password]" aria-label="Password input"{if isset($PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH)} data-minlength="{$PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH|intval}"{/if}{if isset($PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH)} data-maxlength="{$PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH|intval}"{/if}{if isset($PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE)} data-minscore="{$PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE|intval}"{/if} value="" pattern=".{literal}{5,}{/literal}" type="password" data-required-errors="{l s='Password is required' mod='ets_onepagecheckout' js=1}">
                                </div>
                                <div>
                                    <div class="password-strength-feedback mt-3" style="display: none;">
                                        <div class="progress-container">
                                            <div class="progress mb-1">
                                                <div class="progress-bar" role="progressbar" value="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="password-strength-text"></div>
                                        <div class="password-requirements">
                                            <p class="password-requirements-length" data-translation="{l s='Enter a password between %s and %s characters' mod='ets_onepagecheckout' js=1}">
                                                <i class="material-icons">check_circle</i>
                                                <span>{l s='Enter a password between 8 and 72 characters' mod='ets_onepagecheckout'}</span>
                                            </p>
                                            <p class="password-requirements-score" data-translation="{l s='The minimum score must be: %s' mod='ets_onepagecheckout' js=1}">
                                                <i class="material-icons">check_circle</i>
                                                <span>{l s='The minimum score must be: Strong' mod='ets_onepagecheckout'}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-control-comment">
                            </div>
                        </div>
                    </div>
                {else}
                    <div class="form-group row type-checkout-option guest " style="display:none;">
                        <label class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if} form-control-label{if in_array('password',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if}">{l s='Password' mod='ets_onepagecheckout'} </label>
                        <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                              <div class="input-group js-parent-focus ets-passw">
                                  <input id="customer_guest_password" class="form-control js-child-focus js-visible-password validate {if in_array('password',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isPasswd" name="customer_guest[password]" title="{l s='At least 5 characters long' mod='ets_onepagecheckout'}" value="" type="password" data-validate-errors="{l s='Password is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Password is required' mod='ets_onepagecheckout' js=1}" />
                                  <span class="input-group-btn">
                                      <button class="btn ets_password" type="button">
                                            <svg class="eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"/></svg>
                                            <svg class="un-eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M555 1335l78-141q-87-63-136-159t-49-203q0-121 61-225-229 117-381 353 167 258 427 375zm389-759q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm363-191q0 7-1 9-106 189-316 567t-315 566l-49 89q-10 16-28 16-12 0-134-70-16-10-16-28 0-12 44-87-143-65-263.5-173t-208.5-245q-20-31-20-69t20-69q153-235 380-371t496-136q89 0 180 17l54-97q10-16 28-16 5 0 18 6t31 15.5 33 18.5 31.5 18.5 19.5 11.5q16 10 16 27zm37 447q0 139-79 253.5t-209 164.5l280-502q8 45 8 84zm448 128q0 35-20 69-39 64-109 145-150 172-347.5 267t-419.5 95l74-132q212-18 392.5-137t301.5-307q-115-179-282-294l63-112q95 64 182.5 153t144.5 184q20 34 20 69z"/></svg>
                                      </button>
                                  </span>
                              </div>
                              <span class="help-block">{l s='Enter password to create an account for your next order' mod='ets_onepagecheckout'}</span>
                        </div>
                    </div>
                {/if}
            {/if}
            {if in_array('birthday',$ETS_OPC_GUEST_DISPLAY_FIELD)}
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <label class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-4{/if} form-control-label{if in_array('birthday',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Birthday' mod='ets_onepagecheckout'} </label>
                    <div class="{if $opc_layout=='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                        <input id="customer_guest_birthday" class="form-control validate {if in_array('birthday',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate="isBirthDate" name="customer_guest[birthday]" value="{if $is_guest}{$checkout_customer->birthday|escape:'html':'UTF-8'} {/if}" placeholder="{$date_format_lite|escape:'html':'UTF-8'}" type="text" data-validate-errors="{l s='Birthday is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Birthday is required' mod='ets_onepagecheckout' js=1}" />
                        <span class="form-control-comment"> ({l s='E.g.:' mod='ets_onepagecheckout'} {$date_eg|escape:'html':'UTF-8'}) </span>
                    </div>
                </div>
            {/if}
            {if Configuration::get('PS_CUSTOMER_OPTIN')}
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    {if $opc_layout =='layout_2'}
                        <div class="col-md-4"></div>
                    {/if}
                    <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_guest_optin">
                        <span class="checkbox">
                            <label for="customer_guest_optin_check" class="form-control-label{if in_array('optin',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                                <input id="customer_guest_optin_check" name="customer_guest[optin]" value="1" type="checkbox"{if ($is_guest && $checkout_customer->optin==1) || $ETS_OPC_CHECK_BOX_OFFERS} checked="checked"{/if} /><i class="ets_checkbox"></i>
                                {l s='Receive offers from our partners' mod='ets_onepagecheckout'}
                            </label>
                        </span>
                    </div>
                </div>
            {/if}
            {if Module::isEnabled('ps_emailsubscription') && in_array('newsletter',$ETS_OPC_GUEST_DISPLAY_FIELD)}
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    {if $opc_layout =='layout_2'}
                        <div class="col-md-4"></div>
                    {/if}
                    <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_guest_newsletter">
                        <span class="checkbox">
                            <label for="customer_guest_newsletter_check" class="form-control-label{if in_array('newsletter',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                                <input id="customer_guest_newsletter_check" name="customer_guest[newsletter]" value="1" type="checkbox"{if ($is_guest && $checkout_customer->newsletter==1) || $ETS_OPC_CHECK_BOX_NEWSLETTER} checked="checked"{/if} /><i class="ets_checkbox"></i>
                                {l s='Sign up for our newsletter' mod='ets_onepagecheckout'}<br />
                            </label>
                            <p class="form_desc">{$NW_CONDITIONS nofilter}</p>
                        </span>
                    </div>
                </div>
            {/if}
            {if Module::isEnabled('psgdpr') && Configuration::get('PSGDPR_CREATION_FORM_SWITCH')}
                <div class="form-group row type-checkout-option guest " style="display:none;">
                    {if $opc_layout =='layout_2'}
                        <div class="col-md-4"></div>
                    {/if}
                    <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_guest_psgdpr">
                        <span class="checkbox ">
                            <label for="customer_guest_psgdpr_check" class="form-control-label{if in_array('psgdpr',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                                <input id="customer_guest_psgdpr_check" name="customer_guest[psgdpr]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                                {$gdpr_text nofilter}
                            </label>
                        </span>
                    </div>
                </div>
            {/if}
            {if Module::isEnabled('ps_dataprivacy') && in_array('customer_privacy',$ETS_OPC_GUEST_DISPLAY_FIELD)}
                <div class="form-group row type-checkout-option guest " style="display:none;">
                    {if $opc_layout =='layout_2'}
                        <div class="col-md-4"></div>
                    {/if}
                    <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_guest_customer_privacy">
                        <span class="checkbox ">
                            <label for="customer_guest_customer_privacy_check" class="form-control-label{if in_array('customer_privacy',$ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                                <input id="customer_guest_customer_privacy_check" name="customer_guest[customer_privacy]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                                {l s='Customer data privacy' mod='ets_onepagecheckout'}<br />
                            </label>
                            <p class="form_desc">{$CUSTPRIV_MSG_AUTH nofilter}</p>
                        </span>
                    </div>
                </div>
            {/if}
        {/if}
        {if in_array('social_title',$ETS_OPC_CREATEACC_DISPLAY_FIELD)}
            <div class="form-group row type-checkout-option social_title_field create" style="display:none;">
                <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label{if in_array('social_title',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} required{/if}">{l s='Social title' mod='ets_onepagecheckout'}</label>
                <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                    <div class="form-control-valign" id="customer_create_id_gender">
                      <label class="radio-inline">
                          <span class="custom-radio">
                            <input name="customer_create[id_gender]" value="1" type="radio" />
                            <span></span>
                          </span>
                          {l s='Mr.' mod='ets_onepagecheckout'}
                      </label>
                      <label class="radio-inline">
                          <span class="custom-radio">
                            <input name="customer_create[id_gender]" value="2" type="radio" />
                            <span></span>
                          </span>
                          {l s='Mrs.' mod='ets_onepagecheckout'}
                      </label>
                    </div>
                </div>
            </div>
        {/if}
        {if $opc_layout=='layout_2'}
            <div class="form-group row type-checkout-option create " style="display:none;">
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <label class="col-md-4 form-control-label required"> {l s='First name' mod='ets_onepagecheckout'}</label>
                        <div class="col-md-8 opc_field_right">
                            <input id="customer_create_firstname" class="form-control validate is_required" data-validate="isCustomerName" name="customer_create[firstname]" value="" type="text" data-validate-errors="{l s='First name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='First name is required' mod='ets_onepagecheckout' js=1}" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <label class="col-md-4 form-control-label required"> {l s='Last name' mod='ets_onepagecheckout'}</label>
                        <div class="col-md-8 opc_field_right">
                            <input id="customer_create_lastname" class="form-control validate is_required" name="customer_create[lastname]" data-validate="isCustomerName" value="" type="text" data-validate-errors="{l s='Last name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Last name is required' mod='ets_onepagecheckout' js=1}" />
                        </div>
                    </div>
                </div>
            </div>
        {else}
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required"> {l s='First name' mod='ets_onepagecheckout'}</label>
                <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                    <input id="customer_create_firstname" class="form-control validate is_required" data-validate="isCustomerName" name="customer_create[firstname]" value="" type="text" data-validate-errors="{l s='First name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='First name is required' mod='ets_onepagecheckout' js=1}" />
                </div>
            </div>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required"> {l s='Last name' mod='ets_onepagecheckout'}</label>
                <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                    <input id="customer_create_lastname" class="form-control validate is_required" name="customer_create[lastname]" data-validate="isCustomerName" value="" type="text" data-validate-errors="{l s='Last name is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Last name is required' mod='ets_onepagecheckout' js=1}" />
                </div>
            </div>
        {/if}

        <div class="form-group row type-checkout-option create " style="display:none;">
            <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required"> {l s='Email' mod='ets_onepagecheckout'}</label>
            <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                <input id="customer_create_email" class="form-control validate is_required" data-validate="isEmail" data-validate-errors="{l s='Email is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Email is required' mod='ets_onepagecheckout' js=1}" name="customer_create[email]" value="" type="email" />
            </div>
        </div>
        {if isset($isps18) && $isps18}
        <div class="field-password-policy">
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required" for="field-password">
                    {l s='Password' mod='ets_onepagecheckout'}
                </label>
                <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right js-input-column">
                    <div class="input-group js-parent-focus">
                        <input id="customer_create_password" class="form-control js-child-focus js-visible-password validate is_required{if isset($isps18) && $isps18} is18{/if}" name="customer_create[password]" aria-label="Password input"{if isset($PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH)} data-minlength="{$PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH|intval}"{/if}{if isset($PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH)} data-maxlength="{$PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH|intval}"{/if}{if isset($PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE)} data-minscore="{$PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE|intval}"{/if} value="" pattern=".{literal}{5,}{/literal}" type="password" data-required-errors="{l s='Password is required' mod='ets_onepagecheckout' js=1}">
                    </div>
                    <div>
                        <div class="password-strength-feedback mt-3" style="display: none;">
                            <div class="progress-container">
                                <div class="progress mb-1">
                                    <div class="progress-bar" role="progressbar" value="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="password-strength-text"></div>
                            <div class="password-requirements">
                                <p class="password-requirements-length" data-translation="{l s='Enter a password between %s and %s characters' mod='ets_onepagecheckout' js=1}">
                                    <i class="material-icons">check_circle</i>
                                    <span>{l s='Enter a password between 8 and 72 characters' mod='ets_onepagecheckout'}</span>
                                </p>
                                <p class="password-requirements-score" data-translation="{l s='The minimum score must be: %s' mod='ets_onepagecheckout' js=1}">
                                    <i class="material-icons">check_circle</i>
                                    <span>{l s='The minimum score must be: Strong' mod='ets_onepagecheckout'}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 form-control-comment">
                </div>
            </div>
        </div>
        {else}
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label required">{l s='Password' mod='ets_onepagecheckout'} </label>
                <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                    <div class="input-group js-parent-focus ets-passw">
                        <input id="customer_create_password" class="form-control js-child-focus js-visible-password validate is_required" data-validate-errors="{l s='Password is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Password is required' mod='ets_onepagecheckout' js=1}" data-validate="isPasswd" name="customer_create[password]" title="{l s='At least 5 characters long' mod='ets_onepagecheckout'}" value="" type="password" />
                        <span class="input-group-btn">
                          <button class="btn ets_password" type="button" data-action="ets-show-password">
                                <svg class="eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"/></svg>
                                <svg class="un-eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M555 1335l78-141q-87-63-136-159t-49-203q0-121 61-225-229 117-381 353 167 258 427 375zm389-759q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm363-191q0 7-1 9-106 189-316 567t-315 566l-49 89q-10 16-28 16-12 0-134-70-16-10-16-28 0-12 44-87-143-65-263.5-173t-208.5-245q-20-31-20-69t20-69q153-235 380-371t496-136q89 0 180 17l54-97q10-16 28-16 5 0 18 6t31 15.5 33 18.5 31.5 18.5 19.5 11.5q16 10 16 27zm37 447q0 139-79 253.5t-209 164.5l280-502q8 45 8 84zm448 128q0 35-20 69-39 64-109 145-150 172-347.5 267t-419.5 95l74-132q212-18 392.5-137t301.5-307q-115-179-282-294l63-112q95 64 182.5 153t144.5 184q20 34 20 69z"/></svg>
                          </button>
                      </span>
                    </div>
                </div>
            </div>
        {/if}
        {if in_array('birthday',$ETS_OPC_CREATEACC_DISPLAY_FIELD)}
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-4{/if} form-control-label{if in_array('birthday',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} required{/if}"> {l s='Birthday' mod='ets_onepagecheckout'} </label>
                <div class="{if $opc_layout =='layout_3'}col-md-12{else}col-md-8{/if} opc_field_right">
                    <input id="customer_create_birthday" class="form-control validate {if in_array('birthday',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} is_required{/if}" data-validate-errors="{l s='Birthday is not valid' mod='ets_onepagecheckout' js=1}" data-required-errors="{l s='Birthday is required' mod='ets_onepagecheckout' js=1}" data-validate="isBirthDate" name="customer_create[birthday]" value="" placeholder="{$date_format_lite|escape:'html':'UTF-8'}" type="text" />
                    <span class="form-control-comment"> ({l s='E.g.:' mod='ets_onepagecheckout'} {$date_eg|escape:'html':'UTF-8'}) </span>
                </div>
            </div>
        {/if}
        <div class="row type-checkout-option create guest">
            {hook h='displayCustomerAccountForm'}
        </div>
        {if Configuration::get('PS_CUSTOMER_OPTIN')}
            <div class="form-group row type-checkout-option create" style="display:none;">
                {if $opc_layout =='layout_2'}
                    <div class="col-md-4"></div>
                {/if}
                <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_create_optin">
                    <span class="checkbox">
                        <label for="customer_create_optin_check" class="form-control-label{if in_array('optin',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                            <input id="customer_create_optin_check" name="customer_create[optin]" value="1" type="checkbox" {if $ETS_OPC_CHECK_BOX_OFFERS} checked=""{/if} /><i class="ets_checkbox"></i>
                            {l s='Receive offers from our partners' mod='ets_onepagecheckout'}
                        </label>
                    </span>
                </div>
            </div>
        {/if}
        {if Module::isEnabled('ps_emailsubscription') && in_array('newsletter',$ETS_OPC_CREATEACC_DISPLAY_FIELD)}
            <div class="form-group row type-checkout-option create" style="display:none;">
                {if $opc_layout =='layout_2'}
                    <div class="col-md-4"></div>
                {/if}
                <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_create_newsletter">
                    <span class="checkbox">
                        <label for="customer_create_newsletter_check" class="form-control-label{if in_array('newsletter',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                            <input id="customer_create_newsletter_check" name="customer_create[newsletter]" value="1" type="checkbox"{if $ETS_OPC_CHECK_BOX_NEWSLETTER} checked=""{/if} /><i class="ets_checkbox"></i>
                            {l s='Sign up for our newsletter' mod='ets_onepagecheckout'}
                        </label>
                        <p class="form_desc">{$NW_CONDITIONS nofilter}</p>
                    </span>
                </div>
            </div>
        {/if}
        {if Module::isEnabled('psgdpr') && Configuration::get('PSGDPR_CREATION_FORM_SWITCH')}
            <div class="form-group row type-checkout-option create " style="display:none;">
                {if $opc_layout =='layout_2'}
                    <div class="col-md-4"></div>
                {/if}
                <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_create_psgdpr">
                    <span class="checkbox ">
                        <label for="customer_create_psgdpr_check" class="form-control-label{if in_array('psgdpr',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                            <input id="customer_create_psgdpr_check" name="customer_create[psgdpr]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                            {$gdpr_text nofilter}
                        </label>
                    </span>
                </div>
            </div>
        {/if}
        {if Module::isEnabled('ps_dataprivacy') && in_array('customer_privacy',$ETS_OPC_CREATEACC_DISPLAY_FIELD)}
            <div class="form-group row type-checkout-option create agree_field" style="display:none;">
                {if $opc_layout =='layout_2'}
                    <div class="col-md-4"></div>
                {/if}
                <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-md-12{/if}" id="customer_create_customer_privacy">
                    <span class="checkbox ">
                        <label for="customer_create_customer_privacy_check" class="form-control-label{if in_array('customer_privacy',$ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED)} required{/if} ets_checkinput">
                            <input id="customer_create_customer_privacy_check" name="customer_create[customer_privacy]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                            {l s='Customer data privacy' mod='ets_onepagecheckout'}
                        </label>
                        <p class="form_desc">{$CUSTPRIV_MSG_AUTH nofilter}</p>
                    </span>
                </div>
            </div>
        {/if}
        {if $ETS_OPC_CAPTCHA_ENABLED && ($ETS_OPC_LOGIN_CAPTCHA_ENABLED || $ETS_OPC_GUEST_CAPTCHA_ENABLED || $ETS_OPC_CREATEACC_CAPTCHA_ENABLED)}
            <div class="form-group row type-checkout-option catpcha_field {if $ETS_OPC_LOGIN_CAPTCHA_ENABLED} login{/if}{if $ETS_OPC_GUEST_CAPTCHA_ENABLED} guest{/if}{if $ETS_OPC_CREATEACC_CAPTCHA_ENABLED} create{/if} " style="display:none;">
                {if $opc_layout =='layout_2'}
                    <div class="col-md-4"></div>
                {/if}
                <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-xs-12 col-sm-12{/if}">
                    {if $ETS_OPC_CAPTCHA_TYPE=='google-v3'}
                        <script src="https://www.google.com/recaptcha/api.js?render={$ETS_OPC_CAPTCHA_SITE_V3|escape:'html':'UTF-8'}"></script>
                        <script>
                            var login_google3_site_key='{$ETS_OPC_CAPTCHA_SITE_V3|escape:'html':'UTF-8'}';
                        </script>
                        <input type="hidden" id="login-g-recaptcha-response-3" value="" name="g-recaptcha-response"/>
                    {else}
                        <div id="login_g_recaptcha_response_2"></div>
                        <script>
                            var login_google2_site_key='{$ETS_OPC_CAPTCHA_SITE_V2|escape:'html':'UTF-8'}';
                            var login_captcha_loadCallback = function() {
                                login_g_recaptcha_response_2 =grecaptcha.render(document.getElementById('login_g_recaptcha_response_2'), {
                                    'sitekey':login_google2_site_key,
                                    'theme':'light'
                                });
                            }
                        </script>
                        <script src="https://www.google.com/recaptcha/api.js?onload=login_captcha_loadCallback&render=explicit" async defer></script>
                    {/if}
                </div>
            </div>
        {/if}
        <div class="row type-checkout-option login opc_forgot_submit" style="display:none;">
            {if $opc_layout =='layout_2'}
                <div class="col-md-4"></div>
            {/if}
            <div class="{if $opc_layout =='layout_2'}col-md-8{else} col-xs-12 col-sm-12{/if}">
                <div class="forgot-password">
                    <a href="{$link->getPageLink('password')|escape:'html':'UTF-8'}" rel="nofollow">
                      {l s='Forgot your password?' mod='ets_onepagecheckout'}
                    </a>
                </div>
                <button type="submit" name="submitCustomerLogin" class="btn-primary">{l s='Sign In' mod='ets_onepagecheckout'}</button>
            </div>
        </div>
        {if $ETS_OPC_PAGE_ENABLED_SOCIAL && in_array('checkout_page',$ETS_OPC_PAGE_ENABLED_SOCIAL) && $list_socials }
            <div class="row type-checkout-option login create" style="display:none;">
                <div class="opc_social_form col-xs-12 col-sm-12">
                    <div class="opc_solo_or"><span>{l s='OR log in with' mod='ets_onepagecheckout'}</span></div>
                    <ul class="opc_social">
                        {if $list_socials}
                            {foreach from=$list_socials item='social'}
                                <li class="opc_social_item {Tools::strtolower($social)|escape:'html':'UTF-8'} active{if strtolower($social) == 'google'}{if $ETS_OPC_GOOGLE_STYLE} {$ETS_OPC_GOOGLE_STYLE|escape:'html':'UTF-8'}{else} light{/if}{/if}" data-auth="{$social|escape:'html':'UTF-8'}" title="{if Tools::strtolower($social) == 'paypal'}{l s='Sign in with Paypal' mod='ets_onepagecheckout'}{elseif Tools::strtolower($social) == 'facebook'}{l s='Sign in with Facebook' mod='ets_onepagecheckout'}{elseif Tools::strtolower($social) == 'google'}{l s='Sign in with Google' mod='ets_onepagecheckout'}{/if}">
                                    <span class="opc_social_btn medium rounded custom">
                                        
                                        {if Tools::strtolower($social) == 'paypal'}
                                            <i class="ets_svg_icon">
                                                <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1647 646q18 84-4 204-87 444-565 444h-44q-25 0-44 16.5t-24 42.5l-4 19-55 346-2 15q-5 26-24.5 42.5t-44.5 16.5h-251q-21 0-33-15t-9-36q9-56 26.5-168t26.5-168 27-167.5 27-167.5q5-37 43-37h131q133 2 236-21 175-39 287-144 102-95 155-246 24-70 35-133 1-6 2.5-7.5t3.5-1 6 3.5q79 59 98 162zm-172-282q0 107-46 236-80 233-302 315-113 40-252 42 0 1-90 1l-90-1q-100 0-118 96-2 8-85 530-1 10-12 10h-295q-22 0-36.5-16.5t-11.5-38.5l232-1471q5-29 27.5-48t51.5-19h598q34 0 97.5 13t111.5 32q107 41 163.5 123t56.5 196z"/></svg>
                                            </i>
                                        {else if Tools::strtolower($social) == 'facebook'}
                                            <i class="ets_svg_icon">
                                                <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z"/></svg>
                                            </i>
                                        {else if Tools::strtolower($social) == 'google'}
                                            <i class="ets_svg_icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="16" height="16">
                                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                                    </svg>
                                            </i>
                                        {else}
                                            <i class="icon icon-{Tools::strtolower($social)|escape:'html':'UTF-8'} fa fa-{Tools::strtolower($social)|escape:'html':'UTF-8'}"></i>
                                        {/if} {$social|escape:'html':'UTF-8'}
                                    </span>
                                </li>
                            {/foreach}
                        {/if}
                    </ul>
                </div>
            </div>
        {/if}
        <div class="form-group row type-checkout-option opc_hasaccount login sugguest" style="display:none;">
            <p>{l s='No account?' mod='ets_onepagecheckout'} <label for="type-checkout-options-3"><a>{l s='Create one here' mod='ets_onepagecheckout'}</a></label></p>
        </div>
        <div class="clearfix"></div>
    </div>
{/if}