<?php
/** Comments template.
 * 
 * @package Archimedes
 */
?>

<section id="comments">
	
	<?php if ( post_password_required() ) : ?>
		
		<?php
			/** 
			 * Prevent comments from displaying on protected posts that haven't
			 * been provided with the proper password. Some notification could
			 * be displayed here letting users know they need to enter a
			 * password to view comments.
			 */
		?>
		
	<?php else : ?>
		
		<?php if ( have_comments() ) : ?>
			
			<header class="comments-header">
				
				<h1><?php comments_number( '', __( 'One Comment', 'archimedes' ), __( '% Comments' ) ); ?></h1>
				
			</header><!-- .comments-header -->
			
			<?php archimedes_comments_nav( 'above' ); ?>
			
			<?php
				wp_list_comments( array(
					'style'        => 'div',
					'callback'     => 'archimedes_start_comment',
					'end-callback' => 'archimedes_end_comment'
				) );
			?>
			
			<?php archimedes_comments_nav( 'below' ); ?>
			
		<?php elseif ( !comments_open() and !is_page() and post_type_supports( get_post_type(), 'comments' ) ) : ?>
			
			<?php
				/**
				 * This is only displayed if no comments have been made and the
				 * current post type supports comments (and is not a page).
				 */
			?>
			
		<?php endif; ?>
		
		<?php comment_form(); ?>
		
	<?php endif; ?>
	
</section><!-- #comments -->