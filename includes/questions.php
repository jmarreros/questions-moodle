<?php

namespace dcms\questions\includes;

use dcms\questions\database\DBMoodle;

class Questions{

    // Get all questions and answers by category
    public function get_questions_and_answers($id_category){
        $moodle = new DBMoodle();
        $questions = $moodle->get_questions_and_answers($id_category);

        $i = 0;
        $id_question = '0';
        $group_questions = [];
        $answers = [];

        foreach ($questions as $question) {
            if ( $id_question !==  $question['id'] ){
                // Question
                $group_questions[$i]['id'] = $question['id'];
                $group_questions[$i]['name'] = $question['name'];
                $group_questions[$i]['questiontext'] =  dcms_clear_html_text($question['questiontext']);
                // Answers 
                $j = 0;
                $answers = [];
                $answers_filter = array_filter($questions, fn($row) => $row['id'] === $question['id'] );
                foreach ($answers_filter as $item) {
                    $answers[$j]['id_answer'] = $item['id_answer'];
                    $answers[$j]['answer'] = wp_strip_all_tags($item['answer']);
                    $answers[$j]['fraction'] = $item['fraction'];
                    $j++;
                }

                $group_questions[$i]['answers'] = $answers;
                $i++;
            }
            $id_question = $question['id'];
        }

        return $group_questions;
    }

    // Get questions by categories
    public function get_questions_by_categories($id_categories, $page, $qty_page, $seed){
        $moodle = new DBMoodle();
        $questions = $moodle->get_questions_by_categories($id_categories, $page, $qty_page, $seed);

        $i = 0;
        $questions_answers = [];
        foreach ($questions as $question) {
            $questions_answers[$i]['id'] = $question['id'];
            $questions_answers[$i]['category'] = $question['category'];
            $questions_answers[$i]['questiontext'] = $question['questiontext'];
            // Answers by question
            $questions_answers[$i]['answers'] = $moodle->get_answers_by_question($question['id'], $seed);
            $i++;
        }

        return $questions_answers;
    }

}


// $patterns = ['/^[0-9]+(\. )?/', '/(<p><\/p>)+/','/(<br>)+/'];
// $group_questions[$i]['questiontext'] =  preg_replace($patterns, '', $question['questiontext']);
