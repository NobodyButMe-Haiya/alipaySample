<?php
/**
 * Created by PhpStorm.
 * User: hafizan
 * Date: 11/04/2018
 * Time: 6:19 PM
 */
$param = "currency=USD&notify_id=9938e4a7a8c50aa92aede16c8ffb9cam3i&notify_time=2018-04-11 18:12:28&notify_type=trade_status_sync&out_trade_no=test_4.048027216282577&sign=4bfdcd902ff6f5536c392ce81f479533&sign_type=MD5&total_fee=8.00&trade_no=2018041121001003790200210315&trade_status=TRADE_FINISHED";
$key = "myiudoop3mcv9pgo47i76udxe5uwo41w";

echo md5($param.$key);
