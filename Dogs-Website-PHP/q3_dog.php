<?php	
	include("inc_db.php");
	session_start();
$er=" ";	
if(isset( $_REQUEST['new_dog'] )) {
	$_SESSION['d_name'] = $_REQUEST["dog_name"];
	$_SESSION['d_address'] = $_REQUEST["adress"];	
	$_SESSION['d_desc'] = $_REQUEST["desc"];	

}	
?>

<!DOCTYPE>
<html dir="rtl">

<head>
	<meta content="en-us" http-equiv="Content-Language" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>q3_dog</title>
<style>
.cell {
	border: 1px solid #000000;
	width: 25%;
}
h1 {
	font-size:48px;
	color:#FFF;
	background-color:#4E9DEC;
	text-align:center;border-radius:10px;
	
}
.Button1:hover {
	background-color:#4E9DEC;
	border-radius:3px;
}

</style>
<script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById('timed').innerHTML = this.responseText;
            }
        };

        xhttp.open("GET", "AJAX_call.php", true);	
        xhttp.send();       
</script>

<script>
function save_dog(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById('add_dog').innerHTML = this.responseText;
            }
        };

        xhttp.open("GET", "add_dog.php", true);	
        xhttp.send();  
}
</script>

</head>

<body style="font-family:Calibri">
<h1>הוספת כלב</h1>

	<table align="center" style="width: 600px">
		<tr>
			<td dir="ltr" colspan="4" style="font-size:x-large"><?php echo "welcome ". $_SESSION['username']; ?></td>
		</tr>
		<tr>
			<td id="timed" colspan="4" style="text-align:left"></td>
		</tr>

		<tr> 
			<td id="message" colspan="4" style="text-align:right"> &nbsp;</td>
		</tr>
	</table>
	
<?php 
if($_SESSION['u_owner']==1)
{
echo "only dog owners can add a dog!";

} else { ?>
	
        <table align="center">
           <form name="dogs" action="q3_dog.php" method="post"> 
           <tr>       
                    <td style="height: 30px">הכלבים שלך:</td>
                    <td style="height: 30px">
                                       
                    	<select name="d_id">
                      
<?php
		$query = "SELECT * FROM u_d,dog WHERE u_d.u_id=".$_SESSION['u_id']." and u_d.d_id=dog.d_id";	
		$result = $conn->query($query);
			
				if ($result->num_rows > 0)
				{
					while($dog = $result->fetch_array())
					{
                   	echo "<option value='".$dog['d_id']."'>".$dog['d_name']."</option>";
                    }
                 }
?>
                    </select>
                   
                    </td>
                    <td style="height: 30px"></td>
                    <td style="height: 30px"></td>
                    <td style="height: 30px"></td>    
                    <td style="height: 30px"><button class="Button1" type="submit" name="add_d">הוסף כלב 
					חדש</button></td>                    
                   
              </tr>
            </form>                          
         </table>
<?php } ?>
         
<?php if(isset( $_REQUEST['add_d'])) { ?>
		<form name="newdog" action="q3_dog.php" method="post"> 
			<table align="center">
			<div id="add_dog">
                <tr>
                    <td style="width: 94px">שם הכלב</td>
                    <td><input type="text" name="dog_name" id="dog_name"></td>
                    <td>&nbsp;</td>
                    <td>כתובת</td>
                    <td style="width: 5px"><input type="text" name="adress" id="adress"></td>
                    <td>&nbsp;</td>
                    <td>תיאור</td>
                    <td style="width: 5px"><input type="text" name="desc" id="desc"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><button name="new_dog" type="submit" onclick="save_dog()">הוסף כלב חדש</button></td>
                </tr>
                </div>
               </table>
        </form>
	
<?php } ?>

</body>

</html>
