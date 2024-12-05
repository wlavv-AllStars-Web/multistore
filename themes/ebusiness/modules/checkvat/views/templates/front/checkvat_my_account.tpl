{*
* History:
*
* 1.0 - First version (only for prestashop 1.4)
* 1.5 - Only for prestashop version 1.5
* 1.5.2 - Correction little bug when the group is "Client"
* 1.5.3 - Add possibility to valid if VIES is enable, Add table with last customers in the back office home page
* 1.5.4 - Allow group pro only (not default)
* 1.5.4.1 - optimisation when VIES is "out"
* 1.5.5 - Add VAT number in the invoice and add Croatia in the list of country
* 1.5.6 - little debug (VAT number also included in the footer of PDF)
* 1.6 - update for v1.6, add hookdashboardZoneTwo 
*
*  @author    Vincent MASSON <contact@coeos.pro>
*  @copyright Vincent MASSON <www.coeos.pro>
*  @license   http://www.coeos.pro/boutique/fr/content/3-conditions-generales-de-ventes
*}

	{if $bloc_checkvat}
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 d-flex">
			<div class="myaccount-link-list" id="check_vat" style="display: flex;flex-direction: column;margin-bottom: 1.875rem !important;justify-content: center;padding:0 1rem;
			align-items: center;
			box-shadow: 2px 2px 11px 0px rgba(0, 0, 0, 0.1);width:100%;">
				<h3>{l s='TVA number (Only for companies)' d='Shop.Theme.CustomerAccount'} :</h3>
				{if $msg_vat_invalid}<p style="color:red;"><strong>{l s='Sorry, invalid VAT number' mod='checkvat'}</strong></p>{/if}
				
				<form method="post" style="display:flex;flex-wrap: nowrap;padding-left: 0px;padding-right:0px;gap:0.5rem;">
					<input class="form-control" placeholder="TVA number" aria-label="TVA number" name="vat_number" type="text" value="{if isset($smarty.post.vat_number)}{$smarty.post.vat_number}{/if}"/>
					<button class="btn" type="submit" value="save" style="border-radius: 0.25rem;">{l s='Save' d='Shop.Theme.CustomerAccount'}</button>
				</form>
				<small style="text-align: start;">{l s='(Ex: FR99999999999 / GR999999999)' d='Shop.Theme.CustomerAccount'}</small>
			</div>
		</div>

	{/if}
	{if $msg_vat_valid}
		<p id="msg_vat_valid" style="{if $msg_vat_valid}background-color:#DFFAD3;padding:10px{/if}">
		<strong>{l s='Your VAT number is correct and has been successfully' mod='checkvat'}
		{if isset($validation_auto) AND $validation_auto == False}, 
		<span id="validation_auto">{l s='the webmaster will validate your account soon' mod='checkvat'}</span>{else}.{/if}
		</strong></p>
	{/if}
<!-- MODULE check_VAT by www.coeos.pro -->

<script>
$('input[name="vat_number"]').next('button').prop('disabled', true);

$('input[name="vat_number"]').focusout(function(){

  $.ajax({
		  type: "POST",
		  dataType: 'text',
		  headers: { "cache-control": "no-cache" },
		  url: "/index.php?controller=my-account",
		  data: {
			  'action' : 'check_vat',
			  'vatnumber' : $('input[name="vat_number"]').val()
		  },
		  success: function(msg){
			  
			if(msg == 1){
				$('input[name="vat_number"]').css('border-color', 'black'); 
				$('input[name="vat_number"]').next('button').prop('disabled', false);
			}else{
				$('input[name="vat_number"]').css('border-color', 'red'); 
				alert("Inserted VAT Number is invalid for your country, please verify!");
				$('input[name="vat_number"]').next('button').prop('disabled', true);   
				// $('input[name="vat_number"]').value = "";   
				// $('input[name="vat_number"]').attr('value', '');  
			}
		  }
  });
});
</script>