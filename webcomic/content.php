<?php
/** Generic webcomic content template.
 * 
 * This is the generic content template for webcomics, mostly used
 * on archive pages. See webcomic/content-single.php for the
 * standard, full-size webcomic display with navigation.
 * 
 * @package Archimedes
 */
?>
<div class="post-webcomic">
		
	<div class="webcomic-img">
		
		<?php the_webcomic( 'large', 'self' ); ?>
		
	</div>
	
</div>