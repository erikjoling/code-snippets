<?php 

//* Remove styles & scripts
add_action( 'wp_print_styles', 'ejo_remove_styles_and_scripts', 99 );


/**
 * Add editor style
 */
function ejo_add_editor_styles()
{
	$suffix = hybrid_get_min_suffix();

	/* External font */
	// $font_url = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic|Roboto+Slab:400,700' );
	// add_editor_style( $font_url );

	/* Editor Style */
	// add_editor_style( THEME_CSS_URI . "editor-style{$suffix}.css?" . THEME_VERSION );
}

add_action( 'admin_init', 'ejo_add_editor_styles' );