<?php
// Turn on error reporting so syntax and runtime errors are visible during development
ini_set('display_errors', 1);
error_reporting(E_ALL);


$host = "localhost";
$db = "week_two";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db";

try {
    
    $pdo = new PDO($dsn $username,);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

    echo "Connected to database!";

catch (PDOException $e {
    echo "Database error: " . $e
}
