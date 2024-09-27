
{if $groups}
    <div class="product-variants js-product-variants">
    {foreach from=$groups key=id_attribute_group item=group}
        {if !empty($group.attributes)}
        <div class="quick-product-option">
            <span>{$group.name}
                {foreach from=$group.attributes key=id_attribute item=group_attribute}
                {if $group_attribute.selected}{$group_attribute.name}{/if}
                {/foreach}
            </span>
            {if $group.group_type == 'select'}
            <select
                class="select-attr"
                id="group_{$id_attribute_group}"
                aria-label="{$group.name}"
                data-product-attribute="{$id_attribute_group}"
                name="group[{$id_attribute_group}]"
                onchange="handleSelectChange(this)">
                {foreach from=$group.attributes key=id_attribute item=group_attribute}
                <option value="{$id_attribute}" title="{$group_attribute.name}"{if $group_attribute.selected} selected="selected"{/if}>{$group_attribute.name}</option>
                {/foreach}
            </select>
            {elseif $group.group_type == 'color'}
            <ul id="group_{$id_attribute_group}">
                {foreach from=$group.attributes key=id_attribute item=group_attribute}
                <li class="float-xs-left input-container">
                    <label aria-label="{$group_attribute.name}">
                    <input class="input-color" type="radio" data-product-attribute="{$id_attribute_group}" name="group[{$id_attribute_group}]" value="{$id_attribute}" title="{$group_attribute.name}"{if $group_attribute.selected} checked="checked"{/if}>
                    <span
                        {if $group_attribute.texture}
                        class="color texture" style="background-image: url({$group_attribute.texture})"
                        {elseif $group_attribute.html_color_code}
                        class="color" style="background-color: {$group_attribute.html_color_code}"
                        {/if}
                    ><span class="attribute-name sr-only">{$group_attribute.name}</span></span>
                    </label>
                </li>
                {/foreach}
            </ul>
            {elseif $group.group_type == 'radio'}
            <ul id="group_{$id_attribute_group}">
                {foreach from=$group.attributes key=id_attribute item=group_attribute}
                <li class="input-container float-xs-left">
                    <label>
                    <input class="input-radio" type="radio" data-product-attribute="{$id_attribute_group}" name="group[{$id_attribute_group}]" value="{$id_attribute}" title="{$group_attribute.name}"{if $group_attribute.selected} checked="checked"{/if}>
                    <span class="radio-label">{$group_attribute.name}</span>
                    </label>
                </li>
                {/foreach}
            </ul>
            {/if}
        </div>
        {/if}
        {/foreach}    
    </div>
    {* {foreach from=$product.groups item=group}
        <div class="quick-product-option">
            <span>{$group.group_name}</span>
            <select class="select-attr" data-group-id="{$group.group_id}" name="group[{$group.group_id}]">
                {foreach from=$group.options item=option}
                    <option value="{$option.id_attribute}" title="{$option.attribute_name}">
                        {$option.attribute_name}
                    </option>
                {/foreach}
            </select>
        </div>
    {/foreach}        *}
{else}
    <div class="no-options-container">
        <p class="no-options">No options</p>
    </div>
{/if}
