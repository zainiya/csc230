<?php require_once('submit_eval.php');?>
<html lang="en">
<head>
  <title>Bid Evaluator</title>
 <!--  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="topnav.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <script src="bootstrap/js/bootstrap.min.js"></script> -->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

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
</head>
<body>
 <div id="wrapper" class="container">
  <div class="container-fluid" id="header">
      <img src="download.png" height="45">
    </div>
 <div class="container-fluid" id="heading">
 <h4>Bid Opportunities Evaluator</h4>
</div>
<div class="container-fluid" id="solicitation">
  <div class="container-fluid" id="solicitation-header">
    <h2><i class="fa fa-money" aria-hidden="true"></i> Solicitations</h2>
  </div>
  <div class="container-fluid" id="solicitation-content">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="active">
        <a  id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ready to Evaluate</a>
      </li>      
      <li >
        <a id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Awarded</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-hover" id='evalsolT' style="cursor:pointer;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Solicitiation Title</th>
            <th scope="col">No of applications</th>
            <th scope="col">Last Updated</th>
          </tr>
        </thead>
        <tbody >
           <?php getBidList(); ?>    
        </tbody>
        </table>
      </div> 
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>
  </div>
 </div>
</div>
</body>
</html>
