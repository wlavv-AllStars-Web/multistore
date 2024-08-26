<label class="control-label">
    {$filter.name|escape:'html':'UTF-8'}
</label>
<select name="id_ukoocompat_criterion_select_groups_[{$filter.id|intval}]" id="id_ukoocompat_criterion_select_groups_{$filter.id|intval}" {if $filter.id > 1}readonly="readonly"{/if} onchange="call_ajax_fill_selects({$filter.id|intval})">
    <option value="0">Todas</option>
    {if $filter.id < 2 || $filter.id > 4}
        {foreach from=$filter.criteria item=criterion}
            <option value="{$criterion.id|intval}">
                {$criterion.value|escape:'html':'UTF-8'}
            </option>
        {/foreach}
    {/if}
</select>