<?php
//required actions
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wlwmanifest_link');
// close required actions

/* Remove default wrappers */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'signuppageheaders');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);

// Отключаем события REST API
remove_action('init', 'rest_api_init');
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
remove_action('parse_request', 'rest_api_loaded');

// Отключаем Embeds связанные с REST API
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);

remove_action('wp_head', 'wp_oembed_add_discovery_links');
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
//remove_action('wp_head', 'wp_oembed_add_host_js');
add_filter('the_content', 'do_shortcode');
add_filter('wpcf7_form_elements', 'do_shortcode');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

add_action('wp_enqueue_scripts', 'add_js');

/* styles and scripts*/
function add_js()
{

    wp_deregister_script('jquery');

    wp_register_script('jquery',get_template_directory_uri().'/dist/js/vendors/jquery-2.2.1.min.js');
    wp_enqueue_script('jquery');

    
    if(is_page_template(array('page-home.php')) || is_archive('archive-product.php')){
        wp_enqueue_style('scrollbar_css', get_template_directory_uri().'/dist/css/perfect-scrollbar.css');
    }

    if(is_singular('product')){
        wp_enqueue_style('slick', get_template_directory_uri().'/dist/css/slick.css');
        wp_enqueue_style('product', get_template_directory_uri().'/dist/css/product.css');
    }

    if(is_page()){
        wp_enqueue_style('slick', get_template_directory_uri().'/dist/css/content-page.css');
    }

    if (is_page_template('page-home.php')){

        wp_enqueue_style('slick', get_template_directory_uri().'/dist/css/slick.css');
        wp_enqueue_style('index', get_template_directory_uri().'/dist/css/index.css');

    }

    if (is_page_template('page-home.php') || is_archive('archive-product.php')){

        wp_enqueue_style('shop', get_template_directory_uri().'/dist/css/index.css');

    }

    if(is_404()){
        wp_enqueue_style('non_exist', get_template_directory_uri().'/dist/css/not-found-page.css');

        wp_register_script('non_exist_js',get_template_directory_uri().'/dist/js/not-found.min.js');
        wp_enqueue_script('non_exist_js');
        
    }

    if(is_page()){
        wp_register_script('content_js',get_template_directory_uri().'/dist/js/content.min.js');
        wp_enqueue_script('content_js');
    }

    if (is_page_template('page-shop.php')){

        wp_enqueue_style('shop', get_template_directory_uri().'/dist/css/shop-page.css');

    }

    if (is_page_template('page-contact.php')){

        wp_enqueue_style('contact', get_template_directory_uri().'/dist/css/contact-us-page.css');

    }

    if (is_page_template(array('page-home.php'))|| is_archive('archive-product.php')){

        wp_register_script('scroll',get_template_directory_uri().'/dist/js/vendors/perfect-scrollbar.jquery.min.js');
        wp_enqueue_script('scroll');

    }

    
    if(is_singular('product')){
        wp_register_script('slick_js',get_template_directory_uri().'/dist/js/vendors/slick.min.js');
        wp_enqueue_script('slick_js');

        wp_register_script('single_product_js',get_template_directory_uri().'/dist/js/single-product.min.js');
        wp_enqueue_script('single_product_js');
    }
    
    if (is_page_template('page-home.php') || is_archive('archive-product.php')){

        wp_register_script('slick_js',get_template_directory_uri().'/dist/js/vendors/slick.min.js');
        wp_enqueue_script('slick_js');

        wp_register_script('index_js',get_template_directory_uri().'/dist/js/index.min.js');
        wp_enqueue_script('index_js');

    }

    if (is_page_template('page-shop.php')){

        wp_register_script('shop_js',get_template_directory_uri().'/dist/js/shop.min.js');
        wp_enqueue_script('shop_js');
    }

    if (is_page_template('page-contact.php')){

        wp_register_script('map_js','https://maps.googleapis.com/maps/api/js?key=AIzaSyAfHUKutvIv-r49HNCxnEzKJlZgfXzPqd4');
        wp_enqueue_script('map_js');

        wp_register_script('contact_js',get_template_directory_uri().'/dist/js/contact-us.min.js');
        wp_enqueue_script('contact_js');
    }

   




}
wp_enqueue_style('style', get_template_directory_uri().'/style.css');



if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );
register_nav_menus( array(
    'menu' => 'menu',
    'footer_menu' => 'footer_menu'
) );



function single_add_product(){
    global $woocommerce;
    $json_data='';

    $product_id  = intval( $_GET['id'] );
    $quantity  = intval($_GET['countProduct']);
    $found = false;

    //check if product already in cart
    if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
            $_product = $values['data'];

            if ( $_product->id == $product_id ){
                $old_quantity = $values['quantity'];
                WC()->cart->set_quantity($cart_item_key, ($old_quantity+$quantity));

                $found = true;
            }

        }
        if(!$found)
        {
            // if product not found, add it
            WC()->cart->add_to_cart( $product_id, $quantity );
        }

    } else {
        // if no products in cart, add it
        WC()->cart->add_to_cart( $product_id, $quantity );
    }


    $cart = WC()->cart;

    $count_products = $cart->get_cart_contents_count();
    
    ($count_products==1)? $item = 'item' : $item = 'items';

    $json_data = '{
        "cartCountProducts": "'.$count_products.' '.$item.'"
    }';

    echo $json_data;
    exit;
}


add_action('wp_ajax_single_add_product','single_add_product');

add_action('wp_ajax_nopriv_single_add_product', 'single_add_product');


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


function site_map_code(){

    $tmp  =  $post;
    $products = get_posts( array(
        'post_type'=>'product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ) );

    $pages = get_posts( array(
        'post_type'=>'page',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ) );

    $sitemap = '';
    $sitemap.='<h2>Pages</h2>';

    $sitemap.='<ul>';
    foreach ($pages as $post){
        $sitemap.='<li><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    }
    $sitemap.='</ul>';


    $sitemap.='<h2>Products</h2>';
    $sitemap.='<ul>';
    foreach ($products as $post){
        $sitemap.='<li><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    }
    $sitemap.='</ul>';


    $post = $tmp;
    return $sitemap;
}
add_shortcode( 'site_map_code', 'site_map_code' );

?>