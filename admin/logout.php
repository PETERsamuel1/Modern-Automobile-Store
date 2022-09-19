<?php 

include_once("../database/constants.php");
if (isset($_SESSION["adminid"]) OR isset($_GET["adminid"])) {
	session_destroy();
	header("location:".DOMAIN."/");
}

?>