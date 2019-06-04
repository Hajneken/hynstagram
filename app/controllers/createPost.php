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
    $query = $db->prepare('SELECT * FROM Posts WHERE url=:url LIMIT 1;');
    $query->execute([':url' => $url]);
    $topicObj = $query->fetchObject();
    return $topicObj;
}

// returns URL of the saved image
function createPostUrl($currentTopicName, $fileName){
    return '../topics/topic_'.urlencode($currentTopicName).'_id_'.$_SESSION['currentTopicId'].'/'.$fileName;
}

function createPostUrltoDB($currentTopicName, $fileName){
    return './topics/topic_'.urlencode($currentTopicName).'_id_'.$_SESSION['currentTopicId'].'/'.$fileName;
}


// debug
    // $_SESSION['errorMessage'] .= $_SESSION['currentTopicName'].' <br><hr>';
    // header("location:./index.php");
    // exit();
    
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["myFile"]) ){
    
    $tempFile = $_FILES["myFile"]["tmp_name"];
    $fileName = $_FILES["myFile"]['name'];
    
    // fixing problem with url
    // should return
    //  $_FILES["myFile"]["tmp_name"],'../topics/.'.$fileName.'/'.$_FILES["myFile"]['name']
    $postUrl = createPostUrl($_SESSION['currentTopicName'], $fileName);
    
    $postUrlDb = createPostUrltoDB($_SESSION['currentTopicName'], $fileName);
    
        // $_SESSION['errorMessage'] .= $postUrl.' <br><hr>';
        // header("location:./index.php");
        // exit();
        
    //  upload img to it's directory on server 
    // move_uploaded_file($tempFile , $postUrl);
    // 🚩🚩🚩🚩
    
    if (move_uploaded_file($tempFile , $postUrl)) {
        // inserting in db ...
        insertPostInDb($db, $postUrlDb, $_SESSION['currentTopicId'], $_SESSION['userID']);
        
        // $_SESSION['newPost'] = $_FILES["myFile"]['name'];
        $dbObj = fetchInsertedPostObj($db, $postUrlDb);
        
        $_SESSION['currentPostId'] = $dbObj->postID;
        
        // file uploaded succeeded
        // sessionMessage(true, 'nice!', 'topic.php');
        $_SESSION['successMessage'] .= 'Nice job! 🚀'.'<br><hr>';
        
        header('location:../topic.php?id='.$_SESSION['currentTopicId']);
        exit();
      } else {
        $_SESSION['errorMessage'] .= 'Sorry our fault 😐, please try to upload your image again 🙃 <br><hr>';
        header('location:../topic.php?id='.$_SESSION['currentTopicId']);
        exit();
      }
      
}

// TODO display posts
$_SESSION['errorMessage'] .= 'Upload image first, would you? 😝 <br><hr>';
header('location:../topic.php?id='.$_SESSION['currentTopicId']);

?>