
<?php
if($_SESSION['modify']==='password'){
    if (isset($_SESSION['errorMessage'])) {
        echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' . $_SESSION['errorMessage'] . '</div>';
        unset($_SESSION['errorMessage']);
    }
 echo '<form class="form" action="./controllers/infoDbModifier.php" method="post">
 <h2>Password change</h2>
 <div class="form-group">
     <label for="oldPassword">Current Password</label>
     <input required type="password" class="form-control" name="oldPassword" id="oldPassword" aria-describedby="Current password" placeholder="Enter your current password...">
 </div>
 <div class="form-group">
     <label for="'.$_SESSION['modify'].'New">New Password</label>
     <input required type="password" class="form-control" 
     name="'.$_SESSION['modify'].'New" id="'.$_SESSION['modify'].'New" aria-describedby="New password" placeholder="Enter your new password...">
 </div>
 <div class="form-group">
     <label for="'.$_SESSION['modify'].'>New2">New password one more time</label>
     <input required type="password" class="form-control"
     name="'.$_SESSION['modify'].'New2" id="'.$_SESSION['modify'].'New2" aria-describedby="New password again" placeholder="Enter your new password again...">
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
</form>';
} else {
    if (isset($_SESSION['errorMessage'])) {
        echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' . $_SESSION['errorMessage'] . '</div>';
        unset($_SESSION['errorMessage']);
    }
    echo '<h2>Current '.$_SESSION['modify'].' value: <span class="font-weight-bold">'.$_SESSION[$_SESSION['modify']].'</span></h2>
    <form class="form" method="post" action="./controllers/infoDbModifier.php">
        <div class="form-group">
            <label for="'.$_SESSION['modify'].'New">New '.$_SESSION['modify'].'</label>
            <input required type="text" class="form-control" id="'.$_SESSION['modify'].'New" name="'.$_SESSION['modify'].'New" aria-describedby="Your new '.$_SESSION['modify'].'" placeholder="Enter your new '.$_SESSION['modify'].'">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>';
}
?>




