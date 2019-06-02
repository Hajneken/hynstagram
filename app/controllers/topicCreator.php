<?php

// database connection 
require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

function insertTopicInDb(PDO $db, $name, $desctiption, $isPublic)
{
    $query = $db->prepare('INSERT into Topics(name, description, isPublic, author) VALUES(:name, :description, :isPublic, :author)');
    $query->execute([
        ':name' => $name,
        ':description' => $desctiption,
        ':isPublic' => $isPublic,
        ':author' => $_SESSION['userID']
    ]);
}

function createTopicDirectory($name, $topicBoilerplate){
    // create directory
    $dir = mkdir('./topics/topic'.$name);
    // create file
    $file = fopen($dir.'/'.'topic'.$name.'.php', 'w');
    // write to file
    fwrite($file, $topicBoilerplate);
    // close the file
    fclose($file);
    
    return './topics/topic'.$name.'/'.'topic'.$name.'.php';
}

function checkForDuplicateTopic(PDO $db, $topic)
{
    $query = $db->prepare('SELECT * FROM Topics WHERE name=:name LIMIT 1;');
    $query->execute([':name' => stringCleaner($topic)]);

    $topicObj = $query->fetchObject();
    if ($topicObj) {
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topicName = $_POST['topicName'];
    $topicDescription = $_POST['topicDescription'];
    $isPublic = $_POST['isPublic'];

    if (checkForDuplicateTopic($db, $topicName)) {
        $_SESSION['errorMessage'] .= 'Sombody was faster than you, a topic with this name already exists!<br><hr>';
        header("location:../index.php");
        exit();
    }

    if ($isPublic === '1') {
        insertTopicInDb($db, stringCleaner($topicName), stringCleaner($topicDescription), 1);
    }
    insertTopicInDb($db, stringCleaner($topicName), stringCleaner($topicDescription), 0);
    
    
}



$_SESSION['successMessage'] .= 'Your new topic named ' . $topicName . ' was born 👶. Check it out <a href="'.createTopicDirectory(stringCleaner($topicName), include "./topicBoilerplate.php").'">Here</a>!';
header("location:../index.php");
exit();

?>