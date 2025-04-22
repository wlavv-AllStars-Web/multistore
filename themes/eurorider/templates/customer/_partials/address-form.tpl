{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 <div class="js-address-form">
 {include file='_partials/form-errors.tpl' errors=$errors['']}

 <form
   method="POST"
   action="{url entity='address' params=['id_address' => $id_address]}"
   data-id-address="{$id_address}"
   data-refresh-url="{url entity='address' params=['ajax' => 1, 'action' => 'addressForm']}"
 >
   <section class="form-fields">
     {block name='form_fields'}
       {foreach from=$formFields item="field"}
         {* <pre>{$formFields|print_r}</pre> *}
         {block name='form_field'}
           {form_field field=$field}
         {/block}
       {/foreach}
     {/block}
   </section>

   <footer class="form-footer {if $page.page_name == 'address'}col-lg-12 {/if} clearfix">
     <div class="col-md-4"></div>

     <div class="col-md-4" style="display: flex;justify-content: center;">
       <input type="hidden" name="submitAddress" value="1">
       {block name='form_buttons'}
         <button class="btn btn-outline-primary pull-xs-right" type="submit" class="form-control-submit">
           {l s='Save' d='Shop.Theme.Actions'}
         </button>
       {/block}
     </div>

     <div class="col-md-4"></div>
   </footer>
 </form>
</div>

<script>
// if(document.querySelector("body#address")){
 $(document).ready(function () {
   let vat_numberEl = document.querySelector("input[name='vat_number']");

   if (vat_numberEl && vat_numberEl.value.trim() !== "") {
       vat_numberEl.setAttribute("readonly", "true");
       document.querySelector("select[name='id_country']").style.pointerEvents = 'none';
   }


 if (vat_numberEl && !vat_numberEl.hasAttribute("data-initialized") && !vat_numberEl.value.trim() !== "") {
   vat_numberEl.setAttribute("data-initialized", "true");

   // vat_numberEl.classList.add("clean_vat_number");
   // console.log("vat_number");
   document.querySelector("select[name='id_country']").setAttribute("readonly","true")

   vat_numberEl.addEventListener("focusout", (e) => {
     setCountryByVATNumber(e.target.value);
   });
 }

 // $('.clean_vat_number').val('');
 // $('.clean_vat_number').value = '';
});


 function setCountryByVATNumber(vatNumber){
   // console.log("setcountrybyvat")


     $('select option').show();
     
     $("select[name='id_country']").attr("readonly", false);

     $("select[name='id_country']").css('pointer-events', 'initial');

     let country_iso_code = '';

     if (!hasNumber(vatNumber.substring(0, 3))) {
         country_iso_code = vatNumber.substring(0, 3);
     } else if (!hasNumber(vatNumber.substring(0, 2))) {
         country_iso_code = vatNumber.substring(0, 2);
     }else{
       document.querySelector("select[name='id_country']").removeAttribute("disabled")
     }

     
     country_iso_code = country_iso_code.toUpperCase();

     // console.log(country_iso_code)
     let country_id = ''
     let call_prefix = ''

     if( !hasNumber(country_iso_code) ){
       $.ajax({
           url: '{url entity='address'}', // Replace with your endpoint
           type: 'POST',
           data: { iso_codeAddress: country_iso_code },
           success: function(response) {
             console.log(response)
               // Adjust based on server response
               country_id = response.country_id; 
               call_prefix = response.call_prefix;
               // console.log("Country ID:", country_id);

               if (country_id) {
                   // let id_country = $('select[name="id_country"] option[value="' + country_id + '"]').val();

                   if (country_iso_code === 'PT') {
                       $('select option[mytag!=351]').hide();
                   } else if (country_iso_code === 'FR') {
                       $('select option[mytag!=33]').hide();
                   } else if (country_iso_code === 'ES') {
                       $('select option[mytag!=34]').hide();
                   } else {
                       // document.querySelector("select[name='id_country']").setAttribute("disabled","disabled")
                   }
                   // document.querySelector("select[name='id_country']").setAttribute("disabled","disabled")
                   $("select[name='id_country']").val(country_id).change();
                   $("input[name='phone']").val(call_prefix);

                   
                   // checkVat();
                   

               } else {
                   console.warn("Invalid country ISO code or no matching country ID found.");
                   // document.querySelector("select[name='id_country']").removeAttribute("disabled")
                   $('.clean_vat_number').val('');
                   $('.clean_vat_number').value = '';
               }


           },
           error: function(xhr, status, error) {
               console.error("AJAX Error:", status, error);
           }
         })
         
     
     }
 }

 // function checkVat() {
 //   $.ajax({
 // 	  type: "POST",
 // 	  dataType: 'text',
 // 	  headers: { "cache-control": "no-cache" },
 // 	  url: '{url entity='my-account'}',
 // 	  data: {
 // 		  'action' : 'check_vat',
 // 		  'vatnumber' : $('input[name="vat_number"]').val().toUpperCase()
 // 	  },
 // 	  success: function(msg){
       
 // 		if(msg == 1){
 // 			$('input[name="vat_number"]').css('border-color', 'black'); 
 // 			$('input[name="vat_number"]').next('button').prop('disabled', false);
 // 		}else{
 // 			$('input[name="vat_number"]').css('outline', '2px solid red'); 
 // 			// alert("Inserted VAT Number is invalid for your country, please verify!");
 // 			// $('input[name="vat_number"]').next('button').prop('disabled', true);   
 // 			// $('input[name="vat_number"]').value = "";   
 // 			// $('input[name="vat_number"]').attr('value', '');  
 // 		}
 // 	  }
 // });
 // }
 
 function hasNumber(myString) { return /\d/.test(myString); }
</script>