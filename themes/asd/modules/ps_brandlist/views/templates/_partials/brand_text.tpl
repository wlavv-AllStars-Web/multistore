{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

<ul>
  {* {$brands} *}
  {foreach from=$brands item=brand name=brand_list}
    {if $smarty.foreach.brand_list.iteration <= $text_list_nb}
      <li class="facet-label">
        <a href="{$brand['link']}" title="{$brand['name']}">
          {$brand['name']}
        </a>
      </li>
    {/if}
  {/foreach}
</ul>
{* {hook h='displayCompact'}
<img onclick="$('#ukoocompat_search_block_custom_form').submit();" style="cursor: pointer;overflow: hidden;border: 1px solid #999;" class="lazy" alt="Nissan | GTR | R35 - 08-... | 3.8- 485/530/550/570/600" src="/img/homepage/icon50/en/64_74_75_247_231204024927_en.webp?t=1399205749" width="933" height="290" loading="lazy">
<form id="ukoocompat_search_block_custom_form" action="/en/module/ukoocompat/listing" method="POST"> <input
    type="hidden" name="id_search" value="1"> <input type="hidden" name="id_search3" value="1"> <input type="hidden"
    name="id_lang" value="1"> <input type="hidden" id="multiFilter_news" name="news_compats" value="0"> <input
    type="hidden" id="multiFilter_order_by" name="order_by_compats" value="price"> <input type="hidden"
    id="multiFilter_order_by_orientation" name="order_by_orientation_compats" value="desc"> <input type="hidden"
    id="multiFilter_id_manufacturer" name="id_manufacturer_compats" value=""> <input type="hidden"
    id="multiFilter_nr_items" name="nr_items_compats" value="20"> <input type="hidden" id="multiFilter_n_items" name="n"
    value="20"> <input type="hidden" id="multiFilter_page_number" name="p" value="1"> <input type="hidden"
    id="multiFilter_id_category" name="id_category" value="0"> <input type="hidden" id="multiFilter_root_page"
    name="root_page" value=""> <input type="hidden" id="check_form" name="check_form" value="99585"> <input
    type="hidden" id="custom_filter_1" name="filters1" value="64"> <input type="hidden" id="custom_filter_2"
    name="filters2" value="74"> <input type="hidden" id="custom_filter_3" name="filters3" value="75"> <input
type="hidden" id="custom_filter_4" name="filters4" value="247"></form> *}