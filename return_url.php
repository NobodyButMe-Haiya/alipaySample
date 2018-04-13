<?php

use Classes\AliPayClass;

require_once("Classes/AliPayClass.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    // this is override if wanted to use global config
    include_once("config.php");
    try {
        $sign = filter_input(INPUT_GET, 'sign');

        $trade_no = filter_input(INPUT_GET, 'trade_no');
        $total_fee = filter_input(INPUT_GET, 'total_fee');
        $out_trade_no = filter_input(INPUT_GET, 'out_trade_no');

        $currency = filter_input(INPUT_GET, 'currency');
        $trade_status = filter_input(INPUT_GET, 'trade_status');
        $sign_type = filter_input(INPUT_GET, 'sign_type');

        $aliPay = new AliPayClass();
        // this config  from config.php
        $aliPay->setNotifyUrl($notify_url)
            ->setPartner($partner)
            ->setKey($key)
            ->setSignType($sign_type);

        // this config from url
        $aliPay
            ->setCurrency($currency)
            ->setOutTradeNo($out_trade_no)
            ->setTotalFee($total_fee)
            ->setKey($key)
            ->setSign($sign)
            ->setSignType($sign_type)
            ->setTransport('https');
        $aliPay->getAliPayParameter();
        $verify_result = $aliPay->verifyReturn();
        if ($verify_result) {
            // trade status not in the documentation
            if ($trade_status == $aliPay::TRADE_FINISHED || $trade_status == 'TRADE_SUCCESS') {
                // here we might update the transaction complete in the database
                // since "When partner is configuring return_url, it is wrong to add custom parameters. For example " Pretty diff a bit
                $aliPay->setMonolog($aliPay::LOG_INFO, "AliPay :: Success return");
            } else {
                echo "trade_status=" . $trade_status;
                $aliPay->setMonolog($aliPay::LOG_ERROR, "trade_status=" . $trade_status);
            }

            echo "Success<br />";
            $aliPay->setMonolog($aliPay::LOG_ERROR, "Success<br />");

            //Please write program according to your business logic.(The above code is only for reference.)

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            if ($trade_status == $aliPay::TRADE_FINISHED || $trade_status == 'TRADE_SUCCESS') {
                $aliPay->setMonolog($aliPay::LOG_ERROR, "Just continue if trade finish");
                echo "success and fail verification";

            } else {
                $aliPay->setMonolog($aliPay::LOG_ERROR, "fail verification and trade");
            }
        }

    } catch (Exception $e) {
        echo $system = $e->getMessage();
    }
    ?>
    <title>支付宝境外收单交易接口(create_forex_trade)</title>
</head>
<body>
</body>
</html>