<?php
session_start();
// Assuming you have a database connection established using MySQLi
$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$database = "u341493210_db_attendance";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$dsn = "mysql:host=localhost;dbname=u341493210_db_attendance";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';

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
    $timeStart = convert12to24($_POST['time_start']);
    $timeEnd = convert12to24($_POST['time_end']);
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
    $stmt->bindParam(':day', $selected_days);
    $stmt->bindParam(':class_id', $classId);

    // Execute the update
    $stmt->execute();
    
    // Close the PDO connection (not needed if the script is about to end)
    $pdo = null;

    $_SESSION['success_message'] = 'Class information updated successfully!';
} else {
    // Redirect back to the form page if the form is not submitted
    $_SESSION['success_message'] = 'Unable to update class information. Please try again later or contact support for assistance.';
}

// Close the MySQLi connection
$db->close();
header("Location: class.php?id=$classId");
exit();

// Function to convert 12-hour time to 24-hour format
function convert12to24($time12) {
    return date("H:i", strtotime($time12));
}
?>
