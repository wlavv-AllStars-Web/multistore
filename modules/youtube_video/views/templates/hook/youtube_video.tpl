{if isset($youtube_urls) && is_array($youtube_urls)}
    {foreach from=$youtube_urls key=key item=url}
        {if $url}
            <div id="custom-text{$key}">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{$url}?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        {/if}
    {/foreach}
{else}
    {/if}
