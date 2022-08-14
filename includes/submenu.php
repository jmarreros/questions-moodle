<?php

namespace dcms\questions\includes;

/**
 * Class for creating a dashboard submenu
 */
class Submenu{
    // Constructor
    public function __construct(){
        add_action('admin_menu', [$this, 'register_submenu']);
    }

    // Register submenu
    public function register_submenu(){
        add_submenu_page(
            DCMS_QUESTIONS_SUBMENU,
            __('Moodle Questions','questions-moodle'),
            __('Moodle Questions','questions-moodle'),
            'manage_options',
            'questions-moodle',
            [$this, 'submenu_page_callback']
        );
    }

    // Callback, show view
    public function submenu_page_callback(){
        include_once (DCMS_QUESTIONS_PATH. '/views/backend/main-screen.php');
    }
}