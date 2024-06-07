<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>
<footer id="colophon" class="site-footer">
    
    <nav id="footer-navigation" class="footer-navigation">
        <?php
        wp_nav_menu( array( 'theme_location' => 'footer-right' ) );

    ?></nav><?php
        // Display the custom logo or ACF footer logo
        if ( has_custom_logo() ) {
            the_custom_logo();
        } elseif ( function_exists( 'get_field' ) ) {
            $footer_logo = get_field( 'footer_logo', 'option' );

            if ( is_array( $footer_logo ) && isset( $footer_logo['url'] ) ) {
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link"><img src="' . esc_url( $footer_logo['url'] ) . '" alt="' . esc_attr( $footer_logo['alt'] ) . '"></a>';
            } else {
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link">' . get_bloginfo( 'name' ) . '</a>';
            }
        } else {
            echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link">' . get_bloginfo( 'name' ) . '</a>';
        }
        ?>
    <div class="site-info">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'school-theme' ) ); ?>">
            <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( 'Proudly powered by %s', 'school-theme' ), 'WordPress' );
            ?>
        </a>
        <span class="sep"> | </span>
        <?php
        /* translators: 1: Theme name, 2: Theme author. */
        printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-theme' ), 'school-theme', '<a href="https://itsgill.com">Gillian Downey & Ian D\'souza</a>' );
        ?>
    </div><!-- .site-info -->

</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>