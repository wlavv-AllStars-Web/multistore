{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{extends file='catalog/listing/product-list.tpl'}

{block name='product_list_header'}
    
    {* {if isset($tc_config.YBC_TC_LISTING_NAME_CAT) && $tc_config.YBC_TC_LISTING_NAME_CAT == 1}
        <h1 class="h1 title_category">{$category.name}</h1>
    {/if}
    {if isset($tc_config.YBC_TC_LISTING_IMAGE_BLOCK) && $tc_config.YBC_TC_LISTING_IMAGE_BLOCK == 1 || isset($tc_config.YBC_TC_LISTING_DESCRIPTION) && $tc_config.YBC_TC_LISTING_DESCRIPTION == 1}    
        <div class="block-category card card-block">
            {if $tc_config.YBC_TC_LISTING_IMAGE_BLOCK == 1}
                <div class="category-cover">
                  <img src="{$category.image.large.url}" alt="{$category.image.legend}">
                </div>
            {/if}
           {if $tc_config.YBC_TC_LISTING_DESCRIPTION == 1} 
          {if $category.description}
            <div id="category-description" class="text-muted">{$category.description nofilter}</div>
          {/if}
          {/if}
        </div>
    {/if} *}
{/block}
