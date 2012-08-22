<?php
/** 404 error template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<article id="post-0" class="post e404">
		
		<header class="post-header">
			
			<h1><?php _e( '404 Error', 'archimedes' ); ?></h1>
			
		</header><!-- .post-header -->
		
		<div class="post-content">
			
			<p><?php _e( "Apologies, but we can't seem to find what you're looking for.", 'archimedes' ); ?></p>
			
		</div><!-- .post-content -->
		
	</article><!-- #post-0 -->
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>