<?php
date_default_timezone_set('America/Los_Angeles');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csc230";

function getBidList(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
	 		$sql = "SELECT a.sid, a.stitle, count(*) cnt, a.last_updated  FROM bid_transactions bt, solicitation a where a.sid=bt.bid_id group by a.sid";
  			$result = mysqli_query($conn, $sql);

  			 while($row = mysqli_fetch_array($result))
              {
                  echo '  
                       <tr class="clickable-row" data-href="bidderEvaluate.php?bid_id='.$row["sid"].'">  
                            <td>'.$row["sid"].'</td>  
                            <td>'.$row["stitle"].'</td>  
                            <td>'.$row["cnt"].'</td> 
                            <td>'.$row["last_updated"].'</td>
                       </tr>  
                       ';
              }
  		}
   
}
 
function savescore($bid_id, $bidder_id){

	$score=$_POST["score"];
	$bid_amt=$_POST["bid_amount"];
	$comments=$_POST["comments"];
	
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
			$sql = "UPDATE bid_transactions SET eval_status='Scored', score=".$score.", bid_amount=". $bid_amt . ", comments='" . $comments . "' WHERE bidder_id=" . $bidder_id ." and bid_id = '". $bid_id."'";

			if (mysqli_query($conn,$sql) === TRUE) {
				echo "<font color='green'>Scored!!</font>";
			} else {
				echo "Sorry!! something went wrong.".$sql;
			}

			mysqli_close($conn);

		}	
}

function accept_bidder($bid_id, $bidder_id){

	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{

    	$sql = "UPDATE bid_transactions SET eval_status='Accepted' WHERE bidder_id=" .$bidder_id." and bid_id = '".$bid_id."'";
	if (mysqli_query($conn,$sql) === TRUE) {
				echo "<font color='green'>Accepted!!</font>";
			} else {
				echo "Sorry!! something went wrong.".$sql;
			}
			mysqli_close($conn);
		}	          
}

function getBid(){

	$bid_id = $_GET['bid_id'];
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
			$query = "SELECT sid, stitle from solicitation where sid = '$bid_id'";
  			$bid_result = mysqli_query($conn, $query);
if(mysqli_num_rows($bid_result)>0){
			while($bid = mysqli_fetch_assoc($bid_result))
            {
       			echo '  <div class="alert alert-success" >Solicitation No.'.$bid["sid"].'</div>  
                		<table class="table">
							<tbody>
								<!--<tr>
									<th scope="row">Awarded Date</th>
									<td> at 3:00 p.m. (Pacific Time)</td>
									<td>05/11/2018 at  (Pacific Time)</td>
								</tr>-->
								<tr>
									<th scope="row">Name</th>
									<td>Professional Actuarial Services Spring-Fed Pool</td>
								</tr>
								<tr>
									<th scope="row">Type</th>
									<td>Request for Proposal</td>
								</tr>
								<tr>
									<th scope="row">Description</th>
									<td><p>CalPERS is seeking proposals from qualified firms who have experience in performing professional actuarial services related to retirement, healthcare, and long-term care programs for the Professional Actuarial Services Spring-Fed Pool.CalPERS intends to enter into contracts for up to five (5) years, effective November 1, 2018.</p>
						</td>
								</tr>
							</tbody>
						</table>
           			';
          }}
      }	
}

