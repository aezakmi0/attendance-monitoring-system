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
?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $class_code = $_POST["class_code"];
    $class_name = $_POST["class_name"];
    $room = $_POST["room"];
    $time_start = $_POST["time_start"];
    $time_end = $_POST["time_end"];

    // Check if "days" key exists and is an array
    $days = isset($_POST["day"]) && is_array($_POST["day"]) ? implode(",", $_POST["day"]) : '';

    // SQL query to insert data into the database
    $sql = "INSERT INTO tb_class (class_code, class_name, room, time_start, time_end, day)
            VALUES ('$class_code', '$class_name', '$room', '$time_start', '$time_end', '$days')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>