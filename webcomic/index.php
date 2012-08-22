<?php
/** Webcomic index content template.
 * 
 * Displays the first webcomic from any collection on the homepage.
 * 
 * @package Archimedes
 */
$webcomics = new WP_Query( array(
	'posts_per_page' => 1,
	'post_type'      => get_webcomic_collections()
) );

if ( $webcomics->have_posts() ) :
?>
	<section id="webcomic">
		
		<?php while ( $webcomics->have_posts() ) : $webcomics->the_post(); ?>
			
			<?php get_template_part( 'webcomic/content-single', get_post_type() ); ?>
			
			<?php get_template_part( 'content', 'single' ); ?>
			
		<?php endwhile; ?>
		
	</section>
	
<?php endif; ?>