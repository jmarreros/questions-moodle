<?php

use dcms\questions\includes\Categories;

// Validations
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! current_user_can( 'manage_options' ) ) return; // only administrator

// Tabs definitions
$plugin_tabs = Array();
$plugin_tabs['categories'] = __('Categories', 'questions-moodle');
// $plugin_tabs['questions'] = __('Questions Selection', 'questions-moodle');

$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'categories';

// Interfaz header
echo "<div class='wrap'>"; //start wrap
echo "<h1>" . __('Moodle Questions', 'questions-moodle') . "</h1>";

// Intefaz tabs
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
        $questions = [];
        include_once('partials/questions.php');
        break;
}

echo "</div>"; //end wrap