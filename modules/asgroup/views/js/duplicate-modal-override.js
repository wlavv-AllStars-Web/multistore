$(document).ready(function () {
  const modalSelector = '#product-grid-confirm-modal';
  let $lastClickedDuplicateBtn = null;

  // Track which duplicate button was clicked
  $(document).on('click', '.js-submit-row-action.grid-duplicate', function () {
    $lastClickedDuplicateBtn = $(this);
  });

  // Inject the checkbox when the modal shows
  $(document).on('shown.bs.modal', modalSelector, function () {
    const $modalBody = $(this).find('.modal-body');

    // Inject the checkbox only once
    if ($modalBody.find('#duplicate-images-checkbox').length === 0) {
      $modalBody.append(`
        <div class="form-group mt-3">
          <input type="checkbox" id="duplicate-images-checkbox" />
          <label for="duplicate-images-checkbox">Also duplicate images</label>
        </div>
      `);
    }

    // Listen for checkbox state change
    $('#duplicate-images-checkbox').on('change', function () {
      updateDuplicateUrl();
    });

    // Initial URL update based on the checkbox state
    updateDuplicateUrl();
  });

  // Function to update the URL parameter based on checkbox state
  function updateDuplicateUrl() {
    if ($lastClickedDuplicateBtn) {
      const checkboxValue = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;
      let url = $lastClickedDuplicateBtn.attr('data-url') || '';

      // Clean old duplicateimages param
      url = url.replace(/([?&])duplicateimages=\d+(&|$)/, '$1').replace(/&$/, '');

      // Add new duplicateimages param
      const separator = url.includes('?') ? '&' : '?';
      url += `${separator}duplicateimages=${checkboxValue}`;

      // Update the URL of the button (this could be used later)
      $lastClickedDuplicateBtn.attr('data-url', url);
    }
  }

  // Handle the actual submission or redirection when the confirmation button is clicked
  $(document).on('click', '.btn-confirm-submit', function (e) {
    if ($lastClickedDuplicateBtn) {
      let url = $lastClickedDuplicateBtn.attr('data-url');
      if (url) {
        // Trigger the redirection
        window.location.href = url;
      }
    }
  });
});
