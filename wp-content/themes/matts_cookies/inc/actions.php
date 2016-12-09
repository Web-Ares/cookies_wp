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

    
    if(is_page_template(array('page-home.php','page-checkout.php')) || is_archive('archive-product.php')){
        wp_enqueue_style('scrollbar_css', get_template_directory_uri().'/dist/css/perfect-scrollbar.css');
    }

    if(is_singular('product')){
        wp_enqueue_style('slick_css', get_template_directory_uri().'/dist/css/slick.css');
        wp_enqueue_style('product', get_template_directory_uri().'/dist/css/product.css');
    }

    if(is_page_template('default') || is_singular('post')){
        wp_enqueue_style('slick', get_template_directory_uri().'/dist/css/content-page.css');
    }

    if(is_page_template('page-cart.php')){
        wp_enqueue_style('slick', get_template_directory_uri().'/dist/css/swiper.min.css');
        wp_enqueue_style('cart_css', get_template_directory_uri().'/dist/css/cart-page.css');

        wp_register_script('cart_js',get_template_directory_uri().'/dist/js/cart.min.js');
        wp_enqueue_script('cart_js');

        wp_register_script('swiper_js',get_template_directory_uri().'/dist/js/vendors/swiper.jquery.min.js');
        wp_enqueue_script('swiper_js');
    }

    if (is_page_template('page-home.php')){

        wp_enqueue_style('store-finder', get_template_directory_uri().'/dist/css/store-finder.min.css');
        wp_enqueue_style('slick_css', get_template_directory_uri().'/dist/css/slick.css');
        wp_enqueue_style('index', get_template_directory_uri().'/dist/css/index.css');
        
    }

    if (is_archive('archive-product.php')){

        wp_enqueue_style('slick', get_template_directory_uri().'/dist/css/slick.css');
        wp_enqueue_style('shop', get_template_directory_uri().'/dist/css/shop-page.css');

    }

    if(is_404()){
        wp_enqueue_style('non_exist', get_template_directory_uri().'/dist/css/not-found-page.css');

        wp_register_script('non_exist_js',get_template_directory_uri().'/dist/js/not-found.min.js');
        wp_enqueue_script('non_exist_js');
        
    }

    if(is_page_template('default') || is_singular('post')){
        wp_register_script('content_js',get_template_directory_uri().'/dist/js/content.min.js');
        wp_enqueue_script('content_js');
    }

    if (is_page_template('page-shop.php')){

        wp_enqueue_style('shop', get_template_directory_uri().'/dist/css/shop-page.css');

    }

    if (is_page_template('page-contact.php')){

        wp_enqueue_style('contact', get_template_directory_uri().'/dist/css/contact-us-page.css');

    }

    if (is_page_template(array('page-home.php','page-checkout.php'))|| is_archive('archive-product.php')){

        wp_register_script('scroll',get_template_directory_uri().'/dist/js/vendors/perfect-scrollbar.jquery.min.js');
        wp_enqueue_script('scroll');

    }

    
    if(is_singular('product')){
        wp_register_script('slick_js',get_template_directory_uri().'/dist/js/vendors/slick.min.js');
        wp_enqueue_script('slick_js');

        wp_register_script('single_product_js',get_template_directory_uri().'/dist/js/single-product.min.js');
        wp_enqueue_script('single_product_js');
    }
    
    if (is_page_template('page-home.php')){

        wp_register_script('slick_js',get_template_directory_uri().'/dist/js/vendors/slick.min.js');
        wp_enqueue_script('slick_js');

        wp_register_script('index_js',get_template_directory_uri().'/dist/js/index.min.js');
        wp_enqueue_script('index_js');

    }
    if(is_archive('archive-product.php')){

        wp_register_script('slick_js',get_template_directory_uri().'/dist/js/vendors/slick.min.js');
        wp_enqueue_script('slick_js');

        wp_register_script('shop_js',get_template_directory_uri().'/dist/js/shop.min.js');
        wp_enqueue_script('shop_js');

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
    
    if(is_order_received_page()){
        wp_enqueue_style('confirmation', get_template_directory_uri().'/dist/css/confirmation-page.css');

        wp_register_script('confirmation_js',get_template_directory_uri().'/dist/js/confirmation.min.js');
        wp_enqueue_script('confirmation_js');

    }
    elseif(is_page_template('page-checkout.php')){
        wp_enqueue_style('checkout', get_template_directory_uri().'/dist/css/checkout-page.css');


        wp_register_script('checkout_js',get_template_directory_uri().'/dist/js/checkout.min.js');
        wp_enqueue_script('checkout_js');
    }

}
$var = time();
wp_enqueue_style('style', get_template_directory_uri().'/style.css',false, filemtime(get_template_directory_uri().'/style.css'));

