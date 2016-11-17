<?php
// Register Custom Post Type
add_action('init', 'custom_post_type', 0);

function custom_post_type()
{
    $labels = array(

        'name' => 'Projects',
        'singular_name' => 'Projects',
        'menu_name' => 'Projects',
        'all_items' => 'All Projects',
        'view_item' => 'View Project',
        'add_new_item' => 'Add Project',
        'add_new' => 'Add Project',
        'edit_item' => 'Edit',
        'update_item' => 'Update',
        'search_items' => 'Search'
    );


    $args = array(
        'labels' => $labels,
        'supports' => array('title','thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array(
            'with_front' => true
        )
    );

    register_post_type('project', $args);

    function tr_create_my_taxonomy() {

        register_taxonomy(
            'products_cat',
            'products',
            array(
                'label' => __( 'Category' ),
                'hierarchical' => true,
            )
        );
    }
    add_action( 'init', 'tr_create_my_taxonomy' );

}
