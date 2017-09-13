<?php

use Carbon_Fields\Field\Field;
use Carbon_Fields\Datastore\Datastore;

/**
 * Stores serialized values in the database
 */
class Custom_Post_Meta_Datastore extends Datastore {

    /**
     * Initialization tasks for concrete datastores.
     **/
    public function init() {

    }

    protected function get_key_for_field( Field $field ) {
        
        // $key = '_' . $field->get_base_name();
        $key = $field->get_base_name();
        return $key;
    }

    /**
     * Save a single key-value pair to the database
     *
     * @param string $key
     * @param string $value
     */
    protected function save_key_value_pair( $key, $value ) {

        $delete_on_save = apply_filters( 'carbon_fields_should_delete_field_value_on_save', true, $this );

        // Do not save empty value (it's already deleted when delete_on_save is enabled)
        if ($delete_on_save && empty($value)) {
            return;
        }

        if ( ! update_metadata( $this->get_meta_type(), $this->get_object_id(), $key, $value ) ) {
            add_metadata( $this->get_meta_type(), $this->get_object_id(), $key, $value, true );
        }
    }

    /**
     * Load the field value(s)
     *
     * @param Field $field The field to load value(s) in.
     * @return array
     */
    public function load( Field $field ) {
        $key = $this->get_key_for_field( $field );
        $value = get_metadata( $this->get_meta_type(), $this->get_object_id(), $key, true );
        $value = (empty($value)) ? null : $value;

        /**
         * Complex fields expect an empty array when no value is found
         */
        if ( is_a( $field, '\\Carbon_Fields\\Field\\Complex_Field' ) && $value === null ) {
            return array();
        }

        return $value;
    }

    /**
     * Save the field value(s)
     *
     * @param Field $field The field to save.
     */
    public function save( Field $field ) {
        if ( ! empty( $field->get_hierarchy() ) ) {
            return; // only applicable to root fields
        }
        
        // Get get key and value
        $key = $this->get_key_for_field( $field );
        $value = $field->get_value();

        // get_full_value returns an array while get_value returns the value...
        // $value = $field->get_full_value();

        // Get value tree for Complex Field
        if ( is_a( $field, '\\Carbon_Fields\\Field\\Complex_Field' ) ) {
            $value = $field->get_value_tree();
        }

        $this->save_key_value_pair( $key, $value );
    }

    /**
     * Delete the field value(s)
     *
     * @param Field $field The field to delete.
     */
    public function delete( Field $field ) {
        if ( ! empty( $field->get_hierarchy() ) ) {
            return; // only applicable to root fields
        }
        $key = $this->get_key_for_field( $field );
        delete_metadata( $this->get_meta_type(), $this->get_object_id(), $key );
    }

    /**
     * Retrieve the type of meta data.
     *
     * @return string
     */
    public function get_meta_type() {
        return 'post';
    }
}