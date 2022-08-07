<?php

namespace dcms\questions\database;

use dcms\questions\helpers\MoodleConection;

// Moodel database queries
class DBMoodle{
    private $moodledb;

    public function __construct(){
        $this->moodledb = MoodleConection::get_moodle_db();
    }

    // Get all categories
    public function get_all_categories(){
        $sql = "SELECT 
                    ISNULL(qparent.id) isparent, 
                    qchild.id, 
                    qchild.name, 
                    qchild.parent, 
                    qchild.sortorder 
                FROM mo_question_categories qparent 
                RIGHT JOIN mo_question_categories qchild 
                ON qparent.id = qchild.parent";

        return $this->moodledb->get_results($sql, ARRAY_A);
    }

    // Get specific category
    public function get_category_by_id($id_category){
        $sql = "SELECT id, name, parent 
                FROM mo_question_categories 
                WHERE id = {$id_category}";
        
        return $this->moodledb->get_row($sql, ARRAY_A);
    }

    // Get questions by category
    public function get_questions_and_answers($id_category){
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
                WHERE q.category = {$id_category}";

        return $this->moodledb->get_results($sql, ARRAY_A);
    }

}
