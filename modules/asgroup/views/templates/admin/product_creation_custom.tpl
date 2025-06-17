{assign var=admin_url value=$link->getAdminLink('AdminModules', true, [], ['configure' => 'asgroup'])}
{assign var=token value=Tools::getAdminTokenLite('AdminModules')}
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



<div class="tab-container-product-creation-custom row bg-container" style="gap: 2rem;">
    <div class="col-lg-12 bg-creation-container br25" style="display: flex;">
        <div class="col-lg-9 bg-creation-container br25">

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
                                    <span class="currentLength">0</span> of <span class="currentTotalMax">800</span>
                                    characters
                                    allowed
                                </em>
                            </small>
                        </div>
                    {/foreach}
                </div>
            </div>

            <!-- Product images -->

            <div class="form-group mt-2">
                {literal}
                    <div class="manage-shop-images-button-container form-group"
                        data-product-id="{/literal}{$product->id}{literal}"
                        data-translations="{&quot;button.label&quot;:&quot;Manage images&quot;,&quot;modal.save&quot;:&quot;Save and publish&quot;,&quot;modal.close&quot;:&quot;Close&quot;,&quot;modal.cancel&quot;:&quot;Cancel&quot;,&quot;cover.label&quot;:&quot;Cover&quot;,&quot;modal.noImages&quot;:&quot;Product has no images.&quot;,&quot;grid.imageHeader&quot;:&quot;Image&quot;,&quot;warning.deletedImages&quot;:&quot;Images will be deleted.&quot;}"
                        data-v-app="" style="display: none;">
                        <div el=".manage-shop-images-button-container"
                            template="&lt;image-shop-association-modal :productId=productId /&gt;" i18n="[object Object]">
                            <button type="button" class="btn-outline-secondary manage-shop-images-button btn btn">Manage
                                images</button>
                        </div>
                    </div>

                    <div id="product_description_images" name="product[description][images]"
                        class="product-image-dropzone image-dropzone"
                        data-translations="{&quot;window.selectAll&quot;:&quot;Select all&quot;,&quot;window.settingsUpdated&quot;:&quot;Settings updated&quot;,&quot;window.imageReplaced&quot;:&quot;Image replaced&quot;,&quot;window.unselectAll&quot;:&quot;Unselect all&quot;,&quot;window.replaceSelection&quot;:&quot;Replace selection&quot;,&quot;window.cantDisableCover&quot;:&quot;Using another image as cover will automatically uncheck this box.&quot;,&quot;window.selectedFiles&quot;:&quot;&lt;span&gt;{filesNb}&lt;/span&gt; selected file(s)&quot;,&quot;window.notAssociatedToShop&quot;:&quot;Image is not associated to this store&quot;,&quot;window.useAsCover&quot;:&quot;Use as cover image&quot;,&quot;window.applyToAllStores&quot;:&quot;Apply changes to all associated stores&quot;,&quot;window.saveImage&quot;:&quot;Save image settings&quot;,&quot;window.delete&quot;:&quot;Delete selection&quot;,&quot;window.close&quot;:&quot;Close window&quot;,&quot;window.closePhotoSwipe&quot;:&quot;Close (esc)&quot;,&quot;window.download&quot;:&quot;Download&quot;,&quot;window.toggleFullscreen&quot;:&quot;Toggle Fullscreen&quot;,&quot;window.zoomPhotoSwipe&quot;:&quot;Zoom in\/out&quot;,&quot;window.previousPhotoSwipe&quot;:&quot;Previous (arrow left)&quot;,&quot;window.nextPhotoSwipe&quot;:&quot;Next (arrow right)&quot;,&quot;window.downloadImage&quot;:&quot;Download image&quot;,&quot;window.zoom&quot;:&quot;Zoom on selection&quot;,&quot;modal.close&quot;:&quot;Cancel&quot;,&quot;modal.accept&quot;:&quot;Delete&quot;,&quot;modal.title&quot;:&quot;Are you sure you want to delete the selected image?|Are you sure you want to delete the {filesNb} selected images?&quot;,&quot;delete.success&quot;:&quot;The selection has been successfully deleted.&quot;,&quot;window.fileisTooLarge&quot;:&quot;The file is too large. The maximum size allowed is {{maxFilesize}} MB. The file you are trying to upload is {{filesize}} MB.&quot;,&quot;window.dropImages&quot;:&quot;Drop images here&quot;,&quot;window.selectFiles&quot;:&quot;or select files&quot;,&quot;window.recommendedSize&quot;:&quot;Recommended size 800 x 800px for default theme.&quot;,&quot;window.recommendedFormats&quot;:&quot;JPG, GIF, PNG or WebP format.&quot;,&quot;window.cover&quot;:&quot;Cover&quot;,&quot;window.caption&quot;:&quot;Caption&quot;}"
                        data-locales="[{&quot;id_lang&quot;:2,&quot;name&quot;:&quot;English (English)&quot;,&quot;active&quot;:1,&quot;iso_code&quot;:&quot;en&quot;,&quot;language_code&quot;:&quot;en-us&quot;,&quot;locale&quot;:&quot;en-US&quot;,&quot;date_format_lite&quot;:&quot;d\/m\/Y&quot;,&quot;date_format_full&quot;:&quot;d\/m\/Y H:i:s&quot;,&quot;is_rtl&quot;:0,&quot;id_shop&quot;:1,&quot;shops&quot;:{&quot;1&quot;:true,&quot;2&quot;:true,&quot;3&quot;:true,&quot;6&quot;:true}},{&quot;id_lang&quot;:4,&quot;name&quot;:&quot;Espa\u00f1ol (Spanish)&quot;,&quot;active&quot;:1,&quot;iso_code&quot;:&quot;es&quot;,&quot;language_code&quot;:&quot;es-es&quot;,&quot;locale&quot;:&quot;es-ES&quot;,&quot;date_format_lite&quot;:&quot;d\/m\/Y&quot;,&quot;date_format_full&quot;:&quot;d\/m\/Y H:i:s&quot;,&quot;is_rtl&quot;:0,&quot;id_shop&quot;:1,&quot;shops&quot;:{&quot;1&quot;:true,&quot;2&quot;:true,&quot;3&quot;:true,&quot;6&quot;:true}},{&quot;id_lang&quot;:5,&quot;name&quot;:&quot;Fran\u00e7ais (French)&quot;,&quot;active&quot;:1,&quot;iso_code&quot;:&quot;fr&quot;,&quot;language_code&quot;:&quot;fr-fr&quot;,&quot;locale&quot;:&quot;fr-FR&quot;,&quot;date_format_lite&quot;:&quot;d\/m\/Y&quot;,&quot;date_format_full&quot;:&quot;d\/m\/Y H:i:s&quot;,&quot;is_rtl&quot;:0,&quot;id_shop&quot;:1,&quot;shops&quot;:{&quot;1&quot;:true,&quot;2&quot;:true,&quot;3&quot;:true,&quot;6&quot;:true}}]"
                        data-product-id="{/literal}{$product->id}{literal}" data-shop-id="6" data-is-multi-store-active="1"
                        data-form-name="product_image" data-token="{/literal}{$img_upd_token}{literal}" data-v-app="">
                        <div id="product-images-container" el=".product-image-dropzone"
                            template="&lt;dropzone :productId=productId :locales=locales :token=token :formName=formName /&gt;"
                            i18n="[object Object]">
                            <div id="product-images-dropzone" class="dropzone dropzone-container">
                                <div class="dz-preview openfilemanager" style="">
                                    <div><span><i class="material-icons">add_a_photo</i></span></div>
                                </div>
                                <div class="dz-default dz-message openfilemanager dz-clickable d-none"><i
                                        class="material-icons">add_a_photo</i><br> Drop images here<br><a>or select
                                        files</a><br><small>Recommended size 800 x 800px for default theme.<br> JPG, GIF,
                                        PNG or WebP format.</small></div>
                            {/literal}
                            <!--v-if-->
                            {foreach from=$product->images item=image}
                                <div class="dz-preview is-cover dz-complete dz-image-preview" data-id="{$image->id}">
                                    <div class="dz-image">
                                        <img data-dz-thumbnail="" alt="undefined" src="{$image->src}">
                                    </div>
                                </div>
                            {/foreach}

                        </div>
                        <!--v-if-->
                        <!--v-if-->
                        <div class="dz-template d-none">
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image"><img data-dz-thumbnail=""></div>
                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                <div class="dz-success-mark"><span>✔</span></div>
                                <div class="dz-error-mark"><span>✘</span></div>
                                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                                <div class="dz-hover"><i class="material-icons drag-indicator">drag_indicator</i>
                                    <div class="md-checkbox"><label><input type="checkbox"><i
                                                class="md-checkbox-control"></i></label></div>
                                </div>
                                <div class="iscover">Cover</div>
                            </div>
                        </div>
                        <!--v-if-->
                    </div>
                </div>

            </div>

            <!-- fim images -->


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
                                    <span class="currentLength">0</span> of <span class="currentTotalMax">800</span>
                                    characters
                                    allowed
                                </em>
                            </small>
                        </div>
                    {/foreach}
                </div>
            </div>



            <div class="form-group" style="display: none;">
                <div id="custom_notes_asg">
                    <label>Notes</label>
                    <textarea name="product[asg][notes]" class="form-control" rows="3">{$product->notes}</textarea>
                </div>
            </div>

            <div class="form-group">
                <hr>
            </div>

            <div class="form-group">

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
                                        name="product[asg][tags][{$language.id_lang}]"
                                        class="js-taggable-field form-control"
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
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            id="product_seo_tags_dropdown" style="display: flex;align-items: center;">
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
            {* aqui attachments  *}

            <div class="form-group">
                <h3 style="display: none;">
                    Attached files
                    <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                        data-content="Instructions, size guide, or any file you want to add to a product."
                        data-placement="top" data-original-title="" title="">
                    </span>
                </h3>
                <p class="subtitle" style="display: none;">Customers can download these files on the product page.</p>
                <div class="small font-secondary" style="display: none;">
                    <a target="_blank" id="link_manageall_files"
                        href="/admineuromus1/index.php/sell/attachments/?_token=__token__"
                        class="pt-0 btn btn-link px-0 align-right">
                        <i class="material-icons">open_in_new</i>Manage all files</a>
                </div>
                <div id="product_details_attachments">

                    <div class="form-group">
                        <a id="product_details_attachments_add_attachment_btn"
                            name="product[details][attachments][add_attachment_btn]"
                            data-success-create-message="The file was successfully added."
                            data-modal-title="Add new file" class="btn-outline-secondary add-attachment btn"
                            href="/admineuromus1/index.php/sell/attachments/new?liteDisplaying=1&amp;saveAndStay=1&amp;_token=__token__">
                            <i class="material-icons">add_circle</i>
                            <span class="btn-label">Add new file</span>
                        </a>
                    </div>

                    <div class="form-group">
                        {literal}
                            <div id="product_details_attachments_attached_files" data-prototype-template="    &lt;tr id=&quot;product_details_attachments_attached_files___entity_index__&quot; class=&quot;entity-item&quot;&gt;
                                            &lt;input type=&quot;hidden&quot; id=&quot;product_details_attachments_attached_files___entity_index___attachment_id&quot; name=&quot;product[details][attachments][attached_files][__entity_index__][attachment_id]&quot; value=&quot;__attachment_id__&quot; /&gt;

                                            &lt;td&gt;
                                        &lt;input type=&quot;hidden&quot; id=&quot;product_details_attachments_attached_files___entity_index___name&quot; name=&quot;product[details][attachments][attached_files][__entity_index__][name]&quot; value=&quot;__name__&quot; /&gt;
                                &lt;span class=&quot;label text-preview &quot;&gt;

                                    &lt;span class=&quot;text-preview-value&quot;&gt;
                                                    __name__
                                    &lt;/span&gt;

                                    &lt;/span&gt;

                                &lt;/td&gt;
                                            &lt;td&gt;
                                        &lt;input type=&quot;hidden&quot; id=&quot;product_details_attachments_attached_files___entity_index___file_name&quot; name=&quot;product[details][attachments][attached_files][__entity_index__][file_name]&quot; value=&quot;__file_name__&quot; /&gt;
                                &lt;span class=&quot;label text-preview &quot;&gt;

                                    &lt;span class=&quot;text-preview-value&quot;&gt;
                                                    __file_name__
                                    &lt;/span&gt;

                                    &lt;/span&gt;

                                &lt;/td&gt;
                                            &lt;td&gt;
                                        &lt;input type=&quot;hidden&quot; id=&quot;product_details_attachments_attached_files___entity_index___mime_type&quot; name=&quot;product[details][attachments][attached_files][__entity_index__][mime_type]&quot; value=&quot;__mime_type__&quot; /&gt;
                                &lt;span class=&quot;label text-preview &quot;&gt;

                                    &lt;span class=&quot;text-preview-value&quot;&gt;
                                                    __mime_type__
                                    &lt;/span&gt;

                                    &lt;/span&gt;

                                &lt;/td&gt;

                                    &lt;td&gt;
                                &lt;i class=&quot;material-icons entity-item-delete&quot;&gt;clear&lt;/i&gt;
                                &lt;/td&gt;
                                &lt;/tr&gt;" data-prototype-index="__entity_index__"
                                data-identifier-field="attachment_id" data-filtered-identities="[]"
                                data-prototype-mapping='{"attachment_id":"__attachment_id__","name":"__name__","file_name":"__file_name__","mime_type":"__mime_type__"}'
                                data-remove-modal='{"id":"modal-confirm-remove-entity","title":"Delete item","message":"Are you sure you want to delete this item?","apply":"Delete","cancel":"Cancel","buttonClass":"btn-danger"}'
                                data-remote-url="/admineuromus1/index.php/sell/attachments/search/__QUERY__?_token=__token__"
                                data-data-limit="0" data-min-length="2" data-allow-delete="1" data-suggestion-field="name"
                                class="entity-search-widget">
                            {/literal}

                            <div class="search search-with-icon" style="display: none;">
                                <span class="twitter-typeahead" style="position: relative; display: inline-block;">
                                    <input id="product_details_attachments_attached_files_search_input"
                                        class="entity-search-input form-control tt-input" autocomplete="off"
                                        placeholder="Search file" type="text" spellcheck="false" dir="auto"
                                        style="position: relative; vertical-align: top;">
                                    <pre aria-hidden="true"
                                        style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Open Sans&quot;, helvetica, arial, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: optimizelegibility; text-transform: none;"></pre>
                                    <div class="tt-menu"
                                        style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                        <div class="tt-dataset tt-dataset-2"></div>
                                    </div>
                                </span>
                            </div>

                            <div id="product_details_attachments_attached_files_list" class="entities-list-container"
                                style="display: none;">
                                <div class="row">
                                    <div class="col-sm">
                                        <table class="table">
                                            <thead class="thead-default">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>File name</th>
                                                    <th>Type</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="entities-list">
                                                {foreach from=$attachments item=file name=attachedFiles}
                                                    <tr class="entity-item" style="display: contents;"
                                                        id="product_details_attachments_attached_files_{$smarty.foreach.attachedFiles.index}">
                                                        <td>
                                                            <input type="hidden"
                                                                name="product[details][attachments][attached_files][{$smarty.foreach.attachedFiles.index}][attachment_id]"
                                                                value="{$file.id_attachment}">
                                                            <input type="hidden"
                                                                name="product[details][attachments][attached_files][{$smarty.foreach.attachedFiles.index}][name]"
                                                                value="{$file.name}">
                                                            <span class="label text-preview">
                                                                <span class="text-preview-value">{$file.name}</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="hidden"
                                                                name="product[details][attachments][attached_files][{$smarty.foreach.attachedFiles.index}][file_name]"
                                                                value="{$file.file_name}">
                                                            <span class="label text-preview">
                                                                <span class="text-preview-value">{$file.file_name}</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="hidden"
                                                                name="product[details][attachments][attached_files][{$smarty.foreach.attachedFiles.index}][mime_type]"
                                                                value="{$file.mime}">
                                                            <span class="label text-preview">
                                                                <span class="text-preview-value">{$file.mime}</span>
                                                            </span>
                                                        </td>
                                                        <td><i class="material-icons entity-item-delete">clear</i></td>
                                                    </tr>
                                                {/foreach}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info empty-entity-list mt-2" role="alert">
                                <p class="alert-text">
                                    No files attached
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            {* fim attachmetns *}

            <div class="form-group">
                <hr>
            </div>

            {* inicio features *}

            <div class="form-group" style="display: none;">
                <h3>Features</h3>
                {literal}
                    <div id="product_details_features_feature_values" name="product[details][features][feature_values]"
                        data-prototype="&lt;div class=&quot;form-group row product-feature&quot;&gt;
                                                        &lt;div class=&quot;col-xl-3&quot;&gt;
                                                        &lt;fieldset class=&quot;form-group mb-0&quot;&gt;
                                                            &lt;label class=&quot;form-control-label&quot;&gt;Feature&lt;/label&gt;
                                                            &lt;select id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___feature_id&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][feature_id]&quot; data-toggle=&quot;select2&quot; class=&quot;feature-selector custom-select form-control&quot;&gt;&lt;option value=&quot;&quot;&gt;Choose a feature&lt;/option&gt;&lt;option value=&quot;15&quot;&gt;Bolt Pattern&lt;/option&gt;&lt;option value=&quot;19&quot;&gt;Brand&lt;/option&gt;&lt;option value=&quot;11&quot;&gt;Color&lt;/option&gt;&lt;option value=&quot;17&quot;&gt;Diameter&lt;/option&gt;&lt;option value=&quot;18&quot;&gt;Offset&lt;/option&gt;&lt;option value=&quot;14&quot;&gt;Width&lt;/option&gt;&lt;/select&gt;    



                                                        &lt;/fieldset&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;col-xl-4&quot;&gt;
                                                        &lt;fieldset class=&quot;form-group mb-0&quot;&gt;
                                                            &lt;label class=&quot;form-control-label&quot;&gt;Pre-defined value&lt;/label&gt;
                                                            &lt;select id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___feature_value_id&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][feature_value_id]&quot; disabled=&quot;disabled&quot; disabled=&quot;disabled&quot; data-toggle=&quot;select2&quot; class=&quot;feature-value-selector custom-select form-control&quot;&gt;&lt;option value=&quot;&quot;&gt;Choose a value&lt;/option&gt;&lt;/select&gt;    



                                                        &lt;/fieldset&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;col-lg-11 col-xl-4&quot;&gt;
                                                        &lt;fieldset class=&quot;form-group mb-0&quot;&gt;
                                                            &lt;label class=&quot;form-control-label&quot;&gt;OR Customized value&lt;/label&gt;
                                                            &lt;input type=&quot;hidden&quot; id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_id&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][custom_value_id]&quot; class=&quot;custom-value-id&quot; /&gt;

                                                                    &lt;div class=&quot;custom-values input-group locale-input-group js-locale-input-group d-flex&quot; id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value&quot; tabindex=&quot;1&quot;&gt;
                                                                                        &lt;div data-lang-id=&quot;2&quot; class=&quot; js-locale-input js-locale-en&quot; style=&quot;flex-grow: 1;&quot;&gt;

                                                        &lt;input type=&quot;text&quot; id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_2&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][custom_value][2]&quot; aria-label=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_2 input&quot; class=&quot;form-control&quot; /&gt;



                                                            &lt;/div&gt;
                                                                                                            &lt;div data-lang-id=&quot;4&quot; class=&quot; js-locale-input js-locale-es d-none&quot; style=&quot;flex-grow: 1;&quot;&gt;

                                                        &lt;input type=&quot;text&quot; id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_4&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][custom_value][4]&quot; aria-label=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_4 input&quot; class=&quot;form-control&quot; /&gt;



                                                            &lt;/div&gt;
                                                                                                            &lt;div data-lang-id=&quot;5&quot; class=&quot; js-locale-input js-locale-fr d-none&quot; style=&quot;flex-grow: 1;&quot;&gt;

                                                        &lt;input type=&quot;text&quot; id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_5&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][custom_value][5]&quot; aria-label=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_5 input&quot; class=&quot;form-control&quot; /&gt;



                                                            &lt;/div&gt;
                                                                                                            &lt;div data-lang-id=&quot;1&quot; class=&quot; js-locale-input js-locale-pt d-none&quot; style=&quot;flex-grow: 1;&quot;&gt;

                                                        &lt;input type=&quot;text&quot; id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_1&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][custom_value][1]&quot; aria-label=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_1 input&quot; class=&quot;form-control&quot; /&gt;



                                                            &lt;/div&gt;
                                                                        &lt;div class=&quot;dropdown&quot;&gt;
                                                            &lt;button class=&quot;btn btn-outline-secondary dropdown-toggle js-locale-btn&quot;
                                                                    type=&quot;button&quot;
                                                                    data-toggle=&quot;dropdown&quot;
                                                                            data-change-language-url=&quot;/admineuromus1/index.php/configure/advanced/employees/change-form-language?_token=__token__&quot;
                                                                                aria-haspopup=&quot;true&quot;
                                                                    aria-expanded=&quot;false&quot;
                                                                    id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_dropdown&quot;
                                                            &gt;
                                                                EN
                                                            &lt;/button&gt;
                                                            &lt;div class=&quot;dropdown-menu dropdown-menu-right locale-dropdown-menu&quot; aria-labelledby=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___custom_value_dropdown&quot;&gt;
                                                                            &lt;span class=&quot;dropdown-item js-locale-item&quot; data-locale=&quot;en&quot;&gt;English (English)&lt;/span&gt;
                                                                            &lt;span class=&quot;dropdown-item js-locale-item&quot; data-locale=&quot;es&quot;&gt;Español (Spanish)&lt;/span&gt;
                                                                            &lt;span class=&quot;dropdown-item js-locale-item&quot; data-locale=&quot;fr&quot;&gt;Français (French)&lt;/span&gt;
                                                                            &lt;span class=&quot;dropdown-item js-locale-item&quot; data-locale=&quot;pt&quot;&gt;Português (Portuguese)&lt;/span&gt;
                                                                        &lt;/div&gt;
                                                            &lt;/div&gt;
                                                            &lt;/div&gt;



                                                        &lt;/fieldset&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;col-lg-1 col-xl-1&quot;&gt;

                                                    &lt;button id=&quot;product_details_features_feature_values___FEATURE_VALUE_INDEX___delete&quot; name=&quot;product[details][features][feature_values][__FEATURE_VALUE_INDEX__][delete]&quot; class=&quot;tooltip-link delete-feature-value pl-0 pr-0 btn&quot; data-modal-title=&quot;Delete item&quot; data-modal-message=&quot;Are you sure you want to delete this item?&quot; data-modal-apply=&quot;Delete&quot; data-modal-cancel=&quot;Cancel&quot; data-toggle=&quot;pstooltip&quot; data-original-title=&quot;Delete&quot; type=&quot;button&quot;&gt;
                                                        &lt;i class=&quot;material-icons&quot;&gt;delete&lt;/i&gt;
                                                        &lt;span class=&quot;btn-label&quot;&gt;&lt;/span&gt;
                                                    &lt;/button&gt;
                                                        &lt;/div&gt;
                                                    &lt;/div&gt;" data-prototype-name="__FEATURE_VALUE_INDEX__"
                        class="form-group row feature-values-collection">
                        <div class="col-sm"></div>
                    </div>
                {/literal}
                <div class="form-group">
                    {foreach from=$product_features item=feature}
                        <div class="product-feature" data-id-feature="{$feature.id_feature}"
                            data-id-value="{$feature.id_feature_value}">
                            <span class="feature-name">{$feature.name|escape:'html'}</span>:
                            <span class="feature-value">{$feature.value|escape:'html'}</span>
                            <button type="button" class="btn btn-danger btn-sm js-delete-feature"
                                data-id-product="{$product->id}" data-id-feature="{$feature.id_feature}"
                                data-id-value="{$feature.id_feature_value}">
                                Delete
                            </button>
                        </div>
                    {/foreach}

                </div>
                <div class="form-group">
                    <button id="product_details_features_add_feature" name="product[details][features][add_feature]"
                        class="btn-outline-primary feature-value-add-button btn" type="button">
                        <i class="material-icons">add_circle</i>
                        <span class="btn-label">Add a feature</span>
                    </button>
                </div>
            </div>

            {* fim features *}
        </div>

        <div class="col-lg-3 bg-creation-container br25">

            <!-- Product Reference and EAN Section -->
            <div class="form-group">
                <div id="product_details_references" class="">
                    <div class="form-group text-widget">
                        <h3 for="product_details_references_reference">
                            Reference
                            {* <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                                data-content="Allowed special characters: .-_#" data-placement="top">
                            </span> *}
                        </h3>
                        {* <input type="text" class="form-control sync-input" data-sync="reference"
                            value="{$product->reference}"> *}
                        <input type="text" class="form-control" name="product[asg][reference]"
                            value="{$product->reference}">
                    </div>

                    <div class="form-group text-widget">
                        <h3 for="product_details_references_ean_13">
                            EAN-13
                            {* <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                                data-content="This type of product code is specific to Europe and Japan, but is widely used internationally."
                                data-placement="top">
                            </span> *}
                        </h3>
                        {* <input type="text" class="form-control sync-input" data-sync="ean_13" value="{$product->ean13}"> *}
                        <div style="display: flex;gap: .5rem;">
                            <input id="product_details_references_ean_13" type="text" class="form-control"
                                name="product[asg][ean13]" value="{$product->ean13}">
                            <span id="product_details_print_ean_btn" onclick="generateEan()" class="btn btn-info"><i
                                    class="material-icons">local_printshop</i></span>
                        </div>
                    </div>

                    <div class="form-group text-widget">
                        <h3 for="product_details_housing">
                            Housing
                        </h3>
                        <input type="text" class="form-control" name="product[asg][housing]"
                            value="{$product->housing}">
                    </div>

                    {* <div class="form-group text-widget"> <label for="product_details_references_mpn" style="display: none;">
                            MPN
                            <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                                data-content="MPN is used internationally to identify the Manufacturer Part Number."
                                data-placement="top" data-original-title="" title="">
                            </span>
                        </label>
                        <input type="text" id="product_details_references_mpn" name="product[asg][mpn]"
                            aria-label="product_details_references_mpn input" class="form-control">
                    </div> *}

                    {* <div class="form-group text-widget"> <label for="product_details_references_upc" style="display: none;">
                            UPC barcode
                            <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                                data-content="This type of product code is widely used in the United States, Canada, the United Kingdom, Australia, New Zealand and in other countries."
                                data-placement="top" data-original-title="" title="">
                            </span>
                        </label>
                        <input type="text" id="product_details_references_upc" name="product[asg][upc]"
                            aria-label="product_details_references_upc input" class="form-control">
                    </div> *}

                    {* <div class="form-group text-widget"> <label for="product_details_references_isbn" style="display: none;">
                            ISBN
                            <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                                data-content="The International Standard Book Number (ISBN) is used to identify books and other publications."
                                data-placement="top" data-original-title="" title="">
                            </span>
                        </label>
                        <input type="text" id="product_details_references_isbn"
                            name="product[details][references][isbn]" aria-label="product_details_references_isbn input"
                            class="form-control">
                    </div> *}

                </div>

            </div>

            <div class="form-group">
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

            <div class="form-group">
                <hr>
            </div>

            <div class="form-group" style="display: none;">
                <label for="product_visibility">Visibility</label>
                <select class="form-control" id="product_visibility" name="product[asg][visibility]">
                    <option value="both" {if $product->visibility == 'both'}selected="selected" {/if}>Everywhere
                    </option>
                    <option value="catalog" {if $product->visibility == 'catalog'}selected="selected" {/if}>Catalog only
                    </option>
                    <option value="search" {if $product->visibility == 'search'}selected="selected" {/if}>Search only
                    </option>
                    <option value="none" {if $product->visibility == 'none'}selected="selected" {/if}>Nowhere</option>
                </select>
            </div>

            <div class="form-group" style="display: none;">
                <label for="product_description_wmpackqt">Qty Pack</label>
                <input type="text" class="form-control" id="product_description_wmpackqt" name="product[asg][wmpackqt]"
                    placeholder="Enter quantity per pack" value="{$product->wmpackqt}">
            </div>

            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="product_description_ec_approved_0">
                        Ec approved
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
                    </label>

                    <div class="input-group">
                        <span class="ps-switch" id="product_description_wmdeprecated">
                            <input type="radio" id="product_description_wmdeprecated_0"
                                name="product[asg][wmdeprecated]" value="0"
                                {if isset($product->wmdeprecated) && $product->wmdeprecated != 1}checked{/if}>
                            <label for="product_description_wmdeprecated_0">No</label>

                            <input type="radio" id="product_description_wmdeprecated_1"
                                name="product[asg][wmdeprecated]" value="1"
                                {if isset($product->wmdeprecated) && $product->wmdeprecated == 1}checked{/if}>
                            <label for="product_description_wmdeprecated_1">Yes</label>

                            <span class="slide-button"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group col-lg-4">
                    <label for="product_description_real_photos_0">
                        Real Photos
                    </label>

                    <div class="input-group">
                        <span class="ps-switch" id="product_description_real_photos">
                            <input type="radio" id="product_description_real_photos_0" name="product[asg][real_photos]"
                                value="0" {if isset($product->real_photos) && $product->real_photos != 1}checked{/if}>
                            <label for="product_description_real_photos_0">No</label>

                            <input type="radio" id="product_description_real_photos_1" name="product[asg][real_photos]"
                                value="1" {if isset($product->real_photos) && $product->real_photos == 1}checked{/if}>
                            <label for="product_description_real_photos_1">Yes</label>

                            <span class="slide-button"></span>
                        </span>
                    </div>
                </div>


                <div class="form-group col-lg-4" style="display: none;">
                    <label for="product_description_not_to_order_0">
                        Not to order?
                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="Not to order helper." data-placement="top" title=""
                            style="position: absolute;"></span>
                    </label>

                    <div class="input-group">
                        <span class="ps-switch" id="product_description_not_to_order">
                            <input type="radio" id="product_description_not_to_order_0"
                                name="product[asg][not_to_order]" value="0"
                                {if isset($product->not_to_order) && $product->not_to_order != 1}checked{/if}>
                            <label for="product_description_not_to_order_0">No</label>

                            <input type="radio" id="product_description_not_to_order_1"
                                name="product[asg][not_to_order]" value="1"
                                {if isset($product->not_to_order) && $product->not_to_order == 1}checked{/if}>
                            <label for="product_description_not_to_order_1">Yes</label>

                            <span class="slide-button"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group col-lg-4" style="display: none;">
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
                <div class="input-group">

                    <div class="form-check col-lg-6">
                        <input type="hidden" name="product[asg][show_compat_exception]" value="0">
                        <input class="form-check-input" type="checkbox" id="show_compat_exception"
                            name="product[asg][show_compat_exception]" value="1"
                            {if isset($product->show_compat_exception) && $product->show_compat_exception == 1}checked{/if}>
                        <label class="form-check-label" for="show_compat_exception">
                            Compact exception
                        </label>
                    </div>

                    <div class="form-check col-lg-6">

                        <input type="hidden" name="product[asg][universal]" value="0">

                        <input class="form-check-input" type="checkbox" id="universal_product"
                            name="product[asg][universal]" value="1"
                            {if isset($product->universal) && $product->universal == 1}checked{/if}>
                        <label class="form-check-label" for="universal_product">
                            Universal
                        </label>
                    </div>

                </div>
            </div>


            <div class="form-group">
                <h3 for="youtube_code_1">YouTube</h3>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="youtube_code_1" name="product[asg][youtube_1]"
                        placeholder="YouTube Code 1" value="{$product->youtube_1}">
                    {if $shop_id == 1}
                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="{l s='Euromuscle only has one youtube video.' d='Admin.Catalog.Help'}"
                            data-placement="top">
                        </span>
                    {/if}
                </div>
                {if $shop_id != 1}
                    <div class="input-group">
                        <input type="text" class="form-control" id="youtube_2" name="product[asg][youtube_2]"
                            placeholder="YouTube Code 2" value="{$product->youtube_2}">
                    </div>
                {/if}
            </div>

            <div class="form-group">
                <h3 for="youtube_code_1">HS Code</h3>
                <div class="input-group">
                    <input type="text" class="form-control" id="hs_code" name="product[asg][nc]" placeholder="HS Code"
                        value="{$product->nc}">
                </div>
            </div>

            <div class="form-group select-widget">
                <h3 for="product_description_difficulty">
                    Difficulty
                </h3>
                <select id="product_description_difficulty" name="product[asg][difficulty]"
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

    {* <div class="col-lg-12">
        <hr>
    </div> *}

    <div class="col-lg-12 bg-creation-container br25 py-3" style="display: none;">

        <div class="form-group" style="display: flex;gap:1rem;">



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

        {* <div class="form-group">
            <hr>
        </div> *}
        {* <div class="form-group">
            <hr>
        </div> *}

    </div>

    <div class="col-lg-12 bg-creation-container br25 py-3 px-0" style="display: flex;">

        <div class="col-lg-8">
            <div class="content-price-first" style="display: flex;gap:2rem;">
                <div class="form-group">
                    <h3>Price</h3>
                    <div id="product_pricing_retail_price_asg" class="retail-price-widget">

                        <!-- Cost Price -->
                        <div class="form-group money-widget">
                            <label for="product_pricing_wholesale_price_asg">
                                {l s='Cost price (tax excl.)' d='Admin.Catalog.Help'}
                            </label>

                            <div class="input-group money-type">
                                <input type="text" id="product_pricing_wholesale_price_asg"
                                    name="product[asg][wholesale_price]" data-display-price-precision="6"
                                    class="js-comma-transformer form-control"
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
                                        <input type="checkbox" id="product_pricing_modify_all_shops_wholesale_price_asg"
                                            name="product[asg][modify_all_shops_wholesale_price]"
                                            container_class="modify-all-shops" data-value-type="boolean"
                                            class="form-check-input" value="1" />
                                        <i class="md-checkbox-control"></i>
                                        {l s='Apply changes to all stores' d='Admin.Global'}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Tax Excluded -->
                        <div class="form-group money-widget retail-price-tax-excluded ml-3">
                            <label for="product_pricing_retail_price_price_tax_excluded_asg">
                                Retail price (tax excl.)
                            </label>
                            <div class="input-group money-type">
                                <input type="text" id="product_pricing_retail_price_price_tax_excluded_asg"
                                    name="product[asg][retail_price][price_tax_excluded]"
                                    class="js-comma-transformer form-control"
                                    value="{$product->price|escape:'html':'UTF-8'}">
                                <div class="input-group-append">
                                    <span class="input-group-text">&nbsp;€</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tax Rule -->
                        <div class="form-group select-widget retail-price-tax-rules-group-id" style="display: none;">
                            <label for="product_pricing_retail_price_tax_rules_group_id_asg">Tax rule</label>
                            <select id="product_pricing_retail_price_tax_rules_group_id_asg"
                                name="product[asg][retail_price][tax_rules_group_id]"
                                class="custom-select form-control">
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
                            <label for="product_pricing_retail_price_price_tax_included_asg">
                                Retail price (tax incl.)
                            </label>
                            <div class="input-group money-type">
                                <input type="text" id="product_pricing_retail_price_price_tax_included_asg"
                                    name="product[asg][retail_price][price_tax_included]"
                                    class="js-comma-transformer form-control" value="{$retail_price_tax_incl|floatval}">
                                <div class="input-group-append">
                                    <span class="input-group-text">&nbsp;€</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <h3>{l s='Summary' d='Admin.Catalog.Feature'}</h3>

                    <div id="product_pricing_summary" name="product[asg][summary]"
                        class="price-summary-widget form-group"
                        data-price-tax-excluded="{$retail_price_tax_excl|string_format:'%.2f'} {$currency->sign} tax excl."
                        data-price-tax-included="{$retail_price_tax_incl|string_format:'%.2f'} {$currency->sign} tax incl."
                        data-unit-price="{$product->unit_price|string_format:'%.2f'} {$product->unity|escape} unit price"
                        data-margin="{($retail_price_tax_excl - $product->wholesale_price)|string_format:'%.2f'} {$currency->sign} margin"
                        data-margin-rate="{if $product->wholesale_price > 0}{(($retail_price_tax_excl - $product->wholesale_price) / $product->wholesale_price * 100)|string_format:'%.2f'}%{else}0%{/if} margin rate"
                        data-wholesale-price="{$product->wholesale_price|string_format:'%.2f'} {$currency->sign} cost price">
                        {* <div class="price-summary-block"> *}
                        {* <div class="price-summary-value price-tax-excluded-value">
                                {$retail_price_tax_excl|string_format:'%.2f'}&nbsp;{$currency->sign}
                                {l s='tax excl.' d='Admin.Catalog.Feature'}
                            </div> *}
                        {* <div class="price-summary-value price-tax-included-value">
                                {$retail_price_tax_incl|string_format:'%.2f'}&nbsp;{$currency->sign}
                                {l s='tax incl.' d='Admin.Catalog.Feature'}
                            </div> *}
                        {* <div class="price-summary-value unit-price-value {if !$product->unit_price}d-none{/if}">
                                {$product->unit_price|string_format:'%.2f'}&nbsp;{$currency->sign} /
                                {$product->unity|escape}
                            </div> *}
                        {* </div> *}

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
                            {* <div class="price-summary-value wholesale-price-value">
                                {$product->wholesale_price|string_format:'%.2f'}&nbsp;{$currency->sign}
                                {l s='cost price' d='Admin.Catalog.Feature'}
                            </div> *}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div id="specific-prices-container_asg" style="display: flex;gap:2rem;">
                    <div>
                        <h2>
                            {l s='Specific prices' d='Admin.Catalog.Feature'}
                        </h2>
                        <div id="product_pricing_specific_prices_asg">
                            <div class="form-group">
                                <button id="product_pricing_specific_prices_add_specific_price_btn_asg"
                                    name="product[asg][specific_prices][add_specific_price_btn]"
                                    class="js-add-specific-price-btn btn btn-outline-primary"
                                    data-modal-title="{l s='Add new specific price' d='Admin.Catalog.Feature'}"
                                    data-confirm-button-label="{l s='Save and publish' d='Admin.Actions'}"
                                    data-cancel-button-label="{l s='Cancel' d='Admin.Actions'}" type="button">
                                    <i class="material-icons">add_circle</i>
                                    <span
                                        class="btn-label">{l s='Add a specific price' d='Admin.Catalog.Feature'}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="specific-price-list-container_asg">
                            <table class="table {if $specific_data|count > 0}d-block{else}d-none{/if}"
                                id="specific-prices-list-table_asg" style="width: fit-content;">
                                <thead class="thead-default">
                                    <tr>

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
                                                    <label>{l s='From'}
                                                        <span>{$specific.duration.from|date_format:"%Y-%m-%d"}</span></label><br>
                                                    <label>{l s='To'}
                                                        <span>{$specific.duration.to|date_format:"%Y-%m-%d"}</span></label>
                                                {else}
                                                    <label>{$specific.duration}</label>
                                                {/if}
                                            </td>
                                            <td class="from-qty">{$specific.units}</td>

                                            <td>
                                                <span class="btn tooltip-link delete-specific-price"
                                                    onclick="deleteSpecificPrice({$specific.id})"
                                                    data-specific-price-id="{$specific.id}" title="Delete">
                                                    <i class="material-icons">delete</i>
                                                </span>
                                            </td>

                                            <td>
                                                <span type="button" title="Edit"
                                                    class="js-edit-specific-price-btn btn tooltip-link"
                                                    data-modal-title="Edit specific price"
                                                    data-confirm-button-label="Save and publish"
                                                    data-cancel-button-label="Cancel"
                                                    data-specific-price-id="{$specific.id}">
                                                    <i class="material-icons">edit</i>
                                                </span>
                                            </td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-12 bg-creation-container br25 py-3 ">
        <!-- Product Autocomplete Input -->
        <div class="form-group">
            <h3>Related Products</h3>
            <input type="text" id="related-product-autocomplete" class="form-control"
                placeholder="Reference, Name id product (min 3 chars)" autocomplete="off" />
            <ul id="related-products-list" class="entities-list mt-3">
                {foreach from=$related_products item=rp}
                    <li class="related-product entity-item col-lg-2">
                        <div class="related-product-image">
                            <input type="hidden" name="product[description][related_products][{$rp@iteration}][image]"
                                value="{$rp.image_url}" />
                            <img src="{$rp.image_url}" alt="{$rp.name}" width="50" />
                        </div>
                        <div class="related-product-legend">
                            <input type="hidden" name="product[description][related_products][{$rp@iteration}][name]"
                                value="{$rp.name}" />
                            <input type="hidden" name="product[description][related_products][{$rp@iteration}][id]"
                                value="{$rp.id_product}" />
                            <span class="label text-preview">
                                <span class="text-preview-value">{$rp.reference} - {$rp.name}</span>
                                <span class="text-preview-prefix">
                                    <i class="material-icons entity-item-delete"
                                        onclick="deleteRelatedProduct(this, '{$rp.id_product}')">delete</i>
                                </span>
                            </span>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>

        <!-- Template for Related Product -->
        <script type="text/template" id="related-product-template">
            <li class="related-product entity-item col-lg-2">
                <div class="related-product-image ">
                    <input type="hidden" name="product[description][related_products][__index__][image]" value="__image__" />
                    <img src="__image__" alt="Image preview"  />
                </div>
                <div class="related-product-legend">
                    <input type="hidden" name="product[description][related_products][__index__][name]" value="__name__" />
                    <span class="label text-preview">
                        <span class="text-preview-value">__name__</span>
                        <span class="text-preview-prefix">
                            <i class="material-icons entity-item-delete" onclick="deleteRelatedProduct(this, '__id__')">delete</i>
                        </span>
                    </span>
                </div>
                <input type="hidden" name="product[description][related_products][__index__][id]" value="__id__" />
            </li>
        </script>

    </div>

