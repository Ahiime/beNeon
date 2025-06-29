<?php

/**
 * Fired during plugin activation
 *
 * @link       https://blyd3d.com
 * @since      1.0.0
 *
 * @package    Beneon
 * @subpackage Beneon/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Beneon
 * @subpackage Beneon/includes
 * @author     BLYD3D <info@blyd3d.com>
 */
class Beneon_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
        public static function activate() {
                // Create a page for the configurator if it does not exist.
                $page_id = get_option( 'beneon_configurator_page_id' );

                if ( ! $page_id || ! get_post( $page_id ) ) {
                        $page = get_page_by_path( 'neon-configurator' );

                        if ( ! $page ) {
                                $page_id = wp_insert_post( array(
                                        'post_title'   => 'Neon Configurator',
                                        'post_name'    => 'neon-configurator',
                                        'post_content' => '[beneon_configurator]',
                                        'post_status'  => 'publish',
                                        'post_type'    => 'page',
                                ) );
                        } else {
                                $page_id = $page->ID;
                        }

                        if ( $page_id ) {
                                update_option( 'beneon_configurator_page_id', $page_id );
                        }
                }

        }

}
