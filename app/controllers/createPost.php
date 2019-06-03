<?php

require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

//   insert into database
function insertPostInDb(PDO $db, $url, $topicId, $authorId){
    $query = $db->prepare('INSERT into Posts(url, topic, author) VALUES(:url, :topic, :author)');
    $query->execute([
        ':url' => $url,
        ':topic' => $topicId,
        ':author' => $authorId
    ]);
    // MIGHT NOT WORK!!!!
    // $dbObj = $query->fetchObject();
    // $_SESSION['currentPostId'] = $dbObj->topicId;  
}

// returns object representation of inserted post
function fetchInsertedPostObj(PDO $db, $url){
    $query = $db->prepare('SELECT * FROM Topics WHERE url=:url LIMIT 1;');
    $query->execute([':url' => $url]);
    $topicObj = $query->fetchObject();
    return $topicObj;
}

// returns URL of the saved image
function createPostUrl($currentTopicName, $file){
    return './topics/topic_'.$currentTopicName.'/'.$file;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dbObj;
    
    $postUrl = createPostUrl($_SESSION['currentTopicName'], $_FILES["myFile"]['name']);
    
    //  upload img <to></to> it's place on server 
    $isUploaded = move_uploaded_file($_FILES["myFile"]["tmp_name"], $postUrl);
    
    if ($isUploaded) {
        
        $postUrl = createPostUrl($_SESSION['currentTopicName'], $_FILES["myFile"]['name']);
        
        // inserting in db ...
        insertPostInDb($db, $postUrl, $_SESSION['currentTopicId'], $_SESSION['userID']);
        
        // $_SESSION['newPost'] = $_FILES["myFile"]['name'];
        $dbObj = fetchInsertedPostObj($db, $postUrl);
        
        $_SESSION['currentPostId'] = $dbObj->postID;
        
        // file uploaded succeeded
        sessionMessage(true, 'nice!', 'topic.php');
        $_SESSION['successMessage'] .= 'Nice job! 🚀'.'<br><hr>';
        header('location:../topic.php?='.$_SESSION['currentTopicId']);
      }
      
      
}

// TODO display posts

header('location:./topic.php');

?>