<?php
/** single.php content template.
 * 
 * @package Archimedes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
	
	<header class="post-header">
		
		<h1><?php the_title(); ?></h1>
		
		<div class="post-meta">
			
			<?php archimedes_post_meta(); ?>
			
		</div><!-- .post-meta -->
		
	</header><!-- .post-header -->
	
	<div class="post-content">
		
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<nav role="navigation" class="post-pages">', 'after' => '</nav>' ) ); ?>
		
	</div><!-- .post-content -->
	
	<footer class="post-footer">
		
		<?php if ( is_a_webcomic() ) : ?>
			
			<?php the_webcomic_collection(); ?>
			
			<?php the_webcomic_storylines( __( ' | Part of ', 'archimedes' ) ); ?>
			
			<?php the_webcomic_characters( __( ' | Featuring ', 'archimedes' ) ); ?>
			
			<?php if ( comments_open() and !post_password_required() ) : ?>
				
				<span class="post-comments-link"><?php comments_popup_link(); ?></span><!-- .post-comments-link -->
				
			<?php endif; ?>
		
		<?php else : ?>
			
			<?php printf( __( 'Posted in %s', 'archimdes' ), get_the_category_list( __( ', ', 'archimedes' ) ) ); ?>
			
			<?php the_tags( sprintf( '<span class="post-tags">%s ', __( 'Tagged', 'archimedes' ) ), __( ', ', 'archimedes' ), '</span><!-- .post-tags -->' ); ?>
			
			<?php if ( comments_open() and !post_password_required() ) : ?>
				
				<span class="post-comments-link"><?php comments_popup_link(); ?></span><!-- .post-comments-link -->
				
			<?php endif; ?>
			
			<?php if ( get_the_author_meta( 'description' ) and ( !function_exists( 'is_multi_author' ) or is_multi_author() ) ) : ?>
				
				<div class="post-author">
					
					<h2><?php printf( __( 'About %s', 'archimedes' ), get_the_author() ); ?></h2>
					
					<div class="post-author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'archimedes_author_avatar', 80 ) ); ?></div><!-- .post-author-avatar -->
					
					<?php the_author_meta( 'description' ); ?>
					
					<span class="post-author-link">
						
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s &rarr;', 'archimedes' ), get_the_author() ); ?></a>
						
					</span><!-- .post-author-link -->
					
				</div><!-- .post-author -->
				
			<?php endif; ?>
			
		<?php endif; ?>
		
	</footer><!-- .post-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->