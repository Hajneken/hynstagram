<?php

require '../db/connectDb.php';
require './authenticationHelpers.php';

session_start();

// initital votes = 0

function savePostInDb($url){
    // Insert into DB 
}

// creates post by calling savePostInDb
function createPost($url){
    // check for malicious code?
    if(true){
    savePostInDb($url);
    }
}

// if new post is submitted
if(true){
    // createnew post and fetch the name of the file to set path to the file 
    // https://php.net/manual/en/features.file-upload.post-method.php
    createPost($_FILES['fileName']);
}

// if(!empty($_POST)){
//     // aktualizace obsahu 
//     $query = $db->prepare('UPDATE clanky SET obsah=:obsah WHERE id=:id LIMIT 1;');
//     $query->execute([
//         ':obsah'=>$_POST['obsah'],
//         ':id'=>$id_stranky
//     ]);
// }




?>