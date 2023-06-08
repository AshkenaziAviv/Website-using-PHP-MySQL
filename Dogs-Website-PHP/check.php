<?php
	session_start();
	$OK = false;
	if ((isset($_REQUEST['login'])) and (isset($_REQUEST['password']))) {
		$login =  $_REQUEST['login'];
		$pw = $_REQUEST['password'];
		$today = $_REQUEST['mytoday'];
		$_SESSION['today'] = $today;
		
		
		
		include("inc_db.php");
		$query = "select * from user where u_login=\"$login\" and u_password=\"$pw\"";
		$result = $conn->query($query);
// var_dump($result); die();
		if ($result->num_rows > 0)  {		// user found
			$row = $result->fetch_array(MYSQLI_ASSOC);
// var_dump($row);	die();
			$_SESSION["u_id"] = $row["u_id"];	// keep u_id info
			$_SESSION['username'] = $row['u_pname']." ".$row['u_fname'];
			$_SESSION['u_dt'] = $row['u_dt'];
			$_SESSION['u_owner'] = $row['u_owner'];

			
			$u_id = $_SESSION["u_id"];
			$query = "select d_id from u_d where u_id=\"$u_id\"";
			$result = $conn->query($query);
			if ($result->num_rows > 0)  {
				$row = $result->fetch_array(MYSQLI_ASSOC);
			//var_dump($row);	
				$_SESSION["d_id"] = $row["d_id"];
			} else {
				$_SESSION["d_id"] = "0";	
			}
			
			$OK = true;							// ok flag to redirect accordingly
			// Update last used with current date time
			$query = "UPDATE user set u_dt=\"$today\" where u_id=".$_SESSION["u_id"]; // no \" number
			$result = $conn->query($query);
						
		} else {
			$result->free();
		}	

		$conn->close();

		if ($OK) {
			header("location: q2.php");	// login ok
		
		} else {
			$_SESSION['er'] = "Wrong login or password";
			header("location: login.php");	// login error
		}
	
	} else { 	// no username or password input
		$_SESSION['er'] = "No login or password found!";
		header("location: login.php");
	}
	
?>
