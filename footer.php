<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPS_Prime_2
 */

?>
	<?php wps_content_end(); ?>
	</div><!-- #content -->
	<?php wps_after_content(); ?>
	<?php wps_before_footer(); ?>	
		<?php wps_footer_content(); ?>
	<?php wps_after_footer(); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
