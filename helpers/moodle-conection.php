<?php
// Database conection


namespace dcms\questions\helpers;

class MoodleConection{

    public static function get_moodle_db(){   
        $database_name = 'rfwdmqme_mo1';
        $database_user = 'root';
        $database_pass = 'root';
        $database_server = 'localhost';
        
        return new \wpdb($database_user, $database_pass, $database_name, $database_server);
    }
    
}