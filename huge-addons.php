<?php
/**
 * Plugin Name: Huge Addons for Elementor
 * Description: HugeAddons is easy and must have Elementor Addons for WordPress Page Builder. Clean, Modern, Hand crafted designed Addons blocks.
 * plugin URI: https://themehuge.com/elementor-addons/
 * Author: Themehuge
 * Author URI: https://themehuge.com/
 * Version: 1.0.0
 * Text Domain: huge-addons
 * Domain Path: /languages
 * Requires Plugins: elementor
 * Elementor tested up to: 3.24.4
 * Elementor Pro tested up to: 3.24.2
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$ha_plugin_data = get_file_data(
	__FILE__,
	array(
		'Version'     => 'Version',
		'Plugin Name' => 'Plugin Name',
		'Author'      => 'Author',
		'Description' => 'Description',
		'Plugin URI'  => 'Plugin URI',
	),
	false
);

define('HA', $ha_plugin_data['Plugin Name']);
define('HA_PLUGIN_DESC', $ha_plugin_data['Description']);
define('HA_PLUGIN_AUTHOR', $ha_plugin_data['Author']);
define('HA_PLUGIN_URI', $ha_plugin_data['Plugin URI']);
define('HA_VER', $ha_plugin_data['Version']);
define('HA_BASE', plugin_basename(__FILE__));
define('HA_SLUG', dirname(plugin_basename(__FILE__)));
define('HA_FILE', __FILE__);
define('HA_URL', plugin_dir_url( __FILE__ ) );
define('HA_PATH', plugin_dir_path( __FILE__ ) );
define('HA_WIDGET_PREFIX', 'ha_' ); 


// Require the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Initialize the plugin
use HugeAddons\Loader;

function ha_init() {
	$loader = new HugeAddons\Loader();
	$loader->init();
}
add_action( 'plugins_loaded', 'ha_init' );

function ha_activate() {
	// Perform setup tasks
}
register_activation_hook( __FILE__, 'ha_activate' );

function ha_deactivate() {
	// Perform cleanup tasks
}
register_deactivation_hook( __FILE__, 'ha_deactivate' );

function ha_load_textdomain() {
	load_plugin_textdomain( 'huge-addons', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'ha_load_textdomain' );


// Activation and Deactivation hooks
// if (class_exists('\\HugeAddons\\Loader')) {
// 	register_activation_hook(__FILE__, array('\\HugeAddons\\Loader', 'ha_plugin_activation_hook'));
// 	register_deactivation_hook(__FILE__, array('\\HugeAddons\\Loader', 'ha_plugin_deactivation_hook'));
// }


