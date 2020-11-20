<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

class WPS_THEME_Woo_Reviews {
	static function display_review_count() {

		if ( ! comments_open() ) {
			return;
		}
		global $product;
		$rating_count = $product->get_rating_count();
		?>
		<h2 class="woocommerce-reviews-title">
		<?php if ( $rating_count > 0 ) : ?>
			
			<?php

			if ( $rating_count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $rating_count, 'woocommerce' ) ), esc_html( $rating_count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $rating_count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'woocommerce' );
			}
			?>
		
		<?php else : ?>
			<?php _e( 'Customer Reviews', 'wps-lv-426' ); ?>	
		<?php endif; ?>
		</h2>	
		<?php
	}
	static function display_review_form() {

		if ( ! comments_open() ) {
			return;
		}
		global $product;

		?>
			<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php

				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => get_comments_number() > 0 ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'woocommerce' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'woocommerce' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	<?php endif; ?>
</div>
			<?php
	}

	static function display_review_list() {
		global $product;
		$id           = $product->get_id();
		$rating_count = $product->get_rating_count();
		?>
			<?php if ( $rating_count > 0 ) : ?>
				<?php

					// Arguments for the query
					$args = array(
						'order'     => 'ASC',
						'orderby'   => 'date',
						'post_type' => 'product',
						'post_id'   => $id,
					);

					// The comment query
					$comments_query = new WP_Comment_Query();
					$comments       = $comments_query->query( $args );

					foreach ( $comments as $comment ) :

						$timestamp     = strtotime( $comment->comment_date ); // Changing comment time to timestamp
						$date          = date( 'd-m-Y', $timestamp );
						$rating_number = get_comment_meta( $comment->comment_ID, 'rating', true );
						$stars         = WPS_THEME_Woo_Helpers::stars( $rating_number );

						?>
						<div class="wc-single-product-review">
							<div class="wc-single-product-review-rating-top">
								<span class="wc-single-product-review-stars-wrap"><?php echo $stars; ?></span>
								<div class="wc-single-product-review-rating-top__right">
									<span><?php _e( 'By', 'wps-lv-426' ); ?></span>
									<span class="wc-single-product-review-author"><?php echo $comment->comment_author; ?></span>
									<span><?php _e( 'on', 'wps-lv-426' ); ?></span>
									<span class="wc-single-product-review-date"><?php echo $date; ?></span>
								</div>
							</div>
							<div class="wc-single-product-review-content"><?php echo $comment->comment_content; ?></div>
						</div>
						<?php

					endforeach;
					?>
							
			<?php else : ?>				
					<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>				
				<?php
			endif;
	}
}
