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


<div  class="footer-container">
      <div style="max-width: 100%;" class="row">
      {hook h='displayFooter'}
      </div>
    
    <div style="justify-content:center; display: flex ; max-width: 100%;" class="row">
    <div style="padding-top: 25px ;" class="col-md-12" >
      <p class="text-sm-center" style="font-weight: 600;font-size:12px;text-transform:uppercase;">
        {block name='copyright_link'}
          {l s='@ 2024 All Stars Distribution. All Rights Reserved.' d='Shop.Theme.Copyrights'}
        {/block}
      </p>
    </div>
  </div>
  
    </div>
  </div>
