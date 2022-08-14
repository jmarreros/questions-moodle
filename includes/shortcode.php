<?php

namespace dcms\questions\includes;

use dcms\questions\includes\Questions;

// Class for grouping shortcodes functionality
class Shortcode{

    public function __construct(){
        add_action( 'init', [$this, 'create_shortcodes'] );
    }

    // Function to add shortcodes
    public function create_shortcodes(){
        add_shortcode(DCMS_SHORTCODE_QUESTIONS_NAME, [ $this, 'show_shortcode_questions' ]);
    }

    // Function show user account in the front-end
    public function show_shortcode_questions(){
        $questions = (new Questions)->get_questions_by_categories([1300, 1295], 0, 2, 10);
        
        error_log(print_r($questions, true));

        wp_enqueue_style('questions-style');
        wp_enqueue_script('questions-script');

        ob_start();
        include_once DCMS_QUESTIONS_PATH.'views/frontend/questions-category.php';
        $html_code = ob_get_contents();
        ob_end_clean();

        return $html_code;
    }
    
}