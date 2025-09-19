<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dtc
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dtc' ); ?></a>

	<header id="masthead" class="site-header bg-light shadow-sm">
		<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg">
			<div class="container">
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title navbar-brand mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title navbar-brand mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
					}
					?>
				</div><!-- .site-branding -->
				
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu-wrap" aria-controls="primary-menu-wrap" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'dtc' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="primary-menu-wrap">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
							'container'       => false,
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 2,
							'walker'          => new WP_Bootstrap_Navwalker(),
						)
					);
					?>
					<div class="header-actions d-flex align-items-center">
						<?php get_search_form(); ?>
						<?php if ( class_exists( 'Easy_Digital_Downloads' ) ) : ?>
							<div class="header-cart ms-3">
								<a class="cart-contents" href="<?php echo esc_url( edd_get_checkout_uri() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dtc' ); ?>">
									<span class="cart-icon">🛒</span>
									<span class="edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- .container -->
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
