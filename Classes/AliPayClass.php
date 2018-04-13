<?php

namespace Classes;


include_once("AbstractClass.php");

/**
 * Class AliPaySplitFundInfo
 * @link https://global.alipay.com/service/website_split/29
 * @note example provided contradiction with the website.
 * Return JSON String
 * @package Classes
 */
Class AliPaySplitFundInfo
{
    /**
     * Alipay userID that Alipay account for deposit. Alipay userID that composed of 16 digits beginning with 2088
     * @var string
     */
    private $transin;
    /**
     * Split Amount. The format must be correct to the currency
     * @var double
     */
    private $amount;
    /**
     * Split currency. If parameter (total_fee) was used, the split currency must be foreign currency and the same with settlement currency!
     * If parameter (rmb_fee) was used, the split currency must be ‘CNY’!
     * The parameter (total_fee and rmb_fee ) are mutual exclusive.
     * @var string
     */
    private $currency;
    /**
     * Split discretion
     * @var string
     */
    private $desc;

    /**
     * Alipay userID that Alipay account for deposit. Alipay userID that composed of 16 digits beginning with 2088
     * @return string
     */
    public function getTransin()
    {
        return $this->transin;
    }

    /**
     * Alipay userID that Alipay account for deposit. Alipay userID that composed of 16 digits beginning with 2088
     * @param mixed $transin
     * @example 2088101126708402
     * @return AliPaySplitFundInfo
     * @throws \Exception
     */
    public function setTransin($transin)
    {
        if (strlen($transin) == 16) {
            $this->transin = $transin;
        } else {
            throw  new  \Exception("Transin id value length must be 16 character");
        }
        return $this;
    }

    /**
     * Split Amount. The format must be correct to the currency
     * @note  if amount is empty .Ali pay will send this Order information is not recognized, it is recommended to contact the seller.
     * Error code: INVALID_PARAMETER
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Split Amount. The format must be correct to the currency
     * @param mixed $amount
     * @example 0.10
     * @return AliPaySplitFundInfo
     * @throws \Exception
     */
    public function setAmount($amount)
    {
        if (is_double($amount) || is_float($amount) || is_numeric($amount)) {
            $this->amount = $amount;
        } else {
            throw new \Exception("Amount must be correct with currency format");
        }
        return $this;
    }

    /**
     * Split currency. If parameter (total_fee) was used, the split currency must be foreign currency and the same with settlement currency!
     * If parameter (rmb_fee) was used, the split currency must be ‘CNY’!
     * The parameter (total_fee and rmb_fee ) are mutual exclusive.
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Split currency. If parameter (total_fee) was used, the split currency must be foreign currency and the same with settlement currency!
     * If parameter (rmb_fee) was used, the split currency must be ‘CNY’!
     * The parameter (total_fee and rmb_fee ) are mutual exclusive.
     * @param mixed $currency
     * @example USD
     * @return AliPaySplitFundInfo
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Split discretion
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Split discretion
     * @param mixed $desc
     * @return AliPaySplitFundInfo
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    /***
     * Return Json String
     * @example  split_fund_info=
     * [
     *  {"transIn":"2088101126708402","amount":"0.10","currency":"USD","desc":"  Split _test1"},
     *  {"transIn":"2088101126707869","amount":"0.10","currency":"USD","desc":"Split_test2"}
     * ]
     * @return mixed;
     * @throws \Exception
     */
    public function getJsonSplitDetailInfo()
    {
        $array = array();
        if (strlen($this->getTransin()) > 0) {
            $array["transIn"] = $this->getTransin();
        }
        if ($this->getAmount() > 0) {
            $array["amount"] = $this->getAmount();
        }
        if (strlen($this->getCurrency()) > 0) {
            $array["currency"] = $this->getCurrency();
        }
        if (strlen($this->getDesc()) > 0) {
            $array["desc"] = $this->getDesc();
        } else {
            throw  new \Exception("Description must not be empty");
        }
        return json_encode($array);
    }

}

/**
 * Class AliPayClass
 * @package Classes
 */
