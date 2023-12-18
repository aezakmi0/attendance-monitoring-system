<?php
// Include the database connection file
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the AJAX request
$classId = $_POST['classId'];
$seatplanOrder = $_POST['seatplanOrder'];

// Update seat numbers in the database based on the new order
foreach ($seatplanOrder as $index => $seatplanId) {
    $seatplanId = (int) $seatplanId; // Convert to integer to prevent SQL injection
    $seatNumber = $index + 1;

    $query = "UPDATE tb_seatplan SET seat_number = ? WHERE seatplan_ID = ? AND class_ID = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("iii", $seatNumber, $seatplanId, $classId);

    if ($stmt->execute() !== TRUE) {
        echo "Error updating record: " . $stmt->error;
        exit;
    }

    // Close the statement to free up resources
    $stmt->close();
}

echo "Seatplan saved successfully.";

// Close the database connection
$conn->close();
?>
