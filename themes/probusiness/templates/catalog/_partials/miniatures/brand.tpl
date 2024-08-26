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
 {block name='brand_miniature_item'}
  {* <pre>{$brand|print_r}</pre> *}
  {if Context::getContext()->customer->logged}
    <li class="brand_logged col-lg-3 col-md-4 col-sm-6" style="margin-top: 2rem;">
      <div class="brand_content_item_logged" style="border: 1px solid #0273eb;">
          <div class="brand-infos">
            <h3 style="text-align: center;background:#0273eb;color:#fff;padding: 5px;font-size:13px;line-height:18px;font-weight:700;">{$brand.name|escape:'html':'UTF-8'}</h3>
          </div>
          <div class="brand-img" >
            {* <a href="{$brand.url|escape:'html':'UTF-8'}" style="display:flex;justify-content:center;align-items:center;"><img src="{$brand.image_m|escape:'html':'UTF-8'}" alt="{$brand.name|escape:'html':'UTF-8'}" style="width: 100%;max-width:125px;" width="125" height="125"></a> *}
            <a href="{$brand.url|escape:'html':'UTF-8'}" style="display:flex;justify-content:center;align-items:center;"><img src="/img/asd/150px/{$brand.id_manufacturer}.webp" alt="{$brand.name|escape:'html':'UTF-8'}" style="width: 100%;max-width:300px;height:auto;" width="300" height="150"></a>
            
          </div>
          
      </div>
    </li>
  {else}
    {* <li class="brand col-md-12">
      <div class="brand_content_item">
          <div class="brand-img" style="max-width: 250px;overflow:hidden;">
            <a href="{$brand.url|escape:'html':'UTF-8'}"><img src="{$brand.image_m|escape:'html':'UTF-8'}" alt="{$brand.name|escape:'html':'UTF-8'}" width="125" height="125"></a>
          </div>
          <div class="brand-infos">
            <h3>{$brand.name|escape:'html':'UTF-8'}</h3>
            <p style="font-size: 14px;line-height:18px;">{$brand.description nofilter}</p>
          </div>
      </div>
    </li> *}

    <li class="brand_logged col-lg-3 col-md-4 col-sm-6" style="margin-top: 2rem;">
      <div class="brand_content_item_logged" style="border: 1px solid #0273eb;">
          <div class="brand-infos">
            <h3 style="text-align: center;background:#0273eb;color:#fff;padding: 5px;font-size:13px;line-height:18px;font-weight:700;">{$brand.name|escape:'html':'UTF-8'}</h3>
          </div>
          <div class="brand-img" >
            {* <a href="{$brand.url|escape:'html':'UTF-8'}" style="display:flex;justify-content:center;align-items:center;"><img src="{$brand.image_m|escape:'html':'UTF-8'}" alt="{$brand.name|escape:'html':'UTF-8'}" style="width: 100%;max-width:125px;" width="125" height="125"></a> *}
            <div style="display:flex;justify-content:center;align-items:center;">
            <img src="/img/asd/150px/{$brand.id_manufacturer}.webp" alt="{$brand.name|escape:'html':'UTF-8'}" style="width: 100%;max-width:300px;height:auto;" width="300" height="150">
            </div>
            
          </div>
          
      </div>
    </li>
  {/if}
{/block}
