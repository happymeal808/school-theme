<?php
/**
 * Register Custom Post Types and Taxonomies
 *
 * @package School_Theme
 */

/**
 * Register Custom Post Types
 */
function school_theme_register_custom_post_types() {

    // Register Staff CPT
    $labels = array(
        'name'               => _x( 'Staff', 'post type general name' ),
        'singular_name'      => _x( 'Staff', 'post type singular name' ),
        'menu_name'          => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'staff' ),
        'add_new_item'       => __( 'Add New Staff' ),
        'new_item'           => __( 'New Staff' ),
        'edit_item'          => __( 'Edit Staff' ),
        'view_item'          => __( 'View Staff' ),
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
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'staff', $args );

    // Register students CPT
    $labels = array(
        'name'               => _x( 'Schedules', 'post type general name', 'school_theme' ),
        'singular_name'      => _x( 'Schedule', 'post type singular name', 'school_theme' ),
        'menu_name'          => _x( 'Schedules', 'admin menu', 'school_theme' ),
        'name_admin_bar'     => _x( 'Schedule', 'add new on admin bar', 'school_theme' ),
        'add_new'            => _x( 'Add New', 'schedule', 'school_theme' ),
        'add_new_item'       => __( 'Add New Schedule', 'school_theme' ),
        'new_item'           => __( 'New Schedule', 'school_theme' ),
        'edit_item'          => __( 'Edit Schedule', 'school_theme' ),
        'view_item'          => __( 'View Schedule', 'school_theme' ),
        'all_items'          => __( 'All Schedules', 'school_theme' ),
        'search_items'       => __( 'Search Schedules', 'school_theme' ),
        'parent_item_colon'  => __( 'Parent Schedules:', 'school_theme' ),
        'not_found'          => __( 'No schedules found.', 'school_theme' ),
        'not_found_in_trash' => __( 'No schedules found in Trash.', 'school_theme' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'schedule' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title' ),  // Removed 'editor' support
    );

    register_post_type( 'schedule', $args );

    // Register students CPT

    $labels = array(
        'name'               => _x( 'Students', 'post type general name' ),
        'singular_name'      => _x( 'Student', 'post type singular name' ),
        'menu_name'          => _x( 'Students', 'admin menu' ),
        'name_admin_bar'     => _x( 'Student', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'student' ),
        'add_new_item'       => __( 'Add New Student' ),
        'new_item'           => __( 'New Student' ),
        'edit_item'          => __( 'Edit Student' ),
        'view_item'          => __( 'View Student' ),
        'all_items'          => __( 'All Students' ),
        'search_items'       => __( 'Search Students' ),
        'not_found'          => __( 'No students found.' ),
        'not_found_in_trash' => __( 'No students found in Trash.' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'student' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor' ),
        'template'           => array(
            array( 'core/paragraph', array(
                'placeholder' => 'Add a short biography...',
            ) ),
            array( 'core/button', array(
                'placeholder' => 'Link to portfolio',
                'className'   => 'portfolio-button'
            ) ),
        ),
        'template_lock'      => 'all', // Prevents adding, moving, or removing blocks
    );

    register_post_type( 'student', $args );
}
add_action( 'init', 'school_theme_register_custom_post_types' );

/**
 * Register Taxonomies
 */
function school_theme_register_taxonomies() {
    // Register staff taxonomy
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

    register_taxonomy( 'staff-category', array( 'staff' ), $args );

    // Register student role taxonomy
    $labels = array(
        'name'              => _x( 'Roles', 'taxonomy general name', 'school-theme' ),
        'singular_name'     => _x( 'Role', 'taxonomy singular name', 'school-theme' ),
        'search_items'      => __( 'Search Roles', 'school-theme' ),
        'all_items'         => __( 'All Roles', 'school-theme' ),
        'parent_item'       => __( 'Parent Role', 'school-theme' ),
        'parent_item_colon' => __( 'Parent Role:', 'school-theme' ),
        'edit_item'         => __( 'Edit Role', 'school-theme' ),
        'update_item'       => __( 'Update Role', 'school-theme' ),
        'add_new_item'      => __( 'Add New Role', 'school-theme' ),
        'new_item_name'     => __( 'New Role Name', 'school-theme' ),
        'menu_name'         => __( 'Roles', 'school-theme' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'role' ),
    );

    register_taxonomy( 'role', array( 'student' ), $args );
}
add_action( 'init', 'school_theme_register_taxonomies' );

/**
 * Create predefined taxonomy terms
 */
function school_theme_create_taxonomy_terms() {
    // Staff categories
    if ( !term_exists( 'Faculty', 'staff-category' ) ) {
        wp_insert_term( 'Faculty', 'staff-category' );
    }
    if ( !term_exists( 'Administrative', 'staff-category' ) ) {
        wp_insert_term( 'Administrative', 'staff-category' );
    }

    // Student roles
    $roles = array('Designer', 'Developer');
    foreach ($roles as $role) {
        if (!term_exists($role, 'role')) {
            wp_insert_term($role, 'role');
        }
    }
}
add_action( 'init', 'school_theme_create_taxonomy_terms' );

/**
 * Flush rewrite rules on theme activation
 */
function school_theme_rewrite_flush() {
    school_theme_register_custom_post_types();
    school_theme_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_theme_rewrite_flush' );
