{* <pre>{$compats|print_r}</pre> *}
<div class="tab-compats-asg">
    <div class="compats-asg-img">
        <img src="/modules/asgroup/views/img/0.png" width="100" />
    </div>
    <h1>Select compatibilities of the product.</h1>
    <div class="compats-asg-form">
        <select id="select-brands" class="form-select" >
            <option selected>Brand</option>
            {foreach from=$brands item=brand}
                <option value="{$brand.id_brand}">{$brand.name}</option>
            {/foreach}
        </select>
        <select id="select-models" class="form-select" aria-label="Default select example" disabled>
            <option selected>Model</option>
        </select>
        <select id="select-type" class="form-select" aria-label="Default select example" disabled>
            <option selected value="0">Type</option>
        </select>
        <select id="select-version" class="form-select" aria-label="Default select example" disabled>
            <option selected value="0">Version</option>
        </select>
        <div class="btn btn-primary" onclick="saveCompat()">Save</div>
    </div>
    {* {$compats|print_r} *}
    <div class="product-compats-active">
        <table class="table table-bordered" style="margin-top: 2rem;">
            <thead>
                <tr>
                    <td>Brand</td>
                    <td>Model</td>
                    <td>Type</td>
                    <td>Version</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                {foreach from=$compats item=compat}
                    <tr>
                        <td>{$compat.brand}</td>
                        <td>{$compat.model}</td>
                        <td>{$compat.type}</td>
                        <td>{$compat.version}</td>
                        <td style="text-align: center;"><i class="material-icons" onclick="deleteCompat({$compat.id_compat},this)">delete</i></td>
                    </tr>
                {/foreach}
            </tbody>
            
        </table>
    </div>
</div>
<style>

.compats-asg-form {
    width: 50%;
    display: flex;
    gap: 1rem;
}
.compats-asg-form select{
    flex: 1;
    background: #fff;
    border: 1px solid #d0d0d0;
    border-radius: .25rem;
    padding: .25rem .5rem;
}

.product-compats-active thead td {
    font-weight: 600;
    background: #444;
    color: #fff;
}

.table-bordered, .table-bordered td, .table-bordered th{
    border: 1px solid #444;
}

