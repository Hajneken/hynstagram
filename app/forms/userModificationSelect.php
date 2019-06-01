    <?php
    
    
     
    
    // $_SESSION[] = 'lolek'
    // if(!empty($_POST) && (@$_POST))
    
    ?>
    <h2 class="header">Change information</h2>
    <form class="form" method="post" action="userModificationSelect.php" >
        <div class="form-group"><select class="custom-select">
                <option selected>Change information</option>
                <option value="1">Nickname</option>
                <option value="2">Mail</option>
                <option value="3">Password</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">I want to change!</button>
    </form>