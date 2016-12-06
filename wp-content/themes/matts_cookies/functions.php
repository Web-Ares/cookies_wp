<?php

// Define PHP file constants.
define( 'TEMPLATEINC', TEMPLATEPATH . '/inc' );
define( 'TEMPLATEURI', get_template_directory_uri() );
define( 'DIRECT', TEMPLATEURI.'/dist/' );
show_admin_bar( false );

//define('DISALLOW_FILE_MODS',true);

add_filter( 'wpsl_templates', 'custom_templates' );

function custom_templates( $templates ) {

    /**
     * The 'id' is for internal use and must be unique ( since 2.0 ).
     * The 'name' is used in the template dropdown on the settings page.
     * The 'path' points to the location of the custom template,
     * in this case the folder of your active theme.
     */
    $templates[] = array (
        'id'   => 'custom',
        'name' => 'Custom template',
        'path' => get_stylesheet_directory() . '/' . 'wpsl-templates/custom.php',
    );

    return $templates;
}

add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );

function custom_override_billing_fields( $fields ) {

    unset($fields['billing_country']);

//    $fields['billing_first_name'] = array(
//        'label'     => __('First Name', 'woocommerce'),
//        'placeholder'   => _x('First Name', 'placeholder', 'woocommerce'),
//        'required'  => false
//    );

    $fields['billing_last_name'] = array(
        'label'     => __('List Name', 'woocommerce'),
        'placeholder'   => _x('First Name', 'placeholder', 'woocommerce'),
        'required'  => false
    );

    $fields['billing_email'] = array(
        'label'     => __('E-mail', 'woocommerce'),
        'placeholder'   => _x('First Name', 'placeholder', 'woocommerce'),
        'required'  => false
    );

    $fields['billing_phone'] = array(
        'label'     => __('Phone', 'woocommerce'),
        'placeholder'   => _x('First Name', 'placeholder', 'woocommerce'),
        'required'  => false
    );


    $fields['billing_address_1'] = array(
        'placeholder'   => _x('Address 1', 'placeholder', 'woocommerce'),
        'required' => false
    );

    $fields['billing_address_2'] = array(
        'label'     => __('Address 2', 'woocommerce'),
        'placeholder'   => _x('Address 2', 'placeholder', 'woocommerce'),
        'required' => false
    );

    $fields['billing_state'] = array(
        'type' => 'state',
        'placeholder'   => _x('State Name', 'placeholder', 'woocommerce'),
        'required' => false
    );

    $fields['billing_city'] = array(
        'placeholder'   => _x('City Name', 'placeholder', 'woocommerce'),
        'required' => false
    );

    $fields['billing_postcode'] = array(
        'placeholder'   => _x('postcode', 'placeholder', 'woocommerce'),
        'required' => false
    );

    return $fields;
}

add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );

function custom_override_shipping_fields( $fields ) {

//    unset($fields['shipping_country']);

    $fields['shipping_postcode'] = array(
        'placeholder'   => _x('postcode', 'placeholder', 'woocommerce'),
        'required' => false
    );

    return $fields;
}

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );
//
//
//add_filter( 'wc_add_to_cart_message', 'bbloomer_custom_add_to_cart_message' );

function bbloomer_custom_add_to_cart_message() {

    return '';
}

require_once( TEMPLATEINC . '/template.php' );
require_once( TEMPLATEINC . '/actions.php' );
