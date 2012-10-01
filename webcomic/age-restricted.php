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
	<header class="page-header">
		<h1><?php _e( 'Age Restricted Content', 'archimedes' ); ?></h1>
	</header><!-- .page-header -->
	<div class="page-content">
		<?php if ( is_null( verify_webcomic_age() ) ) : ?>
			<p><?php _e( 'We must verify your age before you can continue.', 'archimedes' ); ?></p>
			<form method="post">
				<label for="webcomic_birthday">Date of Birth</label>
				<input type="date" name="webcomic_birthday" id="webcomic_birthday" placeholder="<?php esc_attr_e( 'Date of Birth', 'archimedes' ); ?>">
				<button type="submit"><?php _e( 'Verify Age', 'archimedes' ); ?></button>
			</form>
		<?php else : ?>
			<p><?php _e( "Apologies, but you're not old enough to view this content.", 'archimedes' ); ?></p>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>