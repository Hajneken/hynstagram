<?php 

function stringCleaner($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isNicknameSet($user){
    return isset($user->nickname);
}

function sessionSetter($user){
    session_start();
    // looping over object
    foreach ($user as $propName => $propValue) {
        $_SESSION[$propName] = $propValue;
    }
}

function saveValuesToSession($postVariable){
    foreach ($postVariable as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

?>
