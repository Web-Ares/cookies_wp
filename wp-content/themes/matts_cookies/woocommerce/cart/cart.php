<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$currency = get_woocommerce_currency_symbol(); ?>
<!-- my-cart -->
<div class="my-cart">

	<!-- my-cart__layout -->
	<div class="my-cart__layout">

		<!-- my-cart__products -->
		<div class="my-cart__products">
			<form action="#">

				<div class="my-cart__head">
					<div class="my-cart__caption">product</div>
					<div class="my-cart__caption">Q-ty</div>
					<div class="my-cart__caption">price</div>
					<div class="my-cart__caption">TOTAL</div>
				</div>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
			$thumb_id = get_post_thumbnail_id($product_id);
			$thumb_url = wp_get_attachment_image_src($thumb_id,'full')[0];
			$productTitle = $_product->get_title();
			$link = get_permalink($product_id);
			?>

				<!-- my-cart__product -->
				<div class="my-cart__product"  data-product-key="<?= $cart_item_key ?>" data-product-id="<?= $product_id ?>">
					<div>

						<!-- my-cart__product -->
						<div class="my-cart__name">

							<!-- my-cart__product -->
							<a href="<?= $link ?>" class="my-cart__pic">
								<img src="<?= $thumb_url ?>" width="141" height="132" alt="<?= $productTitle ?>">
							</a>
							<!-- my-cart__product -->

							<div>
								<a href="<?= $link ?>"><span>Matt’s Cookies:</span> <?= $productTitle ?>, <?= $_product->get_weight(); ?>oz </a>
							</div>

						</div>
						<!-- my-cart__product -->

						<!-- my-cart__info -->
						<div class="my-cart__info">
							<div>
								<div class="my-cart__caption">Q-ty</div>
								<div class="my-cart__caption">price</div>
								<div class="my-cart__caption">TOTAL</div>
							</div>
							<div>

								<!-- count-product -->
								<div class="count-product">
									<a class="count-product__btn count-product_del" href="#"><span>-</span></a>
									<input type="number" class="count-product__input site__input" value="<?= $cart_item['quantity'] ?>">
									<a class="count-product__btn count-product_add" href="#"><span>+</span></a>
								</div>
								<!-- /count-product -->

								<div class="my-cart__current-price">
									<?= $currency.$_product->get_price(); ?>
								</div>

								<div class="my-cart__total-price">
									<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									?>
								</div>

							</div>

						</div>
						<!-- /my-cart__info -->

						<!-- my-cart__remove -->
						<a href="#" class="my-cart__remove"></a>
						<!-- /my-cart__remove -->

					</div>
				</div>
				<!-- /my-cart__product -->

			<?php } ?>

				<!-- my-cart__footer -->
				<div class="my-cart__footer">

					<!-- my-cart__promo-code -->
					<div class="my-cart__promo-code">
						<label for="promo-code">Promo code:</label>
						<input type="text" class="site__input" name="promo-code" id="promo-code">
						<button type="button" class="btn btn_4"><span>APPLY</span></button>
					</div>
					<!-- /my-cart__promo-code -->

					<div>

						<span class="my-cart__total">SUBTOTAL: <span><?= WC()->cart->get_cart_total(); ?></span></span>

						<button type="submit" class="btn btn_5"><span>PROCEED TO CHECKOUT</span></button>

					</div>

				</div>
				<!-- /my-cart__footer -->

			</form>
		</div>
		<!-- /my-cart__products -->

	</div>
	<!-- /my-cart__layout -->

</div>
<!-- /product-single -->