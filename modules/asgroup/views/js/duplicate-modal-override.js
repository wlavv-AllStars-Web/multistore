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

    // Attach handler once each time modal is shown
    const $confirmBtn = $(this).find('.btn-confirm-submit');
    $confirmBtn.off('click.custom-duplicate'); // Remove previous to avoid stacking
    $confirmBtn.on('click.custom-duplicate', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      const checkboxValue = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;

      if ($lastClickedDuplicateBtn) {
        let url = $lastClickedDuplicateBtn.attr('data-url') || '';

        // Clean old param
        url = url.replace(/([?&])duplicateimages=\d+(&|$)/, '$1').replace(/&$/, '');

        const separator = url.includes('?') ? '&' : '?';
        url += `${separator}duplicateimages=${checkboxValue}`;

        // Trigger redirect manually
        window.location.href = url;
      }
    });
  });
});
