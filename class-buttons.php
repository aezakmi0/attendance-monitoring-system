<?php
require_once 'includes/check_session.inc.php';

// Assuming you have a database connection established
$servername = "server1319";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$dbname = "u341493210_db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the search term variable
$searchTerm = "";
$filterTime = "";
$filterRoom = "";

$searchTerm = $_GET['search'];
$filterTime = $_GET['filterTime'];
$filterRoom = $_GET['filterRoom'];

error_log('Search term: ' . $_GET['search']);
error_log('Filter time: ' . $_GET['filterTime']);
error_log('Filter Room: ' . $_GET['filterRoom']);

// Fetch data from the tb_class table with the search term condition
$sqlClass = "SELECT * FROM tb_class WHERE is_deleted = 0 AND user_ID = '$user_ID'";

// Add the search condition if the searchTerm is provided
if (!empty($searchTerm)) {
    $sqlClass .= " AND (class_code LIKE ? OR class_name LIKE ?)";
}

// Add the time condition if the filterTime is provided
if (!empty($filterTime)) {
    $sqlClass .= " AND time_start <= ? AND time_end >= ?";
}

// Add the room condition if the filterRoom is provided
if (!empty($filterRoom)) {
    $sqlClass .= " AND room = ?";
}

// Prepare the statement
$stmt = $conn->prepare($sqlClass);

// Bind parameters if necessary
if (!empty($searchTerm)) {
    $searchParam = '%' . $searchTerm . '%';
    $stmt->bind_param("ss", $searchParam, $searchParam);
}

if (!empty($filterTime)) {
    $stmt->bind_param("ss", $filterTime, $filterTime);
}

if (!empty($filterRoom)) {
    $sqlClass .= " AND room = ?";
    $stmt->bind_param("s", $filterRoom);
}

// Execute the statement
$stmt->execute();
$resultClass = $stmt->get_result();

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
