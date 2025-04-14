{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license
*}
{if $ps}
    {foreach from=$languages item=language}
        {if $languages|count > 1}
            <div class="translatable-field row lang-{$language.id_lang|escape:'htmlall':'UTF-8'}">
            <div class="col-lg-9">
        {/if}
    {if isset($maxchar)}
        <div class="input-group">
        <span id="{$input_name|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}_counter" class="input-group-addon">
    				<span class="text-count-down">{$maxchar|escape:'htmlall':'UTF-8'}</span>
    			</span>
    {/if}
        <input type="text"
               id="{$input_name|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}"
               class="form-control {if isset($input_class)}{$input_class|escape:'htmlall':'UTF-8'} {/if}"
               name="{$input_name|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}"
               value="{$input_value[$language.id_lang]|escape:'htmlall':'UTF-8'}"
               onkeyup="if (isArrowKey(event)) return ;updateFriendlyURL();"
               onblur="updateLinkRewrite();"
                {if isset($required)} required="required"{/if}
                {if isset($maxchar)} data-maxchar="{$maxchar|escape:'htmlall':'UTF-8'}"{/if}
                {if isset($maxlength)} maxlength="{$maxlength|escape:'htmlall':'UTF-8'}"{/if} />
    {if isset($maxchar)}
        </div>
    {/if}
        {if $languages|count > 1}
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                    {$language.iso_code|escape:'htmlall':'UTF-8'}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    {foreach from=$languages item=language}
                        <li>
                            <a href="javascript:tabs_manager.allow_hide_other_languages = false;hideOtherLanguage({$language.id_lang|escape:'htmlall':'UTF-8'});">{$language.name|escape:'htmlall':'UTF-8'}</a>
                        </li>
                    {/foreach}
                </ul>
            </div>
            </div>
        {/if}
    {/foreach}
    {if isset($maxchar)}
        <script type="text/javascript">
            function countDown($source, $target) {
                var max = $source.attr("data-maxchar");
                $target.html(max-$source.val().length);

                $source.keyup(function(){
                    $target.html(max-$source.val().length);
                });
            }

            $(document).ready(function(){
                {foreach from=$languages item=language}
                countDown($("#{$input_name|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}"), $("#{$input_name|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}_counter"));
                {/foreach}
            });
        </script>
    {/if}
{else}
    
    {assign  var="defaultlanguage" value=Configuration::get('PS_LANG_DEFAULT')}

    {foreach from=$languages item=language}

    <div class="{$input_name|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}" style="display: {if $language.id_lang == Configuration::get('PS_LANG_DEFAULT')} block {else} none {/if};float: left;">
        <input type="text" 
            name="{$input_name|escape:'html':'UTF-8'}_{$language.id_lang|escape:'html':'UTF-8'}" 
            class="input_{$input_name|escape:'html':'UTF-8'}_{$language.id_lang|escape:'html':'UTF-8'}" 
            value="{if $input_value[$language.id_lang]} {$input_value[$language.id_lang]|escape:'htmlall':'UTF-8'} {/if}" />
     </div>
    {/foreach}
    {$thismodule->displayFlags($languages, Configuration::get('PS_LANG_DEFAULT'), $input_name, $input_name, true)}    {*Generation code html, pas neccesaire de escape*}
{/if}
