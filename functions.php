<?php
/** Set the content width */
if ( !isset( $content_width ) ) $content_width = 640;

/** Load the core */
if ( !class_exists( 'mgs_core' ) ) require_once( 'includes/mgs-core.php' );

/** Defines all theme functionality, extending mgs_core */
class inkblot extends mgs_core {
	/** Override mgs_core variables */
	protected $name    = 'archimedes';
	protected $version = '3.0.5';
	protected $file    = __FILE__;
	protected $type    = 'theme';
	
	function hook_webcomic_initialize() {  }
	
	/** Run-once installation */
	function install() {
		$this->option( array(
			'version' => $this->version
		) );
	}
	
	/** Upgrade older versions */
	function upgrade() {
		$this->option( 'version', $this->version );
	}
	
	/** Downgrades newer versions */
	function downgrade() {
		$this->option( 'version', $this->version );
	}
	
	/** Uninstall the theme */
	function uninstall() {
		$this->option( array(
			'version'   => $this->version,
			'uninstall' => true
		) );
	}
	
	
	
	////
	// Hooks - These functions hook into WordPress to add, change, and remove functionality.
	////
	
	/** Add standard features */
	function hook_after_setup_theme() {
		$this->domain();
		
		//remove_action( 'wp_head', 'rsd_link' );
		//remove_action( 'wp_head', 'wlwmanifest_link' );
		
		define( 'HEADER_IMAGE', '%s/includes/images/header.jpg' );
		define( 'HEADER_TEXTCOLOR', '333' );
		define( 'HEADER_IMAGE_WIDTH', 960 );
		define( 'HEADER_IMAGE_HEIGHT', 96 );
		
		set_post_thumbnail_size( 150, 150, true );
		
		add_editor_style( 'style-editor.css' );
		add_theme_support( 'nav-menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_custom_background( array( &$this, 'custom_background' ) );
		add_custom_image_header( array( &$this, 'custom_header' ), array( &$this, 'admin_custom_header' ) );
		
		register_nav_menus( array(
			'navbar' => __( 'Navbar', 'archimedes' )
		) );
		
		register_default_headers( array (
			'default' => array (
				'url'           => '%s/includes/images/headers/header.png',
				'thumbnail_url' => '%s/includes/images/headers/thumbs/header.png',
				'description'   => ucwords( str_replace( '_', ' ', $this->name ) )
			)
		) );
	}
	
	/** Add theme scripts */
	function hook_template_redirect() {
		if ( is_singular() ) wp_enqueue_script( 'comment-reply', '', '', '', true );
	}
	
	/** Add widgetized areas */
	function hook_init() {
		$sidebars = array(
			'archimedes-sidebar' => array( __( 'Sidebar', 'archimedes' ), __( 'A widgetized sidebar for adding various widgets to.', 'archimedes' ) )
		);
		
		foreach ( $sidebars as $k => $v ) register_sidebar( array( 'id' => $k, 'name' => $v[ 0 ], 'description' => $v[ 1 ], 'before_widget' => '<figure id="%s" class="widget %s">', 'after_widget' => '</figure>', 'before_title' => '<figcaption>', 'after_title' => '</figcaption>' ) );
	}
	
	/** Add custom body classes */
	function hook_body_class( $classes ) {
		global $is_lynx, $is_gecko, $is_winIE, $is_macIE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		
		if ( $is_lynx )       $classes[] = 'browser-lynx';
		elseif ( $is_gecko )  $classes[] = 'browser-gecko';
		elseif ( $is_winIE )  $classes[] = 'browser-winie';
		elseif ( $is_macIE )  $classes[] = 'browser-macie';
		elseif ( $is_opera )  $classes[] = 'browser-oepra';
		elseif ( $is_NS4 )    $classes[] = 'browser-netscape';
		elseif ( $is_safari ) $classes[] = 'browser-safari';
		elseif ( $is_chrome ) $classes[] = 'browser-chrome';
		else                  $classes[] = 'browser-unknown';
		
		if ( $is_iphone ) $classes[] = 'device-iphone';
		
		return $classes;
	}
	
	/** Add custom bloginfo */
	function hook_bloginfo( $r, $s ) {
		global $wpdb, $wp_query;
		
		if ( 'meta_description' == $s ) {
			if ( is_single() || is_attachment() || is_page() )
				$r = ( get_the_excerpt() ) ? get_the_excerpt() : wp_trim_excerpt( '' );
			elseif ( is_category() || is_tag() || is_tax() || is_author() ) {
				$o = $wp_query->get_queried_object();
				$r = implode( ' ', array_slice( explode( ' ', trim( htmlentities( strip_tags( $o->description ) ) ) ), 0, apply_filters( 'excerpt_length', 55 ) ) );
			} else
				$r = get_option( 'blogdescription' );
		} elseif ( 'copyright' == $s ) {
			$c = current( $wpdb->get_results( "SELECT YEAR( min( post_date ) ) AS start, YEAR( max( post_date ) ) AS end FROM $wpdb->posts WHERE post_status = 'publish'" ) );
			$r = ( $c->start == $c->end ) ? "&copy; $c->end" : "&copy; $c->start &ndash; $c->end";
		}
		
		return $r;
	}
	
	/** Add custom url bloginfo */
	function hook_bloginfo_url( $r, $s ) {
		if ( 'icon_url' == $s )
			$r = $this->url . '/includes/images/icon.png';
		
		return $r;
	}
	
	/** Add theme avatar */
	function hook_avatar_defaults( $d ) {
		$d[ $this->url . '/includes/images/avatar.png' ] = ucwords( str_replace( '_', ' ', $this->name ) );
		
		return $d;
	}
	
	/** Remove the generator <meta> field
	function hook_the_generator() {
		return false;
	}
	
	/** Remove recent comments widget styles */
	function hook_widgets_init() {
		global $wp_widget_factory;
		
		remove_action( 'wp_head', array( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ], 'recent_comments_style' ) );
	}
	
