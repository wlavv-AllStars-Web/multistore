<script>
    let category_name='{l s="All" d="Shop.Theme.GetdataFilters"}';
    let manufacturer = '{l s="All" d="Shop.Theme.GetdataFilters"}';
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
        
        if(document.querySelector("body#manufacturer")){
            // Get the current URL dynamically
            const url = window.location.href;
    
            // Extract the part of the path after "/brand/"
            const regex = /\/brand\/(\d+)-([\w-]+)/;
            const match = url.match(regex);
    
            if (match) {
                const id = match[1];
                const brand = match[2];
                document.querySelector("#name_brand span").style.textTransform = "capitalize"
                document.querySelector("#name_brand span").innerText = brand
            }
        }

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

        if(url.searchParams.get("id_compat")) id_compat = url.searchParams.get("id_compat");
        if(url.searchParams.get("orderby")) orderBy = url.searchParams.get("orderby");
        if(url.searchParams.get("orderway")) orderWay = url.searchParams.get("orderway");
        if(url.searchParams.get("n")){
            nrItems= url.searchParams.get("n");
            $('#multiFilter_n_items').val(nrItems);
            $('#multiFilter_nr_items').val(nrItems);
        }
        if(url.searchParams.get("id_manufacturer_layered")){
             idManufacturer = url.searchParams.get("id_manufacturer_layered");
             $('#multiFilter_id_manufacturer').val(idManufacturer); 
        }
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

            // if($('#current_car_settings').length){
            //     deleteHtmlCategory = deleteHtml('removeCategoryParametersAndReloadUkoo');
            // }else{
                deleteHtmlCategory = deleteHtml('removeCategoryParametersAndReload');
            // }
 
        }
        $('.filters-desktop #name_sort_by').html(deleteHtmlParameters + '{l s="Sort By" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">' + $('.products-sort-order .dropdown-menu .current').text() + '</span>');
        $('.filters-mobile #name_sort_by').html(deleteHtmlParameters + '{l s="Sort By" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">' + $('.products-sort-order .dropdown-menu .current').text() + '</span>');
        
        $('.filters-desktop #name_items_per_page').html(deleteHtmlNrItems + '{l s="Per Page" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">'+ nrItems + '</span>');
        $('.filters-mobile #name_items_per_page').html(deleteHtmlNrItems + '{l s="Per Page" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">'+ nrItems + '</span>');

        if ($('body#category').length > 0) {
            category_name = document.querySelector("nav.breadcrumb li:last-child span").textContent
            idCategory =  $('[name="id_category_layered"]').val();
        }else{
                category_name = $('[onclick="setCategory(' + idCategory + ', this)"]').text();
            //     category_name = $('#category_element_' + idCategory).text();
        }
        // console.log(deleteHtmlCategory)
        $('.filters-desktop #name_category').html(deleteHtmlCategory + '{l s="By Category" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">' + category_name + '</span>');
        $('.filters-mobile #name_category').html(deleteHtmlCategory + '{l s="By Category" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">' + category_name + '</span>');

        if ($('body#manufacturer').length > 0) { manufacturer = $('#id_current_manufacturer_name').val();
        }else{
            manufacturer = $('#manufacturer_' + idManufacturer).text();
        }
        $('.filters-desktop #name_brand').html(deleteHtmlManufacturers + '{l s="By Brand" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">' + manufacturer + '</span>');
        $('.filters-mobile #name_brand').html(deleteHtmlManufacturers + '{l s="By Brand" d="Shop.Theme.SortOrders"} <span style="var(--euromus-color-300);font-size: 0.85rem;">' + manufacturer + '</span>');

        if(news == 1){
            $('#multiFilter_news').val(1);
            $('#news_items_news').addClass('switch_active');
            $('#news_items_all').removeClass('switch_active');
            // $('.breadcrumb ').html('<div class="breadcrumb clearfix"><a class="home" href="/"> <i class="fa fa-home"></i> </a> <span style="margin-left:15px">{l s="New products" d="Shop.Theme.GetdataFilters"}</span></div>');
        }else {

            if (url.searchParams.get("news") == null && ($('body#new-products').length > 0)) {
                $('#multiFilter_news').val(1);
                $('#news_items_news').addClass('switch_active');
                $('#news_items_all').removeClass('switch_active');
                // $('.breadcrumb ').html('<div class="breadcrumb clearfix"><a class="home" href="/"> <i class="fa fa-home"></i> </a> <span style="margin-left:15px">{l s="New products" d="Shop.Theme.GetdataFilters"}</span></div>');
            } else {
                $('#multiFilter_news').val(0);
                $('#news_items_news').removeClass('switch_active');
                $('#news_items_all').addClass('switch_active');
                // $('.breadcrumb ').html('<div class="breadcrumb clearfix"><a class="home" href="/"> <i class="fa fa-home"></i> </a> <span style="margin-left:15px">{l s="All products" d="Shop.Theme.GetdataFilters"}</span></div>');
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
        if($('body#new-products').length > 0) {
            news = 1;  // Set value of news
        }
        $('#multiFilter_news').val(news);
    }

    function deleteHtml(functionName){
        return '<div onclick="' + functionName + '(event)" class="pull-left btn-remove-filter-wheel"><i class="material-icons" translate="no">cancel</i></div>';
    }
</script>
