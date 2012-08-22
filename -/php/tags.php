<?php
/** Contains the ArchimedesTag class and template tag functions.
 * 
 * Theme-specific template tags should go in this file.
 * 
 * @package Archimedes
 */

/** Handle custom template tag functionality.
 * 
 * @package Archimedes
 */
class ArchimedesTag extends Archimedes {
	/** Override the parent constructor. */
	public function __construct(){}
	
	/** Return appropriate `<meta>` description text.
	 * 
	 * @return string
	 */
	public function archimedes_page_description() {
		global $wp_query;
		
		if ( is_singular() and !is_home() ) {
			if ( post_password_required( $wp_query->get_queried_object() ) ) {
				$output = __( 'There is no excerpt because this is a protected post.', 'archimedes' );
			} else if ( !$output = $wp_query->get_queried_object()->post_excerpt ) {
				$output = apply_filters( 'wp_trim_excerpt', wp_trim_words( str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', strip_shortcodes( $wp_query->get_queried_object()->post_content ) ) ), apply_filters( 'excerpt_length', 55 ), apply_filters( 'excerpt_more', ' [...]' ) ) );
			}
		} else if ( is_category() or is_tag() or is_tax() or is_author() ) {
			$output = is_author() ? get_user_meta( $wp_query->get_queried_object()->data->ID, 'description', true ) : $wp_query->get_queried_object()->description;
		} else {
			$output = get_bloginfo( 'description', 'display' );
		}
		
		$output = 140 < strlen( $output = strip_tags( $output ) ) ? esc_attr( substr( $output, 0, 139 ) . '&hellip;' ) : esc_attr( $output );
		
		return $output;
	}
	
	/** Return posts paged navigation.
	 * 
	 * @param mixed $class CSS classes or an array of classes to add to the <nav> element.
	 * @param array $args An array of arguments to pass to either `paginate_links` or `get_posts_nav_link`.
	 * @param boolean $paged Whether to display paged navigation.
	 * @return string
	 */
	public static function archimedes_posts_nav( $class = '', $args = array(), $paged = false ) {
		global $wp_query;
	
		if ( $wp_query->max_num_pages > 1 ) {
			return sprintf( '<nav role="navigation" class="posts%s">%s</nav>%s',
				$class ? ' ' . join( ' ', ( array ) $class ) : '',
				$paged ? preg_replace( '/>...</', '>&hellip;<', paginate_links( array_merge( array(
					'base'    => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
					'total'   => $wp_query->max_num_pages,
					'format'  => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) )
				), ( array ) $args ) ) )
				: get_posts_nav_link( ( array ) $args ),
				$class ? sprintf( '<!-- .posts%s -->', ' .' . str_replace( ' ', ' .', join( ' .', ( array ) $class ) ) ) : ''
			);
		}
	}
	
	/** Return comments paged navigation.
	 * 
	 * @param mixed $class CSS classes or an array of classes to add to the <nav> element.
	 * @param mixed $paged An array of arguments to pass to `paginate_comments_link`, or true to enable pagination with default arguments.
	 * @param string $previous Label to use for the previous comments page link when not using `paginate_comments_link`.
	 * @param string $next Label to use for the next comments page link when not using `paginate_comments_link`.
	 * @return string
	 */
	public static function archimedes_comments_nav( $class = '', $paged = array(), $previous = '', $next = '' ) {
		if ( 1 < get_comment_pages_count() and get_option( 'page_comments' ) ) {
			return sprintf( '<nav role="navigation" class="comments%s">%s</nav>%s',
				$class ? ' ' . join( ' ', ( array ) $class ) : '',
				$paged ? paginate_comments_links( array_merge( array(
					'echo' => false
				), ( array ) $paged ) )
				: get_previous_comments_link( $previous ) . get_next_comments_link( $next ),
				$class ? sprintf( '<!-- .comments%s -->', ' .' . str_replace( ' ', ' .', join( ' .', ( array ) $class ) ) ) : ''
			);
		}
	}
	
