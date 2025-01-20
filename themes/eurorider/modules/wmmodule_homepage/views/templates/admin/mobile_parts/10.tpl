<div style="display: flow-root;margin-top: 10px;">
    <div style="border: 1px solid #999;background-color: #999;color: #fff;padding: 5px;{if $mobile_icon_10['active'] == 0} color: red; {else} color: green;{/if}" onclick="$('#container_block_mobile_10').toggle()">Position 10</div>
    <div style="display: none;" id="container_block_mobile_10">
            <div style="border: 1px solid #666;display: contents; width: 100%;">
        		<form action="/admin77500/index.php?controller=AdminWmModuleHomepage&action=update&zone=banner&token={Tools::getValue('token')}" enctype="multipart/form-data" method="POST">
             	    <input type="hidden" name="position" value="10">
             	    <input type="hidden" name="type" value="mobile">
             	    <input type="hidden" name="icon_type" value="10">
             	    <input type="hidden" name="id" value="{$mobile_icon_10['id']}">
                    <div>
                        <div style="width: 27%; float: left;padding: 5px 5px 5px 0;">
                            <div style="color: white; text-transform: uppercase; background-color: #888;padding: 5px;display: flex;">
                                <div   style="width: 80px; float: left;padding: 5px 0;">Inglês</div>
                                <input style="width: calc(100% - 80px); float: left;" name="title_en" type="text" value="{$mobile_icon_10['title_en']}" placeholder="Titulo em inglês" id="title_en_{$mobile_icon_10['id']}">
                            </div>
                            <img src="{$mobile_icon_10['image_en']}{if strlen($mobile_icon_10['image_en']) > 0}?t={rand()}{/if}" style="width: 100%;border: 1px solid #000;height: 239px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;background-size: contain;" onclick="$('#click_{$mobile_icon_10['id']}_en').click();">
                            <div style="background-color: #fff;padding:5px;margin-bottom: 10px;border: 1px solid #333;margin-top: 5px;display: none;">
                                <input type="file" class="required form-control" name="fileUpload_en" id="click_{$mobile_icon_10['id']}_en">
                            </div>
                        </div>
                        <div style="width: 27%; float: left;padding: 5px;">
                            <div style="color: white; text-transform: uppercase; background-color: #888;padding: 5px;display: flex;">
                                <div   style="width: 80px; float: left;padding: 5px 0;">Espanhol</div>
                                <input style="width: calc(100% - 80px); float: left;" name="title_es" type="text" value="{$mobile_icon_10['title_es']}" placeholder="Titulo em espanhol" id="title_es_{$mobile_icon_10['id']}">
                            </div>
                            <img src="{$mobile_icon_10['image_es']}{if strlen($mobile_icon_10['image_es']) > 0}?t={rand()}{/if}" style="width: 100%;border: 1px solid #000;height: 239px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;background-size: contain;" onclick="$('#click_{$mobile_icon_10['id']}_es').click();">
                            <div style="background-color: #fff;padding:5px;margin-bottom: 10px;border: 1px solid #333;margin-top: 5px;display: none;">
                                <input type="file" class="required form-control" name="fileUpload_es" id="click_{$mobile_icon_10['id']}_es">
                            </div>
                        </div>
                        <div style="width: 27%; float: left;padding: 5px;">
                            <div style="color: white; text-transform: uppercase; background-color: #888;padding: 5px;display: flex;">
                                <div   style="width: 80px; float: left;padding: 5px 0;">Françês</div>
                                <input style="width: calc(100% - 80px); float: left;" name="title_fr" type="text" value="{$mobile_icon_10['title_fr']}" placeholder="Titulo em françês" id="title_fr_{$mobile_icon_10['id']}">
                            </div>
                            <img src="{$mobile_icon_10['image_fr']}{if strlen($mobile_icon_10['image_fr']) > 0}?t={rand()}{/if}" style="width: 100%;border: 1px solid #000;height: 239px;background-image: url('/modules/wmmodule_homepage/views/images/upload.webp');background-position: center;background-repeat: no-repeat;background-size: contain;" onclick="$('#click_{$mobile_icon_10['id']}_fr').click();">
                            <div style="background-color: #fff;padding:5px;margin-bottom: 10px;border: 1px solid #333;margin-top: 5px;display: none;">
                                <input type="file" class="required form-control" name="fileUpload_fr" id="click_{$mobile_icon_10['id']}_fr">
                            </div>
                        </div>
                        <div style="width: 19%; float: left;padding: 5px;">
                            <div style="margin-top: 10px;">
                                <input type="checkbox" value="1" name="active" {if $mobile_icon_10['active'] == 1} checked="checked" {else} {/if}> 
                                <span style="margin-left: 5px;;"> Ativo</span>
                            </div>

                            <div style="padding: 5px;margin-top: 10px;">
                                <div>
                                    <label>Select brand</label> 
                                    <select id="select_brand_{$mobile_icon_10['id']}" name="link" onclick="setImageText(this, {$mobile_icon_10['id']}, 'select_car_{$mobile_icon_10['id']}')">
                                        <option value="">---</option>
                                        <option value="523-clearence" {if "523-clearence" == $mobile_icon_10['link']} selected {/if}>Clearence</option>
                                        {foreach $manufacturers AS $manufacturer}
                                            <option value="{$manufacturer['link_data']}" {if $manufacturer['link_data'] == $mobile_icon_10['link']} selected {/if}>{$manufacturer['name']}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <div>
                                    <div style="color: black; font-weight: bolder; font-size: 30px; text-transform: uppercase; text-align: center; padding: 15px;" > OR </div>
                                </div>
                                <div>
                                    {assign var="compat" value="`$mobile_icon_10['brand']`_`$mobile_icon_10['model']`_`$mobile_icon_10['type']`_`$mobile_icon_10['version']`"}
                                    <label>Select car</label> 
                                    <select id="select_car_{$mobile_icon_10['id']}" name="car" onclick="setImageText(this, {$mobile_icon_10['id']}, 'select_brand_{$mobile_icon_10['id']}');">
                                        <option value="">---</option>
                                        {foreach $cars AS $car}
                                            <option value="{implode('_', array_keys($car['filters']))}" {if (implode('_', array_keys($car['filters'])) == $compat)} selected {/if}>{implode(' | ', array_values($car['filters']))}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div style="width: 100%;">
                                <button class="btn btn-primary" type="submit" style="width: 100%; margin-top: 20px;">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>