$(document).ready(function () {
  const modalSelector = '#product-grid-confirm-modal';

  // Inject checkbox into the modal once
  $(document).on('shown.bs.modal', modalSelector, function () {
    const $modalBody = $(this).find('.modal-body');

    if ($modalBody.find('#duplicate-images-checkbox').length === 0) {
      $modalBody.append(`
        <div class="form-group mt-3">
          <input type="checkbox" id="duplicate-images-checkbox" checked />
          <label for="duplicate-images-checkbox">Also duplicate images</label>
        </div>
      `);
    }
  });

  // Modify the data-url of the clicked duplicate button
  $(document).on('click', '.js-submit-row-action.grid-duplicate', function () {
    const $btn = $(this);
    const duplicateImages = $('#duplicate-images-checkbox').is(':checked') ? 1 : 0;

    let url = $btn.attr('data-url');
    if (!url.includes('duplicateimages=')) {
      // Append or update the param
      const separator = url.includes('?') ? '&' : '?';
      url += `${separator}duplicateimages=${duplicateImages}`;
      $btn.attr('data-url', url);
    }
  });
});
