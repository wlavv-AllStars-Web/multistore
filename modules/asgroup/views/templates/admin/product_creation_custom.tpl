<!-- Load the TinyMCE script -->

<link href"https://euromuscleparts.com/js/tiny_mce/skins/prestashop/skin.min.css" type="text/css">
</link>
<link href"https://euromuscleparts.com/js/tiny_mce/skins/prestashop/content.min.css" type="text/css">
</link>

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
                    <input type="text" class="form-control sync-input" data-sync="reference"
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
                    <input type="text" class="form-control sync-input" data-sync="ean_13" value="{$product->ean13}">
                </div>

                <div class="form-group text-widget">
                    <label title="h2" for="product_details_housing">
                        Housing
                    </label>
                    <input type="text" class="form-control sync-input" data-sync="housing" value="{$product->housing}">
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
                        <textarea name="product[asg][description_short][{$language.id_lang}]"
                            class="form-control tinymce-textarea" rows="5">
                                    {$product->description_short[$language.id_lang]|escape:'html'}
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
                        <textarea name="product[asg][description_long][{$language.id_lang}]"
                            class="form-control tinymce-textarea-description" rows="5"
                            value="{$product->description[$language.id_lang]}">
                                    {$product->description[$language.id_lang]|escape:'html'}
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
                <textarea name="product[asg][notes]" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label><strong>Tags</strong></label>
            <div class="lang-tabs">
                {foreach from=$languages item=lang}
                    <button type="button" class="btn btn-sm btn-secondary" onclick="switchLang({$lang.id_lang})"
                        id="lang-btn-{$lang.id_lang}">
                        {$lang.iso_code|upper}
                    </button>
                {/foreach}
            </div>

            <div id="tags_inputs">
                {foreach from=$languages item=lang}
                    <div class="tokenfield form-control mt-1 tag-input-wrapper lang-{$lang.id_lang} {if $lang@first}active{/if}"
                        id="tag-wrapper-{$lang.id_lang}">
                        <input type="text" class="js-taggable-field form-control mb-2 tags-storage "
                            id="tags_input_{$lang.id_lang}" name="product[asg][tags][{$lang.id_lang}]"
                            placeholder="Enter tag and press Enter" readonly style="display:none">

                        <div class="tag-box" id="tag_box_{$lang.id_lang}"></div>
                    </div>
                {/foreach}
            </div>

            <button type="button" class="btn btn-info mt-2" onclick="generateTags()">Generate Tags</button>
        </div>


    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <label>Type</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="product_type" id="standard_product" value="standard"
                    checked>
                <label class="form-check-label" for="standard_product">
                    Standard product
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="product_type" id="pack_product" value="pack">
                <label class="form-check-label" for="pack_product">
                    Pack of existing products
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="product_visibility">Visibility</label>
            <select class="form-control" id="product_visibility" name="product_visibility">
                <option value="everywhere">Everywhere</option>
                <option value="catalog">Catalog only</option>
                <option value="search">Search only</option>
                <option value="nowhere">Nowhere</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product_ec_approved">Ec approved</label>
            <select class="form-control" id="product_ec_approved" name="product_ec_approved">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        
        <div class="form-group"> <label class="">
                End of life


                <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                    data-content="End of life helper." data-placement="top" data-original-title="" title="">
                </span>
            </label>
            <div class="input-group "><span class="ps-switch" id="product_description_wmdeprecated"><input
                        id="product_description_wmdeprecated_0" class="ps-switch"
                        name="product[description][wmdeprecated]" value="0" checked="" type="radio"><label
                        for="product_description_wmdeprecated_0">No</label><input
                        id="product_description_wmdeprecated_1" class="ps-switch"
                        name="product[description][wmdeprecated]" value="1" type="radio"><label
                        for="product_description_wmdeprecated_1">Yes</label><span class="slide-button"></span></span>
            </div>
        </div>
    </div>
</div>

