<script src="https://euromuscleparts.com/admineuromus1/themes/new-theme/public/product_edit.bundle.js?1"></script>

<!-- Load the TinyMCE script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
{* <link href="https://euromuscleparts.com/js/tiny_mce/skins/prestashop/skin.min.css" type="text/css" rel="stylesheet">
<link href="https://euromuscleparts.com/js/tiny_mce/skins/prestashop/content.min.css" type="text/css" rel="stylesheet"> *}

{function name=renderCategoryTree categories=[] parentId=0 selected_ids=[] level=0}
    {assign var="selected_ids" value=$selected_ids|default:[]}

    {if isset($categories[$parentId])}
        <ul class="category-tree level-{$level}" style="padding-left: {($level * 20)}px;">
            {foreach from=$categories[$parentId] item=cat}
                <li class="has-children">
                    <label class="toggle-label">
                        <input type="checkbox" class="form-check-input" name="product[asg][categories][]" value="{$cat.id_category}"
                            {if in_array($cat.id_category, $selected_ids)}checked{/if}>
                        {$cat.name|escape:'html'}
                    </label>

                    {if isset($categories[$cat.id_category]) && $categories[$cat.id_category] != null}
                        <span class="toggle-icon btn-info" style="cursor: pointer;"><i class="fa-solid fa-plus"></i></span>
                    {/if}

                    {* Recursive call for children *}
                    {if isset($categories[$cat.id_category]) && $categories[$cat.id_category] != null}
                        <ul class="category-tree level-{$level+1}" style="padding-left: 20px; display: none;">
                            {renderCategoryTree 
                                                                                                                categories=$categories 
                                                                                                                parentId=$cat.id_category 
                                                                                                                selected_ids=$selected_ids 
                                                                                                                level=$level+1
                                                                                                            }
                        </ul>
                    {/if}
                </li>
            {/foreach}
        </ul>
    {/if}
{/function}



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
                    <div style="display: flex;gap: .5rem;">
                        <input id="product_details_references_ean_13" type="text" class="form-control" name="product[asg][ean13]" value="{$product->ean13}">
                        <span id="product_details_print_ean_btn" class="btn btn-info"><i class="material-icons">local_printshop</i></span>
                    </div>
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
                        <textarea id="description_short_{$language.id_lang}"
                            name="product[asg][description_short][{$language.id_lang}]"
                            class="form-control tinymce-textarea" rows="5">
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
                        <textarea id="description_long_{$language.id_lang}"
                            name="product[asg][description_long][{$language.id_lang}]"
                            class="form-control tinymce-textarea-description" rows="5">
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
                <div class="input-group locale-input-group js-locale-input-group d-flex" id="product_seo_tags"
                    tabindex="1">
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
                                    {assign var="tags_string" value=""} {* Initialize an empty string for concatenation *}

                                    {foreach from=$tags item=tag}
                                        {assign var="tags_string" value=$tags_string|cat:$tag|cat:','}
                                        {* Concatenate each tag with a comma *}
                                    {/foreach}

                                    {assign var="tags_string" value=$tags_string|substr:0:-1} {* Remove the last comma *}
                                {else}
                                    {assign var="tags_string" value=$tags}
                                {/if}

                                <input type="text" id="product_seo_tags_{$language.id_lang}"
                                    name="product[asg][tags][{$language.id_lang}]" class="js-taggable-field form-control"
                                    aria-label="product_seo_tags_{$language.id_lang} input"
                                    value="{$tags_string|escape:'html'}" style="position: absolute; left: -10000px;"
                                    tabindex="-1">
                                <input type="text" style="position: absolute; left: -10000px;" tabindex="-1">

                                <input type="text" class="token-input" autocomplete="off" placeholder=""
                                    id="product_seo_tags_{$language.id_lang}-tokenfield" tabindex="0"
                                    style="min-width: 60px; width: 0px;" maxlength="32">
                            </div>
                        </div>
                    {/foreach}
                </div>
                <div class="dropdown" style="padding: .15rem;">
                    <button class="btn btn-outline-secondary dropdown-toggle js-locale-btn" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="product_seo_tags_dropdown"
                        style="display: flex;align-items: center;">
                        {if isset($languages.0.iso_code)}{$languages.0.iso_code|upper}{/if}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right locale-dropdown-menu"
                        aria-labelledby="product_seo_tags_dropdown">
                        {foreach from=$languages item=language}
                            <span class="dropdown-item js-locale-item" data-locale="{$language.iso_code}">
                                {$language.name} ({$language.iso_code|capitalize})
                            </span>
                        {/foreach}
                    </div>
                </div>
            </div>

            <span class="btn btn-info" onclick="generateTagsASG()">Generate Tags</span>
            <span class="btn btn-danger" onclick="clearTagsASG()">Remove All Tags</span>


        </div>

        <div class="form-group">
            <hr>
        </div>


        <div class="form-group" style="display: flex;gap:1rem;">
            <div class="form-group col-lg-4">
                <div class="select-widget mb-3">
                    <h3 for="product_description_manufacturer">Brand</h3>
                    <select id="product_description_manufacturer" name="product[asg][manufacturer]"
                        data-toggle="select2" data-minimumresultsforsearch="7"
                        class="custom-select form-control select2-hidden-accessible"
                        data-select2-id="product_description_manufacturer" tabindex="-1" aria-hidden="true">

                        <option value="0">No brand</option>

                        {foreach from=$brands item=brand}
                            <option value="{$brand.id_manufacturer}"
                                {if $brand.id_manufacturer == $product->id_manufacturer}selected="selected" {/if}>
                                {$brand.name|escape:'html'}
                            </option>
                        {/foreach}
                    </select>
                </div>


                <div class="select-widget">
                    <h3 for="product_description_supplier">Supplier</h3>
                    <select id="product_description_supplier" name="product[asg][supplier]" data-toggle="select2"
                        data-minimumresultsforsearch="7" class="custom-select form-control select2-hidden-accessible"
                        data-select2-id="product_description_supplier" tabindex="-1" aria-hidden="true">

                        <option value="0">No supplier</option>

                        {foreach from=$suppliers item=supplier}
                            <option value="{$supplier.id_supplier}"
                                {if $supplier.id_supplier == $product->id_supplier}selected="selected" {/if}>
                                {$supplier.name|escape:'html'}
                            </option>
                        {/foreach}
                    </select>
                </div>
            </div>


            {* categories *}

            <div class="form-group col-lg-4">
                <h3>Categories</h3>
                <div id="product_description_categories">

                    <div class="form-group mb-3">
                        <p class="subtitle">Categories Associated with this Product</p>
                        <div id="product_description_categories_product_categories"
                            class="pstaggerTagsWrapper form-group d-block">
                            {foreach from=$product_categories item=prod_cat key=key}
                                <span id="product_description_categories_product_categories_{$key}"
                                    name="product[description][categories][product_categories][{$key}]"
                                    class="pstaggerTag tag-item">
                                    <input type="hidden"
                                        id="product_description_categories_product_categories_{$key}_display_name"
                                        name="product[description][categories][product_categories][{$key}][display_name]"
                                        class="category-name-preview-input" value="{$prod_cat.name|escape:'html'}" />

                                    <span class="label text-preview category-name-preview">
                                        <span class="text-preview-value">{$prod_cat.name|escape:'html'}</span>
                                    </span>

                                    <input type="hidden" id="product_description_categories_product_categories_{$key}_name"
                                        name="product[description][categories][product_categories][{$key}][name]"
                                        class="category-name-input" value="{$prod_cat.name|escape:'html'}" />

                                    {if $prod_cat.id_category != 2}
                                        <a class="pstaggerClosingCross" href="#" data-id="{$prod_cat.id_category}"
                                            {if $prod_cat.id_category == 2} style="pointer-events: none; color: #ccc;"
                                            title="This category cannot be removed" {/if}>
                                            x
                                        </a>
                                    {/if}

                                    <input type="hidden" id="product_description_categories_product_categories_{$key}_id"
                                        name="product[description][categories][product_categories][{$key}][id]"
                                        class="category-id-input" value="{$prod_cat.id_category}" />
                                </span>
                            {/foreach}
                        </div>
                    </div>

                    <!-- Default Category Dropdown -->
                    <div class="form-group mb-3">
                        <label for="defaultCategorySelect" class="form-label">Select Default Category</label>
                        <select class="custom-select form-control" id="defaultCategorySelect"
                            name="product[asg][default_category]" required>
                            <option value="" disabled>Select a category</option>
                            {foreach from=$categories item=cat}
                                <option value="{$cat.id_category}"
                                    {if $cat.id_category == $product->id_category_default}selected="selected" {/if}>
                                    {$cat.name|escape:'html'}
                                </option>
                            {/foreach}
                        </select>
                    </div>

                </div>
            </div>

            <div class="form-group col-lg-4">
                <label for="categoryCheckboxes" class="form-label">Select Categories to Associate</label>
                <div id="categoryCheckboxes">
                    {renderCategoryTree categories=$category_tree parentId=2 selected_ids=$product_category_ids}
                </div>
            </div>





        </div>

        <div class="form-group">
            <hr>
        </div>

        <div class="form-group">
            <h3>Retail price</h3>
            <div id="product_pricing_retail_price" class="retail-price-widget">

                <!-- Tax Excluded -->
                <div class="form-group money-widget retail-price-tax-excluded">
                    <label for="product_pricing_retail_price_price_tax_excluded">
                        Retail price (tax excl.)
                    </label>
                    <div class="input-group money-type">
                        <input type="text" id="product_pricing_retail_price_price_tax_excluded"
                            name="product[asg][retail_price][price_tax_excluded]"
                            class="js-comma-transformer form-control" value="{$retail_price_tax_excl|floatval}">
                        <div class="input-group-append">
                            <span class="input-group-text">&nbsp;€</span>
                        </div>
                    </div>
                </div>

                <!-- Tax Rule -->
                <div class="form-group select-widget retail-price-tax-rules-group-id">
                    <label for="product_pricing_retail_price_tax_rules_group_id">Tax rule</label>
                    <select id="product_pricing_retail_price_tax_rules_group_id"
                        name="product[asg][retail_price][tax_rules_group_id]" class="custom-select form-control">
                        {foreach from=$tax_rules item=rule}
                            <option value="{$rule.id}" data-tax-rate="{$rule.rate}"
                                {if $rule.id == $selected_tax_rule_id}selected="selected" {/if}>
                                {$rule.name}
                            </option>
                        {/foreach}
                    </select>
                    <small class="form-text">
                        Tax: {foreach from=$tax_rules item=rule}
                            {if $rule.id == $selected_tax_rule_id}{$rule.rate}%{/if}
                        {/foreach}
                    </small>
                </div>

                <!-- Tax Included -->
                <div class="form-group money-widget retail-price-tax-included">
                    <label for="product_pricing_retail_price_price_tax_included">
                        Retail price (tax incl.)
                    </label>
                    <div class="input-group money-type">
                        <input type="text" id="product_pricing_retail_price_price_tax_included"
                            name="product[asg][retail_price][price_tax_included]"
                            class="js-comma-transformer form-control" value="{$retail_price_tax_incl|floatval}">
                        <div class="input-group-append">
                            <span class="input-group-text">&nbsp;€</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div style="display: flex;gap: 3rem;">
            <div class="form-group money-widget">
                <h3 for="product_pricing_wholesale_price">
                    {l s='Cost price' d='Admin.Catalog.Feature'}
                </h3>
                <p class="subtitle">{l s='Cost price (tax excl.)' d='Admin.Catalog.Help'}</p>

                <div class="input-group money-type">
                    <input type="text" id="product_pricing_wholesale_price" name="product[pricing][wholesale_price]"
                        data-display-price-precision="6" class="js-comma-transformer form-control"
                        value="{$product->wholesale_price|escape:'html':'UTF-8'}" />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            &nbsp;{$currency->sign}
                        </span>
                    </div>
                </div>

                <div class="form-check form-check-radio form-checkbox modify-all-shops">
                    <div class="md-checkbox md-checkbox-inline">
                        <label>
                            <input type="checkbox" id="product_pricing_modify_all_shops_wholesale_price"
                                name="product[pricing][modify_all_shops_wholesale_price]"
                                container_class="modify-all-shops" data-value-type="boolean" class="form-check-input"
                                value="1" />
                            <i class="md-checkbox-control"></i>
                            {l s='Apply changes to all stores' d='Admin.Global'}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <h3>{l s='Summary' d='Admin.Catalog.Feature'}</h3>

                <div id="product_pricing_summary" name="product[pricing][summary]"
                    class="price-summary-widget form-group"
                    data-price-tax-excluded="{$retail_price_tax_excl|string_format:'%.2f'} {$currency->sign} tax excl."
                    data-price-tax-included="{$retail_price_tax_incl|string_format:'%.2f'} {$currency->sign} tax incl."
                    data-unit-price="{$product->unit_price|string_format:'%.2f'} {$product->unity|escape} unit price"
                    data-margin="{($retail_price_tax_excl - $product->wholesale_price)|string_format:'%.2f'} {$currency->sign} margin"
                    data-margin-rate="{if $product->wholesale_price > 0}{(($retail_price_tax_excl - $product->wholesale_price) / $product->wholesale_price * 100)|string_format:'%.2f'}%{else}0%{/if} margin rate"
                    data-wholesale-price="{$product->wholesale_price|string_format:'%.2f'} {$currency->sign} cost price">
                    <div class="price-summary-block">
                        <div class="price-summary-value price-tax-excluded-value">
                            {$retail_price_tax_excl|string_format:'%.2f'}&nbsp;{$currency->sign}
                            {l s='tax excl.' d='Admin.Catalog.Feature'}
                        </div>
                        <div class="price-summary-value price-tax-included-value">
                            {$retail_price_tax_incl|string_format:'%.2f'}&nbsp;{$currency->sign}
                            {l s='tax incl.' d='Admin.Catalog.Feature'}
                        </div>
                        <div class="price-summary-value unit-price-value {if !$product->unit_price}d-none{/if}">
                            {$product->unit_price|string_format:'%.2f'}&nbsp;{$currency->sign} /
                            {$product->unity|escape}
                        </div>
                    </div>

                    <div class="price-summary-block">
                        <div class="price-summary-value margin-value">
                            {($retail_price_tax_excl - $product->wholesale_price)|string_format:'%.2f'}&nbsp;{$currency->sign}
                            {l s='margin' d='Admin.Catalog.Feature'}
                        </div>
                        <div class="price-summary-value margin-rate-value">
                            {if $product->wholesale_price > 0}
                                {((($retail_price_tax_excl - $product->wholesale_price) / $product->wholesale_price) * 100)|string_format:'%.2f'}%
                            {else}
                                0%
                            {/if}
                            {l s='margin rate' d='Admin.Catalog.Feature'}
                        </div>
                        <div class="price-summary-value wholesale-price-value">
                            {$product->wholesale_price|string_format:'%.2f'}&nbsp;{$currency->sign}
                            {l s='cost price' d='Admin.Catalog.Feature'}
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="form-group">
    <h2>
        {l s='Specific prices' d='Admin.Catalog.Feature'}
        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
            data-content="{l s='Set specific prices for customers meeting certain conditions.' d='Admin.Catalog.Help'}"
            data-placement="top">
        </span>
    </h2>

    <div id="specific-prices-container">
        {* <div id="product_pricing_specific_prices">
            <div class="form-group">
                <button id="product_pricing_specific_prices_add_specific_price_btn"
                    name="product[pricing][specific_prices][add_specific_price_btn]"
                    class="js-add-specific-price-btn btn btn-outline-primary"
                    data-modal-title="{l s='Add new specific price' d='Admin.Catalog.Feature'}"
                    data-confirm-button-label="{l s='Save and publish' d='Admin.Actions'}"
                    data-cancel-button-label="{l s='Cancel' d='Admin.Actions'}" type="button">
                    <i class="material-icons">add_circle</i>
                    <span class="btn-label">{l s='Add a specific price' d='Admin.Catalog.Feature'}</span>
                </button>
            </div>
        </div>

        <div id="specific-price-list-container">
            <table class="table {if $specific_data|count > 0}d-block{else}d-none{/if}"
                id="specific-prices-list-table">
                <thead class="thead-default">
                    <tr>
                        <th>{l s='ID'}</th>
                        <th>{l s='Combination'}</th>
                        <th>{l s='Currency'}</th>
                        <th>{l s='Country'}</th>
                        <th>{l s='Group'}</th>
                        <th>{l s='Store'}</th>
                        <th>{l s='Customer'}</th>
                        <th>{l s='Specific price (tax excl.)'}</th>
                        <th>{l s='Discount (tax incl.)'}</th>
                        <th>{l s='Duration'}</th>
                        <th>{l s='Units'}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$specific_data item=specific}
                        <tr class="specific-price-row" data-specific-price-id="{$specific.id}">
                            <td class="specific-price-id">{$specific.id|default:'-'}</td>
                            <td class="combination">{$specific.combination|default:'--'}</td>
                            <td class="currency">{$specific.currency|escape:'html'}</td>

                            {if isset($specific.country[$language.id_lang]) && $specific.country[$language.id_lang] != ''}
                                <td class="country">{$specific.country[$language.id_lang]|escape:'html'}</td>
                            {else}
                                <td class="country">{l s='-'}</td>
                            {/if}

                            {if isset($specific.group[$language.id_lang]) && $specific.group[$language.id_lang] != ''}
                                <td class="group">{$specific.group[$language.id_lang]|escape:'html'}</td>
                            {else}
                                <td class="group">{l s='-'}</td>
                            {/if}

                            <td class="shop">{$specific.store|escape:'html'}</td>
                            <td class="customer">{$specific.customer|default:'All customers'}</td>
                            <td class="price">
                                {if is_numeric($specific.specific_price)}
                                    {$specific.specific_price|string_format:'%.2f'}
                                {else}
                                    {$specific.specific_price}
                                {/if}
                            </td>
                            <td class="impact">{$specific.discount|escape:'html'}</td>
                            <td class="period">
                                {if isset($specific.duration) && is_array($specific.duration)}
                                    <label>{l s='From'} <span>{$specific.duration.from|date_format:"%Y-%m-%d"}</span></label><br>
                                    <label>{l s='To'} <span>{$specific.duration.to|date_format:"%Y-%m-%d"}</span></label>
                                {else}
                                    <label>{$specific.duration}</label>
                                {/if}
                            </td>
                            <td class="from-qty">{$specific.units}</td>

                            <td>
                                <button class="js-delete-specific-price-btn btn tooltip-link"
                                    data-specific-price-id="{$specific.id}"
                                    data-confirm-title="Specific price deletion"
                                    data-confirm-message="Are you sure you want to delete this specific price?"
                                    data-confirm-btn-label="Delete"
                                    data-cancel-btn-label="Cancel"
                                    data-confirm-btn-class="btn-danger">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>

                            <td>
                                <button type="button" title="Edit"
                                    class="js-edit-specific-price-btn btn tooltip-link"
                                    data-modal-title="Edit specific price"
                                    data-confirm-button-label="Save and publish"
                                    data-cancel-button-label="Cancel"
                                    data-specific-price-id="{$specific.id}">
                                    <i class="material-icons">edit</i>
                                </button>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div> *}

            <table class="specific-price-list">
                <tbody></tbody>
            </table>

            <template id="specific-price-row-template">
                <tr>
                <td class="specificPriceId"></td>
                <td class="combination"></td>
                <td class="currency"></td>
                <td class="country"></td>
                <td class="group"></td>
                <td class="shop"></td>
                <td class="customer"></td>
                <td class="price"></td>
                <td class="impact"></td>
                <td class="period"></td>
                <td class="from"></td>
                <td class="to"></td>
                <td class="fromQuantity"></td>
                <td><button class="deleteBtn">Delete</button></td>
                <td><button class="editBtn">Edit</button></td>
                </tr>
            </template>

            <div id="specific-price-loading-spinner" style="display:none;">Loading...</div>
     



        {* fim *}
    </div>
