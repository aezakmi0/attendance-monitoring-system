<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Initialize the search term variable
$searchTerm = $_GET['search'] ?? '';
$filterTime = $_GET['filterTime'] ?? '';
$filterRoom = $_GET['filterRoom'] ?? '';

error_log('Search term: ' . $searchTerm);
error_log('Filter time: ' . $filterTime);
error_log('Filter Room: ' . $filterRoom);

// Base query
$classQuery = "SELECT * FROM tb_class WHERE is_deleted = 0 AND user_ID = ?";

// Parameters array
$params = [];
$params[] = $_SESSION['user_id']; // User ID parameter

// Add the search condition if the searchTerm is provided
if (!empty($searchTerm)) {
    $classQuery .= " AND (class_code LIKE ? OR class_name LIKE ?)";
    $params[] = '%' . $searchTerm . '%';
    $params[] = '%' . $searchTerm . '%';
}

// Add the time condition if the filterTime is provided
if (!empty($filterTime)) {
    $classQuery .= " AND time_start <= ? AND time_end >= ?";
    $params[] = $filterTime;
    $params[] = $filterTime;
}

// Add the room condition if the filterRoom is provided
if (!empty($filterRoom)) {
    $classQuery .= " AND room = ?";
    $params[] = $filterRoom;
}

// Prepare the statement
$stmt = $pdo->prepare($classQuery);

// Bind parameters
$stmt->execute($params);

// Execute the statement
$resultClass = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the statement
$stmt->closeCursor();

// Create an array to store the results
$data = [];

// Fetch the data and store it in the array
foreach ($resultClass as $rowClass) {
    // Fetch the count of students for the given class with is_deleted condition
    $classId = $rowClass['class_ID'];
    $sqlStudents = "SELECT COUNT(*) AS total_students FROM tb_enrollment WHERE class_ID = ? AND is_deleted = 0";
    $stmtStudents = $pdo->prepare($sqlStudents);
    $stmtStudents->execute([$classId]);
    $totalStudents = $stmtStudents->fetchColumn();
    $rowClass['total_students'] = $totalStudents;
    $data[] = $rowClass;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);

