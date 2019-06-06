<?php

require './db/connectDb.php';
require './controllers/authenticationHelpers.php';

// logic 
if (isset($_SESSION['currentTopicId'])) {
    unset($_SESSION['currentTopicId']);
}

$_SESSION['currentTopicId'] = $_GET['id'];


function fetchAllRelevantPosts(PDO $db, $topicId)
{
    $query = $db->prepare('SELECT * FROM Posts WHERE topic=:topic ORDER BY `votes` DESC;');
    $query->execute([':topic' => $topicId]);
    $postsArray = $query->fetchAll();
    return $postsArray;
}

function fetchCurrentTopicObj(PDO $db, $topicId)
{
    $query = $db->prepare('SELECT * FROM Topics WHERE topicID=:topicID LIMIT 1;');
    $query->execute([':topicID' => $topicId]);
    $topicObj = $query->fetchObject();
    return $topicObj;
}

$postsArray = fetchAllRelevantPosts($db, $_SESSION['currentTopicId']);
$topicObj = fetchCurrentTopicObj($db, $_SESSION['currentTopicId']);

if($topicObj->isPublic === "0" && !isset($_SESSION['userID'])){
    $_SESSION['errorMessage'] .= 'Sorry the topic you are trying to access requires membership. <br><hr>';
    header("location:./index.php");
    exit();
}

$_SESSION['currentTopicName'] = $topicObj->name;

if (!isset($_GET['id']) || !$topicObj) {
    $_SESSION['errorMessage'] .= 'Ooopss we could not find the topic you are looking for, care to create one? 😊 <br><hr>';
    header("location:./index.php");
    exit();
}

?>


<main class="main-container">


    <section class="section mb-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h1 class="title text-center"><?php
                                                    echo htmlspecialchars($topicObj->name); ?></h1>
                </div>
                <div class="col-8">
                    <p class="text"><?php echo htmlspecialchars($topicObj->description); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
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
                </div>
            </div>
        </div>
    </section>

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

    <?php
    if (isset($_SESSION['userID'])) {
        echo '<section class="section">
    <div class="container">
        <div class="col-12 mb-5">
            <div class="wrapper wrapper--comment">
                <div class="col-4">
                    <h2>Comment 👉</h2>
                </div>
                <div class="col-8">
                <form class="form form--post" method="post" action="./controllers/createPost.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="FormControlFile1">Your picture 🖼</label>
                            <input type="file" class="form-control-file" id="FormControlFile1" name="myFile">
                        </div>
                        <button type="submit" name="confirm" class="btn btn--post btn-primary">Post it 🎉!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>';
    }
    ?>

    <section class="section">
        <div class="container posts-wrap">
            <?php

            for ($i = 0; $i < count($postsArray); $i++) {
                $id = $postsArray[$i]['postID'];
                $url = $postsArray[$i]['url'];
                $userId = $postsArray[$i]['author'];
                $votes = $postsArray[$i]['votes'];

                $query = $db->prepare('SELECT * FROM Users WHERE userID=:userID LIMIT 1;');
                $query->execute([':userID' => $userId]);
                $userObj = $query->fetchObject();
                echo
                    '<div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="' . $url . '" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">By: ' . $userObj->nickname . '</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">' . $votes . '</p>
                                    <a href="./controllers/upvote.php?id=' . $id . '" class="btn btn--upvote">👍</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
            ?>

        </div>
    </section>

</main>