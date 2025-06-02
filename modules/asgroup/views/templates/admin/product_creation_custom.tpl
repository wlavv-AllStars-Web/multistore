<!-- Load the TinyMCE script -->
{* <link href="https://euromuscleparts.com/js/tiny_mce/skins/prestashop/skin.min.css" type="text/css" rel="stylesheet">
<link href="https://euromuscleparts.com/js/tiny_mce/skins/prestashop/content.min.css" type="text/css" rel="stylesheet"> *}


<div class="tab-container-product-creation-custom row">
    <div class="col-lg-9">
        <!-- Product Reference and EAN Section -->
        <div class="form-group">
            <div id="product_details_references" class="form-columns-3">
                <div class="form-group text-widget">
                    <label for="product_details_references_reference">
                        Reference
                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="Allowed special characters: .-_#" data-placement="top">
                        </span>
                    </label>
                    {* <input type="text" class="form-control sync-input" data-sync="reference"
                        value="{$product->reference}"> *}
                    <input type="text" class="form-control" name="product[asg][reference]"
                        value="{$product->reference}">
                </div>

                <div class="form-group text-widget">
                    <label for="product_details_references_ean_13">
                        EAN-13 or JAN barcode
                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="This type of product code is specific to Europe and Japan, but is widely used internationally."
                            data-placement="top">
                        </span>
                    </label>
                    {* <input type="text" class="form-control sync-input" data-sync="ean_13" value="{$product->ean13}"> *}
                    <input type="text" class="form-control" name="product[asg][ean13]" value="{$product->ean13}">
                </div>

                <div class="form-group text-widget">
                    <label title="h2" for="product_details_housing">
                        Housing
                    </label>
                    <input type="text" class="form-control" name="product[asg][housing]" value="{$product->housing}">
                </div>
            </div>
        </div>

        <!-- Translations Section for Short Description and Full Description -->

        <div class="translations tabbable" id="product_description_description_short_custom" tabindex="1">
            <label title="h2" for="product_custom_short">
                Short desc.
            </label>
            <ul class="translationsLocales nav nav-pills">
                {foreach from=$languages item=language}
                    <li class="nav-item">
                        <a href="#" data-locale="{$language.iso_code}"
                            class="{if $language.iso_code == 'en'}active{/if} nav-link" data-toggle="tab"
                            data-target=".translationsFields-product_description_description_short_{$language.id_lang}">
                            {$language.iso_code|upper}
                        </a>
                    </li>
                {/foreach}
            </ul>

            <div class="translationsFields tab-content">
                <!-- Short Description Textarea -->
                {foreach from=$languages item=language}
                    <div data-locale="{$language.iso_code}" class="translationsFields-product_description_description_short_{$language.id_lang} 
                         tab-pane translation-field panel panel-default {if $language.iso_code == 'en'}show active{/if} 
                         translation-label-{$language.iso_code}">
                        <!-- TinyMCE Textarea for Short Description -->
                        <textarea
                            id="description_short_{$language.id_lang}"
                            name="product[asg][description_short][{$language.id_lang}]"
                            class="form-control tinymce-textarea"
                            rows="5">
                            {$product->description_short[$language.id_lang]|escape:'htmlall':'UTF-8'}
                        </textarea>

                        <small class="form-text text-muted text-right maxLength maxType">
                            <em>
                                <span class="currentLength">0</span> of <span class="currentTotalMax">800</span> characters
                                allowed
                            </em>
                        </small>
                    </div>
                {/foreach}
            </div>
        </div>

        <!-- Full Description Section -->
        <div class="translations tabbable" id="product_description_full_description_custom" tabindex="2">
            <label title="h2" for="product_custom_description">
                Description
            </label>
            <ul class="translationsLocales nav nav-pills">
                {foreach from=$languages item=language}
                    <li class="nav-item">
                        <a href="#" data-locale="{$language.iso_code}"
                            class="{if $language.iso_code == 'en'}active{/if} nav-link" data-toggle="tab"
                            data-target=".translationsFields-product_description_full_description_{$language.id_lang}">
                            {$language.iso_code|upper}
                        </a>
                    </li>
                {/foreach}
            </ul>

            <div class="translationsFields tab-content">
                <!-- Full Description Textarea -->
                {foreach from=$languages item=language}
                    <div data-locale="{$language.iso_code}" class="translationsFields-product_description_full_description_{$language.id_lang} 
                         tab-pane translation-field panel panel-default {if $language.iso_code == 'en'}show active{/if} 
                         translation-label-{$language.iso_code}">
                        <!-- TinyMCE Textarea for Full Description -->
                        <textarea
                            id="description_long_{$language.id_lang}"
                            name="product[asg][description_long][{$language.id_lang}]"
                            class="form-control tinymce-textarea-description"
                            rows="5">
                            {$product->description[$language.id_lang]|escape:'htmlall':'UTF-8'}
                        </textarea>


                        <small class="form-text text-muted text-right maxLength maxType">
                            <em>
                                <span class="currentLength">0</span> of <span class="currentTotalMax">800</span> characters
                                allowed
                            </em>
                        </small>
                    </div>
                {/foreach}
            </div>
        </div>

        <div class="form-group">
            <div id="custom_notes_asg">
                <label>Notes</label>
                <textarea name="product[asg][notes]" class="form-control" rows="3">{$product->notes}</textarea>
            </div>
        </div>


