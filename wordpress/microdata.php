<?php 

function ejo_microdata( $slug ) {
	echo ejo_get_microdata( $slug );
}

function ejo_get_microdata( $slug ) {

	$output    	= '';
	$microdata 	= call_user_func( 'ejo_microdata_' . $slug );

	foreach ( $microdata as $microdata_name => $microdata_value )
		$output .= $microdata_value ? sprintf( ' %s="%s"', esc_html( $microdata_name ), esc_attr( $microdata_value ) ) : esc_html( " {$microdata_name}" );

	return trim( $output );
}


function ejo_microdata_author() {

	$microdata['itemprop']  = 'author';
	$microdata['itemscope'] = 'itemscope';
	$microdata['itemtype']  = 'http://schema.org/Person';

	return $microdata;
}

function ejo_microdata_post() {

	$post = get_post();

	// Make sure we have a real post first.
	if ( ! empty( $post ) ) {

		$microdata['itemscope'] = 'itemscope';

		if ( 'post' === get_post_type() ) {

			$microdata['itemtype']  = 'http://schema.org/BlogPosting';

			/* Add itemprop if within the main query. */
			if ( is_main_query() && ! is_search() )
				$microdata['itemprop'] = 'blogPost';
		}

		elseif ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {

			$microdata['itemtype'] = 'http://schema.org/ImageObject';
		}

		elseif ( 'attachment' === get_post_type() && hybrid_attachment_is_audio() ) {

			$microdata['itemtype'] = 'http://schema.org/AudioObject';
		}

		elseif ( 'attachment' === get_post_type() && hybrid_attachment_is_video() ) {

			$microdata['itemtype'] = 'http://schema.org/VideoObject';
		}

		else {
			$microdata['itemtype']  = 'http://schema.org/CreativeWork';
		}

	} else {

	}

	return $microdata;
}

?>