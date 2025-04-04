<?php

namespace HugeAddons\Widgets\Renders;

function render_ha_advanced_icon_box_widget( $settings ) {
    ?>
    <div class="ha-advanced-icon-box">
        <div class="ha-icon">
          <?php
            if ( 'icon' === $settings['icon_type'] ) {
              // \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
              ?>            
                <i class="<?php echo esc_attr( $settings['icon']['value'] ); ?>" aria-hidden="true"></i>
              <?php
            } elseif ( 'image' === $settings['icon_type'] ) {
              echo '<img src="' . esc_url( $settings['icon_image']['url'] ) . '" alt="Icon">';
            }
          ?>
        </div>
        <div class="ha-content">
            <h3 class="ha-title"><?php echo esc_html( $settings['title'] ); ?></h3>
            <p class="ha-description"><?php echo wp_kses_post( $settings['description'] ); ?></p>
        </div>
    </div>
    <?php
}
