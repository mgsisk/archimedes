<?php
/** Single post template.
 * 
 * This template is nearly identical to the normal `single.php`
 * template, except for the addition of webcomic display using the
 * separate `/webcomic/webcomic.php` template.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */
?>

<?php while ( have_posts() ) : the_post(); ?>
	<div id="webcomic" class="post-webcomic" data-webcomic-shortcuts data-webcomic-gestures>
		<?php get_template_part( 'webcomic/webcomic', get_post_type() ); ?>
	</div><!-- .post-webcomic -->
	<main role="main">
		<?php get_template_part( 'webcomic/content', get_post_type() ); ?>
		<?php webcomic_transcripts_template(); ?>
		<?php comments_template( '', true ); ?>
	</main>
<?php endwhile; ?>