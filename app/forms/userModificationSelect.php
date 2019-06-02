    <h2 class="header">Change information</h2>
    <form class="form" method="post" action="./controllers/infoModifier.php">
        <div class="form-group">
            <?php
            if (isset($_SESSION['errorMessage'])) {
                echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' . $_SESSION['errorMessage'] . '</div>';
                unset($_SESSION['errorMessage']);
            }
            ?>
            <select class="custom-select" id="userInfo" name="userInfo">
                <option value="0" selected>Change information</option>
                <option value="nickname">Nickname</option>
                <option value="email">Mail</option>
                <option value="password">Password</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">I want to change!</button>
    </form>