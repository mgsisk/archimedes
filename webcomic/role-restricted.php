<?php
/** Webcomic role-restricted template.
 * 
 * This template will be displayed in place of the normal post
 * content when a user with an inappropriate role tries to view a
 * role-restricted Webcomic.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

get_header(); ?>

<section id="main" role="main">
	
	<article id="post-0" class="post webcomic-restricted">
		
		<header class="post-header">
			
			<h1><?php _e( 'Restricted Content', 'archimedes' ); ?></h1>
			
		</header><!-- .post-header -->
		
		<div class="post-content">
			
			<p><?php _e( "You don't have permission to view this content.", 'archimedes' ); ?></p>
			
		</div>
	
	</article><!-- #post-0 -->
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>