</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        document.querySelectorAll(".compats-asg-group select").forEach((element, i) => {
            if (element.options.length > 0) {
                element.selectedIndex = 0; // Select the first option
            }
        });


    document.addEventListener("DOMContentLoaded", function() {
        const brandSelect = document.getElementById("select-brands");
        brandSelect.addEventListener("change", function() {
            getModels(this);
        });
        const modelSelect = document.getElementById("select-models");
        modelSelect.addEventListener("change", function() {
            getTypes(this);
        });
        const typeSelect = document.getElementById("select-type");
        typeSelect.addEventListener("change", function() {
            getVersions(this);
        });
    });

    function getModels(e){
        console.log("getModels function called"); 
        const id_select = e.selectedIndex;
        const brand = document.querySelectorAll("#select-brands option")[id_select].getAttribute("value");
        const shop_id = {$shop_id}
        const key = '{$key}'
        // const url = 'https://webtools.all-stars-motorsport.com/api/get/bo/models/'+brand+'/'+shop_id+'/'+key;
        const url = '{$admin_url}'


        $.ajax({
            url: url,
            type: 'GET',
            data: {
                ajax: true,
                action: 'getModels', 
                brand: brand,
                shop_id: shop_id,
                key: key,
                getmodelsbrand: 1,
            },
            success: function(models) {
                console.log(models);
                document.querySelector("#select-models").removeAttribute("disabled")
                document.querySelector("#select-models").innerHTML = models.html_brands
                // Add your logic here for handling the models returned
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }
    function getTypes(e){
        console.log("getTypes function called"); 
        const id_select = e.selectedIndex;
        const brand = document.querySelectorAll("#select-models option")[id_select].getAttribute("data-brand");
        const model = document.querySelectorAll("#select-models option")[id_select].getAttribute("value");
        const shop_id = {$shop_id}
        const key = '{$key}'
        // const url = 'https://webtools.all-stars-motorsport.com/api/get/bo/models/'+brand+'/'+shop_id+'/'+key;
        const url = '{$admin_url}'


        $.ajax({
            url: url,
            type: 'GET',
            data: {
                ajax: true,
                action: 'getModels', 
                brand: brand,
                model: model,
                shop_id: shop_id,
                key: key,
                getTypesbrand: 1,
            },
            success: function(models) {
                console.log(models);
                document.querySelector("#select-type").removeAttribute("disabled")
                document.querySelector("#select-type").innerHTML = models.html_brands
                // Add your logic here for handling the models returned
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }
    function getVersions(e){
        console.log("getVersions function called"); 
        const id_select = e.selectedIndex;
        const brand = document.querySelectorAll("#select-type option")[id_select].getAttribute("data-brand");
        const model = document.querySelectorAll("#select-type option")[id_select].getAttribute("data-model");
        const type = document.querySelectorAll("#select-type option")[id_select].getAttribute("value");
        const shop_id = {$shop_id}
        const key = '{$key}'
        // const url = 'https://webtools.all-stars-motorsport.com/api/get/bo/models/'+brand+'/'+shop_id+'/'+key;
        const url = '{$admin_url}'


        $.ajax({
            url: url,
            type: 'GET',
            data: {
                ajax: true,
                action: 'getModels', 
                brand: brand,
                model: model,
                type: type,
                shop_id: shop_id,
                key: key,
                getVersionsbrand: 1,
            },
            success: function(models) {
                console.log(models);
                document.querySelector("#select-version").removeAttribute("disabled")
                document.querySelector("#select-version").innerHTML = models.html_brands
                // Add your logic here for handling the models returned
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }

    function saveCompat(e){

        const id_select = document.querySelector("#select-version").selectedIndex
        const brand = document.querySelectorAll("#select-version option")[id_select].getAttribute("data-brand");
        const model = document.querySelectorAll("#select-version option")[id_select].getAttribute("data-model");
        const type = document.querySelectorAll("#select-version option")[id_select].getAttribute("data-type");
        const version = document.querySelectorAll("#select-version option")[id_select].getAttribute("value");
        const product = document.querySelector("form.product-form").getAttribute("data-product-id");

        const shop_id = {$shop_id}
        const key = '{$key}'
        const url = '{$admin_url}'
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                ajax: true,
                action: 'getModels', 
                brand: brand,
                model: model,
                type: type,
                version: version,
                product: product,
                shop_id: shop_id,
                key: key,
                saveCompat: 1,
            },
            success: function(models) {
                console.log(models);

                if (typeof showSuccessMessage === 'function') {
                    showSuccessMessage('Compatibility saved successfully!');
                } else {
                    alert('Compatibility saved successfully!');
                }

                document.querySelector(".product-compats-active table tbody").innerHTML = models.compats

            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);

                if (typeof showErrorMessage === 'function') {
                    showErrorMessage('Something went wrong. Please try again.');
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    }

    function deleteCompat(id_compat,elem){

        const product = document.querySelector("form.product-form").getAttribute("data-product-id");
        const shop_id = {$shop_id}
        const url = '{$admin_url}'

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                ajax: true,
                action: 'getModels', 
                id_compat: id_compat,
                product: product,
                shop_id: shop_id,
                deleteCompat: 1,
            },
            success: function(res) {
                console.log(res);

                if (typeof showSuccessMessage === 'function') {
                    showSuccessMessage('Compatibility deleted successfully!');
                } else {
                    alert('Compatibility deleted successfully!');
                }

                elem.parentElement.parentElement.remove()

                // document.querySelector(".product-compats-active table tbody").innerHTML = models.compats

            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);

                if (typeof showErrorMessage === 'function') {
                    showErrorMessage('Something went wrong. Please try again.');
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    }
</script>
