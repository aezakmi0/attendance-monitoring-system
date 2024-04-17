<?php
require_once 'includes/check_session.inc.php';
// assign_seat.php

$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = "\$variable1=\"Hi\";";
$dbname = "u341493210_db_attendance";

// Assuming you have a database connection established
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the AJAX request
$user_ID = $_SESSION['user_id'];
$classId = isset($_GET['classId']) ? $_GET['classId'] : null;
$seatNumber = isset($_GET['seatNumber']) ? $_GET['seatNumber'] : null;
$studentID = isset($_GET['studentID']) ? $_GET['studentID'] : null;

// Initialize response array
$response = array();

// Perform UPSERT operation (replace INTO is MySQL's UPSERT)
$sql = "
START TRANSACTION;
DELETE FROM tb_seatplan WHERE user_ID = $user_ID AND student_ID = $studentID AND class_ID = $classId;
INSERT INTO tb_seatplan (user_ID, class_ID, seat_number, student_ID)
VALUES ($user_ID, $classId, '$seatNumber', $studentID);
COMMIT;
";

if ($conn->multi_query($sql) === TRUE) {
    // Check if the last query was successful
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());

    $response['status'] = 'success';
    $response['message'] = 'Seat assignment successful.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error assigning seat: ' . $conn->error;
}

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);

$conn->close();
?>
