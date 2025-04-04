<?php

namespace HugeAddons;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Loader {

    public function init() {
        // Register the custom widget category
        $this->register_widget_category();

        // Hook to register widgets once Elementor is initialized
        add_action( 'elementor/widgets/register', [$this, 'register_widgets'] );

        // Hook for admin-specific functionality (if any)
        if ( is_admin() ) {
            $this->init_admin();
        }
    }

    private function register_widget_category() {
        add_action( 'elementor/elements/categories_registered', function ( $elements_manager ) {
            $$elements_manager->add_category(
                'ha-addons-category',
                [
                    'title' => __( 'Huge Addons', 'huge-addons' ),
                    'icon'  => 'fa fa-plug',
                ]
            );
        } );
    }

    public function register_widgets( $widgets_manager ) {
        $widget_files = glob( __DIR__ . '/widgets/*.php' );

        foreach ( $widget_files as $file ) {
            require_once $file;

            $class_name = $this->get_class_name_from_file( $file );

            if ( class_exists( $class_name ) ) {
                $widgets_manager->register( new $class_name() );
                $this->enqueue_widget_assets( $class_name );
            }
        }
    }

    private function enqueue_widget_assets( $class_name ) {
        $widget_name = strtolower( str_replace( '_', '-', $this->get_widget_name( $class_name ) ) );

        $css_url = HA_URL . "assets/css/{$widget_name}.css";
        $js_url = HA_URL . "assets/js/{$widget_name}.js";

        $css_file_path = HA_PATH . "assets/css/{$widget_name}.css";
        $js_file_path = HA_PATH . "assets/js/{$widget_name}.js";

        add_action( 'elementor/frontend/after_enqueue_scripts', function () use ( $widget_name, $css_file_path, $js_file_path, $css_url, $js_url ) {
            if ( file_exists( $css_file_path ) ) {
                wp_enqueue_style( 'ha-' . $widget_name, $css_url, [], '1.0.0' );
            }

            if ( file_exists( $js_file_path ) ) {
                wp_enqueue_script( 'ha-' . $widget_name, $js_url, ['jquery'], '1.0.0', true );
            }
        } );

        add_action( 'elementor/editor/after_enqueue_scripts', function () use ( $widget_name, $css_file_path, $js_file_path, $css_url, $js_url ) {
            if ( file_exists( $css_file_path ) ) {
                wp_enqueue_style( 'ha-' . $widget_name, $css_url, [], '1.0.0' );
            }

            if ( file_exists( $js_file_path ) ) {
                wp_enqueue_script( 'ha-' . $widget_name, $js_url, ['jquery'], '1.0.0', true );
            }
        } );

        $this->conditionally_enqueue_slick( $widget_name );
    }

    private function conditionally_enqueue_slick( $widget_name ) {
        $widgets_using_swiper = ['post-carousel', 'image-carousel', 'testimonials-slider', 'ef-service-list-widget'];

        if ( in_array( $widget_name, $widgets_using_swiper, true ) ) {
            add_action( 'elementor/frontend/after_enqueue_scripts', function () {
                wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', [], '8.0.0' );
                wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], '8.0.0', true );
            } );

            add_action( 'elementor/editor/after_enqueue_scripts', function () {
                wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', [], '8.0.0' );
                wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], '8.0.0', true );
            } );
        }
    }

    private function get_widget_name( $class_name ) {
        $base_class_name = substr( strrchr( $class_name, '\\' ), 1 );
        return strtolower( str_replace( '_', '-', $base_class_name ) );
    }

    private function init_admin() {
        require_once __DIR__ . '/../admin/Dashboard.php';
        $dashboard = new Admin\Dashboard();
        $dashboard->init();
    }

    private function get_class_name_from_file( $file ) {
        $base_name = basename( $file, '.php' );
        return 'HugeAddons\\Widgets\\' . $base_name;
    }
}
