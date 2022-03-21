jQuery(function($) {

    // Upload file input customise
    (function() {
        let inputs = $('.file-input');
        if ( inputs ) {
            $.each(inputs, (index, input) => {
                let label = $(input).prev('.file-label'),
                labelVal = $(label).html();
            
                $(input).on('change', event => {
                    let newLabelVal = '';
                    if (input.files && input.files.length >= 1) {
                        newLabelVal = input.files[0].name;
                    }

                    if (newLabelVal) {
                        $(label).html(newLabelVal);
                    } else {
                        $(label).html(labelVal);
                    }
                })
            })
        }	
	}());
});