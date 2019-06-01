<form class="form">
            <h2>Password change</h2>
            <div class="form-group">
                <label for="<?php echo $dbKey ?>">Current Password</label>
                <input type="email" class="form-control" id="<?php echo $dbKey ?>" aria-describedby="Current password" placeholder="Enter your current password...">
            </div>
            <div class="form-group">
                <label for="<?php echo $dbKey ?>">New Password</label>
                <input type="email" class="form-control" id="<?php echo $dbKey ?>" aria-describedby="New password" placeholder="Enter your new password...">
            </div>
            <div class="form-group">
                <label for="<?php echo $dbKey ?>">New password one more time</label>
                <input type="email" class="form-control" id="<?php echo $dbKey ?>" aria-describedby="New password" placeholder="Enter your new password again...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
</form>