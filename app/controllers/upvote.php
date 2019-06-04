<?php

require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();


$postId = $_GET['id'];
$topicID = $_SESSION['currentTopicId'];

if(!isset($_SESSION['userID'])){
    $_SESSION['errorMessage'] .= 'Only <a href="./sign.php">registered</a> users can vote 😯';
    header('location:./../topic.php?id='.$topicID);
    exit();
}

$query = $db->prepare('SELECT * FROM Posts WHERE postID=:postID LIMIT 1;');
$query->execute([':postID' => $postId]);
$topicObj = $query->fetchObject();


$votes = $topicObj->votes;


$votesNum = (int)$votes + 1;

$query = $db->prepare('UPDATE Posts SET votes=:votes WHERE postID=:postID LIMIT 1;');
$query->execute([
    ':postID' => $postId,
    ':votes' => $votesNum
]);

header('location:../topic.php?id='.$topicID);
?>