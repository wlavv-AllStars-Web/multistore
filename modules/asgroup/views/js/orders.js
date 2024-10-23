document.addEventListener("DOMContentLoaded", () => {
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


    // Create a div container for the buttons
    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('custom-button-container'); // Add a class for styling if needed

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
    const btnGroup = document.querySelector("#order_grid_panel .card-body .btn-group");
    if (btnGroup) {
        // btnGroup.insertAdjacentElement("afterend", buttonContainer);
        btnGroup.appendChild(buttonContainer);
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
});

document.addEventListener("DOMContentLoaded", () => {
    const partialRefundDisplay = document.querySelector('.partial-refund-display'); // Adjust the selector to match your button bar

    if (partialRefundDisplay) {
        // Create the input field
        const inputDiv = document.createElement('div');
        inputDiv.classList.add('d-inline-block', 'ml-2');
        inputDiv.innerHTML = `
            <div class="input-group">
                <input type="text" name="ean" placeholder="Enter EAN" class="form-control" />
            </div>
        `;

        
        partialRefundDisplay.insertAdjacentElement('afterend', inputDiv);

        // REMOVE PRINT ORDER
        const printOrderButton = document.querySelector('.js-print-order-view-page'); // Adjust this selector as necessary
        if (printOrderButton) {
            printOrderButton.parentElement.remove(); // Removes the print button
        }

        // REMOVE VIEW DELIVERY SLIP
        const deliveryslip = document.querySelector('.order-actions-delivery')
        if(deliveryslip) {
            deliveryslip.remove()
        }

    }

    // add event click on paymnet

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
})