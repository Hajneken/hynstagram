<?php
// check if user exists in database and if his hash matches pswd matches


// close connection with the database

session_start();
$_SESSION['isLoggedIn'] = "user";
header("location:../index.php");

?>