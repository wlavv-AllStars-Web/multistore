$(document).ready(function () {
    const modalSelector = '#product-grid-confirm-modal';
    let $lastClickedDuplicateBtn = null;

    // 1. Track the clicked duplicate button
    $(document).on('click', '.js-submit-row-action.grid-duplicate', function () {
        $lastClickedDuplicateBtn = $(this);
        console.log("Duplicate button clicked, tracking the button:", $lastClickedDuplicateBtn);
    });

    // 2. Inject the checkbox and update data-url when modal opens
    $(document).on('shown.bs.modal', modalSelector, function () {
        console.log("Modal shown!");
        
        const $modalBody = $(this).find('.modal-body');
        console.log("Modal body:", $modalBody);

        // Inject checkbox only once
        if ($modalBody.find('#duplicate-images-checkbox').length === 0) {
            console.log("Injecting checkbox into the modal!");
            $modalBody.append(`
                <div class="form-group mt-3">
                    <input type="checkbox" id="duplicate-images-checkbox" />
                    <label for="duplicate-images-checkbox">Also duplicate images</label>
                </div>
            `);
        }

        // Update the data-url on modal open using checkbox state
        updateDataUrl();
    });

    // 3. When the checkbox state changes, update the data-url
    $(document).on('change', '#duplicate-images-checkbox', function () {
        console.log("Checkbox state changed!");
        updateDataUrl();
    });

    // 4. Function to update the data-url based on checkbox state
    function updateDataUrl() {
        const checkboxState = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;
        console.log("change checkbox -> " + checkboxState);  // Proper logging here
        
        const checkboxValue = checkboxState;
        console.log("checkboxValue -> " + checkboxValue);  // Log the actual checkbox value for clarity

        // Ensure there is a valid last clicked button
        if ($lastClickedDuplicateBtn) {
            let url = $lastClickedDuplicateBtn.attr('data-url');
            console.log("URL before update: ", url);

            // Remove old param if present
            url = url.replace(/([?&])duplicateimages=\d(&|$)/, '$1').replace(/&$/, '');
            console.log("URL after removing old param: ", url);

            // Add new param
            const separator = url.includes('?') ? '&' : '?';
            url += `${separator}duplicateimages=${checkboxValue}`;
            console.log("Final URL: ", url);

            // Set the updated URL
            $lastClickedDuplicateBtn.attr('data-url', url);
        }
    }
});
