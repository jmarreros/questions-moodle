<?php

use dcms\questions\database\DBMoodle;

$moodle = new DBMoodle();
$categories = $moodle->get_all_categories();

error_log(print_r($categories, true));

?>
<h1>categories</h1>
categorias :)