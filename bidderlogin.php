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
			<h4>Bid Opportunities</h4>			
		</div>

		<div class="container-fluid" id="login">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div id="panel">
					<?php 
					if(isset($_POST["registerform"])){
						submit();
					}
					?>

					<h3>Log In</h3>
					<div id="loginform">
						<h4> Username</h4>
						<input type="text"><br>
						<h4> Password</h4>
						<input type="password"><br><br>
						<button type="button" class="btn btn-primary">Log In</button>
					</div>
				</div><br>
				<center><a data-toggle="modal" data-target="#myModal">New to Calpers?</a></center><br>
				<center><a href="forget.php">Forget Password?</a></center>
				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Register</h4>
							</div>
							<div class="modal-body">
								<p>	
									<form name="registerform" action="bidderlogin.php" method="post">							
										First Name: <input type="text" name="f_name" required><br><br>
										Middle Initial: <input type="text" name="m_ini" maxlength="1" size="1" value=""><br><br>
										Last Name: <input type="text" name="l_name" required><br><br>
										Last 4-digit SSN: <input type="password" name="ssn" value=""><br><br>
										<hr>
										Email ID: <input type="Email" name="email" required><br>
										(Email ID will be used as your User Name while login).
										<br>
										Password: <input type="password" name="p1" required> <br><br>
										Confirm-Password <input type="password" name="p2" required><br><br>
									

									</p>
									<button type="submit" name="registerform" onclick="verifyform()">Register</button>
								</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>


	</body>
	</html>
