{if !isset($ajax_reload)}
    <div id="ukoocompat_search_block_{$search->id|intval}" class="block ukoocompat_search_block" style="clear: both;">
        <div class="block_content">
{/if}
        <form id="ukoocompat_search_block_form_{$search->id|intval}" action="{$form_action|escape}" method="POST" class="ukoocompat_search_block_form{if $search->dynamic_criteria} dynamic_criteria{/if}">
            <input type="hidden" name="id_search" value="{$search->id|intval}" />
            <input type="hidden" name="id_search3" value="{$search->id|intval}" />
            <input type="hidden" name="id_lang" value="{$search->current_id_lang|intval}" />

            <input type="hidden" id="multiFilter_news" name="news_compats" value="{(isset($news_compats)) ? $news_compats : 0 }"/>
            <input type="hidden" id="multiFilter_order_by" name="order_by_compats" value="{(isset($order_by_compats)) ? $order_by_compats : 'position' }"/>
            <input type="hidden" id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="{(isset($order_by_orientation_compats)) ? $order_by_orientation_compats : 'desc' }"/>
            <input type="hidden" id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value="{(isset($id_manufacturer_compats)) ? $id_manufacturer_compats : '' }"/>
            <input type="hidden" id="multiFilter_nr_items" name="nr_items_compats" value="{(isset($nr_items_compats)) ? $nr_items_compats : 20 }"/>
            <input type="hidden" id="multiFilter_n_items" name="n" value="{(isset($nr_items_compats)) ? $nr_items_compats : 20 }"/>
            <input type="hidden" id="multiFilter_page_number" name="p" value="{(isset($p)) ? $p : 1 }"/>
            <input type="hidden" id="multiFilter_id_category" name="id_category" value="{if (isset($id_category))}{$id_category}{else}0{/if}"/>
            <input type="hidden" id="multiFilter_root_page" name="root_page" value=""/>
            <input type="hidden" id="ukoo_email" name="ukoo_email" value=""/>

            {foreach from=$search->filters item=filter}
				{if $filter->id < 5}
					<div class="ukoocompat_search_block_filter filter_{$filter->id|intval}{if isset($filter->disabled) && $filter->disabled|intval == 1} disabled{/if}">
					    
						{if isset($filter->display_type) && $filter->display_type != 'select'}
							<span class="ukoocompat_search_block_filter_title">{$filter->name|escape:'htmlall':'UTF-8'}</span>
						{/if}
						<div class="ukoocompat_search_block_filter_filter">
							{if $filter->display_type == 'radio'}
								{include file='./search-block-radio.tpl'}
							{else}
								{include file='./search-block-select.tpl'}
							{/if}
						</div>
					</div>
				{/if}
            {/foreach}
            <div class="ukoocompat_search_block_button">
                <button id="ukoocompat_search_block_submit_{$search->id|intval}" type="submit" name="ukoocompat_search_submit" class="button btn btn-default button-medium">
                    <span>{l s='Search' mod='ukoocompat'}</span>
                </button>
            </div>
            <input type="hidden" id="ukoocompat_page_name" name="page_name" value="{$page_name|escape:'htmlall':'UTF-8'}"/>
            {if !$is_rewrite_active}
                <input type="hidden" name="fc" value="module"/>
                <input type="hidden" name="module" value="ukoocompat"/>
                <input type="hidden" name="controller" value="{$search->controller|escape:'htmlall':'UTF-8'}"/>
            {/if}
        </form>
{if !isset($ajax_reload)}
        </div>
    </div>
    {if isset($search->display_alias_search_block) && $search->display_alias_search_block}
        {include file='./search-block-alias.tpl'}
    {/if}
{/if}