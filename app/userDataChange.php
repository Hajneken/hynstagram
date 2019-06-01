<?php
include './controllers/userController.php'
//  PDO database connection

//  1. Check if user is signed in
// yes => show Profile($Name) + Sign Off + Form Create New

// no => show Sign In / Register + Form Sign In to Create New


//  2. Check if Topics Exist
//  yes => list 5 of top

// 3. Check if 

?>

<!DOCTYPE html>
<html lang="en">
<?php include './include/head.php' ?>

<body>
    <?php include './include/nav.php' ?>
    <?php include './pages/userDataChange.php' ?>
    <?php include './include/footer.php' ?>
    <?php include './include/scripts.php' ?>
</body>

</html>