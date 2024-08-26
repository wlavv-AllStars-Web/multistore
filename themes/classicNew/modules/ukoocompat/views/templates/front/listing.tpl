{assign var="apply_filter_en" value="Apply filters"}
{assign var="apply_filter_fr" value="Appliquer des filtres"}
{assign var="apply_filter_es" value="Aplicar filtros"}

{* {Tools::getShopDomain()} *}


{assign var=listing value=[
    'search' => $search,
    'products' => $products,
    'nb_products' => $nb_products,
    'meta_title' => $search->listing_meta_title,
    'meta_description' => $search->listing_meta_description,
    'sort_orders' => $sort_orders,
    'sort_selected' => $sort_selected,
    'pagination' => $pagination
    ]}
    {* 'catalog_link' => $this->context->link->getModuleLink('ukoocompat', 'catalog', $params),
    
    *}



<form id="ukoocompat_search_block_form_1" action="/{$lang_iso}/module/ukoocompat/listing" method="POST"> 

<input type="hidden" id="temp_multiFilter_news" name="temp_news_compats" value="{$news_compats}"/>
<input type="hidden" id="temp_multiFilter_order_by" name="orderby" value="{$order_by_compats}"/>
<input type="hidden" id="temp_multiFilter_order_by_orientation" name="orderway" value="{$order_by_orientation_compats}"/>
<input type="hidden" id="temp_multiFilter_id_manufacturer" name="id_manufacturer_compats" value="{$id_manufacturer_compats}"/>
<input type="hidden" id="temp_multiFilter_nr_items" name="n" value="{$nr_items_compats}"/>
<input type="hidden" id="temp_multiFilter_page_number" name="p" value="{$p}"/>
<input type="hidden" id="temp_multiFilter_id_category" name="id_category" value="{$id_category}"/>
<input type="hidden" id="ukoocompat_select_1" name="filters1" value="{$selected_filter_1}"/>
<input type="hidden" id="ukoocompat_select_2" name="filters2" value="{$selected_filter_2}"/>
<input type="hidden" id="ukoocompat_select_3" name="filters3" value="{$selected_filter_3}"/>
<input type="hidden" id="ukoocompat_select_4" name="filters4" value="{$selected_filter_4}"/>
<input type="hidden" id="ukoocompat_value_1" name="filters1value" value="{$ukoo_name_1}"/>
<input type="hidden" id="ukoocompat_value_2" name="filters1value" value="{$ukoo_name_2}"/>
<input type="hidden" id="ukoocompat_value_3" name="filters1value" value="{$ukoo_name_3}"/>
<input type="hidden" id="ukoocompat_value_4" name="filters1value" value="{$ukoo_name_4}"/>
<input type="hidden" id="sort_selected" name="sort_selected" value="{$sort_selected.label}"/>


<input type="hidden" id="temp_multiFilter_root_page" name="temp_root_file" value="{$root_page}"/>
<input type="hidden" id="id_search" name="id_search" value="1"/>

</form>

{if isset($search->catalog_title) && !empty($search->catalog_title)}
    {assign var=catalog_title value=$search->catalog_title}
{else}
    {if isset($search->tags) && !empty($search->tags)}
        {assign var=catalog_title value={l s='All your products for' d='Modules.Ukoocompat.ListingEuro'}}
        {foreach from=$search->tags item=tag key=k}
            {if $k != '{CATEGORY}'}
                {assign var=catalog_title value=$catalog_title|cat:' '|cat:$tag}
            {/if}
        {/foreach}
    {else}
        {assign var=catalog_title value={l s='All your products' d='Modules.Ukoocompat.ListingEuro'}}
    {/if}
{/if}

{* {include file="$tpl_dir./errors.tpl"} *}

{capture name=path}
    {strip}
        <a href="{$catalog_link|escape:'quotes':'UTF-8'}" title="{$catalog_title|escape:'htmlall':'UTF-8'}">
            {$catalog_title|escape:'htmlall':'UTF-8'}
        </a>
        <span class="navigation-pipe">{$navigationPipe|escape:'quotes':'UTF-8'}</span>
        {if isset($search->listing_title) && !empty($search->listing_title)}
            {$search->listing_title|escape:'htmlall':'UTF-8'}
        {else}
            {assign var=listing_title value={$search->tags['{CATEGORY}']|cat:' '|cat:{l s='for' d='Modules.Ukoocompat.ListingEuro'}}}
            {foreach from=$search->tags item=tag key=k}
                {if $k != '{CATEGORY}'}
                    {assign var=listing_title value=$listing_title|cat:' '|cat:$tag}
                {/if}
            {/foreach}
            {$listing_title|escape:'htmlall':'UTF-8'}
        {/if}
    {/strip}
{/capture}

