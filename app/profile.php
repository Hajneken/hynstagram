<?php
include './controllers/userController.php'

?>

<?php

if(isset($_SESSION['userID'])){
    echo '<!DOCTYPE html>
    <html lang="en">';
    include './include/head.php';
    echo '<body>';
    include './include/nav.php';
    include './pages/profile.php';
    include './include/footer.php';
    include './include/scripts.php';
    
    echo '</body></html>';
} else {
    $_SESSION['errorMessage'] .= 'You need to sign in first sir! ❌<br><hr>';
            header("location:./index.php");
            exit();
}

?>