<?php
// IMPORTANT NOTE: For security reasons, this file is not usable with current settings, please change with respect to the settings of your database and server
// afterwards rename this file to connectDb.php
$db = new PDO('mysql:host=127.0.0.1;dbname=yourDbName;charset=utf8', 'login', 'dbPasswd');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

?>