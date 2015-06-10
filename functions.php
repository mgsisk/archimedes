<?php
/**
 * Archimedes theme functions.
 * 
 * @package Archimedes
 */

add_action('wp_enqueue_scripts', 'archimedes_wp_enqueue_scripts');
add_action('after_setup_theme', 'archimedes_after_setup_theme');

/**
 * Enqueue scripts and stylesheets.
 */
function archimedes_wp_enqueue_scripts() {
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	
	if (is_rtl()) {
		wp_enqueue_style('parent-rtl-style', get_template_directory_uri() . '/rtl.css');
	}
}

/**
 * Setup theme features.
 */
function archimedes_after_setup_theme() {
	load_theme_textdomain('archimedes', get_template_directory() . '/-/l10n');
}