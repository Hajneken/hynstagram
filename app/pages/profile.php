<main class="main-container">

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title text-center mb-5">User: Lorem Ipsum</h1>
                    <?php 
                    if(isset($_SESSION['successMessage'])){
                            echo '<div class="alert alert-success" role="alert">'.$_SESSION['successMessage'].'</div>';
                            unset($_SESSION['successMessage']);
                        }
                        ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="wrapper">             
                        <h2 class="header">User Details:</h2>
                        <ul class="user-info">
                            <li class="user-info__item">Nickname: <span class="font-weight-bold"><?php echo $_SESSION['nickname'];?></span> </li>
                            <li class="user-info__item">Mail: <span class="font-weight-bold"><?php echo $_SESSION['email'];?></span></li>
                            <li class="user-info__item">Posts: <span class="font-weight-bold">WARNING</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <div class="wrapper">
                        <?php include './forms/userModificationSelect.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>