
{assign var="currentShop" value=Context::getContext()->shop->id}
{if $banners[5]['active'] == '1'}
   {assign var='bb' value=$banners[5]['image_en']}
   {/if}
{if $banners[4]['active'] == '1'}
   {assign var='bb' value=$banners[4]['image_en']}
   {/if}
{if $banners[3]['active'] == '1'}
   {assign var='bb' value=$banners[3]['image_en']}
   {/if}
   {if $banners[2]['active'] == '1'}
   {assign var='bb' value=$banners[2]['image_en']}
   {/if}
{if $banners[1]['active'] == '1'}
   {assign var='bb' value=$banners[1]['image_en']}
   {/if}
{if $banners[0]['active'] == '1'}
   {assign var='bb' value=$banners[0]['image_en']}
   {/if}
{if $currentShop ==1}
    <h1 style="text-transform: uppercase;font-weight:bold;color:dodgerblue;">Euromuscle</h1>
{elseif $currentShop ==2}
    <h1 style="text-transform: uppercase;font-weight:bold;color:#ee302e;">All Stars Motorsport</h1>
{elseif $currentShop ==3}
    <h1 style="text-transform: uppercase;font-weight:bold;color:dodgerblue;">All Stars Distribution</h1>
{elseif $currentShop ==6}
    <h1 style="text-transform: uppercase;font-weight:bold;color:#01a547;">EuroRider</h1>
{else}
    <h1>Escolhe um Site</h1>
{/if}
{if $currentShop ==1 || $currentShop ==2 || $currentShop == 6}
   <div style="display: flow-root;" id="abas_container">
    <div class="desktop_mobile_container" style="cursor: pointer;border-radius: 10px 0 0 0;background-color: dodgerblue; color: #fff;width:50%;float: left; border: 1px solid #777;padding: 10px;font-weight: bolder; font-size:40px;text-align: center;" onclick="$('.desktop_mobile_container').css('background-color', 'grey');$(this).css('background-color', 'dodgerblue');$('#desktop_layer_container').toggle();$('#mobile_layer_container').toggle();">
        DESKTOP
    </div>
    <div class="desktop_mobile_container" style="cursor: pointer;border-radius: 0 10px 0 0;background-color: grey; color: #fff;width:50%;float: left; border: 1px solid #777;padding: 10px;font-weight: bolder; font-size:40px;text-align: center;" onclick="$('.desktop_mobile_container').css('background-color', 'grey');$(this).css('background-color', 'dodgerblue');$('#desktop_layer_container').toggle();$('#mobile_layer_container').toggle();">
        MOBILE
    </div>
</div>
<div id="desktop_layer_container" style="display: block;padding:0 10px;background-color: #ddd;border: 1px solid #777;">
    {include file="$modules/wmmodule_homepage/views/templates/admin/desktop.tpl"}
</div>

<div id="mobile_layer_container"  style="display: none;padding:0 10px;background-color: #ddd;border: 1px solid #777;">
    {include file="$modules/wmmodule_homepage/views/templates/admin/mobile.tpl"}
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel" style="text-align: center;padding: 0;margin: 0;">Modal title</h2>
      </div>
      <div class="modal-body">
          <div id="modal_container"> </div>
      </div>
      <div class="modal-footer">
        <button id="setImageButton" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
<style>
    .page-title{ padding-left: 150px; }
    #select_car_1,#select_car_2,#select_car_3,#select_car_4,#select_car_5,#select_car_6{ display:none; }
</style>

