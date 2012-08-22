<?php
/** Author archive template.
 * 
 * @package Archimedes
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( have_posts() ) : $object = get_queried_object(); ?>
		
		<header class="page-header">
			
			<h1><?php printf( __( 'Author Archives: %s', 'archimedes' ), apply_filters( 'the_author', $object->display_name ) ); ?></h1>
			
			<?php if ( $avatar = get_avatar( $object->user_email, apply_filters( 'archimedes_author_archive_avatar_size', 60 ) ) ) : ?>
				
				<div class="author-archive-avatar"><?php echo $avatar; ?></div>
				
			<?php endif; ?>
			
			<?php if ( $description = get_the_author_meta( 'description', $object->ID ) ) : ?>
				
				<div class="author-archive-description"><?php echo $description; ?></div>
				
			<?php endif; ?>
			
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
		
		<?php get_template_part( 'empty', 'author' ); ?>
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>