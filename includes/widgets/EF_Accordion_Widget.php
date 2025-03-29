<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'accordion';
    }

    public function get_title() {
        return __( 'Accordion', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['elements-fusion-category']; // Assign to custom category
    }

    protected function _register_controls() {
        // Accordion Items Section
        $this->start_controls_section(
            'accordion_content_section',
            [
                'label' => __( 'Accordion', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'accordion_title',
            [
                'label'       => __( 'Title', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Accordion Title', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label'      => __( 'Content', 'elements-fusion' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'Accordion content goes here...', 'elements-fusion' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'accordion_items',
            [
                'label'       => __( 'Items', 'elements-fusion' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'accordion_title'   => __( 'Accordion #1', 'elements-fusion' ),
                        'accordion_content' => __( 'Content for accordion item #1', 'elements-fusion' ),
                    ],
                    [
                        'accordion_title'   => __( 'Accordion #2', 'elements-fusion' ),
                        'accordion_content' => __( 'Content for accordion item #2', 'elements-fusion' ),
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
                'label' => __( 'Settings', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_icons',
            [
                'label'        => __( 'Show Title Icon', 'elements-fusion' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'elements-fusion' ),
                'label_off'    => __( 'No', 'elements-fusion' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'icon_normal',
            [
                'label'     => __( 'Icon', 'elements-fusion' ),
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
                'label'     => __( 'Active Icon', 'elements-fusion' ),
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
        require_once __DIR__ . '/renders/render-ef-accordion-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_accordion_widget( $settings );
    }
}