{*
 * Classic theme doesn't use this subtemplate, feel free to do whatever you need here.
 * This template is generated at each ajax calls.
 * See ProductListingFrontController::getAjaxProductSearchVariables()
 *}
<div id="js-product-list-bottom"></div>

{if $listing.products|count > 0}
    {if $pagination}
      {block name='pagination'}
        {include file='themes/ebusiness/templates/_partials/pagination.tpl' pagination=$pagination}
      {/block}
    {else}
      {block name='pagination'}
        {include file='themes/ebusiness/templates/_partials/pagination.tpl' pagination=$listing.pagination}
      {/block}
    {/if}
  {/if}
