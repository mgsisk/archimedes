<?php
/** Archimedes theme.
 * 
 * @package Archimedes
 */

/** Set the content width.
 * @var integer
 */
$content_width = isset( $content_width ) ? $content_width : 960;

/** Initialize the theme.
 * 
 * @package Archimedes
 */
class Archimedes {
	/** Internal version number.
	 * @var string
	 */
	protected static $version = '4';
	
	/** Absolute path to the theme directory.
	 * @var string
	 */
	protected static $dir = '';
	
	/** URL to the theme directory.
	 * @var string
	 */
	protected static $url = '';
	
	/** Set class properties and register hooks.
	 * 
	 * All of the hooks defined here can be overridden by creating
	 * functions of the appropriate name.
	 * 
	 * @uses Archimedes::$dir
	 * @uses Archimedes::$url
	 * @uses Archimedes::$config
	 * @uses Archimedes::widgets_init()
	 * @uses Archimedes::after_setup_theme()
	 * @uses Archimedes::wp_head()
	 * @uses Archimedes::wp_title()
	 * @uses Archimedes::wp_enqueue_scripts()
	 * @uses Archimedes::wp_page_menu_args()
	 * @uses Archimedes::excerpt_more()
	 * @uses Archimedes::excerpt_length()
	 * @uses Archimedes::get_the_excerpt()
	 */
	public function __construct() {
		self::$dir = trailingslashit( get_template_directory() );
		self::$url = trailingslashit( get_template_directory_uri() );
		
		add_action( 'widgets_init', function_exists( 'archimedes_widgets_init' ) ? 'archimedes_widgets_init' : array( $this, 'widgets_init' ) );
		add_action( 'after_setup_theme', function_exists( 'archimedes_after_setup_theme' ) ? 'archimedes_after_setup_theme' : array( $this, 'after_setup_theme' ) );
		
		if ( !is_admin() ) {
			add_action( 'wp_head', function_exists( 'archimedes_head' ) ? 'archimedes_head' : array( $this, 'wp_head' ), 0 );
			add_action( 'wp_title', function_exists( 'archimedes_title' ) ? 'archimedes_title' : array( $this, 'wp_title' ), 10, 3 );
			add_action( 'wp_enqueue_scripts', function_exists( 'archimedes_enqueue_scripts' ) ? 'archimedes_enqueue_scripts' : array( $this, 'wp_enqueue_scripts' ) );
			
			add_filter( 'wp_page_menu_args', function_exists( 'archimedes_page_menu_args' ) ? 'archimedes_page_menu_args' : array( $this, 'page_menu_args' ) );
			add_filter( 'excerpt_more', function_exists( 'archimedes_excerpt_more' ) ? 'archimedes_excerpt_more' : array( $this, 'excerpt_more' ) );
			add_filter( 'get_the_excerpt', function_exists( 'archimedes_custom_excerpt_more' ) ? 'archimedes_custom_excerpt_more' : array( $this, 'get_the_excerpt' ) );
			
			if ( !is_admin() ) {
				require_once self::$dir . '-/php/tags.php';
			}
		}
	}
	
	/** Register widgetized areas. */
	public function widgets_init() {
		foreach ( array(
			__( 'Primary Sidebar', 'archimedes' )
		) as $sidebar ) {
			register_sidebar( array(
				'id'            => 'sidebar-' . sanitize_title( $sidebar ),
				'name'          => $sidebar,
				'before_widget' => '<aside id="%1$s" role="complementary" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			) );
		}
	}
	
	/** Setup theme features.
	 * 
	 * WordPress' gallery shortcode and recent comments widget inline
	 * styles are removed here as well.
	 * 
	 * @uses Archimedes::$dir
	 * @uses Archimedes::header_style()
	 * @uses Archimedes::admin_header_style()
	 * @uses Archimedes::admin_header_img()
	 * @filter integer archimedes_custom_header_width
	 * @filter integer archimedes_custom_header_height
	 * @filter integer archimedes_post_thumbnail_width
	 * @filter integer archimedes_post_thumbnail_height
	 */
	public function after_setup_theme() {
		load_theme_textdomain( 'archimedes', self::$dir . '-/locale' );
		
		add_filter( 'use_default_gallery_style', '__return_false' );
		add_filter( 'show_recent_comments_widget_style', '__return_false' );
		
		add_editor_style( 'editor.css' );
		
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'status', 'quote', 'video' ) );
		add_theme_support( 'custom-header', array(
			'width'                  => apply_filters( 'archimedes_custom_header_width', 1920 ),
			'height'                 => apply_filters( 'archimedes_custom_header_height', 1080 ),
			'flex-width'             => true,
			'flex-height'            => true,
			'random-default'         => true,
			'default-text-color'     => '333',
			'wp-head-callback'       => function_exists( 'archimedes_header_style' ) ? 'archimedes_header_style' : array( $this, 'header_style' ),
			'admin-head-callback'    => function_exists( 'archimedes_admin_header_style' ) ? 'archimedes_admin_header_style' : array( 'ArchimedesAdmin', 'admin_header_style' ),
			'admin-preview-callback' => function_exists( 'archimedes_admin_header_preview' ) ? 'archimedes_admin_header_preview' : array( 'ArchimedesAdmin', 'admin_header_preview' )
		) );
		
		register_nav_menu( 'primary', __( 'Primary Menu', 'archimedes' ) );
		
		set_post_thumbnail_size( apply_filters( 'archimedes_post_thumbnail_width', 128 ), apply_filters( 'archimedes_post_thumbnail_height', 128 ), true );
	}
	
