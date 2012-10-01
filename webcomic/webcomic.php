<?php
/** Generic webcomic template.
 * 
 * Handles full webcomic image display with navigation. Used by the
 * `/webcomic/dynamic.php`, `/webcomic/single.php`, and
 * `/webcomic/index.php` templates, so changes here will affect how
 * full webcomics are displayed in all locations.
 * 
 * @package Archimedes
 */
?>

<nav class="webcomics above">
	<?php first_webcomic_link(); ?>
	<?php previous_webcomic_link(); ?>
	<?php random_webcomic_link(); ?>
	<?php next_webcomic_link(); ?>
	<?php last_webcomic_link(); ?>
</nav><!-- .webcomics.above -->
<div class="webcomic-image">
	<?php the_webcomic(); ?>
</div><!-- .webcomic-image -->
<nav class="webcomics below">
	<?php first_webcomic_link(); ?>
	<?php previous_webcomic_link(); ?>
	<?php random_webcomic_link(); ?>
	<?php next_webcomic_link(); ?>
	<?php last_webcomic_link(); ?>
</nav><!-- .webcomics.below -->