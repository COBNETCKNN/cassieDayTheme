jQuery(document).ready(function($) {
    // Listen for clicks on any button with the class 'cta-button'
    $('.cta-button').on('click', function(e) {
        e.preventDefault();
        var formID = $(this).data('form-id');

        // Make AJAX call to load form content
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_popup_form',
                form_id: formID
            },
            success: function(response) {
                // Inject the form content into the popup
                $('#form-content').html(response);

                // Find the iframe inside the form and bind a load event to it
                $('#form-content iframe').on('load', function() {
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

                // Show the popup
                $('#form-popup').removeClass('hidden').addClass('active');
            },
            error: function() {
                alert('Failed to load form.');
            }
        });
    });

    // Close popup
    $('#close-popup').on('click', function() {
        $('#form-popup').removeClass('active').addClass('hidden');
    });
});