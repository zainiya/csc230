<?php
//require 'PHPMailer/PHPMailerAutoload.php';
//namespace 'PHPMailer';
//require ("PHPMailer/src/Exception.php");
//require("PHPMailer/src/PHPMailer.php");
//require("PHPMailer/src/SMTP.php");

//use 'PHPMailer/PHPMailer';
//ini_set("SMTP","ssl://smtp.gmail.com");
//ini_set("smtp_port","465");

 //echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
?>

<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bidders</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
	<!--<script src="js/custom.js"></script>-->
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
								<?php echo $_SESSION["username"]; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="home.php">Logout</a>
								
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="container-fluid" id="solicitation">
			<div class="container-fluid" id="solicitation-header">
				<h2>
					<i class='fa fa-envelope-o' aria-hidden='true'></i>	Email
				</h2>

			</div>
			<div class="container-fluid" id="solicitation-content">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<?php 
						if(isset($_POST['group1'])){
								send_email(1,$_POST['subject'], $_POST['message'],$_FILES['emaildoc']);
						}
						if(isset($_POST['group2'])){
								send_email(2, $_POST['subject'], $_POST['message'],$_FILES['emaildoc']);
						}

					?>
					<form name="sendemail" action="email.php" method="post" enctype="multipart/form-data">
						<h3>Subject : </h3> <input type="text" class="form-control" id="subject" name="subject"><br>
						<h3>Message - Box:</h3>
						<!--<textarea rows="4" cols="50" class="form-control" id="message" name="message"></textarea>-->
						<textarea id="message" name="message" style="height: 100px;" required></textarea>
						<!--<input type='file' id='emaildoc' name='emaildoc'>-->
						<br>
						<button class="btn btn-primary" type="submit" name="group1" >Email Bidders</button> 
						<button class="btn btn-warning" type="submit" name="group2" >Email Subscribed Users</button>
					</form>
				</div>
				<div class="col-sm-3"></div>

				
			</div>




		</div>
	</div>
	<script>


		$('.datatable').dataTable({
			"sPaginationType": "simple_numbers",
			"language": {
				"lengthMenu": "<span style='font-weight:100;'><span style='float:left;'>_MENU_ </span> records per page</span>",
				"zeroRecords": "Nothing found - sorry",
				"info": "Showing page _PAGE_ of _PAGES_",
				"infoEmpty": "No records available",
				"search":         "",
			}
		}); 
		$('.datatable').each(function(){
			var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.addClass('form-control input-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.addClass('form-control input-sm');
    });

</script>
<script>
	$(document).ready(function() {
		$('#message').summernote({
			height:200,
			focus:true
		});
	});
</script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script src="js/custom.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>



</body>
</html>

