<?php

/* Check if EJO-base is installed (dependancy) */
function ejo_check_dependancies( $dependancies) 
{
	/* Needs array as datastructure, so convert string to array */
	if ( is_string($dependancies) )
		$dependancies = explode( ",", $dependancies );

	/* Check all dependancies */
	foreach ($dependancies as $dependancy) {

		/* Remove possible trailing white spaces */
		$dependancy = trim($dependancy);

		/* Check if EJO-base is installed */
		if ($dependancy == 'ejo-base') { 

			if ( !class_exists( 'EJO_Base' ) ) {

				/* Display notice in admin */
				if (is_admin()) {
					add_action( 'admin_notices', function(){
						echo '<div class="notice notice-error"><p>';
						echo __( 'Error: EJO Base plugin is not installed. The current theme is dependant on it. Install EJO Base or switch your theme.', 'rmrt' );
						echo '</p></div>';
					});
				}
				/* Interrupt frontend */
				else {
					wp_die( __( 'Error: EJO Base plugin is not installed. Please contact the webmaster.', 'rmrt' ) );
				}
			}
		}

		/* Check if Carbon Fields is installed */
		if ($dependancy == 'carbon-fields') { 

			if ( !class_exists( 'Carbon_Fields\Helper\Helper' ) ) {

				/* Display notice in admin */
				if (is_admin()) {
					add_action( 'admin_notices', function(){
						echo '<div class="notice notice-error"><p>';
						echo __( 'Error: Carbon Fields plugin is not installed. The current theme is dependant on it. Install Carbon Fields or switch your theme.', 'rmrt' );
						echo '</p></div>';
					});
				}
				/* Interrupt frontend */
				else {
					wp_die( __( 'Error: Carbon Fields plugin is not installed. Please contact the webmaster.', 'rmrt' ) );
				}
			}
		}
	}
}