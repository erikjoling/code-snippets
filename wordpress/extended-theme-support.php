<?php

/**
 * Wordpress only accepts arguments at 'current_theme_supports' function for
 * it's own built-in functions. This function can be used for filtering custom 
 * theme supported functions
 *
 * Use:
 * add_filter( 'current_theme_supports-feature', 'ejo_add_extended_theme_support', 10, 3 );
 *
 * Then use in theme:
 * add_theme_support( 'feature', array( 'item1', 'item2' ) );
 *
 * And check in plugin:
 * - require_if_theme_supports( 'feature', path );
 * - if (current_theme_supports( 'feature', 'item1' ))
 */
function ejo_add_extended_theme_support($extended_theme_support = true, $checked_arg = array(), $theme_support_args = false)
{
	//* If array: Check if feature-option is supported by theme
	if ( is_array($theme_support_args) ) {		
		$extended_theme_support = in_array( $checked_arg[0], $theme_support_args[0] );
	}

    return $extended_theme_support;
}
