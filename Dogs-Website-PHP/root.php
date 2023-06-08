<?php
	session_start();
	$er = "";
	if (isset($_SESSION['er'])) {	// Check if ther was an error
		 $er = $_SESSION['er']."<br><br>";
		unset($_SESSION['er']);		// Clear the error
	}
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css_master.css" media="all">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Root</title>
<style>
</style>

</head>

<body>
<h1>Adding Owner, Member or Dog </h1>

    <form method="POST" action="q3_dog.php">  
	  <table align="center" style="width: 600px">
        <input type="submit" value="Insert Dog"/>
      </table>
     </form>
     <br><br>
    <form method="POST" action="insert_family_member.php">  
      <table align="center" style="width: 600px">
        <input type="submit" value="Insert Family Member"/> 
      </table>
      </form>
           <br><br>

    <form method="POST" action="insert_owner.php">  
      <table align="center" style="width: 600px">
       <input type="submit" value="Insert Owner"/> 
      </table>

</form>

<input id="mytoday" name="mytoday" type="hidden">

</body>

</html>
