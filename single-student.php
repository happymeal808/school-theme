<?php
/**
 * The template for displaying single student posts
 *
 * @package School_Theme
 */

get_header(); 
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();

        // Get the student's name
        $student_name = get_the_title();
        // Get the content
        $content = get_the_content();
        // Get the featured image
        $featured_image = get_the_post_thumbnail_url();

        // Get the terms of the taxonomy that are attached to the post
        $taxonomy = 'role'; // Replace with your actual taxonomy name
        $terms = wp_get_post_terms( get_the_ID(), $taxonomy );
        ?>

        <div class="student-profile">
            <h1><?php echo esc_html( $student_name ); ?></h1>
            <div class="student-image">
                <?php if ( $featured_image ) : ?>
                    <img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $student_name ); ?>">
                <?php endif; ?>
            </div>
            <div class="student-content">
                <?php echo wp_kses_post( $content ); ?>
            </div>
            
            <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                <div class="related-students">
                    <h2>Related Students</h2>
                    <ul>
                        <?php
                        foreach ( $terms as $term ) {
                            // WP_Query arguments
                            $args = array(
                                'post_type' => 'student', // Replace with your actual post type
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'term_id',
                                        'terms'    => $term->term_id,
                                    ),
                                ),
                                'posts_per_page' => -1, // Adjust the number of posts if needed
                                'post__not_in'   => array( get_the_ID() ), // Exclude current post
                            );

                            // The Query
                            $related_query = new WP_Query( $args );

                            // The Loop
                            if ( $related_query->have_posts() ) :
                                while ( $related_query->have_posts() ) : $related_query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();