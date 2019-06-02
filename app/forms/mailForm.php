<h3 class="subheader mb-4 text-center text-white">Have something on your mind?</h3>
<?php
if (isset($_SESSION['errorMessageMail'])) {
    echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' . $_SESSION['errorMessageMail'] . '</div>';
    unset($_SESSION['errorMessageMail']);
}
if (isset($_SESSION['successMessageMail'])) {
    echo '<div class="alert alert-success" role="alert">'.$_SESSION['successMessageMail'].'</div>';
    unset($_SESSION['successMessageMail']);
}
?>
<form class="form" method="post" action="./controllers/mailHandler.php">
    <div class="form-group">
        <label class="text-white" for="strangerEmail">Email</label>
        <input type="email" class="form-control" name="strangerEmail" id="strangerEmail" aria-describedby="Your email address..." placeholder="Enter your email..." required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label class="text-white" for="strangerMessage">Your message</label>
        <textarea class="form-control" name="strangerMessage" id="strangerMessage" rows="3" placeholder="Share your thoughts with us ..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>