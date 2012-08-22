<?php
/** Generic taxonomy archive template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : $object = get_queried_object(); $taxonomy = get_taxonomy( $object->taxonomy ); ?>
		
		<header class="page-header">
			
			<h1><?php printf( __( '%s Archives: %s', 'archimedes' ), $taxonomy->labels->name, apply_filters( 'single_term_title', $object->name ) ); ?></h1>
			
			<?php if ( $description = term_description( $object->term_id, $object->taxonomy ) ) : ?>
				
				<div class="tax-archive-description"><?php echo $description; ?></div>
				
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
		
		<?php get_template_part( 'empty', $object->taxonomy ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>