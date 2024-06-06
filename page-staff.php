<?php
/**
 * Template Name: Staff Page
 *
 * The template for displaying all staff.
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .page-header -->

    <div class="entry-content">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
    </div><!-- .entry-content -->

    <div class="staff-list">
        <?php
        $taxonomy = 'staff-category';
        $terms = get_terms(
            array(
                'taxonomy' => $taxonomy,
                'include' => array('Faculty', 'Administrative'), // Ensure you only include Faculty and Administrative terms
                'hide_empty' => false,
            )
        );

        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                // WP_Query arguments
                $args = array(
                    'post_type' => 'school-theme-staff',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'slug',
                            'terms' => $term->slug,
                        ),
                    ),
                );

                // The Query
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    echo '<h2>' . esc_html($term->name) . '</h2>';
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <div class="staff-member">
                            <h3 class="staff-name"><?php the_title(); ?></h3>
                            <div class="staff-bio">
                                <?php if (function_exists('get_field') && get_field('short_bio')) : ?>
                                    <p><?php the_field('short_bio'); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($term->slug === 'faculty') : ?>
                                <div class="staff-courses">
                                    <h4>Courses Teaching:</h4>
                                    <?php if (function_exists('get_field') && get_field('courses')) : ?>
                                        <p><?php the_field('courses'); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="staff-website">
                                    <h4>Website:</h4>
                                    <?php if (function_exists('get_field') && get_field('website_url')) : ?>
                                        <p><a href="<?php the_field('website_url'); ?>" target="_blank"><?php the_field('website_url'); ?></a></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                }
            }
        } else {
            echo '<p>No staff found.</p>';
        }
        ?>
    </div><!-- .staff-list -->

</main><!-- #main -->

<?php
get_footer();