<?php
header('Content-Type: application/json');
include_once("../database/constants.php");
include_once("./user.php");
include_once("./service.php");

if (isset($_POST["getSingleCategory"])) {
	$service = new Service();
	$rows = $service->getSingleRecord("category_table","id",$_POST["id"]);
	echo json_encode($rows);
}

if (isset($_POST["getCategoryAndProduct"])) {
	$service = new Service();
	$rows = $service->getCategoryAndProduct($_POST["proid"]);
	echo json_encode($rows);
}

if (isset($_POST["getBillingDetails"])) {
	$user = new User();
	$rows = $user->getCustomerDetails($_POST["userid"]);
	echo json_encode($rows);
}

if (isset($_POST["getCategoryName"])) {
	$service = new Service();
	$rows = $service->getCategoryById($_POST["cat_id"]);
	echo json_encode($rows);
}

if (isset($_POST["getProductGraph"])) {
	$service = new Service();
	$rows = $service->getProductGraph();
	echo json_encode($rows);
}

if (isset($_POST["getPaymentGraph"])) {
	$service = new Service();
	$rows = $service->getPaymentGraph();
	echo json_encode($rows);
}

?>