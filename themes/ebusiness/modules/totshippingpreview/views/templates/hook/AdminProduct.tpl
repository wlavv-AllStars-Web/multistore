{*
* @version 1.0
* @author 202-ecommerce
* @copyright 2014-2015 202-ecommerce
* @license ?
*}
<div class="panel product-tab">
    <h3>{$name|escape:'html':'UTF-8'}</h3>
    {if !$ps}
        {include file='../admin/multilangform/js.tpl'}
    {/if}
    <div class="form-group">
        <label for="delivery_time_{$id_lang|escape:'html':'UTF-8'}" class="control-label col-lg-3">
            <span class="totlabel_tooltip" data-toggle="tooltip" title="" data-original-title="{l s='You can also additional delivery days for this product' mod='totshippingpreview'}">
                {l s='Delivery time (days) :' mod='totshippingpreview'}
            </span>
        </label>
        <div class="col-lg-9">
            <div class="col-lg-9">
                <input type="text" name="delivery_time" value="{$delivery_time|escape:'htmlall':'UTF-8'}" >
            </div>
        </div>
        <label class="col-lg-3"></label>
        <div class="col-lg-9">
            <p class="help-block">{l s='Leave empty to use default value' mod='totshippingpreview'}</p>
        </div>
        <br><br><br>
        <label for="place_delivery_{$id_lang|escape:'html':'UTF-8'}" class="control-label col-lg-3">
            <span class="totlabel_tooltip" data-toggle="tooltip" title="" data-original-title="{l s='Specify a specific place of delivery for this product' mod='totshippingpreview'}">
            {l s='Place of delivery :' mod='totshippingpreview'}
                </span>
        </label>
        <div class="col-lg-9">
            <div class="col-lg-9">
                {include file="./input_text_lang.tpl"
                languages=$languages
                input_value=$place_delivery
                input_name="place_delivery"
                }
            </div>
        </div>
        <label class="col-lg-3"></label>
        <div class="col-lg-9">
            <p class="help-block">{l s='Leave empty to use default value' mod='totshippingpreview'}</p>
        </div>
        <br><br><br>
        <label for="origin_country_{$id_lang|escape:'html':'UTF-8'}" class="control-label col-lg-3">
            <span class="totlabel_tooltip" data-toggle="tooltip" title="" data-original-title="{l s='Indicate the country of origin for this product' mod='totshippingpreview'}">
            {l s='Country of origin :' mod='totshippingpreview'}
                </span>
        </label>

        <div class="col-lg-9">
            <div class="col-lg-9">
                {include file="./input_text_lang.tpl"
                languages=$languages
                input_value=$origin_country
                input_name="origin_country"
                }
            </div>
        </div>
        <label class="col-lg-3"></label>
        <div class="col-lg-9">
            <p class="help-block">{l s='Leave empty to use default value' mod='totshippingpreview'}</p>
        </div>
    </div>
    {if $ps}
    <div class="panel-footer">
        <a href="{$link->getAdminLink('AdminProducts')|escape:'html':'UTF-8'}{if isset($smarty.request.page) && $smarty.request.page > 1}&amp;submitFilterproduct={$smarty.request.page|intval}{/if}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel' mod='totshippingpreview'}</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> {l s='Save' mod='totshippingpreview'}</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> {l s='Save and stay' mod='totshippingpreview'}</button>
    </div>
    {/if}

    {if !$ps}
    <style type="text/css">
        .help-block {
            font-family: Georgia, Arial, 'sans-serif';
            font-style: italic;
            width: 500px;
            color: #7F7F7F;
            font-size: 11px;
            margin-top: 25px;
        }
    </style>
    {/if}

    <script type="text/javascript">
        var iso = '{$iso_tiny_mce|escape:'htmlall':'UTF-8'}';
        var pathCSS = '{$smarty.const._THEME_CSS_DIR_|escape:'htmlall':'UTF-8'}';
        var ad = '{$ad|escape:'htmlall':'UTF-8'}';
        $('.totlabel_tooltip').tooltip();
        if (tabs_manager.allow_hide_other_languages)
            hideOtherLanguage({$default_form_language}); /* Html code generated, no escape*/
    </script>
</div>
