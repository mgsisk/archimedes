/** Handle dynamic theme customization previews.
 * 
 * @package Archimedes
 */
( function( $ ) {
	/** Update the site name. */
	wp.customize( 'blogname', function( value ) { value.bind( function( to ) {
		$( '#header h1' ).html( to );
	} ); } );
	
	/** Update the site description. */
	wp.customize( 'blogdescription', function( value ) { value.bind( function( to ) {
		$( '#header h2' ).html( to );
	} ); } );
	
	/** Update the header text color. */
	wp.customize( 'header_textcolor', function( value ) { value.bind( function( to ) {
		if ( 'blank' === to ) {
			$( '#header hgroup' ).hide();
		} else {
			$( '#header hgroup' ).show();
			$( '#header hgroup, #header hgroup a' ).css( 'color', to );
		}
	} ) } );
	
	/** Update the header image. */
	wp.customize( 'header_image', function( value ) { value.bind( function( to ) {
		if ( to && 'remove-header' !== to ) {
			$( '#header hgroup' ).after( '<a href="#"><img src="' + to + '"></a>' );
		} else {
			$( '#header hgroup + a' ).remove();
		}
	} ) } );
	
	/** Update the background color. */
	wp.customize( 'background_color', function( value ) { value.bind( function( to ) {
		$( 'body' ).css( 'background-color', to );
	} ); } );
	
	/** Update the background image. */
	wp.customize( 'background_image', function( value ) { value.bind( function( to ) {
		$( 'body' ).css( 'background-image', to ? 'url(' + to + ')' : 'none' );
	} ); } );
	
	/** Update the background repeat. */
	wp.customize( 'background_repeat', function( value ) { value.bind( function( to ) {
		$( 'body' ).css( 'background-repeat', to );
	} ); } );
	
	/** Update the background position. */
	wp.customize( 'background_position_x', function( value ) { value.bind( function( to ) {
		$( 'body' ).css( 'background-position', 'top ' + to );
	} ); } );
	
	/** Update the background attachment. */
	wp.customize( 'background_attachment', function( value ) { value.bind( function( to ) {
		$( 'body' ).css( 'background-attachment', to );
	} ); } );
} )( jQuery )