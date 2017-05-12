<?php 

/* Remove toolbar */
if ( !current_user_can('administrator') && !is_admin() ) {
	show_admin_bar(false);
}