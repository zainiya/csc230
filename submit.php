<?php

require ("PHPMailer/src/Exception.php");
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");


date_default_timezone_set('America/Los_Angeles');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csc230";


function submit(){

	$f_name=$_POST["f_name"];
	$m_ini=$_POST["m_ini"];
	$l_name=$_POST["l_name"];
	$ssn=$_POST["ssn"];
	$email = $_POST["email"];
	$p1 = $_POST["p1"];
	$p2 = $_POST["p2"];
	if(strcmp($p1, $p2)==0){
	// Create connection
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

	// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
			$sql = "INSERT INTO person (f_name, m_init, l_name, email, ssn, password, rid)
			VALUES ('$f_name', '$m_ini', '$l_name', '$email','$ssn', '$p1',". 2 .")";

			if (mysqli_query($conn,$sql) === TRUE) {
				echo "<font color='green'>Your account has been created successfully!!<br> LogIn to continue.</font>";
			} else {
				echo "Sorry!! something went wrong.".$sql;
			}

			mysqli_close($conn);

		}

	}else{
		echo "Password doesnot match!";
	}
}

function adminlogin(){
	$email=$_POST["email"];
	$password=$_POST["password"];
	
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		
		$sql = "Select * from person where email='$email' and password='$password' and rid=1";
		$res=mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_assoc($res))
			{
				$sql1= "select * from adminlogs where pid=".$row['pid'];
				$res1=mysqli_query($conn,$sql1);

				if(mysqli_num_rows($res1)==0){

					$sql2="insert into adminlogs (pid,incorrectcnt) VALUES (".$row['pid'].",0)";
					mysqli_query($conn,$sql2);

				}
				else{
					$sql2="update adminlogs set lastlogin= now(), incorrectcnt=0 where pid=".$row['pid'];
					echo mysqli_query($conn, $sql2);
					$_SESSION["username"] = $row['f_name'];
					$_SESSION["user"] = $email;
					$_SESSION["pid"] = $row['pid'];
					header('Location: solicitations.php');
				}
			}
			
		}else{

			$sql= "Select * from person where (email= '$email' or password= '$password' ) and rid=1";//means user have put incorrect email or password
			$res= mysqli_query($conn,$sql);

			if(mysqli_num_rows($res)>0){
				
				while($row=mysqli_fetch_assoc($res)){
					
					$sql1="select * from adminlogs where pid=".$row['pid'];
					$res1=mysqli_query($conn,$sql1);

					if(mysqli_num_rows($res1)>0){
						while($row1=mysqli_fetch_assoc($res1)){
							
							$cntleft=4-$row1['incorrectcnt'];
							echo "you have maximum ". $cntleft. " more try left";//blocking account feature is left
							$cntupdate = $row1['incorrectcnt']+1;
							$sql2="UPDATE adminlogs SET lastincorrect= now() , incorrectcnt=". $cntupdate . " where pid=".$row['pid'];
							mysqli_query($conn, $sql2);

						}
					}else{ 

						$sql2="INSERT INTO adminlogs (pid,incorrectcnt) VALUES (".$row['pid'].",1)";
						mysqli_query($conn,$sql2);

					}
				}
			}else{
				echo "you do not have admin privilages! Please go to home page and try bidder login";
			}

		}

		mysqli_close($conn);

	}

}
function userlogin(){
	$email=$_POST["email"];
	$password=$_POST["password"];
	
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{		
		$sql = "Select * from person where email='$email' and password='$password' and rid=2";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			while($row = mysqli_fetch_object($res)){
				//$document_title = $row -> file;
				$_SESSION["username"] = $row -> f_name; 
				$_SESSION["pid"] = $row -> pid;
				header('Location: Dashboard.php');
			}
		}
		else{
			$sql= "Select * from person where email= '$email' and password != '$password' and rid=2";//means user have put incorrect email or password
			$res= mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				echo "Entered Password is incorrect! Please try again"; }
				else{
				$sql= "Select * from person where email != '$email' and password = '$password' and rid=2";//means user have put incorrect email or password
				$res= mysqli_query($conn,$sql);
				if(mysqli_num_rows($res)>0){
					echo "Entered UserName is incorrect! Please try again";} 
					else{
						echo "You are not registered user. Kindly sign up in order to proceed";} 
					}	
				}

		//mysqli_close($conn);
			}

		}
		function createsolicitation(){
			if(!empty($_POST["snumber"]) && 
				!empty($_POST["sfinalfiling"]) &&
				!empty($_POST["stype"]) &&
				!empty($_POST["scategory"]) &&
				!empty($_POST["stitle"]) &&
				!empty($_POST["editordata"])
			) {	$sid=$_POST["snumber"];
				$finalfiling=$_POST["sfinalfiling"];
			$type=$_POST["stype"];
			$category=$_POST["scategory"];
			$title = $_POST["stitle"];
			$description = $_POST["editordata"];
			$newfinalfiling= str_replace("T", " ", $finalfiling);


			$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}else{
		//add code for updating the data

				$sql="SELECT * FROM solicitation WHERE sid='$sid'";
				$res=mysqli_query($conn,$sql);
				if(mysqli_num_rows($res)>0){
			$sql="UPDATE solicitation SET stitle='$title', type='$type', category='$category', last_updated=now(), description='$description' where sid='$sid'";// update query needs to be fired final filinig date updating feature is left
			if(mysqli_query($conn,$sql)){
				
				echo "<font color='green'>Solicitation has been updated on ".date("Y-m-d h:i:sa")."</font>";
			}else{
				echo "<font color='red'>Error while updating solicitation</font><br><br>";
			}
		}else{

			$sql="INSERT into solicitation 
			(pid, sid, stitle, type, category, status, final_filing_date, description) VALUES 
			(".$_SESSION["pid"].", '$sid', '$title' , '$type', '$category', 'New', '$newfinalfiling', '$description')";

			if(mysqli_query($conn,$sql)){
				echo "<font color='green'>solicitation has been created by ". $_SESSION["username"] ." !!</font>";
			}else {
				echo "<font color='red'>Error while creating solicitation</font><br><br>";
			}



		}

	}

}else {
	echo "<font color='red'>Fill the required inputs!!</font><br><br>";
}
}

