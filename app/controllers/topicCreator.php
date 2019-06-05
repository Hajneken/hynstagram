<?php

// database connection 
require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

$topicBoilerPlate = '<?php
include "./controllers/userController.php"
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../include/head.php" ?>

<body>
    <?php include "../include/nav.php" ?>
    
    <?php include "../include/footer.php" ?>
    <?php include "../include/scripts.php" ?>
</body>

</html>';

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

function fetchInsertedTopicObj(PDO $db, $name){
    $query = $db->prepare('SELECT * FROM Topics WHERE name=:name LIMIT 1;');
    $query->execute([':name' => $name]);
    $topicObj = $query->fetchObject();
    return $topicObj;
}

// returns new folder path 
function createTopicDirectory($name, $topicId){
    $url = '../topics/topic_'.urlencode($name).'_id_'.$topicId;
    // create directory
    if(mkdir($url, 0777, true)){
        chmod('../topics', 0777);
        chmod($url, 0777);
        return $url;
    }
    // MIGHT MAKE PROBLEMS
    sessionMessage(false, 'Unable to create a folder!', 'topic.php');
    exit();
}

// returns path to the file 🚩❌❌❌🚩
function createTopicFile($path, $name, $contents){
    // create file in on a specified url
    $file = fopen('.'.$path.'topic_'.$name.'.php', 'w');
    // write to file
    fwrite($file, $contents);
    // close the file
    fclose($file);
    
    return $path.'topic_'.$name.'.php';
}

function checkForDuplicateTopic(PDO $db, $topic)
{
    $query = $db->prepare('SELECT * FROM Topics WHERE name=:name LIMIT 1;');
    $query->execute([':name' => stringCleaner($topic)]);

    $topicObj = $query->fetchObject();
    // if exists then there are duplicates
    if ($topicObj) {
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topicName = stringCleaner($_POST['topicName']);
    $topicDescription = stringCleaner($_POST['topicDescription']);
    $isPublic = stringCleaner($_POST['isPublic']);
    
    if(strlen($topicDescription)>500){
        $_SESSION['errorMessage'] .= 'We sure do love great books, but for the sake of convenience, try to be more brief and let\'s make it fewer than 500 characters! 📚<br><hr>';
        header("location:../index.php");
        exit();
    }
    
    if (checkForDuplicateTopic($db, $topicName)) {
        $_SESSION['errorTopicName'] = $topicName;
        $_SESSION['errorTopicDescription'] = $topicDescription;
        $_SESSION['errorMessage'] .= 'Sombody was faster than you, a topic '.$topicName.' already exists!<br><hr>';
        header("location:../index.php");
        exit();
    }
    

    if ($isPublic === '1') {
        insertTopicInDb($db, $topicName, stringCleaner($topicDescription), 1);
    }
    insertTopicInDb($db, $topicName, stringCleaner($topicDescription), 0);
    
    // refresh currentTopicId
    if (isset($_SESSION['currentTopicId'])){
        unset($_SESSION['currentTopicId']);
    }
    
    $_SESSION['currentTopicId'] = fetchInsertedTopicObj($db, $topicName)->topicID;
    
    $dir = createTopicDirectory($topicName,$_SESSION['currentTopicId']);
}

// current topic 🤘 won't work if first time
$newTopicUrl = './topic.php?id='.$_SESSION['currentTopicId'];

$_SESSION['successMessage'] .= 'Your new topic named '.htmlspecialchars($topicName).' was born 👶. Check it out <a href="'.$newTopicUrl.'">Here</a>!';

header("location:../index.php");
exit();

?>