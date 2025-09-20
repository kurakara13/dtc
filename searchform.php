<?php
/**
 * The template for displaying search forms in dtc
 *
 * @package dtc
 */
?>

<form role="search" method="get" class="search-form-expanded" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="form-control" type="search" placeholder="<?php echo esc_attr_x( 'Ketik dan tekan Enter untuk mencari produk...', 'placeholder', 'dtc' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autofocus />
	<input type="hidden" name="post_type" value="download" />
</form>
