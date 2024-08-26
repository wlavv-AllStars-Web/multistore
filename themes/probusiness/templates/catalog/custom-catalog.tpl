{extends file=$layout}
{* <pre>{$manufacturers|print_r}</pre> *}

{block name='content'}
	<section id="main" style="display: flex;flex-direction:column;">
<div class="text-center" style="max-width: 1350px;margin:auto;">
	<img src="/img/asd/Content_pages/catalog/ressources_{$language.iso_code}.webp" alt="All Stars Distribution" class="img-fluid cms_header_image" />
</div>

<div class="spacer-20"></div>
<table id="cms_catalog_main_table" style="max-width: 1350px;margin:auto;">
	<tbody>
		<tr class="cms_catalog_table_header">
			<td class="header_label"><p>{l s='Brand'  d="Shop.Theme.catalog" }</p></td>
			<td class="header_label"><p>{l s='Import File' d="Shop.Theme.catalog" }</p></td>
			<td class="header_label"><p>{l s='Catalogue' d="Shop.Theme.catalog" } </p></td>
			<td class="header_label"><p>{l s='Pictures' d="Shop.Theme.catalog" }</p></td>
			<td class="header_label"><p>{l s='Logos' d="Shop.Theme.catalog" }  </p></td>
			<td class="header_label"><p>{l s='Facebook' d="Shop.Theme.catalog" }</p></td>
			<td class="header_label"><p>{l s='Website' d="Shop.Theme.catalog" }</p></td>
			<td class="header_label"><p>{l s='Updates' d="Shop.Theme.catalog" }</p></td>
		</tr>
		
    	{foreach from=$manufacturers item=manufacturer name=manufacturers}
        	<tr class="cms_catalog_tr_separator">

    			<td class="cms_catalog_table_brand_td">
    				<img src="{$base_dir}/img/m/{$manufacturer.id_manufacturer}-medium_default.jpg" width="125" height="125" class="cms_catalog_table_brand_td_image" alt="brand_logo"/>
    			</td>

    			<td class="cms_catalog_right_line">
    				<a href="https://webtools.euromuscleparts.com/uploads/manufacturer/ASD/{$manufacturer.name|replace:' ':''}/{$manufacturer.name|replace:' ':''}.csv" download="{$manufacturer.name|replace:' ':''}.csv">
    					<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/csv{if $manufacturer.csv == 1}_updated{elseif $manufacturer.csv == 2}_none{elseif $manufacturer.csv == 3}_commingSoon{/if}.png" alt="csv_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    				</a>
    			</td>

    			<td class="cms_catalog_right_line">
    			    {if ($manufacturer.id_manufacturer == 11) || ($manufacturer.id_manufacturer == 20) }
        				<a href="https://webtools.euromuscleparts.com/uploads/manufacturer/ASD/{$manufacturer.name|replace:' ':''}/{$manufacturer.name|replace:' ':''}.pdf" download="{$manufacturer.name|replace:' ':''}.pdf">
    			    {else}
        				<a href="https://webtools.euromuscleparts.com/uploads/manufacturer/ASD/{$manufacturer.name|replace:' ':''}/{$manufacturer.name|replace:' ':''}.xlsx" download="{$manufacturer.name|replace:' ':''}.xlsx">
    			    {/if}
    			    	<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/xlsx{if $manufacturer.xlsx == 1}_updated{elseif $manufacturer.xlsx == 2}_none{elseif $manufacturer.xlsx == 3}_commingSoon{/if}.png" alt="xlsx_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    				</a>
    			</td>

    			<td class="cms_catalog_right_line">
    				<a href="https://webtools.euromuscleparts.com/uploads/manufacturer/ASD/{$manufacturer.name|replace:' ':''}/{$manufacturer.name|replace:' ':''}_images.zip" download="{$manufacturer.name|replace:' ':''}_IMAGES.zip">
    					<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/zip{if $manufacturer.pictures == 1}_updated{elseif $manufacturer.pictures == 2}_none{elseif $manufacturer.pictures == 3}_commingSoon{/if}.png" alt="pictures_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    				</a>
    			</td>

    			<td class="cms_catalog_right_line">
    				<a href="https://webtools.euromuscleparts.com/uploads/manufacturer/ASD/{$manufacturer.name|replace:' ':''}/{$manufacturer.name|replace:' ':''}_logos.zip" download="{$manufacturer.name|replace:' ':''}_LOGOS.zip">
    					<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/jpg{if $manufacturer.logos == 1}_updated{elseif $manufacturer.logos == 2}_none{/if}.png" alt="logos_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    				</a>
    			</td>

    			<td class="cms_catalog_right_line">
    				<a href="{$manufacturer.facebook_url}" target="_blank">
    					<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/facebook{if $manufacturer.facebook == 1}_updated{elseif $manufacturer.facebook == 2 }_none{/if}.png" alt="facebook_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    				</a>
    			</td>

    			<td class="cms_catalog_right_line">
    				<a href="{$manufacturer.site_url}" target="_blank">
    					<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/website{if $manufacturer.site ==1}_updated{elseif $manufacturer.site == 2 }_none{/if}.png" alt="site_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    				</a>
    			</td>

    			<td class="cms_catalog_table_updated_td">
    				<table class="width_100">
    					<tbody>
    						<tr>
    							<td class="no_padding_text_center">
    								<img class="cms_catalog_image" src="/img/asd/Content_pages/catalog/icons/stopwatch{if $manufacturer.info == 1}_updated{/if}.png" alt="info_{$manufacturer.name|replace:' ':''}" width="80" height="80"/>
    							</td>
    						</tr>
    						<tr>
    							<td class="no_padding_text_center">
    								<div class="cms_catalog{if $manufacturer.info == 1}_updated{/if}_messages width_100">{l s='Updated' d="Shop.Theme.catalog"} <br>{$manufacturer.info_updated}</div>
    							</td>
    						</tr>
    					</tbody>
    				</table>
    			</td>

    		</tr>
		{/foreach}
	</tbody>
