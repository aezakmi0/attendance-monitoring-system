<?php
require_once 'includes/dbh.inc.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve class ID and date from the POST data
    $classId = $_POST['classId'];
    $date = $_POST['date'];

    try {
        // Perform database operation to delete status records for the specified class on the current date
        // Adjust the SQL query based on your database schema
        $sql = "DELETE FROM tb_attendance WHERE class_ID = ? AND date = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$classId, $date]);

        // Respond with success message or any relevant data
        echo json_encode(['success' => true, 'message' => 'Attendance status reset successfully']);
    } catch (PDOException $e) {
        // Respond with error message
        echo json_encode(['success' => false, 'message' => 'Error resetting attendance status: ' . $e->getMessage()]);
    }
} else {
    // If the request method is not POST, respond with an error message
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}