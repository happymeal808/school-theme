<?php
/**
 * The template for displaying single student posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }

                the_content();
                ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php
                $terms = get_the_terms( get_the_ID(), 'student_taxonomy' );

                if ( $terms && ! is_wp_error( $terms ) ) {
                    $term_ids = wp_list_pluck( $terms, 'term_id' );

                    $related_students_args = array(
                        'post_type' => 'student',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'student_taxonomy',
                                'field'    => 'term_id',
                                'terms'    => $term_ids,
                                'operator' => 'IN',
                            ),
                        ),
                        'post__not_in' => array( get_the_ID() ),
                    );

                    $related_students = new WP_Query( $related_students_args );

                    if ( $related_students->have_posts() ) {
                        echo '<h2>Related Students</h2><ul>';

                        while ( $related_students->have_posts() ) {
                            $related_students->the_post();
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                        echo '</ul>';

                        wp_reset_postdata();
                    }
                }
                ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

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