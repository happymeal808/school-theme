<?php
/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Theme, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header Menu', 'school-theme' ),
			'footer-right' => esc_html__( 'Footer Menu - Right Side', 'school-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

    // Add support for Wide and Full alignment in Gutenberg blocks
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_theme_content_width', 960 );
}
add_action( 'after_setup_theme', 'school_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Page Sidebar', 'school-theme' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_theme_widgets_init' );

/**
 * Custom image field in footer
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
}

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts() {
    // Enqueue the compiled CSS file
    wp_enqueue_style('school-theme-style', get_template_directory_uri() . '/style.css', array(), _S_VERSION);
    wp_style_add_data('school-theme-style', 'rtl', 'replace');

    // Enqueue navigation script
    wp_enqueue_script('school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    // Enqueue comment-reply script if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'school_theme_scripts');

/**
 * Enqueue AOS.
 */
function enqueue_aos_scripts() {
	if (is_single('post')) {
		wp_enqueue_style( 'aos-css', get_stylesheet_directory_uri().'/aos.css' );
    	wp_enqueue_script( 'aos-js', get_stylesheet_directory_uri(). '/aos.js', array(), null, true );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_aos_scripts' );

/**
 * Register CPTs and Taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Remove Block editor from specific pages/posts.
 */
function school_theme_post_filter( $use_block_editor, $post ) {
    $page_ids = array( 54 ); // Add page/post IDs to the array
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'school_theme_post_filter', 10, 2 );

/**
 * Change title placeholder text for the student CPT.
 */
function school_theme_change_student_title_placeholder( $title ) {
    $screen = get_current_screen();

    if ( 'student' == $screen->post_type ) {
        $title = 'Add student name';
    }

    return $title;
}
add_filter( 'enter_title_here', 'school_theme_change_student_title_placeholder' );
/**
 * Change title placeholder text for the staff CPT.
 */

function school_theme_change_staff_title_placeholder( $title ) {
    $screen = get_current_screen();

    if ( 'staff' == $screen->post_type ) {
        $title = 'Add staff name';
    }

    return $title;
}
add_filter( 'enter_title_here', 'school_theme_change_staff_title_placeholder' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Student placeholder text 
 */

function student_title_placeholder( $title, $post ) {
	if ( 'student' === $post->post_type ) {
		$title = 'Add student name';
	}
	return $title;
}
add_filter( 'enter_title_here', 'student_title_placeholder', 10, 2 );

/**
 * Disable comments for the student post type
 */
function disable_student_comments() {
    remove_post_type_support( 'student', 'comments' );
    remove_post_type_support( 'student', 'trackbacks' );
}
add_action( 'init', 'disable_student_comments', 100 );