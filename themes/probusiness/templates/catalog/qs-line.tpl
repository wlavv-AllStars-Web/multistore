
{* <pre>{$product|print_r}</pre> *}
<div class="quick-products" 
    data-id-product="{$product.id_product}" 
    data-id-product-attribute="{$product.id_attribute_child}">
    <div class="quick-product-details">
        <div class="quick-product-img">
            <img src="{$product.product_img}" style="width: 100%;" />
        </div>
        <div class="quick-product-description">
            <p>{$product.name} - <span>{$product.reference}</span></p>
        </div>
    </div>
    <div class="quick-product-options">
    {* para cada atributo *}
    {* <pre>{$product.groups|print_r}</pre> *}
    {if $product.groups}
      {* {foreach from=$product.groups item=group}
        <div class="quick-product-option">
            <span class="QS-span-data" name="group[{$group.id_attribute_group}]" value="{$group.id_attribute}">{$group.public_name} :</span>
            <span>{$group.name}</span>
            <select class="select-attr" data-group-id="{$group.group_id}" name="group[{$group.group_id}]">
                {foreach from=$group.options item=option}
                    <option value="{$option.id_attribute}" title="{$option.attribute_name}">
                        {$option.attribute_name}
                    </option>
                {/foreach}
            </select>
        </div>
      {/foreach}  *}
        <div class="product-variants js-product-variants">
        {foreach from=$product.groups key=id_attribute_group item=group}
          {* <pre>{$group|print_r}</pre> *}
            {if !empty($group)}
            <div class="quick-product-option">
              <span>{$group.group_name}:
                  {* {foreach from=$group.attributes key=id_attribute item=group_attribute}
                    {if $group_attribute.selected}{$group_attribute.name}{/if}
                  {/foreach} *}
              </span>
              {if $group.group_type == 'select'}
                <select
                  class="select-attr"
                  id="group_{$id_attribute_group}"
                  aria-label="{$group.name}"
                  data-product-attribute="{$id_attribute_group}"
                  name="group[{$id_attribute_group}]"
                  onchange="handleSelectChange(this)">
                    <option value="0" data-label-group="{$group.name}" selected>{l s="Please Select" d="Shop.Theme.Quickshop"}</option>
                  {foreach from=$group.attributes key=id_attribute item=group_attribute}
                    <option value="{$id_attribute}" title="{$group_attribute.name}" data-label-group="{$group.name}">{$group_attribute.name}</option>
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
            <p class="no-options">{l s="No options" d="Shop.Theme.Quickshop"}</p>
        </div>
    {/if}
    {* fim de atributo *}
    </div>
    <div class="quick-product-qty">
        <div class="quick-product-qty-container">
            <span>{l s="Qty" d="Shop.Theme.Quickshop"}</span>
            <input type="number" name="qty-product" min="1" value="1">
            <button class="removeLineQS" onclick="deleteLineQS(this)">{l s="Remove" d="Shop.Theme.Quickshop"}</button>
        </div>
    </div>
</div>

{* fim para cada produto *}
