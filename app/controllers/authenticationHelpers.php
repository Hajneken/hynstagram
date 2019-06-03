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

function debug($variable, $header){
    $VAR = var_dump($variable);
    $_SESSION['errorMessage'] .= $VAR; 
    header('location:./'.$header);
    exit();
}

function sessionMessage($success, $message, $headers){
    $messageCode = 'errorMessage';
    if($success){
        $message = 'successMessage'; 
    }
    $_SESSION[$messageCode] .= $message.'<br><hr>';
        header("location:./$headers");
}

?>
