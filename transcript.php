<?php
	if ( !empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'transcripts.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) ) die( 'Please do not load this page directly.' );
	
	if ( post_password_required() ) {
		echo '<p class="nopassword">' . __('This post is password protected. Enter the password to view the transcript.', 'webcomic' ) . '</p>';
		return;
	}
	
	if ( have_transcript( 'publish' ) ) :
?>

	<h2>Transcript</h2>
	<div id="transcript"><?php echo $transcript; ?></div>

<?php elseif ( get_option( 'comic_transcripts_allowed' ) && !have_transcript( 'draft' ) ) : ?>

	<h2><?php transcript_form_title(); ?></h2>
	
	<div id="transcript">
	
	<?php if ( get_option( 'comic_transcripts_loggedin' ) && !$user_ID) : ?>
		<p>You must be <a href="<?php echo get_option( 'siteurl' ) . '/wp-login.php?redirect_to=' . urlencode( get_permalink() ); ?>">logged in</a> to transcribe.</p>
	<?php else : ?>
		<form action="" method="post" id="transcriptform">
		<div id="transcript-response"></div> <!-- For AJAX Responses -->
		<?php if ( $user_ID ) : ?>
			<p>Transcribing as <a href="<?php echo get_option( 'siteurl' ) . '/wp-admin/profile.php'; ?>"><?php echo $user_identity; ?></a> | <a href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out &raquo;</a></p>
		<?php else : ?>
			<p><label for="trans_author">Name</label><input type="text" name="trans_author" id="trans_author" /><?php if ( $req ) echo ' (required)'; ?></p>
			<p><label for="trans_email">E-mail</label><input type="text" name="trans_email" id="trans_email" /><?php if ( $req ) echo ' (required)'; ?></p>
			<p><label for="trans_captcha">Is fire hot or cold?</label><input type="text" name="trans_captcha" id="trans_captcha" /></p>
		<?php endif; ?>
			<p><textarea rows="7" cols="40" name="transcript" id="transcript"><?php if ( have_transcript( 'pending' ) ) echo $transcript; ?></textarea></p>
			<p>Some <abbr title="<?php echo allowed_tags(); ?>">XHTML</abbr> Allowed &emsp; <input type="submit" value="Transcribe" /><?php transcript_id_fields( 'hot' ); ?></p>
		</form>
	<?php endif; ?>
	
	</div>

<?php endif; ?>