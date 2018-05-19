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
	<script src="js/custom.js"></script>
</head>
<body>
	<?php require_once('submit_bidder.php'); ?>
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
							<a class="nav-link" href="Dashboard.php"><i class="fa fa-money" aria-hidden="true"></i>	Solicitations</a>
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
							$status='Published';
							$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}else{
								$sql2="SELECT * FROM solicitation where status = '$status' order by sid";
								$res2= mysqli_query($conn,$sql2);
								$pid = $_SESSION["pid"];
								if(mysqli_num_rows($res2)>0){
									while($row=mysqli_fetch_object($res2)){
										$sid = $row -> sid;
										$pid = $_SESSION["pid"];
										$title = $row -> stitle;
										$sql3 = "INSERT IGNORE into bid_status(pid,sid,stitle,bid_status) values ('$pid','$sid','$title','New')";
										$res3= mysqli_query($conn,$sql3);
										
									}
									
								}
								
								$sql="SELECT * FROM bid_status where bid_status = 'New' and pid = '$pid' order by sid";
								$res= mysqli_query($conn,$sql);
								//$msg="";
								if(mysqli_num_rows($res)>0){
									$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
									<thead>
									<tr>
									<th width = '30%' height = '50' onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
									<th width = '70%' height = '50' onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
									<th width = '70%' height = '50'> Action</th>
									</tr>
									</thead>";
									echo $msg; ?>
									<?php 

									while($row=mysqli_fetch_object($res)){
									?>
										<tr>
										<td><?php echo $row -> sid; ?></td>				
										<td><?php echo $row -> stitle; ?></td>
										<td> <button class = "btn btn-success" data-toggle = "modal" data-target = '#myModal' id = "<?php echo $row->sid ?>" onclick="showdetails(this);"><b>DETAILS</b></button></td>
										</tr>
									<?php }
									$msg1="</table>";
									echo $msg1; ?>
												
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
												<form action="solicitationdescription_bidder.php">
												<button type="submit" class="btn btn-success"><b>Submit Proposal</b></button>

												</form>
											 </div>
										  </div> <!-- /.modal-content -->
										</div> <!-- /.modal-dialog -->
										</div> <!-- /.modal -->									
									
								<?php }


							}	?>					

					</div>
					<div id="SavedBids" class="tab-pane fade">
						<?php						
							$status='Published';
							$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}else{
								/* $sql2="SELECT * FROM solicitation where status = '$status' order by sid";
								$res2= mysqli_query($conn,$sql2);
								if(mysqli_num_rows($res2)>0){
									while($row=mysqli_fetch_object($res2)){
										$sid = $row -> sid;
										$pid = $_SESSION["pid"];
										$title = $row -> stitle;
										$sql3 = "INSERT IGNORE into bid_status(pid,sid,stitle,bid_status) values ('$pid','$sid','$title','New')";
										$res3= mysqli_query($conn,$sql3);
										
									}
									
								} */
								
								$sql4="SELECT * FROM bid_status where bid_status = 'Saved' and pid = '$pid' order by sid";
								$res4= mysqli_query($conn,$sql4);
								//$msg="";
								if(mysqli_num_rows($res4)>0){
									$msg="<table id='currentstable1' class='table table-striped table-bordered datatable'>
									<thead>
									<tr>
									<th width = '30%' height = '50' onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
									<th width = '70%' height = '50' onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
									<th width = '70%' height = '50'> Action</th>
									</tr>
									</thead>";
									echo $msg; ?>
									<?php 

									while($row=mysqli_fetch_object($res4)){
									?>
										<tr>
										<td><?php echo $row -> sid; ?></td>				
										<td><?php echo $row -> stitle; ?></td>
										<td> <button class = "btn btn-success" data-toggle = "modal" data-target = '#myModal1' id = "<?php echo $row->sid ?>" onclick="showdetails_savedBids(this);"><b>CONTINUE</b></button></td>
										</tr>
									<?php }
									$msg1="</table>";
									echo $msg1; ?>
												
									<div class = "modal fade" id = "myModal1" tabindex = "-1" role = "dialog" 
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
												<p><b>Number:</b> <span id="number1"></span></p></br>
												<p><b>Final Filing Date:</b> <span id="finalFilingDate1"></span></p></br>
												<p><b>Type: </b><span id="type1"></span></p></br>
												<p><b>Category: </b><span id="category1"></span></p></br>
												<p><b>Title: </b> <span id="title1"></span></p></br>
												<p><b>Description: </b><span id="description1"></span></p></br>
												<form action="solicitationdescription_bidder.php">
												<button type="submit" class="btn btn-success"><b>Submit Proposal</b></button>
												</form>
											 </div>
										  </div> <!-- /.modal-content -->
										</div> <!-- /.modal-dialog -->
										</div> <!-- /.modal -->									
									
								<?php }
							}	?>	
					</div>
					<div id="SubmittedBids" class="tab-pane fade">
						<?php						
							$status='Published';
							$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}else{
								
								$sql5="SELECT * FROM bid_status where bid_status = 'Submitted' and pid = '$pid' order by sid";
								$res5= mysqli_query($conn,$sql5);
								//$msg="";
								if(mysqli_num_rows($res5)>0){
									$msg="<table id='currentstable1' class='table table-striped table-bordered datatable'>
									<thead>
									<tr>
									<th width = '30%' height = '50' onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
									<th width = '70%' height = '50' onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
									<th width = '70%' height = '50'> Status</th>
									</tr>
									</thead>";
									echo $msg; ?>
									<?php 

									while($row=mysqli_fetch_object($res5)){
									?>
										<tr>
										<td><?php echo $row -> sid; ?></td>				
										<td><?php echo $row -> stitle; ?></td>
										<td> <?php echo $row -> bid_status; ?></td>
										</tr>
									<?php }
									$msg1="</table>";
									echo $msg1; ?>								
									
								<?php }
							}	?>	
					</div>
				</div>
			</div>




		</div>
	</div>
<script>
  
function showdetails(button){
	var sid = button.id;

	$.ajax({
		url: "details.php",
		method: "GET",
		data: {"sid":sid},
		success: function(response){
			var solicitationdetails = JSON.parse(response);
			//$("#number").text("12");
			$("#number").text(solicitationdetails.sid);
			//$_SESSION["sid"] = $("#number").text(solicitationdetails.sid); 
			$("#finalFilingDate").text(solicitationdetails.final_filing_date);
			$("#type").text(solicitationdetails.type);
			$("#category").text(solicitationdetails.category);	
			$("#title").text(solicitationdetails.stitle);
			$("#description").text(solicitationdetails.description);				
		}
	});
}

function showdetails_savedBids(button){
	var sid = button.id;
	$.ajax({
		url: "details_SavedBids.php",
		method: "GET",
		data: {"sid":sid},
		success: function(response){
			var solicitationdetails = JSON.parse(response);
			$("#number1").text(solicitationdetails.sid);
			$("#finalFilingDate1").text(solicitationdetails.final_filing_date);
			$("#type1").text(solicitationdetails.type);
			$("#category1").text(solicitationdetails.category);	
			$("#title1").text(solicitationdetails.stitle);
			$("#description1").text(solicitationdetails.description);				
		}
	});
}

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


</body>
</html>