function getBidderList(){

  $id =$_GET['bid_id'];
  
  $conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
			    $eval_status = "select * from eval_status order by id asc";
			    $eval_result = mysqli_query($conn, $eval_status);
			        
			 $tab_menu = '';
			$tab_content = '';
			$i = 0;
			while($row = mysqli_fetch_array($eval_result))
			{
			 if($i == 0)
			 {
			  $tab_menu .= '
			   <li class=" active"><a class="active" href="#'.$row["description"].'" data-toggle="tab">'.$row["description"].'</a></li>
			  ';
			  $tab_content .= '
			   <div id="'.$row["description"].'" class="tab-pane fade in active"><table class="table table-hover">  
			                          <tr>  
			                               <th >#</th>  
			                               <th >Firstname</th>  
			                               <th >Lastname</th>  
			                               <th >Email</th>  
			                               <th >Submitted date</th>  
			                          </tr>  
			  ';
			 }
			 else
			 {
			  $tab_menu .= '
			   <li ><a class="nav-link" href="#'.$row["description"].'" data-toggle="tab">'.$row["description"].'</a></li>
			  ';
			  if ($row["description"] == "Scored"){
			  $tab_content .= '
			   <div id="'.$row["description"].'" class="tab-pane fade"><table class="table table-hover">  
			                          <tr>  
			                               <th >#</th>  
			                               <th >Firstname</th>  
			                               <th >Lastname</th>  
			                               <th >Email</th>  
			                               <th >Submitted date</th>
			                               <th> Score </th>
			                               <th> Ammount </th>
			                               <th> Comments </th>   
			                          </tr>  
			  ';
			  }else {
			    $tab_content .= '
			   <div id="'.$row["description"].'" class="tab-pane fade"><table class="table table-hover">  
			                          <tr>  
			                               <th >#</th>  
			                               <th >Firstname</th>  
			                               <th >Lastname</th>  
			                               <th >Email</th>  
			                               <th >Submitted date</th>   
			                          </tr>  
			  ';
			  }
			 }
			 $bidder_query = "SELECT b.pid, b.f_name, b.l_name, b.email, bt.date_submtd, bt.eval_status, bt.score, bt.bid_amount, bt.comments FROM bid_transactions bt,  person b where b.pid=bt.bidder_id and bt.bid_id ='$id' and bt.eval_status = '".$row["description"]."' group by b.pid ";
			 $bidder_result = mysqli_query($conn, $bidder_query);
			 while($sub_row = mysqli_fetch_array($bidder_result))
			 {
			  if ($row["description"] == "Rejected"){
			    $tab_content .= '
			  <tr >  
			                      <td>'.$sub_row["pid"].'</td>  
			                      <td>'.$sub_row["f_name"].'</td>  
			                      <td>'.$sub_row["l_name"].'</td> 
			                      <td>'.$sub_row["email"].'</td> 
			                      <td>'.$sub_row["date_submtd"].'</td> 
			                  </tr> ';
			  }elseif ($row["description"] == "Scored"){
			    $tab_content .= '
			  <tr >  
			                      <td>'.$sub_row["pid"].'</td>  
			                      <td>'.$sub_row["f_name"].'</td>  
			                      <td>'.$sub_row["l_name"].'</td> 
			                      <td>'.$sub_row["email"].'</td> 
			                      <td>'.$sub_row["date_submtd"].'</td> 
			                      <td>'.$sub_row["score"].'</td> 
			                      <td>'.$sub_row["bid_amount"].'</td> 
			                      <td>'.$sub_row["comments"].'</td> 
			                  </tr> ';
			  }
			  else {

			  $tab_content .= '
			  <tr class="clickable-row" data-href="bidderEvaluation1.php?bidder_id='.$sub_row["pid"].'&bid_id='.$_GET['bid_id'].'">  
			                      <td>'.$sub_row["pid"].'</td>  
			                      <td>'.$sub_row["f_name"].'</td>  
			                      <td>'.$sub_row["l_name"].'</td> 
			                      <td>'.$sub_row["email"].'</td> 
			                      <td>'.$sub_row["date_submtd"].'</td> 
			                  </tr>';
			                }
			 }

			 $tab_content .= '</table><div style="clear:both"></div></div>';
			  $i++;			 
			}
		}
		echo '
			<ul class="nav nav-tabs">'
				.$tab_menu.' 
   			</ul>
   			<div class="tab-content">'
             .$tab_content.'
 			</div>
 			';

}

function getBidder_details(){

	$bid_id = $_GET['bid_id'];
    $bidder_id = $_GET['bidder_id'];
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
 		    
	    $sql ="SELECT b.pid, b.f_name, b.l_name, b.email, b.creationDate, bt.eval_status FROM bid_transactions bt,  person b where b.pid='$bidder_id' and bt.bid_id ='$bid_id' and b.pid=bt.bidder_id";
	       
	  $result = mysqli_query($conn, $sql);

	  while($row = mysqli_fetch_array($result))
	  {
	       echo '<p>
	      Name : '.$row["f_name"].'  '.$row["l_name"].' <br>
	      Address : Sac State <br>
	      City : Sacramento <br>
	      Phone : 999-999-9999 <br> 
	      Email : '.$row["email"].'</p>       
	            ';
	      if ($row["eval_status"]=="Submitted")
	      {
	        echo '
	            <button type="button" class="btn btn-success">Pre-Evaluate</button>
	            <!--button type="button" class="btn btn-danger">Reject</button>
	            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Send Clarification</button-->
	            ';
	      }elseif($row["eval_status"]=="Scored")
	      {
	      	echo '
    		<a class="btn btn-link" href="bidderEvaluate.php?bid_id='.$_GET['bid_id'].' " role="button">Back</a>
    		';   
	      }
	      else {
	        echo ' <button type="button" class="btn btn-info" data-toggle="modal" data-target="#scoreModal" data-whatever="@mdo">Click here to enter Score</button>';
	         echo '
   			 <a class="btn btn-link" href="bidderEvaluate.php?bid_id='.$_GET['bid_id'].' " role="button">Cancel</a>
    			';   
	      }
  		}    
   
	}
}
function getBidder_document(){

	$bid_id = $_GET['bid_id'];
    $bidder_id = $_GET['bidder_id'];
	
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
	$doc_sql ="SELECT * FROM `bidder_documents` WHERE bid_trans_id in (SELECT bt.id FROM bid_transactions bt, person b where b.pid='$bidder_id' and bt.bid_id ='$bid_id' and b.pid=bt.bidder_id)";

     $doc_result = mysqli_query($conn, $doc_sql);
	 while($row = mysqli_fetch_array($doc_result))
              {
                  echo '  
                       <tr class="clickable-row" data-href="bidderEvaluate.php?id='.$row["dno"].'">  
                            <td>'.$row["dno"].'</td>  
                            <td>'.$row["dtitle"].'</td>                            
                            <td><a href="'.$row['file'].'" target="_blank">'.$row['file_name'].'</a></td>
                       </tr>  
                       ';
              }
          }
}

?>