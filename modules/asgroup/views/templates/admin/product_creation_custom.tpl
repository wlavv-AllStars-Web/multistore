<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="tab-container-product-creation-custom row">
    <div class="col-lg-9">
        {*  *}
        <div class="form-group">
            <div id="product_details_references" class="form-columns-3">
                <div class="form-group text-widget"> <label for="product_details_references_reference">
                        Reference


                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="Allowed special characters: .-_#" data-placement="top" data-original-title=""
                            title="">
                        </span>
                    </label>
                    <input type="text" id="product_details_references_reference"
                        name="product[details][references][reference]"
                        aria-label="product_details_references_reference input" class="form-control"
                        value="{$product->reference}">



                </div>


                <div class="form-group text-widget"> <label for="product_details_references_ean_13">
                        EAN-13 or JAN barcode


                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="This type of product code is specific to Europe and Japan, but is widely used internationally. It is a superset of the UPC code: all products marked with an EAN will be accepted in North America."
                            data-placement="top" data-original-title="" title="">
                        </span>
                    </label>



                    {if !empty($product->ean13)}
                        <div class="container-ean-btn">
                            <button id="product_details_print_ean" name="product[details][print_ean]" class="btn-secondary print_ean_btn ml-auto btn" onclick="generateEan()" type="button">
                                <i class="material-icons">local_printshop</i>
                                <span class="btn-label"></span>
                            </button>
                            <input type="text" id="product_details_references_ean_13" name="product[details][references][ean_13]" aria-label="product_details_references_ean_13 input" class="form-control" value="{$product->ean13}">
                        </div>
                    {else}
                        <div class="container-ean-btn">
                            <button id="product_details_print_ean"
                                name="product[details][print_ean]" class="btn-secondary print_ean_btn ml-auto btn"
                                onclick="generateEan()" type="button" style="display: flex; padding: 0px 0.5rem;">
                                <i class="fa-solid fa-barcode"></i>
                            </button>
                            <input type="text"
                                id="product_details_references_ean_13" name="product[details][references][ean_13]"
                                aria-label="product_details_references_ean_13 input" class="form-control" value="{$product->ean13}">
                        </div>
                    {/if}
                </div>


            </div>
        </div>

        {*  *}
    </div>
    <div class="col-lg-3">right</div>

</div>

{debug}
<pre>{$product|print_r}</pre>