<?php
$user = false; 
$navProfile = '';
$linkPath = './sign.php';
$userStatus = 'Register / Sign In';

if ($user){
    $userStatus = 'Sign Off';
    $linkPath = './index.php';
    $navProfile = '<li class="nav-item">
    <a class="nav-link" href="./profile.php">Profile<span class="sr-only">(current)</span></a>
</li>';
}
?> 