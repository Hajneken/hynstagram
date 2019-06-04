<?php
include './controllers/userController.php';

if(isset($_SESSION['currentPage'])){
    unset($_SESSION['currentPage']);
}
$_SESSION['currentPage'] = 'Sign Up / Log In';

?>

<!DOCTYPE html>
<html lang="en">
<?php include './include/head.php' ?>

<body>
    <?php include './include/nav.php' ?>
    <?php include './pages/sign.php' ?>
    <?php include './include/footer.php' ?>
    <?php include './include/scripts.php' ?>
</body>

</html>