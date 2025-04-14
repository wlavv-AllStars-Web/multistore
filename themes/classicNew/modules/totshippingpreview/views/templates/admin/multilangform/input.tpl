{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license
*}

{*
	Parametre : 
	$language : variable globale Language::getLanguages
	$value : array(
		$id_lang => value
		$id_lang1 => value1
		$id_lang2 => value2
		...
	)
	$inputname 
*}
{assign  var="defaultlanguage" value=Configuration::get('PS_LANG_DEFAULT')}

{foreach from=$languages item=language}

<div class="{$inputname|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}" style="display: {if $language.id_lang == Configuration::get('PS_LANG_DEFAULT')} block {else} none {/if};float: left;">
  	<input type="text" 
  		name="{$inputname|escape:'html':'UTF-8'}[{$language.id_lang|escape:'html':'UTF-8'}]" 
  		class="input_{$inputname|escape:'html':'UTF-8'}_{$language.id_lang|escape:'html':'UTF-8'}" 
  		value="{if isset($value[$language.id_lang])}{$value[$language.id_lang]|escape:'htmlall':'UTF-8'} {/if}" />
 </div>
{/foreach}
{$thismodule->displayFlags($languages, Configuration::get('PS_LANG_DEFAULT'), $inputname, $inputname, true)|escape:'htmlall':'UTF-8'}
