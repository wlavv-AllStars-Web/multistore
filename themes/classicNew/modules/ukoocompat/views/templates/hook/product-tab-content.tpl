{**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2015 - 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 *}

{* <h3 id="ukoocompat_tabcontent_title" class="idTabHrefShort page-product-heading">{l s='Compatibilities' d='Modules.Ukoocompat.ProductTab'}</h3> *}
<div id="ukoocompat_tabcontent">
    {foreach from=$compatTab item=tab}
    <table class="table table-bordered">
        <thead>
            <tr>
                {foreach from=$tab.search->filters item=filter}
                    {if $filter->id != 10}<th class="even" >{$filter->name|escape:'htmlall':'UTF-8'}</th> {/if}
                {/foreach}
            </tr>
        </thead>
        <tbody>
            {foreach from=$tab.compatibilities item=compat name=compatRow}
                <tr{if $smarty.foreach.compatRow.index >= 5} style="display:none;" class="compatNotDisplay" {/if}>
                    {foreach from=$tab.search->filters item=filter}
					 {if $filter->id != 10}
                        <td>
                            {if $compat['filter_'|cat:$filter->id_ukoocompat_filter] == '*'}
                                {l s='All' d='Modules.Ukoocompat.ProductTab'} {$filter->name|escape:'htmlall':'UTF-8'|lower}
                            {else}
                                {$compat['filter_'|cat:$filter->id_ukoocompat_filter]|escape:'htmlall':'UTF-8'}
                            {/if}
                        </td>
					 {/if}	
                    {/foreach}
                </tr>
            {/foreach}
			<tr {if count($tab.compatibilities) < 5} style="display:none" {/if}>
			<td>
			<a id="showMoreCompat"{if count($tab.compatibilities) < 5} style="display:none" {/if} style="color:red;font-size:12px;" href="javascript:void();" onclick="$('.compatNotDisplay:hidden, #reduceCompat').show(); $(this).hide();">...{l s='See more compatibilities' d='Modules.Ukoocompat.ProductTab'}</a>
			<a id="reduceCompat" style="display:none; color:red;font-size:12px;"  href="javascript:void();" onclick="$('.compatNotDisplay:visible').hide(); $('#showMoreCompat').show(); $(this).hide();">{l s='Reduce' d='Modules.Ukoocompat.ProductTab'}...</a>
			</td>
			</tr>
        </tbody>
    </table>
    {/foreach}
</div>