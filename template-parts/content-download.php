<?php
/**
 * Template part for displaying single downloads.
 *
 * @package dtc
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-page' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title product-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="product-content-wrapper">
		<div class="product-gallery">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}
			?>
		</div>

		<div class="product-details">
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<div class="product-meta">
				<?php if ( function_exists( 'edd_price' ) ) : ?>
					<div class="product-price">
						<?php
						if ( edd_has_variable_prices( get_the_ID() ) ) {
							// if the download has variable prices, show the first one as a starting point
							echo 'Starting at: ';
							edd_price( get_the_ID() );
						} else {
							// if the download has a single price, show it
							edd_price( get_the_ID() );
						}
						?>
					</div><!-- .product-price -->
				<?php endif; ?>

				<?php if ( function_exists( 'edd_get_purchase_link' ) ) : ?>
					<div class="product-purchase-button">
						<?php echo edd_get_purchase_link( get_the_ID() ); ?>
					</div>
				<?php endif; ?>
			</div><!-- .product-meta -->
		</div><!-- .product-details -->
	</div><!-- .product-content-wrapper -->

	<footer class="entry-footer">
		<?php
			// You can display categories, tags, or other meta here.
			// Example: echo get_the_term_list( get_the_ID(), 'download_category', '<span class="product-categories">Categories: ', ', ', '</span>' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
