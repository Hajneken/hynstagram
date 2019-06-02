<h2 class="title text-center mb-4">Already a user?</h2>
<h3 class="subheader">Log In 👑</h3>
<form class="form" method="post" action="./controllers/login.php">

<?php
    if (isset($_SESSION['errorMessageLogIn'])) {
        echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' .$_SESSION['errorMessageLogIn'].'</div>';
        unset($_SESSION['errorMessageLogIn']);
    }
    ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" name="userEmail" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>