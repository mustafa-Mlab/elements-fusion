<?php

namespace ElementsFusion\Admin;

class Dashboard {

    public function init() {
        add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
    }

    public function add_admin_menu() {
        add_menu_page(
            __( 'Elements Fusion', 'elements-fusion' ),
            __( 'Elements Fusion', 'elements-fusion' ),
            'manage_options',
            'elements-fusion',
            [ $this, 'render_dashboard' ],
            'dashicons-admin-generic'
        );
    }

    public function render_dashboard() {
        require_once __DIR__ . '/views/dashboard.php';
    }
}
