<?php
require '../db/connectDb.php';
require './authenticationHelpers.php';



function getTopic($topicName){
    // connect to DB, fetch Topic with the corresponding $topicName
    $topicObj = 'DB response'; //fetch topic db obj
    return $topicObj;
}

function getAuthor($topicObj){
    // look into topicObj and search for 
    $authorId = $topicObj->author;
    // connect to DB and retrieve user
    $authorName = 'author name from obj';
    return $authorName;
}

foreach(getTopic($topicName)){
    // echo topic
    $authorName = getAuthor($authorId);
    echo '<div class="row">
    <div class="col-12 col-md-6">
        <div class="wrapper">
            <div class="post">
                <div class="post__img-wrap"><img src="'.$url.'alt='.$pictureName.'" class="post__img"></div><div class="post__meta">
                <div class="post__autor-wrap">
                    <p class="post__author">'.$authorName.'</p>
                    </div>
                    <div class="post__vote-wrap">
                        <p class="post__votes">'.$voteNum.'</p>
                        <button class="btn btn--upvote">👍</button>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>';
}

?>