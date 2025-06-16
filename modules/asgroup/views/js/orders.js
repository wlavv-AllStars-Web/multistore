document.addEventListener("DOMContentLoaded", () => {
    const btn_saveFinal = document.querySelector("#product_footer_save")

    if(btn_saveFinal) {
        btn_saveFinal.removeAttribute("disabled")
    }


    // Function to clone a button and set up its behavior
    function cloneButton(originalButtonSelector, btnGroupSelector) {
        const originalButton = document.querySelector(originalButtonSelector);

        // Check if the original button exists
        if (originalButton) {
            // Clone the original button
            const clonedButton = originalButton.cloneNode(true); // Pass 'true' to clone with children

            // Sync the disabled state initially
            clonedButton.disabled = originalButton.disabled;

            return clonedButton; // Return the cloned button for later use
        } else {
            // console.log("Original button not found");
            return null; // Return null if the button was not found
        }
    }

    if(document.querySelector("body").classList.contains("adminorders")){


        // Create a div container for the buttons
        const buttonContainer = document.createElement('div');
        // buttonContainer.classList.add('custom-button-container');
    
        // Clone the search and clear buttons
        const clonedButtonSearch = cloneButton('#order_grid_table thead button.grid-search-button', "#order_grid_panel .card-body .btn-group");
        const clonedButtonClear = cloneButton('#order_grid_table thead button.grid-reset-button', "#order_grid_panel .card-body .btn-group");
    
        // Append cloned buttons to the button container
        if (clonedButtonSearch) {
            buttonContainer.appendChild(clonedButtonSearch);
        }
    
        if (clonedButtonClear) {
            buttonContainer.appendChild(clonedButtonClear);
        }
    
        // Append the button container after the .btn-group element
        // const btnGroup = document.querySelector("#order_grid_panel .card-body .btn-group");
        const btnGroup = document.querySelector("#order_grid_panel .bulkactions-orders-custom .custom-button-container");
        if (btnGroup) {
            // btnGroup.insertAdjacentElement("afterend", buttonContainer);
            btnGroup.appendChild(buttonContainer);
            // btnGroup.insertAdjacentElement("afterend", buttonContainer);
        } else {
            console.log(".btn_group not found");
        }
    
        // Set up observers and event listeners for each button
        [clonedButtonSearch, clonedButtonClear].forEach((clonedButton, index) => {
            if (clonedButton) {
                // Get the original button to observe
                const originalButton = document.querySelector(index === 0 ? '#order_grid_table thead button.grid-search-button' : '#order_grid_table thead button.grid-reset-button');
                
                // Observe changes to the original button
                const observer = new MutationObserver((mutations) => {
                    mutations.forEach(mutation => {
                        if (mutation.type === "attributes" && mutation.attributeName === "disabled") {
                            // Sync the disabled state
                            clonedButton.disabled = originalButton.disabled;
                        }
                    });
                });
    
                // Start observing the original button for attribute changes
                observer.observe(originalButton, {
                    attributes: true // Observe changes to attributes
                });
    
                // Add click event listener to the cloned button
                clonedButton.addEventListener('click', (event) => {
                    // Prevent default behavior if necessary (e.g., for forms)
                    event.preventDefault();
    
                    // Trigger a click on the original button
                    originalButton.click();
                });
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {

    const addPayment = document.querySelector(".add-payment-details-btn")

    if(addPayment){
        const lineAddPayment = document.querySelector(".add-form-payment-line")
        addPayment.addEventListener("click", () => {
            lineAddPayment.style.display = "table-row"
        })
    }

    const showHistoryStatus = document.querySelector(".btn.history-status")
    if(showHistoryStatus){
        const orderStatusweb = document.querySelector(".order-status-web")
        showHistoryStatus.addEventListener("click", () => {
            orderStatusweb.classList.toggle("show_status")
        })
    }

    const btn_toggle_payments = document.querySelector(".btn-toggle-payments")

    if(btn_toggle_payments) {
        const container_payment = document.querySelector("#view_order_payments_block")
        btn_toggle_payments.addEventListener("click", () => {
            container_payment.classList.toggle("show_payment")
        })
    }
    
    const btn_toggle_note = document.querySelector(".btn-toggle-note")

    if(btn_toggle_note) {
        const container_note = document.querySelector("#view_order_note_block")
        btn_toggle_note.addEventListener("click", () => {
            container_note.classList.toggle("show_note")
        })
    }


    // delete line shipping logic

    const btnsDeleteLineShipping = document.querySelectorAll(".btn-delete-shipping-line")

    btnsDeleteLineShipping.forEach((deleteBtn) => {
        deleteBtn.addEventListener("click", (e) => {
            e.preventDefault();

            const urlAction = deleteBtn.getAttribute("urlaction");
            const orderIdCarrier = deleteBtn.getAttribute("orderidcarrier")

            fetch(urlAction, {
                method: 'POST',
                body: JSON.stringify({
                    orderIdCarrier: orderIdCarrier,
                }),
                headers: {
                    'Accept': 'application/json', 
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest', 
                }
            })
            .then(response => response.json()) // Parse JSON response
            .then(data => {
                if (data.success) {
                    // Optionally, remove the line or update the UI after success
                    deleteBtn.closest('tr').remove(); // This removes the row from the table
                } else {
                    console.error('Error:', data.message); // Handle error from response
                }
            })
            .catch((error) => {
                console.error('Error:', error); // Handle any errors
            });
        })
    })


    // modal dpd

    

    const dpdButton = document.querySelector("#orderShippingDPD");
    const nacexButton = document.querySelector("#orderShippingNACEX");
    const upsButton = document.querySelector("#orderShippingUPS");
    // const modalContainer = document.querySelector(".modal-dpd-asgroup-container");
    // const modalContent = document.querySelector(".modal-dpd-asgroup");
    if(nacexButton){
        nacexButton.addEventListener("click", () => {
            const  estimated = document.querySelector(".nav-item-estimated")
            const  generate = document.querySelector(".nav-item-generate")
            estimated.style.display = "none"
            generate.style.display = "none"

            const selectNacexContainer = document.querySelector(".nav-item-select-nacex")
            selectNacexContainer.style.display = "block"


            const selectServices = document.querySelectorAll("#nacexTabContent #nacex_tip_ser optgroup:nth-child(2) option") 
    
            // clonedSelectServices.id = "nacex_tip_ser_cloned"
            // selectNacex.appendChild(clonedOptionsServices)
            
            const selectNacex = document.querySelector(".nav-item-select-nacex #select-nacex")


            if (selectNacex) {
                selectNacex.innerHTML = ''
                selectServices.forEach(option => {
                    // Clone each option and append it to selectNacex
                    const clonedOption = option.cloneNode(true);
                    selectNacex.appendChild(clonedOption);
                });
            }

            selectNacex.addEventListener("change", (e) => {
                const selectedValue = e.target.value;
                
                selectNacex.style.outline = 'none'

                const targetSelect = document.querySelector("#nacex_tip_ser");

                if (targetSelect) {
                    // Find the option with the same value and set it as selected
                    const matchingOption = targetSelect.querySelector(`option[value="${selectedValue}"]`);
                    if (matchingOption) {
                        targetSelect.value = selectedValue; // Synchronize selection
                    } else {
                        console.error("Matching option not found in the target select");
                    }
                } else {
                    console.error("Target select element not found");
                }
            })

            document.querySelector("#nacex_bul").setAttribute("value", 1)
            
        })
    }

    if(upsButton){
        upsButton.addEventListener("click", () => {
            const  estimated = document.querySelector(".nav-item-estimated")
            const  generate = document.querySelector(".nav-item-generate")
            estimated.style.display = "block"
            generate.style.display = "block"

            const selectNacex = document.querySelector(".nav-item-select-nacex")
            selectNacex.style.display = "none"

            const observer  = new MutationObserver((mutations, observerInstance) => {
                const firstWebvizo = document.querySelector("#upsTabContent .webvizo");
                if (firstWebvizo) {
                    // Stop observing once the element is found
                    observerInstance.disconnect();
    
                    const selectServices = firstWebvizo.querySelectorAll("#UPS_SETTINGS_SHIPMENTMETHOD option");
    
                    const selectUps = document.querySelector(".nav-item-select-shipping-ups #select-ups");
                    if (selectUps) {
                        selectUps.innerHTML = ''; // Clear previous options
                        selectServices.forEach(option => {
                            const clonedOption = option.cloneNode(true);
                            selectUps.appendChild(clonedOption);
                        });
                    }
                }
            });

            // Start observing the parent container for changes
            const upsTabContent = document.querySelector("#upsTabContent");
            if (upsTabContent) {
                observer.observe(upsTabContent, { childList: true, subtree: true });
            }
        })
    }

    if(dpdButton){
        dpdButton.addEventListener("click", () => {
            const orderID = document.querySelector("#shipping-grid-table").getAttribute("orderid")
            const orderWeightTR = document.querySelectorAll("#shipping-grid-table tbody tr")[0] 
            let orderWeightInput,orderWeightInputValidation,orderWeight,orderWeightValue,btnsave,alertShippingNotSaved;
            if(orderWeightTR){
                orderWeightInput = orderWeightTR.querySelector("input[name='update_order_shipping[shipping_weight]']")
                orderWeightInputValidation = orderWeightTR.querySelector(".carrier-weight .invalid-feedback")
                orderWeight = orderWeightTR.querySelector(".carrier-weight input").getAttribute("value")
                orderWeightValue = orderWeightTR.querySelector(".carrier-weight input").value
                btnsave =  orderWeightTR.querySelector(".btns-action-shipping-asg .btn-link")
                alertShippingNotSaved = document.querySelector(".shipping-notsaved-asgroup")
            }

            if(!orderWeightTR){
                alert("Line of shipping needs to be created!")
                document.querySelector("#shipping-grid-table .btn-primary").style.outline = "2px solid red"
                document.querySelector("#shipping-grid-table .btn-primary").style.outlineOffset = "2px"
            

            }else if(orderWeight == 0 && orderWeight == orderWeightValue){
                orderWeightInput.classList.add("input-error");
                orderWeightInputValidation.classList.add("show-validation")
                orderWeightInput.focus()

                orderWeightInput.addEventListener("blur", () => {
                    orderWeightInput.classList.remove("input-error");
                    orderWeightInputValidation.classList.remove("show-validation")
                });
            }else if(orderWeight != orderWeightValue){
                // btnsave.focus()
                alert("Shipping needs to be saved!")
                btnsave.style.outline ="2px solid red"
                alertShippingNotSaved.classList.add("show")
                setTimeout(() => {
                    btnsave.scrollIntoView({ behavior: "smooth"});
                }, 100); 
            }else{
                orderWeightInput.classList.remove("input-error");
                const url = `https://webtools.all-stars-motorsport.com/dpd/csv/generate/${orderID}/${orderWeight}`
        
                location.href = url
            }
        });
    }
    // modalContainer.addEventListener("click", (e) => {
    //     // Check if the click is outside of modalContent
    //     if (!modalContent.contains(e.target)) {
    //         toggleModalDpd(false);
    //     }
    // });
    
    // function toggleModalDpd(state) {
    //     if (state) {
    //         modalContainer.classList.add("show");
    //     } else {
    //         modalContainer.classList.remove("show");
    //     }
    // }

    // const btn_print_ean = document.querySelector("#product_product_creation_custom_html #product_details_print_ean_btn")
    // const containerReferences = document.querySelector("#product_product_creation_custom_html #product_details_references")
    // const inputEAN = document.querySelector("#product_product_creation_custom_html #product_details_references_ean_13")
    // const containerEanGroup = document.querySelector("#product_product_creation_custom_html #product_details_references .form-group:nth-child(4)")
    // const containerEanGroupLabel = document.querySelector("#product_product_creation_custom_html #product_details_references .form-group:nth-child(4) label")



    // if(btn_print_ean && containerReferences && inputEAN){
    //     // APPEND BTN TO INPUT
    //     const containerEan = document.createElement("div")
    //     containerEan.classList.add("container-ean-btn")

    //     containerEan.appendChild(btn_print_ean)
    //     containerEan.appendChild(inputEAN)
        

    //     containerEanGroup.insertAdjacentElement("beforeend", containerEan);

    // }else{
    //     console.log("error found")
    // }


    // btn generate ean combinations
    const EANInputCombinations = document.querySelector("#product_details_references_ean_13")


    if(EANInputCombinations){
        
        const EANvalue = document.querySelector("#product_product_creation_custom_html #product_details_references_ean_13").value;
        const productIdDetails = document.querySelector(".product-form").getAttribute("data-product-id")
        const btn_detailsEAN = document.querySelector("#product_product_creation_custom_html #product_details_print_ean_btn");
        
        if(EANvalue != ''){
            btn_detailsEAN.innerHTML = ''
            btn_detailsEAN.innerHTML = '<i class="material-icons">local_printshop</i>'
        }else{
            btn_detailsEAN.style.display = 'flex'
            btn_detailsEAN.style.padding = '.5rem'
            btn_detailsEAN.innerHTML = ''
            btn_detailsEAN.innerHTML = '<i class="fa-solid fa-barcode" style="font-size:21px"></i>'
        }
    }


})

function generateEanCombination(combinationId, ean13 = null) {
    const productId = document.querySelector(".product-form").getAttribute("data-product-id")
    const idCombination = combinationId ? combinationId : 0

    const ean13Value = ean13 ? ean13 : ''

    if(ean13Value == ''){
        const generateUrl = `https://webtools.all-stars-motorsport.com/barcode/product/generate/${productId}/${idCombination}`;

        fetch(generateUrl, {
        method: 'GET',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            // console.log(reponse)
            return response.json(); 
        })
        .then(data => {
            console.log("Generation successful:", data);
            // EANinput.value = data.html;
            // EANinput.setAttribute("value", data.html)
            
            const saveButton = document.querySelector("#save-combinations-edition");
            if (saveButton) {
                // saveButton.removeAttribute("disabled")
                saveButton.click();
            } else {
                console.log("Element not found!");
            }

        })
        .catch(error => {
            console.error("Error generating EAN:", error);
        });
    }else{
 
        
        const printUrl = `https://webtools.all-stars-motorsport.com/barcode/product/print/${productId}/${idCombination}`;
        window.open(printUrl, '_blank', 'width=1200,height=900');
        // fetch(printUrl, {
        //     method: 'GET',
        //     })
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error(`HTTP error! status: ${response.status}`);
        //         }
                
        //         return response.json(); 
        //     })
        //     .then(data => {
        //         console.log("Generation successful:", data.html);

        //         let printWindow = window.open('', '', 'width=1200,height=900');
    
        //         // Write the HTML content into the new window
        //         printWindow.document.write('<html><head><title>Print Ean13</title></head><body>');
        //         printWindow.document.write(data.html);
        //         printWindow.document.write('</body></html>');
                
        //         // Ensure the page is fully loaded before triggering print
        //         printWindow.document.close(); // Close the document to ensure the content is rendered
            
        //         // Wait for a short moment to ensure the content is rendered before printing
        //         printWindow.onload = function() {
        //             // Trigger the print dialog
        //             printWindow.print();
                    
        //             // Optionally, you can close the window after printing
        //             printWindow.close();
        //         };
        //     })
        //     .catch(error => {
        //         console.error("Error generating EAN:", error);
        //     });
    }

}

function generateEan() {
    const EANinput = document.querySelector("#product_details_references_ean_13");
    const EANvalue = EANinput.value;
    const productIdDetails = document.querySelector(".product-form").getAttribute("data-product-id")
    const btn_detailsEAN = document.querySelector("#product_details_print_ean_btn");

    if(EANvalue == ''){
        const generateUrl = `https://webtools.all-stars-motorsport.com/barcode/product/generate/${productIdDetails}/0`;

        fetch(generateUrl, {
        method: 'GET',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            console.log(reponse)
            return response.json(); 
        })
        .then(data => {
            console.log("Generation successful:", data);
            EANinput.value = data;
            EANinput.setAttribute("value", data)
            
            const saveButton = document.querySelector("#product_footer_save");
            if (saveButton) {
                saveButton.removeAttribute("disabled")
                saveButton.click();
            } else {
                console.log("Element not found!");
            }

        })
        .catch(error => {
            console.error("Error generating EAN:", error);
        });
    }else{
        const printUrl = `https://webtools.all-stars-motorsport.com/barcode/product/print/${productIdDetails}/0/1`;
        window.open(printUrl, '_blank', 'width=1200,height=900');
        // fetch(printUrl, {
        //     method: 'GET',
        //     })
        //     .then(response => {
        //         console.log(response)
        //         if (!response.ok) {
        //             throw new Error(`HTTP error! status: ${response.status}`);
        //         }
        //         return response.json(); 
        //     })
        //     .then(data => {
        //         console.log("Generation successful:", data.html);

        //         let printWindow = window.open('', '', 'width=1200,height=900');
    
        //         // Write the HTML content into the new window
        //         printWindow.document.write('<html><head><title>Print Ean13</title></head><body>');
        //         printWindow.document.write(data.html);
        //         printWindow.document.write('</body></html>');
                
        //         // Ensure the page is fully loaded before triggering print
        //         printWindow.document.close(); // Close the document to ensure the content is rendered
            
        //         // Wait for a short moment to ensure the content is rendered before printing
        //         printWindow.onload = function() {
        //             // Trigger the print dialog
        //             printWindow.print();
                    
        //             // Optionally, you can close the window after printing
        //             printWindow.close();
        //         };
        //     })
        //     .catch(error => {
        //         console.error("Error printing EAN:", error);
        //     });
    }
}


function searchOrderByTracking(e) {
    if(e.key == "Enter"){
        searchTracking(e.target.value);
    }
}

function searchTracking(tracking) {

    const token = document.querySelector("body.adminorders").getAttribute("data-token")

    const trackingUrl = `/admineuromus1/index.php/sell/orders/?_token=${token}&tracking=${tracking}`

    fetch(trackingUrl, {
            method: 'GET',
        })
        .then(response => {
    
            if (!response.ok) {
                throw new Error(`Request failed with status ${response.status}`);
            }
    
            // Only attempt to parse JSON if it's not a redirect
            return response.json();
        })
        .then(data => {
            window.location.href = data.response.targetUrl;
            // Optionally, process the order data and update the UI here
        })
        .catch(error => {
            document.querySelector(".tracking_not_found").classList.add('showTrackingAlert')
        });
}

function carrierGenerateExpedition(e){

    const form = document.querySelector("form[name='update_order_shipping']")
    const navTabs =  document.querySelectorAll(".nav-shipping-asd .nav-item")

    const orderWeightTR = document.querySelectorAll("#shipping-grid-table tbody tr")[0] 
    let orderWeightInput,orderWeightInputValidation,orderWeight,orderWeightValue,btnsave,alertShippingNotSaved;
    if(orderWeightTR){
        orderWeightInput = orderWeightTR.querySelector("input[name='update_order_shipping[shipping_weight]']")
        orderWeightInputValidation = orderWeightTR.querySelector(".carrier-weight .invalid-feedback")
        orderWeight = orderWeightTR.querySelector(".carrier-weight input").getAttribute("value")
        orderWeightValue = orderWeightTR.querySelector(".carrier-weight input").value
        btnsave =  orderWeightTR.querySelector(".btns-action-shipping-asg .btn-link")
        alertShippingNotSaved = document.querySelector(".shipping-notsaved-asgroup")
    }

    let isActive = false;
    let idSelected = '';

    navTabs.forEach((item) => {
        const link = item.querySelector(".nav-link")
        // Check if the item has the class "active"
        if (link.classList.contains("active")) {
            // Perform some action
            idSelected =  item.querySelector("a").getAttribute("id")
            // Example action: Add another class or change text
            isActive = true;
        }
    });

    if(isActive){
        console.log(idSelected)


        const weightInputValue = document.querySelector("input[name='update_order_shipping[shipping_weight]']").value;
        const weightValue = document.querySelector("input[name='update_order_shipping[shipping_weight]']").getAttribute("value");

        if(idSelected == 'orderShippingNACEX'){
            // document.querySelector("input[name='submitputexpedicion']").click()
            const selectNacex = document.querySelector(".nav-item-select-nacex #select-nacex")

            if(selectNacex.value == 'default'){
                selectNacex.style.outline = "2px solid red"
            }

            if(weightValue == 0 && weightValue == weightInputValue){
                orderWeightInput.classList.add("input-error");
                orderWeightInputValidation.classList.add("show-validation")
                orderWeightInput.focus()

                orderWeightInput.addEventListener("blur", () => {
                    orderWeightInput.classList.remove("input-error");
                    orderWeightInputValidation.classList.remove("show-validation")
                });
            }

            if(weightInputValue != weightValue){
                form.submit();
            }

            if(selectNacex.value != 'default' && weightValue > 0 && weightInputValue == weightValue) {
                // document.querySelector("input[name='submitputexpedicion']").click()
            }

        }else if(idSelected == 'orderShippingUPS'){
            save_settings('custom_package')
            
            if(weightValue == 0 && weightValue == weightInputValue){
                orderWeightInput.classList.add("input-error");
                orderWeightInputValidation.classList.add("show-validation")
                orderWeightInput.focus()

                orderWeightInput.addEventListener("blur", () => {
                    orderWeightInput.classList.remove("input-error");
                    orderWeightInputValidation.classList.remove("show-validation")
                });
            }

            if(weightInputValue != weightValue){
                form.submit();
            }

            // document.querySelector("#generate_shipping_label").click()
        }else if(idSelected == 'orderShippingDPD'){
            form.submit();
        }
    }else{
        console.log("not active")
        form.submit();
    }


}