	/** Change wp_title for better search engine optimization */
	function hook_wp_title( $title, $sep, $seplocation ) {
		global $paged, $page;
		
		$a = explode( " $sep ", $title );
		$p = ( 1 < $paged || 1 < $page ) ? sprintf( __( 'Page %s', 'archimedes' ), max( $paged, $page ) ) : '';
		$n = array( $p, get_bloginfo( 'name', 'display' ), get_bloginfo( 'description', 'display' ) );
		
		if ( !is_home() || !is_front_page() )
			unset( $n[ 2 ] );
		
		$a = ( 'right' == $seplocation ) ? array_merge( $a, $n ) : array_merge( $n, $a );
		
		foreach ( $a as $k => $v )
			if ( !$v )
				unset( $a[ $k ] );
		
		return implode( " $sep ", $a );
	}
	
	/** Change the exceprt word length */
	function hook_excerpt_length( $l ) {
		return 60;
	}
	
	/** Change the excerpt 'Read More' link */
	function hook_excerpt_more( $m ) {
		return ' <a href="' . get_permalink() . '" title="' . __( 'Continue reading', 'archimedes' ) . '">&hellip;</a>';
	}
	function hook_custom_excerpt_more( $o ) {
		if ( has_excerpt() && !is_attachment() )
			$o .= ' <a href="' . get_permalink() . '" title="' . __( 'Continue reading', 'archimedes' ) . '">&hellip;</a>';
		
		return $o;
	}
	
