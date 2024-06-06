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
?>

<main id="primary" class="site-main">

    <?php
    // Query for schedule posts
    $schedule_args = array(
        'post_type'      => 'schedule',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'orderby'        => 'title'
    );
    $schedule_query = new WP_Query( $schedule_args );

    if ( $schedule_query->have_posts() ) :
        while ( $schedule_query->have_posts() ) : $schedule_query->the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    // Display Program Schedule using ACF Repeater Field
                    if ( have_rows('weekly_course_schedule') ): ?>
                        <section class="program-schedule">
                            <h2>Program Schedule</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Course</th>
                                        <th>Instructor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ( have_rows('weekly_course_schedule') ): the_row(); ?>
                                        <tr>
                                            <td><?php the_sub_field('date'); ?></td>
                                            <td><?php the_sub_field('course'); ?></td>
                                            <td><?php the_sub_field('instructor'); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </section>
                    <?php else: ?>
                        <p>No schedule available.</p>
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        endwhile;
    else :
        echo '<p>No schedules found.</p>';
    endif;

    wp_reset_postdata();
    ?>

</main><!-- #main -->

<?php
get_footer();