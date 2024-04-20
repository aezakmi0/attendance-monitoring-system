<?php
require_once 'includes/dbh.inc.php';

// Get the class_ID from the URL
$classId = isset($_GET['classId']) ? $_GET['classId'] : null;

try {
    // Fetch student data based on class_ID
    $sql = "SELECT * FROM tb_student WHERE student_ID IN (SELECT student_ID FROM tb_enrollment WHERE class_ID = ? AND is_deleted = 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$classId]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($students);
} catch (PDOException $e) {
    // Handle database error
    echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
}
