<?php
/** Header template.
 * 
 * @package Archimedes
 */
?>
<!doctype html>
<!--[if IE]>
<html <?php language_attributes(); ?> class="no-js ie"><!-->
<html <?php language_attributes(); ?> class="no-js">
	<head><?php wp_head(); ?></head>
	<body id="document" <?php body_class(); ?>>
		<div id="page">
			<header id="header" role="banner">
				<hgroup>
					<h1><a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<?php if ( $header = get_custom_header() and $header->url ) : ?>
					<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><img src="<?php header_image(); ?>" width="<?php echo $header->width; ?>" height="<?php echo $header->height; ?>" alt=""></a>
				<?php endif; ?>
				<nav><?php wp_nav_menu( array( 'theme_location' => 'primary', 'show_home' => true, 'container' => false ) ); ?></nav>
			</header><!-- #header -->
			<div id="content">