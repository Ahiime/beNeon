<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://blyd3d.com
 * @since             1.0.0
 * @package           Beneon
 *
 * @wordpress-plugin
 * Plugin Name:       BeNeon
 * Plugin URI:        https://github.com/Ahiime/beNeon
 * Description:       Transform your online store with BeNeon, the ultimate plugin for creating custom 2D and 3D neon signs. Perfect for e-commerce owners, Beneon allows easy configuration of neon lights that can be directly used by factories. Offer your customers a unique real-time customization experience. Download BeNeon now and boost your sales with bespoke neon signs!
 * Version:           1.0.0
 * Author:            BLYD3D
 * Author URI:        https://blyd3d.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       beneon
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BENEON_VERSION', '1.0.0' );

/**
 * The plugin dir url.
 */
define( 'BENEON_URL', plugins_url( '/', __FILE__ ) );

/**
 * The plugin dir path.
 */
define( 'BENEON_DIR', __DIR__ );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-beneon-activator.php
 */
function activate_beneon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-beneon-activator.php';
	Beneon_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-beneon-deactivator.php
 */
function deactivate_beneon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-beneon-deactivator.php';
	Beneon_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_beneon' );
register_deactivation_hook( __FILE__, 'deactivate_beneon' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-beneon.php';

/**
 * This utils functions.
 */
require plugin_dir_path( __FILE__ ) . 'includes/utils.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_beneon() {

	$plugin = new Beneon();
	$plugin->run();
}
run_beneon();
