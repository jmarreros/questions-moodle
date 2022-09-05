<?php

namespace dcms\questions\database;

use dcms\questions\helpers\MoodleConnection;
use wpdb;


// Moodle database queries
class DBMoodle{
    private wpdb $moodledb;

    public function __construct(){
        $this->moodledb = MoodleConnection::get_moodle_db();
    }

    // Get all categories
    public function get_all_categories(): array
    {
        $sql = "SELECT 
                    ISNULL(qparent.id) isparent, 
                    qchild.id, 
                    qchild.name, 
                    qchild.parent, 
                    qchild.sortorder,
                    count(mq.id) qty
                FROM mo_question_categories qparent 
                RIGHT JOIN mo_question_categories qchild 
                ON qparent.id = qchild.parent
                LEFT JOIN mo_question mq 
                ON qchild.id = mq.category
                GROUP BY qchild.id";

        return $this->moodledb->get_results($sql, ARRAY_A);
    }

    // Get specific category
    public function get_category_by_id($id_category): array
    {
        $sql = "SELECT id, name, parent 
                FROM mo_question_categories 
                WHERE id = $id_category";
        
        return $this->moodledb->get_row($sql, ARRAY_A);
    }

    // Get questions by category
    public function get_questions_and_answers($id_category):array{
        $sql = "SELECT 
                    q.id, 
                    q.name, 
                    q.questiontext, 
                    q.qtype, 
                    q.hidden, 
                    a.id id_answer, 
                    a.answer, 
                    a.fraction 
                FROM mo_question q
                INNER JOIN mo_question_answers a 
                ON q.id = a.question
                WHERE q.category = $id_category";

        return $this->moodledb->get_results($sql, ARRAY_A);
    }


    // Get questions by categories and several parameters
    public function get_questions_by_categories($id_categories, $offset = 0, $per_page = 10, $rand_seed = 100):array{
	    $str_cats = dcms_get_str_categories($id_categories);

	    $sql = "SELECT id, category, questiontext 
                FROM mo_question 
                WHERE category IN ( $str_cats )
                ORDER BY RAND($rand_seed) LIMIT $offset, $per_page";

        return $this->moodledb->get_results($sql, ARRAY_A);
    }

    // Get total  questions by category
    public function get_total_questions_by_category($id_categories):int{

	    $str_cats = dcms_get_str_categories($id_categories);

        $sql = "SELECT count(id) FROM mo_question 
                WHERE category IN ( $str_cats )";

        return $this->moodledb->get_var($sql);
    }
    
    // Get specific answers by question
    public function get_answers_by_question($id_question, $rand_seed = 100, $rand_answers = 1):array{
        $sql = "SELECT id, answer, fraction
                FROM mo_question_answers
                WHERE question = $id_question";

        $sql .= ($rand_answers) ? " ORDER BY RAND($rand_seed)" : '';

        return $this->moodledb->get_results($sql, ARRAY_A);   
    }

}
