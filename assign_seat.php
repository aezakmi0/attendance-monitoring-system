<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php'; // Include the PDO connection file

// Get data from the AJAX request
$user_ID = $_SESSION['user_id'];
$classId = isset($_GET['classId']) ? $_GET['classId'] : null;
$seatNumber = isset($_GET['seatNumber']) ? $_GET['seatNumber'] : null;
$studentID = isset($_GET['studentID']) ? $_GET['studentID'] : null;

// Initialize response array
$response = array();

try {
    // Start a transaction
    $pdo->beginTransaction();

    // Delete existing seat assignment
    $deleteSql = "DELETE FROM tb_seatplan WHERE user_ID = ? AND student_ID = ? AND class_ID = ?";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->execute([$user_ID, $studentID, $classId]);

    // Insert new seat assignment
    $insertSql = "INSERT INTO tb_seatplan (user_ID, class_ID, seat_number, student_ID) VALUES (?, ?, ?, ?)";
    $insertStmt = $pdo->prepare($insertSql);
    $insertStmt->execute([$user_ID, $classId, $seatNumber, $studentID]);

    // Commit the transaction
    $pdo->commit();

    $response['status'] = 'success';
    $response['message'] = 'Seat assignment successful.';
} catch (PDOException $e) {
    // Rollback the transaction if an error occurs
    $pdo->rollBack();

    $response['status'] = 'error';
    $response['message'] = 'Error assigning seat: ' . $e->getMessage();
}

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);