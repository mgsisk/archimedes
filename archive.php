<?php
/** Generic archive template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : $object = get_queried_object(); ?>
		
		<header class="page-header">
			
			<h1>
				
				<?php if ( is_post_type_archive() ) : ?>
					
					<?php printf( __( '%s Archives', 'archimedes' ), post_type_archive_title( '', false ) ); ?>
					
				<?php else : ?>
					
					<?php _e( 'Archives', 'archimedes' ); ?>
					
				<?php endif; ?>
				
			</h1>
			
			<?php if ( is_post_type_archive() and !empty( $object->description ) ) : ?>
				
				<div class="post-type-archive-description"><?php echo wpautop( $object->description ); ?></div>
				
			<?php endif; ?>
			
		</header><!-- .page-header -->
		
		<?php archimedes_posts_nav( 'above' ); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php if ( is_a_webcomic() ) : ?>
				
				<?php get_template_part( 'webcomic/content', get_post_type() ); ?>
				
			<?php endif; ?>
			
			<?php get_template_part( 'content', get_post_format() ); ?>
			
		<?php endwhile; ?>
		
		<?php archimedes_posts_nav( 'below' ); ?>
		
	<?php else : ?>
		
		<?php get_template_part( 'empty', 'archive' ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>