<?php
/** Generic no content template.
 * 
 * @package Archimedes
 */
?>
<header class="page-header">
	<h1><?php _e( 'Nothing Found', 'archimedes' ); ?></h1>
</header><!-- .page-header -->
<div class="page-content">
	<p><?php _e( 'Nothing could be found for the requested archive.', 'archimedes' ); ?></p>
	<?php get_search_form(); ?>
</div><!-- .page-content -->