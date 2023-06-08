<?php
include ("inc_db.php");
session_start();


$u_dt = $_SESSION['u_dt'];
$today = $_SESSION['today'];
$time_diff = round((strtotime($today) - strtotime($u_dt))/(60*60*24)); // strtotime: 2021-07-01 09:32:52 => 2342342356
echo "Time has passed since the last login ".$time_diff." days";

?>