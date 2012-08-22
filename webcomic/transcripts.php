<?php
/** Webcomic transcripts template.
 * 
 * This template is nearly identical to WordPress' own
 * `comments.php` template, except that we have to check for (and
 * display) transcripts that are Pending Review (i.e. transcripts
 * that users can improve upon).
 * 
 * @package Archimedes
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

global $post;
?>

<section id="webcomic-transcripts">
	
	<?php if ( post_password_required() ) : ?>
		
		<?php
			/** 
			 * Prevent transcripts from displaying on protected webcomics that
			 * haven't been provided with the proper password. Some notification
			 * could be displayed here letting users know they need to enter a
			 * password to view transcripts.
			 */
		?>
		
	<?php else : ?>
		
		<?php if ( $transcripts = get_webcomic_transcripts() ) : ?>
			
			<?php foreach ( $transcripts as $post ) : setup_postdata( $post ); ?>
				
				<article id="webcomic-transcript-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<div class="post-content">
						
						<?php the_content(); ?>
						
					</div>
					
					<footer class="post-footer">
						
						<?php printf( __( 'Transcribed by %1$s%2$s', 'archimedes' ), WebcomicTag::get_webcomic_transcript_authors(), WebcomicTag::get_the_webcomic_transcript_term_list( 0, 'webcomic_language', __( ' in ', 'archimedes' ), __( ', ', 'archimedes' ), __( '', 'archimedes' ) ) ); ?>
						
					</footer>
					
				</article><!-- #webcomic-transcript-<?php the_ID(); ?> -->
				
			<?php wp_reset_postdata(); endforeach; ?>
			
		<?php elseif ( webcomic_transcripts_open() ) : ?>
			
			<?php /** This is only displayed if no transcripts have been published. */ ?>
			
		<?php endif; ?>
		
		<?php if ( webcomic_transcripts_open() and have_webcomic_transcripts( true ) and $transcripts = get_webcomic_transcripts( true ) ) : ?>
			
			<?php foreach ( $transcripts as $transcript ) : ?>
				
				<?php webcomic_transcript_form( array(), $transcript ); ?>
				
			<?php endforeach; ?>
			
		<?php endif; ?>
		
		<?php webcomic_transcript_form(); ?>
		
	<?php endif; ?>
	
</section><!-- #webcomic-transcripts -->