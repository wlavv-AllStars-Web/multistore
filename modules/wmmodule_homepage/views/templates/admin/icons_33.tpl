{* <pre>{print_r($array_icons_50,1)}</pre> *}
<div style="display: none;" id="sliders33_container" class="elements_container">
{assign var="currentShop" value=Context::getContext()->shop->id}
{assign var=cardNumber value=0}


    {foreach $array_icons_50 AS $index_50 => $icons_50}
        {if $currentShop == 1}
        <h1 style="font-weight: 700;width:100%">Card {$index_50 + 1}</h1>
        {/if}
        <div style="display: flex;gap:0.5rem;margin-top:1rem;">
        {foreach $array_icons_33 AS $index_33 => $icons_33} 
            {if $index_50 == 0 && $icons_33.id_parent_card == 1}
                
                    <div style="border: 1px solid #666;flex:1;padding: 5px;min-height:560px;background:#808080;color:#fff">
                        <input type="hidden" name="position[{$icons_33['id']}]" value="{$index+1}">
                        <input type="hidden" name="type[{$icons_33['id']}]" value="desktop">
                        <input type="hidden" name="icon_type[{$icons_33['id']}]" value="3">
                        <input type="hidden" value="1" name="active[{$icons_33['id']}]"> 
                        {assign var=id_manufacturer value="_"|explode:$icons_33['link']}
                        <input type="hidden" id="homepage_manufacturer_id_manufacturer_{$icons_33['id']}" name="homepage_manufacturer_id_manufacturer[{$icons_33['id']}]" value="{$id_manufacturer[0]}">
                        <input type="hidden" id="homepage_manufacturer_id_{$icons_33['id']}" name="homepage_manufacturer_id[{$icons_33['id']}]" value="">
                        <img id="image_{$icons_33['id']}" inputparentcard="1" src="{$icons_33['image_en']}{if strlen($icons_33['image_en']) > 0}?t={rand()}{/if}" style="background-color: #fff;margin-bottom: 10px;width: 100%;border: 1px solid #000;min-height: 365px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;object-fit: cover;max-height: 365px;" onclick="setModal({$icons_33['id']},3,$('#select_mini_{$icons_33['id']}'),'miniature')">
                        
                        {if $currentShop != 1}
                        <div style="display:flex;">
                            <div style="width: 45%;">
                                <label>Select brand</label> 
                                <select id="select_brand_{$icons_33['id']}" name="link[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_brand_{$icons_33['id']}')" style="padding:5px;">
                                    <option value="">---</option>
                                    <option value="523_clearence" {if "523_clearence" == $icons_33['link']} selected {/if}>Clearence</option>
                                    {foreach $manufacturers AS $manufacturer}
                                        <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $icons_33['link']} selected {/if}>{$manufacturer['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div style="width: 10%;">
                                <div style="color: black; font-weight: bolder; font-size: 1rem; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                            </div>
                            <div style="width: 45%;">
                                <label>Select car</label> 
                                {assign var="compat" value="`$icons_33['brand']`_`$icons_33['model']`_`$icons_33['type']`_`$icons_33['version']`"}
                                <select id="select_car_{$icons_33['id']}" name="car[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_car_{$icons_33['id']}');" style="padding:5px;">
                                    <option value="">---</option>
                                    
                                    {foreach $cars AS $car}
                                        <option value="{implode('_', array_keys($car['filters']))}"  {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                                    {/foreach}
                                
                                </select>
                            </div>
                        </div>
                        {/if}

                        {if $currentShop == 1}
                            <div style="display: flex;flex-wrap:wrap;">
                            <div style="width: 45%;float: left;display:none;">
                                <label>Select Parent</label> 
                                <select id="select_mini_{$icons_33['id']}" inputparentcard="1"  name="link[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_mini_{$icons_33['id']}')" style="padding:5px;">
                                    <option value="">---</option>
                                    {* {foreach $array_icons_50 AS $icons_50} *}
                                        <option value="{$icons_50.id}" selected >{$icons_50.id}</option>
                                    {* {/foreach} *}
                                </select>
                            </div>
                            <div style="width: 10%;display:none;">
                                <div style="color: black; font-weight: bolder; font-size: 1rem; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                            </div>
                            <div style="width: 100%;">
                                <label>Select car</label> 
                                {assign var="compat" value="`$icons_33['brand']`_`$icons_33['model']`_`$icons_33['type']`_`$icons_33['version']`"}
                                <select id="select_car_{$icons_33['id']}" name="car[{$icons_33['id']}]" onclick="setIdToZero(this, {$icons_33['id']});" style="padding:5px;">
                                    <option value="">---</option>
                                    
                                    {foreach $cars AS $car}
                                        <option value="{implode('_', array_keys($car['filters']))}"  {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                                    {/foreach}
                                
                                </select>
                            </div>
                            <div style="width: 100%;display:flex;flex-direction: column;margin:0.5rem 0;">
                                <label style="color: #103054;">ID of Product</label> 
                                <input class="id_product_input" style="width: 100%;height:39px;color: #555;font-size:0.85rem;" name="link_[{$icons_33['id']}]" type="number" value="{$icons_33['link']}" placeholder="0" id="link_{$icons_33['id']}" onchange="setIdProduct(this,{$icons_33['id']})">  
                            </div>
                            </div>
                        {/if}


                    

                        <div style="color: #666; text-transform: uppercase; background-color: #808080;color:#fff;padding: 5px;display: inline-block;">
                            <span  style="width: 80px; float: left;padding: 5px 0;">Inglês</span>
                            <input style="width: calc(100% - 80px); float: left;" name="title_en[{$icons_33['id']}]" type="text" value="{$icons_33['title_en']}" placeholder="Titulo em inglês" id="title_en_{$icons_33['id']}">
                            <span  style="width: 80px; float: left;padding: 5px 0;">Espanhol</span>
                            <input style="width: calc(100% - 80px); float: left;" name="title_es[{$icons_33['id']}]" type="text" value="{$icons_33['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$icons_33['id']}">
                            <span  style="width: 80px; float: left;padding: 5px 0;">Francês</span>
                            <input style="width: calc(100% - 80px); float: left;" name="title_fr[{$icons_33['id']}]" type="text" value="{$icons_33['title_fr']}" placeholder="Titulo em francês" id="title_fr_{$icons_33['id']}">
                        </div>
                    </div>
                
            {elseif $index_50 == 1 && $icons_33.id_parent_card == 2}
                <div style="border: 1px solid #666;flex:1;padding: 5px;min-height:560px;background:#808080;color:#fff;">
                <input type="hidden" name="position[{$icons_33['id']}]" value="{$index+1}">
                <input type="hidden" name="type[{$icons_33['id']}]" value="desktop">
                <input type="hidden" name="icon_type[{$icons_33['id']}]" value="3">
                <input type="hidden" value="1" name="active[{$icons_33['id']}]"> 
                {assign var=id_manufacturer value="_"|explode:$icons_33['link']}
                <input type="hidden" id="homepage_manufacturer_id_manufacturer_{$icons_33['id']}" name="homepage_manufacturer_id_manufacturer[{$icons_33['id']}]" value="{$id_manufacturer[0]}">
                <input type="hidden" id="homepage_manufacturer_id_{$icons_33['id']}" name="homepage_manufacturer_id[{$icons_33['id']}]" value="">
                <img id="image_{$icons_33['id']}" inputparentcard="2" src="{$icons_33['image_en']}{if strlen($icons_33['image_en']) > 0}?t={rand()}{/if}" style="background-color: #fff;margin-bottom: 10px;width: 100%;border: 1px solid #000;min-height: 365px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;object-fit: cover;max-height: 365px;" onclick="setModal({$icons_33['id']},3,$('#select_mini_{$icons_33['id']}'),'miniature')">
                {* <div style="width: 40%;float: left;">
                    <label>Select brand</label> 
                    <select id="select_brand_{$icons_33['id']}" name="link[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_brand_{$icons_33['id']}')" style="padding:5px;">
                        <option value="">---</option>
                        <option value="523_clearence" {if "523_clearence" == $icons_33['link']} selected {/if}>Clearence</option>
                        {foreach $manufacturers AS $manufacturer}
                            <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $icons_33['link']} selected {/if}>{$manufacturer['name']}</option>
                        {/foreach}
                    </select>
                </div>
                <div style="width: 10%;float: left;">
                    <div style="color: black; font-weight: bolder; font-size: 1rem; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                </div>
                <div style="width: 40%;float: left;">
                    <label>Select car</label> 
                    {assign var="compat" value="`$icons_33['brand']`_`$icons_33['model']`_`$icons_33['type']`_`$icons_33['version']`"}
                    <select id="select_car_{$icons_33['id']}" name="car[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_car_{$icons_33['id']}');" style="padding:5px;">
                        <option value="">---</option>
                        
                        {foreach $cars AS $car}
                            <option value="{implode('_', array_keys($car['filters']))}"  {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                        {/foreach}
                    
                    </select>
                </div> *}

                
                <div style="display: flex;flex-wrap:wrap;">
                <div style="width: 45%;float: left;display:none;">
                    <label>Select Parent</label> 
                    <select id="select_mini_{$icons_33['id']}" inputparentcard="1"  name="link[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_mini_{$icons_33['id']}')" style="padding:5px;">
                        <option value="">---</option>
                        {* {foreach $array_icons_50 AS $icons_50} *}
                            <option value="{$icons_50.id}" selected >{$icons_50.id}</option>
                        {* {/foreach} *}
                    </select>
                </div>
                <div style="width: 10%;display:none;">
                    <div style="color: black; font-weight: bolder; font-size: 1rem; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                </div>
                <div style="width: 100%;">
                    <label>Select car</label> 
                    {assign var="compat" value="`$icons_33['brand']`_`$icons_33['model']`_`$icons_33['type']`_`$icons_33['version']`"}
                    <select id="select_car_{$icons_33['id']}" name="car[{$icons_33['id']}]" onclick="setIdToZero(this, {$icons_33['id']});" style="padding:5px;">
                        <option value="">---</option>
                        
                        {foreach $cars AS $car}
                            <option value="{implode('_', array_keys($car['filters']))}"  {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                        {/foreach}
                    
                    </select>
                </div>
                <div style="width: 100%;display:flex;flex-direction: column;margin:0.5rem 0;">
                    <label style="color: #103054;">ID of Product</label> 
                    <input class="id_product_input" style="width: 100%;height:39px;color: #555;font-size:0.85rem;" name="link_[{$icons_33['id']}]" type="number" value="{$icons_33['link']}" placeholder="0" id="link_{$icons_33['id']}" onchange="setIdProduct(this,{$icons_33['id']})">  
                </div>
                </div>
                


            

                <div style="color: #666; text-transform: uppercase;background:#808080;color:#fff;padding: 5px;display: inline-block;">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Inglês</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_en[{$icons_33['id']}]" type="text" value="{$icons_33['title_en']}" placeholder="Titulo em inglês" id="title_en_{$icons_33['id']}">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Espanhol</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_es[{$icons_33['id']}]" type="text" value="{$icons_33['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$icons_33['id']}">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Francês</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_fr[{$icons_33['id']}]" type="text" value="{$icons_33['title_fr']}" placeholder="Titulo em francês" id="title_fr_{$icons_33['id']}">
                </div>
            </div>
            {elseif $index_50 == 2 && $icons_33.id_parent_card == 3}
                <div style="border: 1px solid #666;flex:1;padding: 5px;background:#808080;color:#fff;min-height:560px">
                <input type="hidden" name="position[{$icons_33['id']}]" value="{$index+1}">
                <input type="hidden" name="type[{$icons_33['id']}]" value="desktop">
                <input type="hidden" name="icon_type[{$icons_33['id']}]" value="3">
                <input type="hidden" value="1" name="active[{$icons_33['id']}]"> 
                {assign var=id_manufacturer value="_"|explode:$icons_33['link']}
                <input type="hidden" id="homepage_manufacturer_id_manufacturer_{$icons_33['id']}" name="homepage_manufacturer_id_manufacturer[{$icons_33['id']}]" value="{$id_manufacturer[0]}">
                <input type="hidden" id="homepage_manufacturer_id_{$icons_33['id']}" name="homepage_manufacturer_id[{$icons_33['id']}]" value="">
                <img id="image_{$icons_33['id']}" src="{$icons_33['image_en']}{if strlen($icons_33['image_en']) > 0}?t={rand()}{/if}" style="background-color: #fff;margin-bottom: 10px;width: 100%;border: 1px solid #000;min-height: 365px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;object-fit: cover;max-height: 365px;" onclick="setModal({$icons_33['id']},3,$('#select_mini_{$icons_33['id']}'),'miniature')">
                {* <div style="width: 40%;float: left;">
                    <label>Select brand</label> 
                    <select id="select_brand_{$icons_33['id']}" name="link[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_brand_{$icons_33['id']}')" style="padding:5px;">
                        <option value="">---</option>
                        <option value="523_clearence" {if "523_clearence" == $icons_33['link']} selected {/if}>Clearence</option>
                        {foreach $manufacturers AS $manufacturer}
                            <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $icons_33['link']} selected {/if}>{$manufacturer['name']}</option>
                        {/foreach}
                    </select>
                </div>
                <div style="width: 10%;float: left;">
                    <div style="color: black; font-weight: bolder; font-size: 1rem; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                </div>
                <div style="width: 40%;float: left;">
                    <label>Select car</label> 
                    {assign var="compat" value="`$icons_33['brand']`_`$icons_33['model']`_`$icons_33['type']`_`$icons_33['version']`"}
                    <select id="select_car_{$icons_33['id']}" name="car[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_car_{$icons_33['id']}');" style="padding:5px;">
                        <option value="">---</option>
                        
                        {foreach $cars AS $car}
                            <option value="{implode('_', array_keys($car['filters']))}"  {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                        {/foreach}
                    
                    </select>
                </div> *}

                
                <div style="display: flex;flex-wrap:wrap;">
                            <div style="width: 45%;float: left;display:none;">
                                <label>Select Parent</label> 
                                <select id="select_mini_{$icons_33['id']}" inputparentcard="1"  name="link[{$icons_33['id']}]" onclick="setImageText(this, {$icons_33['id']}, 'select_mini_{$icons_33['id']}')" style="padding:5px;">
                                    <option value="">---</option>
                                    {* {foreach $array_icons_50 AS $icons_50} *}
                                        <option value="{$icons_50.id}" selected >{$icons_50.id}</option>
                                    {* {/foreach} *}
                                </select>
                            </div>
                            <div style="width: 10%;display:none;">
                                <div style="color: black; font-weight: bolder; font-size: 1rem; text-transform: uppercase; text-align: center; padding: 15px 15px 0px 15px;" > OR </div>
                            </div>
                            <div style="width: 100%;">
                                <label>Select car</label> 
                                {assign var="compat" value="`$icons_33['brand']`_`$icons_33['model']`_`$icons_33['type']`_`$icons_33['version']`"}
                                <select id="select_car_{$icons_33['id']}" name="car[{$icons_33['id']}]" onclick="setIdToZero(this, {$icons_33['id']});" style="padding:5px;">
                                    <option value="">---</option>
                                    
                                    {foreach $cars AS $car}
                                        <option value="{implode('_', array_keys($car['filters']))}"  {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                                    {/foreach}
                                
                                </select>
                            </div>
                            <div style="width: 100%;display:flex;flex-direction: column;margin:0.5rem 0;">
                                <label style="color: #103054;">ID of Product</label> 
                                <input class="id_product_input" style="width: 100%;height:39px;color: #555;font-size:0.85rem;" name="link_[{$icons_33['id']}]" type="number" value="{$icons_33['link']}" placeholder="0" id="link_{$icons_33['id']}" onchange="setIdProduct(this,{$icons_33['id']})">  
                            </div>
                            </div>

            

                <div style="color: #fff; text-transform: uppercase; background-color: #808080;padding: 5px;display: inline-block;">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Inglês</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_en[{$icons_33['id']}]" type="text" value="{$icons_33['title_en']}" placeholder="Titulo em inglês" id="title_en_{$icons_33['id']}">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Espanhol</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_es[{$icons_33['id']}]" type="text" value="{$icons_33['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$icons_33['id']}">
                    <span  style="width: 80px; float: left;padding: 5px 0;">Francês</span>
                    <input style="width: calc(100% - 80px); float: left;" name="title_fr[{$icons_33['id']}]" type="text" value="{$icons_33['title_fr']}" placeholder="Titulo em francês" id="title_fr_{$icons_33['id']}">
                </div>
            </div>
            {/if}
        {/foreach}
        </div>
    {/foreach}
</div>


<style>
.id_product_input:focus {
    border: none !important;
    border-color:#103054 !important;
    background: #e6e6e6 !important;
}
.id_product_input:focus-visible {
    border-color:#103054 !important;
    background: #e6e6e6 !important;
    border: none !important;
}
</style>

