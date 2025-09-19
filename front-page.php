<?php
/**
 * The template for displaying the homepage.
 *
 * @package dtc
 */

get_header();
?>

	<main id="primary" class="site-main homepage-content">

		<?php // Section 1: Hero Banner ?>
		<section class="homepage-hero">
			<div class="container">
				<h1 class="hero-title">Marketplace Produk Digital Anda</h1>
				<p class="hero-subtitle">Temukan ribuan aset digital berkualitas tinggi dari para kreator terbaik.</p>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'download' ) ); ?>" class="hero-button">Jelajahi Produk</a>
			</div>
		</section>

		<?php // Section 2: Latest Products ?>
		<div class="container">
			<section class="homepage-products">
				<h2 class="section-title">Produk Terbaru</h2>

				<?php
				$latest_products_args = array(
					'post_type'      => 'download', // We want to query EDD products
					'posts_per_page' => 8,          // How many products to show
				);
				$latest_products_query = new WP_Query( $latest_products_args );
				?>

				<?php if ( $latest_products_query->have_posts() ) : ?>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
						<?php
						while ( $latest_products_query->have_posts() ) :
							$latest_products_query->the_post();
							echo '<div class="col">';
								// We can reuse the product card template from our archive page
								get_template_part( 'template-parts/content', 'download-archive' );
							echo '</div>';
						endwhile;
						?>
					</div><!-- .product-grid -->
					<?php wp_reset_postdata(); // Important: reset the main query ?>
				<?php else : ?>
					<p>Belum ada produk untuk ditampilkan.</p>
				<?php endif; ?>
			</section>
		</div>

	</main><!-- #main -->

<?php
get_footer();
