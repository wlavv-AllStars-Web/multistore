{assign var="currentLanguageIso" value=Context::getContext()->language->iso_code}
{assign var="currentShop" value=Context::getContext()->shop->id}
<div id="desktop_container" style="font-weight: bolder;display:flex;flex-direction:column;">
    {*
    <form id="desktop_form" action="/admin77500/index.php?controller=AdminWmModuleHomepage&action=updateDesktop&token={Tools::getValue('token')}" enctype="multipart/form-data" method="POST">
    *}
        <div>
            <div class="options_desktop_container" style="cursor: pointer;display: flow-root;margin-top: 10px;width:25%;float:left;background-color: dodgerblue; " onclick="$('.elements_container').css('display', 'none');$('#banners_container').toggle();$('.options_desktop_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
                <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> BANNERS </div>
            </div>
            <div class="options_desktop_container" style="cursor: pointer;display: flow-root;margin-top: 10px;width:25%;float:left;background-color: grey;" onclick="$('.elements_container').css('display', 'none');$('#sliders50_container').toggle();$('#sliders50_container').css('display','flex');$('.options_desktop_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
                <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> ICONS 50% </div>
            </div>
            {if $currentShop == 1}
                <div class="options_desktop_container" style="cursor: pointer;display: flow-root;margin-top: 10px;width:25%;float:left;background-color: grey;" onclick="$('.elements_container').css('display', 'none');$('#sliders33_container').toggle();$('.options_desktop_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
                    <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> ICONS 33% </div>
                </div>
            {else}
                <div class="options_desktop_container" style="cursor: pointer;display: flow-root;margin-top: 10px;width:25%;float:left;background-color: grey;" onclick="$('.elements_container').css('display', 'none');$('#sliders33_container').toggle();$('#sliders33_container').css('display','flex');$('.options_desktop_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
                    <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder; color: #FFF;text-align: center;"> ICONS 33% </div>
                </div>
            {/if}
            <div class="options_desktop_container" style="cursor: pointer;display: flow-root;margin-top: 10px;width:25%;float:left;background-color: grey;" onclick="$('.elements_container').css('display', 'none');$('#videos_container').toggle();$('.options_desktop_container').css('background-color', 'grey'); $(this).css('background-color', 'dodgerblue')">
                <div style="width: 100%;text-align: left;border-top: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;padding: 5px;font-weight: bolder;color: #FFF;text-align: center;"> VIDEOS </div>
            </div>
        </div>
        <div>
            {include file="$modules/wmmodule_homepage/views/templates/admin/banners.tpl"}
            {include file="$modules/wmmodule_homepage/views/templates/admin/icons_50.tpl"}
            {include file="$modules/wmmodule_homepage/views/templates/admin/icons_33.tpl"}
            {include file="$modules/wmmodule_homepage/views/templates/admin/videos.tpl"}            
        </div>

        <div style="text-align: center;margin: 10px;padding: 10px;">
            <button type="button" class="btn btn-primary" onclick="$('#showDesktopPreview').toggle();$('#desktop_container').toggle();$('#mobile_container').toggle();$('#abas_container').toggle();" style="width:400px;">PREVIEW</button>
        </div>
    {*</form>*}
