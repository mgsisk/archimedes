<?php
/** Webcomic age-restricted template.
 * 
 * This template will be displayed in place of the normal post
 * content when a user with an unknown or inappropriate age tries to
 * view an age-restricted Webcomic. The age verification form
 * requires only a single input named `webcomic_birthday`.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

get_header(); ?>

<section id="main" role="main">
	
	<?php if ( is_null( verify_webcomic_age() ) ) : /* The users age is unknown. */ ?>
		
		<article id="post-0" class="post webcomic-restricted">
			
			<header class="post-header">
				
				<h1><?php _e( 'Verify Your Age', 'archimedes' ); ?></h1>
				
			</header><!-- .post-header -->
			
			<div class="post-content">
				
				<form method="post">
					
					<label id="webcomic_birthday">Date of Birth</label>
					
					<input type="date" name="webcomic_birthday" id="webcomic_birthday" placeholder="<?php esc_attr_e( 'Date of Birth', 'archimedes' ); ?>">
					
					<button type="submit"><?php _e( 'Verify Age', 'archimedes' ); ?></button>
					
				</form>
				
			</div>
		
		</article><!-- #post-0 -->
		
	<?php else : /* The user is not old enough for this content. */ ?>
		
		<article id="post-0" class="post webcomic-restricted">
			
			<header class="post-header">
				
				<h1><?php _e( 'Verify Your Age', 'archimedes' ); ?></h1>
				
			</header><!-- .post-header -->
			
			<div class="post-content">
				
				<p><?php _e( 'This content is age restricted.', 'archimedes' ); ?></p>
				
			</div>
		
		</article><!-- #post-0 -->
		
	<?php endif; ?>
	
</section><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>