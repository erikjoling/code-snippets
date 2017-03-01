<?php

/**
 * @param int|object $post
 * @return mixed  String of post-summary on success or false on failure.
 */
if ( !function_exists('ejo_the_post_summary') ) {

	function ejo_the_post_summary( $post = null ) 
	{
		echo ejo_get_post_summary( $post );
	}
}

/**
 * @param int|object $post
 * @return mixed  String of post-summary on success or empty string on failure.
 */
if ( !function_exists('ejo_get_post_summary') ) {

	function ejo_get_post_summary( $post = null ) {

		// if integer or null, get post object
		if ( is_int($post) || is_null($post) ) {
			$post = get_post( $post );
		}

		// if $post is not object, return
		if ( !is_object($post) )
			return '';

		// Check if post_excerpt exists, otherwise process post_content
		if ( !empty($post->post_excerpt) ) {
			$content = $post->post_excerpt;
			$content = apply_filters( 'the_excerpt', $content );
			$content = apply_filters( 'get_the_excerpt', $content );
		}
		else {
			$content = $post->post_content;
			$content = wp_trim_words( $content );
			$content = apply_filters( 'the_content', $content );
			$content = str_replace(']]>', ']]&gt;', $content);
		}

		return $content;
	}
}

// EJO content filters
// add_filter( 'ejo_the_content', 'wptexturize'                       );
// add_filter( 'ejo_the_content', 'convert_smilies',               20 );
// add_filter( 'ejo_the_content', 'wp_trim_words'                     );
// add_filter( 'ejo_the_content', 'wpautop'                           );
// add_filter( 'ejo_the_content', 'shortcode_unautop'                 );
// add_filter( 'ejo_the_content', 'prepend_attachment'                );
// add_filter( 'ejo_the_content', 'wp_make_content_images_responsive' );
// add_filter( 'ejo_the_content', 'do_shortcode',                  11 ); // AFTER wpautop()

// EJO excerpt filters
// add_filter( 'ejo_the_excerpt', 'wptexturize'       );
// add_filter( 'ejo_the_excerpt', 'convert_smilies'   );
// add_filter( 'ejo_the_excerpt', 'convert_chars'     );
// add_filter( 'ejo_the_excerpt', 'wpautop'           );
// add_filter( 'ejo_the_excerpt', 'shortcode_unautop' );
// add_filter( 'ejo_the_excerpt', 'do_shortcode'      );
// add_filter( 'ejo_the_excerpt', 'wp_trim_excerpt'  );
