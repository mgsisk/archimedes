<?php
/** The main template file.
 * 
 * @package Archimedes
 */

get_header(); ?>

<?php if ( class_exists( 'Webcomic' ) ) : ?>

	<?php get_template_part( 'webcomic/index' ); ?>
	
<?php endif; ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : ?>
		
		<?php archimedes_posts_nav( 'above' ); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php if ( is_a_webcomic() ) : ?>
				
				<?php get_template_part( 'content-webcomic', get_post_type() ); ?>
				
			<?php else : ?>
				
				<?php get_template_part( 'content', get_post_format() ); ?>
				
			<?php endif; ?>
		
		<?php endwhile; ?>
			
		<?php archimedes_posts_nav( 'below' ); ?>
		
	<?php else : ?>
		
		<?php get_template_part( 'empty', 'home' ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>