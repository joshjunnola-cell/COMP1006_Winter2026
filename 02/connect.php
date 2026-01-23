<?php
declare(strict_types=1);

$host = 'localhost'; //hostname
$db = "week2"; //database name
$user = "root"; //username
$password = ""; //password

//Points to the database
$dsn = "mysql:host=$host;dbname=$db";

//try to connect to the database, if connected echo yay
try {
    $pdo = new PDO ($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p> Yay, Connected to the database! </p>";
}
//what happens if there is an error connecting to the database
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
