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

  // Override the confirm duplicate button behavior
  $(document).on('click', '.btn-confirm-submit', function (e) {
    e.preventDefault(); // 🚫 Prevent PrestaShop's default behavior
    e.stopImmediatePropagation(); // ✅ Stop other click handlers from running

    const checkboxValue = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;

    if ($lastClickedDuplicateBtn) {
      let url = $lastClickedDuplicateBtn.attr('data-url');

      // Remove existing duplicateimages param
      url = url.replace(/([?&])duplicateimages=\d+(&|$)/, '$1').replace(/&$/, '');

      // Add new param
      const separator = url.includes('?') ? '&' : '?';
      url += `${separator}duplicateimages=${checkboxValue}`;

      console.log('Redirecting to:', url);

      // 🔁 Do the actual redirect
      window.location.href = url;
    }
  });
});
