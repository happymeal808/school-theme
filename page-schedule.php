<?php
/**
 * The template for displaying the schedule.
 *
 * This is the template that displays the schedule by default.
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
 
		 // Display Program Schedule using ACF Repeater Field
		 if( have_rows('program_schedule') ): ?>
			 <section class="program-schedule">
				 <h2>Program Schedule</h2>
				 <ul>
					 <?php while( have_rows('program_schedule') ): the_row(); ?>
						 <li>
							 <strong><?php the_sub_field('date'); ?> at <?php the_sub_field('time'); ?></strong>
							 <h3><?php the_sub_field('session_title'); ?></h3>
							 <p><?php the_sub_field('description'); ?></p>
						 </li>
					 <?php endwhile; ?>
				 </ul>
			 </section>
		 <?php endif;
 
		 // If comments are open or we have at least one comment, load up the comment template.
		 if ( comments_open() || get_comments_number() ) :
			 comments_template();
		 endif;
 
	 endwhile; // End of the loop.
	 ?>
 
 </main><!-- #main -->
 
 <?php
 get_footer();
 ?>