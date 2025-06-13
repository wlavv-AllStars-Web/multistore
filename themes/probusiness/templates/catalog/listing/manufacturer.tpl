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
{extends file='catalog/listing/product-list.tpl'}

{block name='product_list_header'}

  <div style="max-width:1350px;margin:auto;">
    <img class="p-img" src="http://webtools.all-stars-motorsport.com/uploads/manufacturer/ASD/{$manufacturer.name|replace:' ':''}/{$manufacturer.id}.webp" style="width: 100%;" alt="Brand banner"/>
  </div>
  
  <style>
    
    .btnCar{  black; float: left; width: 50%; margin: 0 auto; border: 0px solid #000; text-align: right; padding: 20px; }
    .btnBike{ black; float: left; width: 50%; margin: 0 auto; border: 0px solid #000; text-align: left;  padding: 20px; }
    
    .btnCar:hover{ background-color: #fff; }
    .btnBike:hover{ background-color: #fff; }

</style>

{if $manufacturer.bike_parts == 1}

{assign var="id_category" value="{if $smarty.get.id_category}{$smarty.get.id_category}{else}{/if}"}


<div style="display: flex;width: 100%; text-align: center;margin: 0 auto; background-color: #fff;">

{* {$link->getCategoryLink($id_category)|escape:'html':'UTF-8'} *}
    {* {if Context::getContext()->isMobile()} *}
        <a href="{$link->getManufacturerLink($manufacturer.id)}" class="btnCar mobile">
            <img id="car" {if (!isset($id_category)) || ($id_category != 17) } class="carhover"  src="/img/asd/Content_pages/bike/icon_carM_{$language.iso_code}_hover.webp" style="background-color: #0076E7;" {else} class="car-nothover" src="/img/asd/Content_pages/bike/icon_carM_{$language.iso_code}_normal.webp" {/if}>
        </a> 
        <a href="{$smarty.server.SCRIPT_URI}?id_category=17" class="btnBike mobile" >
            <img id="bike" {if isset($id_category) && ($id_category == 17)  } class="carhover"  src="/img/asd/Content_pages/bike/icon_bikeM_{$language.iso_code}_hover.webp" style="background-color: #0076E7;" {else} class="car-nothover" src="/img/asd/Content_pages/bike/icon_bikeM_{$language.iso_code}_normal.webp" {/if}>
        </a> 
    {* {else} *}
        <a href="{$link->getManufacturerLink($manufacturer.id)}" class="btnCar desktop">
            <img id="car" {if (!isset($id_category)) || ($id_category != 17) } class="carhover" src="/img/asd/Content_pages/bike/icon_car_{$language.iso_code}_hover.webp" style="background-color: #0076E7;" {else}class="car-nothover" src="/img/asd/Content_pages/bike/icon_car_{$language.iso_code}_normal.webp" {/if}>
        </a> 
        <a href="{$smarty.server.SCRIPT_URI}?id_category=17" class="btnBike desktop" >
            <img id="bike" {if isset($id_category) && ($id_category == 17)  } class="carhover" src="/img/asd/Content_pages/bike/icon_bike_{$language.iso_code}_hover.webp" style="background-color: #0076E7;" {else}
            class="car-nothover" src="/img/asd/Content_pages/bike/icon_bike_{$language.iso_code}_normal.webp" {/if}>
        </a> 
    {* {/if} *}
</div>
  {/if}
{/block}

{block name='product_list'}
  {include file='catalog/_partials/products.tpl' listing=$listing productClass="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"}
{/block}
