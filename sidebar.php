<aside id="sidebar">
<?php if ( !dynamic_sidebar( 'archimedes-sidebar' ) ) { //see functions.php hook_init ?>
	<figure>
		<figcaption><?php _e( 'Sidebar', 'archimedes' ); ?></figcaption>
		<?php _e( 'This area is widgetized. You can add widgets by going to <em>Appearance > Widgets</em> in the administrative dashboard. Adding widgets will remove this message.', 'archimedes' ); ?>
	</figure>
<?php } ?>
</aside>