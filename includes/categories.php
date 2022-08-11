<?php

namespace dcms\questions\includes;

use dcms\questions\database\DBMoodle;

class Categories{

    // Get all categories group by parents
    public function get_all_categories(){
        $moodle = new DBMoodle();
        $categories = $moodle->get_all_categories();

        // Group categories parent - child
        $parents = array_filter($categories, fn($row) => $row['isparent'] === '1');

        $group_categories = [];
        foreach ($parents as $parent) {
            $children = array_filter($categories, fn($row) => $row['parent'] === $parent['id'] && $row['qty'] > 0);
            if ( $children ){
                $parent['children'] = $children;         
                $group_categories[] = $parent;    
            }
        }

        return $group_categories;
    }


    // Get specific category
    public function get_category_by_id($id_category){
        $moodle = new DBMoodle();
        return $moodle->get_category_by_id($id_category);
    }

}
