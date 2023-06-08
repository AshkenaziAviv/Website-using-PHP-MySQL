<?php
session_start();
include "inc_db.php";

$d_id = $_REQUEST['d_id'];
$description = $_REQUEST['description'];
$dt = $_REQUEST['dt']; // 2022-06-05
$starthour = $_REQUEST['starthour']; // 18:30
$s_datetime = $dt . ' ' . $starthour; // 2022-06-05 18:30

$array = [ 'desc' => $description]; // {"desc":"Get pills against fleas"}
$json = json_encode( $array ); // convert the array into JSON string

$insert = "insert into s_event( s_dog_id, s_datetime, s_desc) values($d_id, '$s_datetime', '$json')";
$conn->query( $insert );

$_SESSION['message'] = "Special event added successfully";
header("location:add_special_event.php");
exit;
