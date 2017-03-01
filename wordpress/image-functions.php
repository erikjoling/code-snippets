<?php

/**
 * Get all image sizes
 */
function ejo_get_all_image_sizes()
{
	/**
	 * Default Image Sizes 
	 *
	 * Responsive image size `medium_large` is excluded. Maybe include in future?
	 */
	$image_sizes = array( 'thumbnail', 'medium', 'large' );

	/* Additional Image Sizes */
	global $_wp_additional_image_sizes;
	$additional_image_sizes = (!empty($_wp_additional_image_sizes)) ? array_keys($_wp_additional_image_sizes) : array();

	/* Merge all Image Sizes */
	$all_image_sizes = array_merge($image_sizes, $additional_image_sizes);

	return $all_image_sizes
}

/**
 * Usable way to get Image Data
 *
 * @param: Attachment ID, image-size 
 * @return: array or false
 */
function ejo_get_image( $image_id, $image_size = 'full' )
{
	/* Get image */
	$wp_image_data = wp_get_attachment_image_src( $image_id , $image_size );

	/* Stop if no image could be found */
	if ( !$wp_image_data )
		return false;

	/* Setup usable image data */
	$image = array();
	$image['id'] = $image_id;
	$image['src'] = $wp_image_data[0];
	$image['size'] = $image_size;
	$image['width'] = $wp_image_data[1];
	$image['height'] = $wp_image_data[2];

	return $image;
}	