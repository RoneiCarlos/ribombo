<?php
/**
 * @package Ribombo
 * @since Ribombo 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset') ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>

    <body>
        <!-- header -->
        <div class="row" style="max-width: 100%;">
            <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

                if (has_custom_logo()){
                    echo '<img src="'. esc_url($logo[0]). '"class="img-fluid" style="width:100%; margin-left: 15px;">';
                } else {
                    echo '<h1>'. bloginfo('name'). '</h1>';
                    echo '<p>'. bloginfo('description'). '</p>';
                }
            ?>
        </div>
        <!-- menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="<?php echo get_template_directory_uri().'../../../../' ?>">
                    <img class="rounded" src="<?php echo get_template_directory_uri() ?>/img/logo.png" width="30" height="30" alt=""><?php echo ' ';bloginfo('name'); ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                wp_nav_menu( array(
                    'theme_location'    => 'principal',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'bs-example-navbar-collapse-1',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
                <div class="col-lg-4 col-xl-3 collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php dynamic_sidebar('Busca'); ?>
                </div>
            </div>
        </nav>