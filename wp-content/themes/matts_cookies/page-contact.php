<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

    <!-- site__content -->
    <div class="site__content">

        <h1 class="site__main-title site__main-title_2"><?php the_title(); ?></h1>

        <!-- site__content-full -->
        <div class="site__content-full site__content_centered">

            <!-- contact-us -->
            <div class="contact-us">

                <!-- contact-us__layout -->
                <div class="contact-us__layout">

                    <!-- contact-us__info -->
                    <div class="contact-us__info">

                        <h2 class="site__title site__title_4"><?php the_field('company_title') ?></h2>

                        <?php if( have_rows('address') ): ?>
                        <address class="contact-us__address">
                                   <?php  while ( have_rows('address') ) : the_row(); ?>

                                            <p><?php the_sub_field('new_line_of_info') ?></p>

                                        <?php

                                    endwhile;
                                   $phone = get_field('phone');

                                   ?>
                            <a href="<?= $phone ?>"><?= $phone ?></a>
                        </address>
                        <?php   endif;
                        $mail = get_field('mail','options')
                        ?>

                        <a href="tel:<?= $phone ?>" class="btn btn_7 contact-us__phone">CALL NOW: <?= $phone ?></a>
                        <a href="mailto:<?= $mail ?>?subject=<?= get_field('subject_for_emails','options') ?>" class="btn btn_7">SEND US A MESSAGE</a>



                        <!-- social-networks -->
                        <div class="social-networks social-networks_3">
                            <span>Connect to us:</span>

                        <?php
                        if($link = get_field('facebook_link','options')):
                            ?>
                            <a target="_blank" href="<?= $link ?>" class="social-networks__item">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 96.124 96.123" style="enable-background:new 0 0 96.124 96.123;" xml:space="preserve">
                                    <g>
                                        <path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803   c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654   c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246   c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z"/>
                                    </g>
                                </svg>
                            </a>
                                <?php endif;
                                if($link = get_field('twitter_link','options')):
                                    ?>
                            <a target="_blank" href="<?= $link ?>" class="social-networks__item">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 430.117 430.117" style="enable-background:new 0 0 430.117 430.117;" xml:space="preserve">
                                    <g>
                                        <path d="M381.384,198.639c24.157-1.993,40.543-12.975,46.849-27.876   c-8.714,5.353-35.764,11.189-50.703,5.631c-0.732-3.51-1.55-6.844-2.353-9.854c-11.383-41.798-50.357-75.472-91.194-71.404   c3.304-1.334,6.655-2.576,9.996-3.691c4.495-1.61,30.868-5.901,26.715-15.21c-3.5-8.188-35.722,6.188-41.789,8.067   c8.009-3.012,21.254-8.193,22.673-17.396c-12.27,1.683-24.315,7.484-33.622,15.919c3.36-3.617,5.909-8.025,6.45-12.769   C241.68,90.963,222.563,133.113,207.092,174c-12.148-11.773-22.915-21.044-32.574-26.192   c-27.097-14.531-59.496-29.692-110.355-48.572c-1.561,16.827,8.322,39.201,36.8,54.08c-6.17-0.826-17.453,1.017-26.477,3.178   c3.675,19.277,15.677,35.159,48.169,42.839c-14.849,0.98-22.523,4.359-29.478,11.642c6.763,13.407,23.266,29.186,52.953,25.947   c-33.006,14.226-13.458,40.571,13.399,36.642C113.713,320.887,41.479,317.409,0,277.828   c108.299,147.572,343.716,87.274,378.799-54.866c26.285,0.224,41.737-9.105,51.318-19.39   C414.973,206.142,393.023,203.486,381.384,198.639z"/>
                                    </g>
                                </svg>
                            </a>
                                <?php endif;
                            if($link = get_field('instagram_link','options')):
                                ?>
                            <a target="_blank" href="<?= $link ?>" class="social-networks__item social-networks__item_instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 169.063 169.063" style="enable-background:new 0 0 169.063 169.063;" xml:space="preserve">
                                <g>
                                    <path d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752   c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407   c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752   c17.455,0,31.656,14.201,31.656,31.655V122.407z"/>
                                    <path d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561   C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561   c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z"/>
                                    <path d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78   c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78   C135.661,29.421,132.821,28.251,129.921,28.251z"/>
                                </g>
                            </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                        <!-- /social-networks -->

                    </div>
                    <!-- /contact-us__info -->

                </div>
                <!-- /contact-us__layout -->

                <!-- contact-us__map -->
                <div class="contact-us__map" id="contact-google-map" data-map-lat="42.147441" data-map-lng="-87.912872" data-icon-path="<?= DIRECT; ?>img/marker.png" data-map-zoom="11">


                </div>
                <!-- /contact-us__map -->

            </div>
            <!-- /contact-us -->

        </div>
        <!-- /site__content-full -->

    </div>
    <!-- /site__content -->


<?php get_footer(); ?>