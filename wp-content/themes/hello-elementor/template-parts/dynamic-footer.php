<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_editor = isset( $_GET['elementor-preview'] );
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$footer_class = did_action( 'elementor/loaded' ) ? esc_attr( hello_get_footer_layout_class() ) : '';
$footer_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-2',
	'fallback_cb' => false,
	'echo' => false,
] );
?>

<footer class="main_footer">
    <div class="footer_inner">
        <div class="footer_colMain">
            <h4>WHO WE ARE</h4>
            <p>Community based, family focused 
general dental practice providing oral 
health care and dental services to the 
Wairarapa with a team that is trusted, 
realistic, unique and experienced.</p>
        </div>
        <div class="footer_colMain">
            <h4>ADDRESS</h4>
            <!--<p><strong>Clinic Dental:</strong></p>-->
            <p>1A Seddon Street</p>
            <p>Carterton</p>
            <p>Behind Carterton Medical Centre</p>
            <p><strong>Timing:</strong></p>
            <p>Open Monday to Friday</p>
            <p> 8am to 5pm </p>
        </div>
        <div class="footer_colMain">
            <h4>CONTACT US</h4>
            <p><strong>Email:</strong> appointments@truedentistry.co.nz</p>
            <p><strong>Tel:</strong> 06-379 8799</p>
            <p><strong>Mobile:</strong> 06-379 8799</p>
        </div>
    </div>
</footer>

<footer id="site-footer" class="site-footer dynamic-footer <?php echo esc_attr( $footer_class ); ?>">
	<div class="footer-inner">
		<div class="site-branding show-<?php echo esc_attr( hello_elementor_get_setting( 'hello_footer_logo_type' ) ); ?>">
			<?php if ( has_custom_logo() && ( 'title' !== hello_elementor_get_setting( 'hello_footer_logo_type' ) || $is_editor ) ) : ?>
				<div class="site-logo <?php echo esc_attr( hello_show_or_hide( 'hello_footer_logo_display' ) ); ?>">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif;

			if ( $site_name && ( 'logo' !== hello_elementor_get_setting( 'hello_footer_logo_type' ) ) || $is_editor ) : ?>
				<h4 class="site-title <?php echo esc_attr( hello_show_or_hide( 'hello_footer_logo_display' ) ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr__( 'Home', 'hello-elementor' ); ?>" rel="home">
						<?php echo esc_html( $site_name ); ?>
					</a>
				</h4>
			<?php endif;

			if ( $tagline || $is_editor ) : ?>
				<p class="site-description <?php echo esc_attr( hello_show_or_hide( 'hello_footer_tagline_display' ) ); ?>">
					<?php echo esc_html( $tagline ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $footer_nav_menu ) : ?>
			<nav class="site-navigation <?php echo esc_attr( hello_show_or_hide( 'hello_footer_menu_display' ) ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $footer_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>
	</div>
	<div  style="text-align: center;">
	 &#169; <?php echo date("Y"); ?> True Dentistry <br>
	 Design by Freshfields Design Website by ThreePoint
	</div>
</footer>
