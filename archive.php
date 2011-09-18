<?php get_header(); the_post(); ?>

<div class="content alignleft">
	
	<?php if ( is_category() ) { ?><h1><?php single_cat_title(); ?> Posts</h1>
	<?php } elseif( is_tag() ) { ?><h1><?php single_tag_title(); ?> Posts</h1>
	<?php } elseif ( is_author() ) { ?><h1><?php the_author(); ?> Posts</h1>
	<?php } elseif ( is_day() ) { ?><h1><?php the_time( get_option( 'date_format' ) ); ?> Archive</h1>
	<?php } elseif ( is_month() ) { ?><h1><?php the_time( 'F Y' ); ?> Archive</h1>
	<?php } elseif ( is_year() ) { ?><h1><?php get_the_time( 'Y' ); ?> Archive</h1>
	<?php } elseif ( is_tax() ) { ?><h1><?php single_chapter_title(); ?> Comics</h1>
	<?php } rewind_posts(); ?>
	
	<?php while ( have_posts() ) : the_post(); if ( in_comic_category() ) { ?>
		
	<div id="comic-<?php the_id(); ?>" <?php post_class( 'comic' ); ?>>
		<p><?php the_comic( 'medium', 'self' ); ?><p>
		<h2><a href="<?php the_permalink(); ?>" title="Permanent link to <?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</div>
	
	<?php } else { ?>
		
	<div id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<h2><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry"><?php the_content(); ?></div>
		<div class="meta"><?php edit_post_link( 'Edit', '', ' | ' ); the_time( get_option( 'date_format' ) ); ?> | <?php comments_popup_link(); ?></div>
	</div>
	
	<?php } endwhile; ?>
		
	<div class="group">
		<div class="alignleft"><?php previous_posts_link(); ?></div>
		<div class="alignright"><?php next_posts_link(); ?></div>
	</div>

</div>

<?php get_sidebar(); get_footer(); ?>