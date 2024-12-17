<script>
    let category_name='{l s="All"}';
    let manufacturer = '{l s="All"}';
    let orderBy_orderWay = '---';

    let url_string = document.URL;
    let url = new URL(url_string);

    let orderBy = 'position';
    let orderWay = 'asc';
    let orderParameters = 'position:asc';
    let nrItems = 20;
    let idCategory = {if isset($idCategory)} {$idcategory} {else} '' {/if};
    let idManufacturer = '';
    let news = 0;

    let deleteHtmlParameters = '';
    let deleteHtmlNrItems = '';
    let deleteHtmlManufacturers = '';
    let deleteHtmlCategory = '';

    function getDataFromUrl(){
        setDataFromUrl();
        check_ukoo_holder_after_ajax();
        setFiltersTitle();
    }

    function check_ukoo_holder_after_ajax(){
        setTimeout(function(){
            if($('.ajax_ukoo_response').length > 0){
                ajax_has_loaded = 1;
                setUkooData();
                setSelectedOptions();
                setFiltersTitle();
            }else{
                check_ukoo_holder_after_ajax()
            }
        }, 1000);
    }

    function setUkooData() {
        setOrderParametersFromURL();
        setNrItemsFromURL();
        setCategoryFromURL();
        setManufacturerFromURL();
        setNewsFromURL();
    }

    function setDataFromUrl(){
        if(url.searchParams.get("orderby")) orderBy = url.searchParams.get("orderby");
        if(url.searchParams.get("orderway")) orderWay = url.searchParams.get("orderway");
        if(url.searchParams.get("n")){
            nrItems= url.searchParams.get("n");
            $('#multiFilter_n_items').val(nrItems);
            $('#multiFilter_nr_items').val(nrItems);
        }
        if(url.searchParams.get("id_manufacturer_layered")) idManufacturer = url.searchParams.get("id_manufacturer_layered");
        if(url.searchParams.get("id_category_layered")){
            idCategory = url.searchParams.get("id_category_layered");
            $('#multiFilter_id_category').val(idCategory);
        }
        if(url.searchParams.get("news")) news = url.searchParams.get("news");
        
        orderParameters = $('.products-sort-order .dropdown-menu .current').attr('value');
        
        setOrderBy( orderBy );
        setOrientation( orderWay );
        
        if ( orderBy === undefined) {
            var e = document.getElementById("selectProductSort");
            var value = e.value;
            var text = e.options[e.selectedIndex].text;
            var options = text.split(":");
            orderBy = options[0];
            orderWay = options[1];
        }
    }

    function setFiltersTitle(){
        
        idCategory = $('#multiFilter_id_category').val();

        let deleteHtmlParameters = '';
        let deleteHtmlNrItems = '';
        let deleteHtmlManufacturers = '';
        let deleteHtmlCategory = '';
        
        orderParameters = $('.products-sort-order .dropdown-menu .current').attr('value');
        
        if( $('.products-sort-order .dropdown-menu .current').length ) deleteHtmlParameters = deleteHtml('removeOrderParametersAndReload');

        if( nrItems != 20) deleteHtmlNrItems = deleteHtml('removeItemPerPageParametersAndReload');
        if( !($('body#manufacturer').length > 0) && (idManufacturer)) deleteHtmlManufacturers = deleteHtml('removeManufacturerParametersAndReload');
        if( !($('body#category').length > 0) && (idCategory > 0)){

            if($('#current_car_settings').length){
                deleteHtmlCategory = deleteHtml('removeCategoryParametersAndReloadUkoo');
            }else{
                deleteHtmlCategory = deleteHtml('removeCategoryParametersAndReload');
            }
 
        }
        $('#name_sort_by').html('{l s="Sort By"} <span style="color:#444;font-size: 0.85rem;">' + $('.products-sort-order .dropdown-menu .current').text() + '</span>' + deleteHtmlParameters);
        $('#name_items_per_page').html('<b style="color:red;">' + nrItems + '</b><span style="color: #444;font-size: 0.85rem;"> {l s="Per Page"}</span>' + deleteHtmlNrItems);

        if ($('body#category').length > 0) {
            category_name = document.querySelector("nav.breadcrumb li:last-child a span").textContent
            idCategory =  $('[name="id_category_layered"]').val();
        }else{
            category_name = $('#category_element_' + idCategory).text();
        }
        // console.log(deleteHtmlCategory)
        $('#name_category').html('{l s="By Category"} <span style="color:#444;">' + category_name + '</span>' + deleteHtmlCategory);

        if ($('body#manufacturer').length > 0) { manufacturer = $('#id_current_manufacturer_name').val();
        }else{
            manufacturer = $('#manufacturer_' + idManufacturer).text();
        }
        $('#name_brand').html(deleteHtmlManufacturers + '{l s="By Brand"} <span style="color:#444;">' + manufacturer + '</span>');

        if(news == 1){
            $('#multiFilter_news').val(1);
            $('#news_items_news').addClass('switch_active');
            $('#news_items_all').removeClass('switch_active');
            // $('.breadcrumb ').html('<div class="breadcrumb clearfix"><a class="home" href="/"> <i class="fa fa-home"></i> </a> <span style="margin-left:15px">{l s="New products"}</span></div>');
        }else {

            if (url.searchParams.get("news") == null && ($('body#new-products').length > 0)) {
                $('#multiFilter_news').val(1);
                $('#news_items_news').addClass('switch_active');
                $('#news_items_all').removeClass('switch_active');
                // $('.breadcrumb ').html('<div class="breadcrumb clearfix"><a class="home" href="/"> <i class="fa fa-home"></i> </a> <span style="margin-left:15px">{l s="New products"}</span></div>');
            } else {
                $('#multiFilter_news').val(0);
                $('#news_items_news').removeClass('switch_active');
                $('#news_items_all').addClass('switch_active');
                // $('.breadcrumb ').html('<div class="breadcrumb clearfix"><a class="home" href="/"> <i class="fa fa-home"></i> </a> <span style="margin-left:15px">{l s="All products"}</span></div>');
            }
        }
    }

    function setSelectedOptions() {
        $('#category_element_' + idCategory).css('background-color', '#0078D7').css('color', 'white').css('padding', '10px');
        $('#manufacturer_' + idManufacturer).addClass('li_active');
    }

    function setOrderParametersFromURL(){
        $('#multiFilter_order_by').val(orderBy);
        $('#multiFilter_order_by_orientation').val(orderWay);
        $('#selectProductSort').val(orderBy + ':' + orderWay);
    }

    function setNrItemsFromURL(){
        $('#multiFilter_nr_items').val(nrItems);
        $("#nb_item").val(nrItems);
    }
    
    function setCategoryFromURL() {
        
        alert(idCategory);
        if($('body#category').length > 0) idCategory = $('#id_current_category').val();
        
        if( $('#multiFilter_id_category').val() > 0){
            
        }else{
            $('#multiFilter_id_category').val(idCategory);
            $('#id_category_layered').val(idCategory);            
        }

    }

    function setManufacturerFromURL(){
        if($('body#manufacturer').length > 0) idManufacturer = $('#id_current_manufacturer').val();
        
        if( $('#multiFilter_id_manufacturer').val() > 0){
            
        }else{
            $('#multiFilter_id_manufacturer').val(idManufacturer);
            $('[name="id_manufacturer"]').val(idManufacturer);
        }
    
    }

    function setNewsFromURL(){
	    if($('body#new-products').length > 0) news = 1;
        $('#multiFilter_news').val(news);
    }

    function deleteHtml(functionName){
        return '<div onclick="' + functionName + '()" class="pull-left remove_filter_fa_holder"><i class="fa fa-times remove_filter_fa" aria-hidden="true"></i></div>';
    }
</script>
