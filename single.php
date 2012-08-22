<?php
/** Single post template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<?php if ( is_webcomic() ) : ?>
	
	<?php get_template_part( 'webcomic/content-single', get_post_type() ); ?>
	
<?php endif; ?>

<section id="main" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php if ( !is_webcomic() ) : ?>
			
			<nav role="navigation" class="single-posts">
				
				<?php previous_post_link(); ?>
				
				<?php next_post_link(); ?>
				
			</nav>
			
		<?php endif; ?>
		
		<?php get_template_part( 'content', 'single' ); ?>
		
		<?php if ( is_webcomic() ) : ?>
			
			<?php webcomic_transcripts_template(); ?>
			
		<?php endif; ?>
		
		<?php comments_template( '', true ); ?>
		
	<?php endwhile; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>