<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

<!-- site__content -->
<div class="site__content">

    <?php get_template_part('content', 'main-slider'); ?>
    
    <?php get_template_part('content', 'our-cookies'); ?>
    
    <?php get_template_part('content', 'about-us'); ?>
    
    <!-- store-finder -->
    <div class="store-finder slides" data-scroll="scroll">

        <h2 class="site__main-title">STORE FINDER</h2>

        <!-- store-finder__layout -->
        <div class="store-finders__layout">

            <form action="#">

                <!-- store-finders__fields -->
                <div class="store-finders__fields">
                    <div class="store-finders__address">
                        <label for="zip-code-address">ZIP CODE or ADDRESS</label>
                        <input type="text" class="site__input" name="zip-code-address" id="zip-code-address" placeholder="Enter Your Zip or Street address">
                    </div>
                    <div class="store-finders__distance">
                        <label for="distance">DISTANCE</label>
                        <select name="distance" id="distance">
                            <option value="0">5 Miles</option>
                            <option value="1">10 Miles</option>
                            <option value="2">15 Miles</option>
                            <option value="3">20 Miles</option>
                            <option value="4">25 Miles</option>
                            <option value="5">30 Miles</option>
                            <option value="6">35 Miles</option>
                            <option value="7">40 Miles</option>
                            <option value="8">45 Miles</option>
                        </select>
                    </div>
                    <div class="store-finders__search">
                        <button type="button" class="btn btn_3 popup__open store-finders__search" data-popup="store-finder"><span>Search</span></button>
                    </div>

                </div>
                <!-- /store-finders__fields -->

            </form>

        </div>
        <!-- /store-finder__layout -->


<!--        --><?php //echo do_shortcode('[wpsl]') ?>

    </div>
    <!-- /store-finder -->
    
    <?php
    $tmp = $post;
    $arg = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'post_visibility' => 'public'
    );

    $products = new WP_Query($arg);

    if($products->have_posts()) {  ?>

    <!-- products-cookies -->
    <div class="products-cookies">

        <h2 class="site__main-title slides"><?= get_the_title(76) ?></h2>

        <!-- products-cookies__layout -->
        <div class="products-cookies__layout slides">

            <!-- products-cookies__items -->
            <div class="products-cookies__items">

                <!-- slick-container -->
                <div class="slick-container">

                <?php while ( $products->have_posts()) :

                $products->the_post(); ?>

                <?php wc_get_template('content-product.php'); ?>

                <?php endwhile; ?>

                </div>
                <!-- /slick-container -->

            </div>
            <!-- /products-cookies__items -->

        </div>
        <!--/products-cookies__layout -->

    </div>
    <!-- /products-cookies -->

        <?php

    }
    $post = $tmp;
    ?>


</div>
<!-- /site__content -->


<?php get_footer(); ?>
