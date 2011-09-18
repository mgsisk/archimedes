<section id="comments">
<?php
	if ( post_password_required() ) {
		/** If a password must be entered to view comments */
	} elseif ( have_comments() ) {
?>
	<h1><?php comments_number(); ?></h1>
	
	<?php if ( get_comment_pages_count() > 1 ) { ?>
	<nav class="paginated below"><?php paginate_comments_links(); ?></nav>
	<?php
		}
		
		wp_list_comments( array( 'walker' => new archimedes_Walker_Comment() ) ); /* see functions.php archimedes_Walker_Comment */
		
		if ( get_comment_pages_count() > 1 ) {
	?>
	<nav class="paginated below"><?php paginate_comments_links(); ?></nav>
<?php
		}
	} elseif ( comments_open() ) {
		/** If comments are open but none have been posted */
	} else {
		/** If comments are closed */
	}
	
	comment_form();
?>
</section><!-- #comments -->