function currentSolicitation($awardedFlag=0){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{

		$sql="SELECT * FROM solicitation where cancelflag=0 and status='Published' order by sid";
		if($awardedFlag==1){
			$sql="SELECT * FROM solicitation where cancelflag=0 and status='Awarded' order by sid";
		}
		//		(pid, sid, stitle, type, category, status, final_filing_date, description) VALUES 
		//(".$_SESSION["pid"].", $sid, '$title' , '$type', '$category', 'created', '$newfinalfiling', '$description')";
		$res= mysqli_query($conn,$sql);
		//$msg="";
		if(mysqli_num_rows($res)>0){
			$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
			<thead>
			<tr>
			<th onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
			<th onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(2)'> Status <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(3)'> Final Filing Date <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(4)'> Last Updated <span class='glyphicon glyphicon-sort'></span></th>
			</tr>
			</thead>";

				//<td>".$row["sid"]."</td>

			while($row=mysqli_fetch_assoc($res)){

				$msg=$msg."<tr>
				<td><a href='document.php?type=View&dsid=".$row["sid"]."'>".$row["sid"]."</a></td>				

				<td>".$row["stitle"]."</td>
				<td>".$row["status"]."</td>
				<td>".$row["final_filing_date"]."</td>
				<td>".$row["last_updated"]."</td>
				</tr>";
			}
			$msg=$msg."</table>";
			echo $msg;
		}


	}
}
function byme($archiveFLag=0){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="SELECT * FROM solicitation where pid=".$_SESSION["pid"]." and cancelflag=0 order by sid";
		if($archiveFLag==1){
			$sql="SELECT * FROM solicitation where pid=".$_SESSION["pid"]." and cancelflag=0 and status!='Published' order by sid";	
		}
		//		(pid, sid, stitle, type, category, status, final_filing_date, description) VALUES 
		//(".$_SESSION["pid"].", $sid, '$title' , '$type', '$category', 'created', '$newfinalfiling', '$description')";
		$res= mysqli_query($conn,$sql);
		//$msg="";
		if(mysqli_num_rows($res)>0){
			$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
			<thead>
			<tr>
			<th onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
			<th onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(2)'> Status <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(3)'> Final Filing Date <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(4)'> Last Updated <span class='glyphicon glyphicon-sort'></span></th>
			</tr>
			</thead>";


//<td onclick='updatesolicitation(".$row["sid"].")'>".$row["sid"]."</td>
			while($row=mysqli_fetch_assoc($res)){
				if($row['status']=="Published"){

					$msg=$msg."<tr>
					<td><a href='document.php?type=Update&dsid=".$row["sid"]."'>".$row["sid"]."</a></td>				
					<td>".$row["stitle"]."</td>
					<td>".$row["status"]."</td>
					<td>".$row["final_filing_date"]."</td>
					<td>".$row["last_updated"]."</td>
					</tr>";

				}else{
					$msg=$msg."<tr>
					<td><a href='document.php?type=Update&sid=".$row["sid"]."'>".$row["sid"]."</a></td>				
					<td>".$row["stitle"]."</td>
					<td>".$row["status"]."</td>
					<td>".$row["final_filing_date"]."</td>
					<td>".$row["last_updated"]."</td>
					</tr>";
				}
			}
			$msg=$msg."</table>";
			echo $msg;
		}


	}
}

