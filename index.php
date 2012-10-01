<?php
/** The main template file.
 * 
 * @package Archimedes
 * @uses webcomic()
 */

get_header(); ?>

<?php if ( webcomic() ) : ?>
	<?php get_template_part( 'webcomic/index' ); ?>
<?php else : ?>
	<section id="main" role="main">
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
	</section><!-- #main -->
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>