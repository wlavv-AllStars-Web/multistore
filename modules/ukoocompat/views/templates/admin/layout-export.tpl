{**
  * Recherche de produits par compatibilité
  *
  * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
  * @copyright Ukoo 2015 - 2016
  * @license   Ukoo - Tous droits réservés
  *
  * "In Ukoo we trust!"
  *}

{$export_precontent|escape:'quotes':'UTF-8'}{foreach from=$export_headers item=header name=compatLoop}{$text_delimiter|escape:'quotes':'UTF-8'}{$header|escape:'quotes':'UTF-8'}{$text_delimiter|escape:'quotes':'UTF-8'}{if !$smarty.foreach.compatLoop.last};{/if}{/foreach}

{foreach from=$export_content item=line}
{foreach from=$line item=content name=compatLoop}{$text_delimiter|escape:'quotes':'UTF-8'}{$content|escape:'quotes':'UTF-8'}{$text_delimiter|escape:'quotes':'UTF-8'}{if !$smarty.foreach.compatLoop.last};{/if}{/foreach}

{/foreach}