	/** Change the gallery shortcode to use HTML5 */
	function hook_post_gallery( $null, $attr ) {
		global $post, $wp_locale;
		static $instance = 0; $instance++;
		
		if ( isset( $attr[ 'orderby' ] ) ) {
			$attr[ 'orderby' ] = sanitize_sql_orderby( $attr[ 'orderby' ] );
			
			if ( empty( $attr[ 'orderby' ] ) )
				unset( $attr[ 'orderby' ] );
		}
		
		extract( shortcode_atts( array(
			'id'         => $post->ID,
			'size'       => 'thumbnail',
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'itemtag'    => 'figure',
			'icontag'    => 'div',
			'include'    => false,
			'exclude'    => false,
			'columns'    => false,
			'captiontag' => 'figcapture'
		), $attr ) );
		
		$id          = intval( $id );
		$orderby     = ( 'RAND' == $order ) ? 'none' : $orderby;
		$attachments = array();
		$itemtag     = tag_escape( $itemtag );
		$captiontag  = tag_escape( $captiontag );
		$columns     = intval( $columns );
		
		if ( !empty( $include ) ) {
			$include      = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
			
			foreach ( $_attachments as $k => $v )
				$attachments[ $v->ID ] = $_attachments[ $k ];
		} elseif ( !empty( $exclude ) ) {
			$exclude     = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		} else
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		
		if ( empty( $attachments ) )
			return false;
		
		if ( is_feed() ) {
			$r = "\n";
			
			foreach ( $attachments as $att_id => $attachment )
				$r .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		} else {
			$i = 0;
			$r = '<div id="gallery-' . $instance . '" class="gallery gallery-' . $id . '">';
			
			foreach ( $attachments as $id => $attachment ) {
				$l  = isset( $attr[ 'link' ] ) && 'file' == $attr[ 'link' ] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
				$r .= '<' . $itemtag . ' class="gallery-item"><' . $icontag . ' class="gallery-icon">' . $l . '</' . $icontag . '>';
				$r .= ( $captiontag && trim( $attachment->post_excerpt ) ) ? '<' . $captiontag . ' class="gallery-caption">' . wptexturize( $attachment->post_excerpt ) . '</' . $captiontag . '></' . $itemtag . '>' : '</' . $itemtag . '>';
				
				$i++;
				
				$r .= ( 0 < $columns && 0 == ( $i % $columns ) ) ? '<hr>' : '';
			}
			
			$r .= '<hr></div>';
			$r  = str_replace( '<hr><hr></div>', '<hr></div>', $r );
		}
		
		return $r;
	}
	
