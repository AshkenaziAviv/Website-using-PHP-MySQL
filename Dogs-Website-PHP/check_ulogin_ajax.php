<?php
session_start();
include("inc_db.php");
$u_login = $_REQUEST['u_login'];
$select_query = "select * from user where u_login='$u_login'";
$result = $conn->query($select_query );
if( $result->num_rows == 0 ) {
    echo "ok";
} else {
    echo "not ok";
}
