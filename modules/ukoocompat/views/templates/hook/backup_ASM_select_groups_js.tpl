<script>

    $(document).ready(function() {

        $.ajax({
            url: "/modules/ukoocompat/views/templates/hook/getAllIdentedCategories.php",
            type: "POST",
            data: {
                id_lang: $('#id_lang').val(),
                id_category:$('#selected_category').val()
            },
            success: function(result){
                if(result.length > 0) {
                    $('#id_ukoocompat_criterion_select_groups_5').replaceWith(result);
                }
            }
        });
    });

    function call_ajax_fill_selects(index){

        select_1 = $('#id_ukoocompat_criterion_select_groups_1').val();
        select_2 = $('#id_ukoocompat_criterion_select_groups_2').val();
        select_3 = $('#id_ukoocompat_criterion_select_groups_3').val();
        select_4 = $('#id_ukoocompat_criterion_select_groups_4').val();
        id_lang = $('#id_lang').val();

        $.ajax({
            url: "/modules/ukoocompat/views/templates/hook/getDataForNextSelect.php",
            type: "POST",
            data: {
                select_1,
                select_2,
                select_3,
                nextSelect: (index + 1),
                id_lang
            },
            success: function (result) {
                if (result.length > 0 && index < 4) {
                    $('#id_ukoocompat_criterion_select_groups_' + (index + 1)).replaceWith(result);

                    clean_other_selects(index);
                }
            }
        });
    }

    function clean_other_selects(index){

        if(index === 1){
            $('#id_ukoocompat_criterion_select_groups_' + 3).prop('value', "0");
            $('#id_ukoocompat_criterion_select_groups_' + 3).prop('readonly', "readonly");
            $('#id_ukoocompat_criterion_select_groups_' + 4).prop('value', "0");
            $('#id_ukoocompat_criterion_select_groups_' + 4).prop('readonly', "readonly");
        }

        if(index === 2){
            $('#id_ukoocompat_criterion_select_groups_' + 4).prop('value', "0");
        }

    }

    function save_compatibilities(){

        select_1 = $('#id_ukoocompat_criterion_select_groups_1').val();
        select_2 = $('#id_ukoocompat_criterion_select_groups_2').val();
        select_3 = $('#id_ukoocompat_criterion_select_groups_3').val();
        select_4 = $('#id_ukoocompat_criterion_select_groups_4').val();
        select_5 = $('#id_ukoocompat_criterion_select_groups_5').val();
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
                select_5,
                id_product,
            },
            success: function(result){

                $('#show_group_compats_message').toggle();

                var obj = JSON.parse(result);

                if(obj.status) {
                    location.reload();
                }else{
                    alert(obj.message);
                }
            }
        });
    }

</script>