	/** Return post meta information.
	 * 
	 * @return string
	 */
	public static function archimedes_post_meta() {
		global $post;
		
		$edit_post_link = current_user_can( 'edit_post' ) ? sprintf( __( '<a href="%s" class="post-edit-link">Edit This</a>', 'archimedes' ), get_edit_post_link() ) : '';
		
		return is_attachment() ? sprintf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a> in <a href="%5$s" title="Return to %6$s" rel="gallery">%7$s</a>%8$s', 'webcomic' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_permalink( $post->post_parent ) ),
			esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
			get_the_title( $post->post_parent ),
			$edit_post_link
		) : sprintf( __( '<a href="%1$s" rel="author">%2$s</a> on <a href="%3$s" title="%4$s" rel="bookmark"><time datetime="%5$s" pubdate>%6$s</time></a>%7$s', 'archimedes' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author(),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			$edit_post_link
		);
	}
	
	/** Return a unique search form ID.
	 * 
	 * @param boolean $add Increment the counter.
	 * @return string
	 */
	public static function archimedes_search_id( $add = true ) {
		static $count = 0;
		
		if ( $add ) {
			$count++;
		}
		
		return "s{$count}";
	}
	
	/** Return copyright notice.
	  * 
	 * @param integer $user User ID to use for the copyright name.
	 * @return string
	 */
	public static function archimedes_copyright( $user = 0 ) {
		global $wpdb;
		
		$end    = date( 'Y' );
		$start  = $wpdb->get_results( "SELECT YEAR( min( post_date ) ) AS year FROM {$wpdb->posts} WHERE post_status = 'publish'" );
		$output = sprintf( '&copy; %1$s %2$s',
			$start[ 0 ]->year === $end ? $end : $start[ 0 ]->year . '&ndash;' . $end,
			( $author = get_userdata( $user ) ) ? ' ' . $author->display_name : get_bloginfo( 'name', 'display' )
		);
		
		return $output;
	}
	
	/** Render a comment.
	 * 
	 * @param object $comment Comment data object.
	 * @param array $args Array of arguments passed to `wp_list_comments`.
	 * @param integer $depth Depth of comment in reference to parents.
	 */
	public static function archimedes_start_comment( $comment, $args, $depth ) {
		$GLOBALS[ 'comment' ] = $comment;
		?>
		<article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<footer class="comment-footer">
				<?php
					printf( __( '%1$s%2$s on <a href="%3$s"><time datetime="%4$s" pubdate>%5$s @ %6$s</time></a>', 'archimedes' ),
						$args[ 'avatar_size' ] ? get_avatar( $comment, $args[ 'avatar_size' ] ) : '',
						get_comment_author_link(),
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						get_comment_date(),
						get_comment_time()
					);
				?>
				<?php edit_comment_link(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ); ?>
			</footer><!-- .comment-footer -->
			<?php if ( !$comment->comment_approved ) : ?>
				<div class="moderating"><?php _e( 'Your comment is awaiting moderation.', 'archimedes' ); ?></div><!-- .moderating -->
			<?php endif; ?>
			<div class="comment-content"><?php comment_text(); ?></div><!-- .comment-content -->
		<?php
	}
	
	/** Render a comment closing tag.
	 * 
	 * @param object $comment Comment data object.
	 * @param array $args Array of arguments passed to `wp_list_comments`.
	 * @param integer $depth Depth of comment in reference to parents.
	 */
	public static function archimedes_end_comment( $comment, $args, $depth ) {
		?>
		</article><!-- #comment-<?php comment_ID(); ?> -->
		<?php
	}
}

if ( !function_exists( 'archimedes_page_description' ) ) {
	/** Render appropriate `<meta>` description text.
	 * 
	 * @uses ArchimedesTag::archimedes_page_description()
	 */
	function archimedes_page_description() {
		echo ArchimedesTag::archimedes_page_description();
	}
}

