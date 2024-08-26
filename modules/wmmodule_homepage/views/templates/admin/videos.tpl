<div style="display: none;" id="videos_container" class="elements_container">
    {foreach $array_videos AS $index => $video}
        <div style="border: 1px solid #666;width: 33.33%;float: left;padding: 5px;">
     	    <input type="hidden" name="video_position[{$video['id']}]" value="{$index+1}">
     	    <input type="hidden" name="video_type[{$video['id']}]" value="desktop">
     	    <input type="hidden" name="video_icon_type[{$video['id']}]" value="3">
            <input type="hidden" value="1" name="active[{$video['id']}]"> 
            <img id="image_{$video['id']}" src="{$video['image_en']}{if strlen($video['image_en']) > 0}?t={rand()}{/if}" style="background-color: #fff;margin-bottom: 10px;width: 100%;border: 1px solid #000;min-height: 258px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;background-size: contain;" onclick="setModal({$video['id']},4,$('#image_{$video['id']}'))">
            <input style="text-align: center;" name="title_en[{$video['id']}]" type="text" value="{$video['youtube_code']}" placeholder="Youtube code" id="title_en_{$video['id']}" onblur="saveVideoCode(this, {$index})">
        </div>
    {/foreach}
</div>