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
 ?>
<!-- my-cart -->
<div class="my-cart">

	<!-- my-cart__layout -->
	<div class="my-cart__layout">

		<!-- my-cart__products -->
		<div class="my-cart__products">
			<form action="#">

				<div class="my-cart__head">
					<div class="my-cart__caption">product</div>
					<div class="my-cart__caption">Qty</div>
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

						<a href="<?= $link ?>" class="my-cart__name">

								<!-- my-cart__product -->
								<div class="my-cart__pic">
									<img src="<?= $thumb_url ?>" width="141" height="132" alt="$productTitle">
								</div>
								<!-- my-cart__product -->

								<div>
									<span><span>Matt’s Cookies:</span> <?= $productTitle ?>, <?= $_product->get_weight(); ?>oz </span>
								</div>

							</a>

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
									<?= $_product->get_price_html(); ?>
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
						<a href="#" class="my-cart__remove">
							<span></span>
						</a>
						<!-- /my-cart__remove -->

						<!-- my-cart__loading -->
						<div class="my-cart__loading">
							<span class="my-cart__loading-spin"></span>
						</div>
						<!-- /my-cart__loading -->

					</div>
				</div>
				<!-- /my-cart__product -->

			<?php } ?>

				<!-- my-cart__footer -->
				<div class="my-cart__footer">

					<?php
					$coupons = WC()->cart->get_applied_coupons();
					$discount = WC()->cart->get_coupon_discount_amount($coupons[0]);

					$trueCoupon = count(WC()->cart->applied_coupons);

					if($trueCoupon > 0){

						$discount = WC()->cart->get_total_discount();

						$my_cart__discount = 'visible';
						$my_cart__define = 'hidden';
						$my_cart__applied = 'visible';
					} else {
						$my_cart__discount = '';
						$my_cart__define = '';
						$my_cart__applied = '';
					}

					?>
					
					<!-- my-cart__promo-code -->
					<div class="my-cart__promo-code">

						<!-- my-cart__define -->
						<div class="my-cart__define <?= $my_cart__define ?>">
							<label for="promo-code">Promo code:</label>
							<input type="text" class="site__input" value="<?= $coupons[0] ?>" name="promo-code" id="promo-code">
							<button type="button" class="btn btn_4"><span>APPLY</span></button>
						</div>
						<!-- /my-cart__define -->

						<!-- my-cart__applied -->
						<div class="my-cart__applied <?= $my_cart__applied ?>">
							Promo code applied <a href="#">cancel</a>
						</div>
						<!-- /my-cart__applied -->

						<!-- my-cart__invalid -->
						<div class="my-cart__invalid">
							Invalid promo code <a href="#">dismiss</a>
						</div>
						<!-- /my-cart__invalid -->

						<!-- my-cart__promo-loading -->
						<span class="my-cart__promo-loading"></span>
						<!-- /my-cart__promo-loading -->

					</div>
					<!-- /my-cart__promo-code -->

					<div>

						<dl class="my-cart__discount <?= $my_cart__discount ?>">
							<dt>Promo code discount:</dt>
							<dd><?= $discount ?></dd>
						</dl>
						<dl class="my-cart__total">
							<dt>SUBTOTAL:</dt>
							<dd><?= WC()->cart->get_cart_total(); ?></dd>
						</dl>

						<a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="btn btn_5"><span>PROCEED TO CHECKOUT</span></a>
					</div>

				</div>
				<!-- /my-cart__footer -->

			</form>
		</div>
		<!-- /my-cart__products -->

		<!-- my-cart__empty -->
		<div class="my-cart__empty">
			<div>

				<h2 class="site__title site__title_3">Your cart is currently empty.</h2>
				<a class="btn product-single__add" href="<?= get_permalink('76') ?>">Return To Shop</a>

			</div>
		</div>
		<!-- /my-cart__empty -->

	</div>
	<!-- /my-cart__layout -->

</div>
<!-- /product-single -->