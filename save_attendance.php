<?php
// save_attendance.php

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the class_ID from the URL
$classId = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through the seat assignments and save attendance to the database
    foreach ($_POST['seats'] as $seatNumber => $status) {
        // Assuming you have a session or some other way to get the student_ID
        $studentId = 1; // Replace with your logic to get the student_ID

        // Get the current date
        $date = date('Y-m-d');

        // Insert or update the attendance record
        $sql = "INSERT INTO tb_attendance (class_ID, student_ID, date, status) VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE status = VALUES(status)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiss', $classId, $studentId, $date, $status);
        $stmt->execute();
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the seatplan page or any other page
    header("Location: seatplan.php?id=" . $classId);
    exit();
}
?>
