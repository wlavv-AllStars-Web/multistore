<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{* {debug} *}
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

{if	$page_name != 'product'}
<div id="js-totshippingpreview-container">
	<a href="#totselectzone" id="totshippingpreview" style="white-space:nowrap; text-align:center; width:100%;{if $totTxtCol != ""}color: {$totTxtCol|escape:'html':'UTF-8'};{/if}{if $totBgCol != ""}background-color: {$totBgCol|escape:'html':'UTF-8'}{/if}" class="btn btn-default">
		 <div id="totcamion">
		 	{if !empty($totPic)}
		 		<img src="{$totImgDir|escape:'html':'UTF-8'}{$totPic|escape:'html':'UTF-8'}" alt="">
		 	{else}
		 		<img src="{$totImgDir|escape:'html':'UTF-8'}camion.png" alt="">
		 	{/if}
		 	{if !empty($totTxt.$lang_current)}
		 		<span style="margin-left: 10px; text-transform: uppercase;font-weight: initial;">{$totTxt.$lang_current|escape:'html':'UTF-8'}</span>
		 	{else}
		 		<span style="margin-left: 10px; text-transform: uppercase;font-weight: initial;">{l s='Preview shipping costs' mod='totshippingpreview'}</span>
		 	{/if}
		</div>
		<br/>
	</a>
</div>
{/if}

<script type="text/javascript">
console.log("totshipping")
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

{if	$page_name == 'product'}
<div>
{else}
<div style="display:none;">
{/if}
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
				<!-- <label for="tot_zone_1">{if $first_level=='countries'}{l s='Choose your country' mod='totshippingpreview'}{elseif $first_level=='zones'}{l s='Choose your zone' mod='totshippingpreview'}{else}{l s='Choose your state' mod='totshippingpreview'}{/if}</label> -->
				<div class="select-wrapper">
					{if $zone_count > 1 }
					<select name="tot_zone_1" id="tot_zone_1">
						<!--<option value="" selected="selected">{l s='Choose' mod='totshippingpreview'}</option> -->
						{foreach from=$zones item=zone}
							<option value="{$zone.id|escape:'htmlall':'UTF-8'}" data-id-zone="{$zone.id_zone|escape:'htmlall':'UTF-8'}" data-image="/img/flags/Flags_{$zone.id}.webp"> 
    							
    							{$zone.name|escape:'htmlall':'UTF-8'}
							</option>
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
			{*{$tot_shipping_after}*}{*Generation code html, pas neccesaire de escape*}
		</div>
	</div>

</div>


<style>
.select2-selection__rendered{
    display:flex !important;
    align-items:center;
    gap:2rem;
}

.select2-selection__rendered img{
    width:16px;
    height:16px;
}

.select2-search__field{
  display: block;
  color:#333333;
}

.select2-selection{
    text-transform: uppercase;
    font-weight: 500;
    display:flex !important;
    justify-content:center;
}

.select2-results__options li {
    color:#333333 !important; 
    text-transform: uppercase;
 
    font-size:16px;
}

.select2-results__options li span{
    display: flex;
    align-items:center;
}
.select2-results__options li span p{
   margin: 0;
}

.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
    background-color:#dd170ec2 !important;
    color: #fff !important;
}



.select2-container{
  width: 35% !important;
}

.select2-results__option{
    padding:1rem 1.5rem;
}

.select2-results__option .option-icon{
    margin-right: 1rem;
}

@media (max-width: 900px) {
    .select2-container {
      width: 75% !important;
    }
}

.fancybox-desktop .select2-container{
  width: 100% !important;
}

.select2-dropdown{
    z-index:9999;
    width:fit-content !important;
}

.fancybox-inner .totselectzone__row--head{
    color:#fff;
    background:#333333;
    border:none;
}
.fancybox-inner .totselectzone__row--odd {
    color:#000;
    background:none;
}

.fancybox-inner #totselectzone{
    padding:15px 20px;
}

</style>



<script>
// comecei aqui
// const selectCountryTitle = document.queryselectorAll(".select2-results__option span").innerText

$(document).ready(function() {
          $('#tot_zone_1').select2({
            templateResult: formatOption
          });
          
           $('#tot_zone_1').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', '{l s='Search your country' mod='totshippingpreview'}');
            });
          
          var selectfirst = document.querySelector('.select2-selection__rendered')
          
        
          function formatOption(option) {
            if (!option.id) {
              return option.text;
            }
        
            var icon = $(option.element).data('image');
            if(icon){
                var $option = $(
              '<span><img src="' + icon + '" class="option-icon" /> ' + '<p>' + option.text + '</p>' + '</span>'
            );
            }else {
                var $option = $('<span>' + option.text + '</span>')
            }
            
        
            return $option;
          }
          
          // Update the selected option with the flag image
          var selectedOption = $('#tot_zone_1').find(':selected');
          var selectedIcon = selectedOption.data('image');
          var selectedText = selectedOption.text();
          var selectedOptionHTML = '<img src="' + selectedIcon + '" class="option-icon" /> ' + selectedText;
          
          $('#tot_zone_1').siblings('.select2').find('.select2-selection__rendered').html(selectedOptionHTML);
          
          // When an option is selected, update the displayed text
          $('#tot_zone_1').on('select2:select', function(event) {
            var icon = event.params.data.element.dataset.image;
            var newText = '<img src="' + icon + '" class="option-icon" /> ' + event.params.data.text;
            $(this).siblings('.select2').find('.select2-selection__rendered').html(newText);
          });
        });
// acabei aqui

{literal}
document.addEventListener('DOMContentLoaded', function(){
	$('#availability_statut').after($('#js-totshippingpreview-container'));
    $('#availability_statut').after($('#totshippingpreview-info'));
    {/literal}

	if(jQuery().fancybox) {
		$('#totshippingpreview').fancybox({
			padding : 0
		});
	}
	
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
				$("#tot_zone_2").append('<option value="' + jsonData.data[i].id + '" data-id-zone="' + jsonData.data[i].id_zone + '"><img src="/img/flags/flag_' + jsonData.data[i].id_zone + '.jpg" width="20" height="15">' + jsonData.data[i].name + '</option>');
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
