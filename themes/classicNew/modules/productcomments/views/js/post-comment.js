jQuery(document).ready(function () {
  const $ = jQuery;
  const isDesktop = window.screen.width >= 769;

  console.log("paulo 1")

  const selectors = {
    postCommentModal: isDesktop
      ? '#product_reviews #post-product-comment-modal'
      : '.container-reviews-mobile #post-product-comment-modal',
    commentPostedModal: isDesktop
      ? '#product_reviews #product-comment-posted-modal'
      : '.container-reviews-mobile #product-comment-posted-modal',
    commentPostErrorModal: isDesktop
      ? '#product_reviews #product-comment-post-error'
      : '.container-reviews-mobile #product-comment-post-error',
    postProductCommentButton: isDesktop
      ? '#product_reviews .post-product-comment'
      : '.container-reviews-mobile .post-product-comment',
    commentForm: isDesktop
      ? '#product_reviews #post-product-comment-form'
      : '.container-reviews-mobile #post-product-comment-form',
    gradeStars: isDesktop
      ? '#product_reviews #post-product-comment-modal .grade-stars'
      : '.container-reviews-mobile #post-product-comment-modal .grade-stars',
  };

  const postCommentModal = $(selectors.postCommentModal);
  const commentPostedModal = $(selectors.commentPostedModal);
  const commentPostErrorModal = $(selectors.commentPostErrorModal);

  // Attach click handler to post-product-comment button
  $('body').on('click', selectors.postProductCommentButton, function (event) {
    event.preventDefault();
  
    console.log('button clicked'); 
    showPostCommentModal();
  });

  postCommentModal.on('hidden.bs.modal', function () {
    postCommentModal.modal('hide');
    clearPostCommentForm();
  });

  function showPostCommentModal() {
    commentPostedModal.modal('hide');
    commentPostErrorModal.modal('hide');
    postCommentModal.modal('show');
  }

  function showCommentPostedModal() {
    postCommentModal.modal('hide');
    commentPostErrorModal.modal('hide');
    clearPostCommentForm();
    commentPostedModal.modal('show');
  }

  function showPostErrorModal(errorMessage) {
    postCommentModal.modal('hide');
    commentPostedModal.modal('hide');
    clearPostCommentForm();
    $('#product-comment-post-error-message').html(errorMessage);
    commentPostErrorModal.modal('show');
  }

  function clearPostCommentForm() {
    const form = $(selectors.commentForm);
    form.find('input[type="text"]').val('').removeClass('valid error');
    form.find('textarea').val('').removeClass('valid error');
    form.find('.criterion-rating input').val(3).trigger('change');
  }

  function initCommentModal() {
    $(selectors.gradeStars).rating();
    $(selectors.commentForm).on('submit', submitCommentForm);
  }

  function submitCommentForm(event) {
    event.preventDefault();
    const formData = $(this).serializeArray();
    if (!validateFormData(formData)) return;

    $.post($(this).attr('action'), $(this).serialize(), function (jsonData) {
      if (jsonData) {
        if (jsonData.success) {
          clearPostCommentForm();
          showCommentPostedModal();
        } else if (jsonData.errors) {
          const errorList = jsonData.errors.map(error => `<li>${error}</li>`).join('');
          showPostErrorModal(`<ul>${errorList}</ul>`);
        } else {
          const decodedErrorMessage = $('<div/>').html(jsonData.error).text();
          showPostErrorModal(decodedErrorMessage);
        }
      } else {
        showPostErrorModal(productCommentPostErrorMessage);
      }
    }).fail(function () {
      showPostErrorModal(productCommentPostErrorMessage);
    });
  }

  function validateFormData(formData) {
    let isValid = true;
    formData.forEach(function (formField) {
      const fieldSelector = `${selectors.commentForm} [name="${formField.name}"]`;
      const field = $(fieldSelector);
      if (!formField.value) {
        field.addClass('error').removeClass('valid');
        isValid = false;
      } else {
        field.removeClass('error').addClass('valid');
      }
    });
    return isValid;
  }

  initCommentModal();
});
