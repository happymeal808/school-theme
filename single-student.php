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
        $taxonomy = 'role';
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
                        $related_query_args = array(
                            'post_type' => 'student',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'term_id',
                                    'terms'    => wp_list_pluck( $terms, 'term_id' ),
                                    'operator' => 'IN',
                                ),
                            ),
                            'posts_per_page' => -1,
                            'post__not_in'   => array( get_the_ID() ),
                        );

                        // The Query
                        $related_query = new WP_Query( $related_query_args );

                        // The Loop
                        if ( $related_query->have_posts() ) :
                            while ( $related_query->have_posts() ) : $related_query->the_post();
                                ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <li><?php esc_html_e( 'No related students found.', 'school-theme' ); ?></li>
                            <?php
                        endif;
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    <?php
    endwhile;
    ?>

</main>

<?php
get_footer();