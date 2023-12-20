<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input parameters
$classId = isset($_GET['classId']) ? intval($_GET['classId']) : 0;
$studentId = isset($_GET['studentId']) ? intval($_GET['studentId']) : 0;

if ($classId <= 0 || $studentId <= 0) {
    // Invalid parameters, handle accordingly (e.g., return an error response)
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

// Your database query to fetch attendance status
// Modify this query based on your database structure
$query = "SELECT status FROM tb_attendance WHERE class_ID = $classId AND student_ID = $studentId AND date = CURRENT_DATE";

// Execute the query and fetch the result
$result = mysqli_query($conn, $query);

if ($result) {
    // Check if any rows were returned
    if ($row = mysqli_fetch_assoc($result)) {
        // Return the attendance status as JSON
        echo json_encode(['status' => $row['status']]);
    } else {
        // No attendance record for the current day, you might want to handle this case
        echo json_encode(['status' => 'No attendance']);
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle the database query error
    echo json_encode(['error' => 'Database query error']);
}

// Close the database connection
mysqli_close($conn);
?>