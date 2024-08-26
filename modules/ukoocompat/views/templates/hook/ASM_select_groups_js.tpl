{assign var="context" value=Context::getContext()}
{assign var="idLang" value=2}
{* {$idLang} *}

<script>

    $(document).ready(function() {
        return ;
    });
    

    function call_ajax_fill_selects(index){
        id_lang = {$idLang};
        select_1 = 0;
        select_2 = 0;
        select_3 = 0;
        select_4 = 0;
       

        if($('#id_ukoocompat_criterion_select_groups_1').length) select_1 = $('#id_ukoocompat_criterion_select_groups_1').val();
        if($('#id_ukoocompat_criterion_select_groups_2').length) select_2 = $('#id_ukoocompat_criterion_select_groups_2').val();
        if($('#id_ukoocompat_criterion_select_groups_3').length) select_3 = $('#id_ukoocompat_criterion_select_groups_3').val();
        if($('#id_ukoocompat_criterion_select_groups_4').length) select_4 = $('#id_ukoocompat_criterion_select_groups_4').val();
        // if($('#id_lang').length) id_lang = $('#id_lang').val();
        
        if(index == 1){
            $('#id_ukoocompat_criterion_select_groups_2').prop('disabled', 'disabled');
            $('#id_ukoocompat_criterion_select_groups_3').prop('disabled', 'disabled');
            $('#id_ukoocompat_criterion_select_groups_4').prop('disabled', 'disabled');
        }
        
        if(index == 2){
            $('#id_ukoocompat_criterion_select_groups_3').prop('disabled', 'disabled');
            $('#id_ukoocompat_criterion_select_groups_4').prop('disabled', 'disabled');
        }
        
        if(index == 3){
            $('#id_ukoocompat_criterion_select_groups_4').prop('disabled', 'disabled');
        }
        
        $.ajax({
            url: "/modules/ukoocompat/views/templates/hook/getDataForNextSelect.php",
            type: "POST",
            async: true,
            data: {
                select_1,
                select_2,
                select_3,
                nextSelect: (parseInt(index) + parseInt(1)),
                id_lang
            },
            success: function (result) {
                if (result.length > 0 && index < 4) {
                    
                    if($('#id_ukoocompat_criterion_select_groups_' + (index + 1)).length){
                        $('#id_ukoocompat_criterion_select_groups_' + (index + 1)).replaceWith(result);
                        clean_other_selects(index);
                    }
                }
            }
        });
    }

    function clean_other_selects(index){

        if(index === 1){
            if($('#id_ukoocompat_criterion_select_groups_3').length){
                $('#id_ukoocompat_criterion_select_groups_' + 3).prop('value', "0");
                $('#id_ukoocompat_criterion_select_groups_' + 3).prop('readonly', "readonly");
            }

            if($('#id_ukoocompat_criterion_select_groups_4').length){
                $('#id_ukoocompat_criterion_select_groups_' + 4).prop('value', "0");
                $('#id_ukoocompat_criterion_select_groups_' + 4).prop('readonly', "readonly");
            }
        }
        
        if(index === 2){
            if($('#id_ukoocompat_criterion_select_groups_4').length) $('#id_ukoocompat_criterion_select_groups_' + 4).prop('value', "0");
        }

    }

    

    function save_compatibilities(){
        
        select_1 = 0;
        select_2 = 0;
        select_3 = 0;
        select_4 = 0;

        if($('#id_ukoocompat_criterion_select_groups_1').length) select_1 = $('#id_ukoocompat_criterion_select_groups_1').val();
        if($('#id_ukoocompat_criterion_select_groups_2').length) select_2 = $('#id_ukoocompat_criterion_select_groups_2').val();
        if($('#id_ukoocompat_criterion_select_groups_3').length) select_3 = $('#id_ukoocompat_criterion_select_groups_3').val();
        if($('#id_ukoocompat_criterion_select_groups_4').length) select_4 = $('#id_ukoocompat_criterion_select_groups_4').val();

        id_product = $('#id_product').val();

        $('#show_group_compats_message').toggle();

        $.ajax({
            url: "/modules/ukoocompat/views/templates/hook/saveCompatibilities.php",
            type: "POST",
            data: {
                select_1,
                select_2,
                select_3,
                select_4,
                id_product,
            },
            success: function(data){
            
                $('#show_group_compats_message').toggle();

                // var rowClass = 'id_compat_' + data.id_product;

                // var html = '<tr class="' + rowClass + '">';
                // html += '<input type="hidden" id="compatibility_number">';

                // html += '<td>';
                // html += '<input type="checkbox" name="delete_compats" value="' + data.checkboxValue + '">';
                // html += '</td>';

                // html += '<td>' + data.select_1 + '</td>';
                // html += '<td>' + data.select_2 + '</td>';
                // html += '<td>' + data.select_3 + '</td>';
                // html += '<td>' + data.select_4 + '</td>';

                // html += '</tr>';

                // // Now you can use the 'html' variable to append this row to your table
                // $('#module_ukoocompat').append(html);

                location.reload();

            }
        });
    }

</script>