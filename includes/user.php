<?php

namespace dcms\questions\includes;

use dcms\questions\includes\Questions;

// Class for control user results
class User{

    public function __construct(){
        add_action( 'init', [$this, 'create_session'] );
    }

    public function create_session(){
        if ( ! session_id() ) {
            session_start();
        }
    }

}