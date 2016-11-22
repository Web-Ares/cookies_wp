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

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<!-- checkout -->
<div class="checkout">

	<!-- checkout__layout -->
	<div class="checkout__layout">

		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<!-- checkout__form -->
			<div class="checkout__form">

				<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				<?php endif; ?>

				<!-- nice-checkbox -->
				<div class="nice-checkbox checkout__show-billing">
					<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
					<label for="ship-to-different-address-checkbox">same as SHIPPING</label>
				</div>
				<!-- /nice-checkbox -->

				<!-- checkout__proceed -->
				<div class="checkout__proceed">
					<a href="#" class="btn btn_5">PROCEED TO CHECKOUT</a>
				</div>
				<!-- /checkout__proceed -->

			</div>
			<!-- /checkout__form -->

			<!-- my-cart__review -->
			<div class="my-cart__review">
				<h2 class="site__title site__title_4">Please review YOUR order</h2>

				<!-- my-cart__items -->
				<div class="my-cart__items">
					<dl>
						<dt>Matt’s Cookies: Peanut Butter, 25oz x 1</dt>
						<dd>$3.75</dd>
					</dl>
					<dl>
						<dt>Matt’s Cookies: Double Chocolate, 25oz x 1</dt>
						<dd>$3.75</dd>
					</dl>
					<dl>
						<dt>Matt’s Cookies: Peanut Butter, 25oz x 1</dt>
						<dd>$3.75</dd>
					</dl>
					<dl>
						<dt>Matt’s Cookies: Double Chocolate, 25oz x 1</dt>
						<dd>$3.75</dd>
					</dl>
				</div>
				<!-- /my-cart__items -->

				<!-- my-cart__items -->
				<div class="my-cart__items">
					<dl>
						<dt>Shipping</dt>
						<dd>$3.75</dd>
					</dl>
					<dl>
						<dt>Tax</dt>
						<dd>$3.75</dd>
					</dl>
				</div>
				<!-- /my-cart__items -->

				<!-- my-cart__results -->
				<div class="my-cart__results">
					<dl>
						<dt>TOTAL:</dt>
						<dd>$13.75</dd>
					</dl>
				</div>
				<!-- /my-cart__results -->

				<a href="#" class="btn btn_5"><span>PROCEED TO Payment</span></a>

			</div>
			<!-- /my-cart__review -->
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</form>

	</div>
	<!-- /checkout__layout -->

</div>
<!-- /checkout -->