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
        $id_categories = explode(',', $atts['category']);
        $per_page = abs(intval($atts['perpage']??DCMS_QUESTION_PAGE));

        // Session control and seed
        if ( ! isset($_SESSION['custom-seed']) ) {
            $_SESSION['custom-seed'] = rand(1,100);
            $_SESSION['categories'] = $id_categories;
        }
        
        wp_enqueue_style('questions-style');
        wp_enqueue_script('questions-script');

        // Pagination
        $page = $_GET['qpage']??0;
        $finish = $_GET['finish']??0;

        $obj_questions = new Questions;

        if ( ! $finish ) {
            $questions = $obj_questions->get_questions_by_categories($id_categories, ($page*$per_page), $per_page, $_SESSION['custom-seed']);
            $total = $obj_questions->get_total_questions_by_categories($id_categories);
            $show_finish = ($page + 1)*$per_page >= $total;
    
            ob_start();
            include_once DCMS_QUESTIONS_PATH.'views/frontend/questions-category.php';
            $html_code = ob_get_contents();
            ob_end_clean();    
        } else {

            $seed = $_SESSION['custom-seed']??0;
            $id_categories = $_SESSION['categories']??[];
            $total = $obj_questions->get_total_questions_by_categories($id_categories);

            $questions_answers = $obj_questions->get_questions_by_categories($id_categories, 0, $total, $seed);
            
            ob_start();
            include_once DCMS_QUESTIONS_PATH.'views/frontend/finish-results.php';
            $html_code = ob_get_contents();
            ob_end_clean();
            
            // session_destroy();
        }

        return $html_code;
    }
    
}