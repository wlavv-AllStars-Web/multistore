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
 <style>
 .languageimg{
   height: 75%;
   width: auto;
   align-self: center;
   margin-left: 5px;
 } 

 .selector ::before{
  display: none;
 }
 
 button:focus {
    outline: 0px;
    
}

.dropdown:hover .expand-more {
    color:  #0273eb;
}
</style>
 
 <div id="_desktop_language_selector" style="">
   <div style="display-flex;" class="language-selector-wrapper">
  {*   <span style="color: white;" id="language-selector-label" class="hidden-md-up">{l s='Language:' d='Shop.Theme.Global'}</span> *}
     <div class="language-selector dropdown js-dropdown">
       <button style="background-color: #333333; border: 0" data-toggle="dropdown" class=" btn-unstyle lang" aria-haspopup="true" aria-expanded="false" aria-label="{l s='Language dropdown' d='Shop.Theme.Global'}">
       <img style="width:16px; height:11px" src="/img/asd/flags/{$language.iso_code}.jpg?time=1699550058" alt="img_{$language.iso_code}" width="16" height="11">
       <span class="lang expand-more">{strtoupper($current_language.iso_code)}</span>
         <i class="material-icons expand-more">&#xE5C5;</i>
       </button>
       <ul class="dropdown-menu" style="background-color:#333333; color: white " aria-labelledby="language-selector-label ">
         {foreach from=$languages item=language}
           <li style="display: flex; " class=" selector {if $language.id_lang == $current_language.id_lang} current  {/if}">
             {* <img src="/img/tmp/lang_mini_{$language.id_lang}_3.jpg?time=1699550058" style="width:16px; height:11px" class="languageimg"> *}
             <img src="/img/asd/flags/{$language.iso_code}.jpg?time=1699550058" style="width:16px; height:11px" class="languageimg">
             <a style="margin-left: 15px;border: 0; color: white" href="{url entity='language' id=$language.id_lang}" class="dropdown-item" data-iso-code="{$language.iso_code}">{$language.name_simple}</a>
           </li>
         {/foreach}
       </ul>
         
     </div>
   </div>
 </div>