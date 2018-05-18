<?php require_once('submit_eval.php');?>
 
<html lang="en">
<head>
  <title>Bidder Evaluation</title>
  <!-- <meta charset="utf-8">
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

<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" >


    $(document).ready(function () {
    
 
        //User Variables
        var canvasWidth = 400;                           //canvas width
        var canvasHeight = 60;                           //canvas height
        var canvas = document.getElementById('canvas');  //canvas element
        var context = canvas.getContext("2d");     
        context.fillStyle = "#FF0000";      //context element
        var clickX = new Array();
        var clickY = new Array();
        var clickDrag = new Array();
        var paint;
        //alert(canvas.name);
        
        canvas.addEventListener("mousedown", mouseDown, false);
              canvas.addEventListener("mousemove", mouseXY, false);
              document.body.addEventListener("mouseup", mouseUp, false);
            
              //For mobile
              //canvas.addEventListener("touchstart", mouseDown, false);
              //canvas.addEventListener("touchmove", mouseXY, true);
            //  canvas.addEventListener("touchend", mouseUp, false);
             // document.body.addEventListener("touchcancel", mouseUp, false);

        function draw() {
            context.clearRect(0, 0, canvas.width, canvas.height); // Clears the canvas

            context.strokeStyle = "#000000";  //set the "ink" color
            context.lineJoin = "miter";       //line join
            context.lineWidth = 2;            //"ink" width

            for (var i = 0; i < clickX.length; i++) {
                context.beginPath();                               //create a path
                if (clickDrag[i] && i) {
                    context.moveTo(clickX[i - 1], clickY[i - 1]);  //move to
                } else {
                    context.moveTo(clickX[i] - 1, clickY[i]);      //move to
                }
                context.lineTo(clickX[i], clickY[i]);              //draw a line
                context.stroke();                                  //filled with "ink"
                context.closePath();                               //close path
            }
        }

        //Save the Sig
        $("#saveSig").click(function saveSig() {
            var sigData = canvas.toDataURL("image/png");
            $("#imgData").text(sigData);
        });

        //Clear the Sig
        $('#clearSig').click(
          function clearSig() {
              clickX = new Array();
              clickY = new Array();
              clickDrag = new Array();
              context.clearRect(0, 0, canvas.width, canvas.height);
              $("#imgData").html('');
    });
      
    function addClick(x, y, dragging) {
            clickX.push(x);
            clickY.push(y);
            clickDrag.push(dragging);
        }

    function mouseXY(e) {
       if (paint) {
                addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                draw();
             }
    }

    function mouseUp() {
      paint = false;
    }

    function mouseDown(e)
    {
      var mouseX = e.pageX - this.offsetLeft;
            var mouseY = e.pageY - this.offsetTop;

            paint = true;
            addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
            draw();
    }
      
   });


</script>
  <script src="js/custom.js"></script>
  <!--  <script src="js/signpad.js"></script> -->
  <script type="text/javascript">
  	jQuery(document).ready(function($) {
    $(".btn-success").click(function() {
        //window.location = "bidderEvaluate.php";
        //$(location).attr('href', 'bidderEvaluate.php#profile');
        $('#demoModal').modal('show');
    });    
});  	
    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
}); 
  </script>
 
</head>
<body>
  

  <div id="wrapper" class="container">
  <div class="container-fluid" id="header">
      <img src="download.png" height="45">
  </div>
 
     <div id="panel"> <?php 
        if(isset($_POST["scoreform"])){
          savescore($_GET['bid_id'],$_GET['bidder_id']);
          }    
          if(isset($_POST["acceptform"])){
          accept_bidder($_GET['bid_id'],$_GET['bidder_id']);
          }          
        ?>  
      </div>
 
 <div class="container-fluid" id="heading"> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
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
   <h3><i class="fa fa-user" aria-hidden="true"></i>  Bidder Information</h3>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="active">
      <a  id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Details</a>
    </li>
    <li >
      <a  id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Documents</a>
    </li>
    </ul>
     <form action="" method="POST" id="myForm">
<div class="tab-content" id="myTabContent">
 
  <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <?php getBidder_details(); ?>  
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
     <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Document Number</th>
            <th scope="col">Document Title</th>
            <th scope="col">Document Name</th>            
          </tr>
        </thead>
        <tbody >
           <?php getBidder_document(); ?>    
        </tbody>
        </table>        
  </div>  
 </div> 
 <br>Reviewer Signature <span class="req">(required)</span> <br>
  <div><canvas  id="canvas" width="500" height="100" style="border: 1px solid #ccc;"></canvas></div>
<p><button id="clearSig" type="button">Clear Signature</button>&nbsp;
<button id="saveSig" type="button">Save Signature</button></p>
<div id="imgData" style="width:960px; word-wrap: break-word; text-align:center; display: inline-block;"></div>
<br /><br /> 
</form>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form >
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="scoreModal" tabindex="-1" role="dialog" aria-labelledby="scoreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scoreModalLabel">Score</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
         <form action="bidderEvaluation1.php?bidder_id=<?php echo $_GET['bidder_id'];?>&bid_id=<?php echo $_GET['bid_id'];?>" method="post" 
          name="scoreform">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Score:</label>
            <input type="text" class="form-control" name="score">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Bid Amount:</label>
            <textarea class="form-control" name="bid_amount"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comments:</label>
            <textarea class="form-control" name="comments"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="scoreform" class="btn btn-primary" >Save Score</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" align="center">Required Attachments Certification Checklist</h4>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
             <span aria-hidden="true">&times;</span>
          </button> -->
      </div>
      <div class="modal-body">
        <form action="bidderEvaluation1.php?bidder_id=<?php echo $_GET['bidder_id'];?>&bid_id=<?php echo $_GET['bid_id'];?>" method="post" 
              name="acceptform">
         <!-- <h5 class="modal-title" id="myModalLabel">Are you sure, you want to accept this bidder?</h5> -->

         <table border=1>
           <thead>
            <tr>
            <!-- <th>Proposer Certification</th>       --> 
             <th>Attachment Name/Description</th>
             <th>CalPERS Verification</th>
           </tr>
            </thead>
            <tbody>
           <tr>
          <!--   <td><div class="checkbox">
                <label><input type="checkbox" value="">Yes</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">No</label>
              </div></td> -->
            <td>Submitted Cover Letter signed by an individual authorized to bind the Proposer contractually.</td>
            <td><div class="checkbox">
                <label><input type="checkbox" value="">Yes</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">No</label>
              </div></td>
          </tr>
          <tr>
           <!--  <td><div class="checkbox">
                <label><input type="checkbox" value="">Yes</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">No</label>
              </div></td> -->
            <td>Submitted Minimum Qualifications Certification (Attachment A) signed by an individual authorized to bind the Proposer contractually.</td>
            <td><div class="checkbox">
                <label><input type="checkbox" value="">Yes</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">No</label>
              </div></td>
          </tr>     
          
          </tbody>     
          
         </table>
      
         
    

       <br>Comments <span class="req">(required)</span> <br>
         <textarea id="summernote" name="editordata" style="height: 100px;width: 575px;" required></textarea>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="acceptform" class="btn btn-primary">Save changes</button>
      </div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