<div class="form-group">
    <h3>Tags</h3>
    <p class="subtitle">Enter the keywords that customers might search for when looking for this product.</p>

    <div class="" style="display: flex;gap: 1rem;">
        <div class="input-group locale-input-group js-locale-input-group d-flex" id="product_seo_tags" tabindex="1">
            {foreach from=$languages item=language name=langLoop}
                <div data-lang-id="{$language.id_lang}"
                    class="js-taggable-field js-locale-input js-locale-{$language.iso_code}{if !$smarty.foreach.langLoop.first} d-none{/if}"
                    style="flex-grow: 1;">

                    <div class="tokenfield">
                        {if isset($product->tags[$language.id_lang])}
                            {assign var="tags" value=$product->tags[$language.id_lang]}
                        {else}
                            {assign var="tags" value=[]}
                        {/if}

                        {if is_array($tags)}
                            {assign var="tags_string" value=""}  {* Initialize an empty string for concatenation *}

                            {foreach from=$tags item=tag}
                                {assign var="tags_string" value=$tags_string|cat:$tag|cat:','}  {* Concatenate each tag with a comma *}
                            {/foreach}

                            {assign var="tags_string" value=$tags_string|substr:0:-1}  {* Remove the last comma *}
                        {else}
                            {assign var="tags_string" value=$tags}
                        {/if}

                        <input type="text"
                            id="product_seo_tags_{$language.id_lang}"
                            name="product[asg][tags][{$language.id_lang}]"
                            class="js-taggable-field form-control"
                            aria-label="product_seo_tags_{$language.id_lang} input"
                            value="{$tags_string|escape:'html'}"
                            style="position: absolute; left: -10000px;"
                            tabindex="-1">
                        <input type="text" style="position: absolute; left: -10000px;" tabindex="-1">

                        <input type="text"
                            class="token-input"
                            autocomplete="off"
                            placeholder=""
                            id="product_seo_tags_{$language.id_lang}-tokenfield"
                            tabindex="0"
                            style="min-width: 60px; width: 0px;"
                            maxlength="32">
                    </div>
                </div>
            {/foreach}
        </div>
        <div class="dropdown" style="padding: .15rem;">
            <button class="btn btn-outline-secondary dropdown-toggle js-locale-btn"
                    type="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    id="product_seo_tags_dropdown"
                    style="display: flex;align-items: center;">
                {if isset($languages.0.iso_code)}{$languages.0.iso_code|upper}{/if}
            </button>
            <div class="dropdown-menu dropdown-menu-right locale-dropdown-menu" aria-labelledby="product_seo_tags_dropdown">
                {foreach from=$languages item=language}
                    <span class="dropdown-item js-locale-item"
                        data-locale="{$language.iso_code}">
                        {$language.name} ({$language.iso_code|capitalize})
                    </span>
                {/foreach}
            </div>
        </div>
    </div>

    <span class="btn btn-info" onclick="generateTagsASG()">Generate Tags</span>


