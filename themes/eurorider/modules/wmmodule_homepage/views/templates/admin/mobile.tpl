{assign var="currentLanguageIso" value=Context::getContext()->language->iso_code}
{assign var="currentShop" value=Context::getContext()->shop->id}
<div id="mobile_container">
    <div style="display: flex;">
        <div class="options_mobile_container" style="cursor: pointer;display: flow-root;margin-top: 10px;flex:1;background-color: dodgerblue; " onclick="$('.elements_mobile_container').css('display', 'none');$('#container_block_mobile_0').toggle();$('#container_block_mobile_0').css('display', 'flex');$('.options_mobile_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
            <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> POSITION 1 </div>
        </div>
        <div class="options_mobile_container" style="cursor: pointer;display: flow-root;margin-top: 10px;flex:1;background-color: grey;" onclick="$('.elements_mobile_container').css('display', 'none');$('#container_block_mobile_1').toggle();$('#container_block_mobile_1').css('display', 'flex');$('.options_mobile_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
            <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> POSITION 2 </div>
        </div>
        <div class="options_mobile_container" style="cursor: pointer;display: flow-root;margin-top: 10px;flex:1;background-color: grey;" onclick="$('.elements_mobile_container').css('display', 'none');$('#container_block_mobile_2').toggle();$('#container_block_mobile_2').css('display', 'flex');$('.options_mobile_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
            <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> POSITION 3 </div>
        </div>
    </div>
    <div style="display: flex">
        {foreach $mobile_icons AS $index => $mobile}
            
            <div id="container_block_mobile_{$index}" class="elements_mobile_container" style="margin-top: 20px;display: flex;justify-content:center;width: 100%;{if $index == 0} dispplay: block; {else} display:none; {/if}">

                <div style="width: 25%;">
                    <img id="image_{$mobile['id']}" src="{$mobile['image_en']}{if strlen($mobile['image_en']) > 0}?t={rand()}{/if}" style="background-color: #fff;width: 100%;height:100%;border: 1px solid #000;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;object-fit: cover;" onclick="setModal({$mobile['id']},{$mobile['icon_type']},$('#select_brand_{$mobile['id']}'))">
                </div>
                <div style="width: 25%;border: 1px solid #000;">
                    <input type="hidden" value="$mobile_icon_1['active']" name="active"> 
                    <div style="padding: 5px;margin-top: 10px;padding: 0 10px;">
                        <div style="display: flex;flex-wrap:wrap;">
                            <div style="width: 45%;">
                                <label>Select brand</label> 
                                <select id="select_brand_{$mobile['id']}" name="link" onclick="setImageText(this, {$mobile['id']}, 'select_car_{$mobile['id']}')">
                                    <option value="">---</option>
                                    <option value="523_clearence" {if "523_clearence" == $mobile['link']} selected {/if}>Clearence</option>
                                    {foreach $manufacturers AS $manufacturer}
                                        <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $mobile['link']} selected {/if}>{$manufacturer['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div style="width: 10%;"> <div style="color: black; font-weight: bolder; font-size: 20px; text-transform: uppercase; text-align: center;" ></div> </div>
                            <div style="width: 45%;">
                                {assign var="compat" value="`$mobile['brand']`_`$mobile['model']`_`$mobile['type']`_`$mobile['version']`"}
                                <label>Select car</label> 
                                <select id="select_car_{$mobile['id']}" name="car" onclick="setImageText(this, {$mobile['id']}, 'select_brand_{$mobile['id']}');">
                                    <option value="">---</option>
                                   
                                   {foreach $cars AS $car}
                                        <option value="{implode('_', array_keys($car['filters']))}" {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                                    {/foreach}
                                   
                                </select>
                            </div>
                            <div style="width: 100%;display:flex;flex-direction: column;margin:0.5rem 0;">
                                <label style="color: #103054;">ID of Product</label> 
                                <input class="id_product_input" style="width: 100%;height:39px;color: #555;font-size:0.85rem;" name="link_[{$mobile['id']}]" type="number" value="{$mobile['link']}" placeholder="0" id="link_{$mobile['id']}" onchange="setIdProduct(this,{$mobile['id']})">  
                            </div>
                        </div>
                        <div style="margin-top: 20px;">
                            <div style="color: #555; text-transform: uppercase;padding: 5px 0;display: flex;">
                                <div   style="width: 80px; float: left;font-weight: bolder;">Inglês</div>
                                <input style="width: calc(100% - 80px); float: left;" name="title_en" type="text" value="{$mobile['title_en']}" placeholder="Titulo em inglês" id="title_en_{$mobile['id']}">
                            </div>
                            <div style="color: #555; text-transform: uppercase;padding: 5px 0;display: flex;">
                                <div   style="width: 80px; float: left;font-weight: bolder;">Espanhol</div>
                                <input style="width: calc(100% - 80px); float: left;" name="title_en" type="text" value="{$mobile['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$mobile['id']}">
                            </div>
                            <div style="color: #555; text-transform: uppercase;padding: 5px 0;display: flex;">
                                <div   style="width: 80px; float: left;font-weight: bolder;">Francês</div>
                                <input style="width: calc(100% - 80px); float: left;" name="title_en" type="text" value="{$mobile['title_fr']}" placeholder="Titulo em francês" id="title_fr_{$mobile['id']}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
        {/foreach}
    </div>
    <div style="text-align: center;margin: 10px;padding: 10px;">
        <button type="button" class="btn btn-primary" onclick="$('#showMobilePreview').toggle();$('#mobile_container').toggle();$('#abas_container').toggle();" style="width:200px;">PREVIEW</button>
    </div>
</div>
<div id="showMobilePreview" style="display: none;background-color: #111;">
    
    <div style="background-color: #fff;">
    
        <div style="text-align: center;padding: 30px;width: 100%;display: inline-block;">
            <button type="button" class="btn btn-primary" onclick="$('#showMobilePreview').toggle();$('#mobile_container').toggle();$('#abas_container').toggle();" style="width: 320px;">BACK TO EDITOR</button>
        </div>
    
        <div style="width: 320px;margin: 0 auto;background-color: #5c5c5c;">
            <div style="width: 100%;">
                <img style="width: 100%;" src="/modules/wmmodule_homepage/views/images/header_mobile{$currentShop}.png"> 
            </div>   

            {foreach from=$mobile_icons item=item key=key name=name}
                <div style="width: 100%;padding: 5px;">
                    <img id="preview_image_{$item['id']}" src="{$item['image_en']}" style="overflow: hidden;border: 1px solid #999;width: 100%;min-height:210px;object-fit:cover;"> 
                </div>
            {/foreach}

            <div style="width: 100%;">
                <img style="width: 100%;" src="/modules/wmmodule_homepage/views/images/body_mobile{$currentShop}.png"> 
            </div>
            <div class="videosContainer" style="flex-direction:column;">
                {foreach $array_videos AS $index => $video}
                    <div class="video3 video">
                    <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
                    <img id="preview_image_{$video['id']}"  src="{$video["image_{$currentLanguageIso}"]}"/>
                        <div class="play">
                        <img class="image_play" alt="video player" src="/img/youtube_play.png" />
                        </div>
                    </div>
                    </div>
                {/foreach}
            </div>

            <div style="width: 100%;">
                <img style="width: 100%;" src="/modules/wmmodule_homepage/views/images/footer_mobile{$currentShop}.png"> 
            </div>
        </div>
        
        <div style="text-align: center;padding: 30px;">
            <button type="button" class="btn btn-primary" onclick="saveMobileLive();" style="width:320px;">SAVE</button>
        </div>
    </div>
</div>

<style>
 .videosContainer
{
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 5px;
  padding: 2rem 15px;
  background-color: #707c88;
}

.videosContainer .video
{
    flex: 1;
}

.videosContainer .video3
{
  position: relative;
}

.videosContainer img
{
  cursor: pointer;
  width: 100%;
  object-fit: contain;
  object-position: center;
}

.videosContainer .image_play
{
  max-width: 100px !important;
  position: absolute !important;
  pointer-events: none;
  width: 100%;
  object-fit: contain;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}

</style>