<?php

namespace HugeAddons\Admin; // Updated namespace to HugeAddons\Admin

class Dashboard {

    public function init() {
        add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
    }

    public function add_admin_menu() {
        add_menu_page(
            __( 'Huge Addons', 'huge-addons' ), // Updated text domain to huge-addons
            __( 'Huge Addons', 'huge-addons' ), // Updated text domain to huge-addons
            'manage_options',
            'huge-addons', // Updated slug to huge-addons
            [ $this, 'render_dashboard' ],
            'dashicons-admin-generic'
        );
    }

    public function render_dashboard() {
        require_once __DIR__ . '/views/dashboard.php';
    }
}
