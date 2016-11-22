<?php
/**
 * Template Name: Checkout Page
 */


get_header(); ?>

    <!-- site__content -->
    <div class="site__content">

        <h1 class="site__main-title site__main-title_2"><?php the_title() ?></h1>

        <?= do_shortcode('[woocommerce_checkout]') ?>

    </div>
    <!-- /site__content -->

<?php get_footer(); ?>