<?php
/** Header template.
 * 
 * @package Archimedes
 */
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">
	
	<head><?php wp_head(); ?></head>
	
	<body id="document" role="document" <?php body_class(); ?>>
		
		<div id="page">
			
			<header id="banner" role="banner">
				
				<hgroup>
					
					<h1><a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					
					<h2><?php bloginfo( 'description' ); ?></h2>
					
				</hgroup>
				
				<?php if ( $image = get_header_image() ) : ?>
					
					<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><img src="<?php header_image(); ?>" alt=""></a>
					
				<?php endif; ?>
				
				<nav id="navigation" role="navigation" class="cf">
					
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
					
				</nav><!-- #navigation -->
				
			</header><!-- #banner -->
			
			<div id="content" class="cf">