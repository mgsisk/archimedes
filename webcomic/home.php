<?php
/** Webcomic home template.
 * 
 * This is the Webcomic-specific homepage template (used in place of
 * the normal `home.php` or `index.php` when Webcomic is active).
 * The only real difference between this template and the normal
 * template is the inclusion of a webcomic.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

$webcomics = !is_paged() ? new WP_Query( array(
	'posts_per_page' => 1,
	'post_type'      => get_webcomic_collections()
) ) : false;

get_header(); ?>

<?php if ( $webcomics and $webcomics->have_posts() ) : ?>
	<?php while ( $webcomics->have_posts() ) : $webcomics->the_post(); ?>
		<div id="webcomic" class="post-webcomic" data-webcomic-shortcuts data-webcomic-gestures data-webcomic-container>
			<?php get_template_part( 'webcomic/webcomic', get_post_type() ); ?>
		</div><!-- .post-webcomic -->
	<?php endwhile; $webcomics->rewind_posts(); ?>
<?php endif; ?>
<main role="main">
	<?php if ( $webcomics and $webcomics->have_posts() ) : ?>
		<?php while ( $webcomics->have_posts() ) : $webcomics->the_post(); ?>
			<?php get_template_part( 'webcomic/content', get_post_type() ); ?>
		<?php endwhile; ?>
	<?php elseif ( $webcomics and current_user_can( 'edit_posts' ) ) : ?>
		<header class="page-header">
			<h1><?php _e( 'No Webcomics', 'archimedes' ); ?></h1>
		</header><!-- .page-header -->
		<div class="page-content">
			<p><?php printf( __( 'Ready to publish your first webcomic? <a href="%s">Start here &raquo;</a>', 'archimedes' ), add_query_arg( array( 'post_type' => 'webcomic1' ), admin_url( 'post-new.php' ) ) ); ?></p>
		</div><!-- .page-content -->
	<?php endif; ?>
	<?php if ( have_posts() ) : ?>
		<?php archimedes_posts_nav( 'above' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<?php archimedes_posts_nav( 'below' ); ?>
	<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
		<header class="page-header">
			<h1><?php _e( 'No Posts', 'archimedes' ); ?></h1>
		</header><!-- .page-header -->
		<div class="page-content">
			<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Start here &raquo;</a>', 'archimedes' ), admin_url( 'post-new.php' ) ); ?></p>
		</div><!-- .page-content -->
	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>