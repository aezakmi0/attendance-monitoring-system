<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the tb_class table
$sqlClass = "SELECT * FROM tb_class WHERE is_deleted = 0";
$resultClass = $conn->query($sqlClass);

// Create an array to store the results
$data = array();

// Fetch the data and store it in the array
if ($resultClass->num_rows > 0) {
    while ($rowClass = $resultClass->fetch_assoc()) {
        // Fetch the count of students for the given class with is_deleted condition
        $classId = $rowClass['class_ID'];
        $sqlStudents = "SELECT COUNT(*) AS total_students FROM tb_enrollment WHERE class_ID = $classId AND is_deleted = 0";
        $resultStudents = $conn->query($sqlStudents);

        // Fetch the data and store it in the array
        $rowClass['total_students'] = 0; // default value if no students found
        if ($resultStudents->num_rows > 0) {
            $rowStudents = $resultStudents->fetch_assoc();
            $rowClass['total_students'] = $rowStudents['total_students'];
        }

        $data[] = $rowClass;
    }
}

// Close the database connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
