<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ID = $_SESSION["user_id"];
    $classId = $_POST['classId'];
    $studentId = $_POST['studentId'];
    $date = $_POST['date'];
    $status = $_POST['status']; 

    try {
        // Check if a record already exists for the student and date
        $checkSql = "SELECT * FROM tb_attendance WHERE user_ID = ? AND class_ID = ? AND student_ID = ? AND date = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$user_ID, $classId, $studentId, $date]);
        $checkResult = $checkStmt->fetch(PDO::FETCH_ASSOC);

        // If a record exists, delete the previous row
        if ($checkResult) {
            $deleteSql = "DELETE FROM tb_attendance WHERE user_ID = ? AND class_ID = ? AND student_ID = ? AND date = ?";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->execute([$user_ID, $classId, $studentId, $date]);
        }

        // Insert the new record
        $insertSql = "INSERT INTO tb_attendance (user_ID, class_ID, student_ID, date, status) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute([$user_ID, $classId, $studentId, $date, $status]);

        echo "Attendance record updated successfully";
    } catch (PDOException $e) {
        // Log or echo the detailed error message for debugging
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$pdo = null;
