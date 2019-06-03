<?php

require './db/connectDb.php';
require './controllers/authenticationHelpers.php';

// logic 
// session_start();

// current topicId

$_SESSION['currentTopicId'] = $_GET['id'];


function fetchAllRelevantPosts(PDO $db, $topicId){
    $query = $db->prepare('SELECT * FROM Posts WHERE topic=:topic ORDER BY `votes`;');
    $query->execute([':topic' => $topicId]);
    $postsArray = $query->fetchAll();
    return $postsArray;
}

function fetchCurrentTopicObj(PDO $db, $topicId){
    $query = $db->prepare('SELECT * FROM Topics WHERE topicID=:topicID LIMIT 1;');
    $query->execute([':topicID' => $topicId]);
    $topicObj = $query->fetchObject();
    return $topicObj;
}

$postsArray = fetchAllRelevantPosts($db, $_SESSION['currentTopicId']);
$topicObj = fetchCurrentTopicObj($db, $_SESSION['currentTopicId']);

?>
<main class="main-container">

    <section class="section mb-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h1 class="title text-center"><?php echo $topicObj->name;?></h1>
                </div>
                <div class="col-8">
                    <p class="text"><?php echo $topicObj->description;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12"> 
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
                        </div>
            </div>
        </div>
    </section>
    
<?php 
if(isset($_SESSION['userID'])){
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
                            <label for="file">Example file input</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="myFile">
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


<!-- <section class="section">
    <div class="container">
        <div class="col-12 mb-5">
            <div class="wrapper wrapper--comment">
                <div class="col-4">
                    <h2>Comment 👉</h2>
                </div>
                <div class="col-8">
                    <form class="form form--post" method="post" action="./controllers/createPost.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Example file input</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="myFile">
                        </div>
                        <button type="submit" name="confirm" class="btn btn--post btn-primary">Post it 🎉!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="section border">
        <div class="container posts-wrap">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="https://static.vinepair.com/wp-content/uploads/2017/06/iceland-summer-solstice-inside.jpg" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">Lorema Ipsumová</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">20</p>
                                    <button class="btn btn--upvote">👍</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section> -->

    
    <section class="section">
        <div class="container posts-wrap">
            <?php 
            // fill in the database first
foreach ($postsArray as $key) {
    $url = $postsArray[$key]['url'];
    $userId = $postsArray[$key]['userID'];
    $votes = $postsArray[$key]['votes'];
    // TODO resolve duplicates
    $query = $db->prepare('SELECT * FROM Users WHERE userID=:userID LIMIT 1;');
    $query->execute([':userID' => $userId]);
    $userObj = $query->fetchObject();
    // database transaction will be needed
    
    '<div class="row">
    <div class="col-12 col-md-6">
        <div class="wrapper">
            <div class="post">
                <div class="post__img-wrap"><img src="'.$url.'" alt="Iceland picture 1" class="post__img"></div>
                <div class="post__meta">
                    <div class="post__autor-wrap">
                        <p class="post__author">'.$userObj->nickname.'</p>
                    </div>
                    <div class="post__vote-wrap">
                        <p class="post__votes">'.$votes.'</p>
                        <a class="btn btn--upvote">👍</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
    
}
            ?>
            <!-- <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="https://static.vinepair.com/wp-content/uploads/2017/06/iceland-summer-solstice-inside.jpg" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">Lorema Ipsumová</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">20</p>
                                    <button class="btn btn--upvote">👍</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="https://i.imgur.com/KOXOBiN.gif" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">Lorema Ipsumová</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">20</p>
                                    <button class="btn btn--upvote">👍</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="https://www.telegraph.co.uk/content/dam/Travel/2019/March/Kirkjufell-iStock-959966730.jpg?imwidth=450" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">Lorema Ipsumová</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">20</p>
                                    <button class="btn btn--upvote">👍</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="https://techcrunch.com/wp-content/uploads/2015/08/safe_image.gif?w=730&crop=1" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">Lorema Ipsumová</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">20</p>
                                    <button class="btn btn--upvote">👍</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wrapper">
                        <div class="post">
                            <div class="post__img-wrap"><img src="https://cdn-04.independent.ie/life/travel/article34985584.ece/85dd6/AUTOCROP/w620/iceland.jpg" alt="Iceland picture 1" class="post__img"></div>
                            <div class="post__meta">
                                <div class="post__autor-wrap">
                                    <p class="post__author">Lorema Ipsumová</p>
                                </div>
                                <div class="post__vote-wrap">
                                    <p class="post__votes">20</p>
                                    <button class="btn btn--upvote">👍</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </section>

</main>