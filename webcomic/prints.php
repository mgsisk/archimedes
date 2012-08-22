<?php
/** Webcomic prints template.
 * 
 * This template is similar to the `single.php` template, but used
 * specifically for displaying webcomic print purchasing options in
 * a unique way.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( webcomic_prints_available() ) : ?>
		
		<?php get_template_part( 'webcomic/content', get_post_type() ); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
			
			<header class="post-header">
					
					<h1><?php printf( __( 'Purchase %s', 'archimedes' ), get_the_title() ); ?></h1>
				
			</header><!-- .post-header -->
			
			<div class="post-content">
				
				<p><?php webcomic_print_form( 'domestic', __( '%total', 'archimedes' ) ); ?></p>
				
				<p><?php webcomic_print_form( 'international', __( '%total (international orders)', 'archimedes' ) ); ?></p>
				
				<?php if ( webcomic_prints_available( true ) ) : ?>
					
					<p><?php webcomic_print_form( 'original', __( '%total (original print)', 'archimedes' ) ); ?></p>
					
				<?php endif; ?>
				
			</div>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>