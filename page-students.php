<?php
/**
 * Template Name: Students Page
 *
 * The template for displaying all students.
 *
 * @package School_Theme
 */

get_header(); 
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .page-header -->

    <div class="students-list">
        <?php
        // WP_Query arguments to fetch all student posts
        $args = array(
            'post_type'      => 'student', // Custom post type
            'posts_per_page' => -1, // Fetch all student posts
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
                // Get the content
                $content = get_the_content();
                // Get the featured image
                $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'student-thumb' );
                ?>

                <div class="student-item">
                    <h2 class="student-name"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $student_name ); ?></a></h2>
                    <div class="student-image">
                        <?php if ( $featured_image ) : ?>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $student_name ); ?>"></a>
                        <?php endif; ?>
                    </div>
                    <div class="student-content">
                        <?php echo wp_kses_post( $content ); ?>
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
    </div><!-- .students-list -->

</main><!-- #main -->

<?php
get_footer();