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

// Initialize the search term variable
$searchTerm = "";

// Check if the searchTerm parameter is set in the URL
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Fetch data from the tb_class table with the search term condition
$sqlClass = "SELECT * FROM tb_class WHERE is_deleted = 0";

// Add the search condition if the searchTerm is provided
if (!empty($searchTerm)) {
    $sqlClass .= " AND (class_code LIKE '%$searchTerm%' OR class_name LIKE '%$searchTerm%')";
}

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
        $rowClass['total_students'] = $resultStudents->fetch_assoc()['total_students'];
        $data[] = $rowClass;
    }
}

// Close the database connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
