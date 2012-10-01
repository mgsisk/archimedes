<?php
/** Standard sidebar template.
 * 
 * @package Archimedes
 */
?>

<div id="sidebar" role="complementary" class="widgets">
	<?php if ( !dynamic_sidebar( 'primary-sidebar' ) and current_user_can( 'edit_theme_options' ) ) : ?>
		<aside class="widget">
			<h1><?php _e( 'Primary Sidebar', 'archimedes' ); ?></h1>
			<p><?php printf( __( 'This is the primary sidebar. You can remove this message by adding widgets to it from the <a href="%s"><strong>Appearance > Widgets</strong> administrative page</a>.', 'archimedes' ), admin_url( 'widgets.php' ) ); ?></p>
		</aside>
	<?php endif; ?>	
</div><!-- #sidebar1 -->