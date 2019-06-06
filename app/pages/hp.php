<?php

require './db/connectDb.php';

function fetchAllRelevantPosts(PDO $db)
{
    // HERE
    // to do ORDER BY `votes`
    
    // $query = $db->prepare('SELECT * FROM Topics LIMIT 5;');
    // $query->execute();
    // $topicsArray = $query->fetchAll();
    // return $topicsArray;
    
    // alternative
    
    $query = $db->prepare('SELECT topic, topicID, name, sum(`votes`) as votesSum
    FROM Posts
    JOIN Topics 
    ON  `topic` = `topicID`
    GROUP BY name, topic
    ORDER BY votesSum
    DESC
    LIMIT 5;');
    $query->execute();
    $topicsArray = $query->fetchAll();
    return $topicsArray;
}
// HERE
$topicsArray = fetchAllRelevantPosts($db);

// $topicsObj = fetchAllRelevantPosts($db);

?>

<main class="main-container">
    <section class="section-container">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <?php
                    if (isset($_SESSION['successMessage'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['successMessage'] . '</div>';
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
                        <p class="text">A place where only images are a valid means of communication. 🎨 You can create your own topic, upload an image and then just see the rise of popularity of your post. So what are you waiting for? <br> This fun little project has been written as a requirement for the course 4iz278 - Web Applications (2019). Interested what it is made of? Check the <a href="https://github.com/Hajneken/hynstagram"> project repository</a></p>
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
                            <?php
                            // var_dump($topicsArray);
                            // echo (count($topicsArray));
                            for ($i = 0; $i < count($topicsArray); $i++) {
                                $topicID = $topicsArray[$i]['topicID'];
                                $topicName = $topicsArray[$i]['name'];

                                echo '<li class="list-group-item"><a href="./topic.php?id=' . $topicID . '" class="list-group__link">' . $topicName . '</a></li>';
                            }
                            // var_dump($topicsObj);
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="wrapper">
                        <?php
                        if (isset($_SESSION['isLoggedIn'])) {
                            include './forms/newTopic.php';
                        } else {
                            echo '<h2 class="header">Sign in to kick off a new topic! 🏈</h2>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>