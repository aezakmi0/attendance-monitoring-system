<?php
$classId = $_GET['class_id'];

// Assuming you have a database connection established
$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$dbname = "u341493210_db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the count of students for the given class
$sql = "SELECT COUNT(*) AS total_students FROM tb_enrollment WHERE class_ID = $classId AND is_deleted = 0";
$result = $conn->query($sql);

// Create an array to store the results
$data = array();

// Fetch the data and store it in the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}

// Close the database connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
