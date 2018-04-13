# Ali Pay

This library was build for testing  one of my client requirement.
----------
**Requirement** 

	1. Please sign up at the [AliPay Global](https://global.alipay.com) .

	2. Please login at [Sandbox](https://isandbox.alipaydev.com/user/intlAccountDetails.htm).
	
	3. We will focus on  Sandbox 
		Buyer
		Merchant
			Cross-border Online Payment(PC) 
	
	4. For buyer , tester can test using Alipay Sandbox App 
	** This app are not fully develop,it might contain chinese 		
	   character even you choose english

	5. For Merchant, you might access via https://globalprod.alipaydev.com/login/global.htm?goto=https%3A%2F%2Fglobalprod.alipaydev.com%2Forder%2FmyOrder.htm%3ForderState%3DP_CONFIRMATION
----------
**Are there any official sample provided ?**

	1. Sample application AliPay from official link  
	[Sample](https://global.alipay.com/service/website_split/4)  
	Quick Integeration (this link from official website)  

	2. Sample application from 2016 (Unsure as verify)
	[Sample](https://global.alipay.com/service/app/34?_rd=0.4416014717989202#DemoDownload) 
	Quick Integeration (this web crawler with even notify class disabled ?)
	  
	3.  Ali Pay Integeration.Please choose cross border official. 
    [Integeration Guide](https://globalprod.alipay.com/order/integrationGuide.htm)

**Non Official Sample** 

	1.[Bitmash](https://github.com/bitmash/alipay-api-php).  

**Non Official Video**

    1. [AliPay Integration](https://www.youtube.com/watch?v=6N33cU2SuHU)

----------

  **Example Buyer**
  
    1. Username         : alipaytest20091@gmail.com 
       Password         : 111111  
       Payment password : 111111
        ** upon test work
        
    2. Username         : douyufua@alitest.com 
       Password         : 111111  
       Payment password : 111111 
       ** from (https://global.alipay.com/service/website/27)
       ** upon test work
       
  **Example   Partner Id And Partner Secret(MD5 Signature key)**
  
	1. Partner ID       : 2088621891276675  
	   Partner Secret   : 6cgz2arb7djrp0ohrcz580a4sl1n0pfz  
	   *** since this username and password never mention here so 	we assume cannot use also* 			https://globalprod.alipaydev.com/login/global.htm  
  
	2. Partner ID       : 2088111956092332  
	   Partner Secret   : 136nflj7uu24i7v6cheubmpy0uav4tdx  
	   Email            : alipay_test@alipay.com  
	   Login passwword  : alipay  
       Payment password : alipay1  
	   ** warning this username and passsword not work at @link https://globalprod.alipaydev.com/login/global.htm  
  
	3. Partner ID       : 2088101122136241  
	   Partner Secret   : 760bdzec6y9goq7ctyx96ezkz78287de  
	   (https://github.com/bitmash/alipay-api-php)  

    4. Partner ID       : 2088101122136241  
       Partner Secret   : 760bdzec6y9goq7ctyx96ezkz78287de  
       Email            : overseas_kgtest@163.com  
       Login passwword  : 111111   
       Payment password : 111111
       RSA Private Key  : MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAKQ5oPb0bAuwPqeBm01hBCiyAEg6q5hLqaHgVOZliuBsY49H9zupOhvCTPFMqV4IheggNqx1C3b2zik5egn/QdY3Y1SDKnWblVMRpdSxmasR1G6Jh6s2JPrgwAYMAnm+800otolXHIAP8Sryz9z9Kti9rtSNejSef/PEndsWTiCbAgMBAAECgYEAiD1q5RUXAYdgIxSpo0MF8UDibQmHS5wRiUKTDGRXFyG0YqyAVZVpqJfDvzcrFuCZPl5jHSUosrPDin2tWdfSZC6Hn7w+L89EwoekThUkSI6J6GPHSTiGssscBjN0RDjGH87KUmGsoDkgdwBFyG5krJOdCNjlWXnjSag6LFEusLkCQQDpqv4pqGKTSR70NjIFDeXIk8WfMuLFDQTG/Fl3JTt3ptBP0GNyNxZthgSz8+bVYz/udQU0Gx9UaG0guvpfKaKlAkEAs+ufKxFhGSk75+B93D8p6LXug568V3XmgbwsBD4+9zzG9K3PKZDaG+8Y0DCrh0wRXcGEn98xKu+6AOU0uomSPwJBAOQI2HMk/dZI1Kl1PklKb8XX2FNtoHq3IsNiP5kTv74cEEzjzDkJY5zM3kgTrWDvs9NtZf+cvG1uX5lCf9Zg1nUCQCBSGoTFGXlIo/9Sn6l6G1A3poI0eMcJYgA6Snn0qKEHZQI9WvKvl87e08lKhPXIH3KFOgryMEXzTKmugxtjbUcCQDrpXHpYy7MAIcUFpXRWV6BeA/JX3NRugCX6n5NwBrLY+CASViyYctPqnTUKXEz9yRXycuTBdyFr0zJmCxfgKQw=
       Private Key Java : MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAI7Xh680MTnfYDxwyzSqKMhKWed3UP64YMaDkHgBtgCk3odFjoMcDTDumZqeiC1hVICVFR94blrq1ZhxQnFS+UqhXkPbyzuiPZQVBGaZ42y8brGuFiGJVjlo7Sf6GMc14a0d+bLD0C13faGK7PV0YQ7A1xaIIn/fn/Uk4qpOWEhhAgMBAAECgYBO2ZkT1RrLWIxWMOlrY/bpQWnJhSrXwU3ip2OLa15dkqUoRPQ7WbPKbBusp5CChHTSGfm0CpXYaEOKSBMmXWgwuz767/EEpaJfep3OPmKGD+kGPdA3qDYfTMCGRXSX1J47kjLa9XQX6iBmUMAzvTrLS9lZlXPKDhmU6bNZdODH1QJBAO1I/TIcjq7Fd0lwmXigbCs52suZP6/JEVpy6dSVPbZubCnJY3JbG044TN/2Ve4PzMNhmt367k46COpN6Oh1gAMCQQCaG6S2+NL9HTPD2RYmLKF8mXwcYD20WH2qsEGSVZwZma1CzbiwgY0MCUyXue0T/RabkU+oj0v679qy5AtkuULLAkEAzuliwJveX9CZYFTrvyBEsrzUac3Ml0DB/RlPhaxOEBLiBt4x9bo0aVT21CU+cUUdzRIDtaXmwBgjRg2CF5K+eQJAHAZW5+dMBzeeSElcG8kV/OC0jzx5PCizgazX39KttoIZ3gInSgHlMoEmapknIfFugQ/l2pNkj9e6f7m00LZYDQJBAOBCfnJmeppAA07ws2FzfvR880+rYc1gI95BSKK4ZLMoO2w+4k/NQ15K6MqlqwFNzTJq0HBf1MryUcuuASx0sQs=
       Public Key       : MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCO14evNDE532A8cMs0qijISlnnd1D+uGDGg5B4AbYApN6HRY6DHA0w7pmanogtYVSAlRUfeG5a6tWYcUJxUvlKoV5D28s7oj2UFQRmmeNsvG6xrhYhiVY5aO0n+hjHNeGtHfmyw9Atd32hiuz1dGEOwNcWiCJ/35/1JOKqTlhIYQIDAQAB
        ** login work at the [merchant login](https://globalprod.alipaydev.com/login/global.htm?goto=https%3A%2F%2Fglobalprod.alipaydev.com%2Forder%2FmyOrder.htm%3ForderState%3DP_CONFIRMATION) 
----------

**A simple example**
~~~
use Classes\AliPayClass;  
require_once("./Classes/AliPayClass.php");  
try {  
	$alipay = new AliPayClass();  
	$alipay->setInputCharset('utf-8')  
    	   ->setBody('test')  
    	   ->setCurrency('USD')  
    	   ->setNotifyUrl('http://yourip/notify_url.php')  
    	   ->setOutTradeNo('invoice number')  
    	   ->setPartner('Merchant UID/PID')  
    	   ->setReturnUrl('http://yourip/return_url.php')  
    	   ->setSubject('test123')  
    	   ->setTotalFee('total fee')  
    	   ->setKey('key')  
    	   ->setSignType("MD5")  
    	   ->setSplitInfoDisable(1);        
          $alipay->setSubmitAliPay();  
        } catch (Exception $exception) {  
          echo $exception->getMessage();  
        }
  ~~~

**From PHP autocomplete code i see a lot of method instead of above ?**

	Above code are base on api provided from
	https://global.alipay.com/service/website_split/6
 
	  
