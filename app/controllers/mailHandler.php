<?php

require './authenticationHelpers.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $to = 'zemh02@vse.cz';
    $subject = 'Hynstagram: Message from '.stringCleaner($_POST['strangerEmail']);
    $message = stringCleaner($_POST['strangerMessage']);
    
    $headers = 'From: '.$_POST['strangerEmail'].' <'.$_POST['strangerEmail'].'>'."\r\n" .
    'Reply-To: '.$_POST['strangerEmail']."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    if(!isset($_POST['strangerEmail'])){
        $_SESSION['errorMessageMail'] .= 'Please tell us your mail so we can catch up! 📧 <br><hr>';
        header("location:../index.php");
        exit();
    }
    
    if (!filter_var($_POST['strangerEmail'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorStrangerMail'] = $_POST['strangerEmail'];
        $_SESSION['errorStrangerMessage'] = $_POST['strangerMessage'];
        $_SESSION['errorMessageMail'] .= 'This does not look like an email address! 📧 <br><hr>';
        header("location:../index.php");
        exit();
    }
    
    if(!isset($_POST['strangerMessage'])){
        $_SESSION['errorStrangerMail'] = $_POST['strangerEmail'];
        $_SESSION['errorStrangerMessage'] = $_POST['strangerMessage'];
        $_SESSION['errorMessageMail'] .= 'Sometimes silent communication is worth a thousand words, but we would really like to hear your opinion this time!<br><hr>';
        header("location:../index.php");
        exit();
    }
    
    mail($to, $subject, stringCleaner($message), $headers);
    
    $_SESSION['successMessageMail'] .= 'Like a pro 👍 your message has been sent! You may or may not hear from us back, thanks! 👌';
    header("location:../index.php");
    exit();
}


?>