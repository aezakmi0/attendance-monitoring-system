<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Check if the class_ID and student_ID are provided in the URL
if (isset($_GET['id']) && isset($_GET['studentid'])) {
    $classID = $_GET['id'];
    $studentID = $_GET['studentid'];

    // Soft delete the student in tb_enrollment
    $updateEnrollmentQuery = "UPDATE tb_enrollment SET is_deleted = 1 WHERE class_ID = ? AND student_ID = ?";
    $updateEnrollmentStmt = $pdo->prepare($updateEnrollmentQuery);
    $updateEnrollmentStmt->execute([$classID, $studentID]);

    // Check for errors during the update in tb_enrollment
    if ($updateEnrollmentStmt->errorCode() !== '00000') {
        $response = array('success' => false, 'message' => 'Error soft deleting student in tb_enrollment: ' . $updateEnrollmentStmt->errorInfo()[2]);
        echo json_encode($response);
        exit(); // Stop further execution
    }

    // Soft delete the student in tb_seatplan
    $updateSeatplanQuery = "UPDATE tb_seatplan SET is_deleted = 1 WHERE class_ID = ? AND student_ID = ?";
    $updateSeatplanStmt = $pdo->prepare($updateSeatplanQuery);
    $updateSeatplanStmt->execute([$classID, $studentID]);

    // Check for errors during the update in tb_seatplan
    if ($updateSeatplanStmt->errorCode() !== '00000') {
        $response = array('success' => false, 'message' => 'Error soft deleting student in tb_seatplan: ' . $updateSeatplanStmt->errorInfo()[2]);
        echo json_encode($response);
        exit(); // Stop further execution
    }

    $_SESSION['success_message'] = 'Student removed!';
} else {
    // Handle the case where class_ID or student_ID is not provided
    $response = array('success' => false, 'message' => 'Class ID or Student ID not provided!');
    echo json_encode($response);
    exit(); // Stop further execution
}

// Close the database connection
$pdo = null;

// Redirect to the enroll-student page
header("Location: enroll-student.php?id=$classID");
exit();
