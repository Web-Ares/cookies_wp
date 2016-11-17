<!-- site__footer -->
<footer class="site__footer">

    <div class="site__footer-top">



        <?php if(is_front_page()){ ?>

            <!-- site__footer-logo -->
            <div class="site__footer-logo">
                <img src="<?= DIRECT; ?>img/footer-logo.png" width="276" height="206" alt="Matt's Cookies">
            </div>
            <!-- /site__footer-logo -->

       <?php  } else { ?>

            <!-- site__footer-logo -->
            <div class="site__footer-logo">
                <img src="<?= DIRECT; ?>img/footer-logo.png" width="276" height="206" alt="Matt's Cookies">
            </div>
            <!-- /site__footer-logo -->

       <?php  } ?>


        <!-- site__footer-address -->
        <div class="site__footer-address">

            <h2 class="site__footer-address-title"><span><?php the_field('company_name','options') ?></span></h2>
            <span><?php the_field('address_line_1','options') ?></span>
            <span><?php the_field('address_line_2','options') ?></span>
        </div>
        <!-- /site__footer-address -->

    </div>
    <div class="site__footer-bottom">

        <!-- site__footer-layout -->
        <div class="site__footer-layout">

            <!-- site__footer-content -->
            <div class="site__footer-content">
                <div>

                    <h2 class="site__footer-title">OUR PRODUCTS</h2>

                    <!-- site__footer-items -->
                    <div class="site__footer-items">

                        <!-- site__footer-menu -->
                        <ul class="site__footer-menu">
                            <li>
                                <a href="#">chocolate chip</a>
                            </li>
                            <li>
                                <a href="#">peanut butter</a>
                            </li>
                            <li>
                                <a href="#">oatmeal raisin</a>
                            </li>
                            <li>
                                <a href="#">cranberry walnut</a>
                            </li>
                            <li>
                                <a href="#">double chocolate chip</a>
                            </li>
                            <li>
                                <a href="#">peanut butter chocolate chip</a>
                            </li>
                        </ul>
                        <!-- /site__footer-menu -->

                        <!-- site__footer-menu -->
                        <ul class="site__footer-menu">
                            <li>
                                <a href="#">apple fruit fig bar</a>
                            </li>
                            <li>
                                <a href="#">fig bar</a>
                            </li>
                            <li>
                                <a href="#">raspberry fig bar</a>
                            </li>
                            <li>
                                <a href="#"> whole wheat fig bar</a>
                            </li>
                        </ul>
                        <!-- /site__footer-menu -->

                    </div>
                    <!-- /site__footer-items -->

                </div>
                <div>
                    <h2 class="site__footer-title">about</h2>

                    <!-- site__footer-items -->
                    <div class="site__footer-items">

                        <!-- site__footer-menu -->
                        <ul class="site__footer-menu">
                            <li>
                                <a href="#">about matt’s cookies</a>
                            </li>
                            <li>
                                <a href="#">the real stuff</a>
                            </li>
                            <li>
                                <a href="#">store finder</a>
                            </li>
                            <li>
                                <a href="#">privacy terms</a>
                            </li>
                            <li>
                                <a href="#">terms of services</a>
                            </li>
                        </ul>
                        <!-- /site__footer-menu -->

                        <!-- site__footer-menu -->
                        <ul class="site__footer-menu">
                            <li>
                                CALL US:<a href="tel:847.537.3888"> 847.537.3888</a>
                            </li>
                            <li>
                                <a href="#">contact us</a>
                            </li>
                            <li>
                                <a href="#">SITEMAP</a>
                            </li>
                            <li>
                                CONNECT TO us:

                                <!-- social-networks -->
                                <div class="social-networks social-networks_2">
                                    <?php if($lik = get_field('facebook_link','options')): ?>
                                    <a  target="_blank" href="<?= $lik; ?>" class="social-networks__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 96.124 96.123" style="enable-background:new 0 0 96.124 96.123;" xml:space="preserve">
                                    <g>
                                        <path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803   c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654   c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246   c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z" fill="#FFFFFF"/>
                                    </g>
                                </svg>
                                    </a>

                                    <?php endif;
                                    if($lik = get_field('twitter_link','options')):
                                    ?>
                                    
                                    <a target="_blank" href="<?= $lik; ?>" class="social-networks__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 430.117 430.117" style="enable-background:new 0 0 430.117 430.117;" xml:space="preserve">
                                    <g>
                                        <path d="M381.384,198.639c24.157-1.993,40.543-12.975,46.849-27.876   c-8.714,5.353-35.764,11.189-50.703,5.631c-0.732-3.51-1.55-6.844-2.353-9.854c-11.383-41.798-50.357-75.472-91.194-71.404   c3.304-1.334,6.655-2.576,9.996-3.691c4.495-1.61,30.868-5.901,26.715-15.21c-3.5-8.188-35.722,6.188-41.789,8.067   c8.009-3.012,21.254-8.193,22.673-17.396c-12.27,1.683-24.315,7.484-33.622,15.919c3.36-3.617,5.909-8.025,6.45-12.769   C241.68,90.963,222.563,133.113,207.092,174c-12.148-11.773-22.915-21.044-32.574-26.192   c-27.097-14.531-59.496-29.692-110.355-48.572c-1.561,16.827,8.322,39.201,36.8,54.08c-6.17-0.826-17.453,1.017-26.477,3.178   c3.675,19.277,15.677,35.159,48.169,42.839c-14.849,0.98-22.523,4.359-29.478,11.642c6.763,13.407,23.266,29.186,52.953,25.947   c-33.006,14.226-13.458,40.571,13.399,36.642C113.713,320.887,41.479,317.409,0,277.828   c108.299,147.572,343.716,87.274,378.799-54.866c26.285,0.224,41.737-9.105,51.318-19.39   C414.973,206.142,393.023,203.486,381.384,198.639z" fill="#FFFFFF"/>
                                    </g>
                                </svg>
                                    </a>

                                    <?php endif;
                                    if($lik = get_field('instagram_link','options')):
                                    ?>
                                    
                                    <a target="_blank" href="<?= $lik; ?>" class="social-networks__item social-networks__item_instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 169.063 169.063" style="enable-background:new 0 0 169.063 169.063;" xml:space="preserve">
                                                    <g>
                                                        <path d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752   c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407   c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752   c17.455,0,31.656,14.201,31.656,31.655V122.407z" fill="#FFFFFF"/>
                                                        <path d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561   C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561   c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z" fill="#FFFFFF"/>
                                                        <path d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78   c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78   C135.661,29.421,132.821,28.251,129.921,28.251z" fill="#FFFFFF"/>
                                                    </g>
                                                </svg>
                                    </a>

                                    <?php endif;
                                    if($lik = get_field('mail','options')):
                                    ?>
                                    
                                    <a href="mailto:<?= $lik; ?>" class="social-networks__item social-networks__item_instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 235.065 235.065" style="enable-background:new 0 0 235.065 235.065;" xml:space="preserve" width="512px" height="512px">
                                                    <g>
                                                        <g>
                                                            <path d="M156.019,58.832h18.025l-12.358,69.772c-1.376,8.066-1.42,13.908-0.131,17.514    c1.289,3.595,4.166,5.401,8.626,5.401s8.838-1.028,13.13-3.089c4.291-2.061,8.148-5.232,11.585-9.524s6.222-9.692,8.371-16.214    c2.143-6.521,3.22-14.245,3.22-23.176c0-12.874-2.154-23.861-6.44-32.955c-4.291-9.094-10.171-16.611-17.633-22.529    c-7.468-5.929-16.268-10.258-26.396-13.005s-21.022-4.128-32.7-4.128c-13.386,0-25.83,2.404-37.328,7.212    c-11.498,4.814-21.495,11.422-29.996,19.825c-8.496,8.414-15.148,18.411-19.95,30.002c-4.808,11.58-7.207,24.149-7.207,37.714    c0,13.391,2.012,25.4,6.043,36.045c4.036,10.65,9.915,19.695,17.639,27.168c7.723,7.462,17.291,13.212,28.702,17.242    c11.411,4.03,24.503,6.048,39.27,6.048c4.971,0,10.633-0.598,16.986-1.795c6.353-1.207,12.102-3.008,17.253-5.412l7.979,24.721    c-7.038,3.432-14.201,5.831-21.495,7.201c-7.299,1.376-15.665,2.067-25.101,2.067c-16.649,0-32.058-2.41-46.216-7.207    c-14.163-4.814-26.428-11.933-36.812-21.37c-10.389-9.442-18.498-21.158-24.34-35.147C2.915,157.23,0,141.049,0,122.686    c0-18.71,3.345-35.62,10.046-50.725c6.69-15.093,15.703-27.973,27.032-38.623c11.33-10.639,24.459-18.83,39.39-24.59    c14.93-5.744,30.72-8.621,47.369-8.621c15.79,0,30.47,2.279,44.029,6.821c13.554,4.553,25.313,11.068,35.267,19.57    c9.954,8.496,17.769,18.884,23.437,31.16c5.662,12.265,8.496,26.216,8.496,41.832c0,10.987-1.925,21.278-5.793,30.899    c-3.862,9.616-9.181,17.938-15.958,24.976c-6.788,7.033-14.68,12.608-23.687,16.731c-9.007,4.117-18.667,6.179-28.963,6.179    c-4.297,0-8.278-0.468-11.977-1.414c-3.688-0.946-6.777-2.535-9.263-4.765c-2.491-2.235-4.335-5.151-5.537-8.757    c-1.202-3.601-1.55-8.061-1.028-13.386h-1.028c-2.578,3.606-5.363,7.125-8.365,10.552c-3.008,3.438-6.309,6.483-9.915,9.143    c-3.601,2.665-7.555,4.765-11.841,6.309c-4.297,1.539-9.013,2.317-14.163,2.317c-4.117,0-8.066-0.903-11.841-2.698    c-3.78-1.806-7.044-4.34-9.785-7.598c-2.752-3.258-4.939-7.207-6.565-11.846c-1.637-4.634-2.448-9.785-2.448-15.447    c0-10.639,1.713-20.984,5.145-31.024c3.432-10.046,8.115-18.923,14.033-26.646s12.787-13.94,20.598-18.667    c7.811-4.716,16.094-7.076,24.84-7.076c6.005,0,11.074,0.897,15.191,2.698c4.123,1.806,7.892,4.166,11.33,7.087L156.019,58.832z     M139.795,89.992c-2.23-1.893-4.547-3.35-6.946-4.378c-2.404-1.033-5.406-1.545-9.013-1.545c-5.145,0-9.91,1.458-14.283,4.378    c-4.378,2.915-8.159,6.685-11.33,11.324c-3.182,4.634-5.624,9.834-7.343,15.572c-1.713,5.76-2.578,11.379-2.578,16.867    c0,5.667,1.159,10.307,3.481,13.913c2.317,3.595,6.304,5.401,11.966,5.401c2.404,0,4.982-0.729,7.723-2.181    c2.752-1.463,5.406-3.394,7.99-5.798c2.573-2.399,5.058-5.151,7.462-8.235c2.404-3.095,4.547-6.353,6.44-9.785L139.795,89.992z" fill="#FFFFFF"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                    </a>
                                    <?php endif; ?>
                                    
                                </div>
                                <!-- /social-networks -->

                            </li>
                        </ul>
                        <!-- /site__footer-menu -->

                    </div>
                    <!-- /site__footer-items -->

                </div>
            </div>
            <!-- /site__footer-content -->

        </div>
        <!-- /site__footer-layout -->

    </div>

</footer>
<!-- /site__footer -->

</div>
<!-- /site -->
<?php wp_footer(); ?>
<!-- popup -->
<div class="popup">

    <!-- popup__wrap -->
    <div class="popup__wrap">

        <!-- popup__content -->
        <div class="popup__content popup__cookies-info">

            <!-- popup__close -->
            <div class="popup__close">

            </div>
            <!-- /popup__close -->

            <!-- cookies-info -->
            <div class="cookies-info">

                <h2 class="site__main-title">CHOCOLATE</h2>

                <!-- cookies-info__description -->
                <div class="cookies-info__description">

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo

                </div>
                <!-- /cookies-info__description -->

            </div>
            <!-- /cookies-info -->

        </div>
        <!-- /popup__content -->

    </div>
    <!-- /popup__wrap -->

</div>
<!-- /popup -->

</body>
</html>