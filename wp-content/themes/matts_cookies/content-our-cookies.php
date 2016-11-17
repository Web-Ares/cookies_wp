<?php if( have_rows('our_cookies_block') ): ?>

    <!-- our-cookies -->
    <div class="our-cookies slides" data-scroll="scroll">

        <h2 class="site__main-title"><?php the_field('block_title'); ?></h2>

        <!-- our-cookies__inner -->
        <div class="our-cookies__inner">

            <div class="slick-container">

                <?php   while ( have_rows('our_cookies_block') ) : the_row();

                    $image = get_sub_field('preview_image');
                    $link_id = get_sub_field('choose_the_product');
                    $link = get_the_permalink($link_id);
                    $text = get_sub_field('desrciption_text_');
                    $title = get_the_title($link_id);
                    ?>

                    <div class="slick-slide">

                        <!-- our-cookies__info -->
                        <div class="our-cookies__info">

                            <h2 class="site__title"><?= $title;  ?></h2>
                            <div class="our-cookies__pic" style="background-image: url(<?= $image; ?>)"></div>
                            <p><?= $text; ?></p>
                            <a href="<?= $link; ?>" class="btn">BUY NOW</a>

                        </div>
                        <!-- /our-cookies__info -->

                    </div>

                <?php

                    endwhile; ?>

            </div>

        </div>
            <!-- /our-cookies__inner -->

    </div>
    <!-- /our-cookies -->

  <?php   endif; ?>