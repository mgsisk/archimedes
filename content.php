<?php
/** Generic content template.
 * 
 * @package Archimedes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
	
	<header class="post-header">
		
		<?php if ( is_sticky() ) :?>
			
			<hgroup>
				
				<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'archimedes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				
				<h2><?php _e( 'Featured', 'archimedes' ); ?></h2>
				
			</hgroup>
			
		<?php else : ?>
			
			<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'archimedes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
		<?php endif; ?>
		
		<div class="post-meta">
			
			<?php archimedes_post_meta(); ?>
			
		</div><!-- .post-meta -->
		
	</header><!-- .post-header -->
	
	<?php if ( is_search() ) : ?>
	
		<?php if ( has_post_thumbnail() ) : ?>
			
			<div class="post-thumbnail">
				
				<?php the_post_thumbnail(); ?>
				
			</div><!-- .post-thumbnail -->
			
		<?php endif; ?>
		
		<div class="post-summary">
			
			<?php the_excerpt(); ?>
			
		</div><!-- .post-summary -->
		
	<?php else : ?>
		
		<div class="post-content">
			
			<?php the_content(); ?>
			
			<?php wp_link_pages( array( 'before' => '<nav role="navigation" class="post-pages">', 'after' => '</nav>' ) ); ?>
			
		</div><!-- .post-content -->
		
	<?php endif; ?>
	
	<footer class="post-footer">
		
		<?php if ( is_a_webcomic() ) : ?>
			
			<?php the_webcomic_collection(); ?>
			
			<?php the_webcomic_storylines( __( ' | Part of ', 'archimedes' ) ); ?>
			
			<?php the_webcomic_characters( __( ' | Featuring ', 'archimedes' ) ); ?>
			
		<?php else : ?>
			
			<?php printf( __( 'Posted in %s', 'archimdes' ), get_the_category_list( __( ', ', 'archimedes' ) ) ); ?>
			
			<?php the_tags( __( ' | Tagged ', 'archimedes' ), __( ', ', 'archimedes' ) ); ?>
			
		<?php endif; ?>
			
			<?php if ( comments_open() and !post_password_required() ) : ?>
				
				| <?php comments_popup_link(); ?>
				
			<?php endif; ?>
		
	</footer><!-- .post-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->