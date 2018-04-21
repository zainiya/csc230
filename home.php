<?php
session_start();
session_unset(); 
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Calpers</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>
</head>
<body>
	<div id="wrapper" class="container">

		<div class="container-fluid" id="header">
			<img src="download.png" height="45">
		</div>
		<div id="heading" class="container-fluid"> 
			<h4 style="border-right: 1px solid white; padding-right: 10px;margin-right: 10px; ">
				<a href="https://www.calpers.ca.gov/" style="color: white;"><span class="glyphicon glyphicon-home"></span> Home</a>
			</h4>

			<h4>Bid Opportunities</h4>			
		</div>

		<div class="container-fluid" id="home">
			<div class="col-sm-3"></div>
			<div class="col-sm-3">
				<button type="button" class="btn btn-primary" onclick="openPage('bidderlogin.php')">Bidder Login
				</button>
			</div>
			<div class="col-sm-3">
				<button type="button" class="btn btn-warning" onclick="openPage('login.php')">Bidops Login</button>
			</div>
			<div class="col-sm-3"></div>

		</div>
	</div>
</body>
</html>
