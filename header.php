<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _tk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

<nav class="site-navigation">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div class="site-navigation-inner col-sm-12 col-md-10">
				<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<?php 
					  // Fix menu overlap bug..
					  if ( is_admin_bar_showing() ) echo '<div class="hack"></div>'; 
					?>
					<div class="navbar-header">
						<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only"><?php _e('Toggle navigation','_tk') ?> </span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<!-- Your site title as branding in the menu 
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>-->
					</div>
					<!-- The WordPress Menu goes here and prents the main menu to logged in users while presenting a menu (which must be) titled guest-menu to nonlogged in users -->
						<div class="balance">
						<?php 
						if ( is_user_logged_in() )
						{
						wp_nav_menu(
							array(
								'theme_location' 	=> 'primary',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse',
								'menu_class' 		=> 'nav navbar-nav',
								'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
								'menu_id'			=> 'main-menu',
								'walker' 			=> new wp_bootstrap_navwalker()
							)
						); }

						else {wp_nav_menu(
							array(
								'theme_location' 	=> 'primary',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse',
								'menu_class' 		=> 'nav navbar-nav',
								'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
								'menu'			=> 'guest-menu',
								'walker' 			=> new wp_bootstrap_navwalker()
							)
						); }
						 ?>
					</div>
				</div><!-- .navbar -->
			</div>
		</div>
	</div><!-- .container -->
</nav><!-- .site-navigation -->

<div class="main-content">

	<!-- .container -->
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div id="content" class="main-content-inner col-sm-12 col-md-10">
				<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
					</a>
				<?php } // end if ( ! empty( $header_image ) ) ?>


				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img class="rva" src="<?php bloginfo('template_directory'); ?>/imgs/RVArts_Logo75.jpg">
			</a>

			</div>
		</div>
		</div>
		<div class="row">

