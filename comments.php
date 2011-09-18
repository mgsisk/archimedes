<?php
	if ( !empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'comments.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) ) die( 'Please do not load this page directly.' );
	
	if ( post_password_required() ) {
		echo '<div class="nopassword">' . __( 'This post is password protected. Enter the password to view comments.', 'inkblot' ) . '</div>';
		return;
	}
?>

<div id="comments">

<?php if ( have_comments() ) : ?>

	<h2><?php comments_number(); ?></h2>
	<ol class="commentlist"><?php wp_list_comments(); ?></ol>
	<div class="align-center"><?php paginate_comments_links(); ?></div>

<?php endif; if ( 'open' == $post->comment_status ) : ?>

	<div id="respond">
	
	<?php if ( get_option( 'comment_registration' ) && !$user_ID ) : ?>
	
		<p>You must be <a href="<?php echo get_option( 'siteurl' ) . '/wp-login.php?redirect_to=' . urlencode( get_permalink() ); ?>">logged in</a> to comment.</p>
		
	<?php else : ?>
	
		<h2><?php comment_form_title(); ?></h2>
		<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( $user_ID ) : ?>
			<p>Commenting as <a href="<?php echo get_option( 'siteurl' ) . '/wp-admin/profile.php'; ?>"><?php echo $user_identity; ?></a> | <a href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out &raquo;</a></p>
		<?php else : ?>
			<p><label for="author">Name</label><input type="text" name="author" id="author" /><?php if ( $req ) echo '(required)'; ?></p>
			<p><label for="email">E-mail</label><input type="text" name="email" id="email" /><?php if ( $req ) echo '(required)'; ?></p>
			<p><label for="url">Website</label><input type="text" name="url" id="url" /></p>
		<?php endif; ?>
			<p><textarea rows="7" cols="40" name="comment" id="comment"></textarea></p>
			<div><?php do_action( 'comment_form', $post->ID ); ?></div>
			<p>Some <abbr title="<?php echo allowed_tags(); ?>">XHTML</abbr> Allowed&emsp;<span id="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></span>&emsp;<input name="submit" type="submit" id="submit" value="Comment" /><?php comment_id_fields(); ?></p>
		</form>
		
	<?php endif; ?>
	
	</div> <!-- #respond -->
	
<?php endif; ?>

</div> <!-- #comments -->