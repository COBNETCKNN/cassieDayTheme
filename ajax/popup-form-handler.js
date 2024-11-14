jQuery(document).ready(function ($) {
  $('.cta-button').on('click', function (e) {
      e.preventDefault();
      // Get the formID from the button or localStorage
      var formID = $(this).data('form-id') || localStorage.getItem('formId');

      if (!formID) {
          alert('Form ID not found.');
          return;
      }

      $.ajax({
          url: ajax_object.ajaxurl,
          type: 'POST',
          data: {
              action: 'load_popup_form',
              form_id: formID
          },
          success: function (response) {
              $('#form-content').html(response);
              $('#form-content iframe').on('load', function () {
                  var iframe = $(this);
                  var id = iframe.attr('id');
                  console.log('Iframe Loaded: ' + id);

                  // Apply iFrame Resizer
                  iframe.iFrameResize({
                      checkOrigin: false,
                      log: true,
                      sizeHeight: true
                  });
              });
              $('#form-popup').removeClass('hidden').addClass('active');
              $('body').css('overflow', 'hidden'); // Prevent scrolling
          },
          error: function () {
              alert('Failed to load form.');
          }
      });
  });

  // Close popup on button click
  $('#close-popup').on('click', function () {
      closePopup();
  });

  // Close popup on ESC key press
  $(document).on('keydown', function (e) {
      if (e.keyCode === 27 && $('#form-popup').hasClass('active')) {
          closePopup();
      }
  });

  // Close popup when clicking outside of it
  $(document).on('click', function (e) {
      if ($('#form-popup').hasClass('active') && !$(e.target).closest('#form-content, .cta-button').length) {
          closePopup();
      }
  });

  // Function to close the popup
  function closePopup() {
      $('#form-popup').removeClass('active').addClass('hidden');
      $('body').css('overflow', ''); // Restore scrolling
  }
});