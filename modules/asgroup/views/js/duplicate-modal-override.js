$(document).ready(function () {
  const modalSelector = '#product-grid-confirm-modal';
  let $lastClickedDuplicateBtn = null;

  // 1. Track the clicked duplicate button
  $(document).on('click', '.js-submit-row-action.grid-duplicate', function () {
    $lastClickedDuplicateBtn = $(this);
  });

  // 2. Inject the checkbox and update data-url when modal opens
  $(document).on('shown.bs.modal', modalSelector, function () {
    const $modalBody = $(this).find('#product-grid-confirm-modal .modal-body');

    // Inject checkbox only once
    if ($modalBody.find('#duplicate-images-checkbox').length === 0) {
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
    updateDataUrl();
  });

  // 4. Function to update the data-url based on checkbox state
  function updateDataUrl() {
    const checkboxState = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;
    console.log("change checkbox -> " + checkboxState);  // Proper logging here
    
    const checkboxValue = checkboxState;
    console.log("checkboxValue -> " + checkboxValue);  // Log the actual checkbox value for clarity

    let url = $lastClickedDuplicateBtn.attr('data-url');

    // Remove old param if present
    url = url.replace(/([?&])duplicateimages=\d(&|$)/, '$1').replace(/&$/, '');

    // Add new param
    const separator = url.includes('?') ? '&' : '?';
    url += `${separator}duplicateimages=${checkboxValue}`;

    // Set the updated URL
    $lastClickedDuplicateBtn.attr('data-url', url);
  }
});
