<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$productID = $product->get_id();
$productTitle = $product->get_title();
$price = $product->get_price_html();

$weight = $product->get_weight();
$dimensions = $product->get_attribute('Prepacking type');
if(!empty($dimensions)){
	$dimensions = $dimensions.', ';
}

?>

<!-- product-single -->
<div class="product-single">

	<!-- product-single__layout -->
	<div class="product-single__layout">

		<!-- product-single__info -->
		<div class="product-single__info" data-id="<?= $productID; ?>">

			<h2 class="site__title site__title_2"><?= $productTitle; ?></h2>

			<!-- product-single__price -->
			<span class="product-single__price"><?= $price ?></span>
			<!-- /product-single__price -->

			<?php
			$imagesArray = array();
			if( have_rows('gallery_block',$productID) ):
				while ( have_rows('gallery_block',$productID) ) : the_row();

				$imagesArray[]=get_sub_field('choose_the_iamge');

				endwhile;
			endif; ?>

				<?php if(count($imagesArray)>0): ?>

					<!-- product-single__gallery -->
					<div class="product-single__gallery">

						<!-- swiper-container -->
						<div class="swiper-container gallery__top">
							<?php foreach ($imagesArray as $image){ ?>
								<div class="slick-container__slide" style="background-image:url(<?= $image; ?>)" data-image="<?= $image; ?>"></div>
							<?php } ?>
						</div>
						<!-- /swiper-container -->

						<!-- swiper-container -->
						<div class="swiper-container gallery__thumbs">
							<?php foreach ($imagesArray as $image){ ?>
								<div class="slick-container__slide" style="background-image:url(<?= $image; ?>)"></div>
							<?php } ?>
						</div>
						<!-- /swiper-container -->
					</div>
					<!-- /product-single__gallery -->

				<?php endif; ?>

			<!-- product-single__items -->
			<div class="product-single__items">

				<?php
					the_content();
				?>

				<?php if(get_field('ingridients_text')): ?>
					<a href="#" class="product-single__show popup__open" data-popup="ingredients-info">Show Nutrition Information and Ingredients</a>
				<?php endif; ?>

				<!-- product-single__quantity -->
				<div class="product-single__quantity">
					<form action="#">
						<span>Q-ty</span>

						<!-- product-single__quantity-change -->
						<div class="count-product product-single__quantity-change">
							<a class="count-product__btn count-product_del" href="#"><span>-</span></a>
							<input type="number" class="count-product__input site__input" value="1">
							<a class="count-product__btn count-product_add" href="#"><span>+</span></a>
						</div>
						<!-- /product-single__quantity-change -->

						<?php if($product->has_weight()){ ?>
							<span><?= $dimensions ?> <?= $weight ?>OZ</span>
						<?php } ?>



						<div>
							<button type="submit" class="btn product-single__add"><span>ADD TO CART</span></button>
						</div>

					</form>
				</div>
				<!-- /product-single__quantity -->

			</div>
			<!-- /product-single__items -->

		</div>
		<!-- /product-single__info -->

	</div>
	<!-- /product-single__layout -->

</div>
<!-- /product-single -->


