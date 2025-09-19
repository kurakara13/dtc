<?php
/**
 * The template for displaying search forms in dtc
 *
 * @package dtc
 */
?>

<form role="search" method="get" class="d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="form-control me-2" type="search" placeholder="<?php echo esc_attr_x( 'Search products&hellip;', 'placeholder', 'dtc' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<input type="hidden" name="post_type" value="download" />
	<button class="btn btn-outline-success" type="submit"><?php echo esc_html_x( 'Search', 'submit button', 'dtc' ); ?></button>
</form>
