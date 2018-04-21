<?php
session_start();
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/custom.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/custom.js"></script>
	</head>
	<body>
		<?php require_once('submit.php');?>
		<div id="wrapper" class="container">

			<div class="container-fluid" id="header">
				<img src="download.png" height="45">
			</div>
			<div id="heading" class="container-fluid"> 
				<h4 onclick="openPage('home.php')" style="border-right: 1px solid white; padding-right: 10px;margin-right: 10px; "><span class="glyphicon glyphicon-home"></span> Home</h4>
				<h4>Bid Opportunities Admin</h4>			
			</div>

			<div class="container-fluid" id="login">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<div id="panel">

						<?php 
						if(isset($_POST["adminlogin"])){
							adminlogin();
						}
						?>
						<form name="adminlogin" action="login.php" method="post">							
							<h3>Log In</h3>
							<div id="loginform">
								<h4> Username</h4>
								<input type="email" name="email"><br>
								<h4> Password</h4>
								<input type="password" name="password"><br><br>

								<button type="submit" name="adminlogin" class="btn btn-primary">Log In</button>
							</div>
						</form>

					</div><br>
					<center><a href="#">Request access to this app</a></center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>
	</html>
