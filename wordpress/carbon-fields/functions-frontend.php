<?php 

/**
 * Flatten Carbon Fields complex fields data 
 *
 * Useful because the data is stored in a redundant data scheme (see README)
 */
function flatten_cf2_data($data) {
    $processed_data = array();

    if ( ! is_array($data) )
        return $processed_data;

    foreach ($data as $key => $data_entry) {

        if ( ! is_array($data_entry)) {
            $processed_data[$key] = $data_entry;
            continue;
        }

        // If array has only one child, check if it's an array or a string
        if ( count($data_entry) == 1 ) {

            // If it is a string then store it
            if ( isset($data_entry['value']) ) {
                $processed_data[$key] = $data_entry['value'];
                continue;
            }

            // If the child is an array with only one child and its an array with only 'value' as key, store it
            if ( isset($data_entry[0]) && is_array($data_entry[0]) && count($data_entry[0]) == 1 && isset($data_entry[0]['value']) ) {
                $processed_data[$key] = $data_entry[0]['value'];
                continue;
            }
        }

        // If array has more than one child, go deeper!
        $processed_data[$key] = flatten_cf2_data($data_entry);
    };

    return $processed_data; 
}

// Filter to process serialized $complex field data
add_filter( 'cf2_data', function($complex_field) {
    return flatten_cf2_data($complex_field);
});