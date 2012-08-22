<?php
/** Search form template.
 * 
 * @package Archimedes
 */
?>

<form action="<?php echo esc_url( home_url() ); ?>" role="search" class="search">
	
	<label for="<?php archimedes_search_id(); ?>" class="mask focus"><?php _e( 'Search', 'archimedes' ); ?></label>
	
	<input type="search" name="s" id="<?php archimedes_search_id( false ); ?>" placeholder="<?php esc_attr_e( 'Search', 'archimedes' ); ?>">
	
	<button type="submit"><?php _e( 'Search', 'archimedes' ); ?></button>
	
</form><!-- .search -->