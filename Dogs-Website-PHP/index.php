<?php
	session_start();
?>
<!DOCTYPE>
<html dir="rtl">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>מטלה 11 2022</title>
<style>
#maindata {
	border:1px #666 solid;
	height:80vh;
}
.action {
	text-align:center;
}
.action:hover {
	text-decoration-line:underline;
	cursor:pointer;
}
#myiframe {
	width:100%;
	height:100%;
}
</style>
<script>
// Conver month and day to 2 digits with leading zero

function to2(t){ return (t<10 ? "0"+t : t );}

// Get the personal computer date using JavaScript
// YYYY-MM-DD hh:mm:ss
function get_today()
{
	d = new Date();  
	var today = new Date();
	return today.getFullYear()+'-'+to2(today.getMonth()+1)+'-'+to2(today.getDate())+" "+
		to2(today.getHours()) + ":" +to2(today.getMinutes()) + ":" + to2(today.getSeconds());
}

</script>

</head>

<body style="font-family:Arial">

<table style="width: 100%; height:70px;">
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th style="width:20%;"></th>
	</tr>
</table>

<table style="width: 100%">
	<tr>
		<td id="menu" style="vertical-align:top; width:200px">
				
		<table id="subtable" style="width: 100%; height: 156px;">
			<tr>
				<td class="action" onclick="document.getElementById('myiframe').src='login.php'">שאלה 1</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="action" onclick="document.getElementById('myiframe').src='q2.php'">שאלה 2</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="action" onclick="document.getElementById('myiframe').src='root.php'">שאלה 3</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class="action" onclick="document.getElementById('myiframe').src='add_special_event.php'">שאלה 4</td>
			</tr>
		</table>
				
		</td>		
		<td id="maindata" valign="top">
		<iframe id="myiframe" frameBorder="0" src="login.php"></iframe>
		</td>
	</tr>
</table>

</body>

</html>
