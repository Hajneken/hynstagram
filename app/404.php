<?php

session_start();

$_SESSION['errorMessage'] .= 'Something went terribly wrong! We have gathered our engineers to resolve this unacceptable issue that you are experiencing right now. We feel your pain and apologize for the inconvenience. Hang in there and never loose hope! 💯 <br><hr>';
header("location:./index.php");
exit();
     
?>

