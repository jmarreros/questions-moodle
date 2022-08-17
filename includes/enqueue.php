<?php

namespace dcms\questions\includes;

// Enqueu Cass
class Enqueue{

    public function __construct(){
        add_action('admin_enqueue_scripts', [$this, 'register_scripts_backend']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts_front_end']);
    }
    
    // Backend scripts
    public function register_scripts_backend(){
        wp_register_style('questions-style',
                            DCMS_QUESTIONS_URL.'/assets/backend/style.css',
                            [],
                            DCMS_QUESTIONS_VERSION );

        wp_enqueue_style('questions-style');
    }

    // Frontend scripts
    function register_scripts_front_end(){
        wp_register_script('questions-script',
                            DCMS_QUESTIONS_URL.'/assets/frontend/questions.js',
                            ['jquery'],
                            DCMS_QUESTIONS_VERSION,
                            true);

        wp_localize_script('questions-script',
                        'dcms_questions',
                            [ 'ajaxurl'=>admin_url('admin-ajax.php'),
                              'qnonce' => wp_create_nonce('ajax-nonce-questions')
                            ]);
                            
        wp_register_style('questions-style',
                            DCMS_QUESTIONS_URL.'assets/frontend/questions.css',
                            [],
                            DCMS_QUESTIONS_VERSION );
    }
}