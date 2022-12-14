<?php

use dcms\questions\includes\Categories;
use dcms\questions\includes\Questions;

// Validations
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! current_user_can( 'manage_options' ) ) return; // only administrator

// Tabs definitions
$plugin_tabs = Array();
$plugin_tabs['categories'] = __('Categories', 'questions-moodle');
$plugin_tabs['documentation'] = __('Documentation', 'questions-moodle');
// $plugin_tabs['questions'] = __('Questions Selection', 'questions-moodle');

$current_tab = $_GET['tab'] ?? 'categories';

// Interface header
echo "<div class='wrap'>"; //start wrap
echo "<h1>" . __('Moodle Questions', 'questions-moodle') . "</h1>";

// Interface tabs
echo '<h2 class="nav-tab-wrapper">';
foreach ( $plugin_tabs as $tab_key => $tab_caption ) {
    $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
    echo "<a data-tab='".$current_tab."' class='nav-tab " . $active . "' href='".admin_url( DCMS_QUESTIONS_SUBMENU . "?page=questions-moodle&tab=" . $tab_key )."'>" . $tab_caption . '</a>';
}
echo '</h2>';


// Partials
switch ($current_tab){

    case 'categories':
        $categories = (new Categories)->get_all_categories();
        include_once('partials/categories.php');
        break;

    case 'questions':
        $category_id =  $_GET['id']??0;
        if ( $category_id === 0 ) return;

        $category = (new Categories)->get_category_by_id($category_id);
        $questions = (new Questions)->get_questions_and_answers($category_id);
        include_once('partials/questions.php');
        break;
    case 'documentation':
        include_once('partials/documentation.php');
        break;
}

echo "</div>"; //end wrap