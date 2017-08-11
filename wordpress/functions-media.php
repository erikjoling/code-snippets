<?php

// Allow SVG to be uploaded to Media Library 
add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * Allow SVG to be uploaded to Media Library 
 */
function cc_mime_types($mimes) {

    // Add `svg` mimetype
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}