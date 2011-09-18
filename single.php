<?php get_header(); the_post(); ?>

<?php if ( in_comic_category() ) { ?>
	
<div id="comic-<?php the_id(); ?>" <?php post_class( 'comic' ); ?>>
	<div class="align-center"><?php the_comic(); ?></div>
	<div class="group navi">
		<div class="alignright"><?php comics_nav_link(); ?></div>
		<div class="alignleft"><?php chapters_nav_link(); ?></div>
	</div>
</div>
	
<?php } ?>

<div class="content alignleft">

<?php if ( !in_comic_category() ) { ?>
	
	<div class="group">
		<div class="alignleft"><?php previous_post_link( '%link', '&laquo; %title', false, get_comic_category( true, 'post_link_exclude' ) ); ?></div>
		<div class="alignright"><?php next_post_link( '%link', '%title &raquo;', false, get_comic_category( true, 'post_link_exclude' ) ); ?></div>
	</div>
	
<?php } ?>

	<div id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<h1><?php the_title(); ?></h1>
		<div class="entry"><?php the_content(); wp_link_pages(); ?></div>
		
	<?php if ( in_comic_category() ) { ?>
		<p><label>Share this comic: <?php the_comic_embed( ); ?></label></p>
	<?php } transcript_template(); ?>
	
		<div class="meta">
			<p>Posted on <?php the_date(); ?> at <?php the_time(); ?> by <?php the_author(); ?> in <?php the_category( ', ' ); if ( in_comic_chapter() ) { ?> as part of <?php the_chapter_link(); ?> &laquo; <?php the_chapter_link( 'volume' ); ?> &laquo; <?php the_chapter_link( 'series' ); } if ( get_the_tags() ) { ?> and tagged with <?php the_tags( '', ', ' ); } ?>. Follow responses to this post with the <a href="<?php get_post_comments_feed_link(); ?>">comments feed</a>.</p>
			<p>
			<?php if ( ( 'open' == $post->comment_status ) && ( 'open' == $post->ping_status ) ) { ?>
				You can <a href="#comment">leave a comment</a> or <a href="<?php get_trackback_url(); ?>" rel="trackback">trackback</a> from your own site.
			<?php } elseif ( !( 'open' == $post->comment_status ) && ( 'open' == $post->ping_status ) ) { ?>
				Comments are closed, but you can <a href="<?php get_trackback_url(); ?>" rel="trackback">trackback</a> from your own site.
			<?php } elseif ( ( 'open' == $post->comment_status ) && !( 'open' == $post->ping_status ) ) { ?>
				You can <a href="#comment">leave a comment</a>.
			<?php } edit_post_link(); ?>
			</p>
		</div>
	</div>

	<?php comments_template(); ?>
	
</div>

<?php get_sidebar(); get_footer(); ?>