<?php
function school_theme_register_custom_post_types() {

    // register staff
    $labels = array(
        'name'               => _x( 'Staff', 'post type general name'  ),
        'singular_name'      => _x( 'Staff', 'post type singular name'  ),
        'menu_name'          => _x( 'Staff', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Staff' ),
        'add_new_item'       => __( 'Add New Staff' ),
        'new_item'           => __( 'New Staff' ),
        'edit_item'          => __( 'Edit Staff' ),
        'view_item'          => __( 'View Staff'  ),
        'all_items'          => __( 'All Staff' ),
        'search_items'       => __( 'Search Staff' ),
        'parent_item_colon'  => __( 'Parent Staff:' ),
        'not_found'          => __( 'No staff found.' ),
        'not_found_in_trash' => __( 'No staff found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/pullquote' ) ),
        'template_lock'      => 'all'
    );
    
    register_post_type( 'school-theme-staff', $args );
}

add_action( 'init', 'school_theme_register_custom_post_types' );

// Register Taxonomies
function school_theme_register_taxonomies() {
    $labels = array(
        'name'                       => _x( 'Staff Categories', 'taxonomy general name', 'school-theme' ),
        'singular_name'              => _x( 'Staff Category', 'taxonomy singular name', 'school-theme' ),
        'search_items'               => __( 'Search Staff Categories', 'school-theme' ),
        'all_items'                  => __( 'All Staff Categories', 'school-theme' ),
        'parent_item'                => __( 'Parent Staff Category', 'school-theme' ),
        'parent_item_colon'          => __( 'Parent Staff Category:', 'school-theme' ),
        'edit_item'                  => __( 'Edit Staff Category', 'school-theme' ),
        'update_item'                => __( 'Update Staff Category', 'school-theme' ),
        'add_new_item'               => __( 'Add New Staff Category', 'school-theme' ),
        'new_item_name'              => __( 'New Staff Category Name', 'school-theme' ),
        'menu_name'                  => __( 'Staff Category', 'school-theme' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );

    register_taxonomy( 'staff-category', array( 'school-theme-staff' ), $args );
}
add_action( 'init', 'school_theme_register_taxonomies' );

// Create taxonomy terms
function school_theme_create_staff_taxonomy_terms() {
    if ( !term_exists( 'Faculty', 'staff-category' ) ) {
        wp_insert_term( 'Faculty', 'staff-category' );
    }
    if ( !term_exists( 'Administrative', 'staff-category' ) ) {
        wp_insert_term( 'Administrative', 'staff-category' );
    }
}
add_action( 'init', 'school_theme_create_staff_taxonomy_terms' );

function school_theme_rewrite_flush() {
    school_theme_register_custom_post_types();
    school_theme_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_theme_rewrite_flush' );