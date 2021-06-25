<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class marqueeItem extends Widget_Base {

    public function get_name() {
        return 'marqueeItem';
    }

    public function get_title() {
        return __('Marquee Item', 'elementor');
    }

    public function get_icon() {
        return 'fa fa-sliders';
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'marquee_section', [
            'label' => __('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'marquee_title', [
            'label' => __('Title'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Marquee Title'),
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'marquee_image', [
            'label' => __('Choose Image'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'marquee_list', [
            'label' => __('Marquee List'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'marquee_title' => __('Title #1'),
                    'marquee_image' => __(''),
                ],
            ],
            'title_field' => '{{{ marquee_title }}}',
                // 'title_url' => '{{{ marquee_image }}}',
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['marquee_list']) {
            ?>
            <marquee behavior="scroll" direction="left">
                <?php
                foreach ($settings['marquee_list'] as $item) {
                    ?>

                    <div class="analytics_item analytics_item1">
                        <div class="fa"><img src="<?php echo $item['marquee_image']['url']; ?>" alt=""/></div>
                        <div class="analytics_price">
                            <span><?php echo $item['marquee_title']; ?></span>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </marquee>
            <?php
        }
    }

    protected function _content_template() {
        ?> 
        <# if ( settings.marquee_list.length ) { #>
        <marquee behavior="scroll" direction="left">
            <# _.each( settings.marquee_list, function( item ) { #>
            <div class="analytics_item analytics_item1">
                <div class="fa"> <img src="{{ item.marquee_image.url }}"></div>
                <div class="analytics_price">
                    <span> {{ item.marquee_title }}</span>
                </div>
            </div>
            <#  }); #>
        </marquee>
        <# } #>
        <?php
    }

}
