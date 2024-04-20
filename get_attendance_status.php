<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Validate and sanitize input parameters
$user_ID = $_SESSION['user_id'];
$classId = isset($_GET['classId']) ? intval($_GET['classId']) : 0;
$studentId = isset($_GET['studentId']) ? intval($_GET['studentId']) : 0;

if ($classId <= 0 || $studentId <= 0) {
    // Invalid parameters, handle accordingly (e.g., return an error response)
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

try {
    // Your database query to fetch attendance status
    // Modify this query based on your database structure
    $query = "SELECT status FROM tb_attendance WHERE user_ID = ? AND class_ID = ? AND student_ID = ? AND date = CURRENT_DATE";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_ID, $classId, $studentId]);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Attendance status found, return it as JSON
        echo json_encode(['status' => $result['status']]);
    } else {
        // No attendance record for the current day, handle this case
        echo json_encode(['status' => 'No attendance']);
    }
} catch (PDOException $e) {
    // Handle database query error
    echo json_encode(['error' => 'Database query error: ' . $e->getMessage()]);
}

// Close the database connection (not necessary for PDO)
// $pdo = null;