<?php global $webcomic; get_header(); ?>

<div id="main">
	<section id="content">
	
	<?php if ( is_home() ) { //home.php ?>
	
		<?php if ( class_exists( 'webcomic' ) ) { $q = new WP_Query( 'post_type=webcomic_post&posts_per_page=1' ); while( $q->have_posts() ) { $q->the_post(); ?>
		
		<article id="webcomic-<?php the_ID(); ?>" <?php post_class(); ?>>
			<nav><?php first_webcomic_link(); previous_webcomic_link(); next_webcomic_link(); last_webcomic_link(); ?></nav>
			<?php the_webcomic_object(); ?>
			<nav><?php first_webcomic_link(); previous_webcomic_link(); next_webcomic_link(); last_webcomic_link(); ?></nav>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<footer><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> | <?php the_date(); ?> @ <?php the_time(); ?> | <?php comments_popup_link(); edit_post_link( NULL, ' | ' ); ?></footer>
			<?php the_content(); ?>
			<hr>
		</article><!-- #webcomic-<?php the_ID(); ?> -->
		
		<?php } } ?>
		
		<?php while ( have_posts() ) { the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php the_content(); ?>
			<footer><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> | <?php the_date(); ?> @ <?php the_time(); ?> | <?php comments_popup_link(); edit_post_link( NULL, ' | ' ); ?></footer>
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php } ?>
		
	<?php } elseif ( is_single() ) { the_post(); //single.php ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( is_attachment() ) { ?>
			<p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php printf( esc_attr__( 'Return to %s', 'archimedes' ), esc_html( get_the_title( $post->post_parent ), 1 ) ); ?>" rel="gallery">&larr; <?php echo get_the_title( $post->post_parent ); ?></a></p>
			<?php } elseif ( class_exists( 'webcomic' ) && is_singular( 'webcomic_post' ) ) { ?>
			<nav class="webcomic-above">
				<ul>
					<li><?php purchase_webcomic_link(); ?></li>
					<li><?php first_webcomic_link(); ?></li>
					<li><?php previous_webcomic_link(); ?></li>
					<li><?php random_webcomic_link(); ?></li>
					<li><?php next_webcomic_link(); ?></li>
					<li><?php last_webcomic_link(); ?></li>
				</ul>
			</nav>
			<?php the_webcomic_object(); ?>
			<nav class="webcomic-below">
				<ul>
					<li><?php first_webcomic_link(); ?></li>
					<li><?php previous_webcomic_link(); ?></li>
					<li><?php random_webcomic_link(); ?></li>
					<li><?php next_webcomic_link(); ?></li>
					<li><?php last_webcomic_link(); ?></li>
				</ul>
			</nav>
			<?php } else { ?>
			<nav class="posts">
				<ul>
					<li><?php previous_post_link(); ?></li>
					<li><?php next_post_link(); ?></li>
				</ul>
			</nav>
			<?php } ?>
			<h1><?php the_title(); ?></h1>
			<?php
				the_content();
				wp_link_pages( array( 'before' => '<nav class="paged">' . __( 'Pages:', 'archimedes' ), 'after' => '</nav>' ) );
				
				if ( is_attachment() ) {
			?>
			<nav class="attachment">
				<ul>
					<li><?php previous_image_link( false ); ?></li>
					<li><?php next_image_link( false ); ?></li>
				</ul>
			</nav>
			<?php } ?>
			<footer>
			<?php
				printf(
					__( 'Posted on <a href="%s" title="%s" rel="bookmark">%s</a> by <a href="%s" title="View all posts by %s" rel="author">%s</a>', 'archimedes' ),
					get_permalink(),
					get_the_time(),
					get_the_date(),
					get_author_posts_url( get_the_author_meta( 'ID' ) ),
					get_the_author(),
					get_the_author()
				);
				
				if ( class_exists( 'webcomic' ) && is_singular( 'webcomic_post' ) ) {
					the_webcomic_post_collections( array( 'before' => __( ' | From ', 'archimedes' ), 'separator' => ', ' ) );
					the_webcomic_post_storylines( array( 'before' => __( ' | Part of ', 'archimedes' ), 'separator' => ', ' ) );
					the_webcomic_post_characters( array( 'before' => __( ' | Featuring ', 'archimedes' ), 'separator' => ', ' ) );
				}
				
				if ( get_the_category() ) {
					_e( ' | Filed under ', 'archimedes' );
					the_category( ', ' );
					the_tags( __( ' and tagged with ', 'archimedes' ), ', ' );
				} else
					the_tags( __( ' | Tagged with ' ), ', ' );
				
				edit_post_link( __( 'Edit', 'archimedes' ), ' | <span class="edit-link">', '</span>' );
			?>
			</footer>
			<?php webcomic_transcripts_template(); comments_template( '', true ); ?>
		</article><!-- #post-<?php the_ID(); ?> -->
		
	<?php } elseif ( is_page() ) { the_post(); //page.php ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php
				the_content();
				wp_link_pages( array( 'before' => '<nav class="paged">' . __( 'Pages:', 'archimedes' ), 'after' => '</nav>' ) );
				edit_post_link( __( 'Edit', 'archimedes' ), '<span class="edit-link">', '</span>' );
				comments_template( '', true );
			?>
		</article><!-- #post-<?php the_ID(); ?> -->
		
	<?php } elseif ( is_search() ) { //search.php ?>
		
		<?php if ( have_posts() ) { ?>
		<h1><?php printf( __( 'Search Results for %s', 'archimedes' ), '<q>' . esc_html( get_search_query() ) . '</q>' ); ?></h1>
		
		<?php while ( have_posts() ) { the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( 'webcomic_post' === get_post_type() ) { the_webcomic_object( 'small', 'self' ); } ?>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php the_content(); ?>
			<footer><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> | <?php the_date(); ?> @ <?php the_time(); ?> | <?php comments_popup_link(); edit_post_link( NULL, ' | ' ); ?></footer>
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php } ?>
		
		<?php } else { ?>
		<article id="post-0" class="post no-results not-found">
			<h1><?php _e( 'Nothing Found', 'archimedes' ); ?></h1>
			<p><?php _e( 'Nothing matched your search criteria. Please try again: ', 'archimedes' ); get_search_form(); ?></p>
		</article>
		<?php } ?>
		
	<?php } elseif ( is_archive() ) { the_post(); //archive.php ?>
		
		<?php if ( is_date() ) { ?><h1><?php if ( is_year() ) $d = get_the_date( 'Y' ); elseif ( is_month() ) $d = get_the_time( 'F Y' ); else $d = get_the_time( get_option( 'date_format' ) ); printf( __( 'Posts from %s', 'archimedes' ), $d ); ?></h1>
		<?php } elseif ( is_category() ) { ?><h1><?php printf( __( 'Posts filed under %s', 'archimedes' ), single_cat_title( '', false ) ); ?></h1>
		<?php } elseif ( is_tag() ) { ?><h1><?php printf( __( 'Posts tagged with %s', 'archimedes' ), single_tag_title( '', false ) ); ?></h1>
		<?php } elseif ( is_author() ) { ?>
			<?php if ( get_the_author_meta( 'description' ) && !is_paged() ) { //Show author info on the first page only ?>
				<h1><?php the_author(); ?></h1>
				<div id="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'archimedes_author_bio_avatar_size', 60 ) ); ?></div>
				<?php the_author_meta( 'description' ); ?>
				<hr>
				<h2><?php printf( __( 'Posts by %s', 'archimedes' ), get_the_author() ); ?></h2>
			<?php } else { ?>
				<h1><?php printf( __( 'Posts by %s', 'archimedes' ), get_the_author() ); ?></h1>
			<?php } ?>
		<?php } elseif ( is_tax( 'webcomic_collection' ) ) { ?><h1><?php printf( __( 'Webcomics from %s', 'archimedes' ), $webcomic->get_webcomic_term_info( 'name', 'webcomic_collection' ) ); ?></h1>
		<?php } elseif ( is_tax( 'webcomic_storyline' ) ) { ?><h2><?php printf( __( 'Webcomics in %s', 'archimedes' ), $webcomic->get_webcomic_term_info( 'name', 'webcomic_storyline' ) ); ?></h2>
		<?php } elseif ( is_tax( 'webcomic_character' ) ) { query_posts( $query_string . '&order=ASC' ); //Show the characters first appearance first ?>
			<?php if ( !is_paged() ) { //Show character info on the first page only ?>
			<h1><?php webcomic_character_info( 'name' ); ?></h1>
			<div class="character-avatar"><?php webcomic_character_info( 'thumb-full' ); ?></div>
			<?php webcomic_character_info( 'description' ); ?>
			<nav><?php previous_webcomic_character_link( '%link', '&laquo; %name' ); next_webcomic_character_link( '%link', '%name &raquo;' ); ?></nav>
			<hr>
			<h2><?php printf( __( 'Appearances by %s', 'archimedes' ), $webcomic->get_webcomic_term_info( 'name', 'webcomic_character' ) ); ?></h2>
			<?php } else { ?>
			<h1><?php printf( __( 'Appearances by %s', 'archimedes' ), $webcomic->get_webcomic_term_info( 'name', 'webcomic_character' ) ); ?></h1>
			<?php } ?>
		<?php } else { ?><h1><?php _e( 'Archives', 'archimedes' ); ?></h1>
		<?php } rewind_posts(); ?>
		
		<?php while ( have_posts() ) { the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( 'webcomic_post' === get_post_type() ) { the_webcomic_object( 'small', 'self' ); } ?>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php the_content(); ?>
			<footer><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> | <?php the_date(); ?> @ <?php the_time(); ?> | <?php comments_popup_link(); edit_post_link( NULL, ' | ' ); ?></footer>
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php } ?>
		
	<?php } elseif ( is_404() ) { //404.php ?>
		
		<article id="post-0" class="post error404 not-found">
			<h1><?php _e( '404 Not Found', 'archimedes' ); ?></h1>
			<p><?php get_search_form(); ?></p>
		</article>
		
	<?php } ?>
	
	</section><!-- #content -->
</div><!-- #main -->
<?php get_sidebar(); get_footer(); ?>