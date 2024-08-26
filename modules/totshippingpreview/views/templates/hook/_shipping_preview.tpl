{*
* @author 202 ecommerce <contact@202-ecommerce.com>
* @copyright  Copyright (c) 202 ecommerce 2014
* @license    Commercial license
*}
<div id="totshippingpreview-info">
    {if $origin_country}
        <p><label>{l s='Country of origin : ' mod='totshippingpreview'}</label> {$origin_country|escape:'html':'UTF-8'}</p>
    {/if}
    {if $delivery_country}
        <p><label>{l s='Country of delivery : ' mod='totshippingpreview'}</label> {$delivery_country|escape:'html':'UTF-8'}</p>
    {/if}
    {if ($min_days_nb && $min_days_nb > 0) || ($max_days_nb && $max_days_nb > 0)}
        <p><label>{l s='Delivery time : ' mod='totshippingpreview'}</label>
        {if $min_days_nb && $max_days_nb}
            {if $min_days_nb != $max_days_nb}
        		{if !$only_min}
			{l s='Estimated between ' mod='totshippingpreview'}<label>{$min_days_nb|escape:'html':'UTF-8'}{if $min_days_nb > 1}{l s=' days' mod='totshippingpreview'}{else}{l s=' day' mod='totshippingpreview'}{/if}{l s=' and ' mod='totshippingpreview'}{$max_days_nb|escape:'html':'UTF-8'}{l s=' days' mod='totshippingpreview'}</label></p>
        		{else}
			{l s='At the earliest ' mod='totshippingpreview'}<label>{$min_days_nb|escape:'html':'UTF-8'}{if $min_days_nb > 1}{l s=' days' mod='totshippingpreview'}{else}{l s=' day' mod='totshippingpreview'}{/if}</label></p>
				{/if}
			{else}
        	<label>{$min_days_nb|escape:'html':'UTF-8'}{if $min_days_nb > 1}{l s=' days' mod='totshippingpreview'}{else}{l s=' day' mod='totshippingpreview'}{/if}{l s=' minimum' mod='totshippingpreview'}</label>
        	{/if}
        {elseif $min_days_nb && !$max_days_nb}
            {l s='At the earliest ' mod='totshippingpreview'}<label>{$min_days_nb|escape:'html':'UTF-8'}{if $min_days_nb > 1}{l s=' days' mod='totshippingpreview'}{else}{l s=' day' mod='totshippingpreview'}{/if}</label></p>
        {elseif !$min_days_nb && $max_days_nb}
            {l s='At the latest ' mod='totshippingpreview'}<label>{$max_days_nb|escape:'html':'UTF-8'}{if $max_days_nb > 1}{l s=' days' mod='totshippingpreview'}{else}{l s=' day' mod='totshippingpreview'}{/if}</label></p>
        {/if}
    {/if}
</div>

<div id="js-totshippingpreview-container">
	<a href="#totselectzone" id="totshippingpreview" style="{if $page_name == 'order-opc'}width:100%;{/if} text-align:center; height:35px; {if $totTxtCol != ""}color: {$totTxtCol|escape:'html':'UTF-8'};{/if}{if $totBgCol != ""}background-color: {$totBgCol|escape:'html':'UTF-8'}{/if}" class="btn btn-default">
		 <div id="totcamion">
		 	{if !empty($totPic)}
		 		<img src="{$totImgDir|escape:'html':'UTF-8'}{$totPic|escape:'html':'UTF-8'}" alt="">
		 	{else}
		 		<img src="{$totImgDir|escape:'html':'UTF-8'}camion.png" alt="">
		 	{/if}
		 	{if !empty($totTxt.$lang_current)}
		 		<span style="margin-left: 10px; text-transform: uppercase">{$totTxt.$lang_current|escape:'html':'UTF-8'}</span>
		 	{else}
		 		<span style="margin-left: 10px; text-transform: uppercase">{l s='Preview shipping costs' mod='totshippingpreview'}</span>
		 	{/if}
		</div>
		<br/>
	</a>
</div>
<script type="text/javascript">
    var txtoriginal = "{$totTxtCol|escape:'html':'UTF-8'}";
    var bgoriginal = "{$totBgCol|escape:'html':'UTF-8'}";
    var txthover = "{$totTxtColHov|escape:'html':'UTF-8'}";
    var bghover = "{$totBgColHov|escape:'html':'UTF-8'}";
    $('#totshippingpreview').hover(
        function () {
            $(this).css('color', txthover);
            $(this).css('background-color', bghover);
        },
        function () {
            $(this).css('color', txtoriginal);
            $(this).css('background-color', bgoriginal);
        }
    );
</script>

{if $tot_shipping_url_rewritting == true}
<script type="text/javascript">
	$(function(){
		$('#totshippingpreview').attr('href', '#totselectzone');
    });
