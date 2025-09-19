<?php
/**
 * The template for displaying archive pages for 'download' post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dtc
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					// EDD uses post_type_archive_title() instead of the_archive_title()
					post_type_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					echo '<div class="col">';
						get_template_part( 'template-parts/content', 'download-archive' );
					echo '</div>';
				endwhile;
				?>
			</div><!-- .product-grid -->

			<?php the_posts_navigation(); ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
