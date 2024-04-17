<?php
// Assuming you have some database connection setup
// Include or require your database connection file here
$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = "\$variable1=\"Hi\";";
$dbname = "u341493210_db_attendance";

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve class ID and date from the POST data
    $classId = $_POST['classId'];
    $date = $_POST['date'];

    // Perform database operation to delete status records for the specified class on the current date
    // Adjust the SQL query based on your database schema
    $sql = "DELETE FROM tb_attendance WHERE class_ID = ? AND date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $classId, $date);
    
    if ($stmt->execute()) {
        // Respond with success message or any relevant data
        echo json_encode(['success' => true, 'message' => 'Attendance status reset successfully']);
    } else {
        // Respond with error message
        echo json_encode(['success' => false, 'message' => 'Error resetting attendance status']);
    }
} else {
    // If the request method is not POST, respond with an error message
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// Close connection
$conn->close();
?>