function updatesolicitation($sid,$flag){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="";
		if($flag==0){
			$sql="SELECT * from solicitation where sid='$sid' and pid=". $_SESSION["pid"];
		}if($flag==1){
			$sql="SELECT * from solicitation where sid='$sid'";

		}
		//echo $sql;
		$res= mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)>0){
			//header('Location: createsolicitation.php');
			while($row=mysqli_fetch_assoc($res)){

				echo "
				<script type=\"text/javascript\">
				setvalues(\"".$row["sid"]. "\", \"".$row["stitle"]."\",\"".$row["type"]."\",\"".$row["category"]."\", \"".$row["status"]. 
				"\", \"".$row["final_filing_date"]."\", \"".$row["description"]."\", ".$flag.");
				</script>
				";
			}
		}
	}

}

function viewAllDocument(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		if(isset($_GET['sid'])){
			$solid=$_GET['sid'];

		}else if (isset($_GET['dsid'])) {
			$solid=$_GET['dsid'];
		}
		$sql= "select * from document where sid='".$solid."'";
	//file_name, sid, dtitle, posted_date, due_date, file
		$res= mysqli_query($conn,$sql);
		$msg="<table id='documentTable' class='table table-striped'><thead>
		<th>File Name</th>
		<th>Posted Date</th>
		<th>Due Date</th>
		<th>Option</th>
		</thead>";
		while($row=mysqli_fetch_assoc($res)){
			$msg=$msg. "<tr>
			<td><a href='".$row['file']."' target='_blank'>".$row['file_name']."</a></td>
			<td>".$row['posted_date']."</td>
			<td>".$row['due_date']."</td>
			<td><a href='document.php?type=Update&sid=".$_SESSION['sid']."&delid=".$row['dno']."' class='btn btn-danger' id='delete'><i class='glyphicon glyphicon-trash'></i> Delete </td>
			</tr>";
			/*			<td><a href='document.php?type=Update&sid=".$_SESSION['sid']."&delid=".$row['dno']."' ><button type='button' class='btn btn-danger' id='delete' onclick='deletefn(".$row['dno'].")'><i class='glyphicon glyphicon-trash'></i> Delete</button> </td>*/

		}
		$msg=$msg."</table>";
		
		echo $msg;
		

	}

}

function deletefile($dno){

	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="DELETE FROM document WHERE dno=$dno";
		if (mysqli_query($conn, $sql)) {
			$_GET['msg']='File has been deleted!!';
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}

		mysqli_close($conn);
	}

}