</script>
{/if}

{assign var="zone_count" value=count($zones) }
{assign var="zone_2_count" value=count($zones_2) }

<div style="display:none;">

	<div id="totselectzone" class="totselectzone">
		<div class="totselectzone__title">
			{l s='Shipping fees' mod='totshippingpreview'}
		</div>

		<div id="shipping_before">
			{$tot_shipping_before} {*Generation code html, pas neccesaire de escape*}
		</div>

		{if $first_level == 'countries' || $first_level == 'zones' || $first_level == 'states'}
		<div id="shipping_zone">
			<div class="choice_1">
				<label for="tot_zone_1">{if $first_level=='countries'}{l s='Choose your country' mod='totshippingpreview'}{elseif $first_level=='zones'}{l s='Choose your zone' mod='totshippingpreview'}{else}{l s='Choose your state' mod='totshippingpreview'}{/if}</label>
				<div class="select-wrapper">
					{if $zone_count > 1 }
					<select name="tot_zone_1" id="tot_zone_1">
						<option value="" selected="selected">{l s='Choose' mod='totshippingpreview'}</option>
						{foreach from=$zones item=zone}
							<option value="{$zone.id|escape:'htmlall':'UTF-8'}" data-id-zone="{$zone.id_zone|escape:'htmlall':'UTF-8'}">{$zone.name|escape:'htmlall':'UTF-8'}</option>
						{/foreach}
					</select>
					{else if $zone_count > 0}
					{$zones[0].name|escape:'htmlall':'UTF-8'}
					<input id="tot_zone_1" type="hidden" value="{$zones[0].id|escape:'htmlall':'UTF-8'}" data-id-zone="{$zones[0].id_zone|escape:'htmlall':'UTF-8'}" />
					{/if}
				</div>
			</div>
			<div class="choice_2">
				<label for="tot_zone_2">{if $second_level=='countries'}{l s='Choose your country' mod='totshippingpreview'}{elseif $second_level=='zones'}{l s='Choose your zone' mod='totshippingpreview'}{else}{l s='Choose your state' mod='totshippingpreview'}{/if}</label>
				<div class="select-wrapper">
					{if $zone_2_count > 1}
					<select name="tot_zone_2" id="tot_zone_2">
					</select>
					{else}
					{$zones_2[0].name|escape:'htmlall':'UTF-8'}
					<input id="tot_zone_2" type="hidden" value="{$zones_2[0].id|escape:'htmlall':'UTF-8'}" data-id-zone="{$zones_2[0].id_zone|escape:'htmlall':'UTF-8'}" />
					{/if}
				</div>
			</div>
		</div>
		{else}
			<div>
				<p>{l s='Shipping preview module need to be configure before use the preview button' mod='totshippingpreview'}</p>
			</div>
		{/if}

		<div class="totselectzone__table-container">
		</div>

		<div id="shipping_after">
			{$tot_shipping_after} {*Generation code html, pas neccesaire de escape*}
		</div>
	</div>

</div>



