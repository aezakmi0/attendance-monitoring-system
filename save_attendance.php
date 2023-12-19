<?php
// save_attendance.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classId = $_POST['classId'];
    $studentId = $_POST['studentId'];
    $date = $_POST['date'];
    $status = $_POST['status']; 

    // Use UPSERT (INSERT ON DUPLICATE KEY UPDATE) to handle new or existing records
    $sql = "INSERT INTO tb_attendance (class_ID, student_ID, date, status)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE status = VALUES(status)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $classId, $studentId, $date, $status);

    try {
        $stmt->execute();
        echo "Attendance record updated successfully";
    } catch (mysqli_sql_exception $e) {
        // Log or echo the detailed error message for debugging
        echo "Error: " . $e->getMessage();
    }
    

    $stmt->close();
}

$conn->close();
?>
