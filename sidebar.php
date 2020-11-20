<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPS_Prime_2
 */


if ( ! class_exists( 'WooCommerce' ) && is_active_sidebar( 'sidebar-1' ) ) {
	?>
	
		<aside id="secondary" <?php echo wps_prime_theme_main_sidebar_class(); ?> role="complementary">
			<?php wps_sidebar_start(); ?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
			<?php wps_sidebar_end(); ?>
		</aside><!-- #secondary -->
		<?php
}


if ( class_exists( 'WooCommerce' ) ) {
	if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
		return;
	}

	if ( is_shop() || is_product_category() || is_product_tag() ) {

		if ( is_active_sidebar( 'sidebar-shop' ) ) {
			?>
		<aside id="secondary" <?php echo wps_prime_theme_main_sidebar_class(); ?> role="complementary">
			<?php wps_sidebar_start(); ?>
			<?php dynamic_sidebar( 'sidebar-shop' ); ?>
			<?php wps_sidebar_end(); ?>
		</aside><!-- #secondary -->
			<?php
		}
	} else {

		if ( is_active_sidebar( 'sidebar-1' ) ) {
			?>
	
		<aside id="secondary" <?php echo wps_prime_theme_main_sidebar_class(); ?> role="complementary">
				<?php wps_sidebar_start(); ?>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php wps_sidebar_end(); ?>
		</aside><!-- #secondary -->
			<?php
		}
	}
}
