<div style="display: none;" id="sliders50_container" class="elements_container">

    {foreach $array_icons_50 AS $index => $icons_50}
        <div style="border: 1px solid #666;flex:1;padding: 5px;">
     	    <input type="hidden" name="position[{$icons_50['id']}]" value="{$index+1}">
     	    <input type="hidden" name="type[{$icons_50['id']}]" value="desktop">
     	    <input type="hidden" name="icon_type[{$icons_50['id']}]" value="2">
            <input type="hidden" value="1" name="active[{$icons_50['id']}]"> 
     	    {assign var=id_manufacturer value="_"|explode:$icons_50['link']}
     	    <input type="hidden" id="homepage_manufacturer_id_manufacturer_{$icons_50['id']}" name="homepage_manufacturer_id_manufacturer[{$icons_50['id']}]" value="{$id_manufacturer[0]}">
     	    <input type="hidden" id="homepage_manufacturer_id_{$icons_50['id']}" name="homepage_manufacturer_id[{$icons_50['id']}]" value="">
            <img id="image_{$icons_50['id']}" src="{$icons_50['image_en']}{if strlen($icons_50['image_en']) > 0}?t={rand()}{/if}" style="object-fit:cover;background-color: #fff;margin-bottom: 10px;width: 100%;border: 1px solid #000;min-height: 365px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;object-fit:cover;max-height: 365px;" onclick="setModal({$icons_50['id']},2,$('#select_brand_{$icons_50['id']}'))">
            <div>
                <div style="display: flex;align-items:center;flex-wrap:wrap;">
                    <div style="width: 45%;">
                        <label>Select brand</label> 
                        <select id="select_brand_{$icons_50['id']}" name="link[{$icons_50['id']}]" onclick="setImageText(this, {$icons_50['id']}, 'select_brand_{$icons_50['id']}')">
                            <option value="">---</option>
                            <option value="523_clearence" {if "523_clearence" == $icons_50['link']} selected {/if}>Clearence</option>
                            {foreach $manufacturers AS $manufacturer}
                                <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $icons_50['link']} selected {/if}>{$manufacturer['name']}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div style="width: 10%;">
                        <div style="color: black; font-weight: bolder; font-size: 16px; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                    </div>
                    <div style="width: 45%;">
                        {assign var="compat" value="`$icons_50['brand']`_`$icons_50['model']`_`$icons_50['type']`_`$icons_50['version']`"}
                        <label>Select car</label> 
                        <select id="select_car_{$icons_50['id']}" name="car[{$icons_50['id']}]" onclick="setImageText(this, {$icons_50['id']}, 'select_car_{$icons_50['id']}');">
                            {* <option value="">---</option> *}
                            
                            {foreach $cars AS $car}
                                {* <option value="{implode('_', array_keys($car['filters']))}" {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option> *}
                                <option value="{implode('_', array_keys($car['filters']))}" {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                            {/foreach}
                        
                        </select>
                    </div>
                    <div style="width: 100%;display:flex;flex-direction: column;margin:0.5rem 0;">
                                <label style="color: #103054;">ID of Product</label> 
                                <input class="id_product_input" style="width: 100%;height:39px;color: #555;font-size:0.85rem;" name="link_[{$icons_50['id']}]" type="number" value="{$icons_50['link']}" placeholder="0" id="link_{$icons_50['id']}" onchange="setIdProduct(this,{$icons_50['id']})">  
                    </div>
                </div>
                <div style="color: #666; text-transform: uppercase; background-color: #ddd;padding: 5px;display: inline-block; padding: 10px; width: 100%;">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Inglês</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_en[{$icons_50['id']}]" type="text" value="{$icons_50['title_en']}" placeholder="Titulo em inglês" id="title_en_{$icons_50['id']}">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Espanhol</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_es[{$icons_50['id']}]" type="text" value="{$icons_50['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$icons_50['id']}">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Francês</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_fr[{$icons_50['id']}]" type="text" value="{$icons_50['title_fr']}" placeholder="Titulo em francês" id="title_fr_{$icons_50['id']}">
                </div>
            </div>
        </div>
    {/foreach}
</div>