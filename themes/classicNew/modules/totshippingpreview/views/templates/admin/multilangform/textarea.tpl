{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license
*}

{*
	Parametre : 
	$language : variable globale non passé en paramètre Language::getLanguages
	$value : array(
		$id_lang => value
		$id_lang1 => value1
		$id_lang2 => value2
		...
	)
	$textareaname 
*}




{foreach from=$languages item=language}

<div class="{$textareaname|escape:'htmlall':'UTF-8'}_{$language.id_lang|escape:'htmlall':'UTF-8'}" style="display: {if $language.id_lang == $default_lang} block {else} none {/if};float: left;">
  	<textarea name="{$textareaname|escape:'htmlall':'UTF-8'}[{$language.id_lang|escape:'htmlall':'UTF-8'}]" class="rte">{if isset($value[$language.id_lang])} {$value[$language.id_lang]|escape:'htmlall':'UTF-8'}{/if}</textarea>
 </div>
{/foreach}
{$thismodule->displayFlags($languages, $default_lang, $textareaname, $textareaname, true)} {*Generation·code·html,·pas·neccesaire·de·escape*}