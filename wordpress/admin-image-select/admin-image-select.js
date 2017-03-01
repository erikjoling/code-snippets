jQuery(document).ready(function($){

	//* Load medialibrary and process chosen image
	$('body').on('click', '.ejo-image-upload .upload-button, .ejo-image-upload .image-container img', function(e)
	{
		e.preventDefault();

		var container = $(this).closest('.ejo-image-upload');

		var value_holder = container.find('.image-id');
		var image_container = container.find('.image-container');

		// custom_uploader = wp.media.frames.file_frame = wp.media(
		var custom_uploader = wp.media(
		{
			title: 'Choose Image',
			button: {
	    			text: 'Choose Image'
			},
			multiple: false
		});

		custom_uploader.open();

		custom_uploader.on('select', function()
		{
			// var attachment = custom_uploader.state().get('selection').toJSON();
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			value_holder.val(attachment.id);

			var image = $( '<img />', { src: attachment.sizes.thumbnail.url });

			//* Replace current image with selected
			image_container.html(image);

			value_holder.trigger('change');
			image_container.trigger('change');
		});
	});

	//* Remove image and clear hidden image-id input value
	$('body').on('click', '.ejo-image-upload .remove-button', function(e)
	{
		e.preventDefault();

		var container = $(this).closest('.ejo-image-upload');

		var value_holder = container.find('.image-id');
		var image_container = container.find('.image-container');

		//* Remove value
		value_holder.val('');

		//* Make empty
		image_container.html('');

		value_holder.trigger('change');
		image_container.trigger('change');
	});
});