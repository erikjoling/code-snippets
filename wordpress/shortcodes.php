<?php 

/**
 * Theme Shortcodes
 */

// Don't remove the <p>'s and <br>'s around shortcodes
// remove_filter( 'the_content', 'shortcode_unautop' );

// Contact 
add_shortcode( 'telefoon', 'xxx_get_phone' );
add_shortcode( 'email', 'xxx_get_email' );
add_shortcode( 'straat', 'xxx_get_street' );
add_shortcode( 'postcode', 'xxx_get_postcode' );
add_shortcode( 'stad', 'xxx_get_city' );
add_shortcode( 'adres', 'xxx_get_address' );
add_shortcode( 'kvk', 'xxx_get_kvk' );
add_shortcode( 'btw', 'xxx_get_vat' );
add_shortcode( 'algemene_voorwaarden', 'xxx_get_general_terms' );
add_shortcode( 'privacy_policy', 'xxx_get_privacy_policy' );

// Social Media
add_shortcode( 'linkedin', 'xxx_get_linkedin' );
add_shortcode( 'facebook', 'xxx_get_facebook' );
add_shortcode( 'twitter', 'xxx_get_twitter' );
add_shortcode( 'whatsapp', 'xxx_get_whatsapp' );


/**
 * Shortcode-function to get phone output
 */
function xxx_get_phone( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'no-icon' => false
    ), $atts );

    $phone_number = get_option( 'contact_phone' );
    $icon = ($atts['no-icon']) ? '' : do_shortcode('[icon phone circle]');

    return sprintf('<span class="%s">%s%s</span>', 'phone', $icon, $phone_number);
}

/**
 * Shortcode-function to get email output
 */
function xxx_get_email( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'no-icon' => false
    ), $atts );

    $email = get_option( 'contact_email' );
    $icon = ($atts['no-icon']) ? '' : do_shortcode('[icon envelope circle]');

    return sprintf('<a href="%s" class="%s">%s%s</a>', "mailto:$email", 'email', $icon, $email);
}

/**
 * Shortcode-function to get address output
 */
function xxx_get_address( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'no-icon' => false
    ), $atts );

    $street = get_option( 'contact_address_street' );
    $postcode = get_option( 'contact_address_postcode' );
    $city = get_option( 'contact_address_city' );

    return sprintf('<div class="%s">%s<br/>%s %s</div>', 'address', $street, $postcode, $city);
}

/**
 * Shortcode-function to get street output
 */
function xxx_get_street() 
{
    $street = get_option( 'contact_address_street' );

    return $street;
}


/**
 * Shortcode-function to get postcode output
 */
function xxx_get_postcode() 
{
    $postcode = get_option( 'contact_address_postcode' );

    return $postcode;
}

/**
 * Shortcode-function to get city output
 */
function xxx_get_city() 
{
    $city = get_option( 'contact_address_city' );

    return $city;
}

/**
 * Shortcode-function to get kvk output
 */
function xxx_get_kvk() 
{
    $kvk = get_option( 'contact_kvk_number' );

    return $kvk;
}

/**
 * Shortcode-function to get vat output
 */
function xxx_get_vat() 
{
    $vat = get_option( 'contact_vat_number' );

    return $vat;
}

/**
 * Shortcode-function to get vat output
 */
function xxx_get_general_terms() 
{
    $general_terms_id = get_option( 'general_terms' );

    $general_terms = get_post($general_terms_id);

    $link_text = __('Algemene Voorwaarden');

    if ( empty($general_terms) )
        return '';

    if ( 'attachment' == $general_terms->post_type ) {
        $link = wp_get_attachment_url( $general_terms_id );
        $target = '_blank';
    }
    else {
        $link = get_permalink($general_terms);
        $target = '_self';
    }

    return sprintf('<a href="%s" target="%s">%s</a>', $link, $target, $link_text);
}


/**
 * Shortcode-function to get vat output
 */
function xxx_get_privacy_policy() 
{
    $privacy_policy_id = get_option( 'privacy_policy' );

    $privacy_policy = get_post($privacy_policy_id);

    $link_text = __('Privacy Policy');

    if ( empty($privacy_policy) )
        return '';

    if ( 'attachment' == $privacy_policy->post_type ) {
        $link = wp_get_attachment_url( $privacy_policy_id );
        $target = '_blank';
    }
    else {
        $link = get_permalink($privacy_policy);
        $target = '_self';
    }

    return sprintf('<a href="%s" target="%s">%s</a>', $link, $target, $link_text);
}


/**
 * Shortcode-function to get linkedin output
 */
function xxx_get_linkedin( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'with-text' => false
    ), $atts );

    $link = get_option( 'social_link_linkedin' );
    $link_class = 'linkedin';
    $link_has_text_class = ($atts['with-text']) ? 'with-text' : '';
    $text = ($atts['with-text']) ? 'LinkedIn' : '';
    $icon = do_shortcode('[icon linkedin circle]');

    return sprintf('<a href="%s" class="%s %s">%s%s</a>', $link, $link_class, $link_has_text_class, $icon, $text);
}

/**
 * Shortcode-function to get facebook output
 */
function xxx_get_facebook( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'with-text' => false
    ), $atts );

    $link = get_option( 'social_link_facebook' );
    $link_class = 'facebook';
    $link_has_text_class = ($atts['with-text']) ? 'with-text' : '';
    $text = ($atts['with-text']) ? 'Facebook' : '';
    $icon = do_shortcode('[icon facebook circle]');

    return sprintf('<a href="%s" class="%s %s">%s%s</a>', $link, $link_class, $link_has_text_class, $icon, $text);
}

/**
 * Shortcode-function to get twitter output
 */
function xxx_get_twitter( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'with-text' => false
    ), $atts );

    $link = get_option( 'social_link_twitter' );
    $link_class = 'twitter';
    $link_has_text_class = ($atts['with-text']) ? 'with-text' : '';
    $text = ($atts['with-text']) ? 'Twitter' : '';
    $icon = do_shortcode('[icon twitter circle]');

    return sprintf('<a href="%s" class="%s %s">%s%s</a>', $link, $link_class, $link_has_text_class, $icon, $text);
}

/**
 * Shortcode-function to get whatsapp output
 */
function xxx_get_whatsapp( $atts ) 
{
    $atts = normalize_attributes($atts);
    $atts = shortcode_atts( array(
        'with-text' => false
    ), $atts );

    $whatsapp_number = get_option( 'social_link_whatsapp' );
    $link = "https://api.whatsapp.com/send?phone=$whatsapp_number";
    $link_class = 'whatsapp';
    $link_has_text_class = ($atts['with-text']) ? 'with-text' : '';
    $text = ($atts['with-text']) ? 'WhatsApp' : '';
    $icon = do_shortcode('[icon whatsapp circle]');

    return sprintf('<a href="%s" class="%s %s">%s%s</a>', $link, $link_class, $link_has_text_class, $icon, $text);
}


/**
 * Normalize shortcode attributes to be able to use attributes without value
 * 
 * @Source: https://www.sitepoint.com/unleash-the-power-of-the-wordpress-shortcode-api/
 */
if ( ! function_exists('normalize_attributes') ) {
    function normalize_attributes($atts) {
        if (!is_array($atts))
            return array();

        foreach ($atts as $key => $value) {
            if (is_int($key)) {
                $atts[$value] = true;
                unset($atts[$key]);
            }
        }
        
        return $atts;
    }
}