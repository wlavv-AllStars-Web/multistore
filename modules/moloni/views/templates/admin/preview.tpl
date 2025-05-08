<pre>{$moloni|print_r}</pre>
<div class="page_preview">
    <p>Moloni - <span>Encomenda #{$resultPrev.order.base.id_order}</span></p>

    <form method='POST' id='moloniOptionsPreview' action='{$moloni.configurations.formSave|escape:'html':'UTF-8'}'>
        <div class="preview_container">
            <div class="preview_serie col-sm-12">
                <div class="col-sm-6">
                    <label>
                        {l s='Document set' mod='moloni'}
                    </label>
                    <select name='options[document_set]'>
                        <option value='' disabled selected>{l s='Select your document set' mod='moloni'}</option>
                        {foreach from=$moloni.configurations.document_set.options item=opt}
                            <option value='{$opt.document_set_id|escape:'html':'UTF-8'}'
                                {if $moloni.configurations.document_set.value == $opt.document_set_id} selected {/if}>
                                {$opt.name|escape:'html':'UTF-8'} </option>
                        {/foreach}
                    </select>
                </div>
            </div>

            <div class="preview_data_cliente col-sm-12" style="margin-top: 2rem;">
                <fieldset class="client_data_container">
                    <legend>{l s='Client data' mod='moloni'}</legend>
                    <div class="col-sm-6">
                        <div class="name_client">
                            <label>
                                {l s='Name' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_name]"
                                value="{$resultPrev.moloniClient.moloniCustomer.name|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client name' mod='moloni'}" />
                        </div>
                        <div class="nif_client">
                            <label>
                                {l s='Nif' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_nif]"
                                value="{$resultPrev.moloniClient.moloniCustomer.vat|default:'999999999'|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client nif' mod='moloni'}" />
                        </div>
                        <div class="postal_code_client">
                            <label>
                                {l s='Postal Code' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_postal_code]"
                                value="{$resultPrev.moloniClient.moloniCustomer.zip_code|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client postal code' mod='moloni'}" />
                        </div>
                        <div class="country_client">
                            <label>
                                {l s='Country' mod='moloni'}
                            </label>
                            <select name='options[client_country]' disabled>
                                <option value='' disabled selected>{l s='Select your country' mod='moloni'}</option>
                                {foreach from=$resultPrev.countries item=opt}
                                    <option value='{$opt.country_id|escape:'html':'UTF-8'}'
                                        {if $resultPrev.order.fiscal_zone.country_id == $opt.country_id} selected {/if}>
                                        {$opt.name|escape:'html':'UTF-8'} </option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="address_client">
                            <label>
                                {l s='Address' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_address]"
                                value="{$resultPrev.moloniClient.moloniCustomer.address|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client address' mod='moloni'}" />
                        </div>
                        <div class="location_client">
                            <label>
                                {l s='Location' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_location]"
                                value="{$resultPrev.moloniClient.moloniCustomer.city|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client location' mod='moloni'}" />
                        </div>
                    </div>

                    <div class="col-sm-6 data_client_hidden">
                        <div class="reference_client">
                            <label>
                                {l s='Reference' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_reference]"
                                value="{$resultPrev.order.base.id_customer|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client reference' mod='moloni'}" />
                        </div>
                        <div class="email_client">
                            <label>
                                {l s='Email' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_email]"
                                value="{$resultPrev.moloniClient.moloniCustomer.email|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client email' mod='moloni'}" />
                        </div>
                        <div class="phone_client">
                            <label>
                                {l s='Phone' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_phone]"
                                value="{$resultPrev.moloniClient.moloniCustomer.phone|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client phone' mod='moloni'}" />
                        </div>
                        <div class="website_client">
                            <label>
                                {l s='Website' mod='moloni'}
                            </label>
                            <input type="text" name="options[client_website]"
                                value="{$moloni.configurations.client.website|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client website' mod='moloni'}" />
                        </div>
                        <div class="notes_client">
                            <label>
                                {l s='Notes' mod='moloni'}
                            </label>
                            <textarea name="options[client_notes]" rows="4"
                                value="{$moloni.configurations.client.notes|escape:'html':'UTF-8'}"
                                placeholder="{l s='Client notes' mod='moloni'}"></textarea>
                        </div>
                        <div class="maturity_date_client">
                            <label>
                                {l s='Maturity Date' mod='moloni'}
                            </label>
                            <select name='options[maturity_date]'>
                                <option value='' disabled selected>{l s='Maturity date' mod='moloni'}</option>
                                {foreach from=$moloni.configurations.maturity_date.options item=opt}
                                    <option value='{$opt.maturity_date_id|escape:'html':'UTF-8'}'
                                        {if $moloni.configurations.maturity_date.value == $opt.maturity_date_id} selected
                                        {/if}> {$opt.name|escape:'html':'UTF-8'} </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="preview_products col-sm-12" style="margin-top: 2rem;">
                {foreach from=$resultPrev.invoice.products item=product name=productLoop}
                    {if !$smarty.foreach.productLoop.last}
                        <fieldset>
                            <legend>{$product.name|escape:'html':'UTF-8'}</legend>
                            <div class="col-sm-6">
                                <div class="name_product">
                                    <label>
                                        {l s='Name' mod='moloni'}
                                    </label>
                                    <input type="text" name="options[product_name]"
                                        value="{$product.name|escape:'html':'UTF-8'}" />
                                </div>
                                <div class="reference_product">
                                    <label>
                                        {l s='Reference' mod='moloni'}
                                    </label>
                                    <input type="text" name="options[product_reference]"
                                        value="{$product.reference|escape:'html':'UTF-8'}" />
                                </div>
                                <div class="notes_product">
                                    <label>
                                        {l s='Notes' mod='moloni'}
                                    </label>
                                    <textarea name="options[product_notes]" rows="4"
                                        value="{$product.summary|escape:'html':'UTF-8'}"
                                        placeholder="{l s='Product notes' mod='moloni'}"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="price_product">
                                    <label>
                                        {l s='Price' mod='moloni'}
                                    </label>
                                    <input type="text" name="options[product_reference]"
                                        value="{$product.price|escape:'html':'UTF-8'}" />
                                </div>
                                <div class="quantity_product">
                                    <label>
                                        {l s='Quantity' mod='moloni'}
                                    </label>
                                    <input type="text" name="options[product_reference]"
                                        value="{$product.qty|escape:'html':'UTF-8'}" />
                                </div>
                                <div class="vat_product">
                                    <label>
                                        {l s='VAT' mod='moloni'}%
                                    </label>
                                    <input type="text" name="options[product_reference]"
                                        value="{$product.taxes[0].tax_rate|escape:'html':'UTF-8'}" />
                                </div>
                                <div class="exemption_product">
                                    <label>
                                        {l s='Exemption' mod='moloni'}
                                    </label>
                                    <select name='options[exemption_reason]'>
                                        {foreach from=$moloni.configurations.exemption_reason.options item=opt}
                                            <option value='{$opt.code|escape:'html':'UTF-8'}'
                                                {if $moloni.configurations.exemption_reason.value == $opt.code} selected {/if}>
                                                {$opt.name|escape:'html':'UTF-8'} ({$opt.code|escape:'html':'UTF-8'})
                                            </option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>

                        </fieldset>
                    {/if}
                {/foreach}
            </div>

            <div class="preview_costs_shipping col-sm-12">
            </div>

            <div class="btn_submit col-sm-12" style="margin-top: 2rem;">
                <button type="submit" class="btn btn-info" name="submitPreview" value="1">
                    {l s='Generate invoice' mod='moloni'}
                </button>
            </div>
        </div>

    </form>
</div>