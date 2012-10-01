<?php
/** Archimedes theme.
 * 
 * @package Archimedes
 */

/** Set the content width.
 * @var integer
 */
$content_width = isset( $content_width ) ? $content_width : 640;

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
	
	/** Whether the theme is being previewed.
	 * @var boolean
	 */
	protected static $preview = false;
	
	/** Set class properties and register hooks.
	 * 
	 * @uses Archimedes::$dir
	 * @uses Archimedes::$url
	 * @uses Archimedes::widgets_init()
	 * @uses Archimedes::after_setup_theme()
	 * @uses Archimedes::wp_head()
	 * @uses Archimedes::wp_title()
	 * @uses Archimedes::wp_loaded()
	 * @uses Archimedes::customize_head()
	 * @uses Archimedes::wp_enqueue_scripts()
	 * @uses Archimedes::customize_register()
	 * @uses Archimedes::body_class()
	 * @uses archimedes_init()
	 * @uses archimedes_widgets_init()
	 * @uses archimedes_after_setup_theme()
	 * @uses archimedes_wp_loaded()
	 * @uses archimedes_head()
	 * @uses archimedes_title()
	 * @uses archimedes_enqueue_scripts()
	 * @uses archimedes_customize_register()
	 */
	public function __construct() {
		self::$dir = trailingslashit( get_template_directory() );
		self::$url = trailingslashit( get_template_directory_uri() );
		
		add_action( 'wp_head', function_exists( 'archimedes_head' ) ? 'archimedes_head' : array( $this, 'head' ), 0 );
		add_action( 'wp_title', function_exists( 'archimedes_title' ) ? 'archimedes_title' : array( $this, 'title' ), 10, 3 );
		add_action( 'wp_loaded', function_exists( 'archimedes_wp_loaded' ) ? 'archimedes_wp_loaded' : array( $this, 'loaded' ) );
		add_action( 'widgets_init', function_exists( 'archimedes_widgets_init' ) ? 'archimedes_widgets_init' : array( $this, 'widgets_init' ) );
		add_action( 'wp_head', function_exists( 'archimedes_customize_head' ) ? 'archimedes_customize_head' : array( $this, 'customize_head' ) );
		add_action( 'wp_enqueue_scripts', function_exists( 'archimedes_enqueue_scripts' ) ? 'archimedes_enqueue_scripts' : array( $this, 'enqueue_scripts' ) );
		add_action( 'after_setup_theme', function_exists( 'archimedes_after_setup_theme' ) ? 'archimedes_after_setup_theme' : array( $this, 'after_setup_theme' ) );
		add_action( 'customize_register', function_exists( 'archimedes_customize_register' ) ? 'archimedes_customize_register' : array( $this, 'customize_register' ), 10, 1 );
		
		require_once self::$dir . '-/php/tags.php';
		require_once self::$dir . '-/php/config.php'; new ArchimedesConfig;
	}
	
	/** Register widgetized areas.
	 * 
	 * @hook widgets_init
	 */
	public function widgets_init() {
		foreach ( array(
			__( 'Primary Sidebar', 'archimedes' ) => __( 'The primary theme sidebar used on all pages.', 'archimedes' )
		) as $k => $v ) {
			register_sidebar( array(
				'id'            => 'sidebar-' . sanitize_title( $k ),
				'name'          => $k,
				'description'   => $v,
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h1>',
				'after_title'   => '</h1>'
			) );
		}
	}
	
	/** Setup theme features.
	 * 
	 * @uses Archimedes::$dir
	 * @hook after_setup_theme
	 */
	public function after_setup_theme() {
		load_theme_textdomain( 'archimedes', self::$dir . '-/locale' );
		
		add_editor_style();
		
		add_filter( 'use_default_gallery_style', '__return_false' );
		add_filter( 'show_recent_comments_widget_style', '__return_false' );
		
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'status', 'quote', 'video' ) );
		add_theme_support( 'custom-background', array(
			'default-color'    => 'e8e8e8',
			'wp-head-callback' => '__return_false'
		) );
		add_theme_support( 'custom-header', array(
			'width'                  => 640,
			'height'                 => 160,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => '333',
			'wp-head-callback'       => '__return_false',
			'admin-head-callback'    => array( 'ArchimedesAdmin', 'admin_head' ),
			'admin-preview-callback' => array( 'ArchimedesAdmin', 'admin_preview' )
		) );
		
		register_nav_menu( 'primary', __( 'Primary Menu', 'archimedes' ) );
		
		set_post_thumbnail_size( 144, 144 );
	}
	
	/** Render the <head> portion of the page.
	 * 
	 * @uses archimedes_page_description()
	 * @hook wp_head
	 */
	public function head() { ?>
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
	 * @hook wp_title
	 */
	public function title( $title, $sep, $location ) {
		global $page, $paged;
		
		$name        = get_bloginfo( 'name' );
		$title       = explode( " {$sep} ", $title );
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
	
	/** Generate custom stylesheet.
	 * 
	 * It would be better to handle this with an `init` hook, but we
	 * need `get_theme_mod` to function properly for the theme
	 * customizer.
	 * 
	 * @uses Archimedes::$dir
	 * @action wp_loaded
	 */
	public function loaded() {
		if ( !empty( $_GET[ 'archimedes_custom_styles' ] ) ) {
			header( 'Content-Type: text/css' );
			
			require_once self::$dir . '-/php/style.php';
			
			die;
		}
	}
	
	/** Include customized styles inline.
	 * 
	 * We need to do this while previewing to ensure customizations show
	 * up properly if the user navigates through the theme preview.
	 * 
	 * @uses Archimedes::$dir
	 * @hook wp_head
	 */
	public function customize_head() {
		if ( self::$preview ) {
			echo '<style>';
			
			require_once self::$dir . '-/php/style.php';
			
			echo '</style>';
		}
	}
	
	/** Enqueue scripts and stylesheets.
	 * 
	 * @uses Archimedes::$url
	 * @uses Archimedes::$preview
	 * @hook wp_enqueue_scripts
	 */
	public function enqueue_scripts() {
		wp_register_style( 'archimedes-normalize', self::$url . '-/css/normalize.css' );
		wp_register_style( 'archimedes-theme', get_stylesheet_uri(), array( 'archimedes-normalize' ) );
		wp_register_script( 'jquery', '', '', '', true);
		
		wp_enqueue_script( 'modernizr', self::$url . '-/js/modernizr.js' );
		
		wp_enqueue_style( 'archimedes-custom', add_query_arg( array( 'archimedes_custom_styles' => true ), home_url( '/' ) ), array( 'archimedes-theme' ) );
		
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		if ( self::$preview ) {
			wp_enqueue_script( 'archimedes-preview', self::$url . '-/js/admin-preview.js', '', '', true );
		}
	}
	
	/** Set the Archimedes::$preview variable.
	 * 
	 * @param object $customize WordPress theme customization object.
	 * @uses Archimedes::preview_scripts
	 * @hook customize_register
	 */
	public function customize_register( $customize ) {
		self::$preview = $customize->is_preview();
	}
}

if ( is_admin() ) { // Load and instantiate the administrative class.
	require_once dirname( __FILE__ ) . '/-/php/admin.php'; new ArchimedesAdmin;
} else { // Instantiate the standard class.
	new Archimedes;
}