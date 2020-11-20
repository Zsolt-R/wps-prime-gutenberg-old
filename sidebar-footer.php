<?php
/**
 * Footer Sidebars.
 *
 * @package wps_prime
 */

?>

<?php
if ( ! ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) ) ) {
	return;
}
?>
<div class="widget-area-container">	
		<div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
		</div>	
		<div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
		</div>	
		<div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
		</div>	
		<div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
		</div>	
</div>
