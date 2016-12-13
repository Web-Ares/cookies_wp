<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
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
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<h3 id="ship-to-different-address">
			<label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', 'woocommerce' ); ?></label>
			<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
		</h3>
		<h2 class="checkout__title">your Shipping info</h2>
<!-- checkout__info-billing -->
<div class="checkout__info-billing">
	
			<!-- checkout__info -->
			<div class="checkout__info">
				<div>

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div>
							<label class="site__label" for="shipping_first_name">FIRST NAME</label>
						</div>
						<div>
							<input class="site__input"  value="<?= $checkout->get_value('shipping_first_name') ?>" data-required type="text" id="shipping_first_name" name="shipping_first_name">
						</div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div><label class="site__label" for="shipping_last_name">LAST NAME</label></div>
						<div><input class="site__input"  data-required value="<?= $checkout->get_value('shipping_last_name') ?>" type="text" id="shipping_last_name" name="shipping_last_name"></div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div><label class="site__label" for="shipping_email">E-MAIL</label></div>
						<div><input class="site__input"  data-required value="<?= $checkout->get_value('shipping_email') ?>" type="email" id="shipping_email" name="shipping_email"></div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div> <label class="site__label" for="shipping_phone">PHONE</label></div>
						<div><input class="site__input"  data-required value="<?= $checkout->get_value('shipping_phone') ?>" type="tel" id="shipping_phone" name="shipping_phone"></div>
					</fieldset>
					<!-- /checkout__fields -->

				</div>
				<div>

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div><label class="site__label" for="shipping_address_1">ADDRESS</label></div>
						<div><input class="site__input"  data-required value="<?= $checkout->get_value('shipping_address_1') ?>" type="text" id="shipping_address_1" name="shipping_address_1"></div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div><label class="site__label" for="shipping_address_2">ADDRESS</label></div>
						<div><input class="site__input"   value="<?= $checkout->get_value('shipping_address_2') ?>" type="text" id="shipping_address_2" name="shipping_address_2"></div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields checkout__fields-hide">
						<div><label class="site__label" for="shipping_country">Country</label></div>
						<div><input class="site__input"  data-required value="US" type="text" id="shipping_country" name="shipping_country"></div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields">
						<div><label class="site__label" for="shipping_city">CITY & STATE</label></div>
						<div class="checkout__fields__two">
							<div>

								<?php $states = WC()->countries->get_states( 'US' );  ?>

								<input class="site__input" data-required value="<?= $checkout->get_value('shipping_city') ?>" type="text" id="shipping_city" name="shipping_city">

								<?php

								if(is_array( $states ) && !empty( $states )):
									?>
									<select name="shipping_state" id="state">

										<?php foreach ($states as $key => $state){

											if($checkout->get_value('shipping_state') == $key){
												$selected = 'selected';
											} else {
												$selected = '';
											}

											?>

											<option  <?= $selected ?> value="<?= $key ?>"><?= $key ?></option>

										<?php } ?>

									</select>
								<?php endif; ?>

							</div>
						</div>
					</fieldset>
					<!-- /checkout__fields -->

					<!-- checkout__fields -->
					<fieldset class="checkout__fields checkout__fields_zip">
						<div><label class="site__label" for="shipping_postcode">ZIP</label></div>
						<div><input class="site__input"  data-required value="<?= $checkout->get_value('shipping_postcode') ?>" type="text" id="shipping_postcode" name="shipping_postcode"></div>
					</fieldset>
					<!-- /checkout__fields -->
					
				</div>
			</div>
			<!-- /checkout__info -->
</div>
<!-- /checkout__info-billing -->
		
	<?php endif; ?>