</div>




    </div>

    <div class="col-lg-3">

        <div class="form-group">
            <label for="product_visibility">Visibility</label>
            <select class="form-control" id="product_visibility" name="product[asg][visibility]">
                <option value="both" {if $product->visibility == 'both'}selected="selected"{/if}>Everywhere</option>
                <option value="catalog" {if $product->visibility == 'catalog'}selected="selected"{/if}>Catalog only</option>
                <option value="search" {if $product->visibility == 'search'}selected="selected"{/if}>Search only</option>
                <option value="none" {if $product->visibility == 'none'}selected="selected"{/if}>Nowhere</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product_description_wmpackqt">Qty Pack</label>
            <input type="text" class="form-control" id="product_description_wmpackqt" name="product[asg][wmpackqt]"
                placeholder="Enter quantity per pack" value="{$product->wmpackqt}">
        </div>

        <div class="form-row">
            <div class="form-group col-lg-4">
                <label for="product_description_ec_approved_0">
                    Ec approved
                    <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                        data-content="Ec approved helper." data-placement="top" title=""></span>
                </label>

                <div class="input-group">
                    <span class="ps-switch" id="product_description_ec_approved">
                    <input type="radio" id="product_description_ec_approved_0" name="product[asg][ec_approved]" value="0"
                        {if isset($product->ec_approved) && $product->ec_approved != 1}checked{/if}>
                    <label for="product_description_ec_approved_0">No</label>

                    <input type="radio" id="product_description_ec_approved_1" name="product[asg][ec_approved]" value="1"
                        {if isset($product->ec_approved) && $product->ec_approved == 1}checked{/if}>
                    <label for="product_description_ec_approved_1">Yes</label>

                    <span class="slide-button"></span>
                    </span>
                </div>
            </div>


            <div class="form-group col-lg-4">
                <label for="product_description_wmdeprecated_0">
                    End of life
                    <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                        data-content="End of life helper." data-placement="top" title=""></span>
                </label>

                <div class="input-group">
                    <span class="ps-switch" id="product_description_wmdeprecated">
                    <input type="radio" id="product_description_wmdeprecated_0" name="product[asg][wmdeprecated]" value="0"
                        {if isset($product->wmdeprecated) && $product->wmdeprecated != 1}checked{/if}>
                    <label for="product_description_wmdeprecated_0">No</label>

                    <input type="radio" id="product_description_wmdeprecated_1" name="product[asg][wmdeprecated]" value="1"
                        {if isset($product->wmdeprecated) && $product->wmdeprecated == 1}checked{/if}>
                    <label for="product_description_wmdeprecated_1">Yes</label>

                    <span class="slide-button"></span>
                    </span>
                </div>
            </div>


            <div class="form-group col-lg-4">
                <label for="product_description_not_to_order_0">
                    Not to order?
                    <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                        data-content="Not to order helper." data-placement="top" title=""></span>
                </label>

                <div class="input-group">
                    <span class="ps-switch" id="product_description_not_to_order">
                    <input type="radio" id="product_description_not_to_order_0" name="product[asg][not_to_order]" value="0"
                        {if isset($product->not_to_order) && $product->not_to_order != 1}checked{/if}>
                    <label for="product_description_not_to_order_0">No</label>

                    <input type="radio" id="product_description_not_to_order_1" name="product[asg][not_to_order]" value="1"
                        {if isset($product->not_to_order) && $product->not_to_order == 1}checked{/if}>
                    <label for="product_description_not_to_order_1">Yes</label>

                    <span class="slide-button"></span>
                    </span>
                </div>
            </div>


        </div>

        <div class="form-group">
            <label>Options</label>
            <div class="input-group">
            
                <div class="form-check col-lg-12">
                <input type="hidden" name="product[asg][show_compat_exception]" value="0">
                <input class="form-check-input" type="checkbox" id="show_compat_exception"
                    name="product[asg][show_compat_exception]" value="1"
                    {if isset($product->show_compat_exception) && $product->show_compat_exception == 1}checked{/if}>
                <label class="form-check-label" for="show_compat_exception">
                    Show compact exception
                </label>
                </div>

                <div class="form-check col-lg-12">
                
                <input type="hidden" name="product[asg][universal]" value="0">

                <input class="form-check-input" type="checkbox" id="universal_product"
                    name="product[asg][universal]" value="1"
                    {if isset($product->universal) && $product->universal == 1}checked{/if}>
                <label class="form-check-label" for="universal_product">
                    Universal product
                </label>
                </div>

            </div>
        </div>


        <div class="form-group">
            <label for="youtube_code_1">YouTube</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="youtube_code_1" name="product[asg][youtube_1]"
                    placeholder="YouTube Code 1" value="{$product->youtube_1}">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="youtube_2" name="product[asg][youtube_2]"
                    placeholder="YouTube Code 2" value="{$product->youtube_2}">
            </div>
        </div>

        <div class="form-group">
            <label for="youtube_code_1">HS Code</label>
            <div class="input-group">
                <input type="text" class="form-control" id="hs_code" name="product[asg][nc]" placeholder="HS Code" value="{$product->nc}">
            </div>
        </div>

        <div class="form-group select-widget"> <label class="text-info" for="product_description_difficulty">
                Instructions Difficulty

            </label> <select id="product_description_difficulty" name="product[asg][difficulty]"
                class="custom-select form-control">
                    <option value="0" {if $product->difficulty == 0}selected{/if}>Default</option>
                    <option value="1" {if $product->difficulty == 1}selected{/if}>1</option>
                    <option value="2" {if $product->difficulty == 2}selected{/if}>2</option>
                    <option value="3" {if $product->difficulty == 3}selected{/if}>3</option>
                    <option value="4" {if $product->difficulty == 4}selected{/if}>4</option>
                    <option value="5" {if $product->difficulty == 5}selected{/if}>5</option>
            </select>

        </div>




    </div>
