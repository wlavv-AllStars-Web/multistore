{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license
*}

<div class="panel" id="tot-customization">
    <h3>{l s='Customization' mod='totshippingpreview'}</h3>
    <form method="post" action="" enctype="multipart/form-data">

    <div class="row">
        <div class="col-lg-8">
            <h4>{l s='Button : normal state' mod='totshippingpreview'}</h4>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">{l s='Text color' mod='totshippingpreview'}</label>
                <div class="col-lg-2">
                    <input type="text" class="mColorPicker" data-hex="true" name="tot_txt" id="tot_txt" {if isset($totTxtCol)} value="{$totTxtCol|escape:'htmlall':'UTF-8'}" {/if}>
                </div>
                <span class="mColorPickerTrigger" id="icp_tot_txt" data-mcolorpicker="true"><img src="../img/admin/color.png"/></span>
            </div>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">{l s='Background color' mod='totshippingpreview'}</label>
                <div class="col-lg-2">
                    <input type="text" class="mColorPicker" data-hex="true" name="tot_bg" id="tot_bg" {if isset($totBgCol)} value="{$totBgCol|escape:'htmlall':'UTF-8'}" {/if}>
                </div>
                <span class="mColorPickerTrigger" id="icp_tot_bg" data-mcolorpicker="true"><img src="../img/admin/color.png"/></span>
            </div>

            <h4>{l s='Button : on hover' mod='totshippingpreview'}</h4>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">{l s='Text color' mod='totshippingpreview'}</label>
                <div class="col-lg-2">
                    <input type="text" class="mColorPicker" data-hex="true" name="tot_txt_hov" id="tot_txt_hov" {if isset($totTxtColHov)} value="{$totTxtColHov|escape:'htmlall':'UTF-8'}" {/if}>
                </div>
                <span class="mColorPickerTrigger" id="icp_tot_txt_hov" data-mcolorpicker="true"><img src="../img/admin/color.png"/></span>
            </div>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">{l s='Background color' mod='totshippingpreview'}</label>
                <div class="col-lg-2">
                    <input type="text" class="mColorPicker" data-hex="true" name="tot_bg_hov" id="tot_bg_hov" {if isset($totBgColHov)} value="{$totBgColHov|escape:'htmlall':'UTF-8'}" {/if}>
                </div>
                <span class="mColorPickerTrigger" id="icp_tot_bg_hov" data-mcolorpicker="true"><img src="../img/admin/color.png"/></span>
            </div>

            <h4>{l s='Button : content' mod='totshippingpreview'}</h4>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">{l s='Enter text to display' mod='totshippingpreview'}</label>
                <div class="col-lg-2">
                    {foreach from=$languages item=lang}
                    {assign var="lang_id" value=$lang.id_lang }
                    <input type="text" class="tot-lang" id_lang="{$lang.id_lang|escape:'htmlall':'UTF-8'}" name="tot_disp_txt[{$lang.id_lang|escape:'htmlall':'UTF-8'}]" {if $lang.iso_code != $iso} style="display: none;" {/if} {if isset($totTxt.$lang_id)} value="{$totTxt.$lang_id|escape:'htmlall':'UTF-8'}" {/if}>
                    {/foreach}
                </div>
                <div class="col-lg-1">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id="tot-iso">{$iso|escape:'htmlall':'UTF-8'}</span> <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="padding: 10px;">
                       {foreach from=$languages item=lang}
                           <li class ="lang-list" iso="{$lang.iso_code|escape:'htmlall':'UTF-8'}" id_lang="{$lang.id_lang|escape:'htmlall':'UTF-8'}" style="margin: 10px;">{$lang.name|escape:'htmlall':'UTF-8'}</li>
                       {/foreach}
                    </ul>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-2">{l s='Upload image' mod='totshippingpreview'}</label>
                <input type="file" name="tot_pic">
                {if !empty($totPic)}
                <img src="{$totImgDir|escape:'htmlall':'UTF-8'}{$totPic|escape:'htmlall':'UTF-8'}" class="col-lg-1" style="margin-top: 10px; margin-bottom: 10px;">
                {/if}
            </div>
        </div>

        <div class="col-lg-4">
            <div style="margin : 20px; padding: 20px; text-align: center;">
                <p class="h3" id="tot-btn">{l s='Preview' mod='totshippingpreview'}</p>
                <p>
                    {l s='For displaying the preview of the image you should save the configurations before (the image should be uploaded)' mod='totshippingpreview'}
                </p>
                <a class="btn btn-primary" id="tot-prv" style="
                        {if isset($totTxtCol) && !empty($totTxtCol)}
                        color : {$totTxtCol|escape:'htmlall':'UTF-8'};
                        {/if}
                        {if isset($totBgCol) && !empty($totBgCol)}
                        background-color : {$totBgCol|escape:'htmlall':'UTF-8'};
                        {else}
                        background-color: #428bca;
                        {/if}
                        border:none;
                        padding: 6px 12px;
                        height: 32px;
                    ">
                    {if isset($totPic) && !empty($totPic)}
                        <img src="{$totImgDir|escape:'htmlall':'UTF-8'}{$totPic|escape:'htmlall':'UTF-8'}" style="width: auto; height: 100%;">
                    {else}
                        <img src="{$totImgDir|escape:'htmlall':'UTF-8'}camion.png" style="width: auto; height: 100%;">
                    {/if}
                    {if isset($totTxt) && !empty($totTxt)}
                        <span style="margin-left: 10px; margin-right: 5px; font-size:13px;  text-transform: none">{$totTxt.$lang_current|escape:'htmlall':'UTF-8'}</span>
                    {else}
                        <span style="margin-left: 10px; margin-right: 5px; font-size:13px; text-transform: none">{l s='Preview shipping costs' mod='totshippingpreview'}</span>
                    {/if}
                </a>
                <p style="padding: 2vh; cursor: pointer;" id="prv-ref"><small><strong>{l s='Click to refresh' mod='totshippingpreview'}</strong></small></p>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <button type="submit" name="totshippingpreview_customization_submit" class="btn btn-default pull-right" value="1">
            <i class="process-icon-save"></i>{l s='Save' mod='totshippingpreview'}
        </button>
    </div>

    </form>
