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

	<header id="masthead" class="site-header fixed-top">
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
						array( // @codingStandardsIgnoreLine
							'theme_location'  => 'menu-1',
							'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
							'container'       => false,
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 2,
							'walker'          => new WP_Bootstrap_Navwalker(),
						)
					);
					?>
					<div class="header-actions d-flex align-items-center ms-lg-4">
						<div class="header-search">
							<button class="search-toggle btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#search-collapse" aria-expanded="false" aria-controls="search-collapse">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
							</button>
						</div>
						<?php if ( class_exists( 'Easy_Digital_Downloads' ) ) : ?>
							<div class="header-cart ms-3">
								<a class="cart-contents" href="<?php echo esc_url( edd_get_checkout_uri() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dtc' ); ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/></svg>
									<span class="edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- .container -->
		</nav><!-- #site-navigation -->
		<div class="container">
			<div class="collapse" id="search-collapse">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div class="site-header-placeholder"></div>