	/** Render the <head> portion of the page.
	 * 
	 * @uses archimedes_page_description()
	 */
	public function wp_head() { ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="description" content="<?php archimedes_page_description(); ?>">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
		<title><?php wp_title( '|' ); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="author" href="<?php echo get_stylesheet_directory_uri(); ?>/humans.txt">
		<?php
	}
	
	/** Add additional information to page titles.
	 * 
	 * @param string $title The original title.
	 * @param string $sep Separator to place between title elements.
	 * @param string $location Where to place the separator.
	 * @return string
	 */
	public function wp_title( $title, $sep, $location ) {
		global $page, $paged;
		
		$title       = explode( " {$sep} ", $title );
		$name        = get_bloginfo( 'name' );
		$pages       = 2 <= max( $page, $paged ) ? sprintf( __( 'Page %s', 'archimedes' ), max( $paged, $page ) ) : '';
		$description = ( is_home() or is_front_page() ) ? get_bloginfo( 'description', 'display' ) : '';
		
		if ( 'right' === $location ) {
			array_unshift( $title, $description, $name, $pages );
		} else {
			array_push( $title, $pages, $name, $description );
		}
		
		$title = array_filter( $title );
		
		return join( " {$sep} ", $title );
	}
	
	/** Register scripts and stylesheets.
	 * 
	 * The comment reply script is enqueued here and placed in the site
	 * footer instead of the typical:
	 * 
	 * `wp_enqueue_script( 'comment-reply' );`
	 * 
	 * to keep as many scripts as possible at the bottom of the page.
	 * 
	 * @uses Archimedes::$url
	 */
	public function wp_enqueue_scripts() {
		wp_register_style( 'archimedes-normalize', self::$url . '-/css/normalize.css' );
		wp_register_style( 'archimedes-theme', get_bloginfo( 'stylesheet_url' ), array( 'archimedes-normalize' ) );
		
		wp_register_script( 'jquery', '', '', '', true);
		wp_register_script( 'modernizr', self::$url . '-/js/modernizr.js' );
		wp_register_script( 'archimedes-plugins', self::$url . '-/js/plugins.js', array( 'jquery' ), '', true );
		wp_register_script( 'archimedes-scripts', self::$url . '-/js/scripts.js', array( 'jquery', 'modernizr', 'archimedes-plugins' ), '', true );
		
		wp_enqueue_style( 'archimedes-theme' );
		wp_enqueue_script( 'archimedes-scripts' );
		
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply', '', '', '', true );
		}
	}
	
	/** Get wp_page_menu to show a home link.
	 * 
	 * @param array $args The page menu arguments array.
	 * @return array
	 */
	public function page_menu_args( $args ) {
		$args[ 'show_home' ] = true;
		
		return $args;
	}
	
	/** Replace [...] with a "continue reading" link.
	 * 
	 * @uses Archimedes::continue_reading()
	 */
	public function excerpt_more( $more ) {
		return function_exists( 'archimedes_continue_reading' ) ? archimedes_continue_reading : $this->continue_reading();
	}

	/** Add a continue reading link to custom excerpts.
	 * 
	 * @uses Archimedes::continue_reading()
	 */
	public function get_the_excerpt( $output ) {
		return ( has_excerpt() and !is_attachment() ) ? sprintf( "{$output}%s", $this->continue_reading() ) : $output;
	}
	
	/** Return a "continue reading" link for excerpts.
	 * 
	 * @return string
	 */
	public function continue_reading() {
		return sprintf( '<a href="%s" class="continu-reading">&hellip;</a>', esc_url( get_permalink() ) );
	}
	
	/** Render inline styles for customized header. */
	public function header_style() {
		$color = get_header_textcolor();
		
		if ( 'blank' === $color ) {
			echo '<style>#banner hgroup *{border:0;clip:rect(0000);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}</style>';
		} else if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $color ) {
			printf( '<style>#banner hgroup,#banner hgroup a{color:#%s}</style>', $color );
		}
		
		if ( get_header_image() ) {
			echo '<style>#banner hgroup{margin:0 1.5em;position:absolute}</style>';
		}
	}
	
	/** Provides access to the theme configuration.
	 * 
	 * @uses Archimedes::$config
	 * @return array
	 */
	public static function config() {
		return self::$config;
	}
}

if ( is_admin() ) { // Load and instantiate the administrative class.
	require_once '-/php/admin.php'; new ArchimedesAdmin;
} else { // Instantiate the standard class.
	new Archimedes;
}