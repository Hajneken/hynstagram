<?php

$linkPath;
$userStatus; 
$navProfile;

session_start();

if(isset($_SESSION['isLoggedIn'])){
    // user is logged in
    $userStatus = 'Log Out';
    $linkPath = './controllers/logout.php';
    $navProfile = '<li class="nav-item">
    <a class="nav-link" href="./profile.php">Profile<span class="sr-only">(current)</span></a>
</li>';
} else { 
    //  user is logged out
    $userStatus = 'Log In / Register';
    $linkPath = './controllers/login.php';
    $navProfile = '';
}


?> 