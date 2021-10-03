#!/usr/bin/php -q
<?php

require 'config.php';
$db_connection = new Database();
$connect = $db_connection->dbConnection();

try{
    $UpdateToken = "UPDATE magicLogin SET token=NULL";
    $UpdateToken = $connect->prepare($UpdateToken);
    $UpdateToken->execute();

    echo "success";
}

catch (PDOException $error) {
    $message = $error->getMessage();
    echo $message;
}