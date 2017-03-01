<?php 

//* Just register... not only when using widget... ?
add_action( 'admin_enqueue_scripts', 'register_ejo_image_select_files' );

/**
 * Registers and enqueues admin-specific JavaScript and CSS only on widgets page.
 */ 
function register_ejo_image_select_files($hook) 
{
	if ( ! wp_script_is( 'ejo-image-select', 'enqueued' ) && ! wp_style_is( 'ejo-image-select', 'enqueued' ) ) {		
		wp_enqueue_style( 'ejo-image-select', EJO_Base::$uri . 'includes/base/admin-image-select/admin-image-select.css', array(), EJO_Base::$version );
	 
	    // Image Widget
	    wp_enqueue_media();     
	    wp_enqueue_script( 'ejo-image-select', EJO_Base::$uri . 'includes/base/admin-image-select/admin-image-select.js', array('jquery'), EJO_Base::$version, true );
	}
}

function ejo_image_select( $image_id, $field_id = 'ejo-image-id', $field_name = 'ejo-image-id', $label = 'Uitgelichte afbeelding', $upload_button_label = 'Kies een afbeelding', $remove_button_label = 'Verwijder' )
{
	?>
	<div class="ejo-image-upload">
        <label><?php echo $label; ?></label>
        <p class="image-container">
            <?php if ( $image_id ) : ?>

                <?php echo wp_get_attachment_image( $image_id, 'thumbnail', false ); ?>

            <?php endif; ?>
        </p>

        <input type="hidden" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" value="<?php echo $image_id; ?>" class="image-id" />
        <a class="button upload-button" href="#"><?php echo $upload_button_label; ?></a>
        <a class="button remove-button" href="#"><?php echo $remove_button_label; ?></a>
    </div>
    <?php
}