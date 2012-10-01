<?php
/** Automagic integration for dynamic requests.
 * 
 * This template is used to render webcomics using Webcomic's
 * Dynamic Navigation feature. We're just using the
 * `/webcomic/webcomic.php` template to keep things simple.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */
?>

<?php get_template_part( 'webcomic/webcomic', get_post_type() ); ?>