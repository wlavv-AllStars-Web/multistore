{extends file=$layout}

{block name='content'}
    {* <pre>{$urls.pages|print_r}</pre> *}
    <div class="container-quickshop">
        <div class="quickshop-header">
            <h1>Quick Shop</h1>
            <p>Save time and quickly order your products with our quickshop facility.</p>
        </div>
        <div class="quickshop-buysection">
            <div class="quickshop-products-table">
                <div class="quick-header">
                    <div>Product</div>
                    <div>Options</div>
                    <div>Qty</div>
                </div>

                {* para cada produto *}
                

                <div class="quick-products-container">
                    {* <div class="no-products-yet">No Products Yet.</div> *}
                </div>

                {* se add another *}
                <div class="quick-products-search">
                        
                    <div class="product-search-input">
                        <div class="quick-product-search">
                            <form method="get" action="{$link->getPageLink('quickshop', true)}">
                                <input type="hidden" name="quick-search-product" value="1">
                                <input type="text" name="qs-product" placeholder="Product Code">
                                <div id="loading-spinner-small" style="display: none;">
                                    <div class="spinner-small"></div>
                                </div>
                                <div id="loading-error" style="display: none;">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                            </form>
                        </div>
                        <div class="quick-search-gap"></div>
                        <div class="quick-search-gap"></div>
                    </div>
                    <div class="product-search-results">
                        {* results product search *}
                    </div>
                </div>
                {* fim add another *}

                <div class="quick-footer">
                    <div class="quick-footer-container">
                        <div class="quick-footer-left">
                            <button class="quick-btn-remove-all" onclick="removeAllToCart(this)"><i class="fa-solid fa-xmark"></i><span>Remove All</span></button>
                        </div>
                        <div class="quick-footer-right">
                            <button class="quick-btn-addcart" onclick="addAllToCart(this)" disabled>Proceed to Checkout</button>
                            {* <button class="quick-btn-checkout">Proceed to Checkout</button> *}
                        </div>
                    </div>
                </div>
                <div id="loading-spinner" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>
    </div>
    

    <script>
    function deleteLineQS(item) {
        item.parentElement.parentElement.parentElement.remove()
    }

    const productSearch = document.querySelector(".quick-product-search input[type='text']")
    let productsInCart = []; 
    let debounceTimeout;

    productSearch.addEventListener('input', function(event) {

        clearTimeout(debounceTimeout);

        debounceTimeout = setTimeout(function() {

            const searchTerm = productSearch.value;  // Get value from input field
            const link = '{$url_quickshop_controller}'; // Adjust based on your module's namespace
            const loadingSpinnerSmall = document.getElementById('loading-spinner-small'); 


            loadingSpinnerSmall.style.display = 'block';

            $.ajax({
                url: link,
                data: {
                    ajax:1,
                    quickshop: 1,
                    s: searchTerm,
                    resultsPerPage: 9
                },
                type: 'post',
                dataType: 'json',                
                success: function(json) {
                    
                    loadingSpinnerSmall.style.display = 'none';

                    const resultsContainer = document.querySelector(".product-search-results");
                    resultsContainer.innerHTML = '';  // Clear previous results

                    // Append the rendered HTML returned by PrestaShop to the container
                    if (json.rendered_products) {
                        resultsContainer.innerHTML = json.rendered_products;
                    } else {
                        resultsContainer.innerHTML = '<p>No products found</p>';
                    }


                },
                error: function(xhr, status, error) { 
                    console.log("Error:", status, error);
                    console.log("Response:", xhr.responseText);

                }
            });

        }, 300);
    });

    function setProductQS(item, productData){
        const product = JSON.parse(productData);
        // console.log(product.id_product)
        const link = '{$url_quickshop_controller}'; // Adjust based on your module's namespace
        const loadingSpinner = document.getElementById('loading-spinner'); 
        const btnProceed = document.querySelector(".quick-btn-addcart")
        const id_attribute_child = document.querySelector(".qs-product").getAttribute("data-child-id-product-attribute");
        btnProceed.removeAttribute("disabled")

        loadingSpinner.style.display = 'block';

        $.ajax({
            url: link,
            data: {
                // ajax:1,
                qs_setproduct: 1,
                data_product: JSON.stringify(product),
                id_attribute_child: id_attribute_child,
            },
            type: 'post',
            dataType: 'json',                
            success: function(json) {
                const qsProductLineContainer = document.querySelector(".quick-products-container");
                // qsProductLineContainer.innerHTML = '';

                if (json.rendered_template) {
                    qsProductLineContainer.insertAdjacentHTML('beforeend', json.rendered_template);
                } else {
                    qsProductLineContainer.innerHTML = '<p>No products found</p>';
                }

                document.querySelector(".product-search-results").innerHTML = '';
                document.querySelector(".quick-product-search input[name='qs-product']").value = '' 

            },
            error: function(xhr, status, error) { 
                console.log("Error:", status, error);
                console.log("Response:", xhr.responseText);
            },
            complete: function() {
            // Hide the loading spinner after the request is complete
            loadingSpinner.style.display = 'none';
            productsInCart.push(product);
            }
        });

    }

    function addAllToCart(e) {
        const buttonAdd = e;
        const token = '{$static_token}'; // Replace with your actual static token
        const productsContainer = document.querySelectorAll('.quick-products-container .quick-products');
        const productsData = [];

        const spinner = document.createElement("div");
        spinner.classList.add("spinner-addall")
        const spinnerContent = document.createElement("div");
        spinnerContent.classList.add("spinner-small")
        spinner.appendChild(spinnerContent)

        buttonAdd.appendChild(spinner)
        buttonAdd.setAttribute("disabled",'')

        // Iterate through each product and gather data
        productsContainer.forEach(item => {
            const idProduct = item.getAttribute("data-id-product");
            const qty = item.querySelector('input[name="qty-product"]').value;
            const selectedOptions = item.querySelectorAll('.quick-product-option .QS-span-data');
            let nameGroup = null;

            

            let selectedValue = null;
            

            // if (selectedOptions) {

                // const selectedIndex = selectedOption.selectedIndex;
                // selectedValue = selectedOption.options[selectedIndex].value;
                // nameGroup = selectedOption.getAttribute("name");
            // }

            // Prepare the individual data for each product
            const productData = {
                token: token,
                id_product: idProduct,
                id_customization: 0, // Adjust this value as needed
                qty: qty,
                add: 1,
                action: 'update'
            };

            selectedOptions.forEach(option => {
                nameGroup = option.getAttribute("name");
                selectedValue = option.getAttribute("value");
                if (nameGroup && selectedValue) {
                    productData[nameGroup] = selectedValue; // Correctly assign the name and value to productData
                }
            })

            
            // if (nameGroup) {
            //     productData[nameGroup] = selectedValue;
            // }

            // Add this product's data to the array
            productsData.push(productData);
        });

        if (productsData.length === 0) {
            alert("No products to add to cart.");
            return;
        }
        // console.log(productsData)
        // Now send a single AJAX request for all products
        productsData.forEach(function(productData, index) {
            $.ajax({
                url: '{$urls.pages.cart}', // Update this with your actual endpoint
                type: 'POST',
                data: productData,
                success: function(response) {
                    console.log("All products added to cart:", response);

                    // Emit updateCart event to trigger the shopping cart module's logic and update blockcart HTML
                    emitUpdateCartEvent(productData);

                },
                error: function(error) {
                    console.error("Error adding products to cart:", error);
                },
                complete: function() {
                    if (index === productsData.length - 1) {
                        console.log("last processed")
                        document.querySelector(".spinner-addall").remove();
                        window.location.href = "{$urls.pages.order}";
                    }
                }
            });
        });

        // Emit prestashop's updateCart event after products are added
        function emitUpdateCartEvent(product) {
                const eventPayload = {
                    reason: {
                        idCustomization: product.id_customization || 0,
                        idProductAttribute: product.id_product_attribute || 0, // Update as needed
                        idProduct: product.id_product,
                        linkAction: 'update'
                    },
                    resp: {
                        hasError: false,
                    }
                };

                // Trigger the event for each product to update the blockcart
                prestashop.emit('updateCart', eventPayload);
                                    
        }

    }

    function removeAllToCart(e){
        const btnProceed = document.querySelector(".quick-btn-addcart")
        btnProceed.setAttribute("disabled",'')
        const productsContainer = document.querySelector(".quick-products-container")
        productsContainer.innerHTML = '';
    }


    function handleSelectChange(e) {
        const selects = e.parentElement.parentElement.querySelectorAll("select")

        selects.forEach(select => {
            select.addEventListener('change', function() {
                console.log('select')
                // Get dynamic data from relevant elements
                const productId = this.closest('.quick-products').getAttribute('data-id-product'); // Assuming each product wrapper has the ID
                const token = '{$static_token}'; // Replace with actual token variable
                const idCustomization = 0; // Customization ID if applicable
                const qty = 1; // Quantity

                // Gather selected options from all relevant select elements
                const selectedGroups = {};
                selects.forEach(select => {
                    const groupId = select.getAttribute('name'); // Get the group ID from a custom data attribute
                    const selectedValue = select.value; // Get the selected value

                    if (groupId) {
                        selectedGroups[groupId] = selectedValue; // Store the selected value by group ID
                    }
                });

                // Prepare the data object for the AJAX request
                const productData = {
                    quickview:"0",
                    ajax:"1",
                    action:"refresh",
                    quantity_wanted:"1",
                };

                // Prepare the base URL
                let url = 'https://asd.local/pt/index.php?controller=product&token='+token+'&id_product='+productId+'&id_customization='+idCustomization+'&qty='+qty;

                // Append selected groups to the URL
                Object.keys(selectedGroups).forEach(groupId => {
                    url += '&group['+groupId+']='+selectedGroups[groupId];
                });

                $.ajax({
                    url: url,
                    data: productData,
                    type: 'post',
                    dataType: 'json',                
                    success: function(json) {
                        const product_variant = document.querySelector(".product-variants")

                        product_variant.innerHTML = json.product_variants;

                    },
                    error: function(xhr, status, error) { 
                        console.log("Error:", status, error);
                        console.log("Response:", xhr.responseText);

                    }
                });
            });
        });
    }


    </script>

    <style>
        .quick-products::after{
            content: '';
            display: block;
            position: absolute;
            top: 100% !important;
            width: 95%;
            left: 50%;
            border-top: 1px solid #dedede;
            transform: translateX(-50%);
        }
        /* SEARCH ERROR */
        #loading-error{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 1rem;
        }

        .fa-xmark{
            color: #ee302e;
        }

        /* spinnel small */
        #loading-spinner-small{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 1rem;
        }

        .spinner-small {
        border: 3px solid #f3f3f3; /* Light gray */
        border-top: 3px solid #0273eb; /* Blue */
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 600ms linear infinite;
        }

        /* spinner */
        #loading-spinner{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner {
            border: 6px solid #f3f3f3; /* Light gray */
            border-top: 6px solid #0273eb; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 600ms linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        /*  */

        .no-products-yet{
            padding: 1rem;
        }

        .container-quickshop{
          max-width: 1350px;
          width: 100%;
          margin: auto;  
          position: relative;
        }

        .quickshop-buysection{
            margin-bottom: 30px;
        }

        .quickshop-products-table{
            outline: 1px solid #dedede;
            position: relative;
            border-radius: 0.25rem;
        }
        .quick-header{
            display: flex;
            border-bottom: 1px solid #dedede;
            background: #f6f6f6;
        }
        .quickshop-header{
            padding-bottom: 2rem;
        }

        .quickshop-header h1 {
            font-size: 1.8rem;
            color: #333;
            text-transform: uppercase;
        }
        .quickshop-header p {
            font-size: 1rem;
        }

        .quick-header div{
            flex: 1;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            /* border: 1px solid #dedede; */
        }
        /* products search */

        .quick-products-search{
            display: flex;
            flex-direction: column;
            background: #f6f6f6;
        }

        .productsQS{
            padding: 0 1rem 1rem;
        }

        .qs-product{
            background: #fff;
        }

        .qs-warning{
            padding: 0 1rem 1rem;
            font-size: 1rem;
        }
        .qs-warning p{
            margin-bottom: 0;
            color: #ee302e;
        }

        .product-search-input{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            padding: 1rem;
            gap: 1rem;
        }
        .product-search-input .quick-product-search{
            flex: 1;
            position: relative;
        }
        .product-search-input .quick-search-gap{
            flex: 1;
        }

        .product-search-input input{
            width: 100%;
            padding: 0.5rem;
            background: #fff;
            border-radius: .25rem;
            border: 1px solid #dedede;
            height: 35px;
        }

        .product-search-input input:focus-visible{
            outline: #0273EB solid 2px;
        }

        .no-options-container{
            height: 100%;
            display: flex;
            align-items: center;
        }
        .no-options-container p{
            font-size: 1rem;
        }

        /* producst part */
        .quick-products{
            display: flex;
            position: relative;
        }

        .quick-products .quick-search-gap{
            flex: 1;
        }
        .quick-products .quick-product-search{
            padding: 0.5rem 1rem;
            flex: 1;
        }
        .quick-products .quick-product-search input{
            width: 100%;
            padding: 0.5rem;
            background: #fff;
            border-radius: .25rem;
            border: 1px solid #dedede;
            height: 35px;
        }

        .quick-products .quick-product-details {
            flex: 1;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            /* border: 1px solid #dedede; */
        }
        .quick-products .quick-product-details .quick-product-img {
            width: 80px;
        }

        .quick-products .quick-product-details .quick-product-img img{
            max-width: 80px;
            width: 100%;
        }

        .quick-products .quick-product-details .quick-product-description{
            flex: 1;
            padding: 0 1rem;
        }

        .quick-products .quick-product-details .quick-product-description span{
            font-weight: 600;
        }

        .quick-products .quick-product-options {
            flex: 1;
            padding: 0.5rem 1rem;
        }

        .quick-products .quick-product-options .quick-product-option{
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
        }
        .quick-products .quick-product-options .quick-product-option span{
            width: 20%;
        }
        .quick-products .quick-product-options .quick-product-option select{
            width: 80%;
            padding: 0.5rem;
            background: #fff;
            border-radius: .25rem;
            border: 1px solid #dedede;
        }

        /* .quick-products .quick-product-options .quick-product-option select option:hover{
            background: #0273EB !important;
            color: #fff;
            box-shadow: 0 0 10px 100px #1882A8 inset;
        } */
        .quick-products .quick-product-options .quick-product-option select option:checked{
            background: #0273EB !important;
            color: #fff;
        }

        .quick-products .quick-product-qty {
            flex: 1;
            padding: 0.5rem 1rem;
            display: flex;
        }

        .quick-products .quick-product-qty .quick-product-qty-container{
            display: flex;
            align-items: center;
            padding: 0.5rem 0
        }

        .quick-products .quick-product-qty .quick-product-qty-container span{
            width: fit-content;
            padding-right: 1rem;
        }
        .quick-products .quick-product-qty .quick-product-qty-container input{
            flex: 1;
            appearance: auto !important;
            -moz-appearance: number-input !important;

            padding: 0.5rem;
            background: #fff;
            border-radius: .25rem;
            border: 1px solid #dedede;
            height: 35px;
        }
        .quick-products .quick-product-qty .quick-product-qty-container button{
            width: 25%;
            padding: 0 1rem;
            color: #0273EB;
            text-align: center;
            border: 0;
            background: none;
        }

        .quick-footer{
            border-top: 1px solid #dedede;
            background: #f6f6f6;
        }

        .quick-footer .quick-footer-container{
            display: flex;
            padding: 1rem;
        }

        .quick-footer .quick-footer-container .quick-footer-left{
            flex: 1;
            display: flex;
            gap: 1rem;
        }

        .quick-footer .quick-footer-container button{
            padding: 0.5rem 1rem;
            color: #fff;
            border-radius: 0.25rem;
            border: 0;
        }

        .quick-footer .quick-footer-container button.quick-btn-add{
            background: #0273EB;
        }
        .quick-footer .quick-footer-container button.quick-btn-remove-all{
            background: #ee302e;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quick-footer .quick-footer-container button.quick-btn-remove-all:hover{
            background: #d52a28;
        }

        .quick-footer .quick-footer-container button.quick-btn-remove-all i{
            color: #fff;
        }

        .quick-footer .quick-footer-container button.quick-btn-addcart:disabled{
            background: #0273EB70;
            color: #fff
            cursor: no-drop;
        }
        .quick-footer .quick-footer-container button.quick-btn-addcart:disabled:hover{
            background: #0273EB70;
            color: #fff;
            cursor: no-drop;
        }

        .quick-footer .quick-footer-container button.quick-btn-addcart{
            background: #0273EB;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .quick-footer .quick-footer-container button.quick-btn-addcart:hover{
            background: #005BBB;
        }



        .quick-footer .quick-footer-container .quick-footer-right{
            flex: 1;
            display: flex;
            gap: 1rem;
            justify-content: end;
        }

    </style>
{/block}