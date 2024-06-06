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
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/pullquote' ) ),
        'template_lock'      => 'all'
    );
    
    register_post_type( 'school-theme-staff', $args );

        // register schedule
        $labels = array(
            'name'               => _x( 'Schedule', 'post type general name'  ),
            'singular_name'      => _x( 'Schedule', 'post type singular name'  ),
            'menu_name'          => _x( 'Schedule', 'admin menu'  ),
            'name_admin_bar'     => _x( 'Schedule', 'add new on admin bar' ),
            'add_new'            => _x( 'Add New', 'Schedule' ),
            'add_new_item'       => __( 'Add New Schedule' ),
            'new_item'           => __( 'New Schedule' ),
            'edit_item'          => __( 'Edit Schedule' ),
            'view_item'          => __( 'View Schedule'  ),
            'all_items'          => __( 'All Schedule' ),
            'search_items'       => __( 'Search Schedule' ),
            'parent_item_colon'  => __( 'Parent Schedule:' ),
            'not_found'          => __( 'No schedule found.' ),
            'not_found_in_trash' => __( 'No schedule found in Trash.' ),
        );
        
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'schedule' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 7,
            'menu_icon'          => 'dashicons-clock',
            'supports'           => array( 'title', 'editor' ),
            'template'           => array( array( 'core/pullquote' ) ),
            'template_lock'      => 'all'
        );
        
        register_post_type( 'school-theme-schedule', $args );

        //  register students
        $labels = array(
            'name'               => _x( 'Students', 'post type general name', 'school_theme' ),
            'singular_name'      => _x( 'Student', 'post type singular name', 'school_theme' ),
            'menu_name'          => _x( 'Students', 'admin menu', 'school_theme' ),
            'name_admin_bar'     => _x( 'Student', 'add new on admin bar', 'school_theme' ),
            'add_new'            => _x( 'Add New', 'student', 'school_theme' ),
            'add_new_item'       => __( 'Add New Student', 'school_theme' ),
            'new_item'           => __( 'New Student', 'school_theme' ),
            'edit_item'          => __( 'Edit Student', 'school_theme' ),
            'view_item'          => __( 'View Student', 'school_theme' ),
            'all_items'          => __( 'All Students', 'school_theme' ),
            'search_items'       => __( 'Search Students', 'school_theme' ),
            'parent_item_colon'  => __( 'Parent Students:', 'school_theme' ),
            'not_found'          => __( 'No students found.', 'school_theme' ),
            'not_found_in_trash' => __( 'No students found in Trash.', 'school_theme' )
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
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'template'           => array(
                array( 'core/paragraph', array(
                    'placeholder' => 'Add a short biography...',
                ) ),
                array( 'core/button', array(
                    'placeholder' => 'Link to portfolio',
                    'className'   => 'portfolio-button'
                ) ),
            ),
            'template_lock'      => 'all',
        );
    
        register_post_type( 'student', $args );
}

add_action( 'init', 'school_theme_register_custom_post_types' );

// Register Taxonomies
function school_theme_register_taxonomies() {
    // staff
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

    // students
    $labels = array(
        'name'              => _x( 'Student Categories', 'taxonomy general name', 'school_theme' ),
        'singular_name'     => _x( 'Student Category', 'taxonomy singular name', 'school_theme' ),
        'search_items'      => __( 'Search Student Categories', 'school_theme' ),
        'all_items'         => __( 'All Student Categories', 'school_theme' ),
        'parent_item'       => __( 'Parent Student Category', 'school_theme' ),
        'parent_item_colon' => __( 'Parent Student Category:', 'school_theme' ),
        'edit_item'         => __( 'Edit Student Category', 'school_theme' ),
        'update_item'       => __( 'Update Student Category', 'school_theme' ),
        'add_new_item'      => __( 'Add New Student Category', 'school_theme' ),
        'new_item_name'     => __( 'New Student Category Name', 'school_theme' ),
        'menu_name'         => __( 'Student Category', 'school_theme' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'student-category' ),
    );

    register_taxonomy( 'student_taxonomy', array( 'student' ), $args );

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