<script>
{literal}
document.addEventListener('DOMContentLoaded', function(){
	$('#availability_statut').after($('#js-totshippingpreview-container'));
    $('#availability_statut').after($('#totshippingpreview-info'));
    {/literal}

	$('#totshippingpreview').fancybox({
		padding : 0
	});

	$('#totshippingpreview').on('click', function(){
		{if $zone_count == 1 }
		$('#tot_zone_1').trigger('change');
		{/if}
		{if $zone_2_count == 1 }
		$('#tot_zone_2').trigger('change');
		{/if}
	});

    {literal}

    current_controller = "{/literal}{$current_controller|escape:'htmlall':'UTF-8'}{literal}";

	$('#tot_zone_1').change(function(e){
		var tot_id_product_attribute = $('#idCombination').val();
		zoneSelected = $('#tot_zone_1{/literal}{if $zone_count > 1 } option:selected{/if}{literal}');

        if(current_controller == "product") {
            totalPrice = $("#our_price_display").attr("content")*$("#quantity_wanted").val();
			quantity = $("#quantity_wanted").val();
        } else {
			quantity = null;
            totalPrice = 0;
        }

		$.ajax({
			url: '{/literal}{$ajax_url|escape:'htmlall':'UTF-8'}{literal}',
			type: 'post',
			dataType: 'json',
			data: {
				'id_zone' : zoneSelected.attr('data-id-zone'),
				'id' : zoneSelected.val(),
				'zone_name' : zoneSelected.text(),
				'id_product' : {/literal}{$tot_id_product|escape:'htmlall':'UTF-8'}{literal},
				'id_product_attribute' : tot_id_product_attribute ? tot_id_product_attribute : {/literal}{$tot_id_product_attribute|escape:'htmlall':'UTF-8'}{literal},
				'cart' : {/literal}{$tot_cart|escape:'htmlall':'UTF-8'}{literal},
				'choice' : '1',
                'total_price' : totalPrice ,
				'quantity' : quantity

			},
			success: function (data) {
				displayJsonData(data);

				if(Object.keys(data.data).length == 1){
					$("#tot_zone_2").trigger("change");
				}
			}
		});
	});

    $('#quantity_wanted').change(function(){
		var tot_id_product_attribute = $('#idCombination').val();
        if(current_controller == "product") {
		 quantity = $("#quantity_wanted").val();
            totalPrice = $("#our_price_display").attr("content")*$("#quantity_wanted").val();
        } else {
            totalPrice = 0;
			quantity = null;
        }

		$.ajax({
            url: '{/literal}{$ajax_url|escape:'htmlall':'UTF-8'}{literal}',
            type: 'post',
            dataType: 'json',
            data: {
                'id_zone' : zoneSelected.attr('data-id-zone'),
                'id' : zoneSelected.val(),
                'zone_name' : zoneSelected.text(),
                'id_product' : {/literal}{$tot_id_product|escape:'htmlall':'UTF-8'}{literal},
                'id_product_attribute' : tot_id_product_attribute ? tot_id_product_attribute : {/literal}{$tot_id_product_attribute|escape:'htmlall':'UTF-8'}{literal},
                'cart' : {/literal}{$tot_cart|escape:'htmlall':'UTF-8'}{literal},
                'choice' : '1',
                'total_price' : totalPrice ,
				'quantity' : quantity
            },
            success: function (data) {
                displayJsonData(data);

				if(Object.keys(data.data).length == 1){
					$("#tot_zone_2").trigger("change");
				}
            }
        });
    });

	$('#tot_zone_2').on('change', zone2Change);

});

function zone2Change(e) {

	var tot_id_product_attribute = $('#idCombination').val();

	totalPrice = $("#our_price_display").attr("content")*$("#quantity_wanted").val();

	zoneSelected2 = $('#tot_zone_2'+(e.target.type != 'hidden'?' option:selected':''));

	quantity = $("#quantity_wanted").val();

	$.ajax({
		url: '{/literal}{$ajax_url|escape:'htmlall':'UTF-8'}{literal}',
		type: 'post',
		dataType: 'json',
		data: {
			'id_zone' : zoneSelected2.attr('data-id-zone'),
			'id' : zoneSelected2.val(),
			'zone_name' : zoneSelected2.text(),
			'id_product' : {/literal}{$tot_id_product|escape:'htmlall':'UTF-8'}{literal},
			'id_product_attribute' : tot_id_product_attribute ? tot_id_product_attribute : {/literal}{$tot_id_product_attribute|escape:'htmlall':'UTF-8'}{literal},
			'cart' : {/literal}{$tot_cart|escape:'htmlall':'UTF-8'}{literal},
			'choice' : '2',
			'total_price' : totalPrice,
			'quantity' : quantity

		},
		success: function (data) {
			displayJsonData(data);
		}
	});
}

function displayJsonData(jsonData){
	$(".totselectzone__table-container").html("");
	if(jsonData.type == 'tab') {
		if(jsonData.display) {
			$(".choice_2").hide();
		}
		$('.totselectzone__table-container').html(jsonData.data);
	} else {
		$(".choice_2").show();

		$(".choice_2 > .select-wrapper").html("");

		if(Object.keys(jsonData.data).length > 1){
			$(".choice_2 > .select-wrapper").append('<select name="tot_zone_2" id="tot_zone_2"></select>');
			$("#tot_zone_2").append('<option value="" selected="selected">{/literal}{l s='Choose' mod='totshippingpreview'}{literal}</option>');
		}

		for ( i in jsonData.data ) {
			if(Object.keys(jsonData.data).length > 1) {
				$("#tot_zone_2").append('<option value="' + jsonData.data[i].id + '" data-id-zone="' + jsonData.data[i].id_zone + '">' + jsonData.data[i].name + '</option>');
			} else {
				$(".choice_2 > .select-wrapper").append(jsonData.data[i].name + '<input id="tot_zone_2" type="hidden" value="' + jsonData.data[i].id + '" data-id-zone="' + jsonData.data[i].id_zone + '" />');
			}
		}

		$('#tot_zone_2').on('change', zone2Change);
	}

	$.fancybox.reposition();
	$.fancybox.update();

	$(".totselectzone__table-container img").load(function() {
		// Reposition fancybox when images load.
		$.fancybox.reposition();
		$.fancybox.update();
	});

	$('#tot_zone_1, #tot_zone_2').change(function() {
		$.fancybox.reposition();
		$.fancybox.update();
	});
}
{/literal}

</script>
