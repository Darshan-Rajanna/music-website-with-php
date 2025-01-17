<?php
$server="localhost:3307";
$username="root";
$password="";
$datbase="melo";
$conn = mysqli_connect($server, $username, $password, $datbase);
if (!$conn) {
    die("Error:- ".mysqli_connect_error());
}
?>
