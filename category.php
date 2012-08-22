<?php
/** Category archive template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : ?>
		
		<header class="page-header">
			
			<h1><?php printf( __( 'Category Archives: %s', 'archimedes' ), single_cat_title( '', false ) ); ?></h1>
			
			<?php if ( $description = category_description() ) : ?>
				
				<div class="category-archive-description"><?php echo $description; ?></div>
				
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
		
		<?php get_template_part( 'empty', 'category' ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>