<?php

/** 
 * Add theme style formats
 */
function ejo_extra_style_formats($style_formats)
{
	/* Add button-class to anchors */
    $style_formats[] =  array(
        'title' => 'Button',
        'selector' => 'a',
        'classes' => 'button'
    );

    return $style_formats;
}

/* Add style formats */
add_filter( 'ejo_tinymce_style_formats', 'ejo_extra_style_formats' );