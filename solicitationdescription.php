<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Solicitation Description</title>
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
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-users" aria-hidden="true"></i> Bidders</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
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
				<h3><i class="fa fa-money" aria-hidden="true"></i>	Download the Documents</h3> </br>
				<p> you can download and view documents individually by selecting each link, or you can download all of the files in a .ZIP format below </p>
			</div>
			<div class="container-fluid" id="solicitation-document_details">
			<?php 	
			
			$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}else{ ?>
			
			
				<?php 						
				$sql="SELECT * FROM document where sid= ". $_SESSION["sid"] ." ";
				$res= mysqli_query($conn,$sql);
				if (mysqli_num_rows($res)>0){
					while($row = mysqli_fetch_object($res)){
						
						$document_title = $row -> dtitle;
						$user = $_SESSION["pid"];
						$sid = $_SESSION["sid"];
						$sql1 = "INSERT INTO bidder_document_upload VALUES('$user','$sid','$document_title')";
						$res1= mysqli_query($conn,$sql1);
						
					
					}
				} ?>
			
				<?php $sql="SELECT * FROM solicitation where sid= ". $_SESSION["sid"] ." ";		
				
				$res= mysqli_query($conn,$sql);
				if(mysqli_num_rows($res)>0){ ?>
						<a href="?Download_all_files">Download all files</a>
						<?php 
						if (isset($_GET['Download_all_files'])){
							runFunction();
						}						
												
						
					// Solicitation Document
						$sql="SELECT * FROM document where sid= ". $_SESSION["sid"] ." and dtype = 'SolicitationDocument' ";
						$res= mysqli_query($conn,$sql);
						if (mysqli_num_rows($res)>0){ ?>						
						
						<p><b> Solicitation Documents </b></p>
						
						<?php $msg="<table id='currentstable' class='table'>
						<thead bgcolor = '#337ab7'>
						<tr>
						<th width = '60%' style = 'height: 15px'> Document</th>
						<th width = '20%' style = 'height: 15px'>       </th>
						<th width = '20%' style = 'height: 15px'> Posted Date</th>
						</tr>
						</thead>";
						echo $msg;
						while($row=mysqli_fetch_object($res)){ ?>
						<tr>
						<td><a href="<?php echo $row -> file ?>" target="_blank"><?php echo $row -> dtitle ?></a></td>
						<td><button type="submit" class="btn btn-success" style = "height: 30px"><b>upload</b></button>  </td>						
						<td><?php echo $row -> posted_date; ?></td>
						</tr>
						<?php }
						$msg1="</table></br>";
						echo $msg1;
					 } 
					// Addenda
					$sql="SELECT * FROM document where sid= ". $_SESSION["sid"] ." and dtype = 'Addenda' ";
					$res= mysqli_query($conn,$sql);
					if (mysqli_num_rows($res)>0){
						$msg="<p><b> Addenda </b></p><table id='currentstable' class='table'>
						<thead bgcolor = '#337ab7'>
						<tr>
						<th width = '60%' style = 'height: 15px'> Document</th>
						<th width = '20%' style = 'height: 15px'>       </th>
						<th width = '20%' style = 'height: 15px'> Posted Date</th>
						</tr>
						</thead>";
						echo $msg;
						while($row=mysqli_fetch_object($res)){ ?>
						<tr>
						<td><a href="<?php echo $row -> file ?>" target="_blank"><?php echo $row -> dtitle ?></a></td>	
						<td><button type="submit" class="btn btn-success" style = "height: 30px"><b>upload</b></button>  </td>
						<td><?php echo $row -> posted_date; ?></td>
						
						</tr>
						<?php }
						$msg1="</table></br>";
						echo $msg1;
					 }
					 
					
					// Required Attachments
					$sql="SELECT * FROM document where sid= ". $_SESSION["sid"] ." and dtype = 'Required Attachments' ";
					$res= mysqli_query($conn,$sql);
					if (mysqli_num_rows($res)>0){
						$msg="<p><b> Required Attachments </b></p><table id='currentstable' class='table'>
						<thead bgcolor = '#337ab7'>
						<tr>
						<th width = '60%' style = 'height: 15px'> Document</th>
						<th width = '20%' style = 'height: 15px'>       </th>
						<th width = '20%' style = 'height: 15px'> Posted Date</th>
						</tr>
						</thead>";
						echo $msg;
						while($row=mysqli_fetch_object($res)){ ?>
						<tr>
						<td><a href="<?php echo $row -> file ?>" target="_blank"><?php echo $row -> dtitle ?></a></td>
						<td><button type="submit" class="btn btn-success" style = "height: 30px"><b>upload</b></button>  </td>						
						<td><?php echo $row -> posted_date; ?></td>
						</tr>
						<?php }
						$msg1="</table></br>";
						echo $msg1;
					 }
					 
					
					// Exhibits
					$sql="SELECT * FROM document where sid= ". $_SESSION["sid"] ." and dtype = 'Exhibits' ";
					$res= mysqli_query($conn,$sql);
					if (mysqli_num_rows($res)>0){
						$msg="<p><b> Exhibits </b></p><table id='currentstable' class='table'>
						<thead bgcolor = '#337ab7'>
						<tr>
						<th width = '60%' style = 'height: 15px'> Document</th>
						<th width = '20%' style = 'height: 15px'>       </th>
						<th width = '20%' style = 'height: 15px'> Posted Date</th>
						</tr>
						</thead>";
						echo $msg;
						while($row=mysqli_fetch_object($res)){ ?>
						<tr>
						<td><a href="<?php echo $row -> file ?>" target="_blank"><?php echo $row -> dtitle ?></a></td>		
						<td><button type="submit" class="btn btn-success" style = "height: 30px"><b>upload</b></button>  </td>												
						<td><?php echo $row -> posted_date; ?></td>
						</tr>
						<?php }
						$msg1="</table></br>";
						echo $msg1;

					 } ?>
					 
					<p><b> Other Documents </b></p>
					<?php
				}
				 }?>
			</div>
		</div>
	</div>

</body>
</html>
