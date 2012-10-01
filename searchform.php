<?php
/** Search form template.
 * 
 * @package Archimedes
 * @uses archimedes_search_id()
 */
?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search">
	<label for="<?php archimedes_search_id(); ?>" class="ghost focus"><?php _e( 'Search', 'archimedes' ); ?></label>
	<input type="search" id="<?php archimedes_search_id( false ); ?>" name="s" placeholder="<?php esc_attr_e( 'Search', 'archimedes' ); ?>">
	<button type="submit"><?php _e( 'Search', 'archimedes' ); ?></button>
</form><!-- .search -->