<?php
/** Single webcomic content template.
 * 
 * This is the standard full-size webcomic display template used on
 * both the index and single-webcomic pages. Actual post content is
 * handled with the normal content template.
 * 
 * @package Archimedes
 */
?>

<section id="webcomic">
	
	<div class="post-webcomic">
		
		<nav class="webcomics above">
			
			<?php first_webcomic_link(); ?>
			
			<?php previous_webcomic_link(); ?>
			
			<?php random_webcomic_link(); ?>
			
			<?php next_webcomic_link(); ?>
			
			<?php last_webcomic_link(); ?>
			
		</nav>
		
		<div class="webcomic-img">
			
			<?php the_webcomic( 'full' ); ?>
			
		</div>
		
		<nav class="webcomics below">
			
			<?php first_webcomic_link(); ?>
			
			<?php previous_webcomic_link(); ?>
			
			<?php random_webcomic_link(); ?>
			
			<?php next_webcomic_link(); ?>
			
			<?php last_webcomic_link(); ?>
			
		</nav>
		
	</div>
	
</section>