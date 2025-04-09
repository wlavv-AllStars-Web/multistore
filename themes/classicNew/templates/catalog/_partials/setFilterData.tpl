<script defer="defer">
    function setOrder(element) {
        console.log(element)
        const elementValue = element.getAttribute("value")
        let parameters = string_splitter(elementValue, ":");
        setOrderBy(parameters[0]);
        setOrientation(parameters[1]);
        setName($('#name_sort_by'), '{l s="Sort By" d="Shop.Theme.SortOrders"}', $( "#selectProductSort option:selected" ).text());
        doSearch();
    }

    function setManufacturer(element, idManufacturer) {
        console.log(element);
        $('#temp_multiFilter_id_manufacturer').val(idManufacturer);
        $('#multiFilter_id_manufacturer').val(idManufacturer);
        setName($('#name_brand'), '{l s="By Brand" d="Shop.Theme.SortOrders"}', element.text());
        $('#manufacturer_' + idManufacturer).css('background-color', 'rgb(0, 90, 215)').css('color', 'rgb(255, 255, 255)').css('padding', '10px');
        doSearch();
    }

    function setOrderBy(orderBy){
        $('#temp_multiFilter_order_by').val(orderBy);
        $('#multiFilter_order_by').val(orderBy);
    }

    function setOrientation(orientation){
        $('#temp_multiFilter_order_by_orientation').val(orientation);
        $('#multiFilter_order_by_orientation').val(orientation);
    }

    function setCategory(idCategory, element) {
        
        $('#temp_multiFilter_id_category').val(idCategory);
        $('#multiFilter_id_category').val(idCategory);
        $('#id_category_layered').val(idCategory);
        setName($('#name_category'), '{l s="By Category" d="Shop.Theme.SortOrders"}', $(element).text());
		$('#category_element_' + idCategory).css('background-color', 'rgb(0, 90, 215)').css('color', 'rgb(255, 255, 255)').css('padding', '10px');
        doSearch();
        
    }

    // if($("#nb_item").length) {
    //     document.getElementById("nb_item").addEventListener("change", setProductsPerPage, true);
    // }

    document.querySelectorAll('.dropdown-menu.dropdown-perpage .select-list').forEach(function(item) {
        item.addEventListener('click', function() {
            const value = this.getAttribute('value'); // Get the value from data attribute
            setProductsPerPage(value); // Call your function with the selected value
        });
    });

    function setProductsPerPage(value) {
        console.log('Products per page set to:', value);
    // Add your logic to update the products per page here
    let nr_items = value;

    $('#temp_multiFilter_nr_items').val(nr_items);
    $('#multiFilter_nr_items').val(nr_items);
    $('#multiFilter_n_items').val(nr_items);
    setName($('#name_items_per_page'), nr_items, '{l s="Per Page" d="Shop.Theme.SortOrders"}');
    doSearch();
    }


    function string_splitter(string, explode_character){
        return string.split(explode_character);
    }

    function setName(element, tag, value){ element.html('<b>'+tag+': </b> <span style="color:black;">'+value+'</span>'); }
    
    function setPageNumber(p){

        let ukoo_element = $('#ukoocompat_select_4');
        let ukoo_option_element = $('#ukoocompat_select_4 option');
        
        if ( (ukoo_element.length > 0) && (ukoo_element.val()) ){
            $('#temp_multiFilter_page_number').val(p);
            $('#multiFilter_page_number').val(p);
            submitUkooForm();
        } else {
            let url_string = document.URL;
            let new_url;

            if(url_string.includes("&p=")){
                new_url = url_string.substring(0, url_string.indexOf('&p=')) + '&p=' + p;
            }else{
                new_url = location.protocol + '//' + location.host + location.pathname + '?p=' + p;
            }
            window.location.href = new_url;
        }
    }

    function doSearch() {

        let ukoo_element = $('#ukoocompat_select_4');
        let compat_elem = $('#current_car_settings');

        $('#loader_holder').css('display', 'block');

        if ( ( (ukoo_element.length > 0) && (ukoo_option_element.length > 1) && ($('#ukoocompat_select_4').val()) ) || ( $('#module-ukoocompat-listing').attr('id') == 'module-ukoocompat-listing' ) ){
            //submitUkooForm();
        } else {

            if( typeof(create_url) === typeof(Function)) {
                if(compat_elem){
                    window.location.href = create_url(1);
                }else{
                    window.location.href = create_url();
                }
            }else{
                alert($('#alert_message').val());
                $('#loader_holder').css('display', 'none');
                $('.wm-hiddencompats').css('display', 'block');
                
                if($('#ukoocompat_select_1').val() == '') $('#ukoocompat_select_1').css('border', '1px solid red');
                if($('#ukoocompat_select_2').val() == '') $('#ukoocompat_select_2').css('border', '1px solid red');
                if($('#ukoocompat_select_3').val() == '') $('#ukoocompat_select_3').css('border', '1px solid red');
                if($('#ukoocompat_select_4').val() == '') $('#ukoocompat_select_4').css('border', '1px solid red');
            }
        }
    }

    function create_url(compat = null){
        let data =  urlParameter_OrderBy();
        if(compat){
            data += urlParameter_IdCompat();
        }
        data += urlParameter_OrderWay();
        data += urlParameter_NumberOfItems();
        data += urlParameter_NewProducts();
        if ($('body#category').length < 1) data += urlParameter_Category();
        data += urlParameter_Manufacturer();
        data += urlParameter_PageNumber();
        return location.protocol + '//' + location.host + location.pathname + '?' + data;
    }

    function urlParameter_IdCompat(){    return '&id_compat=' + $('#current_car_settings').attr('id_compat'); }
    function urlParameter_PageNumber(){    return '&p=' + $('#multiFilter_page_number').val(); }
    function urlParameter_OrderBy(){       return 'orderby=' + $('#multiFilter_order_by').val(); }
    function urlParameter_OrderWay(){      return '&orderway=' + $('#multiFilter_order_by_orientation').val(); }
    function urlParameter_NumberOfItems(){ return '&n=' + $('#multiFilter_nr_items').val(); }
    function urlParameter_NewProducts(){   return '&news=' + $('#multiFilter_news').val(); }
    function urlParameter_Category(){      return '&id_category_layered=' + $('#multiFilter_id_category').val(); }
    function urlParameter_Manufacturer(){  return '&id_manufacturer_layered=' + $('#multiFilter_id_manufacturer').val(); }


    // functions remove filters

    function removeOrderParametersAndReload(event){
        if (event) {
            event.stopPropagation();
        }
        $('#productsSortForm').remove();
        let alteredURL = removeParam("orderby", document.URL);
        redirectTo(removeParam("orderway", alteredURL));
    }

    function removeItemPerPageParametersAndReload(event){
        if (event) {
            event.stopPropagation();
        }
        $('.wm-hiddennbr').remove();
        redirectTo(removeParam("n", document.URL));
    }

    function removeCategoryParametersAndReload(event){
        if (event) {
            event.stopPropagation();
        }
        $('.wm-hiddenCategoryMenu').remove();
        redirectTo(removeParam("id_category_layered", document.URL));
    }

    function removeCategoryParametersAndReloadUkoo(event){
        if (event) {
            event.stopPropagation();
        }
        $('#multiFilter_id_category').val(0);
        $('#ukoocompat_search_block_form_1').submit();
    }

    function removeManufacturerParametersAndReload(event){
        if (event) {
            event.stopPropagation();
        }
        $('.wm-hiddenlayered').remove();
        redirectTo(removeParam("id_manufacturer_layered", document.URL));
    }

    function setNews(news){
        $('#news_items').remove();
        let current_link = document.URL;
        let link;

        if(news === 1){
            link= current_link.replace("news=0", "news=1");
        }else{
            if(current_link.search("news=")  >= 0){
                link= current_link.replace("news=1", "news=0");
            }else{
                link = current_link + '?news=0';
            }
        }
        redirectTo(link);
    }

    function redirectTo(url){
        window.location.href = url;
    }

    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            rtn = rtn + "?" + params_arr.join("&");
        }
        return rtn;
    }


    // wheels functions

    function filterFeatures(id_feature, id_feature_value){

        const { host, hostname, href, origin, pathname, port, protocol, search } = window.location;
        
        let new_request = window.location.href;
        
        if( search.includes('?') ){
            if( !search.includes( id_feature + ':' + id_feature_value ) ){
                new_request = window.location.href + '|' + id_feature + ':' + id_feature_value;
            }
        }else{	                
            new_request = window.location.href + '?filters=' + id_feature + ':' + id_feature_value;
        }
        
        window.location.href = new_request;
    }

    function removeFilterFeatures(option) {
        const { search } = window.location;

        const options = option.includes(',') ? option.split(',') : [option];

        let current_request = window.location.href;
        let new_request = current_request;



        options.forEach((opt) => {
            // console.log(opt);

            // console.log(current_request.includes(opt))
            // If the filter exists in the search query
            if (current_request.includes(opt)) {

                // If the filter has an '=' sign, i.e., key-value pair
                if (current_request.includes('=' + opt)) {
                    if (current_request.includes('=' + opt + '|')) {
                        // Remove the filter when it is part of a chained query parameter
                        new_request = current_request.replace(opt + '|', '');
    
                    } else {
                        // Remove the filter when it's directly in the filters
                        new_request = current_request.replace('?filters=' + opt, '');
    
                    }
                } else {
                    // If the filter is part of a larger string like 'filters=6:11|5:8'
                    if (current_request.includes(opt + '|')) {
                        new_request = current_request.replace(opt + '|', '');
                    } else {
                        new_request = current_request.replace('|' + opt, '');
                    }
                }
            } else {
                // If no filters were found, remove the whole key-value pair
                new_request = current_request.replace('filters=' + opt + '&', '');
            }

            // Make sure to update `current_request` with the latest `new_request` value
            current_request = new_request;
        });

        // console.log('Final new_request:', new_request);
        
        // Optionally update the browser's location if needed
        window.location.href = new_request;
    }



</script>
