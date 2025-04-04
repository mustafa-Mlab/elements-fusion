<?php

namespace HugeAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class HA_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return HA_WIDGET_PREFIX . 'accordion';
    }

    public function get_title() {
        return __( 'Accordion', 'huge-addons' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['ha-addons-category'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'accordion_content_section',
            [
                'label' => __( 'Accordion', 'huge-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'accordion_title',
            [
                'label'       => __( 'Title', 'huge-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Accordion Title', 'huge-addons' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label'      => __( 'Content', 'huge-addons' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'Accordion content goes here...', 'huge-addons' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'accordion_items',
            [
                'label'       => __( 'Items', 'huge-addons' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'accordion_title'   => __( 'Accordion #1', 'huge-addons' ),
                        'accordion_content' => __( 'Content for accordion item #1', 'huge-addons' ),
                    ],
                    [
                        'accordion_title'   => __( 'Accordion #2', 'huge-addons' ),
                        'accordion_content' => __( 'Content for accordion item #2', 'huge-addons' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

        // Additional Settings Section
        $this->start_controls_section(
            'accordion_settings_section',
            [
                'label' => __( 'Settings', 'huge-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_icons',
            [
                'label'        => __( 'Show Title Icon', 'huge-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'huge-addons' ),
                'label_off'    => __( 'No', 'huge-addons' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'icon_normal',
            [
                'label'     => __( 'Icon', 'huge-addons' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-plus',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_icons' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_active',
            [
                'label'     => __( 'Active Icon', 'huge-addons' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-minus',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_icons' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ha-accordion-widget.php';
        \HugeAddons\Widgets\Renders\render_ha_accordion_widget( $settings );
    }
}
