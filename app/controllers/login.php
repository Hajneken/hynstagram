<?php

session_start();
$_SESSION['isLoggedIn'] = "user";
header("location:../index.php");

?>