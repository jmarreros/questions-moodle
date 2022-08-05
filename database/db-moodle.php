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

}
