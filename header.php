<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/images/favicon.ico">

    <title>
      <?php wp_title( '|', true, 'right' ); ?>
      <?php bloginfo( 'name' ); ?>
    </title>

    <?php wp_head(); ?>
    <?php echo get_option('shortname_googleanalytics_code'); ?>
  </head>

  <body <?php body_class(); ?>>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?php if ( get_theme_mod( 'themeslug_logo' ) ) : ?>
            <div class='site-logo'>
                <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
            </div>
            <?php else : ?>
                
                <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                    <?php bloginfo('name'); ?>
                </a>

            <?php endif; ?>
            
            <div class="mobile-buttons">
                <a href="tel:<?php echo get_option('shortname_phone_url'); ?>"><i class="fa fa-phone"></i></a>
                <a href="mailto:<?php echo get_option('shortname_mailto_url'); ?>"><i class="fa fa-envelope"></i></a>
                <a href="<?php echo get_option('shortname_googlemaps_url'); ?>"><i class="fa fa-map-marker"></i></a>
            </div>
            
        </div>

        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>