</div>
<div id="showDesktopPreview" style="display: none;background-color: #111;">
    
    <div style="background-color: #fff;">

        <div style="text-align: center;padding: 30px;width: 100%;display: inline-block;">
            <button type="button" class="btn btn-primary" onclick="$('#showDesktopPreview').toggle();$('#desktop_container').toggle();$('#mobile_container').toggle();$('#abas_container').toggle();" style="width:400px;">BACK TO EDITOR</button>
        </div>
    
        <div style="width: 1000px;margin: 0 auto;background-color: #333;">

            <div style="width: 100%;">
                <img style="width: 100%;" src="/modules/wmmodule_homepage/views/images/header{$currentShop}.png"> 
            </div>
            <div class="bannersHome">
            
                {foreach $array_icons_50 AS $index_50 => $icons_50 }
                <div class="card-img-container">
                    <div class="card-big">
                    <div class="layerHover">
                        <h6>{$icons_50["title_{$currentLanguageIso}"]}</h6>
                    </div>
                    
                    <img id="preview_image_{$icons_50['id']}" src="{$icons_50["image_{$currentLanguageIso}"]}" />
                    </div>
                    <div class="card-min-img" style="{if $index_50 == 0}background:#ee302e{elseif $index_50 == 1}background:#103054;{elseif $index_50 == 2}background:#ddd;{/if}">
                    {foreach $array_icons_33 AS $index_33 => $icons_33}
                        {if $index_50 == 0 && $icons_33.id_parent_card == 1}
                            <div class="card-img ">
                            <div class="layerHover">{$icons_33["title_{$currentLanguageIso}"]}</div>
                            <img id="preview_image_{$icons_33['id']}" src="{$icons_33["image_{$currentLanguageIso}"]}?t={rand()}" />
                            </div>
                        {elseif  $index_50 == 1 && $icons_33.id_parent_card == 2}
                            <div class="card-img ">
                            <div class="layerHover">{$icons_33["title_{$currentLanguageIso}"]}</div>
                            <img id="preview_image_{$icons_33['id']}"  src="{$icons_33["image_{$currentLanguageIso}"]}?t={rand()}" />
                            </div>
                        {elseif  $index_50 == 2 && $icons_33.id_parent_card == 3}
                            <div class="card-img ">
                            <div class="layerHover">{$icons_33["title_{$currentLanguageIso}"]}</div>
                            <img id="preview_image_{$icons_33['id']}" src="{$icons_33["image_{$currentLanguageIso}"]}?t={rand()}" />
                            </div>
                        {/if}
                        
                    {/foreach}
                    </div>    
                </div>
                {/foreach}
            </div>
            {* <div style="width: 100%;">
                <img id="preview_image_1" src="{$bb}" style="overflow: hidden;border: 1px solid #999;width: 100%;"> 
            </div> *}
            {* <div style="margin-top: 5px;">
                <div style="width: 33.3%;float: left; padding: 5px 5px 5px 0px">
                    <img id="preview_image_13" src="{$array_icons_33[0]['image_en']}" style="overflow: hidden;border: 1px solid #999;width: 100%;height:22vh;object-fit:cover;"> 
                </div>
                <div style="width: 33.3%; float: left; padding: 5px">
                    <img id="preview_image_14" src="{$array_icons_33[1]['image_en']}" style="cursor: pointer;overflow: hidden;border: 1px solid #999;width: 100%;height:22vh;object-fit:cover;"> 
                </div>
                <div style="width: 33.3%; float: left; padding: 5px 0px 5px 5px">
                    <img id="preview_image_15" src="{$array_icons_33[2]['image_en']}" style="cursor: pointer;overflow: hidden;border: 1px solid #999;width: 100%;height:22vh;object-fit:cover;"> 
                </div>
            </div> *}
            {* <div style="margin-top: 5px;">
                <div style="width: 33.3%;float: left; padding: 5px 5px 5px 0px">
                    <img id="preview_image_13" src="{$array_icons_33[3]['image_en']}" style="overflow: hidden;border: 1px solid #999;width: 100%;"> 
                </div>
                <div style="width: 33.3%; float: left; padding: 5px">
                    <img id="preview_image_14" src="{$array_icons_33[4]['image_en']}" style="cursor: pointer;overflow: hidden;border: 1px solid #999;width: 100%;"> 
                </div>
                <div style="width: 33.3%; float: left; padding: 5px 0px 5px 5px">
                    <img id="preview_image_15" src="{$array_icons_33[5]['image_en']}" style="cursor: pointer;overflow: hidden;border: 1px solid #999;width: 100%;"> 
                </div>
            </div>
            <div style="margin-top: 5px;">
                <div style="width: 33.3%;float: left;padding: 5px 5px 5px 0px">
                    <img id="preview_image_16" src="{$array_videos[0]['image_en']}" style="overflow: hidden;border: 1px solid #999;width: 100%;"> 
                </div>
                <div style="width: 33.3%; float: left;padding: 5px;">
                    <img id="preview_image_17" src="{$array_videos[1]['image_en']}" style="cursor: pointer;overflow: hidden;border: 1px solid #999;width: 100%;"> 
                </div>
                <div style="width: 33.3%; float: left;padding: 5px 0px 5px 5px">
                    <img id="preview_image_18" src="{$array_videos[2]['image_en']}" style="cursor: pointer;overflow: hidden;border: 1px solid #999;width: 100%;"> 
                </div>
            </div> *}
            <div style="width: 100%;">
                <img style="width: 100%;" src="/modules/wmmodule_homepage/views/images/body{$currentShop}.png"> 
            </div>

            <div style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;"></div>
            
              <div class="videosContainer" style="  flex-direction: row;">
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
                <img style="width: 100%;" src="/modules/wmmodule_homepage/views/images/footer{$currentShop}.png"> 
            </div>
        </div>
        <div style="text-align: center;padding: 30px;">
            <button type="button" class="btn btn-primary" onclick="saveDesktopLive()" style="width:400px;">SAVE</button>
        </div>
    </div>
</div>

<style>

    .image_container{ margin: 20px 0; border: 1px solid #555; }
    .image_container:hover{ margin: 20px 0; border: 1px solid red; }
    
    #exampleModalLabel{ padding: 0 15px; }
    .modal-footer{ display: none; }

    .videosContainer
{
  display: flex;

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


    .bannersHome {
        display: flex;
        display: flex;
  gap: 5px;
  margin-top: 5px;
    }

    .card-img-container {
        position: relative;
  flex: 1;
    }

    .card-big{
        position: relative;
  margin-bottom: 5px;
    }

    .layerHover {
        display: inline-block;
  position: absolute;
  transition: 0.3s;
  background-color: rgba(255, 255, 255, 0.0);
  color: transparent;
  height: 0em;
  width: 50%;
  bottom: 0;
  left: 25%;
    }

    .card-big img {
        width: 100%;
        object-fit: cover;
        height: 100%;
        min-height: 222px;
        max-height: 222px;
    }

    .card-min-img {
        width: 100%;
  display: flex;
  gap: 5px;
  padding: 5px 0;
  min-height: 77px;
    }

    .card-img {
        flex: 1;
  position: relative;
  overflow: hidden;
    }

    .card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        max-height: 71px;
        min-height: 71px;
    }


    
</style>