</div>


    </div>

    <div class="col-lg-3">

        <div class="form-group">
            <label for="product_visibility">Visibility</label>
            <select class="form-control" id="product_visibility" name="product[asg][visibility]">
                <option value="both" {if $product->visibility == 'both'}selected="selected" {/if}>Everywhere</option>
                <option value="catalog" {if $product->visibility == 'catalog'}selected="selected" {/if}>Catalog only
                </option>
                <option value="search" {if $product->visibility == 'search'}selected="selected" {/if}>Search only
                </option>
                <option value="none" {if $product->visibility == 'none'}selected="selected" {/if}>Nowhere</option>
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
                        <input type="radio" id="product_description_ec_approved_0" name="product[asg][ec_approved]"
                            value="0" {if isset($product->ec_approved) && $product->ec_approved != 1}checked{/if}>
                        <label for="product_description_ec_approved_0">No</label>

                        <input type="radio" id="product_description_ec_approved_1" name="product[asg][ec_approved]"
                            value="1" {if isset($product->ec_approved) && $product->ec_approved == 1}checked{/if}>
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
                        <input type="radio" id="product_description_wmdeprecated_0" name="product[asg][wmdeprecated]"
                            value="0" {if isset($product->wmdeprecated) && $product->wmdeprecated != 1}checked{/if}>
                        <label for="product_description_wmdeprecated_0">No</label>

                        <input type="radio" id="product_description_wmdeprecated_1" name="product[asg][wmdeprecated]"
                            value="1" {if isset($product->wmdeprecated) && $product->wmdeprecated == 1}checked{/if}>
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
                        <input type="radio" id="product_description_not_to_order_0" name="product[asg][not_to_order]"
                            value="0" {if isset($product->not_to_order) && $product->not_to_order != 1}checked{/if}>
                        <label for="product_description_not_to_order_0">No</label>

                        <input type="radio" id="product_description_not_to_order_1" name="product[asg][not_to_order]"
                            value="1" {if isset($product->not_to_order) && $product->not_to_order == 1}checked{/if}>
                        <label for="product_description_not_to_order_1">Yes</label>

                        <span class="slide-button"></span>
                    </span>
                </div>
            </div>

            <div class="form-group col-lg-4">
                <label class="">
                    Disallow stock?
                    <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                        data-content="Disallow stock helper." data-placement="top" data-original-title="" title=""
                        style="position: absolute;">
                    </span>
                </label>
                <div class="input-group ">
                    <span class="ps-switch" id="product_description_disallow_stock">
                        <input id="product_description_disallow_stock_0" class="ps-switch"
                            name="product[asg][disallow_stock]" value="0" checked="" type="radio"
                            {if isset($product->disallow_stock) && $product->disallow_stock != 1}checked{/if}>
                        <label for="product_description_disallow_stock_0">No</label>

                        <input id="product_description_disallow_stock_1" class="ps-switch"
                            name="product[asg][disallow_stock]" value="1" type="radio"
                            {if isset($product->disallow_stock) && $product->disallow_stock != 1}checked{/if}>
                        <label for="product_description_disallow_stock_1">Yes</label>

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
                <input type="text" class="form-control" id="hs_code" name="product[asg][nc]" placeholder="HS Code"
                    value="{$product->nc}">
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

    <div class="col-lg-12">
        <hr>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const productId = {$product->id|intval}; // Or however you pass the product ID

    if (typeof Jw !== 'undefined') {
      const manager = new Jw(productId);
      manager.render({
        specificPrices: [
          {
            id: 1,
            combination: "Size M",
            currency: "USD",
            country: "USA",
            group: "Default",
            shop: "Main",
            customer: "John Doe",
            price: "$20",
            impact: "-10%",
            fromQuantity: "1",
            period: { from: "2024-01-01", to: "2024-12-31" }
          }
        ]
      });
    } else {
      console.error('Jw is not available');
    }
  });
