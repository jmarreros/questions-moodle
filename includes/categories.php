<?php

namespace dcms\questions\includes;

use dcms\questions\database\DBMoodle;

use function PHPSTORM_META\elementType;

class Categories{

    public function __construct(){
    }

    public function get_all_categories(){
        $moodle = new DBMoodle();
        $categories = $moodle->get_all_categories();

        // Group categories parent - child
        $parents = array_filter($categories, fn($row) => $row['isparent'] === '1');

        $group_categories = [];
        foreach ($parents as $parent) {
            $children = array_filter($categories, fn($row) => $row['parent'] === $parent['id'] );
            $parent['children'] = $children;            
            $group_categories[] = $parent;
        }

        return $group_categories;
    }

}
