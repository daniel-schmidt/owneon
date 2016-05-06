<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package owneon
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="background">
</div><!--#background -->

<div id="page" class="site">
	<?php do_action( 'before' ); ?>

        <div id="headline" class="headline">
            <a href="<?php echo home_url();?>">
                <img src="<?php echo esc_url( get_template_directory_uri () . '/img/banner_head.png' )?>" alt="neonlicht fotografie Logo klein"/>
            </a>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'owneon' ); ?></button>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
            
            <?php if( is_single() && has_post_thumbnail() ) : 
                $url = wp_get_attachment_url( get_post_thumbnail_id() );
//                 $url = get_attachment_link( get_post_thumbnail_id() );
            ?>
            
                <a href="<?php echo $url ?>" class="headline-item headline-right">
                    <div class="show-img-button">
                        <div>
                            Hintergrund angucken
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        </div> <!--headline-->
	
	<div id="content" class="site-content">

