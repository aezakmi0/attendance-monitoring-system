<?php
require_once 'includes/dbh.inc.php';

// Get the class ID from the URL
$classId = isset($_GET['class_id']) ? $_GET['class_id'] : null;

// Assuming you have a PDO database connection established
try {
    // Fetch the count of students for the given class
    $sql = "SELECT COUNT(*) AS total_students FROM tb_enrollment WHERE class_ID = ? AND is_deleted = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$classId]);

    // Fetch the result
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle database error
    echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
}