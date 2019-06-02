<!-- infoDbModifier.php -->
<?php

require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

// db connection 

function updateData(PDO $db, $data, $dbColumn)
{
    $query = $db->prepare('UPDATE Users SET '.$dbColumn.'=:'.$dbColumn.' WHERE userID=:userID LIMIT 1;');
    $query->execute([
        ':'.$dbColumn => stringCleaner($data),
        ':userID'=> $_SESSION['userID']
    ]);
}

// check passwords are the same

function isPasswordIdentical($first, $second){
    return $first === $second;
}

// verify that user knows his old password
function verifyOldPassword($oldPswd){
    return password_verify($oldPswd, $_SESSION['password']);
}

// check if password already exists in DB
// return true if already exists
function passwordExists($newPswd){    
    return password_verify($newPswd, $_SESSION['password']);
}

// hash, salt and insert new Password to Db
function updatePassword(PDO $db, $newPswd)
{
    $query = $db->prepare('UPDATE Users SET password=:password WHERE userID=:userID LIMIT 1;');
    $query->execute([
        ':password' => password_hash($newPswd, PASSWORD_DEFAULT),
        ':userID'=> $_SESSION['userID']
    ]);
}

function checkUserId(PDO $db, $id)
{
    // check if user exists against database
    $query = $db->prepare('SELECT * FROM Users WHERE userID=:userID LIMIT 1;');
    // execute query
    $query->execute([':userID' => stringCleaner($id)]);
    // fetch query
    $user = $query->fetchObject();
    
    return $user;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get $user object
    $user = checkUserId($db, $_SESSION['userID']);
    // get form values
    $newValue = stringCleaner($_POST[$_SESSION['modify'].'New']);
    
    if($_SESSION['modify'] === 'password'){
        $oldPassword = stringCleaner($_POST['oldPassword']);
        $newValue2 = stringCleaner($_POST[$_SESSION['modify'].'New2']);
        
        // user know his old password
        if(!verifyOldPassword($oldPassword)){
            $_SESSION['errorMessage'] .= 'Old password is not correct!<br><hr>';
            header("location:../userDataChange.php");
            exit();
        }
        
        // passwords must match
        if(!isPasswordIdentical($newValue, $newValue2)){
            $_SESSION['errorMessage'] .= 'Newly entered passwords do not match!<br><hr>';
            header("location:../userDataChange.php");
            exit();
        }
        
        // password is unique
        if (passwordExists($newValue)){
            $_SESSION['errorMessage'] .= 'Please enter password unique from the current one. (Otherwise what is the point right? 🤓)<br><hr>';
            header("location:../userDataChange.php");
            exit();
        }
        
        updatePassword($db, $newValue);
              
        // refresh session
        sessionSetter($user);
        $_SESSION['successMessage'] .= 'Your password was changed! ✅ <br><hr>';
        header("location:../profile.php");
        exit();
    } else {
        
        // 1. check if data exists
        if($newValue === $_SESSION[$_SESSION['modify']]){
            $_SESSION['errorMessage'] .= 'Please enter new data. (Otherwise what is the point right? 🤓)<br><hr>';
            header("location:../userDataChange.php");
            exit();
        }
        // update data in database
        updateData($db, $newValue, $_SESSION['modify']);
        // update session data
        $modified = $_SESSION['modify'];
        // session_destroy();
        sessionSetter($user);
        $_SESSION['successMessage'] .= 'Your '. $modified.' was changed! ✅ <br><hr> Changes will be available after next login.';
        header("location:../profile.php");
        exit();
    }
}

header("HTTP/1.1 404 Not Found");

?>