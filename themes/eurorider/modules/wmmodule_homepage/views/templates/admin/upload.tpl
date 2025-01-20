<pre>{print_r($bd_data, 1)}</pre>
<div style="display: flow-root;padding: 5px;">
    <div class="banners_container" id="banner">
        <img src="{$bd_data['image']}{if strlen($bd_data['image']) > 0}?t={rand()}{/if}" style="width: 100%;border: 1px solid #000;min-height: {$height}px;" onclick="$('#click_{$index}').click();">
        <div style="background-color: #fff;padding:5px;margin-bottom: 10px;border: 1px solid #333;margin-top: 5px;display: none;">
            <input type="file" class="required form-control" name="fileUpload_{$bd_data['id']}" id="click_{$index}">
        </div>
    </div>
</div>