if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );
register_nav_menus( array(
    'menu' => 'menu',
    'footer_menu' => 'footer_menu'
) );

function single_add_product(){

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
    global $post;
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

function cart_quantity_changes(){

    $new_quantity = $_GET['countProduct'];
    $idProduct = $_GET['id'];
    $keyProduct  = $_GET['key'];
    $_product = wc_get_product( $idProduct );;

    WC()->cart->set_quantity($keyProduct, $new_quantity);

    $subtotal_product =  WC()->cart->get_product_subtotal( $_product , $new_quantity );
    $subtotal_product = str_replace('"', '\"', $subtotal_product);

    $cartTotal  = WC()->cart->get_cart_total();
    $cartTotal = str_replace('"', '\"', $cartTotal);

    $discount = WC()->cart->get_total_discount();
    $discount = str_replace('"', '\"', $discount);

    $json_data = '{
        "total": "'.$subtotal_product.'",
        "subtotal":"'.$cartTotal.'",
        "discount": '.$discount.'"
    }';

    $json_data = '{
        "total": "'.$subtotal_product.'",
        "subtotal":"'.$cartTotal.'",
         "discount":"'.$discount.'"
    }';


    echo $json_data;
    exit;
}

add_action('wp_ajax_cart_quantity_changes','cart_quantity_changes');

add_action('wp_ajax_nopriv_cart_quantity_changes', 'cart_quantity_changes');

function remove_cart_item(){

    $keyProduct = $_GET['id'];
    
    WC()->cart->remove_cart_item($keyProduct);
    $cartTotal  = WC()->cart->get_cart_total();
    $cartTotal = str_replace('"', '\"', $cartTotal);
    $item = '';
    if ( WC()->cart->get_cart_contents_count() == 0 ) {
        $cart_items = 0;
    } else {
        $cart_items = WC()->cart->get_cart_contents_count();
        if($cart_items==1){
            $item = ' item';
        } else {
            $item = ' items';
        }
    }

    
    $discount = WC()->cart->get_total_discount();
    $discount = str_replace('"', '\"', $discount);


    $json_data = '{
        "cartCountProducts": "'.$cart_items.$item.'",
        "subtotal":"'.$cartTotal.'",
        "discount": "'.$discount.'"
    }';

    echo $json_data;
    exit;

}

add_action('wp_ajax_remove_cart_item','remove_cart_item');

add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item');

function apply_coupon_to_order(){

    $coupon_name = $_GET['inputVal'];
    $discount = '';
    $status = 0;
    if(count(WC()->cart->applied_coupons)==0){

        if( WC()->cart->add_discount($coupon_name)){
            $discount = WC()->cart->get_total_discount();
            $discount = str_replace('"', '\"', $discount);
            $status = 1;
          
        }

    } else {
        $status = 0;
    }


    $newSubTotal = WC()->cart->get_cart_total();
    $newSubTotal = str_replace('"', '\"', $newSubTotal);



    $json_data = '{
        "discount": "'.$discount.'",
        "subtotal": "'.$newSubTotal.'",
        "status": "'.$status.'"
    }';

    echo $json_data;
    exit;

}

add_action('wp_ajax_apply_coupon_to_order','apply_coupon_to_order');

add_action('wp_ajax_nopriv_apply_coupon_to_order', 'apply_coupon_to_order');

function remove_coupon_to_order(){

    $coupon_name = $_GET['inputVal'];
    $cart = '';
    WC()->cart->remove_coupon($coupon_name);

    if(WC()->cart->remove_coupon($coupon_name)){
        $cart = WC()->cart->get_cart_subtotal();
    }


    
    $newSubTotal = str_replace('"', '\"', $cart);

    $json_data = '{
        "subtotal": "'.$newSubTotal.'"
    }';



    echo $json_data;
    exit;
}

add_action('wp_ajax_remove_coupon_to_order','remove_coupon_to_order');

add_action('wp_ajax_nopriv_remove_coupon_to_order', 'remove_coupon_to_order');

add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );

function form_submit_button( $button, $form ) {

    if($form['id'] == 1){
        return '<button class="btn btn_9 gform_button button" id="gform_submit_button_1" type="submit"><span>SIGN UP</span></button>';
    }

}


function custom_update_form(){


    $json_data = '{
        "subtotal": "12"
    }';
    echo $json_data;
    exit;
}

add_action('wp_ajax_custom_update_form','custom_update_form');

add_action('wp_ajax_nopriv_custom_update_form', 'custom_update_form');

?>