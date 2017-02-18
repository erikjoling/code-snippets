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
 * Get image height
 */
function ejo_get_image_dimensions( $image_id, $image_size = 'full' )
{
	$image = wp_get_attachment_image_src( $image_id , $image_size );

	if ( !$image )
		return false;

	$image_dimensions = array();
	$image_dimensions['width'] = $image[1];
	$image_dimensions['height'] = $image[2];
	$image_dimensions['src'] = $image[0];
	$image_dimensions['id'] = $image_id;

	return $image_dimensions;
}	
