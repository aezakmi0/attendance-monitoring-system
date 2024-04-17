<?php

$host = 'server1319';
$dbname = 'u341493210_db_attendance';
$dbusername = 'u341493210_aezakmi0';
$dbpassword = '$variable1="Hi";';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
