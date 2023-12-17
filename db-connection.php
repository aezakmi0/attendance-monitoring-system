<?php

$host = 'localhost';
$dbname = 'db_attendance';
$user = 'root';
$password = '';

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

    // Enable PDO exceptions for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionally set other PDO attributes as needed
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle connection errors
    die("Error: " . $e->getMessage());
}

?>