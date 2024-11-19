// Function to preload form content via AJAX
function preloadFormContent(formID) {
    $.ajax({
        url: ajax_object.ajaxurl,  // Ensure this is correct
        type: 'POST',
        data: {
            action: 'load_popup_form',  // WordPress action
            form_id: formID             // The form ID to load
        },
        success: function(response) {
            console.log("AJAX response:", response);  // Log the response for debugging

            if (response) {
                $('#form-content').html(response);  // Insert the response content into the form

                // Once the iframe is loaded, apply iframe resizing (if needed)
                $('#form-content iframe').on('load', function () {
                    var iframe = $(this);
                    var id = iframe.attr('id');
                    console.log('Iframe Loaded: ' + id);

                    // Apply iFrame Resizer (only if needed)
                    iframe.iFrameResize({
                        checkOrigin: false,
                        log: true,
                        sizeHeight: true
                    });
                });
            } else {
                console.error("No response content or an error occurred.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);  // Log any AJAX error
        }
    });
}