<?php


require 'db.php';

$port = 3306;
$dbHost = "localhost";
$dbName = "schools";
$dbUser = "root";
$dbPassword = "";

$db = new MysqliDb (Array ('host' => $dbHost, 'username' => $dbUser, 'password' => $dbPassword, 'db' => $dbName, 'port' => $port));




?>