<main class="main-container">
        <section class="section-container">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-5">
                    <?php 
                    if(isset($_SESSION['successMessage'])){
                            echo '<div class="alert alert-success" role="alert">'.$_SESSION['successMessage'].'</div>';
                            unset($_SESSION['successMessage']);
                        }
                        if (isset($_SESSION['errorMessage'])) {
                            echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' . $_SESSION['errorMessage'] . '</div>';
                            unset($_SESSION['errorMessage']);
                        }
                        ?>
                        <h1 class="title text-center">Hynstagram</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-container">
                            <p class="text">A place where only images are a valid way of communication. 🎨 This fun little project has been written as a requirement for the course 4iz278 - Web Applications (2019). Ipsum blanditiis dolore aperiam corrupti labore pariatur veniam distinctio sit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-container mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="wrapper">
                            <h2 class="header">Trending topics</h2>
                            <ul class="list-group">
                                <li class="list-group-item"><a href="./topic.php" class="list-group__link">Topic</a></li>
                                <li class="list-group-item"><a href="./topic.php" class="list-group__link">Topic</a></li>
                                <li class="list-group-item"><a href="./topic.php" class="list-group__link">Topic</a></li>
                                <li class="list-group-item"><a href="./topic.php" class="list-group__link">Topic</a></li>
                                <li class="list-group-item"><a href="./topic.php" class="list-group__link">Topic</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="wrapper">
                            <?php 
                            if(isset($_SESSION['isLoggedIn'])){
                                include './forms/newTopic.php'; 
                            } else { 
                                echo '<h2 class="header">Sign in to kick off a new topic!</h2>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>