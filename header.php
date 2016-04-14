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

<?php if( is_singular('post') && has_post_thumbnail( get_the_ID() ) ) : ?>
  <div class="show-img-button foreground">
    <div class="foreground">
      Hintergrund angucken
    </div>
  </div>
<?php endif; ?>

<?php if( is_single() ) : ?>
  <nav id="headline">
    <a class="header-branding headline-item" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    </a>
    <?php the_post_navigation(); ?>
    <div class="headline-item headline-right">
    <?php if( has_post_thumbnail( get_the_ID() ) ) : ?>
      <div class="show-img-button">
	<div>
	  Hintergrund angucken
	</div>
      </div>
    <?php endif; ?>
    </div>
  </nav>
<?php endif; ?>


<div id="page" class="site">
	<?php do_action( 'before' ); ?>
	<?php if( is_single() ) : ?>
	<header id="masthead" class="site-header foreground" role="banner">
	  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<div class="site-branding">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	  </a>
	</header><!-- #masthead -->
	<div id="content" class="site-content">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'owneon' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
        <?php endif; ?>
