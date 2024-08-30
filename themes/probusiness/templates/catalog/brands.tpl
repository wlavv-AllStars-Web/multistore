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
 {extends file=$layout}

 {block name='content'}
   <section id="main">
     <div id="brands-page">
       <div class="brands_banner">
         <img class="desktop" src="/img/asd/dealers/headers/linecard_{$language.iso_code}.webp" alt="brands_banner" width="1350" height="300" />
         <img class="mobile p-img" src="/img/asd/dealers/headers/linecard_{$language.iso_code}.webp" alt="brands_banner" width="390" height="90" />
       </div>
     {block name='brand_miniature'}
       <ul class="list_manu row">
         {foreach from=$brands item=brand}
           {include file='catalog/_partials/miniatures/brand.tpl' brand=$brand}
         {/foreach}
       </ul>
     {/block}
     </div>
   </section>
 
 {/block}
 