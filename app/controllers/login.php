<?php
// check if user exists in database and if his hash matches pswd matches
require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

function dbCheck(PDO $db, $email)
{
    // check if user exists against database
    $query = $db->prepare('SELECT * FROM Users WHERE email=:email LIMIT 1;');
    // execute query
    $query->execute([':email' => stringCleaner($email)]);
    // fetch query
    $user = $query->fetchObject();

    return $user;
}

// select password from user with id
// https://php.net/manual/en/function.password-verify.php
function checkPassword($pswd, $dbObj)
{
    $password = password_hash($pswd, PASSWORD_DEFAULT);
    $toCheckAgainst = $dbObj->password;
    
    $isCorrect = password_verify($pswd, $toCheckAgainst);
    
    // dbPassword hash check
    // return $password === $toCheck;
    return $isCorrect;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];

    $user = dbCheck($db, $email);
    if ($user && checkPassword($password, $user))
     {
        // set up session with users name
        if (isNicknameSet($user)) {
            $_SESSION['isLoggedIn'] = $user->nickname;
        } else {
            $_SESSION['isLoggedIn'] = $user->email;
        }
        // set user info into session
        sessionSetter($user);
        
        $_SESSION['successMessage'] .= 'Welcome back! 🦄';
        // redirect to the ok site
        header("location:../index.php");
        exit();
        
    }
    saveValuesToSession($_POST);
    $_SESSION['errorMessageLogIn'] .= 'Invalid combination! 🤯<br><hr>';
    header("location:../sign.php");
    exit();
}

header("HTTP/1.1 404 Not Found");
?>