</div>

<script>
    let typingTimer;
    const delay = 300;

    $('#related-product-autocomplete').on('input', function() {
        clearTimeout(typingTimer);
        const query = $(this).val();

        if (query.length >= 3) {
            typingTimer = setTimeout(() => {
                fetchMatchingProducts(query);
            }, delay);
        }
    });

    function fetchFeatureValues(featureId, $valueSelect) {
        $.ajax({
            url: window.admin_url,
            method: 'POST',
            dataType: 'json',
            data: {
                ajax: true,
                action: 'getFeatureValuesByFeatureId', // You need to handle this in your controller
                feature_id: featureId,
                token: window.token
            },
            success: function(res) {
                if (!res.success || !res.values) {
                    $valueSelect.prop('disabled', true).empty().append(
                        '<option value="">Choose a value</option>');
                    return;
                }

                $valueSelect.empty().append('<option value="">Choose a value</option>');

                res.values.forEach(function(value) {
                    $valueSelect.append(
                        $('<option>', {
                            value: value.id,
                            text: value.name
                        })
                    );
                });

                $valueSelect.prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Feature value fetch error:', error);
                $valueSelect.prop('disabled', true).empty().append(
                    '<option value="">Choose a value</option>');
            }
        });
    }


    function fetchMatchingProducts(query) {
        $.ajax({
            url: window.admin_url,
            method: 'POST',
            dataType: 'json',
            data: {
                ajax: true,
                action: 'searchProductByReferencePrefix',
                query: query,
                token: window.token
            },
            success: function(res) {
                if (!res.success) {
                    return;
                }

                // Show suggestions
                showSuggestions(res.products);
            },
            error: function(xhr, status, error) {
                console.error('Autocomplete error:', error);
            }
        });
    }

    function showSuggestions(products) {
        const $input = $('#related-product-autocomplete');

        // Remove existing suggestions
        $('.autocomplete-suggestions').remove();

        if (!products || products.length === 0) {
            const $alert = $(`
                <div class="alert alert-info mt-2" role="alert">
                    No products found.
                </div>
            `);
            $input.after($alert);

            // Optionally auto-remove the alert after a few seconds
            setTimeout(() => {
                $alert.fadeOut(300, function() { $(this).remove(); });
            }, 3000);

            return;
        }

        const $suggestions = $(
            '<div class="autocomplete-suggestions list-group position-absolute bg-white shadow" style="z-index: 999;"></div>'
        );

        products.forEach(product => {
            const $item = $(
                '<a href="#" class="list-group-item list-group-item-action"><img style="max-width:50px;" src="' +
                product.image + '" />' + product.reference + ' - ' + product.name + '</a>');

            $item.on('click', function(e) {
                e.preventDefault();
                addRelatedProduct(product);
                $('.autocomplete-suggestions').remove();
                $input.val('');
            });
            $suggestions.append($item);
        });

        $('.autocomplete-suggestions').remove(); // Remove any existing ones
        $input.after($suggestions);
    }

    function addRelatedProduct(product) {
        const index = $('#related-products-list li').length;
        let template = $('#related-product-template').html();
        template = template
            .replace(/__index__/g, index)
            .replace(/__id__/g, product.id)
            .replace(/__name__/g, product.name)
            .replace(/__image__/g, product.image);

        $('#related-products-list').append(template);

        $('#product_footer_save').prop('disabled', false);
    }

    function deleteRelatedProduct(element, id) {
        // Remove from custom list
        $(element).closest('li').remove();

        // Find and remove from the original PrestaShop list
        const $originalItems = $('#product_description_related_products_list li');

        $originalItems.each(function() {
            const $input = $(this).find('input[name*="[id]"]');
            if ($input.length && $input.val() === id.toString()) {
                $(this).remove();
            }
        });

        $('#product_footer_save').prop('disabled', false);
    }


    // Close suggestions on click outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.autocomplete-suggestions, #related-product-autocomplete').length) {
            $('.autocomplete-suggestions').remove();
        }
    });
