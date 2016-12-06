<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<!-- checkout -->
<div>

	<!-- checkout__layout -->
	<div class="checkout__layout">

		<form name="checkout" class="checkout woocommerce-checkout" method="post" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<!-- checkout__form -->
			<div class="checkout__form">

				<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>

					<!-- nice-checkbox -->
					<div class="nice-checkbox checkout__show-billing">
						<input type="checkbox" name="billing" checked id="billing">
						<label for="billing">same as SHIPPING</label>
					</div>
					<!-- /nice-checkbox -->

				<?php endif; ?>


				<!-- checkout__proceed -->
				<div class="checkout__proceed">
					<a href="#" class="btn btn_5">PROCEED TO CHECKOUT</a>
				</div>
				<!-- /checkout__proceed -->

			</div>
			<!-- /checkout__form -->

			<div class="my-cart__review">
				<h2 class="site__title site__title_4">Please review YOUR order</h2>
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				<a href="#" class="btn btn_5 checkout__back"><span>back</span></a>
			</div>

		</form>

	</div>
	<!-- /checkout__layout -->

</div>
<!-- /checkout -->

