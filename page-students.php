<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header(); 

// Custom excerpt length for this template
function custom_student_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'custom_student_excerpt_length', 999 );

function custom_student_excerpt_more( $more ) {
    global $post;
    return '... <a class="read-more" href="' . get_permalink($post->ID) . '">' . __('Read More about the Student', 'school-theme') . '</a>';
}
add_filter( 'excerpt_more', 'custom_student_excerpt_more' );
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header>

    <div class="students-list">
        <?php
        $args = array(
            'post_type'      => 'student',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        );

        // The Query
        $students_query = new WP_Query( $args );

        // The Loop
        if ( $students_query->have_posts() ) :
            while ( $students_query->have_posts() ) : $students_query->the_post();
                // Get the student's name
                $student_name = get_the_title();
                // Get the excerpt
                $excerpt = get_the_excerpt();
                // Get the featured image
                $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'student-thumb' );
                // Get the taxonomy terms
                $terms_list = get_the_term_list( get_the_ID(), 'role', '', ', ' );
                ?>

                <div class="student-item">
                    <h2 class="student-name"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $student_name ); ?></a></h2>
                    <div class="student-image">
                        <?php if ( $featured_image ) : ?>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $student_name ); ?>"></a>
                        <?php endif; ?>
                    </div>
                    <div class="student-excerpt">
                        <?php echo wp_kses_post( $excerpt ); ?>
                    </div>
                    <div class="student-terms">
                        <?php if ( $terms_list ) : ?>
                            <p>Specialty: <?php echo $terms_list; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p><?php esc_html_e( 'No students found.', 'school-theme' ); ?></p>
            <?php
        endif;
        ?>
    </div>

</main>

<?php
get_footer();