</div>

<script type="text/javascript">
    var txtcol = "{$totTxtCol|escape:'htmlall':'UTF-8'}";
    var bgcol = "{$totBgCol|escape:'htmlall':'UTF-8'}";
    var txtcolhov = "{$totTxtColHov|escape:'htmlall':'UTF-8'}";
    var bgcolhov = "{$totBgColHov|escape:'htmlall':'UTF-8'}";
    var totTab = "{$totTab|escape:'htmlall':'utf-8'}";
    
    window.addEventListener('load', function() {
        if (totTab) {
            $(totTab).trigger('click');
        }
    });
    $(document).ready(function() {
        $('#tot-prv').click(function(event){
            event.preventDefault();
        });
        $('.mColorPicker').each(function() {
            var color = $(this).val();
            $(this).css('background-color', color);
        });
        $('.lang-list').click(function() {
            $('#tot-iso').text($(this).attr('iso'));
            var langChosen = $(this).attr('id_lang');
            $('.tot-lang').each(function() {
                if ( $(this).attr('id_lang') == langChosen ) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        setHover(txtcolhov, bgcolhov, txtcol, bgcol);

        // LIVE preview
        $('#prv-ref').click(function() {
            updatePreview();
        });
    });

    function updatePreview() {
        var tcol = $('#tot_txt').val();
        var bcol = $('#tot_bg').val();
        var thcol = $('#tot_txt_hov').val();
        var bhcol = $('#tot_bg_hov').val();
        var txt = $('input.tot-lang:visible').val();
        $('#tot-prv').find('span').text(txt);

        $('#tot-prv').css('color', tcol);
        $('#tot-prv').css('background-color', bcol);
        setHover(thcol, bhcol, tcol, bcol);
    }

    function setHover(hovtxt, hovbg, txt, bg) {
        if (hovtxt != '') {
            $('#tot-prv').hover(
                function() {
                    $(this).css('color', hovtxt);
                },
                function() {
                    $(this).css('color', txt);
                }
            );
        }
        if (hovbg != '') {
            $('#tot-prv').hover(
                function() {
                    $(this).css('background-color', hovbg);
                },
                function() {
                    $(this).css('background-color', bg);
                }
            );
        }
    }

    function disactivate()
    {

    }
</script>