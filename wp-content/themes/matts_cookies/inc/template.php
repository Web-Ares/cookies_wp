<?php
/**
 * @return string
 */
function document_title()
{
    global $s;

    if (function_exists('seo_title_tag')) {
        seo_title_tag();

        return null;
    } else if (class_exists('All_in_One_SEO_Pack') || class_exists('Platinum_SEO_Pack') || class_exists('WPSEO_Frontend')) {
        if (is_front_page() || is_home()) {
            $output = get_bloginfo('name') . ' &#8212; ' . get_bloginfo('description');
        } else {
            $output = wp_title('', false);
        }
    } else {
        if (is_attachment()) {
            $output = get_bloginfo('name') . ' &#8212; ' . single_post_title('', false);
        } else if (is_single()) {
            $output = single_post_title('', false);
        } else if (is_home()) {
            $output = get_bloginfo('name') . ' &#8212; ' . get_bloginfo('description');

        } else if (is_page()) {
            $output = single_post_title('', false);
        } else if (is_search()) {
            $output = get_bloginfo('name') . ' &#8212; ' . sprintf(__('Результаты поиска для: %s'), esc_html($s));
        } else if (is_404()) {
            $output = get_bloginfo('name') . ' &#8212; ' . __('Ничего не найдено.');
        } else {
            $output = get_bloginfo('name') . wp_title('&#8212;', false);
        }
    }

    echo apply_filters('document_title', $output);
}?>