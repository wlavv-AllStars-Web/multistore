{debug}
<pre>{$product|print_r}</pre>

<div class="tab-container-product-creation-custom row">
    <div class="col-lg-9">
        {*  *}
        <div class="form-group">
            <h3>
                References

            </h3>
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
                        value="{$product.reference}">



                </div>

                <div class="form-group text-widget"> <label for="product_details_references_mpn">
                        MPN


                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="MPN is used internationally to identify the Manufacturer Part Number."
                            data-placement="top" data-original-title="" title="">
                        </span>
                    </label>
                    <input type="text" id="product_details_references_mpn" name="product[details][references][mpn]"
                        aria-label="product_details_references_mpn input" class="form-control" value="{$product.mpn}">



                </div>

                <div class="form-group text-widget"> <label for="product_details_references_upc">
                        UPC barcode


                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="This type of product code is widely used in the United States, Canada, the United Kingdom, Australia, New Zealand and in other countries."
                            data-placement="top" data-original-title="" title="">
                        </span>
                    </label>
                    <input type="text" id="product_details_references_upc" name="product[details][references][upc]"
                        aria-label="product_details_references_upc input" class="form-control" value="{$product.upc}">



                </div>

                <div class="form-group text-widget"> <label for="product_details_references_ean_13">
                        EAN-13 or JAN barcode


                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="This type of product code is specific to Europe and Japan, but is widely used internationally. It is a superset of the UPC code: all products marked with an EAN will be accepted in North America."
                            data-placement="top" data-original-title="" title="">
                        </span>
                    </label>




                    <div class="container-ean-btn">
                        <button id="product_details_print_ean"
                            name="product[details][print_ean]" class="btn-secondary print_ean_btn ml-auto btn"
                            onclick="generateEan()" type="button" style="display: flex; padding: 0px 0.5rem;"><i
                                class="barcode-white"> </i></button>
                        <input type="text"
                            id="product_details_references_ean_13" name="product[details][references][ean_13]"
                            aria-label="product_details_references_ean_13 input" class="form-control" value="{$product.ean_13}"></div>
                </div>

                <div class="form-group text-widget"> <label for="product_details_references_isbn">
                        ISBN


                        <span class="help-box" data-toggle="popover" data-trigger="hover" data-html="true"
                            data-content="The International Standard Book Number (ISBN) is used to identify books and other publications."
                            data-placement="top" data-original-title="" title="">
                        </span>
                    </label>
                    <input type="text" id="product_details_references_isbn" name="product[details][references][isbn]"
                        aria-label="product_details_references_isbn input" class="form-control" value="{$product.isbn}">



                </div>

            </div>
        </div>

        {*  *}
    </div>
    <div class="col-lg-3">right</div>

</div>