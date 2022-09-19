<?php 

include_once("database/constants.php");
if (isset($_SESSION["customerid"]) OR isset($_GET["customerid"])) {
	session_destroy();
	$url = $_GET["url"];
	//echo $url;
	header("location:".$url);
}

?>