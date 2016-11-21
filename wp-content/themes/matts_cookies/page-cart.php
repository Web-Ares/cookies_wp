<?php
/**
 * Template Name: Cart Page
 */
get_header(); ?>

<!-- site__content -->
<div class="site__content">

    <h1 class="site__main-title site__main-title_2"><?php the_title() ?></h1>

    <?= do_shortcode('[woocommerce_cart]') ?>

    <?php

    if(isset($_GET['coupons'])){
        WC()->cart->remove_coupons();
    }

    $coupons = WC()->cart->get_applied_coupons();
    ?>

    <div class="cart-coupons">

        <?php foreach ($coupons as $coupon): ?>

            <div class="coupon-item">
                <?php echo $coupon; ?>
                <span class="remove-coupon-item">Remove</span>
            </div>

       <?php  endforeach;

        echo do_shortcode('[gravityform id=1 title=true description=true ajax=true]');
        ?>

    </div>

</div>
<!-- /site__content -->


<?php get_footer(); ?>
