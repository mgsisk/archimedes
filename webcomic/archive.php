<?php
/** Generic Webcomic archive template.
 * 
 * Handles Webcomic-related archive page display. You can create
 * collection, storyline, or character-specific archive templates
 * using WordPress' normal template hierarhcy.
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

/** Reverse the order of Webcomic archive pages so older webcomics appear first. */
global $wp_query;

query_posts( array_merge( $wp_query->query_vars, array( 'order' => 'ASC' ) ) );

get_header(); ?>

<main role="main">
	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php if ( is_webcomic_crossover() ) : ?>
				<hgroup>
					<h1><?php printf( __( '%s Crossover Archive', 'archimedes' ), WebcomicTag::webcomic_term_title() ); ?></h1>
					<?php if ( is_webcomic_storyline() ) : ?>
						<h2><?php printf( __( 'Webcomics from %s', 'archimedes' ), WebcomicTag::webcomic_crossover_title() ) ?></h2>
					<?php elseif ( is_webcomic_character() ) : ?>
						<h2><?php printf( __( 'Appearances in %s', 'archimedes' ), WebcomicTag::webcomic_crossover_title() ) ?></h2>
					<?php endif; ?>
				</hgroup>
			<?php elseif ( is_webcomic_storyline() ) : ?>
				<hgroup>
					<h1><?php _e( 'Webcomic Storyline Archive', 'archimedes' ) ?></h1>
					<h2><?php webcomic_storyline_title(); ?></h2>
				</hgroup>
			<?php elseif ( is_webcomic_character() ) : ?>
				<hgroup>
					<h1><?php _e( 'Webcomic Character Archive', 'archimedes' ) ?></h1>
					<h2><?php webcomic_character_title(); ?></h2>
				</hgroup>
			<?php else : ?>
				<h1><?php webcomic_collection_title(); ?></h1>
			<?php endif; ?>
		</header><!-- .page-header -->
		<?php if ( is_webcomic_archive() and $image = WebcomicTag::webcomic_collection_image() ) : ?>
			<div class="page-image"><?php echo $image; ?></div><!-- .page-image -->
		<?php elseif ( is_webcomic_storyline() and $image = WebcomicTag::webcomic_term_image() ) : ?>
			<div class="page-image"><?php echo $image; ?></div><!-- .page-image -->
		<?php elseif ( is_webcomic_character() and $image = WebcomicTag::webcomic_term_image() ) : ?>
			<div class="page-image"><?php echo $image; ?></div><!-- .page-image -->
		<?php endif; ?>
		<?php if ( is_webcomic_archive() and $description = WebcomicTag::webcomic_collection_description() ) : ?>
			<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
		<?php elseif ( is_webcomic_storyline() and $description = WebcomicTag::webcomic_term_description() ) : ?>
			<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
		<?php elseif ( is_webcomic_character() and $description = WebcomicTag::webcomic_term_description() ) : ?>
			<div class="page-content"><?php echo $description; ?></div><!-- .page-content -->
		<?php endif; ?>
		<?php archimedes_posts_nav( 'above' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'webcomic/content', get_post_type() ); ?>
		<?php endwhile; ?>
		<?php archimedes_posts_nav( 'below' ); ?>
	<?php else : ?>
		<?php get_template_part( 'content-none', 'archive' ); ?>
	<?php endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>