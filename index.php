<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Ali Pay Example (Not official)</title>

    <!-- Bootstrap core CSS -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        .container {
            max-width: 960px;
        }

        .border-top { border-top: 1px solid #e5e5e5; }
        .border-bottom { border-bottom: 1px solid #e5e5e5; }
        .border-top-gray { border-top-color: #adb5bd; }

        .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }

        .lh-condensed { line-height: 1.25; }
    </style>
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="logo/alipay_logo.png" alt="" width="182px" height="64px">
        <h2>Sample</h2>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Example (Not Official AliPay)</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <button class="btn btn-info  btn-lg btn-block" type="button" onclick="copyAll()">Copy Sample </button>

                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">body</h6>
                        <small class="text-muted">E.g  Purchases for 12 x 12.24  </small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Currency</h6>
                        <small class="text-muted">GBP,HKD,CHF,SGD,</br>SEK,DKK,NOK,JPY,</br>CAD,AUD,EUR,NZD,KRW,</br>THB,CNY</small>
                        </br>
                        <a href="https://global.alipay.com/help/integration/25">Support Currency Alipay </a>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Notify URL</h6>
                        <small class="text-muted">
                            http://172.129.0.1/notify_url.php
                            <br><p class="text-danger">** must not use localhost</p></small>

                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div>
                        <h6 class="my-0">Out Trade No(Invoice Number)</h6>
                        <small>INV00001</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Partner No /<br>Merchant UID/PID </h6>
                        <small class="text-muted">2088101122136241</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Return URL</h6>
                        <small class="text-muted">
                            http://172.129.0.1/return_url.php
                            <br><p class="text-danger">** must not use localhost</p></small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Subject</h6>
                        <small class="text-muted">Purchasiung form http://www.k.com</small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Total Fee</h6>
                        <small class="text-muted">Total Sum of price</small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Key/<br>MD5 Signature key</h6>
                        <small class="text-muted">760bdzec6y9goq7ctyx96ezkz78287de</small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Sign Type</h6>
                        <small class="text-muted">MD5</small>
                    </div>
                </li>

            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <form action="aliPayApi.php?d" method="post" >


                <div class="mb-3">
                    <label for="body">Body</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="body" name="body" placeholder="Remarks: It is the description of the product." required>
                        <div class="invalid-feedback" style="width: 100%;">
                          Please enter "Body"
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="currency">Currency</label>
                    <select class="custom-select d-block w-100" id="currency" name="currency" required>
                        <option value="">Choose...</option>
                        <option value="AUD">Australian Dollar</option>
                        <option value="AUD">Canadian Dollar</option>
                        <option value="CHF">Confederation Helvetica Franc</option>
                        <option value="DKK">Danish Krone</option>
                        <option value="EUR">Euro</option>
                        <option value="JPY">Japanese Yen</option>
                        <option value="KRW">Korean Won</option>
                        <option value="NOK">Norwegian Krone</option>
                        <option value="NZD">New Zealand Dollar</option>
                        <option value="SEK">Swedish Krona</option>
                        <option value="SGD">Singapore Dollar</option>
                        <option value="THB">Thai Baht</option>
                        <option value="USD">U.S. Dollar</option>
                    </select>
                    <div class="invalid-feedback">
                        Please choose a currency
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notify_url">Notify Url</label>
                    <input type="text" class="form-control" id="notify_url" name="notify_url" placeholder="The URL for receiving asynchronous notifications after the payment is done." required>
                    <div class="invalid-feedback">
                        Please enter notify_url.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="out_trade_no">Out Trade No (invoice number)</label>
                    <input type="text" class="form-control" id="out_trade_no" name="out_trade_no" placeholder="invoice number">
                </div>

                <div class="mb-3">
                    <label for="partner">Partner / Merchant UID/PID </label>
                    <input type="text" class="form-control" id="partner" name="partner" placeholder="Partner ID. Composed of 16 digits beginning with 2088.">
                    <div class="invalid-feedback">
                        Please enter Partner / Merchant UID/PID.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="return_url">Return Url</label>
                    <input type="text" class="form-control" id="return_url" name="return_url" placeholder="After the payment is done, the result is returned to this url via the URL redirect" required>
                    <div class="invalid-feedback">
                        Please enter return url .
                    </div>
                </div>

                <div class="mb-3">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="The name of the items. It should not contain special symbols." required maxlength="255">
                    <div class="invalid-feedback">
                        Please enter subject
                    </div>
                </div>

                <div class="mb-3">
                    <label for="total_fee">Total Fee/Transaction</label>
                    <input type="text" class="form-control" id="total_fee" name="total_fee" placeholder="A floating number ranging 0.01～1000000.00. If total_fee is not null, it means the transaction uses foreign currency and the product price will be calculated in RMB based on the exchange rate." required>
                    <div class="invalid-feedback">
                        Please enter your total transaction
                    </div>
                </div>




                <div class="mb-3">
                    <label for="key">Key / md5 signature key</label>
                    <input type="text" class="form-control" id="key" name="key" placeholder="Signature value." required>
                    <div class="invalid-feedback">
                        Please enter your private key / md5 signature key
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sign_type">Sign Type</label>
                    <select class="custom-select d-block w-100" id="sign_type" name="sign_type" required>
                        <option value="">Choose...</option>
                        <option value="MD5" selected>MD5</option>
                        <option value="RSA">RSA(Not Available)</option>
                        <option value="DSA">DSA(Not Available)</option>
                    </select>
                    <div class="invalid-feedback">
                        Please enter your signature type.. By default now is MD5
                    </div>
                </div>
                <hr class="mb-4">
                <input type="hidden" id="x" name="d" value="e" />
                <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Tutorial</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="https://global.alipay.com">Global Ali Pay Merchant </a></li>
            <li class="list-inline-item"><a href="https://isandbox.alipaydev.com/user/intlAccountDetails.htm">Sandbox</a></li>
            <li class="list-inline-item"><a href="https://globalprod.alipaydev.com/login/global.htm?goto=https%3A%2F%2Fglobalprod.alipaydev.com%2Forder%2FmyOrder.htm%3ForderState%3DP_CONFIRMATION
">Merchant Login</a></li>
        </ul>
    </footer>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="node_modules/jquery-slim/dist/jquery.slim.min.js"><\/script>')</script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="node_modules/holderjs/holder.min.js"></script>
<script>

    function copyAll(){
        $("#out_trade_no").val('test_'+Math.floor((Math.random() * 100) + 1));
        $("#subject").val("test123");
        $("#currency").val("USD");
        $("#total_fee").val(Math.floor((Math.random() * 100) + 1));
        $("#body").val("test");
        // this more on system config
        $("#partner").val("2088101122136241");
        $("#key").val("760bdzec6y9goq7ctyx96ezkz78287de");
        $("#notify_url").val("http://商户网址/create_forex_trade-PHP-UTF-8-MD5-new/notify_url.php");
        $("#return_url").val("http://www.alipay.com");
        $("#sign_type").val("MD5");


    }
</script>
</body>
</html>