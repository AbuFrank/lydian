<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lydian_Center
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text|Lato" rel="stylesheet">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lydian-center' ); ?></a>

	<header id="masthead" class="site-header fixed-top no-scroll">
		<!-- Fancy header bars -->
		<div id="header-graphic" class="d-none d-lg-inline-flex">
			<div class="cb-bar-1"></div>
			<div class="cb-bar-2"></div>
			<div class="cb-bar cb-bar-3"></div>
			<div class="cb-bar-4"></div>
			<div class="cb-bar-5"></div>
		</div>
		<div class="container">
			<nav id="site-navigation" class="navbar navbar-expand-lg navbar-light px-0" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="site-branding navbar-brand mr-auto">
				<?php
				the_custom_logo();
					?>
					<h1 class="site-title"><a class="d-flex align-items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php 
					$siteName = get_bloginfo('name');
					echo split_string_span($siteName); ?></a></h1>
					<?php
				$lydian_center_description = get_bloginfo( 'description', 'display' );
				if ( $lydian_center_description || is_customize_preview() ) :
					?>
					<p class="site-description d-flex align-items-center"><?php echo split_string_span($lydian_center_description); /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
				</div><!-- .site-branding -->
				<button class="navbar-toggler order-3" type="button" data-toggle="collapse" data-target="#cb-collapsing-nav" aria-controls="cb-collapsing-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<!-- shows up to medium screens -->
				<span id="contact-phone-mobile" class="d-none d-md-inline d-lg-none order-2">
					<i class="fa fa-phone fa-2x"></i>
					<p><a href="tel:617-876-6777" style="color: #613b15;">617-876-6777</a></p>
				</span>
				<!-- shows in large screens and above -->
				<p id="contact-phone" class="d-none d-lg-inline">617-876-6777</p>
				<p id="contact-addy" class="d-none d-sm-inline">777 Concord Ave, Cambridge, MA 02138</p>
				<?php
				wp_nav_menu( array(
					'theme_location'    => 'menu-1',
					'depth'             => 2,
					'container'         => 'div',
					'container_class'   => 'collapse navbar-collapse justify-content-center order-3	',
					'container_id'      => 'cb-collapsing-nav',
					'menu_id'           => 'primary-menu',
					'menu_class'        => 'nav navbar-nav',
					'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
					'walker'            => new WP_Bootstrap_Navwalker()
				) );
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
