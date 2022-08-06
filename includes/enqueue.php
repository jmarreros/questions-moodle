<?php

namespace dcms\questions\includes;

// Enqueu Cass
class Enqueue{

    public function __construct(){
        add_action('admin_enqueue_scripts', [$this, 'register_scripts_backend']);
    }

    // Backend scripts
    public function register_scripts_backend(){

        // Javascript
        wp_register_script('questions-script',
                            DCMS_QUESTIONS_URL.'/assets/script.js',
                            ['jquery'],
                            DCMS_QUESTIONS_VERSION,
                            true);

        wp_localize_script('questions-script',
                            'dcms_syscom',
                                [ 'ajaxurl'=>admin_url('admin-ajax.php'),
                                 'nsyscom' => wp_create_nonce('ajax-nonce-syscom'),
                                 'sending' => __('Enviando...', 'syscom-woocommerce'),
                                 'processing' => __('Procesando...', 'syscom-woocommerce')
                                ]);

        wp_enqueue_script('questions-script');


        // CSS
        wp_register_style('questions-style',
                            DCMS_QUESTIONS_URL.'/assets/style.css',
                            [],
                            DCMS_QUESTIONS_VERSION );

        wp_enqueue_style('questions-style');
    }

}