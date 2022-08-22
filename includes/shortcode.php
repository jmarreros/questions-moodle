<?php

namespace dcms\questions\includes;

// Class for grouping shortcodes functionality
class Shortcode{

    public function __construct(){
        add_action( 'init', [$this, 'create_shortcodes'] );
    }

    // Function to add shortcodes
    public function create_shortcodes(): void{
        add_shortcode(DCMS_SHORTCODE_QUESTIONS_NAME, [ $this, 'show_shortcode_questions' ]);
    }

    // Function show user account in the front-end
    public function show_shortcode_questions($attrs): string{
        // Get categories attributes
        if ( ! isset($attrs['category']) ) return "No esta establecido el parámetro de category";

        $id_categories = explode(',', $attrs['category']);
        $per_page = abs(intval($attrs['perpage']??DCMS_QUESTIONS_PAGE));
        $rand_answers = abs(intval($attrs['rand_answers']??1));
        $total = abs(intval($attrs['limit']??0));

        // Session control and seed
        if ( ! isset($_SESSION['custom-seed']) ) {
            $_SESSION['custom-seed'] = rand(1,100);
        }
        
        wp_enqueue_style('questions-style');
        wp_enqueue_script('questions-script');

        // Pagination
        $page = $_GET['qpage']??0;
        $finish = $_GET['finish']??0;
        $seed = $_SESSION['custom-seed'];

        $html_code = '';
        $obj_questions = new Questions;

        $total_questions = $obj_questions->get_total_questions_by_categories($id_categories);

        // Setting total questions
        if ( $total === 0 || $total > $total_questions){
            $total = $total_questions;
        }

        if ( ! $finish ) {
            $questions = $obj_questions->get_questions_by_categories($id_categories, ($page*$per_page), $per_page, $seed, $rand_answers);
            $show_finish = ($page + 1)*$per_page >= $total;
    
            ob_start();
            include_once DCMS_QUESTIONS_PATH.'views/frontend/questions-category.php';
        } else {
            $questions_answers = $obj_questions->get_questions_by_categories($id_categories, 0, $total, $seed, $rand_answers);

            ob_start();
            include_once DCMS_QUESTIONS_PATH.'views/frontend/finish-results.php';
            // session_destroy();
        }
        $html_code = ob_get_contents();
        ob_end_clean();

        return $html_code;
    }
    
}