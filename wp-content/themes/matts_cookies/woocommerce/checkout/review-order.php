<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
?>
<!-- my-cart__review -->
<div class="my-cart__review">
	<h2 class="site__title site__title_4">Please review YOUR order</h2>

	<!-- my-cart__items -->
	<div class="my-cart__items">

		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>

				<dl>
					<dt><?= $_product->get_title() ?>, <?= $_product->get_weight(); ?>oz x <?= $cart_item['quantity'] ?></dt>
					<dd><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></dd>
				</dl>

				<?php
			}
		}
		?>

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
			<dd><?= WC()->cart->get_cart_total(); ?></dd>
		</dl>
	</div>
	<!-- /my-cart__results -->



