<?php
//* Add crop settings via Settings API
add_action('admin_init', 'ejo_additional_crop_settings');

function ejo_additional_crop_settings()
{
	register_setting(
		'media',               // settings page
		'medium_crop'          // option name
	);

	register_setting(
		'media',               // settings page
		'large_crop'           // option name
	);
	
	add_settings_field(
		'ejo_image_crop',      	 // id
		'Extra crop settings',   // setting title
		'ejo_medium_image_crop', // display callback
		'media',                 // settings page
		'default'                // settings section
	);

}

// Display and fill the form field
function ejo_medium_image_crop() 
{
	// get crop options from database
	$medium_crop = get_option( 'medium_crop' );
	$large_crop = get_option( 'large_crop' );

	?>
	<input id="medium_crop" type="checkbox" <?php checked($medium_crop); ?> value="1" name="medium_crop">
	<label for="medium_crop">Medium Crop</label>
	<br/>
	<input id="large_crop" type="checkbox" <?php checked($large_crop); ?> value="1" name="large_crop">
	<label for="large_crop">Large Crop</label>
	<?php
}
