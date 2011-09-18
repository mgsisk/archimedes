<?php get_header(); ?>

<div class="content alignleft">

<?php if ( have_posts() ) : ?>

	<h1>Search results for <?php echo wp_specialchars( stripslashes( $_GET[ 's' ] ), true ); ?></h1>
	
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
	
	<?php else: ?>
	
	<h1>No Results</h1>
	
	<p>Your search for <?php echo wp_specialchars( stripslashes( $_GET[ 's' ] ), true ); ?> did not return any results.</p>
	
	<?php endif; ?>

</div>

<?php get_sidebar(); get_footer(); ?>