{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license
*}

{literal}
	<style>
		.clear {
			clear:both;
		}
	</style>
{/literal}

{literal}
<script>
	$(document).ready(function(){
		$('#module_form_submit_btn').addClass('btn btn-default pull-right');
        $('#module_form_submit_btn').css('margin-top', '0px');
        $('.bootstrap .panel .panel-footer').css('margin-bottom', '0px');
		var zones = '<option value="empty"></option><option value="countries" {/literal}{if $tot_shipping_zone_2 == 'countries'}selected="selected"{/if}{literal}>{/literal}{l s='Countries' mod='totshippingpreview'}{literal}</option><option value="states" {/literal}{if $tot_shipping_zone_2 == 'states'}selected="selected"{/if}{literal}>{/literal}{l s='States' mod='totshippingpreview'}{literal}</option>';

		var countries = '<option value="empty"></option><option value="states" {/literal}{if $tot_shipping_zone_2 == 'states'}selected="selected"{/if}{literal}>{/literal}{l s='States' mod='totshippingpreview'}{literal}</option>';

		var states = '<option value="empty"></option>';

		$('#tot_shipping_zone').on('change',function(){
			var val = $(this).val();

			$('#tot_shipping_zone_2').empty();

			switch(val){
				case 'zones':
					$('#tot_shipping_zone_2').html(zones);
					break;
				case 'countries':
					$('#tot_shipping_zone_2').html(countries);
					break;
				default:
					$('#tot_shipping_zone_2').html(states);
			}
		});
	});
</script>
{/literal}

