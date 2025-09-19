<?php
/**
 * Template part for displaying a download item in a grid.
 *
 * @package dtc
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-card' ); ?>>
	<div class="product-card__image">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'medium_large' ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/placeholder.png' ); ?>" alt="<?php the_title_attribute(); ?>">
			<?php endif; ?>
		</a>
	</div>

	<header class="product-card__header">
		<?php the_title( '<h3 class="product-card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
	</header>

	<div class="product-card__meta">
		<?php if ( function_exists( 'edd_price' ) ) : ?>
			<div class="product-card__price">
				<?php edd_price( get_the_ID() ); ?>
			</div>
		<?php endif; ?>
		<?php if ( function_exists( 'edd_get_purchase_link' ) ) : ?>
			<div class="product-card__button">
				<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
