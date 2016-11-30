<!-- about-us -->
<div class="about-us slides" data-scroll="scroll">

    <h2 class="site__main-title"><?php the_field('title_of_block') ?></h2>

    <!-- about-us__layout -->
    <div class="about-us__layout">

        <!-- about-us__cookies -->
        <div class="about-us__cookies about-us__cookies_1"></div>
        <!-- /about-us__cookies -->

        <!-- about-us__cookies -->
        <div class="about-us__cookies about-us__cookies_2"></div>
        <!-- /about-us__cookies -->

        <!-- about-us__cookies -->
        <div class="about-us__cookies about-us__cookies_3"></div>
        <!-- /about-us__cookies -->

        <!-- about-us__cookies -->
        <div class="about-us__cookies about-us__cookies_4"></div>
        <!-- /about-us__cookies -->

        <!-- about-us__inner -->
        <div class="about-us__inner">

            <!-- about-us__text -->
            <div class="about-us__text">

                <!-- about-us__caption -->
                <div class="about-us__caption">
                    <?php $image = get_field('real_stuff_logo');
                    $attributes['alt'] = get_post_meta($image , '_wp_attachment_image_alt', true);

                    $attributes['url'] = wp_get_attachment_image_src($image,'full')[0];

                    $attributes['description'] = get_post($image)->post_content;
                    ?>

                    <img src="<?= $attributes['url'] ?>" title="<?= $attributes['description'] ?>" alt="<?= $attributes['alt'] ?>">
                </div>
                <!-- /about-us__caption -->

                <?php the_field('the_real_stuff_text') ?>
            </div>
            <!-- about-us__text -->

        </div>
        <!-- /about-us__inner -->

    </div>
    <!-- /about-us__layout -->

    <!-- real-stuff -->
    <div class="real-stuff" data-scroll="scroll">

        

            <!-- real-stuff__title -->
            <h2 class="real-stuff__title">
                <?php the_field('the_real_stuff_slogan') ?>
            </h2>
            <!-- /real-stuff__title -->

            <!-- real-stuff__products -->
            <div class="real-stuff__products">

                <?php if( have_rows('ingridients_description_blocks') ):
                    $step=1;
                    ?>
                <!-- real-stuff__products-img -->
                <div class="real-stuff__products-img">
                       <?php  while ( have_rows('ingridients_description_blocks') ) : the_row(); ?>

                           <!-- real-stuff__description -->
                           <div class="real-stuff__description real-stuff__description_<?= $step; ?> popup__open cookies-info_btn" data-popup="cookies-info">

                               <a class="real-stuff__description-btn" href="#"></a>
                               <div class="real-stuff__description-content">
                                   <h2 class="cookies-info__title"><?php the_sub_field('title_of_ingridient') ?></h2>
                                   <div class="cookies-info__text">
                                       <?php the_sub_field('description') ?>
                                   </div>
                               </div>

                           </div>
                           <!-- /real-stuff__description -->

                            <?php
                           $step++;
                        endwhile; ?>

                </div>
                <!-- /real-stuff__products-img -->
                <?php endif; ?>

            </div>
            <!-- /real-stuff__products -->

        <!-- real-stuff__layout -->
        <div class="real-stuff__layout">
            
            <!-- real-stuff__ingredients -->
            <div class="real-stuff__ingredients">

              <?php if( have_rows('more_ingridients_block') ): ?>
                <!-- real-stuff__ingredients-list -->
                <div class="real-stuff__ingredients-list">
                    <div>
               <?php  while ( have_rows('more_ingridients_block') ) : the_row(); ?>

                   <dl class="cookies-info_btn popup__open" data-popup="cookies-info">
                       <dt class="cookies-info__title"><?php the_sub_field('title') ?></dt>
                       <dd>

                           <!-- real-stuff__ingredients-info -->
                           <div class="real-stuff__ingredients-info">
                               <div class="cookies-info__text">
                                   <?php the_sub_field('description') ?>
                               </div>
                           </div>
                           <!-- real-stuff__ingredients-list -->

                       </dd>
                   </dl>

                    <?php

                     endwhile; ?>

                    </div>
                </div>
                  <!-- /real-stuff__ingredients-list -->
                  <?php   endif; ?>

                <a href="#" class="btn btn_2" data-open="SHOW LESS" data-close="SHOW More">SHOW More</a>

            </div>
            <!-- /real-stuff__ingredients -->

        </div>
        <!-- /real-stuff__layout -->

    </div>
    <!-- /real-stuff -->

</div>
<!-- /about-us -->