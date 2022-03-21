jQuery(function($){

	// Custom upliad image field
	$('.custom-upload-button').click( function(event) {
		event.preventDefault();
 
		const button = $(this);
		const customUploader = wp.media({
			title: 'Select img',
			library : {
				type : 'image'
			},
			button: {
				text: 'Insert'
			},
			multiple: false
		});
 
		// Custom uploader handler
		customUploader.on('select', function() {
 
			const image = customUploader.state().get('selection').first().toJSON();
 
			button.parent().find('.custom-upload-img').attr( 'src', image.url );
			button.parent().find('.custom-upload-input').val( image.id );
 
		});
 
		// Open modal
		customUploader.open();
	});

	// Delete button handler
	$('.custom-upload-remove-button').click( function(event) {
		event.preventDefault();

		if ( true == confirm( "Are you sure?" ) ) {
			const src = $(this).parent().find('.custom-upload-img').data('default');
			$(this).parent().find('.custom-upload-img').attr('src', src);
			$(this).parent().find('.custom-upload-input').val('');
		}
	});

	// Create new upload product button
	(function() {
		const buttonPublish = $('#publish'),
			  newButtonPublish = buttonPublish;
		
		newButtonPublish.attr('id', 'new-publish');
		newButtonPublish.addClass('new-button');

		$('#general_product_data').append(newButtonPublish);
	}());
	
	// Create clear custom fields button
	(function() {
		const buttonClearCustomFields = $('<button id="clear-custom-fields-button" class="button button-primary button-large new-button">Clear custom fields</button>');
		$('#general_product_data').append(buttonClearCustomFields);
	}())

	// Create clear custom fields button handler
	$(document).on('click', '#clear-custom-fields-button', function(event) {
		event.preventDefault();
		const customImg = $('.custom-upload-img'),
			  customImgdefaultSrc = customImg.data('default');

		$('#select_type').val(' ');
		$('#create_date').val('');
		$('#custom_picture').val('');
		customImg.attr('src', customImgdefaultSrc);
	})
});