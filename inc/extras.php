<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package owneon
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function owneon_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'owneon_body_classes' );

/**
 * function to shorten strings with php from
 * http://www.doc4design.com/articles/wordpress-5ways-shorten-titles/
 *
 * The string is shortend to at most $length characters and the $replacer is appended
 * short_title('Example Text', '...', 10); 
 */
function short_title( $string, $replacer = '...', $length) {
        if(strlen($string) > $length)
        $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
        echo $string;
}