</script>


<!-- TinyMCE Initialization Script -->
<script src="{$base_url}js/tiny_mce/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitButton = document.querySelector('#modal-specific-price-form .btn-lg.btn-confirm-submit');
        const dismissButton = document.querySelector('#modal-specific-price-form [data-dismiss="modal"]');

        if (submitButton && dismissButton) {
            submitButton.addEventListener('click', function() {
                // Trigger the modal dismiss button
                dismissButton.click();

                // Show notification (Bootstrap 5 Toast-style fallback)
                const alertBox = document.createElement('div');
                alertBox.className = 'alert alert-success position-fixed top-0 end-0 m-3 shadow';
                alertBox.style.zIndex = '1055';
                alertBox.innerText = 'Specific price saved successfully!';
                document.body.appendChild(alertBox);

                // Auto-dismiss after 3 seconds
                setTimeout(() => {
                    alertBox.remove();
                }, 3000);
            });
        }


        // atachmerts token

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        var token = getUrlParameter('_token');


        if (token) {
            // Select all elements in the DOM
            document.querySelectorAll('*').forEach(function(el) {
                // Loop through all attributes of the element
                Array.from(el.attributes).forEach(function(attr) {
                    if (attr.value.includes('__token__')) {
                        // Replace __token__ with actual token
                        el.setAttribute(attr.name, attr.value.replace(/__token__/g, token));
                    }
                });
            });
        }

    });


    function deleteSpecificPrice(id) {
        if (!confirm('Are you sure you want to delete this specific price?')) {
            return;
        }

        $.ajax({
            url: window.admin_url, // This should be set in your template
            type: 'POST',
            data: {
                ajax: true,
                action: 'deleteSpecificPrice',
                id_specific_price: id,
                token: window.token // Make sure to pass the security token
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Find and remove the row from the table
                    $('tr[data-specific-price-id="' + id + '"]').remove();

                    // If no more rows, hide the table
                    if ($('#specific-prices-list-table tbody tr').length === 0) {
                        $('#specific-prices-list-table').removeClass('d-block');
                        $('#specific-prices-list-table').addClass('d-none');
                    }
                } else {
                    alert('Failed to delete specific price: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                alert('AJAX error: ' + error);
            }
        });
    }




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
        const allTags = [tagBrand, tagRef, ...tagRefVariations, ...uniqueTags];

        const filteredTags = allTags
            .filter(tag => typeof tag === 'string')  // Adjust this to ensure no truncation
            .map(tag => tag.trim());

        const container = document.querySelector(`#product_seo_tags_` + langId + ``).closest('.tokenfield');
        const existingTags = Array.from(container.querySelectorAll('.token')).map(token => token.dataset.value);

        // Clear previous tags
        // container.querySelectorAll('.token').forEach(el => el.remove());

        filteredTags.forEach(tag => {
            if (!existingTags.includes(tag)) {
                const token = document.createElement('div');
                token.className = 'token';
                token.dataset.value = tag;

                const label = document.createElement('span');
                label.className = 'token-label';
                label.style.maxWidth = '951.213px';
                label.textContent = tag;

                const close = document.createElement('a');
                close.href = '#';
                close.className = 'close';
                close.tabIndex = -1;
                close.innerHTML = '&times;';
                close.addEventListener('click', (e) => {
                    e.preventDefault();
                    token.remove();
                    updateHiddenInputByLangId(langId);
                });

                token.appendChild(label);
                token.appendChild(close);

                container.insertBefore(token, container.querySelector('.token-input'));
            }
        });

        updateHiddenInputByLangId(langId);
    });

    function updateHiddenInputByLangId(langId) {
        const container = document.querySelector(`#product_seo_tags_` + langId + ``).closest('.tokenfield');
        const tokens = container.querySelectorAll('.token');
        const values = Array.from(tokens).map(token => token.dataset.value);
        const hiddenInput = document.querySelector(`#product_seo_tags_` + langId + ``);
        if (hiddenInput) {
            hiddenInput.value = values.join(', ');
        }
        buttonSaveProductFooter.removeAttribute('disabled');
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
            if (!input || typeof input.value !== 'string') return;
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
            plugins: 'lists link image table code autoresize',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
            height: null, // Let TinyMCE handle the height automatically
            resize: true,
            statusbar: false, // Disable the status bar
            path: false, // Disable the path toolbar
            skin: 'prestashop',
            content_css:  '{$ps_base_url}/js/tiny_mce/skins/prestashop/content.min.css',
            entity_encoding: 'raw',
            autoresize_on_init: true,
            autoresize_bottom_margin: 20,
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

                    const btn = document.querySelector("#product_footer_save");
                    if (btn) {
                        // Remove the attribute (replace 'disabled' with your attribute)
                        btn.removeAttribute('disabled');
                    }
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

        const singleElementsToRemove = [
            '#product_details #product_details_features_feature_values',
            '#product_details > h3'
        ]

        const elementsToRemove = [
            '#product_details #product_details_features_add_feature',
            '#product_details #product_details_attachments',
            '#product_details #product_details_references_reference',
            '#product_details #product_details_references_ean_13',
            '#product_details #product_details_housing',
            // '#product_details #product_details_references_mpn',
            // '#product_details #product_details_references_upc',
            // '#product_details #product_details_references_isbn',
            '#product_details #product_details_references',
            '#product_description #product_description_description_short',
            '#product_description #product_description_description',
            '#product_seo #product_seo_tags',
            '#product_description #product_description_categories',
            '#product_description #product_description_manufacturer',
        ];

        singleElementsToRemove.forEach(function(selector) {
            const element = document.querySelector(selector);
            if (element) {
                console.log('Removing element:', selector);
                element.remove();
            } else {
                console.log('Element not found for selector:', selector);
            }
        });

        elementsToRemove.forEach(function(selector) {
            const element = document.querySelector(selector);
            if (element && element.parentElement) {
                console.log('Removing element:', selector);
                element.parentElement.remove();
            } else {
                console.log('Element not found for selector:', selector);
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


    $(document).on('change', '.feature-selector', function() {
        const $featureSelect = $(this);
        const featureId = $featureSelect.val();
        const $container = $featureSelect.closest('.product-feature');
        const $valueSelect = $container.find('.feature-value-selector');

        if (!featureId) {
            $valueSelect.prop('disabled', true).empty().append('<option value="">Choose a value</option>');
            return;
        }

        fetchFeatureValues(featureId, $valueSelect);
    });

    $(document).on('click', '.js-delete-feature', function() {
        const $btn = $(this);
        const productId = $btn.data('id-product');
        const featureId = $btn.data('id-feature');
        const featureValueId = $btn.data('id-value');

        if (!confirm('Are you sure you want to delete this feature from the product?')) {
            return;
        }

        $.ajax({
            url: window.admin_url,
            method: 'POST',
            dataType: 'json',
            data: {
                ajax: true,
                action: 'deleteProductFeature',
                id_product: productId,
                id_feature: featureId,
                id_feature_value: featureValueId,
                token: window.token
            },
            success: function(res) {
                if (res.success) {
                    $btn.closest('.product-feature').fadeOut();
                } else {
                    alert('Failed to delete feature: ' + res.message);
                }
            },
            error: function() {
                alert('An error occurred while deleting the feature.');
            }
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all inputs, selects, and checkboxes
        const elements = document.querySelectorAll('input, select, textarea');
        const saveButton = document.getElementById('product_footer_save');

        elements.forEach(function(element) {
            element.addEventListener('change', function() {
                if (saveButton) {
                    saveButton.removeAttribute('disabled');
                    saveButton.classList.remove('disabled'); // if it has a "disabled" class
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all input/select elements inside the #product_pricing_retail_price_asg container
        const container = document.getElementById("product_pricing_retail_price_asg");
        const fields = container.querySelectorAll("input[name^='product[asg]'], select[name^='product[asg]']");

        fields.forEach(field => {
            field.addEventListener("input", syncWithOriginal);
            field.addEventListener("change", syncWithOriginal);
        });

        function syncWithOriginal(e) {
            const source = e.target;
            const asgName = source.getAttribute("name");
            if (!asgName) return;

            const pricingName = asgName.replace("[asg]", "[pricing]");
            const original = document.querySelector(`[name="` + pricingName + `"]`);

            if (original) {
                // For inputs/selects, just copy value
                original.value = source.value;

                // If it's a select element, trigger change in case it's bound to events
                if (original.tagName === "SELECT") {
                    original.dispatchEvent(new Event("change", { bubbles: true }));
                }
            }
        }

        const metadescription = document.querySelector("#product_seo-tab #product_seo_meta_description");
        if (metadescription) {
            metadescription.parentElement.style.display = 'none';
        }
    });
</script>

<script defer="defer">
    document.addEventListener('DOMContentLoaded', function() {
        function updateRetailPriceTaxIncluded() {
            const priceExclInput = document.getElementById(
                'product_pricing_retail_price_price_tax_excluded_asg');
            const taxRulesSelect = document.getElementById(
                'product_pricing_retail_price_tax_rules_group_id_asg');
            const priceInclInput = document.getElementById(
                'product_pricing_retail_price_price_tax_included_asg');

            const priceExcl = parseFloat(priceExclInput.value.replace(',', '.')) || 0;
            const selectedOption = taxRulesSelect.options[taxRulesSelect.selectedIndex];
            const taxRate = parseFloat(selectedOption.getAttribute('data-tax-rate')) || 0;

            const priceIncl = priceExcl * (1 + (taxRate / 100));
            priceInclInput.value = priceIncl.toFixed(2);
        }

        document.getElementById('product_pricing_retail_price_price_tax_excluded_asg')
            .addEventListener('input', updateRetailPriceTaxIncluded);

        document.getElementById('product_pricing_retail_price_tax_rules_group_id_asg')
            .addEventListener('change', updateRetailPriceTaxIncluded);
    });

    if({$shop_id} == 6){
    document.querySelector("#product_pm_advancedpack_custom_html-tab-nav").style.display = 'none'
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const saveButton = document.getElementById('product_footer_save');
        if (saveButton) {
            saveButton.removeAttribute('disabled');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.tokenfield').forEach(container => {
            container.addEventListener('copy', function(e) {
                e.preventDefault();

                // Get all the selected tokens inside this token field
                const selectedTokens = Array.from(container.querySelectorAll('.token')).filter(
                    token => {
                        const label = token.querySelector('.token-label');
                        if (!label) return false; // Skip if no label

                        // Check if the label is selected
                        return window.getSelection().containsNode(label, true);
                    });

                // If there are selected tokens, prepare the text to copy
                if (selectedTokens.length > 0) {
                    const textToCopy = selectedTokens
                        .map(token => token.dataset.value || token.querySelector('.token-label')
                            ?.textContent.trim())
                        .filter(Boolean)
                        .join(', ');

                    // Set the copied text to clipboard
                    e.clipboardData.setData('text/plain', textToCopy);
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

    .bg-container {
        background: #eaebec;
    }

    .bg-creation-container {
        background: #fff;
    }

    .br25 {
        border-radius: .25rem;
    }

    .entity-item {
        border: 2px solid #333;
        border-radius: .25rem;
    }

    .entity-item-delete {
        cursor: pointer;
        color: var(--danger);
    }

    .related-product-image img {
        max-width: 50px;
    }

    #product_pricing-tab-nav {
        display: none;
    }

    #product_description .form-group:nth-child(3) {
        display: none;
    }

    #product_description_description_short_custom {
        display: none;
    }

    #product_options-tab-nav {
        display: none;
    }

    #product_details-tab-nav {
        display: none;
    }

    #product_description-tab-nav {
        display: none;
    }

    .related-product.entity-item {
        display: flex;
    }

    .product-page-v2 .tokenfield .token .close {
        user-select: none;
    }

    .tokenfield .token>.token-label {
        user-select: text;
    }

    .tokenfield .token>.token-label::after {
        content: ", ";
        opacity: 0;
    }

    .tokenfield .token:last-child>.token-label::after {
        content: "";
    }
</style>