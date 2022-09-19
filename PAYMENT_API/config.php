<?php 

	function insert_response($jsonMpesaResponse){

		try {
			$con = new PDO("mysql:dbhost-localhost; dbname-payments",'root','');
			echo "Connection Successful";

		} catch (PDOException $e) {
			die("error connecting".$e->getMessage());
		}

		try {
			$insert = $con->prepare("INSERT INTO `mobile_payments`(`TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`)
			 VALUES(:TransactionType, :TransID, :TransTime, :TransAmount, :BusinessShortCode, :BillRefNumber, :InvoiceNumber, :OrgAccountBalance, :ThirdPartyTransID, :MSISDN, :FirstName, :MiddleName, :LastName)");
		$insert->execute((array)($jsonMpesaResponse));
		} 
		catch (PDOException $e) {
			$errLog = fopen('error.txt', 'a'); 

			fwrite($errLog, $e->getMessage());
			fclose($errLog);

			$logFailedTransaction = fopen('failedTransaction.txt', 'a');
			fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
			fclose($logFailedTransaction);

		}
		
	}
 ?>