<?php
/** Contains the ArchimedesAdmin class.
 * 
 * Functions specific to the administrative dashboard should be
 * placed in this class so they aren't loaded every time any
 * non-administrative page is accessed.
 * 
 * @package Archimedes
 */

/** Handle general administrative tasks.
 * 
 * @package Archimedes
 */
class ArchimedesAdmin extends Archimedes {
	/** Register hooks and istantiate the administrative classes. */
	public function __construct() {
		parent::__construct();
	}
	
	/** Render inline styles for admin header customization. */
	public static function admin_header_style() { ?>
		<style>
			.appearance_page_custom-header #headimg {
				border: none;
				box-shadow: 0 0 .25em rgba( 0, 0, 0, .25 );
			}
			
			#headimg {
				position: relative;
			}
			
			#headimg img {
				vertical-align: bottom;
			}
			
			#name {
				display: block;
				font: bold 200%/1 'Helvetica Neue', Helvetica, sans-serif;
				margin: 0;
			}
			
			#desc {
				display: block;
				font: bold 150%/1 'Helvetica Neue', Helvetica, sans-serif;
				margin: 0;
				text-shadow: none;
			}
			
			#headimg a {
				text-decoration: none;
			}
			
			#headimg img {
				max-width: 1000px;
				height: auto;
				width: 100%;
			}
			<?php
				if ( get_header_image() ) {
					echo '#headimg div { margin: 1.5em; position: absolute; }';
				}
				
				if ( get_theme_support( 'custom-header', 'default-text-color' ) !== get_header_textcolor() ) {
					printf( '#name, #desc { color: #%s }', get_header_textcolor() );
				}
			?>
		</style>
	<?php
	}
	
	/** Render customized header in the admin dashboard. */
	public static function admin_header_preview() {
		$color = get_header_textcolor();
		$style = ( 'blank' === $color or '' === $color ) ? 'display:none !important;visibility:hidden' : "color:#{$color}";
		?>
		<div id="headimg">
			<div>
				<a id="name" href="#" onClick="return false;" style="<?php echo $style; ?>"><?php bloginfo( 'name' ); ?></a>
				<span id="desc" style="<?php echo $style; ?>"><?php bloginfo( 'description' ); ?></span>
			</div>
			<?php echo ( $image = get_header_image() ) ? sprintf( '<img src="%s" alt="%s">', $image, esc_attr( get_bloginfo( 'name' ) ) ) : ''; ?>
		</div>
		<?php
	}
}