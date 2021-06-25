<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class cuscount extends Widget_Base {

    public function get_name() {
        return 'cuscount';
    }

    public function get_title() {
        return __('Custome Count', 'elementor');
    }

    public function get_icon() {
        return 'fa fa-spinner';
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'cuscount_section', [
            'label' => __('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'cuscount_number', [
            'label' => __('Number'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => __('2'),
            'label_block' => true,
                ]
        );

        $this->add_control(
                'heading', [
            'label' => 'Heading',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'My Heading'
                ]
        );
        $this->add_control(
                'cuscount_list', [
            'label' => __('Count List'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'cuscount_number' => __('01'),
                ],
            ],
            'number_field' => '{{{ cuscount_number }}}',
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['cuscount_list']) {
            ?>

            <?php
            foreach ($settings['cuscount_list'] as $item) {
                ?>
                <div id="shiva"><span class="count"><?php echo $item['cuscount_number']; ?></span></div>


                <?php
            }
            ?>
            <p class="cunt-bottom"><?php echo $settings['heading']; ?></p>
            <?php
        }
    }

    protected function _content_template() {
        ?> 
        <# if ( settings.cuscount_list.length ) { #>

        <# _.each( settings.cuscount_list, function( item ) { #>
        <div id="shiva"><span class="count">{{ item.cuscount_number }}</span></div>
        <#  }); #>
        <p class="cunt-bottom">{{ settings.heading }}</p>
        <# } #>
        <?php
    }

}
