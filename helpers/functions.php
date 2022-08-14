<?php

function dcms_clear_html_text( $text ){
    $patterns = ['/^[0-9]+(\. )?/', '/(<p><\/p>)+/','/(<br>)+/'];
    return preg_replace($patterns, '', $text);
}