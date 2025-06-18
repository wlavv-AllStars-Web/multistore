document.addEventListener('DOMContentLoaded', function () {
  const modalSelector = '#product-grid-confirm-modal';
  let lastClickedDuplicateBtn = null;

  // 1. Track when the duplicate button is clicked
  document.querySelector('.js-submit-row-action.grid-duplicate').addEventListener('click', function () {
    lastClickedDuplicateBtn = this;
  });

  // 2. Inject the checkbox when the modal is opened
  const modal = document.querySelector(modalSelector);
  if (modal) {
    modal.addEventListener('shown.bs.modal', function () {
      const modalBody = modal.querySelector('.modal-body');

      // Inject checkbox only once
      if (!modalBody.querySelector('#duplicate-images-checkbox')) {
        const checkboxContainer = document.createElement('div');
        checkboxContainer.classList.add('form-group', 'mt-3');
        checkboxContainer.innerHTML = `
          <input type="checkbox" id="duplicate-images-checkbox" />
          <label for="duplicate-images-checkbox">Also duplicate images</label>
        `;
        modalBody.appendChild(checkboxContainer);
      }

      // Update the data-url on modal open using checkbox state
      updateDataUrl();
    });
  }

  // 3. Track checkbox state changes
  const checkbox = document.getElementById('duplicate-images-checkbox');
  if (checkbox) {
    checkbox.addEventListener('change', function () {
      // Ensure logging of the correct checkbox state
      const checkboxState = checkbox.checked ? 1 : 0;
      console.log("change checkbox -> " + checkboxState); // Log checkbox state (1 for checked, 0 for unchecked)
      updateDataUrl(); // Update data-url when checkbox state changes
    });
  }

  // 4. Function to update the data-url based on checkbox state
  function updateDataUrl() {
    const checkboxState = checkbox.checked ? 1 : 0;
    const checkboxValue = checkboxState;
    console.log("checkboxValue -> " + checkboxValue);  // Log the actual checkbox value for clarity

    if (lastClickedDuplicateBtn) {
      let url = lastClickedDuplicateBtn.getAttribute('data-url');

      // Remove old param if present
      url = url.replace(/([?&])duplicateimages=\d(&|$)/, '$1').replace(/&$/, '');

      // Add new param
      const separator = url.includes('?') ? '&' : '?';
      url += `${separator}duplicateimages=${checkboxValue}`;

      // Set the updated URL
      lastClickedDuplicateBtn.setAttribute('data-url', url);
    }
  }
});
