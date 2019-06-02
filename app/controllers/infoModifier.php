<?php

require './authenticationHelpers.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $value = $_POST['userInfo'];
    $_SESSION['modify'] = stringCleaner($value);
    if ($value === "0"){
        $_SESSION['errorMessage'] .= 'Please select an option. 🤗';
        header("location:../profile.php");
        exit();
    } else {
        header("location:../userDataChange.php");
        exit(); 
    }
    
    exit();
}
header("HTTP/1.1 404 Not Found");
?>