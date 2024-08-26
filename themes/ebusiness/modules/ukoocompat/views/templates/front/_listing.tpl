{**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 *}

{if isset($search->catalog_title) && !empty($search->catalog_title)}
    {assign var=catalog_title value=$search->catalog_title}
{else}
    {if isset($search->tags) && !empty($search->tags)}
        {assign var=catalog_title value={l s='All your products for' mod='ukoocompat'}}
        {foreach from=$search->tags item=tag key=k}
            {if $k != '{CATEGORY}'}
                {assign var=catalog_title value=$catalog_title|cat:' '|cat:$tag}
            {/if}
        {/foreach}
    {else}
        {assign var=catalog_title value={l s='All your products' mod='ukoocompat'}}
    {/if}
{/if}

{include file="$tpl_dir./errors.tpl"}

{capture name=path}
    {strip}
        <a href="{$catalog_link|escape:'quotes':'UTF-8'}" title="{$catalog_title|escape:'htmlall':'UTF-8'}">
            {$catalog_title|escape:'htmlall':'UTF-8'}
        </a>
        <span class="navigation-pipe">{$navigationPipe|escape:'quotes':'UTF-8'}</span>
        {if isset($search->listing_title) && !empty($search->listing_title)}
            {$search->listing_title|escape:'htmlall':'UTF-8'}
        {else}
            {assign var=listing_title value={$search->tags['{CATEGORY}']|cat:' '|cat:{l s='for' mod='ukoocompat'}}}
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
                        <i class="icon-eye"></i> {l s='See more' mod='ukoocompat'}
                    </a>
                {/if}
                {if file_exists('modules/ukoocompat/pdf/notice_'|cat:$search->alias->id|cat:'.pdf')}
                    <a href="{$base_dir_ssl|cat:'modules/ukoocompat/pdf/notice_'|cat:$search->alias->id|cat:'.pdf'|escape:'url':'UTF-8'}" target="_blank" class="btn btn-default">
                        <i class="icon-download"></i> {l s='Download documentation' mod='ukoocompat'}
                    </a>
                {/if}

                <button type="button" class="btn exclusive" id="change_search_button">
                    <i class="icon-exchange"></i> {l s='Change your search' mod='ukoocompat'}
                </button>
            </div>
        </div>
    </div>

    <div id="toggle_search_block" class="row">
        {hook h="displayUkooCompatBlock" display="listing"}
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
{else}
    <div id="ukoocompat_search">
		<div id="toggle_search_block" class="row">
			{hook h="displayUkooCompatBlock" display="listing"}
		</div>
    </div>
{/if}

{if isset($products) && !empty($products)}
	{if !Context::getContext()->isMobile()}
    <div class="content_sortPagiBar clearfix">
        <div class="sortPagiBar clearfix" style="padding-bottom: 10px;">
			{*{include file="$tpl_dir./product-sort.tpl"}
			{include file="$tpl_dir./nbr-product-page.tpl"}*}
			<!--WEBMASTER BAR-->
			<a onClick="history.go(-1);" class="btn button" onClick="history.go(-1);">{l s='Previous Page' mod='ukoocompat'}</a>
			 <!--WEBMASTER BAR-->
		</div>
		<div class="top-pagination-content clearfix">
			{include file="$tpl_dir./product-compare.tpl"}
			{include file="$tpl_dir./pagination.tpl"}
		</div>
	</div>

	{include file="$tpl_dir./product-list.tpl" products=$products}
	<div class="content_sortPagiBar">
		<div class="bottom-pagination-content clearfix">
			{include file="$tpl_dir./product-compare.tpl" paginationId='bottom'}
			{include file="$tpl_dir./pagination.tpl" paginationId='bottom'}
		</div>
	</div>
	{else}
		{include file="$tpl_dir./mobile/product-list.tpl" products=$products}
		<div class="content_sortPagiBar">
			<div class="bottom-pagination-content clearfix">
				{include file="$tpl_dir./mobile/pagination.tpl" paginationId='bottom'}
			</div>
		</div>
	{/if}
{else}
    <p class="alert alert-warning">{l s='No result for your search.' mod='ukoocompat'}</p>
{/if}

{literal}
<script type="text/javascript">
    $(document).ready(function(){
        // Empêche le module blocklayered de prendre le dessus (les résultats ne sont pas cohérents)
        $('#selectProductSort').unbind('change');
    })
</script>
{/literal}