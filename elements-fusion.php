<?php
/**
 * Plugin Name: Elements Fusion
 * Description: A custom Elementor widget bundle for WordPress.
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: elements-fusion
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Require the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Initialize the plugin
use ElementsFusion\Loader;

define( 'ELEMENTS_FUSION_URL', plugin_dir_url( __FILE__ ) );
define( 'ELEMENTS_FUSION_PATH', plugin_dir_path( __FILE__ ) );
define( 'ELEMENTS_FUSION_WIDGET_PREFIX', 'ef_' ); // Prefix for all widgets


function elements_fusion_init() {
    $loader = new Loader();
    $loader->init();
}
add_action( 'plugins_loaded', 'elements_fusion_init' );