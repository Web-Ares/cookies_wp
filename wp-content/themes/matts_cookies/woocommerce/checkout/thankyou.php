<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

		<p class="woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<!-- site__content-full -->
		<div class="site__content-full site__content_centered">

			<!-- confirmation -->
			<div class="confirmation">

				<!-- confirmation__layout -->
				<div class="confirmation__layout">

					<h2 class="site__title site__title_4">THANK YOU!</h2>

					<!-- confirmation__info -->
					<div class="confirmation__info">
						<p>Your order #<?php echo $order->get_order_number(); ?> was successfully placed.</p>
						<p>Your cookies are on the way!</p>
					</div>
					<!-- /confirmation__info -->

					<p>In the meantime, join the Matt’s Cookie Club for exclusive offers
						and discounts!</p>

					<a href="#" class="btn btn_6 popup__open" data-popup="sign">SIGN ME UP</a>

				</div>
				<!-- /confirmation__layout -->

			</div>
			<!-- /confirmation -->

		</div>
		<!-- /site__content-full -->

	<?php endif; ?>


<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