</script>
<!-- TinyMCE Initialization Script -->
<script src="{$base_url}js/tiny_mce/tinymce.min.js"></script>
<script>


    // 
    let buttonSaveProductFooter = document.querySelector("#product_footer_save")

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
        {if !empty($compat.brand)}
        tagCompats.add("{$compat.brand|escape:'javascript'}");
        {/if}
        {if !empty($compat.model)}
        tagCompats.add("{$compat.model|escape:'javascript'}");
        {/if}
        {if !empty($compat.type)}
        tagCompats.add("{$compat.type|escape:'javascript'}");
        {/if}
        {if !empty($compat.version)}
        tagCompats.add("{$compat.version|escape:'javascript'}");
        {/if}
        {/foreach}
        {/if}

        const uniqueTags = Array.from(tagCompats);

        // Loop through each language and apply tags
        Object.keys(tagNames).forEach((langId) => {
            // const tagName = tagNames[langId];

            const allTags = [tagBrand, tagRef, ...tagRefVariations, ...uniqueTags];

            const filteredTags = allTags
                .map(tag => tag && tag.trim())
                .filter(tag => tag && tag.length >= 2);

            const container = document.querySelector(`#product_seo_tags_` + langId + ``).closest('.tokenfield');

            const existingTags = Array.from(container.querySelectorAll('.token')).map(token => token.dataset
                .value);

            // Clear previous tags
            // container.querySelectorAll('.token').forEach(el => el.remove());


            filteredTags.forEach(tag => {
                // Only add the tag if it doesn't already exist in the container
                if (!existingTags.includes(tag)) {
                    const token = document.createElement('div');
                    token.className = 'token';
                    token.dataset.value = tag;

                    const label = document.createElement('span');
                    label.className = 'token-label';
                    label.style.maxWidth = '951.213px'; // Optional: dynamic width?
                    label.textContent = tag;

                    const close = document.createElement('a');
                    close.href = '#';
                    close.className = 'close';
                    close.tabIndex = -1;
                    close.innerHTML = '&times;';
                    close.addEventListener('click', (e) => {
                        e.preventDefault();
                        token.remove();
                        updateHiddenInput(langId);
                    });

                    token.appendChild(label);
                    token.appendChild(close);

                    container.insertBefore(token, container.querySelector('.token-input'));
                }
            });

            // Update the hidden field for this lang
            updateHiddenInput(langId);
        });

        function updateHiddenInput(langId) {
            const container = document.querySelector(`#product_seo_tags_` + langId + ``).closest('.tokenfield');
            const tokens = container.querySelectorAll('.token');
            const values = Array.from(tokens).map(token => token.dataset.value);
            const hiddenInput = document.querySelector(`#product_seo_tags_` + langId + ``);
            if (hiddenInput) {
                hiddenInput.value = values.join(', ');
            }
            buttonSaveProductFooter.removeAttribute('disabled'); // Enable the save button
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.js-taggable-field input[type="text"]:first-child').forEach(function(input) {
            if ($(input).tokenfield) {
                $(input).tokenfield(); // initialize tokenfield
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {

        // Initialize tokenfield for each language input (tokenfield is an input for tag input)
        const tokenInputs = document.querySelectorAll('.js-taggable-field');

        tokenInputs.forEach(function(input) {
            // Initialize the tokenfield
            input.addEventListener('input', function(e) {
                updateHiddenInput(input);
            });
        });

        // Function to update the hidden input with the current tags (comma separated)
        function updateHiddenInput(input) {
            // Get all tokens (tags) from the input (assumes tokens are separated by commas)
            const tokenString = input.value.trim();

            // If there are tokens, update the hidden field
            let tagValues = tokenString.split(',').map(tag => tag.trim()).filter(tag => tag.length > 0).join(
                ',');

            // Get language ID from the input field ID (e.g., product_seo_tags_1 => 1)
            const langId = input.id.split('_')[3];

            // Find the corresponding hidden input and update its value
            const hiddenInput = document.querySelector(`#product_seo_tags_` + langId);
            if (hiddenInput) {
                hiddenInput.value = tagValues;
            }
        }

        // Initialize the tokenfield with commas as delimiters for each language
        tokenInputs.forEach(function(input) {
            const langId = input.id.split('_')[3]; // Extract the language ID from the input ID

            // Automatically trigger an update to ensure the hidden input is in sync when the page loads
            updateHiddenInput(input);
        });
    });




    document.querySelectorAll('.lang-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const langId = this.dataset.lang;

            document.querySelectorAll('.translation-field').forEach(el => {
                el.style.display = 'none';
            });

            const target = document.querySelector('.lang-' + langId);
            if (target) {
                target.style.display = 'block';
            }
        });
    });

    // Function to initialize TinyMCE on a textarea if not already initialized
    function initTinyMCEOnElement(textarea) {
        if (!textarea || textarea.classList.contains('mce-initialized')) return;

        tinymce.init({
            target: textarea,
            valid_elements: '*[*]',
            menubar: false,
            plugins: 'lists link image table code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
            height: 80,
            statusbar: false, // Disable the status bar
            path: false, // Disable the path toolbar
            skin: 'prestashop',
            content_css:  '{$ps_base_url}/js/tiny_mce/skins/prestashop/content.min.css',
            setup: function(editor) {
                editor.on('init', function() {
                    textarea.classList.add('mce-initialized');
                    // After initialization, remove the mce-path element
                    const mcePath = document.querySelector('.mce-path');
                    if (mcePath) {
                        mcePath.remove();
                    }
                });

                editor.on('change input keyup', function() {
                    editor.save(); // updates the underlying <textarea>
                });
            }
        });
    }

    // Initialize TinyMCE for the active tab on page load
    document.addEventListener('DOMContentLoaded', function() {
        // value difficulty
        document.querySelector("#product_description_difficulty").value = "{$product->difficulty}";


        document.querySelectorAll('#product_description_description_short_custom .tinymce-textarea').forEach(
            textarea => {
                initTinyMCEOnElement(textarea);
            });

        document.querySelectorAll('#product_description_full_description_custom .tinymce-textarea-description')
            .forEach(textarea => {
                initTinyMCEOnElement(textarea);
            });


        // Add click event to each language tab
        document.querySelectorAll(
            '#product_product_creation_custom_html .translationsLocales a[data-toggle="tab"]'
        ).forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                // Get the nearest .translationsLocales (tab container) and .tab-content (pane container)
                const tabContainer = this.closest('.translationsLocales');
                const paneContainer = document.querySelector(this.getAttribute('data-target'))
                    .closest('.tab-content');

                // Deactivate only sibling tabs within this group
                tabContainer.querySelectorAll('a[data-toggle="tab"]').forEach(t => t.classList
                    .remove('active'));

                // Deactivate only sibling panes within this container
                paneContainer.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });

                // Activate clicked tab
                this.classList.add('active');

                // Activate corresponding pane
                const targetPane = document.querySelector(this.getAttribute('data-target'));
                if (targetPane) {
                    targetPane.classList.add('show', 'active');

                    // Init TinyMCE if needed
                    const shortDescriptionTextarea = targetPane.querySelector(
                        '.tinymce-textarea');
                    if (shortDescriptionTextarea && !shortDescriptionTextarea.classList
                        .contains('mce-container')) {
                        initTinyMCEOnElement(shortDescriptionTextarea);
                    }

                    const descriptionTextarea = targetPane.querySelector(
                        '.tinymce-textarea-description');
                    if (descriptionTextarea && !descriptionTextarea.classList.contains(
                            'mce-container')) {
                        initTinyMCEOnElement(descriptionTextarea);
                    }
                }
            });
        });
    });

    window.addEventListener('DOMContentLoaded', function() {
        // List of element IDs to be removed
        const elementsToRemove = [
            '#product_details #product_details_references_reference',
            '#product_details #product_details_references_ean_13',
            '#product_details #product_details_housing',
            '#product_description #product_description_description_short',
            '#product_description #product_description_description',
            '#product_seo #product_seo_tags',
            '#product_description #product_description_categories',
            '#product_pricing #specific-prices-container',

        ];

        // Loop through the IDs and remove each element from the DOM
        elementsToRemove.forEach(function(id) {

            const element = document.querySelector(id).parentElement;

            if (element) {
                console.log('Removing element:', id);
                element.remove();
            }
        });


    });

    document.addEventListener('DOMContentLoaded', function() {
        const visibilitySelect = document.querySelector('#product_visibility');

        if (visibilitySelect) {
            visibilitySelect.addEventListener('change', function() {
                const selectedValue = this.value;

                // Find the matching radio input and check it
                const matchingRadio = document.querySelector(
                    `#product_options_visibility_visibility input[type="radio"][value="` +
                    selectedValue + `"]`
                );

                if (matchingRadio) {
                    matchingRadio.checked = true;

                    // Optional: trigger change event if other scripts rely on it
                    matchingRadio.dispatchEvent(new Event('change'));
                }
            });
        }

    });


    document.querySelector('form').addEventListener('submit', function(e) {
        tinymce.editors.forEach(function(editor) {
            const textarea = document.getElementById(editor.id);
            if (textarea) {
                textarea.value = editor.getContent(); // ensures HTML is saved
            }
        });
    });

    function clearTagsASG() {
        const tagFields = document.querySelectorAll('[id^="product_seo_tags_"]');

        tagFields.forEach((input) => {
            const langId = input.id.split('_')[3];
            const container = input.closest('.tokenfield');

            if (!container) return;

            // Remove all existing tag tokens
            container.querySelectorAll('.token').forEach(el => el.remove());

            // Clear the hidden input
            input.value = '';

            // Enable save button since form is now changed
            const buttonSaveProductFooter = document.querySelector("#product_footer_save");
            if (buttonSaveProductFooter) {
                buttonSaveProductFooter.removeAttribute('disabled');
            }
        });
    }


    // categories

    document.addEventListener('DOMContentLoaded', function() {
        // Get all elements with the class "toggle-icon"
        const toggleElements = document.querySelectorAll('.toggle-icon');

        toggleElements.forEach(function(toggle) {
            // Add click event listener to each toggle icon
            toggle.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent checkbox click from being triggered

                const parentLi = this.closest('li');
                const childUl = parentLi.querySelector('ul');
                const icon = parentLi.querySelector('.toggle-icon');

                // Toggle the visibility of child categories
                if (childUl) {
                    childUl.style.display = (childUl.style.display === 'none') ? 'block' :
                        'none';

                    // Toggle the icon between + and -
                    if (childUl.style.display === 'block') {
                        icon.innerHTML =
                            '<i class="fa-solid fa-minus"></i>'; // Change to minus when open
                    } else {
                        icon.innerHTML =
                            '<i class="fa-solid fa-plus"></i>'; // Change to plus when closed
                    }
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Handle removal of categories when the "x" button is clicked
        const removeButtons = document.querySelectorAll('.pstaggerClosingCross');

        removeButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const categoryId = this.getAttribute('data-id');
                const tagItem = this.closest('.pstaggerTag');

                // Remove the corresponding tag item
                if (tagItem) {
                    tagItem.remove();
                    // Optionally, handle other actions like removing the category from the hidden inputs
                    const categoryCheckbox = document.querySelector(
                        `input[type="checkbox"][value="` + categoryId + `"]`);
                    if (categoryCheckbox) {
                        categoryCheckbox.checked = false;
                    }

                    const buttonSaveProductFooter = document.querySelector(
                        "#product_footer_save");
                    if (buttonSaveProductFooter) {
                        buttonSaveProductFooter.removeAttribute('disabled');
                    }
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Find all checkboxes
        const checkboxes = document.querySelectorAll('.category-tree input[type="checkbox"]');

        // Function to check the parent checkbox
        function checkParentCheckbox(childCheckbox) {
            let parentCheckbox = childCheckbox.closest('li').parentElement.closest('li');
            if (parentCheckbox) {
                let parentCheckboxInput = parentCheckbox.querySelector('input[type="checkbox"]');
                if (parentCheckboxInput) {
                    parentCheckboxInput.checked = true;
                    checkParentCheckbox(parentCheckboxInput); // Recursively check the parent
                }
            }
        }

        // Function to uncheck all child checkboxes of a parent
        function uncheckChildCheckboxes(parentCheckbox) {
            let childList = parentCheckbox.closest('li').querySelector('ul');
            if (childList) {
                const childCheckboxes = childList.querySelectorAll('input[type="checkbox"]');
                childCheckboxes.forEach(function(childCheckbox) {
                    childCheckbox.checked = false; // Uncheck each child
                });
            }
        }

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // If this is the last child, automatically check the parent
                if (this.checked) {
                    let childLi = this.closest('li');
                    if (!childLi.querySelector('ul') || childLi.querySelector('ul').style
                        .display === 'none') {
                        // If there are no child categories (last child), check the parent
                        checkParentCheckbox(this);
                    }
                } else {
                    // If this checkbox is unchecked, also uncheck all its children
                    let parentLi = this.closest('li');
                    if (parentLi.querySelector('ul')) {
                        uncheckChildCheckboxes(this);
                    }
                }
            });
        });

        // Add event listener to handle parent checkbox clicks to uncheck children
        const parentCheckboxes = document.querySelectorAll(
            '.category-tree > li > label > input[type="checkbox"]');

        parentCheckboxes.forEach(function(parentCheckbox) {
            parentCheckbox.addEventListener('change', function() {
                if (!this.checked) {
                    // Uncheck all children when a parent is unchecked
                    uncheckChildCheckboxes(this);
                }
            });
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

    #product_options_visibility #product_options_visibility_visibility {
        display: none !important;
    }

    .category-level {
        list-style: none;
        padding-left: 20px;
    }

    .toggle-icon {
        /* background: #222; */
        padding: 2px 7px;
        border-radius: .25rem;
    }

    .toggle-icon i {
        color: #fff;
    }

    .toggle-label {
        user-select: none;
    }
</style>