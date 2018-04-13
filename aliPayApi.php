<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>支付宝境外收单交易接口接口</title>
</head>
<body>
<?php
session_start();
// sample application latest AliPay
// @link https://global.alipay.com/service/website_split/4  Quick Integeration (this link from official website)
// @link https://global.alipay.com/service/app/34?_rd=0.4416014717989202#DemoDownload said 2016 ? Quick Integeration (this web crawler with even notify Classes disabled ?)
// good latest sample but not match with latest documentation
// https://github.com/bitmash/alipay-api-php

// original first link sample
// Partner ID : 2088621891276675
// Partner Secret :6cgz2arb7djrp0ohrcz580a4sl1n0pfz
// since this username and password never mention here so we assume cannot use also https://globalprod.alipaydev.com/login/global.htm

// second link sample
// Partner ID : 2088111956092332
// Partner Secret :136nflj7uu24i7v6cheubmpy0uav4tdx
// email :alipay_test@alipay.com
// login password alipay
// payment password: alipay1
// warning this username and passsword not work at @link https://globalprod.alipaydev.com/login/global.htm

// bitmash sample
// Partner ID: 2088101122136241
// Partner Secret: 760bdzec6y9goq7ctyx96ezkz78287de
// @link https://github.com/bitmash/alipay-api-php
// warning this username and password not work at @link https://globalprod.alipaydev.com/login/global.htm


use Classes\AliPayClass;

require_once("./Classes/AliPayClass.php");
// Please comment or remove this value for production purpose
$body = filter_input(INPUT_POST, 'body');
$currency = filter_input(INPUT_POST, "currency");
$notify_url = filter_input(INPUT_POST, "notify_url");
$out_trade_no = filter_input(INPUT_POST, 'out_trade_no');
$partner = filter_input(INPUT_POST, "partner");
$return_url = filter_input(INPUT_POST, "return_url");
$subject = filter_input(INPUT_POST, "subject");
$total_fee = filter_input(INPUT_POST, "total_fee");
$key = filter_input(INPUT_POST, "key");
$sign_type = filter_input(INPUT_POST, "sign_type");

// this is override if wanted to use global config
include_once ("config.php");
// first test generate output
try {
    $aliPay = new AliPayClass();

    $aliPay->setInputCharset('utf-8')
        ->setBody($body)
        ->setCurrency($currency)
        ->setNotifyUrl($notify_url)
        ->setOutTradeNo($out_trade_no)
        ->setPartner($partner)
        ->setReturnUrl($return_url)
        ->setSubject($subject)
        ->setTotalFee($total_fee)
        ->setKey($key)
        ->setSignType($sign_type);


    
    $aliPay->setSubmitAliPay();
} catch (Exception $exception) {
    echo $exception->getMessage();
} ?>
</body>
</html>

