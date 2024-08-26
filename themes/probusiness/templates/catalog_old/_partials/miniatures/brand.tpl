{*
* 2007-2022 ETS-Soft
*
* NOTICE OF LICENSE
*
* This file is not open source! Each license that you purchased is only available for 1 wesite only.
* If you want to use this file on more websites (or projects), you need to purchase additional licenses. 
* You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
* 
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs, please contact us for extra customization service at an affordable price
*
*  @author ETS-Soft <etssoft.jsc@gmail.com>
*  @copyright  2007-2022 ETS-Soft
*  @license    Valid for 1 website (or project) for each purchase of license
*  International Registered Trademark & Property of ETS-Soft
*}
{block name='brand_miniature_item'}
  {* <pre>{$brand|print_r}</pre> *}
  <li class="brand col-md-12">
    <div class="brand_content_item">
        <div class="brand-img" style="max-width: 250px;overflow:hidden;">
          <a href="{$brand.url|escape:'html':'UTF-8'}"><img src="{$brand.image_h|escape:'html':'UTF-8'}" alt="{$brand.name|escape:'html':'UTF-8'}"></a>
        </div>
        <div class="brand-infos">
          <h3>{$brand.name|escape:'html':'UTF-8'}</h3>
          {$brand.description nofilter}
        </div>
    </div>
  </li>
{/block}
