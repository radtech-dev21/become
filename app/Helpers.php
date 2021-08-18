<?php
use Carbon\Carbon;

function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function pr($var) {
  	echo '<pre>';
	print_r($var);
  	echo '</pre>';
}
function http_check($url) {
    $return = $url;
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $return = 'http://' . $url;
    }
    return $return;
}
