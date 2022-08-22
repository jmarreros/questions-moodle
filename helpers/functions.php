<?php

function dcms_clear_html_text( $text ):string{
    $patterns = ['/^[0-9]+(\. )?/', '/(<p><\/p>)+/','/(<br>)+/'];
    return preg_replace($patterns, '', $text);
}

//function dcms_validate_nonce( $nonce, $nonce_name ): void{
//    if ( ! wp_verify_nonce( $nonce, $nonce_name ) ) {
//        $res = [
//            'status' => 0,
//            'message' => '✋ Error nonce validation!!'
//        ];
//        wp_send_json($res);
//    }
//}