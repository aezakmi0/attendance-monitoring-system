<?php
// Assuming you have a database connection established using MySQLi
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_attendance";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$dsn = "mysql:host=localhost;dbname=db_attendance";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $classId = $_POST['class_id']; // Assuming you have a class_id field in your form
    $classCode = $_POST['class_code'];
    $className = $_POST['class_name'];
    $room = $_POST['room'];
    $timeStart = $_POST['time_start'];
    $timeEnd = $_POST['time_end'];
    $selected_days = isset($_POST["day"]) && is_array($_POST["day"]) ? implode("", $_POST["day"]) : '';

    // Assuming your SQL query is something like this
    $sql = "UPDATE tb_class SET 
            class_code = :class_code, 
            class_name = :class_name, 
            room = :room, 
            time_start = :time_start, 
            time_end = :time_end, 
            day = :day 
            WHERE class_ID = :class_id";

    $stmt = $pdo->prepare($sql);

    // Ensure that all placeholders in the SQL query match the bound parameters
    $stmt->bindParam(':class_code', $classCode);
    $stmt->bindParam(':class_name', $className);
    $stmt->bindParam(':room', $room);
    $stmt->bindParam(':time_start', $timeStart);
    $stmt->bindParam(':time_end', $timeEnd);
    $stmt->bindParam(':day', $selected_days); // Fix the variable name here
    $stmt->bindParam(':class_id', $classId); // Fix the variable name here

    // Execute the update
    $stmt->execute();
    
    // Close the PDO connection (not needed if the script is about to end)
    $pdo = null;
    
} else {
    // Redirect back to the form page if the form is not submitted
    header("Location: edit-class.php?id=$classId");
    exit();
}

// Close the MySQLi connection
$db->close();
?>
