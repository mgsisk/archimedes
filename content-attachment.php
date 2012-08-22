<?php
/** Attachment content template.
 * 
 * @package Archimedes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
	
	<header class="post-header">
		
		<h1><?php the_title(); ?></h1>
		
		<div class="post-meta">
			
			<?php archimedes_post_meta(); ?>
			
		</div><!-- .post-meta -->
		
	</header><!-- .post-header -->
	
	<div class="post-attachment">
		
		<?php the_attachment_link( $post->ID, true ); ?>
		
	</div><!-- .post-attachment -->
	
	<?php if ( $post->post_excerpt ) : ?>
		
		<div class="post-summary">
			
			<?php the_excerpt(); ?>
			
		</div><!-- .post-summary -->
		
	<?php endif; ?>
	
	<div class="post-content">
		
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<nav role="navigation" class="post-pages">', 'after' => '</nav>' ) ); ?>
		
	</div><!-- .post-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->