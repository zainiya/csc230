<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csc230";
if(isset($_POST['up'])){
    $target_dir = "uploads/";
    $target_file_arr=$_FILES["files"]; 
    var_dump($target_file_arr);
// Create connection
    $conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    for($i=0 ; $i<count($target_file_arr['name']) ; $i++)
    {
        $date = $_POST['d'.$i];
        var_dump($date);
        $target_file = $target_dir . basename($target_file_arr['name'][$i]);
var_dump($target_file);
$info = pathinfo($target_file);
$file_name =  basename($target_file,'.'.$info['extension']);
$f=$target_dir . basename($file_name.'-'.$_SESSION['sid'].'.'.$info['extension']);
 //echo 'f='.$f;
 //echo $file_name.$_SESSION['sid'].'.'.$info['extension'];
//exit();
        $uploadOk = 1;

        if (move_uploaded_file($target_file_arr['tmp_name'][$i], $f)) {

    // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }else{

                $sql="insert into document (file_name, sid, dtitle, posted_date, due_date, file) values 
                ('".$target_file_arr['name'][$i]."','".$_SESSION['sid']."','".$target_file_arr['name'][$i]."-".$_SESSION['sid']."','".$date."','".$date."','".$f."')";

                if (mysqli_query($conn,$sql) === TRUE) {
                    echo "The file ". basename( $target_file_arr['name'][$i]). " has been uploaded.";                
                } else {
                    echo "Sorry!! something went wrong.".$sql;
                }

            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    }
    header('Location: document.php?type=Update&msg="File has been Uploaded Successfully"&sid='.$_SESSION['sid']);
    mysqli_close($conn);
}
?>