{**
  * Recherche de produits par compatibilité
  *
  * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
  * @copyright Ukoo 2015 - 2016
  * @license   Ukoo - Tous droits réservés
  *
  * "In Ukoo we trust!"
  *}

<div class="alert alert-info">
    <p>{l s='You must generate the sitemap every time you make changes in the filters of the search tab.' mod='ukoocompat'}</p>
    <p>{l s='Regenerate sitemap search by clicking the button below, or schedule a daily CRON job on your server to do it for you.' mod='ukoocompat'}<br />
        {l s='URL to declare to the CRON task:' mod='ukoocompat'} <b>{$cron_url|escape:'quotes':'UTF-8'}</b></p>

    {if isset($sitemap_index) && !empty($sitemap_index)}
        <br />
        <div id="sitemap_url_to_declare">
            <p>{l s='Sitemap files already exists.' mod='ukoocompat'} {l s='See below url(s) to declare to search engines:' mod='ukoocompat'}</p>
            <ul>
                {foreach from=$sitemap_index item=sitemap}
                    <li>{$sitemap|escape:'quotes':'UTF-8'}</li>
                {/foreach}
            </ul>
        </div>
    {/if}
</div>

<button type="button" class="btn btn-default" name="generateSitemapSearch" id="generateSitemapSearch" data-cron-url="{$cron_url|escape:'quotes':'UTF-8'}">
    <span id="sitemap_regeneration"><i class="icon-refresh"></i> {l s='Regenerate sitemap search' mod='ukoocompat'}</span>
    <span id="sitemap_regeneration_in_progress" style="display: none;"><i class="icon-refresh icon-spin icon-fw"></i> {l s='Sitemap regeneration in progress' mod='ukoocompat'}</span>
</button>

<div id="sitemap_regeneration_success" class="alert alert-success" style="display: none; margin-top: 17px;">
    <p>{l s='Sitemap successfully generate.' mod='ukoocompat'} {l s='See below url(s) to declare to search engines:' mod='ukoocompat'}</p>
    <ul>
        {foreach from=$languages item=lang}
            <li>{$base_url|cat:'modules/ukoocompat/sitemap/sitemap_index_'|cat:$currentObject->id|cat:'_'|cat:$lang.iso_code|cat:'.xml'|escape:'quotes':'UTF-8'}</li>
        {/foreach}
    </ul>
</div>

<div id="sitemap_regeneration_error" class="alert alert-danger" style="display: none; margin-top: 17px;">
    <p>{l s='Error during sitemap regeneration. Ajax request returned the following error:' mod='ukoocompat'}<br />
        <b id="sitemap_regeneration_error_content"></b></p>
</div>
