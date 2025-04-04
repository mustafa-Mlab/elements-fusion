<?php

namespace HugeAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class HA_Advanced_Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'ha_advanced_icon_box'; // Unique name for the widget
    }

    public function get_title() {
        return __( 'Advanced Icon Box', 'huge-addons' );
    }

    public function get_icon() {
        return 'eicon-icon-box'; // Use the icon of your choice
    }

    public function get_categories() {
        return ['ha-addons-category']; // The category for your widget
    }

    protected function _register_controls() {
      // Content Section
      $this->start_controls_section(
          'icon_box_content_section',
          [
              'label' => __( 'Content', 'huge-addons' ),
              'tab'   => Controls_Manager::TAB_CONTENT,
          ]
      );

      $this->add_control(
          'title',
          [
              'label'   => __( 'Title', 'huge-addons' ),
              'type'    => Controls_Manager::TEXT,
              'default' => __( 'Icon Box Title', 'huge-addons' ),
          ]
      );

      $this->add_control(
          'description',
          [
              'label'   => __( 'Description', 'huge-addons' ),
              'type'    => Controls_Manager::TEXTAREA,
              'default' => __( 'This is a description', 'huge-addons' ),
          ]
      );

      // // Icon Section
      // $this->start_controls_section(
      //     'icon_box_icon_section',
      //     [
      //         'label' => __( 'Icon', 'huge-addons' ),
      //     ]
      // );
    

      $this->add_control(
          'icon_type',
          [
              'label'   => __( 'Icon Type', 'huge-addons' ),
              'type'    => Controls_Manager::SELECT,
              'options' => [
                  'icon'   => __( 'Icon', 'huge-addons' ),
                  'image'  => __( 'Image', 'huge-addons' ),
                  'none'   => __( 'None', 'huge-addons' ),
              ],
              'default' => 'icon',
          ]
      );

      $this->add_control(
          'icon',
          [
              'label' => __( 'Icon', 'huge-addons' ),
              'type'  => Controls_Manager::ICONS,
              'default' => [
                  'value'   => 'fas fa-star', 
                  'library' => 'solid',
              ],
              'condition' => [
                  'icon_type' => 'icon',
              ],
          ]
      );

      $this->add_control(
          'icon_image',
          [
              'label'   => __( 'Image', 'huge-addons' ),
              'type'    => Controls_Manager::MEDIA,
              'condition' => [
                  'icon_type' => 'image',
              ],
          ]
      );

      $this->end_controls_section();

      // Style Section
      $this->start_controls_section(
          'icon_box_style_section',
          [
              'label' => __( 'Style', 'huge-addons' ),
              'tab'   => Controls_Manager::TAB_STYLE,
          ]
      );

      $this->add_control(
          'icon_color',
          [
              'label'     => __( 'Icon Color', 'huge-addons' ),
              'type'      => Controls_Manager::COLOR,
              'selectors' => [
                  '{{WRAPPER}} .ha-icon' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ha-advanced-icon-box-widget.php';
        \HugeAddons\Widgets\Renders\render_ha_advanced_icon_box_widget( $settings );
    }
}