</div>

<!-- TinyMCE Initialization Script -->
<script src="{$base_url}js/tiny_mce/tinymce.min.js"></script>
<script>
    const buttonSaveProductFooter = document.querySelector("#product_footer_save");

    // Helper function to escape values safely
    function escapeValue(value) {
        return value ? value.replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0') : '';
    }

    // Generate tags based on the product data and append them to the relevant fields
    function generateTagsASG() {
        const tagNames = {};
        {foreach from=$languages item=language}
            tagNames[{$language.id_lang}] = "{$product->name[$language.id_lang]|escape:'javascript'}";
        {/foreach}

        const tagBrand = "{$product->manufacturer_name|escape:'javascript'}";
        const tagRef = "{$product->reference|escape:'javascript'}";
        const tagRefVariations = [];
        {foreach from=$combinations item=combination}
            tagRefVariations.push("{$combination['reference']|escape:'javascript'}");
        {/foreach}

        const tagCompats = new Set();
        {if isset($compats) && is_array($compats)}
            {foreach from=$compats item=compat}
                {if !empty($compat.brand)} tagCompats.add("{$compat.brand|escape:'javascript'}"); {/if}
                {if !empty($compat.model)} tagCompats.add("{$compat.model|escape:'javascript'}"); {/if}
                {if !empty($compat.type)} tagCompats.add("{$compat.type|escape:'javascript'}"); {/if}
                {if !empty($compat.version)} tagCompats.add("{$compat.version|escape:'javascript'}"); {/if}
            {/foreach}
        {/if}

        const uniqueTags = Array.from(tagCompats);
        
        Object.keys(tagNames).forEach(langId => {
            const tagName = tagNames[langId];
            const allTags = [tagName, tagBrand, tagRef, ...tagRefVariations, ...uniqueTags];
            const filteredTags = allTags.map(tag => tag.trim()).filter(tag => tag.length > 0);
            const container = document.querySelector(`#product_seo_tags_${langId}`).closest('.tokenfield');
            const existingTags = Array.from(container.querySelectorAll('.token')).map(token => token.dataset.value);

            // Add the filtered tags to the container if they do not exist
            filteredTags.forEach(tag => {
                if (!existingTags.includes(tag)) {
                    const token = document.createElement('div');
                    token.className = 'token';
                    token.dataset.value = tag;
                    token.innerHTML = `<span class="token-label">${tag}</span><a href="#" class="close">&times;</a>`;
                    token.querySelector('a').addEventListener('click', (e) => { e.preventDefault(); token.remove(); updateHiddenInput(langId); });
                    container.insertBefore(token, container.querySelector('.token-input'));
                }
            });

            updateHiddenInput(langId);
        });

        function updateHiddenInput(langId) {
            const container = document.querySelector(`#product_seo_tags_${langId}`).closest('.tokenfield');
            const tokens = Array.from(container.querySelectorAll('.token'));
            const values = tokens.map(token => token.dataset.value);
            document.querySelector(`#product_seo_tags_${langId}`).value = values.join(', ');
            buttonSaveProductFooter.removeAttribute('disabled');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize tokenfield for each language input
        document.querySelectorAll('.js-taggable-field input[type="text"]:first-child').forEach(input => $(input).tokenfield());

        // Handle the language tab change event
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const langId = this.dataset.lang;
                document.querySelectorAll('.translation-field').forEach(el => el.style.display = 'none');
                const target = document.querySelector('.lang-' + langId);
                if (target) target.style.display = 'block';
            });
        });

        // Initialize TinyMCE on the active tab textarea
        function initTinyMCE(textarea) {
            if (!textarea || textarea.classList.contains('mce-initialized')) return;
            tinymce.init({
                target: textarea,
                valid_elements: '*[*]',
                menubar: false,
                plugins: 'lists link image table code',
                toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
                height: 80,
                statusbar: false,
                path: false,
                skin: 'prestashop',
                content_css: 'https://euromuscleparts.com/js/tiny_mce/skins/prestashop/content.min.css',
                setup(editor) {
                    editor.on('init', () => textarea.classList.add('mce-initialized'));
                    editor.on('change input keyup', () => editor.save());
                }
            });
        }

        // Initialize TinyMCE for the active description fields
        const activeTextareas = document.querySelectorAll('.tab-pane.show.active .tinymce-textarea');
        activeTextareas.forEach(textarea => initTinyMCE(textarea));

        // Initialize TinyMCE when tab changes
        document.querySelectorAll('#product_product_creation_custom_html .translationsLocales a[data-toggle="tab"]').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const targetPane = document.querySelector(tab.getAttribute('data-target'));
                targetPane && initTinyMCE(targetPane.querySelector('.tinymce-textarea'));
            });
        });

        // Handle form submission to sync TinyMCE content
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();
            tinymce.triggerSave(); // Ensure TinyMCE content is saved
            tinymce.editors.forEach(editor => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = editor.target.name;
                hiddenInput.value = editor.getContent();
                this.appendChild(hiddenInput);
            });
            this.submit(); // Proceed with form submission
        });

        // Handle visibility select change
        document.querySelector('#product_visibility')?.addEventListener('change', function () {
            document.querySelector(`#product_options_visibility_visibility input[type="radio"][value="${this.value}"]`)?.checked = true;
        });
    });

    // Clean up unwanted elements from DOM
    window.addEventListener('DOMContentLoaded', () => {
        const elementsToRemove = [
            '#product_details #product_details_references_reference',
            '#product_details #product_details_references_ean_13',
            '#product_details #product_details_housing',
            '#product_description #product_description_description_short',
            '#product_description #product_description_description',
            '#product_seo #product_seo_tags',
            '#product_description #product_description_youtube_1',
            '#product_description #product_description_youtube_2',
            '#product_description #product_description_hs_code',
            '#product_description #product_description_difficulty',
            '#product_description #product_description_ec_approved',
            '#product_description #product_description_wmdeprecated',
            '#product_description #product_description_not_to_order',
        ];

        elementsToRemove.forEach(id => {
            const element = document.querySelector(id)?.parentElement;
            element && element.remove();
        });
    });
</script>


<style>
    .tag-box {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 5px;
    }

    .tag {
        background-color: #007bff;
        color: #fff;
        padding: 3px 8px;
        border-radius: 3px;
        font-size: 13px;
    }

    .tag-temp {
        margin-top: 1rem;
    }

    .lang-tabs button {
        margin-right: 5px;
    }

    .tag-input-wrapper {
        display: none;
    }

    .tag-input-wrapper.active {
        display: block;
    }

    .dropdown-item {
        cursor: pointer;
    }

    #product_options_visibility #product_options_visibility_visibility{
        display: none !important;
    }
</style>