<script>

    $("#select_brand_1").on("change",   function () { setModal(1,  1, $(this), 'manufacturer' ) });
    $("#select_brand_2").on("change",   function () { setModal(2,  1, $(this), 'manufacturer' ) });
    $("#select_brand_3").on("change",   function () { setModal(3,  1, $(this), 'manufacturer' ) });
    $("#select_brand_4").on("change",   function () { setModal(4,  1, $(this), 'manufacturer' ) });
    $("#select_brand_5").on("change",   function () { setModal(5,  1, $(this), 'manufacturer' ) });
    $("#select_brand_6").on("change",   function () { setModal(6,  1, $(this), 'manufacturer' ) });
    $("#select_brand_7").on("change",   function () { setModal(7,  1, $(this), 'manufacturer' ) });
    $("#select_brand_8").on("change",   function () { setModal(8,  1, $(this), 'manufacturer' ) });
    $("#select_brand_9").on("change",   function () { setModal(9,  1, $(this), 'manufacturer' ) });
    $("#select_brand_10").on("change",  function () { setModal(10, 1, $(this), 'manufacturer' ) });
    $("#select_brand_11").on("change",  function () { setModal(11, 2, $(this), 'manufacturer' ) });
    $("#select_brand_12").on("change",  function () { setModal(12, 2, $(this), 'manufacturer' ) });
    $("#select_brand_13").on("change",  function () { setModal(13, 3, $(this), 'manufacturer' ) });
    $("#select_brand_14").on("change",  function () { setModal(14, 3, $(this), 'manufacturer' ) });
    $("#select_brand_15").on("change",  function () { setModal(15, 3, $(this), 'manufacturer' ) });
    $("#select_brand_19").on("change",  function () { setModal(19, 5, $(this), 'manufacturer' ) });
    $("#select_brand_20").on("change",  function () { setModal(20, 5, $(this), 'manufacturer' ) });
    $("#select_brand_21").on("change",  function () { setModal(21, 5, $(this), 'manufacturer' ) });
    $("#select_brand_22").on("change",  function () { setModal(22, 5, $(this), 'manufacturer' ) });
    $("#select_brand_23").on("change",  function () { setModal(23, 5, $(this), 'manufacturer' ) });

    $("#select_car_1").on("change",   function () { setModal(1,  1, $(this), 'compatibility' ) });
    $("#select_car_2").on("change",   function () { setModal(2,  1, $(this), 'compatibility' ) });
    $("#select_car_3").on("change",   function () { setModal(3,  1, $(this), 'compatibility' ) });
    $("#select_car_4").on("change",   function () { setModal(4,  1, $(this), 'compatibility' ) });
    $("#select_car_5").on("change",   function () { setModal(5,  1, $(this), 'compatibility' ) });
    $("#select_car_6").on("change",   function () { setModal(6,  1, $(this), 'compatibility' ) });
    $("#select_car_7").on("change",   function () { setModal(7,  1, $(this), 'compatibility' ) });
    $("#select_car_8").on("change",   function () { setModal(8,  1, $(this), 'compatibility' ) });
    $("#select_car_9").on("change",   function () { setModal(9,  1, $(this), 'compatibility' ) });
    $("#select_car_10").on("change",  function () { setModal(10, 1, $(this), 'compatibility' ) });
    $("#select_car_11").on("change",  function () { setModal(11, 2, $(this), 'compatibility' ) });
    $("#select_car_12").on("change",  function () { setModal(12, 2, $(this), 'compatibility' ) });
    $("#select_car_13").on("change",  function () { setModal(13, 3, $(this), 'compatibility' ) });
    $("#select_car_14").on("change",  function () { setModal(14, 3, $(this), 'compatibility' ) });
    $("#select_car_15").on("change",  function () { setModal(15, 3, $(this), 'compatibility' ) });
    $("#select_car_19").on("change",  function () { setModal(19, 5, $(this), 'compatibility' ) });
    $("#select_car_20").on("change",  function () { setModal(20, 5, $(this), 'compatibility' ) });
    $("#select_car_21").on("change",  function () { setModal(21, 5, $(this), 'compatibility' ) });
    $("#select_car_22").on("change",  function () { setModal(22, 5, $(this), 'compatibility' ) });
    $("#select_car_23").on("change",  function () { setModal(23, 5, $(this), 'compatibility' ) });
    
    
    $("#select_mini_13").on("change",  function () { setModal(13, 3, $(this), 'miniature' ) });
    $("#select_mini_14").on("change",  function () { setModal(14, 3, $(this), 'miniature' ) });
    $("#select_mini_15").on("change",  function () { setModal(15, 3, $(this), 'miniature' ) });

    $("#select_mini_29").on("change",  function () { setModal(29, 3, $(this), 'miniature') });
    $("#select_mini_30").on("change",  function () { setModal(30, 3, $(this), 'miniature' ) });
    $("#select_mini_31").on("change",  function () { setModal(31, 3, $(this), 'miniature' ) });

    $("#select_mini_32").on("change",  function () { setModal(32, 3, $(this), 'miniature' ) });
    $("#select_mini_33").on("change",  function () { setModal(33, 3, $(this), 'miniature' ) });
    $("#select_mini_34").on("change",  function () { setModal(34, 3, $(this), 'miniature' ) });


    $("#select_brand_55").on("change",   function () { setModal(55,  1, $(this), 'manufacturer' ) });
    $("#select_brand_56").on("change",   function () { setModal(56,  1, $(this), 'manufacturer' ) });
    $("#select_brand_57").on("change",   function () { setModal(57,  1, $(this), 'manufacturer' ) });
    $("#select_brand_58").on("change",   function () { setModal(58,  1, $(this), 'manufacturer' ) });
    $("#select_brand_59").on("change",   function () { setModal(59,  1, $(this), 'manufacturer' ) });
    $("#select_brand_60").on("change",   function () { setModal(60,  1, $(this), 'manufacturer' ) });

    $("#select_car_55").on("change",   function () { setModal(55,  1, $(this), 'compatibility' ) });
    $("#select_car_56").on("change",   function () { setModal(56,  1, $(this), 'compatibility' ) });
    $("#select_car_57").on("change",   function () { setModal(57,  1, $(this), 'compatibility' ) });
    $("#select_car_58").on("change",   function () { setModal(58,  1, $(this), 'compatibility' ) });
    $("#select_car_59").on("change",   function () { setModal(59,  1, $(this), 'compatibility' ) });
    $("#select_car_60").on("change",   function () { setModal(60,  1, $(this), 'compatibility' ) });

    $("#select_mini_61").on("change",  function () { setModal(61, 3, $(this), 'miniature' ) });
    $("#select_mini_62").on("change",  function () { setModal(62, 3, $(this), 'miniature' ) });
    $("#select_mini_63").on("change",  function () { setModal(63, 3, $(this), 'miniature' ) });
    $("#select_mini_64").on("change",  function () { setModal(64, 3, $(this), 'miniature' ) });
    
    
    
    $(document).on("click","#uploadSubmitButton", function(){
        var dataForm = new FormData($('#uploadForm')[0]);

		$.ajax({
			type : 'POST',
			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=uploadSubmitButton",
			data : dataForm,
            processData: false,
            contentType: false,
			success : function(data) {
			    let data_modal = JSON.parse(data);
			    $('#exampleModalLabel').html(data_modal.modal_title);
			    $('#modal_container').html(data_modal.modal_content);
			}
		});
		
    });
    
    function addCheck(imadeID, index){
        $('#'+imadeID).prop('src', '/modules/wmmodule_homepage/views/images/check_upload_'+index+'.gif');
    }
    
    function setModal(id_image, type, selectElement, element, id_shop){

        let id_element = 0;
        
        

        if(element === undefined){

            if($('#select_brand_' + id_image).val() == ''){
                element = 'compatibility';
                id_element = $('#select_car_' + id_image).val();
            }else if($('#select_car_' + id_image).val() == ''){
                element = 'manufacturer';

                let elementComponent = selectElement.val();
                let element_array = elementComponent.split("_");
                id_element = element_array[0];
            }else{
                console.log("aqui")
                element = 'video';
                if(id_image == 16) id_element = 1;
                if(id_image == 17) id_element = 2;
                if(id_image == 18) id_element = 3;
                if(id_image == 46) id_element = 1;
                if(id_image == 47) id_element = 2;
                if(id_image == 48) id_element = 3;

                if(id_image == 65) id_element = 1;
                if(id_image == 66) id_element = 2;
                if(id_image == 67) id_element = 3;
            }
        }else if(element === 'manufacturer'){
            document.getElementById('select_car_' + id_image).selectedIndex = 0;
            id_element = $('#select_brand_' + id_image).val();
        }else if(element === 'miniature' && id_shop == 1){
            document.getElementById('select_mini_' + id_image).selectedIndex = 1;
            id_element = $('#select_mini_' + id_image).attr("inputparentcard");
        }else if(element === 'compatibility'){
            id_element = $('#select_car_' + id_image).val();
        }else{
            document.getElementById('select_brand_' + id_image).selectedIndex = 0;
            id_element = $('#select_car_' + id_image).val();
        }
        
        // console.log(element)
        
		$.ajax({
			type : 'POST',
			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=getBrandImages",
			data : {
				'id_element' : id_element,
				'type' : type,
				'id_image' : id_image,
				'element' : element,
                'id_shop': id_shop,
                'id_compat': element === 'compatibility' ? id_element : 0
			},
			success : function(data) {
			    let data_modal = JSON.parse(data);
			    $('#exampleModalLabel').html(data_modal.modal_title);
			    $('#modal_container').html(data_modal.modal_content);
			}
		});
        
        modal = $('#exampleModal');
        modal.modal('show');
    }
    
    function ativa(qq){
        var checkbox = document.getElementById(qq);
        var att = 3;
        var numero = qq.replace("ativo_", "");

        // Verifica se a checkbox está marcada
        if (checkbox.checked) {
            att = 1;
        } else {
            att = 0;
        }
			$.ajax({
			type : 'POST',
			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=updateActive",
			data : {
				'id' : numero,
				'ativo' : att
			},
			success : function(data) { location.reload(); }
		});
		
    }

    function setImageText(sel, index, element){

        let imageText = $(sel).find('option:selected').text();

        document.getElementById("title_en_" + index).value = imageText;
        document.getElementById("title_es_" + index).value = imageText;
        document.getElementById("title_fr_" + index).value = imageText;
        return;
    }
    
    function setImage(id_zone, id_image, url, homepage_manufacturer_id, homepage_manufacturer_id_manufacturer, id_compat=0){
        // const linkProduct = document.getElementById("link_"+ id_image).innerText;
        // console.log(linkProduct)
		$.ajax({
			type : 'POST',
			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=updateHomepageTemp",
			data : {
				'id_zone' : id_zone,
				'id_image' : id_image,
				'url' : url,
				'id_ps_asm_homepage_temp' : homepage_manufacturer_id,
				'id_element' : homepage_manufacturer_id_manufacturer,
				'title_en' : $('#title_en_' + id_image).val(),
				'title_es' : $('#title_es_' + id_image).val(),
				'title_fr' : $('#title_fr_' + id_image).val(),
                'linkProduct' : $('#link_'+ id_image).val(),
                'id_compat' : id_compat
			},
			success : function(data) { }
		});
		
        $('#image_' + id_image).prop('src', url);
        $('#homepage_manufacturer_id_' + id_image).prop('value', homepage_manufacturer_id);
        $('#homepage_manufacturer_id_manufacturer_' + id_image).prop('value', homepage_manufacturer_id_manufacturer);
        
        $('#preview_image_' + id_image).prop('src', url);

        $('#setImageButton').click();
    }

    function deleteImage(id_zone, id_image, url, homepage_manufacturer_id, homepage_manufacturer_id_manufacturer,clickedElement){

        if(homepage_manufacturer_id_manufacturer === 0) {

        $.ajax({
                    type : 'POST',
                    url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=deleteImgButton",
                    data : {
                        'id_zone' : id_zone,
                        'id_image' : id_image,
                        'url' : url,
                        'id_ps_asm_homepage_temp' : homepage_manufacturer_id,
                        'title_en' : $('#title_en_' + id_image).val(),
                        'title_es' : $('#title_es_' + id_image).val(),
                        'title_fr' : $('#title_fr_' + id_image).val()
                    },
                    success : function(data) { 
             
                        
                    }
                });
                $(".modal .image_container img[src='"+url+"']").parent().fadeOut()
                
        }else{
            $.ajax({
                    type : 'POST',
                    url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=deleteImgButton",
                    data : {
                        'id_zone' : id_zone,
                        'id_image' : id_image,
                        'url' : url,
                        'id_ps_asm_homepage_temp' : homepage_manufacturer_id,
                        'id_element' : homepage_manufacturer_id_manufacturer,
                        'title_en' : $('#title_en_' + id_image).val(),
                        'title_es' : $('#title_es_' + id_image).val(),
                        'title_fr' : $('#title_fr_' + id_image).val()
                    },
                    success : function(data) { 
                     
                    }
                });
                $(".modal .image_container img[src='"+url+"']").parent().fadeOut()
        }
		
    }


    function setIdProduct(element,id_element) {
        const linkProduct = $('#link_'+ id_element).val()
        console.log("idProduto->"+linkProduct)
        console.log("idProduto->"+$("#select_car_"+id_element).find('option:selected').text())
        
        $("#select_car_"+id_element).val("").change();
    }

    function setIdToZero(element,id_element) {
        $('#link_'+ id_element).val(0)
        setImageText(element, id_element, `select_car_{$id_element}`)
    }
    
    function saveDesktopLive(){
        
        var resposta = confirm("Pretende colocar as definições da Homepage, versão desktop live?");
        
        if (resposta) {
    		$.ajax({
    			type : 'POST',
    			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=setDesktopLive",
    			data : { },
    			success : function(data) { alert("As alterações foram aplicadas em desktop."); location.reload();}
    		});
        } else {
          console.log("Nenhuma alteração foi aplicada.");
        }
    }
    
    function saveMobileLive(){
        
        var resposta = confirm("Pretende colocar as definições da Homepage, versão mobile live?");
        
        if (resposta) {
    		$.ajax({
    			type : 'POST',
    			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=setMobileLive",
    			data : { },
    			success : function(data) { alert("As alterações foram aplicadas em mobile.");location.reload(); }
    		});
        } else {
          console.log("Nenhuma alteração foi aplicada.");
        }
    }
    
    function saveVideoCode(element, position){
	    $.ajax({
			type : 'POST',
			url : "{$httpssl}//{$dominio}/{$back_path}/index.php?controller=AdminWmModuleHomepage&token={Tools::getAdminTokenLite('AdminWmModuleHomepage')}&action=updateVideoCode",
			data : {
				'position' : position,
				'code' : element.value
			},
			success : function(data) { }
		});
		
    }
</script>

{else}
    <h1>Only works in EUROMUSCLE AND ALL STARS MOTORSPORT</h1>
{/if}