Class AliPayClass extends AbstractClass
{
    /**
     * Service
     * @example create_forex_trade
     * @note optional
     * @var string
     */
    private $service;
    /**
     * Partner ID. Composed of 16 digits beginning with 2088.
     * @note optional
     * @example 2088001159940003
     * @var string (16)
     */
    private $partner;
    /**
     * The charset with which the request data is encoded. UTF-8 is supported
     * @note optional
     * @example UTF-8
     * @var string
     */
    private $_input_charset;
    /**
     * Signature method. The following are supported. Must be uppercase. DSA, RSA, and MD5.
     * @var string
     */
    private $sign_type;
    /**
     * Signature value
     * @var string
     */
    private $sign;
    /**
     * The URL for receiving asynchronous notifications after the payment is done.
     * @note mandotary
     * @var string (200)
     */
    private $notify_url;
    /**
     * After the payment is done, the result is returned to this url via the URL redirect.
     * @note
     * @var string (200)
     */
    private $return_url;
    ////////////////////
    // Business Partner
    ////////////////////
    /**
     * The name of the items. It should not contain special symbols.
     * @note optional
     * @var string (255)
     */
    private $subject;
    /**
     * A detailed description of the items. It should not contain special symbols.
     * @var string
     */
    private $body;
    /**
     * The unique transaction ID specified by the partner. If the id is duplicated with an earlier transaction’s out_trade_no, the payment will fail with a error message indicating that it is the duplicated payment.
     * @var string
     */
    private $out_trade_no;
    /**
     * The settlement currency code the merchant specifies in the contract.
     * @var string
     */
    private $currency;
    /**
     * A floating number ranging 0.01～1000000.00. If total_fee is not null, it means the transaction uses foreign currency and the product price will be calculated in RMB based on the exchange rate.
     * @example 100.30
     * @var string
     */
    private $total_fee;
    /**
     * Use this parameter to replace total_fee if partner wish to price their product in RMB. If total_fee is used, rmb_fee should not be set. They are mutual exclusive.
     * @example 100.30
     * @var string
     */
    private $rmb_fee;
    /**
     * Reason. Pretty unsure. If not put will be error
     * @example  0.01
     * @var string
     */
    private $split_amount;
    /**
     * The default is 12h. Please contact Alipay Technical Support if you need to use other values. Max value is 15d. This parameter controls the valid time from login to completion.
     * @example 5m 10m 15m 30m 1h 2h 3h 5h 10h 12h 1d.
     * @var string(10)
     */
    private $timeout_rule;
    /**
     * The secure token from the express login API. Mandatory for express login.
     * @note mandotary/maybe not
     * @var string (40)
     */
    private $auth_token;
    /**
     * YYYY-MM-DD HH:MM:SS Please use Beijing time in order to sync up with Alipay system. This parameter can only be used with order_valid_time together in order to control the valid time from redirect to login.
     * @note mandotary
     * @var string
     */
    private $order_gmt_create;
    /**
     * In seconds. Max value is 2592000. This parameter can only be used with order_gmt_create together in order to control the valid time. If the current time passes the time of order_gmt_create + order_valid_time, the payment transaction will be closed.
     * @note mandotary
     * @example 3600
     * @var string(5)
     */
    private $order_valid_time;
    /**
     * Supplier’s name, for page display purpose.
     * @note mandotary
     * @var string (16)
     */
    private $supplier;
    /**
     * Used to differentiate the secondary merchant of the merchant, which is assigned by the merchant itself, not interfered by Alipay
     * @Example A80001
     * @var string
     */
    private $secondary_merchant_id;
    /**
     * Secondary merchant name, assigned by the merchant,not interfered by Alipay
     * @note optional
     * @example  muku
     * @var string (128)
     */
    private $secondary_merchant_name;
    /**
     * Industry classification identifier of sub-merchant which assigned by Alipay. Such like:
     * catering industry: 5812
     * department stores: 5311
     * lodging industry: 7011
     * @link https://global.alipay.com/help/online/81
     * @var string
     */
    private $secondary_merchant_industry;
    /**
     * @note optional
     * @example NEW_OVERSEAS_SELLER
     * @var string
     */
    private $product_code;
    /**
     * Split info, JSON format,
     * @note mandotary
     * @var string (600)
     * @link https://global.alipay.com/service/website_split/29
     */
    private $split_fund_info;

    /**
     * Settlement Currency
     * @var array
     */
    private $settlementCurrency;

    /**
     * MCC List
     * https://global.alipay.com/help/online/81
     * @var array
     */
    private $merchantCategoryCode;
    /**
     * MD5/RSA Key
     * @var string
     */
    private $key;
    /**
     * Detail Description
     * @var string
     */
    private $desc;
    /**
     * Timeszones
     * @link http://php.net/manual/en/timezones.php
     * @var string
     */
    private $timezones;
    /**
     * Live Application
     * @var string
     */
    public $liveAddress = "https://intlmapi.alipay.com/gateway.do?";
    /**
     * Beta/Demo Address
     * @var string
     */
    public $betaAddress = "https://openapi.alipaydev.com/gateway.do?";
    /**
     * @var string
     */
    public $liveAddressNotify = 'https://mapi.alipay.com/gateway.do?service=notify_verify&';
    /**
     * Beta/Demo Address notify
     * @var string
     */
    public $betaAddressNotify = 'https://openapi.alipaydev.com/gateway.do?service=notify_verify&';
    /**
     * Notification Server
     * @var string
     */
    public $https_verify_url = "https://openapi.alipaydev.com/gateway.do?service=notify_verify&";
    /**
     * @var string
     */
    private $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
    /**
     * Trade has been made successfully and refund can be requested.
     * @link https://global.alipay.com/service/app/10?_rd=0.1358832216767789#TradeStatus
     */
    const TRADE_FINISHED = "TRADE_FINISHED";
    /**
     * Trade created and wait for buyer to pay
     * @link https://global.alipay.com/service/app/10?_rd=0.1358832216767789#TradeStatus
     */
    const WAIT_BUYER_PAY = "Trade creation";
    /**
     * Trade that has been closed due to absence of payment in specified time;
     * @link https://global.alipay.com/service/app/10?_rd=0.1358832216767789#TradeStatus
     */
    const TRADE_CLOSED = "TRADE_CLOSED";

    ///
    /// If there are errors in calling parameters, Alipay MAPI gateway will capture it and display the errors. However, the control flow will stay at the Alipay side and will NOT return to the merchant’s site.
    /// this below if something error happen..

    const FOREX_MERCHANT_NOT_SUPPORT_THIS_CURRENCY = "	Cannot support this currency";
    const ILLEGAL_SECURITY_PROFILE = "	Cannot support this kind of encryption";
    const REPEAT_OUT_TRADE_NO = "	out_trade_no parameter is duplicated";
    const ILLEGAL_CURRENCY = " 	Currency parameter is incorrect";
    const ILLEGAL_TIMEOUT_RULE = " 	Timeout_rule parameter is incorrect";
    const SYSTEM_EXCEPTION = "	AliPay system error";
    const ILLEGAL_ARGUMENT = " 	Incorrect parameter";

    const ILLEGAL_SIGN = "Illegal signature";
    const ILLEGAL_SERVICE = "Service Parameter is incorrect";
    const ILLEGAL_PARTNER = "Incorrect Partner ID";
    const ILLEGAL_SIGN_TYPE = "Signature is of wrong type.";
    const ILLEGAL_PARTNER_EXTERFACE = "Service is not activated for this account";
    const ILLEGAL_DYN_MD5_KEY = "Dynamic key information is incorrect";
    const ILLEGAL_ENCRYPT = "Encryption is incorrect.";
    const ILLEGAL_USER = "User ID is incorrect.";
    const ILLEGAL_EXTERFACE = "Interface configuration is incorrect.";
    const ILLEGAL_AGENT = "Agency ID is incorrect.";
    const HAS_NO_PRIVILEGE = "Has no right to visit.";
    const INVALID_CHARACTER_SET = "The character set is invalid.";

    const SYSTEM_ERROR = "	Alipay system error";
    const SESSION_TIMEOUT = "	Session timeout";
    const ILLEGAL_TARGET_SERVICE = "	Wrong  target service";
    const ILLEGAL_ACCESS_SWITCH_SYSTEM = " 	Merchant is not allowed to visit system of this type.";
    const EXTERFACE_IS_CLOSED = "The interface has been closed.";
    /**
     * Ali Pay Config in array
     * @var array
     */
    public $alipay_config = array();
    /**
     * Beta
     * @var int
     */
    private $isBeta = 1;
    /**
     * server / domain name
     * @var string
     */
    private $aliPayServer;

    /**
     * Debug Mode
     * @var string
     */
    private $debugMode;
    /**
     * The ID for a particular notification.  It can be used by the partner system to verify the notification
     * @var string
     */
    private $notify_id;
    /**
     * Time (Alipay’s time zone): YYYY-MM-DD hh:mm:ss
     * @var string
     */
    private $notify_time;
    /**
     * Notification type, value： trade_status_sync.
     * @var string
     */
    private $notify_type;
    /**
     * http or https
     * @var string
     */
    private $transport;
    /**
     * Disable split info just for testing purpose
     * @var int
     */
    private $splitInfoDisable = 0;

    /**
     * AliPayClass constructor.
     * @param null|string $timezone
     * @throws \Exception
     */
    public function __construct($timezone = null)
    {
        parent::__construct();
        $this->setDebugMode(0);
        // default parameter top define 1
        if ($this->getIsBeta() == 1) {
            $this->setAliPayServer($this->betaAddress);
            $this->https_verify_url = $this->betaAddressNotify;
        } else {
            $this->setAliPayServer($this->liveAddress);
            $this->https_verify_url = $this->liveAddressNotify;
        }
        // set default value if not put.
        $this->setService("create_forex_trade");
        $this->setInputCharset("UTF-8");
        // $this->setSignType("MD5");
        //$this->setSign("e5815a4556db338ed237f7d3fd222184");
        //$this->setTimeoutRule("12h");
        // for beijing time .. it should be same with malaysia
        if (($timezone) != null) {
            $now = new \DateTime($timezone);
        } else {
            $now = new \DateTime();
        }
        $this->setOrderGmtCreate($now->format("Y-m-d H:i:s"));
        $this->setOrderValidTime(3600);
        $this->setSupplier("Your Supplier");
        $this->alipay_config['_input_charset'] = 'utf-8';
        // merchant category code
        // number start with 0 must be in string to avoid octal confusion
        $this->merchantCategoryCode = array("0742",
            "0743",
            "0744",
            "0780",
            1711,
            1731,
            1740,
            1750,
            1761,
            1771,
            1799,
            2741,
            2791,
            2842,
            4011,
            4111,
            4112,
            4119,
            4121,
            4131,
            4214,
            4215,
            4225,
            4411,
            4457,
            4468,
            4511,
            4582,
            4722,
            4784,
            4789,
            4812,
            4814,
            4815,
            4816,
            4821,
            4899,
            4900,
            5013,
            5021,
            5039,
            5044,
            5045,
            5046,
            5047,
            5051,
            5065,
            5072,
            5074,
            5085,
            5094,
            5099,
            5111,
            5122,
            5131,
            5137,
            5139,
            5169,
            5192,
            5193,
            5198,
            5199,
            5200,
            5211,
            5231,
            5251,
            5261,
            5271,
            5300,
            5309,
            5310,
            5311,
            5331,
            5399,
            5411,
            5422,
            5441,
            5451,
            5462,
            5499,
            5511,
            5521,
            5531,
            5532,
            5533,
            5541,
            5542,
            5551,
            5561,
            5571,
            5592,
            5598,
            5599,
            5611,
            5621,
            5631,
            5641,
            5651,
            5655,
            5661,
            5681,
            5691,
            5697,
            5698,
            5699,
            5712,
            5713,
            5714,
            5715,
            5718,
            5719,
            5722,
            5732,
            5733,
            5734,
            5735,
            5811,
            5812,
            5813,
            5814,
            5815,
            5816,
            5817,
            5818,
            5912,
            5921,
            5931,
            5935,
            5937,
            5940,
            5941,
            5942,
            5943,
            5944,
            5945,
            5946,
            5947,
            5948,
            5949,
            5950,
            5962,
            5963,
            5964,
            5965,
            5966,
            5967,
            5968,
            5969,
            5970,
            5971,
            5972,
            5973,
            5975,
            5976,
            5977,
            5978,
            5983,
            5992,
            5993,
            5994,
            5995,
            5996,
            5997,
            5998,
            5999,
            7011,
            7032,
            7033,
            7210,
            7211,
            7216,
            7217,
            7221,
            7230,
            7251,
            7261,
            7273,
            7278,
            7295,
            7296,
            7297,
            7298,
            7299,
            7311,
            7333,
            7338,
            7339,
            7342,
            7349,
            7361,
            7372,
            7375,
            7379,
            7392,
            7393,
            7394,
            7395,
            7399,
            7511,
            7512,
            7513,
            7519,
            7523,
            7531,
            7534,
            7535,
            7538,
            7542,
            7549,
            7622,
            7623,
            7629,
            7631,
            7641,
            7692,
            7699,
            7829,
            7832,
            7841,
            7911,
            7922,
            7929,
            7932,
            7933,
            7941,
            7991,
            7992,
            7993,
            7994,
            7996,
            7997,
            7998,
            7999,
            8011,
            8021,
            8031,
            8041,
            8042,
            8043,
            8049,
            8050,
            8062,
            8071,
            8099,
            8111,
            8211,
            8220,
            8241,
            8244,
            8249,
            8299,
            8351,
            8641,
            8675,
            8699,
            8734,
            8911,
            8931,
            8999,
            9399);
    }

    /**
     * Signature string
     * @param string $parameter_string a string that needs to be signed
     * @param string $key private key
     * @return string sign generated
     * @throws \Exception
     */
    function md5Sign($parameter_string, $key)
    {
        $parameter_string= $parameter_string . $key;
        $md5 = md5($parameter_string);
        $this->setMonolog(self::LOG_INFO,"my sign :[".$md5."]");
        return $md5;
    }

    /**
     * Verify Signature
     * @param string $parameter_string a string that needs to be signed
     * @param string $sign Signing Result
     * @param string $key private key
     * @return bool sign generated
     * @throws \Exception
     */
    function md5Verify($parameter_string, $sign, $key)
    {
        $this->setMonolog(self::LOG_INFO,"parameter:[ ".$parameter_string."]");
        $this->setMonolog(self::LOG_INFO,"key :[".$key."]");

        $parameter_string = $parameter_string . $key;
        $my_sign = md5($parameter_string);
        $this->setMonolog(self::LOG_INFO,"my sign  :[".$my_sign."]");
        $this->setMonolog(self::LOG_INFO,"sign :[".$sign."]");

        if ($my_sign == $sign) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * connect parameters with & like "parameter name=value"
     * @param $para array needs to be connected
     * @return string String with connected parameters
     */
    function createLinkString($para)
    {
        $arg = null;
        foreach ($para as $key => $val) {
            $arg .= $key . "=" . $val . "&";
        }
        //remove the last &
        $total = strlen($arg);
        $arg = substr($arg, 0, ($total - 1));
        //remove escape character if there's any

        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        return $arg;
    }

    /**
     * connect parameters to a string with & like "parameter name=value",get the string urlencoded
     * @param $para array needs to be connected
     * @return string String with connected parameters
     */
    function createLinkStringUrlEncode($para)
    {
        $arg = null;
        foreach ($para as $key => $val) {
            $arg .= $key . "=" . urlencode($val) . "&";
        }
        //remove the last &
        $total = strlen($arg);
        $arg = substr($arg, 0, ($total - 1));

        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
        // return http_build_query($para, null, null, PHP_QUERY_RFC3986);
    }

    /**
     * Remove the blank ,sign and sign_type
     * @param array $para set of signature parameters
     * @return bool|array The new signature parameter with the blank ,sign and sign_type removed
     * @throws \Exception
     */
    function paraFilter($para)
    {
        if (is_array($para)) {
            if (count($para) > 0) {
                foreach ($para as $key => $val) {
                    if ($key == "sign" || $key == "sign_type" || $val == "") {
                        unset($key);
                    }
                }
                return $para;
            }
        } else {
            throw new \Exception("Array don't existed. method : para filter ");
        }
        return false;
    }

    /**
     * rearrange Array
     * @param array $para before rearrange
     * @return mixed rearranged
     */
    function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }

    /**
     * remote data access,POST
     * @param string $url path of URL
     * @param string $certificate_authority_certificates_url The absolute path to the current working directory
     * @param string $para
     * @param string $input_charset
     * @return mixed
     * @throws \Exception
     */
    function getHttpResponsePOST($url, $certificate_authority_certificates_url, $para, $input_charset = '')
    {

        $this->setMonolog($this::LOG_INFO, "url address (POST) " . $url);
        $this->setMonolog($this::LOG_INFO, "cert address (POST)" . $certificate_authority_certificates_url);
        if (trim($input_charset) != '') {
            $url = $url . "_input_charset=" . $input_charset;
        }
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_CAINFO, $certificate_authority_certificates_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $para);
        $responseText = curl_exec($curl);
        $error = curl_error($curl);
        if ($error)
        {
            $this->setMonolog(self::LOG_ERROR,$error);
            throw new \Exception($error);
        }else{
            $this->setMonolog(self::LOG_INFO,"Curl Respond :[".$responseText."]");
        }
        curl_close($curl);

        return $responseText;
    }

    /**
     * remote data access,GET
     * @param string $url path of URL
     * @param string $certificate_authority_certificates_url The absolute path to the current working directory
     * @return mixed remote output data
     * @throws \Exception
     */
    function getHttpResponseGET($url, $certificate_authority_certificates_url)
    {
        $this->setMonolog($this::LOG_INFO, "url address (GET)" . $url);
        $this->setMonolog($this::LOG_INFO, "cert address (GET)" . $certificate_authority_certificates_url);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_CAINFO, $certificate_authority_certificates_url);
        $responseText = curl_exec($curl);
        $error = curl_error($curl);
        if ($error)
        {
            $this->setMonolog(self::LOG_ERROR,$error);
            throw new \Exception($error);
        }else{
            $this->setMonolog(self::LOG_INFO,"Curl Respond :[".$responseText."]");
        }
        curl_close($curl);

        return $responseText;
    }

    /**
     * @param $input
     * @param $_output_charset
     * @param $_input_charset
     * @return null|string|string[]
     * @throws \Exception
     */
    function charsetEncode($input, $_output_charset, $_input_charset)
    {
        $output = null;
        if (!isset($_output_charset)) $_output_charset = $_input_charset;
        if ($_input_charset == $_output_charset || $input == null) {
            $output = $input;
        } elseif (function_exists("mb_convert_encoding")) {
            $output = mb_convert_encoding($input, $_output_charset, $_input_charset);
        } elseif (function_exists("iconv")) {
            $output = iconv($_input_charset, $_output_charset, $input);
        } else {
            throw new \Exception("sorry, you have no libs support for charset change.");
        }
        return $output;
    }

    /**
     * @param $input
     * @param $_input_charset
     * @param $_output_charset
     * @return null|string|string[]
     * @throws \Exception
     */
    function charsetDecode($input, $_input_charset, $_output_charset)
    {
        $output = null;
        if ($_input_charset == $_output_charset || $input == null) {
            $output = $input;
        } elseif (function_exists("mb_convert_encoding")) {
            $output = mb_convert_encoding($input, $_output_charset, $_input_charset);
        } elseif (function_exists("iconv")) {
            $output = iconv($_input_charset, $_output_charset, $input);
        } else {
            throw new \Exception("sorry, you have no libs support for charset change.");
        }
        return $output;
    }

    /**
     * Service Name
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Service Name
     * @param string $service
     * @return AliPayClass
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Partner ID. Composed of 16 digits beginning with 2088.
     * @return string
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Partner ID. Composed of 16 digits beginning with 2088.
     * @param string $partner
     * @return AliPayClass
     * @throws \Exception
     */
    public function setPartner($partner)
    {
        if (strlen($partner) == "16") {
            $this->partner = $partner;
        } else {
            throw new \Exception("Partner ID. Composed of 16 digits beginning with 2088. Value Given : " . $partner);
        }
        if (substr($partner, 0, 4) != "2088") {
            throw  new \Exception("Beginning  must with 2088 !");
        }
        return $this;
    }

    /**
     * The charset with which the request data is encoded. UTF-8 is supported
     * @return string
     */
    public function getInputCharset()
    {
        return $this->_input_charset;
    }

    /**
     * The charset with which the request data is encoded. UTF-8 is supported
     * @param string $input_charset
     * @return AliPayClass
     */
    public function setInputCharset($input_charset)
    {

        $this->_input_charset = trim(strtolower($input_charset));
        return $this;
    }

    /**
     * Signature method. The following are supported. Must be uppercase. DSA, RSA, and MD5.
     * @return string
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * Signature method. The following are supported. Must be uppercase. DSA, RSA, and MD5.
     * @param string $sign_type
     * @return AliPayClass
     * @throws \Exception
     */
    public function setSignType($sign_type)
    {
        $array = array("DSA", "RSA", "MD5");
        if (!in_array(strtoupper($sign_type), $array)) {
            throw  new \Exception("Must be uppercase. DSA, RSA, and MD5");
        }
        $this->sign_type = strtoupper($sign_type);
        return $this;
    }

    /**
     * Signature value.
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Signature value.
     * @param string $sign
     * @return AliPayClass
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
        return $this;
    }

    /**
     * The URL for receiving asynchronous notifications after the payment is done.
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * The URL for receiving asynchronous notifications after the payment is done.
     * @param string $notify_url
     * @return AliPayClass
     * @throws \Exception
     */
    public function setNotifyUrl($notify_url)
    {
        if (strlen($notify_url) > 200) {
            throw new \Exception("Must not over 200 character");
        }
        if (strpos($notify_url, "localhost") !== false || strpos($notify_url, "127.0.0.1") !== false) {
            throw  new \Exception("AliPay will try to validate the return_url, so do not set it on local host");
        }
        $this->notify_url = $notify_url;
        return $this;
    }

    /**
     * After the payment is done, the result is returned to this url via the URL redirect.
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * After the payment is done, the result is returned to this url via the URL redirect.
     * @param string $return_url
     * @return AliPayClass
     * @throws  \Exception
     */
    public function setReturnUrl($return_url)
    {
        if (strlen($return_url) > 200) {
            throw  new \Exception("Must not over 200 character");
        }

        if (strpos($return_url, "localhost") !== false || strpos($return_url, "127.0.0.1") !== false) {
            throw  new \Exception("AliPay will try to validate the return_url, so do not set it on local host");
        }
        $this->return_url = $return_url;
        return $this;
    }

    /**
     * The name of the items. It should not contain special symbols.
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * The name of the items. It should not contain special symbols.
     * @param string $subject
     * @return AliPayClass
     * @throws \Exception
     */
    public function setSubject($subject)
    {
        if (strlen($subject) < 255) {
            $this->subject = $subject;
        } else {
            throw  new \Exception("Must not over 255 character");
        }
        return $this;
    }

    /**
     * A detailed description of the items. It should not contain special symbols.
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * A detailed description of the items. It should not contain special symbols.
     * @param string $body
     * @return AliPayClass
     * @throws \Exception
     */
    public function setBody($body)
    {
        if (strlen($body) < 400) {
            $this->body = $body;
        } else {
            throw new \Exception("Must not over 400 character");
        }
        return $this;
    }

    /**
     * The unique transaction ID specified by the partner. If the id is duplicated with an earlier transaction’s out_trade_no, the payment will fail with a error message indicating that it is the duplicated payment.
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * The unique transaction ID specified by the partner. If the id is duplicated with an earlier transaction’s out_trade_no, the payment will fail with a error message indicating that it is the duplicated payment.
     * @param string $out_trade_no
     * @return AliPayClass
     * @throws \Exception
     */
    public function setOutTradeNo($out_trade_no)
    {
        if (strlen($out_trade_no) < 64) {
            $this->out_trade_no = $out_trade_no;
        } else {
            throw  new \Exception("Must not over 64 character");
        }
        return $this;
    }

    /**
     * The settlement currency code the merchant specifies in the contract
     * @return string
     */
    public function getCurrency()
    {
        if (strlen($this->currency) == 0) {
            $this->currency = "RMB";
        }
        if ($this->getRmbFee() > 0) {
            $this->currency = "RMB";
        }
        return $this->currency;
    }

    /**
     * The settlement currency code the merchant specifies in the contract
     * @param string $currency
     * @return AliPayClass
     * @throws \Exception
     */
    public function setCurrency($currency)
    {
        $array = $this->getSettlementCurrency();
        if (count($array) > 0) {
            if (!in_array($currency, $array)) {
                throw  new \Exception("Currency Not Supported");
            }
        }
        $this->currency = $currency;
        return $this;
    }

    /**
     * A floating number ranging 0.01～1000000.00. If total_fee is not null, it means the transaction uses foreign currency and the product price will be calculated in RMB based on the exchange rate.
     * @return string
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * A floating number ranging 0.01～1000000.00. If total_fee is not null, it means the transaction uses foreign currency and the product price will be calculated in RMB based on the exchange rate.
     * @param string $total_fee
     * @return AliPayClass
     * @throws \Exception
     */
    public function setTotalFee($total_fee)
    {
        if (is_float($total_fee) || is_numeric($total_fee) || is_double($total_fee)) {
            $this->total_fee = $total_fee;
        } else {
            throw  new \Exception("Must be float,double,numeric value.Important is currency value");
        }
        return $this;
    }

    /**
     * Use this parameter to replace total_fee if partner wish to price their product in RMB. If total_fee is used, rmb_fee should not be set. They are mutual exclusive.
     * @return string
     */
    public function getRmbFee()
    {
        return $this->rmb_fee;
    }

    /**
     * Use this parameter to replace total_fee if partner wish to price their product in RMB. If total_fee is used, rmb_fee should not be set. They are mutual exclusive.
     * @param string $rmb_fee
     * @return AliPayClass
     * @throws \Exception
     */
    public function setRmbFee($rmb_fee)
    {
        if (is_float($rmb_fee) || is_numeric($rmb_fee) || is_double($rmb_fee)) {

            $this->rmb_fee = $rmb_fee;
        } else {
            throw  new \Exception("Must be float,double,numeric value.Important is currency value");
        }
        return $this;
    }

    /**
     * The default is 12h. Please contact AliPay Technical Support if you need to use other values. Max value is 15d. This parameter controls the valid time from login to completion.
     * @example 5m 10m 15m 30m 1h 2h 3h 5h 10h 12h 1d.
     * @return string
     */
    public function getTimeoutRule()
    {
        return $this->timeout_rule;
    }

    /**
     * The default is 12h. Please contact AliPay Technical Support if you need to use other values. Max value is 15d. This parameter controls the valid time from login to completion.
     * @param string $timeout_rule
     * @example 5m 10m 15m 30m 1h 2h 3h 5h 10h 12h 1d.
     * @return AliPayClass
     */
    public function setTimeoutRule($timeout_rule)
    {
        $this->timeout_rule = $timeout_rule;
        return $this;
    }

    /**
     * The secure token from the express login API. Mandatory for express login.
     * @return string
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * The secure token from the express login API. Mandatory for express login.
     * @param string $auth_token
     * @return AliPayClass
     */
    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
        return $this;
    }

    /**
     * YYYY-MM-DD HH:MM:SS Please use Beijing time in order to sync up with AliPay system. This parameter can only be used with order_valid_time together in order to control the valid time from redirect to login
     * @return string
     */
    public function getOrderGmtCreate()
    {
        return $this->order_gmt_create;
    }

    /**
     * YYYY-MM-DD HH:MM:SS Please use Beijing time in order to sync up with AliPay system. This parameter can only be used with order_valid_time together in order to control the valid time from redirect to login
     * For PHP is not like above.. that above might be JAVA DATE
     * @param string $order_gmt_create
     * @return AliPayClass
     */
    public function setOrderGmtCreate($order_gmt_create)
    {
        $this->order_gmt_create = $order_gmt_create;
        return $this;
    }

    /**
     * In seconds. Max value is 2592000. This parameter can only be used with order_gmt_create together in order to control the valid time. If the current time passes the time of order_gmt_create + order_valid_time, the payment transaction will be closed.
     * @return string
     */
    public function getOrderValidTime()
    {
        return $this->order_valid_time;
    }

    /**
     * In seconds. Max value is 2592000. This parameter can only be used with order_gmt_create together in order to control the valid time. If the current time passes the time of order_gmt_create + order_valid_time, the payment transaction will be closed.
     * @param string $order_valid_time
     * @return AliPayClass
     */
    public function setOrderValidTime($order_valid_time)
    {
        $this->order_valid_time = $order_valid_time;
        return $this;
    }

    /**
     * Supplier’s name, for page display purpose.
     * @return string
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Supplier’s name, for page display purpose.
     * @param string $supplier
     * @return AliPayClass
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
        return $this;
    }

    /**
     * Used to differentiate the secondary merchant of the merchant, which is assigned by the merchant itself, not interfered by AliPay
     * @return string
     */
    public function getSecondaryMerchantId()
    {
        return $this->secondary_merchant_id;
    }

    /**
     * Used to differentiate the secondary merchant of the merchant, which is assigned by the merchant itself, not interfered by AliPay
     * @param string $secondary_merchant_id
     * @return AliPayClass
     */
    public function setSecondaryMerchantId($secondary_merchant_id)
    {
        $this->secondary_merchant_id = $secondary_merchant_id;
        return $this;
    }

    /**
     * Secondary merchant name, assigned by the merchant,not interfered by AliPay
     * @return string
     */
    public function getSecondaryMerchantName()
    {
        return $this->secondary_merchant_name;
    }

    /**
     * Secondary merchant name, assigned by the merchant,not interfered by AliPay
     * @param string $secondary_merchant_name
     * @return AliPayClass
     */
    public function setSecondaryMerchantName($secondary_merchant_name)
    {
        $this->secondary_merchant_name = $secondary_merchant_name;
        return $this;
    }

    /**
     * Industry classification identifier of sub-merchant which assigned by AliPay. Such like:
     * catering industry: 5812
     * department stores: 5311
     * lodging industry: 7011
     * @return string
     */
    public function getSecondaryMerchantIndustry()
    {
        return $this->secondary_merchant_industry;
    }

    /**
     * Industry classification identifier of sub-merchant which assigned by AliPay. Such like:
     * catering industry: 5812
     * department stores: 5311
     * lodging industry: 7011
     * @param string $secondary_merchant_industry
     * @return AliPayClass
     */
    public function setSecondaryMerchantIndustry($secondary_merchant_industry)
    {
        $this->secondary_merchant_industry = $secondary_merchant_industry;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->product_code;
    }

    /**
     * @param string $product_code
     * @return AliPayClass
     */
    public function setProductCode($product_code)
    {
        $this->product_code = $product_code;
        return $this;
    }

    /**
     * Split info, JSON format,
     * @return string
     */
    public function getSplitFundInfo()
    {
        return $this->split_fund_info;
    }

    /**
     * Split info, JSON format,
     * @param string $split_fund_info
     * @return AliPayClass
     */
    public function setSplitFundInfo($split_fund_info)
    {
        $this->split_fund_info = $split_fund_info;
        return $this;
    }

    /**
     * Return Settlement Currency
     * @return array
     */
    public function getSettlementCurrency()
    {
        return $this->settlementCurrency;
    }

    /**
     * Set settlement Currency
     * @param array $settlementCurrency
     */
    public function setSettlementCurrency($settlementCurrency)
    {
        $this->settlementCurrency = $settlementCurrency;
    }

    /**
     * Return TimeZone
     * @return string
     */
    public function getTimezones()
    {
        return $this->timezones;
    }

    /**
     * Set Timezone
     * @link http://php.net/manual/en/timezones.php
     * @param string $timezones
     */
    public function setTimezones($timezones)
    {
        $this->timezones = $timezones;
    }


    /**
     * @return int
     */
    public function getisBeta()
    {
        return $this->isBeta;
    }

    /**
     * @param int $isBeta
     * @return AliPayClass
     */
    public function setIsBeta($isBeta)
    {
        $this->isBeta = $isBeta;
        return $this;
    }

    /**
     * @return string
     */
    public function getAliPayServer()
    {
        return $this->aliPayServer;
    }

    /**
     * @param string $aliPayServer
     * @return AliPayClass
     */
    public function setAliPayServer($aliPayServer)
    {
        $this->aliPayServer = $aliPayServer;
        return $this;
    }

    /**
     * Generate signature results
     * @param array|null $parameter_sort Parameters to sign
     * @return string sign generated
     * @throws \Exception
     * @throws \Exception
     */
    function buildRequestMySign($parameter_sort)
    {
        if (is_array($parameter_sort)) {
            $parameter_string = $this->createLinkString($parameter_sort);
            $mySign = null;
            switch (strtoupper(trim($this->alipay_config['sign_type']))) {
                case "MD5" :
                    $mySign = $this->md5Sign($parameter_string, $this->alipay_config['key']);
                    break;
                default :
                    $mySign = "";
            }
            return $mySign;
        }
        return false;
    }

    /**
     * Generate a set of parameters need in the request of AliPay
     * @param array $parameter_temp Pre-sign string
     * @return array parameters need to be in the request
     * @throws \Exception
     */
    function buildRequestPara($parameter_temp)
    {
        $parameter_filter = $this->paraFilter($parameter_temp);
        $parameter_sort = $this->argSort($parameter_filter);
        $my_sign = $this->buildRequestMySign($parameter_sort);

        $parameter_sort['sign'] = $my_sign;
        $parameter_sort['sign_type'] = strtoupper(trim($this->alipay_config['sign_type']));

        return $parameter_sort;
    }

    /**
     * Generate a set of parameters need in the request of AliPay
     * @param array $para_temp
     * @return string parameters need to be in the request
     * @throws \Exception
     */
    function buildRequestParaToString($para_temp)
    {
        //Pre-sign
        $para = $this->buildRequestPara($para_temp);

        //connect rearranged parameters with & like "parameter=value",get the string urlencoded
        $request_data = $this->createLinkStringUrlEncode($para);

        return $request_data;
    }

    /**
     * Build the request,construct in the format of HTML form
     * @param array $para_temp the request params
     * @param string $method ：post、getrequest form.support two types:post and get
     * @param string $button_name The text of confirmation button
     * @return string 提交表单HTML文本the text of requested HTML form
     * @throws \Exception
     */
    function buildRequestForm($para_temp, $method, $button_name)
    {
        $para = $this->buildRequestPara($para_temp);
        Header("Content-type:text/html;charset=utf-8");

        $sHtml = "\n<form id='aliPaySubmit' name='aliPaySubmit' action='" . $this->getAliPayServer() . "_input_charset=utf-8' method='" . $method . "'>\n\n";
        foreach ($para as $key => $val) {
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>\n";
        }

        $sHtml = $sHtml . "\n<input type='submit'  value='" . $button_name . "' style='display:none' />\n</form>\n";
        $sHtml = $sHtml . "<script>document.forms['aliPaySubmit'].submit();</script>";

        return $sHtml;
    }

    /**
     * Used to anti-phishing，use interface "query_timestamp" to get the function to get the timestamp
     * @return null|string String of timestamp
     */
    function query_timestamp()
    {
        $url = $this->getAliPayServer() . "service=query_timestamp&partner=" . trim(strtolower($this->alipay_config['partner'])) . "&_input_charset=" . trim(strtolower($this->alipay_config['_input_charset']));
        $encrypt_key = null;

        $doc = new \DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName("encrypt_key");
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;

        return $encrypt_key;
    }

    /**
     * The main function of notify page is to receive notifications. However it also needs to inform AliPay that the notification is successfully received. If everything is ok, then it will display "success" otherwise "fail". After send notification, Alipay will call notify page to make sure notification is received. Hence if it displays "success", Alipay will stop sending the notification otherwise keep sending
     * https://global.alipay.com/help/online/7
     * @return bool
     * @throws \Exception
     */
    function verifyNotify()
    {


        if (empty($_POST)) {
            //check whether the info from POST is empty
            $this->setMonolog(self::LOG_INFO, "empty post value");
            return false;
        } else {
            //verify the MD5 sign
            $isSign = $this->getSignVerify($_POST, $this->getSign());

            //Get the remote server ATN result(verify whether it's a legal notification sent from AliPay)
            $responseTxt = 'false';
            if (strlen($this->getNotifyId()) > 0) {
                $responseTxt = $this->getResponse($this->getNotifyId());
            }
            if ($isSign) {
                $isSignStr = 'true';
            } else {
                $isSignStr = 'false';
            }
            $log_text = "responseTxt=" . $responseTxt . "\n notify_url_log:isSign=" . $isSignStr . ",";
            $log_text = $log_text . $this->createLinkString($_POST);
            $this->setMonolog(self::LOG_INFO, "is sign " . $log_text);

            if (preg_match("/true$/i", $responseTxt) && $isSign) {
                return true;
            } else {
                return false;
            }
        }

    }

    /**
     * Verify whether it's a legal notification sent from AliPay
     * @return bool sign
     * @throws \Exception
     */
    function verifyReturn()
    {
        if (empty($_GET)) {
            return false;
        } else {
            $isSign = $this->getSignVerify($_GET, filter_input(INPUT_GET, "sign"));
            return $isSign;
        }
    }

    /**
     * Generate sign from feedback
     * @param array $parameter_temp the params from the feedback notification
     * @param string $sign the sign to be compared
     * @return string the result of verification
     * @throws \Exception
     */
    function getSignVerify($parameter_temp, $sign)
    {
        //Filter parameters with null value ,sign and sign_type

        // testing final

        //testing final
        $parameter_filter = $this->paraFilter($parameter_temp);

        //sort the to-be-signed
        $parameter_sort = $this->argSort($parameter_filter);
        unset($parameter_sort['sign'], $parameter_sort['sign_type']);

        //connect all the parameters with "&" like "parameter=value"
        $parameter_string = $this->createLinkString($parameter_sort);

        $isSign = null;
        switch (strtoupper(trim($this->alipay_config['sign_type']))) {
            case "MD5" :
                $isSign = $this->md5Verify($parameter_string, $sign, $this->alipay_config['key']);
                break;
            default :
                $isSign = false;
        }

        return $isSign;
    }

    /**
     * Get the remote server ATN result,return URL
     * @param string $notify_id The ID for a particular notification
     * @return mixed
     * @throws \Exception
     */
    function getResponse($notify_id)
    {
        $transport = strtolower(trim($this->alipay_config['transport']));
        $partner = trim($this->alipay_config['partner']);
        $verify_url = null;
        if ($transport == 'https') {
            $verify_url = $this->https_verify_url;
        } else {
            $verify_url = $this->http_verify_url;
        }
        $verify_url = $verify_url . "partner=" . $partner . "&notify_id=" . $notify_id;
        $this->setMonolog(self::LOG_INFO, "verify url " . $verify_url);
        $responseTxt = $this->getHttpResponseGET($verify_url, $this->alipay_config['ca_cert']);

        return $responseTxt;
    }

    /**
     * If any exception catch first before submition
     * @return void
     */
    public function setSubmitAliPay()
    {
        try {
            $param = $this->getAliPayParameter();
            echo $this->buildRequestForm($param, "get", "OK");
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    /**
     * Debug Mode
     * @return string
     */
    public function getDebugMode()
    {
        return $this->debugMode;
    }

    /**
     * Debug Mode
     * @param string $debugMode
     * @return AliPayClass
     */
    public function setDebugMode($debugMode)
    {
        $this->debugMode = $debugMode;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return AliPayClass
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param string $desc
     * @return AliPayClass
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    /**
     * @return string
     */
    public function getSplitAmount()
    {
        return $this->split_amount;
    }

    /**
     * @param string $split_amount
     * @return AliPayClass
     */
    public function setSplitAmount($split_amount)
    {
        $this->split_amount = $split_amount;
        return $this;
    }


    /**
     * @return string
     */
    public function getNotifyId()
    {
        return $this->notify_id;
    }

    /**
     * Time (Alipay’s time zone): YYYY-MM-DD hh:mm:ss
     * @param string $notify_id
     * @return AliPayClass
     */
    public function setNotifyId($notify_id)
    {
        $this->notify_id = $notify_id;
        return $this;
    }

    /**
     * Time (Alipay’s time zone): YYYY-MM-DD hh:mm:ss
     * @return string
     */
    public function getNotifyTime()
    {
        return $this->notify_time;
    }

    /**
     * Time (Alipay’s time zone): YYYY-MM-DD hh:mm:ss
     * @param string $notify_time
     * @return AliPayClass
     */
    public function setNotifyTime($notify_time)
    {
        $this->notify_time = $notify_time;
        return $this;
    }

    /**
     * Notification type, value： trade_status_sync.
     * @return string
     */
    public function getNotifyType()
    {
        return $this->notify_type;
    }

    /**
     * Notification type, value： trade_status_sync.
     * @param string $notify_type
     * @return AliPayClass
     */
    public function setNotifyType($notify_type)
    {
        $this->notify_type = $notify_type;
        return $this;
    }

    /**
     * http or https
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * http or https
     * @param string $transport
     * @return AliPayClass
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @return int
     */
    public function getSplitInfoDisable()
    {
        return $this->splitInfoDisable;
    }

    /**
     * @param int $splitInfoDisable
     * @return AliPayClass
     */
    public function setSplitInfoDisable($splitInfoDisable)
    {
        $this->splitInfoDisable = $splitInfoDisable;
        return $this;
    }

    /**
     * Return Ali Pay Configuration
     * @param  null|string $mode
     * @return array|bool
     * @throws \Exception
     */
    public function getAliPayParameter($mode = null)
    {

        $this->alipay_config['partner'] = $this->getPartner();
        $this->alipay_config['key'] = $this->getKey();
        $this->alipay_config['notify_url'] = $this->getNotifyUrl();
        $this->alipay_config['return_url'] = $this->getReturnUrl();
        $this->alipay_config['sign_type'] = $this->getSignType();
        $this->alipay_config['input_charset'] = strtolower($this->getInputCharset());
        $this->alipay_config['ca_cert'] = getcwd() . '/cacert.pem';
        $this->alipay_config['transport'] = $this->getTransport();
        $this->alipay_config['service'] = "create_forex_trade";

        $param = array(
            "service" => $this->getService(),
            "partner" => $this->getPartner(),
            "notify_url" => $this->getNotifyUrl(),
            "return_url" => $this->getReturnUrl(),
            "out_trade_no" => $this->getOutTradeNo(),
            "subject" => $this->getSubject(),
            "total_fee" => $this->getTotalFee(),
            "body" => $this->getBody(),
            "currency" => $this->getCurrency(),
            "_input_charset" => trim(strtolower($this->getInputCharset()))
        );
        return $param;

    }
}