function cancelSolicitation($cansid){

	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="Update solicitation set cancelflag=1, status='cancelled' WHERE sid=$cansid";
		if (mysqli_query($conn, $sql)) {

			echo 'Solicitation has been deleted!!';
			header('Location: solicitations.php');
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
	mysqli_close($conn);
}

function cancelledSolicitation(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="SELECT * FROM solicitation where cancelflag=1 order by sid";
		//		(pid, sid, stitle, type, category, status, final_filing_date, description) VALUES 
		//(".$_SESSION["pid"].", $sid, '$title' , '$type', '$category', 'created', '$newfinalfiling', '$description')";
		$res= mysqli_query($conn,$sql);
		//$msg="";
		if(mysqli_num_rows($res)>0){
			$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
			<thead>
			<tr>
			<th onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
			<th onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(2)'> Status <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(3)'> Final Filing Date <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(4)'> Last Updated <span class='glyphicon glyphicon-sort'></span></th>
			</tr>
			</thead>";

				//<td>".$row["sid"]."</td>

			while($row=mysqli_fetch_assoc($res)){

				$msg=$msg."<tr>
				<td><a href='document.php?type=View&dsid=".$row["sid"]."'>".$row["sid"]."</a></td>				

				<td>".$row["stitle"]."</td>
				<td>".$row["status"]."</td>
				<td>".$row["final_filing_date"]."</td>
				<td>".$row["last_updated"]."</td>
				</tr>";
			}
			$msg=$msg."</table>";
			echo $msg;
		}


	}
}

function publishSolicitation($pubsid){


	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="update solicitation set status='Published' where sid='".$pubsid."'";
		if (mysqli_query($conn, $sql)) {

			echo 'Solicitation has been Published!!';
			header('Location: solicitations.php');
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
	mysqli_close($conn);
}

function bidderList(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="SELECT * FROM person p
		INNER JOIN bid_transaction bt ON p.pid = bt.pid AND p.rid=2";
		$res= mysqli_query($conn,$sql);
		//$msg="";
		if(mysqli_num_rows($res)>0){
			$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
			<thead>
			<tr>
			<th onclick='sortTable(0)'> ID # <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
			<th onclick='sortTable(1)'> Name <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(2)'> Email ID <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(3)'> Applied For <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(4)'> Applied On <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(5)'> Account Created On <span class='glyphicon glyphicon-sort'></span></th>
			</tr>
			</thead>";

				//<td>".$row["sid"]."</td>

			while($row=mysqli_fetch_assoc($res)){

				$msg=$msg."<tr>
				<td>".$row["pid"]."</td>				

				<td>".$row["f_name"]." ".$row["l_name"]."</td>
				<td>".$row["email"]."</td>
				<td>".$row["sid"]."</td>
				<td>".$row["application_date"]."</td>
				<td>".$row["creationDate"]."</td>
				</tr>";
			}
			$msg=$msg."</table>";
			echo $msg;
		}


		mysqli_close($conn);

	}
}

function userList(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="SELECT * FROM person p where rid=2 or rid=4";
		$res= mysqli_query($conn,$sql);
		//$msg="";
		if(mysqli_num_rows($res)>0){
			$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
			<thead>
			<tr>
			<th onclick='sortTable(0)'> ID # <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
			<th onclick='sortTable(1)'> Name <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(2)'> Email ID <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(3)'> Account Created On <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(4)'> Subscribed On <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(5)'> Is Subscribed ?<span class='glyphicon glyphicon-sort'></span></th>
			</tr>
			</thead>";

				//<td>".$row["sid"]."</td>
			$sflag='No';
			while($row=mysqli_fetch_assoc($res)){
				if($row["subscription_flag"]==0)
					{		$sflag='No';
			}else{
				$sflag='Yes';
			}
			$msg=$msg."<tr>
			<td>".$row["pid"]."</td>				
			<td>".$row["f_name"]." ".$row["l_name"]."</td>
			<td>".$row["email"]."</td>
			<td>".$row["creationDate"]."</td>
			<td>".$row["subscription_Date"]."</td>
			<td>".$sflag."</td>
			</tr>";
		}
		$msg=$msg."</table>";
		echo $msg;
	}

	
	mysqli_close($conn);

}
}

