<?php

namespace WPC;

// use Elementor\Plugin; ?????
class Widget_Loader {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

//    public function init() {
//        // Register Widget Scripts
//        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
//    }
//
//    public function widget_scripts() {
//        wp_register_script('count-script', get_template_directory_uri().'/inc/widgets/js/count.js');
//    }

    private function include_widgets_files() {
        require_once(__DIR__ . '/widgets/CustomMenu.php');
        require_once(__DIR__ . '/widgets/analytics_item.php');
        require_once(__DIR__ . '/widgets/marquee_item.php');
        require_once(__DIR__ . '/widgets/cuscount.php');
    }

    public function register_widgets() {

        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CustomMenu());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\analyticsItem());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\marqueeItem());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\cuscount());
    }

    public function __construct() {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    }

}

// Instantiate Plugin Class
Widget_Loader::instance();
