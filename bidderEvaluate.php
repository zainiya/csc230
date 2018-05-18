<?php require_once('submit_eval.php');?>
<html lang="en">
<head>
  <title>Bidder Evaluation</title>
  <!-- <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="topnav.css"> -->

   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
  <!-- blueimp Gallery styles -->
  <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
  <script src="js/custom.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
          window.location = $(this).data("href");
      });   
    });  	
  </script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<div id="wrapper" class="container">
  <div class="container-fluid" id="header">
    <img src="download.png" height="45">
  </div>
   <div class="container-fluid" id="heading"> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" >
          <li class="nav-item active">
            <a class="nav-link" href="#"><h4>Bid Opportunities Evaluator</h4></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="bidEvaluator.php"><i class="fa fa-money" aria-hidden="true"></i> Solicitations</a>
          </li>
        </ul>
        <ul style="float: right;">
          <li class="nav-item dropdown" >
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php //cho $_SESSION["username"]; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
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
       <?php getBid(); ?>      
    <div class="container-fluid" id="solicitation-content">
      <h2><i class="fa fa-users" aria-hidden="true"></i>  Bidders</h2>
      <?php getBidderList(); ?>
    </div>
</div>
</div>
</body>
</html>
