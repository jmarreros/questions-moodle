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
    public function show_shortcode_questions( $atts , $_ ){
        // Get categories attributes
        if ( ! isset($atts['category']) ) return "No esta establecido el parámetro de category";
        $categories = explode(',', $atts['category']);

        // Session control and seed
        if ( ! isset($_SESSION['custom-seed']) ) $_SESSION['custom-seed'] = rand(1,100);
        $seed = $_SESSION['custom-seed']; // TODO, usar el seed

        // Pagination
        $page = $_GET['qpage']??0;
        $questions = (new Questions)->get_questions_by_categories($categories, ($page*DCMS_QUESTION_PAGE), DCMS_QUESTION_PAGE, 100);
        
        wp_enqueue_style('questions-style');
        wp_enqueue_script('questions-script');

        ob_start();
        include_once DCMS_QUESTIONS_PATH.'views/frontend/questions-category.php';
        $html_code = ob_get_contents();
        ob_end_clean();

        // TODO: cuando acabe la encuesta la sesion se debe destruir
        // session_destroy();

        return $html_code;
    }
    
}