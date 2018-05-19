<?php
session_start();
require_once('submit.php');
$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}else{
	$sid = $_GET["sid"];
	$result = mysqli_query($conn,"SELECT * FROM solicitation WHERE sid='$sid'");
	$solicitationdetails = mysqli_fetch_object($result);
	echo json_encode($solicitationdetails);	
	$_SESSION["sid"] = $sid; 
	//echo $_SESSION["sid"];

}
?>