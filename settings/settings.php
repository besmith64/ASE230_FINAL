<?php
//settings.php

$host = '127.0.0.1';
$db = 'finalprojectase230';
$user = 'root';
$pass = '';
$port = 3306;
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
];
// Specify connection
try {
    $connection = new \PDO("mysql:host=$host;dbname=$db;charset=$charset;port=$port", $user, $pass, $options);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

if (session_start() != PHP_SESSION_ACTIVE) session_start(); // Start session