	/** Display standard <head> information */
	function hook_wp_head_0() { ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="description" content="<?php bloginfo( 'meta_description' ); ?>">
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="icon" href="<?php bloginfo( 'icon_url' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
	
	/** Display meta information */
	function hook_wp_meta() { ?>
		<a href="#body" title="Return to Top"><?php bloginfo( 'copyright' ); ?> <?php bloginfo( 'name' ); ?></a> | <?php printf( __( 'Powered by <a href="%s">WordPress</a> with <a href="%s">Webcomic</a> | <a href="%s">Subscribe</a>', 'archimedes' ), 'http://wordpress.org/', 'http://webcomicms.net/', get_bloginfo( 'rss2_url' ) ); ?>
		<?php
		
	}
	
	
	
	////
	// Utilities
	////
	
	/** Display custom background CSS */
	function custom_background() {
		$background = get_background_image();
		$color = get_background_color();
		
		if ( !$background && !$color )
			return false;
		
		switch ( get_theme_mod( 'background_repeat', 'repeat' ) ) {
			case "no-repeat": $repeat = "no-repeat"; break;
			case "repeat-x": $repeat = "repeat-x"; break;
			case "repeat-y": $repeat = "repeat-y"; break;
			default: $repeat = "repeat";
		}
		
		switch ( get_theme_mod( 'background_position', 'left' ) ) {
			case "center": $position = "0 50%"; break;
			case "right": $position = "0 100%"; break;
			default: $position = "0 0";
		}
		
		$attachment = ( 'scroll' == get_theme_mod( 'background_attachment', 'fixed' ) ) ? 'scroll' : 'fixed';
		$image = ( !empty( $background ) ) ? "url($background) $repeat $attachment $position" : '';
		$color = ( !empty( $color ) ) ? "#$color" : '';
		
		echo "<style>html{background:$color $image}</style>";
	}
	
	/** Display custom header CSS */
	function custom_header() {
		$background = ( get_header_image() ) ? '#header hgroup{background:url(' . get_header_image() . ');height:' . HEADER_IMAGE_HEIGHT . 'px;width:' . HEADER_IMAGE_WIDTH . 'px}' : '';
		$color = get_header_textcolor();
		
		if ( !$background && !$color )
			return false;
		
		$text = ( 'blank' == $color ) ? '#header hgroup *{display:none}' : "#header hgroup,#header hgroup a{color:#$color}";
		
		echo '<style>' . $background . $text . "</style>";
	}
	
	/** Display custom header in administrative dashboard CSS */
	function admin_custom_header() {
		echo '<style>#headimg{height:' . HEADER_IMAGE_HEIGHT . 'px;width:' . HEADER_IMAGE_WIDTH . 'px}</style>';
	}
	
	/** Return paginated posts links */
	function get_paginated_posts_links( $args = array() ) {
		global $wp_query, $wp_rewrite;
		
		$p = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
		$defaults = array(
			'base'     => @add_query_arg( 'paged','%#%' ),
			'format'   => false,
			'total'    => $wp_query->max_num_pages,
			'current'  => $p,
			'add_args' => false
		); $args = wp_parse_args( $args, $defaults );
		
		$args[ 'base' ]     = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%', 'page' ) : $args[ 'base' ];
		$args[ 'add_args' ] = ( !empty( $wp_query->query_vars[ 's' ] ) ) ? array( 's' => get_query_var( 's' ) ) : $args[ 'add_args' ];
		
		return preg_replace( '/>...</', '>&hellip;<', paginate_links( $args ) );
	}
} global $archimedes; $archimedes = new inkblot(); //Initialize the theme

/** Displays post comments */
class archimedes_Walker_Comment extends Walker {
	var $tree_type = 'comment';
	var $db_fields = array ( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
	
	function start_lvl( &$output, $depth, $args ) {
		$GLOBALS[ 'comment_depth' ] = $depth++;
	}
	
	function end_lvl( &$output, $depth, $args ) {
		$GLOBALS[ 'comment_depth' ] = $depth++;
	}
	
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( !$element )
			return false;
		
		$id_field = $this->db_fields[ 'id' ];
		$id       = $element->$id_field;
		
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		
		if ( $max_depth <= $depth + 1 && isset( $children_elements[ $id ] ) ) {
			foreach ( $children_elements[ $id ] as $child )
				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
			
			unset( $children_elements[ $id ] );
		}
	}
	
	function start_el( &$output, $comment, $depth, $args ) {
		$depth++;
		
		$GLOBALS[ 'comment' ]       = $comment;
		$GLOBALS[ 'comment_depth' ] = $depth;
		
		extract( $args, EXTR_SKIP );
		
		if ( !$comment->comment_type ) {
		?>
		<article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<footer>
				<?php 
					if ( !empty( $args[ 'avatar_size' ] ) )
						echo get_avatar( $comment, $args[ 'avatar_size' ] );
					
					printf( '<b class="author">%s</b>', get_comment_author_link() );
				?>
				<small>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate><?php printf( '%s @ %s', get_comment_date(),  get_comment_time() ); ?></time></a>
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment-clear', 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ); ?>
					<?php edit_comment_link(); ?>
				</small>
			</footer>
		<?php
			if ( empty( $comment->comment_approved ) )
				echo '<p class="pending">' . __( 'Your comment is awaiting moderation.', 'archimedes' ) . '</p>';
			
			comment_text();
		?>
		<hr id="comment-clear-<?php comment_ID(); ?>">
		<?php } else { ?>
		<article id="pingback-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<footer class="pingback-meta">
				<b><?php comment_type(); ?></b>
				<small><?php comment_author_link(); edit_comment_link ( __( 'edit', 'archimedes') ); ?></small>
			</footer>
			<p><?php comment_author_link();?></p>
		<?php
		}
	}
	
	function end_el( &$output, $comment, $depth, $args ) {
		echo '</article>';
	}
}
?>