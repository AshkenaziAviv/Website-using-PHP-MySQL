<?php
include ("inc_db.php");
session_start();
	$d_name=$_SESSION['d_name'];
	$d_address=$_SESSION['d_address'];
    $d_desc=$_SESSION['d_desc'];	
	


	$query1 = "INSERT INTO dog (`d_name`,`d_address`,`d_desc`) values('$d_name', '$d_address','$d_desc')";
    $conn->query($query1);
    
    //fing d_id    
    $query2 = "SELECT `d_id` FROM `dog` WHERE `d_name`=\"$d_name\"";
    $result = $conn->query($query2);
    if ($result->num_rows > 0)  
    {		// user found
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$_SESSION["d_id"] = $row['d_id'];			
	}
	
    // insert the connection dog-owner
    $u_id=$_SESSION["u_id"];
    $d_id=$_SESSION["d_id"];
    $query3 = "INSERT INTO u_d (`u_id`,`d_id`) VALUES( \"$u_id\" , \"$d_id\")";
    $conn->query($query3);

	$echo = "dog added!";


?>