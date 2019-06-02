<?php

// database connection 
require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

function checkEmail(PDO $db, $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorMessage'] .= 'This does not look like an email!<br><hr>';
        return false;
    }
    // check if user exists against database
    $query = $db->prepare('SELECT * FROM Users WHERE email=:email LIMIT 1;');
    // execute query
    $query->execute([':email' => stringCleaner($email)]);
    // fetch query
    $user = $query->fetchObject();

    if ($user) {
        $_SESSION['errorMessage'] .= 'Submitted email is already registered!<br><hr>';
        return false;
    }
    return true;
}

function checkNickname(PDO $db, $nickname)
{
    // check if user exists against database
    $query = $db->prepare('SELECT * FROM Users WHERE nickname=:nickname LIMIT 1;');
    // execute query
    $query->execute([':nickname' => stringCleaner($nickname)]);
    // fetch query
    $user = $query->fetchObject();

    if ($user) {
        $_SESSION['errorMessage'] .= 'Submitted nickname is already registered!<br><hr>';
        return false;
    }

    return true;
}

function validatePassword($pswd, $pswdCheck)
{
    if ($pswd === $pswdCheck) {
        if (strlen($pswd) >= 8) {
            return true;
        }
        $_SESSION['errorMessage'] .= 'Your password is too weak, please help us to make a world a safer palce and choose password at least 8 characters long.<br><hr>';
        return false;
    }
    $_SESSION['errorMessage'] .= 'Your passwords do not match!<br><hr>';
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['newUserEmail'];
    $nickname = $_POST['newUserNickname'];
    $password = $_POST['newUserPassword'];
    $passwordCheck = $_POST['passwordCheck'];

    if (checkEmail($db, $email) && checkNickname($db, $nickname) && validatePassword($password, $passwordCheck)) {

        $query = $db->prepare('INSERT into Users(email, password, nickname) VALUES(:email, :password, :nickname)');
        //add salt to pswd and store as hash
        $query->execute([
            ':email' => stringCleaner($email),
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':nickname' => stringCleaner($nickname)
        ]);

        // redirect to the ok site
        $_SESSION['successMessage'] .= 'Welcome to the Community! 💘';
        header("location:../index.php");
        exit();
        // header("location:https://www.seznam.cz/");
    } else {
        $_SESSION['errorMessage'] .= '💔 Dare to try again? 💪';
        header("location:../sign.php");
        exit();
    }
    // redirect to the ok site
    $_SESSION['successMessage'] .= 'Welcome to the Community! 💘';
    // redirect to the ok site
    header("location:../index.php");
     
}

?>