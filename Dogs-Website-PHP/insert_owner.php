<?php
session_start();
include("inc_db.php");


if( isset( $_REQUEST['d_id'])) {
    $d_id = $_REQUEST['d_id'];

    $u_login = $_REQUEST['u_login'];
    $u_password = $_REQUEST['u_password'];
    $u_pname = $_REQUEST['u_pname'];
    $u_fname = $_REQUEST['u_fname'];
    $u_phone = $_REQUEST['u_phone'];
    $u_mail = $_REQUEST['u_mail'];
    $insert_query = "insert into user (u_login, u_password, u_pname, u_fname, u_phone, u_mail, u_owner)
                                values('$u_login', '$u_password', '$u_pname', '$u_fname', '$u_phone', '$u_mail', 0 )";
    $conn->query( $insert_query );
    $u_id = $conn->insert_id; // return the last PK of the row inserted

    // final step is to add a new row to u_d
    $insert_query2 = "insert into u_d (u_id, d_id) values( $u_id, $d_id )";
    $conn->query( $insert_query2 );
    header('location:dog_family_members.php?d_id='.$d_id);
}

?>

<style>
h1 {
	font-size:48px;
	color:#FFF;
	background-color:#4E9DEC;
	text-align:center;border-radius:10px;
	
}

</style>

<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP include call</title>
    <script>
        function checkULogin() {
            var u_login = document.getElementById('u_login').value;
            var xhttp = new XMLHttpRequest();
            // callback function: waiting for a response from the PHP file
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText; // php echo: goes to this.responseText
                    // document.getElementById('display_minutes').innerHTML = response;
                    if( response == 'ok' ) {
                        alert("שם משתמש חדש תקין");
                    } else {
                        alert("שם משתמש קיים נא לבחור שם אחר");
                    }
                }
            };
            // send request to check_ulogin_ajax.php
            xhttp.open("GET", 'check_ulogin_ajax.php?u_login='+u_login, true);
            xhttp.send();
        }
    </script>
</head>

<body style="font-family:Arial">
<h1>הוספת בעלים</h1>

<form action="insert_owner.php" method="post">
    <table>
        <tr>
            <?php
            $u_id = $_SESSION['u_id'];
            $select_query = "select u_d.d_id, dog.d_name from u_d inner join dog on u_d.d_id=dog.d_id where u_d.u_id=$u_id";
            $result = $conn->query($select_query);
            ?>
            <td>בחר כלב</td>
            <td>
            <select name="d_id">
                <?php
                while( $row = $result->fetch_array( MYSQLI_ASSOC )) { ?>
                    <option value="<?php echo $row['d_id'];?>">
                        <?php echo $row['d_name']?>
                    </option>
                <?php
                }
                ?>
            </select>
            </td>
        </tr>
        <tr>
            <td>שם משתמש</td>
            <td><input type="text" name="u_login" id="u_login">
                <button type="button" onclick="checkULogin()">בדוק</button>
            </td>
        </tr>
        <tr>
            <td>סיסמה</td>
            <td><input type="password" name="u_password"></td>
        </tr>
        <tr>
           <td>שם פרטי</td>
            <td><input type="text" name="u_pname"></td>
        </tr>
        <tr>
            <td>שם משפחה</td>
            <td><input type="text" name="u_fname"></td>
        </tr>
        <tr>
            <td>טלפון</td>
            <td><input type="text" name="u_phone"></td>
        </tr>
        <tr>
            <td>דוא"ל</td>
            <td><input type="text" name="u_mail"></td>
        </tr>
        <tr>
            <td><button type="reset">ניקוי טופס</button></td>
            <td><button type="submit">הוסף בעלים</button></td>
        </tr>
    </table>
</form>
</body>

</html>
