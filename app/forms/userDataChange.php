<!-- for everything except password -->
<h2>Current <?php echo $data . ':' . $user ?></h2>
<form class="form">
    <div class="form-group">
        <label for="<?php echo $dbKey ?>">New <?php echo $data ?></label>
        <input type="email" class="form-control" id="<?php echo $dbKey ?>" aria-describedby="Your new <?php echo $data ?>" placeholder="Enter your new <?php echo $data ?>...">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>