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
<title>Login</title>
<style>
</style>

<script>
function to2(t) { return (t<10 ? "0"+t : t ); }
function get_today()
{
	d = new Date();  
	var today = new Date();
	document.getElementById("mytoday").value = today.getFullYear()+'-'+to2(today.getMonth()+1)+'-'+to2(today.getDate())+" "+
	to2(today.getHours()) + ":" +to2(today.getMinutes()) + ":" + to2(today.getSeconds());
//	console.log(document.getElementById('mytoday').value);
	form1.submit();
}
function saveL()
{
var myuser = document.getElementById("login").value;
var mypassword = document.getElementById("password").value;
localStorage.gkexam = {"user": myuser , "password" : mypassword};
//console.log( myuser,mypassword);
}
</script>

</head>

<body>
<h1> Login </h1>

<form name="form1" method="post" action="check.php">

<table class=".table1" align="center" style="width: 600px">
	<tr>
		<td>&nbsp;</td>
		<td colspan="5"><?php echo $er ?></td>
	</tr>
	<tr>
		<td class="td">User name:</td>
		<td colspan="5">
			<input id="login" name="login" type="text" required="required" autocomplete="on">
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="5">
			&nbsp;</td>
	</tr>
	<tr>
		<td class="td">Password:</td>
		<td colspan="5">
			<input id="password" name="password" type="password" required="required" autocomplete="on">
		</td>
	</tr>
	<tr>
		<td style="height: 33px"></td>
		<td style="height: 33px" colspan="5"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td style="text-align: center">
		<input class="bn30" name="Button1" type="button" value="Submit" onclick="saveL();get_today()">
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>

	</tr>
</table>
<input id="mytoday" name="mytoday" type="hidden">
</form>

</body>

</html>
