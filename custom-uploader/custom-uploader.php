<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://americodias.com
 * @since             1.0.0
 * @package           Custom_Uploader
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Uploader
 * Plugin URI:        http://americodias.com
 * Description:       Implementation of a custom image upload solution that can post to WordPress, Facebook, and Tumblr. It can take full advantage of the Eram Theme and the image galleries implemented on it. It is also compatible with the Exifography plugin.
 * Version:           1.1.0
 * Author:            Américo Dias
 * Author URI:        http://americodias.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-uploader
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-uploader-activator.php
 */
function activate_custom_uploader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-uploader-activator.php';
	Custom_Uploader_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-uploader-deactivator.php
 */
function deactivate_custom_uploader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-uploader-deactivator.php';
	Custom_Uploader_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_uploader' );
register_deactivation_hook( __FILE__, 'deactivate_custom_uploader' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-uploader.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_uploader() {

	$plugin = new Custom_Uploader();
	$plugin->run();

}
run_custom_uploader();
