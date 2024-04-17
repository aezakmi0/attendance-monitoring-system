<?php
session_start();
// Assuming you have a database connection established
$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$database = "u341493210_db_attendance";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the class_ID and student_ID are provided in the URL
if (isset($_GET['id']) && isset($_GET['studentid'])) {
    $classID = $_GET['id'];
    $studentID = $_GET['studentid'];

    // Soft delete the student in tb_enrollment
    $updateEnrollmentQuery = "UPDATE tb_enrollment SET is_deleted = 1 WHERE class_ID = ? AND student_ID = ?";
    $updateEnrollmentStmt = $db->prepare($updateEnrollmentQuery);
    $updateEnrollmentStmt->bind_param("ii", $classID, $studentID);
    $updateEnrollmentStmt->execute();

    // Check for errors during the update in tb_enrollment
    if ($updateEnrollmentStmt->errno) {
        $response = array('success' => false, 'message' => 'Error soft deleting student in tb_enrollment: ' . $updateEnrollmentStmt->error);
        echo json_encode($response);
    } else {
        // Soft delete the student in tb_seatplan
        $updateSeatplanQuery = "UPDATE tb_seatplan SET is_deleted = 1 WHERE class_ID = ? AND student_ID = ?";
        $updateSeatplanStmt = $db->prepare($updateSeatplanQuery);
        $updateSeatplanStmt->bind_param("ii", $classID, $studentID);
        $updateSeatplanStmt->execute();

        // Check for errors during the update in tb_seatplan
        if ($updateSeatplanStmt->errno) {
            $response = array('success' => false, 'message' => 'Error soft deleting student in tb_seatplan: ' . $updateSeatplanStmt->error);
        } else {
            // $response = array('success' => true, 'message' => 'Student soft deleted successfully.');
            // header("Location: enroll-student.php?id=$classID");
            // exit();
            $_SESSION['success_message'] = 'Student removed!';
        }

        // Close the prepared statement for tb_seatplan
        $updateSeatplanStmt->close();
    }

    // Close the prepared statement for tb_enrollment
    $updateEnrollmentStmt->close();
} else {
    // Handle the case where class_ID or student_ID is not provided
    $response = array('success' => false, 'message' => 'Class ID or Student ID not provided!');
   
}

// Close the database connection
$db->close();
header("Location: enroll-student.php?id=$classID");
exit();
?>
