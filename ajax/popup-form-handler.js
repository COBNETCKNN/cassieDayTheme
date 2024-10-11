jQuery(document).ready(function($) {
    $('.cta-button').on('click', function(e) {
        e.preventDefault();
        var formID = $(this).data('form-id');

        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_popup_form',
                form_id: formID
            },
            success: function(response) {
                $('#form-content').html(response);
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

                $('#form-popup').removeClass('hidden').addClass('active');
                $('body').css('overflow', 'hidden'); // Prevent scrolling
            },
            error: function() {
                alert('Failed to load form.');
            }
        });
    });

    // Close popup on button click
    $('#close-popup').on('click', function() {
        $('#form-popup').removeClass('active').addClass('hidden');
        $('body').css('overflow', ''); // Restore scrolling
    });

    // Close popup on ESC key press
    $(document).on('keydown', function(e) {
        if (e.keyCode === 27) { // ESC key code
            if ($('#form-popup').hasClass('active')) {
                $('#form-popup').removeClass('active').addClass('hidden');
                $('body').css('overflow', ''); // Restore scrolling
            }
        }
    });
});