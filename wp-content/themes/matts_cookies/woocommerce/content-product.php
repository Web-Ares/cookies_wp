<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$thumb_id = get_post_thumbnail_id($product->get_id());
$thumb_url = wp_get_attachment_image_src($thumb_id,'full')[0];

 if( $thumb_url){
	$cur_thumb = ' style="background-image: url('.$thumb_url.')"';
} else {
	$cur_thumb = '';
} 

?>

<div class="slick-slide">

	<!-- products-cookies__item -->
	<a href="<?= $product->get_permalink() ?>" class="products-cookies__item">

		<h3 class="products-cookies__name"><?= $product->get_title() ?></h3>

		<!-- products-cookies__pic -->
		<div class="products-cookies__pic"<?= $cur_thumb; ?>"></div>
		<!-- /products-cookies__pic -->

		<span class="btn btn_2">add to cart</span>

	</a>
	<!-- /products-cookies__item -->

</div>
