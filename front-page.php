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
    while ( have_posts() ) :
        the_post();
        
        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    endwhile; // End of the loop.
    ?>
    
    <section class="home-blog">
        <h2><?php esc_html_e('Recent News', 'school-theme');?></h2>
        <?php
        $args = array(
            'post_type'        => 'post',
            'posts_per_page'   => 3
        );

        $blog_query = new WP_Query( $args );
        if ( $blog_query-> have_posts() ){
            while( $blog_query -> have_posts() ){
                $blog_query -> the_post();
                ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'latest-news-posts' ); ?>
                        <h3><?php the_title(); ?></h3>
                    </a>
                </article>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="all-news-link">
            <?php esc_html_e('See All News', 'school-theme'); ?>
        </a>
    </section>

</main><!-- #main -->

<?php
get_footer();
?>