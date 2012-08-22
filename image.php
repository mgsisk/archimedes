<?php
/** Image attachment template.
 * 
 * @package Archimedes
 */

get_header(); $content_width = isset( $content_width ) ? $content_width : 960; ?>

<section id="main" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php get_template_part( 'content', 'attachment' ); ?>
		
		<nav role="navigation" class="images">
			
			<?php previous_image_link(); ?>
			
			<?php next_image_link(); ?>
			
		</nav>
		
		<?php comments_template( '', true ); ?>
		
	<?php endwhile; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>