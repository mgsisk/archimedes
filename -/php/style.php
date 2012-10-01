<?php
/** Custom stylesheet generator.
 * 
 * To keep a lot of embedded styles out of our `<head>` we use this
 * file to generate a custom stylesheet based on theme
 * modifications. For convenience, the styles are loaded directly
 * into the site `<head>` while actually customizing the theme, to
 * ensure that live modification previews work correctly.
 * 
 * @package Archimedes
 */

if ( !function_exists( 'get_theme_mod' ) ) {
	return;
}

$css = array();

if ( $header_textcolor = get_header_textcolor() ) {
	if ( 'blank' === $header_textcolor ) {
		$css[ '#header hgroup' ][] = 'display:none';
	} else {
		$css[ '#header hgroup,#header hgroup a' ][] = sprintf( 'color:#%s', $header_textcolor );
	}
}

if ( $background_color = get_background_color() ) {
	$css[ 'body' ][] = sprintf( 'background-color:#%s', $background_color );
}

if ( $background_image = get_background_image() ) {
	$css[ 'body' ][] = sprintf( 'background-image:url(%s)', $background_image );
	$css[ 'body' ][] = sprintf( 'background-repeat:%s', get_theme_mod( 'background_repeat', 'repeat' ) );
	$css[ 'body' ][] = sprintf( 'background-position:top %s', get_theme_mod( 'background_position_x', 'left' ) );
	$css[ 'body' ][] = sprintf( 'background-attachment:%s', get_theme_mod( 'background_attachment', 'scroll' ) );
}

foreach ( $css as $k => $v ) {
	printf( '%s{%s}', $k, join( ';', ( array ) $v ) );
}