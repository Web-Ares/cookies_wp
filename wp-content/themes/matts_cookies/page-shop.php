<?php
/**
 * Template Name: Shop Page
 */
get_header(); ?>


    <!-- site__content -->
    <div class="site__content">

        <h1 class="site__main-title site__main-title_2"><?php the_title(); ?></h1>

        <!-- shop -->
        <div class="shop">

            <!-- products-cookies -->
            <div class="products-cookies">

                <!-- products-cookies__layout -->
                <div class="products-cookies__layout">

                    <?php get_template_part('content', 'products_preview'); ?>

                </div>
                <!--/products-cookies__layout -->

            </div>
            <!-- /products-cookies -->

        </div>
        <!-- /shop -->

    </div>
    <!-- /site__content -->


<?php get_footer(); ?>