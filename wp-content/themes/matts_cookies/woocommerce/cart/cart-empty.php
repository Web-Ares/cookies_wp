<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<!-- my-cart -->
<div class="my-cart empty">

	<!-- my-cart__layout -->
	<div class="my-cart__layout">

	<!-- my-cart__empty -->
	<div class="my-cart__empty">
		<div>

			<h2 class="site__title site__title_3">Your cart is currently empty.</h2>
			<a class="btn product-single__add" href="<?= get_permalink('76') ?>">Return To Shop</a>

		</div>
	</div>
	<!-- /my-cart__empty -->



</div>
</div>
<!-- /product-single -->