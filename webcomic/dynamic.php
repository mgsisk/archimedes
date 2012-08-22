<?php
/** Automagic integration for dynamic requests.
 * 
 * This template will be used for any dynamically-requested
 * webcomics. We're keeping things simple here and just using the
 * webcomic/content-single.php template.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */
?>

<?php get_template_part( 'webcomic/content-single', get_post_type() ); ?>