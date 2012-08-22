<?php
/** Empty search template.
 * 
 * @package Archimedes
 */
?>

<article id="post-0" class="post empty">
	
	<header class="post-header">
		
		<hgroup>
			
			<h1><?php _e( 'Nothing Found', 'archimedes' ); ?></h1>
			
			<h2><?php printf( __( 'Searching for %s', 'archimedes' ), get_search_query() ); ?></h2>
			
		</hgroup>
		
	</header><!-- .post-header -->
	
	<div class="post-content">
		
		<p><?php _e( 'No results containing all your search terms were found.', 'archimedes' ); ?></p>
		
		<?php get_search_form(); ?>
		
	</div><!-- .post-content -->
	
</article><!-- #post-0 -->