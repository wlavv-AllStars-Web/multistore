<div class="page_preview">
    <p>Moloni - <span>Encomenda #1</span></p>

    <div class="preview_container">
        <div class="preview_serie col-sm-12">
            <div class="col-sm-6">
                <label>
                    {l s='Document set' mod='moloni'}
                </label>
                <select name='options[document_set]'>
                    <option value='' disabled selected>{l s='Select your document set' mod='moloni'}</option>
                    {foreach from=$moloni.configurations.document_set.options item=opt}
                        <option value='{$opt.document_set_id|escape:'html':'UTF-8'}' {if $moloni.configurations.document_set.value == $opt.document_set_id} selected {/if}> {$opt.name|escape:'html':'UTF-8'} </option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="preview_data_cliente col-sm-12 mt-3">
            <fieldset class="client_data_container">
                <legend>{l s='Client data' mod='moloni'}</legend>
                <div class="col-sm-6">
                    <div class="name_client">
                        <label>
                            {l s='Name' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_name]" value="{$moloni.configurations.client.name|escape:'html':'UTF-8'}" placeholder="{l s='Client name' mod='moloni'}" />
                    </div>
                    <div class="nif_client">
                        <label>
                            {l s='Nif' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_nif]" value="{$moloni.configurations.client.nif|escape:'html':'UTF-8'}" placeholder="{l s='Client nif' mod='moloni'}" />
                    </div>
                    <div class="postal_code_client">
                        <label>
                            {l s='Postal Code' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_postal_code]" value="{$moloni.configurations.client.postal_code|escape:'html':'UTF-8'}" placeholder="{l s='Client postal code' mod='moloni'}" />
                    </div>
                    <div class="country_client">
                        <label>
                            {l s='Country' mod='moloni'}
                        </label>
                        <select name='options[client_country]'>
                            <option value='' disabled selected>{l s='Select your country' mod='moloni'}</option>
                            {foreach from=$moloni.configurations.client.country.options item=opt}
                                <option value='{$opt.country_id|escape:'html':'UTF-8'}' {if $moloni.configurations.client.country.value == $opt.country_id} selected {/if}> {$opt.name|escape:'html':'UTF-8'} </option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 data_client_hidden">
                    <div class="reference_client">
                        <label>
                            {l s='Reference' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_reference]" value="{$moloni.configurations.client.reference|escape:'html':'UTF-8'}" placeholder="{l s='Client reference' mod='moloni'}" />
                    </div>
                    <div class="email_client">
                        <label>
                            {l s='Email' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_email]" value="{$moloni.configurations.client.email|escape:'html':'UTF-8'}" placeholder="{l s='Client email' mod='moloni'}" />
                    </div>
                    <div class="phone_client">
                        <label>
                            {l s='Phone' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_phone]" value="{$moloni.configurations.client.phone|escape:'html':'UTF-8'}" placeholder="{l s='Client phone' mod='moloni'}" />
                    </div>
                    <div class="website_client">
                        <label>
                            {l s='Website' mod='moloni'}
                        </label>
                        <input type="text" name="options[client_website]" value="{$moloni.configurations.client.website|escape:'html':'UTF-8'}" placeholder="{l s='Client website' mod='moloni'}" />
                    </div>
                    <div class="notes_client">
                        <label>
                            {l s='Notes' mod='moloni'}
                        </label>
                        <textarea name="options[client_notes]" rows="4" value="{$moloni.configurations.client.notes|escape:'html':'UTF-8'}" placeholder="{l s='Client notes' mod='moloni'}"></textarea>
                    </div>
                </div>
            </fieldset>
        </div>

    </div>
</div>