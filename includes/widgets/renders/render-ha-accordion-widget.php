<?php 

namespace HugeAddons\Widgets\Renders;

use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Render function for HA_Accordion_Widget
 *
 * @param array $settings The widget settings passed from the main widget class.
 */
function render_ha_accordion_widget( $settings ) {
    if ( empty( $settings['accordion_items'] ) ) {
        return;
    }

    echo '<div class="ha-accordion">';

    foreach ( $settings['accordion_items'] as $index => $item ) {
        $item_id   = 'accordion-item-' . $index;
        $is_active = $index === 0 ? 'active' : '';

        $icon_html        = '';
        $active_icon_html = '';

        if ( 'yes' === $settings['show_icons'] ) {
            if ( ! empty( $settings['icon_normal'] ) ) {
                ob_start();
                Icons_Manager::render_icon( $settings['icon_normal'], [ 'aria-hidden' => 'true' ] );
                $icon_html = ob_get_clean();
            }

            if ( ! empty( $settings['icon_active'] ) ) {
                ob_start();
                Icons_Manager::render_icon( $settings['icon_active'], [ 'aria-hidden' => 'true' ] );
                $active_icon_html = ob_get_clean();
            }
        }

        // echo '<div class="accordion-item ' . esc_attr( $is_active ) . '">';
        echo '<div class="ha-accordion-item ' . esc_attr( $is_active ) . '">';
        // echo '<div class="accordion-title" id="' . esc_attr( $item_id ) . '">';
        echo '<div class="ha-accordion-title" id="' . esc_attr( $item_id ) . '" aria-expanded="' . ($is_active ? 'true' : 'false') . '" aria-controls="' . esc_attr( $item_id ) . '-content">';

        echo '<span>' . esc_html( $item['accordion_title'] ) . '</span>';

        if ( 'yes' === $settings['show_icons'] ) {
            echo '<span class="ha-accordion-icon accordion-icon-closed">' . $icon_html . '</span>';
            echo '<span class="ha-accordion-icon accordion-icon-open">' . $active_icon_html . '</span>';
        }

        echo '</div>';
        // echo '<div class="accordion-content">' . $item['accordion_content'] . '</div>';
        echo '<div class="ha-accordion-content">' . wp_kses_post( $item['accordion_content'] ) . '</div>';

        echo '</div>';
    }

    echo '</div>';
}
