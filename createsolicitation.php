<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Solicitations</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	<script src="js/custom.js"></script>
</head>
<body>
	<?php require_once('submit.php'); ?>
	
	<div id="wrapper" class="container">

		<div class="container-fluid" id="header">
			<img src="download.png" height="45">
		</div>
		<div class="container-fluid" id="heading">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#"><h4>Bid Opportunities Admin</h4></a>
						</li>

						<li class="nav-item active">
							<a class="nav-link" href="solicitations.php"><i class="fa fa-money" aria-hidden="true"></i>	Solicitations</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="email.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> Emails</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="bidder.php?listType=Bidders"><i class="fa fa-users" aria-hidden="true"></i> Bidders</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="bidder.php?listType=Users"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
						</li>

					</ul>
					<ul style="float: right;">
						<li class="nav-item dropdown" >
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $_SESSION["username"]; ?><i class="fa fa-caret-down" aria-hidden="true"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="home.php">Logout</a>
								<!--<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>-->
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="container-fluid" id="solicitation">
			<div class="container-fluid" id="solicitation-header">
				<h2><i class="fa fa-money" aria-hidden="true"></i>	Add Solicitations</h2>				
			</div>
			<div class="container-fluid" id="create-solicitation">
				<?php 
				if(isset($_POST["createsolicitation"])){
					createsolicitation();
				}
				?>
				<form action="createsolicitation.php" method="post" name="createsolicitation">
					<div class="col-sm-6">
						Number <span class="req">(required)</span><br>
						<input type="text" placeholder="2018-" name="snumber" id="snumber" required><br>
						<p style="color:#a8a8a8;">Use numbers only. Example: 2018-1111</p><br>

						Final Filing Date/Time <span class="req">(required)</span>
						<input type="datetime-local" name="sfinalfiling" id="sfinalfiling" value="<?php echo date('Y-m-d').'T15:00'; ?>" required><br><br>

						Type <span class="req">(required)</span><br>
						<select class="form-control" name="stype" id="stype">
							<option value="solicitation">Solicitation</option>
							<option value="cn">Competitive Negotiation (CN)</option>
							<option value="ifb">Invitation for Bid (IFB)</option>
							<option value="rfp">Request for Proposals (RFP)</option>
						</select>

						<br>

						Category <span class="req">(required)</span><br>

						<select class="form-control" name="scategory" id="scategory">
							<option value="it">Information Technology</option>
							<option value="pscc">Personal Services and Consulting Contracts</option>

						</select>


					</div>
					<div class="col-sm-6">
						Title <span class="req">(required)</span> <br>
						<input type="text" name="stitle" id="stitle" required><br>
						<p style="color:#a8a8a8;">Use Title Case.</p><br>
						<br>
						Description <span class="req">(required)</span> <br>

						<textarea id="summernote" name="editordata" style="height: 100px;" required></textarea>

					</div><br>
					<button type="submit" id="submit" name="createsolicitation" class="btn btn-primary" style="border-radius: 0;"><i class="fa fa-floppy-o" aria-hidden="true" style="color: white; "></i> Save</button> 
					<button type="reset" class="btn btn-default" style="border-radius: 0;" onclick="openPage('solicitations.php')">Cancel</button>
					<!--<button type="submit" class="btn btn-danger" style="border-radius: 0;" onclick="openPage('solicitations.php')">Cancel</button>-->

				</form>
			</div>
		</div>
	</div>
	<?php if(isset($_GET['sid'])){
			updatesolicitation($_REQUEST['sid'],0);

	}?>				
	<?php 
		if(isset($_GET['dsid'])){
			updatesolicitation($_REQUEST['dsid'],1);
		}
	?>
	<script>
		$(document).ready(function() {
			$('#summernote').summernote({
				height:200,
				focus:true
			});

		});
	</script>

</body>
</html>
