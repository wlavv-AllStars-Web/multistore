{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="_desktop_language_selector" style="padding-left: 15px;">
  <div class="language-selector-wrapper">
    {* <span class="title_lang">{l s='Language:' d='Shop.Theme'}</span> *}
    <div class="language-selector dropdown js-dropdown">
    
      <span class=" d-none d-lg-block" data-toggle="dropdown" style="text-transform: uppercase;"><img width="20" src="/img/asmFlags/flag{$current_language.iso_code}.jpg"> {$current_language.iso_code}</span>
      <span class=" mobile d-lg-none text-uppercase" onclick="mobileFlags()">{$current_language.iso_code}</span>
      
      <a data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="d-none d-lg-block">
        <i class="material-icons material-icons-expand_more" style="position: relative;"></i>
      </a>
      <ul class="dropdown-menu " style="background: #121212;right:0;left:unset;margin-top:1rem;z-index:99999;">
        {foreach from=$languages item=language}
          <li style="display: flex;justify-content:center;width:100%;" {if $language.id_lang == $current_language.id_lang} class="current" {/if}>
            <div style="display: flex;justify-content:space-between;align-items:center;width:100%;padding-left:0.5rem;">
              <img width="20" src="/img/asmFlags/flag{$language.iso_code}.jpg">
              <a href="{url entity='language' id=$language.id_lang}" class="dropdown-item"{if $language.id_lang == $current_language.id_lang}class="current link" style="color: #dd1411 !important;"{else}style="color: #fff" {/if}>{$language.name_simple}</a>
            </div>
          </li>
        {/foreach}
      </ul>
      <div style="display: none;">
        <ul class="selectorMobileFlags d-lg-none">
            {foreach from=$languages item=language}
            <li style="display: flex;justify-content:center;" {if $language.id_lang == $current_language.id_lang} class="current" {/if}>
              <div style="display: flex;justify-content:center;align-items:center;">
               <a href="{url entity='language' id=$language.id_lang}">
                <img  src="/img/asmFlags/flag{$language.iso_code}.jpg">
                {* <a href="{url entity='language' id=$language.id_lang}" class="dropdown-item"{if $language.id_lang == $current_language.id_lang}class="current link" style="color: #dd1411 !important;"{else}style="color: #fff" {/if}>{$language.name_simple}</a> *}
               </a>
                  </div>
            </li>
            {/foreach}
        </ul>
      </div>

      <select class="link hidden-md-up hidden-sm-down">
        {foreach from=$languages item=language}
          <option value="{url entity='language' id=$language.id_lang}"{if $language.id_lang == $current_language.id_lang} selected="selected"{/if}>{$language.name_simple}</option>
        {/foreach}
      </select>
    </div>
  </div>
</div>
<script>
  isDropdownVisible = false;
 
	function mobileFlags() {
    const dropdownMobile = document.getElementById("languageSelectorMobile");
    const dropdown = document.querySelector('.selectorMobileFlags');
    
    if (!isDropdownVisible) {
        dropdownMobile.appendChild(dropdown);
        isDropdownVisible = true;
        console.log(isDropdownVisible + dropdown)
    } else {
      const dropdownFlags = document.querySelector('#languageSelectorMobile .selectorMobileFlags')
      
      if (dropdownMobile.contains(dropdownFlags)) {
            dropdownMobile.removeChild(dropdownFlags);
      }

        isDropdownVisible = false;
        console.log(isDropdownVisible + dropdownFlags)
    }

  }
</script>
