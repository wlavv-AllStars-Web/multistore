/**
 *
 */
 
 $(document).ready(function(){
	
	$(window).load(function(){
		if (typeof qtyData == 'undefined') return ;
		arrProduct = jQuery.parseJSON(qtyData);
	
		for (var id_po_product in arrProduct) {
			$("#"  + id_po_product).val(arrProduct[id_po_product].value);
		}
		
	});
	$(window).keypress(function(e) {
	  	bareCode(e);
	});	
	$("input[name^='qty'").change(function(){	
		var val = parseInt( $(this).val(),10);
		if(isNaN(val)) val = 0;
		if( val < 0 ) $(this).val(0);
			send($(this).attr('id'));
	});
});

function bareCode(event){
	
	
	if (event.keyCode == 13) {
		reset();

		$.ajax({
			type : 'POST',
			url : barecode_url,
			data : {
				'sku' : $('#barecode').val(),
				'id_po' : id_po
			},
			dataType : 'json',
			success : function($data) {
				if(!$data.result || !$data.ip_pop){
						setError();
				}else{
					setok();
                    $('#barecode').val($data.message);
					inc(1,$data.ip_pop,100)		
				}
			},
			error: function($data) {
				setError();
			}
		});
	}else{
		reset();
		$('#barecode').val($('#barecode').val() + event.key);
		
	}
	

}
function setError(){
	$('#barecode').css('color','rgb(255, 0, 0)'); //rouge
	$('#barecode').val(errorMessage +  ' ' + $('#barecode').val());
    document.getElementById("audio-wrong").play();
}
function setok(){
	$('#barecode').css('color','blue');
    document.getElementById("audio-correct").play();
}
function reset(){
		if( $('#barecode').css('color') != "rgb(85, 85, 85)"){ //si pas vert
			 $('#barecode').css('color','rgb(85, 85, 85)');
			 $('#barecode').val('');
		}
	
}
function changeQte(qte,sens,id,max){
	qte = parseInt(qte,10);
	max = parseInt(max,10);
	

	var val = parseInt( $("#"+id).val(),10);
	
	if(isNaN(val)) val = 0;
	if(isNaN(max)) max = 0;
	
	if(isNaN(qte)) return false;
	
	if(qte == 1){
		switch(sens){
			case "inc":
				$("#"+id).val( val+1 );
			break;
			case "dec":
				if( val > 0) $("#"+id).val(val-1);
			break;
		}
	}else{
		$("#"+id).val(qte);
	}

}