<!-- TinyMCE Initialization Script -->
<script src="{$base_url}js/tiny_mce/tinymce.min.js"></script>
<script>
    // generate tags

    let currentLangId = {$languages[0].id_lang}; // default to first language
    const reference = document.getElementById('reference')?.value || 'REF123';
    const brand = 'MyBrand';

    function switchLang(langId) {
        currentLangId = langId;
        document.querySelectorAll('.tag-input-wrapper').forEach(wrapper => {
            wrapper.classList.remove('active');
        });
        document.getElementById('tag-wrapper-' + langId).classList.add('active');

        document.querySelectorAll('.lang-tabs button').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-secondary');
        });
        document.getElementById('lang-btn-' + langId).classList.remove('btn-secondary');
        document.getElementById('lang-btn-' + langId).classList.add('btn-primary');
    }

    function addTag(langId, text) {
        if (!text) return;

        const tagBox = document.getElementById('tag_box_' + langId);
        const input = document.getElementById('tags_input_' + langId);

        let currentTags = input.value ? input.value.split(',') : [];
        if (currentTags.includes(text)) return;

        currentTags.push(text);
        input.value = currentTags.join(',');

        const tag = document.createElement('div');
        tag.className = 'token';
        tag.setAttribute('data-value', text);

        const span = document.createElement('span');
        span.className = 'token-label';
        span.style.maxWidth = '1508.18px';
        span.textContent = text;

        const close = document.createElement('a');
        close.href = '#';
        close.className = 'close';
        close.tabIndex = -1;
        close.innerHTML = '×';

        close.addEventListener('click', function(e) {
            e.preventDefault();
            tag.remove();
            currentTags = currentTags.filter(tagText => tagText !== text);
            input.value = currentTags.join(',');
        });

        tag.appendChild(span);
        tag.appendChild(close);
        tagBox.appendChild(tag);

        document.querySelector("#product_footer_save").removeAttribute("disabled")
    }

    function generateTags() {
        addTag(currentLangId, reference);
        addTag(currentLangId, brand);
    }

    // Add tag on Enter key in .tag-temp inputs
    document.querySelectorAll('.tag-temp').forEach(input => {
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const value = this.value.trim();
                const langId = this.dataset.lang;
                if (value) {
                    addTag(langId, value);
                    this.value = '';
                }
            }
        });
    });

    // Function to initialize TinyMCE on a textarea if not already initialized
    function initTinyMCEOnElement(textarea) {
        if (!textarea || textarea.classList.contains('mce-initialized')) return;

        tinymce.init({
            target: textarea,
            menubar: false,
            plugins: 'lists link image table code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
            height: 80,
            statusbar: false, // Disable the status bar
            path: false, // Disable the path toolbar
            setup: function(editor) {
                editor.on('init', function() {
                    textarea.classList.add('mce-initialized');
                    // After initialization, remove the mce-path element
                    const mcePath = document.querySelector('.mce-path');
                    if (mcePath) {
                        mcePath.remove();
                    }
                });
            }
        });
    }

    // Initialize TinyMCE for the active tab on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize TinyMCE for the active tab on page load
        const activeShortDescriptionTextarea = document.querySelector(
            '#product_product_creation_custom_html .tab-pane.show.active .tinymce-textarea');
        if (activeShortDescriptionTextarea && !activeShortDescriptionTextarea.classList.contains(
                'mce-container')) {
            initTinyMCEOnElement(activeShortDescriptionTextarea);
        }

        const activeDescriptionTextarea = document.querySelector(
            '#product_product_creation_custom_html .tab-pane.show.active .tinymce-textarea-description');
        if (activeDescriptionTextarea && !activeDescriptionTextarea.classList.contains('mce-container')) {
            initTinyMCEOnElement(activeDescriptionTextarea);
        }

        // Add click event to each language tab
        document.querySelectorAll(
            '#product_product_creation_custom_html .translationsLocales a[data-toggle="tab"]').forEach(
            tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent default anchor behavior

                    // Deactivate all tabs and panes
                    document.querySelectorAll(
                        '#product_product_creation_custom_html .translationsLocales a').forEach(
                        t => t.classList.remove('active'));
                    document.querySelectorAll('#product_product_creation_custom_html .tab-pane')
                        .forEach(pane => {
                            pane.classList.remove('show', 'active');
                        });

                    // Activate clicked tab
                    this.classList.add('active');
                    const targetSelector = this.getAttribute('data-target');
                    const targetPane = document.querySelector(targetSelector);

                    if (targetPane) {
                        targetPane.classList.add('show', 'active');

                        // Find the textarea inside the pane and initialize TinyMCE for short description
                        const shortDescriptionTextarea = targetPane.querySelector(
                            '.tinymce-textarea');
                        if (shortDescriptionTextarea && !shortDescriptionTextarea.classList
                            .contains('mce-container')) {
                            initTinyMCEOnElement(shortDescriptionTextarea);
                        }

                        // Find the textarea inside the pane and initialize TinyMCE for full description
                        const descriptionTextarea = targetPane.querySelector(
                            '.tinymce-textarea-description');
                        if (descriptionTextarea && !descriptionTextarea.classList.contains(
                                'mce-container')) {
                            initTinyMCEOnElement(descriptionTextarea);
                        }
                    }
                });
            });

        // Submit the form with HTML content from TinyMCE editors
        const form = document.querySelector('form'); // Assuming the form element
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Loop over all TinyMCE instances and get their HTML content
            document.querySelectorAll('.tinymce-textarea, .tinymce-textarea-description').forEach(
                function(textarea) {
                    // Get the TinyMCE instance for each textarea
                    const editorId = textarea.getAttribute('id'); // Get the TinyMCE instance id
                    const content = tinymce.get(editorId)
                        .getContent(); // Get the HTML content from TinyMCE

                    // Create a hidden input to store the HTML content
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = textarea.name;
                    hiddenInput.value = content; // Set the HTML content as the value

                    form.appendChild(hiddenInput); // Append the hidden input to the form
                });

            // Now you can submit the form with the hidden inputs containing the HTML content
            form.submit(); // You can replace this with AJAX if needed
        });
    });



    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('sync-input')) {
            const syncKey = e.target.dataset.sync;
            const newValue = e.target.value;

            document.querySelectorAll(`.sync-input[data-sync="` + syncKey + `"]`).forEach(input => {
                if (input !== e.target) {
                    input.value = newValue;
                }
            });

            if (syncKey === 'reference') {
                const realReferenceInput = document.querySelector('#product_details_references_reference');
                if (realReferenceInput) {
                    realReferenceInput.value = newValue;
                    realReferenceInput.dispatchEvent(new Event('input', { bubbles: true }));
                    realReferenceInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
            if (syncKey === 'ean_13') {
                const realEanInput = document.querySelector('#product_details_references_ean_13');
                if (realEanInput) {
                    realEanInput.value = newValue;
                    realEanInput.dispatchEvent(new Event('input', { bubbles: true }));
                    realEanInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
            if (syncKey === 'housing') {
                const realHousingInput = document.querySelector('#product_details_references_ean_13');
                if (realHousingInput) {
                    realHousingInput.value = newValue;
                    realHousingInput.dispatchEvent(new Event('input', { bubbles: true }));
                    realHousingInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
        }
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
</style>


<pre>{$product|print_r}</pre>