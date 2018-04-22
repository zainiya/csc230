<?php
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

function currentSolicitation(){
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}else{
		$sql="SELECT * FROM solicitation where cancelflag=0 and status='Published' order by sid";
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
	$sql= "select * from document where sid='".$_GET['sid']."'";
	//file_name, sid, dtitle, posted_date, due_date, file
	$res= mysqli_query($conn,$sql);
	$msg="<table class='table table-striped'><thead>
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
				<td><a href='document.php?type=Update&sid=".$_SESSION['sid']."&delid=".$row['dno']."'><button type='button' class='btn btn-danger' id='delete' onclick='deletefn(".$row['dno'].")'><i class='glyphicon glyphicon-trash'></i> Delete</button> </td>
				</tr>";
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





?>