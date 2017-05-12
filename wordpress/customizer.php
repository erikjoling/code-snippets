<?php

/**
 * Customizer: Remove Panels
 *
 * Filter must be called before plugins_loaded (priority 10)
 * That means themes won't be able to use this filter
 */
add_filter( 'customize_loaded_components', 'ejo_remove_panels' );

/**
 * Customizer: Remove built-in panels 
 */
function ejo_remove_panels($components)
{
	/* Find the components to remove */
	$widgets_key = array_search( 'widgets', $components );
	$menus_key = array_search( 'nav_menus', $components );

	/* Remove the components */
	if( $widgets_key !== false)
		unset($components[$widgets_key]);

	if( $menus_key !== false)
		unset($components[$menus_key]);

	/* Proceed */
	return $components;
}