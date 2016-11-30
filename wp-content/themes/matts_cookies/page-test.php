<?php
/**
 * Template Name: Test Page
 */
get_header(); ?>

<!-- site__content -->
<div class="site__content">

    <?php
    $posts = get_posts( array(
            'post_type'  => 'store',
            'posts_per_page' => -1,
        )
    );

    var_dump($posts);
    ?>

</div>
<!-- /site__content -->

<?php get_footer(); ?>
