<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class CustomMenu extends Widget_Base {

    public function get_name() {
        return 'CustomMenu';
    }

    public function get_title() {
        return __('Custom Menu', 'elementor');
    }
    public function get_icon() {
        return 'fa fa-bars';
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => __('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'list_title', [
            'label' => __('Title'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('List Title'),
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'list_url', [
            'label' => __('URL'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __('https://your-link.com'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'custom_heading', [
            'label' => 'Heading',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'My Heading'
                ]
        );

        $this->add_control(
                'list', [
            'label' => __('Repeater List'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'list_title' => __('Title #1'),
                    'list_url' => __('Item content. Click the edit button to change this text.'),
                ],
                [
                    'list_title' => __('Title #2'),
                    'list_url' => __('Item content. Click the edit button to change this text.'),
                ],
            ],
            'title_field' => '{{{ list_title }}}',
            'title_url' => '{{{ list_url }}}',
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <?php
        echo '<div class="footer_widget"><h6>'. $settings['custom_heading'].'</h6>';
        if ($settings['list']) {
            echo '<ul>';
            foreach ($settings['list'] as $item) {
                echo '<li class="elementor-repeater-item-' . $item['_id'] . '"><a href="' . $item['list_url'] . '">' . $item['list_title'] . '</a></li>';
            }
            echo '</ul> </div>';
        }
        ?>

        <?php
    }

    protected function _content_template() {
        ?> 

        <# if ( settings.list.length ) { #>
        <div class="footer_widget"><h6>{{ settings.custom_heading }}</h6>
        <ul>
            <# _.each( settings.list, function( item ) { #>
            <li class="elementor-repeater-item-{{ item._id }}"><a href="{{ item.list_url }}">{{ item.list_title }}</a></li>

            <# }); #>
        </ul>
        </div>
        <# } #>
        <?php
    }

}
