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

    // Check if a record already exists for the student and date
    $checkSql = "SELECT * FROM tb_attendance WHERE class_ID = ? AND student_ID = ? AND date = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("iis", $classId, $studentId, $date);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    // If a record exists, delete the previous row
    if ($checkResult->num_rows > 0) {
        $deleteSql = "DELETE FROM tb_attendance WHERE class_ID = ? AND student_ID = ? AND date = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("iis", $classId, $studentId, $date);
        $deleteStmt->execute();
        $deleteStmt->close();
    }

    // Insert the new record
    $insertSql = "INSERT INTO tb_attendance (class_ID, student_ID, date, status) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iiss", $classId, $studentId, $date, $status);

    try {
        $insertStmt->execute();
        echo "Attendance record updated successfully";
    } catch (mysqli_sql_exception $e) {
        // Log or echo the detailed error message for debugging
        echo "Error: " . $e->getMessage();
    }

    $insertStmt->close();
    $checkStmt->close();
}

$conn->close();
?>
