<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><?php wp_head(); //see functions.php hook_wp_head_0 ?></head>
<body id="body" <?php body_class(); ?>>
	<div id="wrap">
		<header id="header">
			<hgroup>
				<a href="<?php echo home_url( '/' ); ?>" rel="home"><h1><b><?php bloginfo( 'name' ); ?></b></h1></a>
				<h2><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
			<nav><?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'navbar' ) ); ?></nav>
			<hr>
		</header><!-- #header -->
		<section id="main">