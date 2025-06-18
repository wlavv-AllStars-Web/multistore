$(document).ready(function () {
  const modalSelector = '#product-grid-confirm-modal';

  // Wait for modal to exist (if triggered dynamically)
  $(document).on('shown.bs.modal', modalSelector, function () {
    const $modalBody = $(this).find('.modal-body');

    // Avoid duplicate injection
    if ($modalBody.find('#duplicate-images-option').length === 0) {
      $modalBody.append(`
        <div class="form-group mt-3" id="duplicate-images-option">
          <input type="checkbox" id="duplicate-images-checkbox" checked />
          <label for="duplicate-images-checkbox">Also duplicate images</label>
        </div>
      `);
    }
  });

  // Intercept the "Duplicate" button
  $(document).on('click', '.btn-confirm-submit', function (e) {
    const duplicateImages = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;

    // Locate the actual duplication URL from the button's parent form or link
    const $modal = $('#product-grid-confirm-modal');
    const $button = $(this);
    const $rowAction = $('button[data-original-title="Duplicate"]:focus, a[data-original-title="Duplicate"]:focus');

    if ($rowAction.length) {
      const originalUrl = $rowAction.data('href') || $rowAction.attr('href');

      if (originalUrl) {
        e.preventDefault();
        const newUrl = originalUrl + (originalUrl.includes('?') ? '&' : '?') + 'duplicate_images=' + duplicateImages;
        window.location.href = newUrl;
      }
    }
  });
});
