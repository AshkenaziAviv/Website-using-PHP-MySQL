<?php
	include("../inc_db.php");
	$str = "";
	// run this query on phpMyAdmin
	$query = "SELECT u_id,u_pname FROM user";
		// only out no food !!
	$result = $conn->query($query);
	if ($result->num_rows > 0)  {
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$u_id = $row['u_id'];
			$u_name =$row['u_pname'];
			$query = "SELECT count(u_id) as num FROM u_d WHERE u_id=\"$u_id\"";
			$result = $conn->query($query);
			if ($result->num_rows > 0)  {
				$row = $result->fetch_array(MYSQLI_ASSOC);
			// ['gk',  2, 'orange'],		
				$str .= "[\"$u_name\",".$row["num"].",'blue'],";
				}
		}
	}		
	echo substr($str,0,-1);	// remove the last comma
	$result->free();
	$conn->close();
?>