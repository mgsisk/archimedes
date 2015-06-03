<?php
/**
 * The main template file.
 * 
 * Exactly the same as Inkblot's `index.php` file.
 * 
 * @package Archimedes
 * @see https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<main role="main">
	
	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
				get_template_part('content', get_post_format());
			endwhile;
			
			print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
		else :
			get_template_part('content', 'none');
		endif;
	?>
	
</main>

<?php get_sidebar(); get_footer();