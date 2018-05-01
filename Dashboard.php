<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Current Solicitations</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
	
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
							<a class="nav-link" href="#"><h4>Bid Opportunities</h4></a>
						</li>

						<li class="nav-item active">
							<a class="nav-link" href="solicitations.php"><i class="fa fa-money" aria-hidden="true"></i>	Solicitations</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Emails</a>
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
		<div class="container-fluid" id="solicitation-content">

			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#current">Current Bid Opportunities</a></li>
				<li><a data-toggle="tab" href="#SavedBids">Saved Bids</a></li>
				<li><a data-toggle="tab" href="#SubmittedBids">Submitted Bids</a></li>
			</ul>

			<div class="tab-content">
				<div id="current" class="tab-pane fade in active">
					<?php						
					publish_dashboard();
					?>

					<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
					aria-labelledby = "myModalLabel" aria-hidden = "true">

					<div class = "modal-dialog">
						<div class = "modal-content">

							<div class = "modal-header">
								<button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
									&times;
								</button>

								<h4 class = "modal-title" id = "myModalLabel">
									Bid Details
								</h4>
							</div>

							<div class = "modal-body">
								<p><b>Number:</b> <span id="number"></span></p></br>
								<p><b>Final Filing Date:</b> <span id="finalFilingDate"></span></p></br>
								<p><b>Type: </b><span id="type"></span></p></br>
								<p><b>Category: </b><span id="category"></span></p></br>
								<p><b>Title: </b> <span id="title"></span></p></br>
								<p><b>Description: </b><span id="description"></span></p></br>
								<form action="solicitationdescription.php">
									<button type="submit" class="btn btn-success"><b>Submit Proposal</b></button>
								</form>
							</div>
						</div> <!-- /.modal-content -->
					</div> <!-- /.modal-dialog -->
				</div> <!-- /.modal -->									

				
		</div>
		<div id="SavedBids" class="tab-pane fade">
			<h3>Menu 1</h3>
			<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
		<div id="SubmittedBids" class="tab-pane fade">
			<h3>Menu 2</h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		</div>
	</div>
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

<script src="js/custom.js"></script>
</body>
</html>