<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the class_ID from the URL
$classId = isset($_GET['classId']) ? $_GET['classId'] : null;

// Fetch student data based on class_ID
$sql = "SELECT * FROM tb_student WHERE student_ID IN (SELECT student_ID FROM tb_enrollment WHERE class_ID = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $classId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data as an associative array
$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

// Close the database connection
$stmt->close();
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($students);
?>
