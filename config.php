<?php
if (is_null($notify_url)) {
    $notify_url = 'http://商户网址/create_forex_trade-PHP-UTF-8-MD5-new/notify_url.php';
}
if (is_null($partner)) {
    $partner = '2088101122136241';
}
if (is_null($return_url)) {
    $return_url = 'http://175.143.137.52/alipay_sample/return_url.php';
}
if (is_null($key)) {
    $key = '760bdzec6y9goq7ctyx96ezkz78287de';
}
if (is_null($sign_type)) {
    $sign_type = "MD5";
}

// other
// uncomment if you want to do testing
/**
 * $subject="test123";
 * $body = "test";
 * $currency ="USD";
 *
 * $out_trade_no = 'test'.rand(1,1000000);
 * $total_fee="0.2";
 **/