{if isset($search->alias) && !empty($search->alias)}
    <div id="ukoocompat_search_alias">
        <div class="block_content">
            {if file_exists($base_dir_ssl|cat:'../../modules/ukoocompat/views/img/'|cat:$search->alias->image)}
                <p>
                    <img src="{$base_dir_ssl|cat:'modules/ukoocompat/views/img/'|cat:$search->alias->image|escape:'quotes':'UTF-8'}" width="120" height="120" alt="{$search->alias->alias|escape:'htmlall':'UTF-8'}"/>
                </p>
            {/if}
            <div>
                <h1 class="title">{$search->alias->alias|escape:'htmlall':'UTF-8'}</h1>
                {if isset($search->alias->description) && !empty($search->alias->description)}
                    <div>{$search->alias->description}</div>
                {/if}
                {if isset($search->alias->link) && !empty($search->alias->link)}
                    <a href="{$search->alias->link|escape:'url':'UTF-8'}" class="btn btn-default">
                        <i class="icon-eye"></i> {l s='See more' d='Modules.Ukoocompat.ListingEuro'}
                    </a>
                {/if}
                {if file_exists('modules/ukoocompat/pdf/notice_'|cat:$search->alias->id|cat:'.pdf')}
                    <a href="{$base_dir_ssl|cat:'modules/ukoocompat/pdf/notice_'|cat:$search->alias->id|cat:'.pdf'|escape:'url':'UTF-8'}" target="_blank" class="btn btn-default">
                        <i class="icon-download"></i> {l s='Download documentation' d='Modules.Ukoocompat.ListingEuro'}
                    </a>
                {/if}
                
                {*
                <button type="button" class="btn exclusive" id="change_search_button">
                    <i class="icon-exchange"></i> {l s='Change your search' d='Modules.Ukoocompat.ListingEuro'}
                </button>
                *}
            </div>
        </div>
    </div>

    <p class="page-heading product-listing">
        <span class="cat-name">
            {if isset($search->listing_title) && !empty($search->listing_title)}
                {$search->listing_title|escape:'htmlall':'UTF-8'}
            {else}
                {$listing_title|escape:'htmlall':'UTF-8'}
            {/if}
        </span>
    </p>
{/if}


{* {if isset($products)}
    {foreach $products as $product}
        <pre>{print_r($product,1)}</pre>
    {/foreach}
{else}
    {l s='No products available yet' d='ListingEuro.Theme.Catalog'}
{/if} *}


{if isset($products) && !empty($products)}
	{if !Context::getContext()->isMobile()}
	
        <div class="content_sortPagiBar">
            {* {include file="$tpl_dir./wm_top_filter.tpl"} *}
        </div>

        {if $products}
            {* {include file="/themes/classic/templates/catalog/listing/product-list.tpl" products=$products} *}
            
            {* <pre>{print_r($pagination,1)}</pre> *}
            
            {include file="themes/classicNew/templates/catalog/listing/product-list.tpl" listing=$listing}


        {else}
            <p class="alert alert-warning text-center">{l s='No new products.'}</p>
        {/if}

        {if $products}
            <div class="content_sortPagiBar">
                {* <div class="bottom-pagination-content clearfix"> {include file="$tpl_dir./pagination.tpl" paginationId='top'} </div> *}
                {* <div class="bottom-pagination-content clearfix"> {include file="file:themes/classic/templates/_partials/pagination.tpl" paginationId='top'} </div> *}

            </div>
        {/if}
        
	{else}
	
        {* <div class="text-center" style="background-color: #333; color: white; text-transform: uppercase;padding: 10px;" onclick="$('#filters_holder').toggle('slow')"> *}
            {* <span><i class="fas fa-filter"></i></span> *}
            {* <span>{${"apply_filter_$lang_iso"}}</span> *}
        {* </div> *}
        <div class="content_sortPagiBar" id="filters_holder" style="display: none;">
            {* <span> {include file="themes/theme1164/mobile/wm_top_filter.tpl"} </span> *}
        </div>

		{include file="themes/classicNew/templates/catalog/listing/product-list.tpl" listing=$listing}
		<div class="content_sortPagiBar">
			<div class="bottom-pagination-content clearfix">
				{* {include file="$tpl_dir./mobile/pagination.tpl" paginationId='bottom'} *}
			</div>
		</div>
	{/if}
{else}
    {if !Context::getContext()->isMobile()}
        <div class="content_sortPagiBar">
            {include file="$tpl_dir./wm_top_filter.tpl"}
            {if $products}<div class="top-pagination-content clearfix"> {include file="file:themes/classicNew/templates/_partials/pagination.tpl"} </div>{/if}
        </div>
    {else}
        <div class="text-center" style="background-color: #333; color: white; text-transform: uppercase;padding: 10px;" onclick="$('#filters_holder').toggle('slow')">
            <span><i class="fas fa-filter"></i></span>
            <span>{${"apply_filter_$lang_iso"}}</span>
        </div>
        <div class="content_sortPagiBar" id="filters_holder" style="display: none;">
            <span> {include file="themes/theme1164/mobile/wm_top_filter.tpl"} </span>
        </div>
    {/if}
    <div class="spacer-15"></div>
    <p class="alert alert-warning text-center">{l s='No result for your search.' d='Modules.Ukoocompat.ListingEuro'}</p>
{/if}


<style>
    div#center_column{ padding: 5px 0; }
</style>

