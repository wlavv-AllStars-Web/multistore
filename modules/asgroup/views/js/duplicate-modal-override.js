$(document).ready(function () {
  const modalSelector = '#product-grid-confirm-modal';
  let $lastClickedDuplicateBtn = null;

  // Track which duplicate button was clicked
  $(document).on('click', '.js-submit-row-action.grid-duplicate', function () {
    $lastClickedDuplicateBtn = $(this);
  });

  // Inject the checkbox on modal open
  $(document).on('shown.bs.modal', modalSelector, function () {
    const $modalBody = $(this).find('.modal-body');

    // Inject only once
    if ($modalBody.find('#duplicate-images-checkbox').length === 0) {
      $modalBody.append(`
        <div class="form-group mt-3">
          <input type="checkbox" id="duplicate-images-checkbox" />
          <label for="duplicate-images-checkbox">Also duplicate images</label>
        </div>
      `);
    }
  });

  // Intercept confirm click to update the URL
  $(document).on('click', '.btn-confirm-submit', function () {
    const checkboxValue = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;

    if ($lastClickedDuplicateBtn) {
      let url = $lastClickedDuplicateBtn.attr('data-url');

      // Clean old param if exists
      url = url.replace(/([?&])duplicateimages=\d+(&|$)/, '$1').replace(/&$/, '');

      // Add new param
      const separator = url.includes('?') ? '&' : '?';
      url += `${separator}duplicateimages=${checkboxValue}`;

      // Set back the updated URL
      $lastClickedDuplicateBtn.attr('data-url', url);
    }
  });
});
