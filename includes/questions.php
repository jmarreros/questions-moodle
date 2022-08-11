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

                $patterns = ['/^[0-9]+(\. )?/', '/(<p><\/p>)+/','/(<br>)+/'];
                $group_questions[$i]['questiontext'] =  preg_replace($patterns, '', $question['questiontext']);
                
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

}