</table>
	</section>
	<style>
    .width_100{ width: 100%; }
    .cms_catalog_table_header{ text-align: center; background-color: #0273EB; color: white; text-transform: uppercase; padding: 10px; font-weight: 700; font-size: 14px;line-height: 18px;}
    .cms_catalog_tr_separator{ border-top: 1px solid #ddd;}
    .cms_catalog_row{ border: 1px solid #ddd; }
    .cms_catalog_right_line{ border-right: 1px solid #ddd; text-align: center; padding: 0; height: 150px; }
    .cms_catalog_image{ height:80px; margin: 0px 10px 0px 20px; }
    .cms_catalog_updated_image{ height:80px; margin: 0px 10px 0px 20px; }
    .cms_catalog_messages{ font-size: 18px; color: #000; line-height: 1.5; float: left; padding: 0 5px; }
    .cms_catalog_updated_messages{ font-size: 18px; color: #0273eb; line-height: 1.5; float: left; padding: 0 5px; }
	.header_label{ padding: 9px 10px;}
	.header_label p{ margin: 0;}
    
    #cms_catalog_main_table{ max-width: 1350px; margin: 20px auto 2rem auto; margin-bottom: 40px;border: 1px solid #ddd; width: 100%; }
    .cms_catalog_table_brand_td{ border-right: 1px solid #ddd; width: 150px !important; padding: 0; text-align: center; }
    .cms_catalog_table_downloads_td{ width: 1070px; padding: 0 }
    .cms_catalog_table_brand_td_image{ width: 125px; max-width: 125px !important;height: auto; margin: 10px; }
    .cms_catalog_table_updated_td{ width: 140px; padding: 0; text-align: center;}
    .no_padding_text_center{ padding: 0; text-align: center; }
    #cms #center_column img.cms_catalog_image{ height:80px; }
    #cms #center_column img.cms_catalog_updated_image{ height:60px; }
    
</style>
{/block}

