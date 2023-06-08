<?php
session_start();
include("inc_db.php");
?>
<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP include call</title>
</head>

<body style="font-family:Arial">
    <?php
    $d_id = $_REQUEST['d_id'];

    $select_query = "select d_name from dog where d_id=$d_id";
    $result = $conn->query( $select_query );
    $dog = $result->fetch_array( MYSQLI_ASSOC );
    ?>
<h1>
    בני המשפחה המשוייכים ל    <?php echo $dog['d_name'];?>
</h1>
    <?php
    $select_query1 = "select u_d.u_id, user.* from u_d inner join user on u_d.u_id=user.u_id where u_d.d_id=$d_id";
    $result1 = $conn->query( $select_query1 );
    ?>
    <table border="1">
        <tr>
            <td>שם פרטי</td>
            <td>שם משפחה</td>
            <td>האם בעלים?</td>
        </tr>
        <?php
        while( $user = $result1->fetch_array( MYSQLI_ASSOC )) { ?>
            <tr>
                <td><?php echo $user['u_pname'];?></td>
                <td><?php echo $user['u_fname'];?></td>
                <td><?php
                    if( $user['u_owner'] == 0 ) {
                        echo "כן";
                    } else {
                        echo "לא";
                    }
                    ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
