<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class analyticsItem extends Widget_Base {

    public function get_name() {
        return 'analyticsItem';
    }

    public function get_title() {
        return 'Analytics';
    }

    public function get_icon() {
        return 'fa fa-bar-chart';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => 'Analytics',
                ]
        );

        $this->add_control(
                'api_code', [
            'label' => 'Code Here',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => ''
                ]
        );
        $this->add_control(
                'image', [
            'label' => __('Choose Image'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('api_code', 'basic');
        $this->add_render_attribute(
                'api_code', [
            'class' => ['analytics_item'],
                ]
        );
        // Get image URL
        ?>
        <div class="analytics_item analytics_item1">
            <div class="fa"><img src="<?php echo $settings['image']['url']; ?>" alt=""/></div>
            <div class="analytics_price">
                <span><?php echo $settings['api_code']; ?></span>
            </div>
        </div>

        <?php
    }

    protected function _content_template() {
        ?>       
        <#
        view.addInlineEditingAttributes( 'api_code', 'basic' );
        view.addRenderAttribute(
        'api_code',
        {
        'class': [ 'advertisement__label-heading' ],
        }
        );

        #>
        <div class="analytics_item analytics_item1">
            <div class="fa"> <img src="{{ settings.image.url }}"></div>
            <div class="analytics_price">
                <span> {{{ settings.api_code }}}</span>
            </div>
        </div>
        <?php
    }

}
