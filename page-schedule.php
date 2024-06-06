<?php
/**
 * Template Name: Schedule Page
 *
 * The template for displaying the program schedule using ACF Repeater field.
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .page-header -->

    <div class="schedule-content">
        <?php
        // Check if the repeater field has rows of data
        if ( have_rows( 'schedule' ) ) :
            echo '<ul class="schedule-list">';
            // Loop through the rows of data
            while ( have_rows( 'schedule' ) ) : the_row();
                // Get sub field values
                $date = get_sub_field( 'date' );
                $time = get_sub_field( 'time' );
                $activity = get_sub_field( 'activity' );
                ?>
                <li class="schedule-item">
                    <span class="schedule-date"><?php echo esc_html( $date ); ?></span>
                    <span class="schedule-time"><?php echo esc_html( $time ); ?></span>
                    <span class="schedule-activity"><?php echo esc_html( $activity ); ?></span>
                </li>
                <?php
            endwhile;
            echo '</ul>';
        else :
            echo '<p>' . esc_html__( 'No schedule found.', 'school-theme' ) . '</p>';
        endif;
        ?>
    </div><!-- .schedule-content -->

</main><!-- #main -->

<?php
get_footer();