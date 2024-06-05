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
		while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>

			<div class="entry-content">
			<?php the_content(); ?>
			<?php
			$args = array(
				'post_type'      => 'school-theme-service',
				'posts_per_page' => -1,
				'order'          => 'ASC',
				'orderby'        => 'title'
			);

			$query = new WP_Query( $args );
			
			?>

			<?php
			$taxonomy = 'fwd-service-type';
			$terms    = get_terms(
				array(
					'taxonomy' => $taxonomy
				)
			);
			if($terms && ! is_wp_error($terms) ){
				foreach($terms as $term){
				$args = array(
					'post_type'      => 'fwd-service',
					'posts_per_page' => -1,
					'order'          => 'ASC',
					'orderby'        => 'title',
					'tax_query'      => array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => $term->slug,
						)
					),
				);
			
				$query = new WP_Query( $args );
				
				if ( $query -> have_posts() ) {
					
					echo '<h2>' . esc_html( $term->name ) . '</h2>';

					while ( $query -> have_posts() ) {
						$query -> the_post();
				
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( 'service_text' ) ) {
								echo '<h2 id="'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</h2>';
								the_field( 'service_text' );
							}
						}
				
					}
					wp_reset_postdata();
				}
			}
		}
			?>
		</div>

	</article>

	<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();
