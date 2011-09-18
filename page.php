<?php get_header(); the_post(); ?>

<div class="content alignleft">

	<div id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<h1><?php the_title(); ?></h1>
		<div class="entry"><?php the_content(); wp_link_pages(); edit_post_link( 'Edit', '<p>', '</p>' ); ?></div>
	</div>
	
	<?php comments_template(); ?>

</div>

<?php get_sidebar(); get_footer(); ?>