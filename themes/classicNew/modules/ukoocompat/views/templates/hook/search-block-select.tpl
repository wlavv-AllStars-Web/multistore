{if Context::getContext()->isMobile() || $page_name!='index'}
    <select id="ukoocompat_select_{$filter->id|intval}" 
        aria-label="ukoocompat_select_{$filter->id|intval}"
    	name="filters{$filter->id|intval}" 
    	data-filter-id="{$filter->id_ukoocompat_filter|intval}" 
    	class="form-control-2{if $search->dynamic_criteria} dynamic_criteria{/if}{if isset($filter->disabled) && $filter->disabled|intval == 1} disabled{/if}" 
    	style="{if {$search->selected_criteria[{$filter->id|intval}]} != ''}background:none;background-color:#FFF;{/if}" 
    	{if $filter->id == 4} onchange="submitUkooForm();"{/if} >
        <option value="">{$filter->name|escape:'htmlall':'UTF-8'}</option>
        {if !isset($filter->disabled) || $filter->disabled|intval != 1}
            {foreach from=$filter->criteria item=criterion}
                    <option
                        value="{$criterion['id']|intval}" style="{if $filter->id == 1}padding: 3px 0;{/if}"
                        {if isset($search->selected_criteria[{$filter->id|intval}]) && $search->selected_criteria[{$filter->id|intval}]|intval == $criterion['id']|intval} selected="selected"{/if}
                    >{$criterion['value']|escape}</option>
            {/foreach}
        {/if}
    </select>
{else} 
    <select id="ukoocompat_select_{$filter->id|intval}" 
    	name="filters{$filter->id|intval}" 
    	data-filter-id="{$filter->id_ukoocompat_filter|intval}" 
    	class="form-control-2{if $search->dynamic_criteria} dynamic_criteria{/if}{if isset($filter->disabled) && $filter->disabled|intval == 1} disabled{/if}" 
    	style="{if {$search->selected_criteria[{$filter->id|intval}]} != ''}background:none;background-color:#eee;{/if}" 
    	{if $filter->id == 1} 
    	    onmouseleave="$(this).attr('size','1').css('height','calc(1*34px)').css('position','absolute').css('width','calc(20% - 10px)').css('z-index','99999');;"
    		onmousedown="$(this).attr('size','22').css('height','calc(22*24px)').css('position','absolute').css('width','20%').css('z-index','99999');"
    	{/if}
    	{if $filter->id == 4} 
    		onchange="submitUkooForm();"
    	{/if} >
    	
        <option value="">{$filter->name|escape:'htmlall':'UTF-8'}</option>
        {if !isset($filter->disabled) || $filter->disabled|intval != 1}
            {foreach from=$filter->criteria item=criterion}
                    <option onmouseover="$(this).css('background','#0078d7').css('color','#fff')" onmouseleave="$(this).css('background','#eee').css('color','#000')"
                        value="{$criterion['id']|intval}" style="{if $filter->id == 1}padding: 3px 0;{/if}"
                        {if isset($search->selected_criteria[{$filter->id|intval}]) && $search->selected_criteria[{$filter->id|intval}]|intval == $criterion['id']|intval} selected="selected"{/if}
                    >{$criterion['value']|escape}</option>
            {/foreach}
        {/if}
    </select>
<{/if}

{if $page_name=='index'}
    <script>function submitUkooForm(){}</script>
{/if}