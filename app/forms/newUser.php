<h2 class="title mb-4 text-center">First time around?</h2>
<h3 class="subheader">Sign Up below 👇😎</h3>
<form class="form" method="post" action="./controllers/register.php">
    <?php
    if (isset($_SESSION['errorMessage'])) {
        echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Oh snap 😢</h3>' . $_SESSION['errorMessage'] . '</div>';
        unset($_SESSION['errorMessage']);
    }
    ?>
    <div class="form-group">
        <label for="newUserEmail">Email address *</label>
        <input type="email" class="form-control" name="newUserEmail" id="newUserEmail" aria-describedby="Email address" placeholder="Enter your email ..." required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="newUserNickname">Nickname</label>
        <input type="text" class="form-control" name="newUserNickname" id="newUserNickname" placeholder="Nickname">
    </div>
    <div class="form-group">
        <label for="newUserPassword">Password *</label>
        <input type="password" class="form-control" name="newUserPassword" id="newUserPassword" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="passwordCheck">Password one more time *</label>
        <input type="password" class="form-control" name="passwordCheck" id="passwordCheck" placeholder="Just to make sure ..." required>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="exampleCheck" id="funCheck" required>
        <label class="form-check-label" for="funCheck">I agree to have fun</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>