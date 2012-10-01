<?php
/** Contains the ArchimedesConfig and custom control classes.
 * 
 * @package Archimedes
 */

/** Handle configuration tasks.
 * 
 * @package Archimedes
 */
class ArchimedesConfig extends Archimedes {
	/** Register hooks.
	 * 
	 * @uses ArchimedesConfig::customize_register()
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ), 10, 1 );
	}
	
	/** Register theme customization sections, settings, and controls.
	 * 
	 * Because we're not using the standard callbacks (to avoid a lot of
	 * ugly inline CSS in our page headers) we have to change the
	 * transport for a number of default theme mods, then handle preview
	 * updates in the `-/js/admin-preview.js` file.
	 * 
	 * @param object $customize WordPress theme customization object.
	 */
	public function customize_register( $customize ) {
		foreach ( array( 'blogname', 'blogdescription', 'header_textcolor', 'header_image', 'background_color', 'background_image', 'background_repeat', 'background_position_x', 'background_attachment' ) as $v ) {
			$customize->get_setting( $v )->transport = 'postMessage';
		}
		
		$customize->add_section( 'archimedes_miscellanea', array( 'title' => __( 'Miscellanea', 'archimedes' ), 'priority' => 999 ) );
		$customize->add_setting( 'uninstall', array( 'default' => false ) );
		
		$customize->add_control( 'uninstall', array(
			'type'    => 'checkbox',
			'label'   => __( 'Remove theme modifications when changing themes', 'archimedes' ),
			'section' => 'archimedes_miscellanea'
		) );
	}
}