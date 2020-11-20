<?php

function wps_theme_footer() {

	$show_footer = true;
	if ( is_page() && get_post_meta( get_the_id(), '_wps_prime_hide_footer', true ) ) {
		$show_footer = false;
	}

	$custom_footer         = get_theme_mod( 'use_custom_footer', false );
	$custom_footer_content = get_option( 'footer_custom_content', false );

	if ( $show_footer ) : ?>
		
		<footer id="colophon" <?php echo wps_prime_theme_footer_class(); ?> role="contentinfo">
		<?php wps_footer_start(); ?>
	
		<?php if ( ! $custom_footer ) : ?>			
				<?php get_sidebar( 'footer' ); ?>			
		<?php else : ?>
			<?php echo do_shortcode( $custom_footer_content ); ?>
		<?php endif; ?>

		<?php wps_footer_end(); ?>
	</footer><!-- #colophon -->
		<?php
	endif;
}
