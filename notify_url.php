<?php

use Classes\AliPayClass;

require_once("Classes/AliPayClass.php");

/**
 * E.g Response
 * @link https://global.alipay.com/service/website_split/7
 * http://www.namesilo.com/alipay_ipn.php?
 * notify_id=0578bc470961e3b43fb676db616711fd2k
 * &notify_type=trade_status_sync
 * &sign=***
 * &trade_no=2015061700001000100000583330
 * &total_fee=11.00
 * &out_trade_no=2082389608326064
 * &currency=USD
 * &notify_time=2015-06-17+02%3A37%3A02
 * &trade_status=TRADE_CLOSED
 * &sign_type=RSA
 */

try {
    /**
     * The ID for a particular notification.  It can be used by the partner system to verify the notification
     */
    $notify_id =  filter_input(INPUT_POST,'notify_id');
    /**
     * Notification type, value： trade_status_sync.
     */
    $notify_type = filter_input(INPUT_POST,'notify_type');
    /**
     * Signature value.
     */
    $sign  =  filter_input(INPUT_POST,'sign');
    /**
     * AliPay Transaction ID.Max length is 64 and min length is 16.
     */
    $trade_no = filter_input(INPUT_POST,'trade_no');
    /**
     * The amount of the payment
     */
    $total_fee = filter_input(INPUT_POST,'total_fee');
    /**
     * out_trade_no passed in by the merchant in the request
     */
    $out_trade_no = filter_input(INPUT_POST,'out_trade_no');
    /**
     * Currency code.
     */
    $currency = filter_input(INPUT_POST,'currency');
    /**
     * Time (Alipay’s time zone): YYYY-MM-DD hh:mm:ss
     */
    $notify_time = filter_input(INPUT_POST,'notify_time');
    /**
     * One of following two values:
     * TRADE_FINISHED
     * TRADE_CLOSED
     */
    $trade_status =filter_input(INPUT_POST,'trade_status');
    /**
     * Signature method. The following are supported. Must be uppercase.DSA, RSA, and MD5.
     */
    $sign_type = filter_input(INPUT_POST,'sign_type');

    // this is override if wanted to use global config
    include_once ("config.php");
    $total_fee =3;
    $aliPay = new AliPayClass();
    // this config  from config.php
    $aliPay->setNotifyUrl($notify_url)
           ->setPartner($partner)
           ->setKey($key)
           ->setSignType($sign_type)
           ->setReturnUrl($return_url);

    // this config from url
    $aliPay
        ->setCurrency($currency)
        ->setOutTradeNo($out_trade_no)
        ->setTotalFee($total_fee)
        ->setSignType($sign_type)
        ->setNotifyId($notify_id)
        ->setTransport('https')
        ->setSign($sign);
    $aliPay->getAliPayParameter('notify');

    $verify_result = $aliPay->verifyNotify();
    $aliPay->setMonolog($aliPay::LOG_INFO,"AliPay : verify object ".var_export($verify_result,true));

    if ($verify_result) {
        if ($trade_status == $aliPay::TRADE_FINISHED) {
            $aliPay->setMonolog($aliPay::LOG_INFO, "AliPay : Trade Finish ");
        } else if ($trade_status == 'TRADE_SUCCESS') {
            // trade success not in the latest documentation.. so pretty weird here
            $aliPay->setMonolog($aliPay::LOG_INFO, "AliPay : Trade Success ");
        }
        //After program is executed, there would not be redirection operation on the page, for AliPay would not recognize a “success” string, so it would be regarded as an error, and AliPay system would keep sending notification.
        echo "success";  // don't touch this string. because important for aliPay server ?
        $aliPay->setMonolog($aliPay::LOG_INFO, "AliPay : Verification Success ");
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    } else {
        //验证失败
        // let play like this .. if trade success  code here
        if ($trade_status == $aliPay::TRADE_FINISHED) {
            // push into the table the transaction .

            // create a table log

            // approved the payment at cash table


        }else{
            $aliPay->setMonolog($aliPay::LOG_ERROR,"AliPay : Verification Failure ali pay transaction");
            // since if failure better we grep whatever resource they output
            $aliPay->setMonolog($aliPay::LOG_INFO, "AliPay : Get Value ".var_export($_GET,true));
            $aliPay->setMonolog($aliPay::LOG_INFO, "AliPay : Post Value ".var_export($_POST,true));
        }

    }
} catch (Exception $e) {
    echo $e->getMessage();
}


