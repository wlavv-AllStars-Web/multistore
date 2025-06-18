$(document).ready(function () {
  const modalSelector = '#product-grid-confirm-modal';
  let $lastClickedDuplicateBtn = null;

  // Track the clicked duplicate button
  $(document).on('click', '.js-submit-row-action.grid-duplicate', function () {
    $lastClickedDuplicateBtn = $(this);
  });

  // When modal opens
  $(document).on('shown.bs.modal', modalSelector, function () {
    const $modalBody = $(this).find('.modal-body');

    // Inject the checkbox if not already added
    if ($modalBody.find('#duplicate-images-checkbox').length === 0) {
      const $checkboxContainer = $(`
        <div class="form-group mt-3">
          <input type="checkbox" id="duplicate-images-checkbox" />
          <label for="duplicate-images-checkbox">Also duplicate images</label>
        </div>
      `);

      $modalBody.append($checkboxContainer);

      // Listen for checkbox changes and update data-url
      $checkboxContainer.find('#duplicate-images-checkbox').on('change', function () {
        updateDuplicateUrl();
      });
    }

    // Initial update on modal open (in case checkbox is toggled before confirmation)
    updateDuplicateUrl();
  });

  // Update the URL parameter based on checkbox state
  function updateDuplicateUrl() {
    if (!$lastClickedDuplicateBtn) return;

    const checkboxValue = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;
    let url = $lastClickedDuplicateBtn.attr('data-url');

    // Remove existing duplicateimages param
    url = url.replace(/([?&])duplicateimages=\d+(&|$)/, '$1').replace(/&$/, '');

    const separator = url.includes('?') ? '&' : '?';
    url += `${separator}duplicateimages=${checkboxValue}`;

    $lastClickedDuplicateBtn.attr('data-url', url);
  }
});
