<?php
/** Search results template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : global $wp_query; ?>
		
		<header class="page-header">
			
			<hgroup>
				
				<h1><?php printf( __( 'Searching for %s', 'archimedes' ), get_search_query() ); ?></h1>
				
				<h2><?php printf( __( '%s results', 'webcomic' ), $wp_query->found_posts ); ?></h2>
				
			</hgroup>
			
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
		
		<?php get_template_part( 'empty', 'search' ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>