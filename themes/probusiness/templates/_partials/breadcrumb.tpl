<nav data-depth="{$breadcrumb.count|escape:'html':'UTF-8'}" class="breadcrumb hidden-sm-down">
  <ol itemscope itemtype="http://schema.org/BreadcrumbList">
    {foreach from=$breadcrumb.links item=path name=breadcrumb}
      {block name='breadcrumb_item'}
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a itemprop="item" href="{$path.url|escape:'html':'UTF-8'}">
            <span itemprop="name">{$path.title|escape:'html':'UTF-8'}</span>
          </a>
          <meta itemprop="position" content="{$smarty.foreach.breadcrumb.iteration|escape:'html':'UTF-8'}">
        </li>
      {/block}
    {/foreach}
  </ol>
</nav>