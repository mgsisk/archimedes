<?php get_header(); ?>

	<?php if ( !is_paged() ) { $comics = comic_loop(); while ( $comics->have_posts() ) : $comics->the_post(); ?>
	
	<div id="comic-<?php the_id(); ?>" <?php post_class( 'comic' ); ?>>
		<div class="align-center"><?php the_comic(); ?></div>
		<div class="group navi">
			<div class="alignright"><?php comics_nav_link(); ?></div>
			<div class="alignleft"><?php chapters_nav_link(); ?></div>
		</div>
	</div>
	
	<?php endwhile; } ?>
	
	<div class="content alignleft">
	
		<h1 class="hide"><?php bloginfo( 'name' ); ?></h1>
		
		<?php if ( !is_paged() ) { while ( $comics->have_posts() ) : $comics->the_post(); ?>
			<div id="post-<?php the_id(); ?>" <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry"><?php the_content(); ?></div>
				<div class="meta"><?php edit_post_link( 'Edit', '', ' | ' ); the_time( get_option( 'date_format' ) ); ?> | <?php comments_popup_link(); ?></div>
			</div>
		<?php endwhile; } ?>
		
		<div class="blog-title">Blog</div>
		
		<?php ignore_comics(); while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_id(); ?>" <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry"><?php the_content(); ?></div>
				<div class="meta"><?php edit_post_link( 'Edit', '', ' | ' ); the_time( get_option( 'date_format' ) ); ?> | <?php comments_popup_link(); ?></div>
			</div>
		<?php endwhile; ?>
		
		<div class="group">
			<div class="alignleft"><?php previous_posts_link(); ?></div>
			<div class="alignright"><?php next_posts_link(); ?></div>
		</div>
	
	</div>

<?php get_sidebar(); get_footer(); ?>