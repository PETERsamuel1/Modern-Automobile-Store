<?php
date_default_timezone_set('Africa/Nairobi');
//access token

	$consumerKey = 'ZnmysuAv8pAFybITrNX0HOHvPzEOsy9I';
	$consumerSecret = 'DaiAKjhQntAAOw6z';
	$headers = ['Content-Type: application/json; charset=utf8'];
	$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
	$amount = "";
	$phone = "";

	if (isset($_POST["lipaNaMpesa"])) {
		$amount = $_POST["totalamount"];
		$phone = '254'.substr($_POST['phoneno'], 1);
	}

	$curl = curl_init($access_token_url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

	curl_setopt($curl, CURLOPT_HEADER, FALSE);

	curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

	$result = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$result = json_decode($result);
	$access_token = "";
	if ($result != "") {
		$access_token = $result->access_token;
	}else{
		$access_token = "";
	}
	curl_close($curl);

	$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    'Authorization: Bearer '.$access_token,
	    'Content-Type: application/json'
	]);

	$d = array(
		"ShortCode" => 600730,
	    "ResponseType" => "Completed",
	    "ConfirmationURL" => "https://0902-41-89-56-240.ngrok.io/Modernautomobilestore/PAYMENT_API/confirmation_url.php",
	    "ValidationURL" => "https://0902-41-89-56-240.ngrok.io/Modernautomobilestore/PAYMENT_API/validation.php"
	);
	$di = json_encode($d);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $di);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response     = curl_exec($ch);
	curl_close($ch);
	//echo $response;

  	//registerurls
  	/*
  	$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'ShortCode' => '600730',
	  'ResponseType' => 'Confirmed',
	  'ConfirmationURL' => 'https://384e-102-68-141-250.ngrok.io/Modernautomobilestore/PAYMENT_API/confirmation_url.php',
	  'ValidationURL' => 'https://384e-102-68-141-250.ngrok.io/Modernautomobilestore/PAYMENT_API/validation.php'
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	*/
	//print_r($curl_response);

	//echo $curl_response;

	//initiating the transaction

	//defining the variables
	$initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

	$BusinessShortCode = '174379';
	$Timestamp = date('YmdHis');
	$PartyA = $phone;
	$CallBackURL = 'https://0902-41-89-56-240.ngrok.io/Modernautomobilestore/PAYMENT_API/callback_url.php';
	$AccountReference = 'Modern Automobile Store';
	$TransactionDesc = 'Modern Automobile Store';
	$Amount = $amount;
	$Passkey ='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

	$Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

	$stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $initiate_url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header


	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'BusinessShortCode' => $BusinessShortCode,
	  'Password' => $Password,
	  'Timestamp' => $Timestamp,
	  'TransactionType' => 'CustomerPayBillOnline',
	  'Amount' => $Amount,
	  'PartyA' => $PartyA,
	  'PartyB' => $BusinessShortCode,
	  'PhoneNumber' => $PartyA,
	  'CallBackURL' => $CallBackURL,
	  'AccountReference' => $AccountReference,
	  'TransactionDesc' => $TransactionDesc
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	//print_r($curl_response);
	$obj=json_decode($curl_response);
	//echo $curl_response;
	if ($obj != "") {
		$ResponseCode =$obj->{"ResponseCode"};
		if ($ResponseCode == '0') {
		    echo "Your transaction was successful wait for confirmation message from us";
		 }else{
		    echo "An Error occured while processing your transaction. Kindly try again later";
		 }
	}else{
		echo "Your request could not be processed at the moment. Kindly try again later";
	}
	
?>