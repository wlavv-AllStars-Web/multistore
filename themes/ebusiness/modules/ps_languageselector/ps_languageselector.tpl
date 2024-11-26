

 <div id="_desktop_language_selector" class="hidden-md-down">
   <div style="display-flex;" class="language-selector-wrapper ">
  {*   <span style="color: white;" id="language-selector-label" class="hidden-md-up">{l s='Language:' d='Shop.Theme.Global'}</span> *}
     <div class="language-selector dropdown js-dropdown">
       <div data-toggle="dropdown" class=" btn-unstyle lang lgh"  style="display: flex;flex-direction:row;align-items:center;gap:5px;"  aria-haspopup="true" aria-expanded="false" aria-label="{l s='Language dropdown' d='Shop.Theme.Global'}">
       <img style="width:16px; height:11px;vertical-align: inherit;" src="/img/tmp/lang_mini_{$current_language.id_lang}_3.jpg?time=1699550058">
       <span style="font-weight: 600;">{strtoupper($current_language.iso_code)}</span>
         <i class="material-icons expand-more">&#xE5C5;</i>
       </div>
       <ul class="dropdown-menu" style="margin-top: -1px;margin-left: -46px; background-color:#121212; color: white " aria-labelledby="language-selector-label ">
         {foreach from=$languages item=language}
           <li style="display: flex; " class=" selector {if $language.id_lang == $current_language.id_lang} current  {/if}">
             <img src="/img/tmp/lang_mini_{$language.id_lang}_3.jpg?time=1699550058" style="width:16px; height:11px" class="languageimg">
             <a style="margin-left: 8px; " href="{url entity='language' id=$language.id_lang}" class="dropdown-item" data-iso-code="{$language.iso_code}">{$language.name_simple}</a>
           </li>
         {/foreach}
       </ul>
     </div>
   </div>
 </div>

 <div id="_mobile_language_selector" class="hidden-lg-up">
   <div class="language-selector-wrapper">
       <ul aria-labelledby="language-selector-label ">
         {foreach from=$languages item=language}
           <li style="display: flex; " class=" selector {if $language.id_lang == $current_language.id_lang} current  {/if}">
            <a style="margin-left: 8px; " href="{url entity='language' id=$language.id_lang}" class="dropdown-item" data-iso-code="{$language.iso_code}">
              <img src="/img/tmp/lang_mini_{$language.id_lang}_3.jpg?time=1699550058" style="width:48px; height:30px;border-radius: 0.25rem;" class="languageimg">
             </a>
           </li>
         {/foreach}
       </ul>
     </div>
   </div>
 </div>

