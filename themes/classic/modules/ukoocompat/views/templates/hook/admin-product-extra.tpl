{**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2015 - 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 *}
 {assign var="context" value=Context::getContext()}
 {assign var="idLang" value=(int)$context->language->id}
{if isset($id_product) && $id_product|intval != 0}

    <div class="panel product-tab">
        <h3><i class="icon-check"></i> Criar compatibilidades para grupos ( em massa )</h3>

        <input type="hidden" id="id_lang" name="id_lang" value="{$idLang}" />

        <div class="row">
            {foreach from=$filters item=filter}
                <div style="width: 20%;float: left;padding: 0 10px;">
                    {include file='./ASM_select_groups.tpl'}
                </div>
            {/foreach}
            <div style="width: 20%;float: left;padding: 0 10px;">
                <div style="width: 100%; height: 25px"></div>
                <button type="button" name="createCompats" class="btn btn-default" onclick="save_compatibilities()">Criar compatibilidades</button>
            </div>
            <div class="col-lg-12" id="show_group_compats_message" style="display: none; margin-top: 10px;">
                <div class="alert alert-warning"> Por favor aguarde enquanto processamos o seu pedido </div>
            </div>
        </div>

        {include file='./ASM_select_groups_js.tpl'}
    </div>
    
    <div class="panel product-tab" style="text-align: center;">
        <h3> Newsletter </h3>
        <span class="btn btn-primary" style="cursor: pointer;width: 75px;" onclick="openNewsletterEmails('newsletter_en')">EN</span>
        <span class="btn btn-primary" style="cursor: pointer;width: 75px;" onclick="openNewsletterEmails('newsletter_es')">ES</span>
        <span class="btn btn-primary" style="cursor: pointer;width: 75px;" onclick="openNewsletterEmails('newsletter_fr')">FR</span>
        <span class="btn btn-success" style="cursor: pointer;width: 150px;" onclick="setToSendNewsletter({$id_product})">SET TO SEND</span>
        
        <div class="newsletter_container" id="newsletter_en" style="display: none;"> 
            <div style="margin: 20px;">E-mails EN</div>
            <div id="emails_newsletter_en"> 
                {* {$emailsNewsletter['en']}  *}
            </div>
            <div style="margin-top: 20px;">
                <button type="button" class="btn btn-success" style="width: 150px;" onclick="copyDivToClipboard('emails_newsletter_en')">COPY</button>    
            </div> 
        </div>
        <div class="newsletter_container" id="newsletter_es" style="display: none;"> 
            <div style="margin: 20px;">E-mails ES</div>
            <div id="emails_newsletter_es">
                {* {$emailsNewsletter['es']} *}
            </div>
            <div style="margin-top: 20px;">
                <button type="button" class="btn btn-success" style="width: 150px;" onclick="copyDivToClipboard('emails_newsletter_es')">COPY</button>    
            </div> 
        </div> 
        <div class="newsletter_container" id="newsletter_fr" style="display: none;"> 
            <div style="margin: 20px;">E-mails FR</div>
            <div id="emails_newsletter_fr"> 
                {* {$emailsNewsletter['fr']}  *}
            </div>
            <div style="margin-top: 20px;">
                <button type="button" class="btn btn-success" style="width: 150px;" onclick="copyDivToClipboard('emails_newsletter_fr')">COPY</button>    
            </div> 
        </div>
    </div>
    
    <script>
        function openNewsletterEmails(id){
            
            $('.newsletter_container').css('display', 'none');
            $('#' + id ).css('display', 'block');
        }
        
        function copyDivToClipboard(id) {
            var range = document.createRange();
            range.selectNode(document.getElementById(id));
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            window.getSelection().removeAllRanges();// to deselect
        }
        
    </script>
    
    <style>
        
        .newsletter_container{ margin: 20px 0; font-size: 16px; color: black; }
        
    </style>
    {* <pre>{print_r($compatTab,1)}<pre> *}
    
    {foreach from=$compatTab item=tab}
    <div class="panel product-tab">
        <h3><i class="icon-search"></i> {l s='Search:' mod='ukoocompat'} {$tab.search->name|escape:'htmlall':'UTF-8'}</h3>
        
        <span class="btn btn-default" style="cursor: pointer;" onclick="selectAll()">Select all</span>
        <span class="btn btn-default" style="cursor: pointer; margin-left: 10px;" onclick="deleteSelectedCompatibility()">Remove selected</span>

        <table class="table">
            <thead>
                <tr>
                    <th class="even"><span class="title_box"></span></th>

                    {foreach from=$tab.search->filters item=filter}
                        <th class="even"><span class="title_box">{$filter->name|escape:'htmlall':'UTF-8'}</span></th>
                    {/foreach}
                    <th class="even"><span class="title_box">&nbsp;</span></th>
                </tr>
            </thead>
            <tbody>

            {foreach from=$tab.compatibilities item=compat}
                <tr class="id_compat_{$compat.id_ukoocompat_compat|intval}">
                    <input type="hidden" id="compatibility_number">

                    <td>
                        <input type="checkbox" name="delete_compats" value="{$compat.id_ukoocompat_compat|intval}">
                    </td>
                    
                    {foreach from=$tab.search->filters item=filter}

                        <td>
                            {if $compat['filter_'|cat:$filter->id_ukoocompat_filter] == '*'}
                                {l s='All' mod='ukoocompat'} {$filter->name|escape:'htmlall':'UTF-8'|lower}
                            {else}
                                {$compat['filter_'|cat:$filter->id_ukoocompat_filter]|escape:'htmlall':'UTF-8'}
                            {/if}
                        </td>

                    {/foreach}


                    <td>
                        <div class="btn-group-action">
                            <div class="btn-group pull-right">
								<!--
                                <a href="javascript:void(0);"
                                   onclick="{literal}if (confirm('{/literal}{l s='Delete the compatibility:' mod='ukoocompat'} {foreach from=$tab.search->filters item=filter}{if $compat['filter_'|cat:$filter->id_ukoocompat_filter] == '*'}{l s='All' mod='ukoocompat'} {$filter->name|lower}{else}{$compat['filter_'|cat:$filter->id_ukoocompat_filter]}{/if} {/foreach}?{literal}')){deleteCompatibility({/literal}{$compat.id_ukoocompat_compat|intval}{literal});}else{event.stopPropagation(); event.preventDefault();};{/literal}" class="edit btn btn-default" title="{l s='Delete' mod='ukoocompat'}">
                                    <i class="icon-trash"></i> {l s='Delete' mod='ukoocompat'}
                                </a>-->

								<a href="javascript:void(0);"
                                   onclick="{literal}if (confirm('Supprimer la compatibilité sélectionnée?')){deleteCompatibility({/literal}{$compat.id_ukoocompat_compat|intval}{literal});}else{event.stopPropagation(); event.preventDefault();};{/literal}" class="edit btn btn-default" title="{l s='Delete' mod='ukoocompat'}">
                                    <i class="icon-trash"></i> {l s='Delete' mod='ukoocompat'}
                                </a>

                            </div>
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
        
        <div style="margin-top: 10px;">
            <span class="btn btn-default" style="cursor: pointer;" onclick="selectAll()">Select all</span>
            <span class="btn btn-default" style="cursor: pointer; margin-left: 10px;" onclick="deleteSelectedCompatibility()">Remove selected</span>
        </div>
    </div>

	{break}

    {/foreach}
	
    <div class="panel product-tab" style="display: none;">
		<div onclick="$('#container_new_compatibility').toggle()" style="cursor:pointer;">
			<h3><i class="icon-check"></i> {l s='Create new compatibility' mod='ukoocompat'}</h3>
		</div>

		<div id="container_new_compatibility" style="display:blobk;">
			<!--<div class="alert alert-info">
				{l s='Indicate the combination of criteria with which there is compatible.' mod='ukoocompat'}
			</div>-->
			<input type="hidden" name="id_product" id="id_product" value="{$id_product|intval}" />
			<input type="hidden" name="compatToken" id="compatToken" value="{$compatToken|escape:'htmlall':'UTF-8'}" />
			{* <input type="hidden" name="id_lang" value="{$search->current_id_lang|intval}" /> *}

			{foreach from=$filters item=filter}
				{if $filter.id != 5 }
					<div class="form-group">
						<label class="control-label col-lg-3">
							{$filter.name|escape:'html':'UTF-8'}
						</label>
						<div class="col-lg-9">
							<select name="id_ukoocompat_criterion[{$filter.id|intval}]" id="id_ukoocompat_criterion_{$filter.id|intval}">
								<option value="" >{l s='---' mod='ukoocompat'}</option>
								<option value="*"{if isset($selected_criteria[$filter.id|intval]) && $selected_criteria[$filter.id|intval].id_ukoocompat_criterion == '*'} selected="selected"{/if}>{l s='All' mod='ukoocompat'}</option>
								{foreach from=$filter.criteria item=criterion}
										<option value="{$criterion.id|intval}"{if isset($selected_criteria[$filter.id|intval]) && $selected_criteria[$filter.id|intval].id_ukoocompat_criterion == $criterion.id|intval} selected="selected"{/if}>
											{$criterion.value|escape:'html':'UTF-8'}
										</option>

								{/foreach}
							</select>

						</div>
					</div>
				{else}
					<div class="form-group">
						<label class="control-label col-lg-3">
							{$filter.name|escape:'html':'UTF-8'}
						</label>
						<div class="col-lg-9">
							<select name="id_ukoocompat_criterion[{$filter.id|intval}]" id="id_ukoocompat_criterion_{$filter.id|intval}" style="display: none">
								<option value="" >{l s='---' mod='ukoocompat'}</option>
								<option value="*"{if isset($selected_criteria[$filter.id|intval]) && $selected_criteria[$filter.id|intval].id_ukoocompat_criterion == '*'} selected="selected"{/if}>{l s='All' mod='ukoocompat'}</option>
								{foreach from=$filter.criteria item=criterion}
									<option value="{$criterion.id|intval}"{if isset($selected_criteria[$filter.id|intval]) && $selected_criteria[$filter.id|intval].id_ukoocompat_criterion == $criterion.id|intval} selected="selected"{/if}>
										{$criterion.value|escape:'html':'UTF-8'}
									</option>

								{/foreach}
							</select>
							<div onclick="changeToSelect()" id="filter_text" style="display: block;padding: 5px 0;font-size: 14px;background-color: #F5F8F9;background-image: none;border: 1px solid #C7D6DB;border-radius: 5px;">
								<div style="padding-left: 10px" id="inner_filter_text">---</div>
							</div>
						</div>
					</div>
				{/if}
			{/foreach}

			<div class="panel-footer">
				{* <a href="{$link->getAdminLink('AdminProducts')|escape:'html':'UTF-8'}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel' mod='ukoocompat'}</a> *}
				<button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save' mod='ukoocompat'}</button>
				<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay' mod='ukoocompat'}</button>
			</div>
		</siv>

    </div>

    <script type="text/javascript">

        function deleteCompatibility(id_compat)
        {
            $.ajax({
                url: './index.php?controller=AdminUkooCompatCompat&action=deleteCompatibility',
                type: 'POST',
                data: {
                    token: $('#compatToken').val(),
                    id_compat: parseInt(id_compat),
                    ajax: true
                },
                success: function(data){
                    if (data.status == 'ok')
                    {
                        showSuccessMessage(data.message);
                        $('.id_compat_' + data.id_compat).fadeOut('slow', function(){ $('.id_compat_' + data.id_compat).remove(); });
                        // $('#module_ukoocompat').fadeOut('slow', function(){ $('.id_compat_' + data.id_compat).remove(); });
                        
                    }
                    else
                        showErrorMessage(data.message);
                }
                });
        }

        function setToSendNewsletter(id_product){
            
            $.ajax({
                url: "./index.php?controller=AdminProducts&action=setToSendNewsletter&token={Tools::getAdminTokenLite('AdminProducts')}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id_product: id_product
                },
                success: function(data){
                    alert("Product marked to send newsletter!");
                }
            });
        }

        function deleteSelectedCompatibility()
        {
            if (confirm('Apagar as compatibilidades seleccionadas?')){
                
                $("input:checkbox[name=delete_compats]:checked").each(function(){
                    deleteCompatibility($(this).val());
                });

            }

        }

        function selectAll()
        {
            $('input[name="delete_compats"]').prop('checked', true);
        }
    </script>
{else}
    <div class="alert alert-warning">
        {l s='There is a warning' mod='ukoocompat'}
        <ul style="display:block;" id="seeMore">
            <li>{l s='You must register the product before creating its compatibility.' mod='ukoocompat'}</li>
        </ul>
    </div>
{/if}