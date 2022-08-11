<?php
// Database conection


namespace dcms\questions\helpers;

class MoodleConection{

    public static function get_moodle_db(){
        // Para pruebas en máquina local
        if ( $_SERVER['SERVER_NAME'] === 'questions.local'){
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
        
        return new \wpdb($database_user, $database_pass, $database_name, $database_server);
    }
    
}