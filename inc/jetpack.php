<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Dream Big and Make Things Theme 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function dbamt_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'dbamt_jetpack_setup' );
