<?php
/**
 * Easy Digital Downloads Compatibility File
 *
 * @link https://easydigitaldownloads.com/
 *
 * @package dtc
 */

/**
 * EDD setup.
 *
 * @return void
 */
function dtc_edd_setup() {
	// Remove default EDD styles so we can style it ourselves.
	remove_action( 'wp_enqueue_scripts', 'edd_register_styles' );
}
add_action( 'after_setup_theme', 'dtc_edd_setup' );

/**
 * EDD scripts and styles.
 *
 * @return void
 */
function dtc_edd_scripts() {
	// You can enqueue a specific stylesheet for EDD here if you want.
	// wp_enqueue_style( 'dtc-edd-style', get_template_directory_uri() . '/edd-style.css', array(), _S_VERSION );
}
add_action( 'wp_enqueue_scripts', 'dtc_edd_scripts' );
