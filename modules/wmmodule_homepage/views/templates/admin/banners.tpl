<div style="display: block;" id="banners_container" class="elements_container">
    <div style="display: inline-block;border: 1px solid #444;">
        {foreach $banners AS $index => $banner}
            <div style="border-bottom: 3px solid dodgerblue;width: 100%;">
                <div class="banner_container" id="container_{$banner['id']}">
             	    <input type="hidden" name="position[{$banner['id']}]" value="{$index+1}">
             	    <input type="hidden" name="type[{$banner['id']}]" value="desktop">
             	    <input type="hidden" name="icon_type[{$banner['id']}]" value="1">
             	    {assign var=id_manufacturer value="_"|explode:$banner['link']}
             	    <input type="hidden" id="homepage_manufacturer_id_manufacturer_{$banner['id']}" name="homepage_manufacturer_id_manufacturer[{$banner['id']}]" value="{$id_manufacturer[0]}">
             	    <input type="hidden" id="homepage_manufacturer_id_{$banner['id']}" name="homepage_manufacturer_id[{$banner['id']}]" value="">
             	    <div style="display: flex;">
             	        <div style="border-bottom: 1px solid #666;"></div>
                        <div style="width: 68%; float: left;"> <img id="image_{$banner['id']}" src="{$banner['image_en']}{if strlen($banner['image_en']) > 0}?t={rand()}{/if}" style="width: 1100px;border: 1px solid #000;height: 200px;background-image: url('/modules/wmmodule_homepage/views/images/upload_banner.webp');background-position: center;background-repeat: no-repeat;background-size: contain;" onclick="setModal({$banner['id']},1,$('#select_brand_{$banner['id']}'))"> </div>
                        <div style="width: calc(32% - 10px);float: left;margin: 0 10px;">                            
                            <div style="margin-top: 10px;"> <input type="checkbox" onclick="ativa('ativo_{$banner['id']}');" id="ativo_{$banner['id']}" value="1" name="active[{$banner['id']}]" {if $banner['active'] == 1} checked="checked" {else} {/if}> <span style="margin-left: 5px;"> Ativo</span> </div>
                            <div style="margin-top: 10px;width: 100%; float: left;">
                                <label>Select brand</label> 
                                <select id="select_brand_{$banner['id']}" name="link[{$banner['id']}]" onclick="setImageText(this, {$banner['id']}, 'select_brand_{$banner['id']}')">
                                    <option value="">---</option>
                                    <option value="523_clearence" {if "523_clearence" == $banner['link']} selected {/if}>Clearence</option>
                                    {foreach $manufacturers AS $manufacturer} 
                                        <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $banner['link']} selected {/if} >{$manufacturer['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div style="display:none;margin-top: 10px;width: 0%; float: left; color: black; font-weight: bolder; font-size: 16px; text-transform: uppercase; text-align: center; padding: 27px 0 0 0;" ></div>
                            <div style="display:none;margin-top: 10px;width: 0%; float: left;">
                                <label>Select car</label> 
                                {assign var="compat" value="`$banner['brand']`_`$banner['model']`_`$banner['type']`_`$banner['version']`"}
                                <select id="select_car_{$banner['id']}" name="car[{$banner['id']}]" onclick="setImageText($(this), {$banner['id']}, 'select_car_{$banner['id']}');">
                                    <option value="">---</option>
                                {*
                                    {foreach $cars AS $car}
                                        <option value="{implode('_', array_keys($car['filters']))}" {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                                    {/foreach}
                                 *}
                                </select>                        
                            </div>
                            <div style="color: #666; text-transform: uppercase; background-color: #ddd;padding: 5px;display: inline-block; padding: 10px; margin-top: 10px;">
                                <span  style="width: 80px; float: left;padding: 5px 0;">Inglês</span>
                                <input style="width: calc(100% - 80px); float: left;" name="title_en[{$banner['id']}]" type="text" value="{$banner['title_en']}" placeholder="Titulo em inglês" id="title_en_{$banner['id']}">
                                <span  style="width: 80px; float: left;padding: 5px 0;">Espanhol</span>
                                <input style="width: calc(100% - 80px); float: left;" name="title_es[{$banner['id']}]" type="text" value="{$banner['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$banner['id']}">
                                <span  style="width: 80px; float: left;padding: 5px 0;">Francês</span>
                                <input style="width: calc(100% - 80px); float: left;" name="title_fr[{$banner['id']}]" type="text" value="{$banner['title_fr']}" placeholder="Titulo em francês" id="title_fr_{$banner['id']}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
</div>