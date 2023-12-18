<?php
// Include your database connection code or require_once('db_connection.php');
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_attendance";

// Create connection using MySQLi
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $classId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Perform the deletion
    try {
        // Use MySQLi for the update
        $sql = "UPDATE tb_class SET is_deleted = 1 WHERE class_ID = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $classId);  // 'i' represents integer type
        $stmt->execute();

        // Redirect to a confirmation page or back to the class list
        header("Location: index.html");
        exit();
    } catch (Exception $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect to an error page or back to the class list
    header("Location: index.html");
    exit();
}
?>
