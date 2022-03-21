jQuery(function ($) {

    // Ajax form customise
    let form = $('#form-new-product'),
        label = $('.file-label'),
        labelVal = label.html(),
        options = {
        url: ajax_form_object.url,
        data: {
            action: 'ajax_form_action'
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            $('#form-submit').val('Sending...');
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // If succes
                if ( $('.succes-message') ) {
                    $('.succes-message').remove();
                }
                form.after(request.data).slideDown();
                
                $('#form-submit').val('Create');
                label.html(labelVal);
            } else {
                // If wrong
                if ( $('.succes-message') ) {
                    $('.succes-message').remove();
                }
                $('#form-submit').val('Something wrong. Try again');
            }
            // Reset fields if succes
            form[0].reset();
        },
        error: function (request, status, error) {
            if ( $('.succes-message') ) {
                $('.succes-message').remove();
            }
            $('#form-submit').val('Something wrong. Try again');
        }
    };
    // Send form
    form.ajaxForm(options);
});