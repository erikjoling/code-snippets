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

/**
 * Customizer: Remove Sections 
 *
 * 
 */
add_action( 'customize_register', 'ejo_customize_register', 99 );
// add_action( 'customize_register', 'ejo_test_customizer' );
// add_action( 'customize_controls_init', 'ejo_test_customizer' );



function ejo_test_customizer()
{
	global $wp_customize;
}

function ejo_customize_register( $wp_customize )
{
	$wp_customize->remove_section( 'title_tagline' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'custom_css' );

	$wp_customize->add_panel( 'ejo_panel', array(
	    'priority'       => 10,
	    'title'          => 'EJO Panel',
	    'description'    => 'My custom panel',
	) );

	$wp_customize->add_section( 'ejo_section', array(
	    'panel'			 => 'ejo_panel',
	    'priority'       => 10,
	    'title'          => 'EJO Section',
	    'description'    => 'My custom section',
	) );

	/* EJO Test settings */

	$wp_customize->add_setting( 'ejo_setting', array(
		'default'    => 'TEST!',
		'type'       => 'option',
	) );

	$wp_customize->add_control( 'ejo_control', array(
		'label'      => __( 'EJO Setting Control' ),
		'section'    => 'ejo_section',
		'settings'   => 'ejo_setting',
	) );

	/* Site Identity */

	$wp_customize->add_section( 'title_tagline', array(
		'panel'    => 'ejo_panel',
		'title'    => __( 'Site Identity' ),
		'priority' => 20,
	) );
}