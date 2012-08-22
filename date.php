<?php
/** Date archive template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : ?>
		
		<header class="page-header">
			
			<h1>
				
				<?php if ( is_day() ) : ?>
					
					<?php printf( __( 'Daily Archives: %s', 'archimedes' ), get_the_date() ); ?>
					
				<?php else if ( is_year() ) : ?>
					
					<?php printf( __( 'Yearly Archives: %s', 'archimedes' ), get_the_date( __( 'Y', 'archimedes' ) ) ); ?>
					
				<?php else : ?>
					
					<?php printf( __( 'Monthly Archives: %s', 'archimedes' ), get_the_date( __( 'F Y', 'archimedes' ) ) ); ?>
					
				<?php endif; ?>
				
			</h1>
			
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
		
		<?php get_template_part( 'empty', 'date' ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>