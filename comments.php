<?php
/** Comments template.
 * 
 * @package Archimedes
 * @uses archimedes_comments_nav()
 * @uses archimedes_start_coment()
 * @uses archimedes_end_coment()
 */
?>

<aside id="comments">
	<?php if ( post_password_required() ) : ?>
		
	<?php else : ?>
		<?php if ( have_comments() ) : ?>
			<header class="comments-header">
				<h1><?php comments_number( '', __( 'One Comment', 'archimedes' ), __( '% Comments', 'archimedes' ) ); ?></h1>
			</header><!-- .comments-header -->
			<?php archimedes_comments_nav( 'above' ); ?>
			<?php
				wp_list_comments( array(
					'style'        => 'div',
					'avatar_size'  => 32,
					'callback'     => 'archimedes_start_comment',
					'end-callback' => 'archimedes_end_comment'
				) );
			?>
			<?php archimedes_comments_nav( 'below' ); ?>
		<?php elseif ( !comments_open() and get_comments_number() and post_type_supports( get_post_type(), 'comments' ) ) : ?>
			
		<?php endif; ?>
		<?php comment_form(); ?>
	<?php endif; ?>
</aside><!-- #comments -->