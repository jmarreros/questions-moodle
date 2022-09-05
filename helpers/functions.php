<?php

function dcms_clear_html_text( $text ): string {
	$patterns = [ '/^[0-9]+(\. )?/', '/(<p><\/p>)+/', '/(<br>)+/' ];

	return preg_replace( $patterns, '', $text );
}

function dcms_clear_answers_text( $answers ): array {
	$patterns = [ '/^[a-z]+\. /', '/(<br>)+/', '/(<p>)+/', '/(<\/p>)+/' ];

	foreach ( $answers as $index => $value ) {
		$answers[ $index ]['answer'] = preg_replace( $patterns, '', $value['answer'] );
	}

	return $answers;
}

function dcms_get_str_categories($id_categories){
	$str_cats = implode(',', $id_categories);
	if ( ! $str_cats ) return 0;
	return $str_cats;
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