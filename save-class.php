<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $classCode = $_POST["class_code"];
    $className = $_POST["class_name"];
    $room = $_POST["room"];
    $startTime = $_POST["time_start"];
    $endTime = $_POST["time_end"];
    $selectedDays = $_POST["days"];
    $daysString = implode(',', $selectedDays); // Assuming you store days as comma-separated values

    // SQL query to insert data into the database
    $sql = "INSERT INTO tb_class (class_code, class_name, room, time_start, time_end, selected_days) VALUES ('$classCode', '$className', '$room', '$startTime', '$endTime', '$daysString')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>