function send_email($group,$subject,$message,$file=null){
 //$target_file_arr=$file; this is left
//$dir_to_search = $file['name'];
	//echo 'file: '.$dir_to_search.'<br />';
	//print_r($dir_to_search);
	//echo '<br />';
//exit();


  //$target_dir = "uploads/";
//$target_file = basename($target_file_arr['tmp_name']);
//$target_file = $file['tmp_name']; THIS IS LEFT
 //$info = pathinfo($target_file);

    //var_dump($info);
    //exit();
	$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Host = 'tls://smtp.gmail.com:587';             // Specify main and backup SMTP servers
//$mail->Port = 587;                          // TCP port to connect to

$mail->SMTPDebug = 0;
//$mail->SMTPSecure = 'tsl';
//$mail->SMTPSecure = 'tsl';                  // Enable TLS encryption, `ssl` also accepted
$mail->IsHTML(true);  // Set email format to HTML
//$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.


$mail->Username = 'zaineyamanjiyani@gmail.com';  // SMTP username
$mail->Password = 'khatijamanjiyani'; // SMTP password

$mail->SetFrom('zaineyamanjiyani@gmail.com', 'Zainiya Manjiyani');
$mail->Subject = $subject;

//$mail->addReplyTo('info@example.com', 'CodexWorld');
//$mail->AddAddress('alhirani2005@yahoo.com');   // Add a recipient
//$mail->AddAddress('zaineyamanjiyani@gmail.com');   // Add a recipient
//$mail->addCC('cc@example.com');
$cnt=0;
$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}else{
	$sql="";
	if($group==1){
		$sql="SELECT * FROM person p where rid=2 and subscription_flag=1";
	}else if($group==2){
		$sql="SELECT * FROM person p where (rid=2 or rid=4) and subscription_flag=1";
	}
	$res= mysqli_query($conn,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		$cnt++;
		$mail->addBCC($row['email']);
		//$mail->addBCC('zaineyamanjiyani@gmail.com');   // Add a recipient
	}

}

//$mail->addAttachment($target_file); THIS IS LEFT

$bodyContent = '<h1>Email From Calpers</h1>';
$bodyContent .= '<p>'.$message.'</p>';


$mail->Body    = $bodyContent;

if(!$mail->Send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
		echo "<b>Email has been sent to ".$cnt." users.</b>";
	
}

}

function publish_dashboard(){
	$status='Published';
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="SELECT * FROM solicitation where status = '$status' and final_filing_date > now() order by sid";
		$res= mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)>0){
			$msg="<table id='currentstable' class='table table-striped table-bordered datatable'>
			<thead>
			
			<th onclick='sortTable(0)'> #  <span class='glyphicon glyphicon-sort-by-attributes-alt'></span></th>
			<th onclick='sortTable(1)'> Solicitation Title <span class='glyphicon glyphicon-sort'></span></th>
			<th onclick='sortTable(2)'>Due Date <span class='glyphicon glyphicon-sort'></span></th>

			<th> Action</th>
			
			</thead>";


			while($row=mysqli_fetch_object($res)){
				$msg=$msg."<tr>
				<td>".$row->sid."</td>				
				<td>".$row->stitle."</td>
				<td>".$row->final_filing_date ."</td>
				<td><button class = 'btn btn-success' data-toggle = 'modal' data-target = '#myModal' id =". $row->sid." onclick='showdetails(this)'><b>DETAILS</b></button></td>
				</tr>";
			}
			$msg=$msg."</table>";
			echo $msg; 						
		}
	}
}

/*function solicitation_description(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}else{ 
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
				$sql="SELECT * FROM solicitation where sid= ". $_SESSION["sid"] ." ";		




				}



			}
}*/


?>