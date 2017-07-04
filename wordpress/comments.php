<?php

//
// Comments
//

// Change comment fields
add_filter( 'comment_form_default_fields', 'ejo_comments_remove_url_field' );

// Add comment notice to end of reply-field
add_filter( 'comment_form_submit_field', 'ejo_comment_form_footer', 10, 2 );

// Ward against spambots
add_filter( 'comment_form_default_fields', 'ejo_comments_add_honeypot_fields' );
add_action( 'preprocess_comment', 'ejo_preprocess_comment_honeypot_fields' );

//
// Customizer
//
add_action( "customize_register", "rmrt_customize_register" );


/**
 * Change comment fields
 */
function ejo_comments_remove_url_field( $fields )
{
	unset($fields['url']);

	return $fields;
}

/**
 * Add a footer to the comment-form
 */
function ejo_comment_form_footer( $submit_field, $args )
{
	$output = '';
	$comment_notice = __('Please use your real name or a pseudonym when commenting. Otherwise your comment may be removed.', 'spelflix');
	$comment_notice = '<p class="comment-form-notice">'.$comment_notice.'</p>';

	$output .= '<div class="comment-form-footer">';
	$output .= $submit_field;

	if ( !is_user_logged_in() )
		$output .= $comment_notice;
	
	$output .= '</div>';

	return $output;
}

/**
 * Add two honeypot fields to mislead spambots
 */
function ejo_comments_add_honeypot_fields($fields)
{
	//* Extra honeypot form field to attract spam-bots
	$fields['is_legit'] = 	'<p class="comment-form-legit">' .
								'<label for="is-legit">' . __('Legit 1', 'spelflix') . '</label>' .
								'<input class="is-legit" name="is-legit" type="text" value="" />' . 
							'</p>';

	$fields['is_legit2'] = 	'<p class="comment-form-legit">' .
								'<label for="is-legit2">2 + 2 =</label>' .
								'<input class="is-legit" name="is-legit2" type="text" value="2" />' . 
							'</p>';
	
	return $fields;
}

/** 
 * Fuck off spammers
 * Check if extra honeypot form-field is filled in. If so, then disallow comment
 */ 
function ejo_preprocess_comment_honeypot_fields( $commentdata ) 
{
	// Disallow comment if is-legit is filled in
	if( isset($_POST['is-legit']) && !empty( $_POST['is-legit'] ) )
		die('Bleep! Please do not comment..');

	// Disallow comment if is-legit2 is not 2
	if( isset($_POST['is-legit2']) && $_POST['is-legit2'] != '2' )
		die('Bleep! Please do not comment..');

	return $commentdata;
}