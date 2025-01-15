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
                    <div style="font-size:1.25rem;border-bottom: 2px solid #d0d0d0;padding-bottom: .5rem;margin-bottom:.5rem;">{l s="Delivery address" d="Shop.Theme.Checkout"}</div>
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
                    <div style="font-size:1.25rem;border-bottom: 2px solid #d0d0d0;padding-bottom: .5rem;margin-bottom:.5rem;">{l s="Billing address" d="Shop.Theme.Checkout"}</div>
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
            <a class="btn_update_address" href="{$urls.pages.contact}" style="padding: .5rem 1rem;background: #444;color: #fff;">{l s="Update my address" d="Shop.Theme.Checkout"} <i class="material-icons">autorenew</i></a>
        </div>
