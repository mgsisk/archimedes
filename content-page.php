<?php
/** Page content template.
 * 
 * @package Archimedes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
	
	<header class="post-header">
		
		<h1><?php the_title(); ?></h1>
		
	</header><!-- .post-header -->
	
	<div class="post-content">
		
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<nav role="navigation" class="post-pages">', 'after' => '</nav>' ) ); ?>
		
	</div><!-- .post-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->