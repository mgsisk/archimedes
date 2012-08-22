<?php
/** Main sidebar template.
 * 
 * @package Archimedes
 */
?>

<section id="complementary" role="complementary">
	
	<?php if ( !dynamic_sidebar( 'primary-sidebar' ) ) : ?>
		
		<aside id="archives" class="widget">
			
			<h3><?php _e( 'Sidebar', 'archimedes' ); ?></h3>
			
			<p><?php _e( 'This is the theme sidebar. You can remove this message by adding widgets to it from the <strong>Appearance > Widgets</strong> administrative page.', 'archimedes' ); ?></p>
			
			<?php if ( is_user_logged_in() ) : ?>
				
				<?php wp_register( '<p>', '</p>' ); ?>
				
			<?php else : ?>
				
				<?php wp_login_form(); ?>
				
			<?php endif; ?>
			
		</aside>
		
	<?php endif; ?>	
	
</section><!-- #complementary -->