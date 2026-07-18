<?php

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'phpmyadmin';
$pass = getenv('DB_PASSWORD') ?: 'disaster';
$db   = getenv('DB_NAME') ?: 'bsms';
$port = getenv('DB_PORT') ?: '3306';

$con=mysqli_connect($host, $user, $pass, $db, $port);

?>