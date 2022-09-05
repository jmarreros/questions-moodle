<?php
// Database conection

namespace dcms\questions\helpers;

use wpdb;

class MoodleConnection{

    public static function get_moodle_db(): wpdb{
        // localhost development condition
        if ( str_contains($_SERVER['SERVER_NAME'], '.local') ){
            $database_name = 'rfwdmqme_mo1';
            $database_user = 'root';
            $database_pass = 'root';
            $database_server = 'localhost';
        } else {
            $database_name = 'rfwdmqme_mo1';
            $database_user = 'rfwdmqme_mo1';
            $database_pass = 'P.XsPTuHWTUMD2eF9uB23';
            $database_server = 'localhost';
        }

        return new wpdb($database_user, $database_pass, $database_name, $database_server);
    }
    
}