if ( !function_exists( 'archimedes_posts_nav' ) ) {
	/** Render posts page navigation.
	 * 
	 * @param mixed $class CSS classes or an array of classes to add to the <nav> element.
	 * @param array $args An array of arguments to pass to either `paginate_links` or `get_posts_nav_link`.
	 * @param boolean $paged Whether to display paged navigation.
	 * @uses ArchimedesTag::archimedes_posts_nav()
	 */
	function archimedes_posts_nav( $class = '', $args = array(), $paged = false ) {
		echo ArchimedesTag::archimedes_posts_nav( $class, $args, $paged );
	}
}

if ( !function_exists( 'archimedes_comments_nav' ) ) {
	/** Render comments paged navigation.
	 * 
	 * @param mixed $class CSS classes or an array of classes to add to the <nav> element.
	 * @param mixed $paged An array of arguments to pass to `paginate_comments_link`, or true to enable pagination with default arguments.
	 * @param string $previous Label to use for the previous comments page link when not using `paginate_comments_link`.
	 * @param string $next Label to use for the next comments page link when not using `paginate_comments_link`.
	 * @uses ArchimedesTag::archimedes_comments_nav()
	 */
	function archimedes_comments_nav( $class = '', $paged = array(), $previous = '', $next = '' ) {
		echo ArchimedesTag::archimedes_comments_nav( $class, $paged, $previous, $next );
	}
}

if ( !function_exists( 'archimedes_post_meta' ) ) {
	/** Render post meta information.
	 * 
	 * @uses ArchimedesTag::archimedes_post_meta()
	 */
	function archimedes_post_meta() {
		echo ArchimedesTag::archimedes_post_meta();
	}
}

if ( !function_exists( 'archimedes_search_id' ) ) {
	/** Render a unique search form ID.
	 * 
	 * @param boolean $add Increment the counter.
	 * @uses ArchimedesTag::archimedes_search_id()
	 */
	function archimedes_search_id( $add = true ) {
		echo ArchimedesTag::archimedes_search_id( $add );
	}
}
	
if ( !function_exists( 'archimedes_copyright' ) ) {
	/** Render copyright notice.
	 * 
	 * @param integer $user User ID to use for the copyright name.
	 * @uses ArchimedesTag::archimedes_copyright()
	 */
	function archimedes_copyright( $user = 0 ) {
		echo ArchimedesTag::archimedes_copyright( $user );
	}
}

if ( !function_exists( 'archimedes_start_comment' ) ) {
	
	/** Render a comment.
	 * 
	 * @param object $comment Comment data object.
	 * @param array $args Array of arguments passed to `wp_list_comments`.
	 * @param integer $depth Depth of comment in reference to parents.
	 * @uses ArchimedesTag::archimedes_start_comment()
	 */
	function archimedes_start_comment( $comment, $args, $depth ) {
		ArchimedesTag::archimedes_start_comment( $comment, $args, $depth );
	}
}

if ( !function_exists( 'archimedes_end_comment' ) ) {
	/** Render a comment closing tag.
	 * 
	 * @param object $comment Comment data object.
	 * @param array $args Array of arguments passed to `wp_list_comments`.
	 * @param integer $depth Depth of comment in reference to parents.
	 * @uses ArchimedesTag::archimedes_end_comment()
	 */
	function archimedes_end_comment( $comment, $args, $depth ) {
		ArchimedesTag::archimedes_end_comment( $comment, $args, $depth );
	}
}

if ( !function_exists( 'is_a_webcomic' ) ) {
	/** Always return false if Webcomic isn't active. */
	function is_a_webcomic() {
		return false;
	}
}

if ( !function_exists( 'is_webcomic' ) ) {
	/** Always return false if Webcomic isn't active. */
	function is_webcomic() {
		return false;
	}
}